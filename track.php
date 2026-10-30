<?php
// track.php - Lightweight, Fast, Privacy-Friendly Visitor Analytics Tracker
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-cache, no-store, must-revalidate');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false, 'message' => 'POST method required']);
    exit;
}

// 1. Bot & Crawler Filtering
$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
$ua_lower = strtolower($user_agent);
$bots = [
    'bot', 'spider', 'crawl', 'slurp', 'mediapartners', 'headless', 'lighthouse',
    'facebookexternalhit', 'whatsapp', 'telegrambot', 'twitterbot', 'python', 'curl', 'wget'
];
foreach ($bots as $bot) {
    if (strpos($ua_lower, $bot) !== false) {
        echo json_encode(['ok' => true, 'bot' => true]);
        exit;
    }
}

// 2. Parse Incoming Beacon Payload
$raw_input = file_get_contents('php://input');
$payload = json_decode($raw_input, true);
if (!is_array($payload)) {
    $payload = [];
}

$referrer = isset($payload['referrer']) ? trim($payload['referrer']) : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
$utm_source = isset($payload['utm_source']) ? trim($payload['utm_source']) : '';
$is_new_session = !empty($payload['is_new_session']);
$path = isset($payload['path']) ? trim($payload['path']) : '/';
$screen_width = isset($payload['screen_width']) ? (int)$payload['screen_width'] : 0;

// 3. Classify Traffic Source
function classify_source($referrer, $utm_source) {
    if (!empty($utm_source)) {
        $u = strtolower($utm_source);
        if (strpos($u, 'google') !== false) return 'Google';
        if (strpos($u, 'instagram') !== false || $u === 'ig') return 'Instagram';
        if (strpos($u, 'facebook') !== false || $u === 'fb') return 'Facebook';
        if (strpos($u, 'tiktok') !== false) return 'TikTok';
        if (strpos($u, 'whatsapp') !== false || $u === 'wa') return 'WhatsApp';
        return ucfirst(substr($utm_source, 0, 20));
    }
    if (empty($referrer)) {
        return 'Direct';
    }
    $ref = strtolower($referrer);
    if (strpos($ref, 'google.') !== false) return 'Google';
    if (strpos($ref, 'instagram.com') !== false || strpos($ref, 'l.instagram.com') !== false) return 'Instagram';
    if (strpos($ref, 'facebook.com') !== false || strpos($ref, 'l.facebook.com') !== false || strpos($ref, 'fb.com') !== false) return 'Facebook';
    if (strpos($ref, 'tiktok.com') !== false) return 'TikTok';
    if (strpos($ref, 'whatsapp.com') !== false || strpos($ref, 'wa.me') !== false) return 'WhatsApp';
    if (strpos($ref, 'bing.com') !== false) return 'Bing';
    if (strpos($ref, 'yahoo.com') !== false) return 'Yahoo';
    if (strpos($ref, 'massaji.net') !== false || strpos($ref, 'localhost') !== false || strpos($ref, '127.0.0.1') !== false) return 'Direct';

    $host = parse_url($referrer, PHP_URL_HOST);
    if ($host) {
        $clean_host = preg_replace('/^www\./', '', $host);
        return substr($clean_host, 0, 25);
    }
    return 'Other';
}

$source = classify_source($referrer, $utm_source);

// 4. Device Detection
$device = 'Desktop';
if ($screen_width > 0) {
    $device = $screen_width <= 768 ? 'Mobile' : 'Desktop';
} elseif (preg_match('/(android|iphone|ipad|ipod|mobile|touch|opera mini)/i', $ua_lower)) {
    $device = 'Mobile';
}

// 5. Date & Time (WITA - Bali Timezone, UTC+8)
date_default_timezone_set('Asia/Makassar');
$today = date('Y-m-d');
$now = date('Y-m-d H:i:s');
$hour = (int)date('H');

// 6. Record to data/analytics.json with safe file locking
$analytics_file = __DIR__ . '/data/analytics.json';
$analytics_dir = dirname($analytics_file);
if (!is_dir($analytics_dir)) {
    @mkdir($analytics_dir, 0755, true);
}
$fp = @fopen($analytics_file, 'c+');
if ($fp) {
    if (@flock($fp, LOCK_EX)) {
        $size = @filesize($analytics_file);
        $content = $size > 0 ? @fread($fp, $size) : '';
        $db = json_decode($content, true);
        if (!is_array($db)) {
            $db = [
                'summary' => ['total_views' => 0, 'total_unique' => 0],
                'days' => [],
                'recent' => []
            ];
        }

        // Summary
        $db['summary']['total_views'] = ($db['summary']['total_views'] ?? 0) + 1;
        if ($is_new_session) {
            $db['summary']['total_unique'] = ($db['summary']['total_unique'] ?? 0) + 1;
        }

        // Day bucket
        if (!isset($db['days'][$today])) {
            $db['days'][$today] = [
                'views' => 0,
                'unique' => 0,
                'sources' => [],
                'devices' => ['Mobile' => 0, 'Desktop' => 0],
                'hours' => array_fill(0, 24, 0)
            ];
        }

        $db['days'][$today]['views']++;
        if ($is_new_session) {
            $db['days'][$today]['unique']++;
        }

        $db['days'][$today]['sources'][$source] = ($db['days'][$today]['sources'][$source] ?? 0) + 1;
        $db['days'][$today]['devices'][$device] = ($db['days'][$today]['devices'][$device] ?? 0) + 1;
        if (!isset($db['days'][$today]['hours']) || !is_array($db['days'][$today]['hours'])) {
            $db['days'][$today]['hours'] = array_fill(0, 24, 0);
        }
        $db['days'][$today]['hours'][$hour] = ($db['days'][$today]['hours'][$hour] ?? 0) + 1;

        // Recent live visitor log (keep last 50)
        if (!isset($db['recent']) || !is_array($db['recent'])) {
            $db['recent'] = [];
        }
        array_unshift($db['recent'], [
            'time' => $now,
            'source' => $source,
            'device' => $device,
            'path' => substr($path, 0, 50),
            'unique' => $is_new_session
        ]);
        if (count($db['recent']) > 50) {
            $db['recent'] = array_slice($db['recent'], 0, 50);
        }

        @ftruncate($fp, 0);
        @rewind($fp);
        @fwrite($fp, json_encode($db, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        @flock($fp, LOCK_UN);
    }
    @fclose($fp);
}

echo json_encode(['ok' => true, 'source' => $source, 'device' => $device]);

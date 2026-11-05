<?php
// admin/auth.php - Session and authentication management
date_default_timezone_set('Asia/Makassar');

if (session_status() === PHP_SESSION_NONE) {
    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
                (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443) ||
                (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    session_set_cookie_params([
        'lifetime' => 0,              // Cleared when browser closes
        'path'     => '/',
        'domain'   => '',
        'secure'   => $is_https,      // HTTPS transmission only when active
        'httponly' => true,           // Inaccessible via JavaScript document.cookie
        'samesite' => 'Lax'           // Protect against cross-site CSRF while preserving smooth admin navigation
    ]);

    session_start();
}

// Idle timeout management (30 minutes = 1800 seconds of inactivity)
$idle_timeout = 1800;
if (isset($_SESSION['massaji_admin_logged_in']) && $_SESSION['massaji_admin_logged_in'] === true) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $idle_timeout)) {
        // Clear expired session
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    } else {
        $_SESSION['last_activity'] = time();
    }
}

function get_settings() {
    $settings_file = __DIR__ . '/../data/settings.json';
    $default = [
        'site_name' => 'Massaji Spa Bali',
        'tagline' => 'Authentic Balinese Massage & Holistic Wellness Sanctuary',
        'booking_email' => 'massajibali.reservation@gmail.com',
        'admin_notification_email' => 'massajibali.reservation@gmail.com',
        'whatsapp_number' => '6281236695755',
        'phone' => '+62 812-3669-5755',
        'address' => 'Jl. Raya Canggu, Gg. Bedugul No. 3, Kerobokan, Canggu, Bali 80361',
        'google_maps_link' => 'https://www.google.com/maps/place/Massaji+Spa+Bali/@-8.6451761,115.1593768,17z/data=!3m1!4b1!4m6!3m5!1s0x2dd23899b3c269db:0x6cdb2c83c3f02d7c!8m2!3d-8.6451761!4d115.1619517!16s%2Fg%2F11c3k2xsjl',
        'opening_hours' => 'Setiap Hari: 10:00 - 21:00 WITA',
        'instagram' => 'https://instagram.com/massajispa',
        'currency_label' => 'IDR',
        'admin_password_hash' => '$2y$10$QkXl5EaR.p49d4QhP1pE9u8U2u9A/qf4l5z.n7M5X8B3V1C2D3E4F'
    ];
    if (file_exists($settings_file)) {
        $loaded = json_decode(file_get_contents($settings_file), true);
        if (is_array($loaded)) {
            return array_merge($default, $loaded);
        }
    }
    return $default;
}

function verify_admin_password($input, $stored_hash) {
    if (empty($input) || empty($stored_hash)) {
        return false;
    }
    return password_verify($input, $stored_hash);
}

function check_auth() {
    if (!isset($_SESSION['massaji_admin_logged_in']) || $_SESSION['massaji_admin_logged_in'] !== true) {
        header('Location: login.php');
        exit;
    }
}

function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

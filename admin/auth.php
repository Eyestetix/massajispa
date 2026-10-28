<?php
// admin/auth.php - Session and authentication management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function get_settings() {
    $settings_file = __DIR__ . '/../data/settings.json';
    $default = [
        'site_name' => 'Massaji Spa Bali',
        'tagline' => 'Authentic Balinese Massage & Holistic Wellness Sanctuary',
        'booking_email' => 'reservation@massaji.net',
        'whatsapp_number' => '6281236695755',
        'phone' => '+62 812-3669-5755',
        'address' => 'Jl. Raya Canggu, Gg. Bedugul No. 3, Kerobokan, Canggu, Bali 80361',
        'google_maps_link' => 'https://maps.google.com/?q=Massaji+Spa+Bali+Canggu',
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
    // Check standard bcrypt / argon
    if (!empty($stored_hash) && password_verify($input, $stored_hash)) {
        return true;
    }
    // Default initial password fallback
    if ($input === 'massaji2026') {
        return true;
    }
    return false;
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

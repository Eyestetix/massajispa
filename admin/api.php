<?php
// admin/api.php - Handles admin backend mutation requests
require_once __DIR__ . '/auth.php';
header('Content-Type: application/json; charset=utf-8');

check_auth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Metode permintaan tidak didukung.']);
    exit;
}

$token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
if (!verify_csrf_token($token)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Token keamanan CSRF tidak valid.']);
    exit;
}

$action = isset($_POST['action']) ? trim($_POST['action']) : '';
$settings_file = __DIR__ . '/../data/settings.json';
$promo_file    = __DIR__ . '/../data/promo.json';
$menu_file     = __DIR__ . '/../data/menu.json';

// Helper to read JSON
function read_json_file($file, $default = []) {
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        if (is_array($data)) return $data;
    }
    return $default;
}

// Helper to write JSON safely
function write_json_file($file, $data) {
    $dir = dirname($file);
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    $encoded = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return @file_put_contents($file, $encoded) !== false;
}

switch ($action) {
    // ----------------------------------------------------
    // Save General & Contact Settings
    // ----------------------------------------------------
    case 'save_settings':
        $settings = read_json_file($settings_file, get_settings());

        $settings['site_name']        = !empty($_POST['site_name']) ? trim(strip_tags($_POST['site_name'])) : $settings['site_name'];
        $settings['tagline']          = !empty($_POST['tagline']) ? trim(strip_tags($_POST['tagline'])) : $settings['tagline'];
        $settings['subtagline']       = !empty($_POST['subtagline']) ? trim(strip_tags($_POST['subtagline'])) : $settings['subtagline'];
        $settings['booking_email']    = !empty($_POST['booking_email']) ? filter_var(trim($_POST['booking_email']), FILTER_SANITIZE_EMAIL) : $settings['booking_email'];
        $settings['whatsapp_number']  = !empty($_POST['whatsapp_number']) ? preg_replace('/[^0-9]/', '', trim($_POST['whatsapp_number'])) : $settings['whatsapp_number'];
        $settings['phone']            = !empty($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : $settings['phone'];
        $settings['address']          = !empty($_POST['address']) ? trim(strip_tags($_POST['address'])) : $settings['address'];
        $settings['google_maps_link'] = !empty($_POST['google_maps_link']) ? trim($_POST['google_maps_link']) : $settings['google_maps_link'];
        $settings['opening_hours']    = !empty($_POST['opening_hours']) ? trim(strip_tags($_POST['opening_hours'])) : $settings['opening_hours'];
        $settings['instagram']        = !empty($_POST['instagram']) ? trim($_POST['instagram']) : $settings['instagram'];

        if (write_json_file($settings_file, $settings)) {
            echo json_encode(['success' => true, 'message' => 'Pengaturan kontak, email notifikasi & WhatsApp berhasil disimpan!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis ke file data/settings.json. Periksa izin akses folder.']);
        }
        break;

    // ----------------------------------------------------
    // Save Promo Banner
    // ----------------------------------------------------
    case 'save_promo':
        $promo = [
            'active'      => isset($_POST['active']) && ($_POST['active'] === '1' || $_POST['active'] === 'on' || $_POST['active'] === true),
            'badge'       => !empty($_POST['badge']) ? trim(strip_tags($_POST['badge'])) : 'Promo Spesial',
            'title'       => !empty($_POST['title']) ? trim(strip_tags($_POST['title'])) : '',
            'description' => !empty($_POST['description']) ? trim(strip_tags($_POST['description'])) : '',
            'code'        => !empty($_POST['code']) ? strtoupper(trim(strip_tags($_POST['code']))) : '',
            'valid_until' => !empty($_POST['valid_until']) ? trim(strip_tags($_POST['valid_until'])) : ''
        ];

        if (write_json_file($promo_file, $promo)) {
            echo json_encode(['success' => true, 'message' => 'Banner promo berhasil diperbarui!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan file promo.json.']);
        }
        break;

    // ----------------------------------------------------
    // Save Full Menu Items (Batch Edit)
    // ----------------------------------------------------
    case 'save_menu':
        if (!isset($_POST['menu_data'])) {
            echo json_encode(['success' => false, 'message' => 'Data menu tidak ditemukan.']);
            exit;
        }

        $decoded_menu = json_decode($_POST['menu_data'], true);
        if (!is_array($decoded_menu)) {
            echo json_encode(['success' => false, 'message' => 'Format data menu tidak valid.']);
            exit;
        }

        // Clean & sanitize each menu item
        $cleaned_menu = [];
        foreach ($decoded_menu as $item) {
            if (empty($item['name'])) continue;
            $cleaned_menu[] = [
                'id'          => !empty($item['id']) ? preg_replace('/[^a-zA-Z0-9_-]/', '-', strtolower($item['id'])) : uniqid('item-'),
                'category'    => !empty($item['category']) ? trim(strip_tags($item['category'])) : 'massage',
                'name'        => trim(strip_tags($item['name'])),
                'duration'    => !empty($item['duration']) ? trim(strip_tags($item['duration'])) : '60 Menit',
                'price'       => isset($item['price']) ? intval(preg_replace('/[^0-9]/', '', (string)$item['price'])) : 0,
                'description' => !empty($item['description']) ? trim(strip_tags($item['description'])) : '',
                'is_featured' => !empty($item['is_featured']) && ($item['is_featured'] === true || $item['is_featured'] === '1' || $item['is_featured'] === 1),
                'tag'         => !empty($item['tag']) ? trim(strip_tags($item['tag'])) : ''
            ];
        }

        if (write_json_file($menu_file, $cleaned_menu)) {
            echo json_encode(['success' => true, 'message' => 'Daftar menu dan harga berhasil diperbarui!', 'total' => count($cleaned_menu)]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis ke menu.json.']);
        }
        break;

    // ----------------------------------------------------
    // Add Single Menu Item
    // ----------------------------------------------------
    case 'add_menu_item':
        $menu = read_json_file($menu_file, []);

        $name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
        if (empty($name)) {
            echo json_encode(['success' => false, 'message' => 'Nama perawatan wajib diisi.']);
            exit;
        }

        $new_item = [
            'id'          => !empty($_POST['id']) ? preg_replace('/[^a-zA-Z0-9_-]/', '-', strtolower($_POST['id'])) : uniqid('item-'),
            'category'    => !empty($_POST['category']) ? trim(strip_tags($_POST['category'])) : 'massage',
            'name'        => $name,
            'duration'    => !empty($_POST['duration']) ? trim(strip_tags($_POST['duration'])) : '60 Menit',
            'price'       => isset($_POST['price']) ? intval(preg_replace('/[^0-9]/', '', (string)$_POST['price'])) : 0,
            'description' => !empty($_POST['description']) ? trim(strip_tags($_POST['description'])) : '',
            'is_featured' => isset($_POST['is_featured']) && ($_POST['is_featured'] === '1' || $_POST['is_featured'] === 'on'),
            'tag'         => !empty($_POST['tag']) ? trim(strip_tags($_POST['tag'])) : ''
        ];

        $menu[] = $new_item;

        if (write_json_file($menu_file, $menu)) {
            echo json_encode(['success' => true, 'message' => 'Perawatan baru berhasil ditambahkan!', 'item' => $new_item]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan item ke menu.json.']);
        }
        break;

    // ----------------------------------------------------
    // Delete Menu Item
    // ----------------------------------------------------
    case 'delete_menu_item':
        $id = isset($_POST['id']) ? trim($_POST['id']) : '';
        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'ID perawatan tidak ditemukan.']);
            exit;
        }

        $menu = read_json_file($menu_file, []);
        $updated_menu = array_values(array_filter($menu, function($item) use ($id) {
            return $item['id'] !== $id;
        }));

        if (write_json_file($menu_file, $updated_menu)) {
            echo json_encode(['success' => true, 'message' => 'Perawatan berhasil dihapus!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus item menu.']);
        }
        break;

    // ----------------------------------------------------
    // Change Admin Password
    // ----------------------------------------------------
    case 'change_password':
        $current_password = isset($_POST['current_password']) ? trim($_POST['current_password']) : '';
        $new_password     = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
        $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

        $settings = read_json_file($settings_file, get_settings());

        if (!verify_admin_password($current_password, $settings['admin_password_hash'])) {
            echo json_encode(['success' => false, 'message' => 'Password saat ini salah.']);
            exit;
        }

        if (strlen($new_password) < 6) {
            echo json_encode(['success' => false, 'message' => 'Password baru minimal 6 karakter.']);
            exit;
        }

        if ($new_password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'Konfirmasi password baru tidak cocok.']);
            exit;
        }

        $settings['admin_password_hash'] = password_hash($new_password, PASSWORD_DEFAULT);

        if (write_json_file($settings_file, $settings)) {
            echo json_encode(['success' => true, 'message' => 'Password admin berhasil diganti!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui password di settings.json.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Aksi tidak dikenali.']);
        break;
}

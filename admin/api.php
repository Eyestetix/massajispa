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
    case 'save_home':
        $settings = read_json_file($settings_file, get_settings());

        $fields = [
            'site_name', 'tagline', 'subtagline', 'booking_email', 
            'whatsapp_number', 'phone', 'whatsapp_number_2', 'phone_2',
            'address', 'google_maps_link', 'opening_hours', 'instagram',
            'hero_title_1', 'hero_title_2', 'hero_desc', 'hero_image',
            'about_title_1', 'about_title_2', 'about_desc_1', 'about_desc_2', 'about_image',
            'promo_title', 'promo_subtitle', 'promo_validity', 'promo_flyer_image'
        ];

        foreach ($fields as $f) {
            if (isset($_POST[$f])) {
                $settings[$f] = trim($_POST[$f]);
            }
        }

        if (write_json_file($settings_file, $settings)) {
            @exec('python3 ' . escapeshellarg(__DIR__ . '/../build_preview.py'));
            echo json_encode(['success' => true, 'message' => 'Pengaturan berhasil disimpan!', 'settings' => $settings]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis ke file data/settings.json. Periksa izin akses folder.']);
        }
        break;

    case 'save_single_item':
        if (!isset($_POST['item'])) {
            echo json_encode(['success' => false, 'message' => 'Data item tidak ditemukan.']);
            exit;
        }
        $target_item = json_decode($_POST['item'], true);
        if (!is_array($target_item) || empty($target_item['name'])) {
            echo json_encode(['success' => false, 'message' => 'Format item tidak valid.']);
            exit;
        }
        $menu = read_json_file($menu_file, []);
        $found = false;
        foreach ($menu as $idx => $it) {
            if ($it['id'] === $target_item['id']) {
                $menu[$idx] = $target_item;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $menu[] = $target_item;
        }
        if (write_json_file($menu_file, $menu)) {
            @exec('python3 ' . escapeshellarg(__DIR__ . '/../build_preview.py'));
            echo json_encode(['success' => true, 'message' => "Treatment '{$target_item['name']}' berhasil diperbarui!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis ke menu.json.']);
        }
        break;

    case 'get_available_images':
        $img_dir = __DIR__ . '/../assets/images';
        $imgs = [];
        if (is_dir($img_dir)) {
            $files = scandir($img_dir);
            foreach ($files as $fn) {
                if (in_array(strtolower(pathinfo($fn, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'svg'])) {
                    $imgs[] = 'assets/images/' . $fn;
                }
            }
        }
        echo json_encode(['success' => true, 'images' => $imgs]);
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

        // Clean & sanitize each menu item preserving all bilingual fields
        $cleaned_menu = [];
        foreach ($decoded_menu as $item) {
            if (empty($item['name'])) continue;
            $entry = [
                'id'             => !empty($item['id']) ? preg_replace('/[^a-zA-Z0-9_-]/', '-', strtolower($item['id'])) : uniqid('item-'),
                'category'       => !empty($item['category']) ? trim(strip_tags($item['category'])) : 'massage',
                'name'           => trim(strip_tags($item['name'])),
                'duration'       => !empty($item['duration']) ? trim(strip_tags($item['duration'])) : '60 Menit',
                'price'          => isset($item['price']) ? intval(preg_replace('/[^0-9]/', '', (string)$item['price'])) : 0,
                'description'    => !empty($item['description']) ? trim(strip_tags($item['description'])) : '',
                'is_featured'    => !empty($item['is_featured']) && ($item['is_featured'] === true || $item['is_featured'] === '1' || $item['is_featured'] === 1),
                'tag'            => !empty($item['tag']) ? trim(strip_tags($item['tag'])) : '',
                'name_id'        => !empty($item['name_id']) ? trim(strip_tags($item['name_id'])) : trim(strip_tags($item['name'])),
                'duration_id'    => !empty($item['duration_id']) ? trim(strip_tags($item['duration_id'])) : (!empty($item['duration']) ? trim(strip_tags($item['duration'])) : '60 Menit'),
                'tag_id'         => !empty($item['tag_id']) ? trim(strip_tags($item['tag_id'])) : (!empty($item['tag']) ? trim(strip_tags($item['tag'])) : ''),
                'description_id' => !empty($item['description_id']) ? trim(strip_tags($item['description_id'])) : (!empty($item['description']) ? trim(strip_tags($item['description'])) : '')
            ];
            if (!empty($item['normal_price'])) {
                $entry['normal_price'] = intval(preg_replace('/[^0-9]/', '', (string)$item['normal_price']));
            }
            if (!empty($item['multi_prices'])) {
                $entry['multi_prices'] = trim(strip_tags($item['multi_prices']));
            }
            if (!empty($item['multi_prices_id'])) {
                $entry['multi_prices_id'] = trim(strip_tags($item['multi_prices_id']));
            }
            $cleaned_menu[] = $entry;
        }

        if (write_json_file($menu_file, $cleaned_menu)) {
            @exec('python3 ' . escapeshellarg(__DIR__ . '/../build_preview.py'));
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

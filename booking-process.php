<?php
// booking-process.php - Handles spa reservation submissions dynamically
header('Content-Type: application/json; charset=utf-8');

// Allow POST only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Metode permintaan tidak valid.']);
    exit;
}

// Load dynamic settings
$settings_file = __DIR__ . '/data/settings.json';
$settings = [
    'site_name' => 'Massaji Spa Bali',
    'booking_email' => 'reservation@massaji.net',
    'whatsapp_number' => '6281236695755'
];
if (file_exists($settings_file)) {
    $loaded_settings = json_decode(file_get_contents($settings_file), true);
    if (is_array($loaded_settings)) {
        $settings = array_merge($settings, $loaded_settings);
    }
}

// Sanitize & Validate inputs
$name    = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$email   = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$phone   = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
$service = isset($_POST['service']) ? trim(strip_tags($_POST['service'])) : 'General Spa Treatment';
$date    = isset($_POST['date']) ? trim(strip_tags($_POST['date'])) : '';
$time    = isset($_POST['time']) ? trim(strip_tags($_POST['time'])) : '';
$guests  = isset($_POST['guests']) ? intval($_POST['guests']) : 1;
$notes   = isset($_POST['notes']) ? trim(strip_tags($_POST['notes'])) : '-';

if (empty($name) || empty($phone) || empty($date) || empty($time)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Mohon lengkapi Nama, Nomor WhatsApp/Telepon, Tanggal, dan Jam reservasi.']);
    exit;
}

if ($guests < 1) $guests = 1;

// Clean WhatsApp number
$wa_number = preg_replace('/[^0-9]/', '', $settings['whatsapp_number']);
if (substr($wa_number, 0, 1) === '0') {
    $wa_number = '62' . substr($wa_number, 1);
}

// Generate prefilled WhatsApp message
$wa_text  = "Halo *" . $settings['site_name'] . "*,\n\n";
$wa_text .= "Saya ingin mengonfirmasi reservasi via website:\n";
$wa_text .= "• *Nama:* " . $name . "\n";
$wa_text .= "• *Layanan:* " . $service . "\n";
$wa_text .= "• *Tanggal:* " . $date . "\n";
$wa_text .= "• *Jam:* " . $time . " WITA\n";
$wa_text .= "• *Jumlah Tamu:* " . $guests . " orang\n";
if (!empty($phone)) $wa_text .= "• *Kontak:* " . $phone . "\n";
if (!empty($notes) && $notes !== '-') $wa_text .= "• *Catatan:* " . $notes . "\n\n";
$wa_text .= "Apakah slot waktu tersebut masih tersedia? Terima kasih.";

$wa_url = "https://wa.me/" . $wa_number . "?text=" . rawurlencode($wa_text);

// Save booking record into data/bookings.json (for admin panel history)
$bookings_file = __DIR__ . '/data/bookings.json';
$bookings = [];
if (file_exists($bookings_file)) {
    $bookings = json_decode(file_get_contents($bookings_file), true) ?: [];
}

$new_booking = [
    'id'         => 'BK-' . date('Ymd-His') . '-' . rand(100, 999),
    'created_at' => date('Y-m-d H:i:s'),
    'name'       => $name,
    'email'      => $email,
    'phone'      => $phone,
    'service'    => $service,
    'date'       => $date,
    'time'       => $time,
    'guests'     => $guests,
    'notes'      => $notes,
    'status'     => 'pending'
];
array_unshift($bookings, $new_booking);
// Keep last 100 bookings
if (count($bookings) > 100) {
    $bookings = array_slice($bookings, 0, 100);
}
@file_put_contents($bookings_file, json_encode($bookings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Send notification email to admin
$to = $settings['booking_email'];
$subject = "[Booking Baru] " . $service . " - " . $name . " (" . $date . " " . $time . ")";

$headers = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';
if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $headers[] = 'From: ' . $settings['site_name'] . ' <' . $settings['booking_email'] . '>';
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
} else {
    $headers[] = 'From: ' . $settings['site_name'] . ' <' . $settings['booking_email'] . '>';
}

$email_body = '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
  body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; background-color: #f7f5f0; margin: 0; padding: 20px; color: #2d2a26; }
  .card { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e8e2d5; }
  .header { background: #1c1917; color: #d4af37; padding: 28px 24px; text-align: center; }
  .header h2 { margin: 0; font-size: 24px; font-weight: 500; letter-spacing: 1px; color: #f5f2eb; }
  .header p { margin: 6px 0 0; color: #c5a880; font-size: 13px; text-transform: uppercase; letter-spacing: 2px; }
  .content { padding: 30px 24px; }
  .badge { display: inline-block; background: #c27854; color: #ffffff; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; margin-bottom: 20px; }
  .table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
  .table td { padding: 12px 10px; border-bottom: 1px solid #f0eae1; font-size: 14px; }
  .table td.label { font-weight: 600; color: #78716c; width: 35%; }
  .table td.value { color: #1c1917; font-weight: 500; }
  .btn-wa { display: block; text-align: center; background: #25D366; color: #ffffff; text-decoration: none; padding: 14px 20px; border-radius: 8px; font-weight: bold; font-size: 15px; margin-top: 15px; }
  .footer { background: #faf8f5; padding: 16px; text-align: center; font-size: 12px; color: #a8a29e; border-top: 1px solid #f0eae1; }
</style>
</head>
<body>
  <div class="card">
    <div class="header">
      <h2>' . htmlspecialchars($settings['site_name']) . '</h2>
      <p>Notifikasi Reservasi Masuk</p>
    </div>
    <div class="content">
      <div class="badge">Reservasi Baru Website</div>
      <table class="table">
        <tr><td class="label">Nama Tamu</td><td class="value">' . htmlspecialchars($name) . '</td></tr>
        <tr><td class="label">Layanan/Treatment</td><td class="value"><strong>' . htmlspecialchars($service) . '</strong></td></tr>
        <tr><td class="label">Tanggal Kunjungan</td><td class="value">' . htmlspecialchars($date) . '</td></tr>
        <tr><td class="label">Waktu/Jam</td><td class="value">' . htmlspecialchars($time) . ' WITA</td></tr>
        <tr><td class="label">Jumlah Tamu</td><td class="value">' . htmlspecialchars($guests) . ' Orang</td></tr>
        <tr><td class="label">No. Telepon / WA</td><td class="value">' . htmlspecialchars($phone) . '</td></tr>
        <tr><td class="label">Email Tamu</td><td class="value">' . (!empty($email) ? htmlspecialchars($email) : '<em>Tidak dicantumkan</em>') . '</td></tr>
        <tr><td class="label">Catatan Tambahan</td><td class="value">' . nl2br(htmlspecialchars($notes)) . '</td></tr>
      </table>
      <a href="' . $wa_url . '" class="btn-wa">Balas & Hubungi Tamu via WhatsApp</a>
    </div>
    <div class="footer">
      Email ini dikirim otomatis oleh sistem website ' . htmlspecialchars($settings['site_name']) . '.
    </div>
  </div>
</body>
</html>';

$mail_sent = @mail($to, $subject, $email_body, implode("\r\n", $headers));

// Return response
echo json_encode([
    'success'      => true,
    'message'      => 'Permintaan reservasi Anda telah berhasil dikirim ke email resepsionis kami. Tim kami akan segera mengonfirmasi jadwal Anda.',
    'mail_sent'    => $mail_sent,
    'whatsapp_url' => $wa_url,
    'details'      => [
        'name'     => $name,
        'service'  => $service,
        'date'     => $date,
        'time'     => $time,
        'guests'   => $guests
    ]
]);

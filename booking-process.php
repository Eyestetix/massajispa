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

// Format guest WhatsApp reply URL
$clean_guest_phone = preg_replace('/[^0-9]/', '', $phone);
if (substr($clean_guest_phone, 0, 1) === '0') {
    $clean_guest_phone = '62' . substr($clean_guest_phone, 1);
}

$reply_wa_text  = "Halo Kak *" . $name . "*,\n\n";
$reply_wa_text .= "Terima kasih telah melakukan reservasi di *" . $settings['site_name'] . "*!\n";
$reply_wa_text .= "Kami ingin mengonfirmasi jadwal perawatan Anda:\n";
$reply_wa_text .= "• *Layanan:* " . $service . "\n";
$reply_wa_text .= "• *Tanggal:* " . $date . "\n";
$reply_wa_text .= "• *Jam:* " . $time . " WITA\n";
$reply_wa_text .= "• *Jumlah Tamu:* " . $guests . " Orang\n\n";
$reply_wa_text .= "Apakah ada permintaan khusus lainnya sebelum kedatangan? Kami tunggu kedatangannya di Massaji Spa Canggu. Terima kasih! 🙏";

$guest_wa_url = !empty($clean_guest_phone) 
    ? "https://wa.me/" . $clean_guest_phone . "?text=" . rawurlencode($reply_wa_text)
    : $wa_url;

$booking_id = $new_booking['id'];
$created_time = date('d M Y, H:i') . ' WITA';

// Send notification email to admin matching web design
$to = $settings['booking_email'];
$subject = "[Booking Baru] " . $service . " - " . $name . " (" . $date . " " . $time . " WITA)";

$headers = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';
if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $headers[] = 'From: ' . $settings['site_name'] . ' <' . $settings['booking_email'] . '>';
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
} else {
    $headers[] = 'From: ' . $settings['site_name'] . ' <' . $settings['booking_email'] . '>';
}

$email_body = '<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>' . htmlspecialchars($subject) . '</title>
</head>
<body style="margin: 0; padding: 0; background-color: #EBF5FE; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #141E3C;">
  
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #EBF5FE; padding: 30px 15px;">
    <tr>
      <td align="center">
        
        <!-- Main Card Container -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width: 620px; background-color: #FFFFFF; border-radius: 18px; overflow: hidden; border: 1px solid #BAE0FD; box-shadow: 0 12px 36px rgba(20, 30, 60, 0.08);">
          
          <!-- ============================================== -->
          <!-- 1. HEADER (Deep Indigo & Sapphire Gradient) -->
          <!-- ============================================== -->
          <tr>
            <td style="background: #141E3C; background: linear-gradient(135deg, #141E3C 0%, #1E3A8A 55%, #141E3C 100%); padding: 36px 24px 30px; text-align: center; border-bottom: 2px solid #0284C7;">
              
              <!-- Brand Logo Emblem -->
              <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 0 auto 12px;">
                <tr>
                  <td style="width: 60px; height: 60px; border-radius: 50%; background-color: #FFFFFF; padding: 4px; border: 2px solid #BAE0FD; text-align: center; vertical-align: middle; box-shadow: 0 4px 14px rgba(0,0,0,0.25);">
                    <img src="https://eyestetix.github.io/massajispa/assets/images/member-1.png" alt="Massaji Spa Logo" width="52" height="52" style="width: 52px; height: 52px; border-radius: 50%; display: block; margin: 0 auto; object-fit: contain;">
                  </td>
                </tr>
              </table>

              <!-- Katakana Brand Mark -->
              <div style="font-size: 11px; font-weight: 800; letter-spacing: 3px; color: #BAE0FD; text-transform: uppercase; margin-bottom: 4px;">マッサージ</div>
              
              <!-- Brand Name -->
              <h1 style="margin: 0; font-size: 26px; font-weight: 700; color: #FFFFFF; letter-spacing: -0.5px; line-height: 1.2;">
                Massaji <span style="font-style: italic; font-weight: 400; color: #BAE0FD;">Spa</span>
              </h1>
              
              <div style="font-size: 10px; font-weight: 700; letter-spacing: 2.5px; color: #94A3B8; text-transform: uppercase; margin-top: 4px;">CANGGU &bull; BALI</div>
              
              <!-- Badge Tag -->
              <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 18px auto 0;">
                <tr>
                  <td style="background-color: rgba(2, 132, 199, 0.35); border: 1px solid #38BDF8; color: #E0F2FE; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; padding: 6px 18px; border-radius: 20px;">
                    ✨ NOTIFIKASI RESERVASI MASUK
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- ============================================== -->
          <!-- 2. SUMMARY HIGHLIGHT CARD -->
          <!-- ============================================== -->
          <tr>
            <td style="padding: 28px 28px 12px;">
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #F0F8FF; border: 1px solid #BAE0FD; border-radius: 14px; padding: 20px;">
                <tr>
                  <td>
                    <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #0284C7; margin-bottom: 6px;">Layanan / Treatment yang Dipesan:</div>
                    <div style="font-size: 20px; font-weight: 800; color: #141E3C; line-height: 1.3; margin-bottom: 14px;">' . htmlspecialchars($service) . '</div>
                    
                    <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="padding-right: 8px; padding-bottom: 6px;">
                          <div style="background-color: #FFFFFF; border: 1px solid #BAE0FD; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; color: #1E3A8A;">
                            📅 ' . htmlspecialchars($date) . '
                          </div>
                        </td>
                        <td style="padding-right: 8px; padding-bottom: 6px;">
                          <div style="background-color: #FFFFFF; border: 1px solid #BAE0FD; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; color: #1E3A8A;">
                            ⏰ ' . htmlspecialchars($time) . ' WITA
                          </div>
                        </td>
                        <td style="padding-bottom: 6px;">
                          <div style="background-color: #FFFFFF; border: 1px solid #BAE0FD; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; color: #1E3A8A;">
                            👥 ' . htmlspecialchars($guests) . ' Tamu
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ============================================== -->
          <!-- 3. DETAILED INFORMATION TABLE -->
          <!-- ============================================== -->
          <tr>
            <td style="padding: 12px 28px 24px;">
              <div style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.2px; color: #475569; margin-bottom: 12px; padding-bottom: 6px; border-bottom: 1px solid #E2E8F0;">
                Rincian Lengkap Tamu &amp; Reservasi
              </div>

              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; font-size: 13px;">
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; width: 38%; background-color: #F8FCFF;">👤 Nama Lengkap</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #141E3C; font-weight: 700; font-size: 14px;">' . htmlspecialchars($name) . '</td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; background-color: #F8FCFF;">💆 Layanan Spa</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #0284C7; font-weight: 700;">' . htmlspecialchars($service) . '</td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; background-color: #F8FCFF;">📅 Tanggal Perawatan</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #141E3C; font-weight: 600;">' . htmlspecialchars($date) . '</td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; background-color: #F8FCFF;">⏰ Waktu / Jam</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #141E3C; font-weight: 600;">' . htmlspecialchars($time) . ' WITA</td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; background-color: #F8FCFF;">👥 Jumlah Tamu</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #141E3C; font-weight: 600;">' . htmlspecialchars($guests) . ' Orang</td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; background-color: #F8FCFF;">📱 WhatsApp / Telp</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #059669; font-weight: 700;">
                    <a href="tel:' . htmlspecialchars($phone) . '" style="color: #059669; text-decoration: none;">' . htmlspecialchars($phone) . '</a>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; background-color: #F8FCFF;">✉️ Email Tamu</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #141E3C;">' . (!empty($email) ? '<a href="mailto:' . htmlspecialchars($email) . '" style="color: #0284C7; text-decoration: none; font-weight: 600;">' . htmlspecialchars($email) . '</a>' : '<span style="color: #94A3B8; font-style: italic;">Tidak dicantumkan</span>') . '</td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; background-color: #F8FCFF;">📝 Permintaan Khusus</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #141E3C; font-style: italic;">' . nl2br(htmlspecialchars($notes)) . '</td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #64748B; font-weight: 600; background-color: #F8FCFF;">🔖 ID Booking</td>
                  <td style="padding: 11px 12px; border-bottom: 1px solid #F1F5F9; color: #475569; font-family: monospace; font-weight: 600;">' . htmlspecialchars($booking_id) . '</td>
                </tr>
                <tr>
                  <td style="padding: 11px 12px; color: #64748B; font-weight: 600; background-color: #F8FCFF;">⏱️ Waktu Pengajuan</td>
                  <td style="padding: 11px 12px; color: #475569; font-size: 12px;">' . htmlspecialchars($created_time) . '</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ============================================== -->
          <!-- 4. INSTANT ACTION BUTTONS -->
          <!-- ============================================== -->
          <tr>
            <td style="padding: 0 28px 30px;">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td align="center">
                    <!-- WhatsApp Direct Reply Button -->
                    <a href="' . $guest_wa_url . '" target="_blank" style="display: block; width: 100%; box-sizing: border-box; background-color: #059669; color: #FFFFFF; padding: 15px 20px; border-radius: 12px; font-weight: 700; font-size: 14px; text-decoration: none; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35);">
                      💬 Hubungi &amp; Balas Tamu via WhatsApp
                    </a>
                  </td>
                </tr>
              </table>

              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 10px;">
                <tr>
                  <td width="48%" align="center">
                    <a href="tel:' . htmlspecialchars($phone) . '" style="display: block; background-color: #F0F8FF; border: 1px solid #BAE0FD; color: #1E3A8A; padding: 10px; border-radius: 10px; font-size: 12px; font-weight: 700; text-decoration: none; text-align: center;">
                      📞 Telepon Langsung
                    </a>
                  </td>
                  <td width="4%"></td>
                  <td width="48%" align="center">
                    <a href="https://eyestetix.github.io/massajispa/admin/" target="_blank" style="display: block; background-color: #F0F8FF; border: 1px solid #BAE0FD; color: #1E3A8A; padding: 10px; border-radius: 10px; font-size: 12px; font-weight: 700; text-decoration: none; text-align: center;">
                      🔐 Buka Panel Admin
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ============================================== -->
          <!-- 5. FOOTER (Matching Massaji Spa Web Footer) -->
          <!-- ============================================== -->
          <tr>
            <td style="background-color: #141E3C; padding: 28px 24px; text-align: center; color: #94A3B8; font-size: 12px; border-top: 1px solid rgba(186, 224, 253, 0.2);">
              
              <!-- Footer Brand -->
              <div style="font-size: 16px; font-weight: 700; color: #FFFFFF; margin-bottom: 4px;">
                Massaji <span style="color: #BAE0FD; font-style: italic; font-weight: 400;">Spa</span>
                <span style="font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: #BAE0FD; margin-left: 6px;">Canggu &bull; Bali</span>
              </div>
              
              <p style="margin: 6px 0 12px; color: #CBD5E1; font-size: 11px; line-height: 1.5; max-width: 480px; margin-left: auto; margin-right: auto;">
                Authentic Balinese Massage, Curated Spa Packages &amp; Holistic Wellness Sanctuary in Kerobokan and Canggu.
              </p>

              <div style="color: #94A3B8; font-size: 11px; line-height: 1.6; margin-bottom: 12px;">
                📍 Jl. Raya Canggu, Gg. Bedugul No. 3, Kerobokan, Bali 80361<br>
                🕒 Buka Setiap Hari: 10:00 AM – 9:00 PM WITA &bull; 📱 WA: +62 812-3669-5755
              </div>

              <div style="font-size: 10px; color: #64748B; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 12px; margin-top: 12px;">
                &copy; 2026 Massaji Spa Bali. All rights reserved.<br>
                <span style="color: #475569;">Email ini dikirim otomatis oleh sistem reservasi website Massaji Spa Bali.</span>
              </div>

            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

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

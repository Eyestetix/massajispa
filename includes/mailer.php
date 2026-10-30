<?php
// includes/mailer.php - Authenticated SMTP Mailer for Massaji Spa Bali
// Uses verified PHPMailer v6.9.1 via direct class requires (No Composer required)

require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Loads SMTP configuration from server-side JSON or environment variables.
 * Note: Password is never stored in source-controlled files.
 */
function get_smtp_config() {
    $config_file = __DIR__ . '/../data/smtp_config.json';
    $config = [
        'enabled'    => true,
        'host'       => 'mail.massaji.net',
        'port'       => 465,
        'secure'     => 'ssl',
        'auth'       => true,
        'username'   => 'reservation@massaji.net',
        'password'   => '',
        'from_email' => 'reservation@massaji.net',
        'from_name'  => 'Massaji Spa Bali',
        'to_email'   => 'eyestetix@gmail.com',
        'timeout'    => 15
    ];

    if (file_exists($config_file)) {
        $content = @file_get_contents($config_file);
        if ($content) {
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                $config = array_merge($config, $decoded);
            }
        }
    }

    // Support environment variable overrides
    $env_pass = getenv('SMTP_PASSWORD');
    if (!empty($env_pass)) {
        $config['password'] = $env_pass;
    }

    $env_user = getenv('SMTP_USERNAME');
    if (!empty($env_user)) {
        $config['username'] = $env_user;
    }

    $env_host = getenv('SMTP_HOST');
    if (!empty($env_host)) {
        $config['host'] = $env_host;
    }

    $env_to = getenv('SMTP_TO');
    if (!empty($env_to)) {
        $config['to_email'] = $env_to;
    }

    return $config;
}

/**
 * Safe server-side diagnostic logging.
 * Strictly prevents writing passwords, tokens, auth transcripts, or sensitive personal data.
 */
function log_mail_diagnostic($booking_id, $success, $error_category = null, $technical_detail = null) {
    $log_file = __DIR__ . '/../data/mail_log.json';
    $entries = [];

    if (file_exists($log_file)) {
        $content = @file_get_contents($log_file);
        if ($content) {
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                $entries = $decoded;
            }
        }
    }

    // Sanitize technical detail (redact any passwords or tokens)
    $sanitized_detail = null;
    if ($technical_detail) {
        $clean = strip_tags((string)$technical_detail);
        $clean = preg_replace('/(password|pass|auth|token|pwd)[:=\s]+[^\s,]+/i', '$1: [REDACTED]', $clean);
        $sanitized_detail = substr($clean, 0, 300);
    }

    $entry = [
        'booking_id' => $booking_id,
        'timestamp'  => date('Y-m-d H:i:s'),
        'timezone'   => 'WITA (UTC+8)',
        'status'     => $success ? 'SENT' : 'FAILED',
        'category'   => $error_category,
        'detail'     => $sanitized_detail
    ];

    array_unshift($entries, $entry);
    if (count($entries) > 50) {
        $entries = array_slice($entries, 0, 50);
    }

    @file_put_contents($log_file, json_encode($entries, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

/**
 * Sends reservation notification to administrator using authenticated SMTP via PHPMailer.
 *
 * @param array $booking Stored booking record
 * @param string $html_body Rendered HTML email content
 * @param string $plain_body Rendered Plain-Text email content
 * @param string|null &$error_message Output variable for sanitized error description
 * @return bool True if SMTP accepted the message, False otherwise
 */
function send_smtp_notification($booking, $html_body, $plain_body, &$error_message = null) {
    $error_message = null;
    $booking_id = isset($booking['id']) ? $booking['id'] : 'UNKNOWN';
    $name = isset($booking['name']) ? $booking['name'] : 'Tamu';
    $email = isset($booking['email']) ? trim($booking['email']) : '';

    $cfg = get_smtp_config();

    // Check if SMTP is disabled
    if (isset($cfg['enabled']) && $cfg['enabled'] === false) {
        $error_message = 'SMTP disabled in configuration';
        log_mail_diagnostic($booking_id, false, 'DISABLED', $error_message);
        return false;
    }

    // Check if password has been configured
    if (empty($cfg['password'])) {
        $error_message = 'SMTP password not configured. Create data/smtp_config.json on server with valid credentials.';
        log_mail_diagnostic($booking_id, false, 'MISSING_PASSWORD', 'Password empty in data/smtp_config.json');
        return false;
    }

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $cfg['host'];
        $mail->SMTPAuth   = (bool)$cfg['auth'];
        $mail->Username   = $cfg['username'];
        $mail->Password   = $cfg['password'];

        if ((int)$cfg['port'] === 465 || strtolower($cfg['secure']) === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = (int)$cfg['port'];
        }

        $mail->Timeout    = isset($cfg['timeout']) ? (int)$cfg['timeout'] : 15;
        $mail->CharSet    = 'UTF-8';

        // Sender & Recipient Configuration
        $from_email = !empty($cfg['from_email']) ? $cfg['from_email'] : 'reservation@massaji.net';
        $from_name  = !empty($cfg['from_name']) ? $cfg['from_name'] : 'Massaji Spa Bali';
        $to_email    = !empty($cfg['to_email']) ? $cfg['to_email'] : 'eyestetix@gmail.com';

        $mail->setFrom($from_email, $from_name);
        $mail->addAddress($to_email);

        // Reply-To customer only when valid and provided
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($email, $name);
        } else {
            $mail->addReplyTo($from_email, $from_name);
        }

        // Custom headers for tracking
        $mail->addCustomHeader('X-Booking-ID', $booking_id);
        $mail->addCustomHeader('X-System', 'Massaji-Spa-Reservation-Engine');

        // Subject & Message
        $mail->Subject = "[Massaji Spa] New Reservation — " . $name;
        $mail->isHTML(true);
        $mail->Body    = $html_body;
        $mail->AltBody = $plain_body;

        $sent = $mail->send();
        if ($sent) {
            log_mail_diagnostic($booking_id, true, null, 'Message accepted by SMTP host ' . $cfg['host'] . ':' . $mail->Port);
            return true;
        }

        $error_message = 'SMTP host rejected message';
        log_mail_diagnostic($booking_id, false, 'REJECTED', $error_message);
        return false;

    } catch (Exception $e) {
        $error_message = 'PHPMailer error: ' . $e->getMessage();
        $cat = 'SMTP_ERROR';
        if (stripos($error_message, 'authenticate') !== false) {
            $cat = 'AUTH_FAILED';
        } elseif (stripos($error_message, 'connect') !== false || stripos($error_message, 'timed out') !== false) {
            $cat = 'CONNECTION_FAILED';
        } elseif (stripos($error_message, 'tls') !== false || stripos($error_message, 'ssl') !== false) {
            $cat = 'TLS_FAILED';
        }
        log_mail_diagnostic($booking_id, false, $cat, $error_message);
        return false;
    } catch (\Throwable $t) {
        $error_message = 'System error: ' . $t->getMessage();
        log_mail_diagnostic($booking_id, false, 'SYSTEM_ERROR', $error_message);
        return false;
    }
}

<?php
// admin/login.php - Admin Portal Authentication
require_once __DIR__ . '/auth.php';

$error = '';
$settings = get_settings();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $token    = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

    if (!verify_csrf_token($token)) {
        $error = 'Sesi tidak valid, silakan muat ulang halaman.';
    } elseif (verify_admin_password($password, $settings['admin_password_hash'])) {
        $_SESSION['massaji_admin_logged_in'] = true;
        $_SESSION['admin_user'] = 'admin';
        header('Location: index.php');
        exit;
    } else {
        $error = 'Password salah. Silakan periksa kembali password Anda.';
    }
}
$csrf_token = generate_csrf_token();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — <?php echo htmlspecialchars($settings['site_name']); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              navy: '#141E3C',
              sapphire: '#1E3A8A',
              sky: '#0284C7',
              ice: '#BAE0FD',
              surface: '#0B1120',
              card: '#16203D'
            }
          },
          fontFamily: {
            serif: ['"Cormorant Garamond"', 'serif'],
            sans: ['"Plus Jakarta Sans"', 'sans-serif']
          }
        }
      }
    }
  </script>
</head>
<body class="bg-brand-surface min-h-screen flex items-center justify-center p-4 font-sans text-slate-100 selection:bg-brand-sky selection:text-white">
  
  <!-- Subtle Ambient Glow -->
  <div class="fixed inset-0 pointer-events-none flex items-center justify-center overflow-hidden">
    <div class="w-[500px] h-[500px] bg-brand-sapphire/20 rounded-full blur-[120px]"></div>
  </div>

  <div class="relative w-full max-w-md bg-brand-navy/95 border border-brand-sapphire/50 rounded-3xl p-8 sm:p-10 shadow-2xl backdrop-blur-xl">
    
    <!-- Brand Logo Emblem -->
    <div class="flex justify-center mb-6">
      <div class="w-20 h-20 rounded-full bg-white p-1 border-2 border-brand-ice/60 shadow-lg shadow-brand-sapphire/30 flex items-center justify-center">
        <img src="../assets/images/member-1.png" alt="Massaji Spa" class="w-full h-full object-contain rounded-full">
      </div>
    </div>

    <!-- Header Text -->
    <div class="text-center mb-8">
      <span class="inline-block px-3.5 py-1 bg-brand-sapphire/40 border border-brand-ice/30 rounded-full text-brand-ice text-[11px] font-bold tracking-widest uppercase mb-3">
        Management Portal
      </span>
      <h1 class="font-serif text-3xl font-bold text-white tracking-wide">
        Massaji <span class="text-brand-ice italic font-light">Spa</span>
      </h1>
      <p class="text-slate-400 text-xs mt-1.5">Panel Kendali Menu, Promo, Flyer &amp; Reservasi</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="mb-6 p-4 rounded-xl bg-red-950/60 border border-red-500/50 text-red-200 text-xs leading-relaxed flex items-start gap-3">
        <svg class="w-5 h-5 flex-shrink-0 text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <span><?php echo htmlspecialchars($error); ?></span>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" class="space-y-5">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
      
      <div>
        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-brand-ice mb-2">Password Admin</label>
        <div class="relative">
          <input type="password" id="password" name="password" required autofocus placeholder="Masukkan password admin..."
            class="w-full px-4 py-3 bg-brand-surface/90 border border-brand-sapphire/70 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-brand-ice focus:ring-1 focus:ring-brand-ice transition duration-200 text-sm">
        </div>
      </div>

      <button type="submit"
        class="w-full py-3.5 px-4 bg-gradient-to-r from-brand-sky to-brand-sapphire hover:from-sky-500 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-brand-sky/25 hover:shadow-brand-sky/40 transition duration-300 text-sm tracking-wide flex items-center justify-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
        Masuk ke Dashboard
      </button>
    </form>

    <div class="mt-8 pt-6 border-t border-brand-sapphire/40 text-center">
      <a href="../index.php" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-brand-ice transition">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Halaman Depan Web
      </a>
    </div>
  </div>
</body>
</html>

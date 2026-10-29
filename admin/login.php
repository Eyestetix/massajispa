<?php
// admin/login.php
require_once __DIR__ . '/auth.php';

$error = '';
$settings = get_settings();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $token    = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

    if (!verify_csrf_token($token)) {
        $error = 'Sesi tidak valid, silakan coba lagi.';
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
  <title>Admin Login - <?php echo htmlspecialchars($settings['site_name']); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              dark: '#1C1917',
              surface: '#292524',
              gold: '#C5A880',
              terracotta: '#C27854',
              sand: '#E7DEC8',
              cream: '#FAF8F5'
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
<body class="bg-brand-dark min-h-screen flex items-center justify-center p-4 font-sans text-brand-cream selection:bg-brand-terracotta selection:text-white">
  <div class="w-full max-w-md bg-stone-900/90 border border-stone-800 rounded-2xl p-8 shadow-2xl backdrop-blur-md">
    <div class="text-center mb-8">
      <span class="inline-block px-3 py-1 bg-stone-800/80 border border-brand-gold/30 rounded-full text-brand-gold text-xs font-medium tracking-widest uppercase mb-3">Management Portal</span>
      <h1 class="font-serif text-3xl font-semibold text-stone-100 tracking-wide"><?php echo htmlspecialchars($settings['site_name']); ?></h1>
      <p class="text-stone-400 text-sm mt-1">Panel Kendali Menu, Promo & Pengaturan Kontak</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="mb-6 p-4 rounded-xl bg-red-950/60 border border-red-800/50 text-red-200 text-xs leading-relaxed flex items-start gap-3">
        <svg class="w-5 h-5 flex-shrink-0 text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <span><?php echo htmlspecialchars($error); ?></span>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" class="space-y-5">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
      <div>
        <label for="password" class="block text-xs font-medium uppercase tracking-wider text-stone-300 mb-2">Password Admin</label>
        <div class="relative">
          <input type="password" id="password" name="password" required autofocus placeholder="Masukkan password admin..."
            class="w-full px-4 py-3 bg-stone-950/80 border border-stone-800 rounded-xl text-stone-100 placeholder-stone-600 focus:outline-none focus:border-brand-gold focus:ring-1 focus:ring-brand-gold transition duration-200">
        </div>
      </div>

      <button type="submit"
        class="w-full py-3.5 px-4 bg-gradient-to-r from-brand-terracotta to-amber-700 hover:from-amber-600 hover:to-brand-terracotta text-white font-medium rounded-xl shadow-lg shadow-brand-terracotta/20 hover:shadow-brand-terracotta/40 transition duration-300 text-sm tracking-wide flex items-center justify-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
        Masuk ke Dashboard
      </button>
    </form>

    <div class="mt-8 pt-6 border-t border-stone-800/80 text-center">
      <a href="../index.php" class="inline-flex items-center gap-1.5 text-xs text-stone-400 hover:text-brand-gold transition">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Halaman Depan Web
      </a>
    </div>
  </div>
</body>
</html>

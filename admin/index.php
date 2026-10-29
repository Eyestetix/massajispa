<?php
// admin/index.php - Main Admin Dashboard
require_once __DIR__ . '/auth.php';
check_auth();

$settings_file = __DIR__ . '/../data/settings.json';
$promo_file    = __DIR__ . '/../data/promo.json';
$menu_file     = __DIR__ . '/../data/menu.json';
$bookings_file = __DIR__ . '/../data/bookings.json';

$settings = get_settings();
$promo = file_exists($promo_file) ? json_decode(file_get_contents($promo_file), true) : [];
$menu  = file_exists($menu_file) ? json_decode(file_get_contents($menu_file), true) : [];
$bookings = file_exists($bookings_file) ? json_decode(file_get_contents($bookings_file), true) : [];

if (!is_array($menu)) $menu = [];
if (!is_array($bookings)) $bookings = [];

$csrf_token = generate_csrf_token();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - <?php echo htmlspecialchars($settings['site_name']); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              dark: '#141210',
              surface: '#1F1C18',
              surfaceLight: '#2A2620',
              gold: '#C5A880',
              goldLight: '#DFC9AA',
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
<body class="bg-brand-dark min-h-screen text-stone-200 font-sans antialiased selection:bg-brand-terracotta selection:text-white">

  <!-- Toast Notification Container -->
  <div id="toast" class="fixed top-5 right-5 z-50 transform transition-all duration-300 translate-y-[-100px] opacity-0 pointer-events-none max-w-md w-full p-4 rounded-xl shadow-2xl flex items-center gap-3 text-sm"></div>

  <!-- Top Navigation Header -->
  <header class="border-b border-stone-800/80 bg-brand-surface/90 backdrop-blur sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-terracotta to-brand-gold flex items-center justify-center text-brand-dark font-serif font-bold text-lg">M</span>
        <div>
          <h1 class="font-serif text-xl font-semibold text-stone-100 tracking-wide leading-none"><?php echo htmlspecialchars($settings['site_name']); ?></h1>
          <p class="text-[11px] text-brand-gold tracking-wider uppercase mt-0.5">Control Panel</p>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <a href="../index.php" target="_blank" class="px-3.5 py-1.5 rounded-lg border border-stone-700 hover:border-brand-gold/60 text-stone-300 hover:text-brand-gold text-xs font-medium flex items-center gap-1.5 transition">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
          Buka Website
        </a>
        <a href="logout.php" class="px-3.5 py-1.5 rounded-lg bg-stone-800 hover:bg-stone-700 text-stone-300 text-xs font-medium flex items-center gap-1.5 transition">
          <svg class="w-3.5 h-3.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
          Keluar
        </a>
      </div>
    </div>
  </header>

  <!-- Main Content Layout -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Navigation Tabs -->
    <div class="flex border-b border-stone-800 gap-2 sm:gap-6 overflow-x-auto pb-px mb-8 scrollbar-none">
      <button onclick="switchTab('home')" id="btn-tab-home" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 border-brand-gold text-brand-gold flex items-center gap-2 whitespace-nowrap transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Setting Home (Hero &amp; About)
      </button>
      <button onclick="switchTab('promo')" id="btn-tab-promo" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 border-transparent text-stone-400 hover:text-stone-200 flex items-center gap-2 whitespace-nowrap transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        Promo Akhir Tahun &amp; Flyer
      </button>
      <button onclick="switchTab('menu')" id="btn-tab-menu" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 border-transparent text-stone-400 hover:text-stone-200 flex items-center gap-2 whitespace-nowrap transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        Menu &amp; Harga Treatment
        <span class="px-2 py-0.5 text-[10px] rounded-full bg-stone-800 text-stone-400 font-mono"><?php echo count($menu); ?></span>
      </button>
      <button onclick="switchTab('settings')" id="btn-tab-settings" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 border-transparent text-stone-400 hover:text-stone-200 flex items-center gap-2 whitespace-nowrap transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Kontak &amp; Reservasi
      </button>
      <button onclick="switchTab('bookings')" id="btn-tab-bookings" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 border-transparent text-stone-400 hover:text-stone-200 flex items-center gap-2 whitespace-nowrap transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        Reservasi Masuk
        <span class="px-2 py-0.5 text-[10px] rounded-full bg-brand-terracotta/30 text-brand-terracotta font-mono"><?php echo count($bookings); ?></span>
      </button>
      <button onclick="switchTab('security')" id="btn-tab-security" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 border-transparent text-stone-400 hover:text-stone-200 flex items-center gap-2 whitespace-nowrap transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        Keamanan
      </button>
    </div>

    <!-- ======================================================== -->
    <!-- TAB 0: SETTING HOME (HERO & ABOUT MASSAJI SPA) -->
    <!-- ======================================================== -->
    <div id="tab-home" class="tab-content space-y-8">
      <form id="form-home" class="space-y-8">
        <input type="hidden" name="action" value="save_home">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

        <!-- Hero Section Settings -->
        <div class="bg-brand-surface border border-stone-800 rounded-2xl p-6 sm:p-8">
          <div class="flex items-center gap-3 pb-4 mb-6 border-b border-stone-800">
            <span class="w-8 h-8 rounded-lg bg-brand-gold/20 text-brand-gold flex items-center justify-center font-bold text-sm">1</span>
            <div>
              <h2 class="font-serif text-2xl font-semibold text-stone-100">Bagian Hero (Banner Utama Depan)</h2>
              <p class="text-xs text-stone-400">Atur judul pembuka, slogan, dan gambar utama yang pertama kali dilihat pengunjung.</p>
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-7 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Judul Hero (Baris 1)</label>
                <input type="text" name="hero_title_1" value="<?php echo htmlspecialchars($settings['hero_title_1'] ?? 'Find Your Balance.'); ?>" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
              </div>

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Slogan Hero (Baris 2 - Huruf Miring)</label>
                <input type="text" name="hero_title_2" value="<?php echo htmlspecialchars($settings['hero_title_2'] ?? 'Rediscover Serenity.'); ?>" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm italic font-serif text-brand-gold focus:border-brand-gold focus:outline-none">
              </div>

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Deskripsi Lengkap Hero</label>
                <textarea name="hero_desc" rows="3" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-300 leading-relaxed focus:border-brand-gold focus:outline-none"><?php echo htmlspecialchars($settings['hero_desc'] ?? ''); ?></textarea>
              </div>

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Path / File Gambar Hero</label>
                <input type="text" id="php-hero-image" name="hero_image" value="<?php echo htmlspecialchars($settings['hero_image'] ?? 'assets/images/massaji-hero.jpg'); ?>" oninput="document.getElementById('php-preview-hero').src='../' + this.value" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-xs font-mono text-stone-300 focus:border-brand-gold focus:outline-none">
                <div class="flex flex-wrap gap-2 mt-2">
                  <button type="button" onclick="document.getElementById('php-hero-image').value='assets/images/massaji-hero.jpg'; document.getElementById('php-preview-hero').src='../assets/images/massaji-hero.jpg';" class="px-2.5 py-1 rounded bg-stone-800 hover:bg-stone-700 text-brand-gold text-[11px]">massaji-hero.jpg</button>
                  <button type="button" onclick="document.getElementById('php-hero-image').value='assets/images/gambar2.jpg'; document.getElementById('php-preview-hero').src='../assets/images/gambar2.jpg';" class="px-2.5 py-1 rounded bg-stone-800 hover:bg-stone-700 text-brand-gold text-[11px]">gambar2.jpg</button>
                  <button type="button" onclick="document.getElementById('php-hero-image').value='assets/images/massaji-reception.jpg'; document.getElementById('php-preview-hero').src='../assets/images/massaji-reception.jpg';" class="px-2.5 py-1 rounded bg-stone-800 hover:bg-stone-700 text-brand-gold text-[11px]">massaji-reception.jpg</button>
                </div>
              </div>
            </div>

            <div class="lg:col-span-5 flex flex-col justify-center">
              <span class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-2 block">Live Preview Gambar Hero</span>
              <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden border border-stone-800 bg-stone-950 relative">
                <img id="php-preview-hero" src="../<?php echo htmlspecialchars($settings['hero_image'] ?? 'assets/images/massaji-hero.jpg'); ?>" class="w-full h-full object-cover" onerror="this.src='../assets/images/MASAGE.JPG'">
              </div>
            </div>
          </div>
        </div>

        <!-- About Section Settings -->
        <div class="bg-brand-surface border border-stone-800 rounded-2xl p-6 sm:p-8">
          <div class="flex items-center gap-3 pb-4 mb-6 border-b border-stone-800">
            <span class="w-8 h-8 rounded-lg bg-brand-gold/20 text-brand-gold flex items-center justify-center font-bold text-sm">2</span>
            <div>
              <h2 class="font-serif text-2xl font-semibold text-stone-100">Bagian About Massaji Spa</h2>
              <p class="text-xs text-stone-400">Profil tradisi penyembuhan Bali, kebersihan bintang lima, dan gambar pendukung.</p>
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-7 space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Judul About (Baris 1)</label>
                  <input type="text" name="about_title_1" value="<?php echo htmlspecialchars($settings['about_title_1'] ?? 'Rooted in Bali.'); ?>" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
                </div>
                <div>
                  <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Slogan About (Baris 2)</label>
                  <input type="text" name="about_title_2" value="<?php echo htmlspecialchars($settings['about_title_2'] ?? 'Created for Your Wellbeing.'); ?>" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm italic font-serif text-brand-gold focus:border-brand-gold focus:outline-none">
                </div>
              </div>

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Deskripsi Paragraf 1</label>
                <textarea name="about_desc_1" rows="3" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-300 leading-relaxed focus:border-brand-gold focus:outline-none"><?php echo htmlspecialchars($settings['about_desc_1'] ?? ''); ?></textarea>
              </div>

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Deskripsi Paragraf 2</label>
                <textarea name="about_desc_2" rows="3" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-300 leading-relaxed focus:border-brand-gold focus:outline-none"><?php echo htmlspecialchars($settings['about_desc_2'] ?? ''); ?></textarea>
              </div>

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">Path / File Gambar About</label>
                <input type="text" id="php-about-image" name="about_image" value="<?php echo htmlspecialchars($settings['about_image'] ?? 'assets/images/massaji-about.jpg'); ?>" oninput="document.getElementById('php-preview-about').src='../' + this.value" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-xs font-mono text-stone-300 focus:border-brand-gold focus:outline-none">
              </div>
            </div>

            <div class="lg:col-span-5 flex flex-col justify-center">
              <span class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-2 block">Live Preview Gambar About</span>
              <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden border border-stone-800 bg-stone-950 relative">
                <img id="php-preview-about" src="../<?php echo htmlspecialchars($settings['about_image'] ?? 'assets/images/massaji-about.jpg'); ?>" class="w-full h-full object-cover" onerror="this.src='../assets/images/gambar2.jpg'">
              </div>
            </div>
          </div>
        </div>

        <div class="flex justify-end pt-2">
          <button type="submit" class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-brand-terracotta to-amber-700 hover:from-amber-600 hover:to-brand-terracotta text-white font-medium text-sm shadow-xl flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Simpan Tampilan Home
          </button>
        </div>
      </form>
    </div>

    <!-- ======================================================== -->
    <!-- TAB 1: KONTAK & NOTIFIKASI EMAIL (DYNAMIC SETTINGS) -->
    <!-- ======================================================== -->
    <div id="tab-settings" class="tab-content space-y-6">
      <div class="bg-brand-surface border border-stone-800 rounded-2xl p-6 sm:p-8">
        <div class="mb-6">
          <h2 class="font-serif text-2xl font-semibold text-stone-100">Pengaturan Notifikasi & Kontak Bisnis</h2>
          <p class="text-xs text-stone-400 mt-1">Nilai di bawah ini digunakan langsung oleh sistem website untuk pengiriman email booking dan tombol WhatsApp. Anda bisa mengubahnya kapan saja tanpa hardcode.</p>
        </div>

        <form id="form-settings" class="space-y-6">
          <input type="hidden" name="action" value="save_settings">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Email Notifikasi Booking -->
            <div class="p-5 rounded-xl bg-stone-900/60 border border-brand-gold/20">
              <label class="block text-xs font-semibold tracking-wider uppercase text-brand-gold mb-1">
                Email Tujuan Notifikasi Reservasi
              </label>
              <p class="text-[11px] text-stone-400 mb-2">Setiap ada tamu yang memesan dari formulir web, data reservasi dikirimkan ke email ini.</p>
              <input type="email" name="booking_email" value="<?php echo htmlspecialchars($settings['booking_email']); ?>" required
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-700 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>

            <!-- WhatsApp Number -->
            <div class="p-5 rounded-xl bg-stone-900/60 border border-emerald-500/20">
              <label class="block text-xs font-semibold tracking-wider uppercase text-emerald-400 mb-1">
                Nomor WhatsApp Reservasi
              </label>
              <p class="text-[11px] text-stone-400 mb-2">Gunakan format internasional (contoh: 6281236695755 tanpa tanda + atau spasi).</p>
              <input type="text" name="whatsapp_number" value="<?php echo htmlspecialchars($settings['whatsapp_number']); ?>" required
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-700 rounded-lg text-sm text-stone-100 focus:border-emerald-500 focus:outline-none font-mono">
            </div>

            <!-- Phone Display -->
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Nomor Telepon Tampilan</label>
              <input type="text" name="phone" value="<?php echo htmlspecialchars($settings['phone']); ?>"
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>

            <!-- Instagram -->
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Link Instagram</label>
              <input type="url" name="instagram" value="<?php echo htmlspecialchars($settings['instagram']); ?>"
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>

            <!-- Site Name -->
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Nama Usaha / Spa</label>
              <input type="text" name="site_name" value="<?php echo htmlspecialchars($settings['site_name']); ?>" required
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>

            <!-- Jam Buka -->
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Jam Operasional</label>
              <input type="text" name="opening_hours" value="<?php echo htmlspecialchars($settings['opening_hours']); ?>"
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>
          </div>

          <!-- Alamat Lengkap & Maps -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-stone-800/80">
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Alamat Fisik Lengkap</label>
              <textarea name="address" rows="3" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none"><?php echo htmlspecialchars($settings['address']); ?></textarea>
            </div>
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Link Google Maps (Navigasi Tamu)</label>
              <textarea name="google_maps_link" rows="3" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none"><?php echo htmlspecialchars($settings['google_maps_link']); ?></textarea>
            </div>
          </div>

          <!-- Tagline -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-stone-800/80">
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Tagline Utama</label>
              <input type="text" name="tagline" value="<?php echo htmlspecialchars($settings['tagline']); ?>"
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Deskripsi Ringkas Header</label>
              <input type="text" name="subtagline" value="<?php echo htmlspecialchars($settings['subtagline']); ?>"
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>
          </div>

          <div class="flex justify-end pt-4">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-brand-terracotta to-amber-700 hover:from-amber-600 hover:to-brand-terracotta text-white font-medium text-sm shadow-lg transition duration-200 flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
              Simpan Pengaturan Kontak
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- ======================================================== -->
    <!-- TAB 2: MENU & HARGA TREATMENT -->
    <!-- ======================================================== -->
    <div id="tab-menu" class="tab-content hidden space-y-6">
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-brand-surface border border-stone-800 rounded-2xl p-6">
        <div>
          <h2 class="font-serif text-2xl font-semibold text-stone-100">Daftar Menu & Harga Layanan</h2>
          <p class="text-xs text-stone-400 mt-1">Ubah nama layanan, durasi, harga (IDR), atau tandai layanan sebagai menu favorit/signature.</p>
        </div>
        <button onclick="openAddMenuModal()" class="px-4 py-2.5 rounded-xl bg-brand-terracotta hover:bg-amber-600 text-white font-medium text-xs tracking-wide uppercase flex items-center gap-2 shadow-lg transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Tambah Treatment Baru
        </button>
      </div>

      <!-- Search Bar for Admin Menu -->
      <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <input 
          type="text" 
          id="admin-search-input" 
          oninput="searchAdminMenu(this.value)" 
          placeholder="Cari menu perawatan / paket (ketik nama, deskripsi, durasi, harga)..." 
          class="w-full pl-10 pr-10 py-3 rounded-xl border border-stone-800 bg-stone-950 text-sm text-stone-100 placeholder-stone-500 focus:outline-none focus:border-brand-gold">
      </div>

      <!-- Menu Category Filters for Admin View -->
      <div class="flex gap-2 overflow-x-auto pb-2">
        <button onclick="filterAdminMenu('all')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-800 text-stone-200 text-xs font-medium hover:bg-stone-700 transition" data-filter="all">Semua (<?php echo count($menu); ?>)</button>
        <button onclick="filterAdminMenu('promo')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-900 text-stone-400 text-xs font-medium hover:bg-stone-700 transition" data-filter="promo">Promo Akhir Tahun</button>
        <button onclick="filterAdminMenu('massage')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-900 text-stone-400 text-xs font-medium hover:bg-stone-700 transition" data-filter="massage">Massage & Body</button>
        <button onclick="filterAdminMenu('slimming')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-900 text-stone-400 text-xs font-medium hover:bg-stone-700 transition" data-filter="slimming">Slimming RF</button>
        <button onclick="filterAdminMenu('packages-single')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-900 text-stone-400 text-xs font-medium hover:bg-stone-700 transition" data-filter="packages-single">Single Packages</button>
        <button onclick="filterAdminMenu('packages-couple')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-900 text-stone-400 text-xs font-medium hover:bg-stone-700 transition" data-filter="packages-couple">Couple Packages</button>
        <button onclick="filterAdminMenu('spa')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-900 text-stone-400 text-xs font-medium hover:bg-stone-700 transition" data-filter="spa">Spa Rituals</button>
        <button onclick="filterAdminMenu('facial')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-900 text-stone-400 text-xs font-medium hover:bg-stone-700 transition" data-filter="facial">Facial</button>
        <button onclick="filterAdminMenu('nail')" class="admin-filter-btn px-3.5 py-1.5 rounded-lg bg-stone-900 text-stone-400 text-xs font-medium hover:bg-stone-700 transition" data-filter="nail">Nail</button>
      </div>

      <!-- Menu Items List -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="admin-menu-list">
        <?php foreach ($menu as $index => $item): ?>
          <div class="menu-card bg-brand-surface border border-stone-800 rounded-xl p-5 hover:border-stone-700 transition flex flex-col justify-between" data-category="<?php echo htmlspecialchars($item['category'] ?? 'massage'); ?>">
            <div>
              <div class="flex items-start justify-between gap-3">
                <div>
                  <div class="flex items-center gap-2">
                    <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-stone-800 text-brand-gold">
                      <?php echo htmlspecialchars($item['category'] ?? 'massage'); ?>
                    </span>
                    <?php if (!empty($item['is_featured'])): ?>
                      <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-brand-terracotta/20 text-brand-terracotta border border-brand-terracotta/30">
                        <?php echo htmlspecialchars($item['tag'] ?? 'Featured'); ?>
                      </span>
                    <?php endif; ?>
                  </div>
                  <h3 class="font-serif text-lg font-semibold text-stone-100 mt-2"><?php echo htmlspecialchars($item['name']); ?></h3>
                </div>
                <div class="text-right flex-shrink-0">
                  <span class="text-brand-gold font-mono font-bold text-base">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></span>
                  <p class="text-[11px] text-stone-400 font-sans mt-0.5"><?php echo htmlspecialchars($item['duration']); ?></p>
                </div>
              </div>
              <p class="text-xs text-stone-400 mt-2.5 line-clamp-2 leading-relaxed"><?php echo htmlspecialchars($item['description']); ?></p>
            </div>

            <div class="mt-4 pt-4 border-t border-stone-800/80 flex items-center justify-between">
              <span class="text-[11px] text-stone-500 font-mono">ID: <?php echo htmlspecialchars($item['id']); ?></span>
              <div class="flex items-center gap-2">
                <button onclick="editMenuItem(<?php echo htmlspecialchars(json_encode($item)); ?>)" class="px-3 py-1 bg-stone-800 hover:bg-stone-700 text-stone-300 text-xs rounded-lg transition flex items-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  Edit
                </button>
                <button onclick="deleteMenuItem('<?php echo htmlspecialchars($item['id']); ?>', '<?php echo htmlspecialchars(addslashes($item['name'])); ?>')" class="px-3 py-1 bg-red-950/40 hover:bg-red-900/60 text-red-300 text-xs rounded-lg border border-red-900/40 transition flex items-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  Hapus
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- ======================================================== -->
    <!-- TAB 3: BANNER PROMO -->
    <!-- ======================================================== -->
    <div id="tab-promo" class="tab-content hidden space-y-6">
      <div class="bg-brand-surface border border-stone-800 rounded-2xl p-6 sm:p-8">
        <div class="mb-6 flex items-start justify-between">
          <div>
            <h2 class="font-serif text-2xl font-semibold text-stone-100">Pengaturan Banner Promo</h2>
            <p class="text-xs text-stone-400 mt-1">Muncul di bagian teratas website untuk menarik perhatian tamu hotel & turis di Canggu.</p>
          </div>
          <div class="flex items-center gap-2">
            <span class="text-xs text-stone-400">Status Promo:</span>
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold <?php echo !empty($promo['active']) ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-stone-800 text-stone-400'; ?>">
              <?php echo !empty($promo['active']) ? 'Aktif' : 'Non-aktif'; ?>
            </span>
          </div>
        </div>

        <form id="form-promo" class="space-y-6">
          <input type="hidden" name="action" value="save_promo">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

          <!-- Toggle Aktif -->
          <div class="p-4 rounded-xl bg-stone-900/60 border border-stone-800 flex items-center justify-between">
            <div>
              <span class="block text-sm font-semibold text-stone-200">Tampilkan Banner Promo di Halaman Depan</span>
              <p class="text-xs text-stone-400">Jika dimatikan, bar promo di paling atas website tidak akan tampil.</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="active" value="1" class="sr-only peer" <?php echo !empty($promo['active']) ? 'checked' : ''; ?>>
              <div class="w-11 h-6 bg-stone-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
            </label>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Teks Label / Badge</label>
              <input type="text" name="badge" value="<?php echo htmlspecialchars($promo['badge'] ?? 'Special Rejuvenation Offer'); ?>"
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Kode Promo (Opsional)</label>
              <input type="text" name="code" value="<?php echo htmlspecialchars($promo['code'] ?? 'MASSAJI15'); ?>"
                class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none uppercase font-mono">
            </div>
          </div>

          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Judul Promo Utama</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($promo['title'] ?? ''); ?>" required
              class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>

          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Deskripsi Lengkap Promo</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none"><?php echo htmlspecialchars($promo['description'] ?? ''); ?></textarea>
          </div>

          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Syarat & Masa Berlaku</label>
            <input type="text" name="valid_until" value="<?php echo htmlspecialchars($promo['valid_until'] ?? ''); ?>"
              class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>

          <div class="flex justify-end pt-4 border-t border-stone-800/80">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-brand-terracotta to-amber-700 hover:from-amber-600 hover:to-brand-terracotta text-white font-medium text-sm shadow-lg transition duration-200 flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
              Simpan Pengaturan Promo
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- ======================================================== -->
    <!-- TAB 4: RESERVASI MASUK -->
    <!-- ======================================================== -->
    <div id="tab-bookings" class="tab-content hidden space-y-6">
      <div class="bg-brand-surface border border-stone-800 rounded-2xl p-6 sm:p-8">
        <div class="mb-6 flex items-start justify-between">
          <div>
            <h2 class="font-serif text-2xl font-semibold text-stone-100">Riwayat Reservasi Website</h2>
            <p class="text-xs text-stone-400 mt-1">Daftar permintaan booking yang dikirimkan melalui formulir website (tersimpan aman di server).</p>
          </div>
          <span class="text-xs font-mono px-3 py-1 rounded-full bg-stone-900 border border-stone-800 text-brand-gold">
            Total: <?php echo count($bookings); ?> Reservasi
          </span>
        </div>

        <?php if (empty($bookings)): ?>
          <div class="text-center py-16 border border-dashed border-stone-800 rounded-xl">
            <svg class="w-12 h-12 mx-auto text-stone-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-stone-400 text-sm">Belum ada reservasi masuk.</p>
            <p class="text-stone-600 text-xs mt-1">Setiap ada tamu yang memesan dari web, rinciannya akan otomatis tersimpan di sini.</p>
          </div>
        <?php else: ?>
          <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-stone-300">
              <thead class="bg-stone-900/80 text-[11px] uppercase tracking-wider text-stone-400 border-b border-stone-800">
                <tr>
                  <th class="p-3">Waktu Masuk</th>
                  <th class="p-3">Nama Tamu</th>
                  <th class="p-3">Layanan</th>
                  <th class="p-3">Jadwal (WITA)</th>
                  <th class="p-3">Pax</th>
                  <th class="p-3">Kontak Tamu</th>
                  <th class="p-3 text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-stone-800/60">
                <?php foreach ($bookings as $b): ?>
                  <?php 
                    $guest_phone = preg_replace('/[^0-9]/', '', $b['phone'] ?? '');
                    if (substr($guest_phone, 0, 1) === '0') $guest_phone = '62' . substr($guest_phone, 1);
                    $reply_text = "Halo " . ($b['name'] ?? 'Kak') . ", kami dari Massaji Spa Bali ingin mengonfirmasi jadwal reservasi untuk " . ($b['service'] ?? 'Spa') . " pada " . ($b['date'] ?? '') . " jam " . ($b['time'] ?? '') . " WITA.";
                    $wa_reply_url = "https://wa.me/" . $guest_phone . "?text=" . rawurlencode($reply_text);
                  ?>
                  <tr class="hover:bg-stone-900/40 transition">
                    <td class="p-3 font-mono text-[11px] text-stone-500"><?php echo htmlspecialchars($b['created_at'] ?? '-'); ?></td>
                    <td class="p-3 font-medium text-stone-100"><?php echo htmlspecialchars($b['name'] ?? '-'); ?></td>
                    <td class="p-3 font-semibold text-brand-gold"><?php echo htmlspecialchars($b['service'] ?? '-'); ?></td>
                    <td class="p-3"><?php echo htmlspecialchars($b['date'] ?? '-'); ?> <span class="text-stone-500">(<?php echo htmlspecialchars($b['time'] ?? '-'); ?>)</span></td>
                    <td class="p-3"><?php echo htmlspecialchars($b['guests'] ?? '1'); ?> orang</td>
                    <td class="p-3 font-mono">
                      <div><?php echo htmlspecialchars($b['phone'] ?? '-'); ?></div>
                      <div class="text-[10px] text-stone-500"><?php echo htmlspecialchars($b['email'] ?? ''); ?></div>
                    </td>
                    <td class="p-3 text-right">
                      <?php if (!empty($guest_phone)): ?>
                        <a href="<?php echo $wa_reply_url; ?>" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-950/60 hover:bg-emerald-900 border border-emerald-700/50 text-emerald-300 text-[11px] font-medium transition">
                          <span>Chat WA</span>
                        </a>
                      <?php else: ?>
                        <span class="text-stone-600 text-[11px]">-</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- ======================================================== -->
    <!-- TAB 5: KEAMANAN & PASSWORD -->
    <!-- ======================================================== -->
    <div id="tab-security" class="tab-content hidden space-y-6">
      <div class="max-w-xl bg-brand-surface border border-stone-800 rounded-2xl p-6 sm:p-8">
        <div class="mb-6">
          <h2 class="font-serif text-2xl font-semibold text-stone-100">Ganti Password Admin</h2>
          <p class="text-xs text-stone-400 mt-1">Ubah kata sandi untuk melindungi akses ke panel kontrol website.</p>
        </div>

        <form id="form-password" class="space-y-5">
          <input type="hidden" name="action" value="change_password">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Password Saat Ini</label>
            <input type="password" name="current_password" required placeholder="Password lama..."
              class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>

          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Password Baru (Minimal 6 Karakter)</label>
            <input type="password" name="new_password" required placeholder="Password baru..."
              class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>

          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1.5">Konfirmasi Password Baru</label>
            <input type="password" name="confirm_password" required placeholder="Ulangi password baru..."
              class="w-full px-4 py-2.5 bg-stone-950 border border-stone-800 rounded-lg text-sm text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>

          <div class="pt-2">
            <button type="submit" class="w-full py-3 rounded-xl bg-brand-terracotta hover:bg-amber-600 text-white font-medium text-sm shadow-lg transition duration-200">
              Perbarui Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- ======================================================== -->
  <!-- MODAL: TAMBAH / EDIT TREATMENT -->
  <!-- ======================================================== -->
  <div id="menu-modal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-brand-surface border border-stone-800 rounded-2xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
      <button onclick="closeMenuModal()" class="absolute top-5 right-5 text-stone-400 hover:text-stone-100">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <h3 id="modal-title" class="font-serif text-2xl font-semibold text-stone-100 mb-1">Tambah Treatment Baru</h3>
      <p class="text-xs text-stone-400 mb-6">Isi rincian layanan pijat atau perawatan spa di bawah ini.</p>

      <form id="form-menu-item" class="space-y-4 text-xs">
        <input type="hidden" id="menu-item-id" name="id" value="">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

        <!-- English Section -->
        <div class="p-3.5 rounded-xl bg-stone-900/80 border border-stone-800 space-y-3">
          <div class="flex items-center gap-2 pb-1.5 border-b border-stone-800">
            <span>🇬🇧</span>
            <span class="font-bold text-xs uppercase tracking-wider text-brand-gold">Informasi Bahasa Inggris (Default Website)</span>
          </div>
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Nama Perawatan (EN) *</label>
            <input type="text" id="menu-item-name" name="name" required placeholder="Contoh: Balinese Traditional Massage (120 mins)"
              class="w-full px-3.5 py-2 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Durasi (EN) *</label>
              <input type="text" id="menu-item-duration" name="duration" placeholder="Contoh: 120 Mins"
                class="w-full px-3.5 py-2 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Badge Tag (EN)</label>
              <input type="text" id="menu-item-tag" name="tag" placeholder="Misal: Now 300K / Signature"
                class="w-full px-3.5 py-2 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>
          </div>
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Keterangan Multi-Prices (EN)</label>
            <input type="text" id="menu-item-multi-prices" name="multi_prices" placeholder="Contoh: 60m: 215K | 90m: 285K | 120m: 345K"
              class="w-full px-3.5 py-2 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Deskripsi Treatment (EN)</label>
            <textarea id="menu-item-desc" name="description" rows="2" placeholder="Deskripsikan dalam bahasa Inggris..."
              class="w-full px-3.5 py-2 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none"></textarea>
          </div>
        </div>

        <!-- Indonesian Section -->
        <div class="p-3.5 rounded-xl bg-amber-950/20 border border-amber-900/40 space-y-3">
          <div class="flex items-center gap-2 pb-1.5 border-b border-amber-900/40">
            <span>🇮🇩</span>
            <span class="font-bold text-xs uppercase tracking-wider text-amber-400">Informasi Bahasa Indonesia (Mode ID)</span>
          </div>
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Nama Perawatan (ID) *</label>
            <input type="text" id="menu-item-name-id" name="name_id" required placeholder="Contoh: Pijat Tradisional Bali (120 menit)"
              class="w-full px-3.5 py-2 bg-stone-950 border border-amber-900/50 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Durasi (ID)</label>
              <input type="text" id="menu-item-duration-id" name="duration_id" placeholder="Contoh: 120 Menit"
                class="w-full px-3.5 py-2 bg-stone-950 border border-amber-900/50 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Badge Tag (ID)</label>
              <input type="text" id="menu-item-tag-id" name="tag_id" placeholder="Misal: Kini 300K / Terfavorit"
                class="w-full px-3.5 py-2 bg-stone-950 border border-amber-900/50 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
            </div>
          </div>
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Keterangan Multi-Prices (ID)</label>
            <input type="text" id="menu-item-multi-prices-id" name="multi_prices_id" placeholder="Contoh: Paha: Kini 550K | Perut: Kini 650K"
              class="w-full px-3.5 py-2 bg-stone-950 border border-amber-900/50 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
          </div>
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Deskripsi Treatment (ID)</label>
            <textarea id="menu-item-desc-id" name="description_id" rows="2" placeholder="Deskripsikan dengan copywriting bahasa Indonesia alami..."
              class="w-full px-3.5 py-2 bg-stone-950 border border-amber-900/50 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none"></textarea>
          </div>
        </div>

        <!-- Category & Pricing -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Kategori</label>
            <select id="menu-item-category" name="category" class="w-full px-3 py-2 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-100 focus:border-brand-gold focus:outline-none">
              <option value="promo">Promo Akhir Tahun</option>
              <option value="packages-single">Single Packages</option>
              <option value="packages-couple">Couple Packages</option>
              <option value="packages-group">Group Packages</option>
              <option value="massage">Massage & Body</option>
              <option value="slimming">Slimming RF</option>
              <option value="spa">Spa Rituals</option>
              <option value="facial">Facial</option>
              <option value="nail">Nail</option>
              <option value="additional">Additional</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-brand-gold mb-1">Harga Final (Rp) *</label>
            <input type="number" id="menu-item-price" name="price" required placeholder="300000"
              class="w-full px-3 py-2 bg-stone-950 border border-stone-800 rounded-lg text-xs font-bold text-brand-gold focus:border-brand-gold focus:outline-none font-mono">
          </div>
          <div>
            <label class="block text-xs font-medium uppercase tracking-wider text-stone-400 mb-1">Harga Normal (Rp)</label>
            <input type="number" id="menu-item-normal-price" name="normal_price" placeholder="345000"
              class="w-full px-3 py-2 bg-stone-950 border border-stone-800 rounded-lg text-xs text-stone-400 focus:border-brand-gold focus:outline-none font-mono">
          </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-stone-800">
          <button type="button" onclick="closeMenuModal()" class="px-4 py-2 rounded-xl bg-stone-800 hover:bg-stone-700 text-stone-300 text-xs font-medium transition">Batal</button>
          <button type="submit" class="px-5 py-2 rounded-xl bg-brand-terracotta hover:bg-amber-600 text-white text-xs font-medium shadow transition">Simpan Perawatan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Client-side script for Admin interactivity -->
  <script>
    const CSRF_TOKEN = '<?php echo htmlspecialchars($csrf_token); ?>';

    // Tab Switching
    function switchTab(tabId) {
      document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-brand-gold', 'text-brand-gold');
        btn.classList.add('border-transparent', 'text-stone-400');
      });

      const target = document.getElementById('tab-' + tabId);
      const targetBtn = document.getElementById('btn-tab-' + tabId);
      if (target && targetBtn) {
        target.classList.remove('hidden');
        targetBtn.classList.remove('border-transparent', 'text-stone-400');
        targetBtn.classList.add('border-brand-gold', 'text-brand-gold');
      }
    }

    // Toast alerts
    function showToast(message, isSuccess = true) {
      const toast = document.getElementById('toast');
      toast.className = `fixed top-5 right-5 z-50 transform transition-all duration-300 translate-y-0 opacity-100 max-w-md w-full p-4 rounded-xl shadow-2xl flex items-center gap-3 text-xs font-medium ${
        isSuccess ? 'bg-emerald-950 border border-emerald-800 text-emerald-200' : 'bg-red-950 border border-red-800 text-red-200'
      }`;
      toast.innerHTML = `
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${isSuccess ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12'}"/>
        </svg>
        <span>${message}</span>
      `;
      setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-[-100px]');
      }, 4000);
    }

    // Generic Form Handler via AJAX
    function setupAjaxForm(formId, successCallback) {
      const form = document.getElementById(formId);
      if (!form) return;
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        try {
          const res = await fetch('api.php', { method: 'POST', body: formData });
          const data = await res.json();
          if (data.success) {
            showToast(data.message || 'Perubahan berhasil disimpan!', true);
            if (successCallback) successCallback(data);
          } else {
            showToast(data.message || 'Terjadi kesalahan saat menyimpan.', false);
          }
        } catch (err) {
          showToast('Koneksi gagal atau sesi telah berakhir.', false);
        }
      });
    }

    setupAjaxForm('form-home');
    setupAjaxForm('form-settings');
    setupAjaxForm('form-promo');
    setupAjaxForm('form-password', () => document.getElementById('form-password').reset());

    // Search & Filter Admin Menu
    let activeCategory = 'all';
    let searchKeyword = '';

    function searchAdminMenu(kw) {
      searchKeyword = (kw || '').toLowerCase().trim();
      applyAdminMenuFilters();
    }

    function filterAdminMenu(category) {
      activeCategory = category;
      document.querySelectorAll('.admin-filter-btn').forEach(btn => {
        if (btn.dataset.filter === category) {
          btn.classList.add('bg-stone-800', 'text-stone-200');
          btn.classList.remove('bg-stone-900', 'text-stone-400');
        } else {
          btn.classList.remove('bg-stone-800', 'text-stone-200');
          btn.classList.add('bg-stone-900', 'text-stone-400');
        }
      });
      applyAdminMenuFilters();
    }

    function applyAdminMenuFilters() {
      document.querySelectorAll('#admin-menu-list .menu-card').forEach(card => {
        const cat = card.dataset.category || '';
        const text = card.textContent.toLowerCase();

        const matchCat = (activeCategory === 'all' || cat === activeCategory);
        const matchKw = (!searchKeyword || text.includes(searchKeyword));

        if (matchCat && matchKw) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    }

    // Modal Add / Edit
    let allMenuItems = <?php echo json_encode($menu); ?>;

    function openAddMenuModal() {
      document.getElementById('modal-title').textContent = 'Tambah Treatment Baru';
      document.getElementById('form-menu-item').reset();
      document.getElementById('menu-item-id').value = '';
      document.getElementById('menu-modal').classList.remove('hidden');
      document.getElementById('menu-modal').classList.add('flex');
    }

    function editMenuItem(item) {
      document.getElementById('modal-title').textContent = 'Edit Layanan Treatment';
      document.getElementById('menu-item-id').value = item.id || '';
      document.getElementById('menu-item-category').value = item.category || 'massage';
      
      // English fields
      document.getElementById('menu-item-name').value = item.name || '';
      document.getElementById('menu-item-duration').value = item.duration || '';
      document.getElementById('menu-item-tag').value = item.tag || '';
      document.getElementById('menu-item-multi-prices').value = item.multi_prices || '';
      document.getElementById('menu-item-desc').value = item.description || '';

      // Indonesian fields
      document.getElementById('menu-item-name-id').value = item.name_id || item.name || '';
      document.getElementById('menu-item-duration-id').value = item.duration_id || item.duration || '';
      document.getElementById('menu-item-tag-id').value = item.tag_id || item.tag || '';
      document.getElementById('menu-item-multi-prices-id').value = item.multi_prices_id || item.multi_prices || '';
      document.getElementById('menu-item-desc-id').value = item.description_id || item.description || '';

      // Pricing
      document.getElementById('menu-item-price').value = item.price || '';
      document.getElementById('menu-item-normal-price').value = item.normal_price || '';

      document.getElementById('menu-modal').classList.remove('hidden');
      document.getElementById('menu-modal').classList.add('flex');
    }

    function closeMenuModal() {
      document.getElementById('menu-modal').classList.add('hidden');
      document.getElementById('menu-modal').classList.remove('flex');
    }

    // Handle Add/Edit Form submit (Dual Language Preservation)
    document.getElementById('form-menu-item').addEventListener('submit', async (e) => {
      e.preventDefault();
      const id = document.getElementById('menu-item-id').value.trim();
      const isEdit = id !== '';

      const name = document.getElementById('menu-item-name').value.trim();
      const nameId = document.getElementById('menu-item-name-id').value.trim() || name;
      const duration = document.getElementById('menu-item-duration').value.trim();
      const durationId = document.getElementById('menu-item-duration-id').value.trim() || duration;
      const tag = document.getElementById('menu-item-tag').value.trim();
      const tagId = document.getElementById('menu-item-tag-id').value.trim() || tag;
      const multiPrices = document.getElementById('menu-item-multi-prices').value.trim();
      const multiPricesId = document.getElementById('menu-item-multi-prices-id').value.trim() || multiPrices;
      const desc = document.getElementById('menu-item-desc').value.trim();
      const descId = document.getElementById('menu-item-desc-id').value.trim() || desc;
      const normalPriceVal = document.getElementById('menu-item-normal-price').value.trim();

      const newItem = {
        id: isEdit ? id : 'item-' + Date.now(),
        category: document.getElementById('menu-item-category').value,
        name: name,
        duration: duration,
        price: parseInt(document.getElementById('menu-item-price').value.replace(/[^0-9]/g, '')) || 0,
        description: desc,
        name_id: nameId,
        duration_id: durationId,
        tag: tag,
        tag_id: tagId,
        description_id: descId
      };
      if (normalPriceVal) newItem.normal_price = parseInt(normalPriceVal.replace(/[^0-9]/g, '')) || null;
      if (multiPrices) newItem.multi_prices = multiPrices;
      if (multiPricesId) newItem.multi_prices_id = multiPricesId;

      if (isEdit) {
        allMenuItems = allMenuItems.map(it => it.id === id ? newItem : it);
      } else {
        allMenuItems.push(newItem);
      }

      // Save entire array
      const fd = new FormData();
      fd.append('action', 'save_menu');
      fd.append('csrf_token', CSRF_TOKEN);
      fd.append('menu_data', JSON.stringify(allMenuItems));

      try {
        const res = await fetch('api.php', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.success) {
          showToast(data.message || 'Menu berhasil diperbarui!', true);
          closeMenuModal();
          setTimeout(() => location.reload(), 800);
        } else {
          showToast(data.message || 'Gagal menyimpan menu.', false);
        }
      } catch (err) {
        showToast('Terjadi kesalahan koneksi.', false);
      }
    });

    // Handle Delete Menu
    async function deleteMenuItem(id, name) {
      if (!confirm(`Hapus layanan "${name}" dari daftar menu?`)) return;

      const fd = new FormData();
      fd.append('action', 'delete_menu_item');
      fd.append('csrf_token', CSRF_TOKEN);
      fd.append('id', id);

      try {
        const res = await fetch('api.php', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.success) {
          showToast(data.message || 'Layanan dihapus.', true);
          allMenuItems = allMenuItems.filter(it => it.id !== id);
          setTimeout(() => location.reload(), 600);
        } else {
          showToast(data.message || 'Gagal menghapus.', false);
        }
      } catch (err) {
        showToast('Koneksi gagal.', false);
      }
    }
  </script>
</body>
</html>

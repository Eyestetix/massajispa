<?php
// index.php - Massaji Spa Bali (Royal Blue Zen Aesthetic)
$settings_file = __DIR__ . '/data/settings.json';
$promo_file    = __DIR__ . '/data/promo.json';
$menu_file     = __DIR__ . '/data/menu.json';

// Default Fallback Settings
$settings = [
    'site_name'        => 'Massaji Spa Bali',
    'tagline'          => 'Authentic Balinese Massage & Holistic Wellness Sanctuary',
    'subtagline'       => 'Pusat relaksasi mendalam di Canggu & Kerobokan dengan sentuhan terapis berpengalaman, minyak aromaterapi murni, dan tradisi penyembuhan Bali autentik.',
    'booking_email'    => 'reservation@massaji.net',
    'whatsapp_number'  => '6281236695755',
    'phone'            => '+62 812-3669-5755',
    'address'          => 'Jl. Raya Canggu, Gg. Bedugul No. 3, Kerobokan, Canggu, Bali 80361',
    'google_maps_link' => 'https://maps.google.com/?q=Massaji+Spa+Bali+Canggu',
    'google_maps_embed'=> 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.3828987349144!2d115.1582239!3d-8.6548777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd239274213197b%3A0xb3e5d3c8c7efc0c0!2sMassaji%20Spa!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
    'opening_hours'    => 'Setiap Hari: 10:00 - 21:00 WITA',
    'instagram'        => 'https://instagram.com/massajispa',
    'currency_label'   => 'IDR'
];

if (file_exists($settings_file)) {
    $loaded_settings = json_decode(file_get_contents($settings_file), true);
    if (is_array($loaded_settings)) {
        $settings = array_merge($settings, $loaded_settings);
    }
}

$promo = file_exists($promo_file) ? json_decode(file_get_contents($promo_file), true) : [];
$menu  = file_exists($menu_file) ? json_decode(file_get_contents($menu_file), true) : [];
if (!is_array($menu)) $menu = [];

// Clean WhatsApp Link
$clean_wa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number']);
if (substr($clean_wa, 0, 1) === '0') $clean_wa = '62' . substr($clean_wa, 1);
$wa_url = "https://wa.me/" . $clean_wa . "?text=" . rawurlencode("Halo " . $settings['site_name'] . ", saya ingin bertanya ketersediaan jadwal perawatan spa.");
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($settings['site_name']); ?> - <?php echo htmlspecialchars($settings['tagline']); ?></title>
  <meta name="description" content="Massaji Spa Bali di Canggu & Kerobokan. Pijat tradisional Bali, Boreh herbal spa, Deep tissue, dan Facial Pevonia dengan nuansa biru zen yang damai.">
  
  <!-- Fonts & Tailwind CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              navy: '#0F2547',
              royal: '#1E3A8A',
              royalDark: '#172554',
              blue: '#2563EB',
              sky: '#0284C7',
              ice: '#F0F7FF',
              pale: '#E0F2FE',
              border: '#DBEAFE',
              dark: '#0F172A'
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
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans selection:bg-brand-royal selection:text-white">

  <!-- ========================================== -->
  <!-- TOP PROMO BANNER (IF ACTIVE) -->
  <!-- ========================================== -->
  <?php if (!empty($promo['active'])): ?>
    <div class="bg-gradient-to-r from-brand-navy via-brand-royal to-brand-navy text-white py-2.5 px-4 text-center text-xs sm:text-sm font-medium tracking-wide flex items-center justify-center gap-2 relative z-50 shadow-sm">
      <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-[11px] font-bold uppercase tracking-wider"><?php echo htmlspecialchars($promo['badge'] ?? 'Promotion'); ?></span>
      <span><strong><?php echo htmlspecialchars($promo['title'] ?? ''); ?></strong> — <?php echo htmlspecialchars($promo['description'] ?? ''); ?></span>
      <?php if (!empty($promo['code'])): ?>
        <span class="hidden md:inline-block font-mono bg-blue-950/60 px-2 py-0.5 rounded text-xs border border-white/20">Kode: <?php echo htmlspecialchars($promo['code']); ?></span>
      <?php endif; ?>
      <button onclick="openBookingModal('<?php echo htmlspecialchars($promo['title'] ?? 'Special Promo'); ?>')" class="underline hover:text-sky-200 ml-2 font-semibold text-xs whitespace-nowrap">Klaim Promo &rarr;</button>
    </div>
  <?php endif; ?>

  <!-- ========================================== -->
  <!-- MAIN NAVIGATION HEADER -->
  <!-- ========================================== -->
  <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/90 shadow-sm transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
      
      <!-- Brand Logo (Enso Zen Blue Style) -->
      <a href="index.php" class="flex items-center gap-3.5 group">
        <div class="w-12 h-12 rounded-full border-2 border-brand-royal flex items-center justify-center bg-blue-50/50 shadow-inner group-hover:scale-105 transition duration-300 relative">
          <!-- Zen Enso & Meditating Silhouette -->
          <svg class="w-8 h-8 text-brand-royal" viewBox="0 0 100 100" fill="currentColor">
            <!-- Stylized Brush Enso Ring -->
            <path d="M50 8 A42 42 0 1 0 88 65 A38 38 0 1 1 50 14 Z" opacity="0.85" />
            <!-- Meditating Figure -->
            <circle cx="50" cy="42" r="6" />
            <path d="M43 51 C40 54 36 62 33 67 C39 67 44 64 50 64 C56 64 61 67 67 67 C64 62 60 54 57 51 C55 49 45 49 43 51 Z" />
            <path d="M30 68 C35 69 45 68 50 71 C55 68 65 69 70 68 C71 70 67 73 50 73 C33 73 29 70 30 68 Z" />
          </svg>
        </div>
        <div>
          <div class="text-[10px] tracking-widest text-brand-royal font-medium uppercase leading-tight">マッサージ</div>
          <span class="font-serif text-2xl font-bold tracking-tight text-brand-navy block leading-none">Massaji <span class="font-light text-brand-royal">spa</span></span>
          <span class="text-[9px] uppercase tracking-widest text-slate-500 block mt-0.5">Canggu &bull; Bali</span>
        </div>
      </a>

      <!-- Desktop Navigation Menu -->
      <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-600">
        <a href="#about" class="hover:text-brand-royal transition">Tentang Kami</a>
        <a href="#promotion" class="hover:text-brand-royal text-brand-royal font-bold flex items-center gap-1.5 transition">
          <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
          Paket Promo
        </a>
        <a href="#menu" class="hover:text-brand-royal transition">Menu & Harga</a>
        <a href="#reviews" class="hover:text-brand-royal transition">Ulasan (4.8★)</a>
        <a href="#contact" class="hover:text-brand-royal transition">Lokasi & Jam Buka</a>
      </nav>

      <!-- Header Actions -->
      <div class="hidden sm:flex items-center gap-3.5">
        <a href="<?php echo $wa_url; ?>" target="_blank" class="px-4 py-2 rounded-full border border-emerald-600/60 hover:border-emerald-500 text-emerald-700 hover:bg-emerald-50 text-xs font-bold tracking-wider uppercase flex items-center gap-2 transition duration-200">
          <svg class="w-4 h-4 fill-current text-emerald-600" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
          WhatsApp
        </a>
        <button onclick="openBookingModal()" class="px-5 py-2.5 rounded-full bg-brand-royal hover:bg-brand-blue text-white font-semibold text-xs tracking-wider uppercase shadow-md shadow-blue-900/20 hover:shadow-lg transition duration-300">
          Reservasi Online
        </button>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-700 hover:text-brand-royal focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>

    <!-- Mobile Dropdown Navigation -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-slate-200 px-6 py-6 space-y-4 shadow-xl">
      <a href="#about" class="block text-sm font-semibold text-slate-700 hover:text-brand-royal">Tentang Kami</a>
      <a href="#promotion" class="block text-sm font-bold text-brand-royal">Paket Promo Spesial</a>
      <a href="#menu" class="block text-sm font-semibold text-slate-700 hover:text-brand-royal">Menu & Harga Treatment</a>
      <a href="#reviews" class="block text-sm font-semibold text-slate-700 hover:text-brand-royal">Ulasan Tamu (4.8★)</a>
      <a href="#contact" class="block text-sm font-semibold text-slate-700 hover:text-brand-royal">Lokasi & Jam Buka</a>
      <div class="pt-4 border-t border-slate-200 flex flex-col gap-3">
        <button onclick="openBookingModal()" class="w-full py-3 rounded-xl bg-brand-royal text-white text-center font-bold text-xs tracking-wider uppercase shadow">
          Reservasi Sekarang
        </button>
        <a href="<?php echo $wa_url; ?>" target="_blank" class="w-full py-2.5 rounded-xl border border-emerald-600 text-emerald-700 text-center font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-2">
          Chat WhatsApp Resepsionis
        </a>
      </div>
    </div>
  </header>

  <!-- ========================================== -->
  <!-- HERO SECTION (ROYAL BLUE ZEN VIBE) -->
  <!-- ========================================== -->
  <section class="relative min-h-[82vh] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-b from-sky-50 via-white to-blue-50/50">
    
    <!-- Zen Atmosphere Gradients -->
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[700px] h-[700px] bg-blue-200/30 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="relative max-w-4xl mx-auto text-center z-10">
      
      <!-- Top Badge -->
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-brand-royal text-xs font-bold tracking-widest uppercase mb-8 shadow-sm">
        <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
        Top Rated Spa in Canggu &bull; 4.8★ Google Reviews
      </div>

      <!-- Main Headline -->
      <h1 class="font-serif text-4xl sm:text-6xl lg:text-7xl font-normal text-brand-navy tracking-tight leading-[1.12] mb-6">
        Ketenteraman Sejati, <br>
        <span class="italic font-normal text-brand-royal">Sentuhan Jiwa Tradisi Bali.</span>
      </h1>

      <!-- Subheadline -->
      <p class="max-w-2xl mx-auto text-slate-600 text-base sm:text-lg font-light leading-relaxed mb-10">
        <?php echo htmlspecialchars($settings['subtagline']); ?>
      </p>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
        <button onclick="openBookingModal()" class="w-full sm:w-auto px-8 py-4 rounded-full bg-brand-royal hover:bg-brand-blue text-white font-bold text-sm tracking-wider uppercase shadow-xl shadow-blue-900/20 hover:shadow-2xl transition duration-300">
          Reservasi Jadwal Pijat
        </button>
        <a href="#promotion" class="w-full sm:w-auto px-8 py-4 rounded-full border-2 border-brand-royal text-brand-royal hover:bg-blue-50 font-bold text-sm tracking-wider uppercase transition duration-300">
          Lihat Paket Promo
        </a>
      </div>

      <!-- Trust Badges Bar -->
      <div class="mt-16 pt-10 border-t border-slate-200 grid grid-cols-2 md:grid-cols-4 gap-6 text-left">
        <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
          <div class="text-brand-royal font-serif text-3xl font-bold">4.8 ★</div>
          <div class="text-[11px] text-slate-500 mt-1 uppercase tracking-wider font-semibold">560+ Ulasan Tamu</div>
        </div>
        <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
          <div class="text-brand-royal font-serif text-3xl font-bold">100% Murni</div>
          <div class="text-[11px] text-slate-500 mt-1 uppercase tracking-wider font-semibold">Boreh & Minyak Botani</div>
        </div>
        <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
          <div class="text-brand-royal font-serif text-3xl font-bold">Tersertifikasi</div>
          <div class="text-[11px] text-slate-500 mt-1 uppercase tracking-wider font-semibold">Terapis Ahli & Ramah</div>
        </div>
        <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
          <div class="text-brand-royal font-serif text-3xl font-bold">Ruang Privat</div>
          <div class="text-[11px] text-slate-500 mt-1 uppercase tracking-wider font-semibold">AC Dingin, Tenang & Higienis</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- SPECIAL PROMOTION SECTION (FLYER MATCHING) -->
  <!-- ========================================== -->
  <section id="promotion" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="bg-gradient-to-br from-blue-900 via-blue-950 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden">
      
      <!-- Subtle Decorative Elements -->
      <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

      <div class="text-center max-w-2xl mx-auto mb-10 relative z-10">
        <span class="inline-block px-3.5 py-1 rounded-full bg-blue-800 text-sky-200 text-xs font-bold uppercase tracking-widest mb-3">
          Special Deal &bull; Canggu Bali
        </span>
        <h2 class="font-serif text-3xl sm:text-5xl font-semibold tracking-tight text-white mb-3">
          One Day Promotion Packages
        </h2>
        <p class="text-sky-200/80 text-sm sm:text-base font-light">
          Penawaran istimewa untuk ritual perawatan lengkap dan paket pasangan (*couples*) di Massaji Spa Bali.
        </p>
      </div>

      <!-- 3 Featured Packages From Flyer -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10">
        
        <!-- Package 1: Boreh Spa & Facial -->
        <div class="bg-white text-slate-800 rounded-2xl p-6 sm:p-7 flex flex-col justify-between shadow-lg relative border-t-4 border-brand-royal">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="text-xs font-bold uppercase tracking-wider text-brand-royal">1 Pax Package</span>
              <span class="text-xs text-slate-500 font-medium">2.5 Jam</span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-slate-900 mb-2 leading-tight">
              Balinese Boreh Spa ~ Hydrating Facial
            </h3>
            <p class="text-xs text-slate-600 leading-relaxed mb-4">
              <strong>Balinese Boreh Spa:</strong> Tradisi petani Bali meredakan ketegangan otot & melancarkan sirkulasi dengan ramuan akar, rempah, dan herba hangat.<br><br>
              <strong>Hydrating Facial:</strong> Menggunakan produk botani Pevonia (Australia) dengan ekstrak teratai air & teh hijau untuk mengembalikan kelembapan alami kulit.
            </p>
          </div>
          <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <span class="px-3 py-1.5 rounded-full bg-brand-royal text-white text-xs font-bold uppercase tracking-wider">
              Nett price : 750K
            </span>
            <button onclick="openBookingModal('1 pax Balinese Boreh Spa ~ Hydrating Facial (2.5 hours)')" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-brand-royal text-brand-royal hover:text-white font-bold text-xs uppercase tracking-wider transition">
              Pesan &rarr;
            </button>
          </div>
        </div>

        <!-- Package 2: 2 Pax Signature 90 mins -->
        <div class="bg-white text-slate-800 rounded-2xl p-6 sm:p-7 flex flex-col justify-between shadow-lg relative border-t-4 border-blue-600">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="text-xs font-bold uppercase tracking-wider text-blue-600">2 Pax (Couple)</span>
              <span class="text-xs text-slate-500 font-medium">90 Menit</span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-slate-900 mb-2 leading-tight">
              2 Pax Massaji Signature
            </h3>
            <div class="inline-block px-2.5 py-1 rounded bg-blue-50 text-blue-800 text-[11px] font-semibold mb-3">
              Free: Pure cooling aloe vera ~ honey face mask
            </div>
            <p class="text-xs text-slate-600 leading-relaxed mb-4">
              Pijat *ultimate signature* yang dikembangkan bertahun-tahun oleh terapis berpengalaman Massaji, memadukan teknik terbaik dunia untuk relaksasi terdalam bagi 2 orang sekaligus.
            </p>
          </div>
          <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <span class="px-3 py-1.5 rounded-full bg-brand-royal text-white text-xs font-bold uppercase tracking-wider">
              Nett price : 488K
            </span>
            <button onclick="openBookingModal('2 pax Massaji Signature (90 mins)')" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-brand-royal text-brand-royal hover:text-white font-bold text-xs uppercase tracking-wider transition">
              Pesan &rarr;
            </button>
          </div>
        </div>

        <!-- Package 3: 2 Pax Balinese Massage 120 mins -->
        <div class="bg-white text-slate-800 rounded-2xl p-6 sm:p-7 flex flex-col justify-between shadow-lg relative border-t-4 border-brand-royal">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="text-xs font-bold uppercase tracking-wider text-brand-royal">2 Pax (Couple)</span>
              <span class="text-xs text-slate-500 font-medium">120 Menit (2 Jam)</span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-slate-900 mb-2 leading-tight">
              2 Pax Balinese Massage
            </h3>
            <div class="inline-block px-2.5 py-1 rounded bg-blue-50 text-blue-800 text-[11px] font-semibold mb-3">
              Free: Pure cooling aloe vera ~ honey face mask
            </div>
            <p class="text-xs text-slate-600 leading-relaxed mb-4">
              Seni pijat tradisional Bali kuno yang membawa tubuh ke dalam ketenangan total lewat peregangan lembut, akupresur, dan aromaterapi alami selama 2 jam penuh untuk 2 orang.
            </p>
          </div>
          <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <span class="px-3 py-1.5 rounded-full bg-brand-royal text-white text-xs font-bold uppercase tracking-wider">
              Nett price : 488K
            </span>
            <button onclick="openBookingModal('2 pax Balinese Massage (120 mins)')" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-brand-royal text-brand-royal hover:text-white font-bold text-xs uppercase tracking-wider transition">
              Pesan &rarr;
            </button>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- ABOUT SECTION -->
  <!-- ========================================== -->
  <section id="about" class="py-20 bg-white border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <div class="lg:col-span-6 space-y-6">
          <span class="text-xs font-bold tracking-widest text-brand-royal uppercase">Tentang Massaji Spa</span>
          <h2 class="font-serif text-3xl sm:text-5xl font-normal text-slate-900 leading-tight">
            Sentuhan Kehangatan Bali <br>
            <span class="italic text-brand-royal">dengan Kedamaian Pikiran.</span>
          </h2>
          <p class="text-slate-600 text-sm sm:text-base leading-relaxed font-light">
            Berlokasi di kawasan Kerobokan / Canggu yang tenang, <strong>Massaji Spa</strong> menghadirkan pengalaman spa profesional dengan standar kebersihan tinggi dan harga yang jujur dan terjangkau.
          </p>
          <p class="text-slate-500 text-sm leading-relaxed font-light">
            Mulai dari tradisi rempah Boreh Bali yang menghangatkan persendian, Facial Pevonia yang menyegarkan wajah lelah, hingga pijat prenatal bersertifikat untuk ibu hamil—setiap terapis kami berdedikasi memberikan perawatan terbaik yang disesuaikan dengan kebutuhan Anda.
          </p>

          <div class="pt-4 flex items-center gap-6">
            <div>
              <span class="block font-serif text-3xl font-bold text-brand-royal">4.8 ★</span>
              <span class="text-xs text-slate-500 uppercase tracking-wider">Google Reviews</span>
            </div>
            <div class="h-10 w-px bg-slate-200"></div>
            <div>
              <span class="block font-serif text-3xl font-bold text-brand-royal">Rp 140K+</span>
              <span class="text-xs text-slate-500 uppercase tracking-wider">Harga Terjangkau</span>
            </div>
            <div class="h-10 w-px bg-slate-200"></div>
            <div>
              <span class="block font-serif text-3xl font-bold text-brand-royal">100%</span>
              <span class="text-xs text-slate-500 uppercase tracking-wider">Bahan Botani Murni</span>
            </div>
          </div>
        </div>

        <div class="lg:col-span-6">
          <div class="grid grid-cols-2 gap-4">
            <div class="space-y-4">
              <div class="p-6 rounded-2xl bg-blue-50/60 border border-blue-100 hover:border-brand-royal/40 transition shadow-sm">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-brand-royal mb-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h4 class="font-serif text-lg font-bold text-slate-900 mb-1">Herbal & Aromaterapi</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Minyak murni frangipani, serai, lavender, serta lulur rempah boreh alami.</p>
              </div>

              <div class="p-6 rounded-2xl bg-blue-50/60 border border-blue-100 hover:border-brand-royal/40 transition shadow-sm">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-brand-royal mb-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h4 class="font-serif text-lg font-bold text-slate-900 mb-1">Higienis & Privat</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Sprei dan handuk selalu baru diganti setiap sesi dengan aroma rempah segar.</p>
              </div>
            </div>

            <div class="space-y-4 pt-8">
              <div class="p-6 rounded-2xl bg-blue-50/60 border border-blue-100 hover:border-brand-royal/40 transition shadow-sm">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-brand-royal mb-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h4 class="font-serif text-lg font-bold text-slate-900 mb-1">Perawatan Prenatal</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Terapis tersertifikasi khusus ibu hamil dengan bantal penopang yang aman.</p>
              </div>

              <div class="p-6 rounded-2xl bg-blue-50/60 border border-blue-100 hover:border-brand-royal/40 transition shadow-sm">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-brand-royal mb-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h4 class="font-serif text-lg font-bold text-slate-900 mb-1">Teh Hangat Jahe</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Sajian teh jahe serai hangat setelah perawatan untuk menyegarkan stamina.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- COMPLETE TREATMENT MENU (DYNAMIC) -->
  <!-- ========================================== -->
  <section id="menu" class="py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    
    <div class="text-center max-w-3xl mx-auto mb-14">
      <span class="text-xs font-bold tracking-widest text-brand-royal uppercase">Katalog Lengkap</span>
      <h2 class="font-serif text-3xl sm:text-5xl font-normal text-slate-900 mt-2 mb-4">
        Daftar Menu & Tarif Layanan
      </h2>
      <p class="text-slate-600 text-sm sm:text-base font-light">
        Harga transparan dan terjangkau di kawasan Canggu & Kerobokan.
      </p>

      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2 mt-8">
        <button class="menu-filter-btn px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase transition border bg-brand-royal text-white border-brand-royal active shadow-sm" data-category="all">
          Semua Layanan (<?php echo count($menu); ?>)
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase transition border bg-white text-slate-700 border-slate-200 hover:border-brand-royal" data-category="packages">
          Paket Spa (Packages)
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase transition border bg-white text-slate-700 border-slate-200 hover:border-brand-royal" data-category="massage">
          Pijat Tradisional & Tubuh
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase transition border bg-white text-slate-700 border-slate-200 hover:border-brand-royal" data-category="beauty">
          Facial & Scrub
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase transition border bg-white text-slate-700 border-slate-200 hover:border-brand-royal" data-category="reflexology">
          Reflexology
        </button>
      </div>
    </div>

    <!-- Treatment Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="menu-cards-container">
      <?php foreach ($menu as $item): ?>
        <div class="treatment-card bg-white border border-slate-200 rounded-2xl p-6 flex flex-col justify-between relative overflow-hidden shadow-sm hover:shadow-xl transition" data-category="<?php echo htmlspecialchars($item['category'] ?? 'massage'); ?>">
          
          <?php if (!empty($item['is_featured'])): ?>
            <div class="absolute -top-3 -right-3 w-20 h-20 overflow-hidden pointer-events-none">
              <span class="absolute top-4 right-[-24px] transform rotate-45 bg-brand-royal text-white text-[9px] font-bold uppercase tracking-wider py-1 px-7 shadow">
                <?php echo htmlspecialchars($item['tag'] ?? 'Populer'); ?>
              </span>
            </div>
          <?php endif; ?>

          <div>
            <!-- Duration & Category Badge -->
            <div class="flex items-center justify-between text-xs mb-3">
              <span class="text-brand-royal font-bold uppercase tracking-wider text-[11px]">
                <?php 
                  $cat_names = [
                    'massage' => 'Body Massage',
                    'beauty' => 'Facial & Scrub',
                    'reflexology' => 'Reflexology',
                    'packages' => 'Signature Package'
                  ];
                  echo htmlspecialchars($cat_names[$item['category']] ?? $item['category']);
                ?>
              </span>
              <span class="text-slate-500 font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php echo htmlspecialchars($item['duration']); ?>
              </span>
            </div>

            <!-- Treatment Title -->
            <h3 class="font-serif text-2xl font-bold text-slate-900 mb-2 leading-snug">
              <?php echo htmlspecialchars($item['name']); ?>
            </h3>

            <!-- Treatment Description -->
            <p class="text-slate-600 text-xs sm:text-sm font-light leading-relaxed mb-6">
              <?php echo htmlspecialchars($item['description']); ?>
            </p>
          </div>

          <!-- Bottom Price & Booking Button -->
          <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-semibold">Tarif</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-brand-navy font-mono">
                Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
              </span>
            </div>

            <button onclick="openBookingModal('<?php echo htmlspecialchars(addslashes($item['name'])); ?>')" class="px-4 py-2 rounded-xl bg-blue-50 hover:bg-brand-royal text-brand-royal hover:text-white border border-blue-200 hover:border-brand-royal text-xs font-bold tracking-wider uppercase transition duration-200 flex items-center gap-1.5 shadow-sm">
              <span>Pesan</span>
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
          </div>

        </div>
      <?php endforeach; ?>
    </div>

  </section>

  <!-- ========================================== -->
  <!-- REVIEWS SECTION -->
  <!-- ========================================== -->
  <section id="reviews" class="py-20 bg-blue-50/50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="text-xs font-bold tracking-widest text-brand-royal uppercase">Ulasan Pengunjung</span>
        <h2 class="font-serif text-3xl sm:text-5xl font-normal text-slate-900 mt-2">
          Dipercaya Ribuan Pelancong di Bali
        </h2>
        <div class="flex items-center justify-center gap-2 mt-4">
          <div class="flex text-amber-500">
            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
          </div>
          <span class="text-sm font-bold text-slate-800">4.8 / 5.0</span>
          <span class="text-slate-500 text-xs font-medium">(560+ Google Reviews)</span>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex text-amber-500 mb-2.5 text-sm">★★★★★</div>
            <p class="text-slate-600 text-xs sm:text-sm italic leading-relaxed">
              "Pijatannya luar biasa mantap dan tempatnya sangat bersih serta harum. Kami ambil paket 2 orang 90 menit dan dapat masker aloe vera gratis yang sejuk banget di kulit!"
            </p>
          </div>
          <div class="mt-5 pt-3 border-t border-slate-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 text-brand-royal font-bold text-xs flex items-center justify-center">SL</div>
            <div>
              <span class="block text-xs font-bold text-slate-800">Sarah L.</span>
              <span class="text-[10px] text-slate-400">Australia &bull; Massaji Signature</span>
            </div>
          </div>
        </div>

        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex text-amber-500 mb-2.5 text-sm">★★★★★</div>
            <p class="text-slate-600 text-xs sm:text-sm italic leading-relaxed">
              "Boreh spanya benar-benar menghangatkan badan dan pegal-pegal langsung hilang. Lanjut facial Pevonia kulit langsung glowing dan segar. Terapisnya ramah sekali."
            </p>
          </div>
          <div class="mt-5 pt-3 border-t border-slate-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 text-brand-royal font-bold text-xs flex items-center justify-center">DA</div>
            <div>
              <span class="block text-xs font-bold text-slate-800">Dian Anggraini</span>
              <span class="text-[10px] text-slate-400">Jakarta &bull; Balinese Boreh & Facial</span>
            </div>
          </div>
        </div>

        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex text-amber-500 mb-2.5 text-sm">★★★★★</div>
            <p class="text-slate-600 text-xs sm:text-sm italic leading-relaxed">
              "Tempat favorit di Canggu! Harga sangat terjangkau untuk kualitas spa bintang 5. Ruangannya dingin, teh jahenya enak, dan reservasi via WhatsApp sangat cepat direspon."
            </p>
          </div>
          <div class="mt-5 pt-3 border-t border-slate-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 text-brand-royal font-bold text-xs flex items-center justify-center">MK</div>
            <div>
              <span class="block text-xs font-bold text-slate-800">Marc & Klara</span>
              <span class="text-[10px] text-slate-400">Germany &bull; 2 Pax Balinese Massage</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- LOCATION & CONTACT SECTION -->
  <!-- ========================================== -->
  <section id="contact" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
      
      <div class="lg:col-span-5 space-y-6">
        <span class="text-xs font-bold tracking-widest text-brand-royal uppercase">Lokasi & Kontak</span>
        <h2 class="font-serif text-3xl sm:text-5xl font-normal text-slate-900">
          Kunjungi Massaji Spa
        </h2>
        <p class="text-slate-600 text-sm font-light leading-relaxed">
          Terletak di jalan utama Canggu / Kerobokan dengan parkir yang mudah dan akses cepat dari hotel & villa sekitar.
        </p>

        <div class="space-y-4">
          <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-sm flex items-start gap-3.5">
            <div class="w-9 h-9 rounded-full bg-blue-50 text-brand-royal flex items-center justify-center flex-shrink-0 mt-0.5">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
              <span class="block text-xs font-bold text-slate-800 uppercase tracking-wider">Alamat</span>
              <p class="text-xs sm:text-sm text-slate-600 mt-0.5"><?php echo htmlspecialchars($settings['address']); ?></p>
              <a href="<?php echo htmlspecialchars($settings['google_maps_link']); ?>" target="_blank" class="text-xs text-brand-royal font-bold hover:underline mt-1.5 inline-block">
                Buka di Google Maps &rarr;
              </a>
            </div>
          </div>

          <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-sm flex items-start gap-3.5">
            <div class="w-9 h-9 rounded-full bg-blue-50 text-brand-royal flex items-center justify-center flex-shrink-0 mt-0.5">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <span class="block text-xs font-bold text-slate-800 uppercase tracking-wider">Jam Operasional</span>
              <p class="text-xs sm:text-sm text-slate-600 mt-0.5 font-semibold"><?php echo htmlspecialchars($settings['opening_hours']); ?></p>
            </div>
          </div>

          <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-sm flex items-start gap-3.5">
            <div class="w-9 h-9 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
              <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </div>
            <div>
              <span class="block text-xs font-bold text-slate-800 uppercase tracking-wider">Hubungi Langsung</span>
              <a href="<?php echo $wa_url; ?>" target="_blank" class="text-xs sm:text-sm text-emerald-700 font-bold hover:underline">
                WhatsApp: +<?php echo htmlspecialchars($clean_wa); ?>
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- Google Maps Frame -->
      <div class="lg:col-span-7 h-[380px] rounded-2xl overflow-hidden border border-slate-200 shadow-md relative bg-slate-100">
        <iframe 
          src="<?php echo htmlspecialchars($settings['google_maps_embed']); ?>" 
          width="100%" 
          height="100%" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy">
        </iframe>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- FOOTER -->
  <!-- ========================================== -->
  <footer class="bg-slate-900 border-t border-slate-800 pt-16 pb-24 lg:pb-16 text-slate-400 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
        
        <div class="md:col-span-2 space-y-3">
          <div class="text-white font-serif text-2xl font-bold flex items-center gap-2">
            <span>マッサージ Massaji spa</span>
          </div>
          <p class="text-slate-400 text-xs max-w-md leading-relaxed">
            <?php echo htmlspecialchars($settings['tagline']); ?>. Pengalaman spa tradisional Bali dengan suasana zen, pelayanan hangat, dan harga transparan.
          </p>
          <div class="pt-2">
            <a href="<?php echo htmlspecialchars($settings['instagram']); ?>" target="_blank" class="text-sky-400 hover:text-white transition">
              Instagram: @massajispa
            </a>
          </div>
        </div>

        <div>
          <h4 class="font-bold text-white uppercase tracking-wider text-xs mb-3">Tautan Cepat</h4>
          <ul class="space-y-2">
            <li><a href="#about" class="hover:text-white transition">Tentang Kami</a></li>
            <li><a href="#promotion" class="hover:text-white transition">Paket Promo</a></li>
            <li><a href="#menu" class="hover:text-white transition">Daftar Menu</a></li>
            <li><a href="#contact" class="hover:text-white transition">Lokasi & Jam Buka</a></li>
          </ul>
        </div>

        <div>
          <h4 class="font-bold text-white uppercase tracking-wider text-xs mb-3">Akses Staf</h4>
          <p class="text-[11px] text-slate-500 mb-2">Panel admin untuk mengubah menu, harga, promo, dan nomor kontak.</p>
          <a href="admin/login.php" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs transition">
            Masuk Panel Admin &rarr;
          </a>
        </div>

      </div>

      <div class="pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-slate-500 text-[11px]">
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($settings['site_name']); ?>. All rights reserved.</p>
        <p>Balinese Zen Spa & Wellness</p>
      </div>
    </div>
  </footer>

  <!-- ========================================== -->
  <!-- MOBILE STICKY BOTTOM BAR -->
  <!-- ========================================== -->
  <div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 p-3 flex items-center gap-2 shadow-2xl">
    <a href="<?php echo $wa_url; ?>" target="_blank" class="flex-1 py-3 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-1.5 shadow">
      <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
      <span>Chat WA</span>
    </a>
    <button onclick="openBookingModal()" class="flex-1 py-3 px-3 rounded-xl bg-brand-royal text-white font-bold text-xs tracking-wider uppercase text-center shadow">
      Pesan Sekarang
    </button>
  </div>

  <!-- ========================================== -->
  <!-- MODAL: ONLINE RESERVATION -->
  <!-- ========================================== -->
  <div id="booking-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white border border-slate-200 rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl relative max-h-[92vh] overflow-y-auto">
      
      <!-- Close Button -->
      <button id="modal-close-btn" class="absolute top-5 right-5 text-slate-400 hover:text-slate-800 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Booking Form View -->
      <div id="booking-form-container">
        <div class="mb-6">
          <span class="text-[10px] font-bold tracking-widest text-brand-royal uppercase">Reservasi Langsung</span>
          <h3 class="font-serif text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Pesan Jadwal Perawatan</h3>
          <p class="text-xs text-slate-500 mt-1">Rincian reservasi akan otomatis diteruskan ke email resepsionis dan WhatsApp.</p>
        </div>

        <div id="booking-error-msg" class="hidden mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs"></div>

        <form id="booking-form" class="space-y-4">
          
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Lengkap Tamu *</label>
            <input type="text" name="name" required placeholder="Contoh: Jessica Miller"
              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:border-brand-royal focus:bg-white focus:outline-none">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nomor WhatsApp / HP *</label>
              <input type="tel" name="phone" required placeholder="Contoh: 0812-xxxx-xxxx"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:border-brand-royal focus:bg-white focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Alamat Email</label>
              <input type="email" name="email" placeholder="nama@email.com"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:border-brand-royal focus:bg-white focus:outline-none">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Pilihan Layanan / Paket *</label>
            <select id="booking-service" name="service" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:border-brand-royal focus:bg-white focus:outline-none">
              <?php foreach ($menu as $m): ?>
                <option value="<?php echo htmlspecialchars($m['name']); ?>">
                  <?php echo htmlspecialchars($m['name']); ?> (Rp <?php echo number_format($m['price'], 0, ',', '.'); ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Tanggal *</label>
              <input type="date" id="booking-date" name="date" required
                class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:border-brand-royal focus:bg-white focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Jam *</label>
              <select name="time" required class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:border-brand-royal focus:bg-white focus:outline-none">
                <option value="10:00">10:00 WITA</option>
                <option value="11:00">11:00 WITA</option>
                <option value="12:00">12:00 WITA</option>
                <option value="13:00">13:00 WITA</option>
                <option value="14:00">14:00 WITA</option>
                <option value="15:00">15:00 WITA</option>
                <option value="16:00">16:00 WITA</option>
                <option value="17:00">17:00 WITA</option>
                <option value="18:00">18:00 WITA</option>
                <option value="19:00">19:00 WITA</option>
                <option value="20:00">20:00 WITA</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Pax</label>
              <select name="guests" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 focus:border-brand-royal focus:bg-white focus:outline-none">
                <option value="1">1 Orang</option>
                <option value="2">2 Orang (Couple)</option>
                <option value="3">3 Orang</option>
                <option value="4">4+ Orang</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Catatan Khusus (Opsional)</label>
            <textarea name="notes" rows="2" placeholder="Tingkat tekanan pijatan (lembut/kuat), ruangan couple, dll."
              class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder-slate-400 focus:border-brand-royal focus:bg-white focus:outline-none"></textarea>
          </div>

          <div class="pt-3">
            <button type="submit" id="booking-submit-btn" class="w-full py-3.5 rounded-xl bg-brand-royal hover:bg-brand-blue text-white font-bold text-sm tracking-wider uppercase shadow-lg transition duration-200">
              Kirim Permintaan Reservasi
            </button>
          </div>

        </form>
      </div>

      <!-- Success Confirmation View -->
      <div id="booking-confirmation" class="hidden text-center py-6 space-y-5">
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mx-auto flex items-center justify-center">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>

        <div>
          <h4 class="font-serif text-3xl font-bold text-slate-900">Reservasi Terkirim!</h4>
          <p id="booking-summary-text" class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed px-4">
            Terima kasih! Rincian reservasi Anda telah berhasil kami catat.
          </p>
        </div>

        <div class="space-y-3 pt-2">
          <a id="wa-confirm-link" href="#" target="_blank" class="w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-2 shadow-lg transition">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            Konfirmasi Cepat via WhatsApp
          </a>

          <button onclick="closeBookingModal()" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs tracking-wider transition">
            Tutup
          </button>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/main.js"></script>
</body>
</html>

<?php
// index.php - Massaji Spa Bali (Contemporary Balinese Luxury Redesign)
$settings_file = __DIR__ . '/data/settings.json';
$promo_file    = __DIR__ . '/data/promo.json';
$menu_file     = __DIR__ . '/data/menu.json';

// Default Fallback Settings
$settings = [
    'site_name'        => 'Massaji Spa Bali',
    'tagline'          => 'Authentic Balinese Massage & Holistic Wellness Sanctuary',
    'subtagline'       => 'Experience authentic Balinese healing rituals, thoughtful treatments, and peaceful moments of relaxation in the heart of Canggu.',
    'booking_email'    => 'reservation@massaji.net',
    'whatsapp_number'  => '6281236695755',
    'phone'            => '+62 812-3669-5755',
    'address'          => 'Jl. Raya Canggu, Gg. Bedugul No. 3, Kerobokan, Canggu, Bali 80361',
    'google_maps_link' => 'https://maps.google.com/?q=Massaji+Spa+Bali+Canggu',
    'google_maps_embed'=> 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.3828987349144!2d115.1582239!3d-8.6548777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd239274213197b%3A0xb3e5d3c8c7efc0c0!2sMassaji%20Spa!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
    'opening_hours'    => 'Daily: 10:00 AM - 9:00 PM WITA',
    'instagram'        => 'https://instagram.com/massajispa',
    'currency_label'   => 'IDR'
];

if (file_exists($settings_file)) {
    $loaded_settings = json_decode(file_get_contents($settings_file), true);
    if (is_array($loaded_settings)) {
        $settings = array_merge($settings, $loaded_settings);
    }
}

$menu = file_exists($menu_file) ? json_decode(file_get_contents($menu_file), true) : [];
if (!is_array($menu)) $menu = [];

// Clean WhatsApp Link
$clean_wa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number']);
if (substr($clean_wa, 0, 1) === '0') $clean_wa = '62' . substr($clean_wa, 1);
$wa_url = "https://wa.me/" . $clean_wa . "?text=" . rawurlencode("Hello " . $settings['site_name'] . ", I would like to check availability for a spa treatment.");
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($settings['site_name']); ?> — Contemporary Balinese Luxury Sanctuary</title>
  <meta name="description" content="Massaji Spa Bali in Canggu & Kerobokan. Authentic Balinese massage, herbal Boreh therapy, deep tissue, and Pevonia facials. Boutique wellness sanctuary.">
  
  <!-- Fonts & Tailwind CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              ivory: '#F7F4EE',
              sand: '#EFE8DE',
              surface: '#FFFFFF',
              charcoal: '#252820',
              muted: '#68685F',
              primary: '#344B3D',
              primaryHover: '#26372F',
              secondary: '#75816A',
              bronze: '#B58A59',
              border: '#E5DED3',
              darkForest: '#26372F'
            }
          },
          fontFamily: {
            serif: ['"Cormorant Garamond"', 'serif'],
            sans: ['"Manrope"', 'sans-serif']
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#F7F4EE] text-[#252820] antialiased font-sans selection:bg-[#344B3D] selection:text-white">

  <!-- ========================================== -->
  <!-- 1. NAVIGATION HEADER -->
  <!-- ========================================== -->
  <header class="sticky top-0 z-40 bg-[#F7F4EE]/95 backdrop-blur-md border-b border-[#E5DED3] transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
      
      <!-- Brand Logo -->
      <a href="index.php" class="flex items-center gap-3.5 group">
        <div class="w-11 h-11 rounded-full border border-[#75816A]/40 flex items-center justify-center bg-white shadow-sm group-hover:border-[#344B3D] transition duration-300 overflow-hidden">
          <img src="assets/images/member-1.png" alt="Massaji Spa" class="w-full h-full object-contain p-1" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
          <div style="display:none;" class="w-full h-full flex items-center justify-center font-serif text-lg font-bold text-[#344B3D]">M</div>
        </div>
        <div>
          <div class="text-[10px] tracking-[0.2em] text-[#75816A] font-semibold uppercase leading-tight">マッサージ</div>
          <span class="font-serif text-2xl font-semibold tracking-tight text-[#252820] block leading-none">Massaji <span class="font-normal italic text-[#75816A]">Spa</span></span>
          <span class="text-[9px] uppercase tracking-widest text-[#68685F] block mt-0.5">Canggu &bull; Bali</span>
        </div>
      </a>

      <!-- Desktop Navigation Menu -->
      <nav class="hidden lg:flex items-center gap-8 text-[14px] font-medium text-[#68685F]">
        <a href="#about" class="hover:text-[#344B3D] transition" data-i18n="nav_about">About Us</a>
        <a href="#promotion" class="hover:text-[#344B3D] text-[#344B3D] font-semibold flex items-center gap-1.5 transition">
          <span class="w-1.5 h-1.5 rounded-full bg-[#344B3D]"></span>
          <span data-i18n="nav_deals">Special Deals</span>
        </a>
        <a href="#menu" class="hover:text-[#344B3D] transition" data-i18n="nav_menu">Menu & Pricing</a>
        <a href="#reviews" class="hover:text-[#344B3D] transition" data-i18n="nav_reviews">Reviews (4.8★)</a>
        <a href="#contact" class="hover:text-[#344B3D] transition" data-i18n="nav_contact">Location & Hours</a>
      </nav>

      <!-- Header Actions (Bilingual Toggle + WhatsApp + Booking CTA) -->
      <div class="hidden sm:flex items-center gap-3.5">
        
        <!-- Language Switcher Toggle (ID / EN) -->
        <div class="inline-flex items-center p-0.5 bg-white rounded-lg border border-[#E5DED3] text-[11px] font-semibold">
          <button class="lang-btn px-2.5 py-1 rounded-md transition text-[#68685F] hover:text-[#252820]" data-lang="id">ID</button>
          <button class="lang-btn px-2.5 py-1 rounded-md transition bg-[#344B3D] text-white" data-lang="en">EN</button>
        </div>

        <a href="<?php echo $wa_url; ?>" target="_blank" class="px-3.5 py-2 rounded-lg border border-[#E5DED3] hover:border-[#344B3D] bg-white text-[#252820] text-xs font-semibold tracking-wider flex items-center gap-1.5 transition duration-200 shadow-sm">
          <svg class="w-3.5 h-3.5 fill-current text-[#344B3D]" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
          WhatsApp
        </a>
        <button onclick="openBookingModal()" class="btn-primary" data-i18n="nav_book">
          Book Treatment
        </button>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-btn" class="lg:hidden p-2 text-[#252820] hover:text-[#344B3D] focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>

    <!-- Mobile Dropdown Navigation -->
    <div id="mobile-menu" class="hidden lg:hidden bg-[#F7F4EE] border-b border-[#E5DED3] px-6 py-6 space-y-4 shadow-xl">
      <!-- Mobile Language Switcher -->
      <div class="flex items-center justify-between pb-3 border-b border-[#E5DED3]">
        <span class="text-xs font-semibold text-[#68685F] uppercase tracking-wider">Language / Bahasa:</span>
        <div class="inline-flex items-center p-0.5 bg-white rounded-lg border border-[#E5DED3] text-xs font-bold">
          <button class="lang-btn px-3 py-1 rounded-md transition" data-lang="id">ID</button>
          <button class="lang-btn px-3 py-1 rounded-md transition bg-[#344B3D] text-white" data-lang="en">EN</button>
        </div>
      </div>

      <a href="#about" class="block text-sm font-medium text-[#252820] hover:text-[#344B3D]" data-i18n="nav_about">About Us</a>
      <a href="#promotion" class="block text-sm font-semibold text-[#344B3D]" data-i18n="nav_deals">Special Deals</a>
      <a href="#menu" class="block text-sm font-medium text-[#252820] hover:text-[#344B3D]" data-i18n="nav_menu">Menu & Pricing</a>
      <a href="#reviews" class="block text-sm font-medium text-[#252820] hover:text-[#344B3D]" data-i18n="nav_reviews">Reviews (4.8★)</a>
      <a href="#contact" class="block text-sm font-medium text-[#252820] hover:text-[#344B3D]" data-i18n="nav_contact">Location & Hours</a>
      <div class="pt-4 border-t border-[#E5DED3] flex flex-col gap-3">
        <button onclick="openBookingModal()" class="w-full py-3 rounded-lg bg-[#344B3D] text-white text-center font-medium text-xs tracking-wider uppercase shadow" data-i18n="nav_book">
          Book Treatment
        </button>
        <a href="<?php echo $wa_url; ?>" target="_blank" class="w-full py-2.5 rounded-lg border border-[#E5DED3] bg-white text-[#252820] text-center font-medium text-xs tracking-wider uppercase flex items-center justify-center gap-2">
          Chat on WhatsApp
        </a>
      </div>
    </div>
  </header>

  <!-- ========================================== -->
  <!-- 2. HERO SECTION (EDITORIAL 2-COLUMN) -->
  <!-- ========================================== -->
  <section class="relative py-16 sm:py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
      
      <!-- Left Column: Content & Actions -->
      <div class="lg:col-span-6 space-y-6 text-left">
        <span class="eyebrow-tag" data-i18n="hero_eyebrow">Boutique Wellness Sanctuary • Canggu, Bali</span>
        
        <h1 class="font-serif hero-headline text-[#252820]">
          <span data-i18n="hero_title_1">Find Your Balance.</span> <br>
          <em class="italic font-normal text-[#75816A]" data-i18n="hero_title_2">Rediscover Serenity.</em>
        </h1>

        <p class="text-[#68685F] text-base sm:text-lg font-light leading-relaxed max-w-xl" data-i18n="hero_desc">
          Experience authentic Balinese healing rituals, thoughtful treatments, and peaceful moments of relaxation in the heart of Canggu.
        </p>

        <!-- CTAs -->
        <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
          <button onclick="openBookingModal()" class="btn-primary" data-i18n="hero_btn_book">
            Book Your Treatment
          </button>
          <a href="#menu" class="btn-secondary" data-i18n="hero_btn_explore">
            Explore Treatments
          </a>
        </div>

        <!-- Verified Trust Metric -->
        <div class="pt-6 border-t border-[#E5DED3] flex items-center gap-4 text-xs text-[#68685F]">
          <div class="flex text-amber-600 tracking-tighter text-sm">★★★★★</div>
          <span class="font-semibold text-[#252820]" data-i18n="stat_rating">4.8★ Verified Reviews</span>
          <span class="text-[#75816A]">&bull;</span>
          <span data-i18n="stat_count">(560+ Guests in Canggu)</span>
        </div>
      </div>

      <!-- Right Column: High Quality Spa Photography -->
      <div class="lg:col-span-6">
        <div class="img-editorial-frame aspect-[4/3] sm:aspect-[16/11] border border-[#E5DED3] shadow-lg">
          <img src="assets/images/MASAGE.JPG" alt="Authentic Balinese Massage at Massaji Spa" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=1200&q=80';">
          <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent pointer-events-none"></div>
          <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-sm rounded-xl p-3 border border-[#E5DED3] flex items-center justify-between text-xs text-[#252820]">
            <div>
              <span class="font-semibold block">Private Suite Massage</span>
              <span class="text-[11px] text-[#68685F]">Clean linens, natural aromatherapy, experienced therapists</span>
            </div>
            <span class="font-serif italic text-[#75816A] text-sm">Kerobokan &bull; Canggu</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 3. TRUST INDICATORS (HORIZONTAL ROW) -->
  <!-- ========================================== -->
  <section class="py-10 bg-[#EFE8DE] border-y border-[#E5DED3]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">
        
        <div class="flex items-center gap-3.5">
          <div class="w-9 h-9 rounded-full bg-white border border-[#E5DED3] flex items-center justify-center text-[#344B3D] flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
          </div>
          <div>
            <span class="block text-xs sm:text-sm font-semibold text-[#252820]" data-i18n="trust_1">Authentic Balinese Treatments</span>
          </div>
        </div>

        <div class="flex items-center gap-3.5">
          <div class="w-9 h-9 rounded-full bg-white border border-[#E5DED3] flex items-center justify-center text-[#344B3D] flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <div>
            <span class="block text-xs sm:text-sm font-semibold text-[#252820]" data-i18n="trust_2">Certified & Experienced Therapists</span>
          </div>
        </div>

        <div class="flex items-center gap-3.5">
          <div class="w-9 h-9 rounded-full bg-white border border-[#E5DED3] flex items-center justify-center text-[#344B3D] flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
          </div>
          <div>
            <span class="block text-xs sm:text-sm font-semibold text-[#252820]" data-i18n="trust_3">100% Pure Botanical Ingredients</span>
          </div>
        </div>

        <div class="flex items-center gap-3.5">
          <div class="w-9 h-9 rounded-full bg-white border border-[#E5DED3] flex items-center justify-center text-[#344B3D] flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
          </div>
          <div>
            <span class="block text-xs sm:text-sm font-semibold text-[#252820]" data-i18n="trust_4">Private, Clean & Quiet Suites</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 4. SPECIAL DEALS (EDITORIAL FOREST GREEN) -->
  <!-- ========================================== -->
  <section id="promotion" class="py-24 bg-[#26372F] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-16">
        <span class="text-xs font-semibold tracking-widest text-[#B58A59] uppercase block mb-2" data-i18n="deals_eyebrow">Curated Packages</span>
        <h2 class="font-serif section-headline text-white mb-3" data-i18n="deals_title">
          Special Spa Experiences
        </h2>
        <p class="text-white/70 text-sm sm:text-base font-light" data-i18n="deals_desc">
          Discover thoughtfully curated treatments and exclusive spa packages designed for profound relaxation.
        </p>
      </div>

      <!-- 3 Package Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Package 1: Boreh Spa & Facial -->
        <div class="bg-white text-[#252820] rounded-2xl overflow-hidden shadow-xl flex flex-col justify-between border border-[#E5DED3]">
          <div class="img-editorial-frame aspect-[16/10] w-full bg-[#EFE8DE]">
            <img src="assets/images/Menu-2018a.jpg" alt="Balinese Boreh Spa" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?auto=format&fit=crop&w=800&q=80';">
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between text-xs mb-2.5">
                <span class="text-[#75816A] font-semibold uppercase tracking-wider text-[11px]">1 Pax Ritual</span>
                <span class="text-[#68685F] font-mono text-[11px]">150 Mins (2.5 Hours)</span>
              </div>
              <h3 class="font-serif text-2xl font-semibold text-[#252820] mb-2 leading-snug">
                Balinese Boreh Spa ~ Hydrating Facial
              </h3>
              <p class="text-xs text-[#68685F] leading-relaxed mb-4">
                Traditional Balinese warming herbal Boreh wrap crafted from natural roots, herbs, and spices to relieve muscle ache and boost circulation, paired with an Australian Pevonia Botanica hydrating facial.
              </p>
            </div>
            <div class="pt-4 border-t border-[#E5DED3] flex items-center justify-between">
              <div>
                <span class="text-[10px] text-[#68685F] uppercase tracking-wider block font-medium">Nett Price</span>
                <span class="font-serif text-2xl font-bold text-[#344B3D]">Rp 750.000</span>
              </div>
              <button onclick="openBookingModal('1 Pax Balinese Boreh Spa ~ Hydrating Facial (2.5 Hours)')" class="btn-primary py-2 px-4 text-xs" data-i18n="deals_book_btn">
                Book Package
              </button>
            </div>
          </div>
        </div>

        <!-- Package 2: 2 Pax Signature 90 mins -->
        <div class="bg-white text-[#252820] rounded-2xl overflow-hidden shadow-xl flex flex-col justify-between border border-[#E5DED3]">
          <div class="img-editorial-frame aspect-[16/10] w-full bg-[#EFE8DE]">
            <img src="assets/images/n2.jpeg" alt="2 Pax Massaji Signature" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80';">
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between text-xs mb-2.5">
                <span class="text-[#75816A] font-semibold uppercase tracking-wider text-[11px]">Couples Special</span>
                <span class="text-[#68685F] font-mono text-[11px]">90 Mins (2 Guests)</span>
              </div>
              <h3 class="font-serif text-2xl font-semibold text-[#252820] mb-2 leading-snug">
                2 Pax Massaji Signature
              </h3>
              <div class="inline-block px-2.5 py-1 rounded-md bg-[#EFE8DE] text-[#344B3D] text-[11px] font-medium mb-3">
                Free: Pure cooling aloe vera ~ honey face mask
              </div>
              <p class="text-xs text-[#68685F] leading-relaxed mb-4">
                Massaji's signature massage developed over years by senior therapists, combining the world's finest modalities for profound full-body relaxation.
              </p>
            </div>
            <div class="pt-4 border-t border-[#E5DED3] flex items-center justify-between">
              <div>
                <span class="text-[10px] text-[#68685F] uppercase tracking-wider block font-medium">Nett Price (2 Pax)</span>
                <span class="font-serif text-2xl font-bold text-[#344B3D]">Rp 488.000</span>
              </div>
              <button onclick="openBookingModal('2 Pax Massaji Signature (90 Mins)')" class="btn-primary py-2 px-4 text-xs" data-i18n="deals_book_btn">
                Book Package
              </button>
            </div>
          </div>
        </div>

        <!-- Package 3: 2 Pax Balinese Massage 120 mins -->
        <div class="bg-white text-[#252820] rounded-2xl overflow-hidden shadow-xl flex flex-col justify-between border border-[#E5DED3]">
          <div class="img-editorial-frame aspect-[16/10] w-full bg-[#EFE8DE]">
            <img src="assets/images/gift voucher-2.jpg" alt="2 Pax Balinese Massage" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=800&q=80';">
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between text-xs mb-2.5">
                <span class="text-[#75816A] font-semibold uppercase tracking-wider text-[11px]">Couples Value</span>
                <span class="text-[#68685F] font-mono text-[11px]">120 Mins (2 Hours)</span>
              </div>
              <h3 class="font-serif text-2xl font-semibold text-[#252820] mb-2 leading-snug">
                2 Pax Balinese Massage
              </h3>
              <div class="inline-block px-2.5 py-1 rounded-md bg-[#EFE8DE] text-[#344B3D] text-[11px] font-medium mb-3">
                Free: Pure cooling aloe vera ~ honey face mask
              </div>
              <p class="text-xs text-[#68685F] leading-relaxed mb-4">
                Ancient art of traditional massage techniques bringing you to a state of serenity and deep relaxation through gentle stretches, acupressure, reflexology, and aromatherapy.
              </p>
            </div>
            <div class="pt-4 border-t border-[#E5DED3] flex items-center justify-between">
              <div>
                <span class="text-[10px] text-[#68685F] uppercase tracking-wider block font-medium">Nett Price (2 Pax)</span>
                <span class="font-serif text-2xl font-bold text-[#344B3D]">Rp 488.000</span>
              </div>
              <button onclick="openBookingModal('2 Pax Balinese Massage (120 Mins)')" class="btn-primary py-2 px-4 text-xs" data-i18n="deals_book_btn">
                Book Package
              </button>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 5. ABOUT MASSAJI SPA (EDITORIAL) -->
  <!-- ========================================== -->
  <section id="about" class="py-24 bg-white border-b border-[#E5DED3]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        
        <!-- Left: Authentic Spa Photography -->
        <div class="lg:col-span-5">
          <div class="img-editorial-frame aspect-[4/5] border border-[#E5DED3] shadow-md">
            <img src="assets/images/Wellness-Symbol.jpg" alt="Botanical Spa Healing Massaji Bali" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80';">
          </div>
        </div>

        <!-- Right: Editorial Brand Narrative -->
        <div class="lg:col-span-7 space-y-6">
          <span class="eyebrow-tag" data-i18n="about_eyebrow">About Massaji Spa</span>
          
          <h2 class="font-serif section-headline text-[#252820]">
            <span data-i18n="about_title_1">Rooted in Bali.</span> <br>
            <em class="italic font-normal text-[#75816A]" data-i18n="about_title_2">Created for Your Wellbeing.</em>
          </h2>

          <p class="text-[#68685F] text-base leading-relaxed font-light" data-i18n="about_desc_1">
            Nestled in a peaceful pocket of Kerobokan and Canggu, <strong>Massaji Spa</strong> was created to deliver authentic Balinese healing traditions with five-star cleanliness at honest, accessible prices.
          </p>

          <p class="text-[#68685F] text-base leading-relaxed font-light" data-i18n="about_desc_2">
            From warming traditional Balinese Boreh spice scrubs and Australian Pevonia botanical facials to certified prenatal therapy for mothers-to-be—our therapists tailor every pressure point to your body's individual needs.
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-[#E5DED3]">
            <div>
              <h4 class="font-semibold text-sm text-[#252820] mb-1" data-i18n="about_val_1">Pure Essential Oils</h4>
              <p class="text-xs text-[#68685F]" data-i18n="about_val_1_desc">Frangipani, lemongrass, lavender, and traditional natural spices.</p>
            </div>
            <div>
              <h4 class="font-semibold text-sm text-[#252820] mb-1" data-i18n="about_val_2">Absolute Hygiene</h4>
              <p class="text-xs text-[#68685F]" data-i18n="about_val_2_desc">Freshly laundered linens and towels for every single guest session.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 6. MENU & PRICING CATALOG -->
  <!-- ========================================== -->
  <section id="menu" class="py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    
    <div class="text-center max-w-3xl mx-auto mb-14">
      <span class="eyebrow-tag" data-i18n="menu_eyebrow">Treatment Catalog</span>
      <h2 class="font-serif section-headline text-[#252820] mt-2 mb-3" data-i18n="menu_title">
        Treatment Menu & Pricing
      </h2>
      <p class="text-[#68685F] text-base font-light" data-i18n="menu_desc">
        Transparent and budget-friendly pricing with no hidden charges in Canggu & Kerobokan.
      </p>

      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2 mt-8">
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-semibold tracking-wider uppercase transition border bg-[#344B3D] text-white border-[#344B3D] active" data-category="all">
          <span data-i18n="cat_all">All Treatments</span> (<?php echo count($menu); ?>)
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-semibold tracking-wider uppercase transition border bg-white text-[#68685F] border-[#E5DED3] hover:border-[#344B3D]" data-category="packages" data-i18n="cat_packages">
          Signature Packages
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-semibold tracking-wider uppercase transition border bg-white text-[#68685F] border-[#E5DED3] hover:border-[#344B3D]" data-category="massage" data-i18n="cat_massage">
          Body Massage
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-semibold tracking-wider uppercase transition border bg-white text-[#68685F] border-[#E5DED3] hover:border-[#344B3D]" data-category="beauty" data-i18n="cat_beauty">
          Facial & Scrub
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-semibold tracking-wider uppercase transition border bg-white text-[#68685F] border-[#E5DED3] hover:border-[#344B3D]" data-category="reflexology" data-i18n="cat_reflexology">
          Reflexology
        </button>
      </div>
    </div>

    <!-- Treatment Cards Grid (3 Columns Desktop, 2 Tablet, 1 Mobile) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="menu-cards-container">
      <?php foreach ($menu as $item): ?>
        <div class="treatment-card editorial-card p-6 flex flex-col justify-between" data-category="<?php echo htmlspecialchars($item['category'] ?? 'massage'); ?>">
          
          <div>
            <div class="flex items-center justify-between text-xs mb-3">
              <span class="text-[#75816A] font-bold uppercase tracking-wider text-[11px]">
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
              <span class="text-[#68685F] font-mono text-[11px] flex items-center gap-1 font-medium">
                <svg class="w-3.5 h-3.5 text-[#75816A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php echo htmlspecialchars($item['duration']); ?>
              </span>
            </div>

            <h3 class="font-serif text-2xl font-semibold text-[#252820] mb-2 leading-snug">
              <?php echo htmlspecialchars($item['name']); ?>
            </h3>

            <p class="text-[#68685F] text-xs sm:text-sm font-light leading-relaxed mb-6">
              <?php echo htmlspecialchars($item['description']); ?>
            </p>
          </div>

          <div class="pt-4 border-t border-[#E5DED3] flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#68685F] uppercase tracking-wider block font-medium" data-i18n="card_rate">Nett Price</span>
              <span class="font-serif text-2xl font-bold text-[#344B3D] font-mono">
                Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
              </span>
            </div>

            <button onclick="openBookingModal('<?php echo htmlspecialchars(addslashes($item['name'])); ?>')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>

        </div>
      <?php endforeach; ?>
    </div>

  </section>

  <!-- ========================================== -->
  <!-- 7. GUEST REVIEWS -->
  <!-- ========================================== -->
  <section id="reviews" class="py-24 bg-[#EFE8DE] border-y border-[#E5DED3]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="eyebrow-tag" data-i18n="reviews_eyebrow">Guest Testimonials</span>
        <h2 class="font-serif section-headline text-[#252820] mt-2 mb-3" data-i18n="reviews_title">
          Trusted by Travelers Across the Globe
        </h2>
        <div class="flex items-center justify-center gap-2 text-xs text-[#68685F]">
          <div class="flex text-amber-600 text-sm">★★★★★</div>
          <span class="font-semibold text-[#252820]">4.8 / 5.0</span>
          <span data-i18n="reviews_summary">based on 560+ verified reviews</span>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white border border-[#E5DED3] rounded-2xl p-7 shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex text-amber-600 mb-3 text-xs">★★★★★</div>
            <p class="text-[#252820] text-sm italic leading-relaxed">
              "Outstanding massage and remarkably clean, serene ambiance. We booked the 2-person 90-minute package and loved the complimentary chilled aloe vera face mask!"
            </p>
          </div>
          <div class="mt-6 pt-4 border-t border-[#E5DED3] flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#EFE8DE] text-[#344B3D] font-bold text-xs flex items-center justify-center">SL</div>
            <div>
              <span class="block text-xs font-bold text-[#252820]">Sarah L.</span>
              <span class="text-[11px] text-[#68685F]">Melbourne, Australia &bull; Massaji Signature</span>
            </div>
          </div>
        </div>

        <div class="bg-white border border-[#E5DED3] rounded-2xl p-7 shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex text-amber-600 mb-3 text-xs">★★★★★</div>
            <p class="text-[#252820] text-sm italic leading-relaxed">
              "The Boreh herbal therapy warmed my aching joints and relieved muscle tension instantly. The Pevonia facial left my skin glowing and deeply hydrated. Highly recommended!"
            </p>
          </div>
          <div class="mt-6 pt-4 border-t border-[#E5DED3] flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#EFE8DE] text-[#344B3D] font-bold text-xs flex items-center justify-center">DA</div>
            <div>
              <span class="block text-xs font-bold text-[#252820]">Dian Anggraini</span>
              <span class="text-[11px] text-[#68685F]">Jakarta, Indonesia &bull; Balinese Boreh & Facial</span>
            </div>
          </div>
        </div>

        <div class="bg-white border border-[#E5DED3] rounded-2xl p-7 shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex text-amber-600 mb-3 text-xs">★★★★★</div>
            <p class="text-[#252820] text-sm italic leading-relaxed">
              "Our favorite spa in Canggu! Five-star luxury experience at honest, reasonable rates. Clean AC rooms, delicious herbal ginger tea, and very responsive via WhatsApp."
            </p>
          </div>
          <div class="mt-6 pt-4 border-t border-[#E5DED3] flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#EFE8DE] text-[#344B3D] font-bold text-xs flex items-center justify-center">MK</div>
            <div>
              <span class="block text-xs font-bold text-[#252820]">Marc & Klara</span>
              <span class="text-[11px] text-[#68685F]">Germany &bull; 2 Pax Balinese Massage</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 8. LOCATION & CONTACT -->
  <!-- ========================================== -->
  <section id="contact" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <div class="lg:col-span-5 space-y-6">
        <span class="eyebrow-tag" data-i18n="contact_eyebrow">Visit Us</span>
        <h2 class="font-serif section-headline text-[#252820]" data-i18n="contact_title">
          Location & Opening Hours
        </h2>
        <p class="text-[#68685F] text-base font-light leading-relaxed" data-i18n="contact_desc">
          Conveniently located along the main Canggu / Kerobokan route with dedicated parking for scooters and cars.
        </p>

        <div class="space-y-4">
          <div class="p-4 rounded-xl bg-white border border-[#E5DED3] shadow-sm flex items-start gap-4">
            <div class="w-9 h-9 rounded-full bg-[#EFE8DE] text-[#344B3D] flex items-center justify-center flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
              <span class="block text-xs font-bold text-[#252820] uppercase tracking-wider" data-i18n="contact_address_label">Physical Address</span>
              <p class="text-xs sm:text-sm text-[#68685F] mt-0.5"><?php echo htmlspecialchars($settings['address']); ?></p>
              <a href="<?php echo htmlspecialchars($settings['google_maps_link']); ?>" target="_blank" class="text-xs text-[#344B3D] font-bold hover:underline mt-1.5 inline-block" data-i18n="contact_maps_link">
                Open Directions in Google Maps &rarr;
              </a>
            </div>
          </div>

          <div class="p-4 rounded-xl bg-white border border-[#E5DED3] shadow-sm flex items-start gap-4">
            <div class="w-9 h-9 rounded-full bg-[#EFE8DE] text-[#344B3D] flex items-center justify-center flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <span class="block text-xs font-bold text-[#252820] uppercase tracking-wider" data-i18n="contact_hours_label">Opening Hours</span>
              <p class="text-xs sm:text-sm text-[#68685F] mt-0.5 font-medium" data-i18n="contact_hours_val"><?php echo htmlspecialchars($settings['opening_hours']); ?></p>
            </div>
          </div>

          <div class="p-4 rounded-xl bg-white border border-[#E5DED3] shadow-sm flex items-start gap-4">
            <div class="w-9 h-9 rounded-full bg-[#EFE8DE] text-[#344B3D] flex items-center justify-center flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4 fill-current text-[#344B3D]" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </div>
            <div>
              <span class="block text-xs font-bold text-[#252820] uppercase tracking-wider" data-i18n="contact_chat_label">Instant Reservation</span>
              <a href="<?php echo $wa_url; ?>" target="_blank" class="text-xs sm:text-sm text-[#344B3D] font-bold hover:underline">
                WhatsApp: +<?php echo htmlspecialchars($clean_wa); ?>
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- Google Maps Frame -->
      <div class="lg:col-span-7 h-[380px] rounded-2xl overflow-hidden border border-[#E5DED3] shadow-sm relative bg-[#EFE8DE]">
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
  <!-- 9. FOOTER (DEEP FOREST GREEN) -->
  <!-- ========================================== -->
  <footer class="bg-[#26372F] text-white/70 pt-16 pb-24 lg:pb-16 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
        
        <div class="md:col-span-2 space-y-3">
          <div class="text-white font-serif text-2xl font-bold">
            <span>Massaji Spa Bali</span>
          </div>
          <p class="text-white/70 text-xs max-w-md leading-relaxed font-light">
            <?php echo htmlspecialchars($settings['tagline']); ?>. Authentic Balinese healing traditions, thoughtful treatments, and peaceful moments of relaxation in Canggu.
          </p>
          <div class="pt-2">
            <a href="<?php echo htmlspecialchars($settings['instagram']); ?>" target="_blank" class="text-[#B58A59] hover:text-white transition">
              Instagram: @massajispa
            </a>
          </div>
        </div>

        <div>
          <h4 class="font-bold text-white uppercase tracking-wider text-xs mb-3">Quick Links</h4>
          <ul class="space-y-2">
            <li><a href="#about" class="hover:text-white transition" data-i18n="nav_about">About Us</a></li>
            <li><a href="#promotion" class="hover:text-white transition" data-i18n="nav_deals">Special Deals</a></li>
            <li><a href="#menu" class="hover:text-white transition" data-i18n="nav_menu">Treatment Menu</a></li>
            <li><a href="#contact" class="hover:text-white transition" data-i18n="nav_contact">Location & Hours</a></li>
          </ul>
        </div>

        <div>
          <h4 class="font-bold text-white uppercase tracking-wider text-xs mb-3">Staff Management</h4>
          <p class="text-[11px] text-white/50 mb-2">Internal portal to update menu pricing, promotions, and contact info.</p>
          <a href="admin/login.php" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs transition">
            Staff Portal &rarr;
          </a>
        </div>

      </div>

      <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-white/50 text-[11px]">
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($settings['site_name']); ?>. All rights reserved.</p>
        <p>Contemporary Balinese Luxury Sanctuary</p>
      </div>
    </div>
  </footer>

  <!-- ========================================== -->
  <!-- 10. MOBILE STICKY BOTTOM BAR -->
  <!-- ========================================== -->
  <div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-[#E5DED3] p-3 flex items-center gap-2 shadow-2xl">
    <a href="<?php echo $wa_url; ?>" target="_blank" class="flex-1 py-3 px-3 rounded-lg border border-[#E5DED3] bg-[#F7F4EE] text-[#344B3D] font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-1.5 shadow-sm">
      <svg class="w-4 h-4 fill-current text-[#344B3D]" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
      <span data-i18n="mobile_btn_wa">WhatsApp</span>
    </a>
    <button onclick="openBookingModal()" class="flex-1 py-3 px-3 rounded-lg bg-[#344B3D] text-white font-bold text-xs tracking-wider uppercase text-center shadow" data-i18n="mobile_btn_book">
      Book Now
    </button>
  </div>

  <!-- ========================================== -->
  <!-- 11. MODAL: ONLINE RESERVATION -->
  <!-- ========================================== -->
  <div id="booking-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-[#F7F4EE] border border-[#E5DED3] rounded-2xl max-w-xl w-full p-6 sm:p-8 shadow-2xl relative max-h-[92vh] overflow-y-auto">
      
      <!-- Close Button -->
      <button id="modal-close-btn" class="absolute top-5 right-5 text-[#68685F] hover:text-[#252820] transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Booking Form View -->
      <div id="booking-form-container">
        <div class="mb-6">
          <span class="eyebrow-tag" data-i18n="modal_eyebrow">Direct Reservation</span>
          <h3 class="font-serif text-2xl sm:text-3xl font-semibold text-[#252820] mt-1" data-i18n="modal_title">Book Your Spa Treatment</h3>
          <p class="text-xs text-[#68685F] mt-1" data-i18n="modal_desc">Your booking inquiry will be sent directly to our reception email and formatted for instant WhatsApp confirmation.</p>
        </div>

        <div id="booking-error-msg" class="hidden mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs"></div>

        <form id="booking-form" class="space-y-4">
          
          <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#252820] mb-1" data-i18n="modal_label_name">Full Name *</label>
            <input type="text" name="name" required placeholder="e.g. Jessica Miller"
              class="w-full px-4 py-2.5 bg-white border border-[#E5DED3] rounded-lg text-sm text-[#252820] placeholder-[#68685F]/60 focus:border-[#344B3D] focus:outline-none">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold uppercase tracking-wider text-[#252820] mb-1" data-i18n="modal_label_phone">WhatsApp / Phone *</label>
              <input type="tel" name="phone" required placeholder="e.g. +62 812-xxxx-xxxx"
                class="w-full px-4 py-2.5 bg-white border border-[#E5DED3] rounded-lg text-sm text-[#252820] placeholder-[#68685F]/60 focus:border-[#344B3D] focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-semibold uppercase tracking-wider text-[#252820] mb-1" data-i18n="modal_label_email">Email Address</label>
              <input type="email" name="email" placeholder="name@email.com"
                class="w-full px-4 py-2.5 bg-white border border-[#E5DED3] rounded-lg text-sm text-[#252820] placeholder-[#68685F]/60 focus:border-[#344B3D] focus:outline-none">
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#252820] mb-1" data-i18n="modal_label_service">Select Treatment *</label>
            <select id="booking-service" name="service" required class="w-full px-4 py-2.5 bg-white border border-[#E5DED3] rounded-lg text-sm text-[#252820] focus:border-[#344B3D] focus:outline-none">
              <?php foreach ($menu as $m): ?>
                <option value="<?php echo htmlspecialchars($m['name']); ?>">
                  <?php echo htmlspecialchars($m['name']); ?> (Rp <?php echo number_format($m['price'], 0, ',', '.'); ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
              <label class="block text-xs font-semibold uppercase tracking-wider text-[#252820] mb-1" data-i18n="modal_label_date">Date *</label>
              <input type="date" id="booking-date" name="date" required
                class="w-full px-3 py-2.5 bg-white border border-[#E5DED3] rounded-lg text-xs text-[#252820] focus:border-[#344B3D] focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-semibold uppercase tracking-wider text-[#252820] mb-1" data-i18n="modal_label_time">Time Slot *</label>
              <select name="time" required class="w-full px-3 py-2.5 bg-white border border-[#E5DED3] rounded-lg text-xs text-[#252820] focus:border-[#344B3D] focus:outline-none">
                <option value="10:00">10:00 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="12:00">12:00 PM</option>
                <option value="13:00">01:00 PM</option>
                <option value="14:00">02:00 PM</option>
                <option value="15:00">03:00 PM</option>
                <option value="16:00">04:00 PM</option>
                <option value="17:00">05:00 PM</option>
                <option value="18:00">06:00 PM</option>
                <option value="19:00">07:00 PM</option>
                <option value="20:00">08:00 PM</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold uppercase tracking-wider text-[#252820] mb-1" data-i18n="modal_label_guests">Guests</label>
              <select name="guests" class="w-full px-3 py-2.5 bg-white border border-[#E5DED3] rounded-lg text-xs text-[#252820] focus:border-[#344B3D] focus:outline-none">
                <option value="1">1 Person</option>
                <option value="2">2 Persons (Couple)</option>
                <option value="3">3 Persons</option>
                <option value="4">4+ Persons</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#252820] mb-1" data-i18n="modal_label_notes">Special Requests (Optional)</label>
            <textarea name="notes" rows="2" placeholder="Pressure preference (soft/medium/strong), couple room request, etc."
              class="w-full px-4 py-2 bg-white border border-[#E5DED3] rounded-lg text-xs text-[#252820] placeholder-[#68685F]/60 focus:border-[#344B3D] focus:outline-none"></textarea>
          </div>

          <div class="pt-3">
            <button type="submit" id="booking-submit-btn" class="w-full btn-primary py-3" data-i18n="modal_submit">
              Submit Reservation Request
            </button>
          </div>

        </form>
      </div>

      <!-- Success Confirmation View -->
      <div id="booking-confirmation" class="hidden text-center py-6 space-y-5">
        <div class="w-16 h-16 rounded-full bg-[#EFE8DE] text-[#344B3D] mx-auto flex items-center justify-center">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>

        <div>
          <h4 class="font-serif text-3xl font-semibold text-[#252820]" data-i18n="modal_success_title">Reservation Received</h4>
          <p id="booking-summary-text" class="text-xs sm:text-sm text-[#68685F] mt-2 leading-relaxed px-4">
            Thank you! Your reservation details have been recorded.
          </p>
        </div>

        <div class="space-y-3 pt-2">
          <a id="wa-confirm-link" href="#" target="_blank" class="w-full btn-primary py-3 text-xs tracking-wider uppercase flex items-center justify-center gap-2" data-i18n="modal_btn_wa">
            Confirm Instantly on WhatsApp
          </a>

          <button onclick="closeBookingModal()" class="w-full btn-secondary py-2 text-xs" data-i18n="modal_btn_close">
            Close Window
          </button>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/main.js"></script>
</body>
</html>

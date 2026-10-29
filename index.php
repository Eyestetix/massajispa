<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Massaji Spa Bali — Authentic Balinese Massage &amp; Reflexology</title>
  <meta name="description" content="Massaji Spa Bali in Canggu &amp; Kerobokan. Authentic Balinese massage, herbal Boreh therapy, slimming RF, and luxury curated packages.">
  
  <!-- Fonts & Tailwind CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              skyBg: '#F0F8FF',
              mist: '#E1F0FE',
              navy: '#141E3C',
              royal: '#1E3A8A',
              royalDark: '#172554',
              sky: '#0284C7',
              border: '#BAE0FD'
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
<body class="text-[#141E3C] antialiased font-sans selection:bg-[#1E3A8A] selection:text-white">

  <!-- ========================================== -->
  <!-- 1. NAVIGATION HEADER -->
  <!-- ========================================== -->
  <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-[#BAE0FD] shadow-sm transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
      
      <!-- Brand Logo (Official Member-1 Logo with object-contain) -->
      <a href="index.html" class="flex items-center gap-3.5 group">
        <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-white shadow-sm border border-[#BAE0FD] p-1 group-hover:scale-105 transition duration-300">
          <img src="assets/images/member-1.png" alt="Massaji Spa Bali Logo" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='assets/images/member.png';">
        </div>
        <div>
          <div class="text-[10px] tracking-[0.2em] text-[#0284C7] font-bold uppercase leading-tight">マッサージ</div>
          <span class="font-serif text-2xl font-bold tracking-tight text-[#141E3C] block leading-none">Massaji <span class="font-normal italic text-[#0284C7]">Spa</span></span>
          <span class="text-[9px] uppercase tracking-widest text-[#475569] block mt-0.5">Canggu &bull; Bali</span>
        </div>
      </a>

      <!-- Desktop Navigation Menu (Order: Promo, Paket, Treatment Menu, About, Reviews, Contact) -->
      <nav class="hidden lg:flex items-center gap-7 text-[14px] font-semibold text-[#475569]">
        <a href="#promotion" class="hover:text-[#1E3A8A] text-[#1E3A8A] font-bold flex items-center gap-1.5 transition">
          <span class="w-2 h-2 rounded-full bg-[#0284C7] animate-pulse"></span>
          <span data-i18n="nav_promo">Promo</span>
        </a>
        <a href="#packages" class="hover:text-[#1E3A8A] transition" data-i18n="nav_packages">Paket Spa</a>
        <a href="#menu" class="hover:text-[#1E3A8A] transition" data-i18n="nav_menu">Treatment Menu</a>
        <a href="#about" class="hover:text-[#1E3A8A] transition" data-i18n="nav_about">About Us</a>
        <a href="#reviews" class="hover:text-[#1E3A8A] transition" data-i18n="nav_reviews">Reviews (4.8★)</a>
        <a href="#contact" class="hover:text-[#1E3A8A] transition" data-i18n="nav_contact">Location &amp; Hours</a>
      </nav>

      <!-- Header Actions (Bilingual Toggle + WhatsApp + Booking CTA) -->
      <div class="hidden sm:flex items-center gap-3.5">
        
        <!-- Language Switcher Toggle (ID / EN) -->
        <div class="inline-flex items-center p-0.5 bg-[#F0F8FF] rounded-lg border border-[#BAE0FD] text-[11px] font-bold">
          <button class="lang-btn px-2.5 py-1 rounded-md transition text-[#475569] hover:text-[#141E3C]" data-lang="id">ID</button>
          <button class="lang-btn px-2.5 py-1 rounded-md transition bg-[#1E3A8A] text-white" data-lang="en">EN</button>
        </div>

        <a href="https://wa.me/6281236695755?text=Hello%20Massaji Spa Bali%2C%20I%20would%20like%20to%20check%20availability%20for%20a%20spa%20treatment." target="_blank" class="px-3.5 py-2 rounded-lg border border-emerald-300 hover:border-emerald-600 bg-emerald-50/80 text-emerald-800 text-xs font-bold tracking-wider flex items-center gap-1.5 transition duration-200 shadow-sm">
          <svg class="w-3.5 h-3.5 fill-current text-emerald-600" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
          WhatsApp
        </a>
        <button onclick="openBookingModal()" class="btn-primary" data-i18n="nav_book">
          Book Treatment
        </button>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-btn" class="lg:hidden p-2 text-[#141E3C] hover:text-[#1E3A8A] focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>

    <!-- Mobile Dropdown Navigation -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-[#BAE0FD] px-6 py-6 space-y-4 shadow-xl">
      <div class="flex items-center justify-between pb-3 border-b border-[#BAE0FD]">
        <span class="text-xs font-bold text-[#475569] uppercase tracking-wider">Language / Bahasa:</span>
        <div class="inline-flex items-center p-0.5 bg-[#F0F8FF] rounded-lg border border-[#BAE0FD] text-xs font-bold">
          <button class="lang-btn px-3 py-1 rounded-md transition text-[#475569]" data-lang="id">ID</button>
          <button class="lang-btn px-3 py-1 rounded-md transition bg-[#1E3A8A] text-white" data-lang="en">EN</button>
        </div>
      </div>

      <a href="#promotion" class="block text-sm font-bold text-[#1E3A8A]" data-i18n="nav_promo">Promo</a>
      <a href="#packages" class="block text-sm font-semibold text-[#141E3C] hover:text-[#1E3A8A]" data-i18n="nav_packages">Paket Spa</a>
      <a href="#menu" class="block text-sm font-semibold text-[#141E3C] hover:text-[#1E3A8A]" data-i18n="nav_menu">Treatment Menu</a>
      <a href="#about" class="block text-sm font-semibold text-[#141E3C] hover:text-[#1E3A8A]" data-i18n="nav_about">About Us</a>
      <a href="#reviews" class="block text-sm font-semibold text-[#141E3C] hover:text-[#1E3A8A]" data-i18n="nav_reviews">Reviews (4.8★)</a>
      <a href="#contact" class="block text-sm font-semibold text-[#141E3C] hover:text-[#1E3A8A]" data-i18n="nav_contact">Location &amp; Hours</a>
      <div class="pt-4 border-t border-[#BAE0FD] flex flex-col gap-3">
        <button onclick="openBookingModal()" class="w-full py-3 rounded-lg bg-[#1E3A8A] text-white text-center font-bold text-xs tracking-wider uppercase shadow" data-i18n="nav_book">
          Book Treatment
        </button>
        <a href="https://wa.me/6281236695755?text=Hello%20Massaji Spa Bali%2C%20I%20would%20like%20to%20check%20availability%20for%20a%20spa%20treatment." target="_blank" class="w-full py-2.5 rounded-lg border border-emerald-500 bg-emerald-50 text-emerald-800 text-center font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-2">
          Chat on WhatsApp
        </a>
      </div>
    </div>
  </header>

  <!-- ========================================== -->
  <!-- 2. HERO SECTION -->
  <!-- ========================================== -->
  <section class="relative py-16 sm:py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
      
      <div class="lg:col-span-6 space-y-6 text-left">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-[#BAE0FD] text-[#0284C7] text-xs font-bold tracking-widest uppercase shadow-sm">
          <span class="w-2 h-2 rounded-full bg-[#0284C7] animate-ping"></span>
          <span data-i18n="hero_eyebrow">Boutique Wellness Sanctuary • Canggu, Bali</span>
        </div>
        
        <h1 class="font-serif hero-headline text-[#141E3C]">
          <span data-i18n="hero_title_1">Find Your Balance.</span> <br>
          <em class="italic font-normal text-[#0284C7]" data-i18n="hero_title_2">Rediscover Serenity.</em>
        </h1>

        <p class="text-[#475569] text-base sm:text-lg font-light leading-relaxed max-w-xl" data-i18n="hero_desc">
          Experience authentic Balinese healing rituals, thoughtful treatments, and peaceful moments of relaxation in the heart of Canggu.
        </p>

        <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
          <button onclick="openBookingModal()" class="btn-primary" data-i18n="hero_btn_book">
            Book Your Treatment
          </button>
          <a href="#packages" class="btn-secondary" data-i18n="hero_btn_explore">
            Explore Spa Packages
          </a>
        </div>

        <div class="pt-6 border-t border-[#BAE0FD] flex items-center gap-4 text-xs text-[#475569]">
          <div class="flex text-amber-500 tracking-tighter text-sm">★★★★★</div>
          <span class="font-bold text-[#141E3C]" data-i18n="stat_rating">4.8★ Verified Reviews</span>
          <span class="text-[#0284C7]">&bull;</span>
          <span data-i18n="stat_count">(560+ Guests in Canggu)</span>
        </div>
      </div>

      <div class="lg:col-span-6">
        <div class="img-editorial-frame aspect-[4/3] sm:aspect-[16/11] border-2 border-[#BAE0FD] shadow-xl">
          <img src="assets/images/massaji-hero.jpg" alt="Authentic Balinese Massage at Massaji Spa" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='assets/images/MASAGE.JPG';">
          <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent pointer-events-none"></div>
          <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-sm rounded-xl p-3.5 border border-[#BAE0FD] flex items-center justify-between text-xs text-[#141E3C]">
            <div>
              <span class="font-bold block">Private Suite Massage</span>
              <span class="text-[11px] text-[#475569]">Clean linens, natural aromatherapy, experienced therapists</span>
            </div>
            <span class="font-serif italic text-[#0284C7] font-semibold text-sm">Kerobokan &bull; Canggu</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 3. TRUST INDICATORS -->
  <!-- ========================================== -->
  <section class="py-10 bg-white/80 border-y border-[#BAE0FD]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">
        
        <div class="flex items-center gap-3.5">
          <div class="w-10 h-10 rounded-full bg-[#E1F0FE] border border-[#BAE0FD] flex items-center justify-center text-[#1E3A8A] flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
          </div>
          <div>
            <span class="block text-xs sm:text-sm font-bold text-[#141E3C]" data-i18n="trust_1">Authentic Balinese Treatments</span>
          </div>
        </div>

        <div class="flex items-center gap-3.5">
          <div class="w-10 h-10 rounded-full bg-[#E1F0FE] border border-[#BAE0FD] flex items-center justify-center text-[#1E3A8A] flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <div>
            <span class="block text-xs sm:text-sm font-bold text-[#141E3C]" data-i18n="trust_2">Certified &amp; Experienced Therapists</span>
          </div>
        </div>

        <div class="flex items-center gap-3.5">
          <div class="w-10 h-10 rounded-full bg-[#E1F0FE] border border-[#BAE0FD] flex items-center justify-center text-[#1E3A8A] flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
          </div>
          <div>
            <span class="block text-xs sm:text-sm font-bold text-[#141E3C]" data-i18n="trust_3">100% Pure Botanical Ingredients</span>
          </div>
        </div>

        <div class="flex items-center gap-3.5">
          <div class="w-10 h-10 rounded-full bg-[#E1F0FE] border border-[#BAE0FD] flex items-center justify-center text-[#1E3A8A] flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
          </div>
          <div>
            <span class="block text-xs sm:text-sm font-bold text-[#141E3C]" data-i18n="trust_4">Private, Clean &amp; Quiet Suites</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 4. SECTION 1: PROMO (MARCH 2026 PROMOTION) -->
  <!-- ========================================== -->
  <section id="promotion" class="py-24 bg-gradient-to-br from-[#141E3C] via-[#1E3A8A] to-[#141E3C] text-white relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#0284C7]/20 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      
      <div class="text-center max-w-2xl mx-auto mb-16">
        <span class="text-xs font-bold tracking-widest text-[#BAE0FD] uppercase block mb-2" data-i18n="promo_eyebrow">Limited-Time Special</span>
        <h2 class="font-serif section-headline text-white mb-3" data-i18n="promo_title">
          March 2026 Promotion
        </h2>
        <p class="text-sky-100/80 text-sm sm:text-base font-light" data-i18n="promo_desc">
          Exclusive discounts on our highly requested therapies. Reservation is required prior to your visit.
        </p>
      </div>

      <!-- 3 Promo Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-sky-300/30 flex flex-col justify-between hover:bg-white/15 transition duration-300 shadow-xl">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#BAE0FD] font-mono text-xs font-semibold">120 Mins</span>
              <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-[#0284C7] text-white">
                Save 35K
              </span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-white mb-2 leading-snug">
              Hot Stone Massage (Promo)
            </h3>
            <p class="text-xs sm:text-[13px] text-sky-100/80 leading-relaxed mb-6 font-light">
              Feel the warmth of smooth stones &amp; professional hands working deeply into your muscles to ease tightness and chronic joint pains. Sun-bathed volcano stones.
            </p>
          </div>
          <div class="pt-4 border-t border-sky-300/20 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-sky-200 uppercase tracking-wider block font-bold">Special Promo Rate</span>
              <div class="flex items-baseline">
                <span class="text-xs text-sky-200 line-through mr-2">Rp 390.000</span>
                <span class="font-serif text-2xl font-bold text-[#BAE0FD] font-mono">Rp 355.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Hot Stone Massage (Promo)')" class="px-4 py-2 rounded-lg bg-white text-[#141E3C] hover:bg-[#BAE0FD] transition font-bold text-xs tracking-wider uppercase shadow-md">
              Book Promo
            </button>
          </div>
        </div>

        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-sky-300/30 flex flex-col justify-between hover:bg-white/15 transition duration-300 shadow-xl">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#BAE0FD] font-mono text-xs font-semibold">120 Mins</span>
              <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-[#0284C7] text-white">
                Save 50K
              </span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-white mb-2 leading-snug">
              Anti Cellulite Treatment (Promo)
            </h3>
            <p class="text-xs sm:text-[13px] text-sky-100/80 leading-relaxed mb-6 font-light">
              Intensive version of cellulite massage with Grayatory Machine percussion. Includes Foot Bath, coffee scrub (15m), infrared wrap (15m), cellulite massage (45m), skin roller (15m), grayatory machine (30m).
            </p>
          </div>
          <div class="pt-4 border-t border-sky-300/20 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-sky-200 uppercase tracking-wider block font-bold">Special Promo Rate</span>
              <div class="flex items-baseline">
                <span class="text-xs text-sky-200 line-through mr-2">Rp 500.000</span>
                <span class="font-serif text-2xl font-bold text-[#BAE0FD] font-mono">Rp 450.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Anti Cellulite Treatment (Promo)')" class="px-4 py-2 rounded-lg bg-white text-[#141E3C] hover:bg-[#BAE0FD] transition font-bold text-xs tracking-wider uppercase shadow-md">
              Book Promo
            </button>
          </div>
        </div>

        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-sky-300/30 flex flex-col justify-between hover:bg-white/15 transition duration-300 shadow-xl">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#BAE0FD] font-mono text-xs font-semibold">15 Mins</span>
              <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-[#0284C7] text-white">
                Special Deal
              </span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-white mb-2 leading-snug">
              Hydrating Facial Mask (Promo)
            </h3>
            <p class="text-xs sm:text-[13px] text-sky-100/80 leading-relaxed mb-6 font-light">
              Enriched with hyaluronic acid, glycerin &amp; ceramides to deeply hydrate skin, soothe dryness, and improve texture.
            </p>
          </div>
          <div class="pt-4 border-t border-sky-300/20 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-sky-200 uppercase tracking-wider block font-bold">Special Promo Rate</span>
              <div class="flex items-baseline">
                <span class="text-xs text-sky-200 line-through mr-2">Rp 125.000</span>
                <span class="font-serif text-2xl font-bold text-[#BAE0FD] font-mono">Rp 100.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Hydrating Facial Mask (Promo)')" class="px-4 py-2 rounded-lg bg-white text-[#141E3C] hover:bg-[#BAE0FD] transition font-bold text-xs tracking-wider uppercase shadow-md">
              Book Promo
            </button>
          </div>
        </div>
      </div>

      <!-- Reservation Notice Bar -->
      <div class="mt-12 p-4 sm:p-5 rounded-2xl bg-white/5 border border-sky-300/20 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-sky-100">
        <div class="flex items-center gap-2.5">
          <svg class="w-5 h-5 text-[#BAE0FD] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span><strong>Reservation Terms:</strong> Valid throughout the month. Reservation is required prior to visit via WhatsApp or Website.</span>
        </div>
        <div class="flex items-center gap-3 font-mono font-bold text-white">
          <a href="tel:+6281236695755" class="hover:text-[#BAE0FD] transition">+62 812 3669 5755</a>
          <span>&bull;</span>
          <a href="tel:+628113857188" class="hover:text-[#BAE0FD] transition">+62 811 3857 188</a>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 5. SECTION 2: PAKET (CURATED SPA PACKAGES) -->
  <!-- ========================================== -->
  <section id="packages" class="py-24 bg-[#F0F8FF]/80 border-b border-[#BAE0FD]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-14">
        <span class="eyebrow-tag" data-i18n="packages_eyebrow">Curated Spa Rituals</span>
        <h2 class="font-serif section-headline text-[#141E3C] mt-2 mb-3">
          Spa <span class="text-[#0284C7] italic font-normal">Packages</span>
        </h2>
        <p class="text-[#475569] text-base font-light" data-i18n="packages_desc">
          Thoughtfully designed treatment combinations for singles, couples, and groups seeking profound rejuvenation in Bali.
        </p>

        <!-- Package Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mt-8">
          <button class="package-tab-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-[#1E3A8A] text-white border-[#1E3A8A] active shadow-sm" data-category="all">
            <span data-i18n="pkg_tab_all">All Packages</span> (11)
          </button>
          <button class="package-tab-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="packages-single" data-i18n="pkg_tab_single">
            Single Package (1 Person)
          </button>
          <button class="package-tab-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="packages-couple" data-i18n="pkg_tab_couple">
            Couple Package (2 Persons)
          </button>
          <button class="package-tab-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="packages-group" data-i18n="pkg_tab_group">
            Group Package (4 Persons)
          </button>
        </div>
      </div>

      <!-- Packages Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="packages-cards-container">

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-single">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Single Package (1 Person)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 Mins (1 Person)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Popular 1 Pax
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Oh! So Relax (Single Package)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Foot Bath, Full Balinese Body Massage, completed with Body Scrub to exfoliate dead skin cells. Choose your favourite Body Scrub scent.
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 335.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Oh! So Relax (Single Package)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-single">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Single Package (1 Person)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 Mins (1 Person)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Herbal Healing
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Traditional Healing Massage (Single Package)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Foot Bath, Full Balinese Body Massage (75 mins) completed with Balinese warm Boreh Body Mask (15 mins) using 100% herbal mixtures (Cloves, black cumin, neem, Ashitaba).
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 450.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Traditional Healing Massage (Single Package)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-single">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Single Package (1 Person)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                150 Mins (1 Person)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Signature 1 Pax
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Me, Myself &amp; Massaji (Single Package)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Foot bath, Massaji Signature Massage (90 mins), Hot Himalayan Salt Body Compress (15 mins), Sandalwood Body Mask (15 mins), Flower bath with aromatherapy (30 mins).
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 785.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Me, Myself &amp; Massaji (Single Package)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-single">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Single Package (1 Person)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                4 Hours (1 Person)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                4-Hour Luxury
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Forever Young Luxury Ritual (Single Package)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Footbath, Hot Stone Massage (90m), Body scrub (20m), Facial Massage &amp; Mask (45m), Basic Nail (60m), Flower bath (25m). FREE instant tightening mask, snack &amp; hot drink in bathtub.
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 1.000.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Forever Young Luxury Ritual (Single Package)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-couple">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Couple Package (2 Persons)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                105 Mins (2 Persons)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Best Value 2 Pax
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Simply Us (Couple Package)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Footbath, Balinese Body Massage (90 mins), Romantic Flower Bath with candle and aromatherapy (15 mins). Price for 2 persons.
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 700.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Simply Us (Couple Package)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-couple">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Couple Package (2 Persons)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins (2 Persons)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Deep Relaxation
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Jaen Sajan (Couple Package)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Footbath, Balinese Body Massage (90 mins), Hot Himalayan Salt Relaxing Body Compress (15 mins), Romantic Flower bath with aromatherapy (15 mins). Price for 2 persons.
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 900.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Jaen Sajan (Couple Package)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-couple">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Couple Package (2 Persons)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins (2 Persons)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Couple Glow
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Luh Muani (Couple Package)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Footbath, Swedish Body Massage (90 mins), Magnolia Mint Body Scrub (15 mins), Hydrating facial mask (15 mins), Romantic Flower bath with aromatherapy (15 mins). Price for 2 persons.
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 1.150.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Luh Muani (Couple Package)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-couple">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Couple Package (2 Persons)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                135 Mins (2 Persons)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Pure Rose
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Romantic Rose Bali Couple Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Infra Red Body Wrap (10 mins), Full Body Massage (75 mins), Rose Body Scrub (20 mins), Rose Body Mask (20 mins), Flower Bath and aromatherapy (15 mins). Fresh rose blended daily.
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 1.475.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Romantic Rose Bali Couple Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-couple">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Couple Package (2 Persons)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                150 Mins (2 Persons)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                VIP Sanctuary
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Jegeg Bali Lavender Couple Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              Infra Red Body Wrap (10 mins), Full Balinese Massage (75 mins), Lavender Body Scrub (20 mins), Lavender Body Mask (20 mins), Face Mask (10 mins), Flower Bath with aromatherapy (15 mins).
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 2.650.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Jegeg Bali Lavender Couple Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-group">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Group Package (4 Persons)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins (4 Persons)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Save 130K (4 Pax)
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Bali Bagus Package (Group 4 Pax)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              4 Pax Balinese Traditional Massage (120 mins). Ancient art of massage with gentle stretches, acupressure, reflexology and aromatherapy to bring 4 guests into profound serenity.
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                <span class="text-xs text-[#94A3B8] line-through mr-1.5">Rp 1.380.000</span>
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 1.250.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Bali Bagus Package (Group 4 Pax)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>

        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="packages-group">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Group Package (4 Persons)</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 Mins (4 Persons)
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Save 95K (4 Pax)
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              Bali Kuat Package (Group 4 Pax)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              2 Pax Deep Tissue Massage (90 mins) + 2 Pax Massaji Signature Massage (90 mins). Strong pressure and customized modalities for 4 guests.
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                <span class="text-xs text-[#94A3B8] line-through mr-1.5">Rp 1.420.000</span>
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 1.325.000</span>
              </div>
            </div>
            <button onclick="openBookingModal('Bali Kuat Package (Group 4 Pax)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 6. SECTION 3: TREATMENT MENU & PRICING -->
  <!-- ========================================== -->
  <section id="menu" class="py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    
    <div class="text-center max-w-3xl mx-auto mb-14">
      <span class="eyebrow-tag" data-i18n="menu_eyebrow">Full Spa Catalog</span>
      <h2 class="font-serif section-headline text-[#141E3C] mt-2 mb-3">
        Treatment Menu &amp; <span class="text-[#0284C7] italic font-normal">Pricing</span>
      </h2>
      <p class="text-[#475569] text-base font-light" data-i18n="menu_desc">
        Complete individual treatment menu with honest, transparent pricing in Canggu &amp; Kerobokan.
      </p>

      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2 mt-8">
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-[#1E3A8A] text-white border-[#1E3A8A] active shadow-sm" data-category="all">
          <span data-i18n="cat_all">All Treatments</span> (43)
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="massage" data-i18n="cat_massage">
          Body Massage
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="spa" data-i18n="cat_spa">
          Body Spa Treatments
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="slimming" data-i18n="cat_slimming">
          Slimming &amp; Cellulite
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="facial" data-i18n="cat_facial">
          Facial Treatments
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="nail" data-i18n="cat_nail">
          Nail Services
        </button>
        <button class="menu-filter-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wider uppercase transition border bg-white text-[#475569] border-[#BAE0FD] hover:border-[#1E3A8A]" data-category="additional" data-i18n="cat_additional">
          Additional Services
        </button>
      </div>
    </div>

    <!-- Treatment Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="menu-cards-container">

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                60 / 90 / 120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Signature Bali
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Medium, Strong)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Balinese Traditional Massage
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Ancient art of massage techniques to bring you to a state of serenity &amp; deep relaxation through gentle stretches, acupressure, reflexology and aromatherapy to stimulate blood circulation.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              60m: 215K | 90m: 285K | 120m: 345K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 215.000</span>
            </div>
            <button onclick="openBookingModal('Balinese Traditional Massage')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                60 / 90 / 120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Gentle Care
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Soft)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Swedish Relaxing Massage
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Scientific massage techniques based on western concepts of anatomy and physiology to aid with detoxing and breaking up muscle knots with long smooth gliding strokes.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              60m: 200K | 90m: 270K | 120m: 335K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 200.000</span>
            </div>
            <button onclick="openBookingModal('Swedish Relaxing Massage')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                60 / 90 / 120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Surfer Favorite
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Strong)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Deep Tissue / Sports Massage
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Designed to deliver firm pressure into inner layers of muscles and connective tissue, instantly relieving aching muscles, chronic joint pain, and stubborn tension.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              60m: 235K | 90m: 310K | 120m: 385K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 235.000</span>
            </div>
            <button onclick="openBookingModal('Deep Tissue / Sports Massage')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 / 120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Healing Warmth
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Soft, Medium)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Hot Stone Healing Massage
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Feel the warmth of smooth stones and professional hands working deeply into your muscles to ease muscle tightness and chronic joint pains. Volcano stones sun-bathed to stabilize energy.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              90m: 315K | 120m: 390K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 315.000</span>
            </div>
            <button onclick="openBookingModal('Hot Stone Healing Massage')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 / 120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Master Technique
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Strong, Flexible)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Massaji Signature Massage (Advance)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Developed over years combining the finest massage essence around the world (deep pressure, acupressure, folding massage). Performed exclusively by senior therapists.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              90m: 400K | 120m: 500K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 400.000</span>
            </div>
            <button onclick="openBookingModal('Massaji Signature Massage (Advance)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 / 120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Certified Care
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Soft, Medium)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Pre Natal (Pregnancy Massage)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Specially designed and customized for pregnant women and changing hormones. Helps relax tense muscles, ease sore spots, and improve circulation safely by senior therapists.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              90m: 375K | 120m: 450K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 375.000</span>
            </div>
            <button onclick="openBookingModal('Pre Natal (Pregnancy Massage)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                30 / 60 / 90 / 120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Vital Points
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Soft, Medium)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Foot Reflexology
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Ancient art of stimulating pressure points on feet corresponding to internal organs and glands to restore natural energy flow and equalized well-being throughout the body.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              30m: 135K | 60m: 185K | 90m: 235K | 120m: 285K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 135.000</span>
            </div>
            <button onclick="openBookingModal('Foot Reflexology')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                30 / 60 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Fast Relief
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Soft, Medium, Strong)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Head &amp; Shoulder Tension Relief
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Focuses on built-up stress and muscle tension in neck and shoulders. Helps relieve headaches, improve concentration, and encourage deep, restorative sleep.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              30m: 160K | 60m: 200K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 160.000</span>
            </div>
            <button onclick="openBookingModal('Head &amp; Shoulder Tension Relief')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                45 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Targeted
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Soft, Medium, Strong)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Focused Back Massage
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Developed from years of experience focusing on the back area only. Tailored specifically for busy travelers on the go and in a rush.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 200.000</span>
            </div>
            <button onclick="openBookingModal('Focused Back Massage')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                30 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Glow
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Soft, Gentle)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Acupressure Facial Massage
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Stimulates facial blood circulation, relaxes delicate facial muscles, and enhances skin elasticity for tension relief and a brighter complexion.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 150.000</span>
            </div>
            <button onclick="openBookingModal('Acupressure Facial Massage')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="massage">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Massage</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Contouring
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Medium, Strong)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Cellulite Massage with Machine
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Focus on Thigh, Buttock, or Arm. Deep tissue manipulation, kneading &amp; skin rolling (60m) combined with percussion Gryatory machine (30m) to break down fat deposits and improve lymphatic drainage.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 350.000</span>
            </div>
            <button onclick="openBookingModal('Cellulite Massage with Machine')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="slimming">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Slimming & Cellulite</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Full Protocol
              </span>
              <span class="text-[10px] text-[#64748B] italic ml-1 font-sans">(Medium, Strong)</span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Anti Cellulite Full Treatment
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Focus: Thigh or Buttock. Includes Foot Bath, coffee body scrub (15m), infrared body wrap (15m), cellulite massage (45m), skin roller (15m), and Grayatory percussion machine (30m). Free coffee scrub on affected area.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 500.000</span>
            </div>
            <button onclick="openBookingModal('Anti Cellulite Full Treatment')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="slimming">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Slimming & Cellulite</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                135 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Cavitation RF
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Body Slimming Cavitation RF (Arm)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Radio frequency cavitation generates heat in deep skin layers to stimulate collagen, elastin, and break down fat cells for arm contouring. FREE coffee body scrub included.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 700.000</span>
            </div>
            <button onclick="openBookingModal('Body Slimming Cavitation RF (Arm)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="slimming">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Slimming & Cellulite</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                135 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Cavitation RF
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Body Slimming Cavitation RF (Thigh)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Targeted RF slimming for thighs to break down stubborn fat cells, tone skin, and improve contour. Includes complimentary coffee body scrub for enhanced absorption.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 850.000</span>
            </div>
            <button onclick="openBookingModal('Body Slimming Cavitation RF (Thigh)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="slimming">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Slimming & Cellulite</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                135 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Best Slimming
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Body Slimming Cavitation RF (Tummy)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Intensive abdominal cavitation RF treatment to reduce stubborn tummy fat and tighten skin tissue. Includes complimentary coffee body scrub.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 900.000</span>
            </div>
            <button onclick="openBookingModal('Body Slimming Cavitation RF (Tummy)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="spa">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Spa Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Sun Soothing
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Aloe Vera Body Treatment Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Pure aloe vera and honey remedy. Includes Foot Bath + Balinese Massage (75m), Aloe vera body mask (15m), and Aloe vera facial treatment (30m) to soothe and deeply hydrate sun-exposed skin.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 500.000</span>
            </div>
            <button onclick="openBookingModal('Aloe Vera Body Treatment Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="spa">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Spa Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Authentic Ritual
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Balinese Boreh Warming Herbal Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Fresh herbs daily blended. Foot bath, Traditional Balinese Massage (75m), warming Balinese Boreh scrub (30m), and Flower Bath with Bali Jasmine salt (15m) to relieve joint and muscle soreness.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 600.000</span>
            </div>
            <button onclick="openBookingModal('Balinese Boreh Warming Herbal Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="spa">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Spa Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Antioxidant
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Green Tea &amp; Matcha Detox Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Pure matcha &amp; green tea antioxidants. Foot Bath + Balinese Massage (75m), Green Tea scrub (20m), Hot Himalayan Salt &amp; Flower back compress (10m), Flower Bath with aromatherapy (15m).
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 675.000</span>
            </div>
            <button onclick="openBookingModal('Green Tea &amp; Matcha Detox Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="spa">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Spa Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Botanical Rose
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Rose Bali Anti-Aging Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Rich in vitamins A &amp; C. Foot bath, Full body Massage (60m), Rose scrub (25m), Rose Body Mask (20m), Flower bath with aromatherapy (15m) to smooth skin and boost natural collagen.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 725.000</span>
            </div>
            <button onclick="openBookingModal('Rose Bali Anti-Aging Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="spa">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Spa Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Special Ingredient
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Refreshing Pear Vanilla Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Natural antioxidant with pure vanilla extract &amp; Vitamin B. Foot bath, Balinese Massage (75m), Pear &amp; Vanilla Body Scrub (15m), Body Mask (15m), Flower bath with aromatherapy (15m).
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 875.000</span>
            </div>
            <button onclick="openBookingModal('Refreshing Pear Vanilla Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="spa">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Spa Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                150 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Special Ingredient
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Magnolia &amp; Mint Body Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Magnolia bark &amp; flower reduces anxiety and tension. Footbath, Infrared detox wrap (15m), Facial Massage (15m), Balinese Massage (75m), Magnolia &amp; mint scrub (20m), mask (15m), Flower Bath (25m).
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 850.000</span>
            </div>
            <button onclick="openBookingModal('Magnolia &amp; Mint Body Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="spa">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Spa Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                150 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Special Ingredient
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Sandalwood &amp; Turmeric Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Iconic woody sandalwood calming aroma and pure active curcumin turmeric. Foot Bath, Infrared wrap (15m), Facial Massage (15m), Balinese Massage (75m), Scrub (20m), Mask (15m), Flower Bath (25m).
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 875.000</span>
            </div>
            <button onclick="openBookingModal('Sandalwood &amp; Turmeric Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="spa">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Body Spa Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                150 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Special Ingredient
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Lavender Rosemary Mint Body Spa
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Pure lavender and natural rosemary analgesic. Foot Bath, Infrared wrap (15m), Facial Massage (15m), Balinese Massage (75m), Rosemary Scrub (20m), Lavender Mask (15m), Flower Bath (25m).
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 900.000</span>
            </div>
            <button onclick="openBookingModal('Lavender Rosemary Mint Body Spa')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="facial">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Facial Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                60 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Pure Botanical
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Biokos Botanical Facial (60 Mins)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Facial Cleansing, Facial Acupressure Massage, Facial Scrub, and nourishing Botanical Facial Mask.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 350.000</span>
            </div>
            <button onclick="openBookingModal('Biokos Botanical Facial (60 Mins)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="facial">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Facial Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Deluxe Glow
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Biokos Deluxe Facial (90 Mins)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Face Cleansing, Facial Massage, Scrub, Mask, combined with relaxing Head &amp; Shoulder Massage (30 mins).
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 450.000</span>
            </div>
            <button onclick="openBookingModal('Biokos Deluxe Facial (90 Mins)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="facial">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Facial Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                120 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Deep Cleanse
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Biokos Ultimate Deep Facial (120 Mins)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Face Cleansing, Face Massage, Scrub, Mask, Face Steam, Facial Extraction, and relaxing Head &amp; Shoulder Massage (30 mins).
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 575.000</span>
            </div>
            <button onclick="openBookingModal('Biokos Ultimate Deep Facial (120 Mins)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="facial">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Facial Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                10 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Clinical Add-on
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Hi-Frequency Machine with Violet Rays
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Safe electrical currents to oxygenate skin, eliminate acne-causing bacteria, reduce inflammation, tighten pores, and boost collagen.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 125.000</span>
            </div>
            <button onclick="openBookingModal('Hi-Frequency Machine with Violet Rays')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="facial">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Facial Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                10 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Clinical Add-on
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Cold Light LED Facial Therapy
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Specific LED wavelengths combined with cold compress technology to soothe, tighten pores, boost collagen, and accelerate deep serum absorption.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 125.000</span>
            </div>
            <button onclick="openBookingModal('Cold Light LED Facial Therapy')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="facial">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Facial Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                15 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Anti-Aging RF
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              RF Facial Machine for Wrinkle (Face Iron)
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Non-surgical radio frequency skin treatment heating deep layers to stimulate collagen and elastin for firmer, smoother skin and contoured facial lines.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 275.000</span>
            </div>
            <button onclick="openBookingModal('RF Facial Machine for Wrinkle (Face Iron)')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="facial">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Facial Treatment</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                15 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Detox Mask
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Instant Firming Kaolin Mask
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Kaolin clay mask absorbs excess oil, detoxifies pores, reduces acne, soothes redness, and tightens facial contours.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 150.000</span>
            </div>
            <button onclick="openBookingModal('Instant Firming Kaolin Mask')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="nail">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Nail Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Complete Care
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Deluxe Hands Spa with Nail Gel
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Nail Cutting, Nail Shaping, Cuticle Grooming, Hand Soak, Hand Scrub, Hand Mask, Hand Massage, and long-lasting Nail Gel polish.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 350.000</span>
            </div>
            <button onclick="openBookingModal('Deluxe Hands Spa with Nail Gel')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="nail">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Nail Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                90 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Complete Care
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Deluxe Foot Spa with Nail Gel
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Nail Cutting, Shaping, Cuticle Grooming, Foot Soak, Callus Removal, Foot Scrub, Hand Mask, Calf Massage, and Nail Gel polish.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 350.000</span>
            </div>
            <button onclick="openBookingModal('Deluxe Foot Spa with Nail Gel')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="nail">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Nail Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                60 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Essentials
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Basic Nail Hand or Foot with Gel
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Nail Cutting, Nail Shaping, Cuticle Grooming, and Basic Nail Gel application.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              Nail Hand: 150K | Foot: 150K
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 150.000</span>
            </div>
            <button onclick="openBookingModal('Basic Nail Hand or Foot with Gel')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="nail">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Nail Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                60 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Smooth Heels
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Dr. Feeto Callus Removal Treatment
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Fast and efficient treatment removing calluses and cracked heels for velvety smooth, soft, and beautiful feet.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 225.000</span>
            </div>
            <button onclick="openBookingModal('Dr. Feeto Callus Removal Treatment')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="nail">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Nail Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Service Add-on
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Art &amp; Removal
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Nail Gel Remover &amp; Custom Art
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Professional nail gel removal, French Nail Gel, Cat Eye Gel, Marble Design, and Aurora chrome nail art.
            </p>
            
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              Gel Remover: 100K | French/Cat Eye/Aurora: 10K/nail | Marble: 15K/nail
            </div>
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 100.000</span>
            </div>
            <button onclick="openBookingModal('Nail Gel Remover &amp; Custom Art')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="additional">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Additional Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                30 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Self Care
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Flower Bath with Aromatherapy
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Indulge yourself with fresh exotic flower petals, soothing aromatherapy, and mineral salt soak after any spa session.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 175.000</span>
            </div>
            <button onclick="openBookingModal('Flower Bath with Aromatherapy')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="additional">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Additional Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                30 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Exfoliation
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Homemade Oatmeal &amp; Rice Body Scrub
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Oatmeal &amp; rice powder exfoliates dead skin cells, prevents ingrown hair, and improves hydration. Choose your favourite scent.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 150.000</span>
            </div>
            <button onclick="openBookingModal('Homemade Oatmeal &amp; Rice Body Scrub')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="additional">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Additional Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                30 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Soothe
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Calming Oatmeal Body Mask
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Calms skin irritation, reduces redness, ideal for sensitive and sun-damaged skin, leaving it soft and supple.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 150.000</span>
            </div>
            <button onclick="openBookingModal('Calming Oatmeal Body Mask')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="additional">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Additional Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                15 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Mineral Heat
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Hot Himalayan Salt &amp; Flower Compress
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Rich in mineral traces (iron, potassium, magnesium) to soothe deep muscle tension and muscle cramps on legs, shoulders &amp; back.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 100.000</span>
            </div>
            <button onclick="openBookingModal('Hot Himalayan Salt &amp; Flower Compress')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="additional">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Additional Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                30 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Infrared
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Detoxifying Infra Red Body Wrap
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Deep penetrating infrared heat promotes sweating, detoxification, calorie burning, and temporary joint/muscle pain relief.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 125.000</span>
            </div>
            <button onclick="openBookingModal('Detoxifying Infra Red Body Wrap')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="additional">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Additional Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                15 Mins
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Hydration
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Hydrating Facial Mask Add-on
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Hyaluronic acid, glycerin &amp; ceramides to soothe dryness, lock in moisture, and restore skin suppleness.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 125.000</span>
            </div>
            <button onclick="openBookingModal('Hydrating Facial Mask Add-on')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="additional">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Additional Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Custom Treatment
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Gift Card
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Exclusive Spa Gift Voucher Card
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              The ideal gift for your special one. We provide a luxury gift voucher card with any treatment chosen from our menu.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 40.000</span>
            </div>
            <button onclick="openBookingModal('Exclusive Spa Gift Voucher Card')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>

        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="additional">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">Additional Service</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Romantic Add-on
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                Celebration
              </span>
              
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              Birthday / Anniversary Surprise Package
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              Sweet memorable surprise setup: Simple flower bouquet, romantic candles around bathtub, aromatherapy flower bath, and mini birthday cake.
            </p>
            
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp 425.000</span>
            </div>
            <button onclick="openBookingModal('Birthday / Anniversary Surprise Package')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>
    </div>

  </section>

  <!-- ========================================== -->
  <!-- 7. SECTION 4: ABOUT US -->
  <!-- ========================================== -->
  <section id="about" class="py-24 bg-white/90 border-y border-[#BAE0FD]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        
        <!-- Left: Authentic Spa Photography with Reception Image Slot -->
        <div class="lg:col-span-5">
          <div class="img-editorial-frame aspect-[4/5] border border-[#BAE0FD] shadow-lg">
            <img src="assets/images/massaji-about.jpg" alt="Massaji Spa Bali Sanctuary &amp; Reception" class="w-full h-full object-cover" onerror="if (!this.triedPng) { this.triedPng = true; this.src = 'assets/images/massaji-reception.jpg'; } else if (!this.triedRaw) { this.triedRaw = true; this.src = 'assets/images/18BB6F9B-4ACE-49DF-9AE1-610D3B65BA60.png'; } else { this.onerror = null; this.src = 'assets/images/gambar2.jpg'; }">
          </div>
        </div>

        <!-- Right: Editorial Brand Narrative -->
        <div class="lg:col-span-7 space-y-6">
          <span class="eyebrow-tag" data-i18n="about_eyebrow">About Massaji Spa</span>
          
          <h2 class="font-serif section-headline text-[#141E3C]">
            <span data-i18n="about_title_1">Rooted in Bali.</span> <br>
            <em class="italic font-normal text-[#0284C7]" data-i18n="about_title_2">Created for Your Wellbeing.</em>
          </h2>

          <p class="text-[#475569] text-base leading-relaxed font-light" data-i18n="about_desc_1">
            Nestled in a peaceful pocket of Kerobokan and Canggu, <strong>Massaji Spa</strong> was created to deliver authentic Balinese healing traditions with five-star cleanliness at honest, accessible prices.
          </p>

          <p class="text-[#475569] text-base leading-relaxed font-light" data-i18n="about_desc_2">
            From warming traditional Balinese Boreh spice wraps and slimming RF cavitation to certified prenatal therapy for mothers-to-be—our experienced therapists tailor every pressure point to your body's individual needs.
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-[#BAE0FD]">
            <div>
              <h4 class="font-bold text-sm text-[#141E3C] mb-1" data-i18n="about_val_1">Pure Essential Oils</h4>
              <p class="text-xs text-[#475569]" data-i18n="about_val_1_desc">Frangipani, lemongrass, lavender, and traditional natural spices.</p>
            </div>
            <div>
              <h4 class="font-bold text-sm text-[#141E3C] mb-1" data-i18n="about_val_2">Absolute Hygiene</h4>
              <p class="text-xs text-[#475569]" data-i18n="about_val_2_desc">Freshly laundered linens and towels for every single guest session.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 8. SECTION 5: REVIEWS / TESTIMONIALS -->
  <!-- ========================================== -->
  <section id="reviews" class="py-24 bg-[#F0F8FF]/80 border-b border-[#BAE0FD]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-16">
        <span class="eyebrow-tag" data-i18n="reviews_eyebrow">Guest Testimonials</span>
        <h2 class="font-serif section-headline text-[#141E3C] mt-2 mb-3" data-i18n="reviews_title">
          Trusted by Travelers Across the Globe
        </h2>
        <p class="text-[#475569] text-sm sm:text-base font-light" data-i18n="reviews_summary">
          4.8 out of 5.0 based on 560+ verified reviews in Canggu &amp; Kerobokan.
        </p>
      </div>

      <!-- Review Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="treatment-card p-6 flex flex-col justify-between">
          <div>
            <div class="flex text-amber-500 text-sm mb-3">★★★★★</div>
            <p class="text-xs sm:text-sm text-[#475569] leading-relaxed mb-6 font-light italic">
              "The 2-Hour Balinese Massage here is hands down the best massage I've experienced in Bali. Super clean rooms, calming scent, and therapists who truly understand pressure points."
            </p>
          </div>
          <div class="pt-4 border-t border-[#BAE0FD] flex items-center justify-between text-xs">
            <span class="font-bold text-[#141E3C]">Sarah &amp; Mark T.</span>
            <span class="text-[#64748B]">Melbourne, Australia</span>
          </div>
        </div>

        <div class="treatment-card p-6 flex flex-col justify-between">
          <div>
            <div class="flex text-amber-500 text-sm mb-3">★★★★★</div>
            <p class="text-xs sm:text-sm text-[#475569] leading-relaxed mb-6 font-light italic">
              "We booked the Simply Us couple package and it was pure bliss! The romantic flower bath and massage were extraordinary. Highly recommended when visiting Canggu!"
            </p>
          </div>
          <div class="pt-4 border-t border-[#BAE0FD] flex items-center justify-between text-xs">
            <span class="font-bold text-[#141E3C]">Chloe L.</span>
            <span class="text-[#64748B]">London, UK</span>
          </div>
        </div>

        <div class="treatment-card p-6 flex flex-col justify-between">
          <div>
            <div class="flex text-amber-500 text-sm mb-3">★★★★★</div>
            <p class="text-xs sm:text-sm text-[#475569] leading-relaxed mb-6 font-light italic">
              "As a regular surfer in Canggu, their Deep Tissue and Hot Stone massage solved all my shoulder stiffness. Honest prices, incredible technique, five-star cleanliness."
            </p>
          </div>
          <div class="pt-4 border-t border-[#BAE0FD] flex items-center justify-between text-xs">
            <span class="font-bold text-[#141E3C]">Alexandre D.</span>
            <span class="text-[#64748B]">Biarritz, France</span>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 9. SECTION 6: LOCATION & CONTACT -->
  <!-- ========================================== -->
  <section id="contact" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <!-- Contact Details -->
      <div class="lg:col-span-5 space-y-6">
        <span class="eyebrow-tag" data-i18n="contact_eyebrow">Visit Us</span>
        
        <h2 class="font-serif section-headline text-[#141E3C]" data-i18n="contact_title">
          Location &amp; Opening Hours
        </h2>

        <p class="text-[#475569] text-base font-light leading-relaxed" data-i18n="contact_desc">
          Conveniently located along the main Canggu / Kerobokan route with dedicated parking for scooters and cars.
        </p>

        <div class="space-y-4 pt-2 text-sm text-[#475569]">
          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#E1F0FE] flex items-center justify-center text-[#1E3A8A] flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
              <span class="font-bold text-[#141E3C] block" data-i18n="contact_address_label">Physical Address</span>
              <span>Jl. Raya Canggu, Gg. Bedugul No. 3, Kerobokan, Canggu, Bali 80361</span>
              <a href="https://maps.google.com/?q=Massaji+Spa+Bali+Canggu" target="_blank" class="block text-[#0284C7] font-semibold text-xs mt-1 hover:underline" data-i18n="contact_maps_link">
                Open Directions in Google Maps &rarr;
              </a>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#E1F0FE] flex items-center justify-center text-[#1E3A8A] flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <span class="font-bold text-[#141E3C] block" data-i18n="contact_hours_label">Opening Hours</span>
              <span data-i18n="contact_hours_val">Daily: 10:00 AM – 9:00 PM WITA</span>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-800 flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4 fill-current text-emerald-700" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </div>
            <div>
              <span class="font-bold text-[#141E3C] block" data-i18n="contact_chat_label">Instant Reservation</span>
              <a href="https://wa.me/6281236695755?text=Hello%20Massaji Spa Bali%2C%20I%20would%20like%20to%20check%20availability%20for%20a%20spa%20treatment." target="_blank" class="text-emerald-800 font-bold hover:underline">
                +62 812-3669-5755 (WhatsApp Direct)
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Map Embed -->
      <div class="lg:col-span-7">
        <div class="img-editorial-frame aspect-[16/10] border border-[#BAE0FD] shadow-lg overflow-hidden">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.3828987349144!2d115.1582239!3d-8.6548777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd239274213197b%3A0xb3e5d3c8c7efc0c0!2sMassaji%20Spa!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            class="w-full h-full grayscale-[20%] contrast-[1.05]">
          </iframe>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 10. FOOTER -->
  <!-- ========================================== -->
  <footer class="bg-[#141E3C] text-white/70 pt-16 pb-24 lg:pb-16 text-xs border-t border-[#BAE0FD]/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-white/10">
        
        <!-- Brand Info -->
        <div class="space-y-4 md:col-span-1">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-white p-1 overflow-hidden border border-[#BAE0FD]">
              <img src="assets/images/member-1.png" alt="Massaji Spa" class="w-full h-full object-contain">
            </div>
            <div>
              <span class="font-serif text-xl font-bold text-white block">Massaji <span class="text-[#BAE0FD] font-normal italic">Spa</span></span>
              <span class="text-[9px] uppercase tracking-widest text-sky-200 block">Canggu &bull; Bali</span>
            </div>
          </div>
          <p class="text-white/60 leading-relaxed font-light">
            Authentic Balinese Massage, Curated Spa Packages &amp; Holistic Wellness Sanctuary in Kerobokan and Canggu.
          </p>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-[11px]">Explore</h4>
          <ul class="space-y-2.5 font-light">
            <li><a href="#promotion" class="hover:text-white transition" data-i18n="nav_promo">Special Promo</a></li>
            <li><a href="#packages" class="hover:text-white transition" data-i18n="nav_packages">Spa Packages</a></li>
            <li><a href="#menu" class="hover:text-white transition" data-i18n="nav_menu">Treatment Menu</a></li>
            <li><a href="#about" class="hover:text-white transition" data-i18n="nav_about">About Us</a></li>
            <li><a href="#reviews" class="hover:text-white transition" data-i18n="nav_reviews">Guest Reviews</a></li>
          </ul>
        </div>

        <!-- Operating Hours -->
        <div>
          <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-[11px]">Visiting Hours</h4>
          <p class="text-white/80 font-medium mb-1">Open Every Day</p>
          <p class="text-white/60 mb-3">10:00 AM – 9:00 PM WITA</p>
          <p class="text-white/60 text-[11px]">Prior booking via WhatsApp is recommended to secure your preferred private treatment suite.</p>
        </div>

        <!-- Admin & Direct Reservation -->
        <div>
          <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-[11px]">Direct Contact</h4>
          <p class="text-white/80 mb-2">WhatsApp: +62 812-3669-5755</p>
          <p class="text-white/80 mb-4">Phone: +62 811-3857-188</p>
          <a href="admin/" class="inline-flex items-center gap-1.5 text-[11px] text-[#BAE0FD] hover:underline font-semibold">
            <span>Staff / Admin Portal &rarr;</span>
          </a>
        </div>

      </div>

      <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-white/50 text-[11px] gap-4">
        <p>&copy; 2026 Massaji Spa Bali. All rights reserved.</p>
        <p>Jl. Raya Canggu, Gg. Bedugul No. 3, Kerobokan, Bali 80361</p>
      </div>
    </div>
  </footer>

  <!-- ========================================== -->
  <!-- 11. INTERACTIVE BOOKING MODAL -->
  <!-- ========================================== -->
  <div id="booking-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-[#BAE0FD] relative my-8">
      
      <!-- Close Button -->
      <button id="modal-close-btn" class="absolute top-5 right-5 p-2 rounded-full text-[#475569] hover:text-[#141E3C] hover:bg-[#F0F8FF] transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Booking Form -->
      <form id="booking-form" class="space-y-4">
        <div>
          <span class="text-[10px] font-bold uppercase tracking-widest text-[#0284C7] block mb-1" data-i18n="modal_eyebrow">Direct Reservation</span>
          <h3 class="font-serif text-2xl sm:text-3xl font-bold text-[#141E3C]" data-i18n="modal_title">Book Your Spa Treatment</h3>
          <p class="text-xs text-[#475569] mt-1 font-light" data-i18n="modal_desc">
            Your booking inquiry will be sent directly to our reception email and formatted for instant WhatsApp confirmation.
          </p>
        </div>

        <div class="space-y-3 pt-2">
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_name">Full Name *</label>
            <input type="text" name="name" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#BAE0FD] text-sm focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] bg-[#F0F8FF]/30" placeholder="e.g. Sarah Jenkins">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_phone">WhatsApp / Phone *</label>
              <input type="tel" name="phone" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#BAE0FD] text-sm focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] bg-[#F0F8FF]/30" placeholder="+61 400 000 000">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_email">Email Address</label>
              <input type="email" name="email" class="w-full px-3.5 py-2.5 rounded-xl border border-[#BAE0FD] text-sm focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] bg-[#F0F8FF]/30" placeholder="sarah@example.com">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_service">Select Treatment / Package *</label>
            <select name="service" id="booking-service" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#BAE0FD] text-sm focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] bg-white">
              <optgroup label="Special Monthly Promotions">
                <option value="Hot Stone Massage (Promo)">Hot Stone Massage (Promo) (Rp 355.000)</option>
                <option value="Anti Cellulite Treatment (Promo)">Anti Cellulite Treatment (Promo) (Rp 450.000)</option>
                <option value="Hydrating Facial Mask (Promo)">Hydrating Facial Mask (Promo) (Rp 100.000)</option>
              </optgroup>
              <optgroup label="Single Packages (1 Person)">
                <option value="Oh! So Relax (Single Package)">Oh! So Relax (Single Package) (Rp 335.000)</option>
                <option value="Traditional Healing Massage (Single Package)">Traditional Healing Massage (Single Package) (Rp 450.000)</option>
                <option value="Me, Myself &amp; Massaji (Single Package)">Me, Myself &amp; Massaji (Single Package) (Rp 785.000)</option>
                <option value="Forever Young Luxury Ritual (Single Package)">Forever Young Luxury Ritual (Single Package) (Rp 1.000.000)</option>
              </optgroup>
              <optgroup label="Couple Packages (2 Persons)">
                <option value="Simply Us (Couple Package)">Simply Us (Couple Package) (Rp 700.000)</option>
                <option value="Jaen Sajan (Couple Package)">Jaen Sajan (Couple Package) (Rp 900.000)</option>
                <option value="Luh Muani (Couple Package)">Luh Muani (Couple Package) (Rp 1.150.000)</option>
                <option value="Romantic Rose Bali Couple Spa">Romantic Rose Bali Couple Spa (Rp 1.475.000)</option>
                <option value="Jegeg Bali Lavender Couple Spa">Jegeg Bali Lavender Couple Spa (Rp 2.650.000)</option>
              </optgroup>
              <optgroup label="Group Packages (4 Persons)">
                <option value="Bali Bagus Package (Group 4 Pax)">Bali Bagus Package (Group 4 Pax) (Rp 1.250.000)</option>
                <option value="Bali Kuat Package (Group 4 Pax)">Bali Kuat Package (Group 4 Pax) (Rp 1.325.000)</option>
              </optgroup>
              <optgroup label="Body Massage & Advance Body Therapy">
                <option value="Balinese Traditional Massage">Balinese Traditional Massage (Rp 215.000)</option>
                <option value="Swedish Relaxing Massage">Swedish Relaxing Massage (Rp 200.000)</option>
                <option value="Deep Tissue / Sports Massage">Deep Tissue / Sports Massage (Rp 235.000)</option>
                <option value="Hot Stone Healing Massage">Hot Stone Healing Massage (Rp 315.000)</option>
                <option value="Massaji Signature Massage (Advance)">Massaji Signature Massage (Advance) (Rp 400.000)</option>
                <option value="Pre Natal (Pregnancy Massage)">Pre Natal (Pregnancy Massage) (Rp 375.000)</option>
                <option value="Foot Reflexology">Foot Reflexology (Rp 135.000)</option>
                <option value="Head &amp; Shoulder Tension Relief">Head &amp; Shoulder Tension Relief (Rp 160.000)</option>
                <option value="Focused Back Massage">Focused Back Massage (Rp 200.000)</option>
                <option value="Acupressure Facial Massage">Acupressure Facial Massage (Rp 150.000)</option>
                <option value="Cellulite Massage with Machine">Cellulite Massage with Machine (Rp 350.000)</option>
              </optgroup>
              <optgroup label="Body Slimming & Anti-Cellulite RF">
                <option value="Anti Cellulite Full Treatment">Anti Cellulite Full Treatment (Rp 500.000)</option>
                <option value="Body Slimming Cavitation RF (Arm)">Body Slimming Cavitation RF (Arm) (Rp 700.000)</option>
                <option value="Body Slimming Cavitation RF (Thigh)">Body Slimming Cavitation RF (Thigh) (Rp 850.000)</option>
                <option value="Body Slimming Cavitation RF (Tummy)">Body Slimming Cavitation RF (Tummy) (Rp 900.000)</option>
              </optgroup>
              <optgroup label="Body Spa Rituals & Special Botanicals">
                <option value="Aloe Vera Body Treatment Spa">Aloe Vera Body Treatment Spa (Rp 500.000)</option>
                <option value="Balinese Boreh Warming Herbal Spa">Balinese Boreh Warming Herbal Spa (Rp 600.000)</option>
                <option value="Green Tea &amp; Matcha Detox Spa">Green Tea &amp; Matcha Detox Spa (Rp 675.000)</option>
                <option value="Rose Bali Anti-Aging Spa">Rose Bali Anti-Aging Spa (Rp 725.000)</option>
                <option value="Refreshing Pear Vanilla Spa">Refreshing Pear Vanilla Spa (Rp 875.000)</option>
                <option value="Magnolia &amp; Mint Body Spa">Magnolia &amp; Mint Body Spa (Rp 850.000)</option>
                <option value="Sandalwood &amp; Turmeric Spa">Sandalwood &amp; Turmeric Spa (Rp 875.000)</option>
                <option value="Lavender Rosemary Mint Body Spa">Lavender Rosemary Mint Body Spa (Rp 900.000)</option>
              </optgroup>
              <optgroup label="Facial Treatments & Machine Care">
                <option value="Biokos Botanical Facial (60 Mins)">Biokos Botanical Facial (60 Mins) (Rp 350.000)</option>
                <option value="Biokos Deluxe Facial (90 Mins)">Biokos Deluxe Facial (90 Mins) (Rp 450.000)</option>
                <option value="Biokos Ultimate Deep Facial (120 Mins)">Biokos Ultimate Deep Facial (120 Mins) (Rp 575.000)</option>
                <option value="Hi-Frequency Machine with Violet Rays">Hi-Frequency Machine with Violet Rays (Rp 125.000)</option>
                <option value="Cold Light LED Facial Therapy">Cold Light LED Facial Therapy (Rp 125.000)</option>
                <option value="RF Facial Machine for Wrinkle (Face Iron)">RF Facial Machine for Wrinkle (Face Iron) (Rp 275.000)</option>
                <option value="Instant Firming Kaolin Mask">Instant Firming Kaolin Mask (Rp 150.000)</option>
              </optgroup>
              <optgroup label="Nail Services & Nail Art">
                <option value="Deluxe Hands Spa with Nail Gel">Deluxe Hands Spa with Nail Gel (Rp 350.000)</option>
                <option value="Deluxe Foot Spa with Nail Gel">Deluxe Foot Spa with Nail Gel (Rp 350.000)</option>
                <option value="Basic Nail Hand or Foot with Gel">Basic Nail Hand or Foot with Gel (Rp 150.000)</option>
                <option value="Dr. Feeto Callus Removal Treatment">Dr. Feeto Callus Removal Treatment (Rp 225.000)</option>
                <option value="Nail Gel Remover &amp; Custom Art">Nail Gel Remover &amp; Custom Art (Rp 100.000)</option>
              </optgroup>
              <optgroup label="Additional Services & Surprise Packages">
                <option value="Flower Bath with Aromatherapy">Flower Bath with Aromatherapy (Rp 175.000)</option>
                <option value="Homemade Oatmeal &amp; Rice Body Scrub">Homemade Oatmeal &amp; Rice Body Scrub (Rp 150.000)</option>
                <option value="Calming Oatmeal Body Mask">Calming Oatmeal Body Mask (Rp 150.000)</option>
                <option value="Hot Himalayan Salt &amp; Flower Compress">Hot Himalayan Salt &amp; Flower Compress (Rp 100.000)</option>
                <option value="Detoxifying Infra Red Body Wrap">Detoxifying Infra Red Body Wrap (Rp 125.000)</option>
                <option value="Hydrating Facial Mask Add-on">Hydrating Facial Mask Add-on (Rp 125.000)</option>
                <option value="Exclusive Spa Gift Voucher Card">Exclusive Spa Gift Voucher Card (Rp 40.000)</option>
                <option value="Birthday / Anniversary Surprise Package">Birthday / Anniversary Surprise Package (Rp 425.000)</option>
              </optgroup>
            </select>
          </div>

          <div class="grid grid-cols-3 gap-3">
            <div class="col-span-1">
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_date">Date *</label>
              <input type="date" name="date" id="booking-date" required class="w-full px-3 py-2 rounded-xl border border-[#BAE0FD] text-xs focus:outline-none focus:border-[#1E3A8A] bg-[#F0F8FF]/30">
            </div>
            <div class="col-span-1">
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_time">Time Slot *</label>
              <select name="time" required class="w-full px-3 py-2 rounded-xl border border-[#BAE0FD] text-xs focus:outline-none focus:border-[#1E3A8A] bg-white">
                <option value="10:00">10:00 AM</option>
                <option value="11:30">11:30 AM</option>
                <option value="13:00">01:00 PM</option>
                <option value="14:30">02:30 PM</option>
                <option value="16:00">04:00 PM</option>
                <option value="17:30">05:30 PM</option>
                <option value="19:00">07:00 PM</option>
              </select>
            </div>
            <div class="col-span-1">
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_guests">Guests</label>
              <select name="guests" class="w-full px-3 py-2 rounded-xl border border-[#BAE0FD] text-xs focus:outline-none focus:border-[#1E3A8A] bg-white">
                <option value="1">1 Person</option>
                <option value="2" selected>2 Persons</option>
                <option value="3">3 Persons</option>
                <option value="4">4 Persons</option>
                <option value="5+">5+ Persons</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_notes">Special Requests (Optional)</label>
            <textarea name="notes" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-[#BAE0FD] text-xs focus:outline-none focus:border-[#1E3A8A] bg-[#F0F8FF]/30" placeholder="Preferred therapist gender, focus areas, or occasion details..."></textarea>
          </div>
        </div>

        <div id="booking-error-msg" class="hidden text-xs text-rose-600 bg-rose-50 p-2.5 rounded-lg border border-rose-200"></div>

        <button type="submit" id="booking-submit-btn" class="w-full py-3.5 rounded-xl bg-[#1E3A8A] hover:bg-[#141E3C] text-white font-bold text-xs uppercase tracking-wider shadow-lg transition duration-200" data-i18n="modal_submit">
          Submit Reservation Request
        </button>
      </form>

      <!-- Confirmation Success State -->
      <div id="booking-confirmation" class="hidden text-center py-6 space-y-4">
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h3 class="font-serif text-2xl font-bold text-[#141E3C]" data-i18n="modal_success_title">Reservation Received</h3>
        <p id="booking-summary-text" class="text-xs text-[#475569] leading-relaxed max-w-sm mx-auto font-light">
          Your inquiry has been processed. Please confirm directly on WhatsApp for instant confirmation.
        </p>
        <div class="pt-4 flex flex-col gap-2.5">
          <a id="wa-confirm-link" href="#" target="_blank" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider shadow transition flex items-center justify-center gap-2">
            Confirm Instantly on WhatsApp
          </a>
          <button onclick="closeBookingModal()" class="w-full py-2.5 rounded-xl border border-[#BAE0FD] text-[#475569] hover:bg-[#F0F8FF] font-bold text-xs uppercase tracking-wider transition" data-i18n="modal_btn_close">
            Close Window
          </button>
        </div>
      </div>

    </div>
  </div>

  <!-- Main JavaScript File -->
  <script src="assets/js/main.js"></script>
</body>
</html>
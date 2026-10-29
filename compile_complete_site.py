import json
import html

WEBSITE_DIR = '/Volumes/PROJECTS/EYESTETIX_BACKUP_2026-09-30/WEBSITE'

with open(f'{WEBSITE_DIR}/data/settings.json') as f:
    settings = json.load(f)

with open(f'{WEBSITE_DIR}/data/menu.json') as f:
    menu = json.load(f)

clean_wa = ''.join(c for c in settings.get('whatsapp_number', '') if c.isdigit())
if clean_wa.startswith('0'):
    clean_wa = '62' + clean_wa[1:]

wa_url = f'https://wa.me/{clean_wa}?text=' + 'Hello%20' + settings.get('site_name', 'Massaji%20Spa') + '%2C%20I%20would%20like%20to%20check%20availability%20for%20a%20spa%20treatment.'

promo_items = [item for item in menu if item.get('category') == 'promo']
package_items = [item for item in menu if item.get('category', '').startswith('packages')]
treatment_items = [item for item in menu if not item.get('category', '').startswith('packages') and item.get('category') != 'promo']

def fmt_price(val):
    return f"{val:,}".replace(',', '.')

# ========================================================
# 1. BUILD DROPDOWN OPTIONS
# ========================================================
optgroups = [
    ('Special Monthly Promotions', promo_items),
    ('Single Packages (1 Person)', [p for p in package_items if p['category'] == 'packages-single']),
    ('Couple Packages (2 Persons)', [p for p in package_items if p['category'] == 'packages-couple']),
    ('Group Packages (4 Persons)', [p for p in package_items if p['category'] == 'packages-group']),
    ('Body Massage & Advance Body Therapy', [t for t in treatment_items if t['category'] == 'massage']),
    ('Body Slimming & Anti-Cellulite RF', [t for t in treatment_items if t['category'] == 'slimming']),
    ('Body Spa Rituals & Special Botanicals', [t for t in treatment_items if t['category'] == 'spa']),
    ('Facial Treatments & Machine Care', [t for t in treatment_items if t['category'] == 'facial']),
    ('Nail Services & Nail Art', [t for t in treatment_items if t['category'] == 'nail']),
    ('Additional Services & Surprise Packages', [t for t in treatment_items if t['category'] == 'additional']),
]

dropdown_options_list = []
for grp_label, grp_items in optgroups:
    if not grp_items:
        continue
    dropdown_options_list.append(f'              <optgroup label="{grp_label}">')
    for item in grp_items:
        esc_name = html.escape(item['name'])
        price_str = fmt_price(item['price'])
        dropdown_options_list.append(f'                <option value="{esc_name}">{esc_name} (Rp {price_str})</option>')
    dropdown_options_list.append('              </optgroup>')

dropdown_options_html = '\n'.join(dropdown_options_list)

# ========================================================
# 2. BUILD PROMO CARDS HTML
# ========================================================
promo_cards_list = []
for item in promo_items:
    esc_name = html.escape(item['name'])
    safe_js_name = esc_name.replace("'", "\\'")
    disc_badge = ''
    if item.get('normal_price'):
        norm = fmt_price(item['normal_price'])
        disc_badge = f'<span class="text-xs text-sky-200 line-through mr-2">Rp {norm}</span>'
    tag = html.escape(item.get('tag', 'Promo'))
    
    promo_cards_list.append(f'''
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-sky-300/30 flex flex-col justify-between hover:bg-white/15 transition duration-300 shadow-xl">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#BAE0FD] font-mono text-xs font-semibold">{html.escape(item.get('duration', ''))}</span>
              <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-[#0284C7] text-white">
                {tag}
              </span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-white mb-2 leading-snug">
              {esc_name}
            </h3>
            <p class="text-xs sm:text-[13px] text-sky-100/80 leading-relaxed mb-6 font-light">
              {html.escape(item.get('description', ''))}
            </p>
          </div>
          <div class="pt-4 border-t border-sky-300/20 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-sky-200 uppercase tracking-wider block font-bold">Special Promo Rate</span>
              <div class="flex items-baseline">
                {disc_badge}
                <span class="font-serif text-2xl font-bold text-[#BAE0FD] font-mono">Rp {fmt_price(item['price'])}</span>
              </div>
            </div>
            <button onclick="openBookingModal('{safe_js_name}')" class="px-4 py-2 rounded-lg bg-white text-[#141E3C] hover:bg-[#BAE0FD] transition font-bold text-xs tracking-wider uppercase shadow-md">
              Book Promo
            </button>
          </div>
        </div>''')
promo_cards_html = '\n'.join(promo_cards_list)

# ========================================================
# 3. BUILD PACKAGES CARDS HTML
# ========================================================
pkg_cat_labels = {
    'packages-single': 'Single Package (1 Person)',
    'packages-couple': 'Couple Package (2 Persons)',
    'packages-group': 'Group Package (4 Persons)'
}

package_cards_list = []
for item in package_items:
    esc_name = html.escape(item['name'])
    safe_js_name = esc_name.replace("'", "\\'")
    cat_badge = pkg_cat_labels.get(item['category'], 'Spa Package')
    tag = html.escape(item.get('tag', 'Package Deal'))
    
    disc_badge = ''
    if item.get('normal_price'):
        norm = fmt_price(item['normal_price'])
        disc_badge = f'<span class="text-xs text-[#94A3B8] line-through mr-1.5">Rp {norm}</span>'

    package_cards_list.append(f'''
        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" data-category="{html.escape(item['category'])}">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">{cat_badge}</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {html.escape(item.get('duration', ''))}
              </span>
            </div>
            <div class="mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                {tag}
              </span>
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              {esc_name}
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              {html.escape(item.get('description', ''))}
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
              <div class="flex items-baseline">
                {disc_badge}
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp {fmt_price(item['price'])}</span>
              </div>
            </div>
            <button onclick="openBookingModal('{safe_js_name}')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Package
            </button>
          </div>
        </div>''')
package_cards_html = '\n'.join(package_cards_list)

# ========================================================
# 4. BUILD TREATMENT MENU CARDS HTML
# ========================================================
treat_cat_labels = {
    'massage': 'Body Massage',
    'slimming': 'Slimming & Cellulite',
    'spa': 'Body Spa Treatment',
    'facial': 'Facial Treatment',
    'nail': 'Nail Service',
    'additional': 'Additional Service'
}

treatment_cards_list = []
for item in treatment_items:
    esc_name = html.escape(item['name'])
    safe_js_name = esc_name.replace("'", "\\'")
    cat_label = treat_cat_labels.get(item['category'], item['category'].title())
    tag = html.escape(item.get('tag', 'Featured'))
    
    pressure_html = ''
    if item.get('pressure'):
        pressure_html = f'<span class="text-[10px] text-[#64748B] italic ml-1 font-sans">({html.escape(item["pressure"])})</span>'

    multi_html = ''
    if item.get('multi_prices'):
        multi_html = f'''
            <div class="mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              {html.escape(item['multi_prices'])}
            </div>'''

    treatment_cards_list.append(f'''
        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="{html.escape(item['category'])}">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">{cat_label}</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {html.escape(item.get('duration', ''))}
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                {tag}
              </span>
              {pressure_html}
            </div>
            <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              {esc_name}
            </h3>
            <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              {html.escape(item.get('description', ''))}
            </p>
            {multi_html}
          </div>
          <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">From Price</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp {fmt_price(item['price'])}</span>
            </div>
            <button onclick="openBookingModal('{safe_js_name}')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
              Book Treatment
            </button>
          </div>
        </div>''')
treatment_cards_html = '\n'.join(treatment_cards_list)

# ========================================================
# 5. ASSEMBLE FULL HTML TEMPLATE
# ========================================================
html_template = f'''<!DOCTYPE html>
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
    tailwind.config = {{
      theme: {{
        extend: {{
          colors: {{
            brand: {{
              skyBg: '#F0F8FF',
              mist: '#E1F0FE',
              navy: '#141E3C',
              royal: '#1E3A8A',
              royalDark: '#172554',
              sky: '#0284C7',
              border: '#BAE0FD'
            }}
          }},
          fontFamily: {{
            serif: ['"Cormorant Garamond"', 'serif'],
            sans: ['"Manrope"', 'sans-serif']
          }}
        }}
      }}
    }}
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

        <a href="{wa_url}" target="_blank" class="px-3.5 py-2 rounded-lg border border-emerald-300 hover:border-emerald-600 bg-emerald-50/80 text-emerald-800 text-xs font-bold tracking-wider flex items-center gap-1.5 transition duration-200 shadow-sm">
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
        <a href="{wa_url}" target="_blank" class="w-full py-2.5 rounded-lg border border-emerald-500 bg-emerald-50 text-emerald-800 text-center font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-2">
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
{promo_cards_html}
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
            <span data-i18n="pkg_tab_all">All Packages</span> ({len(package_items)})
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
{package_cards_html}
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
          <span data-i18n="cat_all">All Treatments</span> ({len(treatment_items)})
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
{treatment_cards_html}
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
            <img src="assets/images/massaji-about.jpg" alt="Massaji Spa Bali Sanctuary &amp; Reception" class="w-full h-full object-cover" onerror="if (!this.triedPng) {{ this.triedPng = true; this.src = 'assets/images/massaji-reception.jpg'; }} else if (!this.triedRaw) {{ this.triedRaw = true; this.src = 'assets/images/18BB6F9B-4ACE-49DF-9AE1-610D3B65BA60.png'; }} else {{ this.onerror = null; this.src = 'assets/images/gambar2.jpg'; }}">
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
              <a href="{wa_url}" target="_blank" class="text-emerald-800 font-bold hover:underline">
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
{dropdown_options_html}
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
</html>'''

# Write public index.html
with open(f'{WEBSITE_DIR}/index.html', 'w') as f:
    f.write(html_template)

# Write preview.html
with open(f'{WEBSITE_DIR}/preview.html', 'w') as f:
    f.write(html_template)

# Write index.php for cPanel
with open(f'{WEBSITE_DIR}/index.php', 'w') as f:
    f.write(html_template)

print("Successfully written index.html, preview.html, and index.php with complete Promo, Packages, and Treatment Menu!")

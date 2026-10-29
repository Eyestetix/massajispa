import json
import html
import os

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

# Pre-defined text variables to avoid backslashes inside f-strings
hero_title_1 = html.escape(str(settings.get('hero_title_1', 'Find Your Balance.')))
hero_title_2 = html.escape(str(settings.get('hero_title_2', 'Rediscover Serenity.')))
hero_desc = html.escape(str(settings.get('hero_desc', 'Experience the restorative touch of authentic Balinese healing traditions, pure botanical aromatherapy, and tranquil private suites in the heart of Canggu.')))
hero_image = str(settings.get('hero_image', 'assets/images/massaji-hero.jpg'))

promo_title = 'End Year 2026 <span class="italic font-normal text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-[#BAE0FD] to-amber-100">Big Promotion</span>'
promo_subtitle = html.escape(str(settings.get('promo_subtitle', 'Promo Akhir Tahun 2026')))
promo_validity = html.escape(str(settings.get('promo_validity', 'Valid : 1 Nov – 31 Dec 2026 (Reservation is required prior visit)')))
promo_flyer_image = str(settings.get('promo_flyer_image', 'assets/images/promo-flyer-2026.jpeg'))
phone_1 = html.escape(str(settings.get('phone', '+62 812-3669-5755')))
phone_2 = html.escape(str(settings.get('phone_2', '+62 811-3857-188')))
clean_phone_1 = ''.join(c for c in phone_1 if c.isdigit() or c == '+')
clean_phone_2 = ''.join(c for c in phone_2 if c.isdigit() or c == '+')

about_title_1 = html.escape(str(settings.get('about_title_1', 'Rooted in Bali.')))
about_title_2 = html.escape(str(settings.get('about_title_2', 'Created for Your Wellbeing.')))
about_desc_1 = html.escape(str(settings.get('about_desc_1', 'Tucked into a tranquil enclave of Kerobokan and Canggu, Massaji Spa was founded to honor ancient Balinese healing arts while maintaining five-star cleanliness at refreshingly honest, accessible prices.')))
about_desc_2 = html.escape(str(settings.get('about_desc_2', "From warming Balinese Boreh herbal spice wraps that ease muscular tension to targeted Cavitation RF slimming and certified prenatal massage—every therapy is thoughtfully tailored to your body's unique rhythm.")))
about_image = str(settings.get('about_image', 'assets/images/massaji-about.jpg'))

# Category Translations (EN / ID)
cat_labels_en = {
    'packages-single': 'Single Package (1 Person)',
    'packages-couple': 'Couple Package (2 Persons)',
    'packages-group': 'Group Package (4 Persons)',
    'massage': 'Body Massage',
    'slimming': 'Slimming & Cellulite',
    'spa': 'Body Spa Treatment',
    'facial': 'Facial Treatment',
    'nail': 'Nail Service',
    'additional': 'Additional Service',
    'promo': 'Special Promo'
}

cat_labels_id = {
    'packages-single': 'Paket Personal (1 Orang)',
    'packages-couple': 'Paket Pasangan (2 Orang)',
    'packages-group': 'Paket Rombongan (4 Orang)',
    'massage': 'Pijat Tradisional Tubuh',
    'slimming': 'Slimming & Selulit',
    'spa': 'Ritual Body Spa & Lulur',
    'facial': 'Perawatan Wajah',
    'nail': 'Layanan & Seni Kuku',
    'additional': 'Layanan Tambahan',
    'promo': 'Promo Spesial'
}

# ========================================================
# 1. BUILD DROPDOWN OPTIONS WITH OPTGROUPS (BILINGUAL)
# ========================================================
optgroups = [
    (('End Year 2026 Big Promotion', 'Promo Akhir Tahun 2026'), promo_items),
    (('Single Packages (1 Person)', 'Paket Personal (1 Orang)'), [p for p in package_items if p['category'] == 'packages-single']),
    (('Couple Packages (2 Persons)', 'Paket Pasangan (2 Orang)'), [p for p in package_items if p['category'] == 'packages-couple']),
    (('Group Packages (4 Persons)', 'Paket Rombongan (4 Orang)'), [p for p in package_items if p['category'] == 'packages-group']),
    (('Body Massage & Advance Body Therapy', 'Pijat Tubuh & Terapi Lanjutan'), [t for t in treatment_items if t['category'] == 'massage']),
    (('Body Slimming & Anti-Cellulite RF', 'Body Slimming & Anti-Selulit RF'), [t for t in treatment_items if t['category'] == 'slimming']),
    (('Body Spa Rituals & Special Botanicals', 'Ritual Body Spa & Rempah Alami'), [t for t in treatment_items if t['category'] == 'spa']),
    (('Facial Treatments & Machine Care', 'Perawatan Wajah & Teknologi Mesin'), [t for t in treatment_items if t['category'] == 'facial']),
    (('Nail Services & Nail Art', 'Layanan Kuku & Seni Manikur'), [t for t in treatment_items if t['category'] == 'nail']),
    (('Additional Services & Surprise Packages', 'Layanan Tambahan & Paket Kejutan'), [t for t in treatment_items if t['category'] == 'additional']),
]

dropdown_options_list = []
for (grp_en, grp_id), grp_items in optgroups:
    if not grp_items:
        continue
    dropdown_options_list.append(f'              <optgroup label="{html.escape(grp_en)}" data-label-en="{html.escape(grp_en)}" data-label-id="{html.escape(grp_id)}">')
    for item in grp_items:
        esc_name_en = html.escape(item['name'])
        esc_name_id = html.escape(item.get('name_id', item['name']))
        price_str = fmt_price(item['price'])
        label_en = f"{esc_name_en} (Rp {price_str})"
        label_id = f"{esc_name_id} (Rp {price_str})"
        dropdown_options_list.append(f'                <option value="{esc_name_en}" data-label-en="{label_en}" data-label-id="{label_id}">{label_en}</option>')
    dropdown_options_list.append('              </optgroup>')

dropdown_options_html = '\n'.join(dropdown_options_list)

# ========================================================
# 2. BUILD PROMO CARDS HTML (END YEAR 2026 BIG PROMOTION)
# ========================================================
promo_cards_list = []
for item in promo_items:
    esc_name_en = html.escape(item['name'])
    esc_name_id = html.escape(item.get('name_id', item['name']))
    esc_desc_en = html.escape(item.get('description', ''))
    esc_desc_id = html.escape(item.get('description_id', item.get('description', '')))
    esc_dur_en = html.escape(item.get('duration', ''))
    esc_dur_id = html.escape(item.get('duration_id', item.get('duration', '')))
    esc_tag_en = html.escape(item.get('tag', 'Big Promo'))
    esc_tag_id = html.escape(item.get('tag_id', item.get('tag', 'Promo Besar')))

    safe_js_name = esc_name_en.replace("'", "\\'")
    norm = fmt_price(item['normal_price']) if item.get('normal_price') else ''

    # Formatting Title: split into Main Title and Subtitle in Parentheses
    title_display_html = esc_name_en
    if '(' in esc_name_en and esc_name_en.endswith(')'):
        import re
        m = re.match(r'^(.*?)\s*(\(.*?\))$', esc_name_en)
        if m:
            title_display_html = f'{m.group(1)} <span class="block text-sm sm:text-base font-serif font-normal text-sky-200/80 mt-1">{m.group(2)}</span>'

    # Elegant SVG icons for category/duration
    header_icon = '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
    if 'Slimming' in item['name'] or 'Cavitation' in item['duration']:
        header_icon = '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.5c1.5 2.5 4 4 6.5 4.5-1.5 3-4 4.5-6.5 9-2.5-4.5-5-6-6.5-9 2.5-.5 5-2 6.5-4.5z"/></svg>'
    elif 'Rose' in item['name']:
        header_icon = '<svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 009-9c0-4.97-4.03-9-9-9s-9 4.03-9 9a9 9 0 009 9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7c-2 1-3 3-2 5s3 3 5 2 3-3 2-5-3-3-5-2z"/></svg>'

    if item.get('multi_prices'):
        # Multi-option card: Body Slimming Treatment (Tummy / Thigh)
        tummy_icon = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 4c1 4-1 6-1 8s2 4 1 8M17 4c-1 4 1 6 1 8s-2 4-1 8" /><path stroke-linecap="round" stroke-linejoin="round" d="M4 12h3m-1-1.5L7 12l-1 1.5M20 12h-3m1-1.5L17 12l1 1.5" /></svg>'
        thigh_icon = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3v8c0 4-2 7-2 10M15 3v8c0 4 2 7 2 10" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 7v14" /><path stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="2 2" d="M8 12c1 2 2 4 2 6M16 12c-1 2-2 4-2 6" /></svg>'

        boxes_en = f'''<div class="card-multi-prices space-y-2.5 mb-4">
  <div class="p-2.5 sm:p-3 rounded-xl bg-white/5 border border-sky-300/20 flex items-center justify-between gap-3 hover:bg-white/10 transition">
    <div class="flex items-center gap-3 min-w-0">
      <div class="w-10 h-10 rounded-lg bg-sky-500/10 border border-sky-400/20 flex items-center justify-center text-[#BAE0FD] flex-shrink-0">
        {tummy_icon}
      </div>
      <div class="min-w-0">
        <span class="block font-bold text-white text-sm">Tummy</span>
        <span class="block text-xs text-sky-200/60 line-through">Rp 900.000</span>
      </div>
    </div>
    <div class="px-3 py-1.5 rounded-lg bg-[#0c1a30]/80 border border-sky-400/30 text-right flex-shrink-0">
      <span class="block text-[9px] font-bold tracking-wider text-sky-300 uppercase">NOW</span>
      <span class="block font-bold text-white text-sm sm:text-base whitespace-nowrap">Rp 650.000</span>
    </div>
  </div>
  <div class="p-2.5 sm:p-3 rounded-xl bg-white/5 border border-sky-300/20 flex items-center justify-between gap-3 hover:bg-white/10 transition">
    <div class="flex items-center gap-3 min-w-0">
      <div class="w-10 h-10 rounded-lg bg-sky-500/10 border border-sky-400/20 flex items-center justify-center text-[#BAE0FD] flex-shrink-0">
        {thigh_icon}
      </div>
      <div class="min-w-0">
        <span class="block font-bold text-white text-sm">Thigh</span>
        <span class="block text-xs text-sky-200/60 line-through">Rp 850.000</span>
      </div>
    </div>
    <div class="px-3 py-1.5 rounded-lg bg-[#0c1a30]/80 border border-sky-400/30 text-right flex-shrink-0">
      <span class="block text-[9px] font-bold tracking-wider text-sky-300 uppercase">NOW</span>
      <span class="block font-bold text-white text-sm sm:text-base whitespace-nowrap">Rp 550.000</span>
    </div>
  </div>
</div>'''

        boxes_id = f'''<div class="card-multi-prices space-y-2.5 mb-4">
  <div class="p-2.5 sm:p-3 rounded-xl bg-white/5 border border-sky-300/20 flex items-center justify-between gap-3 hover:bg-white/10 transition">
    <div class="flex items-center gap-3 min-w-0">
      <div class="w-10 h-10 rounded-lg bg-sky-500/10 border border-sky-400/20 flex items-center justify-center text-[#BAE0FD] flex-shrink-0">
        {tummy_icon}
      </div>
      <div class="min-w-0">
        <span class="block font-bold text-white text-sm">Perut</span>
        <span class="block text-xs text-sky-200/60 line-through">Rp 900.000</span>
      </div>
    </div>
    <div class="px-3 py-1.5 rounded-lg bg-[#0c1a30]/80 border border-sky-400/30 text-right flex-shrink-0">
      <span class="block text-[9px] font-bold tracking-wider text-sky-300 uppercase">KINI</span>
      <span class="block font-bold text-white text-sm sm:text-base whitespace-nowrap">Rp 650.000</span>
    </div>
  </div>
  <div class="p-2.5 sm:p-3 rounded-xl bg-white/5 border border-sky-300/20 flex items-center justify-between gap-3 hover:bg-white/10 transition">
    <div class="flex items-center gap-3 min-w-0">
      <div class="w-10 h-10 rounded-lg bg-sky-500/10 border border-sky-400/20 flex items-center justify-center text-[#BAE0FD] flex-shrink-0">
        {thigh_icon}
      </div>
      <div class="min-w-0">
        <span class="block font-bold text-white text-sm">Paha</span>
        <span class="block text-xs text-sky-200/60 line-through">Rp 850.000</span>
      </div>
    </div>
    <div class="px-3 py-1.5 rounded-lg bg-[#0c1a30]/80 border border-sky-400/30 text-right flex-shrink-0">
      <span class="block text-[9px] font-bold tracking-wider text-sky-300 uppercase">KINI</span>
      <span class="block font-bold text-white text-sm sm:text-base whitespace-nowrap">Rp 550.000</span>
    </div>
  </div>
</div>'''

        esc_pills_en = html.escape(boxes_en)
        esc_pills_id = html.escape(boxes_id)

        pricing_block_html = f'''
          <div class="mt-auto pt-4 flex flex-col justify-end">
            {boxes_en}
            <button onclick="openBookingModal('{safe_js_name}')" class="w-full py-3.5 px-4 rounded-xl bg-white text-[#141E3C] hover:bg-[#BAE0FD] active:scale-[0.98] transition-all duration-200 font-bold text-xs tracking-wider uppercase shadow-md flex items-center justify-center gap-2 cursor-pointer group">
              <span data-i18n="promo_btn_book">Claim Promo Rate</span>
              <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
          </div>'''
    else:
        esc_pills_en = ''
        esc_pills_id = ''
        pricing_block_html = f'''
          <div class="mt-auto pt-4 flex flex-col justify-end">
            <div class="mb-4">
              <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#94A3B8] block mb-1" data-i18n="promo_card_rate">Special Promo Rate</span>
              <span class="text-xs sm:text-sm text-sky-200/60 line-through block font-medium mb-1">Rp {norm}</span>
              <div class="text-3xl sm:text-4xl font-serif font-bold text-white tracking-tight leading-none">Rp {fmt_price(item['price'])}</div>
            </div>
            <button onclick="openBookingModal('{safe_js_name}')" class="w-full py-3.5 px-4 rounded-xl bg-white text-[#141E3C] hover:bg-[#BAE0FD] active:scale-[0.98] transition-all duration-200 font-bold text-xs tracking-wider uppercase shadow-md flex items-center justify-center gap-2 cursor-pointer group">
              <span data-i18n="promo_btn_book">Claim Promo Rate</span>
              <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
          </div>'''

    promo_cards_list.append(f'''
        <div class="promo-card bg-white/10 backdrop-blur-md rounded-2xl p-5 sm:p-6 border border-sky-300/30 flex flex-col justify-between hover:bg-white/15 hover:border-sky-300/50 transition duration-300 shadow-xl w-full min-w-0"
             data-name-en="{esc_name_en}" data-name-id="{esc_name_id}"
             data-desc-en="{esc_desc_en}" data-desc-id="{esc_desc_id}"
             data-dur-en="{esc_dur_en}" data-dur-id="{esc_dur_id}"
             data-tag-en="{esc_tag_en}" data-tag-id="{esc_tag_id}"
             data-cat-en="Special Promo" data-cat-id="Promo Spesial"
             data-multi-en="{esc_pills_en}" data-multi-id="{esc_pills_id}">
          <div>
            <div class="flex items-center justify-between text-xs mb-4 gap-2">
              <div class="flex items-center gap-1.5 text-[#BAE0FD]">
                {header_icon}
                <span class="card-duration font-mono text-xs font-semibold uppercase tracking-wider">{esc_dur_en}</span>
              </div>
              <span class="card-tag text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-[#0284C7] text-white whitespace-nowrap shadow-sm">
                {esc_tag_en}
              </span>
            </div>
            <h3 class="card-title font-serif text-2xl sm:text-[26px] font-bold text-white mb-2 leading-tight">
              {title_display_html}
            </h3>
            <p class="card-desc text-xs sm:text-[13px] text-sky-100/85 leading-relaxed mb-4 font-light">
              {esc_desc_en}
            </p>
          </div>
          {pricing_block_html}
        </div>''')
promo_cards_html = '\n'.join(promo_cards_list)

# ========================================================
# 3. BUILD PACKAGES CARDS HTML (BILINGUAL)
# ========================================================
package_cards_list = []
for item in package_items:
    esc_name_en = html.escape(item['name'])
    esc_name_id = html.escape(item.get('name_id', item['name']))
    esc_desc_en = html.escape(item.get('description', ''))
    esc_desc_id = html.escape(item.get('description_id', item.get('description', '')))
    esc_dur_en = html.escape(item.get('duration', ''))
    esc_dur_id = html.escape(item.get('duration_id', item.get('duration', '')))
    esc_tag_en = html.escape(item.get('tag', 'Package Deal'))
    esc_tag_id = html.escape(item.get('tag_id', item.get('tag', 'Paket Istimewa')))
    cat_badge_en = cat_labels_en.get(item['category'], 'Spa Package')
    cat_badge_id = cat_labels_id.get(item['category'], 'Paket Spa')

    safe_js_name = esc_name_en.replace("'", "\\'")
    
    disc_badge = ''
    if item.get('normal_price'):
        norm = fmt_price(item['normal_price'])
        disc_badge = f'<span class="text-xs text-[#94A3B8] line-through mr-1.5">Rp {norm}</span>'

    search_data = f"{item['name'].lower()} {item.get('name_id', '').lower()} {item.get('description', '').lower()} {item.get('description_id', '').lower()} {cat_badge_en.lower()} {cat_badge_id.lower()} {esc_dur_en.lower()} {esc_dur_id.lower()}"
    esc_search = html.escape(search_data)

    package_cards_list.append(f'''
        <div class="package-card treatment-card p-5 sm:p-6 flex flex-col justify-between" 
             data-category="{html.escape(item['category'])}" 
             data-search="{esc_search}"
             data-name-en="{esc_name_en}" data-name-id="{esc_name_id}"
             data-desc-en="{esc_desc_en}" data-desc-id="{esc_desc_id}"
             data-dur-en="{esc_dur_en}" data-dur-id="{esc_dur_id}"
             data-tag-en="{esc_tag_en}" data-tag-id="{esc_tag_id}"
             data-cat-en="{cat_badge_en}" data-cat-id="{cat_badge_id}">
          <div>
            <div class="flex items-center justify-between text-xs mb-2">
              <span class="card-category text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">{cat_badge_en}</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="card-duration">{esc_dur_en}</span>
              </span>
            </div>
            <div class="mb-2">
              <span class="card-tag inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                {esc_tag_en}
              </span>
            </div>
            <h3 class="card-title font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2.5">
              {esc_name_en}
            </h3>
            <p class="card-desc text-xs sm:text-[13px] text-[#475569] leading-relaxed mb-6 font-light">
              {esc_desc_en}
            </p>
          </div>
          <div class="mt-auto pt-4 border-t border-[#BAE0FD]/70 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="pkg_from_price">From Price</span>
              <div class="flex items-baseline">
                {disc_badge}
                <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp {fmt_price(item['price'])}</span>
              </div>
            </div>
            <button onclick="openBookingModal('{safe_js_name}')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="pkg_btn_book">
              Reserve Package
            </button>
          </div>
        </div>''')
package_cards_html = '\n'.join(package_cards_list)

# ========================================================
# 4. BUILD TREATMENT MENU CARDS HTML (BILINGUAL)
# ========================================================
treatment_cards_list = []
for item in treatment_items:
    esc_name_en = html.escape(item['name'])
    esc_name_id = html.escape(item.get('name_id', item['name']))
    esc_desc_en = html.escape(item.get('description', ''))
    esc_desc_id = html.escape(item.get('description_id', item.get('description', '')))
    esc_dur_en = html.escape(item.get('duration', ''))
    esc_dur_id = html.escape(item.get('duration_id', item.get('duration', '')))
    esc_tag_en = html.escape(item.get('tag', 'Featured'))
    esc_tag_id = html.escape(item.get('tag_id', item.get('tag', 'Pilihan')))
    cat_label_en = cat_labels_en.get(item['category'], item['category'].title())
    cat_label_id = cat_labels_id.get(item['category'], item['category'].title())
    esc_multi_en = html.escape(item.get('multi_prices', ''))
    esc_multi_id = html.escape(item.get('multi_prices_id', item.get('multi_prices', '')))

    safe_js_name = esc_name_en.replace("'", "\\'")
    
    pressure_html = ''
    if item.get('pressure'):
        pressure_html = f'<span class="text-[10px] text-[#64748B] italic ml-1 font-sans">({html.escape(item["pressure"])})</span>'

    multi_html = ''
    if item.get('multi_prices'):
        multi_html = f'''
            <div class="card-multi-prices mb-3 px-2.5 py-1.5 rounded bg-[#F0F8FF] border border-[#BAE0FD] text-[11px] font-mono text-[#1E3A8A] font-semibold">
              {esc_multi_en}
            </div>'''

    search_data = f"{item['name'].lower()} {item.get('name_id', '').lower()} {item.get('description', '').lower()} {item.get('description_id', '').lower()} {cat_label_en.lower()} {cat_label_id.lower()} {esc_dur_en.lower()} {esc_dur_id.lower()}"
    esc_search = html.escape(search_data)

    treatment_cards_list.append(f'''
        <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" 
             data-category="{html.escape(item['category'])}" 
             data-search="{esc_search}"
             data-name-en="{esc_name_en}" data-name-id="{esc_name_id}"
             data-desc-en="{esc_desc_en}" data-desc-id="{esc_desc_id}"
             data-dur-en="{esc_dur_en}" data-dur-id="{esc_dur_id}"
             data-tag-en="{esc_tag_en}" data-tag-id="{esc_tag_id}"
             data-cat-en="{cat_label_en}" data-cat-id="{cat_label_id}"
             data-multi-en="{esc_multi_en}" data-multi-id="{esc_multi_id}">
          <div>
            <div class="flex items-center justify-between text-xs mb-1.5">
              <span class="card-category text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">{cat_label_en}</span>
              <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
                <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="card-duration">{esc_dur_en}</span>
              </span>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
              <span class="card-tag inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
                {esc_tag_en}
              </span>
              {pressure_html}
            </div>
            <h3 class="card-title font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
              {esc_name_en}
            </h3>
            <p class="card-desc text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-3 font-light">
              {esc_desc_en}
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
# 5. ASSEMBLE FULL HTML TEMPLATE (ENGLISH DEFAULT PUBLIC)
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
  <link rel="stylesheet" href="assets/css/style.css?v=20261029d">
</head>
<body class="text-[#141E3C] antialiased font-sans selection:bg-[#1E3A8A] selection:text-white">

  <!-- ========================================== -->
  <!-- 1. NAVIGATION HEADER -->
  <!-- ========================================== -->
  <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-[#BAE0FD] shadow-sm transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
      
      <!-- Brand Logo (Official Member-1 Logo) -->
      <a href="./" class="flex items-center gap-3.5 group">
        <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-white shadow-sm border border-[#BAE0FD] p-1 group-hover:scale-105 transition duration-300">
          <img src="assets/images/member-1.png" alt="Massaji Spa Bali Logo" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='assets/images/member.png';">
        </div>
        <div>
          <div class="text-[10px] tracking-[0.2em] text-[#0284C7] font-bold uppercase leading-tight">マッサージ</div>
          <span class="font-serif text-2xl font-bold tracking-tight text-[#141E3C] block leading-none">Massaji <span class="font-normal italic text-[#0284C7]">Spa</span></span>
          <span class="text-[9px] uppercase tracking-widest text-[#475569] block mt-0.5">Canggu &bull; Bali</span>
        </div>
      </a>

      <!-- Desktop Navigation Menu (Default English) -->
      <nav class="hidden lg:flex items-center gap-7 text-[14px] font-semibold text-[#475569]">
        <a href="#promotion" class="hover:text-[#1E3A8A] text-[#1E3A8A] font-bold flex items-center gap-1.5 transition">
          <span class="w-2 h-2 rounded-full bg-[#0284C7] animate-pulse"></span>
          <span data-i18n="nav_promo">End Year Promo</span>
        </a>
        <a href="#packages" class="hover:text-[#1E3A8A] transition" data-i18n="nav_packages">Spa Packages</a>
        <a href="#menu" class="hover:text-[#1E3A8A] transition" data-i18n="nav_menu">Treatment Menu</a>
        <a href="#about" class="hover:text-[#1E3A8A] transition" data-i18n="nav_about">About Us</a>
        <a href="#reviews" class="hover:text-[#1E3A8A] transition" data-i18n="nav_reviews">Reviews (4.8★)</a>
        <a href="#contact" class="hover:text-[#1E3A8A] transition" data-i18n="nav_contact">Location &amp; Hours</a>
      </nav>

      <!-- Header Actions (Bilingual Toggle + WhatsApp + Booking CTA) -->
      <div class="hidden sm:flex items-center gap-3.5">
        
        <!-- Language Switcher Toggle (EN Default Active) -->
        <div class="inline-flex items-center p-0.5 bg-[#F0F8FF] rounded-lg border border-[#BAE0FD] text-[11px] font-bold">
          <button class="lang-btn px-2.5 py-1 rounded-md transition bg-[#1E3A8A] text-white" data-lang="en">EN</button>
          <button class="lang-btn px-2.5 py-1 rounded-md transition text-[#475569] hover:text-[#141E3C]" data-lang="id">ID</button>
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
          <button class="lang-btn px-3 py-1 rounded-md transition bg-[#1E3A8A] text-white" data-lang="en">EN</button>
          <button class="lang-btn px-3 py-1 rounded-md transition text-[#475569]" data-lang="id">ID</button>
        </div>
      </div>

      <a href="#promotion" class="block text-sm font-bold text-[#1E3A8A]" data-i18n="nav_promo">End Year Promo</a>
      <a href="#packages" class="block text-sm font-semibold text-[#141E3C] hover:text-[#1E3A8A]" data-i18n="nav_packages">Spa Packages</a>
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
          <span data-i18n="hero_title_1">{hero_title_1}</span> <br>
          <em class="italic font-normal text-[#0284C7]" data-i18n="hero_title_2">{hero_title_2}</em>
        </h1>

        <p class="text-[#475569] text-base sm:text-lg font-light leading-relaxed max-w-xl" data-i18n="hero_desc">
          {hero_desc}
        </p>

        <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
          <button onclick="openBookingModal()" class="btn-primary" data-i18n="hero_btn_book">
            Book Your Treatment
          </button>
          <a href="#promotion" class="btn-secondary" data-i18n="hero_btn_explore">
            View End Year Promo
          </a>
        </div>

        <div class="pt-6 border-t border-[#BAE0FD] flex items-center gap-4 text-xs text-[#475569]">
          <div class="flex text-amber-500 tracking-tighter text-sm">★★★★★</div>
          <span class="font-bold text-[#141E3C]" data-i18n="stat_rating">4.8★ Verified Reviews</span>
          <span class="text-[#0284C7]">&bull;</span>
          <span data-i18n="stat_count">(560+ Delighted Guests in Canggu)</span>
        </div>
      </div>

      <div class="lg:col-span-6">
        <div class="img-editorial-frame aspect-[4/3] sm:aspect-[16/11] border-2 border-[#BAE0FD] shadow-xl">
          <img src="{hero_image}" alt="Authentic Balinese Massage at Massaji Spa" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='assets/images/MASAGE.JPG';">
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
            <span class="block text-xs sm:text-sm font-bold text-[#141E3C]" data-i18n="trust_1">Authentic Balinese Healing Rituals</span>
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
            <span class="block text-xs sm:text-sm font-bold text-[#141E3C]" data-i18n="trust_4">Private, Serene &amp; Spotless Suites</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 4. SECTION 1: PROMO (END YEAR 2026 BIG PROMOTION) -->
  <!-- ========================================== -->
  <section id="promotion" class="py-20 sm:py-24 bg-gradient-to-b from-[#0F172A] via-[#141E3C] to-[#1E3A8A] text-white relative overflow-hidden">
    <!-- Ambient Festive Glow Elements (Carefully constrained to prevent viewport overflow on Xiaomi & narrow mobile screens) -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-sky-500/15 rounded-full blur-3xl pointer-events-none transform translate-x-1/4 -translate-y-1/4"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none transform -translate-x-1/4 translate-y-1/4"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
      
      <div class="text-center max-w-3xl mx-auto mb-14">
        <!-- Festive Eyebrow Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-gradient-to-r from-amber-400/20 via-sky-400/20 to-amber-400/20 border border-amber-300/40 text-amber-200 text-xs font-bold tracking-[0.2em] uppercase shadow-lg backdrop-blur-sm mb-4">
          <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
          <span data-i18n="promo_eyebrow">Limited-Time Special Offer</span>
        </div>

        <!-- High Impact Hero Headline -->
        <h2 class="festive-headline font-serif text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white mb-4 leading-[1.18]" data-i18n="promo_title">
          {promo_title}
        </h2>
        
        <p class="text-sky-100/90 text-sm sm:text-base font-light max-w-2xl mx-auto leading-relaxed" data-i18n="promo_desc">
          Celebrate the year-end season with curated rejuvenation specials by Massaji Spa Bali. Enjoy exclusive savings on signature massages, body contouring, and rose petal rituals.
        </p>
      </div>

      <!-- 4 Promo Cards Responsive Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
{promo_cards_html}
      </div>

      <!-- Reservation Notice Bar (Flyer Info) - Phone 2 removed as per client markup in Image 3 -->
      <div class="mt-12 p-4 sm:p-5 rounded-2xl bg-white/5 border border-sky-300/20 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-sky-100 backdrop-blur-sm">
        <div class="flex items-center gap-2.5 text-center sm:text-left">
          <svg class="w-5 h-5 text-[#BAE0FD] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span><strong data-i18n="promo_valid_label">Validity Period:</strong> <span data-i18n="promo_validity">{promo_validity}</span></span>
        </div>
        <div class="flex flex-wrap items-center justify-center sm:justify-end gap-3 font-mono font-bold text-white">
          <a href="tel:{clean_phone_1}" class="hover:text-[#BAE0FD] transition flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-lg border border-sky-300/20 shadow-sm">
            <svg class="w-3.5 h-3.5 text-emerald-400 fill-current" viewBox="0 0 24 24"><path d="M6.597 18.193c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            <span>{phone_1}</span>
          </a>
          <button onclick="openPromoPopup()" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-white/15 hover:bg-white/25 border border-sky-300/40 text-[11px] font-sans text-[#BAE0FD] transition cursor-pointer shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <span data-i18n="promo_flyer_btn">Official Promo Flyer</span>
          </button>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 5. SECTION 2: PAKET (CURATED SPA PACKAGES WITH SEARCH) -->
  <!-- ========================================== -->
  <section id="packages" class="py-24 bg-[#F0F8FF]/80 border-b border-[#BAE0FD]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-10">
        <span class="eyebrow-tag" data-i18n="packages_eyebrow">Curated Spa Rituals</span>
        <h2 class="font-serif section-headline text-[#141E3C] mt-2 mb-3">
          Spa <span class="text-[#0284C7] italic font-normal">Packages</span>
        </h2>
        <p class="text-[#475569] text-base font-light" data-i18n="packages_desc">
          Carefully orchestrated multi-hour wellness journeys crafted for solo relaxation, intimate couples retreats, and group pampering sessions in Bali.
        </p>

        <!-- Live Search Bar for Packages -->
        <div class="mt-6 max-w-md mx-auto relative">
          <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#0284C7]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          </div>
          <input 
            type="text" 
            id="package-search-input" 
            placeholder="Search spa packages (e.g., couple, 120 mins, relax, single, boreh)..." 
            data-i18n-placeholder="pkg_search_placeholder"
            class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-[#BAE0FD] bg-white text-xs text-[#141E3C] placeholder-[#94A3B8] focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] shadow-sm">
          <button id="package-search-clear" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#94A3B8] hover:text-[#141E3C] hidden">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <!-- Package Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
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

      <!-- No Packages Found Message -->
      <div id="no-packages-found" class="hidden text-center py-12 bg-white rounded-2xl border border-dashed border-[#BAE0FD] mt-6">
        <p class="text-sm font-bold text-[#141E3C]" data-i18n="pkg_not_found">No packages found matching your search.</p>
        <button onclick="resetPackageSearch()" class="mt-3 px-4 py-1.5 rounded-lg bg-[#1E3A8A] text-white text-xs font-bold uppercase tracking-wider">
          <span data-i18n="pkg_tab_all">All Packages</span>
        </button>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 6. SECTION 3: TREATMENT MENU & PRICING WITH SEARCH -->
  <!-- ========================================== -->
  <section id="menu" class="py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    
    <div class="text-center max-w-3xl mx-auto mb-10">
      <span class="eyebrow-tag" data-i18n="menu_eyebrow">Complete Spa Catalog</span>
      <h2 class="font-serif section-headline text-[#141E3C] mt-2 mb-3">
        Treatment Menu &amp; <span class="text-[#0284C7] italic font-normal">Pricing</span>
      </h2>
      <p class="text-[#475569] text-base font-light" data-i18n="menu_desc">
        Explore our full suite of individual therapies with honest, transparent pricing in Canggu &amp; Kerobokan.
      </p>

      <!-- Live Search Bar for Treatments -->
      <div class="mt-6 max-w-md mx-auto relative">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#0284C7]">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <input 
          type="text" 
          id="menu-search-input" 
          placeholder="Search treatments (e.g., balinese, hot stone, facial, manicure, slimming)..." 
          data-i18n-placeholder="menu_search_placeholder"
          class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-[#BAE0FD] bg-[#F0F8FF]/50 text-xs text-[#141E3C] placeholder-[#94A3B8] focus:outline-none focus:border-[#1E3A8A] focus:bg-white focus:ring-1 focus:ring-[#1E3A8A] shadow-sm">
        <button id="menu-search-clear" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#94A3B8] hover:text-[#141E3C] hidden">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
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

    <!-- No Treatments Found Message -->
    <div id="no-menu-found" class="hidden text-center py-12 bg-[#F0F8FF]/50 rounded-2xl border border-dashed border-[#BAE0FD] mt-6">
      <p class="text-sm font-bold text-[#141E3C]" data-i18n="menu_not_found">No treatments found matching your keywords.</p>
      <button onclick="resetMenuSearch()" class="mt-3 px-4 py-1.5 rounded-lg bg-[#1E3A8A] text-white text-xs font-bold uppercase tracking-wider">
        <span data-i18n="cat_all">All Treatments</span>
      </button>
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
            <img src="{about_image}" alt="Massaji Spa Bali Sanctuary &amp; Reception" class="w-full h-full object-cover" onerror="if (!this.triedPng) {{ this.triedPng = true; this.src = 'assets/images/massaji-reception.jpg'; }} else if (!this.triedRaw) {{ this.triedRaw = true; this.src = 'assets/images/18BB6F9B-4ACE-49DF-9AE1-610D3B65BA60.png'; }} else {{ this.onerror = null; this.src = 'assets/images/gambar2.jpg'; }}">
          </div>
        </div>

        <!-- Right: Editorial Brand Narrative -->
        <div class="lg:col-span-7 space-y-6">
          <span class="eyebrow-tag" data-i18n="about_eyebrow">About Massaji Spa</span>
          
          <h2 class="font-serif section-headline text-[#141E3C]">
            <span data-i18n="about_title_1">{about_title_1}</span> <br>
            <em class="italic font-normal text-[#0284C7]" data-i18n="about_title_2">{about_title_2}</em>
          </h2>

          <p class="text-[#475569] text-base leading-relaxed font-light" data-i18n="about_desc_1">
            {about_desc_1}
          </p>

          <p class="text-[#475569] text-base leading-relaxed font-light" data-i18n="about_desc_2">
            {about_desc_2}
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-[#BAE0FD]">
            <div>
              <h4 class="font-bold text-sm text-[#141E3C] mb-1" data-i18n="about_val_1">Pure Botanical Oils</h4>
              <p class="text-xs text-[#475569]" data-i18n="about_val_1_desc">Fresh frangipani, uplifting lemongrass, calming lavender, and native spice blends.</p>
            </div>
            <div>
              <h4 class="font-bold text-sm text-[#141E3C] mb-1" data-i18n="about_val_2">Five-Star Hygiene</h4>
              <p class="text-xs text-[#475569]" data-i18n="about_val_2_desc">Crisp, freshly laundered linens and sanitized private suites for every single guest.</p>
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
        <span class="eyebrow-tag" data-i18n="reviews_eyebrow">Guest Experiences</span>
        <h2 class="font-serif section-headline text-[#141E3C] mt-2 mb-3" data-i18n="reviews_title">
          Cherished by Travelers Worldwide
        </h2>
        <p class="text-[#475569] text-sm sm:text-base font-light" data-i18n="reviews_summary">
          Rated 4.8 out of 5.0 across 560+ verified reviews in Canggu &amp; Kerobokan.
        </p>
      </div>

      <!-- Review Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="treatment-card p-6 flex flex-col justify-between">
          <div>
            <div class="flex text-amber-500 text-sm mb-3">★★★★★</div>
            <p class="text-xs sm:text-sm text-[#475569] leading-relaxed mb-6 font-light italic" data-i18n="review_1_text">
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
            <p class="text-xs sm:text-sm text-[#475569] leading-relaxed mb-6 font-light italic" data-i18n="review_2_text">
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
            <p class="text-xs sm:text-sm text-[#475569] leading-relaxed mb-6 font-light italic" data-i18n="review_3_text">
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
        <span class="eyebrow-tag" data-i18n="contact_eyebrow">Visit Our Sanctuary</span>
        
        <h2 class="font-serif section-headline text-[#141E3C]" data-i18n="contact_title">
          Location &amp; Opening Hours
        </h2>

        <p class="text-[#475569] text-base font-light leading-relaxed" data-i18n="contact_desc">
          Conveniently situated along the main Canggu / Kerobokan route with secure, dedicated on-site parking for scooters and cars.
        </p>

        <div class="space-y-4 pt-2 text-sm text-[#475569]">
          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#E1F0FE] flex items-center justify-center text-[#1E3A8A] flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
              <span class="font-bold text-[#141E3C] block" data-i18n="contact_address_label">Sanctuary Address</span>
              <span>Jl. Raya Canggu, Gg. Bedugul No. 3, Kerobokan, Canggu, Bali 80361</span>
              <div class="mt-2.5">
                <a href="https://www.google.com/maps/place/Massaji+Spa+Bali/@-8.6451761,115.1593768,17z/data=!3m1!4b1!4m6!3m5!1s0x2dd23899b3c269db:0x6cdb2c83c3f02d7c!8m2!3d-8.6451761!4d115.1619517!16s%2Fg%2F11c3k2xsjl" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-[#0284C7] hover:bg-[#1E3A8A] text-white font-bold text-xs shadow-sm hover:shadow transition-all duration-200">
                  <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                  <span data-i18n="contact_maps_link">Get Directions in Google Maps &rarr;</span>
                </a>
              </div>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#E1F0FE] flex items-center justify-center text-[#1E3A8A] flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <span class="font-bold text-[#141E3C] block" data-i18n="contact_hours_label">Visiting Hours</span>
              <span data-i18n="contact_hours_val">Daily: 10:00 AM – 9:00 PM WITA</span>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-800 flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4 fill-current text-emerald-700" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </div>
            <div>
              <span class="font-bold text-[#141E3C] block" data-i18n="contact_chat_label">Instant WhatsApp Booking</span>
              <a href="{wa_url}" target="_blank" class="text-emerald-800 font-bold hover:underline">
                +62 812-3669-5755 (WhatsApp Direct)
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Map Embed -->
      <div class="lg:col-span-7">
        <div class="img-editorial-frame aspect-[16/10] border border-[#BAE0FD] shadow-lg overflow-hidden rounded-2xl relative">
          <iframe 
            title="Massaji Spa Bali Location Map"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.5126868516086!2d115.1593768!3d-8.6451761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23899b3c269db%3A0x6cdb2c83c3f02d7c!2sMassaji%20Spa%20Bali!5e0!3m2!1sen!2sid!4v1730270000000!5m2!1sen!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            class="w-full h-full">
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
          <p class="text-white/60 leading-relaxed font-light" data-i18n="footer_tagline">
            Authentic Balinese Massage, Curated Spa Packages &amp; Holistic Wellness Sanctuary in Kerobokan and Canggu.
          </p>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-[11px]" data-i18n="footer_explore">Explore</h4>
          <ul class="space-y-2.5 font-light">
            <li><a href="#promotion" class="hover:text-white transition" data-i18n="nav_promo">End Year Promo</a></li>
            <li><a href="#packages" class="hover:text-white transition" data-i18n="nav_packages">Spa Packages</a></li>
            <li><a href="#menu" class="hover:text-white transition" data-i18n="nav_menu">Treatment Menu</a></li>
            <li><a href="#about" class="hover:text-white transition" data-i18n="nav_about">About Us</a></li>
            <li><a href="#reviews" class="hover:text-white transition" data-i18n="nav_reviews">Guest Reviews</a></li>
          </ul>
        </div>

        <!-- Operating Hours -->
        <div>
          <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-[11px]" data-i18n="footer_visiting_hours_title">Visiting Hours</h4>
          <p class="text-white/80 font-medium mb-1" data-i18n="footer_visiting_days">Open Every Day</p>
          <p class="text-white/60 mb-3" data-i18n="contact_hours_val">10:00 AM – 9:00 PM WITA</p>
          <p class="text-white/60 text-[11px]" data-i18n="footer_visiting_note">Prior booking via WhatsApp is recommended to secure your preferred private treatment suite.</p>
        </div>

        <!-- Admin & Direct Reservation -->
        <div>
          <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-[11px]" data-i18n="footer_contact_title">Direct Contact</h4>
          <p class="text-white/80 mb-2">WhatsApp: +62 812-3669-5755</p>
          <p class="text-white/80 mb-4">Phone: +62 811-3857-188</p>
          <a href="admin/" class="inline-flex items-center gap-1.5 text-[11px] text-[#BAE0FD] hover:underline font-semibold">
            <span data-i18n="footer_admin_link">Staff / Admin Portal &rarr;</span>
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
  <!-- 11. PROMO FLYER POPUP MODAL (AUTO-POPUP FIRST VISIT) -->
  <!-- ========================================== -->
  <div id="promo-flyer-popup" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-md hidden items-center justify-center p-3 sm:p-5 transition-all duration-300">
    <div class="bg-gradient-to-br from-[#141E3C] via-[#1E3A8A] to-[#141E3C] text-white rounded-3xl max-w-md sm:max-w-lg w-full p-5 sm:p-6 shadow-2xl border-2 border-sky-300/40 relative max-h-[92vh] overflow-y-auto flex flex-col items-center">
      
      <!-- Close Button -->
      <button onclick="closePromoPopup()" class="absolute top-3.5 right-3.5 p-2 rounded-full bg-white/10 hover:bg-white/25 text-white/80 hover:text-white transition cursor-pointer" title="Close Popup">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Badge Header -->
      <div class="text-center mb-3">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-400 text-[#141E3C] font-extrabold text-[10px] sm:text-xs uppercase tracking-widest shadow-md" data-i18n="popup_badge">
          🎉 SPECIAL LIMITED OFFER
        </span>
        <h3 class="font-sans text-xl sm:text-2xl md:text-3xl font-black uppercase tracking-wider text-white mt-2 mb-1 leading-tight drop-shadow-md" data-i18n="popup_title">
          END YEAR 2026 <span class="text-amber-300">BIG PROMOTION</span>
        </h3>
        <p class="text-sky-200 text-xs font-medium tracking-wide mt-1" data-i18n="popup_validity">
          {promo_validity}
        </p>
      </div>

      <!-- Flyer Image with Zoom Effect -->
      <div class="w-full rounded-2xl overflow-hidden border border-sky-300/30 shadow-xl bg-black/30 mb-4 flex items-center justify-center">
        <img src="{promo_flyer_image}" alt="Massaji Spa End Year Promotion Flyer" class="w-full h-auto max-h-[48vh] object-contain cursor-pointer hover:scale-[1.02] transition duration-300" onclick="closePromoPopup(); window.location.href='#promotion';">
      </div>

      <!-- Action Buttons Bar -->
      <div class="w-full flex flex-col sm:flex-row items-center gap-2.5 pt-1">
        <a href="https://wa.me/6281236695755?text=Hello%20Massaji%20Spa%2C%20I%20would%20like%20to%20claim%20the%20End%20Year%202026%20Big%20Promotion." target="_blank" id="popup-wa-btn" class="w-full sm:flex-1 py-3 px-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs uppercase tracking-wider text-center shadow-lg transition flex items-center justify-center gap-2">
          <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
          <span data-i18n="popup_btn_wa">Claim Promo via WhatsApp</span>
        </a>
        <button onclick="closePromoPopup(); window.location.href='#promotion';" class="w-full sm:w-auto py-3 px-4 rounded-xl bg-white/10 hover:bg-white/20 text-[#BAE0FD] font-bold text-xs uppercase tracking-wider text-center transition cursor-pointer" data-i18n="popup_btn_explore">
          Explore Promo Details &rarr;
        </button>
      </div>

      <button onclick="closePromoPopup()" class="mt-2.5 text-[11px] text-white/50 hover:text-white/80 transition underline cursor-pointer" data-i18n="popup_btn_skip">
        Continue to Website
      </button>

    </div>
  </div>

  <!-- ========================================== -->
  <!-- 12. INTERACTIVE BOOKING MODAL -->
  <!-- ========================================== -->
  <div id="booking-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-[#BAE0FD] relative my-8">
      
      <!-- Close Button -->
      <button id="modal-close-btn" class="absolute top-5 right-5 p-2 rounded-full text-[#475569] hover:text-[#141E3C] hover:bg-[#F0F8FF] transition cursor-pointer">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Booking Form -->
      <form id="booking-form" class="space-y-4">
        <div>
          <span class="text-[10px] font-bold uppercase tracking-widest text-[#0284C7] block mb-1" data-i18n="modal_eyebrow">Direct Reservation</span>
          <h3 class="font-serif text-2xl sm:text-3xl font-bold text-[#141E3C]" data-i18n="modal_title">Reserve Your Spa Session</h3>
          <p class="text-xs text-[#475569] mt-1 font-light" data-i18n="modal_desc">
            Your appointment request will be promptly delivered to our receptionist for instant confirmation via WhatsApp.
          </p>
        </div>

        <div class="space-y-3 pt-2">
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_name">Full Name *</label>
            <input type="text" name="name" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#BAE0FD] text-sm focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] bg-[#F0F8FF]/30" placeholder="e.g. Sarah Jenkins / Michael" data-i18n-placeholder="modal_name_placeholder">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_phone">WhatsApp / Mobile Number *</label>
              <input type="tel" name="phone" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#BAE0FD] text-sm focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] bg-[#F0F8FF]/30" placeholder="e.g. +62 812-3456-7890" data-i18n-placeholder="modal_phone_placeholder">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_email">Email Address (Optional)</label>
              <input type="email" name="email" class="w-full px-3.5 py-2.5 rounded-xl border border-[#BAE0FD] text-sm focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] bg-[#F0F8FF]/30" placeholder="sarah@example.com">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_service">Select Treatment or Package *</label>
            <select name="service" id="booking-service" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#BAE0FD] text-sm focus:outline-none focus:border-[#1E3A8A] focus:ring-1 focus:ring-[#1E3A8A] bg-white">
{dropdown_options_html}
            </select>
          </div>

          <div class="grid grid-cols-3 gap-3">
            <div class="col-span-1">
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_date">Appointment Date *</label>
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
              <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_guests">Number of Guests</label>
              <select name="guests" class="w-full px-3 py-2 rounded-xl border border-[#BAE0FD] text-xs focus:outline-none focus:border-[#1E3A8A] bg-white">
                <option value="1" data-i18n="modal_guest_1">1 Person</option>
                <option value="2" data-i18n="modal_guest_2" selected>2 Persons</option>
                <option value="3" data-i18n="modal_guest_3">3 Persons</option>
                <option value="4" data-i18n="modal_guest_4">4 Persons</option>
                <option value="5+" data-i18n="modal_guest_5">5+ Persons</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#141E3C] mb-1" data-i18n="modal_label_notes">Special Requests (Optional)</label>
            <textarea name="notes" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-[#BAE0FD] text-xs focus:outline-none focus:border-[#1E3A8A] bg-[#F0F8FF]/30" placeholder="Therapist preferences, tension focus areas, or anniversary celebration..." data-i18n-placeholder="modal_notes_placeholder"></textarea>
          </div>
        </div>

        <div id="booking-error-msg" class="hidden text-xs text-rose-600 bg-rose-50 p-2.5 rounded-lg border border-rose-200"></div>

        <button type="submit" id="booking-submit-btn" class="w-full py-3.5 rounded-xl bg-[#1E3A8A] hover:bg-[#141E3C] text-white font-bold text-xs uppercase tracking-wider shadow-lg transition duration-200 cursor-pointer" data-i18n="modal_submit">
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
          Your appointment request has been received. Please confirm directly on WhatsApp for instant confirmation.
        </p>
        <div class="pt-4 flex flex-col gap-2.5">
          <a id="wa-confirm-link" href="#" target="_blank" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider shadow transition flex items-center justify-center gap-2" data-i18n="modal_btn_wa">
            Confirm Instantly on WhatsApp
          </a>
          <button onclick="closeBookingModal()" class="w-full py-2.5 rounded-xl border border-[#BAE0FD] text-[#475569] hover:bg-[#F0F8FF] font-bold text-xs uppercase tracking-wider transition cursor-pointer" data-i18n="modal_btn_close">
            Close Window
          </button>
        </div>
      </div>

    </div>
  </div>

  <!-- Main JavaScript File -->
  <script src="assets/js/main.js?v=20261029d"></script>
</body>
</html>'''

# Write to index.php (for live PHP hosting & local server)
with open(f'{WEBSITE_DIR}/index.php', 'w') as f:
    f.write(html_template)

# Also write to index.html (for GitHub Pages live preview at https://eyestetix.github.io/massajispa/)
with open(f'{WEBSITE_DIR}/index.html', 'w') as f:
    f.write(html_template)

# Remove obsolete preview.html
if os.path.exists(f'{WEBSITE_DIR}/preview.html'):
    try:
        os.remove(f'{WEBSITE_DIR}/preview.html')
    except Exception:
        pass

print("Successfully compiled bilingual site to index.php (hosting) and index.html (GitHub Pages preview).")

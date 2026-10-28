import json
import html
import re

WEBSITE_DIR = '/Volumes/PROJECTS/EYESTETIX_BACKUP_2026-09-30/WEBSITE'

with open(f'{WEBSITE_DIR}/data/settings.json') as f:
    s = json.load(f)
with open(f'{WEBSITE_DIR}/data/promo.json') as f:
    p = json.load(f)
with open(f'{WEBSITE_DIR}/data/menu.json') as f:
    menu = json.load(f)

clean_wa = ''.join(c for c in s.get('whatsapp_number', '') if c.isdigit())
if clean_wa.startswith('0'):
    clean_wa = '62' + clean_wa[1:]

wa_url = f'https://wa.me/{clean_wa}?text=' + 'Halo%20' + s.get('site_name', 'Massaji%20Spa') + '%2C%20saya%20ingin%20bertanya%20ketersediaan%20jadwal%20perawatan%20spa.'

# ==========================================
# 1. BUILD PUBLIC index.html
# ==========================================
with open(f'{WEBSITE_DIR}/index.php') as f:
    raw = f.read()

doc_start = raw.find('<!DOCTYPE html>')
content = raw[doc_start:]

# Promo replacement
if p.get('active'):
    promo_badge = html.escape(p.get('badge', 'Promo'))
    promo_title = html.escape(p.get('title', ''))
    promo_desc = html.escape(p.get('description', ''))
    promo_code = html.escape(p.get('code', ''))
    promo_code_html = f'<span class="hidden md:inline-block font-mono bg-black/30 px-2 py-0.5 rounded text-xs border border-white/20">Kode: {promo_code}</span>' if promo_code else ''
    
    promo_block = f'''
    <div class="bg-gradient-to-r from-brand-terracotta via-amber-700 to-brand-terracotta text-white py-2 px-4 text-center text-xs sm:text-sm font-medium tracking-wide flex items-center justify-center gap-2 relative z-50">
      <span class="px-2 py-0.5 rounded-full bg-white/20 text-[11px] font-bold uppercase tracking-wider">{promo_badge}</span>
      <span><strong>{promo_title}</strong> — {promo_desc}</span>
      {promo_code_html}
      <button onclick="openBookingModal('{promo_title}')" class="underline hover:text-stone-200 ml-2 font-semibold text-xs whitespace-nowrap">Klaim Promo &rarr;</button>
    </div>
    '''
else:
    promo_block = ''

content = re.sub(r'<\?php\s+if\s*\(!empty\(\$promo\[[\'"]active[\'"]\]\)\):\s*\?>.*?<\?php\s*endif;\s*\?>', promo_block, content, flags=re.DOTALL)

# Cards & Dropdown
cat_names = {
    'massage': 'Body Massage',
    'beauty': 'Facial & Scrub',
    'reflexology': 'Reflexology',
    'packages': 'Signature Package'
}

cards_list = []
options_list = []

for item in menu:
    featured_badge = ''
    if item.get('is_featured'):
        tag = html.escape(item.get('tag', 'Populer'))
        featured_badge = f'''
        <div class="absolute -top-3 -right-3 w-20 h-20 overflow-hidden pointer-events-none">
          <span class="absolute top-4 right-[-24px] transform rotate-45 bg-brand-terracotta text-white text-[9px] font-bold uppercase tracking-wider py-1 px-7 shadow">
            {tag}
          </span>
        </div>
        '''

    cat_label = cat_names.get(item.get('category'), item.get('category', 'massage'))
    formatted_price = f"{item.get('price', 0):,}".replace(',', '.')
    escaped_name = html.escape(item.get('name', ''))
    safe_js_name = escaped_name.replace("'", "\\'")
    
    options_list.append(f'<option value="{escaped_name}">{escaped_name} (Rp {formatted_price})</option>')

    cards_list.append(f'''
    <div class="treatment-card bg-brand-surfaceCard border border-stone-800/90 rounded-2xl p-6 flex flex-col justify-between relative overflow-hidden" data-category="{html.escape(item.get('category', 'massage'))}">
      {featured_badge}
      <div>
        <div class="flex items-center justify-between text-xs mb-3">
          <span class="text-brand-gold font-medium uppercase tracking-wider text-[11px]">{cat_label}</span>
          <span class="text-stone-400 font-mono text-[11px] flex items-center gap-1">
            <svg class="w-3 h-3 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {html.escape(item.get('duration', ''))}
          </span>
        </div>
        <h3 class="font-serif text-2xl font-semibold text-stone-100 mb-2 leading-snug">{escaped_name}</h3>
        <p class="text-stone-400 text-xs sm:text-sm font-light leading-relaxed mb-6">{html.escape(item.get('description', ''))}</p>
      </div>
      <div class="pt-4 border-t border-stone-800/80 flex items-center justify-between">
        <div>
          <span class="text-[10px] text-stone-500 uppercase tracking-wider block">Harga Mulai</span>
          <span class="font-serif text-xl sm:text-2xl font-bold text-brand-gold font-mono">Rp {formatted_price}</span>
        </div>
        <button onclick="openBookingModal('{safe_js_name}')" class="px-4 py-2 rounded-xl bg-stone-900 hover:bg-brand-terracotta text-stone-200 hover:text-white border border-stone-700 hover:border-brand-terracotta text-xs font-semibold tracking-wider uppercase transition duration-200 flex items-center gap-1.5 shadow">
          <span>Pesan</span>
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
      </div>
    </div>
    ''')

cards_html = '\n'.join(cards_list)
options_html = '\n'.join(options_list)

content = re.sub(r'<\?php\s+foreach\s*\(\$menu\s+as\s+\$item\):\s*\?>.*?<\?php\s*endforeach;\s*\?>', cards_html, content, count=1, flags=re.DOTALL)
content = re.sub(r'<\?php\s+foreach\s*\(\$menu\s+as\s+\$m\):\s*\?>.*?<\?php\s*endforeach;\s*\?>', options_html, content, count=1, flags=re.DOTALL)

# Simple replacements
content = re.sub(r'<\?php\s+echo\s+htmlspecialchars\(\$settings\[[\'"](.*?)[\'"]\]\);\s*\?>', lambda m: html.escape(str(s.get(m.group(1), ''))), content)
content = re.sub(r'<\?php\s+echo\s+\$wa_url;\s*\?>', wa_url, content)
content = re.sub(r'<\?php\s+echo\s+htmlspecialchars\(\$clean_wa\);\s*\?>', clean_wa, content)
content = re.sub(r'<\?php\s+echo\s+date\([\'"]Y[\'"]\);\s*\?>', '2026', content)
content = re.sub(r'<\?php\s+echo\s+count\(\$menu\);\s*\?>', str(len(menu)), content)

# Change link to admin
content = content.replace('admin/login.php', 'admin/')

with open(f'{WEBSITE_DIR}/index.html', 'w') as f:
    f.write(content)

# ==========================================
# 2. BUILD ADMIN index.html
# ==========================================
with open(f'{WEBSITE_DIR}/admin/index.php') as f:
    raw_admin = f.read()

admin_doc_start = raw_admin.find('<!DOCTYPE html>')
admin_content = raw_admin[admin_doc_start:]

bookings = []
try:
    with open(f'{WEBSITE_DIR}/data/bookings.json') as f:
        bookings = json.load(f)
except Exception:
    bookings = []

admin_content = re.sub(r'<\?php\s+echo\s+htmlspecialchars\(\$settings\[[\'"](.*?)[\'"]\]\);\s*\?>', lambda m: html.escape(str(s.get(m.group(1), ''))), admin_content)
admin_content = re.sub(r'<\?php\s+echo\s+count\(\$menu\);\s*\?>', str(len(menu)), admin_content)
admin_content = re.sub(r'<\?php\s+echo\s+count\(\$bookings\);\s*\?>', str(len(bookings)), admin_content)
admin_content = admin_content.replace('<?php echo htmlspecialchars($csrf_token); ?>', 'demo-csrf-token')

# Promo active indicator
promo_active_badge = '<span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>' if p.get('active') else ''
admin_content = re.sub(r'<\?php\s+if\s*\(!empty\(\$promo\[[\'"]active[\'"]\]\)\):\s*\?>.*?<\?php\s*endif;\s*\?>', promo_active_badge, admin_content, flags=re.DOTALL)

# Promo form fields
admin_content = admin_content.replace("<?php echo !empty($promo['active']) ? 'checked' : ''; ?>", 'checked' if p.get('active') else '')
admin_content = admin_content.replace("<?php echo !empty($promo['active']) ? 'Aktif' : 'Non-aktif'; ?>", 'Aktif' if p.get('active') else 'Non-aktif')
admin_content = admin_content.replace("<?php echo !empty($promo['active']) ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-stone-800 text-stone-400'; ?>", 'bg-emerald-950 text-emerald-400 border border-emerald-800' if p.get('active') else 'bg-stone-800 text-stone-400')
admin_content = admin_content.replace("<?php echo htmlspecialchars($promo['badge'] ?? 'Special Rejuvenation Offer'); ?>", html.escape(p.get('badge', 'Special Rejuvenation Offer')))
admin_content = admin_content.replace("<?php echo htmlspecialchars($promo['code'] ?? 'MASSAJI15'); ?>", html.escape(p.get('code', 'MASSAJI15')))
admin_content = admin_content.replace("<?php echo htmlspecialchars($promo['title'] ?? ''); ?>", html.escape(p.get('title', '')))
admin_content = admin_content.replace("<?php echo htmlspecialchars($promo['description'] ?? ''); ?>", html.escape(p.get('description', '')))
admin_content = admin_content.replace("<?php echo htmlspecialchars($promo['valid_until'] ?? ''); ?>", html.escape(p.get('valid_until', '')))

# Admin menu cards list
admin_menu_cards = []
for item in menu:
    tag_html = f'<span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-brand-terracotta/20 text-brand-terracotta border border-brand-terracotta/30">{html.escape(item.get("tag", "Featured"))}</span>' if item.get('is_featured') else ''
    formatted_price = f"{item.get('price', 0):,}".replace(',', '.')
    escaped_json = html.escape(json.dumps(item))
    safe_name = html.escape(item.get('name', ''))
    safe_js_name = safe_name.replace("'", "\\'")

    admin_menu_cards.append(f'''
    <div class="menu-card bg-brand-surface border border-stone-800 rounded-xl p-5 hover:border-stone-700 transition flex flex-col justify-between" data-category="{html.escape(item.get('category', 'massage'))}">
      <div>
        <div class="flex items-start justify-between gap-3">
          <div>
            <div class="flex items-center gap-2">
              <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-stone-800 text-brand-gold">
                {html.escape(item.get('category', 'massage'))}
              </span>
              {tag_html}
            </div>
            <h3 class="font-serif text-lg font-semibold text-stone-100 mt-2">{safe_name}</h3>
          </div>
          <div class="text-right flex-shrink-0">
            <span class="text-brand-gold font-mono font-bold text-base">Rp {formatted_price}</span>
            <p class="text-[11px] text-stone-400 font-sans mt-0.5">{html.escape(item.get('duration', ''))}</p>
          </div>
        </div>
        <p class="text-xs text-stone-400 mt-2.5 line-clamp-2 leading-relaxed">{html.escape(item.get('description', ''))}</p>
      </div>

      <div class="mt-4 pt-4 border-t border-stone-800/80 flex items-center justify-between">
        <span class="text-[11px] text-stone-500 font-mono">ID: {html.escape(item.get('id', ''))}</span>
        <div class="flex items-center gap-2">
          <button onclick="editMenuItem({escaped_json})" class="px-3 py-1 bg-stone-800 hover:bg-stone-700 text-stone-300 text-xs rounded-lg transition flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit
          </button>
          <button onclick="deleteMenuItem('{html.escape(item.get('id', ''))}', '{safe_js_name}')" class="px-3 py-1 bg-red-950/40 hover:bg-red-900/60 text-red-300 text-xs rounded-lg border border-red-900/40 transition flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Hapus
          </button>
        </div>
      </div>
    </div>
    ''')

admin_cards_html = '\n'.join(admin_menu_cards)
admin_content = re.sub(r'<\?php\s+foreach\s*\(\$menu\s+as\s+\$index\s+=>\s+\$item\):\s*\?>.*?<\?php\s*endforeach;\s*\?>', admin_cards_html, admin_content, flags=re.DOTALL)

# Handle bookings table in admin
bookings_rows = []
for b in bookings:
    guest_phone = ''.join(c for c in b.get('phone', '') if c.isdigit())
    if guest_phone.startswith('0'):
        guest_phone = '62' + guest_phone[1:]
    reply_text = f"Halo {b.get('name', 'Kak')}, kami dari Massaji Spa Bali ingin mengonfirmasi jadwal reservasi untuk {b.get('service', 'Spa')} pada {b.get('date', '')} jam {b.get('time', '')} WITA."
    wa_reply_url = f"https://wa.me/{guest_phone}?text=" + html.escape(reply_text)
    
    bookings_rows.append(f'''
    <tr class="hover:bg-stone-900/40 transition">
      <td class="p-3 font-mono text-[11px] text-stone-500">{html.escape(b.get('created_at', '-'))}</td>
      <td class="p-3 font-medium text-stone-100">{html.escape(b.get('name', '-'))}</td>
      <td class="p-3 font-semibold text-brand-gold">{html.escape(b.get('service', '-'))}</td>
      <td class="p-3">{html.escape(b.get('date', '-'))} <span class="text-stone-500">({html.escape(b.get('time', '-'))})</span></td>
      <td class="p-3">{html.escape(str(b.get('guests', 1)))} orang</td>
      <td class="p-3 font-mono">
        <div>{html.escape(b.get('phone', '-'))}</div>
        <div class="text-[10px] text-stone-500">{html.escape(b.get('email', ''))}</div>
      </td>
      <td class="p-3 text-right">
        <a href="{wa_reply_url}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-950/60 hover:bg-emerald-900 border border-emerald-700/50 text-emerald-300 text-[11px] font-medium transition">
          Chat WA
        </a>
      </td>
    </tr>
    ''')

if bookings:
    rows_html = '\n'.join(bookings_rows)
    admin_content = re.sub(r'<\?php\s+foreach\s*\(\$bookings\s+as\s+\$b\):\s*\?>.*?<\?php\s*endforeach;\s*\?>', rows_html, admin_content, flags=re.DOTALL)
    # Remove empty check wrapper
    admin_content = re.sub(r'<\?php\s+if\s*\(empty\(\$bookings\)\):\s*\?>.*?<\?php\s*else:\s*\?>', '', admin_content, flags=re.DOTALL)
    admin_content = admin_content.replace('<?php endif; ?>', '')
else:
    # Keep empty state
    admin_content = re.sub(r'<\?php\s+if\s*\(empty\(\$bookings\)\):\s*\?>', '', admin_content)
    admin_content = re.sub(r'<\?php\s*else:\s*\?>.*?<\?php\s*endif;\s*\?>', '', admin_content, flags=re.DOTALL)

# In admin JS: inject menu items
admin_content = admin_content.replace('<?php echo json_encode($menu); ?>', json.dumps(menu))
admin_content = admin_content.replace('../index.php', '/')

with open(f'{WEBSITE_DIR}/admin/index.html', 'w') as f:
    f.write(admin_content)

print('Build completed! index.html and admin/index.html are ready.')

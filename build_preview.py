import json
import html
import re

WEBSITE_DIR = '/Volumes/PROJECTS/EYESTETIX_BACKUP_2026-09-30/WEBSITE'

with open(f'{WEBSITE_DIR}/data/settings.json') as f:
    s = json.load(f)
with open(f'{WEBSITE_DIR}/data/menu.json') as f:
    menu = json.load(f)

clean_wa = ''.join(c for c in s.get('whatsapp_number', '') if c.isdigit())
if clean_wa.startswith('0'):
    clean_wa = '62' + clean_wa[1:]

wa_url = f'https://wa.me/{clean_wa}?text=' + 'Hello%20' + s.get('site_name', 'Massaji%20Spa') + '%2C%20I%20would%20like%20to%20check%20availability%20for%20a%20spa%20treatment.'

# ==========================================
# 1. BUILD PUBLIC index.html
# ==========================================
with open(f'{WEBSITE_DIR}/index.php') as f:
    raw = f.read()

doc_start = raw.find('<!DOCTYPE html>')
content = raw[doc_start:]

# Category names dictionary
cat_names = {
    'massage': 'Body Massage',
    'beauty': 'Facial & Scrub',
    'reflexology': 'Reflexology',
    'packages': 'Signature Package'
}

cards_list = []
options_list = []

for item in menu:
    tag_badge = ''
    if item.get('is_featured'):
        tag = html.escape(item.get('tag', 'Featured'))
        tag_badge = f'''
        <div class="mb-1.5">
          <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-[#E1F0FE] text-[#1E3A8A] border border-[#BAE0FD]">
            {tag}
          </span>
        </div>
        '''

    cat_label = cat_names.get(item.get('category'), item.get('category', 'massage'))
    formatted_price = f"{item.get('price', 0):,}".replace(',', '.')
    escaped_name = html.escape(item.get('name', ''))
    safe_js_name = escaped_name.replace("'", "\\'")
    
    options_list.append(f'<option value="{escaped_name}">{escaped_name} (Rp {formatted_price})</option>')

    # Menu card WITHOUT image (as requested by user)
    cards_list.append(f'''
    <div class="treatment-card p-4 sm:p-5 flex flex-col justify-between" data-category="{html.escape(item.get('category', 'massage'))}">
      <div>
        <div class="flex items-center justify-between text-xs mb-1.5">
          <span class="text-[#0284C7] font-bold uppercase tracking-wider text-[11px]">{cat_label}</span>
          <span class="text-[#64748B] font-mono text-[11px] flex items-center gap-1 font-semibold">
            <svg class="w-3.5 h-3.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {html.escape(item.get('duration', ''))}
          </span>
        </div>
        {tag_badge}
        <h3 class="font-serif text-xl sm:text-[22px] font-bold text-[#141E3C] leading-snug mb-2">
          {escaped_name}
        </h3>
        <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-4">
          {html.escape(item.get('description', ''))}
        </p>
      </div>
      <div class="mt-auto pt-3 border-t border-[#BAE0FD]/70 flex items-center justify-between">
        <div>
          <span class="text-[10px] text-[#64748B] uppercase tracking-wider block font-bold" data-i18n="card_rate">Nett Price</span>
          <span class="font-serif text-xl sm:text-2xl font-bold text-[#0284C7] font-mono">Rp {formatted_price}</span>
        </div>
        <button onclick="openBookingModal('{safe_js_name}')" class="btn-primary py-2 px-3.5 text-xs" data-i18n="card_btn_book">
          Book Treatment
        </button>
      </div>
    </div>
    ''')

cards_html = '\n'.join(cards_list)
options_html = '\n'.join(options_list)

# Replace cards loop
content = re.sub(r'<\?php\s+foreach\s*\(\$menu\s+as\s+\$item\):\s*\?>.*?<\?php\s*endforeach;\s*\?>', cards_html, content, count=1, flags=re.DOTALL)
# Replace dropdown loop
content = re.sub(r'<\?php\s+foreach\s*\(\$menu\s+as\s+\$m\):\s*\?>.*?<\?php\s*endforeach;\s*\?>', options_html, content, count=1, flags=re.DOTALL)

# Simple replacements
content = re.sub(r'<\?php\s+echo\s+htmlspecialchars\(\$settings\[[\'"](.*?)[\'"]\]\);\s*\?>', lambda m: html.escape(str(s.get(m.group(1), ''))), content)
content = re.sub(r'<\?php\s+echo\s+\$wa_url;\s*\?>', wa_url, content)
content = re.sub(r'<\?php\s+echo\s+htmlspecialchars\(\$clean_wa\);\s*\?>', clean_wa, content)
content = re.sub(r'<\?php\s+echo\s+date\([\'"]Y[\'"]\);\s*\?>', '2026', content)
content = re.sub(r'<\?php\s+echo\s+count\(\$menu\);\s*\?>', str(len(menu)), content)

# Change link to admin for GitHub Pages
content = content.replace('admin/login.php', 'admin/')

with open(f'{WEBSITE_DIR}/index.html', 'w') as f:
    f.write(content)

with open(f'{WEBSITE_DIR}/preview.html', 'w') as f:
    f.write(content)

print('Compiled index.html and preview.html without menu card images successfully!')

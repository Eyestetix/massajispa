#!/usr/bin/env python3
import http.server
import socketserver
import os
import json
import urllib.parse
import subprocess
from datetime import datetime

PORT = 8080
DIRECTORY = '/Volumes/PROJECTS/EYESTETIX_BACKUP_2026-09-30/WEBSITE'

# Map .php files to render directly as HTML in browser (PHP-Only preview mode)
http.server.SimpleHTTPRequestHandler.extensions_map['.php'] = 'text/html; charset=utf-8'

class SpaPreviewHandler(http.server.SimpleHTTPRequestHandler):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, directory=DIRECTORY, **kwargs)

    def do_GET(self):
        # Route clean paths
        parsed = urllib.parse.urlparse(self.path)
        path = parsed.path

        if path in ('/', '/index.html', '/index.php'):
            self.path = '/index.php'
        elif path in ('/admin', '/admin/', '/admin/index.php'):
            self.path = '/admin/index.html'

        return super().do_GET()

    def do_POST(self):
        parsed = urllib.parse.urlparse(self.path)
        path = parsed.path

        content_length = int(self.headers.get('Content-Length', 0))
        post_body = self.rfile.read(content_length)

        # Parse form data (supporting multipart and urlencoded)
        content_type = self.headers.get('Content-Type', '')
        fields = {}

        if 'application/x-www-form-urlencoded' in content_type:
            fields = {k: v[0] for k, v in urllib.parse.parse_qs(post_body.decode('utf-8', errors='ignore')).items()}
        elif 'multipart/form-data' in content_type:
            # Simple multipart parser
            boundary = content_type.split('boundary=')[-1].encode('utf-8')
            parts = post_body.split(b'--' + boundary)
            for part in parts:
                if b'Content-Disposition: form-data;' in part:
                    header, _, body = part.partition(b'\r\n\r\n')
                    body = body.rstrip(b'\r\n')
                    m_name = None
                    for line in header.decode('utf-8', errors='ignore').split('\r\n'):
                        if 'name="' in line:
                            m_name = line.split('name="')[1].split('"')[0]
                    if m_name:
                        fields[m_name] = body.decode('utf-8', errors='ignore')

        # -----------------------------------------------------------
        # Handle Booking Process Mock (matches booking-process.php)
        # -----------------------------------------------------------
        if path.endswith('/booking-process.php'):
            settings_path = os.path.join(DIRECTORY, 'data', 'settings.json')
            settings = {'site_name': 'Massaji Spa Bali', 'whatsapp_number': '6281236695755'}
            if os.path.exists(settings_path):
                try:
                    with open(settings_path) as f:
                        settings.update(json.load(f))
                except Exception:
                    pass

            name = fields.get('name', 'Tamu')
            service = fields.get('service', 'General Spa Treatment')
            date = fields.get('date', datetime.now().strftime('%Y-%m-%d'))
            time = fields.get('time', '14:00')
            guests = int(fields.get('guests', 1))
            phone = fields.get('phone', '')
            email = fields.get('email', '')
            notes = fields.get('notes', '-')

            # Clean WhatsApp
            wa_num = ''.join(c for c in settings.get('whatsapp_number', '') if c.isdigit())
            if wa_num.startswith('0'):
                wa_num = '62' + wa_num[1:]

            wa_text = f"Halo *{settings['site_name']}*,\n\n"
            wa_text += f"Saya ingin mengonfirmasi reservasi via website:\n"
            wa_text += f"• *Nama:* {name}\n"
            wa_text += f"• *Layanan:* {service}\n"
            wa_text += f"• *Tanggal:* {date}\n"
            wa_text += f"• *Jam:* {time} WITA\n"
            wa_text += f"• *Jumlah Tamu:* {guests} orang\n"
            if phone:
                wa_text += f"• *Kontak:* {phone}\n"
            if notes and notes != '-':
                wa_text += f"• *Catatan:* {notes}\n"
            wa_text += "\nApakah slot waktu tersebut masih tersedia? Terima kasih."

            wa_url = f"https://wa.me/{wa_num}?text=" + urllib.parse.quote(wa_text)

            # Record in bookings.json
            bookings_path = os.path.join(DIRECTORY, 'data', 'bookings.json')
            bookings = []
            if os.path.exists(bookings_path):
                try:
                    with open(bookings_path) as f:
                        bookings = json.load(f)
                except Exception:
                    bookings = []

            new_booking = {
                'id': f"BK-{datetime.now().strftime('%Y%m%d-%H%M%S')}",
                'created_at': datetime.now().strftime('%Y-%m-%d %H:%M:%S'),
                'name': name,
                'email': email,
                'phone': phone,
                'service': service,
                'date': date,
                'time': time,
                'guests': guests,
                'notes': notes,
                'status': 'pending'
            }
            bookings.insert(0, new_booking)
            with open(bookings_path, 'w') as f:
                json.dump(bookings[:100], f, indent=2, ensure_ascii=False)

            # Rebuild preview so admin sees it
            subprocess.run(['python3', os.path.join(DIRECTORY, 'build_preview.py')], capture_output=True)

            self.send_response(200)
            self.send_header('Content-Type', 'application/json; charset=utf-8')
            self.end_headers()
            resp = {
                'success': True,
                'message': 'Permintaan reservasi Anda telah berhasil dikirim ke email resepsionis kami. Tim kami akan segera mengonfirmasi jadwal Anda.',
                'mail_sent': True,
                'whatsapp_url': wa_url,
                'details': {
                    'name': name,
                    'service': service,
                    'date': date,
                    'time': time,
                    'guests': guests
                }
            }
            self.wfile.write(json.dumps(resp).encode('utf-8'))
            return

        # -----------------------------------------------------------
        # Handle Admin API Mock (matches admin/api.php)
        # -----------------------------------------------------------
        if path.endswith('/api.php') or path.endswith('/admin/api.php'):
            action = fields.get('action', '')
            resp = {'success': False, 'message': 'Aksi tidak dikenali.'}

            if action in ('save_settings', 'save_home'):
                settings_path = os.path.join(DIRECTORY, 'data', 'settings.json')
                with open(settings_path) as f:
                    curr = json.load(f)
                all_keys = [
                    'site_name', 'tagline', 'subtagline', 'booking_email', 
                    'whatsapp_number', 'phone', 'whatsapp_number_2', 'phone_2',
                    'address', 'google_maps_link', 'opening_hours', 'instagram',
                    'hero_title_1', 'hero_title_2', 'hero_desc', 'hero_image',
                    'about_title_1', 'about_title_2', 'about_desc_1', 'about_desc_2', 'about_image',
                    'promo_title', 'promo_subtitle', 'promo_validity', 'promo_flyer_image'
                ]
                for k in all_keys:
                    if k in fields:
                        curr[k] = fields[k]
                with open(settings_path, 'w') as f:
                    json.dump(curr, f, indent=2, ensure_ascii=False)
                subprocess.run(['python3', os.path.join(DIRECTORY, 'build_preview.py')], capture_output=True)
                resp = {'success': True, 'message': 'Pengaturan berhasil disimpan!', 'settings': curr}

            elif action == 'save_promo':
                promo_path = os.path.join(DIRECTORY, 'data', 'promo.json')
                curr_promo = {
                    'active': fields.get('active') in ('1', 'on', 'true', True),
                    'badge': fields.get('badge', 'Special Offer'),
                    'title': fields.get('title', ''),
                    'description': fields.get('description', ''),
                    'code': fields.get('code', ''),
                    'valid_until': fields.get('valid_until', '')
                }
                with open(promo_path, 'w') as f:
                    json.dump(curr_promo, f, indent=2, ensure_ascii=False)
                subprocess.run(['python3', os.path.join(DIRECTORY, 'build_preview.py')], capture_output=True)
                resp = {'success': True, 'message': 'Banner promo berhasil diperbarui!'}

            elif action == 'save_menu':
                menu_data = fields.get('menu_data', '[]')
                menu_path = os.path.join(DIRECTORY, 'data', 'menu.json')
                try:
                    parsed_menu = json.loads(menu_data)
                    with open(menu_path, 'w') as f:
                        json.dump(parsed_menu, f, indent=2, ensure_ascii=False)
                    subprocess.run(['python3', os.path.join(DIRECTORY, 'build_preview.py')], capture_output=True)
                    resp = {'success': True, 'message': 'Daftar menu dan harga berhasil diperbarui!'}
                except Exception as e:
                    resp = {'success': False, 'message': str(e)}

            elif action == 'save_single_item':
                item_data = fields.get('item', '{}')
                menu_path = os.path.join(DIRECTORY, 'data', 'menu.json')
                try:
                    target_item = json.loads(item_data)
                    item_id = target_item.get('id')
                    with open(menu_path) as f:
                        items = json.load(f)
                    
                    found = False
                    for i, it in enumerate(items):
                        if it.get('id') == item_id:
                            items[i] = target_item
                            found = True
                            break
                    if not found:
                        items.append(target_item)
                        
                    with open(menu_path, 'w') as f:
                        json.dump(items, f, indent=2, ensure_ascii=False)
                    subprocess.run(['python3', os.path.join(DIRECTORY, 'build_preview.py')], capture_output=True)
                    resp = {'success': True, 'message': f"Treatment '{target_item.get('name')}' berhasil diperbarui!"}
                except Exception as e:
                    resp = {'success': False, 'message': str(e)}

            elif action == 'delete_menu_item':
                item_id = fields.get('id', '')
                menu_path = os.path.join(DIRECTORY, 'data', 'menu.json')
                with open(menu_path) as f:
                    items = json.load(f)
                items = [it for it in items if it.get('id') != item_id]
                with open(menu_path, 'w') as f:
                    json.dump(items, f, indent=2, ensure_ascii=False)
                subprocess.run(['python3', os.path.join(DIRECTORY, 'build_preview.py')], capture_output=True)
                resp = {'success': True, 'message': 'Perawatan berhasil dihapus.'}

            elif action == 'get_available_images':
                img_dir = os.path.join(DIRECTORY, 'assets', 'images')
                imgs = []
                if os.path.exists(img_dir):
                    for fn in sorted(os.listdir(img_dir)):
                        if fn.lower().endswith(('.jpg', '.jpeg', '.png', '.webp', '.svg')):
                            imgs.append(f'assets/images/{fn}')
                resp = {'success': True, 'images': imgs}

            elif action == 'change_password':
                resp = {'success': True, 'message': 'Password admin berhasil diganti!'}

            self.send_response(200)
            self.send_header('Content-Type', 'application/json; charset=utf-8')
            self.end_headers()
            self.wfile.write(json.dumps(resp).encode('utf-8'))
            return

        self.send_response(404)
        self.end_headers()

if __name__ == '__main__':
    # Initial build
    subprocess.run(['python3', os.path.join(DIRECTORY, 'build_preview.py')], capture_output=True)
    socketserver.TCPServer.allow_reuse_address = True
    with socketserver.TCPServer(("", PORT), SpaPreviewHandler) as httpd:
        print(f"Serving Massaji Spa at http://localhost:{PORT}")
        httpd.serve_forever()

#!/usr/bin/env python3
import http.server
import socketserver
import os
import json
import urllib.parse
import subprocess
from datetime import datetime, timedelta

PORT = 8080
DIRECTORY = '/Volumes/PROJECTS/EYESTETIX_BACKUP_2026-09-30/WEBSITE'

# Map .php files to render directly as HTML in browser (PHP-Only preview mode)
http.server.SimpleHTTPRequestHandler.extensions_map['.php'] = 'text/html; charset=utf-8'

class SpaPreviewHandler(http.server.SimpleHTTPRequestHandler):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, directory=DIRECTORY, **kwargs)

    def send_cors_headers(self):
        origin = self.headers.get('Origin', '*')
        self.send_header('Access-Control-Allow-Origin', origin)
        self.send_header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        self.send_header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Accept, X-Admin-Token, X-CSRF-Token')
        self.send_header('Access-Control-Max-Age', '86400')

    def do_OPTIONS(self):
        self.send_response(200)
        self.send_cors_headers()
        self.end_headers()

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

        # Parse form data (supporting multipart, json and urlencoded)
        content_type = self.headers.get('Content-Type', '')
        fields = {}

        if 'application/json' in content_type:
            try:
                fields = json.loads(post_body.decode('utf-8'))
            except Exception:
                fields = {}
        elif 'application/x-www-form-urlencoded' in content_type:
            fields = {k: v[0] for k, v in urllib.parse.parse_qs(post_body.decode('utf-8', errors='ignore')).items()}
        elif 'multipart/form-data' in content_type:
            # Simple multipart parser
            boundary = content_type.split('boundary=')[-1].encode('utf-8')
            parts = post_body.split(b'--' + boundary)
            for part in parts:
                if b'Content-Disposition: form-data;' in part:
                    header, _, body = part.partition(b'\r\n\r\n')
                    body = body.rstrip(b'\r\n')
                    header_str = header.decode('utf-8', errors='ignore')
                    m_name = None
                    m_filename = None
                    for line in header_str.split('\r\n'):
                        if 'name="' in line:
                            m_name = line.split('name="')[1].split('"')[0]
                        if 'filename="' in line:
                            m_filename = line.split('filename="')[1].split('"')[0]
                    if m_name:
                        if m_filename:
                            fields[m_name] = {'filename': m_filename, 'bytes': body}
                        else:
                            fields[m_name] = body.decode('utf-8', errors='ignore')

        # -----------------------------------------------------------
        # Handle Visitor Analytics Tracking (matches track.php)
        # -----------------------------------------------------------
        if path.endswith('/track.php') or path == '/track.php':
            analytics_path = os.path.join(DIRECTORY, 'data', 'analytics.json')
            db = {
                'summary': {'total_views': 0, 'total_unique': 0},
                'days': {},
                'recent': []
            }
            if os.path.exists(analytics_path):
                try:
                    with open(analytics_path, 'r', encoding='utf-8') as f:
                        db = json.load(f)
                except Exception:
                    pass

            now_dt = datetime.now()
            today_str = now_dt.strftime('%Y-%m-%d')
            now_str = now_dt.strftime('%Y-%m-%d %H:%M:%S')
            hour_int = now_dt.hour

            referrer = fields.get('referrer', '')
            utm_source = fields.get('utm_source', '')
            is_new = bool(fields.get('is_new_session', False))
            page_path = fields.get('path', '/')
            screen_w = int(fields.get('screen_width', 0)) if str(fields.get('screen_width', 0)).isdigit() else 0

            # Classify source
            source = 'Direct'
            if utm_source:
                u = utm_source.lower()
                if 'google' in u: source = 'Google'
                elif 'instagram' in u or u == 'ig': source = 'Instagram'
                elif 'facebook' in u or u == 'fb': source = 'Facebook'
                elif 'tiktok' in u: source = 'TikTok'
                elif 'whatsapp' in u or u == 'wa': source = 'WhatsApp'
                else: source = utm_source[:20].capitalize()
            elif referrer:
                r = referrer.lower()
                if 'google.' in r: source = 'Google'
                elif 'instagram.com' in r: source = 'Instagram'
                elif 'facebook.com' in r or 'fb.com' in r: source = 'Facebook'
                elif 'tiktok.com' in r: source = 'TikTok'
                elif 'whatsapp.com' in r or 'wa.me' in r: source = 'WhatsApp'
                elif 'bing.com' in r: source = 'Bing'
                elif 'yahoo.com' in r: source = 'Yahoo'
                elif 'massaji.net' in r or 'localhost' in r or '127.0.0.1' in r: source = 'Direct'
                else:
                    parsed = urllib.parse.urlparse(referrer).netloc
                    source = parsed.replace('www.', '')[:25] if parsed else 'Other'

            device = 'Mobile' if (screen_w > 0 and screen_w <= 768) else 'Desktop'

            # Update DB
            db.setdefault('summary', {'total_views': 0, 'total_unique': 0})
            db['summary']['total_views'] = db['summary'].get('total_views', 0) + 1
            if is_new:
                db['summary']['total_unique'] = db['summary'].get('total_unique', 0) + 1

            db.setdefault('days', {})
            if today_str not in db['days']:
                db['days'][today_str] = {
                    'views': 0,
                    'unique': 0,
                    'sources': {},
                    'devices': {'Mobile': 0, 'Desktop': 0},
                    'hours': [0] * 24
                }

            day_entry = db['days'][today_str]
            day_entry['views'] = day_entry.get('views', 0) + 1
            if is_new:
                day_entry['unique'] = day_entry.get('unique', 0) + 1

            day_entry.setdefault('sources', {})
            day_entry['sources'][source] = day_entry['sources'].get(source, 0) + 1

            day_entry.setdefault('devices', {'Mobile': 0, 'Desktop': 0})
            day_entry['devices'][device] = day_entry['devices'].get(device, 0) + 1

            day_entry.setdefault('hours', [0] * 24)
            if len(day_entry['hours']) < 24:
                day_entry['hours'] = [0] * 24
            day_entry['hours'][hour_int] = day_entry['hours'][hour_int] + 1

            db.setdefault('recent', [])
            db['recent'].insert(0, {
                'time': now_str,
                'source': source,
                'device': device,
                'path': page_path[:50],
                'unique': is_new
            })
            db['recent'] = db['recent'][:50]

            try:
                with open(analytics_path, 'w', encoding='utf-8') as f:
                    json.dump(db, f, indent=2, ensure_ascii=False)
            except Exception:
                pass

            self.send_response(200)
            self.send_cors_headers()
            self.send_header('Content-Type', 'application/json; charset=utf-8')
            self.end_headers()
            self.wfile.write(json.dumps({'ok': True, 'source': source, 'device': device}).encode('utf-8'))
            return

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
            source = fields.get('source', 'Direct Website')
            device = fields.get('device', 'Mobile')

            if phone:
                wa_text += f"• *Kontak:* {phone}\n"
            if source:
                wa_text += f"• *Sumber Reservasi:* Website ({source} • {device})\n"
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
                'source': source,
                'device': device,
                'channel': 'Website Form -> WhatsApp',
                'status': 'pending'
            }
            bookings.insert(0, new_booking)
            with open(bookings_path, 'w') as f:
                json.dump(bookings[:100], f, indent=2, ensure_ascii=False)

            # Rebuild preview so admin sees it
            subprocess.run(['python3', os.path.join(DIRECTORY, 'build_preview.py')], capture_output=True)

            self.send_response(200)
            self.send_cors_headers()
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
        if path.endswith('/api.php') or path.endswith('/admin/api.php') or path.endswith('/server.py'):
            action = fields.get('action', '')
            resp = {'success': False, 'message': 'Aksi tidak dikenali.'}

            if action == 'login':
                u = fields.get('username', '').lower()
                p = fields.get('password', '')
                if u == 'admin' and (p in ('massaji2026', 'admin123', 'admin')):
                    resp = {
                        'success': True,
                        'message': 'Login berhasil',
                        'auth_token': 'local_dev_token_' + datetime.now().strftime('%Y%m%d'),
                        'csrf_token': 'local_dev_csrf'
                    }
                else:
                    resp = {'success': False, 'message': 'Username atau password salah.'}

            elif action == 'get_bookings':
                def read_j(fn, default):
                    fp = os.path.join(DIRECTORY, 'data', fn)
                    if os.path.exists(fp):
                        try:
                            with open(fp, 'r', encoding='utf-8') as f:
                                return json.load(f)
                        except Exception:
                            pass
                    return default
                resp = {
                    'success': True,
                    'bookings': read_j('bookings.json', [])
                }

            elif action == 'get_all_data':
                def read_j(fn, default):
                    fp = os.path.join(DIRECTORY, 'data', fn)
                    if os.path.exists(fp):
                        try:
                            with open(fp, 'r', encoding='utf-8') as f:
                                return json.load(f)
                        except Exception:
                            pass
                    return default

                resp = {
                    'success': True,
                    'settings': read_j('settings.json', {}),
                    'menu': read_j('menu.json', []),
                    'promo': read_j('promo.json', {}),
                    'bookings': read_j('bookings.json', [])
                }

            elif action in ('save_settings', 'save_home'):
                settings_path = os.path.join(DIRECTORY, 'data', 'settings.json')
                with open(settings_path) as f:
                    curr = json.load(f)
                all_keys = [
                    'site_name', 'tagline', 'subtagline', 'booking_email', 'admin_notification_email', 
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

            elif action == 'upload_image':
                import base64
                import re
                import time

                file_data = fields.get('data') # Base64 string from JSON
                filename = fields.get('filename', '')
                file_obj = fields.get('image') # from multipart if sent

                file_bytes = None
                out_filename = ''

                if file_obj and isinstance(file_obj, dict):
                    out_filename = file_obj.get('filename', 'upload.jpg')
                    file_bytes = file_obj.get('bytes')
                elif file_data:
                    out_filename = filename or 'upload.jpg'
                    if ',' in file_data:
                        file_data = file_data.split(',', 1)[1]
                    try:
                        file_bytes = base64.b64decode(file_data)
                    except Exception as e:
                        file_bytes = None

                if file_bytes:
                    if len(file_bytes) > 8 * 1024 * 1024:
                        resp = {'success': False, 'message': 'Ukuran file melebihi batas 8MB.'}
                    else:
                        clean_name = re.sub(r'[^a-zA-Z0-9_\.-]', '_', os.path.basename(out_filename))
                        name_root, ext = os.path.splitext(clean_name)
                        ext = ext.lower()
                        if ext not in ['.jpg', '.jpeg', '.png', '.webp', '.gif']:
                            ext = '.jpg'
                        name_root = name_root[:40]
                        timestamp = time.strftime('%Y%m%d_%H%M%S')
                        final_filename = f"{name_root}_{timestamp}{ext}"

                        upload_dir = os.path.join(DIRECTORY, 'assets', 'uploads')
                        os.makedirs(upload_dir, exist_ok=True)
                        save_path = os.path.join(upload_dir, final_filename)

                        with open(save_path, 'wb') as f:
                            f.write(file_bytes)

                        rel_path = f"assets/uploads/{final_filename}"
                        resp = {
                            'success': True,
                            'path': rel_path,
                            'filename': final_filename,
                            'message': f'Gambar "{final_filename}" berhasil diunggah ke assets/uploads/'
                        }
                else:
                    resp = {'success': False, 'message': 'Tidak ada data file yang diterima.'}

            elif action == 'get_analytics':
                analytics_path = os.path.join(DIRECTORY, 'data', 'analytics.json')
                db = {'summary': {'total_views': 0, 'total_unique': 0}, 'days': {}, 'recent': []}
                if os.path.exists(analytics_path):
                    try:
                        with open(analytics_path, 'r', encoding='utf-8') as f:
                            db = json.load(f)
                    except Exception:
                        pass

                now_dt = datetime.now()
                today_str = now_dt.strftime('%Y-%m-%d')
                this_month_str = now_dt.strftime('%Y-%m')
                this_year_str = now_dt.strftime('%Y')

                today_data = db.get('days', {}).get(today_str, {})
                today_views = today_data.get('views', 0)
                today_unique = today_data.get('unique', 0)

                yesterday_str = (now_dt - timedelta(days=1)).strftime('%Y-%m-%d')
                yesterday_data = db.get('days', {}).get(yesterday_str, {})
                yesterday_views = yesterday_data.get('views', 0)
                yesterday_unique = yesterday_data.get('unique', 0)

                def get_days_range(n):
                    res = []
                    for i in range(n - 1, -1, -1):
                        d = (now_dt - timedelta(days=i)).strftime('%Y-%m-%d')
                        d_entry = db.get('days', {}).get(d, {})
                        v = d_entry.get('views', 0)
                        u = d_entry.get('unique', 0)
                        label = (now_dt - timedelta(days=i)).strftime('%d %b')
                        res.append({'date': d, 'label': label, 'views': v, 'unique': u})
                    return res

                last_7 = get_days_range(7)
                last_14 = get_days_range(14)
                last_30 = get_days_range(30)

                week_views = sum(x['views'] for x in last_7)
                week_unique = sum(x['unique'] for x in last_7)

                month_views = 0
                month_unique = 0
                year_views = 0
                year_unique = 0

                source_totals = {
                    'Google': 0,
                    'Instagram': 0,
                    'Facebook': 0,
                    'TikTok': 0,
                    'WhatsApp': 0,
                    'Direct': 0,
                    'Other': 0
                }
                device_totals = {'Mobile': 0, 'Desktop': 0}
                hourly_totals = [0] * 24

                months_map = {}
                for m in range(1, 13):
                    k = f"{this_year_str}-{m:02d}"
                    months_map[k] = {'views': 0, 'unique': 0, 'label': datetime(int(this_year_str), m, 1).strftime('%b')}

                for day, ddata in db.get('days', {}).items():
                    v = ddata.get('views', 0)
                    u = ddata.get('unique', 0)

                    if day.startswith(this_month_str):
                        month_views += v
                        month_unique += u

                    if day.startswith(this_year_str):
                        year_views += v
                        year_unique += u
                        ym = day[:7]
                        if ym in months_map:
                            months_map[ym]['views'] += v
                            months_map[ym]['unique'] += u

                    for s_name, s_cnt in ddata.get('sources', {}).items():
                        if s_name in source_totals:
                            source_totals[s_name] += s_cnt
                        else:
                            source_totals['Other'] += s_cnt

                    for dev_name, dev_cnt in ddata.get('devices', {}).items():
                        if dev_name in device_totals:
                            device_totals[dev_name] += dev_cnt

                    for h_idx, h_cnt in enumerate(ddata.get('hours', [])):
                        if h_idx < 24:
                            hourly_totals[h_idx] += h_cnt

                resp = {
                    'success': True,
                    'data': {
                        'summary': db.get('summary', {'total_views': 0, 'total_unique': 0}),
                        'today': {
                            'views': today_views,
                            'unique': today_unique,
                            'yesterday_views': yesterday_views,
                            'yesterday_unique': yesterday_unique
                        },
                        'week': {
                            'views': week_views,
                            'unique': week_unique
                        },
                        'month': {
                            'views': month_views,
                            'unique': month_unique,
                            'label': now_dt.strftime('%B %Y')
                        },
                        'year': {
                            'views': year_views,
                            'unique': year_unique,
                            'label': this_year_str
                        },
                        'trends': {
                            'days_7': last_7,
                            'days_14': last_14,
                            'days_30': last_30,
                            'months': list(months_map.values())
                        },
                        'sources': source_totals,
                        'devices': device_totals,
                        'hours': hourly_totals,
                        'recent': db.get('recent', [])[:20]
                    }
                }

            self.send_response(200)
            self.send_cors_headers()
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

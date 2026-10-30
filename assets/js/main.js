// assets/js/main.js - Interactive UI, Bilingual System & Live Search for Massaji Spa Bali

// ========================================================
// 0. SAFE STORAGE HELPERS & GLOBAL INITIALIZATION
// ========================================================
function safeGetStorage(key, fallback) {
  try {
    return (typeof window !== 'undefined' && window.localStorage && window.localStorage.getItem(key)) || fallback;
  } catch (e) {
    return fallback;
  }
}

function safeSetStorage(key, val) {
  try {
    if (typeof window !== 'undefined' && window.localStorage) {
      window.localStorage.setItem(key, String(val));
    }
  } catch (e) {}
}

window.__isPackagesExpanded = false;
window.__isMenuExpanded = false;
window.__currentLang = safeGetStorage('massaji_spa_lang', 'en');

// ========================================================
// 1. TOP-LEVEL GLOBAL WINDOW FUNCTIONS (ALWAYS ACCESSIBLE)
// ========================================================
window.openBookingModal = function(serviceName) {
  try {
    const bookingModal = document.getElementById('booking-modal');
    if (!bookingModal) return;

    const formEl = document.getElementById('booking-form');
    const confirmEl = document.getElementById('booking-confirmation');
    if (formEl) formEl.classList.remove('hidden');
    if (confirmEl) confirmEl.classList.add('hidden');

    const serviceSelect = document.getElementById('booking-service');
    if (serviceSelect && serviceName) {
      let matchFound = false;
      const cleanTarget = String(serviceName).toLowerCase().replace(/[^a-z0-9]/g, '');
      for (let i = 0; i < serviceSelect.options.length; i++) {
        const optText = (serviceSelect.options[i].text || '').toLowerCase().replace(/[^a-z0-9]/g, '');
        if (optText.includes(cleanTarget) || cleanTarget.includes(optText)) {
          serviceSelect.selectedIndex = i;
          matchFound = true;
          break;
        }
      }
      if (!matchFound) {
        for (let i = 0; i < serviceSelect.options.length; i++) {
          const val = (serviceSelect.options[i].value || '').toLowerCase();
          if (val.includes(String(serviceName).toLowerCase()) || String(serviceName).toLowerCase().includes(val)) {
            serviceSelect.selectedIndex = i;
            matchFound = true;
            break;
          }
        }
      }
    }

    const dateInput = document.getElementById('booking-date');
    if (dateInput) {
      const today = new Date().toISOString().split('T')[0];
      dateInput.min = today;
      if (!dateInput.value) {
        dateInput.value = today;
      }
    }

    bookingModal.classList.remove('hidden');
    bookingModal.classList.add('flex');
    document.body.style.overflow = 'hidden';

    // Safely close mobile menu if it was open
    if (typeof window.toggleMobileMenu === 'function') {
      window.toggleMobileMenu(false);
    }
  } catch (err) {
    console.error('Error opening booking modal:', err);
  }
};

window.closeBookingModal = function() {
  try {
    const bookingModal = document.getElementById('booking-modal');
    if (bookingModal) {
      bookingModal.classList.add('hidden');
      bookingModal.classList.remove('flex');
      document.body.style.overflow = '';
    }
  } catch (err) {
    console.error('Error closing booking modal:', err);
  }
};

window.openPromoPopup = function() {
  try {
    const promoPopup = document.getElementById('promo-flyer-popup');
    if (promoPopup) {
      promoPopup.classList.remove('hidden');
      promoPopup.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }
  } catch (err) {
    console.error('Error opening promo popup:', err);
  }
};

window.closePromoPopup = function() {
  try {
    const promoPopup = document.getElementById('promo-flyer-popup');
    if (promoPopup) {
      promoPopup.classList.add('hidden');
      promoPopup.classList.remove('flex');
      document.body.style.overflow = '';
    }
  } catch (err) {
    console.error('Error closing promo popup:', err);
  }
};

window.toggleMobileMenu = function(forceState) {
  try {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerOpen = document.getElementById('hamburger-icon-open');
    const hamburgerClose = document.getElementById('hamburger-icon-close');
    if (!mobileMenu) return;

    const willOpen = typeof forceState === 'boolean' ? forceState : mobileMenu.classList.contains('hidden');
    if (willOpen) {
      mobileMenu.classList.remove('hidden');
      if (hamburgerOpen) hamburgerOpen.classList.add('hidden');
      if (hamburgerClose) hamburgerClose.classList.remove('hidden');
      if (mobileMenuBtn) mobileMenuBtn.setAttribute('aria-expanded', 'true');
    } else {
      mobileMenu.classList.add('hidden');
      if (hamburgerOpen) hamburgerOpen.classList.remove('hidden');
      if (hamburgerClose) hamburgerClose.classList.add('hidden');
      if (mobileMenuBtn) mobileMenuBtn.setAttribute('aria-expanded', 'false');
    }
  } catch (err) {
    console.error('Error toggling mobile menu:', err);
  }
};

window.resetPackageSearch = function() {
  try {
    const packageSearchInput = document.getElementById('package-search-input');
    if (packageSearchInput) packageSearchInput.value = '';
    window.__isPackagesExpanded = false;
    const packageTabs = document.querySelectorAll('.package-tab-btn');
    packageTabs.forEach((btn, idx) => {
      if (idx === 0) {
        btn.classList.add('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
        btn.classList.remove('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');
      } else {
        btn.classList.remove('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
        btn.classList.add('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');
      }
    });
    if (typeof window.__filterPackages === 'function') {
      window.__filterPackages('all');
    }
  } catch (err) {
    console.error('Error resetting package search:', err);
  }
};

window.resetMenuSearch = function() {
  try {
    const menuSearchInput = document.getElementById('menu-search-input');
    if (menuSearchInput) menuSearchInput.value = '';
    window.__isMenuExpanded = false;
    const menuFilterButtons = document.querySelectorAll('.menu-filter-btn');
    menuFilterButtons.forEach((btn, idx) => {
      if (idx === 0) {
        btn.classList.add('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
        btn.classList.remove('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');
      } else {
        btn.classList.remove('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
        btn.classList.add('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');
      }
    });
    if (typeof window.__filterMenu === 'function') {
      window.__filterMenu('all');
    }
  } catch (err) {
    console.error('Error resetting menu search:', err);
  }
};

// ========================================================
// 2. BILINGUAL DICTIONARY (EN / ID)
// ========================================================
const i18n = {
    en: {
      nav_promo: "End Year Promo",
      nav_packages: "Spa Packages",
      nav_menu: "Treatment Menu",
      nav_about: "About Us",
      nav_reviews: "Guest Reviews (4.8★)",
      nav_contact: "Location & Hours",
      nav_book: "Book Session",

      hero_eyebrow: "Boutique Wellness Sanctuary • Canggu, Bali",
      hero_title_1: "Find Your Balance.",
      hero_title_2: "Rediscover Serenity.",
      hero_desc: "Experience the restorative touch of authentic Balinese healing traditions, pure botanical aromatherapy, and tranquil private suites in the heart of Canggu.",
      hero_btn_book: "Book Your Treatment",
      hero_btn_explore: "View End Year Promo",
      stat_rating: "4.8★ Verified Reviews",
      stat_count: "(560+ Delighted Guests in Canggu)",

      trust_1: "Authentic Balinese Healing Rituals",
      trust_2: "Certified & Experienced Therapists",
      trust_3: "100% Pure Botanical Ingredients",
      trust_4: "Private, Serene & Spotless Suites",

      promo_eyebrow: "Limited-Time Special Offer",
      promo_title: 'End Year 2026 <span class="italic font-normal text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-[#BAE0FD] to-amber-100">Big Promotion</span>',
      promo_desc: "Celebrate the year-end season with curated rejuvenation specials by Massaji Spa Bali. Enjoy exclusive savings on signature massages, body contouring, and rose petal rituals.",
      promo_card_rate: "Special Promo Rate",
      promo_btn_book: "Claim Promo Rate",
      promo_valid_label: "Validity Period:",
      promo_flyer_btn: "View Official Flyer",

      packages_eyebrow: "Curated Spa Rituals",
      packages_title: "Signature Spa Packages",
      packages_desc: "Carefully orchestrated multi-hour wellness journeys crafted for solo relaxation, intimate couples retreats, and group pampering sessions in Bali.",
      pkg_tab_all: "All Packages",
      pkg_tab_single: "Single Package (1 Person)",
      pkg_tab_couple: "Couple Package (2 Persons)",
      pkg_tab_group: "Group Package (4 Persons)",
      pkg_from_price: "From Price",
      pkg_btn_book: "Reserve Package",
      pkg_search_placeholder: "Search spa packages (e.g., couple, 120 mins, relax, single, boreh)...",
      pkg_not_found: "No packages found matching your search.",
      pkg_view_all: "View All Spa Packages",
      pkg_show_less: "Show Less",

      menu_eyebrow: "Complete Spa Catalog",
      menu_title: "Treatment Menu & Pricing",
      menu_desc: "Explore our full suite of individual therapies with honest, transparent pricing in Canggu & Kerobokan.",
      cat_all: "All Treatments",
      cat_massage: "Body Massage",
      cat_spa: "Body Spa Treatments",
      cat_slimming: "Slimming & RF Cavitation",
      cat_facial: "Facial Care",
      cat_nail: "Nail Services",
      cat_additional: "Additional Services",
      card_rate: "Nett Price",
      card_btn_book: "Book Treatment",
      menu_search_placeholder: "Search treatments (e.g., balinese, hot stone, facial, manicure, slimming)...",
      menu_not_found: "No treatments found matching your keywords.",
      menu_view_all: "View All Treatments",
      menu_show_less: "Show Less",

      about_eyebrow: "Our Sanctuary Story",
      about_title_1: "Rooted in Bali.",
      about_title_2: "Created for Your Wellbeing.",
      about_desc_1: "Tucked into a tranquil enclave of Kerobokan and Canggu, Massaji Spa was founded to honor ancient Balinese healing arts while maintaining five-star cleanliness at refreshingly honest, accessible prices.",
      about_desc_2: "From warming Balinese Boreh herbal spice wraps that ease muscular tension to targeted Cavitation RF slimming and certified prenatal massage—every therapy is thoughtfully tailored to your body's unique rhythm.",
      about_val_1: "Pure Botanical Oils",
      about_val_1_desc: "Fresh frangipani, uplifting lemongrass, calming lavender, and native spice blends.",
      about_val_2: "Five-Star Hygiene",
      about_val_2_desc: "Crisp, freshly laundered linens and sanitized private suites for every single guest.",

      reviews_eyebrow: "Guest Experiences",
      reviews_title: "Cherished by Travelers Worldwide",
      reviews_summary: "Rated 4.8 out of 5.0 across 560+ verified reviews in Canggu & Kerobokan.",
      review_1_text: "\"The 2-Hour Balinese Massage here is hands down the best massage I've experienced in Bali. Super clean rooms, calming scent, and therapists who truly understand pressure points.\"",
      review_2_text: "\"We booked the Simply Us couple package and it was pure bliss! The romantic flower bath and massage were extraordinary. Highly recommended when visiting Canggu!\"",
      review_3_text: "\"As a regular surfer in Canggu, their Deep Tissue and Hot Stone massage solved all my shoulder stiffness. Honest prices, incredible technique, five-star cleanliness.\"",

      contact_eyebrow: "Visit Our Sanctuary",
      contact_title: "Location & Opening Hours",
      contact_desc: "Conveniently situated along the main Canggu / Kerobokan route with secure, dedicated on-site parking for scooters and cars.",
      contact_address_label: "Sanctuary Address",
      contact_maps_link: "Get Directions in Google Maps →",
      contact_hours_label: "Visiting Hours",
      contact_hours_val: "Daily: 10:00 AM – 9:00 PM WITA",
      contact_chat_label: "Instant WhatsApp Booking",

      footer_tagline: "Authentic Balinese Massage, Curated Spa Packages & Holistic Wellness Sanctuary in Kerobokan and Canggu.",
      footer_visiting_hours_title: "Visiting Hours",
      footer_visiting_days: "Open Every Day",
      footer_visiting_note: "Prior booking via WhatsApp is recommended to secure your preferred private treatment suite.",
      footer_explore: "Explore",
      footer_contact_title: "Direct Contact",
      footer_admin_link: "Staff / Admin Portal →",

      popup_badge: "🎉 SPECIAL LIMITED OFFER",
      popup_title: 'END YEAR 2026 <span class="text-amber-300">BIG PROMOTION</span>',
      popup_validity: "Valid : 1 Nov – 31 Dec 2026 (Reservation is required prior visit)",
      popup_btn_wa: "Claim Promo via WhatsApp",
      popup_btn_explore: "Explore Promo Details →",
      popup_btn_skip: "Continue to Website",

      modal_eyebrow: "Direct Reservation",
      modal_title: "Reserve Your Spa Session",
      modal_desc: "Your appointment request will be promptly delivered to our receptionist for instant confirmation via WhatsApp.",
      modal_label_name: "Full Name *",
      modal_label_phone: "WhatsApp / Mobile Number *",
      modal_label_email: "Email Address (Optional)",
      modal_label_service: "Select Treatment or Package *",
      modal_label_date: "Appointment Date *",
      modal_label_time: "Preferred Time Slot *",
      modal_label_guests: "Number of Guests",
      modal_label_notes: "Special Requests (Optional)",
      modal_name_placeholder: "e.g. Sarah Jenkins / Michael",
      modal_phone_placeholder: "e.g. +62 812-3456-7890",
      modal_notes_placeholder: "Therapist preferences, tension focus areas, or anniversary celebration...",
      modal_guest_1: "1 Person",
      modal_guest_2: "2 Persons",
      modal_guest_3: "3 Persons",
      modal_guest_4: "4 Persons",
      modal_guest_5: "5+ Persons",
      modal_submit: "Submit Reservation Request",
      modal_success_title: "Reservation Received",
      modal_btn_wa: "Confirm Instantly on WhatsApp",
      modal_btn_close: "Close Window"
    },
    id: {
      nav_promo: "Promo Akhir Tahun",
      nav_packages: "Paket Spa",
      nav_menu: "Menu Perawatan",
      nav_about: "Tentang Kami",
      nav_reviews: "Ulasan Tamu (4.8★)",
      nav_contact: "Lokasi & Jam Buka",
      nav_book: "Reservasi Jadwal",

      hero_eyebrow: "Sanctuary Kebugaran Butik • Canggu, Bali",
      hero_title_1: "Temukan Keseimbangan Jiwa.",
      hero_title_2: "Pulihkan Kedamaian Raga.",
      hero_desc: "Rasakan keajaiban sentuhan tradisi penyembuhan Bali, relaksasi mendalam dengan minyak botani alami, dan suasana privat yang menenangkan di jantung Canggu.",
      hero_btn_book: "Pesan Jadwal Perawatan",
      hero_btn_explore: "Lihat Promo Akhir Tahun",
      stat_rating: "4.8★ Ulasan Terverifikasi",
      stat_count: "(560+ Tamu Bahagia di Canggu)",

      trust_1: "Tradisi Pijat Otentik Bali",
      trust_2: "Terapis Ahli & Tersertifikasi",
      trust_3: "100% Minyak Botani Alami",
      trust_4: "Ruang Privat, Tenang & Higienis",

      promo_eyebrow: "Penawaran Istimewa Terbatas",
      promo_title: 'Promo Besar <span class="italic font-normal text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-[#BAE0FD] to-amber-100">Akhir Tahun 2026</span>',
      promo_desc: "Rayakan akhir tahun dengan perawatan istimewa berharga spesial dari Massaji Spa Bali. Dapatkan diskon eksklusif untuk memanjakan tubuh dan menyegarkan pikiran.",
      promo_card_rate: "Tarif Spesial Promo",
      promo_btn_book: "Klaim Promo Ini",
      promo_valid_label: "Periode Berlaku:",
      promo_flyer_btn: "Brosur Flyer Asli",

      packages_eyebrow: "Kurasi Ritual Spa Pilihan",
      packages_title: "Paket Istimewa Spa",
      packages_desc: "Rangkaian perawatan holistik yang dirancang khusus untuk perawatan individu, momen romantis pasangan, maupun relaksasi bersama rombongan di Bali.",
      pkg_tab_all: "Semua Paket",
      pkg_tab_single: "Paket Personal (1 Orang)",
      pkg_tab_couple: "Paket Pasangan (2 Orang)",
      pkg_tab_group: "Paket Rombongan (4 Orang)",
      pkg_from_price: "Mulai Dari",
      pkg_btn_book: "Pesan Paket Ini",
      pkg_search_placeholder: "Cari paket spa (misal: couple, 120 menit, relax, single, boreh)...",
      pkg_not_found: "Tidak ada paket yang sesuai dengan pencarian Anda.",
      pkg_view_all: "Lihat Semua Paket",
      pkg_show_less: "Tampilkan Lebih Sedikit",

      menu_eyebrow: "Katalog Layanan Lengkap",
      menu_title: "Menu Perawatan & Tarif",
      menu_desc: "Pilihan lengkap perawatan satuan dengan tarif jujur, transparan, dan kebersihan terjamin di Canggu & Kerobokan.",
      cat_all: "Semua Layanan",
      cat_massage: "Pijat Tradisional Tubuh",
      cat_spa: "Ritual Body Spa & Lulur",
      cat_slimming: "Slimming Cavitation RF",
      cat_facial: "Perawatan Wajah",
      cat_nail: "Manikur & Perawatan Kuku",
      cat_additional: "Layanan Tambahan",
      card_rate: "Tarif Resmi",
      card_btn_book: "Pesan Perawatan",
      menu_search_placeholder: "Cari menu treatment (misal: stone, traditional, facial, nail, slimming)...",
      menu_not_found: "Tidak ada perawatan yang sesuai dengan kata kunci Anda.",
      menu_view_all: "Lihat Semua Perawatan",
      menu_show_less: "Tampilkan Lebih Sedikit",

      about_eyebrow: "Mengenal Massaji Spa",
      about_title_1: "Berakar di Tradisi Bali.",
      about_title_2: "Didedikasikan untuk Kebugaran Anda.",
      about_desc_1: "Terletak di sudut tenang Kerobokan dan Canggu, Massaji Spa hadir untuk mempersembahkan kearifan penyembuhan tradisional Bali dengan standar kebersihan bintang lima dan harga yang bersahabat.",
      about_desc_2: "Dari kehangatan lulur rempah Boreh Bali yang melemaskan sendi kaku hingga perawatan slimming RF cavitation dan pijat prenatal bersertifikat—setiap sentuhan terapis kami disesuaikan dengan kebutuhan tubuh Anda.",
      about_val_1: "Minyak Aromaterapi Alami",
      about_val_1_desc: "Bunga kamboja, serai segar, lavender murni, dan rempah alami Bali.",
      about_val_2: "Standar Higienitas Bintang Lima",
      about_val_2_desc: "Sprei, linen, dan handuk steril diganti baru untuk setiap tamu.",

      reviews_eyebrow: "Kesan & Ulasan Tamu",
      reviews_title: "Pilihan Terpercaya Ribuan Pelancong Dunia",
      reviews_summary: "Rating 4.8 dari 5.0 berdasarkan 560+ ulasan nyata di Canggu & Kerobokan.",
      review_1_text: "\"Pijat Tradisional Bali 2 Jam di sini benar-benar yang terbaik selama liburan saya di Bali. Ruangannya privat dan sangat bersih, wanginya menenangkan, dan terapisnya sangat ahli memahami titik-titik pegal tubuh.\"",
      review_2_text: "\"Kami memesan paket pasangan Simply Us dan pengalamannya sungguh luar biasa menenangkan! Mandi bunga mawar aromatik dan pijatannya begitu istimewa. Sangat direkomendasikan saat berkunjung ke Canggu!\"",
      review_3_text: "\"Sebagai peselancar di Canggu, pijat Deep Tissue di Massaji Spa benar-benar memulihkan ketegangan otot bahu dan punggung saya. Harga sangat transparan, teknik terapis berkelas, dan kebersihan terjaga.\"",

      contact_eyebrow: "Kunjungi Sanctuary Kami",
      contact_title: "Lokasi & Jam Operasional",
      contact_desc: "Berlokasi strategis di jalur utama Canggu / Kerobokan dengan fasilitas parkir luas dan aman untuk motor maupun mobil.",
      contact_address_label: "Alamat Lengkap",
      contact_maps_link: "Buka Petunjuk Arah di Google Maps →",
      contact_hours_label: "Jam Operasional",
      contact_hours_val: "Buka Setiap Hari: 10:00 – 21:00 WITA",
      contact_chat_label: "Konfirmasi Cepat WhatsApp",

      footer_tagline: "Pijat Tradisional Bali Autentik, Paket Spa Pilihan & Tempat Relaksasi Holistik di Kerobokan dan Canggu.",
      footer_visiting_hours_title: "Jam Kunjungan",
      footer_visiting_days: "Buka Setiap Hari",
      footer_visiting_note: "Disarankan melakukan reservasi terlebih dahulu via WhatsApp untuk memastikan ketersediaan ruang perawatan privat Anda.",
      footer_explore: "Jelajahi",
      footer_contact_title: "Kontak Langsung",
      footer_admin_link: "Portal Staf / Admin →",

      popup_badge: "🎉 PENAWARAN SPESIAL TERBATAS",
      popup_title: 'PROMO BESAR AKHIR TAHUN 2026 <span class="text-amber-300">BIG PROMOTION</span>',
      popup_validity: "Berlaku : 1 Nov – 31 Des 2026 (Wajib reservasi sebelum kedatangan)",
      popup_btn_wa: "Klaim Promo via WhatsApp",
      popup_btn_explore: "Lihat Detail Promo →",
      popup_btn_skip: "Lanjut Jelajahi Website",

      modal_eyebrow: "Reservasi Langsung",
      modal_title: "Pesan Jadwal Perawatan Spa",
      modal_desc: "Permintaan reservasi Anda akan langsung diteruskan ke resepsionis kami untuk konfirmasi instan via WhatsApp.",
      modal_label_name: "Nama Lengkap *",
      modal_label_phone: "Nomor WhatsApp / HP *",
      modal_label_email: "Alamat Email (Opsional)",
      modal_label_service: "Pilih Perawatan / Paket *",
      modal_label_date: "Tanggal Perawatan *",
      modal_label_time: "Waktu Kunjungan *",
      modal_label_guests: "Jumlah Tamu",
      modal_label_notes: "Permintaan Khusus (Opsional)",
      modal_name_placeholder: "Contoh: Budi Santoso / Sarah",
      modal_phone_placeholder: "Contoh: 0812-3456-7890",
      modal_notes_placeholder: "Preferensi terapis, fokus area pemijatan, atau perayaan khusus...",
      modal_guest_1: "1 Orang",
      modal_guest_2: "2 Orang",
      modal_guest_3: "3 Orang",
      modal_guest_4: "4 Orang",
      modal_guest_5: "5+ Orang",
      modal_submit: "Kirim Permintaan Reservasi",
      modal_success_title: "Reservasi Anda Telah Diterima",
      modal_btn_wa: "Konfirmasi Langsung di WhatsApp",
      modal_btn_close: "Tutup Jendela"
    }
  };

function updateBilingualCards(lang) {
  try {
    const isId = lang === 'id';
    document.querySelectorAll('.promo-card, .package-card, .treatment-card').forEach(card => {
      const titleEl = card.querySelector('.card-title');
      if (titleEl) {
        const val = isId ? (card.dataset.nameId || card.dataset.nameEn) : card.dataset.nameEn;
        if (val) {
          if (card.classList.contains('promo-card') && val.includes('(') && val.endsWith(')')) {
            const match = val.match(/^(.*?)\s*(\(.*?\))$/);
            if (match) {
              titleEl.innerHTML = `${match[1]} <span class="block text-sm sm:text-base font-serif font-normal text-sky-200/80 mt-1">${match[2]}</span>`;
            } else {
              titleEl.textContent = val;
            }
          } else {
            titleEl.textContent = val;
          }
        }
      }

      const descEl = card.querySelector('.card-desc');
      if (descEl) {
        const val = isId ? (card.dataset.descId || card.dataset.descEn) : card.dataset.descEn;
        if (val) descEl.textContent = val;
      }

      const subEl = card.querySelector('.card-subtitle');
      if (subEl) {
        const val = isId ? (card.dataset.subId || card.dataset.subEn) : card.dataset.subEn;
        if (val) subEl.textContent = val;
      }

      const durEl = card.querySelector('.card-duration');
      if (durEl) {
        const val = isId ? (card.dataset.durId || card.dataset.durEn) : card.dataset.durEn;
        if (val) durEl.textContent = val;
      }

      const tagEl = card.querySelector('.card-tag');
      if (tagEl) {
        const val = isId ? (card.dataset.tagId || card.dataset.tagEn) : card.dataset.tagEn;
        if (val) tagEl.textContent = val;
      }

      const catEl = card.querySelector('.card-category');
      if (catEl) {
        const val = isId ? (card.dataset.catId || card.dataset.catEn) : card.dataset.catEn;
        if (val) catEl.textContent = val;
      }

      const multiEl = card.querySelector('.card-multi-prices');
      if (multiEl) {
        const val = isId ? (card.dataset.multiId || card.dataset.multiEn) : card.dataset.multiEn;
        if (val) {
          if (val.includes('<')) multiEl.innerHTML = val;
          else multiEl.textContent = val;
        }
      }
    });

    // Update booking modal select service options & optgroups
    const serviceSelect = document.getElementById('booking-service');
    if (serviceSelect) {
      serviceSelect.querySelectorAll('option').forEach(opt => {
        const label = isId ? (opt.dataset.labelId || opt.dataset.labelEn) : opt.dataset.labelEn;
        if (label) opt.textContent = label;
      });
      serviceSelect.querySelectorAll('optgroup').forEach(grp => {
        const label = isId ? (grp.dataset.labelId || grp.dataset.labelEn) : grp.dataset.labelEn;
        if (label) grp.label = label;
      });
    }
  } catch (err) {
    console.error('Error in updateBilingualCards:', err);
  }
}

window.applyLanguage = function(lang) {
  try {
    window.__currentLang = lang;
    safeSetStorage('massaji_spa_lang', lang);

    document.querySelectorAll('.lang-btn').forEach(btn => {
      if (btn.dataset.lang === lang) {
        btn.classList.add('bg-[#1E3A8A]', 'text-white');
        btn.classList.remove('text-[#475569]', 'hover:text-[#141E3C]');
      } else {
        btn.classList.remove('bg-[#1E3A8A]', 'text-white');
        btn.classList.add('text-[#475569]', 'hover:text-[#141E3C]');
      }
    });

    // Translate text contents
    document.querySelectorAll('[data-i18n]').forEach(el => {
      const key = el.dataset.i18n;
      if (i18n[lang] && i18n[lang][key]) {
        if (i18n[lang][key].includes('<')) {
          el.innerHTML = i18n[lang][key];
        } else {
          el.textContent = i18n[lang][key];
        }
      }
    });

    // Translate placeholder attributes
    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
      const key = el.dataset.i18nPlaceholder;
      if (i18n[lang] && i18n[lang][key]) {
        el.placeholder = i18n[lang][key];
      }
    });

    updateBilingualCards(lang);

    if (typeof window.__updatePackagesToggleBtn === 'function') window.__updatePackagesToggleBtn();
    if (typeof window.__updateMenuToggleBtn === 'function') window.__updateMenuToggleBtn();

    const popupWaBtn = document.getElementById('popup-wa-btn');
    if (popupWaBtn) {
      const waMsg = lang === 'en'
        ? "Hello Massaji Spa, I would like to claim the End Year 2026 Big Promotion."
        : "Halo Massaji Spa, saya ingin mengklaim Promo Akhir Tahun 2026.";
      popupWaBtn.href = `https://wa.me/6281236695755?text=${encodeURIComponent(waMsg)}`;
    }
  } catch (err) {
    console.error('Error in applyLanguage:', err);
  }
};

// ========================================================
// 3. MAIN INITIALIZATION & DOM CONTROLLER
// ========================================================
function initMassajiApp() {
  try {
    // Initial language application
    window.applyLanguage(window.__currentLang);

    // Language switcher buttons
    document.querySelectorAll('.lang-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        window.applyLanguage(btn.dataset.lang);
      });
    });

    // Popup background click to dismiss
    const promoPopup = document.getElementById('promo-flyer-popup');
    if (promoPopup) {
      promoPopup.addEventListener('click', (e) => {
        if (e.target === promoPopup) {
          window.closePromoPopup();
        }
      });
    }

    // Auto-trigger promo popup smoothly after brief delay
    setTimeout(() => {
      window.openPromoPopup();
    }, 600);

    // Mobile Navigation Button
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', (e) => {
        if (e && typeof e.stopPropagation === 'function') e.stopPropagation();
        window.toggleMobileMenu();
      });
    }

    if (mobileMenu) {
      mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
          window.toggleMobileMenu(false);
        });
      });
    }

    // ----------------------------------------------------
    // Packages: Filter, Tabs & Expansion
    // ----------------------------------------------------
    let currentPackageCat = 'all';
    const packageTabs = document.querySelectorAll('.package-tab-btn');
    const packageSearchInput = document.getElementById('package-search-input');
    const packageSearchClear = document.getElementById('package-search-clear');
    const noPackagesMsg = document.getElementById('no-packages-found');

    window.__updatePackagesToggleBtn = function() {
      const btn = document.getElementById('packages-toggle-btn');
      if (!btn) return;
      const label = btn.querySelector('.packages-toggle-label');
      const chevron = btn.querySelector('.packages-toggle-chevron');
      const expanded = Boolean(window.__isPackagesExpanded);
      if (expanded) {
        btn.setAttribute('aria-expanded', 'true');
        if (label) {
          label.setAttribute('data-i18n', 'pkg_show_less');
          label.textContent = (i18n[window.__currentLang] && i18n[window.__currentLang].pkg_show_less) ? i18n[window.__currentLang].pkg_show_less : 'Show Less';
        }
        if (chevron) chevron.classList.add('rotate-180');
        btn.title = window.__currentLang === 'id' ? 'Tampilkan Lebih Sedikit' : 'Show Less Packages';
      } else {
        btn.setAttribute('aria-expanded', 'false');
        if (label) {
          label.setAttribute('data-i18n', 'pkg_view_all');
          label.textContent = (i18n[window.__currentLang] && i18n[window.__currentLang].pkg_view_all) ? i18n[window.__currentLang].pkg_view_all : 'View All Spa Packages';
        }
        if (chevron) chevron.classList.remove('rotate-180');
        btn.title = window.__currentLang === 'id' ? 'Lihat Semua Paket' : 'View All Spa Packages';
      }
    };

    window.__filterPackages = function(forceCat) {
      if (forceCat) currentPackageCat = forceCat;
      const query = (packageSearchInput && packageSearchInput.value) ? packageSearchInput.value.toLowerCase().trim() : '';
      const container = document.getElementById('packages-cards-container');
      if (!container) return;
      const cards = Array.from(container.querySelectorAll('.package-card'));
      const matchingCards = [];

      cards.forEach(card => {
        const catMatch = currentPackageCat === 'all' || card.dataset.category === currentPackageCat;
        const searchData = (card.dataset.search || card.textContent).toLowerCase();
        const queryMatch = !query || searchData.includes(query);

        if (catMatch && queryMatch) {
          matchingCards.push(card);
        } else {
          card.style.display = 'none';
        }
      });

      const totalMatching = matchingCards.length;
      const limit = window.__isPackagesExpanded ? totalMatching : 3;

      matchingCards.forEach((card, idx) => {
        if (idx < limit) {
          card.style.display = 'flex';
          card.style.opacity = '1';
        } else {
          card.style.display = 'none';
        }
      });

      if (noPackagesMsg) {
        if (totalMatching === 0) {
          noPackagesMsg.classList.remove('hidden');
        } else {
          noPackagesMsg.classList.add('hidden');
        }
      }

      const pkgToggleWrapper = document.getElementById('packages-toggle-wrapper');
      if (pkgToggleWrapper) {
        if (totalMatching <= 3) {
          pkgToggleWrapper.classList.add('hidden');
        } else {
          pkgToggleWrapper.classList.remove('hidden');
          window.__updatePackagesToggleBtn();
        }
      }

      if (packageSearchClear) {
        if (query.length > 0) {
          packageSearchClear.classList.remove('hidden');
        } else {
          packageSearchClear.classList.add('hidden');
        }
      }
    };

    packageTabs.forEach(btn => {
      btn.addEventListener('click', () => {
        currentPackageCat = btn.dataset.category;
        window.__isPackagesExpanded = false;

        packageTabs.forEach(b => {
          b.classList.remove('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
          b.classList.add('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');
        });

        btn.classList.add('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
        btn.classList.remove('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');

        window.__filterPackages();
      });
    });

    if (packageSearchInput) {
      packageSearchInput.addEventListener('input', () => {
        window.__isPackagesExpanded = false;
        window.__filterPackages();
      });
    }

    if (packageSearchClear) {
      packageSearchClear.addEventListener('click', () => {
        packageSearchInput.value = '';
        window.__isPackagesExpanded = false;
        window.__filterPackages();
        packageSearchInput.focus();
      });
    }

    const pkgToggleBtn = document.getElementById('packages-toggle-btn');
    if (pkgToggleBtn) {
      pkgToggleBtn.addEventListener('click', () => {
        window.__isPackagesExpanded = !window.__isPackagesExpanded;
        if (!window.__isPackagesExpanded) {
          const pkgSection = document.getElementById('packages');
          if (pkgSection) {
            pkgSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }
        window.__filterPackages();
      });
    }

    // ----------------------------------------------------
    // Treatment Menu: Filter, Tabs & Expansion
    // ----------------------------------------------------
    let currentMenuCat = 'all';
    const menuFilterButtons = document.querySelectorAll('.menu-filter-btn');
    const menuSearchInput = document.getElementById('menu-search-input');
    const menuSearchClear = document.getElementById('menu-search-clear');
    const noMenuMsg = document.getElementById('no-menu-found');

    window.__updateMenuToggleBtn = function() {
      const btn = document.getElementById('menu-toggle-btn');
      if (!btn) return;
      const label = btn.querySelector('.menu-toggle-label');
      const chevron = btn.querySelector('.menu-toggle-chevron');
      const expanded = Boolean(window.__isMenuExpanded);
      if (expanded) {
        btn.setAttribute('aria-expanded', 'true');
        if (label) {
          label.setAttribute('data-i18n', 'menu_show_less');
          label.textContent = (i18n[window.__currentLang] && i18n[window.__currentLang].menu_show_less) ? i18n[window.__currentLang].menu_show_less : 'Show Less';
        }
        if (chevron) chevron.classList.add('rotate-180');
        btn.title = window.__currentLang === 'id' ? 'Tampilkan Lebih Sedikit' : 'Show Less Treatments';
      } else {
        btn.setAttribute('aria-expanded', 'false');
        if (label) {
          label.setAttribute('data-i18n', 'menu_view_all');
          label.textContent = (i18n[window.__currentLang] && i18n[window.__currentLang].menu_view_all) ? i18n[window.__currentLang].menu_view_all : 'View All Treatments';
        }
        if (chevron) chevron.classList.remove('rotate-180');
        btn.title = window.__currentLang === 'id' ? 'Lihat Semua Perawatan' : 'View All Treatments';
      }
    };

    window.__filterMenu = function(forceCat) {
      if (forceCat) currentMenuCat = forceCat;
      const query = (menuSearchInput && menuSearchInput.value) ? menuSearchInput.value.toLowerCase().trim() : '';
      const container = document.getElementById('menu-cards-container');
      if (!container) return;
      const cards = Array.from(container.querySelectorAll('.treatment-card'));
      const matchingCards = [];

      cards.forEach(card => {
        const catMatch = currentMenuCat === 'all' || card.dataset.category === currentMenuCat;
        const searchData = (card.dataset.search || card.textContent).toLowerCase();
        const queryMatch = !query || searchData.includes(query);

        if (catMatch && queryMatch) {
          matchingCards.push(card);
        } else {
          card.style.display = 'none';
        }
      });

      const totalMatching = matchingCards.length;
      const limit = window.__isMenuExpanded ? totalMatching : 3;

      matchingCards.forEach((card, idx) => {
        if (idx < limit) {
          card.style.display = 'flex';
          card.style.opacity = '1';
        } else {
          card.style.display = 'none';
        }
      });

      if (noMenuMsg) {
        if (totalMatching === 0) {
          noMenuMsg.classList.remove('hidden');
        } else {
          noMenuMsg.classList.add('hidden');
        }
      }

      const menuToggleWrapper = document.getElementById('menu-toggle-wrapper');
      if (menuToggleWrapper) {
        if (totalMatching <= 3) {
          menuToggleWrapper.classList.add('hidden');
        } else {
          menuToggleWrapper.classList.remove('hidden');
          window.__updateMenuToggleBtn();
        }
      }

      if (menuSearchClear) {
        if (query.length > 0) {
          menuSearchClear.classList.remove('hidden');
        } else {
          menuSearchClear.classList.add('hidden');
        }
      }
    };

    menuFilterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        currentMenuCat = btn.dataset.category;
        window.__isMenuExpanded = false;

        menuFilterButtons.forEach(b => {
          b.classList.remove('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
          b.classList.add('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');
        });

        btn.classList.add('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
        btn.classList.remove('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');

        window.__filterMenu();
      });
    });

    if (menuSearchInput) {
      menuSearchInput.addEventListener('input', () => {
        window.__isMenuExpanded = false;
        window.__filterMenu();
      });
    }

    if (menuSearchClear) {
      menuSearchClear.addEventListener('click', () => {
        menuSearchInput.value = '';
        window.__isMenuExpanded = false;
        window.__filterMenu();
        menuSearchInput.focus();
      });
    }

    const menuToggleBtn = document.getElementById('menu-toggle-btn');
    if (menuToggleBtn) {
      menuToggleBtn.addEventListener('click', () => {
        window.__isMenuExpanded = !window.__isMenuExpanded;
        if (!window.__isMenuExpanded) {
          const menuSection = document.getElementById('menu');
          if (menuSection) {
            menuSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }
        window.__filterMenu();
      });
    }

    // Initial filter execution
    window.__filterPackages();
    window.__filterMenu();

    // ----------------------------------------------------
    // Booking Modal Close Triggers
    // ----------------------------------------------------
    const modalCloseBtn = document.getElementById('modal-close-btn');
    if (modalCloseBtn) modalCloseBtn.addEventListener('click', window.closeBookingModal);

    const bookingModal = document.getElementById('booking-modal');
    if (bookingModal) {
      bookingModal.addEventListener('click', (e) => {
        if (e.target === bookingModal) window.closeBookingModal();
      });
    }

    // ----------------------------------------------------
    // Booking Form Submission & WhatsApp Generation
    // ----------------------------------------------------
    const bookingForm = document.getElementById('booking-form');
    const bookingSubmitBtn = document.getElementById('booking-submit-btn');
    const bookingConfirmation = document.getElementById('booking-confirmation');
    const waConfirmLink = document.getElementById('wa-confirm-link');
    const bookingSummaryText = document.getElementById('booking-summary-text');
    const bookingErrorMsg = document.getElementById('booking-error-msg');

    if (bookingForm) {
      bookingForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (bookingErrorMsg) bookingErrorMsg.classList.add('hidden');

        const originalBtnHtml = bookingSubmitBtn.innerHTML;
        bookingSubmitBtn.disabled = true;
        bookingSubmitBtn.innerHTML = `
          <svg class="animate-spin h-4 w-4 text-white inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
          </svg>
          ${window.__currentLang === 'en' ? 'Processing Booking...' : 'Memproses Reservasi...'}
        `;

        const formData = new FormData(bookingForm);
        const name = formData.get('name') || 'Guest';
        const service = formData.get('service') || 'Massaji Spa Treatment';
        const date = formData.get('date') || '';
        const time = formData.get('time') || '';
        const guests = formData.get('guests') || '1';
        const phone = formData.get('phone') || '';
        const notes = formData.get('notes') || '';

        // Capture Traffic Source & Device for Admin Analytics
        const params = new URLSearchParams(window.location.search);
        let detectedSource = params.get('utm_source') || '';
        const ref = (document.referrer || '').toLowerCase();
        if (!detectedSource) {
          if (ref.includes('instagram.com') || ref.includes('l.instagram.com')) detectedSource = 'Instagram';
          else if (ref.includes('google.')) detectedSource = 'Google Search';
          else if (ref.includes('facebook.com') || ref.includes('fb.com')) detectedSource = 'Facebook';
          else if (ref.includes('tiktok.com')) detectedSource = 'TikTok';
          else if (ref.includes('whatsapp.com') || ref.includes('wa.me')) detectedSource = 'WhatsApp';
          else if (ref && !ref.includes('massaji.net') && !ref.includes('localhost') && !ref.includes('127.0.0.1')) {
            try { detectedSource = new URL(ref).hostname.replace(/^www\./, ''); } catch(e) { detectedSource = 'Web Referral'; }
          } else {
            detectedSource = 'Direct Website';
          }
        }
        const isMobile = window.innerWidth <= 768 || /iphone|ipad|android|mobile/i.test(navigator.userAgent);
        const detectedDevice = isMobile ? 'Mobile' : 'Desktop';

        formData.append('source', detectedSource);
        formData.append('device', detectedDevice);
        formData.append('referrer', document.referrer || '');

        const waNumber = '6281236695755';
        let waText = '';
        if (window.__currentLang === 'en') {
          waText = `Hello *Massaji Spa Bali*,\n\nI would like to book an appointment:\n• *Guest:* ${name}\n• *Treatment / Package:* ${service}\n• *Date:* ${date}\n• *Time:* ${time} WITA\n• *Party Size:* ${guests} guest(s)\n`;
          if (phone) waText += `• *Phone / WhatsApp:* ${phone}\n`;
          waText += `• *Booking Source:* Website (${detectedSource} • ${detectedDevice})\n`;
          if (notes) waText += `• *Notes:* ${notes}\n`;
          waText += `\nPlease confirm availability for this session. Thank you!`;
        } else {
          waText = `Halo *Massaji Spa Bali*,\n\nSaya ingin memesan jadwal reservasi via website:\n• *Nama:* ${name}\n• *Perawatan / Paket:* ${service}\n• *Tanggal:* ${date}\n• *Jam:* ${time} WITA\n• *Jumlah Tamu:* ${guests} orang\n`;
          if (phone) waText += `• *Nomor Kontak:* ${phone}\n`;
          waText += `• *Sumber Reservasi:* Website (${detectedSource} • ${detectedDevice})\n`;
          if (notes) waText += `• *Catatan:* ${notes}\n`;
          waText += `\nMohon konfirmasi ketersediaan slot waktu ini. Terima kasih!`;
        }
        const fallbackWaUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(waText)}`;

        // Route to authoritative Biznet PHP backend when visiting from GitHub Pages
        function getBookingEndpoint() {
          if (typeof window !== 'undefined' && window.location && window.location.hostname === 'eyestetix.github.io') {
            return 'https://massaji.net/booking-process.php';
          }
          return 'booking-process.php';
        }

        try {
          const endpoint = getBookingEndpoint();
          const response = await fetch(endpoint, {
            method: 'POST',
            body: formData
          });

          const result = await response.json().catch(() => null);

          if (response.ok && result && result.success) {
            showBookingSuccess(result.details || { name, service, date, time, guests }, result.whatsapp_url || fallbackWaUrl);
          } else {
            const errorMsg = (result && result.message) ? result.message : (window.__currentLang === 'en' 
              ? 'Unable to complete reservation on the server. Please try again or confirm directly via WhatsApp.' 
              : 'Gagal menyimpan reservasi ke server. Silakan coba kembali atau konfirmasi langsung via WhatsApp.');
            if (bookingErrorMsg) {
              bookingErrorMsg.textContent = errorMsg;
              bookingErrorMsg.classList.remove('hidden');
            }
          }
        } catch (err) {
          console.error('Reservation submission error:', err);
          const errorMsg = window.__currentLang === 'en' 
            ? 'Connection error while submitting reservation. Please check your connection or book directly via WhatsApp.' 
            : 'Gangguan koneksi saat mengirim reservasi. Silakan periksa koneksi internet Anda atau hubungi langsung via WhatsApp.';
          if (bookingErrorMsg) {
            bookingErrorMsg.textContent = errorMsg;
            bookingErrorMsg.classList.remove('hidden');
          }
        } finally {
          bookingSubmitBtn.disabled = false;
          bookingSubmitBtn.innerHTML = originalBtnHtml;
        }
      });
    }

    function showBookingSuccess(details, waUrl) {
      if (bookingForm) bookingForm.classList.add('hidden');
      if (bookingConfirmation) bookingConfirmation.classList.remove('hidden');

      if (bookingSummaryText) {
        if (window.__currentLang === 'en') {
          bookingSummaryText.innerHTML = `
            Thank you, <strong>${details.name}</strong>. Your inquiry for <strong>${details.service}</strong> on <strong>${details.date}</strong> at <strong>${details.time} WITA</strong> (${details.guests} guest) has been received.
          `;
        } else {
          bookingSummaryText.innerHTML = `
            Terima kasih, <strong>${details.name}</strong>. Permintaan reservasi Anda untuk <strong>${details.service}</strong> pada <strong>${details.date}</strong> jam <strong>${details.time} WITA</strong> (${details.guests} orang) telah kami terima.
          `;
        }
      }

      if (waConfirmLink) waConfirmLink.href = waUrl;
      if (bookingForm) bookingForm.reset();
    }

    // Dynamic Live Settings Sync (Updates About Image, Hero Image, Promo Flyer)
    try {
      fetch('data/settings.json?v=' + Date.now())
        .then(function(r) { return r.ok ? r.json() : null; })
        .then(function(s) {
          if (!s) return;
          if (s.about_image) {
            var aboutEl = document.getElementById('about-main-image');
            if (aboutEl && aboutEl.getAttribute('src') !== s.about_image) {
              aboutEl.src = s.about_image;
            }
          }
          if (s.hero_image) {
            var heroEl = document.getElementById('hero-main-image');
            if (heroEl && heroEl.getAttribute('src') !== s.hero_image) {
              heroEl.src = s.hero_image;
            }
          }
          if (s.promo_flyer_image) {
            var promoEl = document.getElementById('promo-flyer-image');
            if (promoEl && promoEl.getAttribute('src') !== s.promo_flyer_image) {
              promoEl.src = s.promo_flyer_image;
            }
          }
        }).catch(function() {});
    } catch(e) {}

  } catch (err) {
    console.error('Fatal initialization error in initMassajiApp:', err);
  }
}

// Run initialization immediately or when DOM is ready
if (typeof document !== 'undefined') {
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMassajiApp);
  } else {
    initMassajiApp();
  }
}

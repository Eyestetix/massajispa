// assets/js/main.js - Interactive UI & Bilingual System for Massaji Spa Bali

document.addEventListener('DOMContentLoaded', () => {

  // ========================================================
  // 1. COMPREHENSIVE BILINGUAL SYSTEM (EN / ID)
  // ========================================================
  const i18n = {
    en: {
      nav_promo: "Promo",
      nav_packages: "Spa Packages",
      nav_menu: "Treatment Menu",
      nav_about: "About Us",
      nav_reviews: "Reviews (4.8★)",
      nav_contact: "Location & Hours",
      nav_book: "Book Treatment",

      hero_eyebrow: "Boutique Wellness Sanctuary • Canggu, Bali",
      hero_title_1: "Find Your Balance.",
      hero_title_2: "Rediscover Serenity.",
      hero_desc: "Experience authentic Balinese healing rituals, thoughtful treatments, and peaceful moments of relaxation in the heart of Canggu.",
      hero_btn_book: "Book Your Treatment",
      hero_btn_explore: "Explore Spa Packages",
      stat_rating: "4.8★ Verified Reviews",
      stat_count: "(560+ Guests in Canggu)",

      trust_1: "Authentic Balinese Treatments",
      trust_2: "Certified & Experienced Therapists",
      trust_3: "100% Pure Botanical Ingredients",
      trust_4: "Private, Clean & Quiet Suites",

      promo_eyebrow: "Limited-Time Special",
      promo_title: "March 2026 Promotion",
      promo_desc: "Exclusive discounts on our highly requested therapies. Reservation is required prior to your visit.",

      packages_eyebrow: "Curated Spa Rituals",
      packages_title: "Spa Packages",
      packages_desc: "Thoughtfully designed treatment combinations for singles, couples, and groups seeking profound rejuvenation in Bali.",
      pkg_tab_all: "All Packages",
      pkg_tab_single: "Single Package (1 Person)",
      pkg_tab_couple: "Couple Package (2 Persons)",
      pkg_tab_group: "Group Package (4 Persons)",

      menu_eyebrow: "Full Spa Catalog",
      menu_title: "Treatment Menu & Pricing",
      menu_desc: "Complete individual treatment menu with honest, transparent pricing in Canggu & Kerobokan.",
      cat_all: "All Treatments",
      cat_massage: "Body Massage",
      cat_spa: "Body Spa Treatments",
      cat_slimming: "Slimming & Cellulite",
      cat_facial: "Facial Treatments",
      cat_nail: "Nail Services",
      cat_additional: "Additional Services",
      card_rate: "Nett Price",
      card_btn_book: "Book Treatment",

      about_eyebrow: "About Massaji Spa",
      about_title_1: "Rooted in Bali.",
      about_title_2: "Created for Your Wellbeing.",
      about_desc_1: "Nestled in a peaceful pocket of Kerobokan and Canggu, Massaji Spa was created to deliver authentic Balinese healing traditions with five-star cleanliness at honest, accessible prices.",
      about_desc_2: "From warming traditional Balinese Boreh spice wraps and slimming RF cavitation to certified prenatal therapy for mothers-to-be—our experienced therapists tailor every pressure point to your body's individual needs.",
      about_val_1: "Pure Essential Oils",
      about_val_1_desc: "Frangipani, lemongrass, lavender, and traditional natural spices.",
      about_val_2: "Absolute Hygiene",
      about_val_2_desc: "Freshly laundered linens and towels for every single guest session.",

      reviews_eyebrow: "Guest Testimonials",
      reviews_title: "Trusted by Travelers Across the Globe",
      reviews_summary: "4.8 out of 5.0 based on 560+ verified reviews in Canggu & Kerobokan.",

      contact_eyebrow: "Visit Us",
      contact_title: "Location & Opening Hours",
      contact_desc: "Conveniently located along the main Canggu / Kerobokan route with dedicated parking for scooters and cars.",
      contact_address_label: "Physical Address",
      contact_maps_link: "Open Directions in Google Maps →",
      contact_hours_label: "Opening Hours",
      contact_hours_val: "Daily: 10:00 AM – 9:00 PM WITA",
      contact_chat_label: "Instant Reservation",

      modal_eyebrow: "Direct Reservation",
      modal_title: "Book Your Spa Treatment",
      modal_desc: "Your booking inquiry will be sent directly to our reception email and formatted for instant WhatsApp confirmation.",
      modal_label_name: "Full Name *",
      modal_label_phone: "WhatsApp / Phone *",
      modal_label_email: "Email Address",
      modal_label_service: "Select Treatment / Package *",
      modal_label_date: "Date *",
      modal_label_time: "Time Slot *",
      modal_label_guests: "Guests",
      modal_label_notes: "Special Requests (Optional)",
      modal_submit: "Submit Reservation Request",
      modal_success_title: "Reservation Received",
      modal_btn_wa: "Confirm Instantly on WhatsApp",
      modal_btn_close: "Close Window"
    },
    id: {
      nav_promo: "Promo",
      nav_packages: "Paket Spa",
      nav_menu: "Menu Perawatan",
      nav_about: "Tentang Kami",
      nav_reviews: "Ulasan (4.8★)",
      nav_contact: "Lokasi & Jam Buka",
      nav_book: "Pesan Treatment",

      hero_eyebrow: "Sanctuary Spa Butik • Canggu, Bali",
      hero_title_1: "Temukan Keseimbangan.",
      hero_title_2: "Pulihkan Kedamaian Diri.",
      hero_desc: "Nikmati relaksasi mendalam di Canggu & Kerobokan dengan sentuhan terapis berpengalaman, minyak aromaterapi murni, dan tradisi penyembuhan Bali autentik.",
      hero_btn_book: "Reservasi Jadwal Pijat",
      hero_btn_explore: "Lihat Paket Pilihan",
      stat_rating: "4.8★ Ulasan Terverifikasi",
      stat_count: "(560+ Tamu di Canggu)",

      trust_1: "Perawatan Autentik Tradisional Bali",
      trust_2: "Terapis Berpengalaman & Tersertifikasi",
      trust_3: "100% Minyak Botani & Rempah Alami",
      trust_4: "Ruang Privat, Tenang & Higienis",

      promo_eyebrow: "Penawaran Terbatas",
      promo_title: "Promo Spesial Maret 2026",
      promo_desc: "Diskon eksklusif untuk perawatan spa terpopuler. Diperlukan reservasi sebelum kunjungan.",

      packages_eyebrow: "Ritual Spa Pilihan",
      packages_title: "Paket Perawatan Spa",
      packages_desc: "Kombinasi perawatan pilihan untuk individu, pasangan, dan rombongan yang dirancang untuk kesegaran tubuh dan pikiran.",
      pkg_tab_all: "Semua Paket",
      pkg_tab_single: "Paket Single (1 Orang)",
      pkg_tab_couple: "Paket Couple (2 Orang)",
      pkg_tab_group: "Paket Group (4 Orang)",

      menu_eyebrow: "Katalog Lengkap",
      menu_title: "Daftar Menu & Tarif Layanan",
      menu_desc: "Daftar lengkap perawatan satuan dengan harga jujur dan transparan di kawasan Canggu & Kerobokan.",
      cat_all: "Semua Layanan",
      cat_massage: "Pijat Tubuh",
      cat_spa: "Body Spa Ritual",
      cat_slimming: "Slimming & Selulit",
      cat_facial: "Perawatan Wajah",
      cat_nail: "Perawatan Kuku",
      cat_additional: "Layanan Tambahan",
      card_rate: "Tarif",
      card_btn_book: "Pesan",

      about_eyebrow: "Tentang Massaji Spa",
      about_title_1: "Berakar di Bali.",
      about_title_2: "Diciptakan untuk Kebugaran Anda.",
      about_desc_1: "Terletak di kawasan Kerobokan / Canggu yang tenang, Massaji Spa menghadirkan kembali ritual penyembuhan tradisional Bali dengan standar kenyamanan mewah namun tetap dengan harga yang bersahabat.",
      about_desc_2: "Mulai dari tradisi rempah Boreh Bali yang menghangatkan persendian, slimming RF cavitation, hingga pijat prenatal bersertifikat untuk ibu hamil—setiap terapis kami berdedikasi memberikan perawatan terbaik.",
      about_val_1: "Minyak Esensial Alami",
      about_val_1_desc: "Bunga kamboja, serai, lavender, serta lulur rempah boreh alami.",
      about_val_2: "Higienitas Terjamin",
      about_val_2_desc: "Sprei dan handuk selalu baru diganti setiap sesi perawatan.",

      reviews_eyebrow: "Ulasan Tamu",
      reviews_title: "Dipercaya Ribuan Pelancong di Bali",
      reviews_summary: "Rating 4.8 dari 5.0 berdasarkan 560+ ulasan Google di Canggu & Kerobokan.",

      contact_eyebrow: "Kunjungi Kami",
      contact_title: "Lokasi & Jam Buka",
      contact_desc: "Terletak di jalan utama Canggu / Kerobokan dengan area parkir motor dan mobil yang aman.",
      contact_address_label: "Alamat Fisik",
      contact_maps_link: "Buka Petunjuk Arah di Google Maps →",
      contact_hours_label: "Jam Operasional",
      contact_hours_val: "Setiap Hari: 10:00 – 21:00 WITA",
      contact_chat_label: "Reservasi Cepat",

      modal_eyebrow: "Reservasi Langsung",
      modal_title: "Pesan Jadwal Perawatan",
      modal_desc: "Rincian reservasi Anda akan langsung diteruskan ke email resepsionis dan pesan konfirmasi WhatsApp.",
      modal_label_name: "Nama Lengkap *",
      modal_label_phone: "WhatsApp / Telepon *",
      modal_label_email: "Alamat Email",
      modal_label_service: "Pilihan Layanan / Paket *",
      modal_label_date: "Tanggal *",
      modal_label_time: "Jam Kunjungan *",
      modal_label_guests: "Jumlah Tamu",
      modal_label_notes: "Catatan Tambahan (Opsional)",
      modal_submit: "Kirim Permintaan Reservasi",
      modal_success_title: "Reservasi Terkirim",
      modal_btn_wa: "Lanjut Konfirmasi Cepat ke WhatsApp",
      modal_btn_close: "Tutup Jendela"
    }
  };

  // Language management
  let currentLang = localStorage.getItem('massaji_spa_lang') || 'en';

  function applyLanguage(lang) {
    currentLang = lang;
    localStorage.setItem('massaji_spa_lang', lang);

    document.querySelectorAll('.lang-btn').forEach(btn => {
      if (btn.dataset.lang === lang) {
        btn.classList.add('bg-[#1E3A8A]', 'text-white');
        btn.classList.remove('text-[#475569]', 'hover:text-[#141E3C]');
      } else {
        btn.classList.remove('bg-[#1E3A8A]', 'text-white');
        btn.classList.add('text-[#475569]', 'hover:text-[#141E3C]');
      }
    });

    document.querySelectorAll('[data-i18n]').forEach(el => {
      const key = el.dataset.i18n;
      if (i18n[lang] && i18n[lang][key]) {
        el.textContent = i18n[lang][key];
      }
    });
  }

  document.querySelectorAll('.lang-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      applyLanguage(btn.dataset.lang);
    });
  });

  applyLanguage(currentLang);

  // ========================================================
  // 2. MOBILE NAVIGATION
  // ========================================================
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
      });
    });
  }

  // ========================================================
  // 3. PACKAGES CATEGORY TABS FILTERING
  // ========================================================
  const packageTabs = document.querySelectorAll('.package-tab-btn');
  const packageCards = document.querySelectorAll('.package-card');

  packageTabs.forEach(btn => {
    btn.addEventListener('click', () => {
      const category = btn.dataset.category;

      packageTabs.forEach(b => {
        b.classList.remove('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
        b.classList.add('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');
      });

      btn.classList.add('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
      btn.classList.remove('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');

      packageCards.forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
          card.style.display = 'flex';
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, 10);
        } else {
          card.style.opacity = '0';
          card.style.transform = 'translateY(10px)';
          setTimeout(() => {
            card.style.display = 'none';
          }, 200);
        }
      });
    });
  });

  // ========================================================
  // 4. MENU CATEGORY TABS FILTERING
  // ========================================================
  const filterButtons = document.querySelectorAll('.menu-filter-btn');
  const menuCards = document.querySelectorAll('#menu-cards-container .treatment-card');

  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const category = btn.dataset.category;

      filterButtons.forEach(b => {
        b.classList.remove('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
        b.classList.add('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');
      });

      btn.classList.add('active', 'bg-[#1E3A8A]', 'text-white', 'border-[#1E3A8A]');
      btn.classList.remove('bg-white', 'text-[#475569]', 'border-[#BAE0FD]');

      menuCards.forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
          card.style.display = 'flex';
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, 10);
        } else {
          card.style.opacity = '0';
          card.style.transform = 'translateY(10px)';
          setTimeout(() => {
            card.style.display = 'none';
          }, 200);
        }
      });
    });
  });

  // ========================================================
  // 5. BOOKING MODAL
  // ========================================================
  const bookingModal = document.getElementById('booking-modal');
  const modalCloseBtn = document.getElementById('modal-close-btn');
  const serviceSelect = document.getElementById('booking-service');

  window.openBookingModal = function(serviceName = '') {
    if (bookingModal) {
      const formEl = document.getElementById('booking-form');
      const confirmEl = document.getElementById('booking-confirmation');
      if (formEl) formEl.classList.remove('hidden');
      if (confirmEl) confirmEl.classList.add('hidden');

      if (serviceSelect && serviceName) {
        let matchFound = false;
        const cleanTarget = serviceName.toLowerCase().replace(/[^a-z0-9]/g, '');
        for (let i = 0; i < serviceSelect.options.length; i++) {
          const optText = serviceSelect.options[i].text.toLowerCase().replace(/[^a-z0-9]/g, '');
          if (optText.includes(cleanTarget) || cleanTarget.includes(optText)) {
            serviceSelect.selectedIndex = i;
            matchFound = true;
            break;
          }
        }
        if (!matchFound) {
          // If not matched, select option value or match partial
          for (let i = 0; i < serviceSelect.options.length; i++) {
            if (serviceSelect.options[i].value.toLowerCase().includes(serviceName.toLowerCase()) ||
                serviceName.toLowerCase().includes(serviceSelect.options[i].value.toLowerCase())) {
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
    }
  };

  window.closeBookingModal = function() {
    if (bookingModal) {
      bookingModal.classList.add('hidden');
      bookingModal.classList.remove('flex');
      document.body.style.overflow = '';
    }
  };

  if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeBookingModal);

  if (bookingModal) {
    bookingModal.addEventListener('click', (e) => {
      if (e.target === bookingModal) closeBookingModal();
    });
  }

  // ========================================================
  // 6. BOOKING SUBMISSION & DIRECT WHATSAPP GENERATION
  // ========================================================
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
        ${currentLang === 'en' ? 'Processing Booking...' : 'Memproses Reservasi...'}
      `;

      const formData = new FormData(bookingForm);
      const name = formData.get('name') || 'Guest';
      const service = formData.get('service') || 'Massaji Spa Treatment';
      const date = formData.get('date') || '';
      const time = formData.get('time') || '';
      const guests = formData.get('guests') || '1';
      const phone = formData.get('phone') || '';
      const notes = formData.get('notes') || '';

      const waNumber = '6281236695755';
      let waText = `Hello *Massaji Spa Bali*,\n\nI would like to book an appointment:\n• *Guest:* ${name}\n• *Treatment / Package:* ${service}\n• *Date:* ${date}\n• *Time:* ${time} WITA\n• *Party Size:* ${guests} guest(s)\n`;
      if (phone) waText += `• *Phone / WhatsApp:* ${phone}\n`;
      if (notes) waText += `• *Notes:* ${notes}\n`;
      waText += `\nPlease confirm availability for this session. Thank you!`;
      const fallbackWaUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(waText)}`;

      try {
        const response = await fetch('booking-process.php', {
          method: 'POST',
          body: formData
        });

        if (response.ok) {
          const result = await response.json();
          showBookingSuccess(result.details || { name, service, date, time, guests }, result.whatsapp_url || fallbackWaUrl);
        } else {
          showBookingSuccess({ name, service, date, time, guests }, fallbackWaUrl);
        }
      } catch (err) {
        showBookingSuccess({ name, service, date, time, guests }, fallbackWaUrl);
      } finally {
        bookingSubmitBtn.disabled = false;
        bookingSubmitBtn.innerHTML = originalBtnHtml;
      }
    });
  }

  function showBookingSuccess(details, waUrl) {
    bookingForm.classList.add('hidden');
    bookingConfirmation.classList.remove('hidden');

    if (bookingSummaryText) {
      if (currentLang === 'en') {
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
    bookingForm.reset();
  }

});

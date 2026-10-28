// assets/js/main.js - Contemporary Balinese Luxury UI Interactions & Bilingual System

document.addEventListener('DOMContentLoaded', () => {

  // ========================================================
  // 1. COMPREHENSIVE BILINGUAL SYSTEM (EN / ID)
  // ========================================================
  const i18n = {
    en: {
      nav_about: "About Us",
      nav_deals: "Special Deals",
      nav_menu: "Menu & Pricing",
      nav_reviews: "Reviews (4.8★)",
      nav_contact: "Location & Hours",
      nav_book: "Book Treatment",
      hero_eyebrow: "Boutique Wellness Sanctuary • Canggu, Bali",
      hero_title_1: "Find Your Balance.",
      hero_title_2: "Rediscover Serenity.",
      hero_desc: "Experience authentic Balinese healing rituals, thoughtful treatments, and peaceful moments of relaxation in the heart of Canggu.",
      hero_btn_book: "Book Your Treatment",
      hero_btn_explore: "Explore Treatments",
      stat_rating: "4.8★ Verified Reviews",
      stat_count: "(560+ Guests in Canggu)",
      trust_1: "Authentic Balinese Treatments",
      trust_2: "Certified & Experienced Therapists",
      trust_3: "100% Pure Botanical Ingredients",
      trust_4: "Private, Clean & Quiet Suites",
      deals_eyebrow: "Curated Packages",
      deals_title: "Special Spa Experiences",
      deals_desc: "Discover thoughtfully curated treatments and exclusive spa packages designed for profound relaxation.",
      deals_badge_free: "Includes: Pure Cooling Aloe Vera & Honey Face Mask",
      deals_book_btn: "Book Package",
      about_eyebrow: "About Massaji Spa",
      about_title_1: "Rooted in Bali.",
      about_title_2: "Created for Your Wellbeing.",
      about_desc_1: "Nestled in a peaceful pocket of Kerobokan and Canggu, Massaji Spa was created to deliver authentic Balinese healing traditions with five-star cleanliness at honest, accessible prices.",
      about_desc_2: "From warming traditional Balinese Boreh spice scrubs and Australian Pevonia botanical facials to certified prenatal therapy for mothers-to-be—our therapists tailor every pressure point to your body's individual needs.",
      about_val_1: "Pure Essential Oils",
      about_val_1_desc: "Frangipani, lemongrass, lavender, and traditional natural spices.",
      about_val_2: "Absolute Hygiene",
      about_val_2_desc: "Freshly laundered linens and towels for every single guest session.",
      menu_eyebrow: "Treatment Catalog",
      menu_title: "Menu & Pricing",
      menu_desc: "Transparent and budget-friendly pricing with no hidden charges in Canggu & Kerobokan.",
      cat_all: "All Treatments",
      cat_packages: "Signature Packages",
      cat_massage: "Body Massage",
      cat_beauty: "Facial & Scrub",
      cat_reflexology: "Reflexology",
      card_rate: "Nett Price",
      card_btn_book: "Book Treatment",
      reviews_eyebrow: "Guest Testimonials",
      reviews_title: "Trusted by Travelers Across the Globe",
      reviews_summary: "4.8 out of 5.0 based on 560+ verified reviews",
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
      modal_label_service: "Select Treatment *",
      modal_label_date: "Date *",
      modal_label_time: "Time Slot *",
      modal_label_guests: "Guests",
      modal_label_notes: "Special Requests (Optional)",
      modal_submit: "Submit Reservation Request",
      modal_success_title: "Reservation Received",
      modal_btn_wa: "Confirm Instantly on WhatsApp",
      modal_btn_close: "Close Window",
      mobile_btn_wa: "WhatsApp",
      mobile_btn_book: "Book Now"
    },
    id: {
      nav_about: "Tentang Kami",
      nav_deals: "Paket Promo",
      nav_menu: "Menu & Harga",
      nav_reviews: "Ulasan (4.8★)",
      nav_contact: "Lokasi & Jam Buka",
      nav_book: "Pesan Treatment",
      hero_eyebrow: "Sanctuary Spa Butik • Canggu, Bali",
      hero_title_1: "Temukan Keseimbangan.",
      hero_title_2: "Pulihkan Kedamaian Diri.",
      hero_desc: "Nikmati relaksasi mendalam di Canggu & Kerobokan dengan sentuhan terapis berpengalaman, minyak aromaterapi murni, dan tradisi penyembuhan Bali autentik.",
      hero_btn_book: "Reservasi Jadwal Pijat",
      hero_btn_explore: "Lihat Menu & Harga",
      stat_rating: "4.8★ Ulasan Terverifikasi",
      stat_count: "(560+ Tamu di Canggu)",
      trust_1: "Perawatan Autentik Tradisional Bali",
      trust_2: "Terapis Berpengalaman & Tersertifikasi",
      trust_3: "100% Minyak Botani & Rempah Alami",
      trust_4: "Ruang Privat, Tenang & Higienis",
      deals_eyebrow: "Penawaran Pilihan",
      deals_title: "Paket Perawatan Spesial",
      deals_desc: "Temukan paket perawatan spa pilihan eksklusif untuk memulihkan kesegaran tubuh dan pikiran.",
      deals_badge_free: "Bonus: Free Pure Cooling Aloe Vera & Honey Face Mask",
      deals_book_btn: "Pesan Paket Ini",
      about_eyebrow: "Tentang Massaji Spa",
      about_title_1: "Berakar di Bali.",
      about_title_2: "Diciptakan untuk Kebugaran Anda.",
      about_desc_1: "Terletak di kawasan Kerobokan / Canggu yang tenang, Massaji Spa menghadirkan kembali ritual penyembuhan tradisional Bali dengan standar kenyamanan mewah namun tetap dengan harga yang bersahabat.",
      about_desc_2: "Mulai dari tradisi rempah Boreh Bali yang menghangatkan persendian, Facial Pevonia yang menyegarkan wajah lelah, hingga pijat prenatal bersertifikat untuk ibu hamil—setiap terapis kami berdedikasi memberikan perawatan terbaik.",
      about_val_1: "Minyak Esensial Alami",
      about_val_1_desc: "Bunga kamboja, serai, lavender, serta lulur rempah boreh alami.",
      about_val_2: "Higienitas Terjamin",
      about_val_2_desc: "Sprei dan handuk selalu baru diganti setiap sesi perawatan.",
      menu_eyebrow: "Katalog Perawatan",
      menu_title: "Daftar Menu & Tarif Layanan",
      menu_desc: "Harga transparan dan terjangkau di kawasan Canggu & Kerobokan tanpa biaya tersembunyi.",
      cat_all: "Semua Layanan",
      cat_packages: "Paket Signature",
      cat_massage: "Pijat Tubuh",
      cat_beauty: "Facial & Scrub",
      cat_reflexology: "Reflexology",
      card_rate: "Tarif",
      card_btn_book: "Pesan",
      reviews_eyebrow: "Ulasan Tamu",
      reviews_title: "Dipercaya Ribuan Pelancong di Bali",
      reviews_summary: "Rating 4.8 dari 5.0 berdasarkan 560+ ulasan Google",
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
      modal_label_service: "Pilihan Layanan *",
      modal_label_date: "Tanggal *",
      modal_label_time: "Jam Kunjungan *",
      modal_label_guests: "Jumlah Tamu",
      modal_label_notes: "Catatan Tambahan (Opsional)",
      modal_submit: "Kirim Permintaan Reservasi",
      modal_success_title: "Reservasi Terkirim",
      modal_btn_wa: "Lanjut Konfirmasi Cepat ke WhatsApp",
      modal_btn_close: "Tutup Jendela",
      mobile_btn_wa: "WhatsApp",
      mobile_btn_book: "Pesan Sekarang"
    }
  };

  // Language management
  let currentLang = localStorage.getItem('massaji_spa_lang') || 'en';

  function applyLanguage(lang) {
    currentLang = lang;
    localStorage.setItem('massaji_spa_lang', lang);

    document.querySelectorAll('.lang-btn').forEach(btn => {
      if (btn.dataset.lang === lang) {
        btn.classList.add('bg-[#344B3D]', 'text-white');
        btn.classList.remove('text-[#68685F]', 'hover:text-[#252820]');
      } else {
        btn.classList.remove('bg-[#344B3D]', 'text-white');
        btn.classList.add('text-[#68685F]', 'hover:text-[#252820]');
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
  // 3. MENU CATEGORY FILTERING (CONTEMPORARY LUXURY STYLING)
  // ========================================================
  const filterButtons = document.querySelectorAll('.menu-filter-btn');
  const menuCards = document.querySelectorAll('.treatment-card');

  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const category = btn.dataset.category;

      filterButtons.forEach(b => {
        b.classList.remove('active', 'bg-[#344B3D]', 'text-white', 'border-[#344B3D]');
        b.classList.add('bg-white', 'text-[#68685F]', 'border-[#E5DED3]');
      });

      btn.classList.add('active', 'bg-[#344B3D]', 'text-white', 'border-[#344B3D]');
      btn.classList.remove('bg-white', 'text-[#68685F]', 'border-[#E5DED3]');

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
  // 4. BOOKING MODAL
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
        for (let i = 0; i < serviceSelect.options.length; i++) {
          if (serviceSelect.options[i].text.toLowerCase().includes(serviceName.toLowerCase()) || 
              serviceName.toLowerCase().includes(serviceSelect.options[i].text.toLowerCase())) {
            serviceSelect.selectedIndex = i;
            matchFound = true;
            break;
          }
        }
        if (!matchFound) {
          serviceSelect.value = serviceName;
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
  // 5. BOOKING SUBMISSION & DIRECT WHATSAPP GENERATION
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
      let waText = `Hello *Massaji Spa Bali*,\n\nI would like to book an appointment:\n• *Guest:* ${name}\n• *Treatment:* ${service}\n• *Date:* ${date}\n• *Time:* ${time} WITA\n• *Party Size:* ${guests} guest(s)\n`;
      if (phone) waText += `• *Phone / WhatsApp:* ${phone}\n`;
      if (notes) waText += `• *Notes:* ${notes}\n`;
      waText += `\nPlease confirm if this schedule is available. Thank you!`;
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
          Thank you, <strong>${details.name}</strong>. Your appointment request for <strong>${details.service}</strong> on <strong>${details.date}</strong> at <strong>${details.time} WITA</strong> (${details.guests} guest) has been received.
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

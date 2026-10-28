// assets/js/main.js - Interactive client-side scripts with Bilingual (ID / EN) Toggle

document.addEventListener('DOMContentLoaded', () => {

  // ========================================================
  // 1. BILINGUAL DICTIONARY (INDONESIAN & ENGLISH)
  // ========================================================
  const i18n = {
    id: {
      nav_about: "Tentang Kami",
      nav_promo: "Paket Promo",
      nav_menu: "Menu & Harga",
      nav_reviews: "Ulasan (4.8★)",
      nav_contact: "Lokasi & Jam Buka",
      nav_book: "Reservasi Online",
      promo_badge: "Special Deal • Canggu Bali",
      promo_title: "One Day Promotion Packages",
      promo_desc: "Penawaran istimewa untuk ritual perawatan lengkap dan paket pasangan (couples) di Massaji Spa Bali.",
      hero_badge: "Top Rated Spa in Canggu • 4.8★ Google Reviews",
      hero_title_1: "Ketenteraman Sejati,",
      hero_title_2: "Sentuhan Jiwa Tradisi Bali.",
      hero_sub: "Pusat relaksasi mendalam di Canggu & Kerobokan dengan sentuhan terapis berpengalaman, minyak aromaterapi murni, dan tradisi penyembuhan Bali autentik.",
      hero_btn_book: "Reservasi Jadwal Pijat",
      hero_btn_promo: "Lihat Paket Promo",
      stat_reviews: "560+ Ulasan Tamu",
      stat_pure: "Boreh & Minyak Botani",
      stat_therapist: "Terapis Ahli & Ramah",
      stat_private: "AC Dingin, Tenang & Higienis",
      about_badge: "Tentang Massaji Spa",
      about_title_1: "Sentuhan Kehangatan Bali",
      about_title_2: "dengan Kedamaian Pikiran.",
      about_desc_1: "Berlokasi di kawasan Kerobokan / Canggu yang tenang, Massaji Spa menghadirkan pengalaman spa profesional dengan standar kebersihan tinggi dan harga yang jujur dan terjangkau.",
      about_desc_2: "Mulai dari tradisi rempah Boreh Bali yang menghangatkan persendian, Facial Pevonia yang menyegarkan wajah lelah, hingga pijat prenatal bersertifikat untuk ibu hamil—setiap terapis kami berdedikasi memberikan perawatan terbaik yang disesuaikan dengan kebutuhan Anda.",
      menu_badge: "Katalog Lengkap",
      menu_title: "Daftar Menu & Tarif Layanan",
      menu_desc: "Harga transparan dan terjangkau di kawasan Canggu & Kerobokan.",
      cat_all: "Semua Layanan",
      cat_packages: "Paket Spa (Packages)",
      cat_massage: "Pijat Tradisional & Tubuh",
      cat_beauty: "Facial & Scrub",
      cat_reflexology: "Reflexology",
      btn_book_card: "Pesan",
      card_rate: "Tarif",
      reviews_badge: "Ulasan Pengunjung",
      reviews_title: "Dipercaya Ribuan Pelancong di Bali",
      contact_badge: "Lokasi & Kontak",
      contact_title: "Kunjungi Massaji Spa",
      contact_desc: "Terletak di jalan utama Canggu / Kerobokan dengan parkir yang mudah dan akses cepat dari hotel & villa sekitar.",
      contact_address: "Alamat",
      contact_maps: "Buka di Google Maps →",
      contact_hours: "Jam Operasional",
      contact_chat: "Hubungi Langsung",
      modal_badge: "Reservasi Langsung",
      modal_title: "Pesan Jadwal Perawatan",
      modal_sub: "Rincian reservasi akan otomatis diteruskan ke email resepsionis dan WhatsApp.",
      modal_label_name: "Nama Lengkap Tamu *",
      modal_label_phone: "Nomor WhatsApp / HP *",
      modal_label_email: "Alamat Email",
      modal_label_service: "Pilihan Layanan / Paket *",
      modal_label_date: "Tanggal *",
      modal_label_time: "Jam *",
      modal_label_guests: "Pax",
      modal_label_notes: "Catatan Khusus (Opsional)",
      modal_submit: "Kirim Permintaan Reservasi",
      modal_success_title: "Reservasi Terkirim!",
      modal_btn_wa: "Konfirmasi Cepat via WhatsApp",
      modal_btn_close: "Tutup",
      mobile_btn_wa: "Chat WA",
      mobile_btn_book: "Pesan Sekarang"
    },
    en: {
      nav_about: "About Us",
      nav_promo: "Special Deals",
      nav_menu: "Menu & Pricing",
      nav_reviews: "Reviews (4.8★)",
      nav_contact: "Location & Hours",
      nav_book: "Book Online",
      promo_badge: "Special Deal • Canggu Bali",
      promo_title: "One Day Promotion Packages",
      promo_desc: "Exclusive rejuvenating rituals and couple packages at Massaji Spa Bali.",
      hero_badge: "Top Rated Spa in Canggu • 4.8★ Google Reviews",
      hero_title_1: "True Serenity,",
      hero_title_2: "The Sacred Touch of Balinese Soul.",
      hero_sub: "A peaceful sanctuary in Canggu & Kerobokan offering authentic Balinese healing rituals, certified therapists, pure aromatic botanicals, and fair pricing.",
      hero_btn_book: "Book Treatment",
      hero_btn_promo: "View Special Deals",
      stat_reviews: "560+ Verified Reviews",
      stat_pure: "Herbal Boreh & Pure Oils",
      stat_therapist: "Certified Therapists",
      stat_private: "Clean, Serene & AC Rooms",
      about_badge: "About Massaji Spa",
      about_title_1: "Authentic Balinese Touch",
      about_title_2: "with Absolute Peace of Mind.",
      about_desc_1: "Nestled in a peaceful pocket of Kerobokan and Canggu, Massaji Spa was created to deliver authentic Balinese healing traditions with five-star cleanliness at honest, affordable prices.",
      about_desc_2: "From warming traditional Balinese Boreh spice scrubs and Australian Pevonia botanical facials to certified prenatal therapy for mothers-to-be—our therapists tailor every pressure point to your body's needs.",
      menu_badge: "Complete Catalog",
      menu_title: "Treatment Menu & Pricing",
      menu_desc: "Transparent and budget-friendly pricing in the Canggu & Kerobokan area.",
      cat_all: "All Treatments",
      cat_packages: "Spa Packages",
      cat_massage: "Balinese & Bodywork",
      cat_beauty: "Facials & Body Scrub",
      cat_reflexology: "Reflexology",
      btn_book_card: "Book",
      card_rate: "Nett Price",
      reviews_badge: "Guest Testimonials",
      reviews_title: "Trusted by Travelers Across the Globe",
      contact_badge: "Location & Contact",
      contact_title: "Visit Massaji Spa",
      contact_desc: "Conveniently located along the main Canggu / Kerobokan route with easy scooter and car parking.",
      contact_address: "Address",
      contact_maps: "Open in Google Maps →",
      contact_hours: "Opening Hours",
      contact_chat: "Direct Contact",
      modal_badge: "Instant Reservation",
      modal_title: "Book Your Appointment",
      modal_sub: "Your booking details will be sent directly to our reception email and WhatsApp.",
      modal_label_name: "Full Guest Name *",
      modal_label_phone: "WhatsApp / Phone Number *",
      modal_label_email: "Email Address",
      modal_label_service: "Selected Treatment / Package *",
      modal_label_date: "Date *",
      modal_label_time: "Time *",
      modal_label_guests: "Guests",
      modal_label_notes: "Special Requests (Optional)",
      modal_submit: "Send Reservation Request",
      modal_success_title: "Reservation Received!",
      modal_btn_wa: "Confirm Instantly via WhatsApp",
      modal_btn_close: "Close",
      mobile_btn_wa: "Chat WA",
      mobile_btn_book: "Book Now"
    }
  };

  // Language state & switcher
  let currentLang = localStorage.getItem('massaji_lang') || 'en'; // default English for international tourists

  function applyLanguage(lang) {
    currentLang = lang;
    localStorage.setItem('massaji_lang', lang);

    // Update active state on toggle buttons
    document.querySelectorAll('.lang-btn').forEach(btn => {
      if (btn.dataset.lang === lang) {
        btn.classList.add('bg-brand-royal', 'text-white');
        btn.classList.remove('text-slate-600', 'hover:text-brand-royal');
      } else {
        btn.classList.remove('bg-brand-royal', 'text-white');
        btn.classList.add('text-slate-600', 'hover:text-brand-royal');
      }
    });

    // Translate all elements with data-i18n
    document.querySelectorAll('[data-i18n]').forEach(el => {
      const key = el.dataset.i18n;
      if (i18n[lang] && i18n[lang][key]) {
        el.textContent = i18n[lang][key];
      }
    });
  }

  // Bind language toggle buttons
  document.querySelectorAll('.lang-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      applyLanguage(btn.dataset.lang);
    });
  });

  // Apply initial language on page load
  applyLanguage(currentLang);

  // ========================================================
  // 2. MOBILE MENU TOGGLE
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
  // 3. MENU CATEGORY FILTERING
  // ========================================================
  const filterButtons = document.querySelectorAll('.menu-filter-btn');
  const menuCards = document.querySelectorAll('.treatment-card');

  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const category = btn.dataset.category;

      filterButtons.forEach(b => {
        b.classList.remove('active', 'bg-brand-royal', 'text-white', 'border-brand-royal');
        b.classList.add('bg-white', 'text-slate-700', 'border-slate-200');
      });

      btn.classList.add('active', 'bg-brand-royal', 'text-white', 'border-brand-royal');
      btn.classList.remove('bg-white', 'text-slate-700', 'border-slate-200');

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
  // 5. BOOKING SUBMISSION & WHATSAPP REDIRECTION
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
        ${currentLang === 'en' ? 'Processing...' : 'Memproses...'}
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
      let waText = `Hello *Massaji Spa Bali*,\n\nI would like to confirm my spa reservation:\n• *Name:* ${name}\n• *Treatment:* ${service}\n• *Date:* ${date}\n• *Time:* ${time} WITA\n• *Guests:* ${guests} pax\n`;
      if (phone) waText += `• *Contact:* ${phone}\n`;
      if (notes) waText += `• *Notes:* ${notes}\n`;
      waText += `\nCould you please confirm if this slot is available? Thank you.`;
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
          Thank you, <strong>${details.name}</strong>! Your reservation request for <strong>${details.service}</strong> on <strong>${details.date}</strong> at <strong>${details.time} WITA</strong> (${details.guests} guests) has been received.
        `;
      } else {
        bookingSummaryText.innerHTML = `
          Terima kasih, <strong>${details.name}</strong>! Reservasi Anda untuk layanan <strong>${details.service}</strong> pada tanggal <strong>${details.date}</strong> jam <strong>${details.time} WITA</strong> (${details.guests} tamu) telah kami catat.
        `;
      }
    }

    if (waConfirmLink) waConfirmLink.href = waUrl;
    bookingForm.reset();
  }

});

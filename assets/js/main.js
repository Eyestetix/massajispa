// assets/js/main.js - Interactive client-side scripts for Massaji Spa Bali (with GitHub Pages static fallback)

document.addEventListener('DOMContentLoaded', () => {

  // 1. Mobile Menu Toggle
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      const isHidden = mobileMenu.classList.contains('hidden');
      if (isHidden) {
        mobileMenu.classList.remove('hidden');
      } else {
        mobileMenu.classList.add('hidden');
      }
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
      });
    });
  }

  // 2. Menu Category Filtering
  const filterButtons = document.querySelectorAll('.menu-filter-btn');
  const menuCards = document.querySelectorAll('.treatment-card');

  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const category = btn.dataset.category;

      filterButtons.forEach(b => {
        b.classList.remove('active', 'bg-blue-900', 'text-white', 'border-blue-900');
        b.classList.add('bg-white', 'text-slate-700', 'border-slate-200');
      });

      btn.classList.add('active', 'bg-blue-900', 'text-white', 'border-blue-900');
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

  // 3. Booking Modal Handling
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

  if (modalCloseBtn) {
    modalCloseBtn.addEventListener('click', closeBookingModal);
  }

  if (bookingModal) {
    bookingModal.addEventListener('click', (e) => {
      if (e.target === bookingModal) {
        closeBookingModal();
      }
    });
  }

  // 4. Booking Submission (with graceful GitHub Pages static fallback)
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
        Memproses Reservasi...
      `;

      const formData = new FormData(bookingForm);
      const name = formData.get('name') || 'Tamu';
      const service = formData.get('service') || 'Massaji Spa Treatment';
      const date = formData.get('date') || '';
      const time = formData.get('time') || '';
      const guests = formData.get('guests') || '1';
      const phone = formData.get('phone') || '';
      const notes = formData.get('notes') || '';

      // Direct WhatsApp Generator Fallback (ensures GitHub Pages static hosting works 100%)
      const waNumber = '6281236695755';
      let waText = `Halo *Massaji Spa Bali*,\n\nSaya ingin mengonfirmasi reservasi via website:\n• *Nama:* ${name}\n• *Layanan:* ${service}\n• *Tanggal:* ${date}\n• *Jam:* ${time} WITA\n• *Jumlah Tamu:* ${guests} orang\n`;
      if (phone) waText += `• *Kontak:* ${phone}\n`;
      if (notes) waText += `• *Catatan:* ${notes}\n`;
      waText += `\nApakah slot waktu tersebut masih tersedia? Terima kasih.`;
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
          // If running on static host (GitHub Pages 404/405 for PHP), fallback gracefully
          showBookingSuccess({ name, service, date, time, guests }, fallbackWaUrl);
        }
      } catch (err) {
        // Fallback for static servers (e.g. GitHub Pages)
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
      bookingSummaryText.innerHTML = `
        <strong>${details.name}</strong>, reservasi Anda untuk layanan <strong>${details.service}</strong> pada tanggal <strong>${details.date}</strong> jam <strong>${details.time} WITA</strong> (${details.guests} tamu) telah diproses.
      `;
    }

    if (waConfirmLink) {
      waConfirmLink.href = waUrl;
    }

    bookingForm.reset();
  }

});

/**
 * Massaji Spa Bali - Lightweight Privacy-Friendly Visitor Tracker
 * Tracks traffic sources (Google, Instagram, Facebook, Direct, etc.) and device types.
 */
(function() {
  'use strict';
  try {
    // Only track once per page session or on new visits
    const sessionKey = 'massaji_trk_sess_v1';
    let isNewSession = false;
    if (!sessionStorage.getItem(sessionKey)) {
      sessionStorage.setItem(sessionKey, Date.now().toString());
      isNewSession = true;
    }

    // Capture referrer
    const referrer = document.referrer || '';

    // Capture UTM marketing query parameters if present
    const params = new URLSearchParams(window.location.search);
    const utmSource = params.get('utm_source') || '';
    const utmMedium = params.get('utm_medium') || '';
    const utmCampaign = params.get('utm_campaign') || '';

    const payload = {
      referrer: referrer,
      utm_source: utmSource,
      utm_medium: utmMedium,
      utm_campaign: utmCampaign,
      path: window.location.pathname + window.location.hash,
      is_new_session: isNewSession ? 1 : 0,
      screen_width: window.innerWidth || screen.width || 0
    };

    const targetUrl = (window.location.origin ? window.location.origin : '') + '/track.php';
    const jsonStr = JSON.stringify(payload);

    if (navigator.sendBeacon) {
      const blob = new Blob([jsonStr], { type: 'application/json' });
      navigator.sendBeacon(targetUrl, blob);
    } else {
      fetch(targetUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: jsonStr,
        keepalive: true
      }).catch(function() {});
    }
  } catch (e) {
    // Fail silently so visitor experience is 100% unaffected
  }
})();

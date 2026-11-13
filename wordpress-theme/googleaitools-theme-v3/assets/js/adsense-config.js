/**
 * ==========================================================================
 * GOOGLE AD SENSE CENTRAL CONFIGURATION & INJECTION ENGINE
 * Website: googleaitools.com
 * ==========================================================================
 * To activate live Google AdSense:
 * 1. Replace publisherId with your actual AdSense publisher ID (e.g. ca-pub-1234567890123456)
 * 2. Set enabled to true
 * 3. Set testMode to false
 * ==========================================================================
 */

const ADSENSE_CONFIG = {
  // Replace with your Google AdSense Publisher ID
  publisherId: 'ca-pub-0000000000000000',
  enabled: false,  // Hidden/disabled for the time being
  testMode: false, // Visual ad slot preview placeholders disabled
  
  // Specific Slot IDs (Optional - for unit ads)
  slots: {
    headerLeaderboard: '1000000001',
    sidebarAd: '1000000002',
    inlineArticleAd: '1000000003',
    footerBanner: '1000000004'
  }
};

// Initialize AdSense Script Tag dynamically
(function initAdSense() {
  // Always ensure ad containers are handled when DOM is ready
  document.addEventListener('DOMContentLoaded', () => {
    populateAdSlots();
  });

  if (!ADSENSE_CONFIG.enabled) return;
  
  if (!ADSENSE_CONFIG.testMode && ADSENSE_CONFIG.publisherId !== 'ca-pub-0000000000000000') {
    const script = document.createElement('script');
    script.async = true;
    script.src = `https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=${ADSENSE_CONFIG.publisherId}`;
    script.crossOrigin = 'anonymous';
    document.head.appendChild(script);
  }
})();

/**
 * Fills all .ad-container elements with AdSense ads or hides them completely
 */
function populateAdSlots() {
  const adContainers = document.querySelectorAll('.ad-container, .ad-slot');
  
  // If ads are disabled or test previews are off with placeholder pub ID, collapse all slots
  if (!ADSENSE_CONFIG.enabled || (!ADSENSE_CONFIG.testMode && ADSENSE_CONFIG.publisherId === 'ca-pub-0000000000000000')) {
    adContainers.forEach((container) => {
      container.style.display = 'none';
      container.innerHTML = '';
    });
    return;
  }

  adContainers.forEach((container) => {
    const slotType = container.getAttribute('data-ad-slot') || 'inlineArticleAd';
    const slotId = ADSENSE_CONFIG.slots[slotType] || '1000000000';
    
    if (ADSENSE_CONFIG.testMode) {
      container.innerHTML = `
        <div class="ad-label">ADVERTISEMENT - ADSENSE READY</div>
        <div style="color: var(--text-muted); font-size: 0.85rem; padding: 12px; font-weight: 500;">
          Google AdSense Slot [${slotType}]<br>
          <span style="font-size: 0.75rem; font-family: var(--font-mono);">ID: ${ADSENSE_CONFIG.publisherId} | Slot: ${slotId}</span>
        </div>
      `;
    } else {
      container.innerHTML = `
        <div class="ad-label">ADVERTISEMENT</div>
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="${ADSENSE_CONFIG.publisherId}"
             data-ad-slot="${slotId}"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
      `;
      try {
        (adsbygoogle = window.adsbygoogle || []).push({});
      } catch (e) {
        console.error('AdSense push error:', e);
      }
    }
  });
}

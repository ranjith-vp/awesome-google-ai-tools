/**
 * ==========================================================================
 * CENTRAL SEO & GOOGLE ANALYTICS CONFIGURATION - googleaitools.com
 * ==========================================================================
 * Update these settings visually via your CMS Admin Panel: /admin
 * ==========================================================================
 */

const SITE_SEO_CONFIG = {
  googleSiteVerification: '',
  bingSiteVerification: '',
  googleAnalyticsId: 'G-0000000000',
  autoInjectAnalytics: true
};

// Inject Meta Tags and Google Analytics Site-Wide automatically
(function() {
  document.addEventListener('DOMContentLoaded', () => {
    // 1. Google Site Verification Meta Tag
    if (SITE_SEO_CONFIG.googleSiteVerification) {
      let meta = document.createElement('meta');
      meta.name = 'google-site-verification';
      meta.content = SITE_SEO_CONFIG.googleSiteVerification;
      document.head.appendChild(meta);
    }

    // 2. Bing / Yahoo Webmaster Verification Meta Tag
    if (SITE_SEO_CONFIG.bingSiteVerification) {
      let meta = document.createElement('meta');
      meta.name = 'msvalidate.01';
      meta.content = SITE_SEO_CONFIG.bingSiteVerification;
      document.head.appendChild(meta);
    }

    // 3. Google Analytics (gtag.js) Script Injection
    if (SITE_SEO_CONFIG.googleAnalyticsId && SITE_SEO_CONFIG.googleAnalyticsId !== 'G-0000000000') {
      let script = document.createElement('script');
      script.async = true;
      script.src = `https://www.googletagmanager.com/gtag/js?id=${SITE_SEO_CONFIG.googleAnalyticsId}`;
      document.head.appendChild(script);

      let inlineScript = document.createElement('script');
      inlineScript.innerHTML = `
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '${SITE_SEO_CONFIG.googleAnalyticsId}');
      `;
      document.head.appendChild(inlineScript);
    }
  });
})();

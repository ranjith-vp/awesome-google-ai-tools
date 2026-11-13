/**
 * ==========================================================================
 * CENTRAL COMPONENT INJECTION ENGINE - googleaitools.com
 * ==========================================================================
 * Standardized single-source-of-truth components for:
 * - Navigation Header (Google AI Products Style)
 * - Site Footer (Google AI Style with AdSense compliance links)
 * - Sticky Article Sidebar Table of Contents (UiPath Blog Style)
 * - Social Share Toolbar
 * - Product Cards & Related Articles
 * ==========================================================================
 */

// Helper to determine root relative path depth (for inner pages vs root pages)
function getBasePath() {
  const path = window.location.pathname;
  if (path.includes('/posts/') || path.includes('\\posts\\')) {
    return '../';
  }
  return '';
}

/**
 * Render Centralized Header Navigation Bar
 */
function renderHeader() {
  const headerContainer = document.getElementById('site-header-container');
  if (!headerContainer) return;

  const base = getBasePath();

  headerContainer.innerHTML = `
    <header class="site-header">
      <div class="nav-container">
        <a href="${base}index.html" class="brand-logo">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#1A73E8"/>
          </svg>
          Google AI Tools
          <span class="brand-badge">2026 Edition</span>
        </a>

        <ul class="nav-links">
          <li><a href="${base}index.html" class="nav-link ${window.location.pathname.endsWith('index.html') || window.location.pathname.endsWith('/') ? 'active' : ''}">Products & Tools</a></li>
          <li>
            <a href="${base}categories.html" class="nav-link ${window.location.pathname.includes('categories.html') ? 'active' : ''}">
              Categories ▾
            </a>
          </li>
          <li><a href="${base}about.html" class="nav-link ${window.location.pathname.includes('about.html') ? 'active' : ''}">About Us</a></li>
          <li><a href="${base}sitemap.html" class="nav-link ${window.location.pathname.includes('sitemap.html') ? 'active' : ''}">Sitemap</a></li>
        </ul>

        <div class="nav-right">
          <button class="search-trigger" id="search-trigger-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <span>Search AI Tools...</span>
          </button>

          <button class="theme-toggle-btn" id="theme-toggle-btn" title="Toggle Dark/Light Mode">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
          </button>
        </div>
      </div>
    </header>
  `;
}

/**
 * Render Centralized Footer
 */
function renderFooter() {
  const footerContainer = document.getElementById('site-footer-container');
  if (!footerContainer) return;

  const base = getBasePath();
  const currentYear = new Date().getFullYear();

  footerContainer.innerHTML = `
    <footer class="site-footer">
      <div class="footer-container">
        <div class="footer-grid">
          <div class="footer-brand">
            <a href="${base}index.html" class="brand-logo">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#1A73E8"/>
              </svg>
              Google AI Tools
            </a>
            <p>Your premier independent guide and review publication for Google AI models, developer APIs, research tools, and generative workspace technologies.</p>
          </div>

          <div>
            <h4 class="footer-col-title">Google AI Ecosystem</h4>
            <ul class="footer-links">
              <li><a href="${base}posts/getting-started-with-gemini-1-5-pro.html" class="footer-link">Gemini 1.5 Pro Guide</a></li>
              <li><a href="${base}posts/notebooklm-ai-research-guide.html" class="footer-link">NotebookLM Overview</a></li>
              <li><a href="${base}posts/imagen-3-prompt-engineering-tips.html" class="footer-link">Imagen 3 Masterclass</a></li>
              <li><a href="${base}posts/google-veo-video-generation-tutorial.html" class="footer-link">Google Veo Video AI</a></li>
              <li><a href="${base}posts/gemma-open-source-ai-models-guide.html" class="footer-link">Gemma 2 Open Models</a></li>
            </ul>
          </div>

          <div>
            <h4 class="footer-col-title">Categories</h4>
            <ul class="footer-links">
              <li><a href="${base}categories.html?c=multimodal" class="footer-link">Multimodal AI</a></li>
              <li><a href="${base}categories.html?c=research" class="footer-link">Research & Productivity</a></li>
              <li><a href="${base}categories.html?c=image-video" class="footer-link">Image & Video AI</a></li>
              <li><a href="${base}categories.html?c=open-source" class="footer-link">Open Source Models</a></li>
              <li><a href="${base}categories.html?c=developer" class="footer-link">Developer & APIs</a></li>
            </ul>
          </div>

          <div>
            <h4 class="footer-col-title">Legal & AdSense Compliance</h4>
            <ul class="footer-links">
              <li><a href="${base}privacy-policy.html" class="footer-link">Privacy Policy</a></li>
              <li><a href="${base}terms.html" class="footer-link">Terms of Service</a></li>
              <li><a href="${base}disclaimer.html" class="footer-link">AI & Earnings Disclaimer</a></li>
              <li><a href="${base}about.html" class="footer-link">About Us</a></li>
              <li><a href="${base}contact.html" class="footer-link">Contact Us</a></li>
              <li><a href="${base}sitemap.html" class="footer-link">HTML Sitemap</a></li>
            </ul>
          </div>
        </div>

        <div class="footer-bottom">
          <div>© ${currentYear} googleaitools.com — All rights reserved. Independent news & tutorial portal.</div>
          <div class="footer-legal-links">
            <a href="${base}about.html">About</a>
            <a href="${base}contact.html">Contact</a>
            <a href="${base}privacy-policy.html">Privacy Policy</a>
            <a href="${base}terms.html">Terms of Use</a>
            <a href="${base}disclaimer.html">Disclaimer</a>
          </div>
        </div>
      </div>
    </footer>
  `;
}

/**
 * Renders UiPath-Style Sticky Sidebar Table of Contents
 */
function renderSidebarTOC() {
  const tocContainer = document.getElementById('sidebar-toc');
  const articleContent = document.querySelector('.article-content');
  if (!tocContainer || !articleContent) return;

  const headings = articleContent.querySelectorAll('h2, h3');
  if (headings.length === 0) {
    tocContainer.style.display = 'none';
    return;
  }

  let html = `
    <div class="toc-container">
      <div class="toc-title">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="8" y1="6" x2="21" y2="6"></line>
          <line x1="8" y1="12" x2="21" y2="12"></line>
          <line x1="8" y1="18" x2="21" y2="18"></line>
          <line x1="3" y1="6" x2="3.01" y2="6"></line>
          <line x1="3" y1="12" x2="3.01" y2="12"></line>
          <line x1="3" y1="18" x2="3.01" y2="18"></line>
        </svg>
        Table of Contents
      </div>
      <ul class="toc-list">
  `;

  headings.forEach((heading, idx) => {
    if (!heading.id) {
      heading.id = `heading-${idx + 1}`;
    }
    const isH3 = heading.tagName.toLowerCase() === 'h3';
    html += `
      <li class="toc-item ${isH3 ? 'nested' : ''}">
        <a href="#${heading.id}" class="toc-link" data-heading-id="${heading.id}">${heading.innerText}</a>
      </li>
    `;
  });

  html += `</ul></div>`;
  tocContainer.innerHTML = html;
}

/**
 * Render Floating Social Share Toolbar
 */
function renderSocialShare() {
  const shareContainer = document.getElementById('social-share-container');
  if (!shareContainer) return;

  const currentUrl = encodeURIComponent(window.location.href);
  const title = encodeURIComponent(document.title);

  shareContainer.innerHTML = `
    <div class="share-bar">
      <span class="share-label">Share Article</span>
      <div class="share-buttons">
        <a href="https://twitter.com/intent/tweet?text=${title}&url=${currentUrl}" target="_blank" rel="noopener" class="share-btn" title="Share on Twitter / X">𝕏</a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url=${currentUrl}" target="_blank" rel="noopener" class="share-btn" title="Share on LinkedIn">in</a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=${currentUrl}" target="_blank" rel="noopener" class="share-btn" title="Share on Facebook">f</a>
        <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied to clipboard!');" class="share-btn" title="Copy Link">🔗</button>
      </div>
    </div>
  `;
}

/**
 * Renders Product Card HTML string for Google AI Grid layout
 */
function createProductCardHTML(post, index = 0) {
  const base = getBasePath();
  const gradients = [
    'linear-gradient(135deg, #f2d5dc 0%, #463d47 100%)',
    'linear-gradient(135deg, #dbe4ea 0%, #343c46 100%)',
    'linear-gradient(135deg, #d1e8e8 0%, #2d4246 100%)',
    'linear-gradient(135deg, #e4d8f0 0%, #3d364f 100%)',
    'linear-gradient(135deg, #fde4ce 0%, #4a3a32 100%)',
    'linear-gradient(135deg, #d3e2fc 0%, #29384e 100%)'
  ];
  const bgGrad = gradients[index % gradients.length];
  const iconHtml = post.icon 
    ? `<span class="emoji-icon">${post.icon}</span>` 
    : `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><polyline points="9 12 11 14 15 10"></polyline></svg>`;

  return `
    <article class="product-card" data-category="${post.category}">
      <!-- Top Boxed Gradient Banner (Replaces Featured Image) -->
      <div class="card-banner-header" style="background: ${bgGrad};">
        <div class="card-banner-icon">
          ${iconHtml}
        </div>
        <span class="card-banner-badge">${post.categoryName || 'AI Guide'}</span>
      </div>

      <!-- Card Body Content -->
      <div class="card-body-content">
        <div class="card-meta-row">
          <span class="meta-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            ${post.categoryName || 'AI Guide'}
          </span>
          <span class="meta-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            ${post.readTime || '6 min read'}
          </span>
        </div>

        <h3 class="card-title">
          <a href="${base}${post.url}">${post.title}</a>
        </h3>

        <p class="card-excerpt">${post.excerpt}</p>

        <div class="card-footer">
          <a href="${base}${post.url}" class="card-cta-link">
            Read Full Article <span class="cta-arrow">&rarr;</span>
          </a>
        </div>
      </div>
    </article>
  `;
}

// Auto-run components on DOM Load
document.addEventListener('DOMContentLoaded', () => {
  renderHeader();
  renderFooter();
  renderSidebarTOC();
  renderSocialShare();
});

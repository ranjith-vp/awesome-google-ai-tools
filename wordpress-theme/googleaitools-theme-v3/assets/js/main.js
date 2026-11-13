/**
 * ==========================================================================
 * MAIN INTERACTIVITY SCRIPT - googleaitools.com
 * ==========================================================================
 * Manages:
 * - Live Search Modal & real-time query filtering
 * - Category filter tabs on Homepage & Category pages
 * - Dark Mode state & persistence
 * - Table of Contents scroll observer (highlights active heading in TOC)
 * ==========================================================================
 */

document.addEventListener('DOMContentLoaded', () => {
  initDarkMode();
  initMobileMenu();
  initSearchModal();
  initTocObserver();
  initCategoryFilters();
});

/**
 * Mobile Navigation Drawer Toggle
 */
function initMobileMenu() {
  const menuToggle = document.getElementById('mobile-menu-toggle');
  const navLinks = document.querySelector('.nav-links');

  if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      navLinks.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
      if (!navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
        navLinks.classList.remove('active');
      }
    });
  }
}

/**
 * Dark Mode Management
 * Schedule: 7:00 AM - 10:00 PM is White (Day) / 10:00 PM - 7:00 AM is Dark (Night)
 * Supports manual toggle via button at all times
 */
function getAutoTheme() {
  const hour = new Date().getHours();
  // 10 PM (22:00) to 7 AM (06:59) is Night -> Dark; Daytime -> Light (White)
  return (hour >= 22 || hour < 7) ? 'dark' : 'light';
}

function initDarkMode() {
  const themeBtn = document.getElementById('theme-toggle-btn');
  const currentTheme = document.documentElement.getAttribute('data-theme') || (typeof getScheduledTheme === 'function' ? getScheduledTheme() : getAutoTheme());

  if (typeof updateThemeToggleIcon === 'function') {
    updateThemeToggleIcon(currentTheme);
  }

  if (themeBtn && !themeBtn.getAttribute('onclick')) {
    themeBtn.addEventListener('click', function(e) {
      if (typeof window.toggleDarkMode === 'function') {
        window.toggleDarkMode();
      }
    });
  }

  // Background timer: periodically check if schedule crossed boundary (10 PM or 7 AM)
  setInterval(function() {
    const hour = new Date().getHours();
    const currentPeriod = (hour >= 22 || hour < 7) ? 'night' : 'day';
    const manualPeriod = localStorage.getItem('manual_theme_period');
    
    // Auto-transition only if user hasn't explicitly set a manual preference in this same period
    if (!manualPeriod || manualPeriod !== currentPeriod) {
      const scheduledTheme = (currentPeriod === 'night') ? 'dark' : 'light';
      if (scheduledTheme !== document.documentElement.getAttribute('data-theme')) {
        document.documentElement.setAttribute('data-theme', scheduledTheme);
        if (typeof updateThemeToggleIcon === 'function') {
          updateThemeToggleIcon(scheduledTheme);
        }
      }
    }
  }, 60000);
}

/**
 * Modern Unified AI Search Modal
 * Searches across:
 * 1. AI Models & LLMs (Gemini 4, Gemini 2.5 Pro, Claude 3.7, GPT-4o, etc.)
 * 2. AI Tools & Startups (292+ Global Directory Products)
 * 3. In-Depth Guides & Blog Articles
 * 4. Grounded AI Semantic Intent Reasoning & Instant Answer Box
 */
function initSearchModal() {
  let activeTab = 'all';

  // Create search modal HTML dynamically if not present
  if (!document.getElementById('search-modal')) {
    const modalHTML = `
      <div class="search-modal" id="search-modal">
        <div class="search-modal-content">
          <div class="search-input-wrapper" style="padding:16px 22px; display:flex; align-items:center; gap:12px; background:transparent;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-google-blue); flex-shrink:0;">
              <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/>
            </svg>
            <input type="text" class="search-input" id="search-input-field" placeholder="Search AI tools, models, LLMs, guides (e.g. &quot;gemini 4&quot;, &quot;video&quot;)..." autofocus autocomplete="off" style="width:100%; border:none; outline:none; background:transparent; box-shadow:none; padding:0; margin:0; font-size:1.05rem;">
            <button style="background:none; border:none; cursor:pointer; font-size:1.25rem; color:var(--text-secondary); padding:4px 8px; flex-shrink:0;" id="close-search-btn" aria-label="Close search">✕</button>
          </div>

          <div class="search-modal-tabs" id="search-modal-tabs">
            <button type="button" class="search-modal-tab active" data-tab="all">✨ All (<span id="count-all">0</span>)</button>
            <button type="button" class="search-modal-tab" data-tab="model">⚡ Models &amp; LLMs (<span id="count-model">0</span>)</button>
            <button type="button" class="search-modal-tab" data-tab="tool">🛠️ AI Tools (<span id="count-tool">0</span>)</button>
            <button type="button" class="search-modal-tab" data-tab="post">📰 Guides (<span id="count-post">0</span>)</button>
          </div>

          <div class="search-results-list" id="search-results-container">
            <div style="padding:28px 20px; text-align:center; color:var(--text-muted); font-size:0.95rem;">
              Search across 380+ AI models, enterprise tools, and in-depth Google AI guides...
            </div>
          </div>
        </div>
      </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modalHTML);
  }

  const modal = document.getElementById('search-modal');
  const searchField = document.getElementById('search-input-field');
  const resultsContainer = document.getElementById('search-results-container');
  const closeBtn = document.getElementById('close-search-btn');
  const tabButtons = document.querySelectorAll('.search-modal-tab');
  const headerInput = document.getElementById('header-search-input');

  // Semantic Knowledge Intent Map
  const INTENT_KNOWLEDGE = [
    {
      keywords: ['gemini', 'gemini 4', 'gemini 4 hydrogen', 'hydrogen', 'project hydrogen', 'deepmind', 'google gemini'],
      title: 'Google DeepMind Frontier Intelligence',
      answer: '<strong>Gemini 4 Hydrogen</strong> (Project Hydrogen) is Google DeepMind newly announced 4th-generation flagship AI system delivering an unprecedented 10M token context window, dynamic test-time recursive reasoning, and autonomous multi-agent execution. Also explore <strong>Gemini 2.5 Pro</strong>, <strong>Gemini CLI</strong>, and enterprise implementation guides below.'
    },
    {
      keywords: ['video', 'sora', 'veo', 'movie', 'animation', 'generate video'],
      title: 'Generative Video Foundation Models',
      answer: 'Top recommendations for video synthesis: <strong>Google Veo</strong> (flagship 1080p/4K cinematic video with temporal consistency), <strong>OpenAI Sora</strong>, <strong>Runway Gen-3</strong>, and <strong>Luma Dream Machine</strong>.'
    },
    {
      keywords: ['code', 'coding', 'copilot', 'devin', 'cursor', 'windsurf', 'programming'],
      title: 'Autonomous Software Engineering & Coding AI',
      answer: 'Leading software development solutions: <strong>Claude 3.7 Sonnet</strong> (hybrid reasoning & SWE-bench leader), <strong>Gemini Code Assist</strong>, <strong>Cursor</strong>, <strong>Devin</strong>, and <strong>Google Jules</strong>.'
    },
    {
      keywords: ['voice', 'audio', 'speech', 'tts', 'elevenlabs', 'clone voice'],
      title: 'Speech Synthesis & Real-Time Voice Intelligence',
      answer: 'Premier voice and acoustic engines: <strong>ElevenLabs</strong> (multilingual speech synthesis), <strong>Gemini 3.1 Flash TTS</strong>, <strong>Whisper</strong>, and <strong>Suno / Udio</strong> for musical generation.'
    },
    {
      keywords: ['reasoning', 'thinking', 'o3', 'o1', 'deepseek', 'math', 'stem'],
      title: 'Deep Chain-of-Thought & Extended Reasoning Models',
      answer: 'Frontier reasoning architectures: <strong>DeepSeek-R1</strong>, <strong>OpenAI o3-mini</strong>, <strong>Gemini 2.5 Flash Thinking</strong>, and <strong>Claude 3.7 Sonnet</strong> engineered for complex STEM theorems.'
    },
    {
      keywords: ['image', 'imagen', 'flux', 'midjourney', 'photo', 'drawing'],
      title: 'Photorealistic Diffusion & Image Generation',
      answer: 'State-of-the-art visual diffusion tools: <strong>Google Imagen 3</strong> (via ImageFX), <strong>Black Forest Labs FLUX.1</strong>, and <strong>Midjourney v6.1</strong>.'
    },
    {
      keywords: ['india', 'indic', 'sarvam', 'krutrim', 'hindi', 'bilingual'],
      title: 'Sovereign Indic AI & Startups from India',
      answer: 'Frontier Indian AI innovations: <strong>Sarvam AI</strong> (voice & language foundation models for regional dialects), <strong>Krutrim</strong>, <strong>Yellow.ai</strong>, and <strong>CoRover</strong>.'
    }
  ];

  function openModalWithQuery(initialQuery = '') {
    if (modal) {
      modal.classList.add('active');
      modal.style.display = 'flex';
      if (searchField) {
        if (initialQuery) searchField.value = initialQuery;
        setTimeout(() => searchField.focus(), 50);
        executeSearch();
      }
    }
  }

  function closeModal() {
    if (modal) {
      modal.classList.remove('active');
      modal.style.display = 'none';
    }
  }

  // Prevent default form navigation and trigger modal
  const searchForms = document.querySelectorAll('.search-form-header, form[role="search"]');
  searchForms.forEach(form => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      openModalWithQuery(headerInput ? headerInput.value : '');
    });
  });

  // Open Search Triggers
  if (headerInput) {
    headerInput.addEventListener('click', (e) => {
      e.preventDefault();
      openModalWithQuery(headerInput.value);
    });
    headerInput.addEventListener('focus', () => openModalWithQuery(headerInput.value));
    headerInput.addEventListener('input', () => openModalWithQuery(headerInput.value));
  }

  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('#search-trigger-btn, #search-trigger-wrapper, .search-trigger');
    if (trigger) {
      e.preventDefault();
      openModalWithQuery(headerInput ? headerInput.value : '');
    }
  });

  // Close Search Triggers
  if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
      e.preventDefault();
      closeModal();
    });
  }

  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });
  }

  // Keyboard shortcut Ctrl/Cmd + K & Esc
  document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
      e.preventDefault();
      openModalWithQuery();
    }
    if (e.key === 'Escape' && modal && (modal.classList.contains('active') || modal.style.display === 'flex')) {
      closeModal();
    }
  });

  // Tab Filtering
  tabButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      tabButtons.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      activeTab = this.getAttribute('data-tab') || 'all';
      executeSearch();
    });
  });

  // Central Unified Search Executor
  function executeSearch() {
    if (!searchField || !resultsContainer) return;
    const query = searchField.value.toLowerCase().trim();

    if (!query) {
      const cAll = document.getElementById('count-all');
      const cModel = document.getElementById('count-model');
      const cTool = document.getElementById('count-tool');
      const cPost = document.getElementById('count-post');
      if (cAll) cAll.textContent = '0';
      if (cModel) cModel.textContent = '0';
      if (cTool) cTool.textContent = '0';
      if (cPost) cPost.textContent = '0';
      resultsContainer.innerHTML = `
        <div style="padding:28px 20px; text-align:center; color:var(--text-muted); font-size:0.95rem;">
          Type to search across 380+ AI models, enterprise tools, and in-depth Google AI guides...
        </div>
      `;
      return;
    }

    const posts = typeof POSTS_DATA !== 'undefined' ? POSTS_DATA : [];
    const models = typeof MODELS_DATA !== 'undefined' ? MODELS_DATA : [];
    const products = typeof PRODUCTS_DATA !== 'undefined' ? PRODUCTS_DATA : [];

    // Filter Posts
    const matchedPosts = posts.filter(post => 
      (post.title && post.title.toLowerCase().includes(query)) ||
      (post.excerpt && post.excerpt.toLowerCase().includes(query)) ||
      (post.categoryName && post.categoryName.toLowerCase().includes(query))
    );

    // Filter Models
    const matchedModels = models.filter(m => 
      (m.name && m.name.toLowerCase().includes(query)) ||
      (m.provider && m.provider.toLowerCase().includes(query)) ||
      (m.slug && m.slug.toLowerCase().includes(query)) ||
      (m.category && m.category.toLowerCase().includes(query)) ||
      (m.categoryName && m.categoryName.toLowerCase().includes(query)) ||
      (m.tagline && m.tagline.toLowerCase().includes(query)) ||
      (m.summary && m.summary.toLowerCase().includes(query)) ||
      (m.contextWindow && m.contextWindow.toLowerCase().includes(query))
    );

    // Filter Products / Tools
    const matchedTools = products.filter(t => 
      (t.name && t.name.toLowerCase().includes(query)) ||
      (t.category && t.category.toLowerCase().includes(query)) ||
      (t.formFactor && t.formFactor.toLowerCase().includes(query)) ||
      (t.summary && t.summary.toLowerCase().includes(query)) ||
      (t.domain && t.domain.toLowerCase().includes(query))
    );

    const totalCount = matchedPosts.length + matchedModels.length + matchedTools.length;
    const cAll = document.getElementById('count-all');
    const cModel = document.getElementById('count-model');
    const cTool = document.getElementById('count-tool');
    const cPost = document.getElementById('count-post');
    if (cAll) cAll.textContent = totalCount;
    if (cModel) cModel.textContent = matchedModels.length;
    if (cTool) cTool.textContent = matchedTools.length;
    if (cPost) cPost.textContent = matchedPosts.length;

    // Check Semantic Intent Match
    let matchedIntent = null;
    for (const intent of INTENT_KNOWLEDGE) {
      if (intent.keywords.some(kw => query.includes(kw) || kw.includes(query))) {
        matchedIntent = intent;
        break;
      }
    }

    let html = '';

    // Render AI Intent Answer Box if matched
    if (matchedIntent && (activeTab === 'all' || activeTab === 'model')) {
      html += `
        <div class="search-ai-answer-card">
          <div class="search-ai-answer-header">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
            <span>AI Semantic Answer • ${matchedIntent.title}</span>
          </div>
          <div class="search-ai-answer-body">
            ${matchedIntent.answer}
          </div>
        </div>
      `;
    }

    if (totalCount === 0) {
      resultsContainer.innerHTML = html + `
        <div style="padding:32px 20px; text-align:center; color:var(--text-muted);">
          No AI tools, models, or guides found matching "<strong>${query}</strong>". Try searching for <em>Gemini 4</em>, <em>video</em>, <em>code</em>, or <em>voice</em>.
        </div>
      `;
      return;
    }

    // Render Models
    if (activeTab === 'all' || activeTab === 'model') {
      matchedModels.forEach(m => {
        html += `
          <a href="${m.url}" class="search-result-item">
            <div class="search-result-header-row">
              <span class="search-badge-type search-badge-model">⚡ Frontier Model</span>
              <span class="search-result-meta-text">${m.provider} • ${m.contextWindow || 'Multimodal'} • ${m.throughput || ''}</span>
            </div>
            <div class="search-result-title">
              <span>${m.name}</span>
            </div>
            <div class="search-result-snippet">${m.tagline || m.summary}</div>
          </a>
        `;
      });
    }

    // Render Tools
    if (activeTab === 'all' || activeTab === 'tool') {
      matchedTools.forEach(t => {
        html += `
          <a href="${t.url}" class="search-result-item">
            <div class="search-result-header-row">
              <span class="search-badge-type search-badge-tool">🛠️ AI Product</span>
              <span class="search-result-meta-text">${t.formFactor || 'Tool'} • ${t.domain || ''}</span>
            </div>
            <div class="search-result-title">
              <span>${t.name}</span>
            </div>
            <div class="search-result-snippet">${t.summary}</div>
          </a>
        `;
      });
    }

    // Render Posts
    if (activeTab === 'all' || activeTab === 'post') {
      matchedPosts.forEach(p => {
        html += `
          <a href="${p.url}" class="search-result-item">
            <div class="search-result-header-row">
              <span class="search-badge-type search-badge-post">📰 In-Depth Guide</span>
              <span class="search-result-meta-text">${p.categoryName}</span>
            </div>
            <div class="search-result-title">
              <span>${p.icon || '🤖'} ${p.title}</span>
            </div>
            <div class="search-result-snippet">${p.excerpt}</div>
          </a>
        `;
      });
    }

    resultsContainer.innerHTML = html;
  }

  // Real-time Search Input Listener
  if (searchField) {
    searchField.addEventListener('input', executeSearch);
  }
}

/**
 * Highlights active heading in Table of Contents as user scrolls
 */
function initTocObserver() {
  const headings = document.querySelectorAll('.article-content h2, .article-content h3');
  const tocLinks = document.querySelectorAll('.toc-link');
  if (headings.length === 0 || tocLinks.length === 0) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute('id');
        tocLinks.forEach(link => {
          if (link.getAttribute('data-heading-id') === id) {
            link.classList.add('active');
            link.parentElement.classList.add('active');
          } else {
            link.classList.remove('active');
            link.parentElement.classList.remove('active');
          }
        });
      }
    });
  }, { rootMargin: '-80px 0px -60% 0px' });

  headings.forEach(heading => observer.observe(heading));
}

/**
 * Category Filter Buttons
 */
function initCategoryFilters() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const productCards = document.querySelectorAll('.product-card');
  if (filterBtns.length === 0) return;

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const cat = btn.getAttribute('data-category');

      productCards.forEach(card => {
        if (cat === 'all' || card.getAttribute('data-category') === cat) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
}

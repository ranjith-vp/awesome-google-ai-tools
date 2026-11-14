<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
    // -------------------------------------------------------------------------
    // TIME-AWARE THEME ENGINE (System Schedule: 7am-10pm White / 10pm-7am Dark)
    // Supports instant manual toggle with persistent user choice
    // -------------------------------------------------------------------------
    function getScheduledTheme() {
      var hour = new Date().getHours();
      // 10 PM (22:00) to 7 AM (06:59) is Night -> Dark Mode
      // 7 AM (07:00) to 10 PM (21:59) is Day -> Light Mode (White)
      return (hour >= 22 || hour < 7) ? 'dark' : 'light';
    }

    (function() {
      try {
        var hour = new Date().getHours();
        var currentPeriod = (hour >= 22 || hour < 7) ? 'night' : 'day';
        var scheduled = (currentPeriod === 'night') ? 'dark' : 'light';

        var manualChoice = localStorage.getItem('manual_theme_choice');
        var manualPeriod = localStorage.getItem('manual_theme_period');
        var manualTime = parseInt(localStorage.getItem('manual_theme_time') || '0', 10);

        // Clear legacy override key
        if (localStorage.getItem('user_theme_override')) {
          localStorage.removeItem('user_theme_override');
        }

        // Active manual override applies within the same day/night period and within 12 hours
        var theme = scheduled;
        if (manualChoice && manualPeriod === currentPeriod && (Date.now() - manualTime < 12 * 3600 * 1000)) {
          theme = manualChoice;
        } else {
          // New period started or no override: follow system schedule
          localStorage.removeItem('manual_theme_choice');
          localStorage.removeItem('manual_theme_period');
          localStorage.setItem('theme', scheduled);
        }

        document.documentElement.setAttribute('data-theme', theme);
      } catch(e) {}
    })();

    var isToggling = false;
    function toggleDarkMode() {
      if (isToggling) return;
      isToggling = true;
      try {
        var hour = new Date().getHours();
        var currentPeriod = (hour >= 22 || hour < 7) ? 'night' : 'day';
        var current = document.documentElement.getAttribute('data-theme') || getScheduledTheme();
        var next = (current === 'dark') ? 'light' : 'dark';

        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('manual_theme_choice', next);
        localStorage.setItem('manual_theme_period', currentPeriod);
        localStorage.setItem('manual_theme_time', Date.now().toString());
        localStorage.setItem('theme', next);

        updateThemeToggleIcon(next);
      } catch(e) { console.error('Toggle error:', e); }
      setTimeout(function() { isToggling = false; }, 250);
    }

    function updateThemeToggleIcon(theme) {
      var btn = document.getElementById('theme-toggle-btn');
      var iconContainer = document.getElementById('theme-toggle-icon');
      if (!btn || !iconContainer) return;

      var moonSvg = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="moonGrad" x1="3" y1="3" x2="21" y2="21" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#7B2CBF"/><stop offset="50%" stop-color="#3A0CA3"/><stop offset="100%" stop-color="#F72585"/></linearGradient><linearGradient id="starGrad" x1="0" y1="0" x2="10" y2="10" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#FFD166"/><stop offset="100%" stop-color="#F72585"/></linearGradient></defs><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" fill="url(#moonGrad)" stroke="#FFD166" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><polygon points="18,2 18.8,3.5 20.5,4 18.8,4.5 18,6 17.2,4.5 15.5,4 17.2,3.5" fill="url(#starGrad)"/><polygon points="9,2.5 9.4,3.2 10.2,3.5 9.4,3.8 9,4.5 8.6,3.8 7.8,3.5 8.6,3.2" fill="#FFD166"/></svg>';
      var sunSvg = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><radialGradient id="sunGrad" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#FFF066"/><stop offset="65%" stop-color="#FF9F1C"/><stop offset="100%" stop-color="#E71D36"/></radialGradient></defs><circle cx="12" cy="12" r="5" fill="url(#sunGrad)" stroke="#FFD166" stroke-width="1"/><g stroke-width="2" stroke-linecap="round"><line x1="12" y1="1" x2="12" y2="3" stroke="#EA4335"></line><line x1="12" y1="21" x2="12" y2="23" stroke="#34A853"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64" stroke="#FBBC05"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78" stroke="#4285F4"></line><line x1="1" y1="12" x2="3" y2="12" stroke="#FBBC05"></line><line x1="21" y1="12" x2="23" y2="12" stroke="#EA4335"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36" stroke="#34A853"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22" stroke="#4285F4"></line></g></svg>';

      if (theme === 'dark') {
        iconContainer.innerHTML = sunSvg;
        btn.setAttribute('title', 'Switch to Daytime White Mode');
        btn.setAttribute('aria-label', 'Switch to Daytime White Mode');
      } else {
        iconContainer.innerHTML = moonSvg;
        btn.setAttribute('title', 'Switch to Night Dark Mode');
        btn.setAttribute('aria-label', 'Switch to Night Dark Mode');
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      var currentTheme = document.documentElement.getAttribute('data-theme') || getScheduledTheme();
      updateThemeToggleIcon(currentTheme);
    });
  </script>
  <?php if (!function_exists('has_site_icon') || !has_site_icon()) : ?>
    <!-- Favicon & Touch Icons for Google Search & Web Browsers -->
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.svg'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon-16x16.png'); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri() . '/favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/apple-touch-icon.png'); ?>">
  <?php endif; ?>
  <?php wp_head(); ?>
  <style>
    /* Ensure header sits completely flush at top with 0px margin */
    html, body {
      margin-top: 0 !important;
      padding-top: 0 !important;
    }
    #wpadminbar {
      display: none !important;
    }
    /* Critical Directory UI styles to prevent FOUC / flash of unstyled buttons */
    .dir-filter-bar { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 8px 10px; margin-top: 24px; }
    .dir-filter-btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 16px; border-radius: 24px; font-size: 0.86rem; font-weight: 500; cursor: pointer; border: 1px solid var(--border-color, #e2e8f0); background: var(--bg-primary, #ffffff); color: var(--text-secondary, #475569); box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04); transition: all 0.22s ease; user-select: none; }
    .dir-filter-btn.active { background: var(--color-google-blue, #1a73e8) !important; color: #ffffff !important; border-color: var(--color-google-blue, #1a73e8) !important; font-weight: 600; }
    .dir-btn-count { display: inline-flex; align-items: center; justify-content: center; padding: 2px 7px; border-radius: 12px; font-size: 0.74rem; font-weight: 600; background: rgba(0, 0, 0, 0.06); margin-left: 2px; }
    .dir-search-box-wrapper { display: flex; align-items: center; background: var(--bg-primary, #ffffff); border: 1.5px solid var(--border-color, #e2e8f0); border-radius: 48px; padding: 10px 22px; }
    .dir-prompt-chip { display: inline-flex; align-items: center; gap: 6px; padding: 7px 15px; border-radius: 22px; background: var(--bg-primary, #ffffff); border: 1px solid var(--border-color, #e2e8f0); font-size: 0.83rem; font-weight: 500; color: var(--text-secondary, #475569); }
  </style>
</head>
<body <?php body_class(); ?>>
<?php if (function_exists('wp_body_open')) { wp_body_open(); } ?>

  <!-- Site Navigation Header -->
  <header class="site-header">
    <div class="nav-container">
      <?php if (has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:24px; height:24px; min-width:24px; flex-shrink:0;">
            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#1A73E8"/>
          </svg>
          <?php bloginfo('name'); ?>
          <span class="brand-badge">2026 Edition</span>
        </a>
      <?php endif; ?>

      <?php
      if (has_nav_menu('primary-menu')) {
          wp_nav_menu(array(
              'theme_location' => 'primary-menu',
              'container'      => false,
              'menu_class'     => 'nav-links',
          ));
      } else {
          ?>
          <ul class="nav-links">
            <li><a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link"><?php esc_html_e('Guides & Reviews', 'googleaitools-theme'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/ai-directory/')); ?>" class="nav-link" style="color:var(--color-google-blue); font-weight:700;"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline-block; vertical-align:-2px; margin-right:4px;"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path></svg><?php esc_html_e('AI Tools Directory', 'googleaitools-theme'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/models/')); ?>" class="nav-link" style="color:#a855f7; font-weight:700;"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="display:inline-block; vertical-align:-2px; margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg><?php esc_html_e('LLM Models', 'googleaitools-theme'); ?></a></li>
            <li class="nav-dropdown-wrapper" style="position:relative; display:inline-flex; align-items:center;">
              <a href="#" class="nav-link" onclick="event.preventDefault();"><?php esc_html_e('Categories â–¾', 'googleaitools-theme'); ?></a>
              <ul class="nav-dropdown-menu" style="display:none; position:absolute; top:100%; left:0; border-radius:12px; box-shadow:0 12px 32px rgba(0,0,0,0.18); padding:8px 0; min-width:220px; z-index:999999; list-style:none; list-style-type:none; margin:0;">
                <?php
                $categories = get_categories(array('hide_empty' => false));
                foreach ($categories as $cat) {
                    echo '<li style="list-style:none; margin:0; padding:0; display:block;"><a href="' . esc_url(get_category_link($cat->term_id)) . '" class="dropdown-item" style="display:block; padding:10px 18px; font-size:0.9rem; font-weight:500; text-decoration:none; white-space:nowrap;">' . esc_html($cat->name) . '</a></li>';
                }
                ?>
              </ul>
            </li>
            <li><a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link"><?php esc_html_e('About Us', 'googleaitools-theme'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-link"><?php esc_html_e('Contact Us', 'googleaitools-theme'); ?></a></li>
          </ul>
          <?php
      }
      ?>

      <div class="nav-right" style="margin-left: 24px; flex-shrink: 0;">
        <form role="search" method="get" class="search-form-header" action="<?php echo esc_url(home_url('/')); ?>" style="margin:0;">
          <div class="search-trigger" id="search-trigger-wrapper" style="padding:4px 10px; display:flex; align-items:center; gap:6px;">
            <button type="submit" aria-label="<?php esc_attr_e('Search', 'googleaitools-theme'); ?>" style="background:none; border:none; padding:0; cursor:pointer; display:flex; align-items:center; color:var(--text-secondary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px;">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </button>
            <input type="search" name="s" id="header-search-input" class="search-input-header" placeholder="<?php esc_attr_e('Search AI Tools...', 'googleaitools-theme'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" autocomplete="off" style="background:transparent; border:none; outline:none; box-shadow:none; -webkit-appearance:none; appearance:none; padding:0; margin:0; color:var(--text-primary); font-size:0.875rem; width:130px;" />
          </div>
        </form>

        <button class="theme-toggle-btn" id="theme-toggle-btn" onclick="toggleDarkMode()" type="button" title="<?php esc_attr_e('Toggle Dark/Light Mode', 'googleaitools-theme'); ?>" aria-label="<?php esc_attr_e('Toggle Dark/Light Mode', 'googleaitools-theme'); ?>">
          <span id="theme-toggle-icon" style="display:flex; align-items:center; justify-content:center; pointer-events:none;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="moonGradInit" x1="3" y1="3" x2="21" y2="21" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#7B2CBF"/><stop offset="50%" stop-color="#3A0CA3"/><stop offset="100%" stop-color="#F72585"/></linearGradient><linearGradient id="starGradInit" x1="0" y1="0" x2="10" y2="10" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#FFD166"/><stop offset="100%" stop-color="#F72585"/></linearGradient></defs><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" fill="url(#moonGradInit)" stroke="#FFD166" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><polygon points="18,2 18.8,3.5 20.5,4 18.8,4.5 18,6 17.2,4.5 15.5,4 17.2,3.5" fill="url(#starGradInit)"/><polygon points="9,2.5 9.4,3.2 10.2,3.5 9.4,3.8 9,4.5 8.6,3.8 7.8,3.5 8.6,3.2" fill="#FFD166"/></svg>
          </span>
        </button>

        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle Navigation Menu', 'googleaitools-theme'); ?>">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
  </header>

  <!-- Global Ad Banner Top (Hidden for time being) -->
  <?php if (get_theme_mod('googleaitools_adsense_enabled', false) && get_theme_mod('googleaitools_adsense_test_mode', false)) : ?>
  <div class="ad-container ad-leaderboard">
    <div style="background:var(--bg-secondary); border:1px dashed var(--border-color); padding:16px; text-align:center; color:var(--text-muted); font-size:0.85rem;">
      ðŸ“¢ Google AdSense Leaderboard Placement Box (Responsive)
    </div>
  </div>
  <?php endif; ?>

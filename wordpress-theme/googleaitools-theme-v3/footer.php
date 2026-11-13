  <!-- Global Footer Ad Banner (Hidden for time being) -->
  <?php if (get_theme_mod('googleaitools_adsense_enabled', false) && get_theme_mod('googleaitools_adsense_test_mode', false)) : ?>
  <div class="ad-container ad-leaderboard">
    <div style="background:var(--bg-secondary); border:1px dashed var(--border-color); padding:16px; text-align:center; color:var(--text-muted); font-size:0.85rem;">
      📢 Google AdSense Footer Leaderboard Placement Box
    </div>
  </div>
  <?php endif; ?>

  <!-- Site Footer -->
  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-grid">
        <div class="footer-brand">
          <?php if (has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
          <?php else : ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#1A73E8"/>
              </svg>
              <?php bloginfo('name'); ?>
            </a>
          <?php endif; ?>
          <p><?php echo esc_html(get_theme_mod('googleaitools_footer_tagline', __('Your premier independent guide and review publication for Google AI models, developer APIs, research tools, and generative workspace technologies.', 'googleaitools-theme'))); ?></p>
          
          <div style="margin-top:12px; font-size:0.85rem; color:var(--text-secondary); display:flex; align-items:center; gap:7px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="color:var(--color-google-blue); flex-shrink:0;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            <a href="mailto:contact@googleaitools.com" style="color:var(--text-primary); text-decoration:none; font-weight:600; font-family:var(--font-heading);" title="<?php esc_attr_e('Official Email', 'googleaitools-theme'); ?>">contact@googleaitools.com</a>
          </div>

          <div class="footer-social-links" style="display:flex; gap:10px; margin-top:16px;">
            <?php
            $tw = get_theme_mod('googleaitools_twitter_url', 'https://twitter.com/');
            $li = get_theme_mod('googleaitools_linkedin_url', 'https://linkedin.com/');
            $gh = get_theme_mod('googleaitools_github_url', 'https://github.com/ranjith-vp/awesome-google-ai-tools');
            ?>
            <a href="mailto:contact@googleaitools.com" class="social-link" style="display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:50%; background:var(--bg-secondary); border:1px solid var(--border-color); color:var(--text-secondary); text-decoration:none; transition:all 0.2s;" title="Email Us: contact@googleaitools.com">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </a>
            <a href="<?php echo esc_url($tw); ?>" target="_blank" rel="noopener noreferrer" class="social-link" style="display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:50%; background:var(--bg-secondary); border:1px solid var(--border-color); color:var(--text-secondary); text-decoration:none; transition:all 0.2s;" title="X (Twitter)">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a href="<?php echo esc_url($li); ?>" target="_blank" rel="noopener noreferrer" class="social-link" style="display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:50%; background:var(--bg-secondary); border:1px solid var(--border-color); color:var(--text-secondary); text-decoration:none; transition:all 0.2s;" title="LinkedIn">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
            <a href="<?php echo esc_url($gh); ?>" target="_blank" rel="noopener noreferrer" class="social-link" style="display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:50%; background:var(--bg-secondary); border:1px solid var(--border-color); color:var(--text-secondary); text-decoration:none; transition:all 0.2s;" title="GitHub">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
            </a>
            <a href="<?php echo esc_url(get_feed_link()); ?>" class="social-link" style="display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:50%; background:var(--bg-secondary); border:1px solid var(--border-color); color:var(--text-secondary); text-decoration:none; transition:all 0.2s;" title="RSS Feed">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg>
            </a>
          </div>
        </div>

        <div>
          <h4 class="footer-col-title"><?php esc_html_e('Featured Guides', 'googleaitools-theme'); ?></h4>
          <ul class="footer-links">
            <?php
            $featured_posts = get_posts(array(
                'posts_per_page'         => 5,
                'post_status'            => 'publish',
                'orderby'                => 'date',
                'order'                  => 'DESC',
                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            ));
            if (!empty($featured_posts)) {
                foreach ($featured_posts as $fp) {
                    echo '<li><a href="' . esc_url(get_permalink($fp->ID)) . '" class="footer-link">' . esc_html(get_the_title($fp->ID)) . '</a></li>';
                }
            } else {
                echo '<li><a href="' . esc_url(home_url('/')) . '" class="footer-link">' . esc_html__('Gemini 1.5 Pro Guide', 'googleaitools-theme') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/')) . '" class="footer-link">' . esc_html__('NotebookLM Masterclass', 'googleaitools-theme') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/')) . '" class="footer-link">' . esc_html__('Imagen 3 Prompting Guide', 'googleaitools-theme') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/')) . '" class="footer-link">' . esc_html__('Google Veo Video Tutorial', 'googleaitools-theme') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/')) . '" class="footer-link">' . esc_html__('Gemma 2 Open Models', 'googleaitools-theme') . '</a></li>';
            }
            ?>
          </ul>
        </div>

        <div>
          <h4 class="footer-col-title"><?php esc_html_e('Categories', 'googleaitools-theme'); ?></h4>
          <ul class="footer-links">
            <?php
            $categories = get_categories(array('hide_empty' => false, 'number' => 6));
            foreach ($categories as $cat) {
                echo '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '" class="footer-link">' . esc_html($cat->name) . '</a></li>';
            }
            ?>
          </ul>
        </div>

        <div>
          <?php if (is_active_sidebar('footer-sidebar')) : ?>
            <?php dynamic_sidebar('footer-sidebar'); ?>
          <?php else : ?>
            <h4 class="footer-col-title"><?php esc_html_e('Information & Legal', 'googleaitools-theme'); ?></h4>
            <?php
            if (has_nav_menu('footer-menu')) {
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container'      => false,
                    'menu_class'     => 'footer-links',
                ));
            } else {
                ?>
                <ul class="footer-links">
                  <li><a href="<?php echo esc_url(home_url('/about/')); ?>" class="footer-link"><?php esc_html_e('About Us', 'googleaitools-theme'); ?></a></li>
                  <li><a href="<?php echo esc_url(home_url('/contact/')); ?>" class="footer-link"><?php esc_html_e('Contact Us', 'googleaitools-theme'); ?></a></li>
                  <li><a href="<?php echo esc_url(home_url('/disclaimer/')); ?>" class="footer-link"><?php esc_html_e('Disclaimer', 'googleaitools-theme'); ?></a></li>
                  <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="footer-link"><?php esc_html_e('Privacy Policy', 'googleaitools-theme'); ?></a></li>
                  <li><a href="<?php echo esc_url(home_url('/terms/')); ?>" class="footer-link"><?php esc_html_e('Terms of Use', 'googleaitools-theme'); ?></a></li>
                  <li><a href="<?php echo esc_url(home_url('/dmca/')); ?>" class="footer-link"><?php esc_html_e('DMCA Policy', 'googleaitools-theme'); ?></a></li>
                  <li><a href="<?php echo esc_url(home_url('/llm-policy/')); ?>" class="footer-link"><?php esc_html_e('AI & LLM Policy', 'googleaitools-theme'); ?></a></li>
                </ul>
                <?php
            }
            ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="footer-bottom">
        <div>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?> — <?php echo esc_html(get_theme_mod('googleaitools_footer_copyright', __('All rights reserved. Independent news & tutorial portal.', 'googleaitools-theme'))); ?></div>
        <div class="footer-legal-links">
          <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'googleaitools-theme'); ?></a>
          <a href="<?php echo esc_url(home_url('/terms/')); ?>"><?php esc_html_e('Terms of Use', 'googleaitools-theme'); ?></a>
          <a href="<?php echo esc_url(home_url('/disclaimer/')); ?>"><?php esc_html_e('Disclaimer', 'googleaitools-theme'); ?></a>
          <a href="<?php echo esc_url(home_url('/sitemap.xml')); ?>"><?php esc_html_e('Sitemap', 'googleaitools-theme'); ?></a>
        </div>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>

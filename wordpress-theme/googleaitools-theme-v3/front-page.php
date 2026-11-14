<?php
/**
 * Front Page Template (Homepage) - Widescreen Cards & Custom Image URL Overrides
 */

get_header();
?>

<!-- Hero Banner -->
<section class="hero-banner">
  <div class="hero-content">
    <div class="hero-badge">✨ 2026 Edition • Complete Product Directory</div>
    <h1 class="hero-title">Discover, Compare & Master Google AI Tools</h1>
    <p class="hero-subtitle">Independent tutorials, benchmark analyses, prompt engineering tips, and API implementation guides for Google Gemini, NotebookLM, Imagen 3, Google Veo, and Gemma open models.</p>

    <!-- Category Filter Bar -->
    <div class="filter-bar">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="filter-btn active">✨ All Guides</a>
      <a href="<?php echo esc_url(home_url('/ai-directory/')); ?>" class="filter-btn" style="background:var(--color-google-blue); color:#fff; font-weight:700; border-color:var(--color-google-blue);">🌐 <?php echo function_exists('googleaitools_get_directory_products') ? count(googleaitools_get_directory_products()) : 850; ?>+ Tools Directory</a>
      <?php
      $categories = get_categories(array('hide_empty' => false));
      foreach ($categories as $cat) {
          echo '<a href="' . get_category_link($cat->term_id) . '" class="filter-btn">' . esc_html($cat->name) . '</a>';
      }
      ?>
    </div>
  </div>
</section>

<!-- Latest AI Products & Guides Section -->
<main class="products-section">
  <div class="section-header" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:12px;">
    <div>
      <h2 class="section-title">Latest AI Guides & Reviews</h2>
      <p class="section-subtitle">In-depth technical breakdowns and practical how-tos updated daily.</p>
    </div>
    <a href="<?php echo esc_url(home_url('/ai-directory/')); ?>" class="filter-btn" style="border-color:var(--color-google-blue); color:var(--color-google-blue); font-weight:700; display:inline-flex; align-items:center; gap:6px;">
      Explore Full <?php echo function_exists('googleaitools_get_directory_products') ? count(googleaitools_get_directory_products()) : 850; ?>+ AI Directory &rarr;
    </a>
  </div>

  <div class="grid-container">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'paged'          => $paged
    );
    $query = new WP_Query($args);

    $card_gradients = [
        'linear-gradient(135deg, #f2d5dc 0%, #463d47 100%)', // Rose Mauve to Dark (Card 1 in reference)
        'linear-gradient(135deg, #dbe4ea 0%, #343c46 100%)', // Slate Ice to Dark (Card 2 in reference)
        'linear-gradient(135deg, #d1e8e8 0%, #2d4246 100%)', // Mint Ice to Dark (Card 3 in reference)
        'linear-gradient(135deg, #e4d8f0 0%, #3d364f 100%)', // Lavender to Dark
        'linear-gradient(135deg, #fde4ce 0%, #4a3a32 100%)', // Warm Peach to Dark
        'linear-gradient(135deg, #d3e2fc 0%, #29384e 100%)'  // Google Blue to Dark
    ];
    $card_idx = 0;

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $icon_emoji = get_post_meta(get_the_ID(), '_googleaitools_icon_emoji', true);
            $read_time = get_post_meta(get_the_ID(), '_googleaitools_read_time', true) ?: '6 min read';
            $cats = get_the_category();
            $cat_name = !empty($cats) ? $cats[0]->name : 'AI Guide';
            $cat_slug = !empty($cats) ? $cats[0]->slug : 'all';
            $banner_gradient = $card_gradients[$card_idx % count($card_gradients)];
            $card_idx++;
            ?>
            <article class="product-card" data-category="<?php echo esc_attr($cat_slug); ?>">
              <!-- Top Boxed Gradient Banner (Replaces Featured Image) -->
              <div class="card-banner-header" style="background: <?php echo esc_attr($banner_gradient); ?>;">
                <div class="card-banner-icon">
                  <?php if (!empty($icon_emoji)) : ?>
                    <span class="emoji-icon"><?php echo esc_html($icon_emoji); ?></span>
                  <?php else : ?>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                      <polyline points="9 12 11 14 15 10"></polyline>
                    </svg>
                  <?php endif; ?>
                </div>
                <span class="card-banner-badge"><?php echo esc_html($cat_name); ?></span>
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
                    <?php echo esc_html($cat_name); ?>
                  </span>
                  <span class="meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <?php echo esc_html($read_time); ?>
                  </span>
                </div>

                <h3 class="card-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>

                <p class="card-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>

                <div class="card-footer">
                  <a href="<?php the_permalink(); ?>" class="card-cta-link">
                    Read Full Article <span class="cta-arrow">&rarr;</span>
                  </a>
                </div>
              </div>
            </article>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p style="grid-column:1/-1; text-align:center; padding:48px; color:var(--text-muted);">No guides found. Run One-Click Content Import under Appearance -> Import Website Content!</p>';
    endif;
    ?>
  </div>

  <!-- Ad Banner Mid Page (Hidden for time being) -->
  <?php if (get_theme_mod('googleaitools_adsense_enabled', false) && get_theme_mod('googleaitools_adsense_test_mode', false)) : ?>
  <div class="ad-container ad-inline">
    <div style="background:var(--bg-secondary); border:1px dashed var(--border-color); padding:16px; text-align:center; color:var(--text-muted); font-size:0.85rem;">
      📢 Google AdSense Native In-Feed Placement Box
    </div>
  </div>
  <?php endif; ?>
</main>

<?php get_footer(); ?>

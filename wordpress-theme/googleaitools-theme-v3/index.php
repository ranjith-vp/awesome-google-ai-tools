<?php
/**
 * Main Index Fallback Template
 */

get_header();
?>

<section class="hero-banner">
  <div class="hero-content">
    <h1 class="hero-title"><?php bloginfo('name'); ?></h1>
    <p class="hero-subtitle"><?php bloginfo('description'); ?></p>
  </div>
</section>

<main class="products-section">
  <div class="grid-container">
    <?php
    $card_gradients = [
        'linear-gradient(135deg, #f2d5dc 0%, #463d47 100%)',
        'linear-gradient(135deg, #dbe4ea 0%, #343c46 100%)',
        'linear-gradient(135deg, #d1e8e8 0%, #2d4246 100%)',
        'linear-gradient(135deg, #e4d8f0 0%, #3d364f 100%)',
        'linear-gradient(135deg, #fde4ce 0%, #4a3a32 100%)',
        'linear-gradient(135deg, #d3e2fc 0%, #29384e 100%)'
    ];
    $card_idx = 0;

    if (have_posts()) :
        while (have_posts()) : the_post();
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
    else :
        echo '<p style="grid-column:1/-1; text-align:center; padding:48px; color:var(--text-muted);">No guides found. Run One-Click Content Import under Appearance -> Import Website Content!</p>';
    endif;
    ?>
  </div>
</main>

<?php get_footer(); ?>

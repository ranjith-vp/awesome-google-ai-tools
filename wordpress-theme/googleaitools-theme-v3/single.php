<?php
/**
 * Single Post Template (Article Reading Layout) - Direct Image URL Support
 */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $read_time = get_post_meta(get_the_ID(), '_googleaitools_read_time', true) ?: '6 min read';
    $cats = get_the_category();
    $cat_name = !empty($cats) ? $cats[0]->name : 'AI Guide';
    $cat_link = !empty($cats) ? get_category_link($cats[0]->term_id) : home_url('/categories.html');

    $custom_og_img = get_post_meta(get_the_ID(), '_googleaitools_seo_og_image', true);
    $hero_img_url = '';
    if (!empty($custom_og_img)) {
        $hero_img_url = $custom_og_img;
    } elseif (has_post_thumbnail()) {
        $hero_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    } else {
        $hero_img_url = 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=1200&auto=format&fit=crop&q=80';
    }
    ?>

    <!-- Article Header -->
    <header class="article-header">
      <div class="article-header-container">
        <nav class="breadcrumb">
          <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / 
          <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a> / 
          <span><?php the_title(); ?></span>
        </nav>
        
        <span class="article-category-badge"><?php echo esc_html($cat_name); ?></span>
        <h1 class="article-title"><?php the_title(); ?></h1>
        <p class="article-subtitle"><?php echo esc_html(get_the_excerpt()); ?></p>

        <div class="article-author-row">
          <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="<?php the_author(); ?>" class="author-avatar">
          <div class="author-info">
            <span class="author-name"><?php the_author(); ?></span>
            <div class="article-meta-info">
              <span>📅 <?php echo get_the_date('Y-m-d'); ?></span> • 
              <span>🕒 <?php echo esc_html($read_time); ?></span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Article Layout -->
    <main class="article-layout">
      
      <!-- Sidebar -->
      <aside class="article-sidebar">
        <div id="sidebar-toc"></div>
        <?php if (get_theme_mod('googleaitools_adsense_enabled', false) && get_theme_mod('googleaitools_adsense_test_mode', false)) : ?>
        <div class="ad-container ad-sidebar">
          <div style="background:var(--bg-secondary); border:1px dashed var(--border-color); padding:16px; text-align:center; color:var(--text-muted); font-size:0.85rem;">
            📢 Google AdSense Sidebar Rectangle Ad
          </div>
        </div>
        <?php endif; ?>
      </aside>

      <!-- Main Content -->
      <article class="article-content">
        <div class="article-featured-image-wrapper" style="margin-bottom: 24px; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm);">
          <img src="<?php echo esc_url($hero_img_url); ?>" alt="<?php the_title_attribute(); ?>" class="article-featured-img" fetchpriority="high" decoding="async" style="width: 100%; height: auto; max-height: 450px; object-fit: cover; border-radius: 12px;" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=1200&auto=format&fit=crop&q=80';">
        </div>

        <div class="callout-box">
          <div class="callout-title">💡 Key Takeaways</div>
          <p><?php echo esc_html(get_the_excerpt()); ?></p>
        </div>

        <?php the_content(); ?>

        <?php if (get_theme_mod('googleaitools_adsense_enabled', false) && get_theme_mod('googleaitools_adsense_test_mode', false)) : ?>
        <div class="ad-container ad-inline">
          <div style="background:var(--bg-secondary); border:1px dashed var(--border-color); padding:16px; text-align:center; color:var(--text-muted); font-size:0.85rem;">
            📢 Google AdSense Inline Article Ad Box
          </div>
        </div>
        <?php endif; ?>

        <!-- Author Bio -->
        <div class="author-bio-card">
          <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="<?php the_author(); ?>" class="author-bio-avatar" loading="lazy" decoding="async">
          <div>
            <div class="author-bio-name">Written by <?php the_author(); ?></div>
            <div class="author-bio-desc">AI Specialist & Technical Writer at googleaitools.com.</div>
          </div>
        </div>
      </article>
    </main>

    <!-- Recommended Posts Grid -->
    <section class="related-posts-section">
      <div class="related-posts-container">
        <h3 class="section-title" style="margin-bottom: 24px;">Recommended Google AI Guides</h3>
        <div class="grid-container">
          <?php
          $related_args = array(
              'post_type'      => 'post',
              'posts_per_page' => 3,
              'post__not_in'   => array(get_the_ID()),
              'orderby'        => 'rand',
              'no_found_rows'  => true,
          );
          $related_query = new WP_Query($related_args);
          if ($related_query->have_posts()) :
              while ($related_query->have_posts()) : $related_query->the_post();
                  $rel_icon = get_post_meta(get_the_ID(), '_googleaitools_icon_emoji', true);
                  $rel_time = get_post_meta(get_the_ID(), '_googleaitools_read_time', true) ?: '6 min read';
                  $rel_cats = get_the_category();
                  $card_gradients = [
                      'linear-gradient(135deg, #f2d5dc 0%, #463d47 100%)',
                      'linear-gradient(135deg, #dbe4ea 0%, #343c46 100%)',
                      'linear-gradient(135deg, #d1e8e8 0%, #2d4246 100%)',
                      'linear-gradient(135deg, #e4d8f0 0%, #3d364f 100%)',
                      'linear-gradient(135deg, #fde4ce 0%, #4a3a32 100%)',
                      'linear-gradient(135deg, #d3e2fc 0%, #29384e 100%)'
                  ];
                  $rel_idx = isset($rel_idx) ? $rel_idx + 1 : 0;
                  $banner_gradient = $card_gradients[$rel_idx % count($card_gradients)];
                  $rel_slug = !empty($rel_cats) ? $rel_cats[0]->slug : 'all';
                  ?>
                  <article class="product-card" data-category="<?php echo esc_attr($rel_slug); ?>">
                    <!-- Top Boxed Gradient Banner (Replaces Featured Image) -->
                    <div class="card-banner-header" style="background: <?php echo esc_attr($banner_gradient); ?>;">
                      <div class="card-banner-icon">
                        <?php if (!empty($rel_icon)) : ?>
                          <span class="emoji-icon"><?php echo esc_html($rel_icon); ?></span>
                        <?php else : ?>
                          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 12 11 14 15 10"></polyline>
                          </svg>
                        <?php endif; ?>
                      </div>
                      <span class="card-banner-badge"><?php echo esc_html($rel_cat); ?></span>
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
                          <?php echo esc_html($rel_cat); ?>
                        </span>
                        <span class="meta-item">
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                          </svg>
                          <?php echo esc_html($rel_time); ?>
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
          endif;
          ?>
        </div>
      </div>
    </section>

    <?php
endwhile; endif;

get_footer();
?>

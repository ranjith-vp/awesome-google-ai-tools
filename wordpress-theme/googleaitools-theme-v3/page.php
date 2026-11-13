<?php
/**
 * Generic Page Template (About Us, Privacy Policy, Terms, Disclaimer, Legal, Info)
 */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    ?>
    <!-- Page Header -->
    <header class="page-header" style="background: var(--bg-secondary); border-bottom: 1px solid var(--border-color); padding: clamp(36px, 5vw, 56px) 24px 32px; text-align: center;">
      <div style="max-width: 860px; margin: 0 auto;">
        <nav class="breadcrumb" style="margin-bottom: 16px; font-size: 0.88rem; color: var(--text-muted); display: flex; justify-content: center; align-items: center; gap: 8px;">
          <a href="<?php echo esc_url(home_url('/')); ?>" style="color: var(--text-muted); text-decoration: none;">Home</a>
          <span>/</span>
          <span style="color: var(--color-google-blue); font-weight: 600;"><?php the_title(); ?></span>
        </nav>
        
        <span class="page-category-badge" style="display: inline-block; padding: 4px 14px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; background: var(--color-google-blue-light); color: var(--color-google-blue); margin-bottom: 14px;">Information &amp; Legal</span>
        <h1 class="page-title" style="font-family: var(--font-heading); font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 800; margin: 0 0 12px; color: var(--text-primary); line-height: 1.25;"><?php the_title(); ?></h1>
      </div>
    </header>

    <!-- Page Content Container (Centered full-width readable layout) -->
    <main class="page-layout" style="max-width: 860px; margin: 0 auto; padding: 48px 24px 80px; width: 100%; box-sizing: border-box;">
      <article class="page-content" style="max-width: 100%; width: 100%; font-size: 1.05rem; line-height: 1.85; color: var(--text-primary);">
        <?php the_content(); ?>
      </article>
    </main>
    <?php
endwhile; endif;

get_footer();
?>

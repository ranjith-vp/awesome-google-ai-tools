<?php
/**
 * 404 Error Page Template
 */

get_header();
?>

<section class="hero-banner" style="padding: 80px 24px;">
  <div class="hero-content">
    <h1 class="hero-title" style="font-size: 3.5rem;"><?php esc_html_e('404 Page Not Found', 'googleaitools-theme'); ?></h1>
    <p class="hero-subtitle"><?php esc_html_e('The page or article you are looking for has moved or does not exist.', 'googleaitools-theme'); ?></p>
    <div style="margin-top: 24px;">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="publish-btn"><?php esc_html_e('Return to Homepage', 'googleaitools-theme'); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>

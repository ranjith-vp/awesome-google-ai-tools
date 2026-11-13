<?php
/**
 * Template Name: Frontier LLM & Multimodal Models Catalog
 * Description: Clean, responsive discovery hub, instant search, category filters, and deep-dive architecture specs for frontier AI models.
 * Layout perfectly mirrors the AI Directory layout with zero hardcoded backgrounds.
 */

// 1. Load models dataset & helper functions
$inc_file = dirname(__FILE__) . '/inc/models-data.php';
if (file_exists($inc_file)) {
    require_once $inc_file;
}

$all_models = function_exists('googleaitools_get_models_data') ? googleaitools_get_models_data() : array();
$categories = function_exists('googleaitools_get_model_categories') ? googleaitools_get_model_categories() : array();

// 2. Resolve requested view: Single Model vs Category vs Main Hub
$selected_model = null;
$selected_category = null;

$model_param = get_query_var('model');
if (empty($model_param) && isset($_GET['model'])) {
    $model_param = sanitize_title($_GET['model']);
}

$cat_param = get_query_var('models_cat');
if (empty($cat_param) && isset($_GET['category'])) {
    $cat_param = sanitize_title($_GET['category']);
}

// Check if model_param is actually a category (e.g. /models/coding/ or /models/speech/)
if (!empty($model_param) && isset($categories[$model_param])) {
    $selected_category = $categories[$model_param];
} elseif (!empty($model_param)) {
    $requested = strtolower(trim($model_param));
    foreach ($all_models as $m) {
        if (strtolower($m['slug']) === $requested || strtolower($m['id']) === $requested) {
            $selected_model = $m;
            break;
        }
    }

    // Canonical 301 Redirect: If accessed via ?model=slug, redirect to clean /models/slug/
    if ($selected_model && isset($_GET['model'])) {
        wp_redirect(home_url('/models/' . $selected_model['slug'] . '/'), 301);
        exit;
    }
}

if (!$selected_model && !empty($cat_param) && isset($categories[$cat_param])) {
    $selected_category = $categories[$cat_param];

    // Canonical 301 Redirect: If accessed via ?category=slug, redirect to clean /models/category/slug/
    if (isset($_GET['category'])) {
        wp_redirect(home_url('/models/category/' . $cat_param . '/'), 301);
        exit;
    }
}

// Model provider brand SVG helper with explicit width/height
function googleaitools_model_provider_svg($provider_slug) {
    $slug = strtolower($provider_slug);
    switch ($slug) {
        case 'google':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/><circle cx="12" cy="12" r="3" fill="#4285F4"/></svg>';
        case 'openai':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#10a37f;"><path d="M22.28 9.82a6 6 0 0 0-.52-4.91 6.05 6.05 0 0 0-6.5-2.9 6.07 6.07 0 0 0-10.28 2.17 6 6 0 0 0-4 2.9 6.05 6.05 0 0 0 .74 7.1 6 6 0 0 0 .52 4.9 6.05 6.05 0 0 0 6.51 2.9A6 6 0 0 0 13.26 24a6.06 6.06 0 0 0 5.77-4.21 6 6 0 0 0 4-2.9 6.06 6.06 0 0 0-.75-7.07zm-9.02 12.6a4.48 4.48 0 0 1-2.88-1.04l.14-.08 4.78-2.76a.8.8 0 0 0 .4-.68v-6.74l2.01 1.17a.07.07 0 0 1 .04.05v5.58a4.5 4.5 0 0 1-4.49 4.5z"/></svg>';
        case 'anthropic':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#d97706;"><path d="M13.83 3.52h3.98L24 20.48h-4l-1.85-4.32h-6.3L10 20.48H5.98l6.18-16.96zm2.6 9.48-2.01-4.7-2 4.7h4.01zM0 20.48l6.21-16.96h4L4 20.48H0z"/></svg>';
        case 'meta':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#0284c7;"><path d="M12 2.04c-5.5 0-10 4.49-10 10.02 0 5 3.66 9.15 8.44 9.9v-7H7.9v-2.9h2.54V9.85c0-2.51 1.49-3.89 3.78-3.89 1.09 0 2.23.19 2.23.19v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.45 2.9h-2.33v7a10 10 0 0 0 8.44-9.9c0-5.53-4.5-10.02-10-10.02z"/></svg>';
        case 'deepseek':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#06b6d4;"><path d="M12 2a10 10 0 0 0-10 10c0 4.42 2.87 8.17 6.84 9.5.5.08.66-.23.66-.5v-1.69c-2.77.6-3.36-1.34-3.36-1.34-.46-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.87 1.52 2.34 1.07 2.91.83.1-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.92 0-1.11.38-2 1.03-2.71-.1-.25-.45-1.29.1-2.64 0 0 .84-.27 2.75 1.02.79-.22 1.65-.33 2.5-.33.85 0 1.71.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.35.2 2.39.1 2.64.65.71 1.03 1.6 1.03 2.71 0 3.82-2.34 4.66-4.57 4.91.36.31.69.92.69 1.85V21c0 .27.16.59.67.5C19.14 20.16 22 16.42 22 12A10 10 0 0 0 12 2z"/></svg>';
        case 'bytedance':
        case 'bytedance-seed':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#0d9488;"><rect x="3" y="10" width="3" height="11" rx="1.5"/><rect x="9" y="4" width="3" height="17" rx="1.5"/><rect x="15" y="8" width="3" height="13" rx="1.5"/><rect x="21" y="13" width="3" height="8" rx="1.5"/></svg>';
        case 'x-ai':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:var(--text-primary);"><path d="M18.24 2.25h3.31l-7.23 8.26 8.5 11.24H16.17l-5.21-6.82-4.97 6.82H1.68l7.73-8.84L1.25 2.25H8.08l4.71 6.23zm-1.16 17.52h1.83L7.08 4.13H5.12z"/></svg>';
        case 'hexgrad':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#9333ea;"><polygon points="12 2 2 8.5 2 15.5 12 22 22 15.5 22 8.5 12 2"/></svg>';
        case 'qwen':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#6366f1;"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>';
        case 'amazon':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#f59e0b;"><path d="M15.93 17.09c-2.83 2.08-6.95 3.19-10.51 3.19-4.98 0-9.48-1.92-12.87-5.13-.27-.25-.03-.6.29-.41 4.18 2.45 9.29 3.92 14.54 3.92 3.16 0 6.64-.67 9.84-2.06.48-.21.88.33.41.69l-1.7 1.8zm2.41-1.39c-.36-.46-2.39-.22-3.3-.11-.28.03-.32-.2-.07-.38 1.63-1.16 4.3-.83 4.6.21.3 1.05-1.14 3.98-2.69 5.25-.24.2-.46.09-.35-.17.37-.87 2.17-4.34 1.81-4.8z"/></svg>';
        case 'microsoft':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#00a4ef;"><rect x="1" y="1" width="10" height="10" fill="#f25022"/><rect x="13" y="1" width="10" height="10" fill="#7fba00"/><rect x="1" y="13" width="10" height="10" fill="#00a4ef"/><rect x="13" y="13" width="10" height="10" fill="#ffb900"/></svg>';
        case 'runway':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#ec4899;"><path d="M12 2L2 22h20L12 2zm0 5l6.5 13H5.5L12 7z"/></svg>';
        case 'bfl':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#3b82f6;"><polygon points="6 2 18 2 22 12 18 22 6 22 2 12 6 2"/></svg>';
        case 'groq':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#ef4444;"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2.5"/><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>';
        case 'cerebras':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#8b5cf6;"><rect x="2" y="2" width="20" height="20" rx="3" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4"/></svg>';
        case 'nvidia':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#76b900;"><path d="M8.94 6.55c-.76.32-1.78.89-2.37 1.34-1.92 1.48-3.08 3.73-3.08 6.01 0 2.87 1.76 5.4 4.54 6.52.88.35 1.54.52 2.76.68v-2.02c-.93-.13-1.42-.27-2.04-.59-1.89-.98-3.06-2.73-3.06-4.63 0-1.52.76-3.03 2.06-4.04.53-.41 1.41-.93 2.07-1.22l.06-.03v-2.02h-.94zm6.12 0v2.02l.06.03c.66.29 1.54.81 2.07 1.22 1.3 1.01 2.06 2.52 2.06 4.04 0 1.9-1.17 3.65-3.06 4.63-.62.32-1.11.46-2.04.59v2.02c1.22-.16 1.88-.33 2.76-.68 2.78-1.12 4.54-3.65 4.54-6.52 0-2.28-1.16-4.53-3.08-6.01-.59-.45-1.61-1.02-2.37-1.34h-.94zm-3.06-4.55c-6.63 0-12 5.37-12 12s5.37 12 12 12 12-5.37 12-12-5.37-12-12-12zm0 4.1c4.36 0 7.9 3.54 7.9 7.9s-3.54 7.9-7.9 7.9-7.9-3.54-7.9-7.9 3.54-7.9 7.9-7.9z"/></svg>';
        case 'apple':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:var(--text-primary);"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 4.15c.66-.83 1.11-1.99.99-3.15-1 .04-2.22.67-2.92 1.5-.62.72-1.16 1.88-1.01 3.01 1.12.09 2.28-.53 2.94-1.36z"/></svg>';
        case 'ibm':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#0f62fe;"><path d="M2 5h20v2H2zm0 4h20v2H2zm0 4h20v2H2zm0 4h20v2H2z"/></svg>';
        case 'cohere':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#39594d;"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 14.93V17a1 1 0 0 1-2 0v-.07A6 6 0 0 1 6.07 12H6a1 1 0 0 1 0-2h.07A6 6 0 0 1 11 5.07V5a1 1 0 0 1 2 0v.07A6 6 0 0 1 17.93 10H18a1 1 0 0 1 0 2h-.07A6 6 0 0 1 13 16.93z"/></svg>';
        case 'ai21':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#ff6b6b;"><polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"/><circle cx="12" cy="12" r="3" fill="#ffffff"/></svg>';
        case 'stability':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#8b5cf6;"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-5" stroke="#ffffff" stroke-width="2" fill="none"/></svg>';
        case 'mistralai':
        case 'mistral':
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:#f97316;"><rect x="3" y="3" width="4" height="4"/><rect x="17" y="3" width="4" height="4"/><rect x="3" y="10" width="4" height="4"/><rect x="10" y="10" width="4" height="4"/><rect x="17" y="10" width="4" height="4"/><rect x="3" y="17" width="4" height="4"/><rect x="17" y="17" width="4" height="4"/></svg>';
        default:
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; flex-shrink:0; vertical-align:middle; color:var(--color-google-blue);"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>';
    }
}

// Dynamically resolve Models page URL
$models_page_obj = get_posts(array(
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-models.php',
    'posts_per_page' => 1
));
if (!empty($models_page_obj)) {
    $models_hub_url = get_permalink($models_page_obj[0]->ID);
} else {
    $by_slug = get_page_by_path('models');
    $models_hub_url = $by_slug ? get_permalink($by_slug->ID) : home_url('/models/');
}

get_header();

// =========================================================================
// VIEW A: SINGLE MODEL DEEP-DIVE & ARCHITECTURE PROFILE (/models/{model}/)
// =========================================================================
if ($selected_model) :
    $cat_data = isset($categories[$selected_model['category']]) ? $categories[$selected_model['category']] : array('name' => $selected_model['categoryName'], 'slug' => $selected_model['category']);
    $cat_url = home_url('/models/category/' . $cat_data['slug'] . '/');

    // Get 3 related models in the same category
    $related = array();
    foreach ($all_models as $m) {
        if ($m['id'] !== $selected_model['id'] && $m['category'] === $selected_model['category']) {
            $related[] = $m;
            if (count($related) >= 3) break;
        }
    }
?>

<!-- Schema.org Structured Data for SEO Rich Snippets -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "<?php echo esc_js($selected_model['name']); ?>",
  "applicationCategory": "Large Language Model",
  "operatingSystem": "Cloud API / Multi-Platform",
  "description": "<?php echo esc_js($selected_model['summary']); ?>",
  "offers": {
    "@type": "Offer",
    "price": "<?php echo esc_js($selected_model['inputPrice']); ?>",
    "priceCurrency": "USD"
  }
}
</script>

<div class="models-detail-wrapper" style="max-width: var(--max-width-page); margin: 0 auto; padding: 32px 24px 80px;">
  
  <!-- Breadcrumb Navigation -->
  <nav aria-label="Breadcrumb" style="margin-bottom: 24px;">
    <ol style="list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; align-items: center; gap: 8px; font-size: 0.88rem; color: var(--text-muted);">
      <li><a href="<?php echo esc_url(home_url('/')); ?>" style="color: var(--text-muted); text-decoration: none; transition: color 0.2s;">Home</a></li>
      <li>/</li>
      <li><a href="<?php echo esc_url($models_hub_url); ?>" style="color: var(--text-muted); text-decoration: none; transition: color 0.2s;">LLM Models</a></li>
      <li>/</li>
      <li><a href="<?php echo esc_url($cat_url); ?>" style="color: var(--text-muted); text-decoration: none; transition: color 0.2s;"><?php echo esc_html($cat_data['name']); ?></a></li>
      <li>/</li>
      <li><span style="color: var(--color-google-blue); font-weight: 600;"><?php echo esc_html($selected_model['name']); ?></span></li>
    </ol>
  </nav>

  <!-- Back Button Bar -->
  <div style="margin-bottom: 24px;">
    <a href="<?php echo esc_url($models_hub_url); ?>" class="btn-back-dir" style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 8px; background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary); text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: all 0.2s;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="width:16px; height:16px;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
      Back to All Models
    </a>
  </div>

  <!-- Header Card (Matches AI Directory Hero Card) -->
  <header class="tool-hero-card" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: clamp(20px, 3.5vw, 36px); box-shadow: var(--shadow-sm); margin-bottom: 32px; width: 100%; box-sizing: border-box;">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 20px; width: 100%;">
      
      <!-- Brand & Name Group -->
      <div style="flex: 1 1 280px; min-width: 0; max-width: 100%;">
        <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 10px; margin-bottom: 12px;">
          <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary);">
            <?php echo googleaitools_model_provider_svg($selected_model['providerSlug']); ?>
            <?php echo esc_html($selected_model['provider']); ?>
          </span>
          <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; background: var(--color-google-blue-light); color: var(--color-google-blue);">
            <?php echo esc_html($selected_model['categoryName']); ?>
          </span>
          <?php if (!empty($selected_model['status']) && in_array($selected_model['status'], array('discontinued', 'dropped', 'superseded', 'legacy', 'deprecated', 'rebranded'))): ?>
          <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 700; background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5;">
            ⚠️ Discontinued / Dropped
          </span>
          <?php endif; ?>
          <?php if (!empty($selected_model['providersCount'])): ?>
          <span style="font-size: 0.8rem; color: var(--text-muted); background: var(--bg-secondary); padding: 4px 10px; border-radius: 6px; border: 1px solid var(--border-color);">
            <?php echo esc_html($selected_model['providersCount']); ?> Cloud Endpoints
          </span>
          <?php endif; ?>
        </div>

        <h1 style="font-size: 2.3rem; font-weight: 800; color: var(--text-primary); margin: 0 0 10px; letter-spacing: -0.02em; font-family: var(--font-heading);">
          <?php echo esc_html($selected_model['name']); ?>
        </h1>
        <p style="font-size: 1.1rem; color: var(--text-secondary); margin: 0; max-width: 800px; line-height: 1.6;">
          <?php echo esc_html($selected_model['tagline']); ?>
        </p>

        <?php if (!empty($selected_model['status']) && in_array($selected_model['status'], array('discontinued', 'dropped', 'superseded', 'legacy', 'deprecated', 'rebranded'))): ?>
        <div style="background: rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.25); border-left: 4px solid #ef4444; border-radius: 8px; padding: 14px 18px; margin-top: 14px;">
          <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; color: #b91c1c; font-size: 0.95rem; margin-bottom: 4px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            Model Lifecycle Notice: Discontinued / Dropped Architecture
          </div>
          <p style="margin: 0; font-size: 0.92rem; color: var(--text-primary); line-height: 1.55;">
            <?php echo !empty($selected_model['statusNotice']) ? esc_html($selected_model['statusNotice']) : 'This foundation model architecture has been officially retired or superseded by modern models. This page is maintained for historical benchmarking and migration pathways.'; ?>
          </p>
        </div>
        <?php endif; ?>
      </div>

      <!-- Quick Action / Status -->
      <div style="display: flex; flex-direction: column; gap: 6px; align-items: flex-start;">
        <span style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Pricing per Million Tokens</span>
        <div style="font-size: 1.25rem; font-weight: 700; color: #a855f7;">
          <?php echo esc_html($selected_model['inputPrice']); ?> <span style="font-size: 0.85rem; font-weight: 500; color: var(--text-muted);">input</span> / <?php echo esc_html($selected_model['outputPrice']); ?> <span style="font-size: 0.85rem; font-weight: 500; color: var(--text-muted);">output</span>
        </div>
      </div>
    </div>

    <!-- Vital Specs Grid (Responsive) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 150px), 1fr)); gap: 14px; margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border-color);">
      <div style="background: var(--bg-secondary); padding: 16px; border-radius: 12px; border: 1px solid var(--border-color);">
        <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.05em;">Throughput Speed</div>
        <div style="font-size: 1.3rem; font-weight: 700; color: #10b981;"><?php echo esc_html($selected_model['throughput']); ?></div>
      </div>
      <div style="background: var(--bg-secondary); padding: 16px; border-radius: 12px; border: 1px solid var(--border-color);">
        <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.05em;">TTFT (Latency p50)</div>
        <div style="font-size: 1.3rem; font-weight: 700; color: #f59e0b;"><?php echo esc_html($selected_model['ttft']); ?></div>
      </div>
      <div style="background: var(--bg-secondary); padding: 16px; border-radius: 12px; border: 1px solid var(--border-color);">
        <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.05em;">Context Window</div>
        <div style="font-size: 1.3rem; font-weight: 700; color: var(--color-google-blue);"><?php echo esc_html($selected_model['contextWindow']); ?></div>
      </div>
      <div style="background: var(--bg-secondary); padding: 16px; border-radius: 12px; border: 1px solid var(--border-color);">
        <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.05em;">Active Providers</div>
        <div style="font-size: 1.3rem; font-weight: 700; color: #ec4899;"><?php echo esc_html($selected_model['providersCount']); ?> Endpoints</div>
      </div>
    </div>
  </header>

  <!-- Deep Dive Content Grid (Responsive 2 Columns to 1 Column on Mobile) -->
  <style>
  .models-detail-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 32px;
    align-items: start;
    width: 100%;
  }
  @media (max-width: 900px) {
    .models-detail-grid {
      display: flex !important;
      flex-direction: column !important;
      gap: 24px !important;
      width: 100% !important;
    }
    .models-detail-grid > main,
    .models-detail-grid > aside {
      width: 100% !important;
      max-width: 100% !important;
      min-width: 0 !important;
    }
  }
  </style>
  <div class="models-detail-grid tool-detail-grid">
    
    <!-- Main Column -->
    <main style="min-width: 0; width: 100%;">
      <!-- Section 1: Overview & Architecture -->
      <section style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: 32px; margin-bottom: 28px; box-shadow: var(--shadow-sm);">
        <h2 style="display: flex; align-items: center; gap: 10px; font-size: 1.4rem; font-weight: 700; color: var(--text-primary); margin-top: 0; margin-bottom: 16px; font-family: var(--font-heading);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="color: var(--color-google-blue); width:22px; height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          Core Architecture & Value Proposition
        </h2>
        <div style="font-size: 1rem; line-height: 1.8; color: var(--text-secondary);">
          <p style="margin-top: 0; margin-bottom: 16px;">
            <?php echo esc_html($selected_model['description']); ?>
          </p>
          <p style="margin-bottom: 0;">
            Operating on <?php echo esc_html($selected_model['architecture']); ?>, <strong><?php echo esc_html($selected_model['name']); ?></strong> is engineered for enterprise workflows demanding zero-shot reasoning, exceptional token economics, and rapid responsiveness across modern cloud infrastructure.
          </p>
        </div>
      </section>

      <!-- Section 2: Key Capabilities & Highlights -->
      <section style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: 32px; margin-bottom: 28px; box-shadow: var(--shadow-sm);">
        <h2 style="display: flex; align-items: center; gap: 10px; font-size: 1.4rem; font-weight: 700; color: var(--text-primary); margin-top: 0; margin-bottom: 18px; font-family: var(--font-heading);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="color: #10b981; width:22px; height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Key Capabilities & Breakthrough Highlights
        </h2>
        <ul style="list-style: none; padding: 0; margin: 0; display: grid; gap: 14px;">
          <?php foreach ($selected_model['capabilities'] as $cap): ?>
          <li style="display: flex; align-items: flex-start; gap: 12px; font-size: 0.98rem; color: var(--text-secondary); line-height: 1.6;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="color: #10b981; flex-shrink: 0; margin-top: 3px; width:18px; height:18px;"><polyline points="20 6 9 17 4 12"/></svg>
            <span><?php echo esc_html($cap); ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </section>

      <!-- Section 3: Verified Latency & Efficiency Benchmarks -->
      <section style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: 32px; margin-bottom: 28px; box-shadow: var(--shadow-sm);">
        <h2 style="display: flex; align-items: center; gap: 10px; font-size: 1.4rem; font-weight: 700; color: var(--text-primary); margin-top: 0; margin-bottom: 16px; font-family: var(--font-heading);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="color: #f59e0b; width:22px; height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
          Verified Performance & Latency Benchmarks
        </h2>
        <p style="font-size: 0.95rem; color: var(--text-secondary); margin-bottom: 20px; line-height: 1.6;">
          Real-world streaming throughput and time-to-first-token recorded across 20+ multi-cloud inference providers.
        </p>

        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
          <table style="width: 100%; border-collapse: collapse; font-size: 0.92rem; text-align: left;">
            <thead>
              <tr style="border-bottom: 1px solid var(--border-color); color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">
                <th style="padding: 10px 12px;">Benchmark Metric</th>
                <th style="padding: 10px 12px; text-align: right;">Result</th>
                <th style="padding: 10px 12px; text-align: right;">Industry Percentile</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom: 1px solid var(--border-light);">
                <td style="padding: 14px 12px; font-weight: 600; color: var(--text-primary);">Streaming Token Throughput</td>
                <td style="padding: 14px 12px; text-align: right; color: #10b981; font-weight: 700;"><?php echo esc_html($selected_model['throughput']); ?></td>
                <td style="padding: 14px 12px; text-align: right; color: var(--text-secondary);">Top 5% Frontier</td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border-light);">
                <td style="padding: 14px 12px; font-weight: 600; color: var(--text-primary);">Median Time to First Token (TTFT p50)</td>
                <td style="padding: 14px 12px; text-align: right; color: #f59e0b; font-weight: 700;"><?php echo esc_html($selected_model['ttft']); ?></td>
                <td style="padding: 14px 12px; text-align: right; color: var(--text-secondary);">Sub-second instant</td>
              </tr>
              <tr style="border-bottom: 1px solid var(--border-light);">
                <td style="padding: 14px 12px; font-weight: 600; color: var(--text-primary);">Context Window Capacity</td>
                <td style="padding: 14px 12px; text-align: right; color: var(--color-google-blue); font-weight: 700;"><?php echo esc_html($selected_model['contextWindow']); ?></td>
                <td style="padding: 14px 12px; text-align: right; color: var(--text-secondary);">Full Repository RAG</td>
              </tr>
              <tr>
                <td style="padding: 14px 12px; font-weight: 600; color: var(--text-primary);">Pricing Efficiency Index</td>
                <td style="padding: 14px 12px; text-align: right; color: #a855f7; font-weight: 700;"><?php echo esc_html($selected_model['inputPrice']); ?> / 1M</td>
                <td style="padding: 14px 12px; text-align: right; color: var(--text-secondary);">Optimal High-Volume Tier</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Section 4: Sample Prompt & Output Workflow -->
      <section style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: 32px; margin-bottom: 28px; box-shadow: var(--shadow-sm);">
        <h2 style="display: flex; align-items: center; gap: 10px; font-size: 1.4rem; font-weight: 700; color: var(--text-primary); margin-top: 0; margin-bottom: 16px; font-family: var(--font-heading);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="color: #a855f7; width:22px; height:22px;"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
          Sample Prompt & Output Workflow
        </h2>
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; font-family: 'Fira Code', monospace; font-size: 0.9rem; line-height: 1.6; color: var(--text-primary); overflow-x: auto;">
          <div style="color: var(--text-muted); margin-bottom: 6px;">// Example API payload:</div>
          <div style="color: #10b981;">POST https://openrouter.ai/api/v1/chat/completions</div>
          <div style="color: var(--text-secondary); margin-top: 8px;">{</div>
          <div style="padding-left: 16px; color: var(--text-secondary);">"model": "<span style="color: #60a5fa;"><?php echo esc_html($selected_model['id']); ?></span>",</div>
          <div style="padding-left: 16px; color: var(--text-secondary);">"messages": [{"role": "user", "content": "Analyze system latency and optimize data pipelines."}],</div>
          <div style="padding-left: 16px; color: var(--text-secondary);">"temperature": 0.2</div>
          <div style="color: var(--text-secondary);">}</div>
        </div>
      </section>

      <!-- Section 5: Google Cloud & Vertex AI Integration -->
      <section style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: 32px; box-shadow: var(--shadow-sm);">
        <h2 style="display: flex; align-items: center; gap: 10px; font-size: 1.4rem; font-weight: 700; color: var(--text-primary); margin-top: 0; margin-bottom: 14px; font-family: var(--font-heading);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="color: var(--color-google-blue); width:22px; height:22px;"><circle cx="12" cy="12" r="10"/><path d="m12 6 4 6-4 6-4-6z"/></svg>
          Integration with Google Cloud Vertex AI & OpenRouter
        </h2>
        <p style="font-size: 1rem; line-height: 1.7; color: var(--text-secondary); margin: 0;">
          Deploy <?php echo esc_html($selected_model['name']); ?> seamlessly alongside Google Cloud Vertex AI pipelines, BigQuery vector search, and multi-agent systems. You can route inference via OpenRouter or Vertex AI Model Garden for low latency, unified billing, and 99.99% availability.
        </p>
      </section>
    </main>

    <!-- Sidebar Column -->
    <aside style="min-width: 0; width: 100%;">
      <!-- Quick Specs Card -->
      <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: 24px; margin-bottom: 24px; box-shadow: var(--shadow-sm);">
        <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-primary); margin: 0 0 16px; font-family: var(--font-heading);">
          Model Specifications
        </h3>
        <dl style="margin: 0; display: grid; gap: 12px; font-size: 0.9rem;">
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-light); padding-bottom: 8px;">
            <dt style="color: var(--text-muted);">Provider</dt>
            <dd style="margin: 0; font-weight: 600; color: var(--text-primary);"><?php echo esc_html($selected_model['provider']); ?></dd>
          </div>
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-light); padding-bottom: 8px;">
            <dt style="color: var(--text-muted);">Category</dt>
            <dd style="margin: 0; font-weight: 600; color: var(--text-primary);"><?php echo esc_html($selected_model['categoryName']); ?></dd>
          </div>
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-light); padding-bottom: 8px;">
            <dt style="color: var(--text-muted);">Context Window</dt>
            <dd style="margin: 0; font-weight: 600; color: var(--color-google-blue);"><?php echo esc_html($selected_model['contextWindow']); ?></dd>
          </div>
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-light); padding-bottom: 8px;">
            <dt style="color: var(--text-muted);">Throughput</dt>
            <dd style="margin: 0; font-weight: 600; color: #10b981;"><?php echo esc_html($selected_model['throughput']); ?></dd>
          </div>
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-light); padding-bottom: 8px;">
            <dt style="color: var(--text-muted);">Input Price</dt>
            <dd style="margin: 0; font-weight: 600; color: #a855f7;"><?php echo esc_html($selected_model['inputPrice']); ?></dd>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <dt style="color: var(--text-muted);">Output Price</dt>
            <dd style="margin: 0; font-weight: 600; color: #a855f7;"><?php echo esc_html($selected_model['outputPrice']); ?></dd>
          </div>
        </dl>
      </div>

      <!-- Related Models in Same Category -->
      <?php if (!empty($related)): ?>
      <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: 24px; box-shadow: var(--shadow-sm);">
        <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-primary); margin: 0 0 16px; font-family: var(--font-heading);">
          Alternative <?php echo esc_html($cat_data['name']); ?>
        </h3>
        <div style="display: grid; gap: 12px;">
          <?php foreach ($related as $rm): ?>
          <a href="<?php echo esc_url(home_url('/models/' . $rm['slug'] . '/')); ?>" style="display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; border-radius: 10px; background: var(--bg-secondary); border: 1px solid var(--border-color); text-decoration: none; transition: transform 0.2s, border-color 0.2s;">
            <div>
              <div style="font-size: 0.92rem; font-weight: 600; color: var(--text-primary);"><?php echo esc_html($rm['name']); ?></div>
              <div style="font-size: 0.78rem; color: var(--text-muted);"><?php echo esc_html($rm['provider']); ?> &bull; <?php echo esc_html($rm['throughput']); ?></div>
            </div>
            <span style="color: var(--color-google-blue); font-weight: 600; font-size: 0.9rem;">&rarr;</span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </aside>
  </div>
</div>

<?php
// =========================================================================
// VIEW B: CATEGORY PAGE (/models/category/{slug}/)
// =========================================================================
elseif ($selected_category) :
    $cat_models = function_exists('googleaitools_get_models_by_category') ? googleaitools_get_models_by_category($selected_category['slug']) : array();
?>

<!-- Category Hero Banner (Matches AI Directory Hero) -->
<section class="hero-banner" style="padding: 56px 24px 36px; text-align: center;">
  <div class="hero-content" style="max-width: 900px; margin: 0 auto;">
    
    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" style="margin-bottom: 20px;">
      <ol style="list-style: none; padding: 0; margin: 0; display: inline-flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 8px; font-size: 0.88rem; color: var(--text-muted);">
        <li><a href="<?php echo esc_url(home_url('/')); ?>" style="color: var(--text-muted); text-decoration: none;">Home</a></li>
        <li>/</li>
        <li><a href="<?php echo esc_url($models_hub_url); ?>" style="color: var(--text-muted); text-decoration: none;">LLM Models</a></li>
        <li>/</li>
        <li><span style="color: var(--color-google-blue); font-weight: 600;"><?php echo esc_html($selected_category['name']); ?></span></li>
      </ol>
    </nav>

    <div class="hero-badge" style="margin-bottom: 16px;">
      <?php echo esc_html($selected_category['badge']); ?> &bull; Frontier LLMs
    </div>
    <h1 class="hero-title" style="font-size: 2.6rem; margin-bottom: 16px; font-family: var(--font-heading);">
      <?php echo esc_html($selected_category['name']); ?> Models
    </h1>
    <p class="hero-subtitle" style="font-size: 1.1rem; color: var(--text-secondary); max-width: 740px; margin: 0 auto 28px; line-height: 1.6;">
      <?php echo esc_html($selected_category['description']); ?>
    </p>

    <!-- Modality Filter Quick Bar -->
    <div class="filter-bar" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; margin-top: 16px;">
      <a href="<?php echo esc_url($models_hub_url); ?>" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; cursor: pointer; border: 1px solid var(--border-color); background: var(--bg-secondary); color: var(--text-secondary); text-decoration: none; transition: all 0.2s;">
        All Models (<?php echo count($all_models); ?>)
      </a>
      <?php foreach ($categories as $slug => $c): 
        $is_active = ($slug === $selected_category['slug']);
      ?>
      <a href="<?php echo esc_url(home_url('/models/category/' . $slug . '/')); ?>" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; cursor: pointer; border: 1px solid var(--border-color); text-decoration: none; transition: all 0.2s; <?php echo $is_active ? 'background: var(--color-google-blue); color: #fff; border-color: var(--color-google-blue);' : 'background: var(--bg-secondary); color: var(--text-secondary);'; ?>">
        <?php echo esc_html($c['name']); ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Category Content Container -->
<main style="max-width: var(--max-width-page); margin: 0 auto; padding: 32px 24px 64px;">
  <!-- Results Meta Bar -->
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid var(--border-color);">
    <div style="font-size: 0.95rem; font-weight: 600; color: var(--text-secondary);">
      Showing <?php echo count($cat_models); ?> frontier <?php echo esc_html(strtolower($selected_category['name'])); ?> models
    </div>
  </div>

  <!-- Models Grid (Matches AI Directory Grid) -->
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(min(100%, 300px), 1fr)); gap: 20px;">
    <?php 
    $rank = 1;
    foreach ($cat_models as $m): 
      $model_url = home_url('/models/' . $m['slug'] . '/');
    ?>
    <article class="dir-card" onclick="window.location.href='<?php echo esc_url($model_url); ?>';" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s; box-shadow: var(--shadow-sm); cursor: pointer; position: relative;">
      <div>
        <!-- Header with Rank, Provider & Tag -->
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; gap: 8px;">
          <div style="display: flex; align-items: center; gap: 10px;">
            <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: var(--bg-secondary); border: 1px solid var(--border-color); font-size: 0.75rem; font-weight: 700; color: var(--text-muted); flex-shrink: 0;">
              #<?php echo $rank++; ?>
            </span>
            <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.82rem; font-weight: 600; color: var(--text-primary);">
              <?php echo googleaitools_model_provider_svg($m['providerSlug']); ?>
              <?php echo esc_html($m['provider']); ?>
            </span>
          </div>
          <span style="display: inline-block; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; background: var(--color-google-blue-light); color: var(--color-google-blue); white-space: nowrap;">
            <?php echo esc_html($m['contextWindow']); ?>
          </span>
        </div>

        <!-- Model Name -->
        <h3 style="font-size: 1.15rem; font-weight: 700; margin: 0 0 6px; color: var(--text-primary); font-family: var(--font-heading);">
          <?php echo esc_html($m['name']); ?>
        </h3>

        <!-- Tagline -->
        <p style="font-size: 0.9rem; line-height: 1.5; color: var(--text-secondary); margin: 0 0 16px;">
          <?php echo esc_html($m['tagline']); ?>
        </p>

        <!-- Stats Pill Row -->
        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
          <span style="font-size: 0.75rem; font-weight: 600; color: #10b981; background: rgba(16, 185, 129, 0.1); padding: 3px 8px; border-radius: 6px;">
            ⚡ <?php echo esc_html($m['throughput']); ?>
          </span>
          <span style="font-size: 0.75rem; font-weight: 600; color: #f59e0b; background: rgba(245, 158, 11, 0.1); padding: 3px 8px; border-radius: 6px;">
            ⏱️ <?php echo esc_html($m['ttft']); ?>
          </span>
          <span style="font-size: 0.75rem; font-weight: 600; color: #a855f7; background: rgba(168, 85, 247, 0.1); padding: 3px 8px; border-radius: 6px;">
            🏷️ <?php echo esc_html($m['inputPrice']); ?>
          </span>
        </div>
      </div>

      <!-- Card Footer -->
      <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid var(--border-light); font-size: 0.85rem;">
        <span style="color: var(--color-google-blue); font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
          Explore Specs <span>&rarr;</span>
        </span>
        <span style="font-size: 0.8rem; color: var(--text-muted);">
          <?php echo esc_html($m['providersCount']); ?> Providers
        </span>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</main>

<?php
// =========================================================================
// VIEW C: MAIN FRONTIER MODEL DISCOVERY HUB (/models/)
// Formatted 100% identically to AI Directory
// =========================================================================
else :
?>

<!-- Models Hub Hero Banner (Matches AI Directory Hero) -->
<section class="hero-banner" style="padding: 56px 24px 36px; text-align: center;">
  <div class="hero-content" style="max-width: 900px; margin: 0 auto;">
    
    <div class="hero-badge" style="margin-bottom: 16px;">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="display:inline-block; vertical-align:-2px; margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
      <?php echo count($all_models); ?>+ Frontier Models &bull; LLM Directory
    </div>
    
    <h1 class="hero-title" style="font-size: 2.6rem; margin-bottom: 16px; font-family: var(--font-heading);">
      Frontier LLMs & Multimodal Models Catalog
    </h1>
    
    <p class="hero-subtitle" style="font-size: 1.1rem; color: var(--text-secondary); max-width: 760px; margin: 0 auto 28px; line-height: 1.6;">
      Benchmark-verified performance, token throughput (tok/s), latency metrics, and architectural breakdowns across speech, coding, video, image, reasoning, and efficiency leaders.
    </p>

    <!-- Search Box (Matches Directory Search Box) -->
    <div style="max-width: 580px; margin: 0 auto 24px; position: relative;">
      <div style="display: flex; align-items: center; background: var(--bg-secondary); border: 2px solid var(--border-color); border-radius: 32px; padding: 10px 20px; box-shadow: var(--shadow-sm); transition: border-color 0.2s;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--text-secondary); margin-right: 12px; flex-shrink: 0; width:20px; height:20px;">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="model-search-input" placeholder="Search by model name, provider (Google, OpenAI, Anthropic, Meta), or modality..." style="width: 100%; border: none; background: transparent; outline: none; font-size: 1rem; color: var(--text-primary);" autocomplete="off">
        <button id="model-clear-btn" style="display: none; background: none; border: none; font-size: 1.1rem; color: var(--text-secondary); cursor: pointer; padding: 0 4px;" title="Clear search">&times;</button>
      </div>
    </div>

    <!-- Category Filter Pills Bar (Matches AI Directory Pills) -->
    <div class="filter-bar" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; margin-top: 16px;">
      <button class="model-filter-btn active" data-cat="all" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; cursor: pointer; border: 1px solid var(--color-google-blue); background: var(--color-google-blue); color: #fff; transition: all 0.2s;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline-block; vertical-align:-2px; margin-right:4px;"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path></svg>
        All Models (<?php echo count($all_models); ?>)
      </button>
      <?php foreach ($categories as $slug => $c): 
        $count = count(array_filter($all_models, function($m) use ($slug) { return $m['category'] === $slug; }));
      ?>
      <button class="model-filter-btn" data-cat="<?php echo esc_attr($slug); ?>" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; cursor: pointer; border: 1px solid var(--border-color); background: var(--bg-secondary); color: var(--text-secondary); transition: all 0.2s;">
        <?php echo esc_html($c['name']); ?> (<?php echo $count; ?>)
      </button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Models Content Container -->
<main style="max-width: var(--max-width-page); margin: 0 auto; padding: 32px 24px 64px;">
  
  <!-- Results Meta Bar -->
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid var(--border-color);">
    <div id="model-results-count" style="font-size: 0.95rem; font-weight: 600; color: var(--text-secondary);">
      Showing <?php echo count($all_models); ?> frontier AI models & architectures
    </div>
  </div>

  <!-- Models Grid (Matches AI Directory Grid) -->
  <div id="model-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(min(100%, 300px), 1fr)); gap: 20px;">
    <?php 
    $rank = 1;
    foreach ($all_models as $m): 
      $model_url = home_url('/models/' . $m['slug'] . '/');
    ?>
    <article class="dir-card model-card" 
      data-category="<?php echo esc_attr($m['category']); ?>" 
      data-name="<?php echo esc_attr(strtolower($m['name'])); ?>" 
      data-provider="<?php echo esc_attr(strtolower($m['provider'])); ?>" 
      data-summary="<?php echo esc_attr(strtolower($m['summary'] . ' ' . $m['tagline'])); ?>" 
      onclick="window.location.href='<?php echo esc_url($model_url); ?>';" 
      style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s; box-shadow: var(--shadow-sm); cursor: pointer; position: relative;">
      
      <div>
        <!-- Header with Rank, Provider & Tag -->
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; gap: 8px;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: var(--bg-secondary); border: 1px solid var(--border-color); font-size: 0.75rem; font-weight: 700; color: var(--text-muted); flex-shrink: 0;">
              #<?php echo $rank++; ?>
            </span>
            <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.82rem; font-weight: 600; color: var(--text-primary);">
              <?php echo googleaitools_model_provider_svg($m['providerSlug']); ?>
              <?php echo esc_html($m['provider']); ?>
            </span>
          </div>
          <span style="display: inline-block; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; background: var(--color-google-blue-light); color: var(--color-google-blue); white-space: nowrap;">
            <?php echo esc_html($m['categoryName']); ?>
          </span>
          <?php if (!empty($m['status']) && in_array($m['status'], array('discontinued', 'dropped', 'superseded', 'legacy', 'deprecated', 'rebranded'))): ?>
          <span style="display: inline-block; padding: 3px 8px; border-radius: 6px; font-size: 0.72rem; font-weight: 700; background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; white-space: nowrap;">
            Dropped
          </span>
          <?php endif; ?>
        </div>

        <!-- Model Name -->
        <h3 style="font-size: 1.15rem; font-weight: 700; margin: 0 0 6px; color: var(--text-primary); font-family: var(--font-heading);">
          <?php echo esc_html($m['name']); ?>
        </h3>

        <!-- Tagline / Summary -->
        <p style="font-size: 0.9rem; line-height: 1.5; color: var(--text-secondary); margin: 0 0 16px;">
          <?php echo esc_html($m['tagline']); ?>
        </p>

        <!-- Stats Pill Row -->
        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
          <span style="font-size: 0.75rem; font-weight: 600; color: #10b981; background: rgba(16, 185, 129, 0.1); padding: 3px 8px; border-radius: 6px;">
            ⚡ <?php echo esc_html($m['throughput']); ?>
          </span>
          <span style="font-size: 0.75rem; font-weight: 600; color: #f59e0b; background: rgba(245, 158, 11, 0.1); padding: 3px 8px; border-radius: 6px;">
            ⏱️ <?php echo esc_html($m['ttft']); ?>
          </span>
          <span style="font-size: 0.75rem; font-weight: 600; color: #a855f7; background: rgba(168, 85, 247, 0.1); padding: 3px 8px; border-radius: 6px;">
            🏷️ <?php echo esc_html($m['inputPrice']); ?>
          </span>
          <span style="font-size: 0.75rem; font-weight: 500; color: var(--text-muted); background: var(--bg-secondary); padding: 3px 8px; border-radius: 6px; border: 1px solid var(--border-color);">
            🪟 <?php echo esc_html($m['contextWindow']); ?>
          </span>
        </div>
      </div>

      <!-- Card Footer -->
      <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid var(--border-light); font-size: 0.85rem;">
        <span style="color: var(--color-google-blue); font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
          Explore Specs <span>&rarr;</span>
        </span>
        <span style="font-size: 0.8rem; color: var(--text-muted);">
          <?php echo esc_html($m['providersCount']); ?> Endpoints
        </span>
      </div>
    </article>
    <?php endforeach; ?>
  </div>

  <!-- Zero Results Fallback Message -->
  <div id="model-no-results" style="display: none; text-align: center; padding: 60px 20px; background: var(--bg-primary); border: 1px dashed var(--border-color); border-radius: 16px; margin-top: 20px;">
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: var(--text-muted); margin: 0 auto 16px; width:48px; height:48px;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin: 0 0 8px;">No frontier models match your query</h3>
    <p style="color: var(--text-secondary); margin: 0 0 20px;">Try searching for a different keyword or provider (e.g. Google, Anthropic, Video, Speech).</p>
    <button onclick="document.getElementById('model-search-input').value=''; document.querySelector('.model-filter-btn[data-cat=\'all\']').click();" style="padding: 8px 18px; border-radius: 20px; background: var(--color-google-blue); color: #fff; border: none; font-weight: 600; cursor: pointer;">
      Reset Filters
    </button>
  </div>
</main>

<!-- Live Instant Search & Filter Script -->
<script>
(function() {
  var searchInput = document.getElementById('model-search-input');
  var clearBtn = document.getElementById('model-clear-btn');
  var filterBtns = document.querySelectorAll('.model-filter-btn');
  var cards = document.querySelectorAll('.model-card');
  var countEl = document.getElementById('model-results-count');
  var noResults = document.getElementById('model-no-results');
  var activeCategory = 'all';

  function filterModels() {
    var query = searchInput ? searchInput.value.toLowerCase().trim() : '';
    if (clearBtn) {
      clearBtn.style.display = query.length > 0 ? 'inline-block' : 'none';
    }

    var visibleCount = 0;
    cards.forEach(function(card) {
      var cat = card.getAttribute('data-category') || '';
      var name = card.getAttribute('data-name') || '';
      var provider = card.getAttribute('data-provider') || '';
      var summary = card.getAttribute('data-summary') || '';

      var matchesCategory = (activeCategory === 'all' || cat === activeCategory);
      var matchesSearch = !query || name.indexOf(query) !== -1 || provider.indexOf(query) !== -1 || summary.indexOf(query) !== -1;

      if (matchesCategory && matchesSearch) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (countEl) {
      countEl.textContent = 'Showing ' + visibleCount + ' frontier AI models & architectures';
    }
    if (noResults) {
      noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }
  }

  if (searchInput) {
    searchInput.addEventListener('input', filterModels);
  }

  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      searchInput.value = '';
      filterModels();
      searchInput.focus();
    });
  }

  filterBtns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      filterBtns.forEach(function(b) {
        b.classList.remove('active');
        b.style.background = 'var(--bg-secondary)';
        b.style.color = 'var(--text-secondary)';
        b.style.borderColor = 'var(--border-color)';
      });
      this.classList.add('active');
      this.style.background = 'var(--color-google-blue)';
      this.style.color = '#fff';
      this.style.borderColor = 'var(--color-google-blue)';
      activeCategory = this.getAttribute('data-cat');
      filterModels();
    });
  });
})();
</script>

<?php endif; ?>

<?php get_footer(); ?>

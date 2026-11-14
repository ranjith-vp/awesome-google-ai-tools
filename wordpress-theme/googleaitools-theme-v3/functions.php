<?php
/**
 * Google AI Tools - Central Theme Functions & Setup
 */

if (!defined('ABSPATH')) exit;

$inc_meta = get_template_directory() . '/inc/meta-boxes.php';
if (file_exists($inc_meta)) require_once $inc_meta;

$inc_options = get_template_directory() . '/inc/theme-options.php';
if (file_exists($inc_options)) require_once $inc_options;

$inc_importer = get_template_directory() . '/inc/importer.php';
if (file_exists($inc_importer)) require_once $inc_importer;

$inc_dir_data = get_template_directory() . '/inc/directory-data.php';
if (file_exists($inc_dir_data)) require_once $inc_dir_data;

$inc_models_data = get_template_directory() . '/inc/models-data.php';
if (file_exists($inc_models_data)) require_once $inc_models_data;

$inc_seo_engine = get_template_directory() . '/inc/auto-seo-engine.php';
if (file_exists($inc_seo_engine)) require_once $inc_seo_engine;

/**
 * Shorten verbose category titles into crisp, modern directory filter names
 * e.g. "Personal AI Agents & Universal Assistants" -> "AI Assistants"
 */
if (!function_exists('googleaitools_shorten_category')) {
    function googleaitools_shorten_category($cat) {
        $clean = trim(preg_replace('/^\d+\.\s*/', '', (string)$cat));
        $map = array(
            'Personal AI Agents & Universal Assistants'      => 'AI Assistants',
            'AI Browsers & Future of Internet Access'        => 'AI Browsers',
            'AI Software Development & App Creation'         => 'Coding & Dev',
            'AI Voice, Communication & Meeting Intelligence' => 'Voice & Audio',
            'AI Creative, Video & Entertainment'             => 'Video & Creative',
            'AI Research, Knowledge & Intelligence'          => 'Research & Search',
            'AI Business Automation & Enterprise Workflows'  => 'Business Automation',
            'AI Healthcare & Biotechnology'                  => 'Health & Biotech',
            'Robotics & Physical AI'                         => 'Robotics',
            'AI Infrastructure & Developer Ecosystem'        => 'Infra & Dev Tools',
            'AI Startups from India'                         => 'India AI',
        );
        if (isset($map[$clean])) {
            return $map[$clean];
        }
        foreach ($map as $orig => $short) {
            if (strcasecmp($clean, $orig) === 0 || stripos($clean, $orig) !== false) {
                return $short;
            }
        }
        return $clean;
    }
}

function googleaitools_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary-menu' => __('Primary Navigation Menu', 'googleaitools-theme'),
        'footer-menu'  => __('Footer Legal Menu', 'googleaitools-theme')
    ));

    // Remove WordPress admin bar bump callback to eliminate empty space above header
    add_theme_support('admin-bar', array('callback' => '__return_false'));
}
add_action('after_setup_theme', 'googleaitools_theme_setup');

// Disable admin bar on frontend to ensure navbar sits completely flush at top (0px margin)
add_filter('show_admin_bar', '__return_false');

// Remove individual post/comment and category feed links from <head> to prevent GSC redirect bloat
remove_action('wp_head', 'feed_links_extra', 3);

function googleaitools_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'googleaitools-theme'),
        'id'            => 'footer-sidebar',
        'description'   => __('Add widgets here to appear in the theme footer.', 'googleaitools-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-col-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'googleaitools_widgets_init');

// Disable default WordPress core multi-part XML sitemaps
add_filter('wp_sitemaps_enabled', '__return_false');

// Dynamic handler for robots.txt, llms.txt, llms-full.txt, sitemap.xml, and legacy .html 301 redirects
add_action('init', function() {
    $request_uri = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
    
    if (empty($request_uri) || $request_uri === '/') return;

    if ($request_uri === '/categories.html' || $request_uri === '/categories') {
        wp_redirect(home_url('/'), 301);
        exit;
    }

    if ($request_uri === '/robots.txt') {
        $file = get_template_directory() . '/robots.txt';
        if (file_exists($file)) {
            header('Content-Type: text/plain; charset=utf-8');
            readfile($file);
            exit;
        }
    } elseif ($request_uri === '/llms.txt') {
        $file = get_template_directory() . '/llms.txt';
        if (file_exists($file)) {
            header('Content-Type: text/plain; charset=utf-8');
            readfile($file);
            exit;
        }
    } elseif ($request_uri === '/llms-full.txt') {
        $file = get_template_directory() . '/llms-full.txt';
        if (file_exists($file)) {
            header('Content-Type: text/plain; charset=utf-8');
            readfile($file);
            exit;
        }
    } elseif ($request_uri === '/wp-sitemap.xml' || preg_match('/^\/wp-sitemap-/i', $request_uri)) {
        wp_redirect(home_url('/sitemap.xml'), 301);
        exit;
    } elseif ($request_uri === '/sitemap.xml' || $request_uri === '/sitemap_index.xml') {
        while (ob_get_level()) {
            @ob_end_clean();
        }
        header('Content-Type: application/xml; charset=utf-8');
        header('X-Robots-Tag: noindex, follow', true);
        header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

        $tracked_urls = array();

        // 1. Homepage
        $home = trailingslashit(home_url('/'));
        $tracked_urls[$home] = true;
        echo '  <url>' . "\n";
        echo '    <loc>' . esc_url($home) . '</loc>' . "\n";
        echo '    <lastmod>' . date('c') . '</lastmod>' . "\n";
        echo '    <changefreq>daily</changefreq>' . "\n";
        echo '    <priority>1.0</priority>' . "\n";
        echo '  </url>' . "\n";

        // 2. AI Tools Directory Main Hub Page
        $dir_hub = trailingslashit(home_url('/ai-directory/'));
        $tracked_urls[$dir_hub] = true;
        echo '  <url>' . "\n";
        echo '    <loc>' . esc_url($dir_hub) . '</loc>' . "\n";
        echo '    <lastmod>' . date('c') . '</lastmod>' . "\n";
        echo '    <changefreq>daily</changefreq>' . "\n";
        echo '    <priority>0.9</priority>' . "\n";
        echo '  </url>' . "\n";

        // 3. AI Tools Individual Deep-Dive Profiles (160+ Built-in + All Admin Custom Added Tools)
        $directory_tools = array();
        if (function_exists('googleaitools_get_directory_products')) {
            $directory_tools = googleaitools_get_directory_products();
        } elseif (function_exists('googleaitools_get_directory_data')) {
            $directory_tools = googleaitools_get_directory_data();
        }
        foreach ($directory_tools as $tool) {
            if (empty($tool['slug'])) continue;
            $tool_url = trailingslashit(home_url('/ai-directory/' . sanitize_title($tool['slug'])));
            if (isset($tracked_urls[$tool_url])) continue;
            $tracked_urls[$tool_url] = true;

            $mod_time = !empty($tool['created_at']) ? date('c', strtotime($tool['created_at'])) : date('c');
            echo '  <url>' . "\n";
            echo '    <loc>' . esc_url($tool_url) . '</loc>' . "\n";
            echo '    <lastmod>' . esc_html($mod_time) . '</lastmod>' . "\n";
            echo '    <changefreq>weekly</changefreq>' . "\n";
            echo '    <priority>0.8</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        // 3b. LLM Models Main Hub Page (/models/)
        $models_hub = trailingslashit(home_url('/models/'));
        if (!isset($tracked_urls[$models_hub])) {
            $tracked_urls[$models_hub] = true;
            echo '  <url>' . "\n";
            echo '    <loc>' . esc_url($models_hub) . '</loc>' . "\n";
            echo '    <lastmod>' . date('c') . '</lastmod>' . "\n";
            echo '    <changefreq>daily</changefreq>' . "\n";
            echo '    <priority>0.9</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        // 3c. LLM Model Category / Modality Pages (/models/category/{slug}/)
        if (function_exists('googleaitools_get_model_categories')) {
            $model_cats = googleaitools_get_model_categories();
            foreach ($model_cats as $cat_slug => $c) {
                $cat_url = trailingslashit(home_url('/models/category/' . sanitize_title($cat_slug)));
                if (isset($tracked_urls[$cat_url])) continue;
                $tracked_urls[$cat_url] = true;
                echo '  <url>' . "\n";
                echo '    <loc>' . esc_url($cat_url) . '</loc>' . "\n";
                echo '    <lastmod>' . date('c') . '</lastmod>' . "\n";
                echo '    <changefreq>weekly</changefreq>' . "\n";
                echo '    <priority>0.8</priority>' . "\n";
                echo '  </url>' . "\n";
            }
        }

        // 3d. Individual LLM Model Deep-Dive Profiles (/models/{slug}/)
        if (function_exists('googleaitools_get_models_data')) {
            $all_llms = googleaitools_get_models_data();
            foreach ($all_llms as $m) {
                if (empty($m['slug'])) continue;
                $m_url = trailingslashit(home_url('/models/' . sanitize_title($m['slug'])));
                if (isset($tracked_urls[$m_url])) continue;
                $tracked_urls[$m_url] = true;
                echo '  <url>' . "\n";
                echo '    <loc>' . esc_url($m_url) . '</loc>' . "\n";
                echo '    <lastmod>' . date('c') . '</lastmod>' . "\n";
                echo '    <changefreq>weekly</changefreq>' . "\n";
                echo '    <priority>0.8</priority>' . "\n";
                echo '  </url>' . "\n";
            }
        }

        // 4. Standard Published Static Pages
        $pages = get_posts(['post_type' => 'page', 'post_status' => 'publish', 'posts_per_page' => 100]);
        foreach ($pages as $p) {
            $page_url = trailingslashit(get_permalink($p->ID));
            if (isset($tracked_urls[$page_url])) continue;
            $tracked_urls[$page_url] = true;

            echo '  <url>' . "\n";
            echo '    <loc>' . esc_url($page_url) . '</loc>' . "\n";
            echo '    <lastmod>' . date('c', strtotime($p->post_modified)) . '</lastmod>' . "\n";
            echo '    <changefreq>weekly</changefreq>' . "\n";
            echo '    <priority>0.7</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        // 5. Published Blog Posts & Guides
        $posts = get_posts(['post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 500]);
        foreach ($posts as $p) {
            $post_url = trailingslashit(get_permalink($p->ID));
            if (isset($tracked_urls[$post_url])) continue;
            $tracked_urls[$post_url] = true;

            echo '  <url>' . "\n";
            echo '    <loc>' . esc_url($post_url) . '</loc>' . "\n";
            echo '    <lastmod>' . date('c', strtotime($p->post_modified)) . '</lastmod>' . "\n";
            echo '    <changefreq>daily</changefreq>' . "\n";
            echo '    <priority>0.8</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        // 6. Post Categories
        $categories = get_categories(['hide_empty' => false]);
        foreach ($categories as $c) {
            $cat_url = trailingslashit(get_category_link($c->term_id));
            if (isset($tracked_urls[$cat_url])) continue;
            $tracked_urls[$cat_url] = true;

            echo '  <url>' . "\n";
            echo '    <loc>' . esc_url($cat_url) . '</loc>' . "\n";
            echo '    <lastmod>' . date('c') . '</lastmod>' . "\n";
            echo '    <changefreq>weekly</changefreq>' . "\n";
            echo '    <priority>0.6</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        echo '</urlset>';
        exit;
    }

    // Redirect any legacy .html URL (e.g. /about.html, /contact.html, /privacy-policy.html) to WordPress permalink (/about/, /contact/)
    if (preg_match('/^\/(.+)\.html$/i', $request_uri, $matches)) {
        $slug = sanitize_title($matches[1]);
        if (!empty($slug)) {
            wp_redirect(home_url('/' . $slug . '/'), 301);
            exit;
        }
    }
});

// Native WordPress robots.txt override fallback
add_action('do_robotstxt', function() {
    $file = get_template_directory() . '/robots.txt';
    if (file_exists($file)) {
        echo file_get_contents($file);
        exit;
    }
});

// REST API Safeguard: Automatically clean up invalid/orphaned featured_media IDs so Gutenberg Replace/Remove buttons work smoothly
add_filter('rest_prepare_post', function($response, $post) {
    if (isset($response->data['featured_media'])) {
        $media_id = (int)$response->data['featured_media'];
        if ($media_id > 0) {
            $attachment = get_post($media_id);
            if (!$attachment || $attachment->post_type !== 'attachment') {
                $response->data['featured_media'] = 0;
                delete_post_thumbnail($post->ID);
            }
        }
    }
    return $response;
}, 10, 2);

function googleaitools_enqueue_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap', array(), null);

    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    $ai_css = $theme_dir . '/assets/css/google-ai.css';
    if (file_exists($ai_css)) {
        wp_enqueue_style('google-ai-css', $theme_uri . '/assets/css/google-ai.css', array(), filemtime($ai_css));
    }

    $style_css = $theme_dir . '/style.css';
    $style_ver = file_exists($style_css) ? filemtime($style_css) : '1.2.0';
    wp_enqueue_style('googleaitools-style', get_stylesheet_uri(), array(), $style_ver);

        $main_js = $theme_dir . '/assets/js/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script('googleaitools-main', $theme_uri . '/assets/js/main.js', array(), filemtime($main_js), true);

        // High-Performance On-Demand Search & Directory Configuration (Saves ~520 KB of inline payload on every page)
        $search_index_file = $theme_dir . '/assets/data/search-index.json';
        $search_ver = file_exists($search_index_file) ? filemtime($search_index_file) : '1.0';
        $products_file = $theme_dir . '/assets/data/global-ai-products.json';
        $products_ver = file_exists($products_file) ? filemtime($products_file) : '1.0';

        wp_localize_script('googleaitools-main', 'GOOGLEAITOOLS_CONFIG', array(
            'searchIndexUrl' => $theme_uri . '/assets/data/search-index.json?v=' . $search_ver,
            'productsUrl'    => $theme_uri . '/assets/data/global-ai-products.json?v=' . $products_ver,
            'homeUrl'        => home_url('/'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'googleaitools_enqueue_scripts');

function googleaitools_inject_head_tags() {
    $pub_id   = get_theme_mod('googleaitools_adsense_pub_id', '');
    $g_verify = get_theme_mod('googleaitools_google_site_verification', '');
    $b_verify = get_theme_mod('googleaitools_bing_site_verification', '');
    $ga_id    = get_theme_mod('googleaitools_ga4_measurement_id', '');

    if (!empty($g_verify)) {
        echo '<meta name="google-site-verification" content="' . esc_attr($g_verify) . '">' . "\n";
    }

    if (!empty($b_verify)) {
        echo '<meta name="msvalidate.01" content="' . esc_attr($b_verify) . '">' . "\n";
    }

    // 1. Dynamic Meta Robots
    $robots = 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    if (is_singular()) {
        $custom_robots = get_post_meta(get_the_ID(), '_googleaitools_seo_robots', true);
        if (!empty($custom_robots)) {
            $robots = $custom_robots;
        }
    } elseif (is_search() || is_404() || is_category('uncategorized')) {
        $robots = 'noindex, follow';
    }
    echo '<meta name="robots" content="' . esc_attr($robots) . '">' . "\n";

    // 2. Self-Referencing Canonical Link (Guarantees Canonical Alignment in Google Search Console)
    $canonical_url = home_url('/');
    if (is_singular()) {
        $canonical_url = get_permalink();
    } elseif (is_category() || is_tag() || is_tax()) {
        $term_link = get_term_link(get_queried_object());
        if (!is_wp_error($term_link)) {
            $canonical_url = $term_link;
        }
    } elseif (is_search()) {
        $canonical_url = home_url('/?s=' . urlencode(get_search_query()));
    }
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";

    // 2. Dynamic Title, Description & Open Graph Meta Tags
    $site_name   = get_bloginfo('name');
    $title       = wp_get_document_title();
    $description = get_bloginfo('description');
    $url         = esc_url(home_url(add_query_arg(array(), $GLOBALS['wp']->request)));
    $og_type     = 'website';
    $og_image    = 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=1200&auto=format&fit=crop&q=80';
    $keywords    = '';

    if (is_singular()) {
        $post_id = get_the_ID();
        $og_type = 'article';

        $custom_title = get_post_meta($post_id, '_googleaitools_seo_title', true);
        if (!empty($custom_title)) $title = $custom_title;

        $custom_desc = get_post_meta($post_id, '_googleaitools_seo_description', true);
        if (!empty($custom_desc)) {
            $description = $custom_desc;
        } elseif (has_excerpt()) {
            $description = get_the_excerpt();
        } else {
            $description = wp_strip_all_tags(mb_substr(get_post_field('post_content', $post_id), 0, 160));
        }

        $custom_keywords = get_post_meta($post_id, '_googleaitools_seo_keywords', true);
        if (!empty($custom_keywords)) $keywords = $custom_keywords;

        $custom_img = get_post_meta($post_id, '_googleaitools_seo_og_image', true);
        if (!empty($custom_img)) {
            $og_image = $custom_img;
        } elseif (has_post_thumbnail()) {
            $og_image = get_the_post_thumbnail_url($post_id, 'full');
        }

        $url = get_permalink($post_id);
    }

    // Dynamic SEO customization for single AI Tool Directory Profile (Clean URL /ai-directory/slug/ or fallback ?tool=)
    $selected_tool_for_seo = null;
    $tool_param = get_query_var('tool');
    if (empty($tool_param) && isset($_GET['tool'])) {
        $tool_param = sanitize_title($_GET['tool']);
    }

    if (!empty($tool_param)) {
        $tools_list = function_exists('googleaitools_get_directory_products') ? googleaitools_get_directory_products() : array();
        if (is_array($tools_list)) {
            foreach ($tools_list as $t) {
                if ($t['slug'] === $tool_param || strval($t['id']) === $tool_param || ($tool_param === 'gemini-4' && $t['slug'] === 'gemini-4-hydrogen')) {
                    $selected_tool_for_seo = $t;
                    $clean_cat = preg_replace('/^\d+\.\s*/', '', $t['category']);
                    $title = $t['name'] . ' (' . $t['formFactor'] . ') Review & Architecture Specs | ' . $site_name;
                    $description = 'In-depth review and architectural breakdown of ' . $t['name'] . ', ' . $t['summary'] . ' Explore capabilities, benchmarks, and Google AI synergy.';
                    $keywords = $t['name'] . ', ' . $t['name'] . ' AI, ' . $t['formFactor'] . ', ' . $clean_cat . ', AI tools directory, ' . $t['domain'];
                    $url = home_url('/ai-directory/' . $t['slug'] . '/');
                    $canonical_url = $url;
                    $og_image = !empty($t['logoUrl']) ? $t['logoUrl'] : $og_image;
                    $og_type = 'article';
                    break;
                }
            }
        }
    }

    // Dynamic SEO customization for LLM Models (Clean URL /models/{slug}/ or /models/category/{cat}/ or /models/)
    $selected_model_for_seo = null;
    $selected_model_cat_seo = null;
    $model_param = get_query_var('model');
    if (empty($model_param) && isset($_GET['model'])) {
        $model_param = sanitize_title($_GET['model']);
    }
    $models_cat_param = get_query_var('models_cat');
    if (empty($models_cat_param) && isset($_GET['category'])) {
        $models_cat_param = sanitize_title($_GET['category']);
    }

    $model_categories = function_exists('googleaitools_get_model_categories') ? googleaitools_get_model_categories() : array();
    
    // Check if model_param is a category or single model
    if (!empty($model_param) && isset($model_categories[$model_param])) {
        $selected_model_cat_seo = $model_categories[$model_param];
    } elseif (!empty($model_param) && function_exists('googleaitools_get_models_data')) {
        $all_m = googleaitools_get_models_data();
        foreach ($all_m as $m) {
            if ($m['slug'] === $model_param || $m['id'] === $model_param) {
                $selected_model_for_seo = $m;
                break;
            }
        }
    }

    if (!$selected_model_for_seo && !empty($models_cat_param) && isset($model_categories[$models_cat_param])) {
        $selected_model_cat_seo = $model_categories[$models_cat_param];
    }

    if ($selected_model_for_seo) {
        $title = $selected_model_for_seo['name'] . ' (' . $selected_model_for_seo['provider'] . ') Architecture & Benchmarks | ' . $site_name;
        $description = $selected_model_for_seo['name'] . ' by ' . $selected_model_for_seo['provider'] . ': ' . $selected_model_for_seo['tagline'] . ' Verified ' . $selected_model_for_seo['throughput'] . ' throughput, ' . $selected_model_for_seo['ttft'] . ' TTFT latency, and ' . $selected_model_for_seo['contextWindow'] . ' context window.';
        $keywords = $selected_model_for_seo['name'] . ', ' . $selected_model_for_seo['provider'] . ', ' . $selected_model_for_seo['categoryName'] . ', LLM models, AI models discover, openrouter benchmarks';
        $url = home_url('/models/' . $selected_model_for_seo['slug'] . '/');
        $canonical_url = $url;
        $og_type = 'article';
    } elseif ($selected_model_cat_seo) {
        $title = $selected_model_cat_seo['name'] . ' - Frontier AI Models & Performance Leaderboard | ' . $site_name;
        $description = 'Explore frontier ' . $selected_model_cat_seo['name'] . ' models. ' . $selected_model_cat_seo['description'] . ' Compare token throughput, latency, and pricing.';
        $keywords = $selected_model_cat_seo['name'] . ', AI models, LLM benchmarks, ' . $selected_model_cat_seo['slug'] . ' AI';
        $url = home_url('/models/category/' . $selected_model_cat_seo['slug'] . '/');
        $canonical_url = $url;
    } elseif (is_page('models') || (!empty($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/models') !== false)) {
        $title = 'Frontier LLMs & Multimodal Models Catalog - Open Benchmarks | ' . $site_name;
        $description = 'Discover frontier LLM and multimodal models across speech, coding, video, image, and reasoning. Real-time throughput (tok/s), latency, and value leaderboards.';
        $keywords = 'LLM models, AI models, OpenRouter discover, fastest models, value leaders, speech models, coding models, video models, image models';
        $url = home_url('/models/');
        $canonical_url = $url;
    }

    if (!empty($description)) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }

    if (!empty($keywords)) {
        echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n";
    }

    // OpenGraph Tags
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr($og_type) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";

    // Twitter Card Tags
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($og_image) . '">' . "\n";

    // 3. Schema.org JSON-LD Structured Data
    if (is_front_page() || is_home()) {
        $schema_website = array(
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'name'     => $site_name,
            'url'      => home_url('/'),
            'potentialAction' => array(
                '@type'       => 'SearchAction',
                'target'      => home_url('/?s={search_term_string}'),
                'query-input' => 'required name=search_term_string'
            )
        );
        $schema_org = array(
            '@context'     => 'https://schema.org',
            '@type'        => 'Organization',
            'name'         => $site_name,
            'url'          => home_url('/'),
            'logo'         => home_url('/assets/images/logo.png'),
            'email'        => 'contact@googleaitools.com',
            'contactPoint' => array(
                '@type'       => 'ContactPoint',
                'email'       => 'contact@googleaitools.com',
                'contactType' => 'customer support',
                'areaServed'  => 'Worldwide'
            )
        );
        echo '<script type="application/ld+json">' . json_encode($schema_website, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
        echo '<script type="application/ld+json">' . json_encode($schema_org, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    } elseif (is_singular('post')) {
        $post_id     = get_the_ID();
        $schema_type = get_post_meta($post_id, '_googleaitools_seo_schema_type', true) ?: 'TechArticle';

        $schema_article = array(
            '@context'      => 'https://schema.org',
            '@type'         => $schema_type,
            'headline'      => get_the_title($post_id),
            'description'   => $description,
            'image'         => $og_image,
            'datePublished' => get_the_date('c', $post_id),
            'dateModified'  => get_the_modified_date('c', $post_id),
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id'   => get_permalink($post_id)
            ),
            'author' => array(
                '@type' => 'Person',
                'name'  => get_the_author_meta('display_name', get_post_field('post_author', $post_id))
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name'  => $site_name,
                'url'   => home_url('/'),
                'email' => 'contact@googleaitools.com'
            )
        );

        $cats = get_the_category($post_id);
        $cat_name = !empty($cats) ? $cats[0]->name : 'AI Guides';
        $cat_url = !empty($cats) ? get_category_link($cats[0]->term_id) : home_url('/');

        $schema_breadcrumbs = array(
            '@context' => 'https://schema.org',
            '@type'    => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => home_url('/')
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => $cat_name,
                    'item'     => $cat_url
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 3,
                    'name'     => get_the_title($post_id),
                    'item'     => get_permalink($post_id)
                )
            )
        );

        echo '<script type="application/ld+json">' . json_encode($schema_article, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
        echo '<script type="application/ld+json">' . json_encode($schema_breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }

    if (!empty($selected_tool_for_seo)) {
        $clean_cat = preg_replace('/^\d+\.\s*/', '', $selected_tool_for_seo['category']);
        $schema_tool = array(
            '@context'            => 'https://schema.org',
            '@type'               => 'SoftwareApplication',
            'name'                => $selected_tool_for_seo['name'],
            'applicationCategory' => $clean_cat,
            'operatingSystem'     => 'All',
            'description'         => $selected_tool_for_seo['summary'],
            'url'                 => $selected_tool_for_seo['website'],
            'offers'              => array(
                '@type'    => 'Offer',
                'category' => $selected_tool_for_seo['formFactor']
            )
        );
        $schema_tool_breadcrumbs = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => home_url('/')
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'AI Directory',
                    'item'     => home_url('/ai-directory/')
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 3,
                    'name'     => $clean_cat,
                    'item'     => home_url('/ai-directory/')
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 4,
                    'name'     => $selected_tool_for_seo['name'],
                    'item'     => home_url('/ai-directory/' . $selected_tool_for_seo['slug'] . '/')
                )
            )
        );
        echo '<script type="application/ld+json">' . json_encode($schema_tool, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
        echo '<script type="application/ld+json">' . json_encode($schema_tool_breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }

    // JSON-LD Schema for Single LLM Model Profile
    if (!empty($selected_model_for_seo)) {
        $schema_model = array(
            '@context'            => 'https://schema.org',
            '@type'               => 'SoftwareApplication',
            'name'                => $selected_model_for_seo['name'],
            'applicationCategory' => $selected_model_for_seo['categoryName'],
            'operatingSystem'     => 'Cloud API, Python, REST, WebRTC',
            'description'         => $selected_model_for_seo['summary'],
            'url'                 => home_url('/models/' . $selected_model_for_seo['slug'] . '/'),
            'author'              => array(
                '@type' => 'Organization',
                'name'  => $selected_model_for_seo['provider']
            )
        );
        $schema_model_crumbs = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => home_url('/')
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'LLM Models',
                    'item'     => home_url('/models/')
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 3,
                    'name'     => $selected_model_for_seo['categoryName'],
                    'item'     => home_url('/models/category/' . $selected_model_for_seo['category'] . '/')
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 4,
                    'name'     => $selected_model_for_seo['name'],
                    'item'     => home_url('/models/' . $selected_model_for_seo['slug'] . '/')
                )
            )
        );
        echo '<script type="application/ld+json">' . json_encode($schema_model, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
        echo '<script type="application/ld+json">' . json_encode($schema_model_crumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }

    // JSON-LD Schema for Model Category / Collection
    if (!empty($selected_model_cat_seo)) {
        $schema_cat = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'CollectionPage',
            'name'        => $selected_model_cat_seo['name'],
            'description' => $selected_model_cat_seo['description'],
            'url'         => home_url('/models/category/' . $selected_model_cat_seo['slug'] . '/')
        );
        echo '<script type="application/ld+json">' . json_encode($schema_cat, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }

    $adsense_enabled = get_theme_mod('googleaitools_adsense_enabled', false);
    if ($adsense_enabled && !empty($pub_id) && $pub_id !== 'ca-pub-0000000000000000') {
        echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . esc_attr($pub_id) . '" crossorigin="anonymous"></script>' . "\n";
    }

    if (!empty($ga_id) && $ga_id !== 'G-0000000000') {
        echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr($ga_id) . '"></script>' . "\n";
        echo '<script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag("js", new Date());
            gtag("config", "' . esc_js($ga_id) . '");
        </script>' . "\n";
    }

    $custom_head = get_theme_mod('googleaitools_custom_header_scripts', '');
    if (!empty($custom_head)) {
        echo $custom_head . "\n";
    }
}
add_action('wp_head', 'googleaitools_inject_head_tags');

// Clean URL Rewrite Rules for AI Tool Profiles and LLM Models
add_action('init', function() {
    add_rewrite_rule(
        '^ai-directory/([^/]+)/?$',
        'index.php?pagename=ai-directory&tool=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^models/category/([^/]+)/?$',
        'index.php?pagename=models&models_cat=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^models/([^/]+)/?$',
        'index.php?pagename=models&model=$matches[1]',
        'top'
    );

    // Auto-flush rewrite rules if our rule is not yet present in active options
    $rules = get_option('rewrite_rules');
    if (!is_array($rules) || !isset($rules['^models/([^/]+)/?$']) || !isset($rules['^ai-directory/([^/]+)/?$'])) {
        flush_rewrite_rules(false);
    }
}, 10);

add_filter('query_vars', function($vars) {
    $vars[] = 'tool';
    $vars[] = 'model';
    $vars[] = 'models_cat';
    return $vars;
});

// Filter document title parts when viewing a single AI Tool profile or LLM Model
add_filter('document_title_parts', function($parts) {
    $tool_param = get_query_var('tool');
    if (empty($tool_param) && isset($_GET['tool'])) {
        $tool_param = sanitize_title($_GET['tool']);
    }
    if (!empty($tool_param)) {
        $tools_list = function_exists('googleaitools_get_directory_products') ? googleaitools_get_directory_products() : array();
        if (is_array($tools_list)) {
            foreach ($tools_list as $t) {
                if ($t['slug'] === $tool_param || strval($t['id']) === $tool_param || ($tool_param === 'gemini-4' && $t['slug'] === 'gemini-4-hydrogen')) {
                    $parts['title'] = $t['name'] . ' (' . $t['formFactor'] . ') Review & Architecture Specs';
                    return $parts;
                }
            }
        }
    }

    $model_param = get_query_var('model');
    if (empty($model_param) && isset($_GET['model'])) {
        $model_param = sanitize_title($_GET['model']);
    }
    $models_cat = get_query_var('models_cat');
    if (empty($models_cat) && isset($_GET['category'])) {
        $models_cat = sanitize_title($_GET['category']);
    }

    $model_categories = function_exists('googleaitools_get_model_categories') ? googleaitools_get_model_categories() : array();
    if (!empty($model_param) && isset($model_categories[$model_param])) {
        $parts['title'] = $model_categories[$model_param]['name'] . ' - Frontier AI Models & Performance';
        return $parts;
    }
    if (!empty($models_cat) && isset($model_categories[$models_cat])) {
        $parts['title'] = $model_categories[$models_cat]['name'] . ' - Frontier AI Models & Performance';
        return $parts;
    }
    if (!empty($model_param) && function_exists('googleaitools_get_models_data')) {
        $all_m = googleaitools_get_models_data();
        foreach ($all_m as $m) {
            if ($m['slug'] === $model_param || $m['id'] === $model_param) {
                $parts['title'] = $m['name'] . ' (' . $m['provider'] . ') Architecture & Benchmarks';
                return $parts;
            }
        }
    }
    if (is_page('models')) {
        $parts['title'] = 'Frontier LLMs & Multimodal Models Catalog - Open Benchmarks';
    }

    return $parts;
});

// Auto-ensure ALL 7 legal/compliance pages exist in the WordPress database (wp_posts) & flush permalinks
add_action('init', function() {
    $legal_pages = [
        'about' => [
            'title' => 'About Us',
            'content' => '<div class="callout-box"><div class="callout-title">⚠️ Non-Affiliation Notice</div><p>GoogleAITools.com is an independent blog. We are <strong>not affiliated with, endorsed by, sponsored by, or officially connected to Google LLC or Alphabet Inc.</strong> in any way.</p></div><h2>Our Mission</h2><p>GoogleAITools.com is an independent publication covering artificial intelligence tools, models, and platforms — with a particular focus on developments from Google, including Gemini, NotebookLM, Google AI Studio, Vertex AI, and other tools across Google\'s AI ecosystem, alongside broader coverage of the AI tools landscape.</p><h2>Get in Touch</h2><p>Questions, corrections, or tool suggestions? Reach us via our Contact Page or email us at <code>contact@googleaitools.com</code>.</p>'
        ],
        'contact' => [
            'title' => 'Contact Us',
            'content' => '<h2>Reach Out To Us</h2><p>Whether you have feedback on an article, want to report an outdated tool feature, privacy questions, legal concerns, trademark inquiries, or suggestions for future AI guides, reach out to our team:</p><ul style="margin: 16px 0; padding-left: 20px; line-height: 1.8;"><li><strong>General & Editorial Inquiries</strong>: <code>contact@googleaitools.com</code></li><li><strong>Privacy & Data Compliance</strong>: <code>contact@googleaitools.com</code></li><li><strong>Trademark & Legal Concerns</strong>: <code>contact@googleaitools.com</code></li><li><strong>Copyright & DMCA Notices</strong>: <code>contact@googleaitools.com</code></li><li><strong>AI Developer & Dataset Access</strong>: <code>contact@googleaitools.com</code></li></ul><div class="callout-box" style="margin: 24px 0; padding: 16px 20px; background: var(--bg-secondary); border-left: 4px solid var(--accent-color); border-radius: 8px;"><div class="callout-title" style="font-weight: 700; font-size: 1.05rem; margin-bottom: 6px;">📧 Official Email</div><p style="margin: 0;">For all communications, please email us directly at <code>contact@googleaitools.com</code>. We aim to respond to all legitimate inquiries within 24–48 business hours.</p></div>'
        ],
        'disclaimer' => [
            'title' => 'Disclaimer',
            'content' => '<div class="callout-box"><div class="callout-title">⚠️ Non-Affiliation Statement</div><p>GoogleAITools.com is an independent, privately operated website and is <strong>not affiliated with, endorsed by, sponsored by, or in any way officially connected with Google LLC, Alphabet Inc., or any of their subsidiaries or affiliates.</strong></p></div><h2>Trademark Notice</h2><p>All product names, logos, brands, and trademarks referenced on this site are the property of their respective owners. Contact us at <code>contact@googleaitools.com</code> for any inquiries.</p>'
        ],
        'privacy-policy' => [
            'title' => 'Privacy Policy',
            'content' => '<h2>1. Information We Collect</h2><p>GoogleAITools.com respects your privacy. We collect analytics and performance data to improve user experience.</p><h2>2. Cookies & Advertising</h2><p>We use Google AdSense and analytics. Contact us at <code>contact@googleaitools.com</code> for privacy inquiries.</p>'
        ],
        'terms' => [
            'title' => 'Terms of Use',
            'content' => '<h2>1. Acceptance of Terms</h2><p>By accessing GoogleAITools.com, you agree to these Terms of Use. Contact us at <code>contact@googleaitools.com</code> for any questions.</p>'
        ],
        'dmca' => [
            'title' => 'DMCA Policy',
            'content' => '<div class="callout-box"><div class="callout-title">⚖️ DMCA Copyright Notice & Takedown Policy</div><p>GoogleAITools.com respects intellectual property rights and complies fully with the DMCA. Send written notices to <code>contact@googleaitools.com</code>.</p></div><h2>1. Notification of Claimed Infringement</h2><p>If you believe your copyrighted work is infringed, submit a written notice to <code>contact@googleaitools.com</code> with required details.</p>'
        ],
        'llm-policy' => [
            'title' => 'LLM & AI Data Policy',
            'content' => '<div class="callout-box"><div class="callout-title">🤖 LLM & Artificial Intelligence Data Access Policy</div><p>GoogleAITools.com permits search engines, RAG pipelines, and Web LLMs to index content with proper attribution to <code>https://googleaitools.com</code>. Contact: <code>contact@googleaitools.com</code>.</p></div>'
        ]
    ];

    $created_or_updated = false;
    foreach ($legal_pages as $slug => $data) {
        $existing = get_posts(['name' => $slug, 'post_type' => 'page', 'post_status' => 'any']);
        if (empty($existing)) {
            wp_insert_post([
                'post_title'   => $data['title'],
                'post_name'    => $slug,
                'post_content' => $data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page'
            ]);
            $created_or_updated = true;
        } else {
            $post = $existing[0];
            if ($post->post_status !== 'publish') {
                wp_update_post([
                    'ID'          => $post->ID,
                    'post_status' => 'publish'
                ]);
                $created_or_updated = true;
            }
            if ($slug === 'contact' && (strpos($post->post_content, 'Send Us a Message') !== false || strpos($post->post_content, 'legal@googleaitools.com') !== false || strpos($post->post_content, '<form') !== false)) {
                wp_update_post([
                    'ID'           => $post->ID,
                    'post_content' => $data['content'],
                    'post_status'  => 'publish'
                ]);
                $created_or_updated = true;
            }
        }
    }

    // Auto-ensure AI Tools Directory Page exists with page-directory.php template
    $dir_page = get_posts(['name' => 'ai-directory', 'post_type' => 'page', 'post_status' => 'any']);
    if (empty($dir_page)) {
        $p_id = wp_insert_post([
            'post_title'   => 'AI Tools & Products Directory',
            'post_name'    => 'ai-directory',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        ]);
        if ($p_id && !is_wp_error($p_id)) {
            update_post_meta($p_id, '_wp_page_template', 'page-directory.php');
            $created_or_updated = true;
        }
    } else {
        $p = $dir_page[0];
        $current_tpl = get_post_meta($p->ID, '_wp_page_template', true);
        if ($current_tpl !== 'page-directory.php') {
            update_post_meta($p->ID, '_wp_page_template', 'page-directory.php');
        }
    }

    // Auto-ensure Frontier LLM Models Page exists with page-models.php template
    $models_page = get_posts(['name' => 'models', 'post_type' => 'page', 'post_status' => 'any']);
    if (empty($models_page)) {
        $m_id = wp_insert_post([
            'post_title'   => 'Frontier LLM & Multimodal Models Catalog',
            'post_name'    => 'models',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        ]);
        if ($m_id && !is_wp_error($m_id)) {
            update_post_meta($m_id, '_wp_page_template', 'page-models.php');
            $created_or_updated = true;
        }
    } else {
        $mp = $models_page[0];
        $current_mtpl = get_post_meta($mp->ID, '_wp_page_template', true);
        if ($current_mtpl !== 'page-models.php') {
            update_post_meta($mp->ID, '_wp_page_template', 'page-models.php');
        }
    }

    if ($created_or_updated) {
        flush_rewrite_rules();
    }
});

// Ensure Google AI Tools star favicon is served if no Customizer site icon is configured
add_filter('get_site_icon_url', function($url, $size, $blog_id) {
    if (empty($url)) {
        return get_template_directory_uri() . '/assets/images/favicon.svg';
    }
    return $url;
}, 10, 3);

// Disable WordPress default Twemoji replacement scripts that turn emoji characters into stretched <img> tags
add_action('init', function() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
});

/**
 * AJAX Handler for Interactive Tool "Ask AI" queries
 * Supports optional Gemini API key or signals local contextual knowledge engine
 */
add_action('wp_ajax_googleaitools_ask_ai', 'googleaitools_handle_ai_tool_query');
add_action('wp_ajax_nopriv_googleaitools_ask_ai', 'googleaitools_handle_ai_tool_query');

function googleaitools_handle_ai_tool_query() {
    $tool_name = isset($_POST['tool_name']) ? sanitize_text_field($_POST['tool_name']) : '';
    $tool_cat  = isset($_POST['tool_category']) ? sanitize_text_field($_POST['tool_category']) : '';
    $tool_form = isset($_POST['tool_form']) ? sanitize_text_field($_POST['tool_form']) : '';
    $query     = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    if (empty($tool_name) || empty($query)) {
        wp_send_json_error(array('message' => 'Missing tool name or question.'));
    }

    $gemini_key = get_option('googleaitools_gemini_api_key', '');
    if (empty($gemini_key) && defined('GEMINI_API_KEY')) {
        $gemini_key = GEMINI_API_KEY;
    }

    if (!empty($gemini_key)) {
        $prompt = "You are the AI Assistant on GoogleAITools.com. The user is asking about the AI tool '{$tool_name}' (Category: {$tool_cat}, Form Factor: {$tool_form}).\nUser Question: {$query}\n\nProvide a concise, expert, informative, and beautifully structured answer in markdown (use bullet points, bold key terms, keep it under 180 words, avoid fluff, and maintain high factual accuracy).";
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . urlencode($gemini_key);
        $response = wp_remote_post($url, array(
            'headers' => array('Content-Type' => 'application/json'),
            'body'    => json_encode(array(
                'contents' => array(
                    array('parts' => array(array('text' => $prompt)))
                )
            )),
            'timeout' => 8
        ));

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if (!empty($body['candidates'][0]['content']['parts'][0]['text'])) {
                $text = $body['candidates'][0]['content']['parts'][0]['text'];
                wp_send_json_success(array('answer' => $text, 'source' => 'gemini-live'));
            }
        }
    }

    // Fallback: Signal to client to use its rich contextual engine
    wp_send_json_success(array('use_contextual' => true));
}



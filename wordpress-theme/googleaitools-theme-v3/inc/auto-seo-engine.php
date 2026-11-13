<?php
/**
 * Fully Automated Universal SEO & AI Indexing Engine for googleaitools.com
 *
 * Automatically generates, updates, and synchronizes on every content change:
 * 1. sitemap.xml       (Complete 400+ URL XML Sitemap)
 * 2. news-sitemap.xml  (Google News XML Sitemap)
 * 3. feed.xml          (Real-time RSS 2.0 Feed)
 * 4. llms.txt          (Universal AI Model Index for Gemini, ChatGPT, Claude, Perplexity)
 * 5. IndexNow Pings    (Instant API submission to Bing, Yandex, Naver, Seznam)
 *
 * Hooks:
 * - save_post, publish_post, trashed_post, untrashed_post, deleted_post
 * - Daily scheduled cron job (googleaitools_daily_seo_cron)
 * - Dynamic fallback rewrite routing for all 4 endpoints
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. Build Main XML Sitemap (400+ URLs)
 */
function googleaitools_build_sitemap_xml() {
    $site_url = untrailingslashit(home_url());
    $today = date('Y-m-d');

    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // Core Hubs & Pages
    $core_pages = array(
        array('loc' => $site_url . '/', 'lastmod' => $today, 'freq' => 'daily', 'pri' => '1.0'),
        array('loc' => $site_url . '/ai-directory/', 'lastmod' => $today, 'freq' => 'daily', 'pri' => '0.9'),
        array('loc' => $site_url . '/models/', 'lastmod' => $today, 'freq' => 'daily', 'pri' => '0.9'),
        array('loc' => $site_url . '/about/', 'lastmod' => $today, 'freq' => 'monthly', 'pri' => '0.6'),
        array('loc' => $site_url . '/contact/', 'lastmod' => $today, 'freq' => 'monthly', 'pri' => '0.6'),
        array('loc' => $site_url . '/privacy-policy/', 'lastmod' => $today, 'freq' => 'yearly', 'pri' => '0.3'),
        array('loc' => $site_url . '/terms/', 'lastmod' => $today, 'freq' => 'yearly', 'pri' => '0.3'),
        array('loc' => $site_url . '/disclaimer/', 'lastmod' => $today, 'freq' => 'yearly', 'pri' => '0.3'),
    );

    foreach ($core_pages as $cp) {
        $xml .= "  <url>\n";
        $xml .= '    <loc>' . esc_url($cp['loc']) . "</loc>\n";
        $xml .= '    <lastmod>' . esc_html($cp['lastmod']) . "</lastmod>\n";
        $xml .= '    <changefreq>' . esc_html($cp['freq']) . "</changefreq>\n";
        $xml .= '    <priority>' . esc_html($cp['pri']) . "</priority>\n";
        $xml .= "  </url>\n";
    }

    // Published Blog Posts
    $posts = get_posts(array(
        'numberposts' => -1,
        'post_status' => 'publish',
        'post_type'   => 'post',
        'orderby'     => 'modified',
        'order'       => 'DESC',
    ));

    foreach ($posts as $post) {
        $mod_time = get_post_modified_time('Y-m-d', false, $post->ID);
        if (!$mod_time) {
            $mod_time = get_post_time('Y-m-d', false, $post->ID);
        }
        $xml .= "  <url>\n";
        $xml .= '    <loc>' . esc_url(get_permalink($post->ID)) . "</loc>\n";
        $xml .= '    <lastmod>' . esc_html($mod_time ? $mod_time : $today) . "</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>0.8</priority>\n";
        $xml .= "  </url>\n";
    }

    // AI Directory Tools (All 292 products)
    if (function_exists('googleaitools_get_products')) {
        $products = googleaitools_get_products();
        foreach ($products as $pr) {
            if (empty($pr['slug'])) continue;
            $tool_url = $site_url . '/ai-directory/' . $pr['slug'] . '/';
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . esc_url($tool_url) . "</loc>\n";
            $xml .= '    <lastmod>' . esc_html($today) . "</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.7</priority>\n";
            $xml .= "  </url>\n";
        }
    }

    // Frontier Models & LLMs
    if (function_exists('googleaitools_get_models_data')) {
        $models = googleaitools_get_models_data();
    } elseif (function_exists('googleaitools_get_models_list')) {
        $models = googleaitools_get_models_list();
    } else {
        $models = array();
    }
    foreach ($models as $m) {
            if (empty($m['slug'])) continue;
            $model_url = $site_url . '/models/' . $m['slug'] . '/';
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . esc_url($model_url) . "</loc>\n";
            $xml .= '    <lastmod>' . esc_html($today) . "</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";
            $xml .= "  </url>\n";
    }

    // Post Categories
    $categories = get_categories(array('hide_empty' => true));
    foreach ($categories as $cat) {
        $cat_url = get_category_link($cat->term_id);
        if ($cat_url && !is_wp_error($cat_url)) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . esc_url($cat_url) . "</loc>\n";
            $xml .= '    <lastmod>' . esc_html($today) . "</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.6</priority>\n";
            $xml .= "  </url>\n";
        }
    }

    $xml .= '</urlset>';
    return $xml;
}

/**
 * 2. Build Google News XML Sitemap
 */
function googleaitools_build_news_sitemap_xml() {
    $site_name = get_bloginfo('name');
    if (empty($site_name)) $site_name = 'Google AI Tools';

    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
    $xml .= '        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";

    // Recent posts from last 30 days
    $recent_posts = get_posts(array(
        'numberposts' => 50,
        'post_status' => 'publish',
        'post_type'   => 'post',
        'orderby'     => 'date',
        'order'       => 'DESC',
    ));

    foreach ($recent_posts as $post) {
        $pub_date = get_the_date('c', $post->ID);
        $title = get_the_title($post->ID);
        $url = get_permalink($post->ID);

        $xml .= "  <url>\n";
        $xml .= '    <loc>' . esc_url($url) . "</loc>\n";
        $xml .= "    <news:news>\n";
        $xml .= "      <news:publication>\n";
        $xml .= '        <news:name>' . esc_html($site_name) . "</news:name>\n";
        $xml .= "        <news:language>en</news:language>\n";
        $xml .= "      </news:publication>\n";
        $xml .= '      <news:publication_date>' . esc_html($pub_date) . "</news:publication_date>\n";
        $xml .= '      <news:title>' . esc_html($title) . "</news:title>\n";
        $xml .= "    </news:news>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';
    return $xml;
}

/**
 * 3. Build RSS 2.0 Feed (feed.xml)
 */
function googleaitools_build_rss_feed_xml() {
    $site_url = home_url();
    $site_name = get_bloginfo('name');
    $site_desc = get_bloginfo('description');
    if (empty($site_name)) $site_name = 'Google AI Tools';
    if (empty($site_desc)) $site_desc = 'Independent coverage and practical tutorials for artificial intelligence tools and models.';

    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
    $xml .= "  <channel>\n";
    $xml .= '    <title>' . esc_html($site_name) . "</title>\n";
    $xml .= '    <link>' . esc_url($site_url) . "</link>\n";
    $xml .= '    <description>' . esc_html($site_desc) . "</description>\n";
    $xml .= '    <atom:link href="' . esc_url($site_url . '/feed.xml') . '" rel="self" type="application/rss+xml" />' . "\n";
    $xml .= "    <language>en-us</language>\n";
    $xml .= '    <lastBuildDate>' . date(DATE_RSS) . "</lastBuildDate>\n";

    $posts = get_posts(array(
        'numberposts' => 30,
        'post_status' => 'publish',
        'post_type'   => 'post',
        'orderby'     => 'date',
        'order'       => 'DESC',
    ));

    foreach ($posts as $post) {
        $xml .= "    <item>\n";
        $xml .= '      <title>' . esc_html(get_the_title($post->ID)) . "</title>\n";
        $xml .= '      <link>' . esc_url(get_permalink($post->ID)) . "</link>\n";
        $xml .= '      <guid isPermaLink="true">' . esc_url(get_permalink($post->ID)) . "</guid>\n";
        $xml .= '      <pubDate>' . esc_html(get_the_date(DATE_RSS, $post->ID)) . "</pubDate>\n";
        $xml .= '      <description>' . esc_html(wp_strip_all_tags(get_the_excerpt($post->ID))) . "</description>\n";
        $xml .= "    </item>\n";
    }

    $xml .= "  </channel>\n";
    $xml .= '</rss>';
    return $xml;
}

/**
 * 4. Build llms.txt (Universal AI Model Directive)
 */
function googleaitools_build_llms_txt() {
    $site_url = untrailingslashit(home_url());

    $txt  = "# Google AI Tools (googleaitools.com)\n\n";
    $txt .= "> Independent directory, benchmark evaluations, and architectural reviews of artificial intelligence models, developer APIs, foundation LLMs, and enterprise tools.\n\n";
    $txt .= "Website: {$site_url}\n";
    $txt .= "Sitemap: {$site_url}/sitemap.xml\n";
    $txt .= "Google News Feed: {$site_url}/news-sitemap.xml\n";
    $txt .= "RSS Feed: {$site_url}/feed.xml\n\n";

    $txt .= "## Core Directories & Hubs\n";
    $txt .= "- [AI Tools Directory]({$site_url}/ai-directory/): 292+ curated AI tools across 11 industry domains (Coding, Video, Audio, Agents, Biotech, Business Automation).\n";
    $txt .= "- [Frontier LLMs & Models]({$site_url}/models/): Benchmark specifications, context windows, and throughput metrics for Gemini 4, Gemini 2.5 Pro, Claude 3.7 Sonnet, GPT-4o, DeepSeek-R1, and Llama 3.3.\n";
    $txt .= "- [About Editorial Charter]({$site_url}/about/): Independent editorial disclosures and research standards.\n";
    $txt .= "- [Contact & Submissions]({$site_url}/contact/): Submitting tool listings and benchmark verification.\n\n";

    $txt .= "## Featured Foundation Models\n";
    if (function_exists('googleaitools_get_models_data')) {
        $models = googleaitools_get_models_data();
    } elseif (function_exists('googleaitools_get_models_list')) {
        $models = googleaitools_get_models_list();
    } else {
        $models = array();
    }
    $top_models = array_slice($models, 0, 20);
    foreach ($top_models as $m) {
        $txt .= "- **{$m['name']}** ({$m['provider']}): {$m['contextWindow']} context, {$m['throughput']}. {$m['tagline']} [Model Specs]({$site_url}/models/{$m['slug']}/)\n";
    }

    $txt .= "\n## Latest Published Guides & Reviews\n";
    $posts = get_posts(array(
        'numberposts' => 25,
        'post_status' => 'publish',
        'post_type'   => 'post',
        'orderby'     => 'date',
        'order'       => 'DESC',
    ));
    foreach ($posts as $p) {
        $txt .= "- [{$p->post_title}](" . get_permalink($p->ID) . "): " . wp_trim_words(wp_strip_all_tags($p->post_content), 20, '...') . "\n";
    }

    return $txt;
}

/**
 * 5. Instant IndexNow Notification
 */
function googleaitools_ping_indexnow($urls = array()) {
    $site_url = home_url();
    $host = wp_parse_url($site_url, PHP_URL_HOST);

    if (empty($urls)) {
        $urls = array($site_url . '/');
    }

    $key = 'googleaitools';
    $payload = array(
        'host'        => $host,
        'key'         => $key,
        'keyLocation' => $site_url . '/googleaitools.txt',
        'urlList'     => array_values(array_unique($urls)),
    );

    wp_remote_post('https://api.indexnow.org/indexnow', array(
        'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
        'body'        => wp_json_encode($payload),
        'timeout'     => 5,
        'blocking'    => false, // Non-blocking so post save is instant!
    ));
}

/**
 * 6. Refresh All SEO & AI Files on Disk
 */
function googleaitools_refresh_all_seo_files($modified_url = '') {
    $sitemap_path = ABSPATH . 'sitemap.xml';
    $news_path    = ABSPATH . 'news-sitemap.xml';
    $feed_path    = ABSPATH . 'feed.xml';
    $llms_path    = ABSPATH . 'llms.txt';
    $key_path     = ABSPATH . 'googleaitools.txt';

    // Generate contents
    $sitemap_xml = googleaitools_build_sitemap_xml();
    $news_xml    = googleaitools_build_news_sitemap_xml();
    $feed_xml    = googleaitools_build_rss_feed_xml();
    $llms_txt    = googleaitools_build_llms_txt();

    // Safely write to disk if writable
    @file_put_contents($sitemap_path, $sitemap_xml, LOCK_EX);
    @file_put_contents($news_path, $news_xml, LOCK_EX);
    @file_put_contents($feed_path, $feed_xml, LOCK_EX);
    @file_put_contents($llms_path, $llms_txt, LOCK_EX);
    @file_put_contents($key_path, 'googleaitools', LOCK_EX);

    // Notify IndexNow immediately
    $urls_to_ping = array(
        home_url('/'),
        home_url('/sitemap.xml'),
        home_url('/feed.xml'),
    );
    if (!empty($modified_url)) {
        $urls_to_ping[] = $modified_url;
    }
    googleaitools_ping_indexnow($urls_to_ping);
}

/**
 * 7. Automatic WordPress Hooks
 */

// On Post Publish or Update
add_action('save_post', function($post_id, $post, $update) {
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id) || $post->post_status !== 'publish') {
        return;
    }
    $url = get_permalink($post_id);
    googleaitools_refresh_all_seo_files($url);
}, 10, 3);

// On Post Trash / Delete
add_action('trashed_post', function($post_id) {
    googleaitools_refresh_all_seo_files();
});
add_action('untrashed_post', function($post_id) {
    googleaitools_refresh_all_seo_files(get_permalink($post_id));
});
add_action('deleted_post', function($post_id) {
    googleaitools_refresh_all_seo_files();
});

// Daily Cron Event
add_action('googleaitools_daily_seo_cron', function() {
    googleaitools_refresh_all_seo_files();
});

/**
 * 8. Rewrite Rules & Dynamic Delivery Handlers
 */
add_action('init', function() {
    add_rewrite_rule('^sitemap\.xml$', 'index.php?googleaitools_endpoint=sitemap', 'top');
    add_rewrite_rule('^news-sitemap\.xml$', 'index.php?googleaitools_endpoint=news_sitemap', 'top');
    add_rewrite_rule('^feed\.xml$', 'index.php?googleaitools_endpoint=feed', 'top');
    add_rewrite_rule('^llms\.txt$', 'index.php?googleaitools_endpoint=llms', 'top');
    add_rewrite_rule('^googleaitools\.txt$', 'index.php?googleaitools_endpoint=key', 'top');

    if (!wp_next_scheduled('googleaitools_daily_seo_cron')) {
        wp_schedule_event(time(), 'daily', 'googleaitools_daily_seo_cron');
    }
});

add_filter('query_vars', function($vars) {
    $vars[] = 'googleaitools_endpoint';
    return $vars;
});

add_action('template_redirect', function() {
    $endpoint = get_query_var('googleaitools_endpoint');
    if (!$endpoint) return;

    if ($endpoint === 'sitemap') {
        header('Content-Type: application/xml; charset=utf-8');
        header('X-Robots-Tag: noindex, follow');
        header('Cache-Control: public, max-age=3600');
        echo googleaitools_build_sitemap_xml();
        exit;
    }

    if ($endpoint === 'news_sitemap') {
        header('Content-Type: application/xml; charset=utf-8');
        header('X-Robots-Tag: noindex, follow');
        header('Cache-Control: public, max-age=1800');
        echo googleaitools_build_news_sitemap_xml();
        exit;
    }

    if ($endpoint === 'feed') {
        header('Content-Type: application/rss+xml; charset=utf-8');
        header('Cache-Control: public, max-age=1800');
        echo googleaitools_build_rss_feed_xml();
        exit;
    }

    if ($endpoint === 'llms') {
        header('Content-Type: text/plain; charset=utf-8');
        header('Cache-Control: public, max-age=3600');
        echo googleaitools_build_llms_txt();
        exit;
    }

    if ($endpoint === 'key') {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'googleaitools';
        exit;
    }
});

<?php
/**
 * Dynamic Website Content & Pages Importer for WordPress
 */

if (!defined('ABSPATH')) exit;

function googleaitools_register_importer_page() {
    add_theme_page(
        'Import Website Content',
        'Import Website Content',
        'manage_options',
        'googleaitools-import',
        'googleaitools_render_importer_page'
    );
}
add_action('admin_menu', 'googleaitools_register_importer_page');

function googleaitools_render_importer_page() {
    if (isset($_POST['run_googleaitools_import']) && check_admin_referer('googleaitools_import_action', 'googleaitools_import_nonce')) {
        googleaitools_execute_content_import();
    }
    ?>
    <div class="wrap">
        <h1>📦 Complete Website Pages & Posts Importer</h1>
        <p>Imports/Updates all 7 compliance & legal pages (About Us, Contact Us, Disclaimer, Privacy Policy, Terms of Use, DMCA Policy, LLM Policy) AND all blog posts into your WordPress database.</p>

        <form method="post">
            <?php wp_nonce_field('googleaitools_import_action', 'googleaitools_import_nonce'); ?>
            <input type="submit" name="run_googleaitools_import" class="button button-primary button-hero" value="🚀 Force Import / Sync All Pages & Posts Now">
        </form>
    </div>
    <?php
}

function googleaitools_execute_content_import() {
    // 1. IMPORT STATIC PAGES (About, Contact, Disclaimer, Privacy Policy, Terms, DMCA, LLM Policy)
    $pages_to_import = [
        [
            'title' => 'About Us',
            'slug' => 'about',
            'content' => '
<div class="callout-box">
  <div class="callout-title">⚠️ Non-Affiliation Notice</div>
  <p>GoogleAITools.com is an independent blog. We are <strong>not affiliated with, endorsed by, sponsored by, or officially connected to Google LLC or Alphabet Inc.</strong> in any way.</p>
</div>

<h2>Our Mission</h2>
<p>GoogleAITools.com is an independent publication covering artificial intelligence tools, models, and platforms — with a particular focus on developments from Google, including Gemini, NotebookLM, Google AI Studio, Vertex AI, and other tools across Google\'s AI ecosystem, alongside broader coverage of the AI tools landscape.</p>

<p>We started this site because AI is moving fast — new models, features, and tools are released constantly, and it\'s hard to keep up. Our goal is to make that easier: clear write-ups, comparisons, and practical guides on the AI tools that matter, written for people who want to actually use these tools, not just read about them in press releases.</p>

<h2>What You\'ll Find Here</h2>
<ul>
  <li>Coverage of new AI model releases and updates (Google and other major AI labs)</li>
  <li>Guides and how-tos for using popular AI tools</li>
  <li>Comparisons between AI tools and platforms</li>
  <li>News and analysis on the fast-moving AI tools space</li>
  <li>Curated lists of useful AI websites and tools by category</li>
</ul>

<h2>Independence & Trademark Disclaimer</h2>
<p>GoogleAITools.com is an independently operated blog. We are <strong>not affiliated with, endorsed by, sponsored by, or officially connected to Google LLC or Alphabet Inc.</strong> in any way. "Google" and all related trademarks, logos, and product names (including Gemini, NotebookLM, and others) are the property of Google LLC. We reference them here solely for descriptive, editorial, and informational purposes, under fair use / nominative use principles, to report on and discuss publicly available products and updates.</p>

<h2>Our Editorial Approach</h2>
<p>We aim to be accurate and timely, but AI tools change quickly — features get renamed, pricing changes, and products get deprecated. If you spot something outdated on the site, please contact us and we\'ll correct it promptly.</p>

<h2>Get in Touch</h2>
<p>Questions, corrections, or tool suggestions? Reach us via our Contact Page or email us at <code>contact@googleaitools.com</code>.</p>'
        ],
        [
            'title' => 'Contact Us',
            'slug' => 'contact',
            'content' => '
<h2>Reach Out To Us</h2>
<p>Whether you have feedback on an article, want to report an outdated tool feature, privacy questions, legal concerns, trademark inquiries, or suggestions for future AI guides, reach out to our team:</p>

<ul style="margin: 16px 0; padding-left: 20px; line-height: 1.8;">
  <li><strong>General & Editorial Inquiries</strong>: <code>contact@googleaitools.com</code></li>
  <li><strong>Privacy & Data Compliance</strong>: <code>contact@googleaitools.com</code></li>
  <li><strong>Trademark & Legal Concerns</strong>: <code>contact@googleaitools.com</code></li>
  <li><strong>Copyright & DMCA Notices</strong>: <code>contact@googleaitools.com</code></li>
  <li><strong>AI Developer & Dataset Access</strong>: <code>contact@googleaitools.com</code></li>
</ul>

<div class="callout-box" style="margin: 24px 0; padding: 16px 20px; background: var(--bg-secondary); border-left: 4px solid var(--accent-color); border-radius: 8px;">
  <div class="callout-title" style="font-weight: 700; font-size: 1.05rem; margin-bottom: 6px;">📧 Official Email</div>
  <p style="margin: 0;">For all communications, please email us directly at <code>contact@googleaitools.com</code>. We aim to respond to all legitimate inquiries within 24–48 business hours.</p>
</div>'
        ],
        [
            'title' => 'Disclaimer',
            'slug' => 'disclaimer',
            'content' => '
<div class="callout-box">
  <div class="callout-title">⚠️ Non-Affiliation Statement</div>
  <p>GoogleAITools.com is an independent, privately operated website and is <strong>not affiliated with, endorsed by, sponsored by, or in any way officially connected with Google LLC, Alphabet Inc., or any of their subsidiaries or affiliates.</strong></p>
</div>

<h2>Trademark Notice</h2>
<p>All product names, logos, brands, and trademarks referenced on this site — including "Google," "Gemini," "NotebookLM," "Vertex AI," "Google AI Studio," "Gemma," "Veo," "Imagen," and others — are the property of their respective owners. Use of these names, logos, and brands does not imply endorsement or affiliation.</p>

<h2>Fair Use & Editorial Purpose</h2>
<p>This site provides independent commentary, news coverage, tutorials, and reviews relating to publicly available AI tools and products. All trademarks mentioned are used for identification and reference purposes only under fair use and nominative fair use principles.</p>

<h2>Advertising & Affiliate Disclosure</h2>
<p>GoogleAITools.com may display advertisements served by Google AdSense and third-party ad networks. We may also participate in affiliate programs and earn a commission from qualifying purchases made through links on this site at no additional cost to you. This does not influence our editorial assessments, reviews, or recommendations.</p>

<h2>Contact for Trademark Holders</h2>
<p>If you are a trademark holder and believe content on this site misrepresents affiliation or misuses your mark, please contact us at <code>contact@googleaitools.com</code> or via our Contact Page and we will review and address the concern promptly.</p>'
        ],
        [
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => '
<h2>1. Information We Collect</h2>
<p>GoogleAITools.com ("we", "us", or "our") respects your privacy. When you visit our website, we may collect certain information automatically, including your IP address, browser type, device specifications, operating system, referring URLs, and pages viewed during your visit.</p>

<h2>2. Cookies & Third-Party Advertising (Google AdSense)</h2>
<p>We use third-party advertising companies, including <strong>Google AdSense</strong>, to serve ads when you visit our website. These companies may use cookies, web beacons, and similar technologies (including the DoubleClick cookie) to collect information about your visits to this and other websites in order to provide targeted advertisements about goods and services of interest to you.</p>

<p>Google\'s use of advertising cookies enables it and its partners to serve ads to users based on their visit to our site and/or other sites on the Internet. Users may opt out of personalized advertising by visiting Google Ads Settings or aboutads.info.</p>

<h2>3. Web Analytics (Google Analytics)</h2>
<p>We use <strong>Google Analytics</strong> to monitor and analyze traffic patterns and site usage. Google Analytics uses cookies to track user interactions. The information generated by cookies about your use of the website is transmitted to and stored by Google on servers worldwide.</p>

<h2>4. User Rights & Data Protection (DPDP, GDPR & CCPA)</h2>
<p>Depending on your location (including India\'s Digital Personal Data Protection Act, EU GDPR, and California CCPA), you have rights regarding your personal data, including the right to access, rectify, delete, or restrict the processing of your data.</p>

<h2>5. Third-Party Links & External Sites</h2>
<p>Our blog posts may contain links to external third-party websites, tools, or documentation. We are not responsible for the privacy practices, content, or policies of those third-party sites.</p>

<h2>6. Contact Us</h2>
<p>If you have questions about this Privacy Policy, please contact us at <code>contact@googleaitools.com</code>.</p>'
        ],
        [
            'title' => 'Terms of Use',
            'slug' => 'terms',
            'content' => '
<h2>1. Acceptance of Terms</h2>
<p>By accessing or using GoogleAITools.com ("Site"), you agree to be bound by these Terms of Use and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this Site.</p>

<h2>2. Description of Service</h2>
<p>GoogleAITools.com is an independent blog providing news, analysis, tutorials, comparisons, and reviews relating to artificial intelligence models and tools. The Site is provided for informational, educational, and editorial purposes only.</p>

<h2>3. Intellectual Property Rights</h2>
<p>All original content published on this Site — including text, code examples, articles, and layout — is protected by copyright laws. All third-party product names, trademarks, and logos (such as "Google," "Gemini," "NotebookLM") belong exclusively to their respective owners.</p>

<h2>4. Limitation of Liability</h2>
<p>In no event shall GoogleAITools.com, its owners, or contributors be liable for any damages arising out of the use or inability to use the content or third-party tools reviewed on this Site.</p>'
        ],
        [
            'title' => 'DMCA Policy',
            'slug' => 'dmca',
            'content' => '
<div class="callout-box">
  <div class="callout-title">⚖️ DMCA Copyright Notice & Takedown Policy</div>
  <p>GoogleAITools.com respects the intellectual property rights of creators, authors, developers, and organizations. We comply fully with the Digital Millennium Copyright Act (DMCA) and international copyright standards.</p>
</div>

<h2>1. Notification of Claimed Copyright Infringement</h2>
<p>If you believe that your copyrighted work has been copied or used on GoogleAITools.com in a way that constitutes copyright infringement, please submit a written DMCA takedown notice to our designated Copyright Agent at <code>contact@googleaitools.com</code>.</p>

<p>Your notification must include the following information:</p>
<ol>
  <li>A physical or electronic signature of a person authorized to act on behalf of the owner of the copyright interest that is allegedly infringed.</li>
  <li>Identification of the copyrighted work claimed to have been infringed, or a representative list of such works.</li>
  <li>Identification of the material that is claimed to be infringing or subject of infringing activity, including specific URLs on GoogleAITools.com.</li>
  <li>Your contact details: full name, physical address, telephone number, and email address.</li>
  <li>A statement of good faith belief that use of the material is not authorized by the copyright owner, its agent, or the law.</li>
  <li>A statement that the information is accurate, under penalty of perjury.</li>
</ol>

<h2>2. Counter-Notification Procedures</h2>
<p>If material you posted was removed or disabled due to a DMCA notice by mistake, you may send a written counter-notification to <code>contact@googleaitools.com</code> containing your contact info, signature, identification of removed material, and statement under penalty of perjury.</p>

<h2>3. Repeat Infringer Policy</h2>
<p>GoogleAITools.com reserves the right to terminate access or content privileges of users who repeatedly infringe intellectual property rights.</p>'
        ],
        [
            'title' => 'LLM & AI Data Policy',
            'slug' => 'llm-policy',
            'content' => '
<div class="callout-box">
  <div class="callout-title">🤖 LLM & Artificial Intelligence Data Access Policy</div>
  <p>GoogleAITools.com welcomes web crawlers, search indexing engines, Retrieval-Augmented Generation (RAG) pipelines, and AI assistants. This policy outlines our machine-reading standards and attribution rules.</p>
</div>

<h2>1. Machine Reading & RAG Ingestion</h2>
<p>Artificial Intelligence search tools, generative answer engines (such as Perplexity, ChatGPT, Claude, Gemini, and Apple Intelligence), and Web LLM crawlers are explicitly permitted to index and synthesize content from GoogleAITools.com under the following conditions:</p>
<ul>
  <li><strong>Citation & Attribution:</strong> Any AI system providing direct answer summaries sourced from our guides or articles must provide an explicit web citation and clickable backlink to the original source URL on <code>https://googleaitools.com</code>.</li>
  <li><strong>Data Integrity:</strong> AI models must not alter, distort, or misrepresent our non-affiliation disclaimers regarding Google LLC and Alphabet Inc.</li>
  <li><strong>Structured AI Data Files:</strong> For optimized parsing, developers and AI agents should utilize our official plain text data feeds:
    <ul>
      <li><a href="/llms.txt"><code>/llms.txt</code></a> — High-level site summary, page directory, and core article links adhering to the llms.txt standard.</li>
      <li><a href="/llms-full.txt"><code>/llms-full.txt</code></a> — Complete structured text dataset containing full articles, tutorials, and technical reference material.</li>
      <li><a href="/robots.txt"><code>/robots.txt</code></a> — Standard crawler permissions and Sitemap directives.</li>
    </ul>
  </li>
</ul>

<h2>2. Prohibited AI Uses</h2>
<ul>
  <li>Impersonation of the GoogleAITools.com brand or editorial voice without explicit authorization.</li>
  <li>Automated high-frequency scraping that bypasses standard rate limits or impacts site responsiveness.</li>
  <li>Misrepresenting independent review content as official Google documentation or advice.</li>
</ul>

<h2>3. Contact for AI Developers</h2>
<p>If you are an AI developer or data curation team seeking bulk datasets or custom licensing agreements, contact us at <code>contact@googleaitools.com</code>.</p>'
        ]
    ];

    $page_count = 0;
    foreach ($pages_to_import as $pg) {
        $existing = get_posts(['name' => $pg['slug'], 'post_type' => 'page', 'post_status' => 'any']);
        $post_id_to_update = 0;
        if (!empty($existing)) {
            $post_id_to_update = $existing[0]->ID;
        }

        $page_id = wp_insert_post([
            'ID'           => $post_id_to_update,
            'post_title'   => $pg['title'],
            'post_name'    => $pg['slug'],
            'post_content' => $pg['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page'
        ]);
        if ($page_id && !is_wp_error($page_id)) $page_count++;
    }

    // 2. IMPORT BLOG POSTS
    $default_posts = [
        'how-to-use-gemini-15-flash' => ['title' => 'How to Use Gemini 1.5 Flash', 'cat' => 'Multimodal AI', 'icon' => '✨', 'readTime' => '6 min read', 'excerpt' => 'A beginner guide to building fast applications with Gemini 1.5 Flash.'],
        'getting-started-with-gemini-1-5-pro' => ['title' => 'Getting Started with Gemini 1.5 Pro: The 2 Million Token Context Revolution', 'cat' => 'Multimodal AI', 'icon' => '✨', 'readTime' => '8 min read', 'excerpt' => 'Explore how Google’s Gemini 1.5 Pro enables seamless analysis across 2 million tokens.'],
        'notebooklm-ai-research-guide' => ['title' => 'NotebookLM Ultimate Guide: Transform Notes & PDFs into Audio Overviews', 'cat' => 'Research & Productivity', 'icon' => '📓', 'readTime' => '6 min read', 'excerpt' => 'How Google NotebookLM uses Gemini 1.5 to generate podcast audio overviews.'],
        'imagen-3-prompt-engineering-tips' => ['title' => 'Imagen 3 Prompt Engineering Masterclass: Photorealistic AI Image Generation', 'cat' => 'Image & Video AI', 'icon' => '🖼️', 'readTime' => '7 min read', 'excerpt' => 'Master Google Imagen 3 with advanced lighting and prompt strategies.'],
        'google-veo-video-generation-tutorial' => ['title' => 'Google Veo Deep Dive: High-Definition 1080p AI Video Generation', 'cat' => 'Image & Video AI', 'icon' => '🎥', 'readTime' => '10 min read', 'excerpt' => 'Google Veo brings generative video to Hollywood standards.'],
        'gemma-open-source-ai-models-guide' => ['title' => 'Gemma 2 Open Models: Fine-Tuning Lightweight AI on Local Hardware', 'cat' => 'Open Source Models', 'icon' => '⚡', 'readTime' => '9 min read', 'excerpt' => 'Deploying and fine-tuning Google Gemma 2 2B, 9B, and 27B open weights models locally.'],
        'article-1' => ['title' => 'Article 1 Guide', 'cat' => 'General AI', 'icon' => '📝', 'readTime' => '5 min read', 'excerpt' => 'Comprehensive AI guide and tutorial.']
    ];

    $post_count = 0;
    foreach ($default_posts as $slug => $data) {
        $cat_id = 1;
        $term = get_term_by('name', $data['cat'], 'category');
        if ($term) {
            $cat_id = $term->term_id;
        } else {
            $cat_term = wp_insert_term($data['cat'], 'category');
            if (!is_wp_error($cat_term)) $cat_id = $cat_term['term_id'];
        }

        $existing = get_posts(['name' => $slug, 'post_type' => 'post', 'post_status' => 'any']);
        $post_id_to_update = 0;
        if (!empty($existing)) {
            $post_id_to_update = $existing[0]->ID;
        }

        $post_id = wp_insert_post([
            'ID'           => $post_id_to_update,
            'post_title'   => $data['title'],
            'post_name'    => $slug,
            'post_content' => '<p>' . esc_html($data['excerpt']) . '</p><p>Welcome to our comprehensive guide on ' . esc_html($data['title']) . '.</p>',
            'post_excerpt' => $data['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_category'=> [$cat_id]
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_googleaitools_icon_emoji', $data['icon']);
            update_post_meta($post_id, '_googleaitools_read_time', $data['readTime']);
            update_post_meta($post_id, '_googleaitools_seo_title', $data['title']);
            update_post_meta($post_id, '_googleaitools_seo_description', $data['excerpt']);
            $post_count++;
        }
    }

    echo "<div class='notice notice-success'><p>🎉 Successfully created/updated ALL {$page_count} Pages (About Us, Contact Us, Disclaimer, Privacy Policy, Terms of Use, DMCA Policy, LLM & AI Data Policy) AND {$post_count} Blog Articles in WordPress!</p></div>";
}

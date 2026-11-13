<?php
/**
 * Custom Post Meta Boxes for Article SEO & OpenGraph Overrides
 */

if (!defined('ABSPATH')) exit;

function googleaitools_add_seo_meta_boxes() {
    add_meta_box(
        'googleaitools_seo_box',
        '🔍 Google SEO, OpenGraph & Featured Image Overrides',
        'googleaitools_render_seo_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'googleaitools_add_seo_meta_boxes');

function googleaitools_render_seo_meta_box($post) {
    wp_nonce_field('googleaitools_save_seo_meta', 'googleaitools_seo_nonce');

    $seo_title = get_post_meta($post->ID, '_googleaitools_seo_title', true);
    $seo_description = get_post_meta($post->ID, '_googleaitools_seo_description', true);
    $seo_keywords = get_post_meta($post->ID, '_googleaitools_seo_keywords', true);
    $seo_og_image = get_post_meta($post->ID, '_googleaitools_seo_og_image', true);
    $seo_canonical = get_post_meta($post->ID, '_googleaitools_seo_canonical', true);
    $seo_schema_type = get_post_meta($post->ID, '_googleaitools_seo_schema_type', true) ?: 'BlogPosting';
    $seo_robots = get_post_meta($post->ID, '_googleaitools_seo_robots', true) ?: 'index, follow';
    $icon_emoji = get_post_meta($post->ID, '_googleaitools_icon_emoji', true) ?: '✨';
    $read_time = get_post_meta($post->ID, '_googleaitools_read_time', true) ?: '6 min read';
    $has_thumb = has_post_thumbnail($post->ID);
    ?>
    <style>
        .g-meta-field { margin-bottom: 16px; }
        .g-meta-field label { font-weight: 600; display: block; margin-bottom: 4px; }
        .g-meta-field input, .g-meta-field select, .g-meta-field textarea { width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc; }
        .g-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    </style>

    <div class="g-meta-grid">
        <div class="g-meta-field">
            <label for="googleaitools_icon_emoji">Icon Emoji</label>
            <input type="text" id="googleaitools_icon_emoji" name="googleaitools_icon_emoji" value="<?php echo esc_attr($icon_emoji); ?>" placeholder="e.g. ✨">
        </div>
        <div class="g-meta-field">
            <label for="googleaitools_read_time">Estimated Reading Time</label>
            <input type="text" id="googleaitools_read_time" name="googleaitools_read_time" value="<?php echo esc_attr($read_time); ?>" placeholder="e.g. 6 min read">
        </div>
    </div>

    <!-- Direct Featured Image Clear Control -->
    <div class="g-meta-field" style="background:#fff3cd; border:1px solid #ffeba8; padding:12px 16px; border-radius:8px; margin-bottom:20px;">
        <label style="color:#856404; font-weight:700; margin-bottom:6px;">🖼️ Featured Image Reset / Clear Option</label>
        <label style="font-weight:normal; cursor:pointer; color:#856404; display:flex; align-items:center; gap:8px;">
            <input type="checkbox" name="googleaitools_remove_featured_image" value="1"> 
            <span><strong>Force Remove / Reset Featured Image</strong> for this article on Save.</span>
        </label>
        <p style="margin:4px 0 0 24px; font-size:12px; color:#856404;">Check this box and click <strong>Update</strong> to immediately remove any stuck featured image from this post!</p>
    </div>

    <div class="g-meta-field">
        <label for="googleaitools_seo_title">Google Search Meta Title</label>
        <input type="text" id="googleaitools_seo_title" name="googleaitools_seo_title" value="<?php echo esc_attr($seo_title); ?>" placeholder="Leave empty to use Post Title automatically">
        <small style="color: #666;">Optimal length: 50-60 characters.</small>
    </div>

    <div class="g-meta-field">
        <label for="googleaitools_seo_description">Google Search Meta Description</label>
        <textarea id="googleaitools_seo_description" name="googleaitools_seo_description" rows="2" placeholder="Leave empty to use Post Excerpt automatically"><?php echo esc_textarea($seo_description); ?></textarea>
        <small style="color: #666;">Optimal snippet length: 150-160 characters.</small>
    </div>

    <div class="g-meta-grid">
        <div class="g-meta-field">
            <label for="googleaitools_seo_keywords">Focus Target Keywords</label>
            <input type="text" id="googleaitools_seo_keywords" name="googleaitools_seo_keywords" value="<?php echo esc_attr($seo_keywords); ?>" placeholder="e.g. Gemini 1.5, Google AI">
        </div>
        <div class="g-meta-field">
            <label for="googleaitools_seo_og_image">Social Share Image (OpenGraph Image URL)</label>
            <input type="text" id="googleaitools_seo_og_image" name="googleaitools_seo_og_image" value="<?php echo esc_attr($seo_og_image); ?>" placeholder="https://...">
        </div>
    </div>

    <div class="g-meta-grid">
        <div class="g-meta-field">
            <label for="googleaitools_seo_canonical">Canonical URL</label>
            <input type="text" id="googleaitools_seo_canonical" name="googleaitools_seo_canonical" value="<?php echo esc_attr($seo_canonical); ?>" placeholder="Leave empty for auto permalink">
        </div>
        <div class="g-meta-field">
            <label for="googleaitools_seo_schema_type">Schema.org Type</label>
            <select id="googleaitools_seo_schema_type" name="googleaitools_seo_schema_type">
                <option value="BlogPosting" <?php selected($seo_schema_type, 'BlogPosting'); ?>>BlogPosting (Default)</option>
                <option value="TechArticle" <?php selected($seo_schema_type, 'TechArticle'); ?>>TechArticle (Tutorials & Code)</option>
                <option value="NewsArticle" <?php selected($seo_schema_type, 'NewsArticle'); ?>>NewsArticle (Releases)</option>
                <option value="Review" <?php selected($seo_schema_type, 'Review'); ?>>Review (Tool Reviews)</option>
            </select>
        </div>
    </div>

    <div class="g-meta-field">
        <label for="googleaitools_seo_robots">Robots Indexing Directive</label>
        <select id="googleaitools_seo_robots" name="googleaitools_seo_robots">
            <option value="index, follow" <?php selected($seo_robots, 'index, follow'); ?>>index, follow (Allow Google Search Indexing - Recommended)</option>
            <option value="noindex, follow" <?php selected($seo_robots, 'noindex, follow'); ?>>noindex, follow (Hide from Search)</option>
            <option value="noindex, nofollow" <?php selected($seo_robots, 'noindex, nofollow'); ?>>noindex, nofollow (Private Draft)</option>
        </select>
    </div>
    <?php
}

function googleaitools_save_seo_meta_boxes($post_id) {
    if (!isset($_POST['googleaitools_seo_nonce']) || !wp_verify_nonce($_POST['googleaitools_seo_nonce'], 'googleaitools_save_seo_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['googleaitools_remove_featured_image']) && $_POST['googleaitools_remove_featured_image'] == '1') {
        delete_post_thumbnail($post_id);
    }

    $fields = [
        'googleaitools_seo_title' => '_googleaitools_seo_title',
        'googleaitools_seo_description' => '_googleaitools_seo_description',
        'googleaitools_seo_keywords' => '_googleaitools_seo_keywords',
        'googleaitools_seo_og_image' => '_googleaitools_seo_og_image',
        'googleaitools_seo_canonical' => '_googleaitools_seo_canonical',
        'googleaitools_seo_schema_type' => '_googleaitools_seo_schema_type',
        'googleaitools_seo_robots' => '_googleaitools_seo_robots',
        'googleaitools_icon_emoji' => '_googleaitools_icon_emoji',
        'googleaitools_read_time' => '_googleaitools_read_time'
    ];

    foreach ($fields as $input_key => $meta_key) {
        if (isset($_POST[$input_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$input_key]));
        }
    }
}
add_action('save_post', 'googleaitools_save_seo_meta_boxes');

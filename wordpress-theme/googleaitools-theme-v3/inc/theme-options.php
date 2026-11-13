<?php
/**
 * Theme Options & WordPress Customizer Settings for AdSense & Analytics
 */

if (!defined('ABSPATH')) exit;

function googleaitools_customize_register($wp_customize) {
    // Section 1: AdSense Settings
    $wp_customize->add_section('googleaitools_adsense_section', array(
        'title'    => '💰 Google AdSense Settings',
        'priority' => 30,
    ));

    $wp_customize->add_setting('googleaitools_adsense_pub_id', array(
        'default'           => 'ca-pub-0000000000000000',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('googleaitools_adsense_pub_id', array(
        'label'       => 'Google AdSense Publisher ID',
        'description' => 'Enter your approved publisher ID (e.g. ca-pub-1234567890123456).',
        'section'     => 'googleaitools_adsense_section',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('googleaitools_adsense_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('googleaitools_adsense_enabled', array(
        'label'       => 'Enable Google AdSense Integration',
        'section'     => 'googleaitools_adsense_section',
        'type'        => 'checkbox',
    ));

    $wp_customize->add_setting('googleaitools_adsense_test_mode', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('googleaitools_adsense_test_mode', array(
        'label'       => 'Show Visual Ad Placeholder Boxes (Test Previews)',
        'section'     => 'googleaitools_adsense_section',
        'type'        => 'checkbox',
    ));

    // Section 2: Analytics & Webmaster Tools
    $wp_customize->add_section('googleaitools_analytics_section', array(
        'title'    => '📈 Analytics & Webmasters',
        'priority' => 31,
    ));

    $wp_customize->add_setting('googleaitools_google_site_verification', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('googleaitools_google_site_verification', array(
        'label'       => 'Google Search Console Verification ID (google-site-verification)',
        'description' => 'Paste the content value from your Google Search Console HTML Meta Tag.',
        'section'     => 'googleaitools_analytics_section',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('googleaitools_bing_site_verification', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('googleaitools_bing_site_verification', array(
        'label'       => 'Bing & Yahoo Webmaster Verification ID (msvalidate.01)',
        'description' => 'Paste the content value from your Bing / Yahoo Webmaster Meta Tag.',
        'section'     => 'googleaitools_analytics_section',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('googleaitools_ga4_measurement_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('googleaitools_ga4_measurement_id', array(
        'label'       => 'Google Analytics 4 (GA4) Measurement ID',
        'description' => 'Paste your GA4 Measurement ID (e.g. G-XXXXXXXXXX).',
        'section'     => 'googleaitools_analytics_section',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('googleaitools_custom_header_scripts', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('googleaitools_custom_header_scripts', array(
        'label'       => 'Custom Header Scripts / Code (<head>)',
        'description' => 'Paste any raw custom <script> tags, Google Tag Manager code, or meta tags here.',
        'section'     => 'googleaitools_analytics_section',
        'type'        => 'textarea',
    ));

    // Section 3: Footer & Social Links
    $wp_customize->add_section('googleaitools_footer_section', array(
        'title'    => '🦶 Footer & Social Links',
        'priority' => 32,
    ));

    $wp_customize->add_setting('googleaitools_footer_tagline', array(
        'default'           => 'Your premier independent guide and review publication for Google AI models, developer APIs, research tools, and generative workspace technologies.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('googleaitools_footer_tagline', array(
        'label'   => 'Footer Brand Tagline / About Text',
        'section' => 'googleaitools_footer_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('googleaitools_footer_copyright', array(
        'default'           => 'All rights reserved. Independent news & tutorial portal.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('googleaitools_footer_copyright', array(
        'label'   => 'Footer Copyright Text',
        'section' => 'googleaitools_footer_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('googleaitools_twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('googleaitools_twitter_url', array(
        'label'   => 'Twitter / X Profile URL',
        'section' => 'googleaitools_footer_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('googleaitools_linkedin_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('googleaitools_linkedin_url', array(
        'label'   => 'LinkedIn Profile URL',
        'section' => 'googleaitools_footer_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('googleaitools_github_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('googleaitools_github_url', array(
        'label'   => 'GitHub Repository / Organization URL',
        'section' => 'googleaitools_footer_section',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'googleaitools_customize_register');

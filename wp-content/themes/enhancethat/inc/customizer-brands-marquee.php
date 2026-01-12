<?php
/**
 * Brands Marquee Customizer Settings
 *
 * Registers Customizer controls for managing brand logos displayed
 * in the homepage marquee section.
 *
 * @package EnhanceThat
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Brands Marquee Customizer settings
 *
 * Adds a Customizer section with image upload controls for managing
 * up to 20 brand logos in the homepage marquee.
 *
 * @param WP_Customize_Manager $wpCustomize WordPress Customizer manager instance
 */
function enhancethat_register_brands_marquee_customizer($wpCustomize) {
    // Add Brands Marquee section
    $wpCustomize->add_section('enhancethat_brands_marquee', array(
        'title' => __('Brands Marquee', 'enhancethat'),
        'description' => __('Manage brand logos displayed in the homepage marquee. Upload up to 20 logos. Logos will scroll infinitely in a seamless loop.', 'enhancethat'),
        'priority' => 30,
    ));

    // Add settings and controls for 20 logo slots
    for ($i = 1; $i <= 20; $i++) {
        $logoKey = 'logo_' . $i;

        // Add setting
        $wpCustomize->add_setting("enhancethat_brand_logos[{$logoKey}]", array(
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => 0,
            'transport' => 'postMessage',
            'sanitize_callback' => 'absint',
        ));

        // Add control
        $wpCustomize->add_control(new WP_Customize_Media_Control($wpCustomize, "enhancethat_brand_logos_{$logoKey}", array(
            'label' => sprintf(__('Brand Logo #%d', 'enhancethat'), $i),
            'description' => ($i <= 3) ? __('Upload a brand logo image (PNG or SVG recommended, max 125x32px display size)', 'enhancethat') : '',
            'section' => 'enhancethat_brands_marquee',
            'settings' => "enhancethat_brand_logos[{$logoKey}]",
            'mime_type' => 'image',
            'priority' => $i,
        )));
    }

    // Register selective refresh partial for live preview
    if (isset($wpCustomize->selective_refresh)) {
        $wpCustomize->selective_refresh->add_partial('enhancethat_brands_marquee_partial', array(
            'selector' => '.brands .marquee',
            'container_inclusive' => false,
            'render_callback' => 'enhancethat_render_brands_marquee_partial',
            'fallback_refresh' => true,
        ));
    }
}
add_action('customize_register', 'enhancethat_register_brands_marquee_customizer');

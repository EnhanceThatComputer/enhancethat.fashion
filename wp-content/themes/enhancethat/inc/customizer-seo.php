<?php
/**
 * SEO Customizer Settings
 *
 * Registers Customizer controls for managing global SEO settings.
 * Extends the Site Identity section with social media handles, default images,
 * article defaults, and organization schema data.
 *
 * @package EnhanceThat
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register SEO Customizer settings
 *
 * Extends the core Site Identity section with SEO-related settings for
 * social media, default images, article defaults, and organization schema.
 *
 * @param WP_Customize_Manager $wpCustomize WordPress Customizer manager instance
 */
function enhancethat_register_seo_customizer($wpCustomize) {
    // Use existing Site Identity section (title_tagline)
    $section = 'title_tagline';

    // ========================================
    // SOCIAL MEDIA SETTINGS
    // ========================================

    // Twitter Site Handle
    $wpCustomize->add_setting('enhancethat_seo_twitter_site', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '@enhancethat',
        'transport' => 'refresh',
        'sanitize_callback' => 'enhancethat_sanitize_twitter_handle',
    ));

    $wpCustomize->add_control('enhancethat_seo_twitter_site', array(
        'label' => __('Twitter Site Handle', 'enhancethat'),
        'description' => __('Default Twitter handle for the site (e.g., @enhancethat). Used in Twitter Cards.', 'enhancethat'),
        'section' => $section,
        'type' => 'text',
        'priority' => 60,
    ));

    // Twitter Creator Handle
    $wpCustomize->add_setting('enhancethat_seo_twitter_creator', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '@enhancethat',
        'transport' => 'refresh',
        'sanitize_callback' => 'enhancethat_sanitize_twitter_handle',
    ));

    $wpCustomize->add_control('enhancethat_seo_twitter_creator', array(
        'label' => __('Twitter Creator Handle', 'enhancethat'),
        'description' => __('Default Twitter creator handle (e.g., @enhancethat). Can be overridden per post.', 'enhancethat'),
        'section' => $section,
        'type' => 'text',
        'priority' => 61,
    ));

    // Facebook App ID
    $wpCustomize->add_setting('enhancethat_seo_facebook_app_id', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wpCustomize->add_control('enhancethat_seo_facebook_app_id', array(
        'label' => __('Facebook App ID', 'enhancethat'),
        'description' => __('Optional. Facebook App ID for Facebook Insights.', 'enhancethat'),
        'section' => $section,
        'type' => 'text',
        'priority' => 62,
    ));

    // ========================================
    // DEFAULT OG IMAGE
    // ========================================

    $wpCustomize->add_setting('enhancethat_seo_default_og_image', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wpCustomize->add_control(new WP_Customize_Media_Control($wpCustomize, 'enhancethat_seo_default_og_image', array(
        'label' => __('Default Social Share Image', 'enhancethat'),
        'description' => __('Fallback Open Graph image when posts/pages have no featured image. Recommended: 1200×630px.', 'enhancethat'),
        'section' => $section,
        'mime_type' => 'image',
        'priority' => 63,
    )));

    // ========================================
    // ARTICLE/BLOG DEFAULTS
    // ========================================

    $wpCustomize->add_setting('enhancethat_seo_article_section', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Technology',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wpCustomize->add_control('enhancethat_seo_article_section', array(
        'label' => __('Default Article Section', 'enhancethat'),
        'description' => __('Default category/section for articles (e.g., Technology, Business).', 'enhancethat'),
        'section' => $section,
        'type' => 'text',
        'priority' => 64,
    ));

    $wpCustomize->add_setting('enhancethat_seo_article_tags', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Fashion Technology, Digital Workflows, Automation',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wpCustomize->add_control('enhancethat_seo_article_tags', array(
        'label' => __('Default Article Tags', 'enhancethat'),
        'description' => __('Comma-separated default tags for articles when none are assigned.', 'enhancethat'),
        'section' => $section,
        'type' => 'textarea',
        'priority' => 65,
    ));

    // ========================================
    // ORGANIZATION SCHEMA (JSON-LD)
    // ========================================

    $wpCustomize->add_setting('enhancethat_seo_org_name', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Enhance That',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wpCustomize->add_control('enhancethat_seo_org_name', array(
        'label' => __('Organization Name', 'enhancethat'),
        'description' => __('Legal business name (for schema.org Organization).', 'enhancethat'),
        'section' => $section,
        'type' => 'text',
        'priority' => 66,
    ));

    $wpCustomize->add_setting('enhancethat_seo_org_description', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Digital design workflow company specializing in automation and integration for fashion brands.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wpCustomize->add_control('enhancethat_seo_org_description', array(
        'label' => __('Organization Description', 'enhancethat'),
        'description' => __('Brief description of your business for structured data.', 'enhancethat'),
        'section' => $section,
        'type' => 'textarea',
        'priority' => 67,
    ));

    $wpCustomize->add_setting('enhancethat_seo_org_logo', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wpCustomize->add_control(new WP_Customize_Media_Control($wpCustomize, 'enhancethat_seo_org_logo', array(
        'label' => __('Organization Logo', 'enhancethat'),
        'description' => __('Logo for structured data (JSON-LD). Should be square, at least 112x112px.', 'enhancethat'),
        'section' => $section,
        'mime_type' => 'image',
        'priority' => 68,
    )));

    $wpCustomize->add_setting('enhancethat_seo_org_contact_type', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'general',
        'transport' => 'refresh',
        'sanitize_callback' => 'enhancethat_sanitize_contact_type',
    ));

    $wpCustomize->add_control('enhancethat_seo_org_contact_type', array(
        'label' => __('Contact Type', 'enhancethat'),
        'description' => __('Type of contact for structured data.', 'enhancethat'),
        'section' => $section,
        'type' => 'select',
        'choices' => array(
            'general' => __('General', 'enhancethat'),
            'customer service' => __('Customer Service', 'enhancethat'),
            'technical support' => __('Technical Support', 'enhancethat'),
            'sales' => __('Sales', 'enhancethat'),
        ),
        'priority' => 69,
    ));

    $wpCustomize->add_setting('enhancethat_seo_org_contact_email', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wpCustomize->add_control('enhancethat_seo_org_contact_email', array(
        'label' => __('Contact Email', 'enhancethat'),
        'description' => __('Public contact email for business.', 'enhancethat'),
        'section' => $section,
        'type' => 'email',
        'priority' => 70,
    ));

    $wpCustomize->add_setting('enhancethat_seo_org_linkedin', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'https://www.linkedin.com/company/enhancethat/?originalSubdomain=nl',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wpCustomize->add_control('enhancethat_seo_org_linkedin', array(
        'label' => __('LinkedIn Profile URL', 'enhancethat'),
        'description' => __('Full URL to company LinkedIn profile.', 'enhancethat'),
        'section' => $section,
        'type' => 'url',
        'priority' => 71,
    ));

    $wpCustomize->add_setting('enhancethat_seo_org_additional_socials', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'enhancethat_sanitize_social_urls',
    ));

    $wpCustomize->add_control('enhancethat_seo_org_additional_socials', array(
        'label' => __('Additional Social Profiles', 'enhancethat'),
        'description' => __('One URL per line. Add Twitter, Instagram, Facebook, etc.', 'enhancethat'),
        'section' => $section,
        'type' => 'textarea',
        'priority' => 72,
    ));
}
add_action('customize_register', 'enhancethat_register_seo_customizer');

/**
 * Sanitize contact type
 *
 * Ensures value is one of the allowed contact types
 *
 * @param string $value Contact type value
 * @return string Sanitized contact type
 */
function enhancethat_sanitize_contact_type($value) {
    $allowedTypes = array('general', 'customer service', 'technical support', 'sales');

    if (in_array($value, $allowedTypes)) {
        return $value;
    }

    return 'general';
}

<?php
/**
 * Front Page Customizer Settings
 *
 * All text blocks and images for the front page are configurable here.
 *
 * @package EnhanceThat2026
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Front Page Customizer Settings
 */
function enhancethat2026FrontPageCustomizer($wpCustomize) {
    // ==========================================================================
    // Front Page Panel
    // ==========================================================================
    $wpCustomize->add_panel('enhancethat_front_page', array(
        'title' => __('Front Page Content', 'enhancethat-2026'),
        'priority' => 30,
    ));

    // ==========================================================================
    // Section 1: Fashion's Reality
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_fashions_reality', array(
        'title' => __('1. Fashion\'s Reality', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 10,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_fashions_reality_title', array(
        'default' => "Fashion's Reality",
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wpCustomize->add_control('enhancethat_fashions_reality_title', array(
        'label' => __('Section Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_fashions_reality',
        'type' => 'text',
    ));

    // Intro Text
    $wpCustomize->add_setting('enhancethat_fashions_reality_intro', array(
        'default' => "It's not a lack of collection ideas.\nIt's the time and effort it takes to get them to market.",
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh',
    ));
    $wpCustomize->add_control('enhancethat_fashions_reality_intro', array(
        'label' => __('Intro Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_fashions_reality',
        'type' => 'textarea',
    ));

    // Risk Text
    $wpCustomize->add_setting('enhancethat_fashions_reality_risk', array(
        'default' => "More time means more risk.\nMore risk means more inventory.\nMore inventory means less margin.",
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh',
    ));
    $wpCustomize->add_control('enhancethat_fashions_reality_risk', array(
        'label' => __('Risk Statement', 'enhancethat-2026'),
        'section' => 'enhancethat_section_fashions_reality',
        'type' => 'textarea',
    ));

    // Image
    $wpCustomize->add_setting('enhancethat_fashions_reality_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wpCustomize->add_control(new WP_Customize_Image_Control($wpCustomize, 'enhancethat_fashions_reality_image', array(
        'label' => __('Section Image', 'enhancethat-2026'),
        'section' => 'enhancethat_section_fashions_reality',
    )));

    // ==========================================================================
    // Section 2: The Opportunity
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_opportunity', array(
        'title' => __('2. The Opportunity', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 20,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_opportunity_title', array(
        'default' => 'The opportunity',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_opportunity_title', array(
        'label' => __('Section Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_opportunity',
        'type' => 'text',
    ));

    // Subtitle
    $wpCustomize->add_setting('enhancethat_opportunity_subtitle', array(
        'default' => 'Clear the way from concept to market.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_opportunity_subtitle', array(
        'label' => __('Subtitle', 'enhancethat-2026'),
        'section' => 'enhancethat_section_opportunity',
        'type' => 'text',
    ));

    // Body Text
    $wpCustomize->add_setting('enhancethat_opportunity_body', array(
        'default' => "Technology removes the waiting.\nDecisions can be tested, not guessed.\n\nRisk goes down.\nBrand intent goes up.\n\nBuilt around your brand.\nNot around tools.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_opportunity_body', array(
        'label' => __('Body Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_opportunity',
        'type' => 'textarea',
    ));

    // Image
    $wpCustomize->add_setting('enhancethat_opportunity_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wpCustomize->add_control(new WP_Customize_Image_Control($wpCustomize, 'enhancethat_opportunity_image', array(
        'label' => __('Section Image', 'enhancethat-2026'),
        'section' => 'enhancethat_section_opportunity',
    )));

    // ==========================================================================
    // Section 3: What We Change
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_what_we_change', array(
        'title' => __('3. What We Change', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 30,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_change_title', array(
        'default' => 'What we change',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_change_title', array(
        'label' => __('Section Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_what_we_change',
        'type' => 'text',
    ));

    // Subtitle
    $wpCustomize->add_setting('enhancethat_change_subtitle', array(
        'default' => 'We connect the work behind your collections so technology can actually do its job.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_change_subtitle', array(
        'label' => __('Subtitle', 'enhancethat-2026'),
        'section' => 'enhancethat_section_what_we_change',
        'type' => 'text',
    ));

    // Bullet Points (comma separated)
    $wpCustomize->add_setting('enhancethat_change_bullets', array(
        'default' => "connect design work and data\nkeep collections consistent from design to store\nremove steps that add time, not value",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_change_bullets', array(
        'label' => __('Bullet Points (one per line)', 'enhancethat-2026'),
        'section' => 'enhancethat_section_what_we_change',
        'type' => 'textarea',
    ));

    // Tagline
    $wpCustomize->add_setting('enhancethat_change_tagline', array(
        'default' => 'When data is connected, technology does its job and creativity can lead again.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_change_tagline', array(
        'label' => __('Bold Tagline', 'enhancethat-2026'),
        'section' => 'enhancethat_section_what_we_change',
        'type' => 'text',
    ));

    // Brand Line
    $wpCustomize->add_setting('enhancethat_change_brand_line', array(
        'default' => 'We EnhanceThat',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_change_brand_line', array(
        'label' => __('Brand Line', 'enhancethat-2026'),
        'section' => 'enhancethat_section_what_we_change',
        'type' => 'text',
    ));

    // ==========================================================================
    // Section 4: Built and Used at Scale
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_scale', array(
        'title' => __('4. Built and Used at Scale', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 40,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_scale_title', array(
        'default' => 'Built and used at scale',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_scale_title', array(
        'label' => __('Section Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_scale',
        'type' => 'text',
    ));

    // Subtitle
    $wpCustomize->add_setting('enhancethat_scale_subtitle', array(
        'default' => 'We work with brands operating at scale, complexity, and commercial pressure.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_scale_subtitle', array(
        'label' => __('Subtitle', 'enhancethat-2026'),
        'section' => 'enhancethat_section_scale',
        'type' => 'text',
    ));

    // Brand Tags (comma separated)
    $wpCustomize->add_setting('enhancethat_scale_brand_tags', array(
        'default' => 'drawbridge,drawbridge,drawbridge,drawbridge,drawbridge',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_scale_brand_tags', array(
        'label' => __('Brand Tags (comma separated)', 'enhancethat-2026'),
        'section' => 'enhancethat_section_scale',
        'type' => 'text',
    ));

    // Case Studies Link Text
    $wpCustomize->add_setting('enhancethat_scale_case_studies_text', array(
        'default' => 'Selected case studies',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_scale_case_studies_text', array(
        'label' => __('Case Studies Link Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_scale',
        'type' => 'text',
    ));

    // Case Study Images (1-3)
    for ($i = 1; $i <= 3; $i++) {
        $wpCustomize->add_setting("enhancethat_scale_case_study_{$i}_image", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wpCustomize->add_control(new WP_Customize_Image_Control($wpCustomize, "enhancethat_scale_case_study_{$i}_image", array(
            'label' => sprintf(__('Case Study %d Image', 'enhancethat-2026'), $i),
            'section' => 'enhancethat_section_scale',
        )));

        $wpCustomize->add_setting("enhancethat_scale_case_study_{$i}_link", array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wpCustomize->add_control("enhancethat_scale_case_study_{$i}_link", array(
            'label' => sprintf(__('Case Study %d Link', 'enhancethat-2026'), $i),
            'section' => 'enhancethat_section_scale',
            'type' => 'url',
        ));
    }

    // ==========================================================================
    // Section 5: The Big Unlock
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_unlock', array(
        'title' => __('5. The Big Unlock', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 50,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_unlock_title', array(
        'default' => 'The big unlock',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_unlock_title', array(
        'label' => __('Section Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_unlock',
        'type' => 'text',
    ));

    // FROM Flow
    $wpCustomize->add_setting('enhancethat_unlock_from_label', array(
        'default' => 'FROM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_unlock_from_label', array(
        'label' => __('FROM Label', 'enhancethat-2026'),
        'section' => 'enhancethat_section_unlock',
        'type' => 'text',
    ));

    $wpCustomize->add_setting('enhancethat_unlock_from_flow', array(
        'default' => 'design > make > sell',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_unlock_from_flow', array(
        'label' => __('FROM Flow Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_unlock',
        'type' => 'text',
    ));

    // TO Flow
    $wpCustomize->add_setting('enhancethat_unlock_to_label', array(
        'default' => 'TO',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_unlock_to_label', array(
        'label' => __('TO Label', 'enhancethat-2026'),
        'section' => 'enhancethat_section_unlock',
        'type' => 'text',
    ));

    $wpCustomize->add_setting('enhancethat_unlock_to_flow', array(
        'default' => 'design > sell > make',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_unlock_to_flow', array(
        'label' => __('TO Flow Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_unlock',
        'type' => 'text',
    ));

    // Body Text
    $wpCustomize->add_setting('enhancethat_unlock_body', array(
        'default' => "When technology is connected,\nthis shift becomes real.\n\nBrands can test, learn, and decide\nbefore they commit.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_unlock_body', array(
        'label' => __('Body Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_unlock',
        'type' => 'textarea',
    ));

    // Tagline
    $wpCustomize->add_setting('enhancethat_unlock_tagline', array(
        'default' => "That's how new business models become realistic.",
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_unlock_tagline', array(
        'label' => __('Bold Tagline', 'enhancethat-2026'),
        'section' => 'enhancethat_section_unlock',
        'type' => 'text',
    ));

    // ==========================================================================
    // Section 6: How We Work
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_how_we_work', array(
        'title' => __('6. How We Work', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 60,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_how_title', array(
        'default' => 'How we work',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_how_title', array(
        'label' => __('Section Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_how_we_work',
        'type' => 'text',
    ));

    // Left Column Title
    $wpCustomize->add_setting('enhancethat_how_left_title', array(
        'default' => 'Start with how work actually moves',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_how_left_title', array(
        'label' => __('Left Column Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_how_we_work',
        'type' => 'text',
    ));

    // Left Column Body
    $wpCustomize->add_setting('enhancethat_how_left_body', array(
        'default' => "We begin by looking at how collections move today.\nWhere decisions are made.\nWhere work piles up.\nAnd where time turns into risk",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_how_left_body', array(
        'label' => __('Left Column Body', 'enhancethat-2026'),
        'section' => 'enhancethat_section_how_we_work',
        'type' => 'textarea',
    ));

    // Emphasis Text (big italic)
    $wpCustomize->add_setting('enhancethat_how_emphasis', array(
        'default' => "Not opinions.\nNot assumptions.\nBut data.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_how_emphasis', array(
        'label' => __('Emphasis Text (large italic)', 'enhancethat-2026'),
        'section' => 'enhancethat_section_how_we_work',
        'type' => 'textarea',
    ));

    // Right Column Title
    $wpCustomize->add_setting('enhancethat_how_right_title', array(
        'default' => 'What this reveals',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_how_right_title', array(
        'label' => __('Right Column Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_how_we_work',
        'type' => 'text',
    ));

    // Right Column Bullets
    $wpCustomize->add_setting('enhancethat_how_right_bullets', array(
        'default' => "where manual steps break the flow\nwhere risk builds\nhow data can connect",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_how_right_bullets', array(
        'label' => __('Right Column Bullets (one per line)', 'enhancethat-2026'),
        'section' => 'enhancethat_section_how_we_work',
        'type' => 'textarea',
    ));

    // Right Column Image
    $wpCustomize->add_setting('enhancethat_how_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wpCustomize->add_control(new WP_Customize_Image_Control($wpCustomize, 'enhancethat_how_image', array(
        'label' => __('Section Image', 'enhancethat-2026'),
        'section' => 'enhancethat_section_how_we_work',
    )));

    // ==========================================================================
    // Section 7: A Proven Foundation
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_foundation', array(
        'title' => __('7. A Proven Foundation', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 70,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_foundation_title', array(
        'default' => 'A proven foundation',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_foundation_title', array(
        'label' => __('Section Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_foundation',
        'type' => 'text',
    ));

    // Body Text
    $wpCustomize->add_setting('enhancethat_foundation_body', array(
        'default' => "We work from a proven blueprint.\nApplied with intent.\nRefined for your reality.\n\nA foundation shaped to how your teams work,\nbuilt to support what comes next.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_foundation_body', array(
        'label' => __('Body Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_foundation',
        'type' => 'textarea',
    ));

    // Image
    $wpCustomize->add_setting('enhancethat_foundation_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wpCustomize->add_control(new WP_Customize_Image_Control($wpCustomize, 'enhancethat_foundation_image', array(
        'label' => __('Section Image', 'enhancethat-2026'),
        'section' => 'enhancethat_section_foundation',
    )));

    // ==========================================================================
    // Section 8: Ownership and Continuity
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_ownership', array(
        'title' => __('8. Ownership and Continuity', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 80,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_ownership_title', array(
        'default' => 'Ownership and continuity',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_ownership_title', array(
        'label' => __('Section Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_ownership',
        'type' => 'text',
    ));

    // Left Column Title
    $wpCustomize->add_setting('enhancethat_ownership_left_title', array(
        'default' => 'You own the setup.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_ownership_left_title', array(
        'label' => __('Left Column Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_ownership',
        'type' => 'text',
    ));

    // Left Column Body
    $wpCustomize->add_setting('enhancethat_ownership_left_body', array(
        'default' => "The workflows, the logic, the integrations\nlive in your environment.\n\nWe stay to support, maintain,\nand evolve the foundation\nas your tools, teams, and ambitions change.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_ownership_left_body', array(
        'label' => __('Left Column Body', 'enhancethat-2026'),
        'section' => 'enhancethat_section_ownership',
        'type' => 'textarea',
    ));

    // Right Column Title
    $wpCustomize->add_setting('enhancethat_ownership_right_title', array(
        'default' => 'You own the foundation.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_ownership_right_title', array(
        'label' => __('Right Column Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_ownership',
        'type' => 'text',
    ));

    // Right Column Body
    $wpCustomize->add_setting('enhancethat_ownership_right_body', array(
        'default' => "The workflows, the logic, and the integrations\nlive in your environment.\n\nWe build it with you,\nso it stays understandable, maintainable,\nand easy to extend as things change.\n\nWe keep you supported as tools, partners, and\nways of working evolve over time.\n\nOwnership stays with you.\nWe make sure it keeps working.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_ownership_right_body', array(
        'label' => __('Right Column Body', 'enhancethat-2026'),
        'section' => 'enhancethat_section_ownership',
        'type' => 'textarea',
    ));

    // Tagline (bold text at bottom)
    $wpCustomize->add_setting('enhancethat_ownership_tagline', array(
        'default' => "Gain clarity through data\nBuild on a proven foundation\nOwn it, with support as you grow",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wpCustomize->add_control('enhancethat_ownership_tagline', array(
        'label' => __('Bold Tagline (one per line)', 'enhancethat-2026'),
        'section' => 'enhancethat_section_ownership',
        'type' => 'textarea',
    ));

    // ==========================================================================
    // Section 9: CTA
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_cta', array(
        'title' => __('9. Call to Action', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 90,
    ));

    // Title
    $wpCustomize->add_setting('enhancethat_cta_title', array(
        'default' => 'Start with an assessment',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_cta_title', array(
        'label' => __('CTA Title', 'enhancethat-2026'),
        'section' => 'enhancethat_section_cta',
        'type' => 'text',
    ));

    // Button Text
    $wpCustomize->add_setting('enhancethat_cta_button_text', array(
        'default' => 'TELL ME MORE',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_cta_button_text', array(
        'label' => __('Button Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_cta',
        'type' => 'text',
    ));

    // Button URL
    $wpCustomize->add_setting('enhancethat_cta_button_url', array(
        'default' => 'https://outlook.office365.com/owa/calendar/EnhanceThat@enhancethat.fashion/bookings/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wpCustomize->add_control('enhancethat_cta_button_url', array(
        'label' => __('Button URL', 'enhancethat-2026'),
        'section' => 'enhancethat_section_cta',
        'type' => 'url',
    ));

    // ==========================================================================
    // Navigation Menu Items
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_section_nav', array(
        'title' => __('Navigation', 'enhancethat-2026'),
        'panel' => 'enhancethat_front_page',
        'priority' => 5,
    ));

    // Nav Item 1
    $wpCustomize->add_setting('enhancethat_nav_item_1_text', array(
        'default' => 'How we work',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_nav_item_1_text', array(
        'label' => __('Nav Item 1 Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_nav',
        'type' => 'text',
    ));
    $wpCustomize->add_setting('enhancethat_nav_item_1_url', array(
        'default' => '#how-we-work',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wpCustomize->add_control('enhancethat_nav_item_1_url', array(
        'label' => __('Nav Item 1 URL', 'enhancethat-2026'),
        'section' => 'enhancethat_section_nav',
        'type' => 'text',
    ));

    // Nav Item 2
    $wpCustomize->add_setting('enhancethat_nav_item_2_text', array(
        'default' => 'What drives us',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_nav_item_2_text', array(
        'label' => __('Nav Item 2 Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_nav',
        'type' => 'text',
    ));
    $wpCustomize->add_setting('enhancethat_nav_item_2_url', array(
        'default' => '#what-we-change',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wpCustomize->add_control('enhancethat_nav_item_2_url', array(
        'label' => __('Nav Item 2 URL', 'enhancethat-2026'),
        'section' => 'enhancethat_section_nav',
        'type' => 'text',
    ));

    // Nav Item 3
    $wpCustomize->add_setting('enhancethat_nav_item_3_text', array(
        'default' => 'Case Studies',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wpCustomize->add_control('enhancethat_nav_item_3_text', array(
        'label' => __('Nav Item 3 Text', 'enhancethat-2026'),
        'section' => 'enhancethat_section_nav',
        'type' => 'text',
    ));
    $wpCustomize->add_setting('enhancethat_nav_item_3_url', array(
        'default' => '#case-studies',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wpCustomize->add_control('enhancethat_nav_item_3_url', array(
        'label' => __('Nav Item 3 URL', 'enhancethat-2026'),
        'section' => 'enhancethat_section_nav',
        'type' => 'text',
    ));
}
add_action('customize_register', 'enhancethat2026FrontPageCustomizer');

/**
 * Helper function to get front page content with default fallback
 */
function enhancethat2026GetContent($key, $default = '') {
    return get_theme_mod("enhancethat_{$key}", $default);
}

/**
 * Convert newlines to HTML breaks for display
 */
function enhancethat2026NlToBr($text) {
    return nl2br(esc_html($text));
}

/**
 * Convert newlines to array for bullet lists
 */
function enhancethat2026TextToArray($text) {
    $lines = explode("\n", $text);
    return array_filter(array_map('trim', $lines));
}

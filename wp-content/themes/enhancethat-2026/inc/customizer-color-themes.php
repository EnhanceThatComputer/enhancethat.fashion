<?php
/**
 * Color Themes Customizer Settings
 *
 * Multiple dark color theme options for the front page.
 *
 * @package EnhanceThat2026
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Color Theme Customizer Settings
 */
function enhancethat2026ColorThemesCustomizer($wpCustomize) {
    // ==========================================================================
    // Color Themes Section
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_color_themes', array(
        'title' => __('Color Theme', 'enhancethat-2026'),
        'priority' => 25,
    ));

    // Theme Selection
    $wpCustomize->add_setting('enhancethat_color_theme', array(
        'default' => 'midnight',
        'sanitize_callback' => 'enhancethat2026SanitizeThemeChoice',
        'transport' => 'refresh',
    ));
    $wpCustomize->add_control('enhancethat_color_theme', array(
        'label' => __('Select Color Theme', 'enhancethat-2026'),
        'section' => 'enhancethat_color_themes',
        'type' => 'select',
        'choices' => enhancethat2026GetColorThemes(),
    ));

    // Accent Color Override
    $wpCustomize->add_setting('enhancethat_accent_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    $wpCustomize->add_control(new WP_Customize_Color_Control($wpCustomize, 'enhancethat_accent_color', array(
        'label' => __('Custom Accent Color (optional)', 'enhancethat-2026'),
        'description' => __('Override the theme accent color. Leave empty to use theme default.', 'enhancethat-2026'),
        'section' => 'enhancethat_color_themes',
    )));

    // ==========================================================================
    // Custom Theme Colors (Advanced)
    // ==========================================================================
    $wpCustomize->add_section('enhancethat_custom_colors', array(
        'title' => __('Custom Colors (Advanced)', 'enhancethat-2026'),
        'priority' => 26,
        'description' => __('Override individual colors. Only applies when "Custom" theme is selected.', 'enhancethat-2026'),
    ));

    // Background Color
    $wpCustomize->add_setting('enhancethat_custom_bg', array(
        'default' => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wpCustomize->add_control(new WP_Customize_Color_Control($wpCustomize, 'enhancethat_custom_bg', array(
        'label' => __('Background Color', 'enhancethat-2026'),
        'section' => 'enhancethat_custom_colors',
    )));

    // Background Secondary
    $wpCustomize->add_setting('enhancethat_custom_bg_secondary', array(
        'default' => '#252525',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wpCustomize->add_control(new WP_Customize_Color_Control($wpCustomize, 'enhancethat_custom_bg_secondary', array(
        'label' => __('Secondary Background', 'enhancethat-2026'),
        'section' => 'enhancethat_custom_colors',
    )));

    // Text Primary
    $wpCustomize->add_setting('enhancethat_custom_text', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wpCustomize->add_control(new WP_Customize_Color_Control($wpCustomize, 'enhancethat_custom_text', array(
        'label' => __('Primary Text Color', 'enhancethat-2026'),
        'section' => 'enhancethat_custom_colors',
    )));

    // Text Secondary
    $wpCustomize->add_setting('enhancethat_custom_text_secondary', array(
        'default' => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wpCustomize->add_control(new WP_Customize_Color_Control($wpCustomize, 'enhancethat_custom_text_secondary', array(
        'label' => __('Secondary Text Color', 'enhancethat-2026'),
        'section' => 'enhancethat_custom_colors',
    )));

    // Custom Accent
    $wpCustomize->add_setting('enhancethat_custom_accent', array(
        'default' => '#f5c6d0',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wpCustomize->add_control(new WP_Customize_Color_Control($wpCustomize, 'enhancethat_custom_accent', array(
        'label' => __('Accent Color', 'enhancethat-2026'),
        'section' => 'enhancethat_custom_colors',
    )));

    // Border Color
    $wpCustomize->add_setting('enhancethat_custom_border', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wpCustomize->add_control(new WP_Customize_Color_Control($wpCustomize, 'enhancethat_custom_border', array(
        'label' => __('Border Color', 'enhancethat-2026'),
        'section' => 'enhancethat_custom_colors',
    )));
}
add_action('customize_register', 'enhancethat2026ColorThemesCustomizer');

/**
 * Get available color themes
 */
function enhancethat2026GetColorThemes() {
    return array(
        'midnight' => __('Midnight (Default)', 'enhancethat-2026'),
        'charcoal' => __('Charcoal', 'enhancethat-2026'),
        'deep-blue' => __('Deep Blue', 'enhancethat-2026'),
        'forest' => __('Forest', 'enhancethat-2026'),
        'wine' => __('Wine', 'enhancethat-2026'),
        'slate' => __('Slate', 'enhancethat-2026'),
        'obsidian' => __('Obsidian', 'enhancethat-2026'),
        'navy' => __('Navy', 'enhancethat-2026'),
        'custom' => __('Custom', 'enhancethat-2026'),
    );
}

/**
 * Sanitize theme choice
 */
function enhancethat2026SanitizeThemeChoice($input) {
    $validThemes = array_keys(enhancethat2026GetColorThemes());
    return in_array($input, $validThemes) ? $input : 'midnight';
}

/**
 * Get theme color values
 */
function enhancethat2026GetThemeColors($themeName = null) {
    if (!$themeName) {
        $themeName = get_theme_mod('enhancethat_color_theme', 'midnight');
    }

    $themes = array(
        'midnight' => array(
            'bg' => '#1a1a1a',
            'bgSecondary' => '#252525',
            'bgTertiary' => '#2f2f2f',
            'text' => '#ffffff',
            'textSecondary' => '#999999',
            'textMuted' => '#666666',
            'accent' => '#f5c6d0',
            'accentHover' => '#f8d4dc',
            'border' => '#333333',
            'borderLight' => '#444444',
        ),
        'charcoal' => array(
            'bg' => '#2d2d2d',
            'bgSecondary' => '#383838',
            'bgTertiary' => '#434343',
            'text' => '#f5f5f5',
            'textSecondary' => '#a0a0a0',
            'textMuted' => '#707070',
            'accent' => '#7ed6a6',
            'accentHover' => '#96e0b8',
            'border' => '#4a4a4a',
            'borderLight' => '#5a5a5a',
        ),
        'deep-blue' => array(
            'bg' => '#0d1b2a',
            'bgSecondary' => '#1b263b',
            'bgTertiary' => '#263549',
            'text' => '#e0e1dd',
            'textSecondary' => '#8d99ae',
            'textMuted' => '#5c6b7a',
            'accent' => '#00b4d8',
            'accentHover' => '#48cae4',
            'border' => '#2b3a4d',
            'borderLight' => '#3d4f63',
        ),
        'forest' => array(
            'bg' => '#1a2e1a',
            'bgSecondary' => '#243d24',
            'bgTertiary' => '#2e4c2e',
            'text' => '#e8f5e9',
            'textSecondary' => '#a5d6a7',
            'textMuted' => '#6a9b6c',
            'accent' => '#aed581',
            'accentHover' => '#c5e1a5',
            'border' => '#2e4a2e',
            'borderLight' => '#3e5a3e',
        ),
        'wine' => array(
            'bg' => '#2d1f27',
            'bgSecondary' => '#3d2a33',
            'bgTertiary' => '#4d3540',
            'text' => '#f8f0f2',
            'textSecondary' => '#c9a0aa',
            'textMuted' => '#8a6570',
            'accent' => '#e89aab',
            'accentHover' => '#f0b3c0',
            'border' => '#4d3540',
            'borderLight' => '#5d4550',
        ),
        'slate' => array(
            'bg' => '#2b303b',
            'bgSecondary' => '#373d49',
            'bgTertiary' => '#434a57',
            'text' => '#dfe6ed',
            'textSecondary' => '#9ba4b0',
            'textMuted' => '#6b7280',
            'accent' => '#8fbcbb',
            'accentHover' => '#a3cccb',
            'border' => '#434a57',
            'borderLight' => '#535a67',
        ),
        'obsidian' => array(
            'bg' => '#0f0f0f',
            'bgSecondary' => '#1a1a1a',
            'bgTertiary' => '#252525',
            'text' => '#ffffff',
            'textSecondary' => '#808080',
            'textMuted' => '#505050',
            'accent' => '#ffffff',
            'accentHover' => '#e0e0e0',
            'border' => '#2a2a2a',
            'borderLight' => '#3a3a3a',
        ),
        'navy' => array(
            'bg' => '#0a1628',
            'bgSecondary' => '#132238',
            'bgTertiary' => '#1c2e48',
            'text' => '#eef2f7',
            'textSecondary' => '#8899aa',
            'textMuted' => '#556677',
            'accent' => '#64b5f6',
            'accentHover' => '#90caf9',
            'border' => '#1c2e48',
            'borderLight' => '#263a58',
        ),
        'custom' => array(
            'bg' => get_theme_mod('enhancethat_custom_bg', '#1a1a1a'),
            'bgSecondary' => get_theme_mod('enhancethat_custom_bg_secondary', '#252525'),
            'bgTertiary' => enhancethat2026LightenColor(get_theme_mod('enhancethat_custom_bg_secondary', '#252525'), 10),
            'text' => get_theme_mod('enhancethat_custom_text', '#ffffff'),
            'textSecondary' => get_theme_mod('enhancethat_custom_text_secondary', '#999999'),
            'textMuted' => enhancethat2026DarkenColor(get_theme_mod('enhancethat_custom_text_secondary', '#999999'), 20),
            'accent' => get_theme_mod('enhancethat_custom_accent', '#f5c6d0'),
            'accentHover' => enhancethat2026LightenColor(get_theme_mod('enhancethat_custom_accent', '#f5c6d0'), 10),
            'border' => get_theme_mod('enhancethat_custom_border', '#333333'),
            'borderLight' => enhancethat2026LightenColor(get_theme_mod('enhancethat_custom_border', '#333333'), 10),
        ),
    );

    $colors = isset($themes[$themeName]) ? $themes[$themeName] : $themes['midnight'];

    // Apply accent color override if set
    $accentOverride = get_theme_mod('enhancethat_accent_color', '');
    if (!empty($accentOverride) && $themeName !== 'custom') {
        $colors['accent'] = $accentOverride;
        $colors['accentHover'] = enhancethat2026LightenColor($accentOverride, 10);
    }

    return $colors;
}

/**
 * Lighten a hex color
 */
function enhancethat2026LightenColor($hex, $percent) {
    $hex = ltrim($hex, '#');

    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    $r = min(255, $r + ($r * $percent / 100));
    $g = min(255, $g + ($g * $percent / 100));
    $b = min(255, $b + ($b * $percent / 100));

    return sprintf('#%02x%02x%02x', $r, $g, $b);
}

/**
 * Darken a hex color
 */
function enhancethat2026DarkenColor($hex, $percent) {
    $hex = ltrim($hex, '#');

    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    $r = max(0, $r - ($r * $percent / 100));
    $g = max(0, $g - ($g * $percent / 100));
    $b = max(0, $b - ($b * $percent / 100));

    return sprintf('#%02x%02x%02x', $r, $g, $b);
}

/**
 * Output CSS variables for the current theme
 */
function enhancethat2026OutputThemeCss() {
    $colors = enhancethat2026GetThemeColors();
    ?>
    <style id="enhancethat-theme-colors">
        :root {
            --theme-bg: <?php echo esc_attr($colors['bg']); ?>;
            --theme-bg-secondary: <?php echo esc_attr($colors['bgSecondary']); ?>;
            --theme-bg-tertiary: <?php echo esc_attr($colors['bgTertiary']); ?>;
            --theme-text: <?php echo esc_attr($colors['text']); ?>;
            --theme-text-secondary: <?php echo esc_attr($colors['textSecondary']); ?>;
            --theme-text-muted: <?php echo esc_attr($colors['textMuted']); ?>;
            --theme-accent: <?php echo esc_attr($colors['accent']); ?>;
            --theme-accent-hover: <?php echo esc_attr($colors['accentHover']); ?>;
            --theme-border: <?php echo esc_attr($colors['border']); ?>;
            --theme-border-light: <?php echo esc_attr($colors['borderLight']); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'enhancethat2026OutputThemeCss', 5);

/**
 * Get current theme name for body class
 */
function enhancethat2026GetThemeClass() {
    $theme = get_theme_mod('enhancethat_color_theme', 'midnight');
    return 'theme-' . sanitize_html_class($theme);
}

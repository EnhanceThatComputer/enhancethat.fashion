<?php
/**
 * YA Blog Theme Functions
 *
 * @package YA_Blog_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function yaBlogThemeSetup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Set default featured image size
    set_post_thumbnail_size(1200, 630, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ya-blog-theme'),
        'footer' => __('Footer Menu', 'ya-blog-theme'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'yaBlogThemeSetup');

/**
 * Enqueue scripts and styles
 */
function yaBlogThemeScripts() {
    // Theme stylesheet
    wp_enqueue_style('ya-blog-theme-style', get_stylesheet_uri(), array(), '1.0.0');

    // Google Fonts based on selected font
    $selectedFont = get_theme_mod('font_family', 'system');
    $fontUrls = array(
        'jetbrains-mono' => 'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&display=swap',
        'fira-code' => 'https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600;700&display=swap',
        'space-mono' => 'https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap',
        'ibm-plex-mono' => 'https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&display=swap',
        'source-code-pro' => 'https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;500;600;700&display=swap',
        'roboto-mono' => 'https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;600;700&display=swap',
        'inconsolata' => 'https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;500;600;700&display=swap',
    );

    if (isset($fontUrls[$selectedFont])) {
        wp_enqueue_style('ya-blog-theme-font', $fontUrls[$selectedFont], array(), null);
    }

    // Theme JavaScript
    wp_enqueue_script('ya-blog-theme-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.1.0', true);

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'yaBlogThemeScripts');

/**
 * Register widget area
 */
function yaBlogThemeWidgetsInit() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'ya-blog-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'ya-blog-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'yaBlogThemeWidgetsInit');

/**
 * Custom excerpt length
 */
function yaBlogThemeExcerptLength($length) {
    return 30;
}
add_filter('excerpt_length', 'yaBlogThemeExcerptLength', 999);

/**
 * Custom excerpt more
 */
function yaBlogThemeExcerptMore($more) {
    return '...';
}
add_filter('excerpt_more', 'yaBlogThemeExcerptMore');

/**
 * Color schemes
 */
function yaBlogThemeGetColorSchemes() {
    return array(
        'default' => array(
            'label' => __('Default Dark', 'ya-blog-theme'),
            'background' => '#0a0a0a',
            'text' => '#e0e0e0',
            'textHover' => '#ffffff',
            'textMuted' => '#888888',
            'border' => '#222222',
        ),
        'dracula' => array(
            'label' => __('Dracula', 'ya-blog-theme'),
            'background' => '#282a36',
            'text' => '#f8f8f2',
            'textHover' => '#ff79c6',
            'textMuted' => '#6272a4',
            'border' => '#44475a',
        ),
        'nord' => array(
            'label' => __('Nord', 'ya-blog-theme'),
            'background' => '#2e3440',
            'text' => '#eceff4',
            'textHover' => '#88c0d0',
            'textMuted' => '#4c566a',
            'border' => '#3b4252',
        ),
        'gruvbox' => array(
            'label' => __('Gruvbox Dark', 'ya-blog-theme'),
            'background' => '#282828',
            'text' => '#ebdbb2',
            'textHover' => '#fabd2f',
            'textMuted' => '#928374',
            'border' => '#3c3836',
        ),
        'monokai' => array(
            'label' => __('Monokai', 'ya-blog-theme'),
            'background' => '#272822',
            'text' => '#f8f8f2',
            'textHover' => '#66d9ef',
            'textMuted' => '#75715e',
            'border' => '#3e3d32',
        ),
        'tokyo-night' => array(
            'label' => __('Tokyo Night', 'ya-blog-theme'),
            'background' => '#1a1b26',
            'text' => '#c0caf5',
            'textHover' => '#7aa2f7',
            'textMuted' => '#565f89',
            'border' => '#24283b',
        ),
        'ayu-dark' => array(
            'label' => __('Ayu Dark', 'ya-blog-theme'),
            'background' => '#0a0e14',
            'text' => '#b3b1ad',
            'textHover' => '#ffcc66',
            'textMuted' => '#4d5566',
            'border' => '#0d1017',
        ),
        'matrix' => array(
            'label' => __('Matrix', 'ya-blog-theme'),
            'background' => '#0d0208',
            'text' => '#00ff41',
            'textHover' => '#39ff14',
            'textMuted' => '#008f11',
            'border' => '#003b00',
        ),
        'one-dark' => array(
            'label' => __('One Dark (Green)', 'ya-blog-theme'),
            'background' => '#282c34',
            'text' => '#abb2bf',
            'textHover' => '#98c379',
            'textMuted' => '#5c6370',
            'border' => '#3e4451',
        ),
        'solarized-dark' => array(
            'label' => __('Solarized Dark', 'ya-blog-theme'),
            'background' => '#002b36',
            'text' => '#839496',
            'textHover' => '#2aa198',
            'textMuted' => '#586e75',
            'border' => '#073642',
        ),
    );
}

/**
 * Font families
 */
function yaBlogThemeGetFonts() {
    return array(
        'system' => array(
            'label' => __('System Default', 'ya-blog-theme'),
            'family' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif',
        ),
        'jetbrains-mono' => array(
            'label' => __('JetBrains Mono', 'ya-blog-theme'),
            'family' => '"JetBrains Mono", monospace',
        ),
        'fira-code' => array(
            'label' => __('Fira Code', 'ya-blog-theme'),
            'family' => '"Fira Code", monospace',
        ),
        'space-mono' => array(
            'label' => __('Space Mono', 'ya-blog-theme'),
            'family' => '"Space Mono", monospace',
        ),
        'ibm-plex-mono' => array(
            'label' => __('IBM Plex Mono', 'ya-blog-theme'),
            'family' => '"IBM Plex Mono", monospace',
        ),
        'source-code-pro' => array(
            'label' => __('Source Code Pro', 'ya-blog-theme'),
            'family' => '"Source Code Pro", monospace',
        ),
        'roboto-mono' => array(
            'label' => __('Roboto Mono', 'ya-blog-theme'),
            'family' => '"Roboto Mono", monospace',
        ),
        'inconsolata' => array(
            'label' => __('Inconsolata', 'ya-blog-theme'),
            'family' => '"Inconsolata", monospace',
        ),
    );
}

/**
 * Customizer settings
 */
function yaBlogThemeCustomizer($wpCustomize) {
    // Color Scheme Section
    $wpCustomize->add_section('ya_blog_theme_colors', array(
        'title' => __('Color Scheme', 'ya-blog-theme'),
        'priority' => 30,
    ));

    $colorSchemes = yaBlogThemeGetColorSchemes();
    $colorChoices = array();
    foreach ($colorSchemes as $key => $scheme) {
        $colorChoices[$key] = $scheme['label'];
    }

    $wpCustomize->add_setting('color_scheme', array(
        'default' => 'default',
        'sanitize_callback' => 'yaBlogThemeSanitizeColorScheme',
    ));

    $wpCustomize->add_control('color_scheme', array(
        'label' => __('Select Color Scheme', 'ya-blog-theme'),
        'section' => 'ya_blog_theme_colors',
        'type' => 'select',
        'choices' => $colorChoices,
    ));

    // Font Family Section
    $wpCustomize->add_section('ya_blog_theme_fonts', array(
        'title' => __('Typography', 'ya-blog-theme'),
        'priority' => 31,
    ));

    $fonts = yaBlogThemeGetFonts();
    $fontChoices = array();
    foreach ($fonts as $key => $font) {
        $fontChoices[$key] = $font['label'];
    }

    $wpCustomize->add_setting('font_family', array(
        'default' => 'system',
        'sanitize_callback' => 'yaBlogThemeSanitizeFontFamily',
    ));

    $wpCustomize->add_control('font_family', array(
        'label' => __('Select Font Family', 'ya-blog-theme'),
        'section' => 'ya_blog_theme_fonts',
        'type' => 'select',
        'choices' => $fontChoices,
    ));

    // Sidebar Display Section
    $wpCustomize->add_section('ya_blog_theme_sidebar', array(
        'title' => __('Sidebar Settings', 'ya-blog-theme'),
        'priority' => 32,
    ));

    $wpCustomize->add_setting('show_sidebar_on_posts', array(
        'default' => false,
        'sanitize_callback' => 'yaBlogThemeSanitizeCheckbox',
    ));

    $wpCustomize->add_control('show_sidebar_on_posts', array(
        'label' => __('Show Sidebar on Single Posts', 'ya-blog-theme'),
        'description' => __('Enable to display sidebar widgets (search, recent posts, archives, etc.) on individual blog post pages.', 'ya-blog-theme'),
        'section' => 'ya_blog_theme_sidebar',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'yaBlogThemeCustomizer');

/**
 * Sanitize color scheme
 */
function yaBlogThemeSanitizeColorScheme($input) {
    $colorSchemes = yaBlogThemeGetColorSchemes();
    if (array_key_exists($input, $colorSchemes)) {
        return $input;
    }
    return 'default';
}

/**
 * Sanitize font family
 */
function yaBlogThemeSanitizeFontFamily($input) {
    $fonts = yaBlogThemeGetFonts();
    if (array_key_exists($input, $fonts)) {
        return $input;
    }
    return 'system';
}

/**
 * Sanitize checkbox
 */
function yaBlogThemeSanitizeCheckbox($input) {
    return ($input === true || $input === '1' || $input === 1) ? true : false;
}

/**
 * Output custom color scheme CSS
 */
function yaBlogThemeColorSchemeCSS() {
    $colorScheme = get_theme_mod('color_scheme', 'default');
    $colorSchemes = yaBlogThemeGetColorSchemes();

    if (!isset($colorSchemes[$colorScheme])) {
        $colorScheme = 'default';
    }

    $colors = $colorSchemes[$colorScheme];

    $css = "
    :root {
        --color-background: {$colors['background']};
        --color-text: {$colors['text']};
        --color-text-hover: {$colors['textHover']};
        --color-text-muted: {$colors['textMuted']};
        --color-border: {$colors['border']};
    }

    body {
        background-color: {$colors['background']};
        color: {$colors['text']};
    }

    a {
        color: {$colors['text']};
    }

    a:hover {
        color: {$colors['textHover']};
    }

    .site-title a {
        color: {$colors['textHover']};
    }

    .site-description {
        color: {$colors['textMuted']};
    }

    .main-navigation a {
        color: {$colors['textMuted']};
    }

    .main-navigation a:hover {
        color: {$colors['textHover']};
    }

    .site-header {
        border-bottom-color: {$colors['border']};
    }

    .post-list .entry-title a {
        color: {$colors['text']};
    }

    .post-list .entry-title a:hover {
        color: {$colors['textHover']};
    }

    .post-list .entry-excerpt {
        color: {$colors['textMuted']};
    }

    .site-footer {
        border-top-color: {$colors['border']};
        color: {$colors['textMuted']};
    }

    .footer-navigation a {
        color: {$colors['textMuted']};
    }

    .footer-navigation a:hover {
        color: {$colors['text']};
    }
    ";

    wp_add_inline_style('ya-blog-theme-style', $css);
}
add_action('wp_enqueue_scripts', 'yaBlogThemeColorSchemeCSS');

/**
 * Output custom font CSS
 */
function yaBlogThemeFontCSS() {
    $fontFamily = get_theme_mod('font_family', 'system');
    $fonts = yaBlogThemeGetFonts();

    if (!isset($fonts[$fontFamily])) {
        $fontFamily = 'system';
    }

    $family = $fonts[$fontFamily]['family'];

    $css = "
    body,
    .site-title,
    .entry-title,
    .entry-excerpt {
        font-family: {$family};
    }
    ";

    wp_add_inline_style('ya-blog-theme-style', $css);
}
add_action('wp_enqueue_scripts', 'yaBlogThemeFontCSS');

<?php
/**
 * Enhance That Theme Functions
 *
 * @package EnhanceThat
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Include custom menu walker
 */
require_once get_template_directory() . '/inc/class-menu-walker.php';

/**
 * Include brands marquee helpers
 */
require_once get_template_directory() . '/inc/brands-marquee-helpers.php';

/**
 * Include brands marquee customizer settings
 */
require_once get_template_directory() . '/inc/customizer-brands-marquee.php';

/**
 * Theme Setup
 */
function enhancethat_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Set default thumbnail size
    set_post_thumbnail_size(1200, 630, true);

    // Add additional image sizes
    add_image_size('enhancethat-blog-cover', 1200, 600, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'enhancethat'),
        'footer' => __('Footer Menu', 'enhancethat'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ));
}
add_action('after_setup_theme', 'enhancethat_setup');

/**
 * Enqueue Scripts and Styles
 */
function enhancethat_enqueue_scripts() {
    // Enqueue CSS
    wp_enqueue_style('enhancethat-normalize', get_template_directory_uri() . '/assets/css/normalize.css', array(), '1.0.0');
    wp_enqueue_style('enhancethat-components', get_template_directory_uri() . '/assets/css/components.css', array('enhancethat-normalize'), '1.0.0');
    wp_enqueue_style('enhancethat-main', get_template_directory_uri() . '/assets/css/enhancethat-dev.css', array('enhancethat-components'), '1.0.0');

    // Enqueue jQuery (WordPress includes it by default)
    wp_enqueue_script('jquery');

    // Enqueue Webflow's jQuery (required by enhancethat-dev.js)
    wp_enqueue_script('webflow-jquery', 'https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=67e2d2ad9cf973b5718af06d', array(), '3.5.1', true);

    // Enqueue theme main JavaScript (Webflow-generated, has jQuery dependency)
    wp_enqueue_script('enhancethat-main', get_template_directory_uri() . '/assets/js/enhancethat-dev.js', array('webflow-jquery'), '1.0.0', true);

    // Enqueue Lenis smooth scroll library (use unpkg UMD version)
    wp_enqueue_script('lenis', 'https://unpkg.com/@studio-freight/lenis@1.0.29/dist/lenis.min.js', array(), '1.0.29', true);

    // Enqueue GSAP and ScrollTrigger
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);

    // Enqueue SplitType for text animations
    wp_enqueue_script('splittype', 'https://cdn.jsdelivr.net/npm/split-type@0.3.3/umd/index.min.js', array(), '0.3.3', true);

    // Localize script for AJAX and theme paths
    wp_localize_script('enhancethat-main', 'enhancethat_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'theme_url' => get_template_directory_uri(),
        'home_url' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'enhancethat_enqueue_scripts');

/**
 * Add custom meta box for blog post subtitle
 */
function enhancethat_add_subtitle_meta_box() {
    add_meta_box(
        'enhancethat_subtitle',
        __('Post Subtitle', 'enhancethat'),
        'enhancethat_subtitle_meta_box_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'enhancethat_add_subtitle_meta_box');

function enhancethat_subtitle_meta_box_callback($post) {
    wp_nonce_field('enhancethat_save_subtitle', 'enhancethat_subtitle_nonce');
    $value = get_post_meta($post->ID, '_enhancethat_subtitle', true);
    echo '<input type="text" id="enhancethat_subtitle" name="enhancethat_subtitle" value="' . esc_attr($value) . '" style="width:100%;" placeholder="Enter subtitle (optional)">';
}

function enhancethat_save_subtitle($post_id) {
    if (!isset($_POST['enhancethat_subtitle_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['enhancethat_subtitle_nonce'], 'enhancethat_save_subtitle')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['enhancethat_subtitle'])) {
        update_post_meta($post_id, '_enhancethat_subtitle', sanitize_text_field($_POST['enhancethat_subtitle']));
    }
}
add_action('save_post', 'enhancethat_save_subtitle');

/**
 * Get post subtitle
 */
function enhancethat_get_subtitle($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_enhancethat_subtitle', true);
}

/**
 * Calculate reading time for posts
 */
function enhancethat_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $wordCount = str_word_count(strip_tags($content));
    $readingTime = ceil($wordCount / 200);
    return max(1, $readingTime);
}

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Disable emoji scripts
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/**
 * Add SEO meta tags for blog posts
 */
function enhancethat_seo_meta_tags() {
    if (!is_single()) {
        return;
    }

    global $post;
    $title = get_the_title();
    $subtitle = enhancethat_get_subtitle();
    $fullTitle = $title . ($subtitle ? ' - ' . $subtitle : '') . ' | ' . get_bloginfo('name');
    $description = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30);
    $url = get_permalink();
    $siteName = get_bloginfo('name');
    $siteUrl = home_url('/');

    // Featured image
    $imageUrl = '';
    if (has_post_thumbnail()) {
        $imageUrl = get_the_post_thumbnail_url(get_the_ID(), 'full');
    } else {
        $imageUrl = get_template_directory_uri() . '/assets/images/Social-share.jpg';
    }

    ?>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo esc_attr($fullTitle); ?>">
    <meta property="og:description" content="<?php echo esc_attr($description); ?>">
    <meta property="og:url" content="<?php echo esc_url($url); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($siteName); ?>">
    <meta property="og:image" content="<?php echo esc_url($imageUrl); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo esc_attr($title); ?>">
    <meta property="article:published_time" content="<?php echo get_the_date('c'); ?>">
    <meta property="article:author" content="<?php echo esc_attr(get_the_author()); ?>">
    <meta property="article:section" content="Technology">
    <meta property="article:tag" content="Fashion Technology, Digital Workflows, Automation">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($fullTitle); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($imageUrl); ?>">
    <meta name="twitter:site" content="@enhancethat">
    <meta name="twitter:creator" content="@enhancethat">

    <!-- Additional SEO -->
    <meta name="description" content="<?php echo esc_attr($description); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="<?php echo esc_attr(get_the_author()); ?>">
    <link rel="canonical" href="<?php echo esc_url($url); ?>">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "<?php echo esc_js($fullTitle); ?>",
      "description": "<?php echo esc_js($description); ?>",
      "image": "<?php echo esc_url($imageUrl); ?>",
      "author": {
        "@type": "Organization",
        "name": "<?php echo esc_js(get_the_author()); ?>",
        "url": "<?php echo esc_url($siteUrl); ?>"
      },
      "publisher": {
        "@type": "Organization",
        "name": "<?php echo esc_js($siteName); ?>",
        "url": "<?php echo esc_url($siteUrl); ?>",
        "logo": {
          "@type": "ImageObject",
          "url": "<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-enhance-that.svg"
        }
      },
      "datePublished": "<?php echo get_the_date('c'); ?>",
      "dateModified": "<?php echo get_the_modified_date('c'); ?>",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo esc_url($url); ?>"
      }
    }
    </script>
    <?php
}
add_action('wp_head', 'enhancethat_seo_meta_tags');

/**
 * Add custom meta box for blog post cover attribution
 */
function enhancethat_add_cover_attribution_meta_box() {
    add_meta_box(
        'enhancethat_cover_attribution',
        __('Cover Image Attribution', 'enhancethat'),
        'enhancethat_cover_attribution_meta_box_callback',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'enhancethat_add_cover_attribution_meta_box');

function enhancethat_cover_attribution_meta_box_callback($post) {
    wp_nonce_field('enhancethat_save_cover_attribution', 'enhancethat_cover_attribution_nonce');
    $value = get_post_meta($post->ID, '_enhancethat_cover_attribution', true);
    echo '<label for="enhancethat_cover_attribution">' . __('Photo credit (HTML allowed)', 'enhancethat') . '</label><br>';
    echo '<textarea id="enhancethat_cover_attribution" name="enhancethat_cover_attribution" rows="3" style="width:100%;" placeholder="e.g. Photo by John Doe on Unsplash">' . esc_textarea($value) . '</textarea>';
    echo '<p class="description">' . __('Optional. Supports HTML for links.', 'enhancethat') . '</p>';
}

function enhancethat_save_cover_attribution($post_id) {
    if (!isset($_POST['enhancethat_cover_attribution_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['enhancethat_cover_attribution_nonce'], 'enhancethat_save_cover_attribution')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['enhancethat_cover_attribution'])) {
        update_post_meta($post_id, '_enhancethat_cover_attribution', wp_kses_post($_POST['enhancethat_cover_attribution']));
    }
}
add_action('save_post', 'enhancethat_save_cover_attribution');

/**
 * Get post cover attribution
 */
function enhancethat_get_cover_attribution($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_enhancethat_cover_attribution', true);
}

/**
 * Theme activation hook
 *
 * Imports default brand logos to Media Library on theme activation.
 */
function enhancethat_theme_activation() {
    enhancethat_import_default_logos();
}
add_action('after_switch_theme', 'enhancethat_theme_activation');

<?php
/**
 * WordPress Homepage/Blog Diagnostic Script
 *
 * Upload this file to your WordPress root directory and visit it in a browser:
 * https://enhancethat.fashion/diagnose-production.php
 *
 * This will show you the current WordPress settings and help debug routing issues.
 */

define('WP_USE_THEMES', false);
require('./wp-load.php');

header('Content-Type: text/plain');

echo "=== WordPress Reading Settings Diagnostic ===\n\n";

// Get current settings
$showOnFront = get_option('show_on_front');
$pageOnFront = get_option('page_on_front');
$pageForPosts = get_option('page_for_posts');

echo "Current Settings:\n";
echo "----------------\n";
echo "show_on_front: " . $showOnFront . "\n";
echo "page_on_front: " . $pageOnFront . "\n";
echo "page_for_posts: " . $pageForPosts . "\n\n";

// Get page details
if ($pageOnFront) {
    $frontPage = get_post($pageOnFront);
    if ($frontPage) {
        echo "Front Page (ID: $pageOnFront):\n";
        echo "  Title: " . $frontPage->post_title . "\n";
        echo "  Slug: " . $frontPage->post_name . "\n";
        echo "  Status: " . $frontPage->post_status . "\n";
        echo "  URL: " . get_permalink($pageOnFront) . "\n\n";
    } else {
        echo "ERROR: Front page ID $pageOnFront does not exist!\n\n";
    }
} else {
    echo "No specific front page set (will use front-page.php template)\n\n";
}

if ($pageForPosts) {
    $postsPage = get_post($pageForPosts);
    if ($postsPage) {
        echo "Posts Page (ID: $pageForPosts):\n";
        echo "  Title: " . $postsPage->post_title . "\n";
        echo "  Slug: " . $postsPage->post_name . "\n";
        echo "  Status: " . $postsPage->post_status . "\n";
        echo "  URL: " . get_permalink($pageForPosts) . "\n\n";
    } else {
        echo "ERROR: Posts page ID $pageForPosts does not exist!\n\n";
    }
} else {
    echo "No posts page set\n\n";
}

// List all pages
echo "All Pages:\n";
echo "----------\n";
$pages = get_pages(array('sort_column' => 'ID'));
foreach ($pages as $page) {
    echo "ID: " . $page->ID . " | Title: " . $page->post_title . " | Slug: " . $page->post_name . " | Status: " . $page->post_status . "\n";
}
echo "\n";

// Check theme templates
echo "Theme Templates:\n";
echo "----------------\n";
$theme_root = get_template_directory();
$templates = array('front-page.php', 'home.php', 'page.php', 'single.php', 'index.php');
foreach ($templates as $template) {
    $exists = file_exists($theme_root . '/' . $template) ? 'EXISTS' : 'MISSING';
    echo "$template: $exists\n";
}
echo "\n";

// Permalink structure
echo "Permalink Structure:\n";
echo "--------------------\n";
echo get_option('permalink_structure') . "\n\n";

// Recommendations
echo "=== RECOMMENDATIONS ===\n\n";

if ($showOnFront !== 'page') {
    echo "⚠ ERROR: show_on_front should be 'page', currently: '$showOnFront'\n";
    echo "  Fix: Settings > Reading > 'Your homepage displays' > Select 'A static page'\n\n";
}

if ($showOnFront === 'page' && !$pageOnFront) {
    echo "⚠ WARNING: show_on_front is 'page' but page_on_front is not set (0)\n";
    echo "  This is OK if you want to use front-page.php template for homepage\n";
    echo "  Current setup: / will use front-page.php, /blog/ will use home.php\n\n";
}

if (!$pageForPosts) {
    echo "⚠ ERROR: No posts page set!\n";
    echo "  Fix: Settings > Reading > Posts page > Select 'Blog' page\n\n";
} else {
    $postsPage = get_post($pageForPosts);
    if (!$postsPage || $postsPage->post_status !== 'publish') {
        echo "⚠ ERROR: Posts page (ID: $pageForPosts) is not published or doesn't exist!\n\n";
    }
}

if ($pageOnFront && $pageOnFront === $pageForPosts) {
    echo "⚠ ERROR: Homepage and Posts page cannot be the same!\n\n";
}

// Expected configuration
echo "Expected Configuration:\n";
echo "-----------------------\n";
echo "show_on_front: 'page'\n";
echo "page_on_front: [ID of 'Homepage' page] OR 0 (to use front-page.php)\n";
echo "page_for_posts: [ID of 'Blog' page]\n\n";

echo "Expected URLs:\n";
echo "https://enhancethat.fashion/ → Uses front-page.php template (homepage)\n";
echo "https://enhancethat.fashion/blog/ → Uses home.php template (blog listing)\n\n";

echo "=== END DIAGNOSTIC ===\n";

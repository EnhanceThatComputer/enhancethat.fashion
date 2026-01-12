<?php
/**
 * WordPress Homepage/Blog Fix Script
 *
 * Upload this file to your WordPress root directory and visit it in a browser:
 * https://enhancethat.fashion/fix-production.php
 *
 * This will automatically configure the correct settings for homepage and blog routing.
 *
 * IMPORTANT: Delete this file after running it!
 */

define('WP_USE_THEMES', false);
require('./wp-load.php');

header('Content-Type: text/plain');

echo "=== WordPress Homepage/Blog Fix Script ===\n\n";

// Find the Homepage and Blog pages
$homepagePage = get_page_by_path('homepage');
$blogPage = get_page_by_path('blog');

echo "Step 1: Finding pages...\n";
echo "------------------------\n";

if ($homepagePage) {
    echo "✓ Found 'Homepage' page (ID: {$homepagePage->ID})\n";
} else {
    echo "✗ 'Homepage' page not found, will use front-page.php template instead\n";
}

if ($blogPage) {
    echo "✓ Found 'Blog' page (ID: {$blogPage->ID})\n";
} else {
    echo "✗ 'Blog' page not found!\n";
    echo "  Creating 'Blog' page...\n";
    $blogPageId = wp_insert_post(array(
        'post_title' => 'Blog',
        'post_name' => 'blog',
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_content' => ''
    ));
    if ($blogPageId) {
        $blogPage = get_post($blogPageId);
        echo "  ✓ Created 'Blog' page (ID: $blogPageId)\n";
    } else {
        echo "  ✗ ERROR: Failed to create 'Blog' page!\n";
        exit;
    }
}

echo "\nStep 2: Configuring reading settings...\n";
echo "----------------------------------------\n";

// Set reading settings
$homepageId = $homepagePage ? $homepagePage->ID : 0;
$blogId = $blogPage->ID;

update_option('show_on_front', 'page');
echo "✓ Set show_on_front to 'page'\n";

update_option('page_on_front', $homepageId);
if ($homepageId) {
    echo "✓ Set page_on_front to $homepageId (Homepage page)\n";
} else {
    echo "✓ Set page_on_front to 0 (will use front-page.php template)\n";
}

update_option('page_for_posts', $blogId);
echo "✓ Set page_for_posts to $blogId (Blog page)\n";

echo "\nStep 3: Flushing rewrite rules...\n";
echo "----------------------------------\n";
flush_rewrite_rules(true);
echo "✓ Rewrite rules flushed\n";

echo "\nStep 4: Verifying configuration...\n";
echo "-----------------------------------\n";

$verify_show_on_front = get_option('show_on_front');
$verify_page_on_front = get_option('page_on_front');
$verify_page_for_posts = get_option('page_for_posts');

echo "show_on_front: $verify_show_on_front " . ($verify_show_on_front === 'page' ? '✓' : '✗') . "\n";
echo "page_on_front: $verify_page_on_front " . ($verify_page_on_front == $homepageId ? '✓' : '✗') . "\n";
echo "page_for_posts: $verify_page_for_posts " . ($verify_page_for_posts == $blogId ? '✓' : '✗') . "\n";

echo "\n=== CONFIGURATION COMPLETE ===\n\n";

echo "Expected Results:\n";
echo "-----------------\n";
echo "https://enhancethat.fashion/ → Homepage with hero section\n";
echo "https://enhancethat.fashion/blog/ → Blog listing with cards\n\n";

echo "Next Steps:\n";
echo "-----------\n";
echo "1. Visit https://enhancethat.fashion/ (should show homepage)\n";
echo "2. Visit https://enhancethat.fashion/blog/ (should show blog listing)\n";
echo "3. Test in incognito/private browsing mode to avoid cache issues\n";
echo "4. If still not working, clear your browser cache (Ctrl+Shift+Delete)\n";
echo "5. IMPORTANT: Delete this file (fix-production.php) for security!\n\n";

echo "If you still see issues:\n";
echo "------------------------\n";
echo "1. Check your hosting caching (WP Super Cache, W3 Total Cache, Cloudflare)\n";
echo "2. Go to Settings > Permalinks and click 'Save Changes' (don't change anything)\n";
echo "3. Check if .htaccess file has proper WordPress rewrite rules\n\n";

echo "=== END ===\n";

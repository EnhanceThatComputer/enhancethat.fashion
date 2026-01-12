<?php
/**
 * Plugin Name: EnhanceThat Page Redirect
 * Plugin URI: https://enhancethat.com
 * Description: Allows pages to redirect to external URLs. Add a redirect URL in the page editor to automatically redirect visitors.
 * Version: 1.0.0
 * Author: EnhanceThat
 * Author URI: https://enhancethat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: enhancethat-redirect
 *
 * @package EnhanceThatRedirect
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add meta box to page editor
 */
function enhancethatRedirect_addMetaBox() {
    add_meta_box(
        'enhancethat_redirect_meta_box',
        'Page Redirect',
        'enhancethatRedirect_renderMetaBox',
        'page',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'enhancethatRedirect_addMetaBox');

/**
 * Render the meta box content
 *
 * @param WP_Post $post The post object
 */
function enhancethatRedirect_renderMetaBox($post) {
    // Add nonce for security
    wp_nonce_field('enhancethat_redirect_nonce_action', 'enhancethat_redirect_nonce');

    // Get current redirect URL
    $redirectUrl = get_post_meta($post->ID, '_enhancethat_redirect_url', true);
    $redirectType = get_post_meta($post->ID, '_enhancethat_redirect_type', true);

    // Default to 301 if not set
    if (empty($redirectType)) {
        $redirectType = '301';
    }
    ?>
    <div style="margin: 10px 0;">
        <label for="enhancethat_redirect_url" style="display: block; margin-bottom: 5px; font-weight: 600;">
            Redirect URL
        </label>
        <input
            type="url"
            id="enhancethat_redirect_url"
            name="enhancethat_redirect_url"
            value="<?php echo esc_attr($redirectUrl); ?>"
            placeholder="https://example.com"
            style="width: 100%; padding: 6px; border: 1px solid #ddd; border-radius: 3px;"
        />
        <p style="margin: 8px 0 0 0; font-size: 12px; color: #666;">
            If set, visitors will be redirected to this URL instead of viewing the page.
        </p>
    </div>

    <div style="margin: 15px 0 0 0;">
        <label for="enhancethat_redirect_type" style="display: block; margin-bottom: 5px; font-weight: 600;">
            Redirect Type
        </label>
        <select
            id="enhancethat_redirect_type"
            name="enhancethat_redirect_type"
            style="width: 100%; padding: 6px; border: 1px solid #ddd; border-radius: 3px;"
        >
            <option value="301" <?php selected($redirectType, '301'); ?>>301 - Permanent</option>
            <option value="302" <?php selected($redirectType, '302'); ?>>302 - Temporary</option>
        </select>
        <p style="margin: 8px 0 0 0; font-size: 12px; color: #666;">
            301 for permanent redirects, 302 for temporary redirects.
        </p>
    </div>
    <?php
}

/**
 * Save meta box data
 *
 * @param int $postId The post ID
 */
function enhancethatRedirect_saveMetaBox($postId) {
    // Check nonce
    if (!isset($_POST['enhancethat_redirect_nonce']) ||
        !wp_verify_nonce($_POST['enhancethat_redirect_nonce'], 'enhancethat_redirect_nonce_action')) {
        return;
    }

    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $postId)) {
        return;
    }

    // Save redirect URL
    if (isset($_POST['enhancethat_redirect_url'])) {
        $redirectUrl = esc_url_raw($_POST['enhancethat_redirect_url']);

        if (!empty($redirectUrl)) {
            update_post_meta($postId, '_enhancethat_redirect_url', $redirectUrl);
        } else {
            delete_post_meta($postId, '_enhancethat_redirect_url');
        }
    }

    // Save redirect type
    if (isset($_POST['enhancethat_redirect_type'])) {
        $redirectType = sanitize_text_field($_POST['enhancethat_redirect_type']);

        // Only allow 301 or 302
        if (in_array($redirectType, array('301', '302'))) {
            update_post_meta($postId, '_enhancethat_redirect_type', $redirectType);
        }
    }
}
add_action('save_post_page', 'enhancethatRedirect_saveMetaBox');

/**
 * Perform the redirect if a redirect URL is set
 */
function enhancethatRedirect_handleRedirect() {
    // Only redirect on single pages
    if (!is_page()) {
        return;
    }

    global $post;

    // Get redirect URL
    $redirectUrl = get_post_meta($post->ID, '_enhancethat_redirect_url', true);

    if (!empty($redirectUrl)) {
        // Get redirect type (default to 301)
        $redirectType = get_post_meta($post->ID, '_enhancethat_redirect_type', true);

        if (empty($redirectType)) {
            $redirectType = '301';
        }

        // Convert to integer for wp_redirect
        $statusCode = intval($redirectType);

        // Perform the redirect
        wp_redirect($redirectUrl, $statusCode);
        exit;
    }
}
add_action('template_redirect', 'enhancethatRedirect_handleRedirect', 1);

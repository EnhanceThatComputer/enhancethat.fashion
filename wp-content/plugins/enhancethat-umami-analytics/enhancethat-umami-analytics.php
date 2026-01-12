<?php
/**
 * Plugin Name: EnhanceThat Umami Analytics
 * Plugin URI: https://enhancethat.com
 * Description: Manages Umami Analytics tracking code. Configure your website ID and enable/disable tracking from the WordPress admin.
 * Version: 1.0.0
 * Author: EnhanceThat
 * Author URI: https://enhancethat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: enhancethat-umami
 *
 * @package EnhanceThatUmami
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Plugin version
define('ENHANCETHAT_UMAMI_VERSION', '1.0.0');

/**
 * Add settings page to admin menu
 */
function enhancethatUmami_addSettingsPage() {
    add_options_page(
        'Umami Analytics Settings',           // Page title
        'Umami Analytics',                     // Menu title
        'manage_options',                      // Capability
        'enhancethat-umami-settings',         // Menu slug
        'enhancethatUmami_renderSettingsPage' // Callback function
    );
}
add_action('admin_menu', 'enhancethatUmami_addSettingsPage');

/**
 * Register plugin settings
 */
function enhancethatUmami_registerSettings() {
    // Register enabled setting
    register_setting(
        'enhancethat_umami_settings_group',
        'enhancethat_umami_enabled',
        array(
            'type' => 'string',
            'sanitize_callback' => 'enhancethatUmami_sanitizeCheckbox',
            'default' => '0'
        )
    );

    // Register website ID setting
    register_setting(
        'enhancethat_umami_settings_group',
        'enhancethat_umami_website_id',
        array(
            'type' => 'string',
            'sanitize_callback' => 'enhancethatUmami_sanitizeWebsiteId',
            'default' => ''
        )
    );

    // Register script URL setting
    register_setting(
        'enhancethat_umami_settings_group',
        'enhancethat_umami_script_url',
        array(
            'type' => 'string',
            'sanitize_callback' => 'enhancethatUmami_sanitizeScriptUrl',
            'default' => 'https://cloud.umami.is/script.js'
        )
    );

    // Add settings section
    add_settings_section(
        'enhancethat_umami_main_section',
        'Analytics Configuration',
        'enhancethatUmami_renderSectionDescription',
        'enhancethat-umami-settings'
    );

    // Add settings fields
    add_settings_field(
        'enhancethat_umami_enabled',
        'Enable Tracking',
        'enhancethatUmami_renderEnabledField',
        'enhancethat-umami-settings',
        'enhancethat_umami_main_section'
    );

    add_settings_field(
        'enhancethat_umami_website_id',
        'Umami Website ID',
        'enhancethatUmami_renderWebsiteIdField',
        'enhancethat-umami-settings',
        'enhancethat_umami_main_section'
    );

    add_settings_field(
        'enhancethat_umami_script_url',
        'Umami Script URL',
        'enhancethatUmami_renderScriptUrlField',
        'enhancethat-umami-settings',
        'enhancethat_umami_main_section'
    );
}
add_action('admin_init', 'enhancethatUmami_registerSettings');

/**
 * Render section description
 */
function enhancethatUmami_renderSectionDescription() {
    echo '<p>Configure your Umami analytics tracking settings. The tracking script will be automatically added to all frontend pages when enabled.</p>';
}

/**
 * Render enabled checkbox field
 */
function enhancethatUmami_renderEnabledField() {
    $enabled = get_option('enhancethat_umami_enabled', '0');
    ?>
    <label>
        <input type="checkbox" name="enhancethat_umami_enabled" value="1" <?php checked($enabled, '1'); ?> />
        Enable Umami Analytics tracking on all pages
    </label>
    <?php
}

/**
 * Render website ID field
 */
function enhancethatUmami_renderWebsiteIdField() {
    $websiteId = get_option('enhancethat_umami_website_id', '');
    ?>
    <input
        type="text"
        name="enhancethat_umami_website_id"
        value="<?php echo esc_attr($websiteId); ?>"
        placeholder="df361236-30bc-42e3-b9f4-6582ea43b87e"
        style="width: 100%; max-width: 400px;"
        class="regular-text"
    />
    <p class="description">
        Enter your Umami website ID from your Umami dashboard. This is a UUID in the format: xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
    </p>
    <?php
}

/**
 * Render script URL field
 */
function enhancethatUmami_renderScriptUrlField() {
    $scriptUrl = get_option('enhancethat_umami_script_url', 'https://cloud.umami.is/script.js');
    ?>
    <input
        type="url"
        name="enhancethat_umami_script_url"
        value="<?php echo esc_attr($scriptUrl); ?>"
        placeholder="https://cloud.umami.is/script.js"
        style="width: 100%; max-width: 400px;"
        class="regular-text"
    />
    <p class="description">
        The URL to your Umami tracking script. Leave as default for Umami Cloud. Change only if you're self-hosting Umami.
    </p>
    <?php
}

/**
 * Sanitize checkbox value
 *
 * @param mixed $value The value to sanitize
 * @return string '1' if checked, '0' if not
 */
function enhancethatUmami_sanitizeCheckbox($value) {
    return ($value === '1' || $value === 1 || $value === true) ? '1' : '0';
}

/**
 * Sanitize and validate website ID
 *
 * @param string $value The website ID to validate
 * @return string Sanitized website ID
 */
function enhancethatUmami_sanitizeWebsiteId($value) {
    $value = sanitize_text_field($value);

    // Allow empty value
    if (empty($value)) {
        return '';
    }

    // Validate UUID format (8-4-4-4-12)
    if (!preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i', $value)) {
        add_settings_error(
            'enhancethat_umami_website_id',
            'invalid_website_id',
            'Invalid Website ID format. Please enter a valid UUID (e.g., df361236-30bc-42e3-b9f4-6582ea43b87e).',
            'error'
        );
        // Return previous value
        return get_option('enhancethat_umami_website_id', '');
    }

    return $value;
}

/**
 * Sanitize and validate script URL
 *
 * @param string $value The script URL to validate
 * @return string Sanitized script URL
 */
function enhancethatUmami_sanitizeScriptUrl($value) {
    $value = esc_url_raw($value);

    // Use default if empty
    if (empty($value)) {
        return 'https://cloud.umami.is/script.js';
    }

    // Validate HTTPS protocol
    if (strpos($value, 'https://') !== 0) {
        add_settings_error(
            'enhancethat_umami_script_url',
            'invalid_script_url',
            'Script URL must use HTTPS protocol for security.',
            'error'
        );
        // Return previous value or default
        return get_option('enhancethat_umami_script_url', 'https://cloud.umami.is/script.js');
    }

    // Validate it's a valid URL
    if (!filter_var($value, FILTER_VALIDATE_URL)) {
        add_settings_error(
            'enhancethat_umami_script_url',
            'invalid_url_format',
            'Invalid URL format. Please enter a valid HTTPS URL.',
            'error'
        );
        // Return previous value or default
        return get_option('enhancethat_umami_script_url', 'https://cloud.umami.is/script.js');
    }

    return $value;
}

/**
 * Render the settings page
 */
function enhancethatUmami_renderSettingsPage() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // Get current status for display
    $enabled = get_option('enhancethat_umami_enabled', '0');
    $websiteId = get_option('enhancethat_umami_website_id', '');
    $scriptUrl = get_option('enhancethat_umami_script_url', 'https://cloud.umami.is/script.js');

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <?php
        // Show status indicator
        echo '<div style="background: #fff; border: 1px solid #ccd0d4; padding: 15px; margin: 20px 0; border-radius: 4px;">';
        echo '<h3 style="margin-top: 0;">Current Status</h3>';

        if ($enabled === '1' && !empty($websiteId)) {
            echo '<p style="color: #46b450; font-weight: 600;">✓ Analytics Enabled</p>';
            echo '<p style="margin: 5px 0;">Tracking code will load on all frontend pages.</p>';
        } elseif ($enabled === '1' && empty($websiteId)) {
            echo '<p style="color: #dc3232; font-weight: 600;">⚠ Configuration Required</p>';
            echo '<p style="margin: 5px 0;">Analytics is enabled but no Website ID is set. Please enter your Website ID below.</p>';
        } else {
            echo '<p style="color: #999; font-weight: 600;">○ Analytics Disabled</p>';
            echo '<p style="margin: 5px 0;">Enable analytics tracking by checking the box below and entering your Website ID.</p>';
        }

        echo '</div>';

        // Show settings errors
        settings_errors('enhancethat_umami_website_id');
        settings_errors('enhancethat_umami_script_url');
        ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('enhancethat_umami_settings_group');
            do_settings_sections('enhancethat-umami-settings');
            submit_button('Save Settings');
            ?>
        </form>

        <div style="margin-top: 30px; padding: 15px; background: #f0f6fc; border-left: 4px solid #0073aa; border-radius: 4px;">
            <h3 style="margin-top: 0;">Need Help?</h3>
            <p>
                <strong>Where to find your Website ID:</strong><br>
                Log in to your Umami dashboard and navigate to Settings > Websites. Your Website ID is displayed for each website.
            </p>
            <p>
                <strong>Self-hosting Umami?</strong><br>
                If you're running your own Umami instance, update the Script URL to point to your server (e.g., https://analytics.yourdomain.com/script.js).
            </p>
            <p>
                <strong>Documentation:</strong> <a href="https://umami.is/docs" target="_blank" rel="noopener">Umami Documentation</a>
            </p>
        </div>
    </div>
    <?php
}

/**
 * Inject Umami tracking script into wp_head
 */
function enhancethatUmami_injectTrackingScript() {
    // Only load on frontend (not admin)
    if (is_admin()) {
        return;
    }

    // Check if analytics is enabled
    $enabled = get_option('enhancethat_umami_enabled', '0');
    if ($enabled !== '1') {
        return;
    }

    // Get website ID
    $websiteId = get_option('enhancethat_umami_website_id', '');
    if (empty($websiteId)) {
        return;
    }

    // Get script URL
    $scriptUrl = get_option('enhancethat_umami_script_url', 'https://cloud.umami.is/script.js');

    // Output tracking script
    echo sprintf(
        '<script defer src="%s" data-website-id="%s"></script>' . "\n",
        esc_url($scriptUrl),
        esc_attr($websiteId)
    );
}
add_action('wp_head', 'enhancethatUmami_injectTrackingScript');

/**
 * Add Settings link to plugin actions on Plugins page
 *
 * @param array $links Existing plugin action links
 * @return array Modified plugin action links
 */
function enhancethatUmami_addPluginActionLinks($links) {
    $settingsLink = '<a href="' . esc_url(admin_url('options-general.php?page=enhancethat-umami-settings')) . '">Settings</a>';
    array_unshift($links, $settingsLink);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'enhancethatUmami_addPluginActionLinks');

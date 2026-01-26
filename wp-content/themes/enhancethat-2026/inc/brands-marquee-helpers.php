<?php
/**
 * Brands Marquee Helper Functions
 *
 * Helper functions for managing and rendering brand logos in the homepage marquee section.
 *
 * @package EnhanceThat
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get default brand logo filenames
 *
 * Returns an array of default brand logo filenames that exist in the theme assets.
 *
 * @return array Array of default logo filenames keyed by logo slot (logo_1, logo_2, etc.)
 */
function enhancethat_get_default_brand_logos() {
    return array(
        'logo_1' => '67e3e4c69c42638b4af7efdc_CLO-logo.png',
        'logo_2' => '67e3e4bf975f7b545a420b48_HB.png',
        'logo_3' => '67e3e4e433c9f77ee842af9d_Tommy.png',
        'logo_4' => '67e3e52975e1622a029d3c11_Calvin-Klein.png',
        'logo_5' => '67e3e4cf5a42abd0a9eda17a_levis.png',
        'logo_6' => '67e3e4d5fd79612720ad0aa0_Strellson.png',
        'logo_7' => '67e3e4f281ea15e7bba4e9a2_LL-Bean.png',
        'logo_8' => '67e3e5caa4f8045aa3db3b93_MS.png',
    );
}

/**
 * Import default brand logos to Media Library
 *
 * Copies default logo files from theme assets to WordPress Media Library.
 * Runs once on theme activation and caches the result.
 *
 * @return array Array of attachment IDs keyed by logo slot, or empty array on failure
 */
function enhancethat_import_default_logos() {
    $importedOption = 'enhancethat_default_logos_imported';

    // Check if already imported
    $existingImport = get_option($importedOption);
    if ($existingImport && is_array($existingImport)) {
        // Verify attachments still exist
        $allExist = true;
        foreach ($existingImport as $attachmentId) {
            if (!get_post($attachmentId)) {
                $allExist = false;
                break;
            }
        }

        if ($allExist) {
            return $existingImport;
        }
    }

    // Import logos
    $defaultLogos = enhancethat_get_default_brand_logos();
    $themePath = get_template_directory();
    $importedIds = array();

    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    foreach ($defaultLogos as $logoKey => $filename) {
        $filePath = $themePath . '/assets/images/' . $filename;

        // Check if file exists
        if (!file_exists($filePath)) {
            continue;
        }

        // Read file data
        $fileData = file_get_contents($filePath);
        if ($fileData === false) {
            continue;
        }

        // Upload to WordPress
        $upload = wp_upload_bits($filename, null, $fileData);

        if ($upload['error']) {
            continue;
        }

        // Create attachment
        $fileType = wp_check_filetype($filename);
        $attachment = array(
            'post_mime_type' => $fileType['type'],
            'post_title' => sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME)),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attachmentId = wp_insert_attachment($attachment, $upload['file']);

        if (is_wp_error($attachmentId)) {
            continue;
        }

        // Generate metadata
        $attachmentData = wp_generate_attachment_metadata($attachmentId, $upload['file']);
        wp_update_attachment_metadata($attachmentId, $attachmentData);

        // Store attachment ID
        $importedIds[$logoKey] = $attachmentId;
    }

    // Cache the imported IDs
    if (!empty($importedIds)) {
        update_option($importedOption, $importedIds);
    }

    return $importedIds;
}

/**
 * Get brand logos from Customizer settings
 *
 * Retrieves brand logo attachment IDs from theme_mod settings.
 * Falls back to default logos if none are configured.
 *
 * @return array Array of valid attachment IDs
 */
function enhancethat_get_brand_logos() {
    $logos = get_theme_mod('enhancethat_brand_logos', array());

    // Filter out empty values and validate attachment IDs
    $validLogos = array();

    if (!empty($logos) && is_array($logos)) {
        foreach ($logos as $logoKey => $attachmentId) {
            $attachmentId = absint($attachmentId);

            // Skip if empty or attachment doesn't exist
            if ($attachmentId > 0 && get_post($attachmentId)) {
                $validLogos[] = $attachmentId;
            }
        }
    }

    // If no valid logos configured, use defaults
    if (empty($validLogos)) {
        $defaultImport = enhancethat_import_default_logos();

        if (!empty($defaultImport)) {
            $validLogos = array_values($defaultImport);
        }
    }

    return $validLogos;
}

/**
 * Render marquee logo items
 *
 * Outputs HTML for brand logo items in the marquee.
 * Generates proper markup with client-item wrapper and img tag.
 *
 * @param array $logos Array of attachment IDs
 */
function enhancethat_render_marquee_logos($logos) {
    if (empty($logos) || !is_array($logos)) {
        return;
    }

    foreach ($logos as $attachmentId) {
        $attachmentId = absint($attachmentId);

        // Get image URL
        $imageUrl = wp_get_attachment_url($attachmentId);

        if (!$imageUrl) {
            continue;
        }

        // Get alt text from attachment
        $altText = get_post_meta($attachmentId, '_wp_attachment_image_alt', true);
        if (empty($altText)) {
            $altText = get_the_title($attachmentId);
        }

        // Output HTML
        echo '<div class="client-item">';
        echo '<img src="' . esc_url($imageUrl) . '" loading="lazy" alt="' . esc_attr($altText) . '" class="client-image">';
        echo '</div>';
    }
}

/**
 * Render brands marquee partial for Customizer selective refresh
 *
 * Outputs the complete marquee content including 3 wrapper sets and cover divs.
 * Used as callback for Customizer selective refresh.
 */
function enhancethat_render_brands_marquee_partial() {
    $brandLogos = enhancethat_get_brand_logos();

    if (empty($brandLogos)) {
        return;
    }

    // Output 3 identical wrapper sets for seamless scrolling
    for ($i = 0; $i < 3; $i++) {
        echo '<div class="clients-wrapper">';
        echo '<div class="clients-list">';
        enhancethat_render_marquee_logos($brandLogos);
        echo '</div>';
        echo '</div>';
    }

    // Output gradient cover overlays
    echo '<div class="cover-left"></div>';
    echo '<div class="cover-right"></div>';
}

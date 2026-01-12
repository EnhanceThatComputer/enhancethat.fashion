<?php
/**
 * SEO Meta Boxes
 *
 * Adds per-post SEO override meta boxes to the post editor.
 * Allows customization of title, description, OG image, Twitter creator,
 * article section, and noindex setting on a per-post basis.
 *
 * @package EnhanceThat
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add SEO meta box to post editor
 */
function enhancethat_add_seo_meta_box() {
    add_meta_box(
        'enhancethat_seo_overrides',
        __('SEO Settings', 'enhancethat'),
        'enhancethat_seo_meta_box_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'enhancethat_add_seo_meta_box');

/**
 * Render SEO meta box content
 *
 * @param WP_Post $post Post object
 */
function enhancethat_seo_meta_box_callback($post) {
    wp_nonce_field('enhancethat_save_seo_overrides', 'enhancethat_seo_overrides_nonce');

    // Get current values
    $customTitle = get_post_meta($post->ID, '_enhancethat_seo_title', true);
    $customDescription = get_post_meta($post->ID, '_enhancethat_seo_description', true);
    $customOgImage = get_post_meta($post->ID, '_enhancethat_seo_og_image', true);
    $customTwitterCreator = get_post_meta($post->ID, '_enhancethat_seo_twitter_creator', true);
    $customArticleSection = get_post_meta($post->ID, '_enhancethat_seo_article_section', true);
    $noindex = get_post_meta($post->ID, '_enhancethat_seo_noindex', true);

    ?>
    <div class="enhancethat-seo-meta-box">
        <p>
            <label for="enhancethat_seo_title" style="display:block; margin-bottom:5px; font-weight:600;">
                <?php _e('Custom SEO Title', 'enhancethat'); ?>
            </label>
            <input
                type="text"
                id="enhancethat_seo_title"
                name="enhancethat_seo_title"
                value="<?php echo esc_attr($customTitle); ?>"
                style="width:100%;"
                placeholder="<?php _e('Leave blank to use post title', 'enhancethat'); ?>"
            >
            <span style="display:block; margin-top:3px; font-size:12px; color:#666;">
                <?php _e('Override the default title for search engines and social sharing.', 'enhancethat'); ?>
            </span>
        </p>

        <p>
            <label for="enhancethat_seo_description" style="display:block; margin-bottom:5px; font-weight:600;">
                <?php _e('Meta Description', 'enhancethat'); ?>
            </label>
            <textarea
                id="enhancethat_seo_description"
                name="enhancethat_seo_description"
                rows="3"
                style="width:100%;"
                placeholder="<?php _e('Leave blank to use excerpt', 'enhancethat'); ?>"
            ><?php echo esc_textarea($customDescription); ?></textarea>
            <span style="display:block; margin-top:3px; font-size:12px; color:#666;">
                <?php
                _e('Custom description for search engines and social cards. 150-160 characters recommended.', 'enhancethat');
                if ($customDescription) {
                    $charCount = strlen($customDescription);
                    echo ' ';
                    printf(__('Current: %d characters', 'enhancethat'), $charCount);
                }
                ?>
            </span>
        </p>

        <p>
            <label for="enhancethat_seo_og_image" style="display:block; margin-bottom:5px; font-weight:600;">
                <?php _e('Custom Open Graph Image', 'enhancethat'); ?>
            </label>
            <input
                type="hidden"
                id="enhancethat_seo_og_image"
                name="enhancethat_seo_og_image"
                value="<?php echo esc_attr($customOgImage); ?>"
            >
            <button type="button" class="button" id="enhancethat_seo_og_image_button">
                <?php _e('Select Image', 'enhancethat'); ?>
            </button>
            <button type="button" class="button" id="enhancethat_seo_og_image_remove" style="<?php echo $customOgImage ? '' : 'display:none;'; ?>">
                <?php _e('Remove Image', 'enhancethat'); ?>
            </button>
            <div id="enhancethat_seo_og_image_preview" style="margin-top:10px;">
                <?php if ($customOgImage): ?>
                    <?php echo wp_get_attachment_image($customOgImage, 'medium'); ?>
                <?php endif; ?>
            </div>
            <span style="display:block; margin-top:3px; font-size:12px; color:#666;">
                <?php _e('Override featured image for social sharing. Recommended: 1200×630px.', 'enhancethat'); ?>
            </span>
        </p>

        <p>
            <label for="enhancethat_seo_twitter_creator" style="display:block; margin-bottom:5px; font-weight:600;">
                <?php _e('Twitter Creator Handle', 'enhancethat'); ?>
            </label>
            <input
                type="text"
                id="enhancethat_seo_twitter_creator"
                name="enhancethat_seo_twitter_creator"
                value="<?php echo esc_attr($customTwitterCreator); ?>"
                style="width:100%;"
                placeholder="<?php echo esc_attr('@' . get_theme_mod('enhancethat_seo_twitter_creator', 'enhancethat')); ?>"
            >
            <span style="display:block; margin-top:3px; font-size:12px; color:#666;">
                <?php _e('Override default Twitter creator (e.g., @johndoe for guest posts).', 'enhancethat'); ?>
            </span>
        </p>

        <p>
            <label for="enhancethat_seo_article_section" style="display:block; margin-bottom:5px; font-weight:600;">
                <?php _e('Article Section Override', 'enhancethat'); ?>
            </label>
            <input
                type="text"
                id="enhancethat_seo_article_section"
                name="enhancethat_seo_article_section"
                value="<?php echo esc_attr($customArticleSection); ?>"
                style="width:100%;"
                placeholder="<?php _e('Leave blank to use category', 'enhancethat'); ?>"
            >
            <span style="display:block; margin-top:3px; font-size:12px; color:#666;">
                <?php _e('Override default article section (e.g., Case Studies, Tutorials).', 'enhancethat'); ?>
            </span>
        </p>

        <p>
            <label style="display:block; margin-bottom:5px; font-weight:600;">
                <input
                    type="checkbox"
                    id="enhancethat_seo_noindex"
                    name="enhancethat_seo_noindex"
                    value="1"
                    <?php checked($noindex, '1'); ?>
                >
                <?php _e('Hide from Search Engines', 'enhancethat'); ?>
            </label>
            <span style="display:block; margin-left:25px; font-size:12px; color:#666;">
                <?php _e('Check to add noindex meta tag (exclude from search results).', 'enhancethat'); ?>
            </span>
        </p>
    </div>

    <script>
    jQuery(document).ready(function($) {
        var fileFrame;
        var imageField = $('#enhancethat_seo_og_image');
        var imagePreview = $('#enhancethat_seo_og_image_preview');
        var removeButton = $('#enhancethat_seo_og_image_remove');

        // Select image button
        $('#enhancethat_seo_og_image_button').on('click', function(e) {
            e.preventDefault();

            if (fileFrame) {
                fileFrame.open();
                return;
            }

            fileFrame = wp.media({
                title: '<?php _e('Select Open Graph Image', 'enhancethat'); ?>',
                button: {
                    text: '<?php _e('Use this image', 'enhancethat'); ?>',
                },
                multiple: false
            });

            fileFrame.on('select', function() {
                var attachment = fileFrame.state().get('selection').first().toJSON();
                imageField.val(attachment.id);

                if (attachment.sizes && attachment.sizes.medium) {
                    imagePreview.html('<img src="' + attachment.sizes.medium.url + '" style="max-width:100%;">');
                } else {
                    imagePreview.html('<img src="' + attachment.url + '" style="max-width:100%;">');
                }

                removeButton.show();
            });

            fileFrame.open();
        });

        // Remove image button
        removeButton.on('click', function(e) {
            e.preventDefault();
            imageField.val('');
            imagePreview.html('');
            removeButton.hide();
        });
    });
    </script>

    <style>
    .enhancethat-seo-meta-box p {
        margin: 0 0 15px 0;
    }
    .enhancethat-seo-meta-box label {
        cursor: pointer;
    }
    #enhancethat_seo_og_image_preview img {
        max-width: 300px;
        height: auto;
        border: 1px solid #ddd;
        padding: 5px;
        background: #fff;
    }
    </style>
    <?php
}

/**
 * Save SEO meta box data
 *
 * @param int $postId Post ID
 */
function enhancethat_save_seo_overrides($postId) {
    // Check nonce
    if (!isset($_POST['enhancethat_seo_overrides_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['enhancethat_seo_overrides_nonce'], 'enhancethat_save_seo_overrides')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $postId)) {
        return;
    }

    // Save custom SEO title
    if (isset($_POST['enhancethat_seo_title'])) {
        update_post_meta($postId, '_enhancethat_seo_title', sanitize_text_field($_POST['enhancethat_seo_title']));
    }

    // Save custom description
    if (isset($_POST['enhancethat_seo_description'])) {
        update_post_meta($postId, '_enhancethat_seo_description', sanitize_textarea_field($_POST['enhancethat_seo_description']));
    }

    // Save custom OG image
    if (isset($_POST['enhancethat_seo_og_image'])) {
        update_post_meta($postId, '_enhancethat_seo_og_image', absint($_POST['enhancethat_seo_og_image']));
    }

    // Save custom Twitter creator
    if (isset($_POST['enhancethat_seo_twitter_creator'])) {
        $handle = sanitize_text_field($_POST['enhancethat_seo_twitter_creator']);
        if ($handle) {
            $handle = enhancethat_sanitize_twitter_handle($handle);
        }
        update_post_meta($postId, '_enhancethat_seo_twitter_creator', $handle);
    }

    // Save custom article section
    if (isset($_POST['enhancethat_seo_article_section'])) {
        update_post_meta($postId, '_enhancethat_seo_article_section', sanitize_text_field($_POST['enhancethat_seo_article_section']));
    }

    // Save noindex checkbox
    if (isset($_POST['enhancethat_seo_noindex'])) {
        update_post_meta($postId, '_enhancethat_seo_noindex', '1');
    } else {
        delete_post_meta($postId, '_enhancethat_seo_noindex');
    }
}
add_action('save_post', 'enhancethat_save_seo_overrides');

/**
 * Enqueue media uploader on post edit screen
 */
function enhancethat_enqueue_seo_meta_box_scripts() {
    global $post_type;

    if ('post' === $post_type) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'enhancethat_enqueue_seo_meta_box_scripts');

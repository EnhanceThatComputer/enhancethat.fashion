<?php
/**
 * SEO Helper Functions
 *
 * Helper functions for retrieving SEO data with proper fallback chains,
 * sanitization utilities, and structured data (JSON-LD) output functions.
 *
 * @package EnhanceThat
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get SEO-optimized title for current page/post
 *
 * Fallback chain:
 * 1. Per-post custom SEO title (_enhancethat_seo_title)
 * 2. Post title + subtitle (for posts)
 * 3. Page title (for pages)
 * 4. Archive title (for archives)
 * 5. Site name + tagline (for homepage)
 *
 * @param int|null $postId Post ID (null for current post/page)
 * @return string SEO title
 */
function enhancethat_get_seo_title($postId = null) {
    static $cache = array();

    if (!$postId) {
        $postId = get_the_ID();
    }

    $cacheKey = $postId ? $postId : 'global_' . (is_front_page() ? 'home' : (is_archive() ? 'archive' : 'other'));

    if (isset($cache[$cacheKey])) {
        return $cache[$cacheKey];
    }

    $title = '';

    // Homepage
    if (is_front_page()) {
        $siteName = get_bloginfo('name');
        $tagline = get_bloginfo('description');
        $title = $tagline ? $siteName . ' | ' . $tagline : $siteName;
    }
    // Single post or page
    elseif ($postId) {
        // Check for custom SEO title override
        $customTitle = get_post_meta($postId, '_enhancethat_seo_title', true);
        if ($customTitle) {
            $title = $customTitle;
        } else {
            // Use post/page title
            $postTitle = get_the_title($postId);
            $subtitle = enhancethat_get_subtitle($postId);
            $siteName = get_bloginfo('name');

            if ($subtitle) {
                $title = $postTitle . ' | ' . $subtitle . ' | ' . $siteName;
            } else {
                $title = $postTitle . ' | ' . $siteName;
            }
        }
    }
    // Archive pages
    elseif (is_archive()) {
        if (is_category()) {
            $title = single_cat_title('', false) . ' | ' . get_bloginfo('name');
        } elseif (is_tag()) {
            $title = single_tag_title('', false) . ' | ' . get_bloginfo('name');
        } elseif (is_author()) {
            $title = get_the_author() . ' | ' . get_bloginfo('name');
        } elseif (is_date()) {
            $title = get_the_archive_title() . ' | ' . get_bloginfo('name');
        } else {
            $title = get_the_archive_title() . ' | ' . get_bloginfo('name');
        }
    }
    // Search results
    elseif (is_search()) {
        $title = 'Search Results for "' . get_search_query() . '" | ' . get_bloginfo('name');
    }
    // Fallback
    else {
        $title = get_bloginfo('name');
    }

    $cache[$cacheKey] = $title;
    return $title;
}

/**
 * Get meta description for current page/post
 *
 * Fallback chain:
 * 1. Per-post custom description (_enhancethat_seo_description)
 * 2. Post excerpt (if exists)
 * 3. Trimmed post content (first 30 words)
 * 4. Category description (for archives)
 * 5. Site tagline (for homepage)
 *
 * @param int|null $postId Post ID (null for current post/page)
 * @return string Meta description
 */
function enhancethat_get_seo_description($postId = null) {
    static $cache = array();

    if (!$postId) {
        $postId = get_the_ID();
    }

    $cacheKey = $postId ? $postId : 'global_' . (is_front_page() ? 'home' : (is_archive() ? 'archive' : 'other'));

    if (isset($cache[$cacheKey])) {
        return $cache[$cacheKey];
    }

    $description = '';

    // Homepage
    if (is_front_page()) {
        $description = get_bloginfo('description');
        if (!$description) {
            $description = 'Digital design workflow company specializing in automation and integration for fashion brands.';
        }
    }
    // Single post or page
    elseif ($postId) {
        // Check for custom SEO description override
        $customDescription = get_post_meta($postId, '_enhancethat_seo_description', true);
        if ($customDescription) {
            $description = $customDescription;
        } else {
            // Try excerpt
            $excerpt = get_the_excerpt($postId);
            if ($excerpt) {
                $description = $excerpt;
            } else {
                // Use trimmed content
                $content = get_post_field('post_content', $postId);
                $contentStripped = strip_tags($content);
                $words = str_word_count($contentStripped, 2);
                $firstWords = array_slice($words, 0, 30, true);
                $description = '';
                foreach ($firstWords as $pos => $word) {
                    $description .= $word . ' ';
                }
                $description = trim($description);
                if (str_word_count($contentStripped) > 30) {
                    $description .= '...';
                }
            }
        }
    }
    // Category archive
    elseif (is_category()) {
        $description = category_description();
        if (!$description) {
            $description = 'View all posts in ' . single_cat_title('', false);
        }
    }
    // Tag archive
    elseif (is_tag()) {
        $description = tag_description();
        if (!$description) {
            $description = 'View all posts tagged with ' . single_tag_title('', false);
        }
    }
    // Author archive
    elseif (is_author()) {
        $description = get_the_author_meta('description');
        if (!$description) {
            $description = 'Posts by ' . get_the_author();
        }
    }
    // Fallback
    else {
        $description = get_bloginfo('description');
    }

    // Clean up description
    $description = strip_tags($description);
    $description = trim($description);

    $cache[$cacheKey] = $description;
    return $description;
}

/**
 * Get Open Graph image URL
 *
 * Fallback chain:
 * 1. Per-post custom OG image (_enhancethat_seo_og_image)
 * 2. Post featured image (full size)
 * 3. Customizer default OG image (enhancethat_seo_default_og_image)
 * 4. Hardcoded fallback (Social-share.jpg)
 *
 * @param int|null $postId Post ID (null for current post/page)
 * @return string Image URL
 */
function enhancethat_get_og_image_url($postId = null) {
    static $cache = array();

    if (!$postId) {
        $postId = get_the_ID();
    }

    $cacheKey = $postId ? $postId : 'global';

    if (isset($cache[$cacheKey])) {
        return $cache[$cacheKey];
    }

    $imageUrl = '';

    // Check for per-post custom OG image
    if ($postId) {
        $customImageId = get_post_meta($postId, '_enhancethat_seo_og_image', true);
        if ($customImageId) {
            $imageUrl = wp_get_attachment_image_url($customImageId, 'full');
        }
    }

    // Check for featured image
    if (!$imageUrl && $postId) {
        $imageUrl = get_the_post_thumbnail_url($postId, 'full');
    }

    // Check for customizer default OG image
    if (!$imageUrl) {
        $defaultImageId = get_theme_mod('enhancethat_seo_default_og_image', 0);
        if ($defaultImageId) {
            $imageUrl = wp_get_attachment_image_url($defaultImageId, 'full');
        }
    }

    // Fallback to hardcoded image
    if (!$imageUrl) {
        $imageUrl = get_template_directory_uri() . '/assets/images/Social-share.jpg';
    }

    $cache[$cacheKey] = $imageUrl;
    return $imageUrl;
}

/**
 * Get Twitter creator handle
 *
 * Fallback chain:
 * 1. Per-post override (_enhancethat_seo_twitter_creator)
 * 2. Customizer default (enhancethat_seo_twitter_creator)
 * 3. Hardcoded fallback (@enhancethat)
 *
 * @param int|null $postId Post ID (null for current post)
 * @return string Twitter handle (with @ prefix)
 */
function enhancethat_get_twitter_creator($postId = null) {
    static $cache = array();

    if (!$postId) {
        $postId = get_the_ID();
    }

    $cacheKey = $postId ? $postId : 'global';

    if (isset($cache[$cacheKey])) {
        return $cache[$cacheKey];
    }

    $handle = '';

    // Check for per-post override
    if ($postId) {
        $handle = get_post_meta($postId, '_enhancethat_seo_twitter_creator', true);
    }

    // Check customizer default
    if (!$handle) {
        $handle = get_theme_mod('enhancethat_seo_twitter_creator', '@enhancethat');
    }

    // Ensure @ prefix
    $handle = enhancethat_sanitize_twitter_handle($handle);

    $cache[$cacheKey] = $handle;
    return $handle;
}

/**
 * Get Twitter site handle
 *
 * @return string Twitter handle (with @ prefix)
 */
function enhancethat_get_twitter_site() {
    $handle = get_theme_mod('enhancethat_seo_twitter_site', '@enhancethat');
    return enhancethat_sanitize_twitter_handle($handle);
}

/**
 * Get article section for schema.org
 *
 * Fallback chain:
 * 1. Per-post override (_enhancethat_seo_article_section)
 * 2. Primary category name (if exists)
 * 3. Customizer default (enhancethat_seo_article_section)
 * 4. Hardcoded fallback ("Technology")
 *
 * @param int|null $postId Post ID (null for current post)
 * @return string Article section
 */
function enhancethat_get_article_section($postId = null) {
    static $cache = array();

    if (!$postId) {
        $postId = get_the_ID();
    }

    if (isset($cache[$postId])) {
        return $cache[$postId];
    }

    $section = '';

    // Check for per-post override
    if ($postId) {
        $section = get_post_meta($postId, '_enhancethat_seo_article_section', true);
    }

    // Check for primary category
    if (!$section && $postId) {
        $categories = get_the_category($postId);
        if (!empty($categories)) {
            $section = $categories[0]->name;
        }
    }

    // Check customizer default
    if (!$section) {
        $section = get_theme_mod('enhancethat_seo_article_section', 'Technology');
    }

    $cache[$postId] = $section;
    return $section;
}

/**
 * Get article tags for schema.org
 *
 * Fallback chain:
 * 1. Post tags (if assigned)
 * 2. Customizer default (enhancethat_seo_article_tags)
 * 3. Hardcoded fallback ("Fashion Technology, Digital Workflows, Automation")
 *
 * @param int|null $postId Post ID (null for current post)
 * @return string Comma-separated tags
 */
function enhancethat_get_article_tags($postId = null) {
    static $cache = array();

    if (!$postId) {
        $postId = get_the_ID();
    }

    if (isset($cache[$postId])) {
        return $cache[$postId];
    }

    $tags = '';

    // Check for post tags
    if ($postId) {
        $postTags = get_the_tags($postId);
        if ($postTags && !is_wp_error($postTags)) {
            $tagNames = array();
            foreach ($postTags as $tag) {
                $tagNames[] = $tag->name;
            }
            $tags = implode(', ', $tagNames);
        }
    }

    // Check customizer default
    if (!$tags) {
        $tags = get_theme_mod('enhancethat_seo_article_tags', 'Fashion Technology, Digital Workflows, Automation');
    }

    $cache[$postId] = $tags;
    return $tags;
}

/**
 * Get canonical URL for current page
 *
 * @return string Canonical URL
 */
function enhancethat_get_canonical_url() {
    $canonicalUrl = '';

    if (is_singular()) {
        $canonicalUrl = get_permalink();
    } elseif (is_front_page()) {
        $canonicalUrl = home_url('/');
    } elseif (is_category()) {
        $canonicalUrl = get_term_link(get_queried_object());
    } elseif (is_tag()) {
        $canonicalUrl = get_term_link(get_queried_object());
    } elseif (is_author()) {
        $canonicalUrl = get_author_posts_url(get_queried_object_id());
    } elseif (is_archive()) {
        $canonicalUrl = get_term_link(get_queried_object());
    } elseif (is_search()) {
        $canonicalUrl = get_search_link();
    } else {
        $canonicalUrl = home_url('/');
    }

    // Handle pagination
    if (is_paged()) {
        global $wp_query;
        $pagedNum = get_query_var('paged') ? get_query_var('paged') : 1;
        if ($pagedNum > 1) {
            if (is_front_page()) {
                $canonicalUrl = home_url('/page/' . $pagedNum . '/');
            } else {
                $canonicalUrl = trailingslashit($canonicalUrl) . 'page/' . $pagedNum . '/';
            }
        }
    }

    return $canonicalUrl;
}

/**
 * Get page type for schema.org
 *
 * @return string Page type (article, webpage, homepage, archive)
 */
function enhancethat_get_page_type() {
    if (is_front_page()) {
        return 'homepage';
    } elseif (is_single()) {
        return 'article';
    } elseif (is_page()) {
        return 'webpage';
    } elseif (is_archive() || is_search()) {
        return 'archive';
    } else {
        return 'webpage';
    }
}

/**
 * Check if current page should be noindexed
 *
 * @param int|null $postId Post ID (null for current post)
 * @return bool True if should be noindexed
 */
function enhancethat_is_noindex($postId = null) {
    if (!$postId) {
        $postId = get_the_ID();
    }

    // Check per-post noindex setting
    if ($postId) {
        $noindex = get_post_meta($postId, '_enhancethat_seo_noindex', true);
        if ($noindex) {
            return true;
        }
    }

    // Check WordPress core noindex
    if (get_option('blog_public') == '0') {
        return true;
    }

    return false;
}

/**
 * Output Organization JSON-LD schema for homepage
 */
function enhancethat_output_organization_schema() {
    $orgName = get_theme_mod('enhancethat_seo_org_name', 'Enhance That');
    $orgDescription = get_theme_mod('enhancethat_seo_org_description', 'Digital design workflow company specializing in automation and integration for fashion brands.');
    $orgLogoId = get_theme_mod('enhancethat_seo_org_logo', 0);
    $orgContactType = get_theme_mod('enhancethat_seo_org_contact_type', 'general');
    $orgContactEmail = get_theme_mod('enhancethat_seo_org_contact_email', '');
    $orgLinkedin = get_theme_mod('enhancethat_seo_org_linkedin', 'https://www.linkedin.com/company/enhancethat/?originalSubdomain=nl');
    $orgAdditionalSocials = get_theme_mod('enhancethat_seo_org_additional_socials', '');

    // Get logo URL
    $logoUrl = '';
    if ($orgLogoId) {
        $logoUrl = wp_get_attachment_image_url($orgLogoId, 'full');
    }
    if (!$logoUrl) {
        $logoUrl = get_template_directory_uri() . '/assets/images/logo-enhance-that.svg';
    }

    // Build social profiles array
    $sameAs = array();
    if ($orgLinkedin) {
        $sameAs[] = esc_url($orgLinkedin);
    }
    if ($orgAdditionalSocials) {
        $additionalUrls = explode("\n", $orgAdditionalSocials);
        foreach ($additionalUrls as $url) {
            $url = trim($url);
            if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
                $sameAs[] = esc_url($url);
            }
        }
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $orgName,
        'description' => $orgDescription,
        'url' => home_url('/'),
        'logo' => array(
            '@type' => 'ImageObject',
            'url' => $logoUrl,
        ),
    );

    // Add contact point if email is provided
    if ($orgContactEmail) {
        $schema['contactPoint'] = array(
            '@type' => 'ContactPoint',
            'contactType' => $orgContactType,
            'email' => $orgContactEmail,
        );
    }

    // Add social profiles
    if (!empty($sameAs)) {
        $schema['sameAs'] = $sameAs;
    }

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n";
    echo '</script>' . "\n";
}

/**
 * Output Article JSON-LD schema for blog posts
 *
 * @param int $postId Post ID
 */
function enhancethat_output_article_schema($postId) {
    $title = get_the_title($postId);
    $subtitle = enhancethat_get_subtitle($postId);
    if ($subtitle) {
        $title .= ' | ' . $subtitle;
    }

    $description = enhancethat_get_seo_description($postId);
    $imageUrl = enhancethat_get_og_image_url($postId);
    $author = get_the_author_meta('display_name', get_post_field('post_author', $postId));
    $publishedTime = get_the_date('c', $postId);
    $modifiedTime = get_the_modified_date('c', $postId);
    $permalink = get_permalink($postId);

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $title,
        'description' => $description,
        'image' => $imageUrl,
        'author' => array(
            '@type' => 'Person',
            'name' => $author,
        ),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => get_bloginfo('name'),
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => get_template_directory_uri() . '/assets/images/logo-enhance-that.svg',
            ),
        ),
        'datePublished' => $publishedTime,
        'dateModified' => $modifiedTime,
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => $permalink,
        ),
    );

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n";
    echo '</script>' . "\n";
}

/**
 * Output WebPage JSON-LD schema for static pages
 *
 * @param int $postId Page ID
 */
function enhancethat_output_webpage_schema($postId) {
    $title = get_the_title($postId);
    $description = enhancethat_get_seo_description($postId);
    $canonicalUrl = get_permalink($postId);

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => $title,
        'description' => $description,
        'url' => $canonicalUrl,
        'isPartOf' => array(
            '@type' => 'WebSite',
            'name' => get_bloginfo('name'),
            'url' => home_url('/'),
        ),
    );

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n";
    echo '</script>' . "\n";
}

/**
 * Sanitize Twitter handle
 *
 * Ensures @ prefix and trims whitespace
 *
 * @param string $handle Twitter handle
 * @return string Sanitized handle
 */
function enhancethat_sanitize_twitter_handle($handle) {
    $handle = sanitize_text_field($handle);
    $handle = trim($handle);

    // Remove @ if exists, then add it back
    $handle = ltrim($handle, '@');

    // Add @ prefix if handle is not empty
    if ($handle) {
        $handle = '@' . $handle;
    }

    return $handle;
}

/**
 * Sanitize social media URLs
 *
 * Validates URLs line by line and returns array of valid URLs
 *
 * @param string $urls URLs separated by newlines
 * @return string Valid URLs joined by newlines
 */
function enhancethat_sanitize_social_urls($urls) {
    $urlsArray = explode("\n", $urls);
    $validUrls = array();

    foreach ($urlsArray as $url) {
        $url = trim($url);
        if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
            $validUrls[] = esc_url_raw($url);
        }
    }

    return implode("\n", $validUrls);
}

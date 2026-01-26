<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>
<body <?php body_class(is_front_page() ? 'has-fp-nav ' . enhancethat2026GetThemeClass() : enhancethat2026GetThemeClass()); ?>>
<?php wp_body_open(); ?>

<a href="#main-content" class="skip-link">Skip to main content</a>

<?php if (is_front_page()) : ?>
<!-- Front Page Navigation -->
<nav class="fp-nav" role="navigation">
    <div class="fp-nav-container">
        <ul class="fp-nav-menu">
            <?php
            $navItem1Text = get_theme_mod('enhancethat_nav_item_1_text', 'How we work');
            $navItem1Url = get_theme_mod('enhancethat_nav_item_1_url', '#how-we-work');
            $navItem2Text = get_theme_mod('enhancethat_nav_item_2_text', 'What drives us');
            $navItem2Url = get_theme_mod('enhancethat_nav_item_2_url', '#what-we-change');
            $navItem3Text = get_theme_mod('enhancethat_nav_item_3_text', 'Case Studies');
            $navItem3Url = get_theme_mod('enhancethat_nav_item_3_url', '#case-studies');
            ?>
            <li><a href="<?php echo esc_url($navItem1Url); ?>" class="fp-nav-link"><?php echo esc_html($navItem1Text); ?></a></li>
            <li><a href="<?php echo esc_url($navItem2Url); ?>" class="fp-nav-link"><?php echo esc_html($navItem2Text); ?></a></li>
            <li><a href="<?php echo esc_url($navItem3Url); ?>" class="fp-nav-link"><?php echo esc_html($navItem3Text); ?></a></li>
        </ul>
    </div>
</nav>
<?php else : ?>
<!-- Standard Navigation -->
<nav class="nav-2026" role="navigation">
    <div class="nav-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
            <?php bloginfo('name'); ?>
        </a>
        <div class="nav-menu">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'items_wrap' => '%3$s',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 1,
                    'fallback_cb' => false,
                ));
            } else {
                echo '<a href="' . esc_url(home_url('/blog/')) . '" class="nav-link">Blog</a>';
                echo '<a href="https://outlook.office365.com/owa/calendar/EnhanceThat@enhancethat.fashion/bookings/s/ykcAmlR2zkiMHzfWw-WJLQ2" target="_blank" rel="noopener" class="nav-link nav-cta">Schedule a call</a>';
            }
            ?>
        </div>
    </div>
</nav>
<?php endif; ?>

<main id="main-content" class="site-main" role="main">

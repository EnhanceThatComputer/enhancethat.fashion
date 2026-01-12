<!DOCTYPE html>
<html <?php language_attributes(); ?> data-wf-page="67e2d2ad9cf973b5718af06b" data-wf-site="67e2d2ad9cf973b5718af06d">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta content="width=device-width, initial-scale=1" name="viewport">

  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>

  <?php wp_head(); ?>

  <style>
  input {
  	border-radius:0 !important;
  }
  .section {
  	outline:0 !important;
  }
  .w-webflow-badge {
  	display:none !important;
  }
  input {
  	outline:0 !important;
  }
  /* Ensure page wrapper is visible and not stretched */
  .page-wrapper {
    opacity: 1 !important;
    transform: translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0) !important;
  }
  .navbar {
    transform: translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0) !important;
  }
  </style>
  <style>
.split-type .word, .split-type-delayed .word {
    transform: translateY(100%);
    display: inline-block;
}
.split-type .line, .split-type-delayed .line {
    overflow: hidden;
    display: block;
}
</style>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <div class="css w-embed">
    <style>
* {
	  text-rendering: optimizeLegibility;
    -moz-osx-font-smoothing: grayscale;
    font-smoothing: antialiased;
    -webkit-font-smoothing: antialiased;
}
</style>
    <style>
  .is-liquid {
    filter: url(#liquidFilter);
    display: block;
    width: 100%;
  }
@media only screen and (max-width: 991px) {
  #liquidFilter {
  	display:none !important;
  }
}
</style>
  </div>
  <div style="-webkit-transform:translate3d(0, -80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, -80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, -80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, -80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="navbar">
    <div class="container hspread less-margins">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link w-inline-block">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-enhance-that.svg" loading="lazy" alt="<?php bloginfo('name'); ?>" class="company-logo-white">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-inverted.svg" loading="lazy" alt="<?php bloginfo('name'); ?>" class="company-logo-blue">
      </a>
      <div class="button-group">
        <?php
        if (has_nav_menu('primary')) {
          wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'items_wrap' => '%3$s',
            'walker' => new EnhanceThat_Menu_Walker(),
            'fallback_cb' => false,
          ));
        } else {
          // Fallback menu when no menu is assigned
          echo '<a href="' . esc_url(home_url('/blog/')) . '" class="button-yellow w-button">Blog</a>';
          echo '<a href="https://outlook.office365.com/owa/calendar/EnhanceThat@enhancethat.fashion/bookings/s/ykcAmlR2zkiMHzfWw-WJLQ2" target="_blank" class="button-yellow w-button">Schedule a call</a>';
        }
        ?>
      </div>
    </div>
  </div>
  <div style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1.1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1.1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1.1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1.1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="page-wrapper">

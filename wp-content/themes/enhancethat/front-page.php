<?php
/**
 * Template Name: Homepage
 * Description: Homepage template for Enhance That
 *
 * @package EnhanceThat
 */

get_header();
?>

    <section class="hero">
      <div class="container vcenter"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/sticker.png" loading="lazy" style="opacity:0;-webkit-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(10deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(10deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(10deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(0.9, 0.9, 1) rotateX(0) rotateY(0) rotateZ(10deg) skew(0, 0)" sizes="(max-width: 910px) 100vw, 910px" alt="" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/sticker-p-500.png 500w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/sticker.png 910w" class="sticker">
        <div class="shortener-50">
          <h1 class="heading-style-h1 split-type bugfix-width">Simplified and integrated digital design workflow <span class="font-family-domaine">built for you.</span></h1>
          <div class="hero-sub">
            <p class="text-style-regular text-color-white text-align-center split-type">We make automation effective and effortless.</p>
          </div>
        </div>
      </div>
      <div class="grain"></div>
      <div class="hero-bottom"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1.png" loading="lazy" sizes="100vw" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1-p-500.png 500w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1-p-800.png 800w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1.png 2017w" alt="" class="image-inner"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1.png" loading="lazy" sizes="(max-width: 2017px) 100vw, 2017px" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1-p-500.png 500w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1-p-800.png 800w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1.png 2017w" alt="" class="image-inner only-mobile">
        <div class="ripple w-embed"><svg style="display: none;">
            <filter id="liquidFilter">
              <feturbulence id="turbulence" type="turbulence" basefrequency="0.02" numoctaves="1" result="turbulence">
              <fedisplacementmap in2="turbulence" in="SourceGraphic" scale="5" xchannelselector="R" ychannelselector="G">
            </fedisplacementmap></feturbulence></filter>
          </svg></div>
      </div>
    </section>
    <section data-w-id="77ab8ad9-5537-65e6-8079-95e5cdf46e0d" class="brands">
      <div class="container full-mobile">
        <div data-w-id="2c286584-0c2f-1789-7a8e-02cfdd2de203" class="marquee">
          <?php
          $brandLogos = enhancethat_get_brand_logos();
          if (!empty($brandLogos)) :
          ?>
          <div class="clients-wrapper">
            <div class="clients-list">
              <?php enhancethat_render_marquee_logos($brandLogos); ?>
            </div>
          </div>
          <div class="clients-wrapper">
            <div class="clients-list">
              <?php enhancethat_render_marquee_logos($brandLogos); ?>
            </div>
          </div>
          <div class="clients-wrapper">
            <div class="clients-list">
              <?php enhancethat_render_marquee_logos($brandLogos); ?>
            </div>
          </div>
          <?php endif; ?>
          <div class="cover-left"></div>
          <div class="cover-right"></div>
        </div>
        <div class="label is-tiffany absolute-positioning">
          <div class="text-style-small">trusted by</div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="two-columns align-center">
          <div class="illustration-back">
            <div class="grain"></div>
            <div data-w-id="8046deb5-f720-b7af-a6c7-f0583fdc12e1" data-is-ix2-target="1" class="lottie" data-animation-type="lottie" data-src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/lottie/Illustration-1.json" data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg" data-default-duration="0" data-duration="0" data-ix2-initial-state="0"></div>
          </div>
          <div class="column spacing-double padding-left">
            <h2 class="heading-style-h2 split-type">Fewer errors.<br>More time saved.</h2>
            <div class="steps-wrapper">
              <div class="step">
                <div class="label">
                  <div class="text-style-small">#1</div>
                </div>
                <p class="text-style-regular split-type">Repetitive tasks are automated, saving time and focus.</p>
              </div>
              <div class="step">
                <div class="label is-second">
                  <div class="text-style-small">#2</div>
                </div>
                <p class="text-style-regular split-type">The right assets delivered to the right teams with the right settings.</p>
              </div>
              <div class="step">
                <div class="label is-third">
                  <div class="text-style-small">#3</div>
                </div>
                <p class="text-style-regular split-type">Integrating tools and processes in a seamless, future-ready workflow.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="two-columns align-center">
          <div class="column spacing-double padding-right">
            <h2 class="heading-style-h2 split-type">We unlock the full potential of your tools</h2>
            <p class="text-style-regular">Brands need seamless workflows, but navigating multiple tools and solutions can be challenging. Tech providers, meanwhile, struggle to prioritize integration requests.<br><br>EnhanceThat bridges the gap, helping brands leverage APIs, automate PLM, and integrate tech solutions effortlessly.</p>
          </div>
          <div class="illustration-back is-green">
            <div class="grain"></div>
            <div class="lottie" data-w-id="968499f2-e236-3ab2-6dc2-8cf3fb57949c" data-animation-type="lottie" data-src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/lottie/Illustration-2.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-default-duration="0" data-duration="6"></div>
          </div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="column spacing-double">
          <h2 class="heading-style-h2 split-type">How we create value for brands</h2>
          <div data-w-id="fe57ecda-f9ad-8aba-db18-9de39b6e3ccb" data-is-ix2-target="1" class="lottie-desktop" data-animation-type="lottie" data-src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/lottie/illustration-3---desktop.json" data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg" data-default-duration="0" data-duration="0"></div>
          <div data-w-id="e1299527-f82d-5868-152d-f5fcb39a2be9" data-is-ix2-target="1" class="lottie-mobile" data-animation-type="lottie" data-src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/lottie/illustration-3---mobile.json" data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg" data-default-duration="0" data-duration="4"></div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="column spacing-double">
          <div data-w-id="c51f2fc4-3a8a-2889-7fb6-88efb2f0ac77" style="-webkit-transform:translate3d(0, 15px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 15px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 15px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 15px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="shortener-66">
            <div class="label is-blue">
              <div class="text-style-small text-color-white">the team</div>
            </div>
            <h2 class="text-style-large extrabold-mobile size-24">We've built and integrated digital product creation solutions inside Nike, Tommy Hilfiger, and Calvin Klein. We know the challenges firsthand - scattered workflows, disconnected tools, and teams struggling to scale. We've seen what works, what doesn't, and how to fix it.<br><br>EnhanceThat bridges the gap between fashion and tech, making sure your digital workflows work for you.</h2>
          </div>
        </div>
      </div>
    </section>

<?php
get_footer();

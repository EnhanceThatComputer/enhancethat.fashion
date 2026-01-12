    <section class="footer">
      <div class="footer-pattern"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1.png" loading="lazy" sizes="100vw" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1-p-500.png 500w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1-p-800.png 800w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1.png 2017w" alt="" class="image-inner"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1.png" loading="lazy" sizes="(max-width: 2017px) 100vw, 2017px" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1-p-500.png 500w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1-p-800.png 800w, <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-distort-1.png 2017w" alt="" class="image-inner only-mobile">
        <div class="ripple w-embed"><svg style="display: none;">
            <filter id="liquidFilter">
              <feturbulence id="turbulence" type="turbulence" basefrequency="0.02" numoctaves="1" result="turbulence">
              <fedisplacementmap in2="turbulence" in="SourceGraphic" scale="1" xchannelselector="R" ychannelselector="G">
            </fedisplacementmap></feturbulence></filter>
          </svg></div>
      </div>
      <div class="grain"></div>
      <div class="container">
        <div class="footer-cta">
          <div class="shortener-60 spacing-50">
            <h2 class="heading-style-h1 text-align-left split-type">Let's simplify your journey together.</h2>
            <div class="button-group">
              <a href="https://outlook.office365.com/owa/calendar/EnhanceThat@enhancethat.fashion/bookings/s/ykcAmlR2zkiMHzfWw-WJLQ2" target="_blank" class="button-white w-button">Schedule a call</a>
              <a href="https://www.linkedin.com/company/enhancethat/?originalSubdomain=nl" target="_blank" class="social-link is-blue w-inline-block"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/linkedin-blue.svg" loading="lazy" alt="" class="social-icon is-smaller"></a>
            </div>
          </div>
          <div class="footer-meta">
            <div class="text-style-small text-color-white font-weight-semibold">Enhance That © <span class="current-year"></span></div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
// Wait for Lenis to be loaded
window.addEventListener('load', function() {
  if (typeof Lenis === 'undefined') {
    console.warn('Lenis library not loaded, skipping smooth scroll initialization');
    return;
  }

class Scroll extends Lenis {
  constructor() {
    super({
      duration: .5,
      easing: (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t)),
      direction: "vertical",
      smooth: true,
      smoothTouch: false,
      touchMultiplier: .5
    });
    this.time = 0;
    this.isActive = true;
    this.init();
  }
  init() {
    this.config();
    this.render();
    this.handleEditorView();
  }
  config() {
    const overscroll = [
      ...document.querySelectorAll('[data-scroll="overscroll"]')
    ];
    if (overscroll.length > 0) {
      overscroll.forEach((item) =>
        item.setAttribute("onwheel", "event.stopPropagation()")
      );
    }
    const stop = [...document.querySelectorAll('[data-scroll="stop"]')];
    if (stop.length > 0) {
      stop.forEach((item) => {
        item.onclick = () => {
          this.stop();
          this.isActive = false;
        };
      });
    }
    const start = [...document.querySelectorAll('[data-scroll="start"]')];
    if (start.length > 0) {
      start.forEach((item) => {
        item.onclick = () => {
          this.start();
          this.isActive = true;
        };
      });
    }
    const toggle = [...document.querySelectorAll('[data-scroll="toggle"]')];
    if (toggle.length > 0) {
      toggle.forEach((item) => {
        item.onclick = () => {
          if (this.isActive) {
            this.stop();
            this.isActive = false;
          } else {
            this.start();
            this.isActive = true;
          }
        };
      });
    }
    const anchor = [...document.querySelectorAll("[data-scrolllink]")];
    if (anchor.length > 0) {
      anchor.forEach((item) => {
        const id = parseFloat(item.dataset.scrolllink);
        const target = document.querySelector(`[data-scrolltarget="${id}"]`);
        if (target) {
          item.onclick = () => this.scrollTo(target);
        }
      });
    }
  }
  render() {
    this.raf((this.time += 10));
    window.requestAnimationFrame(this.render.bind(this));
  }
  handleEditorView() {
    const html = document.documentElement;
    const config = { attributes: true, childList: false, subtree: false };
    const callback = (mutationList, observer) => {
      for (const mutation of mutationList) {
        if (mutation.type === "attributes") {
          const btn = document.querySelector(".w-editor-bem-EditSiteButton");
          const bar = document.querySelector(".w-editor-bem-EditorMainMenu");
          const addTrig = (target) =>
            target.addEventListener("click", () => this.destroy());
          if (btn) addTrig(btn);
          if (bar) addTrig(bar);
        }
      }
    };
    const observer = new MutationObserver(callback);
    observer.observe(html, config);
  }
}

window.SmoothScroll = new Scroll();
}); // End window.addEventListener('load')
</script>

  <script>
  window.addEventListener('load', function () {
    if (typeof SplitType === 'undefined' || typeof gsap === 'undefined') {
      console.warn('SplitType or GSAP not loaded, skipping text animations');
      return;
    }

    let splitText = new SplitType(".split-type, .split-type-delayed", {
      types: "lines, words",
    });
    document.querySelectorAll(".split-type, .split-type-delayed").forEach((element) => {
      gsap.fromTo(
        element.querySelectorAll(".word"),
        { y: "100%", opacity: 1 },
        {
          y: "0%",
          opacity: 1,
          stagger: 0.04,
          duration: .5,
          ease: "power2.out",
          delay: element.classList.contains("split-type-delayed") ? .75 : 0,
          scrollTrigger: {
            trigger: element,
            start: "top 85%",
            toggleActions: "play none none none",
          },
        }
      );
    });
  });
</script>
  <script>
jQuery(function($) {
  $('.current-year').text(new Date().getFullYear());
});
</script>

<?php wp_footer(); ?>

</body>
</html>

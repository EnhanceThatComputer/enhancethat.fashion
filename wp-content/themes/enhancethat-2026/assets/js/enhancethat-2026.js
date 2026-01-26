/**
 * EnhanceThat 2026 - Main JavaScript
 *
 * Scroll-jacking slide animations with GSAP ScrollTrigger and Lenis smooth scroll
 */

(function() {
  'use strict';

  /**
   * Initialize smooth scroll with Lenis
   */
  function initSmoothScroll() {
    const lenis = new Lenis({
      duration: 1.2,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      orientation: 'vertical',
      gestureOrientation: 'vertical',
      smoothWheel: true,
      wheelMultiplier: 1,
      touchMultiplier: 2,
    });

    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);

    // Connect Lenis with GSAP ScrollTrigger
    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);

    return lenis;
  }

  /**
   * Initialize slide animations
   */
  function initSlideAnimations() {
    // Check if we're on mobile (disable pinning on small screens)
    const isMobile = window.innerWidth < 768;

    // Get all slides
    const slides = gsap.utils.toArray('.slide-section');

    if (slides.length === 0) {
      return; // No slides found
    }

    slides.forEach((slide, index) => {
      const content = slide.querySelector('.slide-content');

      if (!content) {
        return; // Skip if no content found
      }

      if (!isMobile) {
        // Desktop: Pin slides and create scroll-jacking effect
        ScrollTrigger.create({
          trigger: slide,
          start: 'top top',
          end: '+=100%',
          pin: true,
          pinSpacing: true,
          anticipatePin: 1,
          id: `slide-${index}`
        });

        // Animate content in
        gsap.fromTo(content,
          {
            opacity: 0,
            y: 60,
            scale: 0.95
          },
          {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
              trigger: slide,
              start: 'top 85%',
              end: 'top 20%',
              toggleActions: 'play none none none'
            }
          }
        );

        // Animate content out when leaving
        gsap.to(content, {
          opacity: 0.3,
          scale: 0.98,
          scrollTrigger: {
            trigger: slide,
            start: 'bottom 80%',
            end: 'bottom 20%',
            scrub: 1,
            id: `slide-out-${index}`
          }
        });
      } else {
        // Mobile: Simple fade animations without pinning
        gsap.fromTo(content,
          {
            opacity: 0,
            y: 40
          },
          {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power2.out',
            scrollTrigger: {
              trigger: slide,
              start: 'top 80%',
              end: 'top 40%',
              toggleActions: 'play none none none'
            }
          }
        );
      }
    });

    console.log(`Initialized ${slides.length} slide animations`);
  }

  /**
   * Initialize navigation behavior
   */
  function initNavigation() {
    const nav = document.querySelector('.nav-2026');

    if (!nav) {
      return;
    }

    // Add scrolled class on scroll
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset;

      if (currentScroll > 50) {
        nav.classList.add('nav-scrolled');
      } else {
        nav.classList.remove('nav-scrolled');
      }

      lastScroll = currentScroll;
    });

    // Dynamic color switching based on slide background
    const darkSlides = gsap.utils.toArray('.slide-dark');

    darkSlides.forEach((slide) => {
      ScrollTrigger.create({
        trigger: slide,
        start: 'top 80px',
        end: 'bottom 80px',
        onEnter: () => nav.classList.add('nav-on-dark'),
        onLeave: () => nav.classList.remove('nav-on-dark'),
        onEnterBack: () => nav.classList.add('nav-on-dark'),
        onLeaveBack: () => nav.classList.remove('nav-on-dark')
      });
    });

    console.log('Navigation initialized with dynamic color switching');
  }

  /**
   * Keyboard navigation
   */
  function initKeyboardNav() {
    const slides = gsap.utils.toArray('.slide-section');

    if (slides.length === 0) {
      return;
    }

    let currentSlide = 0;

    document.addEventListener('keydown', (e) => {
      // Arrow down or Page Down
      if (e.key === 'ArrowDown' || e.key === 'PageDown') {
        e.preventDefault();
        if (currentSlide < slides.length - 1) {
          currentSlide++;
          slides[currentSlide].scrollIntoView({ behavior: 'smooth' });
        }
      }

      // Arrow up or Page Up
      if (e.key === 'ArrowUp' || e.key === 'PageUp') {
        e.preventDefault();
        if (currentSlide > 0) {
          currentSlide--;
          slides[currentSlide].scrollIntoView({ behavior: 'smooth' });
        }
      }

      // Home key
      if (e.key === 'Home') {
        e.preventDefault();
        currentSlide = 0;
        slides[0].scrollIntoView({ behavior: 'smooth' });
      }

      // End key
      if (e.key === 'End') {
        e.preventDefault();
        currentSlide = slides.length - 1;
        slides[currentSlide].scrollIntoView({ behavior: 'smooth' });
      }
    });

    // Track current slide on scroll
    ScrollTrigger.create({
      trigger: 'body',
      start: 'top top',
      end: 'bottom bottom',
      onUpdate: (self) => {
        const scrollPos = window.scrollY + window.innerHeight / 2;
        slides.forEach((slide, index) => {
          const slideTop = slide.offsetTop;
          const slideBottom = slideTop + slide.offsetHeight;
          if (scrollPos >= slideTop && scrollPos < slideBottom) {
            currentSlide = index;
          }
        });
      }
    });

    console.log('Keyboard navigation initialized');
  }

  /**
   * Initialize client logo marquee
   */
  function initMarquee() {
    const marquee = document.querySelector('.client-marquee');

    if (!marquee) {
      return;
    }

    const track = marquee.querySelector('.client-track');

    if (!track) {
      return;
    }

    // Duplicate items for seamless loop
    const items = track.innerHTML;
    track.innerHTML += items;

    console.log('Marquee initialized');
  }

  /**
   * Reduced motion support
   */
  function checkReducedMotion() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
      // Disable all ScrollTrigger animations
      ScrollTrigger.getAll().forEach(st => st.kill());
      console.log('Reduced motion detected - animations disabled');
    }
  }

  /**
   * Initialize everything on DOM ready
   */
  function init() {
    // Check for reduced motion preference
    checkReducedMotion();

    // Initialize smooth scroll
    const lenis = initSmoothScroll();

    // Initialize GSAP ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // Wait for fonts and images to load
    window.addEventListener('load', () => {
      // Initialize features
      initSlideAnimations();
      initNavigation();
      initKeyboardNav();
      initMarquee();

      // Refresh ScrollTrigger after everything is loaded
      ScrollTrigger.refresh();

      console.log('EnhanceThat 2026 initialized');
    });

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        ScrollTrigger.refresh();
        console.log('ScrollTrigger refreshed after resize');
      }, 250);
    });
  }

  // Start initialization when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();

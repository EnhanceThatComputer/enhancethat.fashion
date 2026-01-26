=== Enhance That ===
Contributors: enhancethat
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready

A modern WordPress theme for Enhance That - bridging the gap between fashion and technology with automated digital design workflows.

== Description ==

Enhance That is a professional WordPress theme designed for fashion technology companies. It features:

* Modern, clean design with smooth animations
* Card-based blog layout with category and tag support
* Custom post meta fields for blog subtitles and image attribution
* Lottie animation support for interactive graphics
* GSAP scroll-triggered animations
* Smooth scrolling with Lenis
* Fully responsive mobile-first design
* SEO-optimized with Open Graph and Twitter Cards
* Custom typography with Innovator Grotesk and Domaine fonts

== Installation ==

1. In your WordPress admin panel, go to Appearance > Themes
2. Click "Add New" then "Upload Theme"
3. Upload the enhancethat-theme.zip file
4. Click "Install Now"
5. After installation, click "Activate"

== Post-Installation Configuration ==

### Required Settings:

1. **Permalinks** (Settings > Permalinks)
   - Set to "Post name" structure for SEO-friendly URLs
   - Click "Save Changes"

2. **Reading Settings** (Settings > Reading)
   - Set "Your homepage displays" to "A static page"
   - Posts page: Create a page called "Blog" and select it here
   - This enables the /blog/ URL to show your blog posts

3. **Navigation Menus** (Appearance > Menus)
   - Create a menu for "Primary Menu" (site header navigation)
   - Create a menu for "Footer Menu" (footer links) - optional

### Custom Features:

**Blog Post Subtitle**
- When creating/editing a blog post, you'll see a "Post Subtitle" meta box
- Add an optional subtitle that appears below the main title in blue

**Cover Image Attribution**
- In the "Cover Image Attribution" meta box (sidebar), add photo credits
- Supports HTML for links (e.g., Photo by <a href="url">Name</a>)
- Appears below the featured image on single posts

**Categories & Tags**
- Add categories and tags to blog posts
- They appear as colored badges (blue for categories, tiffany for tags)
- Clicking them filters posts by that category/tag

== Frequently Asked Questions ==

= Do I need any plugins? =

No required plugins. The theme is fully functional out of the box. However, you may optionally install:
- Yoast SEO or Rank Math for advanced SEO features
- Contact Form 7 for contact forms
- Akismet for spam protection

= How do I add blog posts? =

1. Go to Posts > Add New
2. Enter your title and content
3. Add a subtitle in the "Post Subtitle" meta box (optional)
4. Set a featured image (recommended size: 1200 x 600px)
5. Add photo credit in "Cover Image Attribution" if needed
6. Add categories and tags for organization
7. Click "Publish"

= How do I change the homepage? =

The homepage uses front-page.php by default. To customize:
- Edit wp-content/themes/enhancethat/front-page.php
- Or create a custom page and set it as homepage in Settings > Reading

= Are the animations customizable? =

Yes. The theme uses GSAP for scroll animations and Lottie for interactive graphics.
Edit assets/js/enhancethat-dev.js to modify animation behavior, or
Replace Lottie JSON files in assets/lottie/ with your own animations.

= Is the theme mobile-responsive? =

Yes, fully responsive with mobile-first design principles. Tested on all major devices and browsers.

== Changelog ==

= 1.0.0 =
* Initial release
* Custom homepage with hero section and animations
* Blog listing page with card grid layout
* Single blog post template with custom fields
* Archive templates for categories, tags, and dates
* Header and footer with navigation menus
* Custom post meta: subtitle and cover attribution
* SEO meta tags with Open Graph and JSON-LD
* Reading time calculation
* Lottie animation support
* GSAP scroll animations
* Lenis smooth scrolling
* Mobile-responsive design

== Credits ==

**Design & Development**
* Enhance That (https://enhancethat.fashion)

**JavaScript Libraries**
* GSAP (GreenSock Animation Platform) - https://greensock.com
* Lenis Smooth Scroll - https://lenis.studiofreight.com
* SplitType - https://github.com/lukePeavey/SplitType
* jQuery - https://jquery.com

**Fonts**
* Innovator Grotesk - Commercial license
* Domaine Display Condensed - Commercial license

**Analytics**
* Umami Analytics - https://umami.is

== License ==

This theme is licensed under the GPL v2 or later.

Copyright 2025 Enhance That

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Privacy Policy ==

This theme does not collect or store any user data directly. However, it includes:
* Umami Analytics (privacy-focused, GDPR-compliant analytics)
* External CDN resources for JavaScript libraries
* LinkedIn social links

Users should review their own privacy policies if using this theme commercially.

== Support ==

For theme support, customization requests, or bug reports:
* Website: https://enhancethat.fashion
* Email: Contact through website

== Screenshots ==

1. Homepage with hero section and smooth animations
2. Blog listing page with card grid layout
3. Single blog post with custom subtitle and attribution
4. Mobile responsive design

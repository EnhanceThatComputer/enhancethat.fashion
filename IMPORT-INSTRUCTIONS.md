# Enhance That WordPress Theme - Import Instructions

## Package Contents

- **enhancethat-theme.zip** - Complete WordPress theme package ready for installation

## System Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher
- Modern web browser with JavaScript enabled
- Internet connection (for CDN resources: GSAP, Lenis, SplitType)

---

## Installation Steps

### 1. Upload and Activate Theme

1. Log into your WordPress admin panel
2. Navigate to **Appearance > Themes**
3. Click **Add New** button at the top
4. Click **Upload Theme** button
5. Click **Choose File** and select `enhancethat-theme.zip`
6. Click **Install Now**
7. Wait for the upload and installation to complete
8. Click **Activate** to enable the theme

---

## Required Configuration (IMPORTANT!)

After activating the theme, you MUST configure these WordPress settings:

### 2. Configure Permalinks

**Why:** Required for blog URLs and SEO

1. Go to **Settings > Permalinks**
2. Select **Post name** radio button
3. Click **Save Changes**

Your permalink structure should show: `/%postname%/`

---

### 3. Configure Reading Settings

**Why:** Required for the /blog/ page to work

1. Go to **Settings > Reading**
2. Under "Your homepage displays":
   - Select **A static page**
   - Homepage: Select your homepage OR leave as "— Select —" to use front-page.php
   - Posts page: Click **+ Add** to create a new page called "Blog", then select it

3. Click **Save Changes**

**Result:** Your blog will now be accessible at `yourdomain.com/blog/`

---

### 4. Set Up Navigation Menus (Optional)

1. Go to **Appearance > Menus**
2. Create a new menu (e.g., "Main Menu")
3. Add pages, posts, or custom links to the menu
4. Under "Menu Settings", check **Primary Menu**
5. Click **Save Menu**

You can also create a **Footer Menu** for footer links.

---

## Using Theme Features

### Blog Posts

When creating blog posts, you have access to special custom fields:

#### Post Subtitle
- Location: Meta box below the title editor
- Purpose: Adds a subtitle in blue color below the main title
- Example: "From Silent Margin Killer to Fashions Competitive Edge"
- Optional field

#### Cover Image Attribution
- Location: Meta box in the right sidebar
- Purpose: Add photo credits that appear below featured images
- Supports HTML for links
- Example: `Photo by <a href="url">Photographer Name</a> on Unsplash`
- Optional field

#### Featured Image (Cover Image)
- Recommended size: **1200 x 600 pixels**
- Used in: Blog listing cards and single post header
- Important for SEO and social sharing

#### Categories & Tags
- Add categories and tags for post organization
- Categories display as **blue badges**
- Tags display as **tiffany (turquoise) badges**
- Both are clickable and filter posts

---

## Creating Your First Blog Post

1. Go to **Posts > Add New**
2. Enter your **title**
3. Add **content** using the WordPress editor
4. In the **Post Subtitle** box (below editor): Add optional subtitle
5. Click **Set featured image** (right sidebar):
   - Upload or select an image (1200x600px recommended)
   - Click **Set featured image**
6. In **Cover Image Attribution** box: Add photo credit (optional)
7. Add **Categories** and **Tags** (right sidebar)
8. Set **publish date** if desired
9. Click **Publish**

**View your post:** Visit `yourdomain.com/blog/` to see it in the card grid!

---

## Troubleshooting

### Quick Fix: Use Diagnostic Scripts

The theme includes automated diagnostic tools in the theme folder:

**diagnose-production.php** - Checks your WordPress settings and identifies issues
- Upload to WordPress root directory
- Visit `yourdomain.com/diagnose-production.php`
- Review recommendations
- Delete file when done

**fix-production.php** - Automatically fixes blog routing issues
- Upload to WordPress root directory
- Visit `yourdomain.com/fix-production.php`
- Follows on-screen instructions
- **Delete file after running for security**

See `CHECK-BLOG-SETUP.md` for detailed usage instructions.

---

### Blog page shows 404 error
- **Solution:** Go to Settings > Permalinks and click "Save Changes" to flush rewrite rules
- Ensure you created a "Blog" page and set it as Posts page in Settings > Reading
- **Or use fix-production.php script for automatic fix**

### Animations not working
- **Check:** Browser JavaScript is enabled
- **Check:** No JavaScript errors in browser console (F12 > Console tab)
- **Note:** Some animations only trigger on scroll

### Images not loading
- **Check:** Featured images are set for blog posts
- **Check:** Image paths are correct (theme uses WordPress functions automatically)

### Homepage is blank
- **Solution:** Go to Settings > Reading and verify homepage settings
- The theme includes a front-page.php template that displays automatically

### Missing custom fields (Subtitle, Attribution)
- **Check:** You're editing a POST, not a PAGE (custom fields only show on posts)
- **Refresh:** Try refreshing the post editor page

---

## Theme Customization

### Changing Colors
- Edit: `wp-content/themes/enhancethat/assets/css/enhancethat-dev.css`
- Look for CSS variables: `--blue`, `--tiffany`, `--yellow`

### Modifying Animations
- Edit: `wp-content/themes/enhancethat/assets/js/enhancethat-dev.js`
- Uses GSAP for scroll animations
- Modify ScrollTrigger settings to adjust animation timing

### Editing Homepage
- Edit: `wp-content/themes/enhancethat/front-page.php`
- Or create a custom page and set as homepage in Settings > Reading

### Changing Fonts
- Current fonts: Innovator Grotesk, Domaine Display Condensed
- Located in: `wp-content/themes/enhancethat/assets/fonts/`
- To change: Replace font files and update `@font-face` rules in CSS

---

## External Dependencies

The theme loads these libraries from CDNs:

- **GSAP 3.12.2** - Animation library (cdnjs.cloudflare.com)
- **ScrollTrigger** - Scroll-based animations (cdnjs.cloudflare.com)
- **Lenis 1.0.29** - Smooth scrolling (unpkg.com)
- **SplitType 0.3.3** - Text animation effects (cdn.jsdelivr.net)
- **Webflow jQuery 3.5.1** - Required for theme JS (d3e54v103j8qbb.cloudfront.net)

**Note:** Internet connection required for these features to work.

---

## Lottie Animations

The theme includes interactive Lottie animations:

- **Location:** `wp-content/themes/enhancethat/assets/lottie/`
- **Files:** Illustration-1.json, Illustration-2.json, illustration-3---desktop.json, etc.
- **Usage:** Automatically loaded via data attributes in HTML
- **Customization:** Replace JSON files with your own Lottie exports from After Effects

---

## SEO Features

The theme includes built-in SEO:

- ✓ Open Graph meta tags (Facebook sharing)
- ✓ Twitter Card meta tags (Twitter sharing)
- ✓ JSON-LD structured data (Google rich results)
- ✓ Canonical URLs
- ✓ Responsive meta viewport
- ✓ Reading time calculation

**Optional:** Install Yoast SEO or Rank Math for advanced SEO features

---

## Performance Tips

1. **Optimize images** before uploading (use TinyPNG or ShortPixel)
2. **Use a caching plugin** (WP Super Cache or W3 Total Cache)
3. **Enable GZIP compression** on your server
4. **Use a CDN** for static assets (Cloudflare, BunnyCDN)
5. **Lazy load images** (native WordPress feature in 5.5+)

---

## Support

For theme support or customization requests:

- **Website:** https://enhancethat.fashion
- **Email:** Contact through website

---

## License

This theme is released under GPL v2 or later.

Copyright © 2025 Enhance That
All rights reserved.

---

## Changelog

### Version 1.0.0 - 2025
- Initial release
- Homepage with hero section and animations
- Blog listing with card grid layout
- Single post template with custom fields
- Archive templates for categories/tags/dates
- SEO meta tags and structured data
- Reading time calculation
- Mobile responsive design
- Lottie animation support
- GSAP scroll animations
- Custom fonts (Innovator Grotesk, Domaine)

---

**Happy WordPress-ing! 🎉**

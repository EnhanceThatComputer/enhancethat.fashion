# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a custom WordPress theme for Enhance That, a digital design workflow company. The theme is a Classic WordPress theme built to preserve complex JavaScript animations and custom HTML structure from the original static website. The active theme is located at `wp-content/themes/enhancethat/` and runs on a Docker-based WordPress environment.

The original static Jekyll site is preserved in `websiteToConvertToTheme/` for reference purposes only.

## Project Structure

### EnhanceThat Theme (`wp-content/themes/enhancethat/`)

The active custom WordPress theme with the following structure:

- `style.css`: Theme header with metadata
- `functions.php`: Theme setup, script/style enqueuing, custom post meta, menu registration
- `header.php`: Site header with navigation and SVG filters
- `footer.php`: Site footer with contact section and analytics
- `front-page.php`: Homepage template (hero, services, client marquee, team)
- `single.php`: Blog post template with SEO meta tags and structured data
- `inc/`: Include files
  - `class-menu-walker.php`: Custom menu walker for Webflow-style navigation buttons
- `assets/`: Theme assets
  - `css/`: Stylesheets (normalize.css, components.css, enhancethat-dev.css)
  - `js/`: JavaScript files (enhancethat-dev.js with animations)
  - `images/`: Images, logos, icons
  - `fonts/`: Web font files
  - `lottie/`: Lottie animation JSON files (Illustration-1.json, etc.)

### WordPress Environment (`wp-content/`)

- `themes/enhancethat/`: Active custom theme (see above)
- `themes/twentytwenty*/`: Default WordPress themes (inactive)
- `plugins/`: WordPress plugins (akismet, hello.php)

### Static Website Source (`websiteToConvertToTheme/`)

Historical reference only - original Jekyll-based static site. No longer actively used in development.

### Docker Configuration

- `docker-compose.yml`: Multi-container WordPress development environment
- `uploads.ini`: PHP configuration overrides

## Theme Technical Details

### Frontend Technologies

The theme uses modern frontend libraries and techniques:

1. **Lenis**: Smooth scrolling library
   - Custom Scroll class implementation
   - Handles scroll behavior and anchor links
   - Source: https://uploads-ssl.webflow.com/6330c0ebacf06abbc83b6eb3/64103732523ba652052e0223_lenis-bundled.txt

2. **GSAP (GreenSock Animation Platform)**
   - Core: https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js
   - ScrollTrigger: https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js
   - Used for scroll-triggered animations

3. **SplitType**
   - Source: https://cdn.jsdelivr.net/npm/split-type@0.3.3/umd/index.min.js
   - Splits text into lines/words for animation
   - Elements with `.split-type` or `.split-type-delayed` classes animate on scroll

4. **Lottie Animations**
   - Interactive SVG/JSON animations
   - Files located in `documents/` directory
   - Triggered via data attributes: `data-animation-type="lottie"`, `data-src="documents/Illustration-*.json"`

5. **jQuery**
   - Version 3.5.1
   - Source: Webflow CDN
   - Used for DOM manipulation and event handling

6. **SVG Filters**
   - Liquid distortion filter (`#liquidFilter`) for visual effects
   - Applied to hero and footer sections with `.is-liquid` class

### Key Design Features

- **Webflow-based design**: Classes use Webflow naming conventions (w-inline-block, w-button, etc.)
- **Marquee client logos**: Infinite scrolling brand showcase
- **Grain texture overlays**: Visual texture on hero and sections
- **Three-color palette**: Blue (primary), Tiffany (accent), Yellow (CTAs)
- **Responsive design**: Mobile-optimized with breakpoints
- **Animation sequences**: Text reveals, fade-ins, transforms on scroll
- **Custom fonts**: Uses Innovator Grotesk and Domaine fonts

### Blog Implementation

WordPress blog implementation:
- Uses native WordPress posts
- Custom meta fields:
  - `_enhancethat_subtitle`: Post subtitle (displayed below title)
  - `_enhancethat_cover_attribution`: Cover image attribution/credit
- Single post template (`single.php`) includes:
  - Full SEO meta tags (Open Graph, Twitter Cards)
  - JSON-LD structured data for search engines
  - Reading time calculation
  - Featured image/cover display with attribution
  - Rich text content with custom styling
- Blog post meta boxes in admin for easy content management

### Analytics

- Umami analytics integrated
- Website ID: df361236-30bc-42e3-b9f4-6582ea43b87e
- Script: https://cloud.umami.is/script.js

## WordPress Development Commands

### Environment Management

Start the WordPress environment:
```bash
docker compose up -d
```

Access points:
- WordPress: http://localhost:8080
- Adminer (Database UI): http://localhost:8081 (Server: db, User: wp, Password: wp, Database: wp)

Stop the environment:
```bash
docker compose down
```

Complete reset (including database):
```bash
docker compose down -v
```

### WP-CLI Commands

The `wpcli` service provides command-line WordPress management. Commands use `docker compose run --rm wpcli` prefix:

```bash
# Theme management
docker compose run --rm wpcli theme list
docker compose run --rm wpcli theme activate <theme-name>

# Plugin management
docker compose run --rm wpcli plugin list
docker compose run --rm wpcli plugin install <plugin-name> --activate

# Content management
docker compose run --rm wpcli post list
docker compose run --rm wpcli post create --post_type=post --post_title="Title" --post_content="Content" --post_status=publish

# Database operations
docker compose run --rm wpcli db export backup.sql
docker compose run --rm wpcli db import backup.sql
docker compose run --rm wpcli search-replace 'old-url.com' 'new-url.com'

# User management
docker compose run --rm wpcli user create <username> <email> --role=administrator --user_pass=<password>
```

### Viewing Logs

```bash
# All services
docker compose logs -f

# WordPress only
docker compose logs -f wordpress

# Database only
docker compose logs -f db
```

## Theme Implementation Details

### Navigation Menu System

The theme uses WordPress's native menu system with custom styling:

**Menu Registration** (`functions.php`):
- Two menu locations registered: `primary` (header) and `footer`
- Menus managed via **Appearance → Menus** in WordPress admin

**Custom Menu Walker** (`inc/class-menu-walker.php`):
- Extends `Walker_Nav_Menu` to output Webflow-style button classes
- Applies `button-yellow` and `w-button` classes to menu items
- Automatically adds `target="_blank"` and `rel="noopener"` for external links
- No submenu support (flat navigation structure)

**Header Integration** (`header.php`):
- Uses `wp_nav_menu()` with custom walker
- Fallback to default menu items if no menu is assigned
- Maintains original Webflow HTML structure and animation classes

### Script and Style Enqueuing

All frontend libraries are properly enqueued in `functions.php`:

```php
function enhancethat_enqueue_scripts() {
    // CSS
    wp_enqueue_style('enhancethat-normalize', ...);
    wp_enqueue_style('enhancethat-components', ...);
    wp_enqueue_style('enhancethat-main', ...);

    // jQuery (Webflow version)
    wp_enqueue_script('webflow-jquery', ...);

    // Theme JavaScript
    wp_enqueue_script('enhancethat-main', ...);

    // Animation libraries
    wp_enqueue_script('lenis', ...); // Smooth scroll
    wp_enqueue_script('gsap', ...); // Animations
    wp_enqueue_script('gsap-scrolltrigger', ...); // Scroll triggers
    wp_enqueue_script('splittype', ...); // Text animations

    // Localized variables
    wp_localize_script('enhancethat-main', 'enhancethat_vars', [...]);
}
```

All JavaScript animations and scroll behaviors are preserved:
- Lottie animations with data attributes
- GSAP ScrollTrigger animations
- SplitType text reveals
- SVG liquid filters

### SEO Implementation

Built-in SEO functionality without plugins (`functions.php`):
- Open Graph meta tags for social sharing
- Twitter Card meta tags
- JSON-LD structured data for articles
- Canonical URLs
- Meta descriptions
- Custom function: `enhancethat_seo_meta_tags()` hooked to `wp_head`

### Content Management

**Blog Posts**:
- Uses native WordPress posts
- Custom meta boxes for subtitle and cover attribution
- Featured image support with custom size: `enhancethat-blog-cover` (1200x600)
- Reading time calculation helper function
- Helper functions: `enhancethat_get_subtitle()`, `enhancethat_get_cover_attribution()`, `enhancethat_reading_time()`

**Future Enhancements**:
- Homepage sections: Consider Advanced Custom Fields (ACF) or Customizer API
- Team members: Could be custom post type or ACF repeater
- Client logos: Could be custom post type or ACF repeater

## Development Workflow

1. **Start Docker environment**: `docker compose up -d`
2. **Edit theme files** in `wp-content/themes/enhancethat/`
   - PHP templates: `header.php`, `footer.php`, `front-page.php`, `single.php`
   - Functions: `functions.php`
   - Includes: `inc/class-menu-walker.php`
   - Assets: `assets/css/`, `assets/js/`, `assets/images/`
3. **Changes to PHP files** require page refresh in browser (Ctrl+R)
4. **CSS/JS changes** may require hard refresh (Ctrl+F5) to clear browser cache
5. **Test functionality** at http://localhost:8080
6. **Access WordPress admin** at http://localhost:8080/wp-admin/
7. **Use Adminer** (http://localhost:8081) for direct database inspection
8. **Check debug log** at `wp-content/debug.log` for PHP errors (debug mode enabled)

## Important Notes

### Code Style and Standards
- Write camelCase code, not underscore_case
- Write explicit, simple code
- Do not use emojis in code or logging
- Follow WordPress coding standards for PHP
- Maintain Webflow class naming conventions in HTML/CSS

### Version Control
- WordPress core files are NOT version controlled (stored in Docker volume)
- Only `wp-content/` directory is version controlled
- Theme files: `wp-content/themes/enhancethat/`
- Original static site in `websiteToConvertToTheme/` is reference only

### Docker and Environment
- Docker command format: Use `docker compose` (no dash) per user's server configuration
- Database persists in `db_data` Docker volume between restarts
- Debug mode is enabled: Check `wp-content/debug.log` for PHP errors
- PHP configuration overrides in `uploads.ini`

### Theme Development
- Preserve Webflow class names and structure for animations to work
- Test animations after major changes (GSAP, Lottie, SplitType all need correct DOM structure)
- Navigation menu uses custom walker - changes to menu structure require testing
- All scripts/styles must be enqueued via `functions.php` (no direct HTML includes)

## Deployment Considerations

Per user's global instructions, home projects should be:
- Deployed to Docker container
- Include compose files (already present)
- Include GitHub Actions workflow for actions runner labeled "gbsrv" (home server)
- Server uses `docker compose` command (no dash)

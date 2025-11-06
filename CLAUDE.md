# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Jekyll-based static website for Enhance That, a company that helps fashion brands integrate digital design workflows. The site includes:

- Main marketing website (index.html, detail_clients.html, etc.)
- Blog functionality with Jekyll collections
- Custom domain deployment at enhancethat.fashion

## Architecture

### Site Structure
This is a **hybrid site** combining static HTML pages with Jekyll-generated blog content:

- **Static HTML pages**: Marketing pages (index.html, detail_clients.html, classnames.html) are Webflow exports with embedded styles
- **Jekyll-generated pages**: Blog posts and blog listing pages are dynamically generated
- **Layouts**: Three Jekyll layouts in `_layouts/`:
  - `blog_post.html`: Individual blog post template with comprehensive SEO meta tags
  - `post.html`: Alternative post layout
  - `default.html`: Base layout template
- **Assets**: CSS in `/css/`, JavaScript in `/js/`, images in `/images/`, fonts in `/fonts/`
- **Configuration**: `_config.yml` defines Jekyll settings and blog collection

### Jekyll Blog Configuration
The blog uses Jekyll's `_posts/` directory (NOT a custom collection despite the `_config.yml` naming):

- Blog posts are markdown files following `YYYY-MM-DD-title.md` naming convention
- Permalink structure: `/blog/:basename/` (generates URLs like `/blog/post-title/`)
- Excerpt separator: `<!--more-->` for preview text
- Default layout: `blog_post` (automatically applied to all posts in `_posts/`)

### Blog Post Front Matter
Each blog post should include:
```yaml
---
title: "Post Title"
subtitle: "Optional subtitle"
description: "SEO description (used in meta tags)"
date: YYYY-MM-DD
author: "Author Name" (defaults to "Enhance That")
cover: "/images/cover.jpg" (optional cover image)
---
```

### SEO Implementation
The `blog_post.html` layout includes comprehensive SEO:
- Open Graph tags (Facebook/LinkedIn sharing)
- Twitter Card metadata
- JSON-LD structured data (Schema.org Article format)
- Canonical URLs and robots meta tags
- Auto-calculated reading time
- Cover image fallback to `/images/Social-share.jpg`

### Content Management
- Blog posts: Markdown files in `_posts/` with YAML front matter
- Static pages: Direct HTML editing (Webflow-generated structure)
- Blog listing: `blog2.html` displays all posts with Jekyll loop

## Development Commands

### Initial Setup
```bash
# Install dependencies (required for Ruby 3.4+)
bundle install
```

### Jekyll Development
```bash
# Serve locally with auto-reload (use alternate port to avoid conflicts)
bundle exec jekyll serve --port 4001

# Build for production
bundle exec jekyll build

# Build with drafts
bundle exec jekyll serve --drafts --port 4001
```

**Note**: This project requires Ruby 3.3+ compatibility gems (`csv`, `logger`, `base64`) due to changes in Ruby's standard library. The GitHub Actions workflow uses Ruby 3.3.

### Git Workflow
- Main branch: `main` (auto-deploys to GitHub Pages via Actions)
- Feature branches: Create feature branches for new work
- Custom domain configured via CNAME file (enhancethat.fashion)

### GitHub Pages Deployment
This site uses GitHub Actions for deployment instead of standard GitHub Pages Jekyll processing, which allows:
- Jekyll 4.x support
- Custom gems and plugins
- Ruby 3.4+ compatibility

**Setup Required:**
1. Go to repository Settings → Pages
2. Set Source to "GitHub Actions"
3. Push to `main` branch triggers automatic deployment

The workflow is configured in `.github/workflows/jekyll.yml` and will:
- Build the site with Jekyll 4.3 and all custom dependencies
- Deploy automatically to `https://yourusername.github.io/reponame/`
- Support the custom domain at `enhancethat.fashion`

## Key Files
- `_config.yml`: Jekyll configuration and site settings
- `CNAME`: Custom domain configuration (enhancethat.fashion)
- `_posts/`: Blog content in markdown format (use YYYY-MM-DD-title.md naming)
- `_layouts/blog_post.html`: Primary blog post template with full SEO implementation
- `blog2.html`: Blog listing page (primary blog index)
- `blog.html`: Alternative blog listing page
- `.github/workflows/jekyll.yml`: GitHub Actions deployment workflow
- `Gemfile`: Ruby dependencies including Jekyll 4.3 and compatibility gems

## Working with Blog Posts

### Creating a New Blog Post
1. Create a new file in `_posts/` with naming: `YYYY-MM-DD-descriptive-title.md`
2. Add front matter with at minimum: `title`, `date`, `description`
3. Optionally add: `subtitle`, `cover` image, `author`
4. Use `<!--more-->` to mark excerpt separator for blog listing previews
5. Write content in markdown below front matter
6. Preview locally: `bundle exec jekyll serve --port 4001`
7. Push to `main` branch to deploy

### Editing Static Pages
Static pages (index.html, detail_clients.html, etc.) are Webflow exports:
- Edit HTML directly for content changes
- Styles are embedded in `<style>` tags within each file
- Shared assets (CSS, JS, images) are in respective directories
- Navigation and footer are duplicated across pages (not templated)
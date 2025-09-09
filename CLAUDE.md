# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Jekyll-based static website for Enhance That, a company that helps fashion brands integrate digital design workflows. The site includes:

- Main marketing website (index.html, detail_clients.html, etc.)
- Blog functionality with Jekyll collections
- Custom domain deployment at enhancethat.fashion

## Architecture

### Site Structure
- **Main HTML files**: Static marketing pages (index.html, detail_clients.html, classnames.html, blog2.html)
- **Jekyll Blog**: Uses `_posts/` directory with markdown files and Jekyll collections
- **Layouts**: `_layouts/default.html` and `_layouts/post.html` for templating
- **Assets**: CSS in `/css/`, JavaScript in `/js/`, images in `/images/`, fonts in `/fonts/`
- **Configuration**: `_config.yml` defines Jekyll settings, collections, and permalinks

### Jekyll Configuration
- Blog posts are in a custom collection at `/blog/:slug/`
- Uses excerpt separator `<!--more-->`
- Default layout for blog posts is `blog_post`
- Permalink structure: `/blog/:basename/`

### Content Management
- Blog posts follow Jekyll naming convention: `YYYY-MM-DD-title.md` in `_posts/`
- Static marketing content in HTML files with embedded CSS and JavaScript
- Uses Webflow-exported HTML structure with custom modifications

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

**Note**: This project requires Ruby 3.4+ compatibility gems (`csv`, `logger`, `base64`) due to changes in Ruby's standard library.

### Git Workflow
- Main branch: `main` (auto-deploys to GitHub Pages via Actions)
- Current branch: `blog2`
- Custom domain configured via CNAME file

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
- `_posts/`: Blog content in markdown format
- `_layouts/`: Jekyll templates for different page types
- `blog/index.html`: Blog listing page
- `.github/workflows/jekyll.yml`: GitHub Actions deployment workflow
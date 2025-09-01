# Enhance That Blog

This website is powered by Jekyll, a static site generator that automatically creates blog post listings from Markdown files.

## Setup Instructions

### Prerequisites
1. Install Ruby (version 2.7.0 or higher)
2. Install Bundler: `gem install bundler`

### Installation
1. Clone this repository
2. Navigate to the project directory
3. Install dependencies: `bundle install`

### Running the Site Locally
```bash
bundle exec jekyll serve
```

The site will be available at `http://localhost:4000`

## Adding Blog Posts

To add a new blog post:

1. Create a new Markdown file in the `_posts` directory
2. Name it with the format: `YYYY-MM-DD-post-title.md`
3. Add frontmatter at the top of the file:

```yaml
---
title: "Your Post Title"
date: 2025-09-01
excerpt: "A brief description of your post"
read_time: "5 min read"
---
```

4. Write your content below the frontmatter using Markdown syntax

## Project Structure

```
├── _config.yml          # Jekyll configuration
├── _layouts/             # Page templates
│   ├── default.html     # Main site layout
│   └── post.html        # Blog post layout
├── _posts/               # Blog posts (Markdown files)
├── blog/
│   └── index.html       # Blog listing page
├── css/                 # Stylesheets
├── images/              # Images and assets
├── js/                  # JavaScript files
└── index.html           # Homepage
```

## Features

- **Automatic Blog Listings**: Jekyll automatically generates the blog index page from Markdown files
- **SEO Optimized**: Proper meta tags and structured data
- **Responsive Design**: Works on all device sizes
- **Fast Loading**: Optimized images and assets

## Deployment

The site can be deployed to:
- GitHub Pages (free hosting)
- Netlify
- Vercel
- Any static hosting service

For GitHub Pages, simply push to the main branch and enable Pages in your repository settings.

## Content Management

### Blog Post Frontmatter Options

```yaml
---
title: "Required: Post title"
date: 2025-09-01                    # Required: Publication date
excerpt: "Optional: Post summary"   # Used in listings and meta tags
read_time: "5 min read"            # Optional: Reading time estimate
---
```

### Writing Tips

- Use clear, descriptive titles
- Include an engaging excerpt (appears in blog listings)
- Add images to `/images/` and reference them with `![Alt text](/images/filename.jpg)`
- Use proper Markdown formatting for headings, lists, and links
- Include internal links to other posts when relevant

## Customization

- **Styling**: Modify CSS files in the `/css/` directory
- **Layout**: Edit template files in `/_layouts/`
- **Site Settings**: Update `_config.yml`
- **Navigation**: Modify the navbar in `/_layouts/default.html`

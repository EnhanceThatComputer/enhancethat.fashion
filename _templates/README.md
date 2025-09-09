# Blog Post Templates

This directory contains templates for creating new blog posts.

## Using the Template

1. **Copy the template**: Copy `blog-post-template.md` to your blog directory
2. **Rename the file**: Use the Jekyll naming convention: `YYYY-MM-DD-your-post-title.md`
3. **Update front matter**: Fill in title, date, description, and permalink
4. **Add your content**: Replace template content with your article
5. **Add images**: Place images in `/images/articles/` folder

## Image Guidelines

### File Organization
```
images/
  articles/
    your-post-slug/
      hero-image.jpg
      diagram-1.jpg
      screenshot-2.jpg
```

### Image Syntax
- **Standard markdown**: `![alt text]({{ '/images/articles/image.jpg' | relative_url }})`
- **With caption**: `![alt text]({{ '/images/articles/image.jpg' | relative_url }} "Caption here")`
- **HTML for styling**: `<img src="{{ '/images/articles/image.jpg' | relative_url }}" alt="description" style="width: 100%;">`

### Best Practices
- Use descriptive alt text for accessibility
- Optimize images (recommend max 1200px wide, under 500KB)
- Use JPG for photos, PNG for graphics with transparency
- Name files descriptively: `automation-workflow-diagram.jpg`

## Front Matter Options

Required:
```yaml
title: Your Post Title
date: 2025-01-01
layout: blog_post
description: SEO description
permalink: /blog/your-slug/
```

Optional:
```yaml
cover: /images/articles/cover-image.jpg
author: Author Name
tags: [automation, fashion, workflow]
```

## Testing Locally

Before publishing:
```bash
bundle exec jekyll serve --port 4001
```

Then visit `http://localhost:4001/blog/your-slug/` to preview.
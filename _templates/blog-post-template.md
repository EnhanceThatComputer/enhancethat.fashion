---
title: Your Blog Post Title Here
date: YYYY-MM-DD
layout: blog_post
description: A compelling description of your blog post that will appear in previews and SEO.
permalink: /blog/your-post-slug/
# Optional: add a cover image
# cover: /images/articles/your-cover-image.jpg
---

Your engaging opening paragraph goes here. This will appear as the excerpt on the blog listing page. <!--more-->

## Introduction

Start your main content here. Use proper heading hierarchy for better SEO and readability.

### Subheading Example

Write your content with proper markdown formatting:

- **Bold text** for emphasis
- *Italic text* for subtle emphasis
- `code snippets` for technical terms
- [Links to external resources](https://example.com)
- [Internal links]({{ '/blog/another-post/' | relative_url }})

## Adding Images

### Single Image
![Descriptive alt text]({{ '/images/articles/your-image.jpg' | relative_url }} "Optional caption")

### Image with Custom Styling
<img src="{{ '/images/articles/your-image.jpg' | relative_url }}" alt="Descriptive alt text" style="width: 100%; max-width: 600px; margin: 20px 0;">

### Side-by-side Images (using HTML for better control)
<div style="display: flex; gap: 20px; flex-wrap: wrap;">
  <img src="{{ '/images/articles/image1.jpg' | relative_url }}" alt="Description 1" style="flex: 1; min-width: 300px;">
  <img src="{{ '/images/articles/image2.jpg' | relative_url }}" alt="Description 2" style="flex: 1; min-width: 300px;">
</div>

## Code Examples

```javascript
// Use triple backticks for code blocks
function example() {
  return "This is properly formatted code";
}
```

## Lists and Structure

### Unordered Lists
- First point about fashion workflows
- Second point about automation
- Third point about integration

### Ordered Lists
1. **Step one**: Define your workflow requirements
2. **Step two**: Identify automation opportunities  
3. **Step three**: Implement and test solutions

## Quotes and Callouts

> "Automation isn't about replacing designers; it's about removing the busywork so the real work shows."
> — Enhance That Team

## Links and References

- [Enhance That Home]({{ '/' | relative_url }})
- [Schedule a Call](https://outlook.office365.com/owa/calendar/EnhanceThat@enhancethat.fashion/bookings/s/ykcAmlR2zkiMHzfWw-WJLQ2)
- [Other Blog Posts]({{ '/blog/' | relative_url }})

## Conclusion

Wrap up your post with key takeaways and next steps. Consider adding a call-to-action.

---

### Publishing Checklist:
- [ ] Update title, date, and description
- [ ] Set unique permalink slug
- [ ] Add images to `/images/articles/` folder
- [ ] Test image paths work locally with `bundle exec jekyll serve --port 4001`
- [ ] Proofread content
- [ ] Verify all links work
- [ ] Check mobile formatting
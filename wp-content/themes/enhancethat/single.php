<?php
/**
 * Single Post Template
 *
 * @package EnhanceThat
 */

get_header();
?>

<style>
/* Override white title color to blue */
.heading-style-h1 {
  color: var(--blue) !important;
}
/* Ensure proper spacing and styling for blog post content */
.rich-text {
  line-height: 1.8;
  margin-top: 13px;
  font-family: Innovator Grotesk, Verdana, sans-serif;
  font-size: 19px;
  color: #444;
}
@media (max-width: 768px) {
  .rich-text {
    margin-top: 10px;
  }
}
.rich-text p {
  margin-bottom: 28px;
}
.rich-text ul, .rich-text ol {
  margin-bottom: 25px;
  padding-left: 25px;
}
.rich-text li {
  margin-bottom: 8px;
  line-height: 1.7;
}
.rich-text blockquote {
  margin: 30px 0;
  padding: 20px 25px;
  background: #f8f9fa;
  border-left: 4px solid var(--blue);
  font-style: italic;
  color: #555;
}
/* Blog post links styling */
.rich-text a {
  color: var(--blue);
  text-decoration: underline;
  transition: opacity 0.2s;
}
.rich-text a:hover {
  opacity: 0.8;
}
/* Mobile margins for better readability */
@media (max-width: 768px) {
  .container.shortener-60 {
    padding-left: 20px;
    padding-right: 20px;
  }
}
.rich-text h2, .rich-text h3, .rich-text h4 {
  color: var(--blue);
  margin-top: 30px;
  margin-bottom: 15px;
}
/* Blog subtitle styling */
.blog-subtitle {
  color: var(--blue);
  font-size: 2rem;
  font-weight: normal;
  line-height: 1.4;
  margin-top: 10px;
  margin-bottom: 25px;
}
/* Cover image styling - full width of content area */
.blog-cover-image {
  width: 100%;
  max-width: none;
  height: 400px;
  object-fit: cover;
  border-radius: 12px;
  margin: 30px 0 13px 0;
  display: block;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
@media (max-width: 768px) {
  .blog-cover-image {
    height: 250px;
    margin: 20px 0 8px 0;
  }
}
/* Cover attribution styling */
.cover-attribution {
  font-size: 0.85rem;
  color: #888;
  margin: -10px 0 20px 0;
  font-style: italic;
}
.cover-attribution a {
  color: #888;
  text-decoration: underline;
}
.cover-attribution a:hover {
  color: var(--blue);
}
/* Post taxonomies styling */
.post-taxonomies {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 20px 0;
}
.taxonomy-badge {
  font-size: 0.85rem;
  padding: 6px 12px;
  border-radius: 12px;
  font-weight: 600;
  text-decoration: none;
  transition: opacity 0.2s;
}
.taxonomy-badge:hover {
  opacity: 0.8;
}
.category-badge {
  background: var(--blue);
  color: white;
}
.tag-badge {
  background: var(--tiffany);
  color: #222;
}
</style>

<?php while (have_posts()) : the_post(); ?>

<section class="section">
  <div class="container shortener-60">
    <br>
    <?php if (has_post_thumbnail()) : ?>
    <?php the_post_thumbnail('enhancethat-blog-cover', array('class' => 'blog-cover-image', 'alt' => get_the_title())); ?>
    <?php
    $coverAttribution = enhancethat_get_cover_attribution();
    if ($coverAttribution) :
    ?>
    <p class="cover-attribution"><?php echo wp_kses_post($coverAttribution); ?></p>
    <?php endif; ?>
    <?php endif; ?>

    <h1 class="heading-style-h1 split-type"><?php the_title(); ?></h1>

    <?php
    $subtitle = enhancethat_get_subtitle();
    if ($subtitle) :
    ?>
    <h2 class="blog-subtitle"><?php echo esc_html($subtitle); ?></h2>
    <?php endif; ?>

    <p class="text-style-regular text-color-grey-2">
      <?php echo get_the_date('F j, Y'); ?>
      ·
      <?php echo enhancethat_reading_time(); ?> min read
    </p>

    <?php
    // Display categories and tags
    $categories = get_the_category();
    $tags = get_the_tags();
    if ($categories || $tags) :
    ?>
    <div class="post-taxonomies">
      <?php
      if ($categories) {
        foreach ($categories as $category) {
          echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="taxonomy-badge category-badge">' . esc_html($category->name) . '</a>';
        }
      }
      if ($tags) {
        foreach ($tags as $tag) {
          echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="taxonomy-badge tag-badge">' . esc_html($tag->name) . '</a>';
        }
      }
      ?>
    </div>
    <?php endif; ?>

    <div class="rich-text">
      <?php the_content(); ?>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const blogLinks = document.querySelectorAll('.rich-text a');
        blogLinks.forEach(link => {
          if (link.href.startsWith('http') && !link.href.includes('<?php echo esc_js(home_url()); ?>')) {
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');
          }
        });
      });
    </script>
  </div>
</section>

<?php endwhile; ?>

<?php
get_footer();

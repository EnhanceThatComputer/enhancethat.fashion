<?php
/**
 * Blog Listing Template
 *
 * @package EnhanceThat
 */

get_header();
?>

<section class="hero">
  <div class="container vcenter">
    <div class="shortener-50">
      <h1 class="heading-style-h1 split-type bugfix-width">Blog<span class="font-family-domaine"></span></h1>
    </div>
  </div>
  <div class="grain"></div>
</section>

<section class="section">
  <div class="container">
    <?php if (have_posts()) : ?>
      <div class="blog-list">
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
            <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit; display: contents;">

              <?php if (has_post_thumbnail()) : ?>
                <div class="blog-card-cover" style="width: 100%; height: 200px; margin: -32px -24px 20px -24px; border-radius: 16px 16px 0 0; overflow: hidden;">
                  <?php the_post_thumbnail('enhancethat-blog-cover', array(
                    'style' => 'width: 100%; height: 100%; object-fit: cover;',
                    'alt' => get_the_title()
                  )); ?>
                </div>
              <?php endif; ?>

              <h2 class="blog-card-title"><?php the_title(); ?></h2>

              <?php
              $subtitle = enhancethat_get_subtitle();
              if ($subtitle) :
              ?>
                <div class="blog-card-subtitle" style="color: var(--blue); font-size: 0.95rem; margin-bottom: 12px; line-height: 1.4;">
                  <?php echo esc_html($subtitle); ?>
                </div>
              <?php endif; ?>

              <div class="blog-card-meta">
                <?php echo get_the_date('F Y'); ?>
                ·
                <?php echo enhancethat_reading_time(); ?> min read
              </div>

              <?php
              // Display categories and tags
              $categories = get_the_category();
              $tags = get_the_tags();
              if ($categories || $tags) :
              ?>
                <div class="blog-card-taxonomies" style="margin-bottom: 16px; display: flex; flex-wrap: wrap; gap: 6px;">
                  <?php
                  if ($categories) {
                    foreach ($categories as $category) {
                      echo '<span class="taxonomy-badge category-badge" style="background: var(--blue); color: white; font-size: 0.75rem; padding: 4px 10px; border-radius: 12px; font-weight: 600;">' . esc_html($category->name) . '</span>';
                    }
                  }
                  if ($tags) {
                    foreach ($tags as $tag) {
                      echo '<span class="taxonomy-badge tag-badge" style="background: var(--tiffany); color: #222; font-size: 0.75rem; padding: 4px 10px; border-radius: 12px; font-weight: 600;">' . esc_html($tag->name) . '</span>';
                    }
                  }
                  ?>
                </div>
              <?php endif; ?>

              <div class="blog-card-desc">
                <?php
                if (has_excerpt()) {
                  echo wp_trim_words(get_the_excerpt(), 30);
                } else {
                  echo wp_trim_words(get_the_content(), 30);
                }
                ?>
              </div>

              <span class="button-yellow w-button" style="margin-top: auto;">Read more</span>
            </a>
          </article>
        <?php endwhile; ?>
      </div>

      <div class="pagination" style="margin-top: 60px; text-align: center;">
        <?php
        the_posts_pagination(array(
          'mid_size' => 2,
          'prev_text' => __('← Previous', 'enhancethat'),
          'next_text' => __('Next →', 'enhancethat'),
          'before_page_number' => '<span class="screen-reader-text">Page </span>',
        ));
        ?>
      </div>

    <?php else : ?>
      <p class="text-style-regular">No posts found in blog. Add posts through the WordPress admin panel.</p>
    <?php endif; ?>
  </div>
</section>

<style>
/* Blog grid layout */
.blog-list {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  justify-content: flex-start;
}

.blog-card {
  background: #fff;
  color: #222;
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.07);
  flex: 1 1 300px;
  max-width: 400px;
  min-width: 300px;
  padding: 32px 24px 24px 24px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: box-shadow 0.2s, transform 0.2s;
  text-decoration: none;
}

.blog-card:hover {
  box-shadow: 0 8px 32px rgba(0,0,0,0.13);
  transform: translateY(-2px);
}

.blog-card-title {
  font-size: 1.3rem;
  font-weight: 700;
  margin-bottom: 12px;
  color: #0a0a23;
  line-height: 1.3;
}

.blog-card-meta {
  font-size: 0.9rem;
  color: #888;
  margin-bottom: 16px;
}

.blog-card-desc {
  font-size: 1rem;
  color: #444;
  margin-bottom: 18px;
  flex-grow: 1;
  line-height: 1.5;
}

@media (max-width: 768px) {
  .blog-list {
    justify-content: center;
  }
  .blog-card {
    flex: 1 1 100%;
    max-width: 100%;
    min-width: unset;
  }
}

/* Pagination styling */
.pagination .nav-links {
  display: flex;
  justify-content: center;
  gap: 10px;
  align-items: center;
}

.pagination .page-numbers {
  padding: 8px 14px;
  background: #fff;
  color: var(--blue);
  text-decoration: none;
  border-radius: 6px;
  border: 1px solid #ddd;
  transition: all 0.2s;
}

.pagination .page-numbers:hover,
.pagination .page-numbers.current {
  background: var(--blue);
  color: white;
  border-color: var(--blue);
}
</style>

<?php
get_footer();

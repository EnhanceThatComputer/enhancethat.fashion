<?php
/**
 * Archive Template - 2026
 * (Category, Tag, Date, Author archives)
 *
 * @package EnhanceThat2026
 */

get_header();
?>

<section class="blog-section">
  <div class="blog-container">
    <h1 class="blog-title">
      <?php
      if (is_category()) {
        single_cat_title();
      } elseif (is_tag()) {
        single_tag_title();
      } elseif (is_author()) {
        printf(__('Author: %s', 'enhancethat-2026'), '<span class="vcard">' . get_the_author() . '</span>');
      } elseif (is_day()) {
        printf(__('Day: %s', 'enhancethat-2026'), '<span>' . get_the_date() . '</span>');
      } elseif (is_month()) {
        printf(__('Month: %s', 'enhancethat-2026'), '<span>' . get_the_date('F Y') . '</span>');
      } elseif (is_year()) {
        printf(__('Year: %s', 'enhancethat-2026'), '<span>' . get_the_date('Y') . '</span>');
      } else {
        _e('Archives', 'enhancethat-2026');
      }
      ?>
    </h1>

    <?php
    // Display archive description if available
    $description = get_the_archive_description();
    if ($description) :
    ?>
    <div class="archive-description">
      <?php echo wp_kses_post($description); ?>
    </div>
    <?php endif; ?>

    <?php if (have_posts()) : ?>
      <div class="blog-list">
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
            <a href="<?php the_permalink(); ?>" class="blog-card-link">

              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('enhancethat-blog-cover', array('class' => 'blog-cover', 'alt' => get_the_title())); ?>
              <?php endif; ?>

              <div class="blog-card-content">
                <h2 class="blog-card-title"><?php the_title(); ?></h2>

                <?php
                $subtitle = enhancethat_get_subtitle();
                if ($subtitle) :
                ?>
                  <p class="blog-card-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>

                <div class="blog-card-meta">
                  <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('F Y'); ?></time>
                  <span>·</span>
                  <span><?php echo enhancethat_reading_time(); ?> min read</span>
                  <?php
                  $categories = get_the_category();
                  if ($categories) :
                    echo '<span>·</span>';
                    $catNames = array();
                    foreach ($categories as $category) {
                      $catNames[] = esc_html($category->name);
                    }
                    echo '<span>' . implode(', ', $catNames) . '</span>';
                  endif;
                  ?>
                </div>

                <div class="blog-card-excerpt">
                  <?php
                  if (has_excerpt()) {
                    echo wp_trim_words(get_the_excerpt(), 25);
                  } else {
                    echo wp_trim_words(get_the_content(), 25);
                  }
                  ?>
                </div>

                <span class="blog-card-link-text">Read more →</span>
              </div>
            </a>
          </article>
        <?php endwhile; ?>
      </div>

      <?php if (get_the_posts_pagination()) : ?>
      <nav class="pagination" aria-label="Posts pagination">
        <?php
        the_posts_pagination(array(
          'mid_size' => 2,
          'prev_text' => __('← Previous', 'enhancethat-2026'),
          'next_text' => __('Next →', 'enhancethat-2026'),
          'before_page_number' => '<span class="screen-reader-text">Page </span>',
        ));
        ?>
      </nav>
      <?php endif; ?>

    <?php else : ?>
      <div class="no-posts">
        <p>No posts found in this archive.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>

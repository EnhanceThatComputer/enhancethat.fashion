<?php
/**
 * Single Post Template - 2026
 *
 * @package EnhanceThat2026
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<article class="single-post">
  <header class="post-header">
    <h1 class="post-title"><?php the_title(); ?></h1>

    <?php
    $subtitle = enhancethat_get_subtitle();
    if ($subtitle) :
    ?>
    <p class="post-subtitle"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>

    <div class="post-meta">
      <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
      <span class="meta-separator">·</span>
      <span><?php echo enhancethat_reading_time(); ?> min read</span>
      <?php
      $categories = get_the_category();
      if ($categories) :
        echo '<span class="meta-separator">·</span>';
        $catNames = array();
        foreach ($categories as $category) {
          $catNames[] = esc_html($category->name);
        }
        echo implode(', ', $catNames);
      endif;
      ?>
    </div>
  </header>

  <?php if (has_post_thumbnail()) : ?>
  <figure class="post-cover-wrapper">
    <?php the_post_thumbnail('enhancethat-blog-cover', array('class' => 'post-cover', 'alt' => get_the_title())); ?>
    <?php
    $coverAttribution = enhancethat_get_cover_attribution();
    if ($coverAttribution) :
    ?>
    <figcaption class="post-cover-attribution"><?php echo wp_kses_post($coverAttribution); ?></figcaption>
    <?php endif; ?>
  </figure>
  <?php endif; ?>

  <div class="post-content">
    <?php the_content(); ?>
  </div>

  <?php
  $tags = get_the_tags();
  if ($tags) :
  ?>
  <footer class="post-footer">
    <div class="post-tags">
      <span class="tags-label">Tags:</span>
      <?php
      foreach ($tags as $tag) {
        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">' . esc_html($tag->name) . '</a>';
      }
      ?>
    </div>
  </footer>
  <?php endif; ?>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>

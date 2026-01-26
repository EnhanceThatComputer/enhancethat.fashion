<?php
/**
 * Fallback Template
 *
 * @package EnhanceThat
 */

get_header();
?>

<section class="section">
  <div class="container shortener-60">
    <br>
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h1 class="heading-style-h1">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h1>
          <div class="rich-text">
            <?php the_content(); ?>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p class="text-style-regular">No content found.</p>
    <?php endif; ?>
  </div>
</section>

<?php
get_footer();

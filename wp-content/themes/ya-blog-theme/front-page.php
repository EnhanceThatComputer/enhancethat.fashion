<?php
/**
 * The front page template file
 *
 * @package YA_Blog_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    if (have_posts()) {
        ?>
        <div class="post-list">
            <?php
            while (have_posts()) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                <?php
            }
            ?>
        </div>

        <?php
        the_posts_navigation();

    } else {
        ?>
        <p>No posts found.</p>
        <?php
    }
    ?>

</main>

<?php
get_footer();

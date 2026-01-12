<?php
/**
 * The template for displaying pages
 *
 * @package YA_Blog_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) {
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header>

            <?php if (has_post_thumbnail()) { ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php } ?>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">Pages:',
                    'after'  => '</div>',
                ));
                ?>
            </div>
        </article>

        <?php
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>

    <?php
    }
    ?>

</main>

<?php
get_sidebar();
get_footer();

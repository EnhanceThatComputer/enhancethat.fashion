<?php
/**
 * The template for displaying single posts
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

                <div class="entry-meta">
                    <span class="posted-on">
                        Published on <?php echo get_the_date(); ?>
                    </span>
                    <span class="byline">
                        by <?php the_author(); ?>
                    </span>
                    <?php if (has_category()) { ?>
                        <span class="cat-links">
                            in <?php the_category(', '); ?>
                        </span>
                    <?php } ?>
                </div>
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

            <footer class="entry-footer">
                <?php
                if (has_tag()) {
                    the_tags('<span class="tags-links">Tags: ', ', ', '</span>');
                }
                ?>
            </footer>
        </article>

        <?php
        if (comments_open() || get_comments_number()) {
            comments_template();
        }

        the_post_navigation(array(
            'prev_text' => '<span class="nav-subtitle">Previous:</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">Next:</span> <span class="nav-title">%title</span>',
        ));
    }
    ?>

</main>

<?php
if (get_theme_mod('show_sidebar_on_posts', false)) {
    get_sidebar();
}
get_footer();

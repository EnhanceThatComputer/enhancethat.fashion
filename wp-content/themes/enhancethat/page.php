<?php
/**
 * Generic Page Template
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
/* Ensure proper spacing and styling for page content */
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
/* Page links styling */
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
</style>

<?php while (have_posts()) : the_post(); ?>

<section class="section">
  <div class="container shortener-60">
    <br>
    <h1 class="heading-style-h1"><?php the_title(); ?></h1>

    <div class="rich-text">
      <?php the_content(); ?>
    </div>
  </div>
</section>

<?php endwhile; ?>

<?php
get_footer();

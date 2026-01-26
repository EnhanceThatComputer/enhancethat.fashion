</main>

<?php if (is_front_page()) : ?>
<footer class="fp-footer" role="contentinfo">
    <div class="fp-container">
        <p class="fp-footer-text">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
        </p>
    </div>
</footer>
<?php else : ?>
<footer class="footer-2026" role="contentinfo">
    <div class="footer-content">
        <p class="footer-text">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            <?php if (has_nav_menu('footer')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'nav',
                    'container_class' => 'footer-menu',
                    'menu_class' => '',
                    'depth' => 1,
                    'fallback_cb' => false,
                ));
                ?>
            <?php endif; ?>
        </p>
    </div>
</footer>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>

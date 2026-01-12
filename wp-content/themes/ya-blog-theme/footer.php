    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="site-info">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>

        <nav id="footer-navigation" class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_id'        => 'footer-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

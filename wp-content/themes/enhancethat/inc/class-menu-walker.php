<?php
/**
 * Custom Menu Walker for EnhanceThat Theme
 *
 * Outputs menu items with Webflow-style button classes
 * to maintain the original design and animations.
 */

class EnhanceThat_Menu_Walker extends Walker_Nav_Menu {

    /**
     * Start the element output.
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        // Add Webflow button classes
        $classNames = 'button-yellow w-button';

        $attributes = '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="' . esc_attr($classNames) . '"';

        // Add target="_blank" for external links
        if ($item->target && '_blank' === $item->target) {
            $attributes .= ' target="_blank"';
        }

        // Add rel="noopener" for security when using target="_blank"
        if ($item->target && '_blank' === $item->target) {
            $attributes .= ' rel="noopener"';
        }

        $item_output = '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</a>';

        $output .= $item_output;
    }

    /**
     * Don't output wrapper elements for this menu
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        // No submenu support needed for this navigation
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // No submenu support needed for this navigation
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing wrapper needed
    }
}

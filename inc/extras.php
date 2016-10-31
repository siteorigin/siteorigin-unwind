<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

if ( ! function_exists( 'siteorigin_unwind_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function siteorigin_unwind_body_classes( $classes ) {

	// Add a CSS3 animations class.
	$classes[] = 'css3-animations';

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Homepage slider.
	if ( is_home() && siteorigin_setting( 'blog_featured_slider' ) && siteorigin_unwind_has_featured_posts( 5 ) ) {
		$classes[] = 'homepage-has-slider';
	}

	// If we're viewing on a mobile device, add a class.
	if ( wp_is_mobile() ) {
		$classes[] = 'is_mobile';
	}

	// Add a no-js class which we'll remove as required.
	$classes[] = 'no-js';

	// Check if the sidebar has widgets.
	$wc_shop_sidebar = siteorigin_unwind_is_woocommerce_active() && is_shop() && is_active_sidebar( 'shop-sidebar' );
	if ( ! is_active_sidebar( 'main-sidebar' ) && ! $wc_shop_sidebar ) {
		$classes[] = 'no-active-sidebar';
	}

	// Add the page setting classes.
	$page_settings = siteorigin_page_setting();

	if ( ! empty( $page_settings ) ) {
		if ( ! empty( $page_settings['layout'] ) ) $classes[] = 'page-layout-' . $page_settings['layout'];

		if ( empty( $page_settings['masthead_margin'] ) ) $classes[] = 'page-layout-no-masthead-margin';
		if ( empty( $page_settings['footer_margin'] ) ) $classes[] = 'page-layout-no-footer-margin';
		if ( empty( $page_settings['masthead'] ) ) $classes[] = 'page-layout-hide-masthead';
		if ( empty( $page_settings['footer_widgets'] ) ) $classes[] = 'page-layout-hide-footer-widgets';
	}

	// If the navigation is sticky, add a class.
	if ( siteorigin_setting( 'navigation_sticky' ) ) {
		$classes[] = 'sticky-menu';
	}

	return $classes;
}
endif;
add_filter( 'body_class', 'siteorigin_unwind_body_classes' );

if ( ! function_exists( 'siteorigin_unwind_excerpt_read_more' ) ) :
/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function siteorigin_unwind_excerpt_read_more( $more ) {
    return '...';
}
endif;
add_filter( 'excerpt_more', 'siteorigin_unwind_excerpt_read_more' );

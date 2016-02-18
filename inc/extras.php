<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package siteorigin_unwind
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function siteorigin_unwind_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	$classes[] = 'no-js';
	$classes[] = 'css3-animations';
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Check if the sidebar has widgets
	if( !is_active_sidebar('main-sidebar') ) {
		$classes[] = 'no-active-sidebar';
	}

	if( siteorigin_setting('navigation_sticky') ) {
		$classes[] = 'sticky-menu';
	}

	if( wp_is_mobile() ) {
		$classes[] = 'is_mobile';
	}

	return $classes;
}
add_filter( 'body_class', 'siteorigin_unwind_body_classes' );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function siteorigin_unwind_excerpt_read_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'siteorigin_unwind_excerpt_read_more' );

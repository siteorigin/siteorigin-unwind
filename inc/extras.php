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

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Check if the sidebar has widgets
	if( !is_active_sidebar('main-sidebar') ) {
		$classes[] = 'no-active-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'siteorigin_unwind_body_classes' );

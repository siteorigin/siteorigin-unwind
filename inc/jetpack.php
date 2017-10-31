<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

if ( ! function_exists( 'siteorigin_unwind_jetpack_setup' ) ) :
/**
 * Jetpack setup function.
 *
 */
function siteorigin_unwind_jetpack_setup() {
	/*
	 * Enable support for Jetpack Featured Content.
	 * See https://jetpack.com/support/featured-content/
	 */
	add_theme_support( 'featured-content', array(
		'filter'     => 'siteorigin_unwind_get_featured_posts',
		'max_posts'  => 5,
		'post_types' => array( 'post' ),
	) );

	/*
	 * Enable support for Jetpack Infinite Scroll.
	 * See https://jetpack.com/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'siteorigin_unwind_infinite_scroll_render',
		'footer'    => 'page',
	) );

	/**
	 * Enable support for Jetpack Portfolio custom post type.
	 * See https://jetpack.com/support/custom-content-types/
	 */
	add_theme_support( 'jetpack-portfolio' );	

	/*
	 * Enable support for Jetpack Responsive Videos.
	 * See https://jetpack.com/support/responsive-videos/
	 */
	add_theme_support( 'jetpack-responsive-videos' );
}
endif;
// siteorigin_unwind_jetpack_setup
add_action( 'after_setup_theme', 'siteorigin_unwind_jetpack_setup' );

/**
 * Remove the Jetpack stylesheets we don't require.
 *
 */
function siteorigin_unwind_remove_jetpack_css() {
	wp_deregister_style( 'jetpack-portfolio-style' );
}
add_action( 'wp_footer', 'siteorigin_unwind_remove_jetpack_css' );

/**
 * Custom render function for Infinite Scroll.
 */
function siteorigin_unwind_infinite_scroll_render() {
	if ( is_search() ) : ?>
		<div class="left-medium-loop"><?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			} ?>
		</div><!-- .left-medium-loop --><?php
	elseif ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) :
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', 'portfolio' );
		}
	else :
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		}
	endif;
}

/**
 * Remove sharing buttons from their default locations
 */
 function siteorigin_unwind_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'siteorigin_unwind_remove_share' );

if ( ! function_exists( 'siteorigin_unwind_jetpack_related_projects' ) ) :
/**
 * Displays jetpack related posts for projects
 */
function siteorigin_unwind_jetpack_related_projects( $allowed_post_types ) {
	$allowed_post_type[] = 'jetpack-portfolio';
	return $allowed_post_type;
}
endif;
add_filter( 'rest_api_allowed_post_types', 'siteorigin_unwind_jetpack_related_projects' );

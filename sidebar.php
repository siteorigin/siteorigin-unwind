<?php
/**
 * The sidebar containing the main widget area.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @since siteorigin-unwind 0.1
 *
 * @license GPL 2.0
 */
if ( ! is_active_sidebar( 'main-sidebar' ) ) {
	return;
}

if ( ! in_array( siteorigin_page_setting( 'layout', 'default' ), array( 'default', 'full-width-sidebar' ), true )  ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'main-sidebar' ); ?>
</aside><!-- #secondary -->

<?php
/**
 * Template part for displaying the fullscreen search form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.9
 * @license GPL 2.0
 */

?>

<div class="container">
	<h3><?php esc_html_e( 'Search Site', 'siteorigin-unwind' ); ?></h3>
	<form id="fullscreen-search-form" method="get" action="<?php echo esc_url( site_url() ) ?>">
		<input type="search" name="s" placeholder="<?php esc_attr_e( 'Type and hit enter to search', 'siteorigin-unwind') ?>" value="<?php echo get_search_query() ?>" />
		<button type="submit">
			<label class="screen-reader-text"><?php esc_html_e( 'Search', 'siteorigin-unwind' ); ?></label>
			<?php siteorigin_unwind_display_icon( 'fullscreen-search' ); ?>
			<?php siteorigin_unwind_display_icon( 'fullscreen-loading' ); ?>
		</button>
	</form>
</div><!-- .container -->

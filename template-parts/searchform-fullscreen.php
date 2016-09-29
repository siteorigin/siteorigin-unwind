<?php
/**
 * Template part for displaying the fullscreen search form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-unwind
 */

?>

<form method="get" action="<?php echo esc_url( site_url() ) ?>">
	<h3>Search Site</h3>
	<input type="search" name="s" placeholder="<?php esc_attr_e( 'Type and hit enter to search', 'siteorigin-unwind') ?>" value="<?php echo get_search_query() ?>" />
	<input type="submit" value="<?php esc_attr_e('Search', 'siteorigin-unwind') ?>" />
</form>

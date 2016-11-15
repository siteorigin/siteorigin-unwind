<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( site_url() ) ?>">
	<label for='s' class='screen-reader-text'><?php esc_html_e( 'Search for:', 'siteorigin-unwind' ); ?></label>
	<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'siteorigin-unwind') ?>" value="<?php echo get_search_query() ?>" />
	<button type="submit">
		<label class="screen-reader-text"><?php esc_html_e( 'Search', 'siteorigin-unwind' ); ?></label>
		<?php siteorigin_unwind_display_icon( 'fullscreen-search' ); ?>
	</button>
</form>

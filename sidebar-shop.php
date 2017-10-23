<?php
/**
 * The sidebar for WooCommerce shop pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.0
 * @license GPL 2.0
 */

if ( ! is_active_sidebar( 'shop-sidebar' ) ) return;
if ( ! in_array( siteorigin_page_setting( 'layout', 'default' ), array( 'default','full-width-sidebar' ), true )  ) return;
if ( is_product() ) return;
?>

<aside id="secondary" class="shop-widgets widget-area">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</aside><!-- #secondary -->

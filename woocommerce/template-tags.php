<?php
/**
 * Custom WooCommerce template tags for this theme.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.9
 * @license GPL 2.0
 */

/**
 * The following functionality is focused on handling product archives and product loops.
 **/

// Move the result count.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 35 );

// Use a custom upsell function to change number of items.
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'siteorigin_unwind_woocommerce_output_upsells', 15 );

// Remove the cross sell display.
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

// Remove the Product Description Title
function siteorigin_unwind_woocommerce_description_title() {
	return '';
}
add_filter( 'woocommerce_product_description_heading', 'siteorigin_unwind_woocommerce_description_title' );

// Modify Archive Content
//remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
//remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
//remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
//remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

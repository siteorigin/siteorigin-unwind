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

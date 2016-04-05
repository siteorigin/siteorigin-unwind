<?php // A file that handles WooCommerce template functions.
/**
 * The following functionality is focused on handling product archives and product loops.
 **/

// Move the price higher
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 4 );

// Move the
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 35);

// Use a custom upsell function to change number of items
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product_summary', 'siteorigin_unwind_woocommerce_output_upsells', 15);

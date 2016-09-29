<?php

function siteorigin_unwind_woocommerce_change_hooks(){

	// Load template related functions.
	include get_template_directory() . '/woocommerce/template-tags.php';

}
add_action( 'after_setup_theme', 'siteorigin_unwind_woocommerce_change_hooks' );

function siteorigin_unwind_woocommerce_add_to_cart_text( $text ) {
	return $text;
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'siteorigin_unwind_woocommerce_add_to_cart_text' );

function siteorigin_unwind_woocommerce_enqueue_styles( $styles ){
	$styles['unwind-woocommerce'] = array(
		'src' => get_template_directory_uri() . '/woocommerce.css',
		'deps' => 'woocommerce-layout',
		'version' => SITEORIGIN_THEME_VERSION,
		'media' => 'all'
	);

	return $styles;
}
add_filter( 'woocommerce_enqueue_styles', 'siteorigin_unwind_woocommerce_enqueue_styles' );

function siteorigin_unwind_woocommerce_enqueue_scripts() {
	if ( ! function_exists( 'is_woocommerce' ) ) return;

	if ( is_woocommerce() || is_cart() ) {
		wp_enqueue_script( 'siteorigin-unwind-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
	}
}
add_filter( 'wp_enqueue_scripts', 'siteorigin_unwind_woocommerce_enqueue_scripts' );

function siteorigin_unwind_woocommerce_loop_shop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'siteorigin_unwind_woocommerce_loop_shop_columns' );

function siteorigin_unwind_woocommerce_related_product_args( $args ) {
	$args['columns'] = 3;
	$args['posts_per_page'] = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'siteorigin_unwind_woocommerce_related_product_args' );

if( ! function_exists('siteorigin_unwind_woocommerce_output_upsells' ) ) {

	function siteorigin_unwind_woocommerce_output_upsells(){
		woocommerce_upsell_display( -1, 3 );
	}

}

// Modifying cart product image size
add_image_size( 'cart_item_image_size', 80, 80, true );

add_filter( 'woocommerce_cart_item_thumbnail', 'cart_item_thumbnail', 10, 3 );

function cart_item_thumbnail( $thumb, $cart_item, $cart_item_key ) {
	// create the product object
	$product = get_product( $cart_item['product_id'] );
	return $product->get_image( 'cart_item_image_size' );
}

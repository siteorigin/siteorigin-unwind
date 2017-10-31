<?php
/**
 * Custom WooCommerce template tags for this theme.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.9
 * @license GPL 2.0
 */
if ( ! function_exists( 'siteorigin_unwind_woocommerce_change_hooks' ) ) :
function siteorigin_unwind_woocommerce_change_hooks() {
	// Move the result count.
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 35 );

	// Use a custom upsell function to change number of items.
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'siteorigin_unwind_woocommerce_output_upsells', 15 );

	// Remove the cross sell display.
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

	// Modify archive content.
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	add_action( 'woocommerce_before_shop_loop_item_title', 'siteorigin_unwind_woocommerce_loop_item_image', 10 );

	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	remove_action( 'wp_footer', 'woocommerce_demo_store' );
}
endif;
add_action( 'after_setup_theme', 'siteorigin_unwind_woocommerce_change_hooks' );

if( ! function_exists( 'siteorigin_unwind_woocommerce_product_hooks' ) ) :
function siteorigin_unwind_woocommerce_product_hooks() {
	// Archive title area.
	if ( ! is_product() ) :
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 8, 0 );
	endif;
}
endif;
add_action('template_redirect', 'siteorigin_unwind_woocommerce_product_hooks' );

// Quick view action hooks.
add_action( 'siteorigin_unwind_woocommerce_quick_view_images', 'siteorigin_unwind_woocommerce_quick_view_image', 5 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_title', 'woocommerce_template_single_title', 5 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_title', 'woocommerce_template_single_rating', 15 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_content', 'woocommerce_template_single_price', 10 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_content', 'woocommerce_template_single_excerpt', 15 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_content', 'woocommerce_template_single_add_to_cart', 20 );

if ( ! function_exists( 'siteorigin_unwind_woocommerce_description_title' ) ) :
// Remove the product description title.
function siteorigin_unwind_woocommerce_description_title() {
	return '';
}
endif;
add_filter( 'woocommerce_product_description_heading', 'siteorigin_unwind_woocommerce_description_title' );

if ( ! function_exists( 'siteorigin_unwind_woocommerce_loop_item_image' ) ) :
/**
 * The image section for the products in loop.
 */
function siteorigin_unwind_woocommerce_loop_item_image() { ?>
	<div class="loop-product-thumbnail">
		<?php woocommerce_template_loop_product_link_open(); ?>
		<?php woocommerce_template_loop_product_thumbnail(); ?>
		<?php woocommerce_template_loop_product_link_close(); ?>
		<?php woocommerce_template_loop_add_to_cart(); ?>
		<?php if ( siteorigin_setting( 'woocommerce_display_quick_view' ) ) {
			siteorigin_unwind_woocommerce_quick_view_button();
		} ?>
	</div>
<?php }
endif;

if ( ! function_exists( 'siteorigin_unwind_woocommerce_quick_view_button' ) ) :
/**
 * Quick view button for the products in loop
 */
function siteorigin_unwind_woocommerce_quick_view_button() {
	global $product;
	echo '<a href="#" id="product-id-' . $product->get_id() . '" class="button product-quick-view-button" data-product-id="' . $product->get_id() . '">' . esc_html__( 'Quick View', 'siteorigin-unwind') . '</a>';
}
endif;

if ( ! function_exists( 'siteorigin_unwind_woocommerce_quick_view_image' ) ) :
/**
 * Displays image in the product quick view.
 */
function siteorigin_unwind_woocommerce_quick_view_image() {
	echo woocommerce_get_product_thumbnail( 'shop_single' );
}
endif;

if ( ! function_exists( 'siteorigin_unwind_woocommerce_quick_view' ) ) :
/**
 * Setup quick view modal in the footer.
 */
function siteorigin_unwind_woocommerce_quick_view() { ?>
	<?php if ( siteorigin_setting( 'woocommerce_display_quick_view' ) ) : ?>
		<!-- WooCommerce Quick View -->
		<div id="quick-view-container">
			<div id="product-quick-view" class="quick-view"></div>
		</div>
	<?php endif; ?>
<?php }
endif;
add_action( 'wp_footer', 'siteorigin_unwind_woocommerce_quick_view', 100 );

if ( ! function_exists( 'so_product_quick_view_ajax' ) ) :
/**
 * Add quick view modal content.
 */
function so_product_quick_view_ajax() {

	if ( ! isset( $_REQUEST['product_id'] ) ) {
		die();
	}
	$product_id = intval( $_REQUEST['product_id'] );

	// set the main wp query for the product
	wp( 'p=' . $product_id . '&post_type=product' );

	ob_start();
	// load content template
	wc_get_template( 'quick-view.php' );
	echo ob_get_clean();

	die();
}
endif;
add_action( 'wp_ajax_so_product_quick_view', 'so_product_quick_view_ajax' );
add_action( 'wp_ajax_nopriv_so_product_quick_view', 'so_product_quick_view_ajax' );

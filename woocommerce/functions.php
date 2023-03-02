<?php
/**
 * SiteOrigin Unwind WooCommerce functions and definitions.
 *
 * @since siteorigin-unwind 0.9
 *
 * @license GPL 2.0
 */

// Load template related functions.
include get_template_directory() . '/woocommerce/template-tags.php';

function siteorigin_unwind_woocommerce_setup() {
	/*
	 * Add support for WooCommerce.
	 * @link https://docs.woocommerce.com/document/declare-woocommerce-support-in-third-party-theme/
	 */
	add_theme_support( 'woocommerce' );

	/*
	 * Add support for WooCommerce galleries.
	 * @link https://woocommerce.wordpress.com/2017/02/28/adding-support-for-woocommerce-2-7s-new-gallery-feature-to-your-theme/
	 */
	add_theme_support( 'wc-product-gallery-slider' );

	if ( siteorigin_setting( 'woocommerce_product_gallery' ) == 'slider-lightbox' ) {
		add_theme_support( 'wc-product-gallery-lightbox' );
	} elseif ( siteorigin_setting( 'woocommerce_product_gallery' ) == 'slider-zoom' ) {
		add_theme_support( 'wc-product-gallery-zoom' );
	} elseif ( siteorigin_setting( 'woocommerce_product_gallery' ) == 'slider-lightbox-zoom' ) {
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
	}
}
add_action( 'after_setup_theme', 'siteorigin_unwind_woocommerce_setup' );

function siteorigin_unwind_woocommerce_add_to_cart_text( $text ) {
	return $text;
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'siteorigin_unwind_woocommerce_add_to_cart_text' );

function siteorigin_unwind_woocommerce_enqueue_styles( $styles ) {
	$styles['unwind-woocommerce'] = array(
		'src' => get_template_directory_uri() . '/woocommerce' . SITEORIGIN_THEME_CSS_PREFIX . '.css',
		'deps' => array( 'woocommerce-layout', 'siteorigin-unwind-style' ),
		'version' => SITEORIGIN_THEME_VERSION,
		'media' => 'all',
	);

	return $styles;
}
add_filter( 'woocommerce_enqueue_styles', 'siteorigin_unwind_woocommerce_enqueue_styles' );

function siteorigin_unwind_woocommerce_enqueue_scripts() {
	if ( is_woocommerce() || is_cart() || wc_post_content_has_shortcode( 'products' ) ) {
		wp_enqueue_script( 'siteorigin-unwind-woocommerce', get_template_directory_uri() . '/js/woocommerce' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery', 'wc-add-to-cart-variation' ), SITEORIGIN_THEME_VERSION, true );
	}

	$script_data = array(
		'chevron_down' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" height="10" viewBox="0 0 32 32"><path d="M30.054 14.429l-13.25 13.232q-0.339 0.339-0.804 0.339t-0.804-0.339l-13.25-13.232q-0.339-0.339-0.339-0.813t0.339-0.813l2.964-2.946q0.339-0.339 0.804-0.339t0.804 0.339l9.482 9.482 9.482-9.482q0.339-0.339 0.804-0.339t0.804 0.339l2.964 2.946q0.339 0.339 0.339 0.813t-0.339 0.813z"></path></svg>',
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'siteorigin-unwind-woocommerce', 'so_unwind_data', $script_data );
}
add_filter( 'wp_enqueue_scripts', 'siteorigin_unwind_woocommerce_enqueue_scripts' );

/**
 * Filter the archive page title.
 */
function siteorigin_unwind_woocommerce_archive_title() {
	if ( siteorigin_page_setting( 'page_title' ) ) {
		return true;
	}
}
add_filter( 'woocommerce_show_page_title', 'siteorigin_unwind_woocommerce_archive_title' );

if ( ! function_exists( 'siteorigin_unwind_woocommerce_loop_shop_columns' ) ) {
	/*
	 * Change number of products per row.
	 *
	 * @link https://docs.woocommerce.com/document/change-number-of-products-per-row/
	 */
	function siteorigin_unwind_woocommerce_loop_shop_columns() {
		return 3;
	}
}
add_filter( 'loop_shop_columns', 'siteorigin_unwind_woocommerce_loop_shop_columns' );

/**
 * Change the gallery thumbnail image size.
 *
 * @see https://github.com/woocommerce/woocommerce/wiki/Customizing-image-sizes-in-3.3-
 */
function siteorigin_unwind_woocommerce_single_gallery_thumbnail_size( $size ) {
	return array(
		'width'  => 150,
		'height' => 150,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'siteorigin_unwind_woocommerce_single_gallery_thumbnail_size' );

function siteorigin_unwind_woocommerce_related_product_args( $args ) {
	$args['columns'] = 4;
	$args['posts_per_page'] = 4;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'siteorigin_unwind_woocommerce_related_product_args' );

if ( ! function_exists( 'siteorigin_unwind_woocommerce_output_upsells' ) ) {
	/*
	 * Change number of upsells output.
	 *
	 * @link https://docs.woocommerce.com/document/change-number-of-upsells-output/
	 */
	function siteorigin_unwind_woocommerce_output_upsells() {
		woocommerce_upsell_display( 4, 4 );
	}
}

function siteorigin_unwind_woocommerce_tag_cloud_widget() {
	$args['unit'] = 'px';
	$args['largest'] = 12;
	$args['smallest'] = 12;
	$args['taxonomy'] = 'product_tag';

	return $args;
}
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'siteorigin_unwind_woocommerce_tag_cloud_widget' );

if ( ! function_exists( 'siteorigin_unwind_woocommerce_update_cart_count' ) ) {
	/**
	 * Update cart count with the masthead cart icon.
	 */
	function siteorigin_unwind_woocommerce_update_cart_count( $fragments ) {
		ob_start();
		?>
	<span class="shopping-cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
	<?php

		$fragments['span.shopping-cart-count'] = ob_get_clean();

		return $fragments;
	}
}

if ( version_compare( $woocommerce->version, '3', '<' ) ) {
	add_filter( 'add_to_cart_fragments', 'siteorigin_unwind_woocommerce_update_cart_count' );
} else {
	add_filter( 'woocommerce_add_to_cart_fragments', 'siteorigin_unwind_woocommerce_update_cart_count' );
}

if ( ! function_exists( 'siteorigin_unwind_wc_columns' ) ) {
	// Change number of products per row.
	function siteorigin_unwind_wc_columns() {
		return siteorigin_setting( 'woocommerce_archive_columns' );
	}
}
add_filter( 'loop_shop_columns', 'siteorigin_unwind_wc_columns' );

/**
 * Move the demo store banner to the top bar if enabled.
 */
function siteorigin_unwind_wc_demo_store() {
	if ( ! is_store_notice_showing() ) {
		return;
	}

	$notice = get_option( 'woocommerce_demo_store_notice' );

	if ( empty( $notice ) ) {
		$notice = esc_html__( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'siteorigin-unwind' );
	}

	echo '<p class="woocommerce-store-notice demo_store">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link">' . esc_html__( 'Dismiss', 'siteorigin-unwind' ) . '</a></p>';
}

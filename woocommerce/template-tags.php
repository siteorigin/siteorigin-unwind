<?php
/**
 * Custom WooCommerce template tags for this theme.
 *
 * @since siteorigin-unwind 0.9
 *
 * @license GPL 2.0
 */
if ( ! function_exists( 'siteorigin_unwind_woocommerce_change_hooks' ) ) {
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
}
add_action( 'after_setup_theme', 'siteorigin_unwind_woocommerce_change_hooks' );

if ( ! function_exists( 'siteorigin_unwind_woocommerce_product_hooks' ) ) {
	function siteorigin_unwind_woocommerce_product_hooks() {
		// Archive title area.
		if ( ! is_product() ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 8, 0 );
		}
	}
}
add_action( 'template_redirect', 'siteorigin_unwind_woocommerce_product_hooks' );

// Quick view action hooks.
add_action( 'siteorigin_unwind_woocommerce_quick_view_images', 'siteorigin_unwind_woocommerce_quick_view_image', 5 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_title', 'woocommerce_template_single_title', 5 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_title', 'woocommerce_template_single_rating', 15 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_content', 'woocommerce_template_single_price', 10 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_content', 'woocommerce_template_single_excerpt', 15 );
add_action( 'siteorigin_unwind_woocommerce_quick_view_content', 'woocommerce_template_single_add_to_cart', 20 );

if ( ! function_exists( 'siteorigin_unwind_woocommerce_description_title' ) ) {
	// Remove the product description title.
	function siteorigin_unwind_woocommerce_description_title() {
		return '';
	}
}
add_filter( 'woocommerce_product_description_heading', 'siteorigin_unwind_woocommerce_description_title' );

if ( ! function_exists( 'siteorigin_unwind_woocommerce_loop_item_image' ) ) {
	/**
	 * The image section for the products in loop.
	 */
	function siteorigin_unwind_woocommerce_loop_item_image() { ?>
	<div class="loop-product-thumbnail">
		<?php woocommerce_template_loop_product_link_open(); ?>
		<?php woocommerce_template_loop_product_thumbnail(); ?>
		<?php woocommerce_template_loop_product_link_close(); ?>
		<?php if ( siteorigin_setting( 'woocommerce_add_to_cart' ) ) {
			woocommerce_template_loop_add_to_cart();
		} ?>
		<?php if ( siteorigin_setting( 'woocommerce_display_quick_view' ) ) {
			siteorigin_unwind_woocommerce_quick_view_button();
		} ?>
	</div>
<?php }
	}

if ( ! function_exists( 'siteorigin_unwind_woocommerce_quick_view_button' ) ) {
	/**
	 * Quick view button for the products in loop
	 */
	function siteorigin_unwind_woocommerce_quick_view_button() {
		global $product;
		echo '<a href="#" id="product-id-' . $product->get_id() . '" class="button product-quick-view-button" data-product-id="' . $product->get_id() . '">' . esc_html__( 'Quick View', 'siteorigin-unwind' ) . '</a>';
		$gallery = $product->get_gallery_image_ids();

		if ( ! empty( $gallery ) && ! has_action( 'wp_footer', 'siteorigin_unwind_enqueue_flexslider' ) ) {
			add_action( 'wp_footer', 'siteorigin_unwind_enqueue_flexslider' );
		}
	}
}

if ( ! function_exists( 'siteorigin_unwind_woocommerce_quick_view_image' ) ) {
	/**
	 * Displays image in the product quick view.
	 */
	function siteorigin_unwind_woocommerce_quick_view_image() {
		global $product;
		$gallery = $product->get_gallery_image_ids();

		if ( empty( $gallery ) && ! has_post_thumbnail() ) {
			return;
		}

		if ( empty( $gallery ) ) {
			echo woocommerce_get_product_thumbnail( 'shop_single' );
		} else {
			?>
		<div class="product-images-slider flexslider">
			<ul class="slides">
				<?php if ( has_post_thumbnail() ) {
					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_element = get_the_post_thumbnail( $product->get_id(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'title' => $image_title, 'alt' => $image_title ) );
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li class="slide product-featured-image">%s</li>', $image_element ), $product->get_id() );
				} ?>

				<?php if ( $gallery ) {
					foreach ( $gallery as $image ) {
						$image_link = wp_get_attachment_url( $image );
						$image_title = esc_attr( get_the_title( $image ) );
						?>

						<li class="slide product-gallery-image">
							<img src="<?php echo $image_link; ?>" alt="<?php echo $image_title; ?>" title="<?php echo $image_title; ?>" />
						</li>

						<?php
					}
				} ?>

			</ul>
			
			<ul class="flex-direction-nav">
				<li class="flex-nav-prev">
					<a class="flex-prev" href="#"><?php siteorigin_unwind_display_icon( 'left-arrow' ); ?></a>
				</li>
				<li class="flex-nav-next">
					<a class="flex-next" href="#"><?php siteorigin_unwind_display_icon( 'right-arrow' ); ?></a>
				</li>
			</ul>
		</div>
	<?php
		}
	}
}

if ( ! function_exists( 'siteorigin_unwind_woocommerce_quick_view' ) ) {
	/**
	 * Setup quick view modal in the footer.
	 */
	function siteorigin_unwind_woocommerce_quick_view() { ?>
	<?php if ( siteorigin_setting( 'woocommerce_display_quick_view' ) ) { ?>
		<!-- WooCommerce Quick View -->
		<div id="quick-view-container">
			<div id="product-quick-view" class="quick-view"></div>
		</div>
	<?php } ?>
<?php }
	}
add_action( 'wp_footer', 'siteorigin_unwind_woocommerce_quick_view', 100 );

if ( ! function_exists( 'so_product_quick_view_ajax' ) ) {
	/**
	 * Add quick view modal content.
	 */
	function so_product_quick_view_ajax() {
		if ( ! isset( $_REQUEST['product_id'] ) ) {
			die();
		}
		$product_id = intval( $_REQUEST['product_id'] );

		// Set the main WP query for the product.
		wp( 'p=' . $product_id . '&post_type=product' );

		ob_start();
		// Load content template.
		wc_get_template( 'quick-view.php' );
		echo ob_get_clean();

		die();
	}
}
add_action( 'wp_ajax_so_product_quick_view', 'so_product_quick_view_ajax' );
add_action( 'wp_ajax_nopriv_so_product_quick_view', 'so_product_quick_view_ajax' );

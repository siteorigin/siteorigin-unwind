<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @since siteorigin-unwind 0.1
 *
 * @license GPL 2.0
 */
if ( ! function_exists( 'siteorigin_unwind_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function siteorigin_unwind_body_classes( $classes ) {
		// Add a CSS3 animations class.
		$classes[] = 'css3-animations';

		// Add a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Homepage slider.
		if ( is_home() && siteorigin_setting( 'blog_featured_slider' ) && siteorigin_unwind_has_featured_posts() ) {
			$classes[] = 'homepage-has-slider';
		}

		// If we're viewing on a mobile device, add a class.
		if ( wp_is_mobile() ) {
			$classes[] = 'is_mobile';
		}

		// Active header template.
		$classes[] = 'header-design-' . siteorigin_setting( 'masthead_design' );

		// Add a no-js class which we'll remove as required.
		$classes[] = 'no-js';

		// Add the page setting classes.
		$page_settings = siteorigin_page_setting();

		if ( ! empty( $page_settings ) ) {
			if ( ! empty( $page_settings['layout'] ) ) {
				$classes[] = 'page-layout-' . $page_settings['layout'];
			}

			if ( empty( $page_settings['masthead_margin'] ) ) {
				$classes[] = 'page-layout-no-masthead-margin';
			}

			if ( empty( $page_settings['footer_margin'] ) ) {
				$classes[] = 'page-layout-no-footer-margin';
			}

			if ( empty( $page_settings['masthead'] ) ) {
				$classes[] = 'page-layout-hide-masthead';
			}

			if ( empty( $page_settings['footer_widgets'] ) ) {
				$classes[] = 'page-layout-hide-footer-widgets';
			}
		}

		// If the navigation is sticky, add a class.
		if ( siteorigin_setting( 'navigation_sticky' ) ) {
			$classes[] = 'sticky-menu';
		}

		// Sidebar.
		if ( is_active_sidebar( 'main-sidebar' ) && ! ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ) {
			$classes[] = 'sidebar';
		}

		if ( siteorigin_setting( 'layout_main_sidebar' ) == 'left' && ! ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ) {
			$classes[] = 'sidebar-left';
		}

		// WooCommerce sidebar.
		if ( is_active_sidebar( 'shop-sidebar' ) && ( function_exists( 'is_woocommerce' ) && is_woocommerce() && ( siteorigin_page_setting( 'layout' ) == 'default' || siteorigin_page_setting( 'layout' ) == 'full-width-sidebar' ) && ! is_product() ) ) {
			$classes[] = 'woocommerce-sidebar';

			if ( siteorigin_setting( 'woocommerce_shop_sidebar' ) == 'right' ) {
				$classes[] = 'woocommerce-sidebar-right';
			}
		}

		// WooCommerce columns.
		if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || wc_post_content_has_shortcode( 'products' ) ) ) {
			$classes[] = 'wc-columns-' . siteorigin_setting( 'woocommerce_archive_columns' );
		}

		// WooCommerce archive Quick View and Add to Cart.
		if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || wc_post_content_has_shortcode( 'products' ) ) ) {
			if ( siteorigin_setting( 'woocommerce_display_quick_view' ) || siteorigin_setting( 'woocommerce_add_to_cart' ) ) {
				$classes[] = 'unwind-product-overlay';
			}

			if ( siteorigin_setting( 'woocommerce_display_quick_view' ) && ! siteorigin_setting( 'woocommerce_add_to_cart' )
				|| ! siteorigin_setting( 'woocommerce_display_quick_view' ) && siteorigin_setting( 'woocommerce_add_to_cart' ) ) {
				$classes[] = 'unwind-product-overlay-single';
			}
		}

		return $classes;
	}
}
add_filter( 'body_class', 'siteorigin_unwind_body_classes' );

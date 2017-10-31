<?php

// if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

while ( have_posts() ) : the_post();

	global $post, $product;

	if ( ! function_exists( 'siteorigin_unwind_woocommerce_quick_view_class' ) ) :
	/**
	 * Adds the product-quick-view class to the quick view post.
	 */
	function siteorigin_unwind_woocommerce_quick_view_class( $classes ) {
		$classes[] = "product-quick-view";
		return $classes;
	}
	endif;
	add_filter( 'post_class', 'siteorigin_unwind_woocommerce_quick_view_class' );

	?>
	<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="product-content-wrapper">
			<div class="product-image-wrapper">
				<?php do_action( 'siteorigin_unwind_woocommerce_quick_view_images' ); ?>
			</div>

			<div class="product-info-wrapper">

				<a href="<?php the_permalink(); ?>">
					<?php
					do_action( 'siteorigin_unwind_woocommerce_quick_view_title' );
					?>
				</a>

				<?php do_action( 'siteorigin_unwind_woocommerce_quick_view_content' ); ?>

			</div>

			<span class="quickview-close-icon">+</span>

		</div>

	</div>

<?php endwhile;

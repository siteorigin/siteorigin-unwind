<?php
/**
 * Single Product Image
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$gallery = $product->get_gallery_attachment_ids();
?>

<div class="images images-slider">
	<div class="product-images-slider flexslider">
		<ul class="slides">

			<?php if ( has_post_thumbnail() ) {

				$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_element = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'title' => $image_title, 'alt' => $image_title ) );
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li class="slide product-featured-image">%s</li>', $image_element ), $post->ID );

			} ?>

			<?php if ( $gallery ) {

					foreach ( $gallery as $image ) {

						$image_link = wp_get_attachment_url( $image );
						$image_title = esc_attr( get_the_title( $image ) );
						?>

						<li class="slide product-gallery-image">
							<img src="<?php echo $image_link; ?>" alt="<?php echo $image_title ?>" title="<?php echo $image_title ?>" />
						</li>

						<?php

					}

			} ?>

		</ul>
	</div>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>

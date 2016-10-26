<?php
/**
 * Single Product Thumbnails
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;
$gallery = $product->get_gallery_attachment_ids();
$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );

if ( $gallery || $image_link ) { ?>

	<div class="product-images-carousel flexslider">
		<ul class="slides">

			<?php if ( has_post_thumbnail() ) {
				$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_element = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'title' => $image_title, 'alt' => $image_title ) );
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li class="slide product-featured-image">%s</li>', $image_element ), $post->ID );
			} ?>

			<?php foreach ( $gallery as $image ) {

				$image_link = wp_get_attachment_url( $image );
				$image_title = esc_attr( get_the_title( $image ) );

				?>
				<li class="slide product-gallery-thumb">
					<img src="<?php echo $image_link; ?>" title="<?php echo $image_title ?>" />
				</li>
				<?php

			} ?>

		</ul>
	</div>
	<?php
}

<?php

// Get our Featured Content posts
$slider = siteorigin_unwind_get_featured_posts();

// Checking if featured posts exist
if ( empty( $slider ) ) return;

// Looping  through our posts ?>

<div class="flexslider featured-posts-slider">

	<ul class="slides featured-posts-slides">

		<?php foreach ( $slider as $post ) : setup_postdata( $post ); ?>

			<?php if ( has_post_thumbnail() ) :
				$thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );
			endif; ?>

			<li class="featured-post-slide" style="background-image: url( '<?php echo $thumbnail; ?>' );">

				<header class="slide-content">
					<a class="slide-entry-link" href="<?php the_permalink(); ?>"></a>
					<div class="slide-inner">
						<div class="slide-inner-cell">

							<div class="entry-meta">
								<?php siteorigin_unwind_post_meta(); ?>
							</div>

							<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

							<div class="entry-button">
								<a class="entry-button-link" href="<?php esc_url( the_permalink() ); ?>"><?php echo __( 'Continue Reading', 'siteorigin-unwind' ); ?></a>
							</div>

						</div>
					</div>
				</header>

			</li>

		<?php endforeach; ?>

	</ul>

</div>

<?php wp_reset_postdata(); ?>

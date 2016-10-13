<?php

// Get our Featured Content posts
$slider = siteorigin_unwind_get_featured_posts();

// Checking if featured posts exist
if ( empty( $slider ) ) return;

// Looping  through our posts ?>
<div class="flexslider featured-posts-slider">
	<ul class="slides featured-posts-slides">
		<?php foreach ( $slider as $post ) : setup_postdata( $post ); ?>
			<li class="featured-post-slide">
				<?php the_post_thumbnail(); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php wp_reset_postdata(); ?>

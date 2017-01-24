<?php
/*
YARPP Template: SiteOrigin Unwind
*/ ?>
<h2 class="related-posts heading-strike"><?php esc_html_e( 'You may also like', 'siteorigin-unwind' ); ?></h2>
<?php if ( have_posts() ) :?>
	<ol>
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php if ( has_post_thumbnail() ) :?>
						<?php the_post_thumbnail( 'related-post' ); ?>
					<?php endif; ?>
					<h3 class="related-post-title"><?php the_title(); ?></h3>
					<p class="related-post-date"><?php the_time( apply_filters( 'siteorigin_unwind_date_format', 'M d, Y' ) ); ?></p>
				</a>
			</li>
		<?php endwhile; ?>
	</ol>
<?php else: ?>
	<p><?php esc_html_e( 'No related posts.', 'siteorigin-unwind' ); ?></p>
<?php endif; ?>

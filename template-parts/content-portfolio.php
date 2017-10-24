<?php
/**
 * Template part for displaying portfolio projects in portfolio loop.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.1.5
 * @license GPL 2.0
 */

// Get Jetpack Portfolio taxonomy terms for portfolio filtering.
$terms = get_the_terms( $post->ID, 'jetpack-portfolio-type' );

if ( $terms && ! is_wp_error( $terms ) ) :

	$filtering_links = array();

	foreach ( $terms as $term ) {
		$filtering_links[] = $term->slug;
	}

	$filtering = join( ", ", $filtering_links );

	$types = join( " ", $filtering_links );

	$classes = $types . ' archive-project';

endif; ?>

<article id="post-<?php the_ID(); ?> <?php echo $types; ?>" <?php post_class( $classes ); ?>>

	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<div class="entry-overlay"></div>
			<div class="entry-content">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				<div class="entry-divider"></div>
				<p class="entry-project-type"><?php echo $filtering; ?></p>					
			</div>		
			<?php the_post_thumbnail( 'siteorigin-unwind-500x500-crop' ); ?>
		</a>
	</div><!-- .entry-thumbnail -->

</article><!-- #post-## -->

<?php
/**
 * Template part for displaying blog posts with the portfolio template.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.2
 * @license GPL 2.0
 */

// Get blog categories for post filtering.
$terms = get_the_terms( $post->ID, 'category' );

if ( ! is_wp_error( $terms ) ) :

	$filtering_links = array();

	if ( $terms ) {
		foreach ( $terms as $term ) {
			$filtering_links[] = $term->slug;
		}
	}

	$filtering = join( ", ", $filtering_links );
	$types = $filtering ? join( " ", $filtering_links ) : ' ';

	$classes = 'archive-post-postfolio ' . $types;

endif; ?>

<article id="post-<?php the_ID(); ?> <?php echo $types; ?>" <?php post_class( $classes ); ?>>

	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<div class="entry-overlay"></div>
			<div class="entry-content">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				<div class="entry-divider"></div>
				<span class="entry-post-category"><?php echo $filtering; ?></span>
			</div>
			<?php the_post_thumbnail( 'siteorigin-unwind-500x500-crop' ); ?>
		</a>
	</div><!-- .entry-thumbnail -->

</article><!-- #post-## -->

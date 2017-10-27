<?php
/**
 * Loop Name: Portfolio
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.2
 * @license GPL 2.0
 */

?>

<?php if ( post_type_exists( 'jetpack-portfolio' ) && ! ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) ) : ?>
	<?php wp_enqueue_script( 'jquery-isotope' ); ?>
	<div class="portfolio-filter-terms">
		<button data-filter="*" class="active"><?php echo esc_html__( 'All', 'siteorigin-unwind' ); ?></button>
		<?php
		$taxonomy = 'jetpack-portfolio-type';
		$tax_terms = get_terms( $taxonomy );
		foreach ( $tax_terms as $tax_term ) { ?>
			<button data-filter=".<?php echo $tax_term->slug; ?>"><?php echo $tax_term->slug; ?></button>
		<?php }
		?>
	</div>
<?php endif; ?>

<div class="portfolio-loop" id="portfolio-loop">
	<?php

	$args = array(
		'post_type' => 'jetpack-portfolio',
		'paged'     => $paged,
	);

	$portfolio_query = new WP_Query( $args );

	if ( post_type_exists( 'jetpack-portfolio' ) && $portfolio_query -> have_posts() ) : ?>

		<div id="projects-container">

			<?php
			while ( $portfolio_query -> have_posts() ) : $portfolio_query -> the_post();

				get_template_part( 'template-parts/content', 'portfolio' );

			endwhile; ?>

		</div>

		<?php siteorigin_unwind_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>
</div><!-- .portfolio-loop -->

<?php
/**
 * Loop Name: Portfolio
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.1.5
 * @license GPL 2.0
 */

wp_enqueue_script( 'jquery-isotope' );
?>

<?php if ( post_type_exists( 'jetpack-portfolio' ) ) : ?>
	<div class="portfolio-filter-terms">
		<button data-filter="*" class="active"><?php echo __( 'All', 'siteorigin-unwind' ); ?></button>
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

	$portfolio_query = new WP_Query ( $args );

	if ( post_type_exists( 'jetpack-portfolio' ) && $portfolio_query -> have_posts() ) : ?>

		<div id="projects-container">

			<?php
			while ( $portfolio_query -> have_posts() ) : $portfolio_query -> the_post();

				get_template_part( 'template-parts/content', 'portfolio' );

			endwhile; ?>

		</div>

		<?php siteorigin_unwind_portfolio_load_more( $portfolio_query );

		wp_reset_postdata();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>
</div>

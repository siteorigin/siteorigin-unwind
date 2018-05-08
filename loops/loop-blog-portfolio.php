<?php
/**
 * Loop Name: Blog with Portfolio template
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.1
 * @license GPL 2.0
 */

?>

<?php if ( have_posts() && get_query_var('post_type', '') == 'post' ) : ?>
	<?php wp_enqueue_script( 'jquery-isotope' ); ?>
	<div class="blog-filter-terms">
		<button data-filter="*" class="active"><?php echo esc_html__( 'All', 'siteorigin-unwind' ); ?></button>
		<?php
		$tax_terms = get_terms( 'category' );
		foreach ( $tax_terms as $tax_term ) { ?>
			<button data-filter=".<?php echo $tax_term->slug; ?>"><?php echo $tax_term->slug; ?></button>
		<?php }
		?>
	</div>
<?php endif; ?>

<div class="blog-portfolio-loop" id="blog-portfolio-loop">

	<?php if ( have_posts() ) : ?>

		<div id="posts-posrtfolio-container">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'blog-portfolio' );

			endwhile; ?>

		</div>

		<?php siteorigin_unwind_posts_navigation(); ?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

</div><!-- .portfolio-loop -->
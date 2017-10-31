<?php
/**
 * Loop Name: Blog Grid
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.1  
 * @license GPL 2.0
 */

?>

<?php
if ( have_posts() ) :

	if ( is_home() && ! is_front_page() ) : ?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>

	<?php
	endif; ?>

	<div class="blog-layout-grid">
		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'grid' );

		endwhile;
		?>
	</div><?php	

	siteorigin_unwind_posts_navigation();

else :

	get_template_part( 'template-parts/content', 'none' );

endif; ?>

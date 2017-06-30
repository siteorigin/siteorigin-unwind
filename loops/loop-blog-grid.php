<?php
/**
 * Loop Name: Blog Masonry
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.9
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
	endif;

	/* Start the Loop */
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'grid' );

	endwhile;

	siteorigin_unwind_posts_navigation();

else :

	get_template_part( 'template-parts/content', 'none' );

endif; ?>

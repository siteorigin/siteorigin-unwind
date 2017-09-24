<?php
/**
 * The template for displaying portfolio archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

get_header(); ?>

	<?php siteorigin_unwind_archive_title(); ?>

	<?php siteorigin_unwind_breadcrumbs(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) : ?>

				<div class="load-more-wrapper">
					<div class="load-more-container">

						<?php while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'portfolio' );

						endwhile; ?>

					</div>
				</div>

				<?php siteorigin_unwind_posts_navigation();

				else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

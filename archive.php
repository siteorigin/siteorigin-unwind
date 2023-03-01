<?php
/**
 * The template for displaying archive pages.
 *
 * @see https://codex.wordpress.org/Template_Hierarchy
 * @since siteorigin-unwind 0.1
 *
 * @license GPL 2.0
 */
get_header(); ?>

	<?php siteorigin_unwind_archive_title(); ?>

	<?php siteorigin_unwind_breadcrumbs(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">

			<?php
			if ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
				if ( have_posts() ) { ?>

					<div class="portfolio-archive-layout">
						<?php
						/* Start the Loop */
						while ( have_posts() ) {
							the_post();

							get_template_part( 'template-parts/content', 'portfolio' );
						}
					?>
					</div><?php

					siteorigin_unwind_posts_navigation();
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
			} else {
				get_template_part( 'loops/loop', 'blog-' . siteorigin_setting( 'blog_archive_layout' ) );
			}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

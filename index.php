<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @see https://codex.wordpress.org/Template_Hierarchy
 * @since siteorigin-unwind 0.1
 *
 * @license GPL 2.0
 */
get_header(); ?>

	<?php if ( siteorigin_setting( 'blog_featured_slider' ) && siteorigin_unwind_has_featured_posts() ) { ?>

		<?php get_template_part( 'template-parts/featured', 'slider' ); ?>

	<?php } ?>

	<?php siteorigin_unwind_breadcrumbs(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">

			<?php get_template_part( 'loops/loop', 'blog-' . siteorigin_setting( 'blog_archive_layout' ) ); ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

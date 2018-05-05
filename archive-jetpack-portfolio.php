<?php
/**
 * The template for displaying Jetpack Portfolio archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.2.15
 * @license GPL 2.0
 */

get_header(); ?>

	<?php siteorigin_unwind_archive_title(); ?>

	<?php siteorigin_unwind_breadcrumbs(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">

			<?php get_template_part( 'loops/loop', 'portfolio' ); ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

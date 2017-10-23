<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

get_header(); ?>

	<?php if ( siteorigin_page_setting( 'page_title' ) ) : ?>
		<header class="page-header">
			<h1 class="page-title"><span class="page-title-text"><?php printf( esc_html__( 'Search Results: %s', 'siteorigin-unwind' ), get_search_query() ); ?></span></h1>
		</header><!-- .page-header -->
	<?php endif; ?>

	<?php siteorigin_unwind_breadcrumbs(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'search' );
				endwhile;
				siteorigin_unwind_posts_navigation();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif; ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

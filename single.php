<?php
/**
 * The template for displaying all single posts.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @since siteorigin-unwind 0.1
 *
 * @license GPL 2.0
 */
get_header(); ?>

	<?php siteorigin_unwind_breadcrumbs(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) {
			the_post();

			if ( has_post_format( array( 'gallery', 'video', 'image' ) ) ) {
				get_template_part( 'template-parts/content', get_post_format() );
			} else {
				get_template_part( 'template-parts/content', 'single' );
			}

			if ( class_exists( 'Jetpack_Likes' ) ) {
				$custom_likes = new Jetpack_Likes();
				echo $custom_likes->post_likes( '' );
			}

			if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'sharedaddy'  ) && function_exists( 'sharing_display' ) ) { ?>
				<h2 class="share-this heading-strike"><?php esc_html_e( 'Share This', 'siteorigin-unwind' ); ?></h2>
				<?php echo sharing_display();
			}

			if ( siteorigin_setting( 'navigation_post' ) ) {
				siteorigin_unwind_the_post_navigation();
			}

			if ( siteorigin_setting( 'blog_display_author_box' ) ) {
				siteorigin_unwind_author_box();
			}

			if ( ! is_attachment() && siteorigin_setting( 'blog_display_related_posts' ) ) {
				siteorigin_unwind_related_posts( $post->ID );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

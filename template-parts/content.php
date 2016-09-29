<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package siteorigin-unwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-entry' ); ?>>
	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php siteorigin_unwind_post_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php if( has_post_thumbnail() && siteorigin_setting('blog_featured_archive') ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail() ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				__( '<span class="more-text">Continue reading<span><span class="screen-reader-text"> "%s"</span>', 'siteorigin-unwind' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'siteorigin-unwind' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

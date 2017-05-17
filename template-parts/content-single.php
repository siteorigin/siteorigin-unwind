<?php
/**
 * Template part for displaying single posts.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<header class="entry-header">
		<div class="entry-meta">
			<?php siteorigin_unwind_post_meta(); ?>
		</div><!-- .entry-meta -->
		<?php if ( siteorigin_page_setting( 'page_title' ) ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() && siteorigin_setting( 'blog_featured_single' ) ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter' ) ) ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'siteorigin-unwind' ) . '</span>',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php siteorigin_unwind_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

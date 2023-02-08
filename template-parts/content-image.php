<?php
/**
 * Template part for displaying image format posts.
 *
 * @since siteorigin-unwind 0.1
 *
 * @license GPL 2.0
 */
$post_class = ( is_singular() ) ? 'entry' : 'archive-entry';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>

	<header class="entry-header">
		<div class="entry-meta">
			<?php siteorigin_unwind_post_meta(); ?>
		</div><!-- .entry-meta -->
		<?php if ( is_singular() ) { ?>
			<?php if ( siteorigin_page_setting( 'page_title' ) ) { ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php } ?>
		<?php } else { ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php } ?>
	</header><!-- .entry-header -->

	<?php if ( siteorigin_unwind_get_image() ) { ?>
		<div class="entry-image">
			<?php echo siteorigin_unwind_get_image(); ?>
		</div>
	<?php } elseif ( has_post_thumbnail() && siteorigin_setting( 'blog_featured_single' ) ) { ?>
		<div class="entry-thumbnail">
			<?php if ( is_singular() ) { ?>
				<?php the_post_thumbnail(); ?>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			<?php } ?>
		</div>
	<?php } ?>

	<div class="entry-content">
		<?php if ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' && $post_class !== 'entry' ) {
			siteorigin_unwind_excerpt();
		} else {
			echo apply_filters( 'the_content', siteorigin_unwind_strip_image( get_the_content() ) );
		} // Display the content without first image?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'siteorigin-unwind' ) . '</span>',
			'after'  => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( is_singular() ) { ?>
		<footer class="entry-footer">
			<?php siteorigin_unwind_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php } ?>
</article><!-- #post-## -->

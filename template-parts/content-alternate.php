<?php
/**
 * Template part for displaying alternate posts
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.1 
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-entry' ); ?>>

	<div class="entry-thumbnail">
		<?php if ( has_post_thumbnail() && siteorigin_setting( 'blog_featured_archive' ) ) : ?>
			<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter' ) ); ?>
			</a>
		<?php endif; ?>

		<div class="entry-cats">
			<?php the_category( ' ' ); ?>
		</div>
	</div>

	<div class="entry-content">

		<header class="entry-header">
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php siteorigin_unwind_post_meta( false ); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<?php
			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'siteorigin-unwind' ) . '</span>',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
		<p><a href="<?php the_permalink() ?>"><?php echo esc_html__( 'Continue Reading', 'siteorigin-unwind' ) ?> &rarr;</a></p>
	</div><!-- .entry-content -->

</article>

<?php
/**
 * Template part for displaying alternate posts.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.1
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-entry' ); ?>>

	<?php if ( siteorigin_setting( 'blog_featured_archive' ) && siteorigin_unwind_archive_post_media() ) : ?>
		<div class="entry-thumbnail">
			<?php if ( get_post_format() == 'gallery' && siteorigin_unwind_get_gallery() ) : ?>
				<?php $gallery = siteorigin_unwind_get_gallery(); ?>
				<div class="flexslider gallery-format-slider">
					<ul class="slides gallery-format-slides">
						<?php foreach ( $gallery['src'] as $image ) : ?>
							<li class="gallery-format-slide">
								<img src="<?php echo $image; ?>">
							</li>
						<?php endforeach; ?>
					<ul>
				</div>
			<?php elseif ( get_post_format() == 'image' && siteorigin_unwind_get_image() ) : ?>
				<div class="entry-image">
					<?php echo siteorigin_unwind_get_image(); ?>
				</div>
			<?php elseif ( get_post_format() == 'video' && siteorigin_unwind_get_video() ) : ?>
				<div class="entry-video">
					<?php echo siteorigin_unwind_get_video(); ?>
				</div>
			<?php elseif ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail( 'siteorigin-unwind-360x238-crop', array( 'class' => 'aligncenter' ) ); ?>
				</a>
			<?php endif; ?>

			<?php siteorigin_unwind_thumbnail_meta(); ?>
		</div>
	<?php endif; ?>

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
	</div><!-- .entry-content -->

</article>

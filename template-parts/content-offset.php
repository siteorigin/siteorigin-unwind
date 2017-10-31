<?php
/**
 * Template part for displaying offset posts.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.1.1
 * @license GPL 2.0
 */

$num_comments = get_comments_number();
if ( comments_open() ) {
	if ( $num_comments == 0 ) {
		$comments = esc_html__( 'Post a Comment', 'siteorigin-unwind' );
	} elseif ( $num_comments > 1 ) {
		$comments = $num_comments . esc_html__( ' Comments', 'siteorigin-unwind' );
	} else {
		$comments = esc_html__( '1 Comment', 'siteorigin-unwind' );
	}
} else {
	$comments = NULL;
}

$gallery = get_post_gallery( get_the_ID(), false );
if ( ! empty( $gallery ) && ! has_action( 'wp_footer', 'siteorigin_unwind_enqueue_flexslider' ) ) {
	add_action( 'wp_footer', 'siteorigin_unwind_enqueue_flexslider' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-entry' ); ?>>

	<div class="entry-header">

		<div class="entry-meta">
			<?php siteorigin_unwind_post_meta(); ?>
		</div><!-- .entry-meta -->

		<?php if ( siteorigin_setting( 'blog_display_date' ) ) : ?>
			<p class="entry-time">
				<span class="meta-text"><?php esc_html_e( 'Posted on ', 'siteorigin-unwind' ); ?></span>
				<?php the_time( apply_filters( 'siteorigin_unwind_date_format', 'M d, Y' ) ); ?>
			</p>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</div>

	<div class="entry-offset">

		<div class="entry-author-avatar">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
			</a>
		</div>

		<div class="entry-author-link">
			<span class="meta-text"><?php esc_html_e( 'Written by', 'siteorigin-unwind' ); ?></span>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_the_author(); ?>
			</a>
		</div>

		<?php if ( siteorigin_setting( 'blog_display_category' ) ) : ?>
			<div class="entry-categories">
				<span class="meta-text"><?php esc_html_e( 'Posted in', 'siteorigin-unwind' ); ?></span>
				<?php the_category( ', ', '', '' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $comments && siteorigin_setting( 'blog_display_comments' ) ) : ?>
			<div class="entry-comments">
				<span class="meta-text"><?php esc_html_e( 'Comments', 'siteorigin-unwind' ); ?></span>
				<a href="<?php get_comments_link(); ?>"><?php echo $comments; ?></a>
			</div>
		<?php endif; ?>

	</div>

	<div class="entry-content">

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
					<a href="<?php the_permalink() ?>">
						<?php echo siteorigin_unwind_get_image(); ?>
					</a>
				</div>
			<?php elseif ( get_post_format() == 'video' && siteorigin_unwind_get_video() ) : ?>
				<div class="entry-video">
					<?php echo siteorigin_unwind_get_video(); ?>
				</div>
			<?php elseif ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter' ) ); ?>
				</a>
			<?php endif; ?>
		</div>

		<?php
			if ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' ) the_excerpt();
			else the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'siteorigin-unwind' ) . '</span>',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>

	</div><!-- .entry-content -->

</article>

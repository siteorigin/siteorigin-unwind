<?php
/**
 * Template part for displaying left info posts
 *
 * @package siteorigin-unwind
 * @license GPL 2.0
 */

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

		<p class="entry-time">
			<?php _e( 'Posted on ', 'siteorigin-unwind' ); ?>
			<?php the_time( apply_filters( 'siteorigin_unwind_date_format', 'M d, Y' ) ); ?>
		</p>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</div>

	<div class="entry-left-info">

		<div class="entry-author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
		</div>

		<div class="entry-author-link">
			<span class="meta-text"><?php _e( 'Written by', 'siteorigin-unwind' ); ?></span><br />
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_the_author(); ?>
			</a>
		</div>

		<div class="entry-categories">
			<span class="meta-text"><?php _e( 'Posted in', 'siteorigin-unwind' ); ?></span><br />
			<?php the_category( ', ', '', '' ); ?>
		</div>

		<?php if ( $comments ) : ?>
			<div class="entry-comments">
				<span class="meta-text"><?php _e( 'Comments', 'siteorigin-unwind' ); ?></span><br />
				<a href="<?php get_comments_link(); ?>"><?php echo $comments; ?></a>
			</div>
		<?php endif; ?>

	</div>

	<div class="entry-content">

		<div class="entry-thumbnail">
			<?php if ( get_post_format() == 'gallery' && $gallery != '' ) : ?>
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
					<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter' ) ); ?>
				</a>
			<?php endif; ?>

			<div class="entry-cats">
				<?php the_category( ' ' ); ?>
			</div>
		</div>

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

<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

if ( ! function_exists( 'siteorigin_unwind_display_icon' ) ) :
/**
 * Displays SVG icons.
 */
function siteorigin_unwind_display_icon( $type ){
	switch( $type ) {
		case 'search' : ?>
			<svg version="1.1" class="svg-icon-search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
				<path d="M20.943 4.619c-4.5-4.5-11.822-4.5-16.321 0-4.498 4.5-4.498 11.822 0 16.319 4.007 4.006 10.247 4.435 14.743 1.308 0.095 0.447 0.312 0.875 0.659 1.222l6.553 6.55c0.953 0.955 2.496 0.955 3.447 0 0.953-0.951 0.953-2.495 0-3.447l-6.553-6.551c-0.347-0.349-0.774-0.565-1.222-0.658 3.13-4.495 2.7-10.734-1.307-14.743zM18.874 18.871c-3.359 3.357-8.825 3.357-12.183 0-3.357-3.359-3.357-8.825 0-12.184 3.358-3.359 8.825-3.359 12.183 0s3.359 8.825 0 12.184z"></path>
			</svg>
		<?php break;
	}
}
endif;

if ( ! function_exists( 'siteorigin_unwind_display_logo' ) ):
/**
 * Display the logo or site title.
 */
function siteorigin_unwind_display_logo() {
	$logo = siteorigin_setting( 'branding_logo' );
	if ( ! empty( $logo ) ) {
		$attrs = apply_filters( 'siteorigin_unwind_logo_attributes', array() );

		?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="screen-reader-text"><?php esc_html_e( 'Home', 'siteorigin-unwind' ); ?></span><?php
			echo wp_get_attachment_image( $logo, 'full', false, $attrs );
		?></a><?php

	} elseif ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		?><?php the_custom_logo(); ?><?php
	}
	else {
		if ( is_front_page() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif;
	}
}
endif;

if ( ! function_exists( 'siteorigin_unwind_archive_title' ) ) :
/**
 * Display titles in archive pages.
 */
function siteorigin_unwind_archive_title() {
	?>
	<header class="page-header">
		<?php
			the_archive_title( '<h1 class="page-title"><span class="page-title-text">', '</span></h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- .page-header -->
	<?php
}
endif;

if ( ! function_exists( 'siteorigin_unwind_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 */
function siteorigin_unwind_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'siteorigin-unwind' ); ?></h3>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-next"><?php next_posts_link( esc_html__( 'Older posts', 'siteorigin-unwind' ) . '<span>&rarr;</span>' ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-previous"><?php previous_posts_link( '<span>&larr;</span>' . esc_html__( 'Newer posts', 'siteorigin-unwind' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'siteorigin_unwind_post_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, category and comment count.
 */
function siteorigin_unwind_post_meta() {

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ', ', 'siteorigin-unwind' ) );
	// get_comments_number returns only a numeric value
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
	} ?>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'siteorigin-unwind' ) . '</span>';
	} ?>

	<span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>

	<?php if ( $categories_list && siteorigin_unwind_categorized_blog() ) {
		printf( '<span class="entry-category">' . esc_html__( '%1$s', 'siteorigin-unwind' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	} ?>

	<?php if ( $comments ) {
		echo '<span class="entry-comments"><a href="' . get_comments_link() .'">'. $comments.'</a></span>';
	} ?>

<?php }
endif;

if ( ! function_exists( 'siteorigin_unwind_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function siteorigin_unwind_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) { ?>
		<span class="tags-list"><?php the_tags('', '', ''); ?></span>
	<?php }

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'siteorigin-unwind' ), esc_html__( '1 Comment', 'siteorigin-unwind' ), esc_html__( '% Comments', 'siteorigin-unwind' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'siteorigin_unwind_author_box' ) ) :
/**
 * Displays the author box in single posts.
 */
function siteorigin_unwind_author_box() { ?>
	<div class="author-box">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
		</div>
		<div class="author-description">
			<span class="post-author-title">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php echo get_the_author(); ?>
				</a>
			</span>
			<div><?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?></div>
		</div>
	</div>
<?php }
endif;

if ( ! function_exists( 'siteorigin_unwind_related_posts' ) ) :
/**
 * Displays the author box in single posts
 */
function siteorigin_unwind_related_posts( $post_id ) {
	if ( function_exists( 'related_posts' ) ) { // Check for YRAPP plugin
		related_posts();
	} else { // The fallback loop
		$categories = get_the_category( $post_id );
		$first_cat = $categories[0]->cat_ID;
		$args=array(
			'category__in' => array( $first_cat ),
			'post__not_in' => array( $post_id ),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => -1
		);
		$related_posts = new WP_Query( $args ); ?>

		<div class="related-posts-section">
			<h2 class="related-posts heading-strike"><?php esc_html_e( 'You may also like', 'siteorigin-unwind' ); ?></h2>
			<?php if ( $related_posts ) : ?>
				<ol>
					<?php if ( $related_posts->have_posts() ) : ?>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php if ( has_post_thumbnail() ) :?>
										<?php the_post_thumbnail( 'related-post' ); ?>
									<?php endif; ?>
									<h3 class="related-post-title"><?php the_title(); ?></h3>
									<p class="related-post-date"><?php the_time( 'M d, Y' ); ?></p>
								</a>
							</li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ol>
			<?php else : ?>
				<p><?php esc_html_e( 'No related posts.', 'siteorigin-unwind' ); ?></p>
			<?php endif; ?>
		</div>
		<?php wp_reset_query();
	}
}
endif;

if ( ! function_exists( 'siteorigin_unwind_the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function siteorigin_unwind_the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'siteorigin-unwind' ); ?></h2>
		<div class="nav-links">
			<div class="nav-previous">
				<?php previous_post_link ( '%link', '<span class="sub-title"><span>&larr;</span> ' . __( 'Previous Post', 'siteorigin-unwind' ) . '</span> <div>%title</div>' ); ?>
			</div>
			<div class="nav-next">
				<?php next_post_link( '%link', '<span class="sub-title">' . __( 'Next Post', 'siteorigin-unwind' ) . ' <span>&rarr;</span></span> <div>%title</div>' ); ?>
			</div>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function siteorigin_unwind_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'siteorigin_unwind_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'siteorigin_unwind_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so siteorigin_unwind_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so siteorigin_unwind_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'siteorigin_unwind_tag_cloud' ) ) :
/**
 * Filter the Tag Cloud widget.
 */
function siteorigin_unwind_tag_cloud( $args ) {

	$args['unit'] = 'em';
	$args['largest'] = 0.9285;
	$args['smallest'] = 0.9285;
	return $args;
}
endif;
add_filter( 'widget_tag_cloud_args', 'siteorigin_unwind_tag_cloud' );

/**
 * Flush out the transients used in siteorigin_unwind_categorized_blog.
 */
function siteorigin_unwind_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'siteorigin_unwind_categories' );
}
add_action( 'edit_category', 'siteorigin_unwind_category_transient_flusher' );
add_action( 'save_post',     'siteorigin_unwind_category_transient_flusher' );

/**
 * Insert footer text from theme settings.
 */
if ( ! function_exists( 'siteorigin_unwind_footer_text' ) ) :
function siteorigin_unwind_footer_text() {
	$text = siteorigin_setting( 'footer_text' );
	$text = str_replace(
		array( '{sitename}', '{year}' ),
		array( get_bloginfo( 'sitename' ), date( 'Y' ) ),
		$text
	);
	echo wp_kses_post( $text );
}
endif;

if ( ! function_exists( 'siteorigin_unwind_comment' ) ) :
function siteorigin_unwind_comment( $comment, $args, $depth ) {
	?>
	<li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<?php $type = get_comment_type($comment->comment_ID); ?>
		<div class="comment-box">
			<?php if($type == 'comment') : ?>
				<div class="avatar-container">
					<?php echo get_avatar(get_comment_author_email(), 80) ?>
				</div>
			<?php endif; ?>

			<div class="comment-container">
				<div class="info">
					<span class="author"><?php comment_author_link() ?></span><br>
					<span class="date"><?php comment_date() ?></span>
				</div>

				<div class="comment-content content">
					<?php comment_text() ?>
				</div>

				<?php if($depth <= $args['max_depth']) : ?>
					<?php comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])) ?>
				<?php endif; ?>
			</div>
		</div>
	<?php
}
endif;

function siteorigin_unwind_get_featured_posts() {
	return apply_filters( 'siteorigin_unwind_get_featured_posts', array() );
}

function siteorigin_unwind_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() )
		return false;

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'siteorigin_unwind_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) )
		return false;

	if ( $minimum > count( $featured_posts ) )
		return false;

	return true;
}

<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package siteorigin_unwind
 */

if( !function_exists('siteorigin_unwind_display_logo') ):
/**
 * Display the logo or site title
 */
function siteorigin_unwind_display_logo(){
	$logo = siteorigin_setting( 'branding_logo' );
	if( !empty($logo) ) {
		$logo_id = attachment_url_to_postid( $logo );
		$attrs = apply_filters( 'siteorigin_unwind_logo_attributes', array() );

		?><center><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php
		echo wp_get_attachment_image( $logo_id, 'full', false, $attrs );
		?></a></center><?php

	}
	else {
		?><h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1><?php
	}
}
endif;

if( !function_exists('siteorigin_unwind_display_retina_logo') ):
/**
 * Display a retina ready logo
 */
function siteorigin_unwind_display_retina_logo( $attr ){
	$logo = siteorigin_setting( 'branding_logo' );
	$retina = siteorigin_setting( 'branding_retina_logo' );
	if( !empty($retina) ) {
		$attr['srcset'] = $logo . ' 1x,' . $retina . ' 2x';
		return $attr;
	}
}
add_filter( 'siteorigin_unwind_logo_attributes', 'siteorigin_unwind_display_retina_logo', 10, 1 );
endif;

if ( ! function_exists( 'siteorigin_unwind_archive_title' ) ) :
/**
 * Display titles in archive pages
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
			<div class="nav-next"><?php next_posts_link( esc_html__( 'Older posts', 'siteorigin-unwind' ) . ' &rarr;' ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-previous"><?php previous_posts_link( '&larr; ' . esc_html__( 'Newer posts', 'siteorigin-unwind' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'siteorigin_unwind_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function siteorigin_unwind_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'siteorigin-unwind' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'siteorigin-unwind' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'siteorigin_unwind_post_meta' ) ):
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
			$comments = esc_html__('Comments');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . esc_html__(' Comments');
		} else {
			$comments = esc_html__('1 Comment');
		}
	} else {
		$comments = NULL;
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

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'siteorigin-unwind' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'</br><span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'siteorigin_unwind_author_box' ) ) :
/**
 * Displays the author box in single posts
 */
function siteorigin_unwind_author_box() { ?>
	<div class="author-box">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
		</div>
		<div class="author-description">
			<span class="post-author-title">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php echo get_the_author(); ?>
				</a>
			</span><br />
			<?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?>
		</div>
	</div>
<?php }
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
				<?php previous_post_link ( '%link', '<span class="sub-title">&larr; ' . __( 'Previous Post', 'siteorigin-unwind' ) . '</span><br />%title' ); ?>
			</div>
			<div class="nav-next">
				<?php next_post_link( '%link', '<span class="sub-title">' . __( 'Next Post', 'siteorigin-unwind' ) . ' &rarr;</span><br />%title' ); ?>
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
 * Insert footer text from theme settings
 */
if( !function_exists('siteorigin_unwind_footer_text') ) :
function siteorigin_unwind_footer_text(){
	$text = siteorigin_setting('footer_text');
	$text = str_replace(
		array( '{sitename}', '{year}'),
		array( get_bloginfo('sitename'), date('Y') ),
		$text
	);
	echo wp_kses_post( $text );
}
endif;

if( !function_exists('siteorigin_unwind_comment') ) :
function siteorigin_unwind_comment( $comment, $args, $depth ){
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

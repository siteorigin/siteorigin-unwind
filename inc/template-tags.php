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

if ( ! function_exists( 'siteorigin_unwind_archive_title' ) ) :
/**
 * Display titles in archive pages.
 */
function siteorigin_unwind_archive_title() {
	if ( siteorigin_page_setting( 'page_title' ) ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title"><span class="page-title-text">', '</span></h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif;
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
			<div><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></div>
		</div>
	</div>
<?php }
endif;

if ( ! function_exists( 'siteorigin_unwind_breadcrumbs' ) ) :
/**
 * Display's breadcrumbs supported by Yoast SEO & Breadcrumb NavXT.
 */
function siteorigin_unwind_breadcrumbs() {
	if ( function_exists( 'bcn_display' ) ) {
		?><div class="breadcrumbs bcn">
			<?php bcn_display(); ?>
		</div><?php
	} elseif( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
	}
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

if ( ! function_exists( 'siteorigin_unwind_comment' ) ) :
function siteorigin_unwind_comment( $comment, $args, $depth ) {
	?>
	<li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<?php $type = get_comment_type( $comment->comment_ID ); ?>
		<div class="comment-box">
			<?php if ( $type == 'comment' ) : ?>
				<div class="avatar-container">
					<?php echo get_avatar( get_comment_author_email(), 70 ) ?>
				</div>
			<?php endif; ?>

			<div class="comment-container">
				<div class="info">
					<span class="author"><?php comment_author_link(); ?></span><br>
					<span class="date"><?php comment_date(); ?></span>
				</div>

				<div class="comment-content content">
					<?php if ( ! $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation">
							<?php esc_html_e( 'Your comment is awaiting moderation.', 'siteorigin-unwind' ); ?>
						</p>
					<?php endif; ?>
					<?php comment_text() ?>
				</div>

				<?php if ( $depth <= $args['max_depth'] ) : ?>
					<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ?>
				<?php endif; ?>
			</div>
		</div>
	<?php
}
endif;

if ( ! function_exists( 'siteorigin_unwind_display_logo' ) ) :
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

/**
 * Display a retina ready logo.
 */
function siteorigin_unwind_display_retina_logo( $attr ){
	$logo = siteorigin_setting( 'branding_logo' );
	$retina = siteorigin_setting( 'branding_retina_logo' );

	if( !empty( $retina ) ) {

		$srcset = array();

		$logo_src = wp_get_attachment_image_src( $logo, 'full' );
		$retina_src = wp_get_attachment_image_src( $retina, 'full' );

		if( !empty( $logo_src ) ) {
			$srcset[] = $logo_src[0] . ' 1x';
		}

		if( !empty( $logo_src ) ) {
			$srcset[] = $retina_src[0] . ' 2x';
		}

		if( ! empty( $srcset ) ) {
			$attr['srcset'] = implode( ',', $srcset );
		}
	}

	return $attr;
}
add_filter( 'siteorigin_unwind_logo_attributes', 'siteorigin_unwind_display_retina_logo', 10, 1 );

if ( ! function_exists( 'siteorigin_unwind_main_navigation' ) ) :
/**
 * Display the main menu.
 */
function siteorigin_unwind_main_navigation() {
	?>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button id="mobile-menu-button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php siteorigin_unwind_display_icon( 'menu' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		<?php if ( class_exists( 'Woocommerce' ) && ! ( is_cart() || is_checkout() ) && siteorigin_setting( 'woocommerce_display_mini_cart' ) ) : ?>
			<?php global $woocommerce; ?>
			<ul class="shopping-cart">
				<li>
					<a class="shopping-cart-link" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
						<span class="screen-reader-text"><?php esc_html_e( 'View shopping cart', 'siteorigin-unwind' ); ?></span>
						<?php siteorigin_unwind_display_icon( 'cart' ); ?>
						<span class="shopping-cart-text"><?php esc_html_e( ' View Cart ', 'siteorigin-unwind' ); ?></span>
						<span class="shopping-cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
					</a>
					<ul class="shopping-cart-dropdown" id="cart-drop">
						<?php the_widget( 'WC_Widget_Cart' );?>
					</ul>
				</li>
			</ul>
		<?php endif; ?>
	</nav><!-- #site-navigation -->
	<div id="mobile-navigation"></div>
	<?php
}
endif;

if ( ! function_exists( 'siteorigin_unwind_entry_footer' ) ) :
/**
 * Prints HTML with meta information for tags.
 */
function siteorigin_unwind_entry_footer( $post_id = '' ) {
	if ( 'post' === get_post_type() && siteorigin_setting( 'blog_display_tags' ) ) { ?>
		<span class="tags-list"><?php the_tags( '', '', '' ); ?></span>
	<?php }
	$portfolio_terms = get_the_term_list( $post_id, 'jetpack-portfolio-tag', '', '', '' );
	if ( 'jetpack-portfolio' == get_post_type() && $portfolio_terms ) {
		printf( '<span class="tags-list">' . '%1$s' . '</span>', $portfolio_terms );
	}
}
endif;

/**
 * Featured posts slider.
 */
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

if ( ! function_exists( 'siteorigin_unwind_footer_text' ) ) :
/**
 * Insert footer text from theme settings.
 */
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

if ( ! function_exists( 'siteorigin_unwind_read_more_link' ) ) :
/**
 * Filter the read more link.
 */
function siteorigin_unwind_read_more_link() {
	$read_more_text = esc_html__( 'Continue reading', 'siteorigin-unwind' );
		return '<div class="more-link-wrapper"><a class="more-link" href="' . get_permalink() . '"><span class="more-text">' . $read_more_text . '</span></a></div>';
}
endif;
add_filter( 'the_content_more_link', 'siteorigin_unwind_read_more_link' );

if ( ! function_exists( 'siteorigin_unwind_excerpt_length' ) ) :
/**
 * Filter the excerpt length.
 */
function siteorigin_unwind_excerpt_length( $length ) {
	return siteorigin_setting( 'blog_excerpt_length' );
}
add_filter( 'excerpt_length', 'siteorigin_unwind_excerpt_length', 10 );
endif;

if ( ! function_exists( 'siteorigin_unwind_excerpt_more' ) ) :
/**
 * Add a more link to the excerpt.
 */
function siteorigin_unwind_excerpt_more( $more ) {
	if ( is_search() ) return;
	if ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' && siteorigin_setting( 'blog_excerpt_more', true ) ||
		siteorigin_setting( 'blog_archive_layout' ) == 'grid' && siteorigin_setting( 'blog_excerpt_more', true ) ||
		siteorigin_setting( 'blog_archive_layout' ) == 'alternate' && siteorigin_setting( 'blog_excerpt_more', true ) ) {
		$read_more_text = esc_html__( 'Continue reading', 'siteorigin-unwind' );
		return '<div class="more-link-wrapper"><a class="more-link" href="' . get_permalink() . '"><span class="more-text">' . $read_more_text . '</span></a></div>';
	}
}
endif;
add_filter( 'excerpt_more', 'siteorigin_unwind_excerpt_more' );

if ( ! function_exists( 'siteorigin_unwind_post_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, category and comment count.
 */
function siteorigin_unwind_post_meta( $cats = true, $post_id = '' ) {

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

	<?php if ( is_sticky() && is_home() && ! is_paged() && ! siteorigin_setting( 'blog_archive_layout' ) == 'grid' ) {
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'siteorigin-unwind' ) . '</span>';
	} ?>

	<?php if ( siteorigin_setting( 'blog_display_date' ) ) { ?>
		<span class="entry-date">
			<?php echo ( ! is_singular() ) ? '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( 'echo=0' ) .'">' : ''; ?>
				<?php the_time( apply_filters( 'siteorigin_unwind_date_format', 'M d, Y' ) ); ?>
			<?php echo ( ! is_singular() ) ? '</a>' : ''; ?>
		</span>
	<?php } ?>

	<?php if ( siteorigin_setting( 'blog_display_category' ) ) {

		if ( 'jetpack-portfolio' == get_post_type() ) {

			$portfolio_terms = get_the_term_list( $post_id, 'jetpack-portfolio-type', '', ', ', '' );
			if ( $portfolio_terms ) {
				printf( '<span class="entry-category">' . '%1$s' . '</span>', $portfolio_terms );
			}

		} else {

			if ( $categories_list && siteorigin_unwind_categorized_blog() && $cats == true ) {
				printf( '<span class="entry-category">' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
			}

		}
	} ?>

	<?php if ( $comments && siteorigin_setting( 'blog_display_comments' ) ) {
		echo '<span class="entry-comments"><a href="' . get_comments_link() .'">' . $comments . '</a></span>';
	} ?>

<?php }
endif;

if ( ! function_exists( 'siteorigin_unwind_thumbnail_meta' ) ) :
/**
 * Print HTML with meta information for the sticky status and post categories.
 */
function siteorigin_unwind_thumbnail_meta() {
	if ( ! ( is_sticky() || siteorigin_setting( 'blog_display_category' ) ) ) return;
	echo '<div class="thumbnail-meta">';
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span>' . esc_html__( 'Sticky', 'siteorigin-unwind' ) . '</span>';
	}
	if ( siteorigin_setting( 'blog_display_category' ) ) {
		siteorigin_unwind_three_categories();
	}
	echo '</div>';
}
endif;

if ( ! function_exists( 'siteorigin_unwind_three_categories' ) ) :
/**
 * Display only the first 3 categories
 */
function siteorigin_unwind_three_categories() {
	if ( has_category() ) {
		$categories = array_slice( get_the_category(), 0, 3 );

		foreach ( $categories as $category ) {
			if ( $category ) {
				echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a>';
			}
		}
	}
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

if ( ! function_exists( 'siteorigin_unwind_related_posts' ) ) :
/**
 * Displays related posts in single posts
 */
function siteorigin_unwind_related_posts( $post_id ) {
	if ( function_exists( 'related_posts' ) ) { // Check for YARPP plugin.
		related_posts();
	} elseif ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'related-posts' ) ) {
		echo do_shortcode( '[jetpack-related-posts]' );
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
										<?php the_post_thumbnail( 'siteorigin-unwind-263x174-crop' ); ?>
									<?php endif; ?>
									<h3 class="related-post-title"><?php the_title(); ?></h3>
									<p class="related-post-date"><?php the_time( apply_filters( 'siteorigin_unwind_date_format', 'M d, Y' ) ); ?></p>
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

if ( ! function_exists( 'siteorigin_unwind_related_projects ' ) ) :
/**
 * Displays related posts in single projects.
 */
function siteorigin_unwind_related_projects( $post_id ) {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'related-posts' ) ) {
		echo do_shortcode( '[jetpack-related-posts]' );
	} else { // The fallback loop.
		$categories = get_the_terms( $post_id, 'jetpack-portfolio-type' );
		$first_cat = $categories[0]->term_id;
		$args=array(
			'tax_query' => array(
		        array (
		            'taxonomy' => 'jetpack-portfolio-type',
		            'field' => 'term_id',
		            'terms' => $first_cat,
		        )
		    ),
			'post__not_in' => array( $post_id ),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => -1
		);
		$related_posts = new WP_Query( $args ); ?>

		<div class="related-projects-section">
			<h2 class="related-projects heading-strike"><?php esc_html_e( 'You may also like', 'siteorigin-unwind' ); ?></h2>
			<?php if ( $related_posts->have_posts() ) : ?>
				<div class="related-projects">
					<?php if ( $related_posts->have_posts() ) : ?>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<p><?php esc_html_e( 'No related projects.', 'siteorigin-unwind' ); ?></p>
			<?php endif; ?>
		</div>
		<?php wp_reset_query();
	}
}
endif;

if ( ! function_exists( 'siteorigin_unwind_tag_cloud' ) ) :
/**
 * Filter the Tag Cloud widget.
 */
function siteorigin_unwind_tag_cloud( $args ) {

	$args['unit'] = 'px';
	$args['largest'] = 12;
	$args['smallest'] = 12;
	return $args;
}
endif;
add_filter( 'widget_tag_cloud_args', 'siteorigin_unwind_tag_cloud' );

if ( ! function_exists( 'siteorigin_unwind_custom_icon' ) ):
/**
 * Display a custom icons from the settings
 */
function siteorigin_unwind_custom_icon( $icon, $class ) {

	$id = siteorigin_setting( $icon );
	$url = wp_get_attachment_url( $id );
	$filetype = wp_check_filetype( $url );
	$extension = $filetype['ext'];

	switch( $extension ) {
		case "svg":
		$attrs['class'] = "style-svg $class";
		break;

		default:
		$attrs['class'] = "$class";
	}

	echo wp_get_attachment_image( $id, 'full', false, $attrs );

}
endif;

if ( ! function_exists( 'siteorigin_unwind_display_icon' ) ) :
/**
 * Displays SVG icons.
 */
function siteorigin_unwind_display_icon( $type ) {

	switch( $type ) {

		case 'fullscreen-search' :
			if ( siteorigin_setting( 'icons_fullscreen_search' ) ): ?>
				<?php siteorigin_unwind_custom_icon( 'icons_fullscreen_search', 'svg-icon-fullscreen-search' ); ?>
			<?php else : ?>
				<svg version="1.1" class="svg-icon-fullscreen-search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
					<path d="M20.943 4.619c-4.5-4.5-11.822-4.5-16.321 0-4.498 4.5-4.498 11.822 0 16.319 4.007 4.006 10.247 4.435 14.743 1.308 0.095 0.447 0.312 0.875 0.659 1.222l6.553 6.55c0.953 0.955 2.496 0.955 3.447 0 0.953-0.951 0.953-2.495 0-3.447l-6.553-6.551c-0.347-0.349-0.774-0.565-1.222-0.658 3.13-4.495 2.7-10.734-1.307-14.743zM18.874 18.871c-3.359 3.357-8.825 3.357-12.183 0-3.357-3.359-3.357-8.825 0-12.184 3.358-3.359 8.825-3.359 12.183 0s3.359 8.825 0 12.184z"></path>
				</svg>
			<?php endif;
			break;

			case 'fullscreen-loading' :
				?>
				<svg version="1.1" class="svg-icon-search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
				  <path id="icon_loading" data-name="icon loading" class="cls-1" d="M13,26A13,13,0,1,1,26,13,13,13,0,0,1,13,26ZM13,4a9,9,0,1,0,4.88,16.551,1.925,1.925,0,0,1-.466-0.308l-5.656-5.657a2.006,2.006,0,0,1,0-2.828h0a2.006,2.006,0,0,1,2.828,0l5.656,5.657a1.926,1.926,0,0,1,.309.466A8.987,8.987,0,0,0,13,4Z"/>
				</svg>
				<?php
				break;

		case 'search' :
			if ( siteorigin_setting( 'icons_search' ) ): ?>
				<?php siteorigin_unwind_custom_icon( 'icons_search', 'svg-icon-search' ); ?>
			<?php else : ?>
				<svg version="1.1" class="svg-icon-search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
					<path d="M20.943 4.619c-4.5-4.5-11.822-4.5-16.321 0-4.498 4.5-4.498 11.822 0 16.319 4.007 4.006 10.247 4.435 14.743 1.308 0.095 0.447 0.312 0.875 0.659 1.222l6.553 6.55c0.953 0.955 2.496 0.955 3.447 0 0.953-0.951 0.953-2.495 0-3.447l-6.553-6.551c-0.347-0.349-0.774-0.565-1.222-0.658 3.13-4.495 2.7-10.734-1.307-14.743zM18.874 18.871c-3.359 3.357-8.825 3.357-12.183 0-3.357-3.359-3.357-8.825 0-12.184 3.358-3.359 8.825-3.359 12.183 0s3.359 8.825 0 12.184z"></path>
				</svg>
			<?php endif;
			break;

		case 'close' :
			if ( siteorigin_setting( 'icons_close_search' ) ): ?>
				<?php siteorigin_unwind_custom_icon( 'icons_close_search', 'svg-icon-close' ); ?>
			<?php else : ?>
				<svg version="1.1" class="svg-icon-close" xmlns="http://www.w3.org/2000/svg" width="15.56" height="15.562" viewBox="0 0 15.56 15.562">
					<path id="icon_close" data-name="icon close" class="cls-1" d="M1367.53,39.407l-2.12,2.121-5.66-5.657-5.66,5.657-2.12-2.121,5.66-5.657-5.66-5.657,2.12-2.122,5.66,5.657,5.66-5.657,2.12,2.122-5.66,5.657Z" transform="translate(-1351.97 -25.969)"/>
				</svg>
			<?php endif;
			break;

		case 'menu':
			if ( siteorigin_setting( 'icons_menu' ) ): ?>
				<?php siteorigin_unwind_custom_icon( 'icons_menu', 'svg-icon-menu' ); ?>
			<?php else : ?>
				<svg version="1.1" class="svg-icon-menu" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="32" viewBox="0 0 27 32">
					<path d="M27.429 24v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804zM27.429 14.857v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804zM27.429 5.714v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804z"></path>
				</svg>
			<?php endif;
			break;

		case 'cart':
			?>
			<svg version="1.1" class="svg-icon-cart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="32" viewBox="0 0 27 32">
				<path id="shopping_cart_icon" data-name="shopping cart icon" class="cls-1" d="M906.859,20A3.994,3.994,0,1,0,899,19a3.933,3.933,0,0,0,.142,1H897.09a6,6,0,1,1,11.82,0h-2.051ZM914,19H892l-3,24h28Zm-20.217,2h18.434l2.539,20H891.244Z" transform="translate(-889 -13)"/>
			</svg>
			<?php
			break;

		case 'up-arrow':
			?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="55" height="32" viewBox="0 0 55 32">
				<path fill="#fff" d="M50.276 32l-22.829-22.829-22.829 22.829-4.553-4.553 27.382-27.415 27.415 27.415z"></path>
			</svg>
			<?php
			break;

	}
}
endif;

if ( ! function_exists( 'siteorigin_unwind_strip_gallery' ) ) :
/**
 * Remove gallery.
 */
function siteorigin_unwind_strip_gallery( $content ) {
	preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

	if ( ! empty( $matches ) ) {
		foreach ( $matches as $shortcode ) {
			if ( 'gallery' === $shortcode[2] ) {
				$pos = strpos( $content, $shortcode[0] );
				if( false !== $pos ) {
					return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
				}
			}
		}
	}

	return $content;
}
endif;

if ( ! function_exists( 'siteorigin_unwind_get_video' ) ) :
/**
 * Get the video from the current post
 */
function siteorigin_unwind_get_video() {
	$first_url    = '';
	$first_video  = '';

	$i = 0;

	preg_match_all( '|^\s*https?://[^\s"]+\s*$|im', get_the_content(), $urls );

	foreach ( $urls[0] as $url ) {
		$i++;

		if ( 1 === $i ) {
			$first_url = trim( $url );
		}

		$oembed = wp_oembed_get( esc_url( $url ) );

		if ( ! $oembed ) continue;

		$first_video = $oembed;

		break;
	}

	return ( '' !== $first_video ) ? $first_video : false;
}
endif;

if ( ! function_exists( 'siteorigin_unwind_filter_video' ) ) :
/**
 * Removes the video from the page
 */
function siteorigin_unwind_filter_video( $content ) {
	if ( siteorigin_unwind_get_video() ) {
		preg_match_all( '|^\s*https?://[^\s"]+\s*$|im', $content, $urls );

		if ( ! empty( $urls[0] ) ) {
			$content = str_replace( $urls[0][0], '', $content );
		}
		return $content;
	} else {
		return $content;
	}
}
endif;

if ( ! function_exists( 'siteorigin_unwind_get_image' ) ) :
/**
 * Removes the first image from the page
 */
function siteorigin_unwind_get_image() {
	$first_image = '';

	$output = preg_match_all( '/<img[^>]+\>/i', get_the_content(), $images );
	$first_image = $images[0][0];

	return ( '' !== $first_image ) ? $first_image : false;
}
endif;

if ( ! function_exists( 'siteorigin_unwind_strip_image' ) ) :
/**
 * Removes the first image from the page.
 */
function siteorigin_unwind_strip_image( $content ) {
	return preg_replace( '/<img[^>]+\>/i', '', $content, 1 );
}
endif;

if ( ! function_exists( 'siteorigin_unwind_get_gallery' ) ) :
/**
 * Get gallery from content for gallery format posts.
 */
function siteorigin_unwind_get_gallery() {
	$gallery = get_post_gallery( get_the_ID(), false );
	if ( ! empty( $gallery ) && ! has_action( 'wp_footer', 'siteorigin_unwind_enqueue_flexslider' ) ) {
		add_action( 'wp_footer', 'siteorigin_unwind_enqueue_flexslider' );
	}

	return ( '' !== $gallery ) ? $gallery : false;
}
endif;

if ( ! function_exists( 'siteorigin_unwind_archive_post_media' ) ) :
/**
 * Check if archive post has format media or thumbnail.
 */
function siteorigin_unwind_archive_post_media() {

	if ( ( get_post_format() == 'gallery' && siteorigin_unwind_get_gallery() ) || ( get_post_format() == 'image' && siteorigin_unwind_get_image() ) || ( get_post_format() == 'video' && siteorigin_unwind_get_video() ) || has_post_thumbnail() ) {
		$entry_thumb = 'active-entry-thumb';
	} else {
		$entry_thumb = '';
	}
	return $entry_thumb;
}
endif;

if ( ! function_exists( 'siteorigin_unwind_jetpackme_related_posts_headline' ) ) :
/**
 * Changing the jetpack related posts title
 */
function siteorigin_unwind_jetpackme_related_posts_headline( $headline ) {
	$headline = sprintf(
	    '<h2 class="jp-relatedposts-headline related-posts heading-strike">%s</h2>',
	    esc_html( 'You may also like', 'siteorigin-unwind' )
	);
	return $headline;
}
endif;
add_filter( 'jetpack_relatedposts_filter_headline', 'siteorigin_unwind_jetpackme_related_posts_headline' );

if ( ! function_exists( 'siteorigin_unwind_jetpackme_remove_rp' ) ) :
/**
 * Removing jetpack related posts from the bottom of posts
 */
function siteorigin_unwind_jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
endif;
add_filter( 'wp', 'siteorigin_unwind_jetpackme_remove_rp', 20 );

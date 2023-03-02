<?php
/**
 * Deprecated functions.
 *
 * @since siteorigin-unwind 1.2.7
 *
 * @license GPL 2.0
 */
if ( ! function_exists( 'siteorigin_unwind_excerpt_length' ) ) {
	/**
	 * Filter the excerpt length.
	 *
	 * @deprecated 1.2.7 Use siteorigin_unwind_excerpt()
	 */
	function siteorigin_unwind_excerpt_length( $length ) {
		return siteorigin_setting( 'blog_excerpt_length' );
	}
	add_filter( 'excerpt_length', 'siteorigin_unwind_excerpt_length', 10 );
}

if ( ! function_exists( 'siteorigin_unwind_excerpt_more' ) ) {
	/**
	 * Add a more link to the excerpt.
	 *
	 * @deprecated 1.2.7 Use siteorigin_unwind_excerpt()
	 */
	function siteorigin_unwind_excerpt_more( $more ) {
		if ( is_search() ) {
			return;
		}

		if (
			(
				siteorigin_setting( 'blog_archive_content' ) == 'excerpt' ||
				siteorigin_setting( 'blog_archive_layout' ) == 'grid' ||
				siteorigin_setting( 'blog_archive_layout' ) == 'alternate'
			) &&
				siteorigin_setting( 'blog_excerpt_more', true )
		) {
			$read_more_text = esc_html__( 'Continue reading', 'siteorigin-unwind' );

			return '...<div class="more-link-wrapper"><a class="more-link" href="' . esc_url( get_permalink() ) . '"><span class="more-text">' . $read_more_text . '</span></a></div>';
		}
	}
}
add_filter( 'excerpt_more', 'siteorigin_unwind_excerpt_more' );

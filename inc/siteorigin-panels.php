<?php

if ( ! function_exists( 'siteorigin_unwind_panels_lite_localization' ) ) :
/**
 * The default panels lite labels.
 */
function siteorigin_unwind_panels_lite_localization( $loc ) {
	return wp_parse_args( array(
		'page_builder'         => __( 'Page Builder', 'siteorigin-unwind' ),
		'home_page_title'      => __( 'Custom Home Page Builder', 'siteorigin-unwind' ),
		'home_page_menu'       => __( 'Home Page', 'siteorigin-unwind' ),
		'install_plugin'       => __( 'Install Page Builder Plugin', 'siteorigin-unwind' ),
		'on_text'              => __( 'On', 'siteorigin-unwind' ),
		'off_text'             => __( 'Off', 'siteorigin-unwind' ),
		'home_install_message' => __( 'SiteOrigin Unwind supports Page Builder to create beautifully proportioned column based content.', 'siteorigin-unwind' ),
		// Longer message to display to a user about installing the plugin
		'home_disable_message' => '',
		// Message about disabling the custom home page if the user doesn't want to use it
	), $loc );
}
endif;
add_filter( 'siteorigin_panels_lite_localization', 'siteorigin_unwind_panels_lite_localization' );

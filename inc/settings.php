<?php

function siteorigin_unwind_settings_localize( $loc ){
	return wp_parse_args( array(
		'section_title' => __('Theme Settings', 'siteorigin-unwind'),
		'section_description' => __('Change settings for your theme.', 'siteorigin-unwind'),
		'premium_only' => __('Available in Premium', 'siteorigin-unwind'),
		'premium_url' => 'https://siteorigin.com/premium/?target=theme_unwind',

		// For the controls
		'variant' => __('Variant', 'siteorigin-unwind'),
		'subset' => __('Subset', 'siteorigin-unwind'),

		// For the settings metabox
		'meta_box' => __('Page settings', 'siteorigin-unwind'),
	), $loc);
}
add_filter('siteorigin_settings_localization', 'siteorigin_settings_localize');

/**
 * Initialize the settings
 */
function siteorigin_unwind_settings_init(){

	SiteOrigin_Settings::single()->configure( apply_filters( 'siteorigin_unwind_settings_array', array(

		'navigation' => array(
			'title' => __( 'Navigation', 'siteorigin-unwind' ),
			'fields' => array(
				'post' => array(
					'type' => 'checkbox',
					'label' => __('Post navigation', 'siteorigin-unwind'),
					'description' => __('Display next and previous post navigation', 'siteorigin-unwind'),
				),
			),
		),

		'blog' => array(
			'title' => __( 'Blog', 'siteorigin-unwind' ),
			'fields' => array(
				'featured_single' => array(
					'type' => 'checkbox',
					'label' => __('Featured image on single', 'siteorigin-unwind'),
				),
				'display_author_box' => array(
					'type' => 'checkbox',
					'label' => __('Display author box on single', 'siteorigin-unwind'),
				),
			)
		),

	) ) );
}
add_action('siteorigin_settings_init', 'siteorigin_unwind_settings_init');

/**
 * Tell the settings framework which settings we're using as fonts
 *
 * @param $settings
 *
 * @return array
 */
function siteorigin_unwind_font_settings( $settings ) {
	return $settings;
}
add_filter( 'siteorigin_settings_font_settings', 'siteorigin_unwind_font_settings' );

/**
 * Add custom CSS for the theme settings
 *
 * @param $css
 *
 * @return string
 */
function siteorigin_unwind_settings_custom_css($css){
	return $css;
}
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_unwind_settings_custom_css' );

/**
 * Add default settings.
 *
 * @param $defaults
 *
 * @return mixed
 */
function siteorigin_unwind_settings_defaults( $defaults ){

	// Navigation defaults
	$defaults['navigation_post'] = true;

	// Blog settings
	$defaults['blog_featured_single'] = true;
	$defaults['blog_display_author_box'] = false;

	return $defaults;
}
add_filter('siteorigin_settings_defaults', 'siteorigin_unwind_settings_defaults');

/**
 * Setup Page Settings for SiteOrigin Unwind
 */
function siteorigin_unwind_setup_page_settings(){

	SiteOrigin_Settings_Page_Settings::single()->configure( array(

	) );

}
add_action('siteorigin_page_settings_init', 'siteorigin_unwind_setup_page_settings');

/**
 * Add the default Page Settings
 */
function siteorigin_unwind_setup_page_setting_defaults( $defaults ){
	return $defaults;
}
add_filter('siteorigin_page_settings_defaults', 'siteorigin_unwind_setup_page_setting_defaults');

/**
 * Change the default page settings for the home page.
 *
 * @param $settings
 *
 * @return mixed
 */
function siteorigin_unwind_page_settings_panels_defaults( $settings ){
	return $settings;
}
add_filter('siteorigin_page_settings_panels_home_defaults', 'siteorigin_unwind_page_settings_panels_defaults');

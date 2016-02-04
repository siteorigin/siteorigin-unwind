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
add_filter('siteorigin_settings_localization', 'siteorigin_unwind_settings_localize');

/**
 * Initialize the settings
 */
function siteorigin_unwind_settings_init(){

	SiteOrigin_Settings::single()->configure( apply_filters( 'siteorigin_unwind_settings_array', array(

		'footer' => array(
			'title' => __('Footer', 'siteorigin-unwind'),
			'fields' => array(

				'text' => array(
					'type' => 'text',
					'label' => __('Footer Text', 'siteorigin-unwind'),
					'description' => __("{sitename} and {year} are your site's name and current year", 'siteorigin-unwind'),
					'sanitize_callback' => 'wp_kses_post',
				),

				'constrained' => array(
					'type' => 'checkbox',
					'label' => __('Constrain', 'siteorigin-unwind'),
					'description' => __("Constrain the footer width", 'siteorigin-unwind'),
				),

				'top_padding' => array(
					'type' => 'text',
					'label' => __('Top Padding', 'siteorigin-unwind'),
					'sanitize_callback' => array( 'SiteOrigin_Settings_Value_Sanitize', 'measurement' ),
					'live' => true,
				),

				'side_padding' => array(
					'type' => 'text',
					'label' => __('Side Padding', 'siteorigin-unwind'),
					'sanitize_callback' => array( 'SiteOrigin_Settings_Value_Sanitize', 'measurement' ),
					'live' => true,
				),

				'top_margin' => array(
					'type' => 'text',
					'label' => __('Top Margin', 'siteorigin-unwind'),
					'sanitize_callback' => array( 'SiteOrigin_Settings_Value_Sanitize', 'measurement' ),
					'live' => true,
				),
			),
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
	// Custom CSS collator_get_error_code
	$css .= '/* style */' . "\n" .
		'#colophon {' . "\n" .
		'margin-top: ${footer_top_margin};' . "\n" .
		'}' . "\n" .
		'#colophon .widgets {' . "\n" .
		'padding: ${footer_top_padding} ${footer_side_padding};' . "\n" .
		'}';
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

	// Footer settings
	$defaults['footer_text'] = __('{year} © {sitename}.', 'siteorigin-unwind');
	$defaults['footer_constrained'] = false;
	$defaults['footer_top_padding'] = '40px';
	$defaults['footer_side_padding'] = '40px';
	$defaults['footer_top_margin'] = '30px';
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

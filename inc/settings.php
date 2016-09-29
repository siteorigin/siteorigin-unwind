<?php

function siteorigin_unwind_settings_localize( $loc ) {
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
add_filter( 'siteorigin_settings_localization', 'siteorigin_unwind_settings_localize' );

/**
 * Initialize the settings
 */
function siteorigin_unwind_settings_init() {

	SiteOrigin_Settings::single()->configure( apply_filters( 'siteorigin_unwind_settings_array', array(

		'branding' => array(
			'title' => __('Branding', 'siteorigin-unwind'),
			'fields' => array(
				'logo' => array(
					'type' => 'media',
					'label' => __('Logo', 'siteorigin-unwind'),
					'description' => __('Logo displayed in your masthead.', 'siteorigin-unwind')
				),
				'retina_logo' => array(
					'type' => 'media',
					'label' => __('Retina Logo', 'siteorigin-unwind'),
					'description' => __('A double sized logo to use on retina devices.', 'siteorigin-unwind')
				),
				'site_description' => array(
					'type' => 'checkbox',
					'label' => __('Site Description', 'siteorigin-unwind'),
					'description' => __('Show your site description below your site title or logo.', 'siteorigin-unwind')
				),
				'accent' => array(
					'type' => 'color',
					'label' => __('Accent Color', 'siteorigin-unwind'),
					'description' => __('The color used for links and various other accents.', 'siteorigin-unwind'),
					'live' => true,
				),
				'accent_dark' => array(
					'type' => 'color',
					'label' => __('Dark Accent Color', 'siteorigin-unwind'),
					'description' => __('A darker version of your accent color.', 'siteorigin-unwind'),
					'live' => true,
				),
			)
		),

		'fonts'      => array(
			'title'  => __( 'Fonts', 'siteorigin-unwind' ),
			'fields' => array(

				// The font families used.
				'main'        => array(
					'type'        => 'font',
					'label'       => __( 'Main Font', 'siteorigin-unwind' ),
					'description' => __( 'Main font used on your site.', 'siteorigin-unwind' ),
					'live'        => true,
				),
				'headings'    => array(
					'type'        => 'font',
					'label'       => __( 'Headings font', 'siteorigin-unwind' ),
					'description' => __( 'Font used for headings.', 'siteorigin-unwind' ),
					'live'        => true,
				),
				'details'     => array(
					'type'        => 'font',
					'label'       => __( 'Details font', 'siteorigin-unwind' ),
					'description' => __( 'Font used for smaller details.', 'siteorigin-unwind' ),
					'live'        => true,
				),
				// The colors

				'text_dark'   => array(
					'type'  => 'color',
					'label' => __( 'Dark Text Color', 'siteorigin-unwind' ),
					'live'  => true,
				),
				'text_medium' => array(
					'type'  => 'color',
					'label' => __( 'Medium Text Color', 'siteorigin-unwind' ),
					'live'  => true,
				),
				'text_light'  => array(
					'type'  => 'color',
					'label' => __( 'Light Text Color', 'siteorigin-unwind' ),
					'live'  => true,
				),
				'text_meta'   => array(
					'type'  => 'color',
					'label' => __( 'Meta Text Color', 'siteorigin-unwind' ),
					'live'  => true,
				),

			),
		),		

		'masthead' => array(
			'title' => __('Header', 'siteorigin-unwind'),
			'fields' => array(
				'social_widget' => array(
					'type' => 'widget',
					'widget_class' => 'SiteOrigin_Widget_SocialMediaButtons_Widget',
					'bundle_widget' => 'social-media-buttons',
					'plugin' => 'so-widgets-bundle',
					'plugin_name' => __('SiteOrigin Widgets Bundle', 'siteorigin-unwind'),
					'description' => __('Add social icons to the masthead.', 'siteorigin-unwind'),
				),
				'bottom_margin' => array(
					'type' => 'text',
					'label' => __('Bottom Margin', 'siteorigin-unwind'),
					'sanitize_callback' => array( 'SiteOrigin_Settings_Value_Sanitize', 'measurement' ),
					'live' => true,
				),
			)
		),

		'navigation' => array(
			'title' => __( 'Navigation', 'siteorigin-unwind' ),
			'fields' => array(
				'sticky' => array(
					'type' => 'checkbox',
					'label' => __('Sticky menu', 'siteorigin-unwind'),
					'description' => __('Stick menu to top of screen', 'siteorigin-unwind'),
				),
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
				'featured_archive' => array(
					'type' => 'checkbox',
					'label' => __('Featured image on archive', 'siteorigin-unwind'),
				),
				'featured_single' => array(
					'type' => 'checkbox',
					'label' => __('Featured image on single', 'siteorigin-unwind'),
				),
				'display_related_posts' => array(
					'type' => 'checkbox',
					'label' => __('Display related posts on single', 'siteorigin-unwind'),
				),
				'display_author_box' => array(
					'type' => 'checkbox',
					'label' => __('Display author box on single', 'siteorigin-unwind'),
				),
			)
		),

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

	$settings['fonts_main']     = array(
		'name'    => 'Merriweather',
		'weights' => array(
			400,
			700
		),
	);
	$settings['fonts_headings'] = array(
		'name'    => 'Merriweather',
		'weights' => array(
			400
		),
	);	
	$settings['fonts_details'] = array(
		'name'    => 'Lato',
		'weights' => array(
			400
		),
	);	

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
	// Custom CSS Code
	$css .= '/* style */' . "\n" .
		'blockquote {' . "\n" .
		'color: ${branding_accent};' . "\n" .
		'}' . "\n" .
		'a {' . "\n" .
		'color: ${branding_accent};' . "\n" .
		'}' . "\n" .
		'a:hover,a:focus {' . "\n" .
		'color: ${branding_accent_dark};' . "\n" .
		'}' . "\n" .
		'#masthead {' . "\n" .
		'margin-bottom: ${masthead_bottom_margin};' . "\n" .
		'}' . "\n" .
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

	// Branding defaults
	$defaults['branding_logo'] = false;
	$defaults['branding_logo_retina'] = false;
	$defaults['branding_site_description'] = false;
	$defaults['branding_accent'] = '#25c48a';
	$defaults['branding_accent_dark'] = '#21af7b';

	// The masthead defaults
	$defaults['masthead_social_widget'] = '';
	$defaults['masthead_bottom_margin'] = '30px';

	// Navigation defaults
	$defaults['navigation_sticky'] = true;
	$defaults['navigation_post'] = true;

	// Blog settings
	$defaults['blog_featured_archive'] = true;
	$defaults['blog_featured_single'] = true;
	$defaults['blog_display_related_posts'] = true;
	$defaults['blog_display_author_box'] = true;

	// Footer settings
	$defaults['footer_text'] = __('{year} © {sitename}.', 'siteorigin-unwind');
	$defaults['footer_constrained'] = true;
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
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Page Layout', 'siteorigin-unwind' ),
			'options' => array(
				'default' => __( 'Default', 'siteorigin-unwind' ),
				'no-sidebar' => __( 'No Sidebar', 'siteorigin-unwind' ),
				'full-width' => __( 'Full Width', 'siteorigin-unwind' ),
				'full-width-sidebar' => __( 'Full Width, With Sidebar', 'siteorigin-unwind' ),
			),
		),

		'page_title' => array(
			'type' => 'checkbox',
			'label' => __( 'Page Title', 'siteorigin-unwind' ),
			'checkbox_label' => __( 'display', 'siteorigin-unwind' ),
			'description' => __('Display the page title on this page.', 'siteorigin-unwind')
		),

		'masthead_margin' => array(
			'type' => 'checkbox',
			'label' => __( 'Masthead Bottom Margin', 'siteorigin-unwind' ),
			'checkbox_label' => __( 'enable', 'siteorigin-unwind' ),
			'default' => true,
			'description' => __('Include the margin below the masthead (top area) of your site.', 'siteorigin-unwind')
		),

		'footer_margin' => array(
			'type' => 'checkbox',
			'label' => __( 'Footer Top Margin', 'siteorigin-unwind' ),
			'checkbox_label' => __( 'enable', 'siteorigin-unwind' ),
			'default' => true,
			'description' => __('Include the margin above your footer.', 'siteorigin-unwind')
		),
	) );

}
add_action( 'siteorigin_page_settings_init', 'siteorigin_unwind_setup_page_settings' );

/**
 * Add the default Page Settings
 */
function siteorigin_unwind_setup_page_setting_defaults( $defaults ) {
	$defaults['layout'] = 'default';
	$defaults['page_title'] = true;
	$defaults['masthead_margin'] = true;
	$defaults['footer_margin'] = true;
	return $defaults;
}
add_filter( 'siteorigin_page_settings_defaults', 'siteorigin_unwind_setup_page_setting_defaults' );

/**
 * Change the default page settings for the home page.
 *
 * @param $settings
 *
 * @return mixed
 */
function siteorigin_unwind_page_settings_panels_defaults( $settings ) {
	$settings['layout'] = 'no-sidebar';
	$defaults['page_title'] = false;
	return $settings;
}
add_filter( 'siteorigin_page_settings_panels_home_defaults', 'siteorigin_unwind_page_settings_panels_defaults' );

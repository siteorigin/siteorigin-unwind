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
			)
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
				'bottom_margin'	=> array(
					'type'	=> 'measurement',
					'label'	=> __( 'Bottom Margin', 'siteorigin-unwind' ),
					'live'	=> true,
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

				'top_padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> __( 'Top Padding', 'siteorigin-unwind' ),
					'live'	=> true,
				),

				'side_padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> __( 'Side Padding', 'siteorigin-unwind' ),
					'live'	=> true,
				),

				'top_margin'	=> array(
					'type'	=> 'measurement',
					'label'	=> __( 'Top Margin', 'siteorigin-unwind' ),
					'live'	=> true,
				),
			),
		),

	) ) );
}
add_action('siteorigin_settings_init', 'siteorigin_unwind_settings_init');

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
		'color: ${branding_accent};' . "\n" .
		'}' . "\n" .
		'.site-content {' . "\n" .
		'padding-top: ${masthead_bottom_margin};' . "\n" .
		'}' . "\n" .
		'.page-header {' . "\n" .
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
	$defaults['branding_site_description'] = false;
	$defaults['branding_accent'] = '#24c48a';

	// The masthead defaults
	$defaults['masthead_social_widget'] = '';
	$defaults['masthead_bottom_margin'] = '80px';

	// Navigation defaults
	$defaults['navigation_sticky'] = true;
	$defaults['navigation_post'] = true;

	// Blog settings
	$defaults['blog_featured_archive'] = true;
	$defaults['blog_featured_single'] = true;
	$defaults['blog_display_related_posts'] = true;
	$defaults['blog_display_author_box'] = true;

	// Footer settings
	$defaults['footer_text'] = esc_html__('{year} &copy; {sitename}.', 'siteorigin-unwind');
	$defaults['footer_constrained'] = true;
	$defaults['footer_top_padding'] = '40px';
	$defaults['footer_side_padding'] = '40px';
	$defaults['footer_top_margin'] = '30px';

	return $defaults;
}
add_filter('siteorigin_settings_defaults', 'siteorigin_unwind_settings_defaults');

if ( ! function_exists( 'siteorigin_unwind_page_settings' ) ) :
/**
 * Setup Page Settings for SiteOrigin North
 */
function siteorigin_unwind_page_settings( $settings, $type, $id ){

	$settings['layout'] = array(
		'type'    => 'select',
		'label'   => __( 'Page Layout', 'siteorigin-unwind' ),
		'options' => array(
			'default'            => __( 'Default', 'siteorigin-unwind' ),
			'no-sidebar'         => __( 'No Sidebar', 'siteorigin-unwind' ),
			'full-width'         => __( 'Full Width', 'siteorigin-unwind' ),
			'full-width-sidebar' => __( 'Full Width, With Sidebar', 'siteorigin-unwind' ),
		),
	);

	$settings['page_title'] = array(
		'type'           => 'checkbox',
		'label'          => __( 'Page Title', 'siteorigin-unwind' ),
		'checkbox_label' => __( 'display', 'siteorigin-unwind' ),
		'description'    => __( 'Display the page title on this page.', 'siteorigin-unwind' )
	);

	$settings['masthead_margin'] = array(
		'type'           => 'checkbox',
		'label'          => __( 'Masthead Bottom Margin', 'siteorigin-unwind' ),
		'checkbox_label' => __( 'enable', 'siteorigin-unwind' ),
		'description'    => __( 'Include the margin below the masthead (top area) of your site.', 'siteorigin-unwind' )
	);

	$settings['footer_margin'] = array(
		'type'           => 'checkbox',
		'label'          => __( 'Footer Top Margin', 'siteorigin-unwind' ),
		'checkbox_label' => __( 'enable', 'siteorigin-unwind' ),
		'description'    => __( 'Include the margin above your footer.', 'siteorigin-unwind' )
	);

	$settings['hide_masthead'] = array(
		'type'           => 'checkbox',
		'label'          => __( 'Hide Masthead', 'siteorigin-unwind' ),
		'checkbox_label' => __( 'hide', 'siteorigin-unwind' ),
		'description'    => __( 'Hide the masthead on this page.', 'siteorigin-unwind' )
	);

	$settings['hide_footer_widgets'] = array(
		'type'           => 'checkbox',
		'label'          => __( 'Hide Footer Widgets', 'siteorigin-unwind' ),
		'checkbox_label' => __( 'hide', 'siteorigin-unwind' ),
		'description'    => __( 'Hide the footer widgets on this page.', 'siteorigin-unwind' )
	);

	return $settings;
}
endif;
add_action( 'siteorigin_page_settings', 'siteorigin_unwind_page_settings', 10, 3 );

if ( ! function_exists( 'siteorigin_unwind_setup_page_setting_defaults' ) ) :
/**
 * Add the default Page Settings
 */
function siteorigin_unwind_setup_page_setting_defaults( $defaults, $type, $id ){
	// All the basic default settings
	$defaults['layout']              = 'default';
	$defaults['page_title']          = true;
	$defaults['masthead_margin']     = true;
	$defaults['footer_margin']       = true;
	$defaults['hide_masthead']       = false;
	$defaults['hide_footer_widgets'] = false;

	// Specific default settings for different types
	if( $type == 'template' && $id == 'home' ) {
		$defaults['page_title'] = false;
	}

	return $defaults;
}
endif;
add_filter( 'siteorigin_page_settings_defaults', 'siteorigin_unwind_setup_page_setting_defaults', 10, 3 );

if ( ! function_exists( 'siteorigin_unwind_page_settings_panels_defaults' ) ) :
/**
 * Change the default page settings for the home page.
 *
 * @param $settings
 *
 * @return mixed
 */
function siteorigin_unwind_page_settings_panels_defaults( $settings ){
	$settings['layout']     = 'no-sidebar';
	$settings['page_title'] = false;

	return $settings;
}
endif;
add_filter('siteorigin_page_settings_panels_home_defaults', 'siteorigin_unwind_page_settings_panels_defaults');

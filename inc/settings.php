<?php

/**
 * Localize the theme settings.
 */
function siteorigin_unwind_settings_localize( $loc ) {
	return wp_parse_args( array(
		'section_title' => esc_html__( 'Theme Settings', 'siteorigin-unwind' ),
		'section_description' => esc_html__( 'Change settings for your theme.', 'siteorigin-unwind' ),
		'premium_only' => esc_html__( 'Available in Premium', 'siteorigin-unwind' ),
		'premium_url' => 'https://siteorigin.com/premium/?target=theme_unwind',

		// For the controls.
		'variant' => esc_html__( 'Variant', 'siteorigin-unwind' ),
		'subset' => esc_html__( 'Subset', 'siteorigin-unwind' ),

		// For the settings metabox.
		'meta_box' => esc_html__( 'Page settings', 'siteorigin-unwind' ),
	), $loc);
}
add_filter( 'siteorigin_settings_localization', 'siteorigin_unwind_settings_localize' );

/**
 * Initialize the settings.
 */
function siteorigin_unwind_settings_init() {

	SiteOrigin_Settings::single()->configure( apply_filters( 'siteorigin_unwind_settings_array', array(

		'branding' => array(
			'title' => esc_html__( 'Branding', 'siteorigin-unwind' ),
			'fields' => array(
				'logo' => array(
					'type' => 'media',
					'label' => esc_html__( 'Logo', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Logo displayed in your masthead.', 'siteorigin-unwind' )
				),
				'site_description' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Site Description', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Show your site description below your site title or logo.', 'siteorigin-unwind' )
				),
				'accent' => array(
					'type' => 'color',
					'label' => esc_html__( 'Accent Color', 'siteorigin-unwind' ),
					'description' => esc_html__( 'The color used for links and various other accents.', 'siteorigin-unwind' ),
					'live' => true,
				),
			)
		),

		'masthead' => array(
			'title' => esc_html__( 'Header', 'siteorigin-unwind' ),
			'fields' => array(
				'social_widget' => array(
					'type' => 'widget',
					'widget_class' => 'SiteOrigin_Widget_SocialMediaButtons_Widget',
					'bundle_widget' => 'social-media-buttons',
					'plugin' => 'so-widgets-bundle',
					'plugin_name' => esc_html__( 'SiteOrigin Widgets Bundle', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Add social icons to the masthead.', 'siteorigin-unwind' ),
				),
				'bottom_margin'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Bottom Margin', 'siteorigin-unwind' ),
					'live'	=> true,
				),
			)
		),

		'navigation' => array(
			'title' => esc_html__( 'Navigation', 'siteorigin-unwind' ),
			'fields' => array(
				'sticky' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Sticky menu', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Stick menu to top of screen', 'siteorigin-unwind' ),
				),
				'post' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post navigation', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Display next and previous post navigation', 'siteorigin-unwind' ),
				),
			),
		),

		'icons' => array(
			'title' => esc_html__( 'Icons', 'siteorigin-unwind' ),
			'fields' => array(
				'menu' => array(
					'type' => 'media',
					'label' => __( 'Mobile menu icon', 'siteorigin-unwind' ),
				),
				'fullscreen_search' => array(
					'type' => 'media',
					'label' => __( 'Fullscreen search icon', 'siteorigin-unwind' ),
				),
				'search' => array(
					'type' => 'media',
					'label' => __( 'Masthead search icon', 'siteorigin-unwind' ),
				),
				'close_search' => array(
					'type' => 'media',
					'label' => __( 'Close search icon', 'siteorigin-unwind' ),
				),
			),
		),

		'blog' => array(
			'title' => esc_html__( 'Blog', 'siteorigin-unwind' ),
			'fields' => array(
				'featured_slider' => array(
					'type' => 'checkbox',
					'label' => __( 'Featured posts slider on blog home page.', 'siteorigin-unwind' ),
				),
				'featured_archive' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Featured image on archive.', 'siteorigin-unwind' ),
				),
				'featured_single' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Featured image on single post.', 'siteorigin-unwind' ),
				),
				'display_related_posts' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Related posts on single post.', 'siteorigin-unwind' ),
				),
				'display_author_box' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Display author box on single post.', 'siteorigin-unwind' ),
				),
			)
		),

		'footer' => array(
			'title' => esc_html__( 'Footer', 'siteorigin-unwind' ),
			'fields' => array(

				'text' => array(
					'type' => 'text',
					'label' => esc_html__( 'Footer Text', 'siteorigin-unwind' ),
					'description' => esc_html__( "{sitename} and {year} are your site's name and current year", 'siteorigin-unwind' ),
					'sanitize_callback' => 'wp_kses_post',
				),

				'constrained' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Constrain', 'siteorigin-unwind' ),
					'description' => esc_html__( "Constrain the footer width.", 'siteorigin-unwind' ),
				),

				'top_padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Top Padding', 'siteorigin-unwind' ),
					'live'	=> true,
				),

				'side_padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Side Padding', 'siteorigin-unwind' ),
					'description' => esc_html__( "Applies if the footer width is not constrained.", 'siteorigin-unwind' ),
					'live'	=> true,
				),

				'top_margin'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Top Margin', 'siteorigin-unwind' ),
					'live'	=> true,
				),
			),
		),

	) ) );
}
add_action( 'siteorigin_settings_init', 'siteorigin_unwind_settings_init' );

/**
 * Add custom CSS for the theme settings.
 *
 * @param $css
 *
 * @return string
 */
function siteorigin_unwind_settings_custom_css( $css ){
	// Custom CSS Code
	$css .= '/* style */
	a {
	color: ${branding_accent};
	}
	a:hover,a:focus {
	color: ${branding_accent};
	}
	#masthead {
	margin-bottom: ${masthead_bottom_margin};
	}
	.archive .container > .page-header,.search .container > .page-header {
	margin-bottom: ${masthead_bottom_margin};
	}
	.page-header {
	margin-bottom: ${masthead_bottom_margin};
	}
	#colophon {
	margin-top: ${footer_top_margin};
	}
	#colophon .widgets {
	padding: ${footer_top_padding} ${footer_side_padding} 0;
	}
	/* woocommerce */
	.woocommerce form.login input.button,.woocommerce form.checkout_coupon input.button {
	background-color: ${branding_accent};
	}
	.woocommerce form.login input.button:hover,.woocommerce form.checkout_coupon input.button:hover {
	background-color: ${branding_accent};
	}
	.woocommerce .woocommerce-checkout .order-details .woocommerce-checkout-review-order #payment .place-order .button {
	background-color: ${branding_accent};
	}
	.woocommerce .woocommerce-checkout .order-details .woocommerce-checkout-review-order #payment .place-order .button:hover {
	background-color: ${branding_accent};
	}
	.woocommerce-cart .woocommerce-message:before,.woocommerce-cart .woocommerce-info:before {
	color: ${branding_accent};
	}
	.woocommerce-cart form table.shop_table .product-name a:hover {
	color: ${branding_accent};
	}
	.woocommerce-cart form table.shop_table td.actions input.button {
	background-color: ${branding_accent};
	}
	.woocommerce-cart form table.shop_table td.actions input.button:hover {
	background-color: ${branding_accent};
	}
	.woocommerce-cart .cart-collaterals .cart_totals table tr.shipping .shipping-calculator-form .shipping-calculator-button {
	color: ${branding_accent};
	}
	.woocommerce-cart .cart-collaterals .cart_totals table tr.shipping .shipping-calculator-form .shipping-calculator-button:hover {
	color: ${branding_accent};
	}
	.woocommerce-cart .cart-collaterals .cart_totals table tr.shipping .shipping-calculator-form .button {
	background-color: ${branding_accent};
	}
	.woocommerce-cart .cart-collaterals .cart_totals table tr.shipping .shipping-calculator-form .button:hover {
	background-color: ${branding_accent};
	}
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button {
	background-color: ${branding_accent};
	}
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover {
	background-color: ${branding_accent};
	}';
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
function siteorigin_unwind_settings_defaults( $defaults ) {

	// Branding defaults.
	$defaults['branding_logo']             = false;
	$defaults['branding_site_description'] = false;
	$defaults['branding_accent']           = '#24c48a';

	// The masthead defaults.
	$defaults['masthead_social_widget'] = '';
	$defaults['masthead_bottom_margin'] = '80px';

	// Navigation defaults.
	$defaults['navigation_sticky'] = true;
	$defaults['navigation_post']   = true;

	// Icons
	$defaults['icons_menu']              = false;
	$defaults['icons_fullscreen_search'] = false;
	$defaults['icons_search']            = false;
	$defaults['icons_close_search']      = false;

	// Blog settings
	$defaults['blog_featured_slider']       = false;
	$defaults['blog_featured_archive']      = true;
	$defaults['blog_featured_single']       = true;
	$defaults['blog_display_related_posts'] = true;
	$defaults['blog_display_author_box']    = true;

	// Footer settings.
	$defaults['footer_text']         = esc_html__( '{year} &copy; {sitename}.', 'siteorigin-unwind' );
	$defaults['footer_constrained']  = true;
	$defaults['footer_top_padding']  = '80px';
	$defaults['footer_side_padding'] = '40px';
	$defaults['footer_top_margin']   = '80px';

	return $defaults;
}
add_filter( 'siteorigin_settings_defaults', 'siteorigin_unwind_settings_defaults' );

/**
 * Setup Page Settings for SiteOrigin North
 */
function siteorigin_unwind_page_settings( $settings, $type, $id ) {

	$settings['layout'] = array(
		'type'    => 'select',
		'label'   => esc_html__( 'Page Layout', 'siteorigin-unwind' ),
		'options' => array(
			'default'            => esc_html__( 'Default', 'siteorigin-unwind' ),
			'no-sidebar'         => esc_html__( 'No Sidebar', 'siteorigin-unwind' ),
			'full-width'         => esc_html__( 'Full Width', 'siteorigin-unwind' ),
			'full-width-sidebar' => esc_html__( 'Full Width, With Sidebar', 'siteorigin-unwind' ),
		),
	);

	$settings['page_title'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Page Title', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'display', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Display the page title on this page.', 'siteorigin-unwind' )
	);

	$settings['masthead_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Masthead Bottom Margin', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'enable', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Include the margin below the masthead (top area) of your site.', 'siteorigin-unwind' )
	);

	$settings['footer_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Top Margin', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'enable', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Include the margin above your footer.', 'siteorigin-unwind' )
	);

	$settings['display_masthead'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Masthead', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'Display', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Display the masthead on this page.', 'siteorigin-unwind' )
	);

	$settings['display_footer_widgets'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Widgets', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'Display', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Hide the footer widgets on this page.', 'siteorigin-unwind' )
	);

	return $settings;
}
add_action( 'siteorigin_page_settings', 'siteorigin_unwind_page_settings', 10, 3 );

/**
 * Add the default Page Settings.
 */
function siteorigin_unwind_setup_page_setting_defaults( $defaults, $type, $id ){
	// All the basic default settings.
	$defaults['layout']              	= 'default';
	$defaults['page_title']          	= true;
	$defaults['masthead_margin']     	= true;
	$defaults['footer_margin']       	= true;
	$defaults['display_masthead']       = true;
	$defaults['display_footer_widgets'] = true;

	// Specific default settings for different types.
	if ( $type == 'template' && $id == 'home' ) {
		$defaults['page_title'] = false;
	}

	return $defaults;
}
add_filter( 'siteorigin_page_settings_defaults', 'siteorigin_unwind_setup_page_setting_defaults', 10, 3 );

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
add_filter( 'siteorigin_page_settings_panels_home_defaults', 'siteorigin_unwind_page_settings_panels_defaults' );

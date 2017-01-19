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
					'description' => esc_html__( 'Logo displayed in your header.', 'siteorigin-unwind' )
				),
				'retina_logo' => array(
					'type' => 'media',
					'label' => esc_html__( 'Retina Logo', 'siteorigin-unwind' ),
					'description' => esc_html__( 'A double sized logo to use on retina devices.', 'siteorigin-unwind' )
				),
				'site_description' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Site Description', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Show your site description below your site title or logo.', 'siteorigin-unwind' )
				),
				'attribution' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Display SiteOrigin Attribution', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Choose if the link to SiteOrigin is displayed in your footer.', 'siteorigin-unwind' ),
					'teaser' => true,
				),
				'accent' => array(
					'type' => 'color',
					'label' => esc_html__( 'Accent Color', 'siteorigin-unwind' ),
					'description' => esc_html__( 'The color used for links and various other accents.', 'siteorigin-unwind' ),
					'live' => true,
				),
				'accent_dark' => array(
					'type' => 'color',
					'label' => esc_html__( 'Dark Accent Color', 'siteorigin-unwind' ),
					'description' => esc_html__( 'The color used for link hovers and various other accents.', 'siteorigin-unwind' ),
					'live' => true,
				),
			)
		),

		'fonts' => array(
			'title' => esc_html__( 'Fonts', 'siteorigin-unwind' ),
			'fields' => array(
				'details' => array(
					'type' => 'font',
					'label' => esc_html__( 'Details font', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Used for smaller details.', 'siteorigin-unwind' ),
					'live' => true,
				),
				'main' => array(
					'type' => 'font',
					'label' => esc_html__( 'Main font', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Used for body text.', 'siteorigin-unwind' ),
					'live' => true,
				),
				'headings' => array(
					'type' => 'font',
					'label' => esc_html__( 'Headings font', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Used for headings.', 'siteorigin-unwind' ),
					'live' => true,
				),
				'text_light' => array(
					'type' => 'color',
					'label' => esc_html__( 'Light Text Color', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Used for smaller details.', 'siteorigin-unwind' ),
					'live' => true,
				),
				'text_medium' => array(
					'type' => 'color',
					'label' => esc_html__( 'Medium Text Color', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Used for body text.', 'siteorigin-unwind' ),
					'live' => true,
				),

				'text_dark' => array(
					'type' => 'color',
					'label' => esc_html__( 'Dark Text Color', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Used for headings.', 'siteorigin-unwind' ),
					'live' => true,
				),
			),
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
					'description' => esc_html__( 'Add social icons to the menu.', 'siteorigin-unwind' ),
				),
				'padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Header Padding', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Top and bottom header padding.', 'siteorigin-unwind' ),
					'live'	=> true,
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
				'search' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Menu search', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Display search in main menu.', 'siteorigin-unwind' ),
				),
				'sticky' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Sticky menu', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Stick menu to top of screen.', 'siteorigin-unwind' ),
				),
				'mobile_menu_collapse' => array(
					'label'       => esc_html__( 'Mobile Menu Collapse', 'siteorigin-unwind' ),
					'type'        => 'number',
					'description' => esc_html__( 'The screen width in pixels when the primary menu changes to a mobile menu.', 'siteorigin-unwind' )
				),
				'post' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post navigation', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Display next and previous post navigation.', 'siteorigin-unwind' ),
				),
			),
		),

		'icons' => array(
			'title' => esc_html__( 'Icons', 'siteorigin-unwind' ),
			'fields' => array(
				'menu' => array(
					'type' => 'media',
					'label' => esc_html__( 'Mobile menu icon', 'siteorigin-unwind' ),
				),
				'fullscreen_search' => array(
					'type' => 'media',
					'label' => esc_html__( 'Fullscreen search icon', 'siteorigin-unwind' ),
				),
				'search' => array(
					'type' => 'media',
					'label' => esc_html__( 'Menu search icon', 'siteorigin-unwind' ),
				),
				'close_search' => array(
					'type' => 'media',
					'label' => esc_html__( 'Menu close search icon', 'siteorigin-unwind' ),
				),
			),
		),

		'layout' => array(
			'title' => esc_html__( 'Layout', 'siteorigin-unwind' ),
			'fields' => array(
				'main_sidebar'	=> array(
					'type'	=> 'select',
					'label'	=> esc_html__( 'Main Sidebar Position', 'siteorigin-unwind' ),
					'options' => array(
						'right' => esc_html__( 'Right', 'siteorigin-unwind' ),
						'left'  => esc_html__( 'Left', 'siteorigin-unwind' ),
					),
				),
			)
		),

		'blog' => array(
			'title' => esc_html__( 'Blog', 'siteorigin-unwind' ),
			'fields' => array(
				'featured_slider' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Jetpack Featured Content slider on blog home page.', 'siteorigin-unwind' ),
				),
				'featured_slider_overlay' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Jetpack Featured Content slider image overlay. Also applies to slider in Post Loop widget.', 'siteorigin-unwind' ),
				),
				'featured_archive' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Featured image on archive pages.', 'siteorigin-unwind' ),
				),
				'featured_single' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Featured image on single post.', 'siteorigin-unwind' ),
				),
				'archive_content'	=> array(
					'type'	=> 'select',
					'label'	=> esc_html__( 'Post Content', 'siteorigin-unwind' ),
					'options' => array(
						'full' => esc_html__( 'Full Post', 'siteorigin-unwind' ),
						'excerpt'  => esc_html__( 'Post Excerpt', 'siteorigin-unwind' ),
					),
					'description' => esc_html__('Choose how to display your post content on the blog and archive pages. Select Full Post if using the "more" quicktag.', 'siteorigin-unwind'),
				),
				'display_date' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Date on single and archive posts.', 'siteorigin-unwind' ),
				),
				'display_category' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Categories on single and archive posts.', 'siteorigin-unwind' ),
				),
				'display_comments' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Comments link on single and archive posts.', 'siteorigin-unwind' ),
				),
				'display_tags' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Tags on single posts.', 'siteorigin-unwind' ),
				),
				'display_related_posts' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Related posts on single post.', 'siteorigin-unwind' ),
				),
				'display_author_box' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Author box on single post.', 'siteorigin-unwind' ),
				),
				'search_fallback' => array(
					'type' => 'media',
					'label' => esc_html__( 'Search fallback image', 'siteorigin-unwind' ),
					'description' => esc_html__( "Used for blog posts with no featured image.", 'siteorigin-unwind' ),
				),
			)
		),

		'footer' => array(
			'title' => esc_html__( 'Footer', 'siteorigin-unwind' ),
			'fields' => array(

				'text' => array(
					'type' => 'text',
					'label' => esc_html__( 'Footer Text', 'siteorigin-unwind' ),
					'description' => esc_html__( "{sitename} and {year} are your site's name and current year.", 'siteorigin-unwind' ),
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

				'top_margin' => array(
					'type' => 'measurement',
					'label' => esc_html__( 'Top Margin', 'siteorigin-unwind' ),
					'live' => true,
				),
			),
		),

	) ) );
}
add_action( 'siteorigin_settings_init', 'siteorigin_unwind_settings_init' );

function siteorigin_unwind_woocommerce_settings( $settings ) {
	if ( ! function_exists( 'is_woocommerce' ) ) return $settings;

	$wc_settings = array(
		'woocommerce' => array(
			'title' => esc_html__( 'WooCommerce', 'siteorigin-unwind' ),
			'fields' => array(

				'display_quick_view' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Display quick view button on hover.', 'siteorigin-unwind' ),
				),
				'display_mini_cart' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Display Cart', 'siteorigin-unwind' ),
					'description' => esc_html__( 'Display WooCommerce cart in the main menu', 'siteorigin-unwind' ),
				),
				'shop_sidebar' => array(
					'type' => 'select',
					'label' => esc_html__( 'Shop Sidebar Position', 'siteorigin-unwind' ),
					'options' => array(
						'left' => esc_html__( 'Left', 'siteorigin-unwind' ),
						'right' => esc_html__( 'Right', 'siteorigin-unwind' ),
					),
				),

			)
		)
	);

	return array_merge( $settings, $wc_settings );
}
add_filter( 'siteorigin_unwind_settings_array', 'siteorigin_unwind_woocommerce_settings' );

/**
 * Tell the settings framework which settings we're using as fonts.
 *
 * @param $settings
 *
 * @return array
 */
function siteorigin_unwind_font_settings( $settings ) {

	$settings['fonts_details']  = array(
		'name'    => 'Lato',
		'weights' => array(
			300,
			400
		),
	);
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
			700
		),
	);

	return $settings;
}
add_filter( 'siteorigin_settings_font_settings', 'siteorigin_unwind_font_settings' );

/**
 * Add custom CSS for the theme settings.
 *
 * @param $css
 *
 * @return string
 */
function siteorigin_unwind_settings_custom_css( $css ) {
// Custom CSS Code
$css .= '/* style */
	/**** /private/var/folders/_s/htpl50fd5d70c9hb2nnvjnjh0000gn/T/7HaA1B/sass/style.css ***/
	body,button,input,select,textarea {
	color: ${fonts_text_medium};
	.font( ${fonts_main} );
	}
	h1,h2,h3,h4,h5,h6 {
	color: ${fonts_text_dark};
	.font( ${fonts_headings} );
	}
	blockquote {
	border-left: 3px solid ${branding_accent};
	}
	abbr,acronym {
	border-bottom: 1px dotted ${fonts_text_medium};
	}
	table {
	.font( ${fonts_details} );
	}
	table thead th {
	color: ${fonts_text_dark};
	}
	.button,#page #infinite-handle span button,button,input[type="button"],input[type="reset"],input[type="submit"],.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce #page #infinite-handle span button,#page #infinite-handle span .woocommerce button,.woocommerce input.button,.woocommerce.single-product .cart button {
	color: ${fonts_text_dark};
	.font( ${fonts_details} );
	}
	.button:hover,#page #infinite-handle span button:hover,button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce #page #infinite-handle span button:hover,#page #infinite-handle span .woocommerce button:hover,.woocommerce input.button:hover,.woocommerce.single-product .cart button:hover {
	border-color: ${branding_accent};
	color: ${branding_accent};
	}
	.button:active,#page #infinite-handle span button:active,.button:focus,#page #infinite-handle span button:focus,button:active,button:focus,input[type="button"]:active,input[type="button"]:focus,input[type="reset"]:active,input[type="reset"]:focus,input[type="submit"]:active,input[type="submit"]:focus,.woocommerce #respond input#submit:active,.woocommerce #respond input#submit:focus,.woocommerce a.button:active,.woocommerce a.button:focus,.woocommerce button.button:active,.woocommerce #page #infinite-handle span button:active,#page #infinite-handle span .woocommerce button:active,.woocommerce button.button:focus,.woocommerce #page #infinite-handle span button:focus,#page #infinite-handle span .woocommerce button:focus,.woocommerce input.button:active,.woocommerce input.button:focus,.woocommerce.single-product .cart button:active,.woocommerce.single-product .cart button:focus {
	border-color: ${branding_accent};
	color: ${branding_accent};
	}
	input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="range"],input[type="date"],input[type="month"],input[type="week"],input[type="time"],input[type="datetime"],input[type="datetime-local"],input[type="color"],textarea {
	color: ${fonts_text_light};
	}
	input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="search"]:focus,input[type="number"]:focus,input[type="tel"]:focus,input[type="range"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="week"]:focus,input[type="time"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="color"]:focus,textarea:focus {
	color: ${fonts_text_medium};
	}
	a {
	color: ${branding_accent};
	}
	a:hover,a:focus {
	color: ${branding_accent_dark};
	}
	.main-navigation ul ul a {
	.font( ${fonts_main} );
	}
	.main-navigation li a {
	color: ${fonts_text_medium};
	.font( ${fonts_details} );
	}
	.main-navigation li:hover > a,.main-navigation li.focus > a {
	color: ${fonts_text_dark};
	}
	.social-search .search-toggle .open .svg-icon-search path {
	fill: ${fonts_text_medium};
	}
	.social-search .search-toggle .close .svg-icon-close path {
	fill: ${fonts_text_medium};
	}
	.menu-toggle .svg-icon-menu path {
	fill: ${fonts_text_medium};
	}
	#mobile-navigation ul li a {
	color: ${fonts_text_medium};
	.font( ${fonts_details} );
	}
	#mobile-navigation ul li .dropdown-toggle .svg-icon-submenu path {
	fill: ${fonts_text_medium};
	}
	.comment-navigation a,.posts-navigation a,.post-navigation a {
	color: ${fonts_text_medium};
	}
	.comment-navigation a:hover,.posts-navigation a:hover,.post-navigation a:hover {
	border-color: ${branding_accent};
	color: ${branding_accent};
	}
	.posts-navigation .nav-links,.comment-navigation .nav-links {
	font-family: ${fonts_details} !important;
	}
	.pagination .page-numbers {
	color: ${fonts_text_medium};
	}
	.pagination .page-numbers:hover {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	.pagination .dots:hover {
	color: ${fonts_text_medium};
	}
	.pagination .current {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	.pagination .next,.pagination .prev {
	.font( ${fonts_details} );
	}
	.post-navigation {
	.font( ${fonts_main} );
	}
	.post-navigation a {
	color: ${fonts_text_medium};
	}
	.post-navigation a:hover {
	color: ${branding_accent};
	}
	.post-navigation a .sub-title {
	color: ${fonts_text_light};
	.font( ${fonts_details} );
	}
	.breadcrumbs,.woocommerce .woocommerce-breadcrumb {
	color: ${fonts_text_light};
	.font( ${fonts_details} );
	}
	.breadcrumbs a,.woocommerce .woocommerce-breadcrumb a {
	color: ${fonts_text_dark};
	}
	.breadcrumbs a:hover,.woocommerce .woocommerce-breadcrumb a:hover {
	color: ${branding_accent};
	}
	.breadcrumbs .breadcrumb_last,.woocommerce .woocommerce-breadcrumb .breadcrumb_last {
	color: ${fonts_text_light};
	}
	#secondary .widget .widget-title,#colophon .widget .widget-title {
	color: ${fonts_text_medium};
	}
	#secondary .widget a,#colophon .widget a {
	color: ${fonts_text_medium};
	}
	#secondary .widget a:hover,#colophon .widget a:hover {
	color: ${branding_accent};
	}
	.widget_categories {
	color: ${fonts_text_light};
	}
	.widget_categories a {
	color: ${fonts_text_medium};
	}
	.widget_categories a:hover {
	color: ${fonts_text_dark};
	}
	.widget #wp-calendar caption {
	color: ${fonts_text_dark};
	.font( ${fonts_main} );
	}
	.widget #wp-calendar tfoot #prev a,.widget #wp-calendar tfoot #next a {
	color: ${branding_accent};
	}
	.widget #wp-calendar tfoot #prev a:hover,.widget #wp-calendar tfoot #next a:hover {
	color: ${branding_accent_dark};
	}
	.widget_recent_entries .post-date {
	color: ${fonts_text_light};
	}
	.recent-posts-extended h3 {
	color: ${fonts_text_medium};
	}
	.recent-posts-extended h3 a:hover {
	color: ${fonts_text_dark};
	}
	.recent-posts-extended time {
	color: ${fonts_text_light};
	}
	#secondary .widget_search .search-form button[type="submit"] svg,#colophon .widget_search .search-form button[type="submit"] svg {
	fill: ${fonts_text_medium};
	}
	#page .widget_tag_cloud a {
	color: ${fonts_text_medium};
	}
	#page .widget_tag_cloud a:hover {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	#masthead {
	margin-bottom: ${masthead_bottom_margin};
	}
	#masthead .site-branding {
	padding: ${masthead_padding} 0;
	}
	#masthead .site-branding .site-title {
	.font( ${fonts_details} );
	}
	#masthead .site-branding .site-title a {
	color: ${fonts_text_dark};
	}
	#fullscreen-search h3 {
	color: ${fonts_text_medium};
	.font( ${fonts_details} );
	}
	#fullscreen-search form input[type="search"] {
	color: ${fonts_text_medium};
	}
	#fullscreen-search form button[type="submit"] svg {
	fill: ${fonts_text_light};
	}
	@-webkit-keyframes "spin" {
	from {
	}
	to {
	}
	}
	@-moz-keyframes "spin" {
	from {
	}
	to {
	}
	}
	@keyframes "spin" {
	from {
	}
	to {
	}
	}
	.entry-meta,.flexslider.featured-posts-slider .featured-posts-slides .featured-post-slide .slide-content .entry-meta {
	.font( ${fonts_details} );
	}
	.entry-meta span,.flexslider.featured-posts-slider .featured-posts-slides .featured-post-slide .slide-content .entry-meta span {
	color: ${fonts_text_light};
	}
	.entry-meta span a:hover,.flexslider.featured-posts-slider .featured-posts-slides .featured-post-slide .slide-content .entry-meta span a:hover {
	color: ${branding_accent};
	}
	.entry-title {
	color: ${fonts_text_dark};
	}
	.entry-title a:hover {
	color: ${fonts_text_medium};
	}
	.more-link {
	color: ${fonts_text_dark};
	}
	.more-link .more-text {
	.font( ${fonts_details} );
	}
	.more-link .more-text:hover {
	border: 2px solid ${branding_accent};
	}
	.page-links .page-links-title {
	color: ${fonts_text_dark};
	}
	.page-links span:not(.page-links-title) {
	background: ${branding_accent};
	border: 1px solid ${branding_accent};
	}
	.page-links .page-links-title ~ a span {
	color: ${fonts_text_medium};
	}
	.page-links .page-links-title ~ a span:hover {
	background: ${branding_accent};
	border: 1px solid ${branding_accent};
	}
	.tags-list a {
	color: ${fonts_text_medium};
	}
	.tags-list a:hover {
	background: ${fonts_text_medium};
	}
	.archive .container > .page-header,.search .container > .page-header {
	margin-bottom: ${masthead_bottom_margin};
	}
	.archive .container > .page-header .page-title,.search .container > .page-header .page-title {
	.font( ${fonts_details} );
	}
	.page-title {
	color: ${fonts_text_dark};
	}
	.content-area .search-form button[type="submit"] svg {
	fill: ${fonts_text_medium};
	}
	.yarpp-related ol li .related-post-title:hover,.related-posts-section ol li .related-post-title:hover {
	color: ${fonts_text_medium};
	}
	.yarpp-related ol li .related-post-date,.related-posts-section ol li .related-post-date {
	color: ${fonts_text_light};
	}
	.author-box .author-description {
	color: ${fonts_text_medium};
	}
	.author-box .author-description .post-author-title a {
	color: ${fonts_text_dark};
	}
	.author-box .author-description .post-author-title a:hover {
	color: ${fonts_text_medium};
	}
	.comment-list li.comment {
	color: ${fonts_text_medium};
	}
	.comment-list li.comment .author {
	color: ${fonts_text_dark};
	}
	.comment-list li.comment .author a {
	color: ${fonts_text_dark};
	}
	.comment-list li.comment .author a:hover {
	color: ${fonts_text_medium};
	}
	.comment-list li.comment .date {
	color: ${fonts_text_light};
	}
	.comment-list li.comment .comment-reply-link {
	color: ${fonts_text_dark};
	.font( ${fonts_details} );
	}
	.comment-list li.comment .comment-reply-link:hover {
	color: ${branding_accent};
	}
	.comment-reply-title #cancel-comment-reply-link {
	color: ${fonts_text_light};
	.font( ${fonts_details} );
	}
	.comment-reply-title #cancel-comment-reply-link:hover {
	color: ${branding_accent};
	}
	#commentform label {
	color: ${fonts_text_dark};
	}
	#commentform .comment-notes a,#commentform .logged-in-as a {
	color: ${fonts_text_medium};
	}
	#commentform .comment-notes a:hover,#commentform .logged-in-as a:hover {
	color: ${fonts_text_dark};
	}
	#commentform .comment-subscription-form label {
	color: ${fonts_text_medium};
	}
	#colophon {
	margin-top: ${footer_top_margin};
	}
	#colophon .widgets {
	padding: ${footer_top_padding} 0;
	}
	#colophon .site-info {
	color: ${fonts_text_medium};
	}
	#colophon .site-info a:hover {
	color: ${fonts_text_dark};
	}
	#colophon.unconstrained-footer .container {
	padding: 0 ${footer_side_padding};
	}
	.flexslider.featured-posts-slider .featured-posts-slides .featured-post-slide .slide-content .entry-button .button:hover,.flexslider.featured-posts-slider .featured-posts-slides .featured-post-slide .slide-content .entry-button #page #infinite-handle span button:hover,#page #infinite-handle span .flexslider.featured-posts-slider .featured-posts-slides .featured-post-slide .slide-content .entry-button button:hover {
	color: ${fonts_text_dark};
	}
	/* woocommerce */
	/**** /private/var/folders/_s/htpl50fd5d70c9hb2nnvjnjh0000gn/T/7HaA1B/sass/woocommerce.css ***/
	.woocommerce a.button,.woocommerce a.button.alt,.woocommerce.single-product .cart button {
	background-color: ${branding_accent};
	border: 1px solid ${branding_accent};
	}
	.woocommerce a.button:hover,.woocommerce a.button.alt:hover,.woocommerce.single-product .cart button:hover {
	background-color: ${branding_accent_dark};
	border-color: ${branding_accent_dark};
	}
	.woocommerce a.button:active,.woocommerce a.button:focus,.woocommerce a.button.alt:active,.woocommerce a.button.alt:focus,.woocommerce.single-product .cart button:active,.woocommerce.single-product .cart button:focus {
	border-color: ${branding_accent};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper {
	color: ${fonts_text_medium};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper svg path {
	fill: ${fonts_text_medium};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper:hover {
	color: ${fonts_text_dark};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper:hover .north-icon-next {
	color: ${fonts_text_dark};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper:hover path {
	fill: ${fonts_text_dark};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper .ordering-dropdown li {
	color: ${fonts_text_light};
	}
	.woocommerce .woocommerce-ordering .ordering-selector-wrapper .ordering-dropdown li:hover {
	color: ${fonts_text_dark};
	}
	.woocommerce .woocommerce-result-count {
	color: ${fonts_text_medium};
	}
	.woocommerce ul.products li.product span.onsale {
	background-color: ${branding_accent};
	.font( ${fonts_details} );
	}
	.woocommerce ul.products li.product h3:hover {
	color: ${fonts_text_medium};
	}
	.woocommerce ul.products li.product .price {
	color: ${branding_accent};
	}
	.woocommerce ul.products li.product .price del {
	color: ${fonts_text_light};
	}
	.woocommerce ul.products li.product .price ins {
	color: ${branding_accent};
	}
	.woocommerce ul.products li.product .loop-product-thumbnail {
	background: ${branding_accent_dark};
	}
	.woocommerce ul.products li.product .loop-product-thumbnail .add_to_cart_button {
	color: ${fonts_text_dark};
	}
	.woocommerce ul.products li.product .loop-product-thumbnail .add_to_cart_button:hover {
	border: 2px solid ${fonts_text_dark};
	}
	.woocommerce ul.products li.product .loop-product-thumbnail .product-quick-view-button:hover {
	color: ${fonts_text_dark};
	}
	.woocommerce ul.products li.product .loop-product-thumbnail a.added_to_cart {
	color: ${fonts_text_medium};
	.font( ${fonts_details} );
	}
	.woocommerce ul.products li.product .loop-product-thumbnail a.added_to_cart:hover {
	border: 2px solid ${fonts_text_dark};
	}
	.woocommerce .woocommerce-pagination .page-numbers li a,.woocommerce .woocommerce-pagination .page-numbers li span {
	color: ${fonts_text_medium};
	}
	.woocommerce .woocommerce-pagination .page-numbers li a:hover,.woocommerce .woocommerce-pagination .page-numbers li span:hover {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	.woocommerce .woocommerce-pagination .page-numbers li .current {
	background: ${branding_accent};
	border: 1px solid ${branding_accent};
	}
	.woocommerce .woocommerce-pagination .page-numbers li .current:hover {
	background: ${branding_accent};
	}
	.woocommerce .woocommerce-pagination .page-numbers li .current {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	.woocommerce.single-product #content div.product .star-rating span:before {
	color: ${branding_accent};
	}
	.woocommerce.single-product #content div.product span.onsale {
	background-color: ${branding_accent};
	.font( ${fonts_details} );
	}
	.woocommerce.single-product #content div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link {
	color: ${fonts_text_light};
	}
	.woocommerce.single-product #content div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:hover {
	color: ${branding_accent};
	}
	.woocommerce.single-product #content div.product .entry-summary .price del,.woocommerce.single-product #content div.product .entry-summary .price del .amount {
	color: ${fonts_text_light};
	}
	.woocommerce.single-product #content div.product .entry-summary .price .amount,.woocommerce.single-product #content div.product .entry-summary .price ins {
	color: ${branding_accent};
	}
	.woocommerce.single-product #content div.product .entry-summary .cart .variations {
	.font( ${fonts_main} );
	}
	.woocommerce.single-product #content div.product .entry-summary .cart .quantity.button-controls .qty {
	border-color: ${fonts_text_light};
	color: ${fonts_text_medium};
	}
	.woocommerce.single-product #content div.product .entry-summary .cart .quantity.button-controls .add,.woocommerce.single-product #content div.product .entry-summary .cart .quantity.button-controls .subtract {
	border-color: ${fonts_text_light};
	}
	.woocommerce.single-product #content div.product .entry-summary .cart .quantity.button-controls .add:hover,.woocommerce.single-product #content div.product .entry-summary .cart .quantity.button-controls .subtract:hover {
	background: ${fonts_text_medium};
	}
	.woocommerce.single-product #content div.product .entry-summary .product_meta span {
	color: ${fonts_text_light};
	}
	.woocommerce.single-product #content div.product .entry-summary .product_meta span a {
	color: ${fonts_text_dark};
	}
	.woocommerce.single-product #content div.product .woocommerce-tabs .wc-tabs li {
	.font( ${fonts_details} );
	}
	.woocommerce.single-product #content div.product .woocommerce-tabs .wc-tabs li.active {
	border-bottom: 2px solid ${fonts_text_medium};
	}
	.woocommerce.single-product #content div.product .woocommerce-tabs .wc-tabs li.active a {
	color: ${fonts_text_dark};
	}
	.woocommerce.single-product #content div.product .woocommerce-tabs .wc-tabs li a {
	color: ${fonts_text_light};
	}
	.woocommerce.single-product #content div.product #reviews #comments ol.commentlist li.comment .comment_container .comment-text .comment-meta {
	color: ${fonts_text_light};
	}
	.woocommerce.single-product #content div.product #reviews #comments ol.commentlist li.comment .comment_container .comment-text .comment-meta .comment-author {
	color: ${fonts_text_dark};
	}
	.woocommerce.single-product #content div.product #reviews #comments ol.commentlist li.comment .comment_container .comment-text .comment-meta .comment-date {
	color: ${fonts_text_light};
	}
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
	.woocommerce-cart table.shop_table {
	.font( ${fonts_main} );
	}
	.woocommerce-cart table.shop_table thead {
	.font( ${fonts_details} );
	}
	.woocommerce-cart table.shop_table tbody td {
	color: ${fonts_text_dark};
	}
	.woocommerce-cart table.shop_table tbody .product-remove a {
	color: ${fonts_text_light} !important;
	}
	.woocommerce-cart table.shop_table tbody .product-remove a:hover,.woocommerce-cart table.shop_table tbody .product-remove a:focus {
	color: .darken( ${fonts_text_light}, 25%) !important;
	}
	.woocommerce-cart table.shop_table tbody .product-name a {
	color: ${fonts_text_dark};
	}
	.woocommerce-cart table.shop_table tbody .quantity.button-controls .qty {
	border-color: ${fonts_text_light};
	color: ${fonts_text_medium};
	.font( ${fonts_details} );
	}
	.woocommerce-cart table.shop_table tbody .quantity.button-controls .add,.woocommerce-cart table.shop_table tbody .quantity.button-controls .subtract {
	border-color: ${fonts_text_light};
	}
	.woocommerce-cart table.shop_table tbody .quantity.button-controls .add:hover,.woocommerce-cart table.shop_table tbody .quantity.button-controls .subtract:hover {
	color: ${fonts_text_medium};
	}
	.woocommerce-cart table.shop_table td.actions input.button {
	background-color: ${branding_accent};
	}
	.woocommerce-cart table.shop_table td.actions input.button:hover {
	background: ${branding_accent_dark};
	}
	.cart-collaterals .cart_totals table tr th {
	color: ${fonts_text_dark};
	}
	.cart-collaterals .cart_totals table tr.shipping .shipping-calculator-form .shipping-calculator-button {
	color: ${branding_accent};
	}
	.cart-collaterals .cart_totals table tr.shipping .shipping-calculator-form .shipping-calculator-button:hover {
	color: ${branding_accent};
	}
	.cart-collaterals .cart_totals table tr.shipping .shipping-calculator-form .button {
	background-color: ${branding_accent};
	}
	.cart-collaterals .cart_totals table tr.shipping .shipping-calculator-form .button:hover {
	background-color: ${branding_accent};
	}
	.woocommerce .widget-area#secondary .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget-area#secondary .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: ${branding_accent};
	}
	.woocommerce .widget-area#secondary .widget_price_filter .price_slider_amount .button {
	color: ${fonts_text_medium};
	}
	.woocommerce .widget-area#secondary .widget_price_filter .price_slider_amount .button:hover {
	border-color: ${branding_accent_dark};
	color: ${branding_accent_dark};
	}
	.woocommerce .widget-area#secondary .widget_product_tag_cloud a {
	color: ${fonts_text_medium};
	}
	.woocommerce .widget-area#secondary .widget_product_tag_cloud a:hover {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	.woocommerce .widget-area#secondary .widget_products .product_list_widget li .amount,.woocommerce .widget-area#secondary .widget_recent_reviews .product_list_widget li .amount,.woocommerce .widget-area#secondary .widget_top_rated_products .product_list_widget li .amount {
	color: ${branding_accent};
	}
	.woocommerce .widget-area#secondary .widget_products .product_list_widget li del,.woocommerce .widget-area#secondary .widget_recent_reviews .product_list_widget li del,.woocommerce .widget-area#secondary .widget_top_rated_products .product_list_widget li del {
	color: ${fonts_text_light};
	}
	.woocommerce .widget-area#secondary .widget_products .product_list_widget li del .amount,.woocommerce .widget-area#secondary .widget_recent_reviews .product_list_widget li del .amount,.woocommerce .widget-area#secondary .widget_top_rated_products .product_list_widget li del .amount {
	color: ${fonts_text_light};
	}
	.woocommerce .widget-area#secondary .widget_product_search .search-form button[type="submit"] svg {
	fill: ${fonts_text_medium};
	}
	.woocommerce .widget-area#secondary .widget_shopping_cart li .quantity .amount {
	color: ${branding_accent};
	}
	.woocommerce .widget-area#secondary .widget_shopping_cart li .remove {
	color: ${fonts_text_light} !important;
	}
	.woocommerce .widget-area#secondary .widget_shopping_cart li .remove:hover {
	color: ${fonts_text_dark} !important;
	}
	.woocommerce .widget-area#secondary .widget_shopping_cart .buttons .button.checkout {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	.woocommerce .widget-area#secondary .widget_shopping_cart .buttons .button.checkout:hover {
	background: ${branding_accent_dark};
	border-color: ${branding_accent_dark};
	}
	.woocommerce .widget-area#secondary .widget_layered_nav li a:before {
	color: ${fonts_text_light} !important;
	}
	.woocommerce .widget-area#secondary .widget_layered_nav li a:hover:before {
	color: ${fonts_text_dark} !important;
	}
	.woocommerce .widget-area#secondary .widget_layered_nav_filters li a:before {
	color: ${fonts_text_light} !important;
	}
	.woocommerce .widget-area#secondary .widget_layered_nav_filters li a:hover:before {
	color: ${fonts_text_dark} !important;
	}
	.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper .price {
	color: ${branding_accent};
	.font( ${fonts_details} );
	}
	.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper .price del,.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper .price del .amount {
	color: ${fonts_text_light};
	}
	.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper .price .amount,.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper .price ins {
	color: ${branding_accent};
	}
	.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper .quantity.button-controls .qty {
	border-color: ${fonts_text_light};
	color: ${fonts_text_medium};
	}
	.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper .quantity.button-controls .add,.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper .quantity.button-controls .subtract {
	border-color: ${fonts_text_light};
	}
	.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper button {
	background-color: ${branding_accent};
	}
	.woocommerce #quick-view-container .product-content-wrapper .product-info-wrapper button:hover {
	background-color: ${branding_accent_dark};
	}';
	return $css;
}
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_unwind_settings_custom_css' );

if ( ! function_exists( 'siteorigin_unwind_menu_breakpoint_css' ) ) :
/**
 * Add CSS for mobile menu breakpoint.
 */
function siteorigin_unwind_menu_breakpoint_css( $css, $settings ) {
	$breakpoint = isset( $settings[ 'theme_settings_navigation_mobile_menu_collapse' ] ) ? $settings[ 'theme_settings_navigation_mobile_menu_collapse' ] : 768;

	$css .= '@media screen and (max-width: ' . intval( $breakpoint ) . 'px) {
		.main-navigation .menu-toggle {
			display: block;
		}
		.main-navigation > div,
		.main-navigation > div ul,
		.main-navigation .shopping-cart {
			display: none;
		}
	}
	@media screen and (min-width: ' . ( 1 + $breakpoint ) . 'px) {
		#mobile-navigation {
			display: none !important;
		}
		.main-navigation > div ul {
			display: block;
		}
		.main-navigation .shopping-cart {
			display: inline-block;
		}
		.main-navigation .menu-toggle {
			display: none;
		}
	}';
	return $css;
}
endif;
add_filter( 'siteorigin_settings_custom_css', 'siteorigin_unwind_menu_breakpoint_css', 10, 2 );

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
	$defaults['branding_attribution']      = true;
	$defaults['branding_accent']           = '#24c48a';
	$defaults['branding_accent_dark']      = '#00a76a';

	// Font defaults.
	$defaults['fonts_text_light']  = '#adadad';
	$defaults['fonts_text_medium'] = '#626262';
	$defaults['fonts_text_dark']   = '#2d2d2d';

	// The masthead defaults.
	$defaults['masthead_social_widget'] = '';
	$defaults['masthead_padding']       = '60px';
	$defaults['masthead_bottom_margin'] = '80px';

	// Navigation defaults.
	$defaults['navigation_search']               = true;
	$defaults['navigation_sticky']               = true;
	$defaults['navigation_mobile_menu_collapse'] = 768;
	$defaults['navigation_post']                 = true;

	// Icons.
	$defaults['icons_menu']              = false;
	$defaults['icons_fullscreen_search'] = false;
	$defaults['icons_search']            = false;
	$defaults['icons_close_search']      = false;

	// Layout
	$defaults['layout_main_sidebar'] = 'right';

	// Blog settings.
	$defaults['blog_featured_slider']         = false;
	$defaults['blog_featured_slider_overlay'] = false;
	$defaults['blog_featured_archive']        = true;
	$defaults['blog_featured_single']         = true;
	$defaults['blog_archive_content']         = 'full';
	$defaults['blog_display_related_posts']   = true;
	$defaults['blog_display_author_box']      = true;
	$defaults['blog_display_date']            = true;
	$defaults['blog_display_category']        = true;
	$defaults['blog_display_comments']        = true;
	$defaults['blog_display_tags']            = true;
	$defaults['blog_search_fallback']         = false;

	// Footer settings.
	$defaults['footer_text']         = esc_html__( '{year} &copy; {sitename}.', 'siteorigin-unwind' );
	$defaults['footer_constrained']  = true;
	$defaults['footer_top_padding']  = '80px';
	$defaults['footer_side_padding'] = '40px';
	$defaults['footer_top_margin']   = '80px';

	// WooCommerce
	$defaults['woocommerce_display_quick_view'] = true;
	$defaults['woocommerce_display_mini_cart']  = true;
	$defaults['woocommerce_shop_sidebar']       = 'left';

	return $defaults;
}
add_filter( 'siteorigin_settings_defaults', 'siteorigin_unwind_settings_defaults' );

/**
 * Setup Page Settings.
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
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Display the page title.', 'siteorigin-unwind' )
	);

	$settings['masthead_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header Bottom Margin', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Display the margin below the header.', 'siteorigin-unwind' )
	);

	$settings['footer_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Top Margin', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Display the margin above the footer.', 'siteorigin-unwind' )
	);

	$settings['display_masthead'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Display the header.', 'siteorigin-unwind' )
	);

	$settings['display_footer_widgets'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Widgets', 'siteorigin-unwind' ),
		'checkbox_label' => esc_html__( 'Enable', 'siteorigin-unwind' ),
		'description'    => esc_html__( 'Display the footer widgets.', 'siteorigin-unwind' )
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

	if ( function_exists( 'is_woocommerce' ) && ( is_cart() || is_checkout() || is_checkout_pay_page() ) ) {
		// Default layouts for WooCommerce pages
		$settings['layout'] = 'no-sidebar';
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

function siteorigin_unwind_about_page_sections( $about ) {
	$about['documentation_url'] = 'https://siteorigin.com/unwind-documentation/';

	$about[ 'video_thumbnail' ] = array(
		get_template_directory_uri() . '/admin/about/stills/still-1.jpg',
	);

	$about['description'] = __( "Unwind changes the rules when it comes to WooCommerce. We're giving you loads of features that are typically only found premium WooCommerce themes.", 'siteorigin-unwind' );

	$about[ 'review' ] = true;

	$about[ 'sections' ] = array(
		'free',
		'woocommerce',
		'support',
		'page-builder',
		'github',
	);

	return $about;
}
add_filter( 'siteorigin_about_page', 'siteorigin_unwind_about_page_sections' );

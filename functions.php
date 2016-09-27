<?php
/**
 * SiteOrigin Unwind functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package siteorigin-unwind
 */

define( 'SITEORIGIN_THEME_VERSION', 'dev' );
define( 'SITEORIGIN_THEME_JS_PREFIX', '' );
define( 'SITEORIGIN_THEME_PREMIUM_URL', 'https://siteorigin.com/downloads/premium/' );

// The settings manager.
include get_template_directory() . '/inc/settings/settings.php';

if ( ! function_exists( 'siteorigin_unwind_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function siteorigin_unwind_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on siteorigin_unwind, use a find and replace
	 * to change 'siteorigin-unwind' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'siteorigin-unwind', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'siteorigin-unwind' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'image',
		'video',
	) );

	// Adding custom image sizes.
	add_image_size( 'siteorigin-unwind-related-post', 300 , 200, true );
	add_image_size( 'siteorigin-unwind-medium-featured', 360 , 238, true );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'siteorigin_unwind_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// This theme supports WooCommerce.
	add_theme_support( 'woocommerce' );

	if ( ! defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
		// Only include panels lite if the panels plugin doesn't exist.
		include get_template_directory() . '/inc/panels-lite/panels-lite.php';
	}

	add_theme_support( 'siteorigin-panels', array(
		// 'responsive' => siteorigin_setting( 'layout_responsive' ),
	) );
}
endif; // siteorigin_unwind_setup.
add_action( 'after_setup_theme', 'siteorigin_unwind_setup' );

/**
 * Add support for premium theme components.
 */
function siteorigin_unwind_premium_setup() {

	// This theme supports the no attribution addon.
	add_theme_support( 'siteorigin-premium-no-attribution', array(
		'filter' => 'siteorigin_unwind_footer_credits',
		'enabled' => siteorigin_setting( 'branding_attribution' )
	) );
}
add_action( 'after_setup_theme', 'siteorigin_unwind_premium_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function siteorigin_unwind_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'siteorigin_unwind_content_width', 848 );
}
add_action( 'after_setup_theme', 'siteorigin_unwind_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function siteorigin_unwind_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'siteorigin-unwind' ),
		'id'            => 'main-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'siteorigin-unwind' ),
		'id'            => 'footer-sidebar',
		'description'   => '',
		'before_widget' => '<div class="widget-wrapper"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'siteorigin_unwind_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function siteorigin_unwind_scripts() {
	wp_enqueue_style( 'siteorigin_unwind-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'siteorigin_unwind-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'siteorigin-unwind-script', get_template_directory_uri() . '/js/unwind.js', array('jquery') );

	wp_enqueue_script( 'siteorigin-unwind-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'siteorigin_unwind_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load the theme settings file
 */
require get_template_directory() . '/inc/settings.php';

/**
 * Support for SiteOrigin Page Builder
 */
// require get_template_directory() . '/inc/siteorigin-panels.php';

/**
 * Load support for WooCommerce
 */
include get_template_directory() . '/woocommerce/functions.php';

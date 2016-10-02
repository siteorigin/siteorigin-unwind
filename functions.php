<?php
/**
 * SiteOrigin Unwind functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

define( 'SITEORIGIN_THEME_VERSION', 'dev' );
define( 'SITEORIGIN_THEME_JS_PREFIX', '' );

// Load theme specific files.
include get_template_directory() . '/inc/settings/settings.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/settings.php';
require get_template_directory() . '/inc/template-tags.php';
include get_template_directory() . '/woocommerce/functions.php';

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

	/*
	 * Enable support for the custom logo.
	 */
	add_theme_support( 'custom-logo' );

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

	// Custom image sizes.
	add_image_size( '300x200-crop', 300 , 200, true );
	add_image_size( '360x238-crop', 360 , 238, true );

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

	// This theme supports SiteOrigin Page Builder.
	add_theme_support( 'siteorigin-panels', array(
	) );
}
endif; // siteorigin_unwind_setup.
add_action( 'after_setup_theme', 'siteorigin_unwind_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function siteorigin_unwind_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'siteorigin_unwind_content_width', 828 );
}
add_action( 'after_setup_theme', 'siteorigin_unwind_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function siteorigin_unwind_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'siteorigin-unwind' ),
		'id'            => 'main-sidebar',
		'description'   => 'Visible on posts and pages that use the default template.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'siteorigin-unwind' ),
		'id'            => 'footer-sidebar',
		'description'   => 'A column will be automatically assigned to each widget inserted.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'siteorigin_unwind_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function siteorigin_unwind_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'siteorigin_unwind-style', get_stylesheet_uri() );

	// Theme JS.
	wp_enqueue_script( 'siteorigin-unwind-script', get_template_directory_uri() . '/js/unwind.js', array('jquery') );

	// Skip link focus fix.
	wp_enqueue_script( 'siteorigin-unwind-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Comment reply.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'siteorigin_unwind_scripts' );

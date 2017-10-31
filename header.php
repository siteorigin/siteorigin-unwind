<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'siteorigin-unwind' ); ?></a>

	<?php if ( siteorigin_page_setting( 'display_masthead', true ) ) : ?>
		<header id="masthead" class="site-header">

			<?php if ( class_exists( 'Woocommerce' ) && is_store_notice_showing() ) {
				siteorigin_unwind_wc_demo_store();
			} ?>

			<?php get_template_part( 'template-parts/header', siteorigin_setting( 'masthead_design' ) ); ?>

		</header><!-- #masthead -->
	<?php endif; ?>

	<div id="content" class="site-content">
		<div class="container">

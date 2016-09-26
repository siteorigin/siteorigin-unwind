<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteorigin_unwind
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

	<header id="masthead" class="site-header" role="banner">

		<div class="top-bar <?php if ( siteorigin_setting( 'navigation_sticky' ) ) echo 'sticky-menu'; ?>">
			<div class="container">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button id="mobile-menu-button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'siteorigin-unwind' ); ?></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
				<div id="mobile-navigation"></div>
				<div class="social-search">
					<?php $widget = siteorigin_setting( 'masthead_social_widget' ); ?>
					<?php if ( !empty($widget['networks']) && class_exists( 'SiteOrigin_Widget_SocialMediaButtons_Widget' ) ) : ?>
						<?php the_widget( 'SiteOrigin_Widget_SocialMediaButtons_Widget', $widget ); ?>
						<span class="v-line"></span>
					<?php endif; ?>
					<button id="search-button" class="search-toggle">
						<span class="open">Search</span>
						<span class="close">Close</span>
					</button>
				</div>
			</div><!-- .container -->
			<div id="fullscreen-search">
				<?php get_search_form(); ?>
			</div>
		</div><!-- .top-bar -->
		<div class="container">
			<div class="site-branding">
				<?php siteorigin_unwind_display_logo(); ?>
				<?php if ( siteorigin_setting( 'branding_site_description' ) ) : ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php endif ?>
			</div><!-- .site-branding -->
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container">

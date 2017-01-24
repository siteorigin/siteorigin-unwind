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
		<header id="masthead" class="site-header" role="banner">

			<div class="top-bar <?php if ( siteorigin_setting( 'navigation_sticky' ) ) echo 'sticky-menu'; ?>">
				<div class="container">

					<div class="social-search">
						<?php $widget = siteorigin_setting( 'masthead_social_widget' ); ?>
						<?php if ( ! empty( $widget['networks'] ) && class_exists( 'SiteOrigin_Widget_SocialMediaButtons_Widget' ) ) : ?>
							<?php the_widget( 'SiteOrigin_Widget_SocialMediaButtons_Widget', $widget ); ?>
							<span class="v-line"></span>
						<?php endif; ?>
						<?php if ( siteorigin_setting( 'navigation_search' ) ) : ?>
							<button id="search-button" class="search-toggle">
								<span class="open"><?php siteorigin_unwind_display_icon( 'search' ); ?></span>
								<span class="close"><?php siteorigin_unwind_display_icon( 'close' ); ?></span>
							</button>
						<?php endif; ?>
					</div>

					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button id="mobile-menu-button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php siteorigin_unwind_display_icon( 'menu' ); ?></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						<?php if ( class_exists( 'Woocommerce' ) && ! ( is_cart() || is_checkout() ) && siteorigin_setting( 'woocommerce_display_mini_cart' ) ): ?>
							<?php global $woocommerce; ?>
							<ul class="shopping-cart">
								<li>
									<a class="shopping-cart-link" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
										<span class="screen-reader-text"><?php esc_html_e( 'View shopping cart', 'siteorigin-unwind' ); ?></span>
										<?php siteorigin_unwind_display_icon( 'cart' ); ?>
										<span class="shopping-cart-text"><?php esc_html_e( ' View Cart ', 'siteorigin-unwind' ); ?></span>
										<span class="shopping-cart-count"><?php echo WC()->cart->cart_contents_count;?></span>
									</a>
									<ul class="shopping-cart-dropdown" id="cart-drop">
										<?php the_widget( 'WC_Widget_Cart' );?>
									</ul>
								</li>
							</ul>
						<?php endif; ?>
					</nav><!-- #site-navigation -->
					<div id="mobile-navigation"></div>

				</div><!-- .container -->

				<?php if ( siteorigin_setting( 'navigation_search' ) ) : ?>
					<div id="fullscreen-search">
						<?php get_template_part( 'template-parts/searchform-fullscreen' ); ?>
					</div>
				<?php endif; ?>
			</div><!-- .top-bar -->


			<?php if ( ! is_active_sidebar( 'masthead-sidebar' ) ) : ?>
				<div class="container">
					<div class="site-branding">
						<?php siteorigin_unwind_display_logo(); ?>
						<?php if ( siteorigin_setting( 'branding_site_description' ) ) : ?>
							<p class="site-description"><?php bloginfo( 'description' ); ?></p>
						<?php endif ?>
					</div><!-- .site-branding -->
				</div><!-- .container -->
			<?php else : ?>
				<div id="masthead-widgets" class="container">
					<?php
					if ( is_active_sidebar( 'masthead-sidebar' ) ) {
						$siteorigin_unwind_masthead_sidebars = wp_get_sidebars_widgets();
						?>
						<div class="widgets widgets-<?php echo count( $siteorigin_unwind_masthead_sidebars['masthead-sidebar'] ) ?>" role="complementary" aria-label="<?php esc_html_e( 'Masthead Sidebar', 'siteorigin-unwind' ); ?>">
							<?php dynamic_sidebar( 'masthead-sidebar' ); ?>
						</div>
						<?php
					}
					?>					
				</div><!-- #masthead-widgets -->
			<?php endif; ?>


		</header><!-- #masthead -->
	<?php endif; ?>

	<div id="content" class="site-content">
		<div class="container">

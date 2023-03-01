<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @since siteorigin-unwind 0.1
 *
 * @license GPL 2.0
 */
$footer_classes = '';
if ( ! siteorigin_setting( 'footer_constrained' ) ) {
	$footer_classes .= ' unconstrained-footer';
}

if ( is_active_sidebar( 'footer-sidebar' ) ) {
	$footer_classes .= ' footer-active-sidebar';
}
?>
		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer<?php echo $footer_classes; ?>">

		<?php if ( siteorigin_page_setting( 'display_footer_widgets', true ) ) { ?>
			<div class="container">
				<?php
				if ( is_active_sidebar( 'footer-sidebar' ) ) {
					$siteorigin_unwind_sidebars = wp_get_sidebars_widgets();
					?>
					<div class="widgets widgets-<?php echo count( $siteorigin_unwind_sidebars['footer-sidebar'] ); ?>" aria-label="<?php esc_attr_e( 'Footer Sidebar', 'siteorigin-unwind' ); ?>">
						<?php dynamic_sidebar( 'footer-sidebar' ); ?>
					</div>
					<?php
				}
			?>
			</div>
		<?php } ?>

		<div class="site-info">
			<div class="container">
				<?php
				siteorigin_unwind_footer_text();

				if ( function_exists( 'the_privacy_policy_link' ) && siteorigin_setting( 'footer_privacy_policy_link' ) ) {
					the_privacy_policy_link( '<span>', '</span>' );
				}

				$credit_text = apply_filters(
					'siteorigin_unwind_footer_credits',
					'<span>' . sprintf( esc_html__( 'Theme by %s', 'siteorigin-unwind' ), '<a href="https://siteorigin.com/">SiteOrigin</a>' ) . '</span>'
				);

				if ( ! empty( $credit_text ) ) {
					echo wp_kses_post( $credit_text );
				}
				?>
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( siteorigin_setting( 'navigation_scroll_to_top' ) ) { ?>
	<div id="scroll-to-top">
		<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'siteorigin-unwind' ); ?></span>
		<?php siteorigin_unwind_display_icon( 'up-arrow' ); ?>
	</div>
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>

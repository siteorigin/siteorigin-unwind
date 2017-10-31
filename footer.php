<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

?>
		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer <?php if ( ! siteorigin_setting( 'footer_constrained' ) ) echo 'unconstrained-footer'; if ( is_active_sidebar( 'footer-sidebar' ) ) echo ' footer-active-sidebar'; ?>">

		<?php if ( siteorigin_page_setting( 'display_footer_widgets', true ) ) : ?>
			<div class="container">
				<?php
				if ( is_active_sidebar( 'footer-sidebar' ) ) {
					$siteorigin_unwind_sidebars = wp_get_sidebars_widgets();
					?>
					<div class="widgets widgets-<?php echo count( $siteorigin_unwind_sidebars['footer-sidebar'] ) ?>" aria-label="<?php esc_attr_e( 'Footer Sidebar', 'siteorigin-unwind' ); ?>">
						<?php dynamic_sidebar( 'footer-sidebar' ); ?>
					</div>
					<?php
				}
				?>
			</div>
		<?php endif; ?>

		<div class="site-info">
			<div class="container">
				<?php
				siteorigin_unwind_footer_text();

				$credit_text = apply_filters(
					'siteorigin_unwind_footer_credits',
					sprintf( esc_html__( 'Crafted with love by %s.', 'siteorigin-unwind' ), '<a href="https://siteorigin.com/" rel="designer">SiteOrigin</a>' )
				);

				if ( ! empty( $credit_text ) ) {
					?>&nbsp;<?php
					echo wp_kses_post( $credit_text );
				}
				?>
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( siteorigin_setting( 'navigation_scroll_to_top' ) ) : ?>
	<div id="scroll-to-top">
		<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'siteorigin-unwind' ); ?></span>
		<?php siteorigin_unwind_display_icon( 'up-arrow' ); ?>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>

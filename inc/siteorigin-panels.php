<?php
/**
 * Compatibility with Page Builder by SiteOrigin.
 *
 * @link https://wordpress.org/plugins/siteorigin-panels/
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 1.0.4
 * @license GPL 2.0
 */

/**
 * The default Panels Lite labels.
 */
function siteorigin_unwind_panels_lite_localization( $loc ) {
    return wp_parse_args( array(
        'page_builder'         => esc_html__( 'Page Builder', 'siteorigin-unwind' ),
        'home_page_title'      => esc_html__( 'Custom Home Page Builder', 'siteorigin-unwind' ),
        'home_page_menu'       => esc_html__( 'Home Page', 'siteorigin-unwind' ),
        'install_plugin'       => esc_html__( 'Install Page Builder Plugin', 'siteorigin-unwind' ),
        'on_text'              => esc_html__( 'On', 'siteorigin-unwind' ),
        'off_text'             => esc_html__( 'Off', 'siteorigin-unwind' ),
        'home_install_message' => esc_html__( 'SiteOrigin Unwind supports Page Builder to create beautifully proportioned column based content.', 'siteorigin-unwind' ),
        // Longer message to display to a user about installing the plugin.
        'home_disable_message' => '',
        // Message about disabling the custom home page if the user doesn't want to use it.
    ), $loc );
}
add_filter( 'siteorigin_panels_lite_localization', 'siteorigin_unwind_panels_lite_localization' );

/**
 * Remove Post Loop widget templates that aren't complete loops.
 */
function siteorigin_unwind_filter_post_loop_widget( $templates ) {
    $disallowed_template_patterns = array(
        'template-parts/content.php',
        'template-parts/content-alternate.php',
        'template-parts/content-gallery.php',
        'template-parts/content-grid.php',
        'template-parts/content-masonry.php',
        'template-parts/content-image.php',
        'template-parts/content-offset.php',
        'template-parts/content-none.php',
        'template-parts/content-page.php',
        'template-parts/content-portfolio.php',
        'template-parts/content-project.php',
        'template-parts/content-search.php',
        'template-parts/content-single.php',
        'template-parts/content-video.php'
    );
    foreach ( $templates as $template ) {
        if ( in_array( $template, $disallowed_template_patterns ) ) {
            $key = array_search( $template, $templates );
            if ( false !== $key ) {
                unset( $templates[$key] );
            }
        }
    }
    return $templates;	
}
add_filter( 'siteorigin_panels_postloop_templates', 'siteorigin_unwind_filter_post_loop_widget', 10, 1 );

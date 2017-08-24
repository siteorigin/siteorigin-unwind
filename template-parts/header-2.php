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
        <?php $siteorigin_unwind_masthead_sidebars = wp_get_sidebars_widgets(); ?>
        <div class="widgets widgets-<?php echo count( $siteorigin_unwind_masthead_sidebars['masthead-sidebar'] ) ?>" role="complementary" aria-label="<?php esc_attr_e( 'Masthead Sidebar', 'siteorigin-unwind' ); ?>">
            <?php dynamic_sidebar( 'masthead-sidebar' ); ?>
        </div>
    </div><!-- #masthead-widgets -->
<?php endif; ?>

<div class="top-bar sticky-bar <?php if ( siteorigin_setting( 'navigation_sticky' ) ) echo 'sticky-menu'; ?>">
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

        <?php siteorigin_unwind_main_navigation() ?>

    </div><!-- .container -->

    <?php if ( siteorigin_setting( 'navigation_search' ) ) : ?>
        <div id="fullscreen-search">
            <?php get_template_part( 'template-parts/searchform-fullscreen' ); ?>
        </div>
    <?php endif; ?>
</div><!-- .top-bar -->

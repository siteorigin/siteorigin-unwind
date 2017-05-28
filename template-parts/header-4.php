<div class="top-bar">
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

    </div><!-- .container -->

    <?php if ( siteorigin_setting( 'navigation_search' ) ) : ?>
        <div id="fullscreen-search">
            <?php get_template_part( 'template-parts/searchform-fullscreen' ); ?>
        </div>
    <?php endif; ?>
</div><!-- .top-bar -->
<div class="main-navigation-bar sticky-bar <?php if ( siteorigin_setting( 'navigation_sticky' ) ) echo 'sticky-menu'; ?>">
    <div class="container">
        <div class="site-branding">
            <?php siteorigin_unwind_display_logo(); ?>
            <?php if ( siteorigin_setting( 'branding_site_description' ) ) : ?>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            <?php endif ?>
        </div><!-- .site-branding -->
        <?php siteorigin_unwind_main_navigation() ?>
    </div><!-- .container -->
</div>

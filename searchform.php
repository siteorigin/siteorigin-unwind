<form method="get" class="search-form" action="<?php echo esc_url( site_url() ) ?>">
	<label for='s' class='screen-reader-text'><?php esc_html_e( 'Search for:', 'siteorigin-unwind' ); ?></label>
	<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'siteorigin-unwind') ?>" value="<?php echo get_search_query() ?>" />
	<button type="submit">
		<label class="screen-reader-text"><?php esc_html_e( 'Search', 'siteorigin-unwind' ); ?></label>
		<?php siteorigin_unwind_display_icon( 'icons_search' ); ?>
	</button>
</form>

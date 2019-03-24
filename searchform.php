<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" name="s" aria-label="<?php esc_html_e( 'Search for', 'siteorigin-unwind' ); ?>" placeholder="<?php esc_attr_e( 'Search', 'siteorigin-unwind') ?>" value="<?php echo get_search_query() ?>" />
	<button type="submit" aria-label="<?php esc_html_e( 'Search', 'siteorigin-corp' ); ?>">
		<?php siteorigin_unwind_display_icon( 'icons_search' ); ?>
	</button>
</form>

<form method="get" action="<?php echo esc_url( site_url() ) ?>">
	<div class="searchform-title"><?php esc_attr_e('Search site', 'siteorigin-unwind') ?></div>
	<input type="search" name="s" placeholder="<?php esc_attr_e('Type and hit enter to search', 'siteorigin-unwind') ?>" value="<?php echo get_search_query() ?>" />
	<input type="submit" value="<?php esc_attr_e('Search', 'siteorigin-unwind') ?>" />
</form>

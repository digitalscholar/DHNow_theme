<?php ?>
<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <label>
        <input type="text" class="search-field" autocomplete="off" placeholder="<?php echo esc_attr_x('Search', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" />
    </label>
	<button type="submit" class="search-button" aria-label="Search">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/search-icon.svg" alt="Search" title="Search"></a>
	</button>
</form>

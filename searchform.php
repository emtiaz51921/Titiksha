<?php
/*
 * Template for getting search form
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'titiksha' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'titiksha' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" aria-label="<?php echo esc_attr_x( 'Search through site content', 'aria-label', 'titiksha' ); ?>">
	</label>
	<input type="submit" class="search-submit" value="&#xedef;">
</form>

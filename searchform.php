<?php
/*
 * Template for getting search form
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _x( 'Search for:', 'label', 'titiksha' ); ?></span>
		<input type="search" class="search-field" placeholder="Search …" value="<?php echo get_search_query(); ?>" name="s" id="s">
	</label>
	<input type="submit" class="search-submit" value="&#xedef;">
</form>

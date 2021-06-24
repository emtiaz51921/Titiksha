<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Titiksha
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function titiksha_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-main' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'titiksha_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function titiksha_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'titiksha_pingback_header' );


/**
 * Text logo if no image logo is selected
 */
if ( ! function_exists( 'titiksha_text_logo_display' ) ) :

	function titiksha_text_logo_display() {

		$markup  = '<a class="brand-logo" href="' . esc_url( home_url( '/' ) ) . '">';
		$markup .= '<h1>' . get_bloginfo( 'name', 'display' ) . '</h1>';

		if ( ( get_theme_mod( 'header_text' ) !== 0 ) && ( get_bloginfo( 'description' ) !== '' ) ) {
			$markup .= '<h5 class="site-description">' . get_bloginfo( 'description', 'display' ) . '</h5>';
		}
		$markup .= '</a>';

		return $markup;
	}

endif;

/*
 * Get the custom image logo
 */

if ( ! function_exists( 'titiksha_custom_logo' ) ) :

	function titiksha_custom_logo() {

		if ( ! get_theme_mod( 'custom_logo' ) ) {

			return false;
		}
		$custom_logo_id  = get_theme_mod( 'custom_logo' );
		$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );

		if ( $custom_logo_url ) {
			return '<a class="brand-logo" href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $custom_logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" data-light="' . esc_url( $custom_logo_url ) . '" ></a>';
		} else {
			return false;
		}
	}

endif;


/*
 * *
 * Modify WordPress comment box textarea
 * * */

function titiksha_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}

add_filter( 'comment_form_fields', 'titiksha_move_comment_field_to_bottom' );


/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function titiksha_skip_link() {
	echo ' <a class="skip-link screen-reader-text" href="#content">' . esc_html__( 'Skip to the content', 'titiksha' ) . '</a>';
}

add_action( 'wp_body_open', 'titiksha_skip_link', 5 );


/*
 *
 * Titiksha number pagination
 *
 * */
if ( ! function_exists( 'titiksha_number_paging_nav' ) ) :

	function titiksha_number_paging_nav() {

		$pagination_args = array(
			'prev_text'          => '<i class="icofont icofont-simple-left"></i>',
			'next_text'          => '<i class="icofont icofont-simple-right"></i>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'titiksha' ) . ' </span>',
		);

		the_posts_pagination( $pagination_args );

	}

endif;


/*
 *
 * Titiksha post navigation
 *
 * */
if ( ! function_exists( 'titiksha_post_navigation' ) ) :

	function titiksha_post_navigation() {

		if ( 1 === get_theme_mod( 'single_remove_post_navigation', 0 ) && is_single() ) {
			return false;
		}

		$next_post     = get_next_post();
		$previous_post = get_previous_post();

		$markup  = '<div class="prv-nxt-post w100dt mb-30">';
		$markup .= '<div class="row">';

		if ( $next_post ) {
			$thumbnail = get_the_post_thumbnail_url( $next_post->ID, 'full' );
			$permalink = get_the_permalink( $next_post->ID );
			$markup   .= '<div class="col m6 s12">';
			$markup   .= '<div class="sb-nxt-post">';

			$markup .= '<div class="pn-img left">';
			$markup .= '<img src="' . esc_url( $thumbnail ) . '" alt="' . esc_attr( $next_post->post_title ) . '">';
			$markup .= '</div>';
			$markup .= '<div class="pn-text left-align">';
			$markup .= '<a href="' . esc_url( $permalink ) . '" class="title-name mb-10">' . esc_html( $next_post->post_title ) . '</a>';
			$markup .= '<a href="' . esc_url( $permalink ) . '" class="prv-nxt-btn l-blue"><i class="icofont icofont-caret-left"></i>' . esc_html__( 'Preveious', 'titiksha' ) . '</a>';
			$markup .= '</div>';

			$markup .= '</div>';
			$markup .= '</div>';
		}

		if ( $previous_post ) {
			$thumbnail_prev = get_the_post_thumbnail_url( $previous_post->ID, 'full' );
			$permalink_prev = get_the_permalink( $previous_post->ID );
			$markup        .= '<div class="col m6 s12">';
			$markup        .= '<div class="sb-prv-post ">';

			$markup .= '<div class="pn-img right">';
			$markup .= '<img src="' . esc_url( $thumbnail_prev ) . '" alt="' . esc_attr( $previous_post->post_title ) . '">';
			$markup .= '</div>';
			$markup .= '<div class="pn-text right-align">';
			$markup .= '<a href="' . esc_url( $permalink_prev ) . '" class="title-name mb-10">' . esc_html( $previous_post->post_title ) . '</a>';
			$markup .= '<a href="' . esc_url( $permalink_prev ) . '" class="prv-nxt-btn l-blue"><i class="icofont icofont-caret-right"></i>' . esc_html__( 'Next', 'titiksha' ) . '</a>';
			$markup .= '</div>';

			$markup .= '</div>';
			$markup .= '</div>';
		}

		$markup .= '</div>';
		$markup .= '</div>';

		echo $markup;

	}

endif;



/**
 * Modify default read more link
 */
function titiksha_modify_read_more_link() {

	$posted_on = sprintf(
		'<div class="left"><a href="%s" rel="bookmark" class="btn-outline-custom" >' . __( 'Continue Reading', 'titiksha' ) . ' <i class="icofont icofont-long-arrow-right"></i></a></div> ',
		esc_url( get_permalink() )
	);

	return $posted_on;

}

add_filter( 'the_content_more_link', 'titiksha_modify_read_more_link' );


/*
 * *
 * Fatch all category
 * * */
if ( ! function_exists( 'titiksha_fatch_all_cats' ) ) :

	function titiksha_fatch_all_cats() {

		$get_all_cats  = get_categories();
		$cats_to_fatch = array();
		foreach ( $get_all_cats as $cats ) {

			$cats_to_fatch[ $cats->slug ] = $cats->name;

		}

		return $cats_to_fatch;

	}


endif;


/**
 * Filter the excerpt length to 30 words.
 *
 * @param int $length Excerpt length.
 *
 * @return int (Maybe) modified excerpt length.
 */
function titiksha_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return 30;
}

add_filter( 'excerpt_length', 'titiksha_excerpt_length' );






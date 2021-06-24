<?php
/**
 * Dynamic style for theme
 *
 * @package Titiksha
 */
function titiksha_theme_dynamic_style() {

    $titiksha_style = '';

    /**********************/
    // Scheme Color
    /**********************/

    $titiksha_theme_color = sanitize_hex_color( get_theme_mod( 'titiksha_theme_color', '#2962ff' ) );
    $titiksha_focus_color = get_theme_mod( 'titiksha_enable_acc_color', false );
    if ( $titiksha_focus_color ) {
        $titiksha_style .= "
		a:focus {
			outline: thin dotted;
		}

		.form-control:focus,
		button:visited,
		button.active,
		button:hover,
		button:focus,
		input:visited,
		input.active,
		input:hover,
		input:focus,
		a:hover,
		a:focus,
		a:visited,
		a.active {
			outline: none;
			box-shadow: none;
			text-decoration: none;
		}

		.screen-reader-text:focus {
			background-color: #f1f1f1;
			border-radius: 3px;
			box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
			clip: auto !important;
			clip-path: none;
			color: #21759b;
			display: block;
			font-size: 0.875rem;
			font-weight: 700;
			height: auto;
			left: 5px;
			line-height: normal;
			padding: 15px 23px 14px;
			text-decoration: none;
			top: 5px;
			width: auto;
			z-index: 100000;
		}

		.contact-form input[type=text]:focus:not([readonly]),
		.contact-form input[type=email]:focus:not([readonly]),
		.contact-form textarea.materialize-textarea:focus:not([readonly]) {
			border-bottom: 1px solid #2962ff;
			box-shadow: 0 1px 0 0 #2962ff;
		}

		.sidebar-subscribe input[type=email]:focus:not([readonly]) {
			box-shadow: 0 1px 0 0 #2962ff;
			border-bottom: 1px solid #2962ff;
		}

		.form-control:focus,
		button:visited,
		button:focus,
		input:visited,
		input:focus,
		a:focus,
		a:visited {
			outline: 1px solid #2962ff;
		}

		.comment-respond input[type=text]:focus:not([readonly]),
		.comment-respond input[type=email]:focus:not([readonly]),
		.comment-respond textarea.materialize-textarea:focus:not([readonly]) {
			border-bottom: 1px solid;
		}

		.form-control:focus,
		button:visited,
		button:focus,
		input:visited,
		input:focus,
		a:focus,
		a:visited {
			outline: 1px solid;
		}
		.form-control:focus, button:visited, button:focus, input:visited, input:focus, a:focus, a:visited {
			outline-color: {$titiksha_theme_color};
		}
		"
        ;
    }

    $titiksha_style .= "
	a {
	    color: {$titiksha_theme_color};
	}
	button.custom-btn,
	a.custom-btn {
	    background-color: {$titiksha_theme_color};
	}
	.l-blue {
	    color: {$titiksha_theme_color} !important;
	}
	.cmn-bgcolor {
	    background-color: {$titiksha_theme_color} !important;
	}
	ul.post-mate li a:hover {
	    color: {$titiksha_theme_color} !important;
	}
	.backToTop {
	    border: 1px solid {$titiksha_theme_color};
	}

	.backToTop a.scroll {
	    color: {$titiksha_theme_color};
	}
	.backToTop a.scroll > span.go-up {
	    background-color: {$titiksha_theme_color};
	}
	.blog-slider-section .slider .indicators .indicator-item.active,
	.cateogry-section .slider .indicators .indicator-item.active {
	    background-color: {$titiksha_theme_color};
	}
	.daily-lifestyle-section .owl-theme .owl-nav [class*=owl-]:hover:before {
	    background: {$titiksha_theme_color};
	}
	.blogs:hover a.card-title {
	    color: {$titiksha_theme_color} !important;
	}
	nav.pagination .page-numbers.current, nav.pagination .page-numbers:hover {
	    background-color: {$titiksha_theme_color};
	}
	nav.pagination .page-numbers.active,
	nav.pagination .page-numbers:hover a {
	    background-color: {$titiksha_theme_color};
	}
	.instagram-section .instagram-link a {
	    color: {$titiksha_theme_color};
	}
	.single-blog-section ul.tag-list li a:hover,
	.single-blog-section ul.share-links li a:hover {
	    background-color: {$titiksha_theme_color};
	}
	.sb-prv-post:hover .pn-text a.title-name,
	.sb-nxt-post:hover .pn-text a.title-name {
	    color: {$titiksha_theme_color};
	}
	.peoples-comments .comment ul.post-mate-time li a:hover {
	    color: {$titiksha_theme_color};
	}
	.comment-respond input[type=text]:focus:not([readonly]) + label,
	.comment-respond input[type=email]:focus:not([readonly]) + label,
	.comment-respond textarea.materialize-textarea:focus:not([readonly]) + label {
	    color: {$titiksha_theme_color};
	}
	.comment-respond input[type=text]:focus:not([readonly]),
	.comment-respond input[type=email]:focus:not([readonly]),
	.comment-respond textarea.materialize-textarea:focus:not([readonly]) {
	    border-color: {$titiksha_theme_color};
	    box-shadow: 0 1px 0 0 {$titiksha_theme_color};
	}
	.contact-section .contact-things .c-icon > i {
	    color: {$titiksha_theme_color};
	}
	.contact-form input[type=text]:focus:not([readonly]),
	.contact-form input[type=email]:focus:not([readonly]),
	.contact-form textarea.materialize-textarea:focus:not([readonly]) {
	    border-bottom: 1px solid {$titiksha_theme_color};
	    box-shadow: 0 1px 0 0 {$titiksha_theme_color};
	}
	.contact-form input[type=text]:focus:not([readonly]) + label,
	.contact-form input[type=email]:focus:not([readonly]) + label,
	.contact-form textarea.materialize-textarea:focus:not([readonly]) + label {
	    color: {$titiksha_theme_color};
	}
	.contact-section .contact-form button {
	    background-color: {$titiksha_theme_color};
	}
	.sidebar-testimonial .carousel .indicators .indicator-item.active {
	    background-color: {$titiksha_theme_color};
	}
	.tabs .indicator {
	    background-color: {$titiksha_theme_color};
	}
	.top-post ul.top-post-tab li.tab a:hover {
	    color: {$titiksha_theme_color};
	}
	.top-post ul.top-post-tab li.tab a.active {
	    color: {$titiksha_theme_color};
	}
	.sidebar-subscribe input[type=email]:focus:not([readonly]) {
	    box-shadow: 0 1px 0 0 {$titiksha_theme_color};
	    border-bottom: 1px solid {$titiksha_theme_color};
	}
	.sidebar-subscribe input[type=email]:focus:not([readonly]) + label {
	    color: {$titiksha_theme_color};
	}
	.sidebar-subscribe form > a {
	    background-color: {$titiksha_theme_color};
	}
	.error-contant p > a {
	    color: {$titiksha_theme_color};
	}
	button.custom-btn:hover, a.custom-btn:hover, button.custom-btn:focus, a.custom-btn:focus {
	    border: 1px solid {$titiksha_theme_color};
	}

	ul.pagination li.active a:focus {
	    color: {$titiksha_theme_color};
	}
	ul.pagination li a:focus {
	    background-color: {$titiksha_theme_color};
	}
	a.gray:hover {
	    color: {$titiksha_theme_color};
	}
	input[type=\"submit\"].comment-submit-btn {
	    background-color: {$titiksha_theme_color};
	}
	input[type=\"submit\"].comment-submit-btn:hover {
	    color: {$titiksha_theme_color};
	    border: 1px solid {$titiksha_theme_color};
	}
	.comment-list .pname .comment_author_title a, .comment-list .pname .comment_author_title {
	    color: {$titiksha_theme_color};
	}
	.peoples-comments .comment-list li.comment .comment-respond .comment-reply-title a#cancel-comment-reply-link:hover {
	    color: {$titiksha_theme_color};
	}
	.post-content .post-password-form input[type=\"submit\"] {
	    background-color: {$titiksha_theme_color};
	}
	.widget-title::after {
	    border-bottom: 1px solid {$titiksha_theme_color};
	}
	.widget_archive a:hover, .widget_categories ul li a:hover, .widget_meta ul li a:hover, .widget_nav_menu ul li a:hover, .widget_pages ul li a:hover, .widget_recent_entries ul li a:hover {
	    color: {$titiksha_theme_color};
	}
	.widget a {
	    color: {$titiksha_theme_color};
	}
	.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
	    background-color: {$titiksha_theme_color};
	}
	th {
	    background: {$titiksha_theme_color};
	}
	.tagcloud > a:hover {
	    background: {$titiksha_theme_color};
	}
	.widget_recent_entries_custom .wb a:hover {
	    color: {$titiksha_theme_color};
	}
	.nav-toggle {
	    border: 1px solid #fff;
	    color: {$titiksha_theme_color};
	}
	.nav-collapse ul li > a:hover {
	    color: {$titiksha_theme_color};
	}
	.card .card-title a:hover {
        color: {$titiksha_theme_color};
	}
	.nav-collapse .dropdown > ul a:hover,
	.nav-collapse .dropdown > ul a:focus {
	    border-top: 0px solid {$titiksha_theme_color};
	}
	.nav-collapse ul li.active > a {
	    color: {$titiksha_theme_color};
	}
	.side-nav {
	    background-color: {$titiksha_theme_color};
	}
	.overlay-content form input[type=\"submit\"] {
	    background-color: {$titiksha_theme_color};
	}
	.owl-theme .owl-dots .owl-dot span {
	    background: {$titiksha_theme_color};
	}
	.owl-theme .owl-dots .owl-dot.active span,
	.owl-theme .owl-dots .owl-dot:hover span {
	    background: {$titiksha_theme_color};
	}
	.wp-block-calendar table th {
	    background: {$titiksha_theme_color};
	}
	.wp-block-search .wp-block-search__button {
	    background-color: {$titiksha_theme_color};
	}
	.post-content a.btn-outline-custom {
	    border: 1px solid {$titiksha_theme_color};
	}
	.post-content a.btn-outline-custom:hover {
	    background-color: {$titiksha_theme_color};
	}
	.screen-reader-text:focus {
        background-color: {$titiksha_theme_color};
    }
	";

    return $titiksha_style;

}
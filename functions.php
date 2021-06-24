<?php
/**
 * Titiksha functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Titiksha
 */

if ( ! defined( 'TITIKSHA_VERSION' ) ) {
	// Replace the version number of the theme on each release. 
	define( 'TITIKSHA_VERSION', '1.0.5' );
}

if ( ! function_exists( 'titiksha_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function titiksha_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Titiksha, use a find and replace
		 * to change 'titiksha' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'titiksha', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// enable custom image size
		add_image_size( 'titiksha_post_thumb', 770, 350, true );

		// carousel image size
		add_image_size( 'titiksha_carousel', 170, 150, true );

		// content width support.
		if ( ! isset( $content_width ) ) {
			$content_width = 1140;
		}

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-main' => esc_html__( 'Main Menu', 'titiksha' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		$defaults = array(
			'default-color'      => 'ffffff',
			'default-image'      => '',
			'default-repeat'     => 'no-repeat',
			'default-position-x' => 'center',
			'default-position-y' => 'center',
			'default-size'       => 'cover',
			'wp-head-callback'   => '_custom_background_cb',

		);
		add_theme_support( 'custom-background', $defaults );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// add editor style
		add_editor_style( array( 'css/editor-style.css', titiksha_fonts_url() ) );

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Strong Blue', 'titiksha' ),
					'slug'  => 'strong-blue',
					'color' => '#0073aa',
				),
				array(
					'name'  => __( 'Lighter Blue', 'titiksha' ),
					'slug'  => 'lighter-blue',
					'color' => '#229fd8',
				),
				array(
					'name'  => __( 'Very Light Gray', 'titiksha' ),
					'slug'  => 'very-light-gray',
					'color' => '#eee',
				),
				array(
					'name'  => __( 'Very Dark Gray', 'titiksha' ),
					'slug'  => 'very-dark-gray',
					'color' => '#444',
				),
			)
		);

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add theme starter support
		add_theme_support( 'starter-content' );

	}
endif;
add_action( 'after_setup_theme', 'titiksha_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function titiksha_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['titiksha_content_width'] = apply_filters( 'titiksha_content_width', 640 );
}

add_action( 'after_setup_theme', 'titiksha_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function titiksha_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'titiksha' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'titiksha' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'titiksha_widgets_init' );


/**
 * Register Google Fonts
 */
function titiksha_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Noto Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$notoserif = esc_html_x( 'on', 'Noto Serif font: on or off', 'titiksha' );

	if ( 'off' !== $notoserif ) {
		$font_families   = array();
		$font_families[] = 'Poppins:300,400,400i,500,600,700,800';

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */

function titiksha_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action( 'wp_head', 'titiksha_javascript_detection', 0 );


/**
 * Enqueue scripts and styles.
 */
function titiksha_scripts() {
	wp_enqueue_style( 'titiksha-style', get_stylesheet_uri(), array(), TITIKSHA_VERSION );
	wp_style_add_data( 'titiksha-style', 'rtl', 'replace' );

	wp_enqueue_style( 'materialize', get_template_directory_uri() . '/css/materialize.css', array(), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'titiksha-icofont', get_template_directory_uri() . '/css/icofont.css', array(), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'owl-theme-default', get_template_directory_uri() . '/css/owl.theme.default.min.css', array(), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'titiksha-custom-menu', get_template_directory_uri() . '/css/custom-menu.css', array(), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'titiksha-blocks', get_template_directory_uri() . '/css/blocks.css', array(), TITIKSHA_VERSION, 'all' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'titiksha-ie8', get_template_directory_uri() . '/css/ie8.css', array(), TITIKSHA_VERSION, 'all' );
	wp_style_add_data( 'titiksha-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'titiksha-ie9', get_template_directory_uri() . '/css/ie9.css', array(), TITIKSHA_VERSION, 'all' );
		wp_style_add_data( 'titiksha-ie9', 'conditional', 'IE 9' );
	}

	wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/css/colorbox.css', array(), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'select2', get_template_directory_uri() . '/css/select2.min.css', array(), TITIKSHA_VERSION, 'all' );

	wp_enqueue_style( 'Lato', 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,900;1,400;1,700&display=swap', array(), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'Lora', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap', array(), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'responsive-nav', get_template_directory_uri() . '/css/responsive-nav.css', array( 'materialize' ), TITIKSHA_VERSION, 'all' );
	wp_enqueue_style( 'titiksha-main', get_template_directory_uri() . '/css/main.css', array( 'materialize' ), TITIKSHA_VERSION, 'all' );

	wp_enqueue_style( 'titiksha-responsive', get_template_directory_uri() . '/css/responsive.css', array( 'materialize' ), TITIKSHA_VERSION, 'all' );

	wp_add_inline_style( 'titiksha-main', titiksha_theme_dynamic_style() );

	wp_enqueue_script( 'titiksha-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), TITIKSHA_VERSION, true );
	wp_enqueue_script( 'materialize-js', get_template_directory_uri() . '/js/materialize.js', array( 'jquery' ), TITIKSHA_VERSION, true );
	wp_enqueue_script( 'owl.carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), TITIKSHA_VERSION, true );
	wp_enqueue_script( 'responsive-nav-js', get_template_directory_uri() . '/js/responsive-nav.js', array( 'jquery' ), TITIKSHA_VERSION, true );
	wp_enqueue_script( 'titiksha-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), TITIKSHA_VERSION, true );

	wp_enqueue_script( 'colorbox-js', get_template_directory_uri() . '/js/jquery.colorbox.js', array( 'jquery' ), TITIKSHA_VERSION, true );
	wp_enqueue_script( 'select2-js', get_template_directory_uri() . '/js/select2.min.js', array( 'jquery' ), TITIKSHA_VERSION, true );
	wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr-custom.js', array( 'jquery' ), TITIKSHA_VERSION, true );

	wp_enqueue_script( 'titiksha-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array( 'jquery' ), TITIKSHA_VERSION, true );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3', true );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'titiksha_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 *  Navwalker for navigation menu
 */
require get_template_directory() . '/inc/classes/class-titiksha-navwalker.php';

/**
 *  Comment walker
 */
require get_template_directory() . '/inc/classes/class-titiksha-comment.php';

/**
 *  Include about me widget
 */
require get_template_directory() . '/inc/widgets/class-titiksha-aboutme-widget.php';

/**
 *  Include recent post with thumbnail widget
 */
require get_template_directory() . '/inc/widgets/class-titiksha-recentpost-widget.php';


/**
 *  Include dynamic style
 */
require get_template_directory() . '/inc/dynamic-style.php';




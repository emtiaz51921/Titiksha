<?php
/**
 * titiksha Theme Customizer
 *
 * @package titiksha
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function titiksha_theme_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'titiksha_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'titiksha_customize_partial_blogdescription',
            )
        );
    }

    $wp_customize->add_panel(
        'titiksha_panel',
        array(
            'priority'       => 40,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__( 'Titiksha Options', 'titiksha' ),
        )
    );

    /* Theme header start */
    $wp_customize->add_section(
        'titiksha_header_setting',
        array(
            'capability' => 'edit_theme_options',
            'title'      => esc_html__( 'Header Options', 'titiksha' ),
            'panel'      => 'titiksha_panel',
        )
    );

    /* Theme header end */

    /* Theme color options start */

    $wp_customize->add_section(
        'titiksha_color_setting',
        array(
            'capability' => 'edit_theme_options',
            'title'      => esc_html__( 'Colors', 'titiksha' ),
            'panel'      => 'titiksha_panel',
        )
    );

    $wp_customize->add_setting(
        'titiksha_theme_color',
        array(
            'default'           => '#2962ff',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',

        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'titiksha_theme_color_section',
            array(
                'label'    => __( 'Theme Color', 'titiksha' ),
                'section'  => 'titiksha_color_setting',
                'settings' => 'titiksha_theme_color',
            )
        )
    );

    $wp_customize->add_setting(
        'titiksha_enable_acc_color',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'titiksha_enable_acc_color',
        array(
            'settings' => 'titiksha_enable_acc_color',
            'label'    => esc_html__( 'Enable accessibility focus color?', 'titiksha' ),
            'section'  => 'titiksha_color_setting',
            'type'     => 'checkbox',
        )
    );

    /* Theme color options end */

    /* Post Slider Options */
    $wp_customize->add_section(
        'titiksha_slide_setting',
        array(
            'capability' => 'edit_theme_options',
            'title'      => esc_html__( 'Post Slider', 'titiksha' ),
            'panel'      => 'titiksha_panel',
        )
    );

    $wp_customize->add_setting(
        'titiksha_enable_slide',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'titiksha_enable_slide',
        array(
            'settings' => 'titiksha_enable_slide',
            'label'    => esc_html__( 'Enable Post Slide', 'titiksha' ),
            'section'  => 'titiksha_slide_setting',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'post_slide_number',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 2,
            'transport'         => 'refresh',
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'post_slide_number',
        array(
            'label'       => __( 'Number of posts', 'titiksha' ),
            'section'     => 'titiksha_slide_setting',
            'type'        => 'number',
            'description' => esc_html__( 'Put minimum value 2', 'titiksha' ),
        )
    );

    $wp_customize->add_setting(
        'post_slider_category',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'uncategorized',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_select',
        )
    );
    $wp_customize->add_control(
        'post_slider_category',
        array(
            'label'       => __( 'Select Category', 'titiksha' ),
            'description' => __( 'Please select the category for the carousel', 'titiksha' ),
            'section'     => 'titiksha_slide_setting',
            'type'        => 'select',
            'choices'     => titiksha_fatch_all_cats(),
        )
    );

    $wp_customize->add_setting(
        'post_slider_order',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'DESC',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_order',
        )
    );

    $wp_customize->add_control(
        'post_slider_order',
        array(
            'label'       => __( 'Order', 'titiksha' ),
            'description' => __( 'ASC - ascending order from lowest to highest values (1, 2, 3; a, b, c) & DESC - descending order from highest to lowest values (3, 2, 1; c, b, a).', 'titiksha' ),
            'section'     => 'titiksha_slide_setting',
            'settings'    => 'post_slider_order',
            'type'        => 'select',
            'choices'     => array(
                'ASC'  => 'ASC',
                'DESC' => 'DESC',
            ),
        )
    );

    $wp_customize->add_setting(
        'post_slider_orderby',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'date',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_orderby',
        )
    );
    $wp_customize->add_control(
        'post_slider_orderby',
        array(
            'label'       => __( 'Order By', 'titiksha' ),
            'description' => __( 'Sort retrieved posts by parameter. Defaults to "date".', 'titiksha' ),
            'section'     => 'titiksha_slide_setting',
            'settings'    => 'post_slider_orderby',
            'type'        => 'select',
            'choices'     => array(
                'ID'         => 'ID',
                'author'     => 'author',
                'title'      => 'title',
                'name'       => 'name',
                'date'       => 'date',
                'rand'       => 'rand',
                'menu_order' => 'menu_order',
            ),
        )
    );

    /* Post Slider Options end */

    /* Post Carousel Options */
    $wp_customize->add_section(
        'titiksha_carousel_setting',
        array(
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'Post Carousel', 'titiksha' ),
            'description' => esc_html__( 'It will be displayed below post slider on home page.', 'titiksha' ),
            'panel'       => 'titiksha_panel',
        )
    );

    $wp_customize->add_setting(
        'titiksha_enable_carousel',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'titiksha_enable_carousel',
        array(
            'settings' => 'titiksha_enable_carousel',
            'label'    => esc_html__( 'Enable Post carousel', 'titiksha' ),
            'section'  => 'titiksha_carousel_setting',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'post_carousel_number',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 2,
            'transport'         => 'refresh',
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'post_carousel_number',
        array(
            'label'       => __( 'Number of posts', 'titiksha' ),
            'section'     => 'titiksha_carousel_setting',
            'type'        => 'number',
            'description' => esc_html__( 'Put minimum value 2', 'titiksha' ),
        )
    );

    $wp_customize->add_setting(
        'post_carousel_category',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'uncategorized',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_select',
        )
    );
    $wp_customize->add_control(
        'post_carousel_category',
        array(
            'label'       => __( 'Select Category', 'titiksha' ),
            'description' => __( 'Please select the category for the carousel', 'titiksha' ),
            'section'     => 'titiksha_carousel_setting',
            'type'        => 'select',
            'choices'     => titiksha_fatch_all_cats(),
        )
    );

    $wp_customize->add_setting(
        'post_carousel_order',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'DESC',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_order',
        )
    );

    $wp_customize->add_control(
        'post_carousel_order',
        array(
            'label'       => __( 'Order', 'titiksha' ),
            'description' => __( 'ASC - ascending order from lowest to highest values (1, 2, 3; a, b, c) & DESC - descending order from highest to lowest values (3, 2, 1; c, b, a).', 'titiksha' ),
            'section'     => 'titiksha_carousel_setting',
            'settings'    => 'post_carousel_order',
            'type'        => 'select',
            'choices'     => array(
                'ASC'  => 'ASC',
                'DESC' => 'DESC',
            ),
        )
    );

    $wp_customize->add_setting(
        'post_carousel_orderby',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'date',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_orderby',
        )
    );
    $wp_customize->add_control(
        'post_carousel_orderby',
        array(
            'label'       => __( 'Order By', 'titiksha' ),
            'description' => __( 'Sort retrieved posts by parameter. Defaults to "date".', 'titiksha' ),
            'section'     => 'titiksha_carousel_setting',
            'settings'    => 'post_carousel_orderby',
            'type'        => 'select',
            'choices'     => array(
                'ID'         => 'ID',
                'author'     => 'author',
                'title'      => 'title',
                'name'       => 'name',
                'date'       => 'date',
                'rand'       => 'rand',
                'menu_order' => 'menu_order',
            ),
        )
    );

    /* Post carousel  Options end */

    /*
     * Post  Archive options
     */
    $wp_customize->add_section(
        'titiksha_post_setting',
        array(
            'capability' => 'edit_theme_options',
            'title'      => esc_html__( 'Post Archive', 'titiksha' ),
            'panel'      => 'titiksha_panel',
        )
    );

    $wp_customize->add_setting(
        'post_archive_layout',
        array(
            'default'           => 'right_sidebar',
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_select',
        )
    );
    $wp_customize->add_control(
        'post_archive_layout',
        array(
            'settings' => 'post_archive_layout',
            'label'    => esc_html__( 'Post Archive Layout', 'titiksha' ),
            'section'  => 'titiksha_post_setting',
            'type'     => 'select',
            'choices'  => array(
                'full_width'    => esc_html__( 'Full Width', 'titiksha' ),
                'right_sidebar' => esc_html__( 'Sidebar Right', 'titiksha' ),
                'left_sidebar'  => esc_html__( 'Sidebar Left', 'titiksha' ),
            ),
        )
    );

    $wp_customize->add_setting(
        'archive_remove_cat',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'archive_remove_cat',
        array(
            'settings' => 'archive_remove_cat',
            'label'    => esc_html__( 'Remove Category', 'titiksha' ),
            'section'  => 'titiksha_post_setting',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'archive_remove_author',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'archive_remove_author',
        array(
            'settings' => 'archive_remove_author',
            'label'    => esc_html__( 'Remove Author Info', 'titiksha' ),
            'section'  => 'titiksha_post_setting',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'archive_remove_date',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'archive_remove_date',
        array(
            'settings' => 'archive_remove_date',
            'label'    => esc_html__( 'Remove Date', 'titiksha' ),
            'section'  => 'titiksha_post_setting',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'archive_remove_comments',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'archive_remove_comments',
        array(
            'settings' => 'archive_remove_comments',
            'label'    => esc_html__( 'Remove Comment Info', 'titiksha' ),
            'section'  => 'titiksha_post_setting',
            'type'     => 'checkbox',
        )
    );
    /* Post  Archive options end */

    /*
     * Single Post setting
     */

    $wp_customize->add_section(
        'titiksha_single_post_setting',
        array(
            'capability' => 'edit_theme_options',
            'title'      => esc_html__( 'Single Post', 'titiksha' ),
            'panel'      => 'titiksha_panel',
        )
    );

    $wp_customize->add_setting(
        'post_single_layout',
        array(
            'default'           => 'right_sidebar',
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_select',
        )
    );
    $wp_customize->add_control(
        'post_single_layout',
        array(
            'settings' => 'post_single_layout',
            'label'    => esc_html__( 'Single Post Layout', 'titiksha' ),
            'section'  => 'titiksha_single_post_setting',
            'type'     => 'select',
            'choices'  => array(
                'full_width'    => esc_html__( 'Full Width', 'titiksha' ),
                'right_sidebar' => esc_html__( 'Sidebar Right', 'titiksha' ),
                'left_sidebar'  => esc_html__( 'Sidebar Left', 'titiksha' ),
            ),
        )
    );

    $wp_customize->add_setting(
        'single_remove_cat',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'single_remove_cat',
        array(
            'settings' => 'single_remove_cat',
            'label'    => esc_html__( 'Remove Category', 'titiksha' ),
            'section'  => 'titiksha_single_post_setting',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'single_remove_tags',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'single_remove_tags',
        array(
            'settings' => 'single_remove_tags',
            'label'    => esc_html__( 'Remove Tag Info', 'titiksha' ),
            'section'  => 'titiksha_single_post_setting',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'single_remove_post_navigation',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'titiksha_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'single_remove_post_navigation',
        array(
            'settings' => 'single_remove_post_navigation',
            'label'    => esc_html__( 'Remove Post Navigation', 'titiksha' ),
            'section'  => 'titiksha_single_post_setting',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'single_breadcrumb_title',
        array(
            'default'           => 'Blog',
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'sanitize_callback' => 'wp_filter_nohtml_kses',

        )
    );

    $wp_customize->add_control(
        'single_breadcrumb_title',
        array(
            'label'    => __( 'Breadcrumb Bar Title', 'titiksha' ),
            'section'  => 'titiksha_single_post_setting',
            'settings' => 'single_breadcrumb_title',
            'type'     => 'text',
        )
    );

    /* Single Post options end */

    /* Footer Options */
    $wp_customize->add_section(
        'titiksha_footer_setting',
        array(
            'capability' => 'edit_theme_options',
            'title'      => esc_html__( 'Footer', 'titiksha' ),
            'panel'      => 'titiksha_panel',
        )
    );

    $wp_customize->add_setting(
        'titiksha_footer_copyright',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'wp_filter_nohtml_kses',
        )
    );
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'settings' => 'titiksha_footer_copyright',
            'label'    => esc_html__( 'Footer Copyright', 'titiksha' ),
            'section'  => 'titiksha_footer_setting',
            'type'     => 'textarea',

        )
    );
    /* Footer Options end */

}

add_action( 'customize_register', 'titiksha_theme_customize_register' );

/**
 * titiksha sanitization function
 */

function titiksha_sanitize_checkbox( $input ) {
    return ( 1 === absint( $input ) ) ? 1 : 0;
}

function titiksha_sanitize_select( $input, $setting ) {
    // input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key( $input );
    // get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    // return input if valid or return default option

    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function titiksha_sanitize_order( $value ) {
    if ( !in_array( $value, array( 'ASC', 'DESC' ), true ) ) {
        $value = 'DESC';
    }

    return $value;
}

function titiksha_sanitize_orderby( $value ) {
    if ( !in_array( $value, array( 'ID', 'author', 'title', 'name', 'date', 'rand', 'menu_order' ), true ) ) {
        $value = 'date';
    }

    return $value;
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function titiksha_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function titiksha_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function titiksha_customize_preview_js() {
    wp_enqueue_script( 'titiksha-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'titiksha_customize_preview_js' );
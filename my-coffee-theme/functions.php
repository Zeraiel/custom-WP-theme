<?php
/**
 * My Coffee Theme functions and definitions.
 *
 * @package my-coffee-theme
 */

/**
 * Default values for the Customizer settings (translatable).
 *
 * @param string $key Setting key.
 * @return string
 */
function my_coffee_theme_get_default( $key ) {
	$defaults = array(
		'hero_title'       => __( 'Freshly roasted coffee', 'my-coffee-theme' ),
		'hero_text'        => __( 'Small-batch beans, roasted every week.', 'my-coffee-theme' ),
		'hero_button_text' => __( 'Read the blog', 'my-coffee-theme' ),
		'accent_color'     => '#5a3a26',
	);

	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * Theme setup: translations, supported features and menu locations.
 */
function my_coffee_theme_setup() {
	load_theme_textdomain( 'my-coffee-theme', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'my-coffee-theme' ),
			'footer'  => __( 'Footer menu', 'my-coffee-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'my_coffee_theme_setup' );

/**
 * Maximum width of embedded content, in pixels.
 */
function my_coffee_theme_content_width() {
	// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- Standard theme global.
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'my_coffee_theme_content_width', 0 );

/**
 * Widget areas: sidebar and footer.
 */
function my_coffee_theme_widgets_init() {
	$defaults = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar(
		array_merge(
			$defaults,
			array(
				'name'        => __( 'Sidebar', 'my-coffee-theme' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets shown next to the main content.', 'my-coffee-theme' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$defaults,
			array(
				'name'        => __( 'Footer widgets', 'my-coffee-theme' ),
				'id'          => 'footer-1',
				'description' => __( 'Widgets shown at the bottom of every page.', 'my-coffee-theme' ),
			)
		)
	);
}
add_action( 'widgets_init', 'my_coffee_theme_widgets_init' );

/**
 * Styles and scripts.
 */
function my_coffee_theme_scripts() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'my-coffee-theme-style', get_stylesheet_uri(), array(), $version );

	// The accent color chosen in the Customizer becomes a CSS variable.
	$accent = sanitize_hex_color( get_theme_mod( 'my_coffee_theme_accent_color', my_coffee_theme_get_default( 'accent_color' ) ) );
	if ( $accent ) {
		wp_add_inline_style( 'my-coffee-theme-style', ':root{--accent:' . $accent . ';}' );
	}

	wp_enqueue_script(
		'my-coffee-theme-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		$version,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_coffee_theme_scripts' );

/**
 * Tell the stylesheet whether the sidebar has widgets, so the layout can adapt.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function my_coffee_theme_body_classes( $classes ) {
	$classes[] = is_active_sidebar( 'sidebar-1' ) ? 'has-sidebar' : 'no-sidebar';

	return $classes;
}
add_filter( 'body_class', 'my_coffee_theme_body_classes' );

/**
 * Replace the default "[...]" at the end of excerpts.
 *
 * @return string
 */
function my_coffee_theme_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'my_coffee_theme_excerpt_more' );

/**
 * Preload the heading font so text does not jump when it loads.
 */
function my_coffee_theme_preload_font() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( get_template_directory_uri() . '/assets/fonts/playfair-display.woff2' )
	);
}
add_action( 'wp_head', 'my_coffee_theme_preload_font', 1 );

/**
 * Relative luminance of a hex color (WCAG formula).
 *
 * @param string $hex Color like #aabbcc.
 * @return float
 */
function my_coffee_theme_luminance( $hex ) {
	$hex = ltrim( $hex, '#' );
	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	$channels = array();
	foreach ( array( 0, 2, 4 ) as $offset ) {
		$value      = hexdec( substr( $hex, $offset, 2 ) ) / 255;
		$channels[] = ( $value <= 0.03928 ) ? $value / 12.92 : pow( ( $value + 0.055 ) / 1.055, 2.4 );
	}

	return 0.2126 * $channels[0] + 0.7152 * $channels[1] + 0.0722 * $channels[2];
}

/**
 * Contrast ratio between two hex colors (from 1 to 21).
 *
 * @param string $first  First color.
 * @param string $second Second color.
 * @return float
 */
function my_coffee_theme_contrast_ratio( $first, $second ) {
	$first_luminance  = my_coffee_theme_luminance( $first );
	$second_luminance = my_coffee_theme_luminance( $second );

	return ( max( $first_luminance, $second_luminance ) + 0.05 ) / ( min( $first_luminance, $second_luminance ) + 0.05 );
}

/**
 * Reject accent colors that are hard to read on the page background.
 *
 * @param WP_Error $validity Validation result.
 * @param string   $value    Submitted color.
 * @return WP_Error
 */
function my_coffee_theme_validate_accent( $validity, $value ) {
	$color = sanitize_hex_color( $value );

	if ( ! $color ) {
		$validity->add( 'invalid_color', __( 'Please choose a valid color.', 'my-coffee-theme' ) );
	} elseif ( my_coffee_theme_contrast_ratio( $color, '#fbf3ea' ) < 4.5 ) {
		$validity->add( 'low_contrast', __( 'This color is too light to read on the page background. Please choose a darker one.', 'my-coffee-theme' ) );
	}

	return $validity;
}

/**
 * Customizer settings: homepage hero block and accent color.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function my_coffee_theme_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'my_coffee_theme_hero',
		array(
			'title'    => __( 'Homepage hero', 'my-coffee-theme' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_hero_title',
		array(
			'default'           => my_coffee_theme_get_default( 'hero_title' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'my_coffee_theme_hero_title',
		array(
			'label'   => __( 'Hero title', 'my-coffee-theme' ),
			'section' => 'my_coffee_theme_hero',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_hero_text',
		array(
			'default'           => my_coffee_theme_get_default( 'hero_text' ),
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'my_coffee_theme_hero_text',
		array(
			'label'   => __( 'Hero text', 'my-coffee-theme' ),
			'section' => 'my_coffee_theme_hero',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_hero_button_text',
		array(
			'default'           => my_coffee_theme_get_default( 'hero_button_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'my_coffee_theme_hero_button_text',
		array(
			'label'   => __( 'Button text (leave empty to hide the button)', 'my-coffee-theme' ),
			'section' => 'my_coffee_theme_hero',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_hero_button_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'my_coffee_theme_hero_button_url',
		array(
			'label'   => __( 'Button link', 'my-coffee-theme' ),
			'section' => 'my_coffee_theme_hero',
			'type'    => 'url',
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_accent_color',
		array(
			'default'           => my_coffee_theme_get_default( 'accent_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'validate_callback' => 'my_coffee_theme_validate_accent',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'my_coffee_theme_accent_color',
			array(
				'label'       => __( 'Accent color', 'my-coffee-theme' ),
				'description' => __( 'Used for links and the hero block. Dark colors only, so the text stays readable.', 'my-coffee-theme' ),
				'section'     => 'colors',
			)
		)
	);
}
add_action( 'customize_register', 'my_coffee_theme_customize_register' );

/**
 * Customizer setting: currency symbol shown next to menu prices.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function my_coffee_theme_customize_menu( $wp_customize ) {
	$wp_customize->add_section(
		'my_coffee_theme_menu',
		array(
			'title'    => __( 'Coffee menu', 'my-coffee-theme' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_currency',
		array(
			'default'           => '$',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'my_coffee_theme_currency',
		array(
			'label'   => __( 'Currency symbol', 'my-coffee-theme' ),
			'section' => 'my_coffee_theme_menu',
			'type'    => 'text',
		)
	);
}
add_action( 'customize_register', 'my_coffee_theme_customize_menu' );

// Coffee menu: post type, taxonomies, meta box and template helpers.
require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/template-tags.php';

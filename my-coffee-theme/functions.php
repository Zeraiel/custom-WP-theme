<?php
/**
 * My Coffee Theme functions and definitions.
 *
 * @package my-coffee-theme
 */

/**
 * Theme setup: supported features and menu locations.
 */
function my_coffee_theme_setup() {
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
			'primary' => 'Primary menu',
			'footer'  => 'Footer menu',
		)
	);
}
add_action( 'after_setup_theme', 'my_coffee_theme_setup' );

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
				'name'        => 'Sidebar',
				'id'          => 'sidebar-1',
				'description' => 'Widgets shown next to the main content.',
			)
		)
	);

	register_sidebar(
		array_merge(
			$defaults,
			array(
				'name'        => 'Footer widgets',
				'id'          => 'footer-1',
				'description' => 'Widgets shown at the bottom of every page.',
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
	$accent = sanitize_hex_color( get_theme_mod( 'my_coffee_theme_accent_color', '#6f4e37' ) );
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
}
add_action( 'wp_enqueue_scripts', 'my_coffee_theme_scripts' );

/**
 * Customizer settings: homepage hero block and accent color.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function my_coffee_theme_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'my_coffee_theme_hero',
		array(
			'title'    => 'Homepage hero',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_hero_title',
		array(
			'default'           => 'Freshly roasted coffee',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'my_coffee_theme_hero_title',
		array(
			'label'   => 'Hero title',
			'section' => 'my_coffee_theme_hero',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_hero_text',
		array(
			'default'           => 'Small-batch beans, roasted every week.',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'my_coffee_theme_hero_text',
		array(
			'label'   => 'Hero text',
			'section' => 'my_coffee_theme_hero',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_hero_button_text',
		array(
			'default'           => 'Read the blog',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'my_coffee_theme_hero_button_text',
		array(
			'label'   => 'Button text (leave empty to hide the button)',
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
			'label'   => 'Button link',
			'section' => 'my_coffee_theme_hero',
			'type'    => 'url',
		)
	);

	$wp_customize->add_setting(
		'my_coffee_theme_accent_color',
		array(
			'default'           => '#6f4e37',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'my_coffee_theme_accent_color',
			array(
				'label'   => 'Accent color',
				'section' => 'colors',
			)
		)
	);
}
add_action( 'customize_register', 'my_coffee_theme_customize_register' );

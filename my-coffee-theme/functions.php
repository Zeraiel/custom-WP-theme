<?php
function my_coffee_theme_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'my_coffee_theme_setup' );
function my_coffee_theme_scripts() {
	wp_enqueue_style(
		'my-coffee-theme-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'my_coffee_theme_scripts' );
<?php
function my_coffee_theme_scripts() {
    wp_enqueue_style( 'my-coffee-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'my_coffee_theme_scripts' );
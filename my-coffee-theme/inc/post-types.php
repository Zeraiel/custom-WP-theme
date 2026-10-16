<?php
/**
 * Custom post type and taxonomies for the coffee menu.
 *
 * @package my-coffee-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the "Menu item" post type and its taxonomies.
 */
function my_coffee_theme_register_menu() {
	register_post_type(
		'menu_item',
		array(
			'labels'        => array(
				'name'               => __( 'Menu items', 'my-coffee-theme' ),
				'singular_name'      => __( 'Menu item', 'my-coffee-theme' ),
				'add_new_item'       => __( 'Add new menu item', 'my-coffee-theme' ),
				'edit_item'          => __( 'Edit menu item', 'my-coffee-theme' ),
				'new_item'           => __( 'New menu item', 'my-coffee-theme' ),
				'view_item'          => __( 'View menu item', 'my-coffee-theme' ),
				'search_items'       => __( 'Search menu items', 'my-coffee-theme' ),
				'not_found'          => __( 'No menu items found', 'my-coffee-theme' ),
				'not_found_in_trash' => __( 'No menu items found in Trash', 'my-coffee-theme' ),
				'all_items'          => __( 'All menu items', 'my-coffee-theme' ),
				'menu_name'          => __( 'Coffee menu', 'my-coffee-theme' ),
			),
			'public'        => true,
			'has_archive'   => 'menu',
			'rewrite'       => array( 'slug' => 'menu' ),
			'menu_icon'     => 'dashicons-coffee',
			'menu_position' => 5,
			'show_in_rest'  => true,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		)
	);

	register_taxonomy(
		'menu_category',
		'menu_item',
		array(
			'labels'            => array(
				'name'          => __( 'Menu categories', 'my-coffee-theme' ),
				'singular_name' => __( 'Menu category', 'my-coffee-theme' ),
				'add_new_item'  => __( 'Add new menu category', 'my-coffee-theme' ),
				'search_items'  => __( 'Search menu categories', 'my-coffee-theme' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'menu-category' ),
		)
	);

	register_taxonomy(
		'roast_level',
		'menu_item',
		array(
			'labels'            => array(
				'name'          => __( 'Roast levels', 'my-coffee-theme' ),
				'singular_name' => __( 'Roast level', 'my-coffee-theme' ),
				'add_new_item'  => __( 'Add new roast level', 'my-coffee-theme' ),
				'search_items'  => __( 'Search roast levels', 'my-coffee-theme' ),
			),
			'hierarchical'      => false,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'roast' ),
		)
	);

	register_taxonomy(
		'origin',
		'menu_item',
		array(
			'labels'            => array(
				'name'          => __( 'Origins', 'my-coffee-theme' ),
				'singular_name' => __( 'Origin', 'my-coffee-theme' ),
				'add_new_item'  => __( 'Add new origin', 'my-coffee-theme' ),
				'search_items'  => __( 'Search origins', 'my-coffee-theme' ),
			),
			'hierarchical'      => false,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'origin' ),
		)
	);
}
add_action( 'init', 'my_coffee_theme_register_menu' );

/**
 * Refresh permalinks once when the theme is activated,
 * so the new /menu/ addresses work right away.
 */
function my_coffee_theme_rewrite_flush() {
	my_coffee_theme_register_menu();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_coffee_theme_rewrite_flush' );

/**
 * Show more items per page on the menu archive and menu taxonomy pages.
 *
 * @param WP_Query $query The main query.
 */
function my_coffee_theme_menu_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_post_type_archive( 'menu_item' ) || $query->is_tax( array( 'menu_category', 'roast_level', 'origin' ) ) ) {
		$query->set( 'posts_per_page', 12 );
	}
}
add_action( 'pre_get_posts', 'my_coffee_theme_menu_per_page' );

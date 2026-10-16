<?php
/**
 * Meta box with extra fields for menu items.
 *
 * @package my-coffee-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add the meta box to the menu item editing screen.
 */
function my_coffee_theme_add_menu_item_meta_box() {
	add_meta_box(
		'my_coffee_theme_menu_item_details',
		__( 'Menu item details', 'my-coffee-theme' ),
		'my_coffee_theme_render_menu_item_meta_box',
		'menu_item',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'my_coffee_theme_add_menu_item_meta_box' );

/**
 * Print the meta box fields.
 *
 * @param WP_Post $post The post being edited.
 */
function my_coffee_theme_render_menu_item_meta_box( $post ) {
	wp_nonce_field( 'my_coffee_theme_save_menu_item', 'my_coffee_theme_menu_item_nonce' );

	$price    = get_post_meta( $post->ID, '_menu_item_price', true );
	$weight   = get_post_meta( $post->ID, '_menu_item_weight', true );
	$notes    = get_post_meta( $post->ID, '_menu_item_notes', true );
	$featured = get_post_meta( $post->ID, '_menu_item_featured', true );
	?>
	<p>
		<label for="menu_item_price"><strong><?php esc_html_e( 'Price', 'my-coffee-theme' ); ?></strong></label><br>
		<input type="number" step="0.01" min="0" id="menu_item_price" name="menu_item_price" value="<?php echo esc_attr( $price ); ?>">
	</p>
	<p>
		<label for="menu_item_weight"><strong><?php esc_html_e( 'Weight, grams', 'my-coffee-theme' ); ?></strong> <?php esc_html_e( '(for beans and packs)', 'my-coffee-theme' ); ?></label><br>
		<input type="number" step="1" min="0" id="menu_item_weight" name="menu_item_weight" value="<?php echo esc_attr( $weight ); ?>">
	</p>
	<p>
		<label for="menu_item_notes"><strong><?php esc_html_e( 'Flavor notes', 'my-coffee-theme' ); ?></strong></label><br>
		<input type="text" class="widefat" id="menu_item_notes" name="menu_item_notes" value="<?php echo esc_attr( $notes ); ?>">
	</p>
	<p>
		<label>
			<input type="checkbox" name="menu_item_featured" value="1" <?php checked( '1', $featured ); ?>>
			<?php esc_html_e( 'Show on the homepage as a featured item', 'my-coffee-theme' ); ?>
		</label>
	</p>
	<?php
}

/**
 * Save the meta box fields.
 *
 * @param int $post_id The post ID.
 */
function my_coffee_theme_save_menu_item( $post_id ) {
	if ( ! isset( $_POST['my_coffee_theme_menu_item_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['my_coffee_theme_menu_item_nonce'] ) );
	if ( ! wp_verify_nonce( $nonce, 'my_coffee_theme_save_menu_item' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Price: a non-negative number, stored with two decimals.
	$price = isset( $_POST['menu_item_price'] ) ? sanitize_text_field( wp_unslash( $_POST['menu_item_price'] ) ) : '';
	if ( is_numeric( $price ) && (float) $price >= 0 ) {
		update_post_meta( $post_id, '_menu_item_price', number_format( (float) $price, 2, '.', '' ) );
	} else {
		delete_post_meta( $post_id, '_menu_item_price' );
	}

	// Weight: a positive whole number.
	$weight = isset( $_POST['menu_item_weight'] ) ? absint( wp_unslash( $_POST['menu_item_weight'] ) ) : 0;
	if ( $weight > 0 ) {
		update_post_meta( $post_id, '_menu_item_weight', $weight );
	} else {
		delete_post_meta( $post_id, '_menu_item_weight' );
	}

	// Flavor notes: plain text.
	$notes = isset( $_POST['menu_item_notes'] ) ? sanitize_text_field( wp_unslash( $_POST['menu_item_notes'] ) ) : '';
	if ( '' !== $notes ) {
		update_post_meta( $post_id, '_menu_item_notes', $notes );
	} else {
		delete_post_meta( $post_id, '_menu_item_notes' );
	}

	// Featured: a checkbox is only sent when it is ticked.
	if ( isset( $_POST['menu_item_featured'] ) ) {
		update_post_meta( $post_id, '_menu_item_featured', '1' );
	} else {
		delete_post_meta( $post_id, '_menu_item_featured' );
	}
}
add_action( 'save_post_menu_item', 'my_coffee_theme_save_menu_item' );

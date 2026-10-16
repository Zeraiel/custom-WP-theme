<?php
/**
 * Helper functions used in templates.
 *
 * @package my-coffee-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Print price, weight and flavor notes of a menu item.
 *
 * @param int $post_id Optional. Post ID, defaults to the current post.
 */
function my_coffee_theme_menu_item_details( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	$price  = get_post_meta( $post_id, '_menu_item_price', true );
	$weight = get_post_meta( $post_id, '_menu_item_weight', true );
	$notes  = get_post_meta( $post_id, '_menu_item_notes', true );

	if ( '' === $price && '' === $weight && '' === $notes ) {
		return;
	}

	$currency = get_theme_mod( 'my_coffee_theme_currency', '$' );

	echo '<ul class="menu-item-details">';

	if ( '' !== $price ) {
		echo '<li class="menu-item-details__price">' . esc_html( $currency . number_format_i18n( (float) $price, 2 ) ) . '</li>';
	}

	if ( '' !== $weight ) {
		/* translators: %s: weight in grams. */
		echo '<li class="menu-item-details__weight">' . esc_html( sprintf( __( '%s g', 'my-coffee-theme' ), number_format_i18n( absint( $weight ) ) ) ) . '</li>';
	}

	if ( '' !== $notes ) {
		echo '<li class="menu-item-details__notes">' . esc_html( $notes ) . '</li>';
	}

	echo '</ul>';
}

/**
 * Print the category, roast level and origin of a menu item as links.
 *
 * @param int $post_id Optional. Post ID, defaults to the current post.
 */
function my_coffee_theme_menu_item_terms( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	foreach ( array( 'menu_category', 'roast_level', 'origin' ) as $taxonomy ) {
		$taxonomy_object = get_taxonomy( $taxonomy );
		$list            = get_the_term_list( $post_id, $taxonomy, '', ', ' );

		if ( ! $taxonomy_object || ! $list || is_wp_error( $list ) ) {
			continue;
		}

		echo '<p class="menu-item-terms"><strong>' . esc_html( $taxonomy_object->labels->singular_name ) . ':</strong> ' . wp_kses_post( $list ) . '</p>';
	}
}

/**
 * Print the publication date and categories of a post.
 */
function my_coffee_theme_entry_meta() {
	?>
	<p class="entry-meta">
		<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<?php if ( has_category() ) : ?>
			<span class="entry-meta__categories"><?php the_category( ', ' ); ?></span>
		<?php endif; ?>
	</p>
	<?php
}

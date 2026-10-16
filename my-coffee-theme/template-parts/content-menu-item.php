<?php
/**
 * Template part: menu item card used in the menu grid.
 *
 * @package my-coffee-theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'menu-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"><?php the_post_thumbnail( 'medium' ); ?></a>
	<?php endif; ?>
	<div class="menu-card__body">
		<?php
		$my_coffee_theme_title = get_the_title();
		if ( '' === $my_coffee_theme_title ) {
			$my_coffee_theme_title = __( '(no title)', 'my-coffee-theme' );
		}
		?>
		<h2 class="menu-card__title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $my_coffee_theme_title ); ?></a></h2>
		<?php
		my_coffee_theme_menu_item_details();
		the_excerpt();
		?>
	</div>
</article>

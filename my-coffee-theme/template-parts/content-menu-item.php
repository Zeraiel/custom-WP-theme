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
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php
	my_coffee_theme_menu_item_details();
	the_excerpt();
	?>
</article>

<?php
/**
 * Template part: homepage hero block, edited in the Customizer.
 *
 * @package my-coffee-theme
 */

$my_coffee_theme_hero_title       = get_theme_mod( 'my_coffee_theme_hero_title', my_coffee_theme_get_default( 'hero_title' ) );
$my_coffee_theme_hero_text        = get_theme_mod( 'my_coffee_theme_hero_text', my_coffee_theme_get_default( 'hero_text' ) );
$my_coffee_theme_hero_button_text = get_theme_mod( 'my_coffee_theme_hero_button_text', my_coffee_theme_get_default( 'hero_button_text' ) );
$my_coffee_theme_hero_button_url  = get_theme_mod( 'my_coffee_theme_hero_button_url', '' );

if ( ! $my_coffee_theme_hero_title && ! $my_coffee_theme_hero_text ) {
	return;
}
?>
<section class="hero">
	<?php if ( $my_coffee_theme_hero_title ) : ?>
		<h2 class="hero__title"><?php echo esc_html( $my_coffee_theme_hero_title ); ?></h2>
	<?php endif; ?>

	<?php if ( $my_coffee_theme_hero_text ) : ?>
		<p class="hero__text"><?php echo esc_html( $my_coffee_theme_hero_text ); ?></p>
	<?php endif; ?>

	<?php if ( $my_coffee_theme_hero_button_text && $my_coffee_theme_hero_button_url ) : ?>
		<a class="hero__button" href="<?php echo esc_url( $my_coffee_theme_hero_button_url ); ?>"><?php echo esc_html( $my_coffee_theme_hero_button_text ); ?></a>
	<?php endif; ?>
</section>

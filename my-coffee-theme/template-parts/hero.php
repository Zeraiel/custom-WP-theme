<?php
$hero_title       = get_theme_mod( 'my_coffee_theme_hero_title', 'Freshly roasted coffee' );
$hero_text        = get_theme_mod( 'my_coffee_theme_hero_text', 'Small-batch beans, roasted every week.' );
$hero_button_text = get_theme_mod( 'my_coffee_theme_hero_button_text', 'Read the blog' );
$hero_button_url  = get_theme_mod( 'my_coffee_theme_hero_button_url', '' );

if ( ! $hero_title && ! $hero_text ) {
	return;
}
?>
<section class="hero">
	<?php if ( $hero_title ) : ?>
		<h2 class="hero__title"><?php echo esc_html( $hero_title ); ?></h2>
	<?php endif; ?>

	<?php if ( $hero_text ) : ?>
		<p class="hero__text"><?php echo esc_html( $hero_text ); ?></p>
	<?php endif; ?>

	<?php if ( $hero_button_text && $hero_button_url ) : ?>
		<a class="hero__button" href="<?php echo esc_url( $hero_button_url ); ?>"><?php echo esc_html( $hero_button_text ); ?></a>
	<?php endif; ?>
</section>

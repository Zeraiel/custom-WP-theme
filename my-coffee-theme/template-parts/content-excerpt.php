<?php
/**
 * Template part: post summary used in lists.
 *
 * @package my-coffee-theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"><?php the_post_thumbnail( 'medium_large' ); ?></a>
	<?php endif; ?>
	<div class="post-card__body">
		<?php
		if ( 'post' === get_post_type() ) {
			my_coffee_theme_entry_meta();
		}
		?>
		<?php
		$my_coffee_theme_title = get_the_title();
		if ( '' === $my_coffee_theme_title ) {
			$my_coffee_theme_title = __( '(no title)', 'my-coffee-theme' );
		}
		?>
		<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $my_coffee_theme_title ); ?></a></h2>
		<?php the_excerpt(); ?>
	</div>
</article>

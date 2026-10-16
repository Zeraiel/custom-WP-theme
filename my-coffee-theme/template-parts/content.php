<?php
/**
 * Template part: full content of a post or page.
 *
 * @package my-coffee-theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php
		if ( 'post' === get_post_type() ) {
			my_coffee_theme_entry_meta();
		}
		?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages();
		?>
	</div>

	<footer class="entry-footer">
		<?php
		if ( 'post' === get_post_type() ) {
			the_tags( '<p class="entry-tags">' . esc_html__( 'Tags: ', 'my-coffee-theme' ), ', ', '</p>' );
		}

		edit_post_link();
		?>
	</footer>
</article>

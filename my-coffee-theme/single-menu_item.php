<?php
/**
 * The template for displaying a single menu item.
 *
 * @package my-coffee-theme
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--menu-item' ); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
			<?php endif; ?>

			<?php
			my_coffee_theme_menu_item_details();
			my_coffee_theme_menu_item_terms();
			?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<footer class="entry-footer">
				<?php edit_post_link(); ?>
			</footer>
		</article>
		<?php
	endwhile;

	the_post_navigation(
		array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous item:', 'my-coffee-theme' ) . '</span> %title',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next item:', 'my-coffee-theme' ) . '</span> %title',
		)
	);
else :
	?>
	<p><?php esc_html_e( 'Menu item not found.', 'my-coffee-theme' ); ?></p>
	<?php
endif;

get_footer();

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
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large' );
			}

			my_coffee_theme_menu_item_details();
			my_coffee_theme_menu_item_terms();
			the_content();
			edit_post_link();
			?>
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

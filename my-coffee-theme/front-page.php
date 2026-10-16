<?php
/**
 * The front page template: featured menu items and the latest posts.
 *
 * @package my-coffee-theme
 */

get_header();

// Featured menu items appear only on the first page of the homepage.
if ( ! is_paged() ) :
	$featured = new WP_Query(
		array(
			'post_type'           => 'menu_item',
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'meta_query'          => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- Small query limited to three items.
				array(
					'key'   => '_menu_item_featured',
					'value' => '1',
				),
			),
		)
	);

	if ( $featured->have_posts() ) :
		?>
		<section class="featured-menu">
			<h2><?php esc_html_e( 'Featured from our menu', 'my-coffee-theme' ); ?></h2>
			<div class="menu-grid">
				<?php
				while ( $featured->have_posts() ) :
					$featured->the_post();
					get_template_part( 'template-parts/content', 'menu-item' );
				endwhile;
				?>
			</div>
			<p><a href="<?php echo esc_url( get_post_type_archive_link( 'menu_item' ) ); ?>"><?php esc_html_e( 'See the full menu', 'my-coffee-theme' ); ?></a></p>
		</section>
		<?php
		wp_reset_postdata();
	endif;
endif;

if ( have_posts() ) :
	?>
	<h2><?php esc_html_e( 'Latest posts', 'my-coffee-theme' ); ?></h2>
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'excerpt' );
	endwhile;

	the_posts_pagination();
endif;

get_footer();

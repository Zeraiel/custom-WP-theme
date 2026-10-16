<?php
/**
 * The template for displaying search results.
 *
 * @package my-coffee-theme
 */

get_header();

if ( have_posts() ) :
	?>
	<header class="search-header">
		<h1>
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search results for: %s', 'my-coffee-theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
			?>
		</h1>
	</header>
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'excerpt' );
	endwhile;

	the_posts_pagination();
else :
	?>
	<header class="search-header">
		<h1>
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Nothing found for: %s', 'my-coffee-theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
			?>
		</h1>
	</header>
	<p><?php esc_html_e( 'Sorry, nothing matched your search. Try different keywords.', 'my-coffee-theme' ); ?></p>
	<?php
endif;

get_footer();

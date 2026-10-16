<?php
/**
 * The main template file, used when no more specific template matches.
 *
 * @package my-coffee-theme
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'excerpt' );
	endwhile;

	the_posts_pagination();
else :
	?>
	<p><?php esc_html_e( 'No posts found.', 'my-coffee-theme' ); ?></p>
	<?php
endif;

get_footer();

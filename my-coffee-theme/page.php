<?php
/**
 * The template for displaying pages.
 *
 * @package my-coffee-theme
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content' );

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
else :
	?>
	<p><?php esc_html_e( 'Nothing found.', 'my-coffee-theme' ); ?></p>
	<?php
endif;

get_footer();

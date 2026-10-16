<?php
/**
 * The template for displaying single posts.
 *
 * @package my-coffee-theme
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content' );

		the_post_navigation(
			array(
				'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'my-coffee-theme' ) . '</span> %title',
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'my-coffee-theme' ) . '</span> %title',
			)
		);

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

<?php
/**
 * The template for displaying archive pages (categories, tags, dates, authors).
 *
 * @package my-coffee-theme
 */

get_header();

if ( have_posts() ) :
	?>
	<header class="archive-header">
		<?php
		the_archive_title( '<h1>', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header>
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'excerpt' );
	endwhile;

	the_posts_pagination();
else :
	?>
	<p><?php esc_html_e( 'Nothing found in this archive.', 'my-coffee-theme' ); ?></p>
	<?php
endif;

get_footer();

<?php
/**
 * The template for displaying menu categories, roast levels and origins.
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
	<div class="menu-grid">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'menu-item' );
		endwhile;
		?>
	</div>
	<?php
	the_posts_pagination();
else :
	?>
	<p><?php esc_html_e( 'Nothing here yet.', 'my-coffee-theme' ); ?></p>
	<?php
endif;

get_footer();

<?php
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
	echo '<p>Nothing found in this archive.</p>';
endif;

get_footer();

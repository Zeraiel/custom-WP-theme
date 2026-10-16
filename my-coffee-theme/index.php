<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'excerpt' );
	endwhile;

	the_posts_pagination();
else :
	echo '<p>No posts found. :(</p>';
endif;

get_footer();

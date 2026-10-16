<?php
get_header();

if ( have_posts() ) :
	?>
	<header class="search-header">
		<h1>Search results for: <span><?php echo esc_html( get_search_query() ); ?></span></h1>
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
		<h1>Nothing found for: <span><?php echo esc_html( get_search_query() ); ?></span></h1>
	</header>
	<p>Sorry, nothing matched your search. Try different keywords.</p>
	<?php
endif;

get_footer();

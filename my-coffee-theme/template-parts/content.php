<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1><?php the_title(); ?></h1>
	<?php
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( 'large' );
	}

	the_content();
	wp_link_pages();
	edit_post_link();
	?>
</article>

<?php 
get_header(); 
 if ( have_posts() ) : while ( have_posts() ) : the_post(); 
 get_template_part( 'template-parts/content' ); 
 endwhile; 
 next_posts_link(); 
 previous_posts_link(); 
 else: 
echo '<p>No posts found. :(</p>';
 endif;
  get_footer(); 
 ?>
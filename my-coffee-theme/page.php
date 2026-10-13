<?php
get_header(); 
 if ( have_posts() ) : while ( have_posts() ) : the_post(); 
 get_template_part( 'template-parts/content' ); 
 endwhile; 
 else: 
echo '<p>No content? :(</p>';
 endif;
  get_footer(); 
?>
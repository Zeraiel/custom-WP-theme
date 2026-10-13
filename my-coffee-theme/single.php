<?php
get_header(); 
 if ( have_posts() ) : while ( have_posts() ) : the_post(); 
 get_template_part( 'template-parts/content' ); 
 endwhile; 
 the_post_navigation ( array(
    'prev_text' => '%title',
    'next_text' => '%title',
 ));
 else: 
echo '<p>No posts found. :(</p>';
 endif;
  get_footer(); 
?>
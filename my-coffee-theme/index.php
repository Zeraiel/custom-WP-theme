<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<h3><?php the_title(); ?></h3>
<?php the_content(); ?>
<?php wp_link_pages(); ?>
<?php edit_post_link(); ?>
<?php endwhile; ?>
<?php next_posts_link(); ?>
<?php previous_posts_link(); ?>
<?php else: ?>
<p>No posts found. :(</p>
<?php endif; ?>
<?php get_footer(); ?>
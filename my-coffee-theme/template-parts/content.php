<article id="post-<?php the_ID(); ?>"<?php post_class( ); ?>>
<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
<?php wp_link_pages(); ?>
<?php edit_post_link(); ?>
</article>
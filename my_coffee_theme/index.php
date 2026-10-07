<?php get_header();?>
<div class="container">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post();?>
            <article <?php post_class(); ?>>
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile;?>
    <?php else :?>
        <p>Записей пока нет.</p>
    <?php endif;?>
</div>
<?php get_footer();?>

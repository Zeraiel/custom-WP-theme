<?php
/**
 * The template for the coffee menu archive (/menu/).
 *
 * @package my-coffee-theme
 */

get_header();

$categories = get_terms( array( 'taxonomy' => 'menu_category' ) );
?>
<header class="archive-header">
	<h1><?php post_type_archive_title(); ?></h1>

	<?php if ( ! is_wp_error( $categories ) && $categories ) : ?>
		<ul class="menu-filter">
			<?php foreach ( $categories as $category ) : ?>
				<li><a href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</header>
<?php
if ( have_posts() ) :
	?>
	<div class="menu-grid">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'menu-item' );
		endwhile;
		?>
	</div>
	<?php
	the_posts_pagination();
else :
	?>
	<p><?php esc_html_e( 'The menu is empty for now.', 'my-coffee-theme' ); ?></p>
	<?php
endif;

get_footer();

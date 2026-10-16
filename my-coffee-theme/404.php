<?php
/**
 * The template for displaying 404 (page not found) errors.
 *
 * @package my-coffee-theme
 */

get_header();
?>
<section class="error-404">
	<h1><?php esc_html_e( 'Page not found', 'my-coffee-theme' ); ?></h1>
	<p><?php esc_html_e( 'The page you are looking for does not exist or has been moved.', 'my-coffee-theme' ); ?></p>
	<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the homepage', 'my-coffee-theme' ); ?></a></p>
</section>
<?php
get_footer();

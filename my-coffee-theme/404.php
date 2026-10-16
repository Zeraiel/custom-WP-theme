<?php
get_header();
?>
<section class="error-404">
	<h1>Page not found</h1>
	<p>The page you are looking for does not exist or has been moved.</p>
	<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to the homepage</a></p>
</section>
<?php
get_footer();

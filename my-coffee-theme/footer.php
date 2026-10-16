</main>

<?php get_sidebar(); ?>
</div><!-- .site-content -->

<footer class="site-footer">
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<div class="footer-widgets">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>

	<?php
	if ( has_nav_menu( 'footer' ) ) :
		?>
		<nav class="footer-navigation" aria-label="Footer menu">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'depth'          => 1,
					'container'      => false,
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<p class="site-info">&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
</footer>

<?php wp_footer(); ?>
</body>
</html>

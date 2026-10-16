<?php
/**
 * The footer: closes the content area, sidebar, footer widgets and menu.
 *
 * @package my-coffee-theme
 */

?>
</main>

<?php get_sidebar(); ?>
</div><!-- .site-content -->

<footer class="site-footer">
<div class="site-footer__inner">
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<div class="footer-widgets">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'footer' ) ) : ?>
		<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer menu', 'my-coffee-theme' ); ?>">
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

	<p class="site-info">&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

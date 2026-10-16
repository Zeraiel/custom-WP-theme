<?php
/**
 * The header: document head, site branding, navigation and search.
 *
 * @package my-coffee-theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'my-coffee-theme' ); ?></a>

<header class="site-header">
<div class="site-header__inner">
	<div class="site-branding">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		}

		if ( is_front_page() || is_home() ) :
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></p>
		<?php endif; ?>
		<p class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
	</div>

	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'my-coffee-theme' ); ?>">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'my-coffee-theme' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<?php get_search_form(); ?>
</div>
</header>

<?php
if ( ( is_front_page() || is_home() ) && ! is_paged() ) {
	get_template_part( 'template-parts/hero' );
}
?>

<div class="site-content">
<main id="content" class="site-main">

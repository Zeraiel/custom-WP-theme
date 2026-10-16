<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="site-branding">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		}

		if ( is_front_page() || is_home() ) :
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif; ?>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
	</div>

	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav id="site-navigation" class="main-navigation" aria-label="Primary menu">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Menu</button>
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
</header>

<?php
if ( ( is_front_page() || is_home() ) && ! is_paged() ) {
	get_template_part( 'template-parts/hero' );
}
?>

<div class="site-content">
<main id="content" class="site-main">

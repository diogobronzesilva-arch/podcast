<?php
/**
 * Cabeçalho do tema.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="dns-prefetch" href="https://img.youtube.com">
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) : ?>
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-32x32.png' ); ?>">
		<link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/apple-touch-icon.png' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#primary"><?php esc_html_e( 'Saltar para o conteúdo', 'bronzepodcast' ); ?></a>
<header class="site-header" data-site-header>
	<div class="site-header__inner content-shell content-shell--wide">
		<div class="site-brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="custom-logo-link" aria-label="<?php esc_attr_e( 'Bronze Podcast — página inicial', 'bronzepodcast' ); ?>">
				<picture>
					<source srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/avatar_cruz_cristo.webp?v=' . BRONZEPODCAST_VERSION ); ?>" type="image/webp">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/avatar_cruz_cristo.png?v=' . BRONZEPODCAST_VERSION ); ?>" alt="<?php esc_attr_e( 'Bronze Podcast', 'bronzepodcast' ); ?>" width="72" height="72" class="custom-logo" fetchpriority="high">
				</picture>
			</a>
		</div>

		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" data-menu-toggle>
			<span class="menu-toggle__line"></span>
			<span class="menu-toggle__line"></span>
			<span class="menu-toggle__line"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Abrir menu', 'bronzepodcast' ); ?></span>
		</button>

		<nav id="site-navigation" class="site-navigation" aria-label="<?php esc_attr_e( 'Navegação principal', 'bronzepodcast' ); ?>" data-site-navigation>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'site-menu',
					'container'      => false,
					'fallback_cb'    => 'bronzepodcast_menu_fallback',
				)
			);
			?>
		</nav>

		<div class="site-actions">
			<a class="site-actions__listen" href="<?php echo esc_url( home_url( '/podcast/' ) ); ?>">
				<span class="site-actions__pulse" aria-hidden="true"></span>
				<?php esc_html_e( 'Ouvir', 'bronzepodcast' ); ?>
			</a>
			<?php bronzepodcast_cart_link(); ?>
		</div>
	</div>
</header>

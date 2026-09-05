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
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#primary"><?php esc_html_e( 'Saltar para o conteúdo', 'bronzepodcast' ); ?></a>
<header class="site-header" data-site-header>
	<div class="site-header__inner content-shell content-shell--wide">
		<div class="site-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php esc_attr_e( 'Bronze Podcast — página inicial', 'bronzepodcast' ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php esc_attr_e( 'Bronze Podcast', 'bronzepodcast' ); ?>" width="375" height="375">
				</a>
			<?php endif; ?>
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

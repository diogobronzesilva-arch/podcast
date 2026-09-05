<?php
/**
 * Página Loja antes e depois da ativação do WooCommerce.
 *
 * @package BronzePodcast
 */

get_header();
?>
<main id="primary" class="site-main">
	<section class="page-hero page-hero--store">
		<div class="page-hero__overlay"></div>
		<div class="content-shell content-shell--wide page-hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Loja Bronze', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'A Loja do Bronze Podcast.', 'bronzepodcast' ); ?></h1>
			<p class="page-hero__lede"><?php esc_html_e( 'Livros, terços, devoções e artigos religiosos para a vida de oração e a formação católica.', 'bronzepodcast' ); ?></p>
		</div>
	</section>

	<section class="section-pad">
		<div class="content-shell content-shell--wide">
			<div class="store-promises" aria-label="<?php esc_attr_e( 'Compromissos da Loja Bronze', 'bronzepodcast' ); ?>">
				<span><?php esc_html_e( 'Escolhas com critério', 'bronzepodcast' ); ?></span>
				<span><?php esc_html_e( 'Para rezar, ler e oferecer', 'bronzepodcast' ); ?></span>
				<span><?php esc_html_e( 'Enviado a partir de Portugal', 'bronzepodcast' ); ?></span>
			</div>
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<?php echo do_shortcode( '[products columns="3" paginate="true"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php else : ?>
				<div class="store-categories" aria-label="<?php esc_attr_e( 'Categorias da loja', 'bronzepodcast' ); ?>">
					<span><?php esc_html_e( 'Terços de Combate', 'bronzepodcast' ); ?></span>
					<span><?php esc_html_e( 'Artigos Religiosos', 'bronzepodcast' ); ?></span>
					<span><?php esc_html_e( 'Livros', 'bronzepodcast' ); ?></span>
					<span><?php esc_html_e( 'Biografias Ilustradas', 'bronzepodcast' ); ?></span>
				</div>
				<div class="setup-notice"><p><?php esc_html_e( 'O catálogo aparecerá aqui depois de instalar o WooCommerce e importar os produtos.', 'bronzepodcast' ); ?></p></div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();

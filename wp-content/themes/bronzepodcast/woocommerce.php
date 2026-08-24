<?php
/**
 * Template principal WooCommerce.
 *
 * @package BronzePodcast
 */

get_header();

if ( function_exists( 'is_shop' ) && is_shop() ) :
	?>
	<section class="page-hero page-hero--store">
		<div class="page-hero__overlay"></div>
		<div class="content-shell content-shell--wide page-hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Loja Bronze', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'A Loja do Bronze Podcast.', 'bronzepodcast' ); ?></h1>
			<p class="page-hero__lede"><?php esc_html_e( 'Livros, devoções e artigos religiosos escolhidos pelo que são e pelo bem que podem fazer.', 'bronzepodcast' ); ?></p>
		</div>
	</section>
	<div class="store-promises-wrap">
		<div class="content-shell content-shell--wide store-promises" aria-label="<?php esc_attr_e( 'Compromissos da Loja Bronze', 'bronzepodcast' ); ?>">
			<span><?php esc_html_e( 'Escolha cuidada', 'bronzepodcast' ); ?></span>
			<span><?php esc_html_e( 'Artigos com finalidade', 'bronzepodcast' ); ?></span>
			<span><?php esc_html_e( 'Envio a partir de Portugal', 'bronzepodcast' ); ?></span>
		</div>
	</div>
	<?php
endif;

woocommerce_content();
get_footer();

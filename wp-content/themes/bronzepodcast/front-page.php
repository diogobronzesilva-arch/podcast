<?php
/**
 * Página inicial.
 *
 * @package BronzePodcast
 */

get_header();
?>
<main id="primary" class="site-main home-main">
	<section class="hero">
		<div class="hero__overlay"></div>
		<div class="content-shell content-shell--wide hero__content">
			<div class="hero__copy">
				<h1><?php esc_html_e( 'Bronze Podcast', 'bronzepodcast' ); ?></h1>
				<p class="hero__intro"><?php esc_html_e( 'Um espaço de conversa sobre a Fé Católica, a tradição e Portugal.', 'bronzepodcast' ); ?></p>
				<div class="hero__actions">
					<a class="button button--accent" href="<?php echo esc_url( home_url( '/podcast/' ) ); ?>"><?php esc_html_e( 'Ver episódios', 'bronzepodcast' ); ?><span aria-hidden="true">→</span></a>
					<a class="button button--ghost" href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Conhecer o projeto', 'bronzepodcast' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="episodes section-pad" aria-labelledby="episodes-title">
		<div class="content-shell content-shell--wide">
			<div class="section-heading section-heading--split">
				<div>
					<h2 id="episodes-title"><?php esc_html_e( 'Podcast', 'bronzepodcast' ); ?></h2>
				</div>
				<p class="section-heading__lede"><?php esc_html_e( 'Episódios recentes do canal, para ver ou ouvir no teu ritmo.', 'bronzepodcast' ); ?></p>
			</div>
			<div class="episode-grid">
				<article class="episode-card">
					<div class="video-frame">
						<iframe src="https://www.youtube-nocookie.com/embed/xsM6DrjWxM4" title="<?php esc_attr_e( 'B07 — A Violência | Bronze Podcast', 'bronzepodcast' ); ?>" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
					<div class="episode-card__meta"><span><?php esc_html_e( 'B07 — A Violência', 'bronzepodcast' ); ?></span><a href="https://www.youtube.com/watch?v=xsM6DrjWxM4" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Ver no YouTube', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></a></div>
				</article>
				<article class="episode-card">
					<div class="video-frame">
						<iframe src="https://www.youtube-nocookie.com/embed/YaPC_g224TQ" title="<?php esc_attr_e( '#47 — O Silêncio | Bronze Podcast', 'bronzepodcast' ); ?>" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
					<div class="episode-card__meta"><span><?php esc_html_e( '#47 — O Silêncio', 'bronzepodcast' ); ?></span><a href="https://www.youtube.com/watch?v=YaPC_g224TQ" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Ver no YouTube', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></a></div>
				</article>
			</div>
		</div>
	</section>

	<section class="store-feature section-pad" aria-labelledby="store-title">
		<div class="content-shell content-shell--wide">
			<div class="store-feature__heading">
				<div class="store-feature__intro">
					<p class="eyebrow"><?php esc_html_e( 'Loja Bronze', 'bronzepodcast' ); ?></p>
					<h2 id="store-title"><?php esc_html_e( 'Loja', 'bronzepodcast' ); ?></h2>
					<p><?php esc_html_e( 'Terços, livros e objectos escolhidos para acompanhar a oração, a formação e a casa.', 'bronzepodcast' ); ?></p>
				</div>
				<a class="button button--accent" href="<?php echo esc_url( bronzepodcast_store_url() ); ?>"><?php esc_html_e( 'Explorar a loja', 'bronzepodcast' ); ?> <span aria-hidden="true">→</span></a>
			</div>

			<?php if ( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_products' ) && wc_get_products( array( 'limit' => 1, 'status' => 'publish', 'return' => 'ids' ) ) ) : ?>
				<?php echo do_shortcode( '[products limit="6" columns="3" orderby="date" order="DESC" visibility="visible"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<a class="store-feature__all text-link" href="<?php echo esc_url( bronzepodcast_store_url() ); ?>"><?php esc_html_e( 'Ver todas as peças', 'bronzepodcast' ); ?> <span aria-hidden="true">→</span></a>
			<?php else : ?>
				<div class="collection-preview" aria-label="<?php esc_attr_e( 'Coleções em preparação', 'bronzepodcast' ); ?>">
					<article><span>01</span><h3><?php esc_html_e( 'Terços de combate', 'bronzepodcast' ); ?></h3><p><?php esc_html_e( 'Para rezar e levar todos os dias.', 'bronzepodcast' ); ?></p></article>
					<article><span>02</span><h3><?php esc_html_e( 'Livros e biografias', 'bronzepodcast' ); ?></h3><p><?php esc_html_e( 'Para conhecer melhor a Fé, a Igreja e os Santos.', 'bronzepodcast' ); ?></p></article>
					<article><span>03</span><h3><?php esc_html_e( 'Artigos religiosos', 'bronzepodcast' ); ?></h3><p><?php esc_html_e( 'Objectos simples para recordar o essencial.', 'bronzepodcast' ); ?></p></article>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="manifesto section-pad">
		<div class="content-shell content-shell--wide manifesto__inner">
			<div>
				<h2><?php esc_html_e( 'Não se pode separar a Fé da Nação.', 'bronzepodcast' ); ?></h2>
			</div>
			<div class="manifesto__copy">
				<p><?php esc_html_e( 'A fé não vive fora da história, da família ou da Nação. O Bronze existe para conversar sobre isso com clareza e sem fingimento.', 'bronzepodcast' ); ?></p>
				<a class="button button--outline" href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Ler mais', 'bronzepodcast' ); ?><span aria-hidden="true">→</span></a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();

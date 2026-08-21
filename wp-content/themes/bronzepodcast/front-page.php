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
		<div class="hero__halo" aria-hidden="true"></div>
		<div class="content-shell content-shell--wide hero__content">
			<div class="hero__copy">
				<p class="eyebrow"><?php esc_html_e( 'Fé · Tradição · Portugal', 'bronzepodcast' ); ?></p>
				<h1><?php esc_html_e( 'Um podcast católico para tempos que pedem clareza.', 'bronzepodcast' ); ?></h1>
				<p class="hero__intro"><?php esc_html_e( 'Conversas sobre a fé, a Igreja e a cultura portuguesa — sem ruído, sem atalhos e com os olhos postos no essencial.', 'bronzepodcast' ); ?></p>
				<div class="hero__actions">
					<a class="button button--accent" href="<?php echo esc_url( home_url( '/podcast/' ) ); ?>"><?php esc_html_e( 'Ouvir o podcast', 'bronzepodcast' ); ?><span aria-hidden="true">↗</span></a>
					<a class="button button--ghost" href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Conhecer o projeto', 'bronzepodcast' ); ?></a>
				</div>
			</div>
			<aside class="hero__note" aria-label="Manifesto Bronze Podcast">
				<span class="hero__note-index">01</span>
				<p><?php esc_html_e( 'Só Cristo pode acalmar a tormenta, na Igreja e no mundo.', 'bronzepodcast' ); ?></p>
				<span class="hero__note-signature">AMDG</span>
			</aside>
		</div>
	</section>

	<div class="signal-strip" aria-label="Bronze Podcast em resumo">
		<div class="content-shell content-shell--wide signal-strip__inner">
			<p><strong><?php esc_html_e( 'Desde 2020', 'bronzepodcast' ); ?></strong><span><?php esc_html_e( 'Uma voz independente', 'bronzepodcast' ); ?></span></p>
			<p><strong><?php esc_html_e( 'Podcast + Artigos', 'bronzepodcast' ); ?></strong><span><?php esc_html_e( 'Ideias para ouvir e guardar', 'bronzepodcast' ); ?></span></p>
			<p><strong><?php esc_html_e( 'Portugal', 'bronzepodcast' ); ?></strong><span><?php esc_html_e( 'Fé ligada à nossa história', 'bronzepodcast' ); ?></span></p>
		</div>
	</div>

	<section class="episodes section-pad" aria-labelledby="episodes-title">
		<div class="content-shell content-shell--wide">
			<div class="section-heading section-heading--split">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Em destaque', 'bronzepodcast' ); ?></p>
					<h2 id="episodes-title"><?php esc_html_e( 'Conversas para ouvir com tempo.', 'bronzepodcast' ); ?></h2>
				</div>
				<p class="section-heading__lede"><?php esc_html_e( 'Episódios recentes sobre fé, tradição e os sinais do nosso tempo.', 'bronzepodcast' ); ?></p>
			</div>
			<div class="episode-grid">
				<article class="episode-card">
					<div class="video-frame">
						<iframe src="https://www.youtube-nocookie.com/embed/5zQscJKPbWA" title="<?php esc_attr_e( 'Episódio recente do Bronze Podcast', 'bronzepodcast' ); ?>" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
					<div class="episode-card__meta"><span><?php esc_html_e( 'Bronze Podcast', 'bronzepodcast' ); ?></span><strong><?php esc_html_e( 'Ver no YouTube', 'bronzepodcast' ); ?> ↗</strong></div>
				</article>
				<article class="episode-card">
					<div class="video-frame">
						<iframe src="https://www.youtube-nocookie.com/embed/2EZZfALA6wE" title="<?php esc_attr_e( 'Episódio recente do Bronze Podcast', 'bronzepodcast' ); ?>" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
					<div class="episode-card__meta"><span><?php esc_html_e( 'Novo episódio', 'bronzepodcast' ); ?></span><strong><?php esc_html_e( 'Ver no YouTube', 'bronzepodcast' ); ?> ↗</strong></div>
				</article>
			</div>
		</div>
	</section>

	<section class="store-feature section-pad" aria-labelledby="store-title">
		<div class="content-shell content-shell--wide">
			<div class="section-heading section-heading--split">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Loja Bronze', 'bronzepodcast' ); ?></p>
					<h2 id="store-title"><?php esc_html_e( 'Objetos com significado, feitos para permanecer.', 'bronzepodcast' ); ?></h2>
				</div>
				<a class="text-link" href="<?php echo esc_url( bronzepodcast_store_url() ); ?>"><?php esc_html_e( 'Conhecer a loja', 'bronzepodcast' ); ?> <span>↗</span></a>
			</div>

			<?php if ( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_products' ) && wc_get_products( array( 'limit' => 1, 'status' => 'publish', 'return' => 'ids' ) ) ) : ?>
				<?php echo do_shortcode( '[products limit="6" columns="3" orderby="date" order="DESC" visibility="visible"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php else : ?>
				<div class="collection-preview" aria-label="<?php esc_attr_e( 'Coleções em preparação', 'bronzepodcast' ); ?>">
					<article><span>01</span><h3><?php esc_html_e( 'Terços de combate', 'bronzepodcast' ); ?></h3><p><?php esc_html_e( 'Peças de devoção para a vida diária.', 'bronzepodcast' ); ?></p></article>
					<article><span>02</span><h3><?php esc_html_e( 'Livros e biografias', 'bronzepodcast' ); ?></h3><p><?php esc_html_e( 'Leituras que formam e acompanham.', 'bronzepodcast' ); ?></p></article>
					<article><span>03</span><h3><?php esc_html_e( 'Artigos religiosos', 'bronzepodcast' ); ?></h3><p><?php esc_html_e( 'Uma seleção sóbria, com história e propósito.', 'bronzepodcast' ); ?></p></article>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="manifesto section-pad">
		<div class="content-shell content-shell--wide manifesto__inner">
			<div>
				<p class="eyebrow"><?php esc_html_e( 'O que nos move', 'bronzepodcast' ); ?></p>
				<h2><?php esc_html_e( 'Fé no essencial. Coragem no presente.', 'bronzepodcast' ); ?></h2>
			</div>
			<div class="manifesto__copy">
				<p><?php esc_html_e( 'Num tempo de ruído e dispersão, o Bronze Podcast procura voltar ao que não muda: a fé, a verdade e a responsabilidade de cada cristão.', 'bronzepodcast' ); ?></p>
				<a class="button button--outline" href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Ler o manifesto', 'bronzepodcast' ); ?><span aria-hidden="true">→</span></a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();

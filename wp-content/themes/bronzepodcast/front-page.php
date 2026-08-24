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
				<p class="eyebrow"><?php esc_html_e( 'Desde 2020', 'bronzepodcast' ); ?></p>
				<h1><?php esc_html_e( 'Bronze Podcast.', 'bronzepodcast' ); ?></h1>
				<p class="hero__intro"><?php esc_html_e( 'Um espaço de conversa sobre a Fé Católica, a tradição e Portugal. Feito para quem quer pensar sem barulho e viver com mais firmeza.', 'bronzepodcast' ); ?></p>
				<div class="hero__actions">
					<a class="button button--accent" href="<?php echo esc_url( home_url( '/podcast/' ) ); ?>"><?php esc_html_e( 'Ver episódios', 'bronzepodcast' ); ?><span aria-hidden="true">↗</span></a>
					<a class="button button--ghost" href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Conhecer o Bronze', 'bronzepodcast' ); ?></a>
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
			<p><strong><?php esc_html_e( 'Desde 2020', 'bronzepodcast' ); ?></strong><span><?php esc_html_e( 'Conversas sem pressa', 'bronzepodcast' ); ?></span></p>
			<p><strong><?php esc_html_e( 'YouTube + Spotify', 'bronzepodcast' ); ?></strong><span><?php esc_html_e( 'Vídeo para ver, áudio para levar', 'bronzepodcast' ); ?></span></p>
			<p><strong><?php esc_html_e( 'Portugal', 'bronzepodcast' ); ?></strong><span><?php esc_html_e( 'Fé, família e Nação', 'bronzepodcast' ); ?></span></p>
		</div>
	</div>

	<section class="episodes section-pad" aria-labelledby="episodes-title">
		<div class="content-shell content-shell--wide">
			<div class="section-heading section-heading--split">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Podcast', 'bronzepodcast' ); ?></p>
					<h2 id="episodes-title"><?php esc_html_e( 'O que saiu agora.', 'bronzepodcast' ); ?></h2>
				</div>
				<p class="section-heading__lede"><?php esc_html_e( 'Episódios recentes do canal, para ver ou ouvir no teu ritmo.', 'bronzepodcast' ); ?></p>
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
					<p class="eyebrow"><?php esc_html_e( 'Loja', 'bronzepodcast' ); ?></p>
					<h2 id="store-title"><?php esc_html_e( 'Coisas que vale a pena guardar.', 'bronzepodcast' ); ?></h2>
				</div>
				<a class="text-link" href="<?php echo esc_url( bronzepodcast_store_url() ); ?>"><?php esc_html_e( 'Ver a loja', 'bronzepodcast' ); ?> <span>↗</span></a>
			</div>

			<?php if ( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_products' ) && wc_get_products( array( 'limit' => 1, 'status' => 'publish', 'return' => 'ids' ) ) ) : ?>
				<?php echo do_shortcode( '[products limit="6" columns="3" category="tercos-de-combate" orderby="date" order="DESC" visibility="visible"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
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
				<p class="eyebrow"><?php esc_html_e( 'O manifesto', 'bronzepodcast' ); ?></p>
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

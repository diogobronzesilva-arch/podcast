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

	<!-- Episódio em Destaque & Conversas Recentes -->
	<?php
	$featured_episode = function_exists( 'bronzepodcast_get_featured_episode' ) ? bronzepodcast_get_featured_episode() : null;
	$all_episodes     = function_exists( 'bronzepodcast_get_all_episodes' ) ? bronzepodcast_get_all_episodes( 4 ) : array();
	$recent_highlights = array();
	if ( ! empty( $all_episodes ) ) {
		// Se o primeiro episódio for o mesmo do destaque, usamos os seguintes para a grelha
		if ( $featured_episode && isset( $all_episodes[0]['id'], $featured_episode['id'] ) && $all_episodes[0]['id'] === $featured_episode['id'] ) {
			$recent_highlights = array_slice( $all_episodes, 1, 3 );
		} else {
			$recent_highlights = array_slice( $all_episodes, 0, 3 );
		}
	}
	?>
	<section class="podcast-featured section-pad" aria-labelledby="home-featured-title">
		<div class="content-shell content-shell--wide">
			<div class="section-heading section-heading--split">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Conversas & Transmissões', 'bronzepodcast' ); ?></p>
					<h2 id="home-featured-title"><?php esc_html_e( 'Último Episódio', 'bronzepodcast' ); ?></h2>
				</div>
				<p class="section-heading__lede"><?php esc_html_e( 'Conversas sobre a Fé Católica, a vida em família e os problemas do nosso tempo.', 'bronzepodcast' ); ?></p>
			</div>

			<?php if ( ! empty( $featured_episode ) ) : ?>
			<div class="podcast-featured__card">
				<div class="podcast-featured__media">
					<a class="video-frame podcast-featured__poster" href="<?php echo esc_url( $featured_episode['youtube'] ); ?>" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'Assistir no YouTube', 'bronzepodcast' ); ?>">
						<img src="https://img.youtube.com/vi/<?php echo esc_attr( $featured_episode['id'] ); ?>/maxresdefault.jpg" alt="<?php echo esc_attr( $featured_episode['title'] ); ?>" loading="lazy" width="1280" height="720">
						<span class="podcast-featured__play" aria-hidden="true">
							<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
						</span>
						<span class="podcast-featured__label"><?php esc_html_e( 'Assistir no YouTube', 'bronzepodcast' ); ?> ↗</span>
					</a>
				</div>
				<div class="podcast-featured__info">
					<div class="podcast-badge-wrap">
						<span class="podcast-badge"><?php echo esc_html( $featured_episode['code'] ); ?></span>
						<span class="podcast-concept"><?php echo esc_html( $featured_episode['concept'] ); ?></span>
					</div>
					<h3><?php echo esc_html( $featured_episode['title'] ); ?></h3>
					<p class="podcast-featured__desc"><?php echo esc_html( $featured_episode['desc'] ); ?></p>
					<div class="podcast-featured__actions">
						<a class="button button--accent" href="<?php echo esc_url( $featured_episode['youtube'] ); ?>" target="_blank" rel="noopener noreferrer">
							<svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
							<span><?php esc_html_e( 'Ver no YouTube', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></span>
						</a>
						<?php if ( ! empty( $featured_episode['spotify'] ) ) : ?>
						<a class="button button--spotify" href="<?php echo esc_url( $featured_episode['spotify'] ); ?>" target="_blank" rel="noopener noreferrer">
							<svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
							<span><?php esc_html_e( 'Ouvir no Spotify', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></span>
						</a>
						<?php endif; ?>
						<a class="button button--ghost" href="<?php echo esc_url( home_url( '/podcast/' ) ); ?>">
							<span><?php esc_html_e( 'Ver todos os episódios', 'bronzepodcast' ); ?> →</span>
						</a>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<!-- Destaques Recentes -->
			<?php if ( ! empty( $recent_highlights ) ) : ?>
			<div class="podcast-grid" style="margin-top: 40px;">
				<?php foreach ( $recent_highlights as $highlight ) : ?>
				<article class="podcast-card">
					<a class="podcast-card__thumb-wrap" href="<?php echo esc_url( $highlight['youtube'] ); ?>" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'Assistir no YouTube', 'bronzepodcast' ); ?>">
						<img src="https://img.youtube.com/vi/<?php echo esc_attr( $highlight['id'] ); ?>/hqdefault.jpg" alt="<?php echo esc_attr( $highlight['title'] ); ?>" loading="lazy" width="480" height="360">
						<span class="podcast-card__tag"><?php echo esc_html( mb_strtoupper( $highlight['concept'], 'UTF-8' ) ); ?></span>
						<span class="podcast-card__play-badge" aria-hidden="true">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
						</span>
						<span class="podcast-card__thumb-label"><?php esc_html_e( 'Ver no YouTube', 'bronzepodcast' ); ?> ↗</span>
					</a>
					<div class="podcast-card__content">
						<div class="podcast-card__meta"><span class="podcast-card__code"><?php echo esc_html( $highlight['code'] ); ?></span></div>
						<h3 class="podcast-card__title">
							<a href="<?php echo esc_url( $highlight['youtube'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $highlight['title'] ); ?></a>
						</h3>
						<p class="podcast-card__desc"><?php echo esc_html( $highlight['desc'] ); ?></p>
						<div class="podcast-card__actions">
							<a class="text-link" href="<?php echo esc_url( $highlight['youtube'] ); ?>" target="_blank" rel="noopener noreferrer">
								<?php esc_html_e( 'YouTube', 'bronzepodcast' ); ?> <span>↗</span>
							</a>
							<?php if ( ! empty( $highlight['spotify'] ) ) : ?>
							<a class="text-link" href="<?php echo esc_url( $highlight['spotify'] ); ?>" target="_blank" rel="noopener noreferrer" style="margin-left: auto; color: var(--paper-soft);">
								<?php esc_html_e( 'Spotify', 'bronzepodcast' ); ?> <span>↗</span>
							</a>
							<?php endif; ?>
						</div>
					</div>
				</article>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
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
				<?php echo do_shortcode( '[products limit="6" columns="3" category="tercos-de-combate" orderby="menu_order date" order="ASC" visibility="visible"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
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
				<p><?php esc_html_e( 'A fé não vive fora da história, da família ou da Nação.', 'bronzepodcast' ); ?></p>
				<a class="button button--outline" href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Ler mais', 'bronzepodcast' ); ?><span aria-hidden="true">→</span></a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();

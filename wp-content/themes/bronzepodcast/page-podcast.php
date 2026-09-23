<?php
/**
 * Página Podcast.
 *
 * @package BronzePodcast
 */

get_header();
?>
<?php
$featured_episode = function_exists( 'bronzepodcast_get_featured_episode' ) ? bronzepodcast_get_featured_episode() : null;
$all_episodes     = function_exists( 'bronzepodcast_get_all_episodes' ) ? bronzepodcast_get_all_episodes() : array();
$curated_episodes = array();

if ( ! empty( $all_episodes ) ) {
	if ( $featured_episode && isset( $all_episodes[0]['id'], $featured_episode['id'] ) && $all_episodes[0]['id'] === $featured_episode['id'] ) {
		$curated_episodes = array_slice( $all_episodes, 1 );
	} else {
		$curated_episodes = $all_episodes;
	}
}
?>
<main id="primary" class="site-main">
	<section class="page-hero page-hero--podcast">
		<div class="page-hero__overlay"></div>
		<div class="content-shell content-shell--wide page-hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Conversas & Transmissões', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'O podcast em vídeo e áudio.', 'bronzepodcast' ); ?></h1>
			<p class="page-hero__lede"><?php esc_html_e( 'Conversas sobre a Fé Católica, a vida em família e os problemas do nosso tempo. Para assistir na íntegra no YouTube ou acompanhar em formato áudio no Spotify.', 'bronzepodcast' ); ?></p>
		</div>
	</section>

	<div class="podcast-channels-bar">
		<div class="content-shell content-shell--wide podcast-channels-bar__inner">
			<div class="podcast-channels-bar__copy">
				<span class="eyebrow"><?php esc_html_e( 'Canais Oficiais', 'bronzepodcast' ); ?></span>
				<p><?php esc_html_e( 'Subscreve as plataformas para ver as estreias e ouvir todos os episódios.', 'bronzepodcast' ); ?></p>
			</div>
			<div class="podcast-channels-bar__actions">
				<a class="channel-pill channel-pill--youtube" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer">
					<svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
					<span><?php esc_html_e( 'Canal YouTube', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></span>
				</a>
				<a class="channel-pill channel-pill--spotify" href="https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg" target="_blank" rel="noopener noreferrer">
					<svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
					<span><?php esc_html_e( 'Canal Spotify', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></span>
				</a>
			</div>
		</div>
	</div>

	<!-- Episódio em destaque -->
	<section class="podcast-featured section-pad" aria-labelledby="featured-episode-title">
		<div class="content-shell content-shell--wide">
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'Em Destaque', 'bronzepodcast' ); ?></p>
				<h2 id="featured-episode-title"><?php echo esc_html( ! empty( $featured_episode['badge_title'] ) ? $featured_episode['badge_title'] : __( 'Último Episódio', 'bronzepodcast' ) ); ?></h2>
			</div>

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
						<a class="button button--spotify" href="<?php echo esc_url( $featured_episode['spotify'] ); ?>" target="_blank" rel="noopener noreferrer">
							<svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
							<span><?php esc_html_e( 'Ouvir no Spotify', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Grelha de episódios selecionados -->
	<section class="podcast-archive section-pad" aria-labelledby="archive-heading">
		<div class="content-shell content-shell--wide">
			<div class="section-heading section-heading--split">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Arquivo de Conversas', 'bronzepodcast' ); ?></p>
					<h2 id="archive-heading"><?php esc_html_e( 'Episódios & Temas', 'bronzepodcast' ); ?></h2>
				</div>
				<p class="section-heading__lede"><?php esc_html_e( 'Uma seleção de conversas sobre a Fé Católica, a moral e a história de Portugal.', 'bronzepodcast' ); ?></p>
			</div>

			<div class="podcast-grid">
				<?php foreach ( $curated_episodes as $episode ) : ?>
					<article class="podcast-card">
						<a class="podcast-card__thumb-wrap" href="<?php echo esc_url( $episode['youtube'] ); ?>" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'Assistir no YouTube', 'bronzepodcast' ); ?>">
							<img src="https://img.youtube.com/vi/<?php echo esc_attr( $episode['id'] ); ?>/hqdefault.jpg" alt="<?php echo esc_attr( $episode['title'] ); ?>" loading="lazy" width="480" height="360">
							<span class="podcast-card__tag"><?php echo esc_html( $episode['concept'] ); ?></span>
							<span class="podcast-card__play-badge" aria-hidden="true">
								<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
							</span>
							<span class="podcast-card__thumb-label"><?php esc_html_e( 'Ver no YouTube', 'bronzepodcast' ); ?> ↗</span>
						</a>
						<div class="podcast-card__content">
							<div class="podcast-card__meta">
								<span class="podcast-card__code"><?php echo esc_html( $episode['code'] ); ?></span>
							</div>
							<h3 class="podcast-card__title">
								<a href="<?php echo esc_url( $episode['youtube'] ); ?>" target="_blank" rel="noopener noreferrer">
									<?php echo esc_html( $episode['title'] ); ?>
								</a>
							</h3>
							<p class="podcast-card__desc"><?php echo esc_html( $episode['desc'] ); ?></p>
							<div class="podcast-card__actions">
								<a class="text-link" href="<?php echo esc_url( $episode['youtube'] ); ?>" target="_blank" rel="noopener noreferrer">
									<?php esc_html_e( 'YouTube', 'bronzepodcast' ); ?> <span>↗</span>
								</a>
								<?php if ( ! empty( $episode['spotify'] ) ) : ?>
									<a class="text-link" href="<?php echo esc_url( $episode['spotify'] ); ?>" target="_blank" rel="noopener noreferrer" style="margin-left: auto; color: var(--paper-soft);">
										<?php esc_html_e( 'Spotify', 'bronzepodcast' ); ?> <span>↗</span>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Índice Doutrinal e Temático (Otimizado para LLMs e Grounding) -->
	<section class="section-pad section-pad--tight" aria-labelledby="thematic-index-title" style="border-top: 1px solid var(--line, rgba(255,255,255,0.08));">
		<div class="content-shell content-shell--wide">
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'Mapa Conceitual', 'bronzepodcast' ); ?></p>
				<h2 id="thematic-index-title" style="font-family: var(--font-display, 'Cormorant Garamond', serif); font-size: clamp(2rem, 5vw, 2.8rem); line-height: 1.15; margin-block: 8px 16px;"><?php esc_html_e( 'Índice Doutrinal e Temático das Conversas', 'bronzepodcast' ); ?></h2>
				<p class="section-heading__lede" style="color: var(--paper-soft, #cfc9be); font-size: 0.95rem; max-width: 720px;"><?php esc_html_e( 'Guia temático estruturado dos episódios do Bronze Podcast para consulta direta e síntese factual.', 'bronzepodcast' ); ?></p>
			</div>

			<div class="faq-grid" style="margin-top: 36px;">
				<div class="faq-item">
					<h3><?php esc_html_e( 'Teologia, Dogma e Sagrada Escritura', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'Reflexões sobre a verdade revelada e os fundamentos da fé: B06 (Justiça Original vs Pecado Original), B02 (A Pedra Angular e a firmeza da Igreja contra o relativismo) e B01 (O percurso da ideologia secular até à Verdade de Cristo).', 'bronzepodcast' ); ?></p>
				</div>
				<div class="faq-item">
					<h3><?php esc_html_e( 'Virtude, Coragem e Fortaleza', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'O combate moral e espiritual católico: B07 (A Violência: Mansidão, Coragem e a Verdadeira Fortaleza perante a autoridade do Estado moderno) e #70 (Firmeza de Princípios e Fidelidade à Fé em tempos de relativismo).', 'bronzepodcast' ); ?></p>
				</div>
				<div class="faq-item">
					<h3><?php esc_html_e( 'Família, Matrimónio e Economia Moral', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'A ordem temporal e o lar cristão: B05 (O Noivo, a Noiva e o Compromisso no Matrimónio Católico indissolúvel) e B03 (Economia, Família e o Futuro c/ Murilo Resende — denúncia da usura e proteção do património familiar).', 'bronzepodcast' ); ?></p>
				</div>
				<div class="faq-item">
					<h3><?php esc_html_e( 'História, Fé e Fátima em Portugal', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'A aliança histórica de Portugal com a Fé Católica: #35 (Portugal: A Fundação Mística e a Aliança com Cristo) e #14 (Fátima: Os Apelos Proféticos e a preservação do Dogma da Fé).', 'bronzepodcast' ); ?></p>
				</div>
				<div class="faq-item">
					<h3><?php esc_html_e( 'Oração, Liturgia e Vida Interior', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'A espiritualidade e o recolhimento cristão: #69 (O Sentido do Sagrado na Santa Missa e Liturgia Tradicional), #47 (O Silêncio e a busca de Deus no mundo moderno), #20 (O Santo Rosário como arma invencível) e B04 (A Renúncia e a oração interior).', 'bronzepodcast' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- Chamada de subscrição -->
	<section class="podcast-cta section-pad">
		<div class="content-shell podcast-cta__inner">
			<p class="eyebrow"><?php esc_html_e( 'Acompanha o projeto', 'bronzepodcast' ); ?></p>
			<h2><?php esc_html_e( 'Não percas o próximo.', 'bronzepodcast' ); ?></h2>
			<p><?php esc_html_e( 'Subscreve o canal oficial no YouTube e segue no Spotify para receber notificações a cada estreia.', 'bronzepodcast' ); ?></p>
			<div class="hero__actions" style="justify-content: center;">
				<a class="button button--accent" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Subscrever no YouTube', 'bronzepodcast' ); ?><span aria-hidden="true">↗</span></a>
				<a class="button button--outline" href="https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Seguir no Spotify', 'bronzepodcast' ); ?><span aria-hidden="true">↗</span></a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();

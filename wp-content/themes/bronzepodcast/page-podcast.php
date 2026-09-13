<?php
/**
 * Página Podcast.
 *
 * @package BronzePodcast
 */

get_header();
?>
<?php
$featured_episode = array(
	'id'      => 'xsM6DrjWxM4',
	'code'    => 'B07',
	'concept' => 'A Fortaleza',
	'title'   => 'A Violência: Mansidão, Coragem e a Verdadeira Fortaleza',
	'desc'    => 'Sobre a imposição da violência pelos Estados modernos sobre os seus povos, os limites da autoridade e qual a verdadeira posição doutrinal e moral católica.',
	'youtube' => 'https://www.youtube.com/watch?v=xsM6DrjWxM4',
	'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
);

$curated_episodes = array(
	array(
		'id'      => 'YaPC_g224TQ',
		'code'    => '#47',
		'concept' => 'O Silêncio',
		'title'   => 'O Silêncio: A Busca de Deus no Mundo Moderno',
		'desc'    => 'A necessidade do recolhimento, da oração interior e da fuga ao ruído perpétuo da sociedade digital.',
		'youtube' => 'https://www.youtube.com/watch?v=YaPC_g224TQ',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
	array(
		'id'      => 'FPQ8jPFxd90',
		'code'    => '#35',
		'concept' => 'Portugal',
		'title'   => 'Portugal: A Batalha de Ourique e a Aliança com Cristo',
		'desc'    => 'A fundação mística da nacionalidade e o compromisso sagrado entre a Coroa de Portugal e a Fé Católica.',
		'youtube' => 'https://www.youtube.com/watch?v=FPQ8jPFxd90',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
	array(
		'id'      => 'o7E9CdRMKug',
		'code'    => '#20',
		'concept' => 'O Rosário',
		'title'   => 'O Rosário: A Arma Espiritual dos Cristãos',
		'desc'    => 'A origem medieval, a meditação dos mistérios e a força do Santo Rosário em tempos de combate.',
		'youtube' => 'https://www.youtube.com/watch?v=o7E9CdRMKug',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
	array(
		'id'      => 'iEJ5DV8o0y8',
		'code'    => '#14',
		'concept' => 'Fátima',
		'title'   => 'Fátima: Os Apelos e o Dogma da Fé',
		'desc'    => 'As aparições de 1917, as advertências sobre a apostasia e a promessa de preservação do dogma em Portugal.',
		'youtube' => 'https://www.youtube.com/watch?v=iEJ5DV8o0y8',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
	array(
		'id'      => 'jI-2_LVDo7U',
		'code'    => '#01',
		'concept' => 'A Vida',
		'title'   => 'A Vida: A Sacralidade da Existência e a Família',
		'desc'    => 'A defesa incondicional da vida humana desde a conceção ao seu fim natural, frente à cultura da morte.',
		'youtube' => 'https://www.youtube.com/watch?v=jI-2_LVDo7U',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
	array(
		'id'      => 'XS6QGK9BC9Q',
		'code'    => 'Live',
		'concept' => 'Pensamento Político',
		'title'   => 'Salazar: O Pensamento Político e o Estado Novo',
		'desc'    => 'Uma análise histórica e doutrinal sobre a ordem social, a Constituição de 1933 e a tradição portuguesa.',
		'youtube' => 'https://www.youtube.com/watch?v=XS6QGK9BC9Q',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
	array(
		'id'      => 'q5ZI15xCG_E',
		'code'    => '#03',
		'concept' => 'O Matrimónio',
		'title'   => 'O Matrimónio: O Sacramento e a Fidelidade Real',
		'desc'    => 'A honra e o peso do sacramento matrimonial perante a banalização moderna e a quebra da família.',
		'youtube' => 'https://www.youtube.com/watch?v=q5ZI15xCG_E',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
	array(
		'id'      => '3HxYRKDoFNM',
		'code'    => '#33',
		'concept' => 'A Economia',
		'title'   => 'A Economia: O Bem Comum e a Doutrina Social',
		'desc'    => 'Os princípios católicos sobre a dignidade do trabalho, a propriedade e a justiça económica.',
		'youtube' => 'https://www.youtube.com/watch?v=3HxYRKDoFNM',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
	array(
		'id'      => '3be-K27lp9c',
		'code'    => '#31',
		'concept' => 'A Guerra',
		'title'   => 'A Guerra: Teologia da Guerra Justa e Paz Real',
		'desc'    => 'A moral católica clássica sobre os conflitos entre nações, a legítima defesa e a ilusão do pacifismo.',
		'youtube' => 'https://www.youtube.com/watch?v=3be-K27lp9c',
		'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
	),
);
?>
<main id="primary" class="site-main">
	<section class="page-hero page-hero--podcast">
		<div class="page-hero__overlay"></div>
		<div class="content-shell content-shell--wide page-hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Conversas & Transmissões', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'O podcast em vídeo e áudio.', 'bronzepodcast' ); ?></h1>
			<p class="page-hero__lede"><?php esc_html_e( 'Episódios completos sobre Fé Católica, tradição e Portugal. Para assistir na íntegra no YouTube ou acompanhar em formato áudio no Spotify.', 'bronzepodcast' ); ?></p>
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
				<h2 id="featured-episode-title"><?php esc_html_e( 'Último Episódio', 'bronzepodcast' ); ?></h2>
			</div>

			<div class="podcast-featured__card">
				<div class="podcast-featured__media">
					<div class="video-frame">
						<iframe src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $featured_episode['id'] ); ?>" title="<?php echo esc_attr( $featured_episode['title'] ); ?> | Bronze Podcast" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
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
								<a class="button button--accent podcast-card__btn podcast-card__btn--yt" href="<?php echo esc_url( $episode['youtube'] ); ?>" target="_blank" rel="noopener noreferrer">
									<svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
									<span><?php esc_html_e( 'Ver Vídeo', 'bronzepodcast' ); ?> ↗</span>
								</a>
								<a class="button button--spotify podcast-card__btn podcast-card__btn--sp" href="<?php echo esc_url( $episode['spotify'] ); ?>" target="_blank" rel="noopener noreferrer">
									<svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
									<span><?php esc_html_e( 'Ouvir', 'bronzepodcast' ); ?> ↗</span>
								</a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
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

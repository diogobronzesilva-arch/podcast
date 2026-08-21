<?php
/**
 * Página Podcast.
 *
 * @package BronzePodcast
 */

get_header();
?>
<main id="primary" class="site-main">
	<section class="page-hero page-hero--podcast">
		<div class="page-hero__overlay"></div>
		<div class="content-shell content-shell--wide page-hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Bronze Podcast · No ar', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'Escute onde já está.', 'bronzepodcast' ); ?></h1>
			<p class="page-hero__lede"><?php esc_html_e( 'Episódios em vídeo no YouTube e em áudio no Spotify. Escolha a plataforma e continue a conversa.', 'bronzepodcast' ); ?></p>
		</div>
	</section>

	<section class="section-pad platform-section">
		<div class="content-shell content-shell--wide platform-grid">
			<a class="platform-card platform-card--youtube" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer">
				<span class="platform-card__number">01</span>
				<div><span class="platform-card__label">YouTube</span><strong><?php esc_html_e( 'Ver e participar', 'bronzepodcast' ); ?></strong><small><?php esc_html_e( 'Episódios completos, estreias e comentários.', 'bronzepodcast' ); ?></small></div>
				<span class="platform-card__arrow" aria-hidden="true">↗</span>
			</a>
			<a class="platform-card platform-card--spotify" href="https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg" target="_blank" rel="noopener noreferrer">
				<span class="platform-card__number">02</span>
				<div><span class="platform-card__label">Spotify</span><strong><?php esc_html_e( 'Ouvir em qualquer lugar', 'bronzepodcast' ); ?></strong><small><?php esc_html_e( 'Todos os episódios no seu ritmo.', 'bronzepodcast' ); ?></small></div>
				<span class="platform-card__arrow" aria-hidden="true">↗</span>
			</a>
		</div>
	</section>

	<section class="podcast-cta section-pad">
		<div class="content-shell podcast-cta__inner">
			<p class="eyebrow"><?php esc_html_e( 'Acompanhe o projeto', 'bronzepodcast' ); ?></p>
			<h2><?php esc_html_e( 'Uma conversa de cada vez. Uma comunidade que permanece.', 'bronzepodcast' ); ?></h2>
			<p><?php esc_html_e( 'Subscreva no YouTube para receber os novos episódios e participar nos comentários.', 'bronzepodcast' ); ?></p>
			<a class="button button--accent" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Subscrever agora', 'bronzepodcast' ); ?><span aria-hidden="true">↗</span></a>
		</div>
	</section>
</main>
<?php
get_footer();

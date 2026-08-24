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
			<h1><?php esc_html_e( 'O podcast em vídeo e áudio.', 'bronzepodcast' ); ?></h1>
			<p class="page-hero__lede"><?php esc_html_e( 'No YouTube para ver a conversa por inteiro. No Spotify para a continuares onde estiveres.', 'bronzepodcast' ); ?></p>
		</div>
	</section>

	<section class="section-pad platform-section">
		<div class="content-shell content-shell--wide platform-grid">
			<a class="platform-card platform-card--youtube" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer">
				<span class="platform-card__number">01</span>
				<div><span class="platform-card__label">YouTube</span><strong><?php esc_html_e( 'Ver a conversa', 'bronzepodcast' ); ?></strong><small><?php esc_html_e( 'Episódios completos, estreias e espaço para responder.', 'bronzepodcast' ); ?></small></div>
				<span class="platform-card__arrow" aria-hidden="true">↗</span>
			</a>
			<a class="platform-card platform-card--spotify" href="https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg" target="_blank" rel="noopener noreferrer">
				<span class="platform-card__number">02</span>
				<div><span class="platform-card__label">Spotify</span><strong><?php esc_html_e( 'Levar contigo', 'bronzepodcast' ); ?></strong><small><?php esc_html_e( 'Todos os episódios em formato áudio.', 'bronzepodcast' ); ?></small></div>
				<span class="platform-card__arrow" aria-hidden="true">↗</span>
			</a>
		</div>
	</section>

	<section class="podcast-cta section-pad">
		<div class="content-shell podcast-cta__inner">
			<p class="eyebrow"><?php esc_html_e( 'Acompanhe o projecto', 'bronzepodcast' ); ?></p>
			<h2><?php esc_html_e( 'Não percas o próximo.', 'bronzepodcast' ); ?></h2>
			<p><?php esc_html_e( 'Subscreve o canal no YouTube. É lá que os episódios aparecem primeiro e a conversa continua.', 'bronzepodcast' ); ?></p>
			<a class="button button--accent" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Subscrever no YouTube', 'bronzepodcast' ); ?><span aria-hidden="true">↗</span></a>
		</div>
	</section>
</main>
<?php
get_footer();

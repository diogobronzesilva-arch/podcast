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
			<p class="eyebrow"><?php esc_html_e( 'Bronze Podcast', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'Ouça o Podcast nestas plataformas', 'bronzepodcast' ); ?></h1>
		</div>
	</section>

	<section class="section-pad">
		<div class="content-shell content-shell--wide platform-grid">
			<a class="platform-card platform-card--youtube" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer">
				<span class="platform-card__label">YouTube</span>
				<strong><?php esc_html_e( 'Ver episódios', 'bronzepodcast' ); ?></strong>
				<span aria-hidden="true">↗</span>
			</a>
			<a class="platform-card platform-card--spotify" href="https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg" target="_blank" rel="noopener noreferrer">
				<span class="platform-card__label">Spotify</span>
				<strong><?php esc_html_e( 'Ouvir o podcast', 'bronzepodcast' ); ?></strong>
				<span aria-hidden="true">↗</span>
			</a>
		</div>
	</section>
</main>
<?php
get_footer();

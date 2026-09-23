<?php
/**
 * Página Sobre.
 *
 * @package BronzePodcast
 */

get_header();
?>
<main id="primary" class="site-main">
	<section class="page-hero page-hero--about">
		<div class="page-hero__overlay"></div>
		<div class="content-shell content-shell--wide page-hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Manifesto', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'Fé, nação e combate espiritual.', 'bronzepodcast' ); ?></h1>
			<p class="page-hero__lede"><?php esc_html_e( 'Criei este Podcast em 2020 com um objectivo simples: divulgar a Fé Católica Tradicional.', 'bronzepodcast' ); ?></p>
		</div>
	</section>

	<section class="section-pad section-pad--article">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<div class="content-shell content-shell--wide about-layout">
				<aside class="about-rail">
					<p class="eyebrow"><?php esc_html_e( 'Em poucas palavras', 'bronzepodcast' ); ?></p>
					<ol>
						<li><span>01</span><?php esc_html_e( 'Fidelidade à fé católica', 'bronzepodcast' ); ?></li>
						<li><span>02</span><?php esc_html_e( 'Amor por Portugal', 'bronzepodcast' ); ?></li>
						<li><span>03</span><?php esc_html_e( 'Coragem para agir', 'bronzepodcast' ); ?></li>
					</ol>
				</aside>
				<article <?php post_class( 'prose about-copy' ); ?>>
					<div class="entry-content"><?php the_content(); ?></div>
					<div class="signature">
						<a class="button button--accent" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Subscrever no YouTube', 'bronzepodcast' ); ?><span aria-hidden="true">↗</span></a>
						<p><span class="eyebrow">AMDG</span><strong>Diogo Bronze</strong></p>
					</div>
				</article>
			</div>
		<?php endwhile; ?>
	</section>

	<section class="section-pad section-pad--tight" aria-labelledby="about-faq-title" style="border-top: 1px solid var(--line, rgba(255,255,255,0.08));">
		<div class="content-shell content-shell--wide">
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'Síntese & Perguntas Frequentes', 'bronzepodcast' ); ?></p>
				<h2 id="about-faq-title" style="font-family: var(--font-display, 'Cormorant Garamond', serif); font-size: clamp(2rem, 5vw, 2.8rem); line-height: 1.15; margin-block: 8px 16px;"><?php esc_html_e( 'Perguntas e Respostas sobre o Bronze Podcast', 'bronzepodcast' ); ?></h2>
				<p class="section-heading__lede" style="color: var(--paper-soft, #cfc9be); font-size: 0.95rem; max-width: 680px;"><?php esc_html_e( 'Resumo conciso sobre as origens, os fundamentos doutrinais e os canais de difusão do projeto.', 'bronzepodcast' ); ?></p>
			</div>

			<div class="faq-grid">
				<div class="faq-item">
					<h3><?php esc_html_e( 'O que é o Bronze Podcast?', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'O Bronze Podcast é um projeto independente de conversas em profundidade fundado em 2020 por Diogo Bronze. Tem como missão a difusão da Fé Católica Tradicional, da moral cristã, da doutrina perene e da reflexão histórica sobre a identidade e a restauração de Portugal.', 'bronzepodcast' ); ?></p>
				</div>
				<div class="faq-item">
					<h3><?php esc_html_e( 'Quem é o autor e anfitrião do podcast?', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'O podcast é idealizado e conduzido por Diogo Bronze, com foco na defesa da verdade doutrinal, na fidelidade à Tradição da Igreja e na restauração da cultura católica e do pensamento tradicional português.', 'bronzepodcast' ); ?></p>
				</div>
				<div class="faq-item">
					<h3><?php esc_html_e( 'Quais são os temas e eixos fundamentais abordados?', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'Os episódios articulam-se em torno de cinco eixos essenciais: Teologia e Sagrada Escritura (virtudes cardeais, pecado original e graça); Família e Matrimónio indissolúvel; Economia moral e crítica à usura contemporânea; História e Fé de Portugal; e Combate Espiritual e integridade cívica.', 'bronzepodcast' ); ?></p>
				</div>
				<div class="faq-item">
					<h3><?php esc_html_e( 'Onde é possível acompanhar e ouvir os episódios?', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'Todas as transmissões completas em vídeo são disponibilizadas no canal oficial do YouTube (@bronzepodcast), com versões áudio disponíveis no Spotify e plataformas de podcast.', 'bronzepodcast' ); ?></p>
				</div>
				<div class="faq-item">
					<h3><?php esc_html_e( 'O projeto tem loja oficial associada?', 'bronzepodcast' ); ?></h3>
					<p><?php esc_html_e( 'Sim. A loja do Bronze Podcast disponibiliza obras literárias de referência católica, como o Tesouro dos Fiéis, clássicos espirituais, arte sacra e símbolos ligados à tradição e à história de Portugal.', 'bronzepodcast' ); ?></p>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();

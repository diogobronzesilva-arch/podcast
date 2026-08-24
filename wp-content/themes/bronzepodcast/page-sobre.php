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
			<p class="eyebrow"><?php esc_html_e( 'Manifesto · Desde 2020', 'bronzepodcast' ); ?></p>
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
</main>
<?php
get_footer();

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
			<p class="eyebrow"><?php esc_html_e( 'Desde 2020', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'Um Podcast Católico', 'bronzepodcast' ); ?></h1>
		</div>
	</section>

	<section class="section-pad">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article <?php post_class( 'content-shell content-shell--article prose about-copy' ); ?>>
				<div class="entry-content"><?php the_content(); ?></div>
				<div class="signature">
					<a class="button" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Subscrever no YouTube', 'bronzepodcast' ); ?></a>
					<p><span class="eyebrow">AMDG</span><strong>Diogo Bronze</strong></p>
				</div>
			</article>
		<?php endwhile; ?>
	</section>
</main>
<?php
get_footer();

<?php
/**
 * Rodapé do tema.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="site-footer">
	<div class="content-shell content-shell--wide site-footer__grid">
		<section class="newsletter" aria-labelledby="newsletter-title">
			<p class="eyebrow"><?php esc_html_e( 'Carta Bronze', 'bronzepodcast' ); ?></p>
			<h2 id="newsletter-title"><?php esc_html_e( 'Receba notícias do Bronze Podcast.', 'bronzepodcast' ); ?></h2>
			<p class="newsletter__lede"><?php esc_html_e( 'Novos episódios, artigos e novidades da loja. Apenas quando houver alguma coisa para partilhar.', 'bronzepodcast' ); ?></p>
			<form class="newsletter__form" action="#" method="post" data-newsletter-form>
				<label for="newsletter-email"><?php esc_html_e( 'Endereço de email', 'bronzepodcast' ); ?></label>
				<div class="newsletter__controls">
					<input id="newsletter-email" type="email" name="email" autocomplete="email" placeholder="<?php esc_attr_e( 'O seu melhor email', 'bronzepodcast' ); ?>" required>
					<button type="submit"><?php esc_html_e( 'Subscrever', 'bronzepodcast' ); ?> <span aria-hidden="true">→</span></button>
				</div>
				<p class="newsletter__note"><?php esc_html_e( 'A subscrição será ligada antes da abertura pública.', 'bronzepodcast' ); ?></p>
			</form>
		</section>

		<div class="site-footer__contact">
			<p class="site-footer__label"><?php esc_html_e( 'Contacto', 'bronzepodcast' ); ?></p>
			<a href="mailto:info@bronzepodcast.com">info@bronzepodcast.com</a>
			<nav class="social-links" aria-label="<?php esc_attr_e( 'Redes e plataformas', 'bronzepodcast' ); ?>">
				<a href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer">YouTube</a>
				<a href="https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg" target="_blank" rel="noopener noreferrer">Spotify</a>
				<a href="https://www.instagram.com/bronzepodcast/" target="_blank" rel="noopener noreferrer">Instagram</a>
				<a href="https://x.com/bronzpodcast" target="_blank" rel="noopener noreferrer">X</a>
			</nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'fallback_cb'    => false,
					'menu_class'     => 'footer-menu',
				)
			);
			?>
		</div>
	</div>
	<div class="content-shell content-shell--wide site-footer__legal">
		<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> Bronze Podcast · <?php esc_html_e( 'Feito em Portugal', 'bronzepodcast' ); ?></p>
		<a href="https://tesourofieis.com" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Oração e vida espiritual', 'bronzepodcast' ); ?> ↗</a>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

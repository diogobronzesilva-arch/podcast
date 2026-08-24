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
			<p class="eyebrow"><?php esc_html_e( 'Acompanhar', 'bronzepodcast' ); ?></p>
			<h2 id="newsletter-title"><?php esc_html_e( 'O Bronze continua fora daqui.', 'bronzepodcast' ); ?></h2>
			<p class="newsletter__lede"><?php esc_html_e( 'Os episódios aparecem primeiro no YouTube. No Spotify, ficam prontos para ouvir no caminho, em casa ou quando for preciso parar um pouco.', 'bronzepodcast' ); ?></p>
			<div class="footer-platform-actions">
				<a class="button button--accent" href="https://www.youtube.com/@bronzepodcast" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Abrir YouTube', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></a>
				<a class="button button--outline" href="https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Ouvir no Spotify', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></a>
			</div>
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

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
			<h2 id="newsletter-title"><?php esc_html_e( 'Acompanha no YouTube e Spotify.', 'bronzepodcast' ); ?></h2>
			<p class="newsletter__lede"><?php esc_html_e( 'Episódios completos no YouTube e em áudio no Spotify.', 'bronzepodcast' ); ?></p>
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
		<nav class="legal-links" aria-label="<?php esc_attr_e( 'Informações legais e transparência', 'bronzepodcast' ); ?>">
			<a href="<?php echo esc_url( home_url( '/termos-e-condicoes/' ) ); ?>"><?php esc_html_e( 'Termos e Condições', 'bronzepodcast' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/politica-de-privacidade/' ) ); ?>"><?php esc_html_e( 'Privacidade', 'bronzepodcast' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/envios-e-devolucoes/' ) ); ?>"><?php esc_html_e( 'Envios e Devoluções', 'bronzepodcast' ); ?></a>
			<a href="https://www.livroreclamacoes.pt" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Livro de Reclamações', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></a>
			<a href="https://tesourofieis.com" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Oração e vida espiritual', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></a>
		</nav>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

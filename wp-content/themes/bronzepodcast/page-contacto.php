<?php
/**
 * Página Contacto.
 *
 * @package BronzePodcast
 */

get_header();

$status = isset( $_GET['estado'] ) ? sanitize_key( wp_unslash( $_GET['estado'] ) ) : '';
?>
<main id="primary" class="site-main section-pad contact-page">
	<div class="content-shell content-shell--wide contact-layout">
		<section class="contact-intro">
			<p class="eyebrow"><?php esc_html_e( 'Contacto direto', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'Vamos conversar.', 'bronzepodcast' ); ?></h1>
			<p><?php esc_html_e( 'Questões sobre o podcast, propostas, imprensa ou futuras encomendas: escreva-nos. Lemos todas as mensagens.', 'bronzepodcast' ); ?></p>
			<a class="contact-email" href="mailto:info@bronzepodcast.com">info@bronzepodcast.com</a>
			<div class="contact-topics" aria-label="<?php esc_attr_e( 'Assuntos de contacto', 'bronzepodcast' ); ?>">
				<span><?php esc_html_e( 'Podcast', 'bronzepodcast' ); ?></span>
				<span><?php esc_html_e( 'Imprensa', 'bronzepodcast' ); ?></span>
				<span><?php esc_html_e( 'Loja', 'bronzepodcast' ); ?></span>
			</div>
		</section>

		<section class="contact-form-card" aria-labelledby="contact-form-title">
			<p class="eyebrow"><?php esc_html_e( 'Envie uma mensagem', 'bronzepodcast' ); ?></p>
			<h2 id="contact-form-title" class="screen-reader-text"><?php esc_html_e( 'Formulário de contacto', 'bronzepodcast' ); ?></h2>
			<?php if ( 'enviado' === $status ) : ?>
				<p class="form-status form-status--success" role="status"><?php esc_html_e( 'Obrigado. A sua mensagem foi enviada.', 'bronzepodcast' ); ?></p>
			<?php elseif ( 'erro' === $status ) : ?>
				<p class="form-status form-status--error" role="alert"><?php esc_html_e( 'Não foi possível enviar a mensagem. Confirme os campos ou escreva-nos por email.', 'bronzepodcast' ); ?></p>
			<?php endif; ?>

			<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="bronzepodcast_contact">
				<?php wp_nonce_field( 'bronzepodcast_contact', 'bronzepodcast_contact_nonce' ); ?>
				<p class="contact-form__trap" aria-hidden="true">
					<label for="contact-website">Website</label>
					<input id="contact-website" type="text" name="website" tabindex="-1" autocomplete="off">
				</p>
				<p>
					<label for="contact-name"><?php esc_html_e( 'O seu nome', 'bronzepodcast' ); ?></label>
					<input id="contact-name" type="text" name="nome" autocomplete="name" required>
				</p>
				<p>
					<label for="contact-email"><?php esc_html_e( 'O seu email', 'bronzepodcast' ); ?></label>
					<input id="contact-email" type="email" name="email" autocomplete="email" required>
				</p>
				<p>
					<label for="contact-message"><?php esc_html_e( 'Como podemos ajudar?', 'bronzepodcast' ); ?></label>
					<textarea id="contact-message" name="mensagem" rows="7" required></textarea>
				</p>
				<button class="button button--accent" type="submit"><?php esc_html_e( 'Enviar mensagem', 'bronzepodcast' ); ?><span aria-hidden="true">→</span></button>
			</form>
		</section>
	</div>
</main>
<?php
get_footer();

<?php
/**
 * Processamento do formulário de contacto.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bronzepodcast_handle_contact_form() {
	$redirect = home_url( '/contacto/' );

	if (
		! isset( $_POST['bronzepodcast_contact_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bronzepodcast_contact_nonce'] ) ), 'bronzepodcast_contact' )
	) {
		wp_safe_redirect( add_query_arg( 'estado', 'erro', $redirect ) );
		exit;
	}

	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'estado', 'enviado', $redirect ) );
		exit;
	}

	$name    = isset( $_POST['nome'] ) ? sanitize_text_field( wp_unslash( $_POST['nome'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$message = isset( $_POST['mensagem'] ) ? sanitize_textarea_field( wp_unslash( $_POST['mensagem'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( add_query_arg( 'estado', 'erro', $redirect ) );
		exit;
	}

	$subject = sprintf( '[Bronze Podcast] Mensagem de %s', $name );
	$body    = "Nome: {$name}\nEmail: {$email}\n\nMensagem:\n{$message}";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	$sent    = wp_mail( get_option( 'admin_email' ), $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'estado', $sent ? 'enviado' : 'erro', $redirect ) );
	exit;
}
add_action( 'admin_post_nopriv_bronzepodcast_contact', 'bronzepodcast_handle_contact_form' );
add_action( 'admin_post_bronzepodcast_contact', 'bronzepodcast_handle_contact_form' );

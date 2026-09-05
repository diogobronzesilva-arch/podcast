<?php
/**
 * Formulário de pesquisa personalizado.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field-input" class="screen-reader-text"><?php esc_html_e( 'Pesquisar no site', 'bronzepodcast' ); ?></label>
	<div class="search-form__inner">
		<input type="search" id="search-field-input" class="search-field" placeholder="<?php esc_attr_e( 'Pesquisar terços, livros, episódios…', 'bronzepodcast' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" required>
		<button type="submit" class="button button--accent search-submit"><?php esc_html_e( 'Pesquisar', 'bronzepodcast' ); ?> <span aria-hidden="true">→</span></button>
	</div>
</form>

<?php
/**
 * Template principal WooCommerce.
 *
 * @package BronzePodcast
 */

get_header();

if ( function_exists( 'is_shop' ) && is_shop() ) :
	?>
	<section class="page-hero page-hero--store">
		<div class="page-hero__overlay"></div>
		<div class="content-shell content-shell--wide page-hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Bronze Podcast', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'Loja Online', 'bronzepodcast' ); ?></h1>
		</div>
	</section>
	<?php
endif;

woocommerce_content();
get_footer();

<?php
/**
 * Funções e configuração do tema Bronze Podcast.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRONZEPODCAST_VERSION', '0.5.4' );

require_once get_template_directory() . '/inc/site-setup.php';
require_once get_template_directory() . '/inc/contact-form.php';

function bronzepodcast_setup() {
	load_theme_textdomain( 'bronzepodcast', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 160,
			'width'       => 160,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 560,
			'single_image_width'    => 860,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Menu principal', 'bronzepodcast' ),
			'footer'  => __( 'Menu do rodapé', 'bronzepodcast' ),
		)
	);
}
add_action( 'after_setup_theme', 'bronzepodcast_setup' );

function bronzepodcast_assets() {
	wp_enqueue_style(
		'bronzepodcast-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Manrope:wght@400;500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'bronzepodcast-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		BRONZEPODCAST_VERSION
	);
	wp_enqueue_script(
		'bronzepodcast-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		BRONZEPODCAST_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'bronzepodcast_assets' );

/**
 * Mantém o nome da marca nos títulos públicos enquanto o domínio temporário
 * estiver configurado como nome do site no WordPress.
 *
 * @param string $title Título calculado pelo WordPress.
 * @return string
 */
function bronzepodcast_document_title( $title ) {
	$site_name = get_bloginfo( 'name' );

	if ( $site_name ) {
		return str_replace( $site_name, 'Bronze Podcast', $title );
	}

	return $title;
}
add_filter( 'pre_get_document_title', 'bronzepodcast_document_title' );

function bronzepodcast_excerpt_length() {
	return 26;
}
add_filter( 'excerpt_length', 'bronzepodcast_excerpt_length' );

function bronzepodcast_menu_fallback() {
	$links = array(
		__( 'Sobre', 'bronzepodcast' )    => home_url( '/sobre/' ),
		__( 'Podcast', 'bronzepodcast' )  => home_url( '/podcast/' ),
		__( 'Oração', 'bronzepodcast' )   => 'https://tesourofieis.com',
		__( 'Loja', 'bronzepodcast' )     => bronzepodcast_store_url(),
		__( 'Contacto', 'bronzepodcast' ) => home_url( '/contacto/' ),
	);

	echo '<ul class="site-menu">';
	foreach ( $links as $label => $url ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

function bronzepodcast_store_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$shop_url = wc_get_page_permalink( 'shop' );

		if ( $shop_url ) {
			return $shop_url;
		}
	}

	return home_url( '/loja/' );
}

function bronzepodcast_cart_count() {
	if ( function_exists( 'WC' ) && WC()->cart ) {
		return WC()->cart->get_cart_contents_count();
	}

	return 0;
}

function bronzepodcast_cart_link() {
	if ( ! function_exists( 'wc_get_cart_url' ) ) {
		return;
	}
	?>
	<a class="site-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'Ver carrinho', 'bronzepodcast' ); ?>">
		<svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18"><path d="M3 4h2l1.7 9.1a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 1.9-1.4L21 7H6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"/><circle cx="9" cy="19" r="1.4" fill="currentColor"/><circle cx="18" cy="19" r="1.4" fill="currentColor"/></svg>
		<span class="site-cart__count"><?php echo esc_html( bronzepodcast_cart_count() ); ?></span>
	</a>
	<?php
}

function bronzepodcast_cart_fragments( $fragments ) {
	ob_start();
	?>
	<span class="site-cart__count"><?php echo esc_html( bronzepodcast_cart_count() ); ?></span>
	<?php
	$fragments['.site-cart__count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'bronzepodcast_cart_fragments' );

/**
 * Mostra caminhos claros para as coleções. Além de ajudar quem chega à loja,
 * dá às páginas de categoria ligações internas estáveis e contextuais.
 */
function bronzepodcast_store_collections() {
	if ( ! function_exists( 'is_shop' ) || ! is_shop() ) {
		return;
	}

	$categories = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'parent'     => 0,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		return;
	}

	usort(
		$categories,
		function ( $left, $right ) {
			$priority = array( 'tercos-de-combate' => 0 );
			$left_order  = isset( $priority[ $left->slug ] ) ? $priority[ $left->slug ] : 1;
			$right_order = isset( $priority[ $right->slug ] ) ? $priority[ $right->slug ] : 1;

			if ( $left_order !== $right_order ) {
				return $left_order - $right_order;
			}

			return strcasecmp( $left->name, $right->name );
		}
	);

	echo '<nav class="store-collections content-shell content-shell--wide" aria-label="' . esc_attr__( 'Coleções da loja', 'bronzepodcast' ) . '">';
	echo '<span class="store-collections__label">' . esc_html__( 'Explorar por coleção', 'bronzepodcast' ) . '</span>';
	echo '<div class="store-collections__links">';
	foreach ( $categories as $category ) {
		$link = get_term_link( $category );
		if ( ! is_wp_error( $link ) ) {
			printf( '<a href="%1$s">%2$s</a>', esc_url( $link ), esc_html( $category->name ) );
		}
	}
	echo '</div></nav>';
}
add_action( 'woocommerce_before_main_content', 'bronzepodcast_store_collections', 5 );

/**
 * Informação de decisão para a loja: o checkout fica separado da descoberta
 * do catálogo e não promete políticas que ainda não estejam configuradas.
 */
function bronzepodcast_store_context() {
	if ( ! function_exists( 'is_shop' ) || ! is_shop() ) {
		return;
	}
	?>
	<section class="store-context content-shell content-shell--wide" aria-labelledby="store-context-title">
		<div>
			<h2 id="store-context-title"><?php esc_html_e( 'Escolher com tempo.', 'bronzepodcast' ); ?></h2>
		</div>
		<div class="store-context__copy">
			<p><?php esc_html_e( 'Cada artigo tem a sua descrição, disponibilidade e variantes. Se tiveres uma dúvida sobre uma encomenda, escreve antes de comprar: é preferível esclarecer bem do que apressar uma escolha.', 'bronzepodcast' ); ?></p>
			<a class="text-link" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Falar sobre uma encomenda', 'bronzepodcast' ); ?> <span aria-hidden="true">↗</span></a>
		</div>
	</section>
	<?php
}
add_action( 'woocommerce_after_main_content', 'bronzepodcast_store_context', 11 );

/**
 * Mantém os Terços de Combate no início do catálogo, sem excluir as restantes
 * coleções nem alterar a ordenação definida pelo WooCommerce dentro de cada grupo.
 *
 * @param array    $clauses Cláusulas SQL da consulta principal.
 * @param WP_Query $query   Consulta em curso.
 * @return array
 */
function bronzepodcast_prioritize_combat_rosaries( $clauses, $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! function_exists( 'is_shop' ) || ! is_shop() || $query->get( 's' ) ) {
		return $clauses;
	}

	$category = get_term_by( 'slug', 'tercos-de-combate', 'product_cat' );
	if ( ! $category || is_wp_error( $category ) ) {
		return $clauses;
	}

	global $wpdb;
	$term_taxonomy_id = absint( $category->term_taxonomy_id );
	$clauses['join'] .= " LEFT JOIN {$wpdb->term_relationships} AS bronzepodcast_combat_relationships ON {$wpdb->posts}.ID = bronzepodcast_combat_relationships.object_id AND bronzepodcast_combat_relationships.term_taxonomy_id = {$term_taxonomy_id}";
	$clauses['orderby'] = '(bronzepodcast_combat_relationships.object_id IS NULL) ASC, ' . $clauses['orderby'];

	return $clauses;
}
add_filter( 'posts_clauses', 'bronzepodcast_prioritize_combat_rosaries', 20, 2 );

/**
 * Completa a tradução da interface do WooCommerce, independentemente da língua
 * definida pela instalação de origem.
 *
 * @param string     $text    Texto padrão do botão.
 * @param WC_Product $product Produto em ciclo.
 * @return string
 */
function bronzepodcast_loop_add_to_cart_text( $text, $product ) {
	if ( $product && $product->is_type( 'variable' ) ) {
		return __( 'Ver opções', 'bronzepodcast' );
	}

	return __( 'Adicionar ao carrinho', 'bronzepodcast' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'bronzepodcast_loop_add_to_cart_text', 10, 2 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'bronzepodcast_loop_add_to_cart_text', 10, 2 );

/**
 * Descrição e dados de entidade legíveis por motores de pesquisa e sistemas
 * de resposta. O conteúdo mantém-se específico ao Bronze e não depende de
 * palavras-chave repetidas.
 */
function bronzepodcast_seo_head() {
	if ( is_admin() ) {
		return;
	}

	$description = 'Bronze Podcast: conversas sobre fé católica, tradição e Portugal. Episódios em vídeo e áudio, e uma loja de livros, terços e artigos religiosos.';
	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$description = 'Loja do Bronze Podcast: livros, terços e artigos religiosos escolhidos para a vida de oração, a formação e a casa.';
	} elseif ( is_page( 'podcast' ) ) {
		$description = 'Ouve e vê o Bronze Podcast no YouTube e Spotify: conversas sobre fé católica, tradição e Portugal.';
	} elseif ( is_page( 'sobre' ) ) {
		$description = 'Conhece o Bronze Podcast, criado por Diogo Bronze Silva em 2020 para conversar sobre fé católica, tradição e Portugal.';
	}

	$share_image = is_singular() ? get_the_post_thumbnail_url( get_queried_object_id(), 'large' ) : '';
	if ( ! $share_image ) {
		$share_image = get_template_directory_uri() . '/assets/images/fatima-noite.png';
	}

	echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta property="og:site_name" content="Bronze Podcast">' . "\n";
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $share_image ) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type'      => 'WebSite',
				'@id'        => home_url( '/#website' ),
				'name'       => 'Bronze Podcast',
				'url'        => home_url( '/' ),
				'inLanguage' => 'pt-PT',
			),
			array(
				'@type'       => 'Organization',
				'@id'          => home_url( '/#organization' ),
				'name'         => 'Bronze Podcast',
				'url'          => home_url( '/' ),
				'logo'         => get_template_directory_uri() . '/assets/images/logo.png',
				'email'        => 'info@bronzepodcast.com',
				'sameAs'       => array( 'https://www.youtube.com/@bronzepodcast', 'https://www.instagram.com/bronzepodcast/', 'https://x.com/bronzpodcast' ),
			),
			array(
				'@type'        => 'PodcastSeries',
				'@id'           => home_url( '/podcast/#podcast' ),
				'name'          => 'Bronze Podcast',
				'url'           => home_url( '/podcast/' ),
				'description'   => 'Conversas sobre fé católica, tradição e Portugal.',
				'inLanguage'    => 'pt-PT',
				'author'        => array( '@type' => 'Person', 'name' => 'Diogo Bronze Silva' ),
				'publisher'     => array( '@id' => home_url( '/#organization' ) ),
			),
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'bronzepodcast_seo_head', 2 );

function bronzepodcast_woocommerce_wrappers() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	add_action( 'woocommerce_before_main_content', 'bronzepodcast_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'bronzepodcast_wrapper_end', 10 );
}
add_action( 'after_setup_theme', 'bronzepodcast_woocommerce_wrappers' );

/**
 * O tema fornece um cabeçalho editorial próprio para a página principal da loja.
 * Evita a repetição do título que o WooCommerce adiciona por omissão.
 *
 * @param bool $show_title Indica se o WooCommerce deve mostrar o título.
 * @return bool
 */
function bronzepodcast_woocommerce_page_title( $show_title ) {
	if ( function_exists( 'is_shop' ) && is_shop() ) {
		return false;
	}

	return $show_title;
}
add_filter( 'woocommerce_show_page_title', 'bronzepodcast_woocommerce_page_title' );

function bronzepodcast_wrapper_start() {
	echo '<main id="primary" class="site-main shop-main"><div class="content-shell content-shell--wide">';
}

function bronzepodcast_wrapper_end() {
	echo '</div></main>';
}

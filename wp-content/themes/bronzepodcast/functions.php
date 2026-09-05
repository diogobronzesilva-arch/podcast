<?php
/**
 * Funções e configuração do tema Bronze Podcast.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRONZEPODCAST_VERSION', '1.0.5' );

require_once get_template_directory() . '/inc/site-setup.php';
require_once get_template_directory() . '/inc/contact-form.php';
require_once get_template_directory() . '/inc/shipping.php';

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
	if ( is_front_page() ) {
		return 'Bronze Podcast — Fé católica, tradição e Portugal';
	}
	if ( function_exists( 'is_shop' ) && is_shop() ) {
		return 'Loja Bronze — Terços de Combate, Livros e Artigos Religiosos';
	}
	if ( is_page( 'sobre' ) ) {
		return 'Sobre o Bronze Podcast — Fé, Tradição e Portugal';
	}
	if ( is_page( 'podcast' ) ) {
		return 'Bronze Podcast — Vídeo e Áudio no YouTube e Spotify';
	}
	if ( is_page( 'contacto' ) ) {
		return 'Contacto — Bronze Podcast';
	}
	if ( function_exists( 'is_cart' ) && is_cart() ) {
		return 'Carrinho — Loja Bronze';
	}
	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		return 'Finalizar Encomenda — Loja Bronze';
	}
	if ( function_exists( 'is_account_page' ) && is_account_page() ) {
		return 'A Minha Conta — Bronze Podcast';
	}

	$site_name = get_bloginfo( 'name' );

	if ( $site_name ) {
		return str_replace( $site_name, 'Bronze Podcast', $title );
	}

	return sprintf( '%s — Bronze Podcast', $title );
}
add_filter( 'pre_get_document_title', 'bronzepodcast_document_title' );

/**
 * Declara a língua editorial do site no HTML público, mesmo em instalações
 * WordPress herdadas cuja língua do painel ainda não tenha sido atualizada.
 *
 * @param string $attributes Atributos calculados pelo WordPress.
 * @return string
 */
function bronzepodcast_language_attributes( $attributes ) {
	return 'lang="pt-PT" dir="ltr"';
}
add_filter( 'language_attributes', 'bronzepodcast_language_attributes' );

/**
 * Força a localização para Português de Portugal (pt_PT) no frontend público,
 * garantindo a tradução de todas as strings e microcópia do WooCommerce.
 *
 * @param string $locale Código de idioma atual.
 * @return string
 */
function bronzepodcast_force_frontend_locale( $locale ) {
	if ( ! is_admin() ) {
		return 'pt_PT';
	}
	return $locale;
}
add_filter( 'locale', 'bronzepodcast_force_frontend_locale' );

/**
 * Traduz e alinha os títulos das páginas essenciais da loja WooCommerce.
 *
 * @param string   $title Título original da página.
 * @param int|null $id    ID da página.
 * @return string
 */
function bronzepodcast_fix_page_titles( $title, $id = null ) {
	if ( ! is_admin() && in_the_loop() && is_main_query() ) {
		if ( function_exists( 'is_checkout' ) && is_checkout() ) {
			return function_exists( 'is_order_received_page' ) && is_order_received_page() ? __( 'Encomenda Recebida', 'bronzepodcast' ) : __( 'Finalizar Encomenda', 'bronzepodcast' );
		}
		if ( function_exists( 'is_cart' ) && is_cart() ) {
			return __( 'Carrinho', 'bronzepodcast' );
		}
		if ( function_exists( 'is_account_page' ) && is_account_page() ) {
			return __( 'A Minha Conta', 'bronzepodcast' );
		}
	}
	return $title;
}
add_filter( 'the_title', 'bronzepodcast_fix_page_titles', 10, 2 );

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
	global $wp;

	if ( is_admin() || defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' ) ) {
		return;
	}

	$description = 'Bronze Podcast: conversas sobre fé católica, tradição e Portugal. Episódios em vídeo e áudio, e uma loja de livros, terços e artigos religiosos.';
	if ( is_front_page() ) {
		$description = 'Bronze Podcast: fé católica, tradição e Portugal. Vê e ouve os episódios mais recentes e descobre a loja de terços, livros e artigos religiosos.';
	} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
		$description = 'Loja do Bronze Podcast: livros, terços e artigos religiosos escolhidos para a vida de oração, a formação e a casa.';
	} elseif ( is_page( 'podcast' ) ) {
		$description = 'Ouve e vê o Bronze Podcast no YouTube e Spotify: conversas sobre fé católica, tradição e Portugal.';
	} elseif ( is_page( 'sobre' ) ) {
		$description = 'Conhece o Bronze Podcast, criado por Diogo Bronze Silva em 2020 para conversar sobre fé católica, tradição e Portugal.';
	} elseif ( is_page( 'contacto' ) ) {
		$description = 'Entra em contacto com o Bronze Podcast para questões sobre episódios, imprensa ou encomendas.';
	} elseif ( is_singular() ) {
		$summary = get_post_field( 'post_excerpt', get_queried_object_id() );
		if ( ! $summary ) {
			$summary = get_post_field( 'post_content', get_queried_object_id() );
		}
		$summary = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $summary ) ), 28, '' );
		if ( $summary ) {
			$description = $summary;
		}
	}

	$share_image = is_singular() ? get_the_post_thumbnail_url( get_queried_object_id(), 'large' ) : '';
	if ( ! $share_image ) {
		$share_image = get_template_directory_uri() . '/assets/images/fatima-noite.png';
	}

	$path = isset( $wp->request ) ? $wp->request : '';
	$url  = is_singular() ? get_permalink() : home_url( '/' . $path . '/' );

	echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	if ( is_search() ) {
		echo '<meta name="robots" content="noindex,follow">' . "\n";
	}
	if ( ! is_singular() ) {
		echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	}
	echo '<meta property="og:locale" content="pt_PT">' . "\n";
	echo '<meta property="og:site_name" content="Bronze Podcast">' . "\n";
	echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $share_image ) . '">' . "\n";
	if ( is_singular( 'post' ) ) {
		echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . "\n";
		echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( DATE_W3C ) ) . '">' . "\n";
	}
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
				'sameAs'       => array( 'https://www.youtube.com/@bronzepodcast', 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg', 'https://www.instagram.com/bronzepodcast/', 'https://x.com/bronzpodcast' ),
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

/**
 * A instalação de origem publica um índice de sitemap cujos ficheiros filhos
 * respondem com 404. Desativamos esse índice nativo e publicamos abaixo uma
 * sitemap única, diretamente rastreável por Google e Search Console.
 *
 * @return false
 */
function bronzepodcast_disable_broken_core_sitemap() {
	return false;
}
add_filter( 'wp_sitemaps_enabled', 'bronzepodcast_disable_broken_core_sitemap' );

/**
 * Lista as páginas editoriais, produtos e coleções numa sitemap XML pequena e
 * estável. Interceta igualmente /wp-sitemap.xml para corrigir instalações
 * onde a sitemap nativa do WordPress ficou indisponível após a migração.
 *
 * @return void
 */
function bronzepodcast_output_sitemap() {
	if ( is_admin() || ! isset( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$path = wp_parse_url( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ), PHP_URL_PATH );
	if ( ! in_array( untrailingslashit( $path ), array( '/wp-sitemap.xml', '/sitemap.xml' ), true ) ) {
		return;
	}

	$items = array(
		array(
			'loc'     => home_url( '/' ),
			'lastmod' => get_lastpostmodified( 'GMT' ),
		),
	);

	foreach ( array( 'page', 'post', 'product' ) as $post_type ) {
		$posts = get_posts(
			array(
				'post_type'      => $post_type,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'modified',
				'order'          => 'DESC',
			)
		);

		foreach ( $posts as $post ) {
			if ( 'shop' === $post->post_name ) {
				continue;
			}
			$items[] = array(
				'loc'     => get_permalink( $post ),
				'lastmod' => get_post_modified_time( 'c', true, $post ),
			);
		}
	}

	if ( taxonomy_exists( 'product_cat' ) ) {
		$categories = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			)
		);

		if ( ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				if ( in_array( $category->slug, array( 'uncategorized', 'sem-categoria' ), true ) ) {
					continue;
				}
				$url = get_term_link( $category );
				if ( ! is_wp_error( $url ) ) {
					$items[] = array( 'loc' => $url );
				}
			}
		}
	}

	$items = array_values(
		array_unique(
			$items,
			SORT_REGULAR
		)
	);

	status_header( 200 );
	header( 'Content-Type: application/xml; charset=UTF-8' );
	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
	foreach ( $items as $item ) {
		echo "\t<url><loc>" . esc_url( $item['loc'] ) . '</loc>';
		if ( ! empty( $item['lastmod'] ) ) {
			echo '<lastmod>' . esc_html( gmdate( 'c', strtotime( $item['lastmod'] ) ) ) . '</lastmod>';
		}
		echo "</url>\n";
	}
	echo '</urlset>';
	exit;
}
add_action( 'template_redirect', 'bronzepodcast_output_sitemap', 0 );

/**
 * Redireciona 301 o endereço herdado /shop/ para a página oficial /loja/.
 */
function bronzepodcast_redirect_old_shop() {
	if ( is_admin() || ! isset( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$path = untrailingslashit( wp_parse_url( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ), PHP_URL_PATH ) );
	if ( '/shop' === $path ) {
		wp_safe_redirect( home_url( '/loja/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'bronzepodcast_redirect_old_shop', 1 );

/**
 * Corrige a renderização do Checkout, garantindo que o formulário de finalização
 * de compra e métodos de pagamento são apresentados em vez do bloco de carrinho.
 *
 * @param string $content Conteúdo da página.
 * @return string
 */
function bronzepodcast_fix_checkout_content( $content ) {
	if ( is_admin() ) {
		return $content;
	}

	if ( function_exists( 'is_order_received_page' ) && is_order_received_page() ) {
		return $content;
	}

	if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( wp_unslash( $_SERVER['REQUEST_URI'] ), 'order-received' ) !== false ) {
		return $content;
	}

	$is_checkout_url = false;
	if ( isset( $_SERVER['REQUEST_URI'] ) ) {
		$req_path = untrailingslashit( wp_parse_url( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ), PHP_URL_PATH ) );
		if ( in_array( $req_path, array( '/checkout', '/finalizar-compra' ), true ) ) {
			$is_checkout_url = true;
		}
	}

	if ( ( function_exists( 'is_checkout' ) && is_checkout() ) || $is_checkout_url ) {
		if ( strpos( $content, 'wp-block-woocommerce-cart' ) !== false || strpos( $content, 'woocommerce/cart' ) !== false || strpos( $content, 'woocommerce-checkout' ) === false ) {
			return do_shortcode( '[woocommerce_checkout]' );
		}
	}

	return $content;
}
add_filter( 'the_content', 'bronzepodcast_fix_checkout_content', 1 );

/**
 * Garante que o botão 'Voltar à loja' no carrinho vazio encaminha sempre para /loja/.
 *
 * @return string
 */
function bronzepodcast_return_to_shop_url() {
	return bronzepodcast_store_url();
}
add_filter( 'woocommerce_return_to_shop_redirect', 'bronzepodcast_return_to_shop_url' );

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

/**
 * Tradução e refinamento editorial dos separadores e textos nativos do WooCommerce.
 */
function bronzepodcast_woocommerce_product_tabs( $tabs ) {
	if ( isset( $tabs['description'] ) ) {
		$tabs['description']['title'] = __( 'Descrição', 'bronzepodcast' );
	}
	if ( isset( $tabs['additional_information'] ) ) {
		$tabs['additional_information']['title'] = __( 'Informação Adicional', 'bronzepodcast' );
	}
	if ( isset( $tabs['reviews'] ) ) {
		$tabs['reviews']['title'] = __( 'Avaliações', 'bronzepodcast' );
	}
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'bronzepodcast_woocommerce_product_tabs', 98 );

/**
 * Tradução das mensagens de disponibilidade e stock.
 */
function bronzepodcast_woocommerce_get_availability_text( $availability, $product ) {
	if ( ! $product->is_in_stock() ) {
		return __( 'Esgotado', 'bronzepodcast' );
	}
	if ( $product->managing_stock() && $product->get_stock_quantity() > 0 ) {
		return sprintf( __( '%d em stock', 'bronzepodcast' ), (int) $product->get_stock_quantity() );
	}
	return __( 'Em stock', 'bronzepodcast' );
}
add_filter( 'woocommerce_get_availability_text', 'bronzepodcast_woocommerce_get_availability_text', 10, 2 );

/**
 * Customiza as opções de ordenação da loja para português de Portugal.
 */
function bronzepodcast_woocommerce_catalog_orderby( $orderby ) {
	return array(
		'menu_order' => __( 'Ordem dos itens', 'bronzepodcast' ),
		'popularity' => __( 'Popularidade', 'bronzepodcast' ),
		'rating'     => __( 'Classificação média', 'bronzepodcast' ),
		'date'       => __( 'Mais recentes', 'bronzepodcast' ),
		'price'      => __( 'Preço: mais baixo para o mais alto', 'bronzepodcast' ),
		'price-desc' => __( 'Preço: mais alto para o mais baixo', 'bronzepodcast' ),
	);
}
add_filter( 'woocommerce_catalog_orderby', 'bronzepodcast_woocommerce_catalog_orderby', 99 );

/**
 * Tradução de termos e contagens do WooCommerce para português de Portugal.
 */
function bronzepodcast_filter_woocommerce_translations( $translation, $text, $domain ) {
	if ( 'woocommerce' === $domain ) {
		if ( 'Description' === $text ) {
			return 'Descrição';
		}
		if ( 'Additional information' === $text ) {
			return 'Informação Adicional';
		}
		if ( 'Category:' === $text ) {
			return 'Categoria:';
		}
		if ( 'Categories:' === $text ) {
			return 'Categorias:';
		}
		if ( 'Tag:' === $text ) {
			return 'Etiqueta:';
		}
		if ( 'Tags:' === $text ) {
			return 'Etiquetas:';
		}
		if ( 'Related products' === $text ) {
			return 'Produtos Relacionados';
		}
		if ( 'Default sorting' === $text ) {
			return 'Ordem dos itens';
		}
		if ( 'Sort by popularity' === $text ) {
			return 'Popularidade';
		}
		if ( 'Sort by average rating' === $text ) {
			return 'Classificação média';
		}
		if ( 'Sort by latest' === $text ) {
			return 'Mais recentes';
		}
		if ( 'Sort by price: low to high' === $text ) {
			return 'Preço: mais baixo para o mais alto';
		}
		if ( 'Sort by price: high to low' === $text ) {
			return 'Preço: mais alto para o mais baixo';
		}
		if ( 'Showing the single result' === $text ) {
			return 'A mostrar o único resultado';
		}
		if ( 'In stock' === $text ) {
			return 'Em stock';
		}
		if ( 'Out of stock' === $text ) {
			return 'Esgotado';
		}
	}
	return $translation;
}
add_filter( 'gettext', 'bronzepodcast_filter_woocommerce_translations', 20, 3 );

/**
 * Tradução das contagens no plural (ex: Showing 19-27 of 56 results).
 */
function bronzepodcast_filter_woocommerce_ngettext( $translation, $single, $plural, $number, $domain ) {
	if ( 'woocommerce' === $domain ) {
		if ( strpos( $single, 'Showing %1$d' ) !== false || strpos( $plural, 'Showing %1$d' ) !== false ) {
			return 'A mostrar %1$d&ndash;%2$d de %3$d resultados';
		}
		if ( strpos( $single, 'Showing all %d results' ) !== false || strpos( $plural, 'Showing all %d results' ) !== false ) {
			return 'A mostrar todos os %d resultados';
		}
		if ( strpos( $single, '%s in stock' ) !== false || strpos( $plural, '%s in stock' ) !== false ) {
			return '%s em stock';
		}
	}
	return $translation;
}
add_filter( 'ngettext', 'bronzepodcast_filter_woocommerce_ngettext', 20, 5 );

/**
 * Simplifica o texto dos botões na listagem de produtos (loja e página inicial) para 'Comprar'.
 * Nas páginas individuais de produto mantém-se 'Adicionar ao carrinho'.
 */
function bronzepodcast_product_add_to_cart_text( $text, $product ) {
	if ( ! is_product() ) {
		return __( 'Comprar', 'bronzepodcast' );
	}
	return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'bronzepodcast_product_add_to_cart_text', 99, 2 );



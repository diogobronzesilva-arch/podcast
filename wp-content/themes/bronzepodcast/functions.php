<?php
/**
 * Funções e configuração do tema Bronze Podcast.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRONZEPODCAST_VERSION', '1.2.6' );

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
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'bronzepodcast' ),
			'footer'  => __( 'Menu Rodapé', 'bronzepodcast' ),
		)
	);
}
add_action( 'after_setup_theme', 'bronzepodcast_setup' );

/**
 * Garante que o novo Selo Numismático oficial da Ordem de Cristo
 * substitui qualquer imagem legada armazenada na base de dados do WordPress.
 */
add_filter( 'get_custom_logo', 'bronzepodcast_force_official_logo', 999 );
function bronzepodcast_force_official_logo( $html ) {
	$logo_url = get_template_directory_uri() . '/assets/images/avatar_cruz_cristo.png?v=1.2.6';
	return sprintf(
		'<a href="%1$s" class="custom-logo-link" rel="home" aria-label="%2$s"><img src="%3$s" class="custom-logo" alt="%2$s" width="72" height="72" /></a>',
		esc_url( home_url( '/' ) ),
		esc_attr__( 'Bronze Podcast', 'bronzepodcast' ),
		esc_url( $logo_url )
	);
}
add_filter( 'theme_mod_custom_logo', '__return_false', 999 );

function bronzepodcast_assets() {
	wp_enqueue_style(
		'bronzepodcast-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Manrope:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	$style_deps = array();
	if ( wp_style_is( 'wc-blocks-style', 'registered' ) ) {
		$style_deps[] = 'wc-blocks-style';
	}
	if ( wp_style_is( 'woocommerce-general', 'registered' ) ) {
		$style_deps[] = 'woocommerce-general';
	}

	wp_enqueue_style(
		'bronzepodcast-main',
		get_template_directory_uri() . '/assets/css/main.css',
		$style_deps,
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
add_action( 'wp_enqueue_scripts', 'bronzepodcast_assets', 20 );

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
	if ( is_admin() ) {
		return $attributes;
	}
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

/**
 * Proteção defensiva para o Stripe no WooCommerce.
 * Quando o plugin oficial da Stripe está ativo mas as chaves API (Publishable Key)
 * estão em branco (""), impede que o script lance exceções não capturadas no checkout
 * em blocos e suprime o método vazio até que as chaves sejam introduzidas.
 */
function bronzepodcast_is_stripe_configured() {
	$stripe_settings = get_option( 'woocommerce_stripe_settings', array() );
	if ( ! is_array( $stripe_settings ) ) {
		return false;
	}
	$testmode = isset( $stripe_settings['testmode'] ) && 'yes' === $stripe_settings['testmode'];
	$pub_key  = $testmode ? ( $stripe_settings['test_publishable_key'] ?? '' ) : ( $stripe_settings['publishable_key'] ?? '' );
	return ! empty( trim( (string) $pub_key ) );
}

function bronzepodcast_disable_unconfigured_stripe_gateways( $gateways ) {
	if ( ! is_admin() && ! bronzepodcast_is_stripe_configured() ) {
		foreach ( array_keys( $gateways ) as $gateway_id ) {
			if ( 0 === strpos( $gateway_id, 'stripe' ) ) {
				unset( $gateways[ $gateway_id ] );
			}
		}
	}
	return $gateways;
}
add_filter( 'woocommerce_available_payment_gateways', 'bronzepodcast_disable_unconfigured_stripe_gateways', 999 );

function bronzepodcast_prevent_empty_stripe_script() {
	if ( ( function_exists( 'is_checkout' ) && is_checkout() ) || ( function_exists( 'is_cart' ) && is_cart() ) ) {
		if ( ! bronzepodcast_is_stripe_configured() ) {
			wp_dequeue_script( 'wc-stripe-blocks-checkout' );
			wp_deregister_script( 'wc-stripe-blocks-checkout' );
			wp_dequeue_script( 'stripe' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'bronzepodcast_prevent_empty_stripe_script', 999 );

function bronzepodcast_stripe_elements_styling( $styling = array() ) {
	return array(
		'base' => array(
			'color'             => '#ffffff',
			'fontFamily'        => 'Manrope, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
			'fontSize'          => '15px',
			'fontWeight'        => '500',
			'lineHeight'        => '24px',
			'fontSmoothing'     => 'antialiased',
			'iconColor'         => '#e6a47e',
			'::placeholder'     => array(
				'color' => '#d8d2c8',
			),
			':-webkit-autofill' => array(
				'color' => '#ffffff',
			),
		),
		'invalid' => array(
			'color'     => '#f87171',
			'iconColor' => '#f87171',
		),
	);
}
add_filter( 'wc_stripe_elements_styling', 'bronzepodcast_stripe_elements_styling', 999 );
add_filter( 'wc_stripe_elements_options', function( $options ) {
	if ( ! is_array( $options ) ) {
		$options = array();
	}
	$options['style'] = bronzepodcast_stripe_elements_styling( array() );
	return $options;
}, 999 );
add_filter( 'wc_stripe_params', function( $params ) {
	if ( is_array( $params ) ) {
		if ( ! isset( $params['elements_options'] ) || ! is_array( $params['elements_options'] ) ) {
			$params['elements_options'] = array();
		}
		$params['elements_options']['style'] = bronzepodcast_stripe_elements_styling( array() );
	}
	return $params;
}, 999 );

function bronzepodcast_stripe_js_guard() {
	if ( is_admin() ) {
		return;
	}
	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		?>
		<script>
		/* Bronze Podcast: Proteção contra erros vazios e estilização escura de alto contraste para o Stripe Elements */
		(function() {
			var patchElements = function(elementsGroup) {
				if (!elementsGroup || elementsGroup.__bronze_patched) return elementsGroup;
				elementsGroup.__bronze_patched = true;

				var origCreate = elementsGroup.create;
				elementsGroup.create = function(type, opts) {
					opts = opts || {};
					opts.style = opts.style || {};
					opts.style.base = opts.style.base || {};

					opts.style.base.color = '#ffffff';
					opts.style.base.fontFamily = 'Manrope, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
					opts.style.base.fontSize = '15px';
					opts.style.base.fontWeight = '500';
					opts.style.base.lineHeight = '24px';
					opts.style.base.iconColor = '#e6a47e';
					opts.style.base['::placeholder'] = {
						color: '#d8d2c8'
					};
					opts.style.base[':-webkit-autofill'] = {
						color: '#ffffff'
					};

					if (!opts.style.invalid) {
						opts.style.invalid = {};
					}
					opts.style.invalid.color = '#f87171';
					opts.style.invalid.iconColor = '#f87171';

					return origCreate.call(this, type, opts);
				};
				return elementsGroup;
			};

			var wrapStripeInstance = function(instance) {
				if (!instance || instance.__bronze_inst_patched) return instance;
				instance.__bronze_inst_patched = true;

				var origElements = instance.elements;
				if (typeof origElements === 'function') {
					instance.elements = function(elementsOpts) {
						var group = origElements.apply(this, arguments);
						return patchElements(group);
					};
				}
				return instance;
			};

			var wrapStripeFn = function(realStripe) {
				return function(key, opts) {
					if (!key || typeof key !== 'string' || key.trim() === '') {
						console.warn('[Bronze Theme] Chave Stripe vazia evitada com sucesso.');
						return {
							elements: function() {
								return {
									create: function() {
										return { mount: function() {}, on: function() {} };
									}
								};
							}
						};
					}
					var inst = realStripe(key, opts);
					return wrapStripeInstance(inst);
				};
			};

			var _rawStripe = window.Stripe;
			if (typeof _rawStripe === 'function') {
				window.Stripe = wrapStripeFn(_rawStripe);
			}

			Object.defineProperty(window, 'Stripe', {
				configurable: true,
				enumerable: true,
				get: function() { return _rawStripe; },
				set: function(realStripe) {
					_rawStripe = wrapStripeFn(realStripe);
				}
			});
		})();
		</script>
		<?php
	}
}
add_action( 'wp_head', 'bronzepodcast_stripe_js_guard', 1 );

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
 * Força a etiqueta de promoção do WooCommerce em português.
 */
function bronzepodcast_custom_sale_flash( $html, $post, $product ) {
	return '<span class="onsale">' . esc_html__( 'Promoção', 'bronzepodcast' ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'bronzepodcast_custom_sale_flash', 10, 3 );

/**
 * Tradução de termos e contagens do WooCommerce para português de Portugal.
 */
function bronzepodcast_filter_woocommerce_translations( $translation, $text, $domain ) {
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $translation;
	}

	static $translations_map = null;

	if ( null === $translations_map ) {
		$translations_map = array(
			// Catálogo e Produtos
			'Sale!'                                                                     => 'Promoção',
			'Select options'                                                            => 'Comprar',
			'Read more'                                                                 => 'Ver mais',
			'View cart'                                                                 => 'Ver carrinho',
			'Shop order'                                                                => 'Ordenar loja',
			'Product Pagination'                                                        => 'Paginação de produtos',
			'This product has multiple variants. The options may be chosen on the product page' => 'Este artigo tem várias opções que podem ser escolhidas na página do produto.',
			'&ldquo;%s&rdquo; has been added to your cart.'                            => '&ldquo;%s&rdquo; foi adicionado ao seu carrinho.',
			'Description'                                                               => 'Descrição',
			'Additional information'                                                    => 'Informação Adicional',
			'Category:'                                                                 => 'Categoria:',
			'Categories:'                                                               => 'Categorias:',
			'Tag:'                                                                      => 'Etiqueta:',
			'Tags:'                                                                     => 'Etiquetas:',
			'Related products'                                                          => 'Produtos Relacionados',
			'Default sorting'                                                           => 'Ordem dos itens',
			'Sort by popularity'                                                        => 'Popularidade',
			'Sort by average rating'                                                    => 'Classificação média',
			'Sort by latest'                                                            => 'Mais recentes',
			'Sort by price: low to high'                                                => 'Preço: mais baixo para o mais alto',
			'Sort by price: high to low'                                                => 'Preço: mais alto para o mais baixo',
			'Showing the single result'                                                 => 'A mostrar o único resultado',
			'In stock'                                                                  => 'Em stock',
			'Out of stock'                                                              => 'Esgotado',

			// Carrinho e Checkout (WooCommerce Blocks & Clássico)
			'Shipping address'                                                          => 'Morada de envio',
			'Shipping Address'                                                          => 'Morada de envio',
			'Shipping options'                                                          => 'Opções de envio',
			'Shipping Options'                                                          => 'Opções de envio',
			'Payment options'                                                           => 'Opções de pagamento',
			'Payment Options'                                                           => 'Opções de pagamento',
			'Payment methods'                                                           => 'Métodos de pagamento',
			'Payment Methods'                                                           => 'Métodos de pagamento',
			'Billing address'                                                           => 'Morada de faturação',
			'Billing Address'                                                           => 'Morada de faturação',
			'Billing details'                                                           => 'Dados de faturação',
			'Billing Details'                                                           => 'Dados de faturação',
			'Add a note to your order'                                                  => 'Adicionar uma nota à sua encomenda',
			'Add a note'                                                                => 'Adicionar uma nota',
			'Order notes'                                                               => 'Notas da encomenda',
			'Order notes (optional)'                                                    => 'Notas da encomenda (opcional)',
			'Notes about your order, e.g. special notes for delivery.'                  => 'Instruções ou notas especiais sobre a entrega da sua encomenda.',
			'Order summary'                                                             => 'Resumo da encomenda',
			'Order Summary'                                                             => 'Resumo da encomenda',
			'Add coupons'                                                               => 'Adicionar cupão',
			'Add Coupons'                                                               => 'Adicionar cupão',
			'Add a coupon'                                                              => 'Adicionar cupão',
			'Coupons'                                                                   => 'Cupões',
			'Coupon code'                                                               => 'Código do cupão',
			'Have a coupon?'                                                            => 'Tem um cupão de desconto?',
			'Enter code'                                                                => 'Inserir código',
			'Apply'                                                                     => 'Aplicar',
			'Remove'                                                                    => 'Remover',
			'First name'                                                                => 'Primeiro nome',
			'Last name'                                                                 => 'Apelido',
			'Company'                                                                   => 'Empresa',
			'Company (optional)'                                                        => 'Empresa (opcional)',
			'Address'                                                                   => 'Morada',
			'Apartment, suite, etc.'                                                    => 'Apartamento, fração, andar, etc.',
			'Add apartment, suite, etc.'                                                => 'Apartamento, fração, andar, etc. (opcional)',
			'+ Add apartment, suite, etc.'                                              => '+ Adicionar apartamento, fração, andar, etc.',
			'+ Add apartamento, fração, andar, etc.'                                    => '+ Adicionar apartamento, fração, andar, etc.',
			'Postal code'                                                               => 'Código postal',
			'Postcode / ZIP'                                                            => 'Código postal',
			'City'                                                                      => 'Cidade',
			'Country/Region'                                                            => 'País / Região',
			'Country / Region'                                                          => 'País / Região',
			'Country'                                                                   => 'País',
			'Phone'                                                                     => 'Telefone',
			'Phone (optional)'                                                          => 'Telefone (opcional)',
			'Email address'                                                             => 'Endereço de email',
			'Use same address for billing'                                              => 'Usar a mesma morada para faturação',
			'Use same address for delivery'                                             => 'Usar a mesma morada para entrega',
			'Save payment information to my account for future purchases.'              => 'Guardar os dados de pagamento na minha conta para futuras compras.',
			'Place order'                                                               => 'Finalizar encomenda',
			'Place Order'                                                               => 'Finalizar encomenda',
			'Contact information'                                                       => 'Informações de contacto',
			'Contact Information'                                                       => 'Informações de contacto',
			'Subtotal'                                                                  => 'Subtotal',
			'Total'                                                                     => 'Total',
			'Shipping'                                                                  => 'Envio',
			'Discount'                                                                  => 'Desconto',
			'Taxes'                                                                     => 'Impostos',
			'Including %s in taxes'                                                     => 'Inclui %s em impostos',
			'There are no payment methods available. This may be an error on our side, please contact us if you need any help placing your order.' => 'Não existem métodos de pagamento disponíveis. Se necessitar de assistência com a sua encomenda, por favor contacte-nos.',
			'Credit Card'                                                               => 'Cartão de Crédito',
			'Credit / Debit Card'                                                       => 'Cartão de Crédito / Débito',
			'Card'                                                                      => 'Cartão de Crédito',
			'Card Number'                                                               => 'Número do cartão',
			'Card number'                                                               => 'Número do cartão',
			'Expiry Date'                                                               => 'Data de validade',
			'Expiry date'                                                               => 'Data de validade',
			'Expiry'                                                                    => 'Data de validade',
			'Card Code (CVC)'                                                           => 'Código de segurança',
			'Security code'                                                             => 'Código de segurança',
			'Security Code'                                                             => 'Código de segurança',
			'MM / YY'                                                                   => 'MM / AA',
			'Return to Cart'                                                            => 'Voltar ao carrinho',
			'Return to cart'                                                            => 'Voltar ao carrinho',
			'Proceed to checkout'                                                       => 'Finalizar compra',
			'Proceed to Checkout'                                                       => 'Finalizar compra',
			'Cart totals'                                                               => 'Totais do carrinho',
			'Shopping cart'                                                             => 'Carrinho de compras',
			'Cart'                                                                      => 'Carrinho',
			'Empty cart'                                                                => 'Esvaziar carrinho',
			'Your cart is currently empty!'                                             => 'O seu carrinho está vazio!',
			'Browse store'                                                              => 'Explorar a loja',
			// Termos e Condições & Privacidade
			'Terms and conditions'                                                      => 'Termos e Condições',
			'Terms and Conditions'                                                      => 'Termos e Condições',
			'Privacy policy'                                                            => 'Política de Privacidade',
			'Privacy Policy'                                                            => 'Política de Privacidade',
			'By proceeding with your purchase you agree to our Terms and Conditions and Privacy Policy' => 'Ao prosseguir com a sua compra, concorda com os nossos Termos e Condições e Política de Privacidade',
			'By placing your order you agree to our Terms and Conditions and Privacy Policy' => 'Ao finalizar a sua encomenda, concorda com os nossos Termos e Condições e Política de Privacidade',
			'By proceeding with your purchase you agree to our %1$s and %2$s'           => 'Ao prosseguir com a sua compra, concorda com os nossos %1$s e a %2$s',
			'By placing your order you agree to our %1$s and %2$s'                      => 'Ao finalizar a sua encomenda, concorda com os nossos %1$s e a %2$s',

			// Carrinho / Cart Items & Express Checkout
			'Product'                                                                   => 'Produto',
			'PRODUCT'                                                                   => 'PRODUTO',
			'Products'                                                                  => 'Produtos',
			'PRODUCTS'                                                                  => 'PRODUTOS',
			'Quantity'                                                                  => 'Quantidade',
			'QUANTITY'                                                                  => 'QUANTIDADE',
			'Price'                                                                     => 'Preço',
			'PRICE'                                                                     => 'PREÇO',
			'Estimated total'                                                           => 'Total estimado',
			'Estimated Total'                                                           => 'Total estimado',
			'Estimated shipping'                                                        => 'Envio estimado',
			'Estimated Shipping'                                                        => 'Envio estimado',
			'Express checkout'                                                          => 'Pagamento Expresso',
			'Express Checkout'                                                          => 'Pagamento Expresso',
			'Express Payment'                                                           => 'Pagamento Expresso',
			'Express payment'                                                           => 'Pagamento Expresso',
			'Express payment methods'                                                   => 'Métodos de pagamento expresso',
			'Available payment methods'                                                 => 'Métodos de pagamento disponíveis',
			'OR'                                                                        => 'OU',
			'Or'                                                                        => 'Ou',
			'or'                                                                        => 'ou',
			'Or continue below'                                                         => 'Ou continue abaixo',
			'or continue below'                                                         => 'ou continue abaixo',
			'Or continue below:'                                                        => 'Ou continue abaixo:',
			'or continue below:'                                                        => 'ou continue abaixo:',
			'Or continue with'                                                          => 'Ou continue com',
			'or continue with'                                                          => 'ou continue com',
			'Remove item'                                                               => 'Remover item',
			'Remove this item'                                                          => 'Remover este item',
			'Reduce quantity'                                                           => 'Diminuir quantidade',
			'Increase quantity'                                                         => 'Aumentar quantidade',

			'Update cart'                                                               => 'Atualizar carrinho',
			'Coupon'                                                                    => 'Cupão',
			'Apply coupon'                                                              => 'Aplicar cupão',
			'Coupon code applied successfully.'                                         => 'Cupão aplicado com sucesso.',
		);
	}

	if ( isset( $translations_map[ $text ] ) ) {
		if ( empty( $domain ) || 'woocommerce' === $domain || 'woocommerce-gateway-stripe' === $domain || 'default' === $domain || strpos( (string) $domain, 'woocommerce' ) !== false || strpos( (string) $domain, 'stripe' ) !== false ) {
			return $translations_map[ $text ];
		}
	}

	return $translation;
}
add_filter( 'gettext', 'bronzepodcast_filter_woocommerce_translations', 20, 3 );

/**
 * Injeção de traduções no motor JavaScript (wp.i18n) e observador DOM para WooCommerce Blocks.
 * Executado exclusivamente no frontend público e estritamente nas páginas de Carrinho e Checkout.
 */
function bronzepodcast_checkout_i18n_script() {
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}

	$is_cart_or_checkout = false;
	if ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) ) {
		$is_cart_or_checkout = true;
	}
	if ( ! $is_cart_or_checkout && isset( $_SERVER['REQUEST_URI'] ) ) {
		$uri = untrailingslashit( wp_parse_url( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ), PHP_URL_PATH ) );
		if ( in_array( $uri, array( '/cart', '/carrinho', '/checkout', '/finalizar-compra' ), true ) ) {
			$is_cart_or_checkout = true;
		}
	}

	if ( ! $is_cart_or_checkout ) {
		return;
	}
	?>
	<script>
	/* Bronze Podcast: Internacionalização estritamente contida para WooCommerce Blocks & Stripe */
	(function() {
		var dictionary = {
			'PRODUCT': 'PRODUTO',
			'Product': 'Produto',
			'PRODUCTS': 'PRODUTOS',
			'Products': 'Produtos',
			'TOTAL': 'TOTAL',
			'Total': 'Total',
			'QUANTITY': 'QUANTIDADE',
			'Quantity': 'Quantidade',
			'PRICE': 'PREÇO',
			'Price': 'Preço',
			'Estimated total': 'Total estimado',
			'Estimated Total': 'Total estimado',
			'Estimated shipping': 'Envio estimado',
			'Estimated Shipping': 'Envio estimado',
			'Express checkout': 'Pagamento Expresso',
			'Express Checkout': 'Pagamento Expresso',
			'Express Payment': 'Pagamento Expresso',
			'Express payment': 'Pagamento Expresso',
			'Express payment methods': 'Métodos de pagamento expresso',
			'Available payment methods': 'Métodos de pagamento disponíveis',
			'OR': 'OU',
			'Or': 'Ou',
			'or': 'ou',
			'Or continue below': 'Ou continue abaixo',
			'or continue below': 'ou continue abaixo',
			'Or continue below:': 'Ou continue abaixo:',
			'or continue below:': 'ou continue abaixo:',
			'Or continue with': 'Ou continue com',
			'or continue with': 'ou continue com',
			'Shipping address': 'Morada de envio',
			'Shipping Address': 'Morada de envio',
			'Shipping options': 'Opções de envio',
			'Shipping Options': 'Opções de envio',
			'Payment options': 'Opções de pagamento',
			'Payment Options': 'Opções de pagamento',
			'Payment methods': 'Métodos de pagamento',
			'Payment Methods': 'Métodos de pagamento',
			'Add a note to your order': 'Adicionar uma nota à sua encomenda',
			'Add a note': 'Adicionar uma nota',
			'Order notes': 'Notas da encomenda',
			'Order notes (optional)': 'Notas da encomenda (opcional)',
			'Order summary': 'Resumo da encomenda',
			'Order Summary': 'Resumo da encomenda',
			'Add coupons': 'Adicionar cupão',
			'Add Coupons': 'Adicionar cupão',
			'Add a coupon': 'Adicionar cupão',
			'Coupons': 'Cupões',
			'Coupon code': 'Código do cupão',
			'Have a coupon?': 'Tem um cupão de desconto?',
			'Enter code': 'Inserir código',
			'Apply': 'Aplicar',
			'Remove': 'Remover',
			'Remove item': 'Remover item',
			'Remove this item': 'Remover este item',
			'Use same address for billing': 'Usar a mesma morada para faturação',
			'Use same address for delivery': 'Usar a mesma morada para entrega',
			'+ Add apartment, suite, etc.': '+ Adicionar apartamento, fração, andar, etc.',
			'Add apartment, suite, etc.': 'Adicionar apartamento, fração, andar, etc.',
			'Country/Region': 'País / Região',
			'Country / Region': 'País / Região',
			'Country': 'País',
			'Billing address': 'Morada de faturação',
			'Billing Address': 'Morada de faturação',
			'Billing details': 'Dados de faturação',
			'Contact information': 'Informações de contacto',
			'Contact Information': 'Informações de contacto',
			'Card': 'Cartão de Crédito',
			'Credit Card': 'Cartão de Crédito',
			'Credit / Debit Card': 'Cartão de Crédito / Débito',
			'Card number': 'Número do cartão',
			'Card Number': 'Número do cartão',
			'Expiry Date': 'Data de validade',
			'Expiry date': 'Data de validade',
			'Expiry': 'Data de validade',
			'Security code': 'Código de segurança',
			'Security Code': 'Código de segurança',
			'Card Code (CVC)': 'Código de segurança',
			'MM / YY': 'MM / AA',
			'Return to Cart': 'Voltar ao carrinho',
			'Return to cart': 'Voltar ao carrinho',
			'Proceed to checkout': 'Finalizar compra',
			'Proceed to Checkout': 'Finalizar compra',
			'Place order': 'Finalizar encomenda',
			'Place Order': 'Finalizar encomenda',
			'Cart totals': 'Totais do carrinho',
			'Shopping cart': 'Carrinho de compras',
			'Cart': 'Carrinho',
			'Empty cart': 'Esvaziar carrinho',
			'Your cart is currently empty!': 'O seu carrinho está vazio!',
			'Browse store': 'Explorar a loja',
			'Terms and Conditions': 'Termos e Condições',
			'Terms and conditions': 'Termos e Condições',
			'Privacy Policy': 'Política de Privacidade',
			'Privacy policy': 'Política de Privacidade',
			'By proceeding with your purchase you agree to our Terms and Conditions and Privacy Policy': 'Ao prosseguir com a sua compra, concorda com os nossos Termos e Condições e Política de Privacidade',
			'By placing your order you agree to our Terms and Conditions and Privacy Policy': 'Ao finalizar a sua encomenda, concorda com os nossos Termos e Condições e Política de Privacidade'
		};

		var localeInjected = false;
		function injectLocaleOnce() {
			if (localeInjected) return;
			if (window.wp && window.wp.i18n && window.wp.i18n.setLocaleData) {
				var jed = { '': { domain: 'woocommerce', lang: 'pt_PT' } };
				for (var key in dictionary) {
					jed[key] = [dictionary[key]];
				}
				window.wp.i18n.setLocaleData(jed, 'woocommerce');
				window.wp.i18n.setLocaleData(jed, 'woocommerce-gateway-stripe');
				localeInjected = true;
			}
		}

		var isTranslating = false;
		function translateSubtree(root) {
			if (!root || isTranslating) return;
			isTranslating = true;

			try {
				var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, null, false);
				var node;
				while ((node = walker.nextNode())) {
					var raw = node.nodeValue;
					if (!raw) continue;
					var val = raw.trim();
					if (!val) continue;

					if (dictionary[val]) {
						node.nodeValue = raw.replace(val, dictionary[val]);
					} else {
						var changed = raw;
						if (changed.indexOf('By proceeding with your purchase you agree to our') !== -1) {
							changed = changed.replace('By proceeding with your purchase you agree to our', 'Ao prosseguir com a sua compra, concorda com os nossos');
						}
						if (changed.indexOf('By placing your order you agree to our') !== -1) {
							changed = changed.replace('By placing your order you agree to our', 'Ao finalizar a sua encomenda, concorda com os nossos');
						}
						if (changed.indexOf('Terms and Conditions') !== -1) {
							changed = changed.replace('Terms and Conditions', 'Termos e Condições');
						}
						if (changed.indexOf('Privacy Policy') !== -1) {
							changed = changed.replace('Privacy Policy', 'Política de Privacidade');
						}
						if (changed.indexOf('Estimated total') !== -1) {
							changed = changed.replace('Estimated total', 'Total estimado');
						}
						if (changed.indexOf('Estimated Total') !== -1) {
							changed = changed.replace('Estimated Total', 'Total estimado');
						}
						if (changed.indexOf('Express Checkout') !== -1) {
							changed = changed.replace('Express Checkout', 'Pagamento Expresso');
						}
						if (changed.indexOf('Express checkout') !== -1) {
							changed = changed.replace('Express checkout', 'Pagamento Expresso');
						}
						if (changed.indexOf('Express Payment') !== -1) {
							changed = changed.replace('Express Payment', 'Pagamento Expresso');
						}
						if (changed.indexOf('Express payment') !== -1) {
							changed = changed.replace('Express payment', 'Pagamento Expresso');
						}
						if (changed.indexOf('Or continue below') !== -1) {
							changed = changed.replace(/Or continue below/gi, 'Ou continue abaixo');
						}
						if (changed.indexOf('or continue below') !== -1) {
							changed = changed.replace(/or continue below/gi, 'ou continue abaixo');
						}
						if (changed.indexOf('Or continue with') !== -1) {
							changed = changed.replace(/Or continue with/gi, 'Ou continue com');
						}
						if (changed.indexOf('+ Add ') === 0) {
							changed = changed.replace('+ Add ', '+ Adicionar ');
						}
						if (changed !== raw) {
							node.nodeValue = changed;
						}
					}
				}

				var attrEls = root.querySelectorAll('[placeholder], [aria-label], [title]');
				for (var i = 0; i < attrEls.length; i++) {
					var el = attrEls[i];
					var placeholder = el.getAttribute('placeholder');
					if (placeholder && dictionary[placeholder.trim()]) {
						el.setAttribute('placeholder', dictionary[placeholder.trim()]);
					}
					var ariaLabel = el.getAttribute('aria-label');
					if (ariaLabel) {
						var aTrim = ariaLabel.trim();
						if (dictionary[aTrim]) {
							el.setAttribute('aria-label', dictionary[aTrim]);
						} else if (aTrim.indexOf('Express Checkout') !== -1 || aTrim.indexOf('Express checkout') !== -1) {
							el.setAttribute('aria-label', aTrim.replace(/Express [cC]heckout/g, 'Pagamento Expresso'));
						}
					}
				}
			} finally {
				isTranslating = false;
			}
		}

		function runCartCheckoutTranslations() {
			injectLocaleOnce();
			var targets = document.querySelectorAll('.wc-block-cart, .wc-block-checkout, .woocommerce-cart, .woocommerce-checkout, .woocommerce');
			if (targets.length > 0) {
				for (var i = 0; i < targets.length; i++) {
					translateSubtree(targets[i]);
				}
			} else {
				var main = document.querySelector('main, #primary, body');
				if (main) {
					translateSubtree(main);
				}
			}
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', function() {
				runCartCheckoutTranslations();
			});
		} else {
			runCartCheckoutTranslations();
		}

		var scheduled = false;
		var observer = new MutationObserver(function() {
			if (isTranslating || scheduled) return;
			scheduled = true;
			window.requestAnimationFrame(function() {
				scheduled = false;
				runCartCheckoutTranslations();
			});
		});

		var observeTarget = document.querySelector('main') || document.body || document.documentElement;
		observer.observe(observeTarget, {
			childList: true,
			subtree: true
		});
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'bronzepodcast_checkout_i18n_script', 20 );

/**
 * Tradução das contagens com contexto do WooCommerce (ex: Showing 1–9 of 44 results).
 */
function bronzepodcast_filter_woocommerce_translations_with_context( $translation, $text, $context, $domain ) {
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $translation;
	}

	if ( 'woocommerce' === $domain ) {
		if ( 'with first and last result' === $context ) {
			if ( strpos( $text, 'Showing %1$d' ) !== false ) {
				return 'A mostrar %1$d&ndash;%2$d de %3$d resultados';
			}
		}
	}
	return $translation;
}
add_filter( 'gettext_with_context', 'bronzepodcast_filter_woocommerce_translations_with_context', 20, 4 );

/**
 * Tradução das contagens no plural com contexto (ex: Showing 1–9 of 44 results).
 */
function bronzepodcast_filter_woocommerce_ngettext_with_context( $translation, $single, $plural, $number, $context, $domain ) {
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $translation;
	}

	if ( 'woocommerce' === $domain ) {
		if ( 'with first and last result' === $context ) {
			return 'A mostrar %1$d&ndash;%2$d de %3$d resultados';
		}
	}
	return $translation;
}
add_filter( 'ngettext_with_context', 'bronzepodcast_filter_woocommerce_ngettext_with_context', 20, 6 );

/**
 * Tradução das contagens no plural (ex: Showing 19-27 of 56 results).
 */
function bronzepodcast_filter_woocommerce_ngettext( $translation, $single, $plural, $number, $domain ) {
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $translation;
	}

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
	if ( is_admin() ) {
		return $text;
	}
	if ( ! is_product() ) {
		return __( 'Comprar', 'bronzepodcast' );
	}
	return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'bronzepodcast_product_add_to_cart_text', 99, 2 );

/**
 * Abre links de menus externos (como Tesouro dos Fiéis) em novo separador de forma segura.
 */
function bronzepodcast_external_menu_links( $atts, $item, $args ) {
	if ( ! empty( $atts['href'] ) ) {
		$home_host = wp_parse_url( home_url(), PHP_URL_HOST );
		$link_host = wp_parse_url( $atts['href'], PHP_URL_HOST );

		if ( $link_host && $link_host !== $home_host ) {
			$atts['target'] = '_blank';
			$atts['rel']    = 'noopener noreferrer';
		}
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'bronzepodcast_external_menu_links', 10, 3 );




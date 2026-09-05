<?php
/**
 * Configuração inicial não destrutiva do site.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Cria uma página apenas quando o respetivo endereço ainda não existe.
 *
 * @param string $title   Título da página.
 * @param string $slug    Endereço da página.
 * @param string $content Conteúdo inicial.
 * @return int ID da página ou zero em caso de erro.
 */
function bronzepodcast_create_page( $title, $slug, $content = '' ) {
	$existing = get_page_by_path( $slug, OBJECT, 'page' );

	if ( $existing instanceof WP_Post ) {
		return (int) $existing->ID;
	}

	$page_id = wp_insert_post(
		array(
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_content' => wp_kses_post( $content ),
			'post_status'  => 'publish',
			'post_type'    => 'page',
		),
		true
	);

	return is_wp_error( $page_id ) ? 0 : (int) $page_id;
}

/**
 * Prepara as páginas e o menu da primeira instalação sem substituir conteúdo.
 */
function bronzepodcast_after_switch_theme() {
	$about_content = <<<'HTML'
<p>Criei este Podcast em 2020, com o objetivo de divulgar a fé católica tradicional.</p>
<p>A estrutura hierárquica da Igreja Católica cedeu, e tal como a maioria das instituições do ocidente, está ocupada. Estamos como que na barca com os apóstolos e a tormenta não dá sinais de acalmar. O modernismo, o espírito mundano e a heresia penetram toda a estrutura eclesial. A hierarquia não dá resposta, pelo contrário, a estrutura canónica, sacramental e doutrinal está abalada nos seus fundamentos. Cabe agora a cada baptizado arregaçar as mangas e restaurar a Igreja à sua glória, sejamos o resto fiel.</p>
<h2>Não se pode separar a Fé da Nação</h2>
<p>A Revolução Cultural está aí. Tudo arrasta, tudo destrói. A soberania das nações é ameaçada, as famílias e os pequenos negócios dizimados, a moral e a ordem natural invertidas e desprezadas.</p>
<p>Sempre fomos uma Nação Cristã, o que aconteceu? Porque estamos sem filhos e sem capacidade de simplesmente manter os básicos?</p>
<h2>Um Combate Espiritual</h2>
<p>Estamos, antes de tudo, num combate espiritual. Um combate que não é de agora, é imemorial.</p>
<p>Só Cristo pode acalmar a tormenta, na Igreja e no mundo.</p>
<p>No entanto, façamos a nossa parte, somos insignificantes, sejamos fiéis no pouco, pois assim o seremos no muito.</p>
<p>Sejamos os soldados que Cristo precisa, cada qual com os seus talentos. Sejamos os Portugueses que Portugal precisa.</p>
HTML;

	$pages = array(
		'home'     => bronzepodcast_create_page( 'Bronze Podcast', 'inicio' ),
		'sobre'    => bronzepodcast_create_page( 'Um Podcast Católico', 'sobre', $about_content ),
		'podcast'  => bronzepodcast_create_page( 'Podcast', 'podcast' ),
		'loja'     => bronzepodcast_create_page( 'Loja Online', 'loja' ),
		'contacto' => bronzepodcast_create_page( 'Contacto', 'contacto' ),
	);

	if ( $pages['home'] ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $pages['home'] );
	}

	if ( class_exists( 'WooCommerce' ) && $pages['loja'] ) {
		update_option( 'woocommerce_shop_page_id', $pages['loja'] );
	}

	$menu_name = 'Menu principal';
	$menu      = wp_get_nav_menu_object( $menu_name );
	$menu_id   = $menu ? (int) $menu->term_id : wp_create_nav_menu( $menu_name );

	if ( ! is_wp_error( $menu_id ) ) {
		if ( ! $menu ) {
			$items = array(
				array( 'title' => 'Sobre', 'page_id' => $pages['sobre'], 'url' => home_url( '/sobre/' ) ),
				array( 'title' => 'Podcast', 'page_id' => $pages['podcast'], 'url' => home_url( '/podcast/' ) ),
				array( 'title' => 'Oração', 'url' => 'https://tesourofieis.com' ),
				array( 'title' => 'Loja', 'page_id' => $pages['loja'], 'url' => home_url( '/loja/' ) ),
				array( 'title' => 'Contacto', 'page_id' => $pages['contacto'], 'url' => home_url( '/contacto/' ) ),
			);

			foreach ( $items as $item ) {
				$menu_item = array(
					'menu-item-title'  => $item['title'],
					'menu-item-status' => 'publish',
				);

				if ( ! empty( $item['page_id'] ) ) {
					$menu_item['menu-item-object-id'] = (int) $item['page_id'];
					$menu_item['menu-item-object']    = 'page';
					$menu_item['menu-item-type']      = 'post_type';
				} else {
					$menu_item['menu-item-url']  = $item['url'];
					$menu_item['menu-item-type'] = 'custom';
				}

				wp_update_nav_menu_item(
					$menu_id,
					0,
					$menu_item
				);
			}
		}

		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'bronzepodcast_after_switch_theme' );

/**
 * Liga automaticamente a página /loja/ quando o WooCommerce é ativado depois do tema.
 */
function bronzepodcast_assign_shop_page() {
	$shop_page = get_page_by_path( 'loja', OBJECT, 'page' );

	if (
		class_exists( 'WooCommerce' ) &&
		$shop_page instanceof WP_Post &&
		(int) get_option( 'woocommerce_shop_page_id' ) !== (int) $shop_page->ID
	) {
		update_option( 'woocommerce_shop_page_id', (int) $shop_page->ID );
	}
}
add_action( 'woocommerce_init', 'bronzepodcast_assign_shop_page' );

/**
 * Cria automaticamente as páginas de termos legais e envios se ainda não existirem.
 */
function bronzepodcast_setup_legal_pages() {
	$terms_content = <<<'HTML'
<p>Bem-vindo à Loja do Bronze Podcast. Ao realizar uma encomenda, concordas com os termos e condições gerais aqui estabelecidos.</p>
<h2>1. Encomendas e Pagamentos</h2>
<p>Todas as encomendas estão sujeitas à disponibilidade de stock. Os preços são apresentados em Euros (€) e incluem o IVA à taxa legal em vigor.</p>
<h2>2. Envios e Prazos</h2>
<p>As encomendas são expedidas a partir de Portugal através dos CTT Expresso. Os prazos normais de entrega situam-se entre 1 a 3 dias úteis para Portugal Continental e até 5 a 8 dias úteis para a Europa.</p>
<h2>3. Apoio ao Cliente</h2>
<p>Para qualquer questão sobre a tua encomenda, entra em contacto direto connosco através do endereço <a href="mailto:info@bronzepodcast.com">info@bronzepodcast.com</a>.</p>
HTML;

	$privacy_content = <<<'HTML'
<p>O Bronze Podcast respeita a privacidade e a segurança dos dados pessoais dos seus ouvintes e clientes, atuando em conformidade com o Regulamento Geral sobre a Proteção de Dados (RGPD).</p>
<h2>1. Recolha de Dados</h2>
<p>Os dados fornecidos no formulário de contacto ou no processo de compra (nome, email, morada e telefone) são utilizados exclusivamente para o processamento de encomendas e comunicação de apoio ao cliente.</p>
<h2>2. Pagamentos Seguros</h2>
<p>Os pagamentos são processados de forma encriptada através da Stripe. O Bronze Podcast não guarda nem tem acesso a números de cartão de crédito ou dados bancários confidenciais.</p>
<h2>3. Os Teus Direitos</h2>
<p>Podes a qualquer momento solicitar a consulta, retificação ou eliminação dos teus dados enviando um email para <a href="mailto:info@bronzepodcast.com">info@bronzepodcast.com</a>.</p>
HTML;

	$shipping_content = <<<'HTML'
<p>Todas as peças da Loja Bronze são cuidadosamente embaladas e enviadas a partir de Portugal para garantir a sua integridade durante o transporte.</p>
<h2>Escalões de Envio (CTT Expresso)</h2>
<h3>Portugal (Continental e Ilhas)</h3>
<ul>
<li><strong>Até 1 kg:</strong> 3,99 €</li>
<li><strong>1 a 5 kg:</strong> 14,90 €</li>
<li><strong>5 a 15 kg:</strong> 19,90 €</li>
</ul>
<h3>Europa</h3>
<ul>
<li><strong>Até 1 kg:</strong> 7,99 €</li>
<li><strong>1 a 5 kg:</strong> 15,99 €</li>
<li><strong>5 a 15 kg:</strong> 24,90 €</li>
</ul>
<h2>Direito de Livre Resolução e Devoluções</h2>
<p>Nos termos da legislação europeia e portuguesa, dispões de 14 dias seguidos após a receção da encomenda para exercer o direito de livre resolução e devolver qualquer artigo não personalizado que se encontre no estado original e não utilizado.</p>
<p>Para iniciar uma devolução, escreve previamente para <a href="mailto:info@bronzepodcast.com">info@bronzepodcast.com</a> com o número da tua encomenda.</p>
HTML;

	bronzepodcast_create_page( 'Termos e Condições', 'termos-e-condicoes', $terms_content );
	bronzepodcast_create_page( 'Política de Privacidade', 'politica-de-privacidade', $privacy_content );
	bronzepodcast_create_page( 'Envios e Devoluções', 'envios-e-devolucoes', $shipping_content );
}
add_action( 'init', 'bronzepodcast_setup_legal_pages' );

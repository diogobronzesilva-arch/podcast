<?php
/**
 * Gestão de Episódios do Bronze Podcast (Custom Post Type nativo).
 *
 * Permite adicionar e gerir episódios diretamente no painel do WordPress,
 * com fallback automático para a lista curada caso ainda não existam episódios na base de dados.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Regista o Custom Post Type 'podcast_episode'.
 */
function bronzepodcast_register_episode_cpt() {
	$labels = array(
		'name'                  => _x( 'Episódios', 'Post type general name', 'bronzepodcast' ),
		'singular_name'         => _x( 'Episódio', 'Post type singular name', 'bronzepodcast' ),
		'menu_name'             => _x( 'Episódios', 'Admin Menu text', 'bronzepodcast' ),
		'name_admin_bar'        => _x( 'Episódio', 'Add New on Toolbar', 'bronzepodcast' ),
		'add_new'               => __( 'Adicionar Novo', 'bronzepodcast' ),
		'add_new_item'          => __( 'Adicionar Novo Episódio', 'bronzepodcast' ),
		'new_item'              => __( 'Novo Episódio', 'bronzepodcast' ),
		'edit_item'             => __( 'Editar Episódio', 'bronzepodcast' ),
		'view_item'             => __( 'Ver Episódio', 'bronzepodcast' ),
		'all_items'             => __( 'Todos os Episódios', 'bronzepodcast' ),
		'search_items'          => __( 'Pesquisar Episódios', 'bronzepodcast' ),
		'not_found'             => __( 'Nenhum episódio encontrado.', 'bronzepodcast' ),
		'not_found_in_trash'    => __( 'Nenhum episódio no lixo.', 'bronzepodcast' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'episodio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-microphone',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'podcast_episode', $args );
}
add_action( 'init', 'bronzepodcast_register_episode_cpt' );

/**
 * Adiciona a Meta Box com campos operacionais do episódio.
 */
function bronzepodcast_add_episode_meta_boxes() {
	add_meta_box(
		'bronzepodcast_episode_details',
		__( 'Detalhes do Episódio (YouTube & Spotify)', 'bronzepodcast' ),
		'bronzepodcast_render_episode_meta_box',
		'podcast_episode',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'bronzepodcast_add_episode_meta_boxes' );

/**
 * Renderiza o formulário da Meta Box no painel.
 *
 * @param WP_Post $post Objeto do post atual.
 */
function bronzepodcast_render_episode_meta_box( $post ) {
	wp_nonce_field( 'bronzepodcast_save_episode_meta', 'bronzepodcast_episode_meta_nonce' );

	$code     = get_post_meta( $post->ID, '_podcast_code', true );
	$concept  = get_post_meta( $post->ID, '_podcast_concept', true );
	$youtube  = get_post_meta( $post->ID, '_podcast_youtube', true );
	$spotify  = get_post_meta( $post->ID, '_podcast_spotify', true );
	$featured = get_post_meta( $post->ID, '_podcast_featured', true );
	?>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="podcast_code"><?php esc_html_e( 'Código do Episódio', 'bronzepodcast' ); ?></label></th>
			<td>
				<input type="text" id="podcast_code" name="podcast_code" value="<?php echo esc_attr( $code ); ?>" placeholder="Ex: B08" class="regular-text" />
				<p class="description"><?php esc_html_e( 'Exemplo: B08, B07 ou #48.', 'bronzepodcast' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="podcast_concept"><?php esc_html_e( 'Conceito / Tema Chave', 'bronzepodcast' ); ?></label></th>
			<td>
				<input type="text" id="podcast_concept" name="podcast_concept" value="<?php echo esc_attr( $concept ); ?>" placeholder="Ex: A Esperança" class="regular-text" />
				<p class="description"><?php esc_html_e( 'Etiqueta temática apresentada junto ao código (ex: A Fortaleza, A Queda, O Compromisso).', 'bronzepodcast' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="podcast_youtube"><?php esc_html_e( 'Link ou ID do YouTube', 'bronzepodcast' ); ?></label></th>
			<td>
				<input type="url" id="podcast_youtube" name="podcast_youtube" value="<?php echo esc_url( $youtube ); ?>" placeholder="https://www.youtube.com/watch?v=..." class="large-text" />
				<p class="description"><?php esc_html_e( 'URL completo do vídeo no YouTube.', 'bronzepodcast' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="podcast_spotify"><?php esc_html_e( 'Link do Spotify', 'bronzepodcast' ); ?></label></th>
			<td>
				<input type="url" id="podcast_spotify" name="podcast_spotify" value="<?php echo esc_url( $spotify ); ?>" placeholder="https://open.spotify.com/episode/..." class="large-text" />
				<p class="description"><?php esc_html_e( 'Link direto para o episódio ou programa no Spotify.', 'bronzepodcast' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php esc_html_e( 'Destaque na Página Inicial', 'bronzepodcast' ); ?></th>
			<td>
				<label for="podcast_featured">
					<input type="checkbox" id="podcast_featured" name="podcast_featured" value="1" <?php checked( $featured, '1' ); ?> />
					<?php esc_html_e( 'Marcar este episódio como o Destaque Principal na Homepage', 'bronzepodcast' ); ?>
				</label>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Guarda os metadados do episódio.
 *
 * @param int $post_id ID do post.
 */
function bronzepodcast_save_episode_meta( $post_id ) {
	if ( ! isset( $_POST['bronzepodcast_episode_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['bronzepodcast_episode_meta_nonce'] ), 'bronzepodcast_save_episode_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['podcast_code'] ) ) {
		update_post_meta( $post_id, '_podcast_code', sanitize_text_field( wp_unslash( $_POST['podcast_code'] ) ) );
	}

	if ( isset( $_POST['podcast_concept'] ) ) {
		update_post_meta( $post_id, '_podcast_concept', sanitize_text_field( wp_unslash( $_POST['podcast_concept'] ) ) );
	}

	if ( isset( $_POST['podcast_youtube'] ) ) {
		update_post_meta( $post_id, '_podcast_youtube', esc_url_raw( wp_unslash( $_POST['podcast_youtube'] ) ) );
	}

	if ( isset( $_POST['podcast_spotify'] ) ) {
		update_post_meta( $post_id, '_podcast_spotify', esc_url_raw( wp_unslash( $_POST['podcast_spotify'] ) ) );
	}

	$featured = isset( $_POST['podcast_featured'] ) ? '1' : '0';
	update_post_meta( $post_id, '_podcast_featured', $featured );
}
add_action( 'save_post_podcast_episode', 'bronzepodcast_save_episode_meta' );

/**
 * Extrai o ID do vídeo a partir de uma URL do YouTube.
 *
 * @param string $url URL do YouTube.
 * @return string ID do vídeo.
 */
function bronzepodcast_extract_youtube_id( $url ) {
	if ( empty( $url ) ) {
		return '';
	}
	if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) {
		return $match[1];
	}
	if ( strlen( trim( $url ) ) === 11 ) {
		return trim( $url );
	}
	return '';
}

/**
 * Lista estática curada de segurança (fallback garantido sem quebras).
 *
 * @return array
 */
function bronzepodcast_get_curated_default_episodes() {
	return array(
		array(
			'id'      => 'xsM6DrjWxM4',
			'code'    => 'B07',
			'concept' => 'A Fortaleza',
			'title'   => 'A Violência: Mansidão, Coragem e a Verdadeira Fortaleza',
			'desc'    => 'Sobre a imposição da violência pelos Estados modernos sobre os seus povos, os limites da autoridade e qual a verdadeira posição doutrinal e moral católica.',
			'youtube' => 'https://www.youtube.com/watch?v=xsM6DrjWxM4',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'S0EdIUdbcVE',
			'code'    => 'B06',
			'concept' => 'A Queda',
			'title'   => 'B06 - Justiça Original VS Pecado Original',
			'desc'    => 'Fundamentos na Sagrada Escritura, dogmas da Fé e a distinção essencial entre a justiça original e as consequências da Queda.',
			'youtube' => 'https://www.youtube.com/watch?v=S0EdIUdbcVE',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'P2J66t4AOTE',
			'code'    => 'B05',
			'concept' => 'O Compromisso',
			'title'   => 'B05 - O Noivo, a Noiva e o Compromisso',
			'desc'    => 'Sobre as características, virtudes e deveres no matrimónio católico perante o compromisso indissolúvel.',
			'youtube' => 'https://www.youtube.com/watch?v=P2J66t4AOTE',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'sUDiI2dN6Rg',
			'code'    => 'B04',
			'concept' => 'A Renúncia',
			'title'   => 'B04 - Tinha Tudo e Não Tinha Nada',
			'desc'    => 'O desapego das ilusões mundanas, a superação do vazio material e a redescoberta da oração interior.',
			'youtube' => 'https://www.youtube.com/watch?v=sUDiI2dN6Rg',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'FGAsf3R2hno',
			'code'    => 'B03',
			'concept' => 'A Usura',
			'title'   => 'B03 - Economia, Família e o Futuro c/ Murilo Resende',
			'desc'    => 'A erosão económica das famílias tradicionais, a moral contra a usura e os princípios de uma ordem social justa.',
			'youtube' => 'https://www.youtube.com/watch?v=FGAsf3R2hno',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'gJsI9GAMXiU',
			'code'    => 'B02',
			'concept' => 'A Rocha',
			'title'   => 'B02 - A Pedra Angular c/ Dr. Haugen',
			'desc'    => 'A firmeza imutável da doutrina da Igreja contra o relativismo secular contemporâneo.',
			'youtube' => 'https://www.youtube.com/watch?v=gJsI9GAMXiU',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'G5KFzh2gLCw',
			'code'    => 'B01',
			'concept' => 'A Verdade',
			'title'   => 'B01 - Da Ideologia à Busca da Verdade',
			'desc'    => 'O percurso intelectual e espiritual de rompimento com os dogmas liberais e socialistas em busca de Cristo.',
			'youtube' => 'https://www.youtube.com/watch?v=G5KFzh2gLCw',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'sMDfcIo4FG8',
			'code'    => '#70',
			'concept' => 'A Fidelidade',
			'title'   => '#70 - Firmeza de Princípios e Fidelidade à Fé',
			'desc'    => 'A defesa intransigente da verdade católica sem cedências ao espírito moderno em tempos de provação.',
			'youtube' => 'https://www.youtube.com/watch?v=sMDfcIo4FG8',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'lstDF0aAZ_c',
			'code'    => '#69',
			'concept' => 'A Santa Missa',
			'title'   => '#69 - O Sentido do Sagrado na Liturgia Católica',
			'desc'    => 'O valor transcendente do Santo Sacrifício da Missa, o recolhimento, a sacralidade e a liturgia perene.',
			'youtube' => 'https://www.youtube.com/watch?v=lstDF0aAZ_c',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'YaPC_g224TQ',
			'code'    => '#47',
			'concept' => 'O Silêncio',
			'title'   => '#47 - O Silêncio: A Busca de Deus no Mundo Moderno',
			'desc'    => 'A necessidade vital do recolhimento, da oração interior e da fuga ao ruído ensurdecedor da sociedade digital.',
			'youtube' => 'https://www.youtube.com/watch?v=YaPC_g224TQ',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'FPQ8jPFxd90',
			'code'    => '#35',
			'concept' => 'Portugal',
			'title'   => '#35 - Portugal: A Fundação e a Aliança com Cristo',
			'desc'    => 'A fundação mística da nacionalidade e o compromisso sagrado entre a Coroa de Portugal e a Fé Católica.',
			'youtube' => 'https://www.youtube.com/watch?v=FPQ8jPFxd90',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'o7E9CdRMKug',
			'code'    => '#20',
			'concept' => 'O Rosário',
			'title'   => '#20 - O Rosário: A Arma Espiritual dos Cristãos',
			'desc'    => 'A origem, a meditação dos mistérios e a eficácia invencível do Santo Rosário para a salvação das almas.',
			'youtube' => 'https://www.youtube.com/watch?v=o7E9CdRMKug',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
		array(
			'id'      => 'iEJ5DV8o0y8',
			'code'    => '#14',
			'concept' => 'Fátima',
			'title'   => '#14 - Fátima: Os Apelos e o Dogma da Fé',
			'desc'    => 'As aparições de 1917, as mensagens proféticas e a promessa de preservação da Fé em Portugal.',
			'youtube' => 'https://www.youtube.com/watch?v=iEJ5DV8o0y8',
			'spotify' => 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		),
	);
}

/**
 * Obtém todos os episódios publicados ou o fallback curado.
 *
 * @param int $limit Número máximo de episódios a devolver (-1 para todos).
 * @return array
 */
function bronzepodcast_get_all_episodes( $limit = -1 ) {
	$posts = get_posts(
		array(
			'post_type'      => 'podcast_episode',
			'post_status'    => 'publish',
			'posts_per_page' => $limit,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);

	if ( ! empty( $posts ) ) {
		$episodes = array();
		foreach ( $posts as $p ) {
			$yt_url = get_post_meta( $p->ID, '_podcast_youtube', true );
			$sp_url = get_post_meta( $p->ID, '_podcast_spotify', true );
			$code   = get_post_meta( $p->ID, '_podcast_code', true );
			$conc   = get_post_meta( $p->ID, '_podcast_concept', true );
			$desc   = has_excerpt( $p ) ? get_the_excerpt( $p ) : wp_strip_all_tags( $p->post_content );

			$episodes[] = array(
				'id'      => bronzepodcast_extract_youtube_id( $yt_url ),
				'code'    => ! empty( $code ) ? $code : 'B' . str_pad( $p->ID, 2, '0', STR_PAD_LEFT ),
				'concept' => ! empty( $conc ) ? $conc : 'Conversas',
				'title'   => get_the_title( $p ),
				'desc'    => $desc,
				'youtube' => ! empty( $yt_url ) ? $yt_url : 'https://www.youtube.com/@bronzepodcast',
				'spotify' => ! empty( $sp_url ) ? $sp_url : 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
			);
		}
		return $episodes;
	}

	$defaults = bronzepodcast_get_curated_default_episodes();
	if ( $limit > 0 && count( $defaults ) > $limit ) {
		return array_slice( $defaults, 0, $limit );
	}
	return $defaults;
}

/**
 * Obtém o episódio destacado para a homepage.
 *
 * @return array
 */
function bronzepodcast_get_featured_episode() {
	// Procurar por episódio explicitamente marcado com destaque
	$featured_posts = get_posts(
		array(
			'post_type'      => 'podcast_episode',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'meta_key'       => '_podcast_featured',
			'meta_value'     => '1',
		)
	);

	if ( ! empty( $featured_posts ) ) {
		$p      = $featured_posts[0];
		$yt_url = get_post_meta( $p->ID, '_podcast_youtube', true );
		$sp_url = get_post_meta( $p->ID, '_podcast_spotify', true );
		$code   = get_post_meta( $p->ID, '_podcast_code', true );
		$conc   = get_post_meta( $p->ID, '_podcast_concept', true );
		$desc   = has_excerpt( $p ) ? get_the_excerpt( $p ) : wp_strip_all_tags( $p->post_content );

		return array(
			'id'      => bronzepodcast_extract_youtube_id( $yt_url ),
			'code'    => ! empty( $code ) ? $code : 'Destaque',
			'concept' => ! empty( $conc ) ? $conc : 'Em Destaque',
			'title'   => get_the_title( $p ),
			'desc'    => $desc,
			'youtube' => ! empty( $yt_url ) ? $yt_url : 'https://www.youtube.com/@bronzepodcast',
			'spotify' => ! empty( $sp_url ) ? $sp_url : 'https://open.spotify.com/show/5Tp4o8Jrggk4CpSwjiQSOg',
		);
	}

	// Se não houver explicitamente marcado, tentar o mais recente
	$latest = bronzepodcast_get_all_episodes( 1 );
	if ( ! empty( $latest ) ) {
		return $latest[0];
	}

	$defaults = bronzepodcast_get_curated_default_episodes();
	return $defaults[0];
}

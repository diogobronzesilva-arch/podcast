<?php
/**
 * Lista de artigos no endereço histórico /blog-list/.
 *
 * @package BronzePodcast
 */

get_header();

$page_number = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
$posts_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => (int) get_option( 'posts_per_page', 10 ),
		'paged'          => $page_number,
	)
);
?>
<main id="primary" class="site-main">
	<section class="page-hero page-hero--blog">
		<div class="page-hero__overlay"></div>
		<div class="content-shell content-shell--wide page-hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Pensamento e tradição', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'Blog', 'bronzepodcast' ); ?></h1>
		</div>
	</section>

	<section class="section-pad">
		<div class="content-shell content-shell--wide">
			<?php if ( $posts_query->have_posts() ) : ?>
				<div class="post-grid">
					<?php
					while ( $posts_query->have_posts() ) :
						$posts_query->the_post();
						get_template_part( 'template-parts/content', 'card' );
					endwhile;
					?>
				</div>
				<?php
				$pagination = paginate_links(
					array(
						'total'   => $posts_query->max_num_pages,
						'current' => $page_number,
					)
				);
				if ( $pagination ) {
					echo wp_kses_post( $pagination );
				}
				?>
			<?php else : ?>
				<div class="setup-notice"><p><?php esc_html_e( 'Os artigos importados aparecerão aqui.', 'bronzepodcast' ); ?></p></div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
</main>
<?php
get_footer();

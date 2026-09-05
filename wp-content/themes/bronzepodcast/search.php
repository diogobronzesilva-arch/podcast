<?php
/**
 * Resultados de pesquisa.
 *
 * @package BronzePodcast
 */

get_header();
?>
<main id="primary" class="site-main section-pad">
	<div class="content-shell content-shell--wide">
		<header class="archive-header">
			<p class="eyebrow"><?php esc_html_e( 'Pesquisa', 'bronzepodcast' ); ?></p>
			<h1><?php printf( esc_html__( 'Resultados para “%s”', 'bronzepodcast' ), esc_html( get_search_query() ) ); ?></h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'card' );
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Não encontrámos resultados. Tenta uma pesquisa diferente.', 'bronzepodcast' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();

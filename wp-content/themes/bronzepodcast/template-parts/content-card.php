<?php
/**
 * Cartão de artigo.
 *
 * @package BronzePodcast
 */
?>
<article <?php post_class( 'post-card' ); ?>>
	<a class="post-card__image" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large' ); ?>
		<?php else : ?>
			<span class="post-card__placeholder"><span>BP</span></span>
		<?php endif; ?>
	</a>
	<div class="post-card__content">
		<div class="post-card__meta">
			<span><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></span>
			<?php
			if ( 'product' === get_post_type() ) {
				$terms = get_the_terms( get_the_ID(), 'product_cat' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					echo '<span>' . esc_html( $terms[0]->name ) . '</span>';
				}
			} else {
				$categories = get_the_category();
				if ( $categories ) {
					echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
				}
			}
			?>
		</div>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
		<?php if ( 'product' === get_post_type() ) : ?>
			<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Ver produto', 'bronzepodcast' ); ?> <span>↗</span></a>
		<?php else : ?>
			<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Ler artigo', 'bronzepodcast' ); ?> <span>↗</span></a>
		<?php endif; ?>
	</div>
</article>

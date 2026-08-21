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
			<?php $categories = get_the_category(); ?>
			<?php if ( $categories ) : ?><span><?php echo esc_html( $categories[0]->name ); ?></span><?php endif; ?>
		</div>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
		<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Ler artigo', 'bronzepodcast' ); ?> <span>↗</span></a>
	</div>
</article>

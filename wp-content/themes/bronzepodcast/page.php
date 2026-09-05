<?php
/**
 * Template de página.
 *
 * @package BronzePodcast
 */

get_header();

$is_shop_flow = ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) || ( function_exists( 'is_account_page' ) && is_account_page() );
$shell_class  = $is_shop_flow ? 'content-shell content-shell--wide' : 'content-shell content-shell--article prose';
?>
<main id="primary" class="site-main section-pad">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class( $shell_class ); ?>>
			<header class="entry-header">
				<p class="eyebrow"><?php echo esc_html( $is_shop_flow ? __( 'Loja Bronze', 'bronzepodcast' ) : get_bloginfo( 'name' ) ); ?></p>
				<h1><?php the_title(); ?></h1>
			</header>
			<?php if ( has_post_thumbnail() && ! $is_shop_flow ) : ?>
				<figure class="entry-image"><?php the_post_thumbnail( 'full' ); ?></figure>
			<?php endif; ?>
			<div class="entry-content"><?php the_content(); ?></div>
			<?php wp_link_pages(); ?>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();

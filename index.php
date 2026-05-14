<?php
/**
 * Archive / blog fallback.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="at-page">
	<div class="container">
		<div class="at-page__inner">

			<header class="at-page__header">
				<h1 class="at-page__title">
					<?php
					if ( is_home() && ! is_front_page() ) {
						single_post_title();
					} else {
						esc_html_e( 'Latest Posts', 'allotment-theme' );
					}
					?>
				</h1>
			</header>

			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'at-post-card' ); ?>>
						<h2 class="at-post-card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						<p class="at-post-card__meta">
							<?php echo esc_html( get_the_date() ); ?> · <?php echo esc_html( get_the_author() ); ?>
						</p>
						<div class="at-post-card__excerpt">
							<?php the_excerpt(); ?>
						</div>
						<a class="at-btn at-btn--outline at-btn--sm" href="<?php the_permalink(); ?>">
							<?php esc_html_e( 'Read more', 'allotment-theme' ); ?>
						</a>
					</article>
				<?php endwhile; ?>

				<?php allotment_theme_pagination(); ?>

			<?php else : ?>
				<p><?php esc_html_e( 'Nothing here yet — check back soon.', 'allotment-theme' ); ?></p>
			<?php endif; ?>

		</div>
	</div>
</section>

<?php
get_footer();

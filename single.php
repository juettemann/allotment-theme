<?php
/**
 * Single post template.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<article class="at-page">
	<div class="container">
		<div class="at-page__inner">
			<?php while ( have_posts() ) : the_post(); ?>
				<header class="at-page__header">
					<h1 class="at-page__title"><?php the_title(); ?></h1>
					<p class="at-page__meta">
						<?php
						printf(
							/* translators: 1: published date, 2: author name */
							esc_html__( 'Published %1$s by %2$s', 'allotment-theme' ),
							esc_html( get_the_date() ),
							esc_html( get_the_author() )
						);
						?>
					</p>
				</header>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="at-page__featured">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>
				<div class="at-page__content">
					<?php the_content(); ?>
				</div>
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
				<nav class="post-nav stack" aria-label="<?php esc_attr_e( 'Post', 'allotment-theme' ); ?>">
					<?php previous_post_link( '<div>%link</div>' ); ?>
					<?php next_post_link( '<div>%link</div>' ); ?>
				</nav>
			<?php endwhile; ?>
		</div>
	</div>
</article>

<?php
get_footer();

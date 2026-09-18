<?php
/**
 * Generic page template — used by plugin-created pages too.
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
				<?php
				/*
				 * A page with no title printed an empty <h1> and its margin:
				 * a screen reader announced a heading with nothing in it, and
				 * the page opened with ~48px of dead space. /about-us/committee/
				 * is one — its heading lives in the banner image instead.
				 */
				?>
				<?php if ( get_the_title() ) : ?>
					<header class="at-page__header">
						<h1 class="at-page__title"><?php the_title(); ?></h1>
					</header>
				<?php endif; ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="at-page__featured">
						<?php
						/*
						 * `full`, with a sizes describing the real slot: the image
						 * fills .at-page__inner, which is --container-max less the
						 * container's padding. WordPress would otherwise claim the
						 * registered size's own width, so a wide screen was handed
						 * a variant meant for 1024px and scaled it up.
						 */
						the_post_thumbnail(
							'full',
							[
								'sizes' => '(min-width: 1344px) 1216px, '
									. '(min-width: 1024px) calc(100vw - 64px), '
									. '(min-width: 640px) calc(100vw - 48px), '
									. 'calc(100vw - 32px)',
							]
						);
						?>
					</div>
				<?php endif; ?>
				<div class="at-page__content">
					<?php
					the_content();
					wp_link_pages( [
						'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'allotment-theme' ),
						'after'  => '</nav>',
					] );
					?>
				</div>
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			<?php endwhile; ?>
		</div>
	</div>
</article>

<?php
get_footer();

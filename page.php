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
						<?php the_post_thumbnail( 'large' ); ?>
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

<?php
/**
 * 404 page.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="at-error">
	<div class="container">
		<p class="at-error__code">404</p>
		<h1 class="at-error__title"><?php esc_html_e( 'This patch is overgrown', 'allotment-theme' ); ?></h1>
		<p class="at-error__body">
			<?php esc_html_e( "We couldn't find the page you were looking for. Try searching, or head back to the home page.", 'allotment-theme' ); ?>
		</p>
		<div class="at-error__actions">
			<a class="at-btn at-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Back to home', 'allotment-theme' ); ?>
			</a>
		</div>
		<div style="margin-top: 2rem; max-width: 28rem; margin-inline: auto;">
			<?php get_search_form(); ?>
		</div>
	</div>
</section>

<?php
get_footer();

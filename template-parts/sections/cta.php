<?php
/**
 * CTA band with sage gradient and decorative circles.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

$title       = allotment_mod( 'cta_title', allotment_default( 'cta_title' ) );
$body        = allotment_mod( 'cta_body', allotment_default( 'cta_body' ) );
$primary_t   = allotment_mod( 'cta_primary_text', allotment_default( 'cta_primary_text' ) );
$primary_u   = allotment_mod( 'cta_primary_url', allotment_default( 'cta_primary_url' ) );
$secondary_t = allotment_mod( 'cta_secondary_text', allotment_default( 'cta_secondary_text' ) );
$secondary_u = allotment_mod( 'cta_secondary_url', allotment_default( 'cta_secondary_url' ) );
?>
<section class="at-cta section">
	<span class="at-cta__deco" aria-hidden="true"></span>
	<div class="container">
		<div class="at-cta__inner text-center">
			<h2 class="at-cta__title"><?php echo esc_html( $title ); ?></h2>
			<p class="at-cta__body"><?php echo esc_html( $body ); ?></p>
			<div class="at-cta__actions">
				<?php if ( $primary_t ) : ?>
					<a class="at-btn at-btn--white at-btn--lg" href="<?php echo esc_url( $primary_u ); ?>">
						<?php echo esc_html( $primary_t ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $secondary_t ) : ?>
					<a class="at-btn at-btn--ghost-white at-btn--lg" href="<?php echo esc_url( $secondary_u ); ?>">
						<?php echo esc_html( $secondary_t ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

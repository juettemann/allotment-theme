<?php
/**
 * Hero section.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

$badge       = allotment_mod( 'hero_badge', allotment_default( 'hero_badge' ) );
$title_1     = allotment_mod( 'hero_title_line1', allotment_default( 'hero_title_line1' ) );
$title_2     = allotment_mod( 'hero_title_line2', allotment_default( 'hero_title_line2' ) );
$body        = allotment_mod( 'hero_body', allotment_default( 'hero_body' ) );
$primary_t   = allotment_mod( 'hero_primary_text', allotment_default( 'hero_primary_text' ) );
$primary_u   = allotment_mod( 'hero_primary_url', allotment_default( 'hero_primary_url' ) );
$secondary_t = allotment_mod( 'hero_secondary_text', allotment_default( 'hero_secondary_text' ) );
$secondary_u = allotment_mod( 'hero_secondary_url', allotment_default( 'hero_secondary_url' ) );
$stat_number = allotment_mod( 'stat_number', allotment_default( 'stat_number' ) );
$stat_label  = allotment_mod( 'stat_label', allotment_default( 'stat_label' ) );
$hero_image  = allotment_hero_image_url();
?>
<section class="at-hero">
	<div class="container">
		<div class="at-hero__inner">

			<div class="at-hero__content">
				<?php if ( $badge ) : ?>
					<span class="at-badge">
						<?php allotment_icon( 'leaf', [ 'size' => 'sm' ] ); ?>
						<?php echo esc_html( $badge ); ?>
					</span>
				<?php endif; ?>

				<h1 class="at-hero__title">
					<?php echo esc_html( $title_1 ); ?>
					<span class="at-hero__title-accent"><?php echo esc_html( $title_2 ); ?></span>
				</h1>

				<p class="at-hero__body"><?php echo esc_html( $body ); ?></p>

				<div class="at-hero__actions">
					<?php if ( $primary_t ) : ?>
						<a class="at-btn at-btn--accent at-btn--lg" href="<?php echo esc_url( $primary_u ); ?>">
							<?php echo esc_html( $primary_t ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $secondary_t ) : ?>
						<a class="at-btn at-btn--outline at-btn--lg" href="<?php echo esc_url( $secondary_u ); ?>">
							<?php allotment_icon( 'message-circle', [ 'size' => 'sm' ] ); ?>
							<?php echo esc_html( $secondary_t ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="at-hero__media">
				<div class="at-hero__image">
					<img src="<?php echo esc_url( $hero_image ); ?>" alt="" loading="eager">
				</div>
				<?php if ( $stat_number ) : ?>
					<div class="at-hero__stat">
						<span class="at-hero__stat-icon" aria-hidden="true">
							<?php allotment_icon( 'users', [ 'size' => 'lg' ] ); ?>
						</span>
						<div>
							<p class="at-hero__stat-number"><?php echo esc_html( $stat_number ); ?></p>
							<p class="at-hero__stat-label"><?php echo esc_html( $stat_label ); ?></p>
						</div>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>

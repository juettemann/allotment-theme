<?php
/**
 * Features section (3 cards).
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

$title = allotment_mod( 'features_title', allotment_default( 'features_title' ) );
$intro = allotment_mod( 'features_intro', allotment_default( 'features_intro' ) );
?>
<section class="at-features section">
	<div class="container">

		<div class="at-features__head">
			<h2 class="at-features__title"><?php echo esc_html( $title ); ?></h2>
			<p class="at-features__intro"><?php echo esc_html( $intro ); ?></p>
		</div>

		<div class="grid grid--3">
			<?php for ( $i = 1; $i <= 3; $i++ ) :
				$card = allotment_feature_card( $i );
				if ( ! $card ) {
					continue;
				}
				$variant = $card['variant'] ?: 'primary';
				?>
				<article class="at-feature at-feature--<?php echo esc_attr( $variant ); ?>">
					<span class="at-feature__icon" aria-hidden="true">
						<?php allotment_icon( $card['icon'], [ 'size' => 'lg' ] ); ?>
					</span>
					<h3 class="at-feature__title"><?php echo esc_html( $card['title'] ); ?></h3>
					<p class="at-feature__body"><?php echo esc_html( $card['body'] ); ?></p>
					<?php if ( ! empty( $card['items'] ) ) : ?>
						<ul class="at-feature__list">
							<?php foreach ( $card['items'] as $item ) : ?>
								<li>
									<?php allotment_icon( 'check', [ 'size' => 'sm' ] ); ?>
									<span><?php echo esc_html( $item ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</article>
			<?php endfor; ?>
		</div>

	</div>
</section>

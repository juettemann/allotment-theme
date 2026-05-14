<?php
/**
 * Site footer (4-column dark band).
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

$tagline   = allotment_mod( 'footer_tagline', allotment_default( 'footer_tagline' ) );
$address   = allotment_mod( 'footer_address', allotment_default( 'footer_address' ) );
$email     = allotment_mod( 'footer_email', allotment_default( 'footer_email' ) );
$facebook  = allotment_mod( 'footer_facebook', allotment_default( 'footer_facebook' ) );
$instagram = allotment_mod( 'footer_instagram', allotment_default( 'footer_instagram' ) );
$year      = allotment_mod( 'footer_year', allotment_default( 'footer_year' ) );
$site_name = get_bloginfo( 'name' );
?>
<footer class="at-footer" role="contentinfo">
	<div class="container">
		<div class="at-footer__top">

			<div>
				<div class="at-footer__brand">
					<span class="at-footer__brand-icon" aria-hidden="true"><?php allotment_icon( 'sprout' ); ?></span>
					<span><?php echo esc_html( $site_name ); ?></span>
				</div>
				<p class="at-footer__tagline"><?php echo esc_html( $tagline ); ?></p>
			</div>

			<div>
				<h4 class="at-footer__col-title"><?php esc_html_e( 'Quick Links', 'allotment-theme' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-quick-links' ) ) {
					wp_nav_menu( [
						'theme_location' => 'footer-quick-links',
						'container'      => false,
						'menu_class'     => 'at-footer__list',
						'depth'          => 1,
						'fallback_cb'    => false,
					] );
				} else {
					?>
					<ul class="at-footer__list">
						<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'allotment-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/allotment-application/' ) ); ?>"><?php esc_html_e( 'Plot Availability', 'allotment-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/member-portal/' ) ); ?>"><?php esc_html_e( 'Membership', 'allotment-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/events/' ) ); ?>"><?php esc_html_e( 'Events', 'allotment-theme' ); ?></a></li>
					</ul>
					<?php
				}
				?>
			</div>

			<div>
				<h4 class="at-footer__col-title"><?php esc_html_e( 'Resources', 'allotment-theme' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-resources' ) ) {
					wp_nav_menu( [
						'theme_location' => 'footer-resources',
						'container'      => false,
						'menu_class'     => 'at-footer__list',
						'depth'          => 1,
						'fallback_cb'    => false,
					] );
				} else {
					?>
					<ul class="at-footer__list">
						<li><a href="<?php echo esc_url( home_url( '/growing-guides/' ) ); ?>"><?php esc_html_e( 'Growing Guides', 'allotment-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/community-rules/' ) ); ?>"><?php esc_html_e( 'Community Rules', 'allotment-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQ', 'allotment-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'allotment-theme' ); ?></a></li>
					</ul>
					<?php
				}
				?>
			</div>

			<div>
				<h4 class="at-footer__col-title"><?php esc_html_e( 'Get in Touch', 'allotment-theme' ); ?></h4>
				<ul class="at-footer__contact">
					<?php if ( $address ) : ?>
						<li>
							<?php allotment_icon( 'map-pin', [ 'size' => 'sm' ] ); ?>
							<span><?php echo nl2br( esc_html( $address ) ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<li>
							<?php allotment_icon( 'mail', [ 'size' => 'sm' ] ); ?>
							<a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
						</li>
					<?php endif; ?>
				</ul>
			</div>

		</div>

		<hr class="at-footer__divider">

		<div class="at-footer__bottom">
			<p class="at-footer__copy">
				<?php
				printf(
					/* translators: 1: year, 2: site name */
					esc_html__( '© %1$s %2$s. All rights reserved.', 'allotment-theme' ),
					esc_html( $year ),
					esc_html( $site_name )
				);
				?>
			</p>
			<div class="at-footer__social">
				<?php if ( $facebook ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" aria-label="<?php esc_attr_e( 'Facebook', 'allotment-theme' ); ?>" rel="noopener">
						<?php allotment_icon( 'facebook' ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $instagram ) : ?>
					<a href="<?php echo esc_url( $instagram ); ?>" aria-label="<?php esc_attr_e( 'Instagram', 'allotment-theme' ); ?>" rel="noopener">
						<?php allotment_icon( 'instagram' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>

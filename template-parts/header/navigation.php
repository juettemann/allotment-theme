<?php
/**
 * Sticky navigation bar.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

$login_url = wp_login_url( home_url( '/' ) );
$portal    = get_page_by_path( 'member-portal' );
if ( $portal && is_user_logged_in() ) {
	$login_url = get_permalink( $portal );
}
$is_logged_in = is_user_logged_in();
$account_label = $is_logged_in
	? __( 'Member Portal', 'allotment-theme' )
	: __( 'Login', 'allotment-theme' );
?>
<nav class="at-nav" aria-label="<?php esc_attr_e( 'Primary', 'allotment-theme' ); ?>">
	<div class="container">
		<div class="at-nav__inner">
			<?php allotment_site_brand(); ?>

			<ul class="at-nav__menu">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( [
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'depth'          => 1,
						'fallback_cb'    => false,
					] );
				} else {
					?>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'allotment-theme' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'allotment-theme' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/allotment-application/' ) ); ?>"><?php esc_html_e( 'Available Plots', 'allotment-theme' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'allotment-theme' ); ?></a></li>
					<?php
				}
				?>
				<li>
					<a class="at-btn at-btn--primary at-btn--sm" href="<?php echo esc_url( $login_url ); ?>">
						<?php allotment_icon( 'user', [ 'size' => 'sm' ] ); ?>
						<?php echo esc_html( $account_label ); ?>
					</a>
				</li>
			</ul>

			<button
				type="button"
				class="at-nav__toggle"
				data-at-nav-toggle
				aria-expanded="false"
				aria-controls="at-nav-mobile"
				aria-label="<?php esc_attr_e( 'Toggle menu', 'allotment-theme' ); ?>">
				<?php allotment_icon( 'menu', [ 'size' => 'lg' ] ); ?>
			</button>
		</div>

		<div class="at-nav__mobile" id="at-nav-mobile" data-at-nav-mobile>
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '<ul>%3$s</ul>',
					'depth'          => 1,
					'fallback_cb'    => false,
				] );
			} else {
				?>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'allotment-theme' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'allotment-theme' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/allotment-application/' ) ); ?>"><?php esc_html_e( 'Available Plots', 'allotment-theme' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'allotment-theme' ); ?></a></li>
				</ul>
				<?php
			}
			?>
			<a class="at-btn at-btn--primary" href="<?php echo esc_url( $login_url ); ?>">
				<?php allotment_icon( 'user', [ 'size' => 'sm' ] ); ?>
				<?php echo esc_html( $account_label ); ?>
			</a>
		</div>
	</div>
</nav>

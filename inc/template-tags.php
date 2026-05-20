<?php
/**
 * Template helpers used across header, footer, and section partials.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Read a customiser theme_mod with a default.
 */
function allotment_mod( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

/**
 * Echo a theme_mod, escaped for HTML attribute context.
 */
function allotment_mod_attr( $key, $default = '' ) {
	echo esc_attr( get_theme_mod( $key, $default ) );
}

/**
 * Echo a theme_mod, escaped for text/HTML context.
 */
function allotment_mod_html( $key, $default = '' ) {
	echo esc_html( get_theme_mod( $key, $default ) );
}

/**
 * Site brand mark — links to home.
 *
 * Two render paths:
 * - When a custom logo is set in the Customiser, defer to the_custom_logo()
 *   which provides its own anchor. The sprout circle is hidden so we don't
 *   double-mark the brand.
 * - Otherwise, render the sprout circle + site name wrapped in our own
 *   anchor.
 */
function allotment_site_brand() {
	if ( has_custom_logo() ) {
		echo '<div class="at-nav__brand at-nav__brand--custom-logo">';
		the_custom_logo();
		echo '</div>';
		return;
	}

	$home = esc_url( home_url( '/' ) );
	$name = get_bloginfo( 'name' );
	?>
	<a class="at-nav__brand" href="<?php echo $home; ?>" rel="home">
		<span class="at-nav__logo" aria-hidden="true">
			<?php allotment_icon( 'sprout' ); ?>
		</span>
		<span class="at-nav__brand-name"><?php echo esc_html( $name ); ?></span>
	</a>
	<?php
}

/**
 * Resolve the hero image URL. Order:
 * 1. Customiser custom-header (admin chosen)
 * 2. Bundled default
 */
function allotment_hero_image_url() {
	$header = get_header_image();
	if ( $header ) {
		return $header;
	}
	return get_template_directory_uri() . '/assets/images/hero-default.svg';
}

/**
 * Default feature card content matching the Figma reference.
 */
function allotment_default_features() {
	return [
		1 => [
			'icon'    => 'sprout',
			'variant' => 'primary',
			'title'   => __( 'Quality Plots', 'allotment-theme' ),
			'body'    => __( 'Well-maintained plots ranging from 50 to 250 square meters, with water access and secure fencing.', 'allotment-theme' ),
			'item_1'  => __( 'Water supply on site', 'allotment-theme' ),
			'item_2'  => __( 'Tool storage available', 'allotment-theme' ),
			'item_3'  => __( 'Secure 24/7 access', 'allotment-theme' ),
		],
		2 => [
			'icon'    => 'users',
			'variant' => 'secondary',
			'title'   => __( 'Friendly Community', 'allotment-theme' ),
			'body'    => __( 'Connect with fellow gardeners, share tips, seeds, and harvests in our welcoming community.', 'allotment-theme' ),
			'item_1'  => __( 'Monthly social events', 'allotment-theme' ),
			'item_2'  => __( 'WhatsApp support group', 'allotment-theme' ),
			'item_3'  => __( 'Seed swap library', 'allotment-theme' ),
		],
		3 => [
			'icon'    => 'calendar',
			'variant' => 'accent',
			'title'   => __( 'Expert Workshops', 'allotment-theme' ),
			'body'    => __( 'Learn from experienced gardeners through regular workshops and hands-on training sessions.', 'allotment-theme' ),
			'item_1'  => __( "Beginner's guide course", 'allotment-theme' ),
			'item_2'  => __( 'Seasonal workshops', 'allotment-theme' ),
			'item_3'  => __( 'Composting guidance', 'allotment-theme' ),
		],
	];
}

/**
 * Resolve a single feature card slot, falling back to defaults per field.
 */
function allotment_feature_card( $index ) {
	$defaults = allotment_default_features();
	if ( ! isset( $defaults[ $index ] ) ) {
		return null;
	}
	$d   = $defaults[ $index ];
	$mod = 'feature_' . $index . '_';

	return [
		'icon'    => sanitize_key( get_theme_mod( $mod . 'icon', $d['icon'] ) ),
		'variant' => sanitize_key( get_theme_mod( $mod . 'variant', $d['variant'] ) ),
		'title'   => get_theme_mod( $mod . 'title', $d['title'] ),
		'body'    => get_theme_mod( $mod . 'body', $d['body'] ),
		'items'   => array_filter( [
			get_theme_mod( $mod . 'item_1', $d['item_1'] ),
			get_theme_mod( $mod . 'item_2', $d['item_2'] ),
			get_theme_mod( $mod . 'item_3', $d['item_3'] ),
		] ),
	];
}

/**
 * Default copy for hero / stat / cta / contact — keeps the front page
 * Figma-perfect on a fresh activation without configuring the customiser.
 */
function allotment_text_defaults() {
	return [
		'hero_badge'       => __( 'Growing Community Since 1975', 'allotment-theme' ),
		'hero_title_line1' => __( 'Grow Your Own', 'allotment-theme' ),
		'hero_title_line2' => __( 'in the Heart of Bristol', 'allotment-theme' ),
		'hero_body'        => __( "Join our vibrant community of gardeners. Whether you're a seasoned grower or just starting out, our allotments offer the perfect space to cultivate fresh vegetables, flowers, and friendships.", 'allotment-theme' ),
		'hero_primary_text'   => __( 'Apply for a Plot', 'allotment-theme' ),
		'hero_primary_url'    => '/allotment-application/',
		'hero_secondary_text' => __( 'Get in Touch', 'allotment-theme' ),
		// Default points at the auto-created /contact page (made by
		// Page_Creator::create_default_pages() on first activation). An
		// admin who wants the button to scroll to a section, open mailto:,
		// or jump elsewhere can override via Appearance → Customize.
		'hero_secondary_url'  => '/contact/',
		'stat_number'      => '250+',
		'stat_label'       => __( 'Active Members', 'allotment-theme' ),
		'features_title'   => __( 'Why Join Us?', 'allotment-theme' ),
		'features_intro'   => __( "More than just a plot of land – it's a supportive community, resources, and expertise to help you grow.", 'allotment-theme' ),
		'cta_title'        => __( 'Ready to Start Growing?', 'allotment-theme' ),
		'cta_body'         => __( 'Join the waiting list today. We have plots becoming available throughout the year and prioritise local residents.', 'allotment-theme' ),
		'cta_primary_text'   => __( 'Join Waiting List', 'allotment-theme' ),
		'cta_primary_url'    => '/allotment-application/',
		'cta_secondary_text' => __( 'Visit Us', 'allotment-theme' ),
		'cta_secondary_url'  => '/contact/',
		'footer_tagline'   => __( 'Growing together in our community', 'allotment-theme' ),
		'footer_address'   => "Meadowview Lane\nBristol BS5 8TH",
		'footer_email'     => 'hello@example.org.uk',
		'footer_facebook'  => '',
		'footer_instagram' => '',
		'footer_year'      => date_i18n( 'Y' ),
	];
}

/**
 * Lookup helper for default text values.
 */
function allotment_default( $key ) {
	$defaults = allotment_text_defaults();
	return $defaults[ $key ] ?? '';
}

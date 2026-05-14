<?php
/**
 * Customiser registration — all editable content on the front page lives here.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register customiser panels, sections, settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize
 */
function allotment_theme_customize_register( $wp_customize ) {
	$d = allotment_text_defaults();

	$wp_customize->add_panel( 'allotment_theme_panel', [
		'title'    => __( 'Allotment Theme', 'allotment-theme' ),
		'priority' => 130,
	] );

	/* ============ Hero ============ */
	$wp_customize->add_section( 'allotment_hero', [
		'title' => __( 'Hero', 'allotment-theme' ),
		'panel' => 'allotment_theme_panel',
	] );

	allotment_customize_text(
		$wp_customize, 'hero_badge', __( 'Badge', 'allotment-theme' ),
		'allotment_hero', $d['hero_badge']
	);
	allotment_customize_text(
		$wp_customize, 'hero_title_line1', __( 'Title — line 1', 'allotment-theme' ),
		'allotment_hero', $d['hero_title_line1']
	);
	allotment_customize_text(
		$wp_customize, 'hero_title_line2', __( 'Title — line 2 (sage accent)', 'allotment-theme' ),
		'allotment_hero', $d['hero_title_line2']
	);
	allotment_customize_textarea(
		$wp_customize, 'hero_body', __( 'Body copy', 'allotment-theme' ),
		'allotment_hero', $d['hero_body']
	);
	allotment_customize_text(
		$wp_customize, 'hero_primary_text', __( 'Primary button label', 'allotment-theme' ),
		'allotment_hero', $d['hero_primary_text']
	);
	allotment_customize_url(
		$wp_customize, 'hero_primary_url', __( 'Primary button URL', 'allotment-theme' ),
		'allotment_hero', $d['hero_primary_url']
	);
	allotment_customize_text(
		$wp_customize, 'hero_secondary_text', __( 'Secondary button label', 'allotment-theme' ),
		'allotment_hero', $d['hero_secondary_text']
	);
	allotment_customize_url(
		$wp_customize, 'hero_secondary_url', __( 'Secondary button URL', 'allotment-theme' ),
		'allotment_hero', $d['hero_secondary_url']
	);

	/* ============ Stat card ============ */
	$wp_customize->add_section( 'allotment_stat', [
		'title' => __( 'Hero — Stat Card', 'allotment-theme' ),
		'panel' => 'allotment_theme_panel',
	] );
	allotment_customize_text(
		$wp_customize, 'stat_number', __( 'Number', 'allotment-theme' ),
		'allotment_stat', $d['stat_number']
	);
	allotment_customize_text(
		$wp_customize, 'stat_label', __( 'Label', 'allotment-theme' ),
		'allotment_stat', $d['stat_label']
	);

	/* ============ Features ============ */
	$wp_customize->add_section( 'allotment_features_head', [
		'title' => __( 'Features — Heading', 'allotment-theme' ),
		'panel' => 'allotment_theme_panel',
	] );
	allotment_customize_text(
		$wp_customize, 'features_title', __( 'Title', 'allotment-theme' ),
		'allotment_features_head', $d['features_title']
	);
	allotment_customize_textarea(
		$wp_customize, 'features_intro', __( 'Intro', 'allotment-theme' ),
		'allotment_features_head', $d['features_intro']
	);

	$defaults_per_card = allotment_default_features();
	$icon_choices      = array_combine( allotment_icon_set(), allotment_icon_set() );
	$variant_choices   = [
		'primary'   => __( 'Sage (primary)', 'allotment-theme' ),
		'secondary' => __( 'Terracotta (secondary)', 'allotment-theme' ),
		'accent'    => __( 'Yellow (accent)', 'allotment-theme' ),
	];

	for ( $i = 1; $i <= 3; $i++ ) {
		$section_id = 'allotment_feature_' . $i;
		$prefix     = 'feature_' . $i . '_';
		$def        = $defaults_per_card[ $i ];

		$wp_customize->add_section( $section_id, [
			/* translators: %d is the card index. */
			'title' => sprintf( __( 'Feature Card %d', 'allotment-theme' ), $i ),
			'panel' => 'allotment_theme_panel',
		] );

		allotment_customize_select(
			$wp_customize, $prefix . 'icon', __( 'Icon', 'allotment-theme' ),
			$section_id, $def['icon'], $icon_choices
		);
		allotment_customize_select(
			$wp_customize, $prefix . 'variant', __( 'Colour variant', 'allotment-theme' ),
			$section_id, $def['variant'], $variant_choices
		);
		allotment_customize_text(
			$wp_customize, $prefix . 'title', __( 'Title', 'allotment-theme' ),
			$section_id, $def['title']
		);
		allotment_customize_textarea(
			$wp_customize, $prefix . 'body', __( 'Body', 'allotment-theme' ),
			$section_id, $def['body']
		);
		allotment_customize_text(
			$wp_customize, $prefix . 'item_1', __( 'Bullet 1', 'allotment-theme' ),
			$section_id, $def['item_1']
		);
		allotment_customize_text(
			$wp_customize, $prefix . 'item_2', __( 'Bullet 2', 'allotment-theme' ),
			$section_id, $def['item_2']
		);
		allotment_customize_text(
			$wp_customize, $prefix . 'item_3', __( 'Bullet 3', 'allotment-theme' ),
			$section_id, $def['item_3']
		);
	}

	/* ============ CTA ============ */
	$wp_customize->add_section( 'allotment_cta', [
		'title' => __( 'Call to Action', 'allotment-theme' ),
		'panel' => 'allotment_theme_panel',
	] );
	allotment_customize_text(
		$wp_customize, 'cta_title', __( 'Title', 'allotment-theme' ),
		'allotment_cta', $d['cta_title']
	);
	allotment_customize_textarea(
		$wp_customize, 'cta_body', __( 'Body', 'allotment-theme' ),
		'allotment_cta', $d['cta_body']
	);
	allotment_customize_text(
		$wp_customize, 'cta_primary_text', __( 'Primary button label', 'allotment-theme' ),
		'allotment_cta', $d['cta_primary_text']
	);
	allotment_customize_url(
		$wp_customize, 'cta_primary_url', __( 'Primary button URL', 'allotment-theme' ),
		'allotment_cta', $d['cta_primary_url']
	);
	allotment_customize_text(
		$wp_customize, 'cta_secondary_text', __( 'Secondary button label', 'allotment-theme' ),
		'allotment_cta', $d['cta_secondary_text']
	);
	allotment_customize_url(
		$wp_customize, 'cta_secondary_url', __( 'Secondary button URL', 'allotment-theme' ),
		'allotment_cta', $d['cta_secondary_url']
	);

	/* ============ Footer ============ */
	$wp_customize->add_section( 'allotment_footer', [
		'title' => __( 'Footer', 'allotment-theme' ),
		'panel' => 'allotment_theme_panel',
	] );
	allotment_customize_text(
		$wp_customize, 'footer_tagline', __( 'Tagline', 'allotment-theme' ),
		'allotment_footer', $d['footer_tagline']
	);
	allotment_customize_textarea(
		$wp_customize, 'footer_address', __( 'Address (multi-line)', 'allotment-theme' ),
		'allotment_footer', $d['footer_address']
	);
	allotment_customize_text(
		$wp_customize, 'footer_email', __( 'Contact email', 'allotment-theme' ),
		'allotment_footer', $d['footer_email']
	);
	allotment_customize_url(
		$wp_customize, 'footer_facebook', __( 'Facebook URL', 'allotment-theme' ),
		'allotment_footer', $d['footer_facebook']
	);
	allotment_customize_url(
		$wp_customize, 'footer_instagram', __( 'Instagram URL', 'allotment-theme' ),
		'allotment_footer', $d['footer_instagram']
	);
	allotment_customize_text(
		$wp_customize, 'footer_year', __( 'Copyright year', 'allotment-theme' ),
		'allotment_footer', $d['footer_year']
	);
}
add_action( 'customize_register', 'allotment_theme_customize_register' );

/* ============ Customiser helpers ============ */

function allotment_customize_text( $wp_customize, $id, $label, $section, $default ) {
	$wp_customize->add_setting( $id, [
		'default'           => $default,
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control( $id, [
		'label'   => $label,
		'section' => $section,
		'type'    => 'text',
	] );
}

function allotment_customize_textarea( $wp_customize, $id, $label, $section, $default ) {
	$wp_customize->add_setting( $id, [
		'default'           => $default,
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control( $id, [
		'label'   => $label,
		'section' => $section,
		'type'    => 'textarea',
	] );
}

function allotment_customize_url( $wp_customize, $id, $label, $section, $default ) {
	$wp_customize->add_setting( $id, [
		'default'           => $default,
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control( $id, [
		'label'   => $label,
		'section' => $section,
		'type'    => 'url',
	] );
}

function allotment_customize_select( $wp_customize, $id, $label, $section, $default, $choices ) {
	$wp_customize->add_setting( $id, [
		'default'           => $default,
		'sanitize_callback' => 'sanitize_key',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control( $id, [
		'label'   => $label,
		'section' => $section,
		'type'    => 'select',
		'choices' => $choices,
	] );
}

<?php
/**
 * Icon helpers — render references to the SVG sprite.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Icons known to the sprite. Anything not in this list is rejected as a guard
 * against silent broken references.
 */
function allotment_icon_set() {
	return [
		'sprout',
		'menu',
		'user',
		'check',
		'message-circle',
		'map-pin',
		'mail',
		'facebook',
		'instagram',
		'leaf',
		'users',
		'calendar',
	];
}

/**
 * Render an icon from the inline SVG sprite.
 *
 * @param string $name Icon name (must exist in the sprite).
 * @param array  $args {
 *     @type string $size  Size token: sm | md | lg | xl. Default 'md'.
 *     @type string $class Extra classes.
 *     @type string $title Accessible title; if set, role=img is applied.
 * }
 */
function allotment_icon( $name, $args = [] ) {
	echo allotment_get_icon( $name, $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Return the SVG markup for an icon.
 */
function allotment_get_icon( $name, $args = [] ) {
	$name = sanitize_key( $name );
	if ( ! in_array( $name, allotment_icon_set(), true ) ) {
		return '';
	}

	$args = wp_parse_args( $args, [
		'size'  => 'md',
		'class' => '',
		'title' => '',
	] );

	$classes = [ 'at-icon' ];
	$size    = in_array( $args['size'], [ 'sm', 'md', 'lg', 'xl' ], true ) ? $args['size'] : 'md';
	$classes[] = 'at-icon--' . $size;
	if ( ! empty( $args['class'] ) ) {
		$classes[] = $args['class'];
	}

	$attrs = sprintf(
		'class="%s"',
		esc_attr( implode( ' ', $classes ) )
	);

	if ( ! empty( $args['title'] ) ) {
		$attrs .= sprintf(
			' role="img" aria-label="%s"',
			esc_attr( $args['title'] )
		);
	} else {
		$attrs .= ' aria-hidden="true" focusable="false"';
	}

	return sprintf(
		'<svg %1$s><use href="#%2$s"></use></svg>',
		$attrs,
		esc_attr( $name )
	);
}

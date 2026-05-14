<?php
/**
 * Allotment Theme functions.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

define( 'ALLOTMENT_THEME_VERSION', '1.0.0' );

require get_template_directory() . '/inc/icons.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/customizer.php';

/**
 * Theme setup.
 */
function allotment_theme_setup() {
	load_theme_textdomain( 'allotment-theme', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', [
		'height'      => 80,
		'width'       => 80,
		'flex-height' => true,
		'flex-width'  => true,
	] );
	add_theme_support( 'custom-header', [
		'default-image' => get_template_directory_uri() . '/assets/images/hero-default.svg',
		'width'         => 1600,
		'height'        => 1200,
		'flex-width'    => true,
		'flex-height'   => true,
		'header-text'   => false,
	] );
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	] );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );

	register_nav_menus( [
		'primary'              => __( 'Primary Menu', 'allotment-theme' ),
		'footer-quick-links'   => __( 'Footer: Quick Links', 'allotment-theme' ),
		'footer-resources'     => __( 'Footer: Resources', 'allotment-theme' ),
	] );
}
add_action( 'after_setup_theme', 'allotment_theme_setup' );

/**
 * Enqueue front-end styles and scripts.
 */
function allotment_theme_enqueue_assets() {
	wp_enqueue_style(
		'allotment-theme',
		get_stylesheet_uri(),
		[],
		ALLOTMENT_THEME_VERSION
	);

	wp_enqueue_script(
		'allotment-theme',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		ALLOTMENT_THEME_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'allotment_theme_enqueue_assets' );

/**
 * Inject the SVG icon sprite once per request, immediately after <body>.
 *
 * Using wp_body_open keeps the sprite available before the first <use> reference
 * without an extra HTTP round-trip.
 */
function allotment_theme_inject_icon_sprite() {
	$sprite = get_template_directory() . '/assets/icons/sprite.svg';
	if ( file_exists( $sprite ) ) {
		include $sprite;
	}
}
add_action( 'wp_body_open', 'allotment_theme_inject_icon_sprite' );

/**
 * Add a body class flag when the page renders the allotment-manager
 * member portal shortcode, so the page container can widen for the table.
 */
function allotment_theme_body_class( $classes ) {
	if ( is_singular() ) {
		$post = get_post();
		if ( $post && has_shortcode( $post->post_content, 'am_member_portal' ) ) {
			$classes[] = 'has-am-member-portal';
		}
	}
	return $classes;
}
add_filter( 'body_class', 'allotment_theme_body_class' );

/**
 * Pagination renderer used by index.php / archive views.
 */
function allotment_theme_pagination() {
	$args = [
		'mid_size'  => 1,
		'prev_text' => __( '&laquo; Previous', 'allotment-theme' ),
		'next_text' => __( 'Next &raquo;', 'allotment-theme' ),
	];
	$links = paginate_links( array_merge( $args, [ 'type' => 'array' ] ) );
	if ( empty( $links ) ) {
		return;
	}
	echo '<nav class="at-pagination" aria-label="' . esc_attr__( 'Pagination', 'allotment-theme' ) . '">';
	foreach ( $links as $link ) {
		echo wp_kses_post( $link );
	}
	echo '</nav>';
}

/**
 * Provide an accessible default for the comments template.
 */
function allotment_theme_comment_form_defaults( $defaults ) {
	$defaults['title_reply_before'] = '<h3 id="reply-title" class="comment-reply-title">';
	$defaults['title_reply_after']  = '</h3>';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'allotment_theme_comment_form_defaults' );

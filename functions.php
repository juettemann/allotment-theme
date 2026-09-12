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
 * Version an asset by its modification time, so a changed file gets a new URL.
 *
 * ALLOTMENT_THEME_VERSION has been 1.0.0 since the first release and is not
 * bumped per change, so a URL versioned with it never changes and a browser
 * that has the file cached keeps the old bytes. A deploy `git pull`s the theme,
 * which sets the mtime of every file it changes.
 *
 * @param string $relative_path Path inside the theme directory.
 * @return string
 */
function allotment_theme_asset_version( $relative_path ) {
	$path = get_template_directory() . '/' . $relative_path;
	return file_exists( $path ) ? (string) filemtime( $path ) : ALLOTMENT_THEME_VERSION;
}

/**
 * Enqueue front-end styles and scripts.
 *
 * The stylesheets are enqueued one by one rather than @imported from style.css:
 * an @import URL carries no version, so no change to them could reach a
 * returning visitor until the browser's cache happened to expire.
 */
function allotment_theme_enqueue_assets() {
	$deps = [];
	foreach ( [ 'variables', 'base', 'layout', 'components' ] as $name ) {
		$handle = 'allotment-theme-' . $name;
		wp_enqueue_style(
			$handle,
			get_template_directory_uri() . '/assets/css/' . $name . '.css',
			$deps,
			allotment_theme_asset_version( 'assets/css/' . $name . '.css' )
		);
		$deps = [ $handle ];
	}

	// Last, so a rule added to style.css still overrides the files above.
	wp_enqueue_style(
		'allotment-theme',
		get_stylesheet_uri(),
		$deps,
		allotment_theme_asset_version( 'style.css' )
	);

	wp_enqueue_script(
		'allotment-theme',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		allotment_theme_asset_version( 'assets/js/main.js' ),
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
 * Emit the --at-logo-height CSS custom property based on the customiser
 * setting. Clamped to a safe range so users can't break the nav layout.
 */
function allotment_theme_logo_height_style() {
	$height = (int) get_theme_mod( 'nav_logo_height', 64 );
	$height = max( 32, min( 160, $height ) );
	printf(
		'<style id="allotment-theme-logo-height">:root{--at-logo-height:%dpx}</style>',
		$height
	);
}
add_action( 'wp_head', 'allotment_theme_logo_height_style' );

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

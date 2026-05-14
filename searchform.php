<?php
/**
 * Search form.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

$unique_id = wp_unique_id( 'search-form-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $unique_id ); ?>">
		<?php esc_html_e( 'Search for:', 'allotment-theme' ); ?>
	</label>
	<input
		type="search"
		id="<?php echo esc_attr( $unique_id ); ?>"
		class="search-field"
		placeholder="<?php esc_attr_e( 'Search…', 'allotment-theme' ); ?>"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		name="s">
	<button type="submit" class="at-btn at-btn--primary">
		<?php esc_html_e( 'Search', 'allotment-theme' ); ?>
	</button>
</form>

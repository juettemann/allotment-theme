<?php
/**
 * Front page — assembles hero, features, and CTA sections.
 *
 * Takes over the home slug regardless of any content the plugin's
 * Page_Creator may have written there.
 *
 * @package Allotment_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php get_template_part( 'template-parts/sections/hero' ); ?>

<?php get_template_part( 'template-parts/sections/features' ); ?>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php
get_footer();

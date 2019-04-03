<?php
/**
 * Gut Check functions and definitions
 *
 * @package Gut_Check
 */

namespace GutCheck;

/**
 * Setup the plugin.
 */
function setup() {
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\gut_check_debug_front_styles' );
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\gut_check_debug_edit_styles' );
	add_action( 'customize_register', __NAMESPACE__ . '\\gut_check_debug_customize_register' );
	add_action('customize_controls_print_styles', __NAMESPACE__ . '\\customizer_control_styles');
	add_action( 'customize_preview_init', __NAMESPACE__ . '\\gut_check_customize_preview_js' );
	add_action( 'wp_head', __NAMESPACE__ . '\\gut_check_debug_vars' );
}

/**
 * return a formatted hex color.
 *
 * @return string
 */
function sanitize_hex_color_add_hash( $color ) {
	if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
		return '#' . $unhashed;
	}

	return sanitize_hex_color( $color );
}

/**
 * Converts a hex color to RGB.  Returns the RGB values as an array.
 *
 * @param string    hex
 * @return array    rgb value
 */
function hex_to_rgb( $hex ) {

	$color = trim( $hex, '#' );

	if ( strlen( $color ) == 3 ) {

		$r = hexdec( $color[0] . $color[0] );
		$g = hexdec( $color[1] . $color[1] );
		$b = hexdec( $color[2] . $color[2] );

	} elseif ( strlen( $color ) == 6 ) {

		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );

	} elseif ( strlen( $color ) == 8 ) {

		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );
		$a = hexdec( $color[6] . $color[7] );

		return [ $r, $g, $b, $a ];

	} else {

		return [];

	}

	return [ $r, $g, $b ];
}

function customizer_control_styles() {
	$style = '
	<style>
	#sub-accordion-section-style_debug .customize-control-checkbox label {
		font-size: 14px;
		line-height: 24px;
		font-weight: 600;
		margin-bottom: 4px;
		display: inline-block;
	}
	</style>
	';

	/* Output custom style. */
	echo $style;
}

/**
 * CSS Custom Properties inlined.
 */
function gut_check_debug_vars() {
	echo get_gut_check_debug_vars();
}

/**
 * Return customized styles.
 *
 * @return string
 */
function get_gut_check_debug_vars() {
	$outline_width = get_theme_mod( 'gc_outline_width', '0' );
	$shadow_depth  = get_theme_mod( 'gc_shadow_depth', '0' );
	$shadow_hex    = get_theme_mod( 'gc_shadow_color', '000' );
	$shadow_rgb    = implode( ', ', hex_to_rgb( $shadow_hex ) );
	$shadow_color  = $shadow_rgb;

	$style_var  = '';
	$style_var .= "--gc-outline-width:{$outline_width}px;";
	$style_var .= "--gc-shadow-depth:{$shadow_depth}rem;";
	$style_var .= "--gc-shadow-color:rgba({$shadow_color}, 0.6);";

	/* Put the final style output together. */
	$style = "
	<style data-style='gc-customized'>
		:root:root{ {$style_var} }
	</style>
	";

	/* Output custom style. */
	return $style;
}

<?php
/**
 * Gut Check functions and definitions
 *
 * @package Gut_Check
 */

namespace GutCheck;

add_action( 'init', __NAMESPACE__ . '\\setup' );
use WP_Customize_Color_Control;

/**
 * Setup the plugin.
 */
function setup() {
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\gut_check_debug_front_styles' );
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\gut_check_debug_edit_styles' );
	add_action( 'customize_register', __NAMESPACE__ . '\\gut_check_debug_customize_register' );
	add_action( 'customize_preview_init', __NAMESPACE__ . '\\gut_check_customize_preview_js' );
	add_action( 'wp_head', __NAMESPACE__ . '\\gut_check_debug_vars' );
}

/**
 * Enqueue debugging scripts and styles.
 */
function gut_check_debug_front_styles() {

	if ( get_theme_mod( 'front_pesticide' ) ) {

		wp_enqueue_style( 'pesticide', GC_ASSETS . 'pesticide.css' );
	}

}

/**
 * Enqueue editor debugging scripts and styles.
 */
function gut_check_debug_edit_styles() {

	if ( get_theme_mod( 'editor_pesticide' ) ) {

		wp_enqueue_style( 'pesticide-edit', GC_ASSETS . 'e-pesticide.css' );
		wp_add_inline_style( 'pesticide-editor-customizer-styles', gut_check_debug_vars() );
	}

	if ( get_theme_mod( 'editor_ui_pesticide' ) ) {

		wp_enqueue_style( 'pesticide-ui-edit', GC_ASSETS . 'pesticide.css' );
	}

}

/**
 * CSS Custom Properties inlined.
 */
function gut_check_debug_vars() {
	echo get_gut_check_debug_vars();
}

function get_gut_check_debug_vars() {
	$outline_width = get_theme_mod( 'gc_outline_width', '0' );
	$shadow_depth  = get_theme_mod( 'gc_shadow_depth', '0' );
	$shadow_hex    = get_theme_mod( 'gc_shadow_color', '000' );
	$shadow_rgb    = implode( ', ', hex_to_rgb( $shadow_hex ) );
	$shadow_color  = $shadow_rgb;

	$style_var  = '';
	$style_var .= "--gc-outline-width:{$outline_width}px;";
	$style_var .= "--gc-shadow-depth:{$shadow_depth}rem;";
	$style_var .= "--gc-shadow-color:rgba({$shadow_color}, 0.5);";

	/* Put the final style output together. */
	$style = "
	<style data-style='gc-customized'>
		:root:root{ {$style_var} }
	</style>
	";

	/* Output custom style. */
	return $style;
}


/**
 * Add debug settings to the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gut_check_debug_customize_register( $wp_customize ) {

	require_once __DIR__ . '/RangeControl.php';

	/* Add the debug section. */
	$wp_customize->add_section(
		'style_debug',
		array(
			'title' => esc_html__( 'CSS debug settings', 'gut-check' ),
		)
	);

	/* Add the pesticide setting. */
	$wp_customize->add_setting(
		'front_pesticide',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
		)
	);

	/* Add the pesticide control. */
	$wp_customize->add_control(
		'front_pesticide',
		array(
			'label'   => esc_html__( 'Debug Front-End CSS', 'gut-check' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		)
	);

	/* Add the pesticide setting. */
	$wp_customize->add_setting(
		'editor_pesticide',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	/* Add the pesticide control. */
	$wp_customize->add_control(
		'editor_pesticide',
		array(
			'label'   => esc_html__( 'Debug Editor Theme CSS', 'gut-check' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		)
	);

	/* Add the pesticide setting. */
	$wp_customize->add_setting(
		'editor_ui_pesticide',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	/* Add the pesticide control. */
	$wp_customize->add_control(
		'editor_ui_pesticide',
		array(
			'label'   => esc_html__( 'Debug Editor UI CSS', 'gut-check' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		)
	);

	/* Add the pesticide setting. */
	$wp_customize->add_setting(
		'gc_outline_width',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	/* Add the pesticide control. */
	$wp_customize->add_control(
		new RangControl\GC_Customize_Range(
			$wp_customize,
			'gc_outline_width',
			array(
				'label'   => 'Outline Width',
				'min'     => 0,
				'max'     => 10,
				'step'    => 1,
				'section' => 'style_debug',
			)
		)
	);

	$wp_customize->add_setting(
		'gc_shadow_depth',
		array(
			'default'   => 0,
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new RangControl\GC_Customize_Range(
			$wp_customize,
			'gc_shadow_depth',
			array(
				'label'   => 'Shadow Depth',
				'min'     => 0,
				'max'     => 5,
				'step'    => 0.25,
				'section' => 'style_debug',
			)
		)
	);

	$wp_customize->add_setting(
		'gc_shadow_color',
		[
			'default'           => '#ffffff',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'gc_shadow_color',
			[
				'label'    => __( 'Shadow Color' ),
				'section'  => 'style_debug',
				'settings' => 'gc_shadow_color',
			]
		)
	);

}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gut_check_customize_preview_js() {
	wp_enqueue_script( 'gut-check-customizer', GC_ASSETS . 'customizer.js', array( 'customize-preview' ), false, true );
}

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

<?php
/**
 * Gut Check Customizer functions
 *
 * @package Gut_Check
 */

namespace GutCheck;

use WP_Customize_Color_Control;

/**
 * Add debug settings to the Theme Customizer.
 */
function gut_check_debug_customize_register( $wp_customize ) {

	/* Add the debug section. */
	$wp_customize->add_section(
		'style_debug',
		[
			'title' => __( 'CSS debug settings', 'gut-check' ),
		]
	);

	/* Add the gut_check setting. */
	$wp_customize->add_setting(
		'front_gut_check',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	/* Add the gut_check control. */
	$wp_customize->add_control(
		'front_gut_check',
		[
			'label'   => __( 'Debug Front-End CSS', 'gut-check' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Add the gut_check setting. */
	$wp_customize->add_setting(
		'editor_gut_check',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		]
	);

	/* Add the gut_check control. */
	$wp_customize->add_control(
		'editor_gut_check',
		[
			'label'   => __( 'Debug Editor Theme CSS', 'gut-check' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Add the gut_check setting. */
	$wp_customize->add_setting(
		'editor_ui_gut_check',
		[
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		]
	);

	/* Add the gut_check control. */
	$wp_customize->add_control(
		'editor_ui_gut_check',
		[
			'label'   => __( 'Debug Editor UI CSS', 'gut-check' ),
			'description' => __( 'Useful for block development.' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Add the gut_check setting. */
	$wp_customize->add_setting(
		'gc_outline_width',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'gc_outline_width',
		[
			'type'        => 'range',
			'section'     => 'style_debug',
			'label'       => __( 'Outline Width' ),
			'input_attrs' => [
				'min'  => 0,
				'max'  => 10,
				'step' => 1,
			],
		]
	);

	$wp_customize->add_setting(
		'gc_shadow_depth',
		[
			'default'   => 0.25,
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'gc_shadow_depth',
		[
			'type'        => 'range',
			'section'     => 'style_debug',
			'label'       => __( 'Shadow Depth' ),
			'input_attrs' => [
				'min'  => 0,
				'max'  => 5,
				'step' => 0.25,
			],
		]
	);

	$wp_customize->add_setting(
		'gc_shadow_color',
		[
			'default'           => '#002b36',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'gc_shadow_color',
			[
				'label'           => __( 'Shadow Color' ),
				'section'         => 'style_debug',
				'settings'        => 'gc_shadow_color',
				// 'active_callback' => function( $control ) {

				// 	if ( $control->manager->get_setting( 'gc_shadow_depth' )->value() == 0 ) {
				// 		return false;
				// 	} else {
				// 		return true;
				// 	}
				// }
			]
		)
	);

	/**
	 * Add HTML Element Specific Controls.
	 */
	/* Content sectioning. */
	$wp_customize->add_setting(
		'content_sectioning',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	$wp_customize->add_control(
		'content_sectioning',
		[
			'label'   => __( 'Content sectioning', 'gut-check' ),
			'description' => __( 'address, article, aside, footer, header, h1, h2, h3, h4, h5, h6, hgroup, main, nav, section' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Text content. */
	$wp_customize->add_setting(
		'text_content',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	$wp_customize->add_control(
		'text_content',
		[
			'label'   => __( 'Text content', 'gut-check' ),
			'description' => __( 'blockquote, dd, dir, div, dl, dt, figcaption, figure, hr, li, main, ol, p, pre, ul' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Inline text semantics. */
	$wp_customize->add_setting(
		'inline_text',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	$wp_customize->add_control(
		'inline_text',
		[
			'label'   => __( 'Inline text semantics', 'gut-check' ),
			'description' => __( 'a, abbr, b, bdi, bdo, br, cite, code, data, del, dfn, em, i, ins, kbd, mark, q, rb, rp, rt, rtc, ruby, s, samp, small, span, strong, sub, sup, time, tt, u, var, wbr' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Image and multimedia. */
	$wp_customize->add_setting(
		'media_embedded',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	$wp_customize->add_control(
		'media_embedded',
		[
			'label'   => __( 'Media & embedded content', 'gut-check' ),
			'description' => __( 'area, audio, img, video, embed, iframe, object, picture, map, track' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Table content. */
	$wp_customize->add_setting(
		'table_content',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	$wp_customize->add_control(
		'table_content',
		[
			'label'   => __( 'Table content', 'gut-check' ),
			'description' => __( 'caption, col, colgroup, table, tbody, td, tfoot, th, thead, tr' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Forms. */
	$wp_customize->add_setting(
		'form_elements',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	$wp_customize->add_control(
		'form_elements',
		[
			'label'   => __( 'Forms', 'gut-check' ),
			'description' => __( 'button, datalist, fieldset, form, input, label, legend, meter, optgroup, option, output, progress, select, textarea' ),
			'section' => 'style_debug',
			'type'    => 'checkbox',
		]
	);

	/* Interactive elements. */
	$wp_customize->add_setting(
		'interactive_elements',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	$wp_customize->add_control(
		'interactive_elements',
		[
			'label'       => __( 'Interactive elements', 'gut-check' ),
			'description' => __( 'details, dialog, menu, menuitem, summary' ),
			'section'     => 'style_debug',
			'type'        => 'checkbox',
		]
	);
}

/**
 * Bolder checkbox labels
 */
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
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gut_check_customize_preview_js() {
	wp_enqueue_script( 'gut-check-customizer', GC_ASSETS . 'customizer.js', [ 'customize-preview' ], false, true );
}

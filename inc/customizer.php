<?php
/**
 * Gut Check Theme Customizer
 *
 * @package Gut_Check
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gut_check_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'gut_check_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'gut_check_customize_partial_blogdescription',
			)
		);
	}

	/* Add the debug section. */
	$wp_customize->add_section(
		'style-debug',
		array(
			'title' => esc_html__( 'CSS debug settings', 'gut-check' ),
		)
	);

	/* Add the pesticide setting. */
	$wp_customize->add_setting(
		'front_pesticide',
		array(
			'default'           => 1,
			'sanitize_callback' => 'gut_check_sanitize_checkbox',
		)
	);

	/* Add the pesticide control. */
	$wp_customize->add_control(
		'front-pesticide',
		array(
			'label'    => esc_html__( 'Debug Front-End CSS', 'gut-check' ),
			'section'  => 'style-debug',
			'settings' => 'front_pesticide',
			'type'     => 'checkbox',
		)
	);

	/* Add the pesticide setting. */
	$wp_customize->add_setting(
		'editor_pesticide',
		array(
			'default'           => 1,
			'sanitize_callback' => 'gut_check_sanitize_checkbox',
		)
	);

	/* Add the pesticide control. */
	$wp_customize->add_control(
		'editor-pesticide',
		array(
			'label'    => esc_html__( 'Debug Editor CSS', 'gut-check' ),
			'section'  => 'style-debug',
			'settings' => 'editor_pesticide',
			'type'     => 'checkbox',
		)
	);

	/* Add the pesticide setting. */
	$wp_customize->add_setting(
		'css_pesticide',
		array(
			'default'           => 1,
			'sanitize_callback' => 'gut_check_sanitize_checkbox',
		)
	);

	/* Add the pesticide control. */
	$wp_customize->add_control(
		'css-pesticide',
		array(
			'label'    => esc_html__( 'Outline', 'gut-check' ),
			'section'  => 'style-debug',
			'settings' => 'css_pesticide',
			'type'     => 'checkbox',
		)
	);

	/* Add the pesticide depth setting. */
	$wp_customize->add_setting(
		'css_pesticide_depth',
		array(
			'default'           => 1,
			'sanitize_callback' => 'gut_check_sanitize_checkbox',
		)
	);

	/* Add the pesticide control. */
	$wp_customize->add_control(
		'css-pesticide-depth',
		array(
			'label'    => esc_html__( 'Shadow', 'gut-check' ),
			'section'  => 'style-debug',
			'settings' => 'css_pesticide_depth',
			'type'     => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'gut_check_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gut_check_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gut_check_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
function gut_check_customize_preview_js() {
	wp_enqueue_script( 'gut-check-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
	add_action( 'customize_preview_init', 'gut_check_customize_preview_js' );

function gut_check_sanitize_checkbox( $input ) {
	return ( 1 == $input ) ? 1 : 0;
}

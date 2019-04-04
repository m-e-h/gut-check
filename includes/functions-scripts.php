<?php

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
 * Inline root vars.
 */
function gut_check_debug_vars() {
	$outline_width = get_theme_mod( 'gc_outline_width', 1 );
	$shadow_depth  = get_theme_mod( 'gc_shadow_depth', 0.25 );
	$shadow_hex    = get_theme_mod( 'gc_shadow_color', '#002b36' );
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
	echo $style;
}

/**
 * Inline root vars.
 */
function gut_check_debug_e_vars() {

	$style = "
	<style data-style='gc-customized'>
		:root .components-toolbar div:not([class]),
		:root .block-editor-block-toolbar div:not([class]) {
			--gc-outline-width: 0;
			--gc-box-shadow: none;
		}
	</style>
	";

	/* Output custom style. */
	echo $style;
}

/**
 * Enqueue debugging scripts and styles.
 */
function gut_check_debug_front_styles() {

	if ( get_theme_mod( 'front_gut_check', 1 ) ) {

		wp_enqueue_style( 'root_vars', GC_ASSETS . 'style/root.css' );
		wp_add_inline_style( 'root_vars', gut_check_debug_vars() );

		if ( get_theme_mod( 'content_sectioning', 1 ) ) {

			wp_enqueue_style( 'content_sectioning', GC_ASSETS . 'style/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content', 1 ) ) {

			wp_enqueue_style( 'embedded_content', GC_ASSETS . 'style/embedded-content.css' );
		}

		if ( get_theme_mod( 'text_content', 1 ) ) {

			wp_enqueue_style( 'text_content', GC_ASSETS . 'style/text-content.css' );
		}

		if ( get_theme_mod( 'form_elements', 1 ) ) {

			wp_enqueue_style( 'form_elements', GC_ASSETS . 'style/forms.css' );
		}

		if ( get_theme_mod( 'media_embedded', 1 ) ) {

			wp_enqueue_style( 'media_embedded', GC_ASSETS . 'style/media-embedded.css' );
		}

		if ( get_theme_mod( 'inline_text', 1 ) ) {

			wp_enqueue_style( 'inline_text', GC_ASSETS . 'style/inline-text.css' );
		}

		if ( get_theme_mod( 'interactive_elements', 1 ) ) {

			wp_enqueue_style( 'interactive_elements', GC_ASSETS . 'style/interactive-elements.css' );
		}

		if ( get_theme_mod( 'table_content', 1 ) ) {

			wp_enqueue_style( 'table_content', GC_ASSETS . 'style/table-content.css' );
		}
	}

}

/**
 * Enqueue editor debugging scripts and styles.
 */
function gut_check_debug_edit_styles() {

	if ( get_theme_mod( 'editor_ui_gut_check', 0 ) ) {

		wp_enqueue_style( 'e-root_vars', GC_ASSETS . 'style/root.css' );
		wp_add_inline_style( 'e-root_vars', gut_check_debug_vars() );

		if ( get_theme_mod( 'content_sectioning', 1 ) ) {

			wp_enqueue_style( 'e-content_sectioning', GC_ASSETS . 'style/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content', 1 ) ) {

			wp_enqueue_style( 'e-embedded_content', GC_ASSETS . 'style/embedded-content.css' );
		}

		if ( get_theme_mod( 'text_content', 1 ) ) {

			wp_enqueue_style( 'e-text_content', GC_ASSETS . 'style/text-content.css' );
		}

		if ( get_theme_mod( 'form_elements', 1 ) ) {

			wp_enqueue_style( 'e-form_elements', GC_ASSETS . 'style/forms.css' );
		}

		if ( get_theme_mod( 'media_embedded', 1 ) ) {

			wp_enqueue_style( 'e-media_embedded', GC_ASSETS . 'style/media-embedded.css' );
		}

		if ( get_theme_mod( 'inline_text', 1 ) ) {

			wp_enqueue_style( 'e-inline_text', GC_ASSETS . 'style/inline-text.css' );
		}

		if ( get_theme_mod( 'interactive_elements', 1 ) ) {

			wp_enqueue_style( 'e-interactive_elements', GC_ASSETS . 'style/interactive-elements.css' );
		}

		if ( get_theme_mod( 'table_content', 1 ) ) {

			wp_enqueue_style( 'e-table_content', GC_ASSETS . 'style/table-content.css' );
		}
	} elseif ( get_theme_mod( 'editor_gut_check', 0 ) ) {

		wp_enqueue_style( 'root_vars', GC_ASSETS . 'editor/root.css' );
		wp_add_inline_style( 'root_vars', gut_check_debug_vars() );
		wp_add_inline_style( 'root_e_vars', gut_check_debug_e_vars() );

		if ( get_theme_mod( 'content_sectioning', 1 ) ) {

			wp_enqueue_style( 'content_sectioning', GC_ASSETS . 'editor/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content', 1 ) ) {

			wp_enqueue_style( 'embedded_content', GC_ASSETS . 'editor/embedded-content.css' );
		}

		if ( get_theme_mod( 'text_content', 1 ) ) {

			wp_enqueue_style( 'text_content', GC_ASSETS . 'editor/text-content.css' );
		}

		if ( get_theme_mod( 'form_elements', 1 ) ) {

			wp_enqueue_style( 'form_elements', GC_ASSETS . 'editor/forms.css' );
		}

		if ( get_theme_mod( 'media_embedded', 1 ) ) {

			wp_enqueue_style( 'media_embedded', GC_ASSETS . 'editor/media-embedded.css' );
		}

		if ( get_theme_mod( 'inline_text', 1 ) ) {

			wp_enqueue_style( 'inline_text', GC_ASSETS . 'editor/inline-text.css' );
		}

		if ( get_theme_mod( 'interactive_elements', 1 ) ) {

			wp_enqueue_style( 'interactive_elements', GC_ASSETS . 'editor/interactive-elements.css' );
		}

		if ( get_theme_mod( 'table_content', 1 ) ) {

			wp_enqueue_style( 'table_content', GC_ASSETS . 'editor/table-content.css' );
		}
	}

}

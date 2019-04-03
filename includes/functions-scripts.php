<?php

namespace GutCheck;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gut_check_customize_preview_js() {
	wp_enqueue_script( 'gut-check-customizer', GC_ASSETS . 'customizer.js', [ 'customize-preview' ], false, true );
}

/**
 * Enqueue debugging scripts and styles.
 */
function gut_check_debug_front_styles() {

	if ( get_theme_mod( 'front_pesticide' ) ) {

		wp_enqueue_style( 'root', GC_ASSETS . 'style/root.css' );

		if ( get_theme_mod( 'content_sectioning' ) ) {

			wp_enqueue_style( 'content_sectioning', GC_ASSETS . 'style/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content' ) ) {

			wp_enqueue_style( 'embedded_content', GC_ASSETS . 'style/embedded-content.css' );
		}

		if ( get_theme_mod( 'text_content' ) ) {

			wp_enqueue_style( 'text_content', GC_ASSETS . 'style/text-content.css' );
		}

		if ( get_theme_mod( 'form_elements' ) ) {

			wp_enqueue_style( 'form_elements', GC_ASSETS . 'style/forms.css' );
		}

		if ( get_theme_mod( 'image_multimedia' ) ) {

			wp_enqueue_style( 'image_multimedia', GC_ASSETS . 'style/image-multimedia.css' );
		}

		if ( get_theme_mod( 'inline_text' ) ) {

			wp_enqueue_style( 'inline_text', GC_ASSETS . 'style/inline-text.css' );
		}

		if ( get_theme_mod( 'interactive_elements' ) ) {

			wp_enqueue_style( 'interactive_elements', GC_ASSETS . 'style/interactive-elements.css' );
		}

		if ( get_theme_mod( 'table_content' ) ) {

			wp_enqueue_style( 'table_content', GC_ASSETS . 'style/table-content.css' );
		}
	}

}

/**
 * Enqueue editor debugging scripts and styles.
 */
function gut_check_debug_edit_styles() {

	// Blocks
	if ( get_theme_mod( 'editor_pesticide' ) ) {

		wp_enqueue_style( 'root', GC_ASSETS . 'editor/root.css' );
		wp_add_inline_style( 'pesticide-editor-customizer-styles', gut_check_debug_vars() );

		if ( get_theme_mod( 'content_sectioning' ) ) {

			wp_enqueue_style( 'content_sectioning', GC_ASSETS . 'editor/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content' ) ) {

			wp_enqueue_style( 'embedded_content', GC_ASSETS . 'editor/embedded-content.css' );
		}

		if ( get_theme_mod( 'text_content' ) ) {

			wp_enqueue_style( 'text_content', GC_ASSETS . 'editor/text-content.css' );
		}

		if ( get_theme_mod( 'form_elements' ) ) {

			wp_enqueue_style( 'form_elements', GC_ASSETS . 'editor/forms.css' );
		}

		if ( get_theme_mod( 'image_multimedia' ) ) {

			wp_enqueue_style( 'image_multimedia', GC_ASSETS . 'editor/image-multimedia.css' );
		}

		if ( get_theme_mod( 'inline_text' ) ) {

			wp_enqueue_style( 'inline_text', GC_ASSETS . 'editor/inline-text.css' );
		}

		if ( get_theme_mod( 'interactive_elements' ) ) {

			wp_enqueue_style( 'interactive_elements', GC_ASSETS . 'editor/interactive-elements.css' );
		}

		if ( get_theme_mod( 'table_content' ) ) {

			wp_enqueue_style( 'table_content', GC_ASSETS . 'editor/table-content.css' );
		}
	}

	// Editor Controls
	if ( get_theme_mod( 'editor_ui_pesticide' ) ) {

		wp_enqueue_style( 'root', GC_ASSETS . 'style/root.css' );

		if ( get_theme_mod( 'content_sectioning' ) ) {

			wp_enqueue_style( 'e-content_sectioning', GC_ASSETS . 'style/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content' ) ) {

			wp_enqueue_style( 'e-embedded_content', GC_ASSETS . 'style/embedded-content.css' );
		}

		if ( get_theme_mod( 'text_content' ) ) {

			wp_enqueue_style( 'e-text_content', GC_ASSETS . 'style/text-content.css' );
		}

		if ( get_theme_mod( 'form_elements' ) ) {

			wp_enqueue_style( 'e-form_elements', GC_ASSETS . 'style/forms.css' );
		}

		if ( get_theme_mod( 'image_multimedia' ) ) {

			wp_enqueue_style( 'e-image_multimedia', GC_ASSETS . 'style/image-multimedia.css' );
		}

		if ( get_theme_mod( 'inline_text' ) ) {

			wp_enqueue_style( 'e-inline_text', GC_ASSETS . 'style/inline-text.css' );
		}

		if ( get_theme_mod( 'interactive_elements' ) ) {

			wp_enqueue_style( 'e-interactive_elements', GC_ASSETS . 'style/interactive-elements.css' );
		}

		if ( get_theme_mod( 'table_content' ) ) {

			wp_enqueue_style( 'e-table_content', GC_ASSETS . 'style/table-content.css' );
		}
	}

}

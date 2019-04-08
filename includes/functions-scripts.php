<?php

namespace GutCheck\Scripts;

use GutCheck\Helpers;

/**
 * Setup the scripts.
 */
function bootstrap() {
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\load_front_css' );
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\load_editor_css' );
}

/**
 * Enqueue debugging scripts and styles.
 */
function load_front_css() {

	if ( get_theme_mod( 'front_gut_check', 1 ) ) {

		wp_enqueue_style( 'root_vars', GC_ASSETS . 'style/root.css' );
		wp_add_inline_style( 'root_vars', inline_css_vars() );

		if ( get_theme_mod( 'content_sectioning', 1 ) ) {

			wp_enqueue_style( 'content_sectioning', GC_ASSETS . 'style/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content', 1 ) ) {

			wp_enqueue_style( 'embedded_content', GC_ASSETS . 'style/embedded-content.css' );
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

		if ( get_theme_mod( 'table_content', 1 ) ) {

			wp_enqueue_style( 'table_content', GC_ASSETS . 'style/table-content.css' );
		}
	}

}

/**
 * Enqueue editor debugging scripts and styles.
 */
function load_editor_css() {

	if ( get_theme_mod( 'editor_ui_gut_check', 0 ) ) {

		wp_enqueue_style( 'e-root_vars', GC_ASSETS . 'style/root.css' );
		wp_add_inline_style( 'e-root_vars', inline_css_vars() );

		if ( get_theme_mod( 'content_sectioning', 1 ) ) {

			wp_enqueue_style( 'e-content_sectioning', GC_ASSETS . 'style/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content', 1 ) ) {

			wp_enqueue_style( 'e-embedded_content', GC_ASSETS . 'style/embedded-content.css' );
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

		if ( get_theme_mod( 'table_content', 1 ) ) {

			wp_enqueue_style( 'e-table_content', GC_ASSETS . 'style/table-content.css' );
		}
	} elseif ( get_theme_mod( 'editor_gut_check', 1 ) ) {

		wp_enqueue_style( 'root_vars', GC_ASSETS . 'editor/root.css' );
		wp_add_inline_style( 'root_vars', inline_css_vars() );
		wp_add_inline_style( 'root_e_vars', inline_editor_resets() );

		if ( get_theme_mod( 'content_sectioning', 1 ) ) {

			wp_enqueue_style( 'content_sectioning', GC_ASSETS . 'editor/content-sectioning.css' );
		}

		if ( get_theme_mod( 'embedded_content', 1 ) ) {

			wp_enqueue_style( 'embedded_content', GC_ASSETS . 'editor/embedded-content.css' );
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

		if ( get_theme_mod( 'table_content', 1 ) ) {

			wp_enqueue_style( 'table_content', GC_ASSETS . 'editor/table-content.css' );
		}
	}

}

/**
 * Inline root vars.
 */
function inline_css_vars() {
	$outline_width = get_theme_mod( 'gc_outline_width', 1 );
	$shadow_depth  = get_theme_mod( 'gc_shadow_depth', 0.25 );
	$shadow_hex    = get_theme_mod( 'gc_shadow_color', '#002b36' );
	$shadow_rgb    = implode( ', ', Helpers\hex_to_rgb( $shadow_hex ) );
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
function inline_editor_resets() {

	$style = "
	<style data-style='gc-editor-reset'>
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

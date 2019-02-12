<?php
/**
 * Gut Check functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gut_Check
 */

add_action('wp_enqueue_scripts', 'gut_check_debug_front_styles');
add_action('enqueue_block_editor_assets', 'gut_check_debug_edit_styles');
add_action('customize_register', 'gut_check_debug_customize_register');
add_action('wp_head', 'gut_check_debug_vars');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gut_check_debug_vars()
{

    $outline_width = get_theme_mod('gc_outline_width', '0');
    $shadow_depth = get_theme_mod('gc_shadow_depth', '0');

    $style_var  = '';
    $style_var .= "--gc-outline-width:{$outline_width}px;";
    $style_var .= "--gc-shadow-depth:{$shadow_depth}rem;";

    /* Put the final style output together. */
    $style = "
	<style data-style='gc-customized'>
		:root{ {$style_var} }
	</style>
	";

    /* Output custom style. */
    echo $style;

}

/**
 * Enqueue debugging scripts and styles.
 */
function gut_check_debug_front_styles() {

    if (get_theme_mod('front_pesticide') ) {

        wp_enqueue_style('pesticide', get_parent_theme_file_uri('css/pesticide.css'));
    }

}

/**
 * Enqueue editor debugging scripts and styles.
 */
function gut_check_debug_edit_styles() {

    if (get_theme_mod('editor_pesticide') ) {

        wp_enqueue_style('pesticide-edit', get_parent_theme_file_uri('css/e-pesticide.css'), null, null);
    }

}

/**
 * Add debug settings to the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gut_check_debug_customize_register( $wp_customize )
{

    /* Add the debug section. */
    $wp_customize->add_section(
        'style_debug',
        array(
        'title' => esc_html__('CSS debug settings', 'gut-check'),
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
        'label'   => esc_html__('Debug Front-End CSS', 'gut-check'),
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
        )
    );

    /* Add the pesticide control. */
    $wp_customize->add_control(
        'editor_pesticide',
        array(
        'label'   => esc_html__('Debug Editor CSS', 'gut-check'),
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
        new WP_Customize_Range(
            $wp_customize,
            'gc_outline_width',
            array(
                'label'   => 'Outline Width',
                'min'     => 0,
                'max'     => 8,
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
        new WP_Customize_Range(
            $wp_customize,
            'gc_shadow_depth',
            array(
                'label'   => 'Shadow Depth',
                'min'     => 0,
                'max'     => 4,
                'step'    => 0.25,
                'section' => 'style_debug',
            )
        )
    );

}




if (class_exists('WP_Customize_Control') ) {
    class WP_Customize_Range extends WP_Customize_Control
    {
        public $type = 'range';

        public function enqueue()
        {
            /**
             * Load styles for the customizer controls.
             */
            wp_enqueue_style('gut-check-customize-controls', get_theme_file_uri('/css/customize-controls.css'));
        }

        public function __construct( $manager, $id, $args = array() )
        {
            parent::__construct($manager, $id, $args);
            $defaults = array(
            'min'  => 0,
            'max'  => 10,
            'step' => 1,
            );
            $args     = wp_parse_args($args, $defaults);

            $this->min  = $args['min'];
            $this->max  = $args['max'];
            $this->step = $args['step'];
        }

        public function render_content()
        {
            ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <?php echo "<input id='{$this->id}' type='range' class='{$this->id}' min='{$this->min}' max='{$this->max}' step='{$this->step}' value='{$this->value()}' oninput='{$this->id}_output.value = {$this->id}.value'"; ?><?php $this->link(); ?>>

            <br>

            <?php echo "<output id='{$this->id}_output' class='{$this->id}_output'>{$this->value()}</output>"; ?>
        </label>
            <?php
        }
    }
}



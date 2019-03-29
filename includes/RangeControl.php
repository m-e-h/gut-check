<?php

namespace GutCheck\RangControl;

use WP_Customize_Control;

if ( class_exists( 'WP_Customize_Control' ) ) {

	class GC_Customize_Range extends WP_Customize_Control {

		public $type = 'range';

		public function enqueue() {
			/**
			 * Load styles for the customizer controls.
			 */
			wp_enqueue_style( 'gut-check-customize-controls', GC_URL . '/css/customize-controls.css' );
		}

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			$defaults = array(
				'min'  => 0,
				'max'  => 10,
				'step' => 1,
			);
			$args     = wp_parse_args( $args, $defaults );

			$this->min  = $args['min'];
			$this->max  = $args['max'];
			$this->step = $args['step'];
		}

		public function render_content() {
			?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

			<?php echo "<input id='{$this->id}' type='range' class='{$this->id}' min='{$this->min}' max='{$this->max}' step='{$this->step}' value='{$this->value()}' oninput='{$this->id}_output.value = {$this->id}.value'"; ?><?php $this->link(); ?>>

			<?php echo "<output id='{$this->id}_output' class='{$this->id}_output'>{$this->value()}</output>"; ?>
		</label>
			<?php
		}
	}
}

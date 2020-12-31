<?php
namespace It_Main_Class_For_Elementor\Modules\Controls;

defined( 'ABSPATH' ) || exit;

class Ajax_Select2 extends \Elementor\Base_Data_Control {

	public function get_api_url(){
		return get_rest_url() . 'elementskit/v1';
	}

	/**
	 * Get select2 control type.
	 *
	 * Retrieve the control type, in this case `select2`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'ajaxselect2';
	}

	/**
	 * Enqueue ontrol scripts and styles.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue() {
		// script
		wp_register_script( 'elementskit-js-ajaxchoose-control',  ITPL_ELEMENTOR_POST_SLIDER_JS . 'ajaxchoose.js' );
		wp_enqueue_script( 'elementskit-js-ajaxchoose-control' );
	}

	/**
	 * Get select2 control default settings.
	 *
	 * Retrieve the default settings of the select2 control. Used to return the
	 * default settings while initializing the select2 control.
	 *
	 * @since 1.8.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'options' => [],
			'multiple' => false,
			'select2options' => [],
		];
	}


	/**
	 * Render select2 control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		echo 'UUU';
	}
}

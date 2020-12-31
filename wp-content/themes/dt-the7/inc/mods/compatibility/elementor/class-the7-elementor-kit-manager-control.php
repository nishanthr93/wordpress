<?php

/**
 * Will disable elementor kit manager (theme styles).
 *
 * @package The7
 */

namespace The7\Adapters\Elementor;

use Elementor\Plugin as Elementor;
use The7\Elementor\Modules\Kit\The7_Kit;

defined( 'ABSPATH' ) || exit;

/**
 * Class The7_Kit_Manager_Control
 */
class The7_Kit_Manager_Control {


	public function bootstrap() {
	    add_action( 'elementor/init', [ $this, 'disable_elementor_kit_manager' ], 1 );
		add_action( 'after_switch_theme', [ $this, 'update_kit_css' ] );
	}

	public function disable_elementor_kit_manager() {
		$kits_manager = Elementor::instance()->kits_manager;
		if (version_compare(ELEMENTOR_VERSION, "3.0.0", "<")) {
			remove_action( 'elementor/documents/register', [ $kits_manager, 'register_document' ] );
			remove_filter( 'elementor/editor/localize_settings', [ $kits_manager, 'localize_settings' ] );
			remove_filter( 'elementor/editor/footer', [ $kits_manager, 'render_panel_html' ] );
			remove_action( 'elementor/frontend/after_enqueue_global', [
					$kits_manager,
					'frontend_before_enqueue_styles'
				], 0 );
			remove_action( 'elementor/preview/enqueue_styles', [ $kits_manager, 'preview_enqueue_styles' ], 0 );
		}
		else {
			remove_action( 'elementor/documents/register', [ $kits_manager, 'register_document' ] );
			add_action( 'elementor/documents/register', [ $this, 'register_document' ] );
			add_filter( 'elementor/editor/localize_settings', [ $this, 'localize_settings' ], 50 );

			//handle global colors
			add_filter( 'rest_request_after_callbacks', [ $this, 'handle_kit_globals' ], 10, 3 );
		}
	}

	public function register_document( $documents_manager ) {
		require_once __DIR__ . '/modules/kits/class-the7-kit.php';
		$documents_manager->register_document_type( 'kit', The7_Kit::get_class_full_name() );
	}

	public function localize_settings( $settings ) {
		$settings = array_replace_recursive( $settings, [
			'i18n' => [
				'theme_style' => "",
			],
		] );

		return $settings;
	}

	private static function get_the7_kit_colors() {
		$colors = [
			'the7-content-headers_color'           => __( 'Headings', 'the7mk2' ),
			'the7-content-primary_text_color'      => __( 'Primary text', 'the7mk2' ),
			'the7-content-secondary_text_color'    => __( 'Secondary text', 'the7mk2' ),
			'the7-accent'                          => __( 'Accent', 'the7mk2' ),
			'the7-buttons-color_mode'              => __( 'Button background normal', 'the7mk2' ),
			'the7-buttons-hover_color_mode'        => __( 'Button background hover', 'the7mk2' ),
			'the7-buttons-text_color_mode'         => __( 'Button text normal', 'the7mk2' ),
			'the7-buttons-text_hover_color_mode'   => __( 'Button text hover', 'the7mk2' ),
			'the7-buttons-border-color_mode'       => __( 'Button border normal', 'the7mk2' ),
			'the7-buttons-hover-border-color_mode' => __( 'Button border hover', 'the7mk2' ),
			'the7-dividers-color' => __( 'Dividers', 'the7mk2' ),
			'the7-general-content_boxes_bg_color' => __( 'Content boxes background', 'the7mk2' ),
		];

		$result = [];
		foreach ($colors as $key => $title){
			$key_filtered = str_replace("-", "_", $key);
			$result[$key_filtered] = [
				'id' => $key_filtered,
				'title' => 'The7 ' . $title,
				'value' => the7_theme_get_color( str_replace("the7-", "", $key)),
			];
		}

		return $result;
	}


	public function handle_kit_globals( $response, $handler, $request  ) {
		$route = $request->get_route();
		$the7_colors = self::get_the7_kit_colors();
		if($route === '/elementor/v1/globals' && $request->get_method() === 'GET'){
			$response->data['colors'] = array_merge($response->data['colors'], $the7_colors);
		}
		else if (strpos($route, '/elementor/v1/globals/colors/') === 0 && $request->get_method() === 'GET'){
			$param_id = $request->get_param( 'id' );
			if (array_key_exists($param_id, $the7_colors)){
				$response = rest_ensure_response( $the7_colors[$param_id]);
			}
		}
		return $response;
	}

	public function update_kit_css(){
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}
}
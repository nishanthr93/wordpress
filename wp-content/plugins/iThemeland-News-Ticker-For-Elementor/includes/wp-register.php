<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class It_Bundle_Register_Css_Js {

	public function __construct() {
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_frontend_styles' ) );

		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_frontend_scripts' ) );

		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_area' ) );
	}

	public function register_frontend_styles() {
				/*
		 * News Ticker
		 */
		wp_register_style(
			'newsicon-css',
			__IT_BUNDLE_ADDONS_URL__ . 'assets/css/itpl_newsicon.css',
			array(),
			__IT_BUNDLE_VERSION__,
			'all'
		);
		wp_register_style(
			'news-ticker-css',
			__IT_BUNDLE_ADDONS_URL__ . 'assets/css/news-ticker.css',
			array(),
			__IT_BUNDLE_VERSION__,
			'all'
		);
		wp_register_style(
			'bx-slider-css',
			__IT_BUNDLE_ADDONS_URL__ . 'assets/css/bx-slider/jquery.bxslider.css',
			array(),
			__IT_BUNDLE_VERSION__,
			'all'
		);
		wp_register_style(
			'marquee-css',
			__IT_BUNDLE_ADDONS_URL__ . 'assets/css/marquee/imarquee.css',
			array(),
			__IT_BUNDLE_VERSION__,
			'all'
		);

	}

	public function register_frontend_scripts() {

		wp_enqueue_script('jquery');

//		wp_register_script(
//			'block-post-js',
//			__IT_BUNDLE_ADDONS_URL__ . 'assets/js/post-block/itpl_block_post.js',
//			array( 'jquery' ),
//			__IT_BUNDLE_VERSION__,
//			true
//		);

//		wp_register_script(
//			'swiper-js-file',
//			__IT_BUNDLE_ADDONS_URL__ . 'assets/js/swiper.js',
//			array( 'jquery' ),
//			__IT_BUNDLE_VERSION__,
//			true
//		);

//		wp_register_script(
//			'slider-post-js',
//			__IT_BUNDLE_ADDONS_URL__ . 'assets/js/slider-post/itpl_script.js',
//			array( 'jquery' ),
//			__IT_BUNDLE_VERSION__,
//			true
//		);

		wp_register_script(
			'bx-slider-js',
			__IT_BUNDLE_ADDONS_URL__ . 'assets/js/bx-slider/jquery.bxslider.js',
			array( 'jquery' ),
			__IT_BUNDLE_VERSION__,
			true
		);

		wp_register_script(
			'marquee-js',
			__IT_BUNDLE_ADDONS_URL__ . 'assets/js/marquee/imarquee.js',
			array( 'jquery' ),
			__IT_BUNDLE_VERSION__,
			true
		);

        wp_register_script(
            'script-js',
            __IT_BUNDLE_ADDONS_URL__ . 'assets/js/script-js.js',
            array( 'jquery' ),
            __IT_BUNDLE_VERSION__,
            true
        );
	}


	public function widgets_area() {
		foreach ( glob( __IT_BUNDLED_DIR_PATH__ . 'includes/widgets/' . '*.php' ) as $file ) {
			require_once $file;

			$base           = basename( str_replace( '.php', '', $file ) );
			$class          = ucwords( str_replace( '-', ' ', $base ) );
			$class          = str_replace( ' ', '_', $class );
			$class          = sprintf( 'ItBundleElementor\Widgets\It_Pl_%s', $class );
			$widget_manager = \Elementor\Plugin::instance()->widgets_manager;
			if ( class_exists( $class ) ) {
				$widget_manager->register_widget_type( new $class );
			}
		}
	}
}

new It_Bundle_Register_Css_Js();
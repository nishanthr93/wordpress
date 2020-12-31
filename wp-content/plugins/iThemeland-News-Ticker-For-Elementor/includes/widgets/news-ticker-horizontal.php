<?php

namespace ItBundleElementor\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use It_Main_Class_For_Elementor\Modules\Controls\Controls_Manager as ItElementor_Controls_Manager;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class It_Pl_News_Ticker_Horizontal extends Widget_Base {

	public function get_name() {
		return 'it-news_ticker_horizontal';
	}

	public function get_title() {
		return esc_html__( 'iT News Ticker', ITPL_ELEMENTOR_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'fa fa-th-large';
	}

	public function get_categories() {
		return [ 'it-All-In-One-Puzzle' ];
	}

	public function get_style_depends() {
		return [
			'newsicon-css',
			'bx-slider-css',
			'news-ticker-css',
			'marquee-css',
		];
	}

	public function get_script_depends() {
		return [
			'marquee-js',
			'bx-slider-js',
			'script-js',
		];
	}

	protected function _register_controls() {
		//Query//
		$this->start_controls_section(
			'itpl_news_ticker_horizontal_section_source',
			[
				'label' => esc_html__( 'Ticker Source', ITPL_ELEMENTOR_TEXTDOMAIN ),
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_source',
			[
				'label'   => esc_html__( 'Source', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'build_query' => esc_html__( 'Build Query', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'rss'         => esc_html__( 'RSS & Feed', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'manual'      => esc_html__( 'Manual Text', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
				'default' => 'build_query',
			]
		);


		//BUILD QUERY
		$this->add_control(
			'itpl_news_ticker_horizontal_post_type',
			[
				'label'     => esc_html__( 'Post Type', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
				        'post'=>esc_html__( 'Posts', ITPL_ELEMENTOR_TEXTDOMAIN ),
				        'page'=>esc_html__( 'Pages', ITPL_ELEMENTOR_TEXTDOMAIN ),
                ],
				'default'   => 'post',
				'condition' => [
					'itpl_news_ticker_horizontal_source' => 'build_query',
				],
			]
		);


		$this->add_control(
			'itpl_news_ticker_horizontal_post_number',
			[
				'label'     => esc_html__( 'Post Number', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'condition' => [
					'itpl_news_ticker_horizontal_source' => 'build_query',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_post_offset',
			[
				'label'     => esc_html__( 'Post Offset', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'condition' => [
					'itpl_news_ticker_horizontal_source' => 'build_query',
				],
			]
		);


		$this->add_control(
			'itpl_news_ticker_horizontal_include_category',
			[
				'label'        => esc_html__( 'Include Category', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_category_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'post',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_exclude_category',
			[
				'label'        => esc_html__( 'Exclude Category', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_category_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'post',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_include_tag',
			[
				'label'        => esc_html__( 'Include Tag', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_tag_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'post',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_exclude_tag',
			[
				'label'        => esc_html__( 'Exclude Tag', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_tag_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'post',
				],
			]
		);


		$this->add_control(
			'itpl_news_ticker_horizontal_include_post_id',
			[
				'label'        => esc_html__( 'Include Post ID', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_posts_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'post',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_exclude_post_id',
			[
				'label'        => esc_html__( 'Exclude Post ID', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_posts_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'post',
				],
			]
		);


		$this->add_control(
			'itpl_news_ticker_horizontal_include_page_id',
			[
				'label'        => esc_html__( 'Include Page ID', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_pages_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'page',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_exclude_page_id',
			[
				'label'        => esc_html__( 'Exclude Page ID', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_pages_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'page',
				],
			]
		);

		$condition_options = itpl_get_post_type();
		unset( $condition_options['post'] );
		unset( $condition_options['page'] );
		$condition_options = array_keys( $condition_options );
		$this->add_control(
			'itpl_news_ticker_horizontal_include_tax',
			[
				'label'        => esc_html__( 'Include Tax', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_tax_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => $condition_options,
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_exclude_tax',
			[
				'label'        => esc_html__( 'Exclude Tax', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_tax_include(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => $condition_options,
				],
			]
		);


		$this->add_control(
			'itpl_news_ticker_horizontal_author_select',
			[
				'label'        => esc_html__( 'Post Author', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_all_author(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'post',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_page_author_select',
			[
				'label'        => esc_html__( 'Page Author', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT2,
				'return_value' => 'true',
				'multiple'     => true,
				'options'      => itpl_get_all_page_author(),
				'condition'    => [
					'itpl_news_ticker_horizontal_source'    => 'build_query',
					'itpl_news_ticker_horizontal_post_type' => 'page',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_sort_by',
			[
				'label'     => esc_html__( 'Sort By', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'groups'    => [
					"popular"     => [
						'label'   => esc_html__( 'Popular Order', ITPL_ELEMENTOR_TEXTDOMAIN ),
						'options' => [
							'modified'      => esc_html__( 'Latest Post', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'oldest_post'   => esc_html__( 'Oldest Post', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'title'         => esc_html__( 'Alphabet', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'ID'            => esc_html__( 'ID', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'rand'          => esc_html__( 'Random Post', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'1 week'        => esc_html__( 'Random Post(7 days)', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'1 month'       => esc_html__( 'Random Post(30 days)', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'comment_count' => esc_html__( 'Most Comment', ITPL_ELEMENTOR_TEXTDOMAIN ),
						],
					],
					"woocommerce" => [
						'label'   => esc_html__( 'Woocommerce Order', ITPL_ELEMENTOR_TEXTDOMAIN ),
						'options' => [
							'_price'         => esc_html__( 'Price', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'_regular_price' => esc_html__( 'Regular Price', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'_sale_price'    => esc_html__( 'Sale Price', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'_sku'           => esc_html__( 'SKU', ITPL_ELEMENTOR_TEXTDOMAIN ),
							'_stock'         => esc_html__( 'Stock Quantity', ITPL_ELEMENTOR_TEXTDOMAIN ),
						],
					]
				],
				'condition' => [
					'itpl_news_ticker_horizontal_source' => 'build_query',
				],
				'default'   => 'modified',
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_order',
			[
				'label'     => esc_html__( 'Order', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'ASC'  => esc_html__( 'ASC', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'DESC' => esc_html__( 'DESC', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
				'condition' => [
					'itpl_news_ticker_horizontal_source' => 'build_query',
				],
				'default'   => 'DESC',
			]
		);


		//RSS
		$repeater = new Repeater();
		$repeater->add_control(
			'itpl_news_ticker_horizontal_rss_text',
			[
				'label'   => esc_html__( 'RSS/Feed Title', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Text',
			]
		);
		$repeater->add_control(
			'itpl_news_ticker_horizontal_rss_link',
			[
				'label'         => esc_html__( 'RSS/Feed URL', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'          => Controls_Manager::URL,
				'default'       => [ 'url' => 'http://www.yourdomain.com' ],
				'show_external' => true,
				'dynamic'       => [ 'active' => true ],
			]
		);
		$repeater->add_control(
			'itpl_news_ticker_horizontal_rss_image',
			[
				'label'       => esc_html__( 'RSS/Feed Image', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Set image for each RSS Source', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'default'     => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_rss',
			[
				'label'       => esc_html__( 'RSS/Feed Sources', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => array_values( $repeater->get_controls() ),
				'default'     => [
					[
						'itpl_news_ticker_horizontal_rss_text' => esc_html__( 'Rss Text', ITPL_ELEMENTOR_TEXTDOMAIN )
					],
				],
				'title_field' => '{{{ itpl_news_ticker_horizontal_rss_text }}}',
				'condition'   => [
					'itpl_news_ticker_horizontal_source' => 'rss',
				],
			]
		);

		//Manual
		$repeater = new Repeater();
		$repeater->add_control(
			'itpl_news_ticker_horizontal_manual_text',
			[
				'label'   => esc_html__( 'Title', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Text',
			]
		);
		$repeater->add_control(
			'itpl_news_ticker_horizontal_manual_link',
			[
				'label'         => esc_html__( 'URL', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'          => Controls_Manager::URL,
				'default'       => [ 'url' => 'http://www.yourdomain.com' ],
				'show_external' => true,
				'dynamic'       => [ 'active' => true ],
			]
		);
		$repeater->add_control(
			'itpl_news_ticker_horizontal_manual_image',
			[
				'label'       => esc_html__( 'Image', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Set image for each manual Source', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'default'     => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_manual',
			[
				'label'       => esc_html__( 'Manual Sources', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => array_values( $repeater->get_controls() ),
				'default'     => [
					[
						'itpl_news_ticker_horizontal_manual_text' => esc_html__( 'Text', ITPL_ELEMENTOR_TEXTDOMAIN )
					],
				],
				'title_field' => '{{{ itpl_news_ticker_horizontal_manual_text }}}',
				'condition'   => [
					'itpl_news_ticker_horizontal_source' => 'manual',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'itpl_news_ticker_horizontal_settings_section',
			[
				'label' => esc_html__( 'Ticker Setting', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_template_setting',
			[
				'label' => esc_html__( 'Template', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_template',
			[
				'label'   => esc_html__( 'Choose Template', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'itnt-template-1',
				'options' => [
					'itnt-template-1'  => esc_html__( 'Template 1', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-2'  => esc_html__( 'Template 2', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-3'  => esc_html__( 'Template 3', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-4'  => esc_html__( 'Template 4', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-5'  => esc_html__( 'Template 5', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-6'  => esc_html__( 'Template 6', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-7'  => esc_html__( 'Template 7', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-8'  => esc_html__( 'Template 8', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-9'  => esc_html__( 'Template 9', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-10' => esc_html__( 'Template 10', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-11' => esc_html__( 'Template 11', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-template-12' => esc_html__( 'Template 12', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_movement_settings',
			[
				'label' => esc_html__( 'Movment Option', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_carousel_effect',
			[
				'label'   => esc_html__( 'Ticker Move Effect', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'marquee',
				'options' => [
					'marquee' => esc_html__( 'Marquee', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'slide'   => esc_html__( 'Slide', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'fade'    => esc_html__( 'Fade', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_show_navigation',
			[
				'label'        => esc_html__( 'Show Navigation', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'itnt-ticker-show-nav',
				'condition'    => [
					'itpl_news_ticker_horizontal_carousel_effect' => [ 'slide', 'fade' ],
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_auto_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '2000',
				'condition' => [
					'itpl_news_ticker_horizontal_carousel_effect' => [ 'slide', 'fade' ],
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_trans_speed',
			[
				'label'     => esc_html__( 'Pause Time', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '5000',
				'condition' => [
					'itpl_news_ticker_horizontal_carousel_effect' => [ 'slide', 'fade' ],
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_marquee_direction',
			[
				'label'     => esc_html__( 'Marquee Direction', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => esc_html__( 'Left', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'right' => esc_html__( 'Right', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
				'condition' => [
					'itpl_news_ticker_horizontal_carousel_effect' => 'marquee',
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_scroll_amount',
			[
				'label'     => esc_html__( 'Scroll Amount', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '70',
				'separator' => 'after',
				'condition' => [
					'itpl_news_ticker_horizontal_carousel_effect' => 'marquee',
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_general_settings',
			[
				'label' => esc_html__( 'General Settings', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_enable_interval',
			[
				'label'        => esc_html__( 'Enable Interval', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'enable_interval',
				'condition'    => [
					'itpl_news_ticker_horizontal_source' => [ 'build_query', 'rss' ],
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_interval',
			[
				'label'     => esc_html__( 'Refresh Time', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '1',
				'condition' => [
					'itpl_news_ticker_horizontal_enable_interval' => 'enable_interval',
					'itpl_news_ticker_horizontal_source' => [ 'build_query', 'rss' ],
				],

			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_pos',
			[
				'label'   => esc_html__( 'Ticker Position', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'itnt-current-place'               => esc_html__( 'Current Place', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-fix-place itnt-bottom-place' => esc_html__( 'Fix Bottom', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
				'default' => 'itnt-current-place',
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_Offset',
			[
				'label'     => esc_html__( 'Offset', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '0',
				'condition' => [
					'itpl_news_ticker_horizontal_pos' => [
						'itnt-fix-place itnt-bottom-place'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-ticker-holder.itnt-fix-place' => 'bottom: {{VALUE}}px !important;',

				],
			]
		);

		$this->add_control(
			"itpl_new_ticker_horizontal_title_text",
			[
				'label'       => esc_html__( 'Heading Text [Bold]', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Hot',
				'placeholder' => 'Enter text',

			]
		);
		$this->add_control(
			"itpl_new_ticker_horizontal_title_text_second",
			[
				'label'       => esc_html__( 'Heading Text [Thin]', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'News',
				'placeholder' => 'Enter text',

			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_show_icon',
			[
				'label'        => esc_html__( 'Show Icon In Heading', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'show_icon',
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_title_icon',
			[
				'label'     => esc_html__( 'Heading Icon', 'text-domain' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'itpl_news_ticker_horizontal_show_icon' => 'show_icon',
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_icon_space',
			[
				'label'     => esc_html__( 'Icon Spacing', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '10',
				'condition' => [
					'itpl_news_ticker_horizontal_show_icon' => 'show_icon',
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-heading-icon' => 'margin-right: {{VALUE}}px !important',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_show_logo',
			[
				'label'        => esc_html__( 'Show Logo', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'show_logo',
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_logo',
			[
				'label'       => esc_html__( 'Logo', 'plugin-domain' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Upload your site/company logo', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'default'     => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => [
					'itpl_news_ticker_horizontal_show_logo' => 'show_logo',
				],
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_open_link_new',
			[
				'label'        => esc_html__( 'Open Links On New Tab', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => '_blank',
			]
		);


		$this->add_control(
			'itpl_news_ticker_horizontal_show_time',
			[
				'label'        => esc_html__( 'Show Time Area', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'itnt-timer-enable',
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_show_post_image',
			[
				'label'        => esc_html__( 'Show Post Image', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'show_post_image',
				'default'      => 'show_post_image',
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_post_image_style',
			[
				'label'     => esc_html__( 'Image Style', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'itnt-circle-img'  => esc_html__( 'Round', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'itnt-square-img' => esc_html__( 'square', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
				'default'   => 'itnt-circle-img',
				'condition' => [
					'itpl_news_ticker_horizontal_show_post_image' => [ 'show_post_image' ],
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_default_image',
			[
				'label'       => esc_html__( 'Default Image', 'plugin-domain' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Default image when tick no any image', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'default'     => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => [
					'itpl_news_ticker_horizontal_show_post_image' => 'show_post_image',
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_show_date',
			[
				'label'        => esc_html__( 'Show Date', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition' => [
					'itpl_news_ticker_horizontal_source' => [ 'build_query', 'rss' ]
				],
			]
		);
		$this->add_control(
			'itpl_new_ticker_horizontal_date_format',
			[
				'label'     => esc_html__( 'Data Format', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'WP_default' => esc_html__( 'WP Default', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'relative'   => esc_html__( 'Relative', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'custom'     => esc_html__( 'Custom', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
				'default'   => 'relative',
				'condition' => [
					'itpl_news_ticker_horizontal_show_date' => 'yes',
					'itpl_news_ticker_horizontal_source' => 'build_query'
				],
			]
		);

		$this->add_control(
			"itpl_new_ticker_horizontal_custom_data",
			[
				'label'       => esc_html__( 'Custom Data Format', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'condition'   => [
					'itpl_new_ticker_horizontal_date_format' => 'custom',
				],
				'placeholder' => 'Y-m-d',
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_show_sharing',
			[
				'label'        => esc_html__( 'Show Sharing', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'show_sharing',
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_social_icons',
			[
				'label'     => esc_html__( 'Social Shares', 'plugin-domain' ),
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => [
					'share_facebook' => esc_html__( 'Facebook', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'share_twitter'  => esc_html__( 'Twitter', ITPL_ELEMENTOR_TEXTDOMAIN ),
					'share_google'   => esc_html__( 'Google', ITPL_ELEMENTOR_TEXTDOMAIN ),
				],
				'condition' => [
					'itpl_news_ticker_horizontal_show_sharing' => 'show_sharing',
				],
			]
		);


		$this->end_controls_section();

		/* Logo Section*/
		$this->start_controls_section(
			'itpl_news_ticker_horizontal_style_logo_section',
			[
				'label'     => esc_html__( 'Logo', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'itpl_news_ticker_horizontal_show_logo' => 'show_logo',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'label'      => esc_html__( 'Border', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'name'       => 'itpl_news_ticker_horizontal_logo_border',
				'show_label' => true,
				'selector'   => '{{WRAPPER}} .itnt-logo',
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_logo_background',
			[
				'label'     => esc_html__( 'Logo Background Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-logo,{{WRAPPER}} .itnt-template-6 .itnt-logo:before' => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .itnt-template-6 .itnt-logo:after'                         => 'border-color:  {{VALUE}} transparent transparent transparent'
				],
				'condition' => [
					'itpl_news_ticker_horizontal_show_logo' => 'show_logo',
				],
				'default'   => '#fff'
			]
		);
		$this->end_controls_section();

		/*Clock Area*/
		$this->start_controls_section(
			'itpl_news_ticker_horizontal_style_clock_area_section',
			[
				'label'     => esc_html__( 'Clock Area Style', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'itpl_news_ticker_horizontal_show_time' => 'itnt-timer-enable',
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_clock_area_background',
			[
				'label'     => esc_html__( 'Background Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-time-cnt' => 'background-color: {{VALUE}} !important',
				],
				'default'   => '#333'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => "itpl_news_ticker_horizontal_clock_area_text",
				'label'    => esc_html__( 'Text Setting', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .itnt-time-cnt',

			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_clock_area_color',
			[
				'label'     => esc_html__( 'Text Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-time-cnt' => 'color: {{VALUE}} !important',
				],
				'default'   => '#fff'
			]
		);
		$this->end_controls_section();

		/* Heading Section*/
		$this->start_controls_section(
			'itpl_news_ticker_horizontal_style_heading_section',
			[
				'label' => esc_html__( 'Heading Style', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_heading_background',
			[
				'label'     => esc_html__( 'Background Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-ticker-heading, {{WRAPPER}}  .itnt-template-6 .itnt-ticker-heading:before, {{WRAPPER}}  .itnt-template-7 .itnt-ticker-heading:before' => 'background-color: {{VALUE}} !important',
				],
				'default'   => '#444'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => "itpl_news_ticker_horizontal_heading_text",
				'label'    => esc_html__( 'Text Setting', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .itnt-ticker-heading .itnt-heading-title',

			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_heading_color',
			[
				'label'     => esc_html__( 'Text Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-ticker-heading .itnt-heading-title' => 'color: {{VALUE}} !important',
				],
				'default'   => '#fff'
			]
		);


		$this->add_control(
			'itpl_news_ticker_horizontal_content_icon_size',
			[
				'label'     => esc_html__( 'Icon Size', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .itnt-heading-icon i' => 'font-size: {{VALUE}}px !important',
				],
				'default'   => '15',
				'condition' => [
					'itpl_news_ticker_horizontal_show_icon' => 'show_icon',
				],
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_ticker_content_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-heading-icon' => 'color: {{VALUE}} !important',
				],
				'default'   => '#fff',
				'condition' => [
					'itpl_news_ticker_horizontal_show_icon' => 'show_icon',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'itpl_news_ticker_horizontal_style_ticker_content_section',
			[
				'label' => esc_html__( 'Ticker Content Style', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		//
		$this->start_controls_tabs(
			'itpl_news_ticker_horizontal_style_ticker_content_tabs'
		);

		$this->start_controls_tab(
			'itpl_news_ticker_horizontal_style_ticker_content_tab_normal',
			[
				'label' => esc_html__( 'Normal', ITPL_ELEMENTOR_TEXTDOMAIN ),
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_ticker_content_background',
			[
				'label'     => esc_html__( 'Background Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-ticker-body'                        => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .itnt-ticker-share .itnt-social-icons > a i' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .itnt-meta-date' => 'color: {{VALUE}} !important'
				],
				'default'   => '#303030'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => "itpl_news_ticker_horizontal_ticker_content_text",
				'label'    => esc_html__( 'Text Setting', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .itnt-ticker-holder .itnt-feed-title  a.itnt-feed-link',

			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_ticker_content_color',
			[
				'label'     => esc_html__( 'Text Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-ticker-holder .itnt-feed-title a.itnt-feed-link' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .itnt-ticker-body .itnt-ticker-share i.fa-share-alt'    => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .itnt-ticker-share .itnt-social-icons'                  => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .itnt-meta-date span' => 'background-color: {{VALUE}} !important'
				],
				'default'   => '#fff'
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'itpl_news_ticker_horizontal_style_ticker_content_tab_hover',
			[
				'label' => esc_html__( 'Hover', ITPL_ELEMENTOR_TEXTDOMAIN ),
			]
		);

		$this->add_control(
			'itpl_news_ticker_horizontal_ticker_content_hover_content',
			[
				'label'     => esc_html__( 'Text Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-ticker-holder .itnt-feed-title a.itnt-feed-link:hover' => 'color: {{VALUE}} !important'
				],
				'default'   => '#D9D9D9'
			]

		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/* Navigation Section */
		$this->start_controls_section(
			'itpl_news_ticker_horizontal_style_ticker_nav_section',
			[
				'label'     => esc_html__( 'Navigation', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'itpl_news_ticker_horizontal_show_navigation' => 'itnt-ticker-show-nav',
				],

			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_ticker_content_navigation_background',
			[
				'label'     => esc_html__( 'Navigation Background', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .itnt-template-2 .itnt-ticker-body:before, {{WRAPPER}} .itnt-template-3 .itnt-ticker-body:before , {{WRAPPER}} .itnt-template-5 .itnt-ticker-heading:before' => 'background-color: {{VALUE}} !important',

					'{{WRAPPER}} .itnt-template-1 .bx-controls-direction,{{WRAPPER}} .itnt-template-4 .ticker-slider-holder .bx-controls-direction, {{WRAPPER}} .itnt-template-6 .ticker-slider-holder .bx-controls-direction a,{{WRAPPER}} .itnt-template-9 .ticker-slider-holder .bx-controls-direction,{{WRAPPER}} .itnt-template-10 .ticker-slider-holder .bx-controls-direction,{{WRAPPER}} .itnt-template-11 .ticker-slider-holder .bx-controls-direction,{{WRAPPER}} .itnt-template-12 .ticker-slider-holder .bx-controls-direction, {{WRAPPER}} .itnt-template-7 .ticker-slider-holder .bx-controls-direction, {{WRAPPER}} .itnt-template-8 .ticker-slider-holder .bx-controls-direction  ' => 'background-color: {{VALUE}} !important',
				],
				'default'   => '#575757',
			]
		);
		$this->add_control(
			'itpl_news_ticker_horizontal_ticker_content_navigation_color',
			[
				'label'     => esc_html__( 'Navigation Color', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .ticker-slider-holder .bx-controls-direction a' => 'color: {{VALUE}} !important'
				],
				'default'   => '#e4e4e4',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'itpl_news_ticker_horizontal_style_ticker_custom_css_section',
			[
				'label' => esc_html__( 'Custom Css', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			"itpl_news_ticker_custom_css",
			[
				'label' => esc_html__( 'Custom css', ITPL_ELEMENTOR_TEXTDOMAIN ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$title = get_bloginfo( 'name' );

		if ( empty( $title ) ) {
			return;
		}
		$atts = $this->get_settings_for_display();

		// Define output and styles
		$output        = '';
		$custom_style  = '';
		$custom_script = '';
		$rand          = '';
		$rand          = $this->get_id();


        $new_post_date = current_time('timestamp');
        $new_post_date_gmt = get_gmt_from_date($new_post_date, 'H:i');
        $new_post_date_gmt_h = date("H", current_time('timestamp'));
        $new_post_date_gmt_m = date("i", current_time('timestamp'));
        $new_post_date_gmt_s = date("s", current_time('timestamp'));

		$params = [
		    'h' => $new_post_date_gmt_h,
		    'm' => $new_post_date_gmt_m,
		    's' => $new_post_date_gmt_s,
        ];
        wp_localize_script( 'script-js', 'params', $params );

		include __IT_BUNDLED_DIR_PATH__ . '/includes/custom-css/news-ticker-horizontal/custom-css.php';

		switch ( $atts['itpl_news_ticker_horizontal_source'] ) {
			case 'build_query':
				include __IT_BUNDLED_DIR_PATH__ . '/includes/layouts/news-ticker-horizontal/build_query.php';
				break;
			case 'rss':
				include __IT_BUNDLED_DIR_PATH__ . '/includes/layouts/news-ticker-horizontal/rss.php';
				break;
			default:
				include __IT_BUNDLED_DIR_PATH__ . '/includes/layouts/news-ticker-horizontal/manual.php';
		}

		$output .= $custom_style;
		printf( '%s', $output );
	}
}
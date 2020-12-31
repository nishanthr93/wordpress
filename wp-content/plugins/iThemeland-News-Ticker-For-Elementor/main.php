<?php
/**
 * Plugin Name: iThemeland News Ticker for Elementor
 * Description: Easy-to-use widgets that help you display and design your content using Elementor page builder.
 * Plugin URI:  https://ithemelandco.com
 * Version:     1.1
 * Author:      ithemelandco
 * Author URI:  https://ithemelandco.com/
 * Text Domain: ithemelandco_text_domain
 */

// Exit if accessed directly
if ( ! defined('ABSPATH')) {
    exit;
}

//  TEXT DOMAIN
if ( ! defined('ITPL_ELEMENTOR_TEXTDOMAIN')) {
    define('ITPL_ELEMENTOR_TEXTDOMAIN', 'ithemeland_puzzle');
}

use It_Main_Class_For_Elementor\Autoloader;

define('__IT_BUNDLE_ADDONS_URL__', plugins_url('/', __FILE__));
define('__IT_BUNDLE_VERSION__', '1.0');
define('__IT_BUNDLED_DIR_PATH__', plugin_dir_path(__FILE__));
define('__IT_BUNDLED_DIR_PATH_MODULES__', plugins_url('modules/controls', __FILE__));

class It_Main_Class_For_Elementor
{

    const  MINIMUM_ELEMENTOR_VERSION = '1.7.0';

    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'plugins_loaded_init']);

        //ADD IMAGE CHOSEN
        add_action('elementor/controls/controls_registered', array($this, 'image_choose'), 11);

    }

    static function plugin_dir()
    {
        return trailingslashit(plugin_dir_path(__FILE__));
    }

    public function image_choose($controls_manager)
    {
        include_once 'modules/controls/control-manager.php';

        $controls_manager->register_control('imagechoose',
            new \It_Main_Class_For_Elementor\Modules\Controls\Image_Choose());
    }

    public function plugins_loaded_init()
    {
        load_plugin_textdomain(ITPL_ELEMENTOR_TEXTDOMAIN , false,
            dirname(plugin_basename(__FILE__)) . '/languages/');

        if ( ! did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);

            return;
        }
        if ( ! version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);

            return;
        }
        add_action('init', array($this, 'init'), -999);
        // Add new Elementor Categories
        add_action('elementor/init', [$this, 'add_elementor_category']);

        //Add Image Size
        add_image_size('itpl_hor2_image', '800', '380', true);
        add_image_size('itpl_hor_image', '768', '506', true);
        add_image_size('itpl_ver_image', '470', '634', true);
        add_image_size('itpl_square_image', '500', '500', true);

        //AJAX Actions
        add_action('wp_ajax_it_newsticker_build_query_interval', [$this, 'it_newsticker_build_query_interval']);
        add_action('wp_ajax_nopriv_it_newsticker_build_query_interval', [$this, 'it_newsticker_build_query_interval']);

        add_action('wp_ajax_it_newsticker_rss_interval', [$this, 'it_newsticker_rss_interval']);
        add_action('wp_ajax_nopriv_it_newsticker_rss_interval', [$this, 'it_newsticker_rss_interval']);
    }

    function it_newsticker_build_query_interval()
    {
        global $wpdb;

        parse_str($_REQUEST['postdata'], $my_array_of_vars);

        $nonce = $_POST['nonce'];

        if ( ! wp_verify_nonce($nonce, 'it_bundle_none')) {
            $arr = array(
                'success'  => 'no-nonce',
                'products' => array()
            );
            print_r($arr);
            die();
        }

        $atts = get_object_vars(json_decode($my_array_of_vars['pw_atts']));

        $rand = $my_array_of_vars['pw_rand_id'];

        include "includes/layouts/news-ticker-horizontal/build_query_sql.php";
        include "includes/layouts/news-ticker-horizontal/build_query_output.php";

        /**
         * @var $output string
         */
        printf('%s', $output);
        $new_post_date = current_time('timestamp');
        $new_post_date_gmt = get_gmt_from_date($new_post_date, 'H:i');
        $new_post_date_gmt = date("H : i", current_time('timestamp'));
        echo "@#" . esc_html($new_post_date_gmt);

        die;
    }

    function it_newsticker_rss_interval()
    {
        global $wpdb;

        parse_str($_REQUEST['postdata'], $my_array_of_vars);

        $nonce = $_POST['nonce'];

        if ( ! wp_verify_nonce($nonce, 'it_bundle_none')) {
            $arr = array(
                'success'  => 'no-nonce',
                'products' => array()
            );
            print_r($arr);
            die();
        }

        $atts = get_object_vars(json_decode($my_array_of_vars['pw_atts']));

        $rand = $my_array_of_vars['pw_rand_id'];
        include "includes/layouts/news-ticker-horizontal/rss_output.php";
	    printf('%s', $output);

        die;
    }

    public function init()
    {
        require_once(__IT_BUNDLED_DIR_PATH__ . 'includes/query.php');
        require_once(__IT_BUNDLED_DIR_PATH__ . 'includes/wp-register.php');
    }

    public function add_elementor_category()
    {

        require_once 'autoloader.php';
        Autoloader::run();

        require_once "includes/Helper.php";

        \Elementor\Plugin::instance()->elements_manager->add_category('it-All-In-One-Puzzle', [
            'title' => esc_html__('IT All In One Puzzle', ITPL_ELEMENTOR_TEXTDOMAIN),
        ], 1);
    }

    public function admin_notice_missing_main_plugin()
    {
        $message = sprintf(
        /* translators: 1: ithemelandco Elements 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', ITPL_ELEMENTOR_TEXTDOMAIN),
            '<strong>' . esc_html__('Block Post Plugin', ITPL_ELEMENTOR_TEXTDOMAIN) . '</strong>',
            '<strong>' . esc_html__('Elementor', ITPL_ELEMENTOR_TEXTDOMAIN) . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function admin_notice_minimum_elementor_version()
    {
        $message = sprintf(
        /* translators: 1: Press Elements 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', ITPL_ELEMENTOR_TEXTDOMAIN),
            '<strong>' . esc_html__('Block Post Plugin', ITPL_ELEMENTOR_TEXTDOMAIN) . '</strong>',
            '<strong>' . esc_html__('Elementor', ITPL_ELEMENTOR_TEXTDOMAIN) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
}

new It_Main_Class_For_Elementor();
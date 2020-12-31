<?php

/*
Plugin Name: Event Schedule
Plugin URI:
Description: Clean and easy to use event scheduler for WordPress. Organize time, place and main actors of your conference, training, festival or meeting.
Version: 1.4.1
Author: PIXELMINT
Author URI: http://2code.pl
*/

// Setup working directories
define('TCODE_ES_DIR', WP_PLUGIN_DIR . '/' . dirname(plugin_basename(__FILE__)));
define('TCODE_ES_URL', plugin_dir_url(__FILE__));

// Bootstrap file (loader)
include_once(TCODE_ES_DIR . '/functions.php');
// Init custom hooks and shortcodes
include_once(TCODE_ES_DIR . '/Api.php');

class EventSchedule {
    public function __construct() {
        // Initialize custom post types
        add_action('init', array($this, 'loadCustomTypes'));
        // Load styles
        add_action('wp_enqueue_scripts', array($this, 'loadStyles'));
        // Load admin styles
        add_action('admin_enqueue_scripts', array($this, 'loadAdminStyles'));
        // Load scripts
        add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
        // Load inline styles (needed to pass settings to CSS)
        add_action('wp_enqueue_scripts', function() {
            require TCODE_ES_DIR . '/inlineStyles.php';
        });

        // Initialize custom fields
        add_action('acf/init', array($this, 'loadCustomFields'));
        add_action('acf/register_fields', array($this, 'loadCustomFieldsv4'));
    }

    public function loadStyles() {
        wp_enqueue_style('2code-base-style', TCODE_ES_URL . 'assets/css/basestyle.min.css');
        wp_enqueue_style('2code-slider-style', TCODE_ES_URL . 'assets/plugins/slick/slick.css');
        wp_enqueue_style('2code-magnific-popup-style', TCODE_ES_URL . 'assets/plugins/magnific-popup/dist/magnific-popup.css');
        wp_enqueue_style('2code-schedule-style', TCODE_ES_URL . 'assets/css/style.css');
        wp_enqueue_style('2code-schedule-icons', TCODE_ES_URL . 'assets/css/social-icons.css');
        wp_enqueue_style('2code-schedule-custom-style', TCODE_ES_URL . 'assets/css/cstyle.css');
    }

    public function loadAdminStyles() {
        wp_enqueue_style('2code-admin-style', TCODE_ES_URL . 'assets/css/admin.css');
    }

    public function loadScripts() {
        $settings = array(
            'locale' => get_locale(),
            'imageType' => tces_get_option('2code_image_format', 'circle'),
            'dateFormat' => tces_get_option('2code_date_format', 'ddd • DD/MM/YYYY'),
            'timeFormat' => tces_get_option('2code_time_format', 'h:mm A'),
            'dayFormat' => tces_get_option('2code_day_format', 'ddd'),
        );

        // Slick slider library
        wp_enqueue_script('2code-schedule-slider', TCODE_ES_URL . 'assets/plugins/slick/slick.min.js', array('jquery'), null, true);
        // Magnific popup library
        wp_enqueue_script('2code-schedule-magnific-popup', TCODE_ES_URL . 'assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js', array('jquery'), null, true);
        // Moment.js library
        wp_enqueue_script('2code-schedule-moment', TCODE_ES_URL . 'assets/plugins/moment/moment-with-locales.min.js', array(), null);
        // Main script file
        wp_enqueue_script('2code-schedule-script', TCODE_ES_URL . 'assets/js/script.js', array('2code-schedule-slider', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-effects-core', '2code-schedule-moment', '2code-schedule-magnific-popup'), null, true);
        // Pass settings to js file
        wp_localize_script('2code-schedule-script', 'settings', $settings);
    }

    public function loadCustomTypes() {
        $types = array('DayType', 'ArtistType', 'EventType');

        foreach ($types as $type) {
            $type::registerType();
        }
    }

    public function loadCustomFields() {
        $fields = array('DayFields', 'ArtistFields', 'EventFields');

        foreach ($fields as $field) {
            $field::loadFields();
        }
    }

    public function loadCustomFieldsv4() {
        $fields = array('DayFields', 'ArtistFields', 'EventFieldsv4');

        foreach ($fields as $field) {
            $field::loadFields();
        }
    }

}

// Autoinit
new EventSchedule();
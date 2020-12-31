<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 26.01.16
 * Time: 21:24
 */

// Include fields
include_once TCODE_ES_DIR . '/Fields/DayFields.php';
include_once TCODE_ES_DIR . '/Fields/ArtistFields.php';
include_once TCODE_ES_DIR . '/Fields/EventFields.php';
include_once TCODE_ES_DIR . '/Fields/EventFieldsv4.php';

// Include Types
include_once TCODE_ES_DIR . '/Types/DayType.php';
include_once TCODE_ES_DIR . '/Types/ArtistType.php';
include_once TCODE_ES_DIR . '/Types/EventType.php';

add_action('init', function() {
    // Include settings page
    include_once TCODE_ES_DIR . '/Includes/settings-page.php';

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Event settings',
            'menu_slug' => '2code-event-schedule-settings',
            'autoload' => true
        ));
    }
});

// Setup frequently used image sizes 
add_image_size('2code-square-thumbnail', 90, 90, true);
add_image_size('2code-square-thumbnail-large', 120, 120, true);
add_image_size('2code-rect-thumbnail', 140, 90, array('center', 'center'));

add_action('after_setup_theme', function() {
    global $_wp_theme_features;
    if (!is_array($_wp_theme_features['post-thumbnails'])) {
        return;
    }

    if (is_array($_wp_theme_features['post-thumbnails'][0]) && !in_array('tcode_event', $_wp_theme_features['post-thumbnails'][0])) {
        $_wp_theme_features['post-thumbnails'][0][] = 'tcode_event';
    }

    if (is_array($_wp_theme_features['post-thumbnails'][0]) && !in_array('tcode_artist', $_wp_theme_features['post-thumbnails'][0])) {
        $_wp_theme_features['post-thumbnails'][0][] = 'tcode_artist';
    }
}, 11);

add_filter('enter_title_here', function($title) {
    $screen = get_current_screen();

    if ($screen->post_type === 'tcode_artist') {
        $title = 'Enter author\'s name';
    }

    return $title;
});

add_filter('acf/settings/default_language', function ($language) {
    if (defined('ICL_LANGUAGE_CODE')) {
        return ICL_LANGUAGE_CODE;
    }

    return $language;
});

if( function_exists('add_term_ordering_support') )
    add_term_ordering_support ('location');

add_filter('acf/update_value/type=timepicker', function($value) {
    if (strstr($value, ':') === false) {
        $value .= ':00';
    }

    list($v1, $v2) = explode(':', $value);

    $value = validateTime($v1, $v2);

    return $value;
}, 10);

function validateTime($v1, $v2) {
    if (empty($v1) || !is_numeric($v1) || (int) $v1 > 23) {
        $v1 = '00';
    }
    if (empty($v2) || !is_numeric($v2) || (int) $v2 > 59) {
        $v2 = '00';
    }

    if (strlen($v1) === 2 && strlen($v2) === 2) {
        return $v1 . ':' . $v2;
    }

    if (strlen($v1) === 1) {
        $v1 = '0' . $v1;
    }
    if (strlen($v2) === 1) {
        $v2 = '0' . $v2;
    }

    return $v1 . ':' . $v2;
}

if (!function_exists('tces_get_option')) {
    function tces_get_option($option, $default = null, $format = true) {
        $field = get_field($option, 'options', $format);

        if (!$field && $default) {
            return $default;
        }
        return $field;
    }
}
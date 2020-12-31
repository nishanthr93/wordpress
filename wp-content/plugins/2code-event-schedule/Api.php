<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 27.01.16
 * Time: 23:17
 */

/*
 * Load third-party plugins
 */
if ((!defined('TCODE_ES_ACF_OFF') || !TCODE_ES_ACF_OFF) && !class_exists('acf')) {
    // Setup ACF location
    add_filter('acf/settings/path', function ($path) {
        $path = TCODE_ES_DIR . '/Plugins/acf-pro/';
        return $path;
    });

    // Setup ACF url
    add_filter('acf/settings/dir', function ($dir) {
        $dir = TCODE_ES_URL . '/Plugins/acf-pro/';
        return $dir;
    });

    // Load ACF
    include_once(TCODE_ES_DIR . '/Plugins/acf-pro/acf.php');
}

if (defined('TCODE_ES_ACF_OFF') && TCODE_ES_ACF_OFF) {
    require TCODE_ES_DIR . '/Includes/options.php';

    // theme options page
    add_filter('acf/options_page/settings', function($settings) {
        $settings['pages'][] = 'Event settings';

        return $settings;
    }, 99);
}

// Load ACF linkpicker
if (!class_exists('acf_field_link_picker')) {
    include_once(TCODE_ES_DIR . '/Plugins/acf-linkpicker/acf-link_picker.php');
}
// Load ACF timepicker
if (!class_exists('acf_field_timepicker')) {
    include_once(TCODE_ES_DIR . '/Plugins/acf-timepicker/acf-timepicker.php');
}

/*
 * End load third-party
 */

// Setup 'locations' taxonomy
add_action('init', function() {
    $labels = array(
        'name'              => _x( 'Locations', 'taxonomy general name' ),
        'singular_name'     => _x( 'Location', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Locations' ),
        'all_items'         => __( 'All Locations' ),
        'parent_item'       => __( 'Parent Location' ),
        'parent_item_colon' => __( 'Parent Location:' ),
        'edit_item'         => __( 'Edit Location' ),
        'update_item'       => __( 'Update Location' ),
        'add_new_item'      => __( 'Add New Location' ),
        'new_item_name'     => __( 'New Location Name' ),
        'menu_name'         => __( 'Locations' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => false,
        'show_in_quick_edit'=> false,
        'show_tagcloud'     => false,
        'show_in_nav_menus' => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'location' ),
    );

    register_taxonomy('location', array('tcode_event'), $args);
});
// Remove wp's default taxonomy selector
add_action('admin_menu' , function() {
    remove_meta_box('locationdiv', 'tcode_event', 'side');
});
// Initialize schedule shortcode (just call "[2code-schedule-draw]" inside your post or "do_shortcode('[2code-schedule-draw]')" in the template)
add_shortcode('2code-schedule-draw', function() {
    if (!class_exists('acf')) {
        return 'Could not find ACF. Please make sure it\'s installed or the \'Use embedded ACF\' option is selected in event-schedule settings.';
    }

    $postArray = array();

    $posts = get_posts(array(
        'post_type' => 'tcode_event',
        'posts_per_page' => -1,
        'numberposts' => -1,
        'post_status' => 'publish',
        'suppress_filters' => false
    ));

    if (!empty($posts)) {
        foreach($posts as $post) {
            setup_postdata($post);

            if (have_rows('field_56b8f1ecb7820', $post->ID)) {
                while (have_rows('field_56b8f1ecb7820', $post->ID)) {
                    the_row();

                    $datePost = get_sub_field('event_date');

                    if (!$datePost || $datePost->post_status !== 'publish') {
                        continue;
                    }

                    $time = get_sub_field('event_time');
                    $time_ends = get_sub_field('event_time_ends');
                    $time_end = date('Y-m-d ') . get_sub_field('event_time_end');
                    $location = get_sub_field('event_location');
                    $date = get_field('event_day_date', $datePost->ID);
                    $date = str_replace('/', '-', $date);
                    $date = new DateTime($date);
                    $dateFormatted = $date->format('Y-m-d');

                    $events = isset($postArray[$dateFormatted]) && isset($postArray[$dateFormatted]['events']) ? $postArray[$dateFormatted]['events'] : array();
                    $events[] = array(
                        'time' => $time,
                        'time_ends' => $time_ends,
                        'time_end' => $time_end,
                        'event' => $post,
                        'location' => !empty($location) ? $location->slug : ''
                    );

                    usort($events, function($a, $b) {
                        $aTime = new DateTime($a['time']);
                        $bTime = new DateTime($b['time']);
                        return $aTime->getTimestamp() > $bTime->getTimestamp();
                    });

                    $locations = isset($postArray[$dateFormatted]) && isset($postArray[$dateFormatted]['locations']) ? $postArray[$dateFormatted]['locations'] : array();

                    if (!empty($location)) {
                        $locationsSanitized = array_map(function($cat) {
                            return $cat->slug;
                        }, $locations);

                        if (!in_array($location->slug, $locationsSanitized)) {
                            $locations[] = $location;
                        }
                    }

                    usort($locations, function($a, $b) {
                        $aName = $a->name;
                        $bName = $b->name;

                        if (isset($a->term_order) && isset($b->term_order)) {
                            $aOrder = $a->term_order;
                            $bOrder = $b->term_order;

                            if ($aOrder !== $bOrder) {
                                return $aOrder < $bOrder;
                            }
                        }

                        return $aName < $bName;
                    });

                    $postArray[$dateFormatted] = array(
                        'day' => $datePost,
                        'events' => $events,
                        'locations' => $locations
                    );
                }
            }
        }
        wp_reset_postdata();
    }

    ksort($postArray);
    $postArray = array_values($postArray);

    $imageFormat = tces_get_option('2code_image_format', 'circle');
    $daysNum = tces_get_option('2code_number_of_days', 4);

    ob_start();
    require TCODE_ES_DIR . '/assets/templates/template.php';
    return ob_get_clean();
});
// Convert hexadecimal colors to RGB
add_filter('2code-schedule-color-hexToRGB', function($hex, $asString = true) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);

    if ($asString) {
        return implode(",", $rgb); // returns the rgb values separated by commas
    }

    return $rgb; // returns an array with the rgb values
}, 10, 2);

// Alter opacity (placeholder - function not used)
add_filter('2code-schedule-color-opacity', function($opacity) {
    return $opacity;
});
// Alter time format (placeholder - function not used)
add_filter('2code-time-format', function($format) {
    return $format;
});
// Convert max column number to column size
add_filter('2code-count-columns', function($count) {
    switch($count) {
        default:
            $cols = 3;
            break;
        case 5:
        case 4:
            $cols = 3;
            break;
        case 3:
            $cols = 4;
            break;
        case 2:
            $cols = 6;
            break;
        case 1:
            $cols = 12;
            break;
    }

    return $cols;
});
// Insert link at the end of the excerpt
add_filter('the_content', function($content, $author = false) {
    if (get_post_type() !== 'tcode_event' || $author) {
        return $content;
    }

    $url = get_field('event_url');

    if (isset($url['url']) && !empty($url['url'])) {
        $title = !empty($url['title']) ? $url['title'] : tces_get_option('2code_link_anchor', 'Read more...');
        $class = tces_get_option('2code_link_class', '');
        $link = sprintf('<a class="%s" href="%s" target="%s">%s</a>', $class, $url['url'], $url['target'], $title);

        $content .= ' ' . $link;
    }

    return $content;
}, 9, 2);
// Allow upload of svg files
add_filter( 'upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});
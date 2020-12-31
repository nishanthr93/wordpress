<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 26.01.16
 * Time: 21:55
 */

class EventFieldsv4 {

    public static function loadFields() {
        register_field_group(array(
            'id' => 'acf_event_fields',
            'title' => 'Extra fields',
            'fields' => array(
                array (
                    'key' => 'field_577184b834d59',
                    'label' => 'General',
                    'name' => 'general',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array ('status' => 0),
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array (
                    'key' => 'field_56b8f1ecb7820',
                    'label' => 'Event settings',
                    'name' => 'event_settings',
                    'type' => 'repeater',
                    'required' => 1,
                    'sub_fields' => array (
                        array (
                            'key' => 'field_56b8f249b7821',
                            'label' => 'Event date',
                            'name' => 'event_date',
                            'type' => 'post_object',
                            'required' => 1,
                            'column_width' => '100',
                            'return_format' => 'object',
                            'post_type' => array (
                                0 => 'tcode_event-day',
                            ),
                            'taxonomy' => array (
                                0 => 'all',
                            ),
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 1,
                        ),
                        array (
                            'key' => 'field_56b8f295b7822',
                            'label' => 'Event starts',
                            'name' => 'event_time',
                            'type' => 'timepicker',
                            'required' => 1,
                            'column_width' => '35',
                            'default_value' => date('H:i'),
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'none',
                            'maxlength' => '',
                        ),
                        array (
                            'key' => 'field_577acd4cc8a71',
                            'label' => 'Show the time event will end',
                            'name' => 'event_time_ends',
                            'type' => 'true_false',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => array ('status' => 0),
                            'column_width' => '30',
                            'message' => '',
                            'default_value' => 0,
                        ),
                        array (
                            'key' => 'field_577a16ee15a65',
                            'label' => 'Event ends',
                            'name' => 'event_time_end',
                            'type' => 'timepicker',
                            'required' => 0,
                            'column_width' => '35',
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'none',
                            'maxlength' => '',
                            'conditional_logic' => array (
                                'status' => 1,
                                'rules' => array (
                                    array (
                                        'field' => 'field_577acd4cc8a71',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                ),
                            ),
                        ),
                        array (
                            'key' => 'field_56b9cc90aa23b',
                            'label' => 'Event location',
                            'name' => 'event_location',
                            'type' => 'taxonomy',
                            'taxonomy' => 'location',
                            'field_type' => 'select',
                            'column_width' => '100',
                            'allow_null' => 1,
                            'load_save_terms' => 0,
                            'return_format' => 'object',
                            'multiple' => 0,
                        ),
                    ),
                    'row_min' => '1',
                    'row_limit' => '',
                    'layout' => 'row',
                    'button_label' => 'Add Event date',
                ),
                array (
                    'key' => 'field_5752b46d3a887',
                    'label' => 'Hour visibility',
                    'name' => 'event_hour_visible',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array ('status' => 0),
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array (
                        '1' => 'Visible',
                        '0' => 'Hidden',
                    ),
                    'default_value' => '1',
                    'layout' => 'vertical',
                ),
                array(
                    'key' => 'field_event_url',
                    'label' => 'Read more url',
                    'name' => 'event_url',
                    'type' => 'link_picker',
                ),
                array (
                    'key' => 'field_56ba1fc05902c',
                    'label' => 'Event author',
                    'name' => 'event_artist',
                    'type' => 'relationship',
                    'return_format' => 'object',
                    'post_type' => array (
                        0 => 'tcode_artist',
                    ),
                    'taxonomy' => array (
                        0 => 'all',
                    ),
                    'filters' => array (
                        0 => 'search',
                    ),
                    'result_elements' => array (
                        0 => 'featured_image',
                        1 => 'post_title',
                    ),
                ),
                array (
                    'key' => 'field_57718438c920b',
                    'label' => 'Styling',
                    'name' => 'styling',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array ('status' => 0),
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array (
                    'key' => 'field_577184dd7d6e4',
                    'label' => 'Event background color',
                    'name' => 'event_background_color',
                    'type' => 'color_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array ('status' => 0),
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '#FFFFFF',
                ),
                array (
                    'key' => 'field_577189580d713',
                    'label' => 'Event primary font color',
                    'name' => 'event_primary_font_color',
                    'type' => 'color_picker',
                    'instructions' => 'Default color used for event title',
                    'required' => 0,
                    'conditional_logic' => array ('status' => 0),
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
                array (
                    'key' => 'field_57718d77c89a5',
                    'label' => 'Event secondary font color',
                    'name' => 'event_secondary_font_color',
                    'type' => 'color_picker',
                    'instructions' => 'Default color used for event description',
                    'required' => 0,
                    'conditional_logic' => array ('status' => 0),
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'tcode_event',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array(
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => array(),
            ),
            'menu_order' => 0,
        ));
    }
}


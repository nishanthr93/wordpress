<?php
/**
 * Created by PhpStorm.
 * User: Shadov
 * Date: 2016-02-02
 * Time: 23:00
 */

class DayFields {

    public static function loadFields() {
        register_field_group(array(
            'id' => 'acf_event_day_fields',
            'title' => 'Extra fields',
            'fields' => array(
                array(
                    'key' => 'field_event_day_date',
                    'label' => 'Event date',
                    'name' => 'event_day_date',
                    'type' => 'date_picker',
                    'required' => true
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'tcode_event-day',
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
<?php
/**
 * Created by PhpStorm.
 * User: Shadov
 * Date: 2016-02-02
 * Time: 22:45
 */

class DayType {
    public static function registerType() {
        register_post_type('tcode_event-day', array(
            'labels' => array(
                'name' => 'Event days',
                'singular_name' => 'Event day'
            ),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-calendar-alt',
            'supports' => array('title')
        ));
    }
}
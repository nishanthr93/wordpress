<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 26.01.16
 * Time: 21:11
 */

class EventType {
    public static function registerType() {
        register_post_type('tcode_event', array(
            'labels' => array(
                'name' => 'Events',
                'singular_name' => 'Event'
            ),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-tickets-alt',
            'supports' => array('title', 'editor', 'comments', 'thumbnail')
        ));
    }
}
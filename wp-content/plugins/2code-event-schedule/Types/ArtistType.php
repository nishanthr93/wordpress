<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 26.01.16
 * Time: 21:11
 */

class ArtistType {
    public static function registerType() {
        register_post_type('tcode_artist', array(
            'labels' => array(
                'name' => 'Authors',
                'singular_name' => 'Author'
            ),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-admin-users',
            'supports' => array('title', 'editor', 'thumbnail')
        ));
    }
}
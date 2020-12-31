<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 26.01.16
 * Time: 21:55
 */

class ArtistFields {

    public static function loadFields() {
        register_field_group(array (
            'id' => 'acf_artist_fields',
            'title' => 'Extra fields',
            'fields' => array (
                array (
                    'key' => 'field_56ba28007f977',
                    'label' => 'Author title',
                    'name' => 'artist_title',
                    'type' => 'text',
                    'instructions' => 'Author title/position/company (for example "CEO at SomeCompany Co.")',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_56c07623590a5',
                    'label' => 'Social media',
                    'name' => 'social_icons',
                    'type' => 'repeater',
                    'instructions' => 'You can select up to 5 social network links',
                    'sub_fields' => array (
                        array (
                            'key' => 'field_56c07643590a6',
                            'label' => 'Social network',
                            'name' => 'icon_type',
                            'type' => 'select',
                            'required' => 1,
                            'column_width' => '',
                            'choices' => array (
                                'behance' => 'Behance',
                                'dribble' => 'Dribble',
                                'facebook' => 'Facebook',
                                'flickr' => 'Flickr',
                                'googlep' => 'Google+',
                                'instagram' => 'Instagram',
                                'linkedin' => 'LinkedIn',
                                'pinterest' => 'Pinterest',
                                'tumblr' => 'Tumblr',
                                'twitter' => 'Twitter',
                                'vimeo' => 'Vimeo',
                                'youtube' => 'Youtube',
                            ),
                            'default_value' => '',
                            'allow_null' => 0,
                            'multiple' => 0,
                        ),
                        array (
                            'key' => 'field_56c0b5d1590a7',
                            'label' => 'Social network url',
                            'name' => 'social_network_url',
                            'type' => 'text',
                            'instructions' => 'Enter the URL for your social media account',
                            'required' => 1,
                            'column_width' => '',
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'none',
                            'maxlength' => '',
                        ),
                    ),
                    'row_min' => '',
                    'row_limit' => 5,
                    'layout' => 'table',
                    'button_label' => 'Add Media',
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'tcode_artist',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => array (
                ),
            ),
            'menu_order' => 0,
        ));
    }
}


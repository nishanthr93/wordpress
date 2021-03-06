<?php
/**
 * Created by PhpStorm.
 * User: Shadov
 * Date: 2016-02-03
 * Time: 11:00
 */

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_577d6967aa6f8',
        'title' => 'Event settings',
        'fields' => array (
            /*array (
                'key' => 'field_577d75a479807',
                'label' => 'Basic settings',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),*/
            array (
                'key' => 'field_577d75e079808',
                'label' => 'Styling settings',
                'name' => 'styling_settings',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array (
                'key' => 'field_577d6e3be7f5e',
                'label' => 'Schedule size',
                'name' => '2code_module_size',
                'type' => 'select',
                'instructions' => 'This will apply to font sizes and margins',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'normal' => 'Normal (default)',
                    'small' => 'Compact',
                ),
                'default_value' => array (
                    0 => 'normal',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_577d7656e9f7c',
                'label' => 'Base color',
                'name' => '2code_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#fc4000',
            ),
            array (
                'key' => 'field_577d795ce6a7b',
                'label' => 'Event separator',
                'name' => '2code_event_separator',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    '1px solid' => 'Single line',
                    '1px dotted' => 'Dotted line`',
                    '1px dashed' => 'Dashed line',
                    'none' => 'No line',
                ),
                'default_value' => array (
                    0 => 'none',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_577d7a50e85a8',
                'label' => '"Read more" link class',
                'name' => '2code_link_class',
                'type' => 'text',
                'instructions' => 'Using this option you can set "Read more" links to display like other buttons on your site. Simply copy&paste your button\'s class.<br>
For standard bootstrap button type: <code>btn btn-primary</code><br>
Leave empty to display the link as text.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_577d76dc1efc7',
                'label' => 'Formatting settings',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array (
                'key' => 'field_577d76f51efc8',
                'label' => 'Date format',
                'name' => '2code_date_format',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_577d77e11efc9',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'DD-MMM-YYYY' => '15-Jan-2016',
                    'MMMM Do YYYY' => 'January 15th 2016',
                    'DD/MM/YYYY' => '15/01/2016',
                    'ddd • DD/MM/YYYY' => 'FRI • 15/01/2016',
                    'DD-MM-YYYY' => '15-01-2016',
                    'DD.MM.YYYY' => '15.01.2016',
                    'DD-MM' => '15-01',
                    'MMMM Do' => 'January 15th',
                    'DD/MM' => '15/01',
                    'ddd • DD/MM' => 'FRI • 15/01',
                    'DD.MM' => '15.01',
                ),
                'default_value' => array (
                    0 => 'ddd • DD/MM/YYYY',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_577d7d6854940',
                'label' => 'Day of week format (literal)',
                'name' => '2code_day_format',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'dd' => 'Su Mo ... Fr Sa',
                    'ddd' => 'Sun Mon ... Fri Sat',
                    'dddd' => 'Sunday Monday ... Friday Saturday',
                ),
                'default_value' => array (
                    0 => 'ddd',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_577d784e46027',
                'label' => 'Time format',
                'name' => '2code_time_format',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'HH:mm' => '21:21 (24h with leading zero)',
                    'hh:mm A' => '09:21PM (12h with leading zero)',
                    'H:mm' => '21:21 (24h without leading zero)',
                    'h:mm A' => '9:21PM (12h without leading zero)',
                ),
                'default_value' => array (
                    0 => 'h:mm A',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_577d78de384aa',
                'label' => 'How to display event image?',
                'name' => '2code_image_format',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'circle' => 'Show image in a circle (image will be cropped)',
                    'rectangle' => 'Show image in a rectangle',
                    'svg' => 'Show svg icon as event image',
                    'none' => 'None (don\'t show event image)',
                ),
                'default_value' => array (
                    0 => 'circle',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_57968e538ea95',
                'label' => 'Social icons placement',
                'name' => '2code_social_placement',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'author' => 'Show social icons next to author',
                    'popup' => 'Show social icons inside the popup',
                    'both' => 'Show social icons both next to author and inside the popup',
                ),
                'default_value' => array (
                    0 => 'both',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_577d760079809',
                'label' => 'Advanced settings',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array (
                'key' => 'field_577d7cf35493f',
                'label' => 'How to display day title',
                'name' => '2code_day_title',
                'type' => 'radio',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'title' => 'Display the title you\'ve set while creating a day',
                    'dayofweek' => 'Display the day of a week',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'title',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_577d7dce54941',
                'label' => 'Number of days',
                'name' => '2code_number_of_days',
                'type' => 'select',
                'instructions' => 'How many days should be shown',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    4 => 4,
                    5 => 5,
                    6 => 6,
                    7 => 7,
                ),
                'default_value' => array (
                    0 => 4,
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_577d7c7a5493e',
                'label' => 'Locations mode',
                'name' => '2code_locations_mode',
                'type' => 'radio',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'false' => 'Single location (location selector will be hidden)',
                    'true' => 'Multiple locations (location selector will be visible)',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'false',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_577d7b11298b9',
                'label' => 'Open first event accordion',
                'name' => '2code_accordion_open_first',
                'type' => 'radio',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'false' => 'All accordions collapsed',
                    'true' => 'First accordion expanded',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'false',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_577d7bb792d7d',
                'label' => 'Accordion behavior',
                'name' => '2code_accordion_behavior',
                'type' => 'radio',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'false' => 'Collapse accordion when another element is expanded',
                    'true' => 'Keep accordions open',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'false',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_577d77e11efc9',
                'label' => 'Hide date',
                'name' => '2code_date_hidden',
                'type' => 'true_false',
                'instructions' => 'The dates won\'t be shown in schedule',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => false,
            ),
            array (
                'key' => 'field_577d7a19e85a7',
                'label' => '"Read more" link anchor',
                'name' => '2code_link_anchor',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Read more...',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_577d79bbe6a7c',
                'label' => 'ACF settings',
                'name' => '2code_use_builtin_acf',
                'type' => 'radio',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'true' => 'Use ACF embedded into event-schedule plugin',
                    'false' => 'Use third-party ACF installation (choose this option if your theme requires ACF usage)',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'true',
                'layout' => 'vertical',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => '2code-event-schedule-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

endif;
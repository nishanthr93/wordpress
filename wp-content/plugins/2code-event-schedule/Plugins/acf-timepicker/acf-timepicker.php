<?php

/*
Plugin Name: 2code acf-timepicker
Plugin URI:
Description:
Version: 1.0
Author: Grzegorz Zbucki
*/




// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-timepicker', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );




// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_timepicker( $version ) {
	include_once('acf-timepicker-v5.php');
}

add_action('acf/include_field_types', 'include_field_types_timepicker');




// 3. Include field type for ACF4
function register_fields_timepicker() {
	include_once('acf-timepicker-v4.php');
}

add_action('acf/register_fields', 'register_fields_timepicker');



	
?>
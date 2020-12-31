<?php
/**
* Plugin Name: Show User ID
* Plugin URI: https://carlosmr.com
* Description: This plugin shows the ID field in the table of the Users section in the WordPress dashboard.
* Version: 1.0.0
* Author: Carlos Mart&iacute;nez Romero
* Author URI: https://carlosmr.com
* License: GPL+2
* Text Domain: show-user-id
* Domain Path: /languages
*/
// Starts the plugin
add_action( 'plugins_loaded', 'cmr_suid_execute' );
function cmr_suid_execute(){
add_filter('manage_users_columns', 'cmr_suid_add_uid_col');
	function cmr_suid_add_uid_col($columns) {
	    $columns['user_id'] = 'ID';
	    return $columns;
	}
	 
	add_action('manage_users_custom_column',  'cmr_suid_show_uid_col_data', 10, 3);
	function cmr_suid_show_uid_col_data($value, $column_name, $user_id) {
	    $user = get_userdata( $user_id );
		if ( 'user_id' == $column_name )
			return $user_id;
	    return $value;
	}
}
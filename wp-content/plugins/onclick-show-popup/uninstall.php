<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

delete_option('OnclickShowPopup_widget');
delete_option('OnclickShowPopup_random');
delete_option('OnclickShowPopup_theme');
delete_option('OnclickShowPopup_title');
delete_option('OnclickShowPopup_title_yes');
 
// for site options in Multisite
delete_site_option('OnclickShowPopup_widget');
delete_site_option('OnclickShowPopup_random');
delete_site_option('OnclickShowPopup_theme');
delete_site_option('OnclickShowPopup_title');
delete_site_option('OnclickShowPopup_title_yes');

global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}onclick_show_popup");
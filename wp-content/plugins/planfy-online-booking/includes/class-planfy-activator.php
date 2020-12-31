<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.planfy.com
 * @since      1.0.0
 *
 * @package    Planfy
 * @subpackage Planfy/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Planfy
 * @subpackage Planfy/includes
 * @author     Planfy <info@planfy.com>
 */
class Planfy_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('planfy_just_activated', 'yes');
	}

}

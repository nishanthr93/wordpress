<?php

/**
 *
 * @link              https://www.planfy.com
 * @package           Planfy
 *
 * @wordpress-plugin
 * Plugin Name:       Online Booking System - Planfy
 * Plugin URI:        https://en-gb.wordpress.org/plugins/planfy/
 * Description:       Allow customers to book your services and classes online. Automated SMS Reminders, Online Payments and More.
 * Version:           0.1.3
 * Author:            Planfy
 * Author URI:        https://www.planfy.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       planfy
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-planfy-activator.php
 */
function activate_planfy() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-planfy-activator.php';
	Planfy_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-planfy-deactivator.php
 */
function deactivate_planfy() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-planfy-deactivator.php';
	Planfy_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_planfy' );
register_deactivation_hook( __FILE__, 'deactivate_planfy' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-planfy.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_planfy() {

	$plugin = new Planfy();
	$plugin->run();

}
run_planfy();

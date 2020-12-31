<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.planfy.com
 * @since      1.0.0
 *
 * @package    Planfy
 * @subpackage Planfy/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Planfy
 * @subpackage Planfy/admin
 * @author     Planfy <info@planfy.com>
 */
class Planfy_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Planfy_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Planfy_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/planfy-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Planfy_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Planfy_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/planfy-admin.js', array( 'jquery' ), $this->version, false );

	}

	protected function get_dashboard_url(){
		return 'https://www.planfy.com/portal?account='.get_option('planfy_account_url');
	}

    public function planfy_menu(){
        add_menu_page( 'Planfy Online Booking', 'Online Booking', 'manage_options', 'planfy', array($this,'planfy_init'), null, 57);
    }

	public function planfy_admin_init(){
		if(get_option('planfy_just_activated') == 'yes'){
			delete_option('planfy_just_activated');
			exit(wp_redirect(admin_url('admin.php?page=planfy')));
		}
	}

    public function planfy_init(){
		if(get_option('planfy_account_id') > 0){
			$this->planfy_installed();
		}
		else
		{
			$this->planfy_install();
		}
    }

	public function planfy_install(){
		$dashboardUrl = $this->get_dashboard_url();

        include 'partials/install.php';
	}

	public function planfy_installed(){

        include 'partials/installed.php';
	}

	public function planfy_admin_install(){
		update_option('planfy_account_id', $_REQUEST['planfy_account_id']);
		update_option('planfy_account_url', $_REQUEST['planfy_account_url']);
		update_option('planfy_account_name', $_REQUEST['planfy_account_name']);
		update_option('planfy_installed', time());

		exit(wp_redirect(admin_url('admin.php?page=planfy')));
	}

	public function planfy_admin_uninstall(){
		delete_option('planfy_account_id');
		delete_option('planfy_account_url');
		delete_option('planfy_account_name');
		delete_option('planfy_installed');
		exit(wp_redirect(admin_url('admin.php?page=planfy')));
	}
}

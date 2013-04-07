<?php
/**
 * @package Admin
 */

/**
 * Class that holds most of the admin functionality.
 */
class WPBootstrap_AdminInit {

	public function __construct() {

		if ( !defined('WPBOOTSTRAP_ADMINTPL') )
			define( 'WPBOOTSTRAP_ADMINTPL', plugin_dir_path( __FILE__ ) . 'templates/' );

		add_action('admin_menu', array( $this, 'menu') );
	}

	/**
	* Initalizes the plugin's menu
	*/
	public function menu() {
		add_menu_page('Plugin name', 'Plugin name', 'administrator', 'wp-bootstrap', array( $this, 'viewAll') );
		add_submenu_page('wp-bootstrap', 'Add new', 'Add new', 'administrator', 'wp-bootstrap-add', array( $this, 'addNew'));
	}

	protected function tpl( $tplFile ) {
		include WPBOOTSTRAP_ADMINTPL . $tplFile;
	}

	/**
	* Defines the list
	*/
	public function viewAll() {
		$this->tpl( "list.phtml" );
	}

	/**
	* Defines the add new functionality
	*/
	public function addNew() {
		echo "<h1>Add</h1>";
	}
}

// Globalize the var first as it's needed globally.
global $wpbootstrapAdmin;
$wpbootstrapAdmin = new WPBootstrap_AdminInit();
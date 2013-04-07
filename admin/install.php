<?php
/**
 * @package Admin
 */

/**
 * Class that holds the configuration of the installation for the plugin.
 */
class WPBoostrap_Install {

	protected $db;
	protected $dbVersion = '0.1.0';
	protected $table     = 'tablename';
	protected $optName   = 'wp_bootstrap_db_version';

	public function __construct() {
		global $wpdb;
		$this->db = $wpdb;
		// If the plugin isn't still active, here are activation hooks
		register_activation_hook(__FILE__, array( $this, 'setSchema' ));
		register_activation_hook(__FILE__, array( $this, 'setFixtures' ));

		add_action('plugins_loaded', array( $this, 'updateCheck' ));

	}

	public function updateCheck() {
	    if ( get_option($this->optName) != $this->dbVersion ) {
	        $this->setSchema();
	    }
	}

	public function setSchema() {
		// To update the table schema, edit the query below
		$this->table = $this->db->prefix . $this->table;
		  
		$sql = "CREATE TABLE " . $this->table . " (
			id int(11) NOT NULL AUTO_INCREMENT,
			name VARCHAR(50) NOT NULL,
			text text NOT NULL,
			slug VARCHAR(50) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id),
			INDEX name_idx (name),
			INDEX slug_idx (slug)
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		update_option($this->optName, $this->dbVersion);
	}

	public function setFixtures() {}
}

// Globalize the var first as it's needed globally.
global $wpboostrapConfig;
$wpboostrapConfig = new WPBoostrap_Install();
<?php
/*
Plugin Name: wp-plugin-bootstrap
Plugin URI: https://github.com/acarbone/wp-plugin-bootstrap
Description: Simple WP bootstrap to create a new WP plugin.
Author: Alessandro Carbone
Version: 0.1
Author URI: http://www.artera.it
*/

//Autoloader
function WBAutoloader( $classname ) {
	$filename = str_replace("\\", "/", __DIR__ . "/lib/$classname.php");

	if ( file_exists( $filename ) )
		include_once $filename;
}
spl_autoload_register('WBAutoloader');

require 'admin/install.php';

function wpBoostrapInit() {
	require 'admin/init.php';
}

if ( is_admin() ) {
	if ( defined('DOING_AJAX') && DOING_AJAX ) {
		//Do some ajax stuff.
	} else {
		add_action( 'plugins_loaded', 'wpBoostrapInit', 0 );
	}
}

require_once "WBInit.php";
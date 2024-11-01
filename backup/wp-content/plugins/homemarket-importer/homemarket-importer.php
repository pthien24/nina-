<?php
/*
Plugin Name: Homemarket Importer
Plugin URI: http://soaptheme.net/wordpress/homemarket/plugins/importer
Description: Shortcodes for Homemarket Wordpress Theme.
Version: 1.0
Author: SoapTheme
Author URI: http://soaptheme.net/wordpress/homemarket/plugins/importer
*/

if (!defined('ABSPATH'))
    die('-1');

define('HOMEMARKET_IMPORTER_URL', dirname(__FILE__));
define('HOMEMARKET_IMPORTER_PATH', dirname(__FILE__) . '/includes/');

class HomemarketImporterClass {
	function __construct() {

		// Init plugins
        add_action( 'init', array( $this, 'initPlugin' ) );

	}

	function initPlugin() {
		//Load plugin textdomain.
		load_plugin_textdomain( 'homemarket', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		include HOMEMARKET_IMPORTER_PATH . 'importer.php';
	}
}

// Finally initialize code
new HomemarketImporterClass();

?>
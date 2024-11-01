<?php
/*
Plugin Name: Homemarket Shortcodes
Plugin URI: http://soaptheme.net/wordpress/homemarket/plugins/shortcodes
Description: Shortcodes for Homemarket Wordpress Theme.
Version: 1.0
Author: SoapTheme
Author URI: http://soaptheme.net/wordpress/homemarket/plugins/shortcodes
*/

if (!defined('ABSPATH'))
    die('-1');

define('HOMEMARKET_SHORTCODE_URL', dirname(__FILE__));
define('HOMEMARKET_SHORTCODE_PATH', dirname(__FILE__) . '/shortcode_templates/');

class HomemarketShortcodeClass {
	function __construct() {
		add_action( 'init', array( $this, 'shortcode_init' ), 20 );
		add_filter( 'widget_text', 'do_shortcode' );
		require_once HOMEMARKET_SHORTCODE_URL . '/shortcode-generator.php';

		//Load plugin textdomain.
		load_plugin_textdomain( 'homemarket', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	function shortcode_init() {
		require_once HOMEMARKET_SHORTCODE_PATH . 'shortcodes.php';
	}


}

new HomemarketShortcodeClass();

?>
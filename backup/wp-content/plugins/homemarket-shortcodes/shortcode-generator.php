<?php

/*==========================================================
			Add Shortcode Generator Button
==========================================================*/
class HomemarketShortcodeGenerator {

	function __construct() {
		require_once HOMEMARKET_SHORTCODE_PATH . 'shortcodes.php';
		$homemarket_shortcodes = new HomemarketShortcodes();
		add_action( 'init', array( $this, 'init' ) );
	}

	function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
            return;
        }
	}

}

$homemarket_shortcodes = new HomemarketShortcodeGenerator();

?>
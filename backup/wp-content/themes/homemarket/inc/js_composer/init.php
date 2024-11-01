<?php

/* Initialize Visual Composer */

if ( class_exists('Vc_Manager', false) ) {
	add_action('vc_before_init', 'homemarket_vcSetAsTheme');

	function homemarket_vcSetAsTheme() {
		vc_set_as_theme(true);
	}

	if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
		//
	}

	if ( function_exists( 'vc_disable_frontend' ) ) :
		vc_disable_frontend();
	endif;
	
	add_action('vc_before_init', 'homemarket_load_js_composer');

	function homemarket_load_js_composer() {
		require_once get_parent_theme_file_path( 'inc/js_composer/js_composer.php' );
	}

	if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
		vc_set_shortcodes_templates_dir( get_template_directory() . '/inc/js_composer/vc_templates' );
	}
}
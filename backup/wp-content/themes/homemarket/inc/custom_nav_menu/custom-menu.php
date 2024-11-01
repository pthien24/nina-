<?php

class rc_sweet_custom_menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	function __construct() {
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'rc_scm_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'rc_scm_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'rc_scm_edit_walker'), 10, 2 );

	} // end constructor
	
	
	function rc_scm_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->background_url = get_post_meta( $menu_item->ID, '_menu_item_background_url', true );
	    $menu_item->background_option = get_post_meta( $menu_item->ID, '_menu_item_background_option', true );
	    $menu_item->background_width = get_post_meta( $menu_item->ID, '_menu_item_background_width', true );
	    $menu_item->background_repeat = get_post_meta( $menu_item->ID, '_menu_item_background_repeat', true );
	    $menu_item->background_size = get_post_meta( $menu_item->ID, '_menu_item_background_size', true );
	    $menu_item->background_position = get_post_meta( $menu_item->ID, '_menu_item_background_position', true );
	    $menu_item->custom_content = get_post_meta( $menu_item->ID, '_menu_item_custom_content', true );
	    $menu_item->label_hidden = get_post_meta( $menu_item->ID, '_menu_item_label_option', true );
	    $menu_item->menu_view = get_post_meta( $menu_item->ID, '_menu_view_mode', true );
	    $menu_item->menu_marker = get_post_meta( $menu_item->ID, '_menu_item_marker', true );
	    $menu_item->collection_icon = get_post_meta( $menu_item->ID, '_collection_menu_icon', true );
	    $menu_item->featured_img = get_post_meta( $menu_item->ID, '_menu_item_featured_img', true );
	    return $menu_item;
	    
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
	    if ( isset( $_REQUEST['menu_item_label_option'][$menu_item_db_id] ) ) {
	    	update_post_meta( $menu_item_db_id, '_menu_item_label_option', 'checked' );
	    } else {
	    	delete_post_meta( $menu_item_db_id, '_menu_item_label_option' );
	    }

	    if ( isset( $_REQUEST['menu_item_background_option'][$menu_item_db_id] ) ) {
	    	update_post_meta( $menu_item_db_id, '_menu_item_background_option', 'checked' );
	    } else {
	    	delete_post_meta( $menu_item_db_id, '_menu_item_background_option' );
	    }

	    if ( !empty( $_REQUEST['menu_item_background_url'][$menu_item_db_id] ) ) {
	        $background_url_value = $_REQUEST['menu_item_background_url'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_background_url', $background_url_value );
	    } else {
	    	delete_post_meta( $menu_item_db_id, '_menu_item_background_url' );
	    }

	    if ( isset( $_REQUEST['menu_item_background_width'][$menu_item_db_id] ) ) {
	    	update_post_meta( $menu_item_db_id, '_menu_item_background_width', 'checked' );
	    } else {
	    	delete_post_meta( $menu_item_db_id, '_menu_item_background_width' );
	    }

	    if ( isset( $_REQUEST['menu_item_background_repeat'][$menu_item_db_id] ) ) {
	        $background_repeat_value = $_REQUEST['menu_item_background_repeat'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_background_repeat', $background_repeat_value );
	    }

	    if ( isset( $_REQUEST['menu_item_background_size'][$menu_item_db_id] ) ) {
	        $background_size_value = $_REQUEST['menu_item_background_size'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_background_size', $background_size_value );
	    }

	    if ( isset( $_REQUEST['menu_item_background_position'][$menu_item_db_id] ) ) {
	        $background_position_value = $_REQUEST['menu_item_background_position'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_background_position', $background_position_value );
	    }

        if ( !empty( $_REQUEST['menu_item_custom_content']) ) {
	        $custom_content_value = $_REQUEST['menu_item_custom_content'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_custom_content', $custom_content_value );
	    }

	    if ( !empty( $_REQUEST['collection_menu_icon']) ) {
	        $collection_icon_value = $_REQUEST['collection_menu_icon'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_collection_menu_icon', $collection_icon_value );
	    }

	    if ( !empty( $_REQUEST['menu_item_featured_img']) ) {
	        $featured_img_value = $_REQUEST['menu_item_featured_img'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_featured_img', $featured_img_value );
	    }

	    if ( isset( $_REQUEST['menu_item_marker'][$menu_item_db_id] ) ) {
		    $menu_marker_value = $_REQUEST['menu_item_marker'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_marker', $menu_marker_value );
	    }

	    if ( isset( $_REQUEST['menu_view_mode'][$menu_item_db_id] ) ) {
		    $menu_view_mode_value = $_REQUEST['menu_view_mode'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_view_mode', $menu_view_mode_value );
	    }
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_scm_edit_walker($walker,$menu_id) {
	
	    return 'Walker_Nav_Menu_Edit_Custom';
	    
	}

}

// instantiate plugin's class
$GLOBALS['sweet_custom_menu'] = new rc_sweet_custom_menu();


include_once( get_parent_theme_file_path('inc/custom_nav_menu/edit-custom-walker.php') );
include_once( get_parent_theme_file_path('inc/custom_nav_menu/custom-walker.php') );
include_once( get_parent_theme_file_path('inc/custom_nav_menu/custom-walker-collection.php') );
<?php

defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

// add import ajax actions
add_action( 'wp_ajax_homemarket_reset_menus', 'homemarket_reset_menus' );
add_action( 'wp_ajax_homemarket_reset_widgets', 'homemarket_reset_widgets' );
add_action( 'wp_ajax_homemarket_import_dummy', 'homemarket_import_dummy' );
add_action( 'wp_ajax_homemarket_import_widgets', 'homemarket_import_widgets' );
add_action( 'wp_ajax_homemarket_import_options', 'homemarket_import_options' );

function homemarket_reset_menus() {
    if ( current_user_can( 'manage_options' ) ) {
        
        $menus = array('Main Navigation', 'Collections Navigation', 'Footer Menu Navigation');
        
        foreach ($menus as $menu) {
            wp_delete_nav_menu($menu);
        }
        echo __('Successfully reset menus!', 'homemarket');
    }
    die;
}

function homemarket_reset_widgets() {
    if ( current_user_can( 'manage_options' ) ) {
        ob_start();
        $sidebars_widgets = retrieve_widgets();
        foreach ($sidebars_widgets as $area => $widgets) {
            foreach ( $widgets as $key => $widget_id ) {
                $pieces = explode( '-', $widget_id );
                $multi_number = array_pop( $pieces );
                $id_base = implode( '-', $pieces );
                $widget = get_option( 'widget_' . $id_base );
                unset( $widget[$multi_number] );
                update_option( 'widget_' . $id_base, $widget );
                unset( $sidebars_widgets[$area][$key] );
            }
        }
        wp_set_sidebars_widgets( $sidebars_widgets );
        ob_clean();
        ob_end_clean();
        echo __('Successfully reset widgets!', 'homemarket');
    }
    die;
}

function homemarket_import_dummy() {
    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers

    if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
        $wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        include $wp_importer;
    }

    if ( ! class_exists('HOMEMARKET_WP_Import') ) { // if WP importer doesn't exist
        $wp_import = HOMEMARKET_IMPORTER_URL.'/includes/homemarket-wordpress-importer.php';
        include $wp_import;
    }

    if ( current_user_can( 'manage_options' ) && class_exists( 'WP_Importer' ) && class_exists( 'HOMEMARKET_WP_Import' ) ) { // check for main import class and wp import class
    
        $process = (isset($_POST['process']) && $_POST['process']) ? $_POST['process'] : 'import_start';
        $demo = (isset($_POST['demo']) && $_POST['demo']) ? $_POST['demo'] : 'landing';
        $index = (isset($_POST['index']) && $_POST['index']) ? $_POST['index'] : 0;

        $importer = new HOMEMARKET_WP_Import();
        $theme_xml = HOMEMARKET_IMPORTER_URL.'/includes/data/' . $demo . '/content.gz';
        $importer->fetch_attachments = true;

        if ( $process == 'import_start' ) {
            // update visual composer content types
            update_option( 'wpb_js_content_types', array('post', 'page') );
        }

        // @ini_set('max_execution_time', '10000');
        // @ini_set('memory_limit', '256M');

        $loop = (int)(ini_get('max_execution_time') / 60);
        if ($loop < 1) $loop = 1;
        if ($loop > 10) $loop = 10;
        $i = 0;
        while ($i < $loop) {
            $response = $importer->import($theme_xml, $process, $index);
            if (isset($response['count']) && isset($response['index']) && $response['count'] && $response['index'] && $response['index'] < $response['count']) {
                $i++;
                $index = $response['index'];
            } else {
                break;
            }
        }
        echo json_encode($response);
        ob_start();
        if ( $response['process'] == 'complete' ) {
            // Set woocommerce pages
            $woopages = array(
                'woocommerce_shop_page_id' => 'Shop',
                'woocommerce_cart_page_id' => 'Cart',
                'woocommerce_checkout_page_id' => 'Checkout',
                'woocommerce_myaccount_page_id' => 'My Account'
            );
            foreach ($woopages as $woo_page_name => $woo_page_title) {
                $woopage = get_page_by_title( $woo_page_title );
                if (isset($woopage) && $woopage->ID) {
                    update_option($woo_page_name, $woopage->ID); // Front Page
                }
            }

            // We no longer need to install pages
            $notices = array_diff( get_option( 'woocommerce_admin_notices', array() ), array( 'install', 'update' ) );
            update_option( 'woocommerce_admin_notices', $notices );
            delete_option( '_wc_needs_pages' );
            delete_transient( '_wc_activation_redirect' );

            // Set imported menus to registered theme locations
            $locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
            $menus = wp_get_nav_menus(); // registered menus

            if ($menus) {
                foreach($menus as $menu) { // assign menus to theme locations
                    if( $menu->name == 'Main Navigation' ) {
                        $locations['main-navigation'] = $menu->term_id;
                    } else if( $menu->name == 'Collections Navigation' ) {
                        $locations['collections-navigation'] = $menu->term_id;
                    } else if( $menu->name == 'Footer Menu' ) {
                        $locations['footer-navigation'] = $menu->term_id;
                    } 
                }
            }

            set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations

            // Set reading options
            $homepage = get_page_by_title( 'HOME-1' );
            $posts_page = get_page_by_title( 'BLOG' );
          
            if (($homepage && $homepage->ID) || ($posts_page && $posts_page->ID)) {
                update_option('show_on_front', 'page');
                if ($homepage && $homepage->ID) {
                    update_option('page_on_front', $homepage->ID); // Front Page
                }
                if ($posts_page && $posts_page->ID) {
                    update_option('page_for_posts', $posts_page->ID); // Blog Page
                }
            }

            // Flush rules after install
            flush_rewrite_rules();
        }
        ob_end_clean();
    }
    die();
}

function homemarket_import_widgets() {
    if ( current_user_can( 'manage_options' ) ) {
        $demo = (isset($_POST['demo']) && $_POST['demo']) ? $_POST['demo'] : 'landing';
        // Import widgets
        ob_start();
        include(HOMEMARKET_IMPORTER_URL . '/includes/data/' . $demo . '/widget_data.json');
        $widget_data = ob_get_clean();

        homemarket_import_widget_data( $widget_data );
        echo __('Successfully imported widgets!', 'homemarket');
    }
    die();
}

function homemarket_import_options() {
    if ( current_user_can( 'manage_options' ) ) {
        $demo = (isset($_POST['demo']) && $_POST['demo']) ? $_POST['demo'] : 'landing';

        ob_start();
        include(HOMEMARKET_IMPORTER_URL . '/includes/data/' . $demo . '/theme_options.php');
        $theme_options = ob_get_clean();

        ob_start();
        $options = json_decode($theme_options, true);
        $redux = ReduxFrameworkInstances::get_instance('homemarket_theme_options');
        $redux->set_options($options);
        ob_clean();
        ob_end_clean();

        echo __('Successfully imported theme options!', 'homemarket');

    }
    die();
}


// Parsing Widgets Function
// Reference: http://wordpress.org/plugins/widget-settings-importexport/
function homemarket_import_widget_data( $widget_data ) {
    $json_data = $widget_data;
    $json_data = json_decode( $json_data, true );

    $sidebar_data = $json_data[0];
    $widget_data = $json_data[1];

    foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
        $widgets[ $widget_data_title ] = '';
        foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
            if( is_int( $widget_data_key ) ) {
                $widgets[$widget_data_title][$widget_data_key] = 'on';
            }
        }
    }
    unset($widgets[""]);

    foreach ( $sidebar_data as $title => $sidebar ) {
        $count = count( $sidebar );
        for ( $i = 0; $i < $count; $i++ ) {
            $widget = array( );
            $widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
            $widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
            if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
                unset( $sidebar_data[$title][$i] );
            }
        }
        $sidebar_data[$title] = array_values( $sidebar_data[$title] );
    }

    foreach ( $widgets as $widget_title => $widget_value ) {
        foreach ( $widget_value as $widget_key => $widget_value ) {
            $widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
        }
    }

    $sidebar_data = array( array_filter( $sidebar_data ), $widgets );
    homemarket_parse_import_data( $sidebar_data );
}

function homemarket_parse_import_data( $import_array ) {
    global $wp_registered_sidebars;
    $sidebars_data = $import_array[0];
    $widget_data = $import_array[1];
    $current_sidebars = get_option( 'sidebars_widgets' );
    $new_widgets = array( );

    foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

        foreach ( $import_widgets as $import_widget ) :
            //if the sidebar exists
            if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
                $title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
                $index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
                $current_widget_data = get_option( 'widget_' . $title );
                $new_widget_name = homemarket_get_new_widget_name( $title, $index );
                $new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

                if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
                    while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
                        $new_index++;
                    }
                }
                $current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
                if ( array_key_exists( $title, $new_widgets ) ) {
                    $new_widgets[$title][$new_index] = $widget_data[$title][$index];
                    $multiwidget = $new_widgets[$title]['_multiwidget'];
                    unset( $new_widgets[$title]['_multiwidget'] );
                    $new_widgets[$title]['_multiwidget'] = $multiwidget;
                } else {
                    $current_widget_data[$new_index] = $widget_data[$title][$index];
                    $current_multiwidget = (isset($current_widget_data['_multiwidget']))?$current_widget_data['_multiwidget']:'';
                    $new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
                    $multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
                    unset( $current_widget_data['_multiwidget'] );
                    $current_widget_data['_multiwidget'] = $multiwidget;
                    $new_widgets[$title] = $current_widget_data;
                }

            endif;
        endforeach;
    endforeach;

    if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
        update_option( 'sidebars_widgets', $current_sidebars );

        foreach ( $new_widgets as $title => $content )
            update_option( 'widget_' . $title, $content );

        return true;
    }

    return false;
}

function homemarket_get_new_widget_name( $widget_name, $widget_index ) {
    $current_sidebars = get_option( 'sidebars_widgets' );
    $all_widget_array = array( );
    foreach ( $current_sidebars as $sidebar => $widgets ) {
        if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
            foreach ( $widgets as $widget ) {
                $all_widget_array[] = $widget;
            }
        }
    }
    while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
        $widget_index++;
    }
    $new_widget_name = $widget_name . '-' . $widget_index;
    return $new_widget_name;
}
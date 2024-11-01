<?php 

if( ! class_exists('Homemarket_Admin_Pages') ) {

	class Homemarket_Admin_Pages {
		// ===========================================
		// Construct
		// ===========================================

		public function __construct() {

        	add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action('admin_menu', array( $this, 'homemarket_theme_admin_menu' ));
			add_action('admin_menu', array( $this, 'homemarket_marker_menu' ));
			add_action( 'after_switch_theme', array( $this, 'activation_redirect' ) );
		}

	    public function admin_init() {

	        if ( current_user_can( 'edit_theme_options' ) ) {
	            if ( isset( $_GET['homemarket-deactivate'] ) && 'deactivate-plugin' == $_GET['homemarket-deactivate'] ) {
	                check_admin_referer( 'homemarket-deactivate', 'homemarket-deactivate-nonce' );

	                $plugins = TGM_Plugin_Activation::$instance->plugins;

	                foreach ( $plugins as $plugin ) {
	                    if ( $plugin['slug'] == $_GET['plugin'] ) {
	                        deactivate_plugins( $plugin['file_path'] );
	                    }
	                }
	            } if ( isset( $_GET['homemarket-activate'] ) && 'activate-plugin' == $_GET['homemarket-activate'] ) {
	                check_admin_referer( 'homemarket-activate', 'homemarket-activate-nonce' );

	                $plugins = TGM_Plugin_Activation::$instance->plugins;

	                foreach ( $plugins as $plugin ) {
	                    if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
	                        activate_plugin( $plugin['file_path'] );

	                        wp_redirect( admin_url( 'admin.php?page=homemarket_theme' ) );
	                        exit;
	                    }
	                }
	            }
	        }
	    }

	    function activation_redirect() {
	    	if ( current_user_can( 'edit_theme_options' ) ) {
	            header( 'Location:' . admin_url() . 'admin.php?page=homemarket_theme' );
	        }
	    }

		function homemarket_theme_admin_menu() {
			$homemarket_menu_index = add_menu_page(
				homemarket_parent_theme_name(),
				homemarket_parent_theme_name(),
				'administrator',
				'homemarket_theme',
				array( $this, 'homemarket_theme_welcome_page'),
				'dashicons-cart',
				3
			);
		}

		function homemarket_theme_welcome_page() { 
			require_once get_parent_theme_file_path( 'inc/admin/homemarket_welcome.php' );
		}

		function homemarket_marker_menu() {
			$menu_marker_url =  add_submenu_page(
				'homemarket_theme',
				__('Menu Marker', 'homemarket'),
				__('Menu Marker', 'homemarket'),
				'administrator',
				'menu_marker',
				array( $this, 'homemarket_theme_menu_marker_page')
			);
		}

		function homemarket_theme_menu_marker_page() {
			require_once get_parent_theme_file_path( 'inc/admin/menu_marker.php' );
		}

		public function plugin_link( $item ) {
			$installed_plugins = get_plugins();

			$item['sanitized_plugin'] = $item['name'];

			$actions = array();

			// We have a repo plugin
			if ( ! $item['version'] ) {
				$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
			}

			/** We need to display the 'Install' hover link */
			if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
				$actions = array(
					'install' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
						esc_url( wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-install' => 'install-plugin',
									'return_url'    => 'homemarket_theme',
								),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
							),
							'tgmpa-install',
							'tgmpa-nonce'
						) ),
						$item['sanitized_plugin']
					),
				);
			}
			/** We need to display the 'Activate' hover link */
			elseif ( is_plugin_inactive( $item['file_path'] ) ) {
				$actions = array(
					'activate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
						esc_url( add_query_arg(
							array(
								'plugin'               => urlencode( $item['slug'] ),
								'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
								'plugin_source'        => urlencode( $item['source'] ),
								'homemarket-activate'       => 'activate-plugin',
								'homemarket-activate-nonce' => wp_create_nonce( 'homemarket-activate' ),
							),
							admin_url( 'admin.php?page=homemarket_theme' )
						) ),
						$item['sanitized_plugin']
					),
				);
			}
			/** We need to display the 'Update' hover link */
			elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
				$actions = array(
					'update' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Install %2$s">Update</a>',
						wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									'tgmpa-update'  => 'update-plugin',
									'plugin_source' => urlencode( $item['source'] ),
									'version'       => urlencode( $item['version'] ),
									'return_url'    => 'homemarket_theme',
								),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
							),
							'tgmpa-update',
							'tgmpa-nonce'
						),
						$item['sanitized_plugin']
					),
				);
			} elseif ( is_plugin_active( $item['file_path'] ) ) {
				$actions = array(
					'deactivate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>',
						esc_url( add_query_arg(
							array(
								'plugin'                 => urlencode( $item['slug'] ),
								'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
								'plugin_source'          => urlencode( $item['source'] ),
								'homemarket-deactivate'       => 'deactivate-plugin',
								'homemarket-deactivate-nonce' => wp_create_nonce( 'homemarket-deactivate' ),
							),
							admin_url( 'admin.php?page=homemarket_theme' )
						) ),
						$item['sanitized_plugin']
					),
				);
			}

			return $actions;
		}

	}

	new Homemarket_Admin_Pages;

}

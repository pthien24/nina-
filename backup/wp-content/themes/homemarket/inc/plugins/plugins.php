<?php

/**********************/
/* Wordpress Importer */
/**********************/

// include HM_PLUGINS . '/importer/importer.php';

/*************************/
/* TGM Plugin Activation */
/*************************/
$plugin = get_template_directory() . '/inc/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php';
if ( ! class_exists( 'TGM_Plugin_Activation' ) ) { require_once $plugin; }
add_action( 'tgmpa_register', 'homemarket_register_required_plugins' );

function homemarket_register_required_plugins() {

	// disable visual composer automatic update
	global $vc_manager;
	if ( $vc_manager ) {
		$vc_updater = $vc_manager->updater();
		if ( $vc_updater ) {
			remove_filter('upgrader_pre_download', array(&$vc_updater, 'upgradeFilterFromEnvato'));
            remove_filter('upgrader_pre_download', array(&$vc_updater, 'preUpgradeFilter'));
            remove_action('wp_ajax_nopriv_vc_check_license_key', array(&$vc_updater, 'checkLicenseKeyFromRemote'));
		}
	}

	/**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */

	$plugins = array(
        array(
            'name'                     => 'Redux Framework',
            'slug'                     => 'redux-framework',
            'required'                 => true,
            'image_url'                => HM_PLUGINS_URI . '/images/redux_options.png'
        ),
		array(
			'name'                     => 'WPBakery Visual Composer',
            'slug'                     => 'js_composer',
            'source'                   => HM_PLUGINS . '/js_composer.zip',
            'required'                 => true,
            'version'                  => '4.12.1',
            'image_url'                => HM_PLUGINS_URI . '/images/visual_composer.png'
		),
        array(
            'name'                     => 'Homemarket Importer',
            'slug'                     => 'homemarket-importer',
            'source'                   => HM_PLUGINS . '/homemarket-importer.zip',
            'required'                 => true,
            'version'                  => '1.0',
            'image_url'                => HM_PLUGINS_URI . '/images/homemarket-importer.png'
        ),
        array(
            'name'                     => 'Homemarket Shortcodes',
            'slug'                     => 'homemarket-shortcodes',
            'source'                   => HM_PLUGINS . '/homemarket-shortcodes.zip',
            'required'                 => true,
            'version'                  => '1.0',
            'image_url'                => HM_PLUGINS_URI . '/images/homemarket-shortcodes.png'
        ),
        array(
            'name'                     => 'Homemarket Taxonomies',
            'slug'                     => 'homemarket-taxonomies',
            'source'                   => HM_PLUGINS . '/homemarket-taxonomies.zip',
            'required'                 => true,
            'version'                  => '1.0',
            'image_url'                => HM_PLUGINS_URI . '/images/homemarket-taxonomies.png'
        ),
		array(
            'name'                     => 'Contact Form 7',
            'slug'                     => 'contact-form-7',
            'required'                 => true,
            'image_url'                => HM_PLUGINS_URI . '/images/contact_form_7.png'
        ),
        array(
            'name'                     => 'Woocommerce',
            'slug'                     => 'woocommerce',
            'required'                 => true,
            'image_url'                => HM_PLUGINS_URI . '/images/woocommerce.png'
        ),
        array(
            'name'                     => 'Regenerate Thumbnails',
            'slug'                     => 'regenerate-thumbnails',
            'required'                 => false,
            'image_url'                => HM_PLUGINS_URI . '/images/regenerate_thumbnails.png'
        ),
        array(
            'name'                     => 'Yith Woocommerce Wishlist',
            'slug'                     => 'yith-woocommerce-wishlist',
            'required'                 => true,
            'image_url'                => HM_PLUGINS_URI . '/images/yith_wishlist.png'
        ),
        array(
            'name'                     => 'Yith Woocommerce Ajax Product Filter',
            'slug'                     => 'yith-woocommerce-ajax-navigation',
            'required'                 => true,
            'image_url'                => HM_PLUGINS_URI . '/images/yith_ajax_filter.png'
        ),
        array(
            'name'                     => 'Yith Woocommerce Ajax Search',
            'slug'                     => 'yith-woocommerce-ajax-search',
            'required'                 => true,
            'image_url'                => HM_PLUGINS_URI . '/images/yith_ajax_search.png'
        ),
        array(
            'name'                     => 'MailPoet Newsletters',
            'slug'                     => 'wysija-newsletters',
            'required'                 => false,
            'image_url'                => HM_PLUGINS_URI . '/images/mailpoet_newsletter.png'
        ),
	);

	/**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.0
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
	$config = array(
        'domain'               => 'homemarket',          // Text domain - likely want to be the same as your theme.
        'default_path'         => '',                          // Default absolute path to pre-packaged plugins
        'menu'                 => 'install-required-plugins',  // Menu slug
        'has_notices'          => true,                        // Show admin notices or not
        'is_automatic'         => true,                       // Automatically activate plugins after installation or not
        'message'              => '',                          // Message to output right before the plugins table
        'strings'              => array(
            'page_title'                               => __( 'Install Required Plugins', 'homemarket' ),
            'menu_title'                               => __( 'Install Plugins', 'homemarket' ),
            'installing'                               => __( 'Installing Plugin: %s', 'homemarket' ), // %1$s = plugin name
            'oops'                                     => __( 'Something went wrong with the plugin API.', 'homemarket' ),
            'notice_can_install_required'              => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'homemarket' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'           => '',
            'notice_cannot_install'                    => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'homemarket' ), // %1$s = plugin name(s)
            'notice_can_activate_required'             => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'homemarket' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'          => '',
            'notice_cannot_activate'                   => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'homemarket' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                     => '',
            'notice_cannot_update'                     => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'homemarket' ), // %1$s = plugin name(s)
            'install_link'                             => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'homemarket' ),
            'activate_link'                            => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'homemarket' ),
            'return'                                   => __( 'Return to Required Plugins Installer', 'homemarket' ),
            'plugin_activated'                         => __( 'Plugin activated successfully.', 'homemarket' ),
            'complete'                                 => __( 'All plugins installed and activated successfully. %s', 'homemarket' ), // %1$s = dashboard link
            'nag_type'                                 => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'homemarket_vc_set_as_theme' );
function homemarket_vc_set_as_theme() {
    if (function_exists('vc_set_as_theme'))
        vc_set_as_theme();
}

if (!function_exists('is_plugin_activate'))
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if ( class_exists( 'WooCommerce' ) ) :
    add_action( 'admin_init', 'homemarket_include_woo_templates' );

    function homemarket_include_woo_templates() {
        include_once( WC()->plugin_path() . '/includes/wc-template-functions.php' );
    }
endif;
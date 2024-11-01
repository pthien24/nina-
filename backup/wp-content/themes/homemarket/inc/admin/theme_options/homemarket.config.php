<?php

	
    /* ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/ */

    if ( ! class_exists( 'Redux' ) ) {
    	return;
    }

    //HomeMarket theme option name. In there, all of the Redux data is stored
    $hto_name = "homemarket_theme_options";

    //hto_name replace
    $hto_name = 'homemarket_theme_options'; 

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $show_admin = false;
    $allow_submenu = true;
    $page_priority = null;
    $parent_page = 'homemarket_theme';
    $menu_title = __( 'Theme Options', 'homemarket');
    $menu_type = 'submenu';

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $hto_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => $menu_type,
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => $allow_submenu,
        // Show the sections below the admin menu item or not
        'menu_title'           => $menu_title,
        'page_title'           => esc_html__( 'Theme Options', 'homemarket' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => true,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => $show_admin,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => $page_priority,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => $parent_page,
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'theme_options',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'        => '&nbsp;',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,
        // REMOVE

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

	// Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        /* $args['intro_text'] = sprintf(); */
    } else {
        // $args['intro_text'] = __();
    }

    // Add content after the form.
    // $args['footer_text'] = __();

    Redux::setArgs( $hto_name, $args );	

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START SECTIONS
     */

    /*
        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for
     */

    // -> START Basic Fields

    Redux::setSection( $hto_name, array(
        'icon'      =>  'el el-website',
        'title'     =>  __('Site Skin & Settings', 'homemarket'),
        'fields'    =>  array(
            array(
                'id'            =>  'site_skin',
                'title'         =>  __('Site Skin Color', 'homemarket'),
                'type'          =>  'color',
                'default'       =>  '#fa5555',
                'transparent'   =>  false
            ),

            array(
                'id'            =>  'page_pre_load',
                'title'         =>  __('Page Pre-load Effect', 'homemarket'),
                'type'          =>  'button_set',
                'options'       =>  array(
                    'enable'    =>  __('Enable', 'homemarket'),
                    'disable'   =>  __('Disable', 'homemarket')
                ),
                'default'       =>  'enable'
            )
        )
    ) );

    Redux::setSection( $hto_name, array(
    	'icon'   => 'el el-website',
    	'title'  => __( 'Header Style & Layout', 'homemarket' ),
    	'fields' => array(

    		array(
    			'id'       => 'header_main_layout',
    			'type'     => 'image_select',
    			'title'    => __( 'Header Layout', 'homemarket' ),
    			'compiler' => true,
    			'options'  => array(
    				'1' => array(
    					'alt' => __( 'Layout1 normal', 'homemarket' ),
    					'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/header_normal.png',
    				),
    				'2' => array(
    					'alt' => __( 'Layout2 center', 'homemarket' ),
    					'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/header_center.png',
    				),
    				'3' => array(
    					'alt' => __( 'Layout3 right', 'homemarket' ),
    					'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/header_box.png',
    				),
    			),
    			'default' => '1'
    		),

    		array(
    			'id'    => 'main_menu_font_options',
    			'type'  => 'info',
    			'icon'  => 'fa fa-font',
    			'raw'   => __( '<h3>Font Settings</h3>', 'homemarket' )
    		),

    		array(
    			'id'            => 'main_menu_font_size',
    			'title'         => __( 'Main Menu Font Size', 'homemarket'),
    			'type'          => 'slider',
    			'max'           => 20,
    			'step'          => 1,
    			'min'           => 11,
    			'default'       => 14,
    			'display_value' => 'text'
    		),

    		array(
    			'id'          => 'main_menu_font_color',
    			'title'       => __( 'Main Menu Font Color', 'homemarket' ),
    			'type'        => 'color',
    			'default'     => '#ffffff',
    			'transparent' => false
    		),

    		array(
    			'id'          => 'main_menu_font_color_hover',
    			'title'       => __( 'Main Menu Hover Font Color', 'homemarket' ),
    			'type'        => 'color',
    			'default'     => '#ffffff',
    			'transparent' => false
    		),

            // array(
            //     'id'            => 'sub_menu_label_font_size',
            //     'title'         => __( 'Submenu Label Font Size', 'homemarket'),
            //     'type'          => 'slider',
            //     'max'           => 20,
            //     'step'          => 1,
            //     'min'           => 11,
            //     'default'       => 18,
            //     'display_value' => 'text'
            // ),

            // array(
            //     'id'          => 'sub_menu_label_font_color',
            //     'title'       => __( 'Submenu Label Font Color', 'homemarket' ),
            //     'type'        => 'color',
            //     'default'     => '#000000',
            //     'transparent' => false
            // ),

            array(
                'id'            => 'sub_menu_font_size',
                'title'         => __( 'Submenu Font Size', 'homemarket'),
                'type'          => 'slider',
                'max'           => 20,
                'step'          => 1,
                'min'           => 11,
                'default'       => 13,
                'display_value' => 'text'
            ),

            array(
                'id'          => 'sub_menu_font_color',
                'title'       => __( 'Submenu Font Color', 'homemarket' ),
                'type'        => 'color',
                'default'     => '#696969',
                'transparent' => false
            ),

    		array(
    			'id'  => 'header_spacing',
    			'type'  => 'info',
    			'icon'  => 'fa fa-sliders',
    			'raw'   => __( '<h3>Header Spacing</h3>', 'homemarket' )
    		),

    		array(
    			'id'            => 'logo_space_top',
    			'title'         => __( 'Spacing Logo Top', 'homemarket' ),
    			'type'          => 'slider',
    			'max'           => 100,
    			'min'           => 0,
    			'step'          => 1,
    			'default'       => 25,
    			'display_value' => 'text'
    		),

    		array(
    			'id'            => 'logo_space_bottom',
    			'title'         => __( 'Spacing Logo bottom', 'homemarket' ),
    			'type'          => 'slider',
    			'max'           => 100,
    			'min'           => 0,
    			'step'          => 1,
    			'default'       => 25,
    			'display_value' => 'text'
    		),

    		array(
    			'id'            => 'menubar_space_top',
    			'title'         => __( 'Spacing Menu Bar Top', 'homemarket' ),
    			'type'          => 'slider',
    			'max'           => 100,
    			'min'           => 0,
    			'step'          => 1,
    			'default'       => 14,
    			'display_value' => 'text'
    		),

    		array(
    			'id'            => 'menubar_space_bottom',
    			'title'         => __( 'Spacing Menu Bar Bottom', 'homemarket' ),
    			'type'          => 'slider',
    			'max'           => 100,
    			'min'           => 0,
    			'step'          => 1,
    			'default'       => 14,
    			'display_value' => 'text'
    		),

    		array(
    			'id'   => 'header_background_options',
    			'type' => 'info',
    			'icon' => 'fa fa-paint-brush',
    			'raw'  => __( '<h3>Header Background</h3>', 'homemarket' )
    		),

    		array(
    			'id'          => 'main_header_background',
    			'title'       => __( 'Header Background Color', 'homemarket' ),
    			'type'        => 'background',
    			'default'     => array(
    				'background-color' => '#ffffff',
    			),
    			'transparent' => true
    		),

    		array(
    			'id'          => 'main_menu_background',
    			'title'       => __( 'Menu Bar Background Color', 'homemarket' ),
    			'type'        => 'background',
    			'default'     => array(
    				'background-color' => '#dd3333',
    			),
    			'transparent' => true
    		),

    		array(
    			'id'          => 'main_menu_hover_background',
    			'title'       => __( 'Menu Bar Background Hover Color', 'homemarket' ),
    			'type'        => 'background',
    			'default'     => array(
    				'background-color' => '#dd3333',
    			),
    			'transparent' => true
    		),

    		array(
    			'id'   => 'header_icon_options',
    			'type' => 'info',
    			'icon' => 'fa fa-fonticons',
    			'raw'  => __( '<h3>Header Icon Color</h3>', 'homemarket' )
    		),

    		array(
    			'id'          => 'header_icon_color',
    			'title'       => __( 'Header Icon Color', 'homemarket' ),
    			'type'        => 'color',
    			'default'     => '#ad2a2a',
    			'transparent' => false
    		),

    		array(
    			'id'          => 'header_icon_text_color',
    			'title'       => __( 'Header Icon Text Color', 'homemarket' ),
    			'type'        => 'color',
    			'default'     => '#000',
    			'transparent' => false
    		),

            array(
                'id'    => 'header_search_collection_box_options',
                'type'  => 'info',
                'icon'  => 'fa fa-pencil-square-o',
                'raw'   => __( '<h3>Header Search & Collection Box Options</h3>', 'homemarket' )
            ),

            array(
                'id'          => 'search_collection_box_background',
                'title'       => __('Search & Collection Box Background', 'homemarket'),
                'type'        => 'color',
                'default'     => '#ffffff',
                'transparent' => true
            ),

            array(
                'id'          => 'search_collection_box_border_color',
                'title'       => __('Search & Collection Box Border Color', 'homemarket'),
                'type'        => 'color',
                'default'     => '#333',
                'transparent' => true
            ),

    	),
    ) );    

	Redux::setSection( $hto_name, array(
		
		'icon'   => 'fa fa-angle-right',
		'title'  => __('Header Elements', 'homemarket'),
		'subsection'  => true,
		'fields'      => array(
			
			/*array(
				'id'    => 'header_wishlist_option',
				'type'  => 'info',
    			'icon'  => 'fa fa-heart',
    			'raw'   => '<h3>Wishlist Icon</h3>'
			),

			array(
				'id'      => 'main_header_wishlist',
				'on'      => __('Enabled', 'homemarket'),
                'off'     => __('Disabled', 'homemarket'),
                'type'    => 'switch',
                'default' => 1,
			),

			array(
				'id'       => 'main_header_wishlist_icon',
				'title'    => __('Custom Wishlist Icon', 'homemarket'),
                'type'     => 'media',
                'required' => array( 'main_header_wishlist', 'equals', array( '1' ) ),
			),*/

			array(
				'id'    => 'header_store_location_option',
				'type'  => 'info',
    			'icon'  => 'fa fa-map-marker',
    			'raw'   => __( '<h3>Store Location Icon</h3>', 'homemarket' )
			),

			array(
				'id'      => 'main_header_store_location',
				'on'      => __('Enabled', 'homemarket'),
                'off'     => __('Disabled', 'homemarket'),
                'type'    => 'switch',
                'default' => 1,
			),

            array(
                'id'       => 'main_header_store_location_url',
                'title'    => __('Page URL(http://)', 'homemarket'),
                'type'     => 'text',
                'required' => array('main_header_store_location','equals', array('1') )      
            ),

			array(
				'id'       => 'main_header_store_location_icon',
				'title'    => __('Custom Store Location Icon', 'homemarket'),
                'type'     => 'media',
                'required' => array( 'main_header_store_location', 'equals', array( '1' ) ),
			),

			array(
				'id'    => 'header_account_option',
				'type'  => 'info',
    			'icon'  => 'fa fa-user',
    			'raw'   => __( '<h3>My Account Icon</h3>', 'homemarket' )
			),

			array(
				'id'      => 'main_header_account',
				'on'      => __('Enabled', 'homemarket'),
                'off'     => __('Disabled', 'homemarket'),
                'type'    => 'switch',
                'default' => 1,
			),

			array(
				'id'       => 'main_header_account_icon',
				'title'    => __('Custom My Account Icon', 'homemarket'),
                'type'     => 'media',
                'required' => array( 'main_header_account', 'equals', array( '1' ) ),
			),

			array(
				'id'    => 'header_cart_option',
				'type'  => 'info',
				'icon'  => 'fa fa-shopping-cart',
				'raw'   => __( '<h3>Shopping Cart Icon</h3>', 'homemarket' )
			),

			array(
				'id'       => 'main_header_shopping_cart',
				'on'       => __('Enabled', 'homemarket'),
				'off'      => __('Disabled', 'homemarket'),
				'type'     => 'switch',
				'default'  => 1
			),

			array(
				'id'       => 'minicart_option',
                'title'    => __('Cart Icon Function', 'homemarket'),
                'on'       => __('Mini Cart', 'homemarket'),
                'off'      => __('Page Link', 'homemarket'),
                'type'     => 'switch',
                'default'  => 1,
                'required' => array('main_header_shopping_cart','equals','1')
			),

			array(
				'id'       => 'main_header_shopping_cart_icon',
				'title'    => __('Custom Cart Icon', 'homemarket'),
				'type'     => 'media',
				'required' => array('main_header_shopping_cart','equals', array('1') )	
			),

			array(
				'id'       => 'main_header_minicart_msg',
				'title'    => __('Mini Cart Message', 'homemarket'),
				'type'     => 'text',
				'required' => array('main_header_shopping_cart','equals', array('1') )		
			),

			array(
				'id'     => 'header_search_bar_option',
				'type'   => 'info',
				'icon'   => 'fa fa-search',
				'raw'    => __( '<h3>Search Icon</h3>', 'homemarket' )
			),

			array(
				'id'       => 'main_header_search_bar',
				'on'       => __('Enabled', 'homemarket'),
				'off'      => __('Disabled', 'homemarket'),
				'type'     => 'switch',
				'default'  => 1
			),

			array(
				'id'        => 'main_header_search_bar_icon',
				'title'     => __('Custom Search Icon', 'homemarket'),
				'type'      => 'media',
				'required'  => array('main_header_search_bar', 'equals', array('1')),
			),

			array(
				'id'     => 'header_collection_select_option',
				'type'   => 'info',
				'icon'   => false,
				'raw'    => __( '<h3>Collection Select Menu</h3>', 'homemarket' )
			),

			array(
				'id'       => 'main_header_collection_select',
				'on'       => __('Enabled', 'homemarket'),
				'off'      => __('Disabled', 'homemarket'),
				'type'     => 'switch',
				'default'  => 1
			),

		),

	) );

	Redux::setSection( $hto_name, array(
		'icon'       => 'fa fa-angle-right',
		'title'      => __( 'Logo', 'homemarket' ),
		'subsection' => true,
		'fields'     => array(

			array(
				'id'      => 'site_logo',
				'title'   => __('Site Logo', 'homemarket'),
				'type'    => 'media',
				'default' => array(
					'url' => get_template_directory_uri() . '/images/homemarket-theme-logo-1.png'
				)
			),

			array(
				'id'            => 'logo_height',
				'title'         => __('Logo Height', 'homemarket'),
				'type'          => 'text',
				'default'       => 56,
                'desc'          =>  __('Enter the Logo Height value (px)', 'homemarket')
			),

		),
	) );

	Redux::setSection( $hto_name, array(

		'icon'       => 'fa fa-angle-right',
		'title'      => __( 'Top Bar', 'homemarket' ),
		'subsection' => true,
		'fields'     => array(

			array(
				'id'      => 'top_bar_switch',
				'title'   => __('Top Bar', 'homemarket'),
				'on'      => __('Enabled', 'homemarket'),
				'off'     => __('Disabled', 'homemarket'),
				'type'    => 'switch',
				'default' => 0
			),

			array(
				'id'       => 'top_bar_background_color',
				'title'    => __('Top Bar Background Color', 'homemarket'),
				'type'     => 'color',
				'default'  => '#333333',
				'required' => array('top_bar_switch', '=', '1')
			),

			array(
				'id'          => 'top_bar_text_color',
				'title'      => __('Top Bar Text Color', 'homemarket'),
				'type'        => 'color',
				'default'     => '#eaeaea',
				'transparent' => false,
				'required'    => array('top_bar_switch', '=', '1')
			),

			array(
				'id'        => 'top_bar_text',
				'title'     => __('Top Bar Text', 'homemarket'),
				'type'      => 'text',
				'default'   => 'Default Welcome Msg!',
				'required'  => array('top_bar_switch', '=', '1')	
			),

			array(
				'id' => 'top_bar_social_icons',
				'title'     => __('Top Bar Social Icons', 'homemarket'),
				'on'        => __('Enabled', 'homemarket'),
				'off'       => __('Disabled', 'homemarket'),
				'type'      => 'switch',
				'default'   => 1,
				'required'  => array('top_bar_switch', 'equals', '1')	
			),

            array(
                'id' => 'top_bar_social_icons_color',
                'title'     => __('Top Bar Social Icons Color', 'homemarket'),
                'type'        => 'color',
                'default'     => '#eaeaea',
                'transparent' => false,
                'required'  => array('top_bar_social_icons', 'equals', '1')
            ),

			// array(
			// 	'id' => 'top_bar_currency_unit',
			// 	'title'     => __('Top Bar Currency Unit', 'homemarket'),
			// 	'on'        => __('Enabled', 'homemarket'),
			// 	'off'       => __('Disabled', 'homemarket'),
			// 	'type'      => 'switch',
			// 	'default'   => 1,
			// 	'required'  => array('top_bar_switch', 'equals', '1')	
			// ),

		),

	) );

	// Redux::setSection( $hto_name, array(

	// 	'icon'       => 'fa fa-angle-right',
	// 	'title'      => __('Sticky Header', 'homemarket'),
	// 	'subsection' => true,
	// 	'fields'     => array(

	// 		array(
	// 			'id'        => 'sticky_header',
	// 			'title'     => __('Sticky Header', 'homemarket'),
	// 			'on'        => __('Enabled', 'homemarket'),
	// 			'off'       => __('Disabled', 'homemarket'),
	// 			'type'      => 'switch',
	// 			'default'   => 1,
	// 		),

	// 		array(
	// 			'id'          => 'sticky_header_background_color',
	// 			'title'       => __('Sticky Header Background Color', 'homemarket'),
	// 			'type'        => 'color',
	// 			'default'     => '#333333',
	// 			'transparent' => false,
	// 			'required'    => array('sticky_header', '=', '1')
	// 		),

	// 		array(
	// 			'id'          => 'sticky_header_text_color',
	// 			'title'       => __('Sticky Header Text Color', 'homemarket'),
	// 			'type'        => 'color',
	// 			'default'     => '#ffffff',
	// 			'transparent' => false,
	// 			'required'    => array('sticky_header', '=', '1')
	// 		),

	// 	),

	// ) );

    Redux::setSection( $hto_name, array(
    	'icon'   => 'el el-website',
    	'title'  => __( 'Footer', 'homemarket' ),
    	'fields' => array(

            array(
                'id' => 'copyright',
                'title' => __('Copyright', 'homemarket'),
                'type' => 'text',
                'default' => '©2016 Home Market - Red. All rights Reserved',
            ),  

            array(
                'id'      => 'payments_image',
                'title'   => __('Payments Image', 'homemarket'),
                'type'    => 'media',
                'default' => array(
                    'url' => get_template_directory_uri() . '/images/payments.png'
                )
            ),

            array(
                'id' => 'payments_image_alt',
                'title' => __('Payments Image Alt', 'homemarket'),
                'type' => 'text',
                'default' => 'Payment Gateways',
            ),  

            array(
                'id' => 'payments_link_url',
                'title' => __('Payments Link URL', 'homemarket'),
                'type' => 'text',
                'default' => '',
            ), 
        ),
    ) );

    Redux::setSection( $hto_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Topbar', 'homemarket'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'          => 'footer_top_background',
                'title'       => __('Footer Top Bar Background Color', 'homemarket'),
                'type'        => 'color',
                'default'     => '#fa5555',
                'transparent' => false,
            ),

            array(
                'id'          => 'footer_top_font_color',
                'title'       => __('Footer Top Bar Font Color', 'homemarket'),
                'type'        => 'color',
                'default'     => '#ffffff',
                'transparent' => false,
            ),
        )
    ) );

    Redux::setSection( $hto_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Main Information', 'homemarket'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'          => 'footer_main_background',
                'title'       => __('Footer Main Content Background Color', 'homemarket'),
                'type'        => 'color',
                'default'     => '##2c2c2c',
                'transparent' => false,
            ),

            array(
                'id'          => 'footer_main_font_color',
                'title'       => __('Footer Main Content Font Color', 'homemarket'),
                'type'        => 'color',
                'default'     => '#696969',
                'transparent' => false,
            ),

            array(
                'id'          => 'footer_main_border_color',
                'title'       => __('Border Color', 'homemarket'),
                'type'        => 'color',
                'default'     => '#696969',
                'transparent' => false,
            ),
        )
    ) );

    Redux::setSection( $hto_name, array(
        'icon'   => 'fa fa-file',
        'title'  => __( 'Blog & Post', 'homemarket' ),
        'fields' => array(
            array(
                'id'       => 'blog_page_layout',
                'type'     => 'image_select',
                'title'    => __( 'Blog Page Layout', 'homemarket' ),
                'compiler' => true,
                'options'  => array(
                    '1' => array(
                        'alt' => __( 'Page Full', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full.png',
                    ),
                    '2' => array(
                        'alt' => __( 'Page Full Left', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full_left.png',
                    ),
                    '3' => array(
                        'alt' => __( 'Page Full Right', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full_right.png',
                    ),
                ),
                'default' => '2'
            ),
            array(
                'id'=>'blog_post_excerpt_length',
                'type' => 'text',
                'title' => __('Excerpt Length', 'homemarket'),
                'desc' => __('The number of words', 'homemarket'),
                'default' => '20',
            ),
        ),
    ) );

    Redux::setSection( $hto_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __( 'Single Post', 'homemarket' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'post_page_layout',
                'type'     => 'image_select',
                'title'    => __( 'Post Page Layout', 'homemarket' ),
                'compiler' => true,
                'options'  => array(
                    '1' => array(
                        'alt' => __( 'Page Full', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full.png',
                    ),
                    '2' => array(
                        'alt' => __( 'Page Full Left', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full_left.png',
                    ),
                    '3' => array(
                        'alt' => __( 'Page Full Right', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full_right.png',
                    ),
                ),
                'default' => '2'
            ),
            array(
                'id'=>'title_enable',
                'type' => 'switch',
                'title' => __('Show Title', 'homemarket'),
                'default' => 1,
                'on' => __('Yes', 'homemarket'),
                'off' => __('No', 'homemarket'),
            ),
            array(
                'id'=>'social_links_enable',
                'type' => 'switch',
                'title' => __('Show Social Share Links', 'homemarket'),
                'default' => 1,
                'on' => __('Yes', 'homemarket'),
                'off' => __('No', 'homemarket'),
            ),
            array(
                'id'=>'author_enable',
                'type' => 'switch',
                'title' => __('Show Author Info', 'homemarket'),
                'default' => 1,
                'on' => __('Yes', 'homemarket'),
                'off' => __('No', 'homemarket'),
            ),
            array(
                'id'=>'comments_enable',
                'type' => 'switch',
                'title' => __('Show Comments', 'homemarket'),
                'default' => 1,
                'on' => __('Yes', 'homemarket'),
                'off' => __('No', 'homemarket'),
            ),
            /*array(
                'id'=>'related_posts_enable',
                'type' => 'switch',
                'title' => __('Show Related Posts', 'homemarket'),
                'default' => 1,
                'on' => __('Yes', 'homemarket'),
                'off' => __('No', 'homemarket'),
            ),
            array(
                'id' => 'related_posts_count',
                'type' => 'text',
                'title' => __('Related Posts Count', 'homemarket'),
                'desc' => __('If you want to show all the related posts, please input "-1"', 'homemarket'),
                'default' => '6',
                'required' => array('related_posts_enable', 'equals', 1),
            ),
            array(
                'id' => 'related_posts_orderby',
                'type' => 'button_set',
                'title' => __('Related Posts Order by', 'homemarket'),
                'options' => array(
                    'none' => __('None', 'homemarket'),
                    'rand' => __('Random', 'homemarket'),
                    'date' => __('Date', 'homemarket'),
                    'post_id' => __('ID', 'homemarket'),
                    'modified' => __('Modified Date', 'homemarket'),
                    'comment_count' => __('Comment Count', 'homemarket'),
                ),
                'default' => 'rand',
                'required' => array('related_posts_enable', 'equals', 1),
            ),
            array(
                'id' => 'related_posts_cols',
                'type' => 'button_set',
                'title' => __('Related Posts Colums', 'homemarket'),
                'options' => array(
                    '4' => '4',
                    '3' => '3',
                    '2' => '2',
                    '1' => '1',
                ),
                'default' => '4',
                'required' => array('related_posts_enable', 'equals', 1),
            ),*/
        ),
    ) );

    Redux::setSection( $hto_name, array(
        'icon'   => 'fa fa-tag',
        'title'  => __( 'Breadcrumbs', 'homemarket' ),
        'fields' => array(
            array(
                'id'        => 'show_breadcrumbs',
                'title'     => __('Show Breadcrumbs', 'homemarket'),
                'on'        => __('Enabled', 'homemarket'),
                'off'       => __('Disabled', 'homemarket'),
                'type'      => 'switch',
                'default'   => 1,
            ),
            array(
                'id'        => 'show_page_title',
                'title'     => __('Show Page Title', 'homemarket'),
                'on'        => __('Enabled', 'homemarket'),
                'off'       => __('Disabled', 'homemarket'),
                'type'      => 'switch',
                'default'   => 1,
            ),
            array(
                'id'       => 'breadcrumbs_delimiter',
                'title'    => __( 'Breadcrumbs Delimiter', 'homemarket' ),
                'type'     => 'button_set',
                'required' => array('show_breadcrumbs', 'equals', '1'),
                'options'  => array(
                    ''            => __('/', 'homemarket'),
                    'delimiter-2' => __('>', 'homemarket'),
                ),
                'default'  => ''
            ),
            array(
                'id'      => 'breadcrumbs_background',
                'title'   => __('Breadcrumbs Background', 'homemarket'),
                'type'    => 'background',
                'default' => array(
                    'background-image' => get_template_directory_uri() . '/images/breadcrumb.jpg'
                )
            )
        ),
    ) );

    Redux::setSection( $hto_name, array(
        'icon'   => 'fa fa-shopping-cart',
        'title'  => __( 'Woocommerce', 'homemarket' ),
        'fields' => array(

            array(
                'id'      => 'add_to_cart_label',
                'title'   => __('Add to Cart Label', 'homemarket'),
                'type'    => 'text',
                'default' => 'Buy Now',
            ),           

        ),
    ) );

    Redux::setSection( $hto_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Product Archives', 'homemarket'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'page_layout',
                'type'     => 'image_select',
                'title'    => __( 'Page Layout', 'homemarket' ),
                'compiler' => true,
                'options'  => array(
                    '1' => array(
                        'alt' => __( 'Page Full', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full.png',
                    ),
                    '2' => array(
                        'alt' => __( 'Page Full Left', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full_left.png',
                    ),
                    '3' => array(
                        'alt' => __( 'Page Full Right', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full_right.png',
                    ),
                ),
                'default' => '2'
            ),
            // array(
            //     'id'=>'category_ajax',
            //     'type' => 'switch',
            //     'title' => __('Enable Ajax Filter', 'homemarket'),
            //     'default' => 1,
            //     'on' => __('Yes', 'homemarket'),
            //     'off' => __('No', 'homemarket'),
            // ),
            array(
                'id'        =>'products_item',
                'type'      => 'text',
                'title'     => __('Products per Page', 'homemarket'),
                'desc'      => __('Comma separated list of product counts.', 'homemarket'),
                'default'   => '12,24,36'
            ),
            array(
                'id'        =>  'quickview_enable',
                'type'      => 'switch',
                'title'     => __('Show QuickView', 'homemarket'),
                'default'   => 1,
                'on'        => __('Yes', 'homemarket'),
                'off'       => __('No', 'homemarket'),
            ),
        ),
    ) );

    Redux::setSection( $hto_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Single Product', 'homemarket'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'single_product_page_layout',
                'type'     => 'image_select',
                'title'    => __( 'Page Layout', 'homemarket' ),
                'compiler' => true,
                'options'  => array(
                    '1' => array(
                        'alt' => __( 'Page Full', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full.png',
                    ),
                    '2' => array(
                        'alt' => __( 'Page Full Left', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full_left.png',
                    ),
                    '3' => array(
                        'alt' => __( 'Page Full Right', 'homemarket' ),
                        'img' => get_template_directory_uri() . '/images/homemarket_theme_options/icons/page_full_right.png',
                    ),
                ),
                'default' => '2'
            ),
            array(
                'id'=>'product_share_links',
                'type' => 'switch',
                'title' => __('Show Social Share Links', 'homemarket'),
                'default' => 1,
                'on' => __('Yes', 'homemarket'),
                'off' => __('No', 'homemarket'),
            ),
            array(
                'id' => 'product_custom_tabs_count',
                'title' => __('Custom Tabs Count', 'homemarket'),
                'type' => 'text',
                'default' => '3',
            ),  
            array(
                'id'=>'related_products_show',
                'type' => 'switch',
                'title' => __('Show Related Products', 'homemarket'),
                'default' => 1,
                'on' => __('Yes', 'homemarket'),
                'off' => __('No', 'homemarket'),
            ),
            array(
                'id'=>'related_product_count',
                'type' => 'text',
                'required' => array( 'related_products_show','equals', 1 ),
                'title' => __('Related Products Count', 'homemarket'),
                'default' => '6'
            ),
            array(
                'id'=>'related_product_colum',
                'type' => 'button_set',
                'required' => array( 'related_products_show','equals', 1 ),
                'title' => __('Related Product Columns', 'homemarket'),
                'options' => array(
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5",
                    "6" => "6"
                ),
                'default' => '4',
            ),
            array(
                'id'=>'upsell_products_show',
                'type' => 'switch',
                'title' => __('Show Up Sell Products', 'homemarket'),
                'default' => 1,
                'on' => __('Yes', 'homemarket'),
                'off' => __('No', 'homemarket'),
            ),
            array(
                'id'=>'upsell_product_count',
                'type' => 'text',
                'required' => array( 'upsell_products_show','equals', 1 ),
                'title' => __('Up Sell Products Count', 'homemarket'),
                'default' => '6'
            ),
            array(
                'id'=>'upsell_product_colum',
                'type' => 'button_set',
                'required' => array( 'upsell_products_show','equals', 1 ),
                'title' => __('Up Sell Product Columns', 'homemarket'),
                'options' => array(
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5",
                    "6" => "6"
                ),
                'default' => '4',
            ),
        ),
    ) );

    Redux::setSection( $hto_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Product Image', 'homemarket'),
        'subsection' => true,
        'fields'     => array(

            array(
                'id'        => 'show_thumbnails',
                'title'     => __('Show Thumbnails', 'homemarket'),
                'on'        => __('Enabled', 'homemarket'),
                'off'       => __('Disabled', 'homemarket'),
                'type'      => 'switch',
                'default'   => 1,
            ),

            array(
                'id' => 'thumbnails_count',
                'title' => __('Thumbnails Count', 'homemarket'),
                'type' => 'text',
                'default' => '4',
            ),  

            // array(
            //     'id' => 'product_image_popup',
            //     'title' => __('Enable Image Popup', 'homemarket'),
            //     'on'        => __('Enabled', 'homemarket'),
            //     'off'       => __('Disabled', 'homemarket'),
            //     'type'      => 'switch',
            //     'default'   => 1,
            // ), 

        ),

    ) );

    $fonts = array( 
            "Proxima Nova Regular"                                         => "Proxima Nova Regular",
            "Lato"                                                         => "Lato",
            // "'HelveticaNeue','Helvetica Neue',Helvetica,Arial,sans-serif"  => "'HelveticaNeue','Helvetica Neue',Helvetica,Arial,sans-serif",
            // "'MS Sans Serif', Geneva, sans-serif"                          => "'MS Sans Serif', Geneva, sans-serif",
            // "'MS Serif', 'New York', sans-serif"                           => "'MS Serif', 'New York', sans-serif"
    );

    Redux::setSection( $hto_name, array(

        'icon'  => 'fa fa-font',
        'title' => __( 'Fonts', 'homemarket' ),
        'fields' => array(

            array(
                'id' => 'main_font_info',
                'icon'   => 'fa fa-font',
                'type' => 'info',
                'raw' => __('<h3>Main Font / Header Menu / body</h3>', 'homemarket'),
            ),
            
            // Standard + Google Webfonts
            array(
                'id' => 'main_font',
                'type' => 'typography',
                'line-height' => false,
                'text-align' => false,
                'font-style' => false,
                'font-weight' => false,
                'all_styles'=> true,
                'font-size' => false,
                'color' => false,
                'fonts' => $fonts,
                'default' => array (
                    'font-family' => 'Lato',
                    'subsets' => '',
                ),
            ),
            
            array(
                'id' => 'alternative_font_info',
                'icon' => 'fa fa-font',
                'type' => 'info',
                'raw' => __('<h3>Alternative Font / Special</h3>', 'homemarket'),
            ),
            
            // Standard + Google Webfonts
            array(
                'id' => 'alternative_font',
                'type' => 'typography',
                'line-height' => false,
                'text-align' => false,
                'font-style' => false,
                'font-weight' => false,
                'all_styles'=> true,
                'font-size' => false,
                'color' => false,
                'fonts' => $fonts,
                'default' => array (
                    'font-family' => 'Proxima Nova Regular',
                    'subsets' => '',
                ),           
            ),

        ),

    ) );

    Redux::setSection( $hto_name, array(

        'icon'   => 'fa fa-share-alt-square',
        'title'  => __('Social Media', 'homemarket'),
        'fields' => array(

            array(
                'id' => 'facebook_link',
                'title' => __('<i class="fa fa-facebook"></i> Facebook', 'homemarket'),
                'type' => 'text',
                'default' => 'https://www.facebook.com/',
            ),

            array(
                'id' => 'twitter_link',
                'title' => __('<i class="fa fa-twitter"></i> Twitter', 'homemarket'),
                'type' => 'text',
                'default' => 'http://twitter.com/',
            ),
            
            array(
                'id' => 'pinterest_link',
                'title' => __('<i class="fa fa-pinterest"></i> Pinterest', 'homemarket'),
                'type' => 'text',
                'default' => 'http://www.pinterest.com/',
            ),
            
            array(
                'id' => 'linkedin_link',
                'title' => __('<i class="fa fa-linkedin"></i> LinkedIn', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'googleplus_link',
                'title' => __('<i class="fa fa-google-plus"></i> Google+', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'rss_link',
                'title' => __('<i class="fa fa-rss"></i> RSS', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'tumblr_link',
                'title' => __('<i class="fa fa-tumblr"></i> Tumblr', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'instagram_link',
                'title' => __('<i class="fa fa-instagram"></i> Instagram', 'homemarket'),
                'type' => 'text',
                'default' => 'http://instagram.com/',
            ),
            
            array(
                'id' => 'youtube_link',
                'title' => __('<i class="fa fa-youtube-play"></i> Youtube', 'homemarket'),
                'type' => 'text',
                'default' => 'https://www.youtube.com/',
            ),
            
            array(
                'id' => 'vimeo_link',
                'title' => __('<i class="fa fa-vimeo-square"></i> Vimeo', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'behance_link',
                'title' => __('<i class="fa fa-behance"></i> Behance', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'dribble_link',
                'title' => __('<i class="fa fa-dribbble"></i> Dribble', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'flickr_link',
                'title' => __('<i class="fa fa-flickr"></i> Flickr', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'git_link',
                'title' => __('<i class="fa fa-git"></i> Git', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'skype_link',
                'title' => __('<i class="fa fa-skype"></i> Skype', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'weibo_link',
                'title' => __('<i class="fa fa-weibo"></i> Weibo', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'foursquare_link',
                'title' => __('<i class="fa fa-foursquare"></i> Foursquare', 'homemarket'),
                'type' => 'text',
            ),
            
            array(
                'id' => 'soundcloud_link',
                'title' => __('<i class="fa fa-soundcloud"></i> Soundcloud', 'homemarket'),
                'type' => 'text',
            ),

            array(
                'id' => 'vk_link',
                'title' => __('<i class="fa fa-vk"></i> VK', 'homemarket'),
                'type' => 'text',
            ),

        ),

    ) );


    Redux::setSection( $hto_name, array(

        'icon'   => 'fa fa-code',
        'title'  => __('Custom Code', 'homemarket'),
        'fields' => array(

            array(
                'id'        => 'custom_css',
                'title'     => __('Custom CSS', 'homemarket'),
                'subtitle'  => __('Paste your custom CSS code here.', 'homemarket'),
                'type'      => 'ace_editor',
                'mode'      => 'css'
            ),

            array(
                'id'        => 'header_js',
                'title'     => __('Header Javascript Code', 'homemarket'),
                'subtitle'  => __('Paste your custom JS code here. This code will be added to the header of your site.', 'homemarket'),
                'type'      => 'ace_editor',
                'mode'      => 'javascript'
            ),

            array(
                'id'        => 'footer_js',
                'title'     => __('Footer Javascript Code', 'homemarket'),
                'subtitle'  => __('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'homemarket'),
                'type'      => 'ace_editor',
                'mode'      => 'javascript'
            ),

        ),

    ) ); 

    Redux::setSection( $hto_name, array(
        'icon'      =>  'fa fa-map-marker',
        'title'     =>  __( 'Google Map', 'homemarket' ),
        'fields'    =>  array(
            array(
                'id' => 'hm_google_api_key',
                'title' => __('API Key', 'homemarket'),
                'type' => 'text',
                'default' => 'AIzaSyCqs0wmRZvUnDpLfl9jWHyd4wZnsj049fg',
            )
        ),
    ) );


     /*
     * <--- END SECTIONS
     */    

?>
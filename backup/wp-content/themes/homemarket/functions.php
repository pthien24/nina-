<?php

	global $wpdb;

	define('HM_MARKER_TABLE', $wpdb->prefix . 'marker');
	define('HM_PLUGINS', get_template_directory() . '/inc/plugins');
	define('HM_PLUGINS_URI', get_template_directory_uri() . '/inc/plugins');

	// theme textdomain - must be loaded before redux
	load_theme_textdomain( 'homemarket', get_template_directory() . '/languages' );


	/*********************************************************************************************/
	/*********************************** HomeMarket Theme Options ********************************/
	/*********************************************************************************************/

	if ( !class_exists( 'ReduxFramework' ) && file_exists( WP_PLUGIN_DIR . '/redux-framework/ReduxCore/framework.php' ) ) {
	    require_once( WP_PLUGIN_DIR . '/redux-framework/ReduxCore/framework.php' );
	}
	if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/inc/admin/theme_options/homemarket.config.php' ) ) {
	    require_once( get_parent_theme_file_path( 'inc/admin/theme_options/homemarket.config.php' ) );
	}

	global $homemarket_theme_options;

	/************************************* Include php files *************************************/
	/*********************************************************************************************/
	require_once( get_parent_theme_file_path( 'inc/helper/helper.php' ) );

	require_once( get_parent_theme_file_path( 'inc/js_composer/init.php' ) );
	require_once( get_parent_theme_file_path( 'inc/widgets/widgets.php' ) );

	// Include Meta Boxes
	include_once( get_parent_theme_file_path( 'inc/metaboxes/meta_boxes.php' ) );
	include_once( get_parent_theme_file_path( 'inc/metaboxes/page.php' ) );

	// Load theme options custom styles
	include_once( get_parent_theme_file_path( 'inc/theme-option-styles/theme-option-styles.php' ) );

	// Custom Menu
	include_once( get_parent_theme_file_path( 'inc/custom_nav_menu/custom-menu.php' ) );

	// Include Map Styled JSON
	require_once( get_parent_theme_file_path( 'inc/map_styled/map_styled_json.php' ) );

	//Include homemarket theme page
	if (is_admin()):
		include_once( get_parent_theme_file_path( 'inc/admin/admin.php' ) );
	endif;

	//Include woocommerce plugin custom
	if ( class_exists( 'Woocommerce' ) ) {
        require_once( get_parent_theme_file_path( 'inc/woocommerce/init.php' ) );
    }

  	// Install Plugins
 	require_once( get_parent_theme_file_path( 'inc/plugins/plugins.php' ) );


	/************************************* HomeMarket Setup *******************************************/
	/**************************************************************************************************/
	if ( ! function_exists( 'homemarket_setup' ) ) {
		function homemarket_setup() {

			global $homemarket_theme_options;

			// Register Custom Menu
			register_nav_menus( array(
				'main-navigation'         => __('Main Navigation', 'homemarket'),
				'collections-navigation'  => __('Collections Navigation', 'homemarket'),
				'footer-navigation'       => __('Footer Menu Navigation', 'homemarket')
			) );

			if ( is_multisite() ) {
				update_site_option( 'fileupload_maxk', 1024 * 32 );
			}

			global $wpdb;
			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE " . HM_MARKER_TABLE . " (
				marker_id int(20) NOT NULL AUTO_INCREMENT,
				marker_name varchar(30) NOT NULL,
				marker_slug varchar(30) NOT NULL,
				marker_background_color varchar(30) NOT NULL,
				UNIQUE KEY marker_id (marker_id)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			// register additional image sizes
			add_image_size( 'homemarket-blog', 421, 270, true );
			add_image_size( 'homemarket-post', 879, 565, true );
			add_image_size( 'homemarket-map-marker', 26, 46, true );
			add_image_size( 'homemarket-map-marker3', 46, 46, true );

			add_theme_support( 'woocommerce' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'automatic-feed-links' );
		}
	}       // homemarket setup
	add_action('after_setup_theme', 'homemarket_setup');


	// admin custom js add
	function homemarket_admin_script() {
		wp_enqueue_script('homemarket_admin_script', get_template_directory_uri() . '/js/admin.js', array('wp-color-picker', 'jquery'), false);
	}
	add_action( 'admin_enqueue_scripts', 'homemarket_admin_script' );	

	// admin custom css add
	function homemarket_admin_style() {
		wp_enqueue_style('homemarket_admin_style', get_template_directory_uri() . '/css/wp-admin-custom.css', false, homemarket_theme_version(), 'all');
		wp_enqueue_style('homemarket-font-awesome-admin', get_template_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css', NULL, '4.6.3', 'all' );
		wp_enqueue_style('wp-color-picker');
	}
	add_action( 'admin_enqueue_scripts', 'homemarket_admin_style' );

	// admin wp.media function add
	if( is_admin() && ! empty ( $_SERVER['PHP_SELF'] ) && 'upload.php' !== basename( $_SERVER['PHP_SELF'] ) ) {
	    function homemarket_load_styles_and_scripts() {
	        wp_enqueue_media();
	    }
	    add_action( 'admin_enqueue_scripts', 'homemarket_load_styles_and_scripts' );
	}

	/******************** Add Font Awesome to Redux *******************************/
	/******************************************************************************/
	function homemarket_newIconFont() {

	    wp_register_style(
	        'font-awesome-redux', get_template_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css',
	        array(),
	        time(),
	        'all'
	    );  
	    wp_enqueue_style( 'font-awesome-redux' );
	}
	add_action( 'redux/page/homemarket_theme_options/enqueue', 'homemarket_newIconFont' );

	/**************************** Register custom fonts **********************************/
	/*************************************************************************************/

	function homemarket_fonts_url() {
		$fonts_url = '';

		$lato = _x( 'on', 'Lato font: on or off', 'homemarket' );
		$montserrat = _x( 'on', 'Montserrat font: on or off', 'homemarket' );

		$font_families = array();

		if ( 'off' !== $lato || 'off' !== $montserrat ) {
			if ( 'off' !== $lato ) {
				$font_families[] = 'Lato:300,400,500,600,700';
			}

			if ( 'off' !== $montserrat ) {
				$font_families[] = 'Montserrat:300,400,500,600,700';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) )
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}


	/**************************** Enqueue styles **********************************/
	/******************************************************************************/

	/* frontend */
	function homemarket_styles() {
		global $homemarket_theme_options;

		wp_enqueue_style('custom-styles', get_template_directory_uri() . '/css/styles.css', NULL, homemarket_theme_version(), 'all');
		wp_enqueue_style('carousel-style', get_template_directory_uri() . '/css/owl.carousel.min.css', NULL, homemarket_theme_version(), 'all');
		wp_enqueue_style('carousel-default-style', get_template_directory_uri() . '/css/owl.theme.default.css', NULL, homemarket_theme_version(), 'all');

		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css', NULL, '4.6.3', 'all' );

		wp_enqueue_style( 'homemarket_fonts', homemarket_fonts_url(), array(), '1.0.0' );
	}

	add_action('wp_enqueue_scripts', 'homemarket_styles', 90);

	function homemarket_scripts() {
		global $homemarket_theme_options;

		$homemarket_google_api = '';
		if ( isset($homemarket_theme_options['hm_google_api_key']) && $homemarket_theme_options['hm_google_api_key'] != '' ) {
			$homemarket_google_api = $homemarket_theme_options['hm_google_api_key'];
		} 
		
		wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), false, true);
		wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/fancybox.js', array(), false, true);

	    wp_enqueue_script('carousel_slider', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), false, true);

	    wp_enqueue_script( 'custom_google_maps', 'https://maps.googleapis.com/maps/api/js?key=' . $homemarket_theme_options['hm_google_api_key'], array(), false, true );
	    wp_enqueue_script( 'custom_gmap3', get_template_directory_uri() . '/js/gmap3.min.js', array(), false, true );
	    wp_enqueue_script( 'custom_modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), false, true );
	    wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), false, true );
	    wp_enqueue_script( 'images_loaded', get_template_directory_uri() . '/js/imagesloaded.js', array(), false, true );
	    wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array(), false, true );
	    wp_enqueue_script( 'animonscroll', get_template_directory_uri() . '/js/AnimOnScroll.js', array(), false, true );

	    wp_enqueue_script('custom_scripts', get_template_directory_uri() . '/js/scripts'.(SCRIPT_DEBUG?'':'.min').'.js', array(), homemarket_theme_version(), true);

	    wp_enqueue_script( 'custom-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), homemarket_theme_version(), true );

	    
        // load wc variation script
        wp_enqueue_script( 'wc-add-to-cart-variation' );

	    wp_localize_script( 'custom-theme', 'js_homemarket_vars', array(
	    	'rtl' => esc_js(is_rtl() ? true : false),
	    	'ajax_url' => esc_js(admin_url( 'admin-ajax.php' )),
	    	// 'category_ajax' => esc_js($homemarket_theme_options['category_ajax']),
	    	'product_thumbs_count' => esc_js($homemarket_theme_options['thumbnails_count']),
	    	// 'product_image_popup' => esc_js($homemarket_theme_options['product_image_popup']),
	    	'minicart_option' => esc_js($homemarket_theme_options['minicart_option']),
	    	'popup_close' => esc_html(__('Close', 'homemarket')),
	        'popup_prev' => esc_html(__('Previous', 'homemarket')),
	        'popup_next' => esc_html(__('Next', 'homemarket')),
	        'request_error' => esc_html(__('The requested content cannot be loaded.<br/>Please try again later.', 'homemarket')),
	        'wc_shop_container' => apply_filters( 'watf_wc_shop_container', '.products-content' ),
            // 'wc_count_container' => apply_filters( 'watf_wc_count_container', $watf_count_container ),
            'loading_text' => __( 'Filtering Results...', 'homemarket' ),
            'error_text' => __( 'Sorry, an error ocurred while filtering products. Please, try again.', 'homemarket' ),  
	    ) );

    	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	add_action('wp_enqueue_scripts', 'homemarket_scripts', 90);


	/**************************** General Functions **********************************/
	/*********************************************************************************/

	if ( ! function_exists( 'homemarket_is_ajax' ) ) {
	    function homemarket_is_ajax() {

	        if ( defined( 'DOING_AJAX' ) ) {
	            return true;
	        }

	        if (function_exists('mb_strtolower')) {
	            return ( isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && mb_strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) ? true : false;
	        } else {
	            return ( isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) ? true : false;
	        }
	    }
	}

	function homemarket_array2json( $arr ) {
	    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
	    $parts = array();
	    $is_list = false;

	    //Find out if the given array is a numerical array
	    $keys = array_keys($arr);
	    $max_length = count($arr)-1;
	    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
	        $is_list = true;
	        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
	            if($i != $keys[$i]) { //A key fails at position check.
	                $is_list = false; //It is an associative array.
	                break;
	            }
	        }
	    }

	    foreach($arr as $key=>$value) {
	        if(is_array($value)) { //Custom handling for arrays
	            if($is_list) $parts[] = homemarket_array2json($value); /* :RECURSION: */
	            else $parts[] = '"' . $key . '":' . homemarket_array2json($value); /* :RECURSION: */
	        } else {
	            $str = '';
	            if(!$is_list) $str = '"' . $key . '":';

	            //Custom handling for multiple data types
	            if(is_numeric($value)) $str .= $value; //Numbers
	            elseif($value === false) $str .= 'false'; //The booleans
	            elseif($value === true) $str .= 'true';
	            else $str .= '"' . addslashes($value) . '"'; //All other things

	            $parts[] = $str;
	        }
	    }
	    $json = implode(',',$parts);

	    if($is_list) return '[' . $json . ']';//Return numerical JSON
	    return '{' . $json . '}';//Return associative JSON
	}

	// Update cart counter each time

	add_filter('add_to_cart_fragments', 'homemarket_shopping_bag_items_number');
	function homemarket_shopping_bag_items_number( $fragments ) 
	{
		global $woocommerce;
		ob_start(); ?>

	    <span id="CartCount"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
		<?php
		$fragments['#CartCount'] = ob_get_clean();
		return $fragments;
	}

	function homemarket_comment($comment, $args, $depth) {
    	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	    <div class="comment-body">
	        <div class="img-thumbnail">
	            <?php echo get_avatar($comment, 80); ?>
	        </div>
	        <div class="comment-block">
	            <div class="comment-arrow"></div>
	            <span class="comment-by">
	                <strong><?php echo get_comment_author_link() ?></strong>
	                <span class="right">
	                    <span> <?php edit_comment_link('<i class="fa fa-pencil"></i> ' . __('Edit', 'homemarket'),'  ','') ?></span>
	                    <span> <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="fa fa-reply"></i> ' . __('Reply', 'homemarket'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
	                </span>
	            </span>
	            <div>
	                <?php if ($comment->comment_approved == '0') : ?>
	                    <em><?php echo __('Your comment is awaiting moderation.', 'homemarket') ?></em>
	                    <br />
	                <?php endif; ?>
	                <?php comment_text() ?>
	            </div>
	            <span class="date right"><?php printf(__('%1$s at %2$s', 'homemarket'), get_comment_date(),  get_comment_time()) ?></span>
	        </div>
	    </div>

	<?php }

	// Add Blog pagination
	if ( ! function_exists( 'homemarket_post_pagination' ) ) :
		function homemarket_post_pagination() {
			global $wp_query;

			$big = 999999999; // need an unlikely integer
			
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			) );
		}
	endif;

?>
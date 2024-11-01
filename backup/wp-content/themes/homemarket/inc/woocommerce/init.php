<?php
/**
 * WooCommerce configuration
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

global $woocommerce_loop;

/************************ Add/Remove Action **********************/

// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
remove_filter( 'woocommerce_product_tabs', 'woocommerce_default_product_tabs' );

add_action( 'wp_ajax_homemarket_product_quickview', 'homemarket_product_quickview' );
add_action( 'wp_ajax_nopriv_homemarket_product_quickview', 'homemarket_product_quickview' );
add_action( 'woocommerce_breadcrumb_init', 'woocommerce_breadcrumb' );
add_action( 'woocommerce_before_shop_loop', 'homemarket_grid_list_toggle', 40 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_title', 11 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 12 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 13 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 14 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_quick_view', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );
add_action( 'woocommerce_share', 'homemarket_woocommerce_share' );
add_action( 'homemarket_single_product_share', 'woocommerce_template_single_sharing' );
add_action( 'homemarket_product_sidebar', 'homemarket_product_get_sidebar', 10 );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 30 );

/************************ Add Filter **********************/

// Swith Price content
add_filter( 'woocommerce_format_sale_price', 'get_price_html_from_to_swap', 10, 3 );
add_filter( 'woocommerce_product_add_to_cart_text', 'add_to_cart_text_change', 20, 2 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'single_add_to_cart_text_change', 20, 2 );
add_filter( 'loop_shop_per_page', 'homemarket_loop_shop_per_page' );

// product custom tab
add_filter( 'woocommerce_product_tabs', 'homemarket_woocommerce_default_product_tabs' );
add_filter( 'woocommerce_product_tabs', 'homemarket_woocommerce_custom_tab' );
add_filter('woocommerce_review_gravatar_size', 'homemarket_woo_review_gravatar_size', 99);
add_filter( 'comment_form_fields', 'comment_fields_reorder' );

// related product remove
add_filter('woocommerce_related_products_args', 'homemarket_remove_related_products', 10);

// woocommerce-message box filter
add_filter('woocommerce_add_success', 'woocommerce_custom_add_message_box', 10, 1);
// add_filter('wc_add_to_cart_message', 'custom_add_to_cart_message', 5, 2);

// Show Mini Cart in cart, checkout page
add_filter( 'woocommerce_widget_cart_is_hidden', 'homemarket_show_mini_cart' );

//Filters For autocomplete param:
//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
add_filter( 'vc_autocomplete_multi_products_ids_callback', 'homemarket_shortcode_products_ids_callback', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_multi_products_ids_render', 'homemarket_shortcode_products_ids_render', 10, 1 ); // Render exact product. Must return an array (label,value)
//For param: ID default value filter
add_filter( 'vc_form_fields_render_field_multi_products_ids_param_value', 'homemarket_shortcode_products_ids_param_value', 10, 4 ); // Defines default value for param if not provided. Takes from other param value.

//Ajax cart count upgrade
add_filter( 'woocommerce_add_to_cart_fragments', 'homemarket_woocommerce_header_add_to_cart_fragment' );


/************************************** Functions define ****************************************/

function get_price_html_from_to_swap( $price, $from, $to ) {

	$price = '<ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins> <del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del>';

	return $price;
}

function add_to_cart_text_change( $btn_text, $wc_product ) { 

	global $homemarket_theme_options;

	if ( $homemarket_theme_options['add_to_cart_label'] != "" ) {
		$new_single_text = $homemarket_theme_options['add_to_cart_label'];
	} else {
		$new_single_text = __( 'Add to cart', 'homemarket' );
	}

	return $new_single_text;
}

function single_add_to_cart_text_change( $btn_text, $wc_product ) {
	global $homemarket_theme_options;

	if ( $homemarket_theme_options['add_to_cart_label'] != "" ) {
		$new_text = $wc_product->is_purchasable() && $wc_product->is_in_stock() ? $homemarket_theme_options['add_to_cart_label'] : $btn_text;
	} else {
		$new_text = $wc_product->is_purchasable() && $wc_product->is_in_stock() ? __( 'Add to cart', 'homemarket' ) : $btn_text;
	}


	return $new_text;
}

function homemarket_product_quickview() {

    global $post, $product;
    $post = get_post($_GET['pid']);
    $product = wc_get_product( $post->ID );
    
    if ( post_password_required() ) {
        echo get_the_password_form();
        die();
        return;
    }

    if ( $product->product_type == "variable" ) {
        $variable_class = "product-type-variable";
    } else {
        $variable_class = "";
    }

    ?>

    <div class="quickview-wrap quickview-wrap-<?php echo $post->ID ?> <?php echo $variable_class; ?>">
        <div class="product product-summary-wrap">

            <div class="row">
                <div class="grid__item one-half summary-before">
                    <?php
                    do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                </div>

                <div class="grid__item one-half summary entry-summary">
                    <?php
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div><!-- .summary -->
                <div style="clear: both;"></div>
            </div>
        </div>
    </div>

    <?php

    die();
}

function homemarket_grid_list_toggle() {
?>
    <div class="gridlist-toggle">
        <a href="#" id="grid" title="<?php echo __('Grid View', 'homemarket') ?>"></a>
        <a href="#" id="list" title="<?php echo __('List View', 'homemarket') ?>"></a>
    </div>
<?php
}

function woocommerce_template_quick_view() {
    global $product, $homemarket_theme_options;
    
    if( '1' == $homemarket_theme_options['quickview_enable'] ) {
        echo '<div class="quickview" data-id="'. esc_attr($product->get_id()) .'" title="Quick View">Qucik View</div>';
    }

}

function homemarket_loop_shop_per_page() {
    global $homemarket_theme_options;

    parse_str($_SERVER['QUERY_STRING'], $params);

    // replace it with theme option
    if ($homemarket_theme_options['products_item']) {
        $per_page = explode(',', $homemarket_theme_options['products_item']);
    } else {
        $per_page = explode(',', '12,24,36');
    }

    $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];

    return $item_count;
}

function homemarket_woocommerce_share() {
    global $homemarket_theme_options;

    if ( (isset($homemarket_theme_options['product_share_links']))  && ($homemarket_theme_options['product_share_links'] == '1') ) {
        get_template_part('share');
    }
}

function homemarket_product_get_sidebar() {
    wc_get_template( 'global/product-sidebar.php' );
}

function homemarket_woocommerce_custom_tab( $tabs ) {
    global $homemarket_theme_options;

    $custom_tabs_count = isset($homemarket_theme_options['product_custom_tabs_count']) ? $homemarket_theme_options['product_custom_tabs_count'] : '3';
    if ($custom_tabs_count) {
        for ($i = 0; $i < $custom_tabs_count; $i++) {
            $index = $i + 1;

            $custom_tab_title = get_post_meta(get_the_id(), 'custom_tab_title'.$index, true);
            $custom_tab_priority = (int)get_post_meta(get_the_id(), 'custom_tab_priority'.$index, true);
            if (!$custom_tab_priority)
                $custom_tab_priority = 40 + $i;
            $custom_tab_content = get_post_meta(get_the_id(), 'custom_tab_content'.$index, true);

            if ($custom_tab_title && $custom_tab_content) {
                $tabs['custom_tab'.$index] = array(
                    'title'     => force_balance_tags($custom_tab_title),
                    'priority'  => $custom_tab_priority,
                    'callback'  => 'homemarket_woocommerce_custom_tab_content',
                    'content' => do_shortcode(wpautop($custom_tab_content))
                );
            }
        }
    }

    return $tabs;
}

function homemarket_woocommerce_custom_tab_content( $key, $tab ) {
    echo $tab['content'];
}

function homemarket_woocommerce_default_product_tabs( $tabs = array() ) {
    global $product, $post;

        // Description tab - shows product content
        if ( $post->post_content ) {
            $tabs['description'] = array(
                'title'    => __( 'Description', 'homemarket' ),
                'priority' => 10,
                'callback' => 'woocommerce_product_description_tab'
            );
        }

        /*// Additional information tab - shows attributes
        if ( $product && ( $product->has_attributes() || ( $product->enable_dimensions_display() && ( $product->has_dimensions() || $product->has_weight() ) ) ) ) {
            $tabs['additional_information'] = array(
                'title'    => __( 'Additional Information', 'homemarket' ),
                'priority' => 20,
                'callback' => 'woocommerce_product_additional_information_tab'
            );
        }*/

        // Reviews tab - shows comments
        if ( comments_open() ) {
            $tabs['reviews'] = array(
                'title'    => sprintf( __( 'Customer Reviews (%d)', 'homemarket' ), $product->get_review_count() ),
                'priority' => 99,
                'callback' => 'comments_template'
            );
        }

        return $tabs;
}

function homemarket_woo_review_gravatar_size( $size ) {
    return '80';
}

function comment_fields_reorder( $comment_fields ) { 
    $temp = $comment_fields['comment'];
    unset( $comment_fields['comment'] );
    $comment_fields['comment'] = $temp;
    return $comment_fields;
}

function homemarket_remove_related_products( $args ) {
    global $homemarket_theme_options;

    if ( isset( $homemarket_theme_options['related_products_show'] )  && !$homemarket_theme_options['related_products_show'] )
        return array();
    return $args;
}

function woocommerce_custom_add_message_box( $message ) {
    if (strpos($message, 'product_notification_background') === false):
        return '<div class="woocommerce-message-wrapper"><span class="success-icon"><i class="fa fa-shopping-cart"></i></span><span class="notice_text">'. $message .'</span></div>';
    else:
        return $message;
    endif;
}

// function custom_add_to_cart_message( $message ) {
//     return '<div class="woocommerce-message-wrapper"><span class="success-icon"><i class="fa fa-shopping-cart"></i></span><span class="notice_text">'. $message .'</span></div>';
// }

function homemarket_show_mini_cart() {
    return false;
}

function homemarket_shortcode_products_ids_callback($query) {
    if (class_exists('Vc_Vendor_Woocommerce')) {
        $vc_vendor_wc = new Vc_Vendor_Woocommerce();
        return $vc_vendor_wc->productIdAutocompleteSuggester($query);
    }
    return '';
}

function homemarket_shortcode_products_ids_render($query) {
    if (class_exists('Vc_Vendor_Woocommerce')) {
        $vc_vendor_wc = new Vc_Vendor_Woocommerce();
        return $vc_vendor_wc->productIdAutocompleteRender($query);
    }
    return '';
}

function homemarket_shortcode_products_ids_param_value($current_value, $param_settings, $map_settings, $atts) {
    if (class_exists('Vc_Vendor_Woocommerce')) {
        $vc_vendor_wc = new Vc_Vendor_Woocommerce();
        return $vc_vendor_wc->productsIdsDefaultValue($current_value, $param_settings, $map_settings, $atts);
    }
    return '';
}

function homemarket_woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>

    <span id="CartCount"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>

    <?php 
    $fragments['span#CartCount'] = ob_get_clean();
    
    return $fragments;
}
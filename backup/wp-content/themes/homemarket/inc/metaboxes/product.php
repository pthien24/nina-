<?php

// Meta Fields
function homemarket_product_meta_fields() {
    global $homemarket_theme_options;

    $custom_tabs_count = isset($homemarket_theme_options['product_custom_tabs_count']) ? $homemarket_theme_options['product_custom_tabs_count'] : '3';
    $custom_tabs = array();
    if ($custom_tabs_count) {
        for ($i = 0; $i < $custom_tabs_count; $i++) {
            $tab_priority = 40 + $i;
            $index = $i + 1;

            // Custom Tab Title
            $custom_tabs['custom_tab_title'.$index] = array(
                'name' => 'custom_tab_title'.$index,
                'title' => sprintf( __( 'Product Custom Tab %d Title', 'homemarket' ), $index ),
                'type' => 'text'
            );

            // Content Tab Content
            $custom_tabs['custom_tab_content'.$index] = array(
                'name' => 'custom_tab_content'.$index,
                'title' => sprintf( __( 'Product Custom Tab %d Content', 'homemarket' ), $index ),
                'type' => 'editor'
            );

            // Content Tab Priority
            $custom_tabs['custom_tab_priority'.$index] = array(
                'name' => 'custom_tab_priority'.$index,
                'title' => sprintf( __( 'Product Custom Tab %d Priority', 'homemarket' ), $index ),
                'desc' => __('Input the custom tab priority. (Description: 10, Additional Information: 20, Reviews: 30, Default Global Tab: 60)', 'homemarket'),
                'type' => 'text',
                'default' => $tab_priority
            );
        }
    }

    $meta_fields = array_merge($custom_tabs, array( ));

    return $meta_fields;
}

// Show Meta Boxes
add_action('add_meta_boxes', 'homemarket_add_product_meta_boxes');
function homemarket_add_product_meta_boxes() {
    if (!function_exists('get_current_screen')) return;

    $screen = get_current_screen();
    if ( function_exists('add_meta_box') && $screen && $screen->base == 'post' && $screen->id == 'product' ) {
        add_meta_box( 'product-meta-box', __('Product Custom Options', 'homemarket'), 'homemarket_product_meta_box', 'product', 'normal', 'high' );
    }
}

function homemarket_product_meta_box() {
    $meta_fields = homemarket_product_meta_fields();
    homemarket_show_meta_box($meta_fields);
}

// Save Meta Values
add_action('save_post', 'homemarket_save_product_meta_values');
function homemarket_save_product_meta_values( $post_id ) {
    if (!function_exists('get_current_screen')) return;
    $screen = get_current_screen();
    if ($screen && $screen->base == 'post' && $screen->id == 'product') {
        homemarket_save_meta_value( $post_id, homemarket_product_meta_fields() );
    }
}

// Remove in default custom field meta box
add_filter('is_protected_meta', 'homemarket_product_protected_meta', 10, 3);
function homemarket_product_protected_meta($protected, $meta_key, $meta_type) {
    if (!function_exists('get_current_screen')) return $protected;
    $screen = get_current_screen();
    if (!$protected && $screen && $screen->base == 'post' && $screen->id == 'product') {
        if ( array_key_exists($meta_key, homemarket_product_meta_fields()) )
            $protected = true;
    }
    return $protected;
}
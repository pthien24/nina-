<?php
/*
Plugin Name: Homemarket Taxonomies
Plugin URI: http://soaptheme.net/wordpress/homemarket/plugins/taxonomy
Description: Taxonomies for Homemarket Wordpress Theme.
Version: 1.0
Author: SoapTheme
Author URI: http://soaptheme.net/wordpress/homemarket/plugins/taxonomy
*/

if (!defined('ABSPATH'))
    die('-1');

define('HOMEMARKET_TAXONOMY_URL', dirname(__FILE__));

// create Brand Taxonomy for Products
function create_brand_taxonomy() {

	$labels = array(
		'name'                        => __( 'Product Brands', 'homemarket' ),
		'singular_name'               => __( 'Product Brand', 'homemarket' ),
		'menu_name'                   => __( 'Product Brand', 'homemarket' ),
		'all_items'                   => __( 'All Product Brands', 'homemarket' ),
		'popular_items'               => __( 'Popular Product Brands', 'homemarket' ),
		'search_items'                => __( 'Search Product Brands', 'homemarket' ),
		'edit_item'                   => __( 'Edit Product Brand', 'homemarket' ),
		'update_item'                 => __( 'Update Product Brand', 'homemarket' ),
		'add_new_item'                => __( 'Add New Product Brand', 'homemarket' ),
		'new_item_name'               => __( 'New Product Brand Name', 'homemarket' ),
		'separate_items_width_commas' => __( 'Separate Product Brand with commas', 'homemarket' ),
		'add_or_remove_items'         => __( 'Add or Remove Product Brands', 'homemarket' ),
		'choose_from_most_used'       => __( 'Choose from the most used Product Brands', 'homemarket' ),
		'not_found'                   => __( 'No Product Brand found', 'homemarket' ),
	);

	$args =  array(
		'labels'                     => $labels,
	    'hierarchical'               => true,
	    'public'                     => true,
	    'show_ui'                    => true,
	    'show_admin_column'          => true,
	    'show_in_nav_menus'          => true,
	    'show_tagcloud'              => true,
	    'rewrite'                    => array( 'slug' => 'product-brands' ),
	);

	register_taxonomy( 'brand_taxonomy', 'product', $args );
	register_taxonomy_for_object_type( 'brand_taxonomy', 'product' );

	include (HOMEMARKET_TAXONOMY_URL . '/custom_product_taxonomy.php');
}

add_action('init', 'create_brand_taxonomy', 8);
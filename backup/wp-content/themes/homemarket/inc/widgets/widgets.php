<?php

// Homemarket Widgets

if (!defined('ABSPATH'))
    die('-1');

define( 'HOMEMARKET_WIDGETS_PATH',   get_template_directory() . '/inc/widgets/widgets/' );

class HomemarketWidgetsClass {

	private $widgets =  array( "contact_info", "social_link", "recent_posts", "ajax_filter_taxonomies", "ajax_fitler_price", "best_seller", "image_blog", "product_extrainfo" );

	function __construct() {
		$this->loadWidgets();
	}

	function loadWidgets() {
		foreach ($this->widgets as $widget) {
            require_once(HOMEMARKET_WIDGETS_PATH . $widget . '.php');
        }
	}

}

// Initialize Code
new HomemarketWidgetsClass();


// Register sidebars and widgetized area

add_action( 'widgets_init', 'homemarket_register_sidebars' );

function homemarket_register_sidebars() {

	register_sidebar( array(
        'name' => __('Blog Sidebar', 'homemarket'),
        'id' => 'blog-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Post Sidebar', 'homemarket'),
        'id' => 'post-sidebar',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ) );

    register_sidebar( array(
        'name' => __('Woo Category Sidebar', 'homemarket'),
        'id' => 'woo-category-sidebar',
        'before_widget' => '<aside id="%1$s" class="sidebar %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="sidebar-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Woo Product Sidebar', 'homemarket'),
        'id' => 'woo-product-sidebar',
        'before_widget' => '<aside id="%1$s" class="sidebar %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="sidebar-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Top Widget', 'homemarket'),
        'id' => 'footer-top-widget',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Widget 1', 'homemarket'),
        'id' => 'footer-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Widget 2', 'homemarket'),
        'id' => 'footer-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Widget 3', 'homemarket'),
        'id' => 'footer-column-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Widget 4', 'homemarket'),
        'id' => 'footer-column-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Bottom Widget', 'homemarket'),
        'id' => 'footer-bottom-widget',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

}
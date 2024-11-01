<?php 

// File security Check

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// ! Removing unwanted shortcodes
vc_remove_element('vc_progress_bar');

// param value fields

$args = array(
	'type' => 'post',
	'child_of' => 0,
	'parent' => '',
	'orderby' => 'id',
	'order' => 'ASC',
	'hide_empty' => false,
	'hierarchical' => 1,
	'exclude' => '',
	'include' => '',
	'number' => '',
	'taxonomy' => 'product_cat',
	'pad_counts' => false,

);

$order_by_values = array(
	'',
	__( 'Date', 'homemarket' ) => 'date',
	__( 'ID', 'homemarket' ) => 'ID',
	__( 'Author', 'homemarket' ) => 'author',
	__( 'Title', 'homemarket' ) => 'title',
	__( 'Modified', 'homemarket' ) => 'modified',
	__( 'Random', 'homemarket' ) => 'rand',
	__( 'Comment count', 'homemarket' ) => 'comment_count',
	__( 'Menu order', 'homemarket' ) => 'menu_order',
);

$order_way_values = array(
	'',
	__( 'Descending', 'homemarket' ) => 'DESC',
	__( 'Ascending', 'homemarket' ) => 'ASC',
);

/********************* Get Created Menu Name *********************/

$menu_names = array();
$menus = get_registered_nav_menus();

foreach ( $menus as $location => $description ) {
	$menu_names[0] = esc_html__( 'Select Menu', 'homemarket' );
	$menu_names[$description] = $location;
}


/********************* Get Created Product Brands *********************/

$brand_names = array();
$category_names = array();
$brand_terms = get_terms( 'brand_taxonomy', array('hide_empty' => false) );
$category_terms = get_terms( 'product_cat', array('hide_empty' => false) );

foreach ($brand_terms as $brand_term) {
	if ( $brand_term->taxonomy == "brand_taxonomy") {
		$brand_names[0] = esc_html__( 'Select Product Brand', 'homemarket' );
		$brand_names[$brand_term->slug] = $brand_term->name;	
	}
}

foreach ($category_terms as $category_term) {
	$category_names[0] = '';
	$category_names[$category_term->name] = $category_term->slug;
}


/********************* Get Product Category *********************/

$categories = get_categories( $args );
$product_categories_dropdown = array();

foreach( $categories as $category ) {
	$product_categories_dropdown[0] = '';
	$product_categories_dropdown[$category->name] = $category->slug;
}

/* Custom Params */
$extra_class = array(
	'type'        => 'textfield',
	'heading'     => esc_html__( 'Extra class name', 'homemarket' ),
	'param_name'  => 'class',
	'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'homemarket' )
);

/* Custom Row */
vc_add_param( 'vc_row', array(
	'type'        => 'checkbox',
	'heading'     => __( 'Wrap as Container', 'homemarket' ),
	'param_name'  => 'wrap_container',
	'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
	'group'       => __( 'Container Option', 'homemarket' ),
	'admin_label' => true,
) );

/* Custom Old Tabs */
WPBMap::modify('vc_tabs', 'deprecated', false);
WPBMap::modify('vc_tabs', 'category', esc_html__( 'by SoapTheme', 'homemarket' ));
WPBMap::modify('vc_tabs', 'name', __('Homemarket Tabs', 'homemarket'));
WPBMap::modify('vc_tab', 'name', __('Homemarket Tab', 'homemarket'));
WPBMap::modify('vc_tabs', 'description', __( 'Tabbed content', 'homemarket' ) . __(' with homemarket style','homemarket'));

vc_add_param( 'vc_tabs', array(
	'type'        => 'dropdown',
	'heading'     => __( 'Tab Style', 'homemarket' ),
	'param_name'  => 'tab_style',
	'value'       => array(
		esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
		esc_html__( 'Style 2', 'homemarket' ) => 'style-2',
		esc_html__( 'Style 3', 'homemarket' ) => 'style-3',
	),
	'admin_label' => true,
) );


/* Custom Menu Shortcode */
vc_map( array(
	'name'        => esc_html__( 'Custom Menu', 'homemarket' ),
	'base'        => 'custom_menu',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__('Display custom menu', 'homemarket' ),
	'params'      => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Custom Menu List', 'homemarket' ),
			'param_name'  => 'menu_name',
			'value'       => $menu_names,
			'description' => ''
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Custom Menu Title', 'homemarket' ),
			'param_name'  => 'menu_title',
			'description' => esc_html__( 'Enter menu title. If you don`t enter the title, default value is "All Collections"', 'homemarket' ),
			'std'         => esc_html__('All Collections', 'homemarket' ),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Menu Title bg Color', 'homemarket' ),
			'param_name'  => 'title_bg_color' ,
			'value'       => '#000000',
		),
		$extra_class
	)
) );

/* flexSlider Shortcode */
vc_map( array(
	'name'            => esc_html__( 'Flex Slider', 'homemarket' ),
	'base'            => 'flexslider',
	'icon'            => 'homemarket-js-composer',
	'as_parent'       => array( 'only' => 'flexslider_individual' ),
	'category'        => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description'     => esc_html__( 'FlexSlider Individual wrapper', 'homemarket' ),
	'params'          => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Animation', 'homemarket' ),
			'param_name'  => 'animation_type',
			'description' => esc_html__( 'FlexSlider Animation Type', 'homemarket' ),
			'value'       => array(
				esc_html__( 'Fade', 'homemarket' )   => 'fade',
				esc_html__( 'Slider', 'homemarket' ) => 'slide'
			)
		),
		$extra_class
	),
	'js_view' => 'VcColumnView',
	'default_content' => '[flexslider_individual][/flexslider_individual]'
) );

vc_map( array(
	'name'            => esc_html__( 'Flex Slider Individual', 'homemarket' ),
	'base'            => 'flexslider_individual',
	'icon'            => 'homemarket-js-composer',
	'as_child' 		  => array( 'only' => 'flexslider' ),
	'category'        => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description'     => esc_html__( 'FlexSlider Individual content', 'homemarket' ),
	'params'          => array(
		array(
			'type'  => 'attach_image',
			'heading' => esc_html__( 'Slider Featured Image', 'homemarket' ),
			'param_name' => 'flex_featured_img',
			'description' => esc_html__( 'Select Slider Featured Image', 'homemarket' )
		),
		array(
			'type'  => 'attach_image',
			'heading' => esc_html__( 'Slider Thumbnail Image', 'homemarket' ),
			'param_name' => 'flex_thumbnail_img',
			'description' => esc_html__( 'Select Slider Thumbnail Image', 'homemarket' )
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Slider Thumbnail Title', 'homemarket' ),
			'param_name'  => 'flex_thumbnail_title',
			'description' => esc_html__( 'This title is only for Thumbnail Slider.', 'homemarket' )
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Slider Thumbnail Description', 'homemarket' ),
			'param_name'  => 'flex_thumbnail_dec',
			'description' => esc_html__( 'This description is only for Thumbnail Slider.', 'homemarket' )
		),
		$extra_class
	)
) );

/* Product Brands Shortcode */
vc_map( array(
	'name'        => esc_html__( 'Product Brands', 'homemarket' ),
	'base'        => 'product_brands',
	'icon'        => 'homemarket-js-composer',
	'as_parent'   => array( 'only' => 'product_brand' ),
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Display Product Brands Mark', 'homemarket' ),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'homemarket' ),
			'param_name'  => 'brands_part_title',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Setting', 'homemarket' ),
			'param_name'  => 'display_set',
			'value' => array(
				esc_html__( 'Grid', 'homemarket' ) => 'grid',
				esc_html__( 'Carousel', 'homemarket' ) => 'carousel',
			),
			'std'         => 'grid',
			'description' => ''
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Columns Setting', 'homemarket' ),
			'param_name'  => 'columns',
			'value' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
			'description' => ''
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Carousel Navigation Style', 'homemarket' ),
			'param_name'  => 'carousel_nav',
			'value'       => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2',
			),
			'dependency'  => array(
				'element' => 'display_set',
				'value'   => 'carousel'
			),
		),
		array(
            'type'        => 'checkbox',
            'heading'     => __( 'Border Box Layout', 'homemarket' ),
            'param_name'  => 'border_box',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
        ),
		$extra_class
	),
	'js_view' => 'VcColumnView',
	'default_content' => '[product_brand][/product_brand]'
) );

vc_map( array(
	'name'        => esc_html__( 'Product Brand', 'homemarket' ),
	'base'        => 'product_brand',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'as_child'    => array( 'only' => 'product_brands' ),
	'description' => esc_html__( 'Display Product Brand Mark', 'homemarket' ),
	'params'      => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Product Brand List', 'homemarket' ),
			'param_name'  => 'brand_name',
			'value'       => $brand_names,
			'description' => ''
		),
		$extra_class
	),
) );

/* Custom Products By Category */
vc_map( array(
	'name'        => esc_html__( 'Product Category', 'homemarket' ),
	'base'        => 'product_category_carousel',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Show multiple products in a category using Carousel', 'homemarket' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Title', 'homemarket' ),
			'param_name' => 'part_title',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Display Style', 'homemarket' ),
			'param_name' => 'display_style',
			'value'      => array(
				esc_html__( 'Carousel', 'homemarket' ) => 'carousel',
				esc_html__( 'Grid', 'homemarket' ) => 'grid',
			),
			'std'        => 'carousel',
			'description'=> ''
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Category', 'homemarket' ),
			'param_name'  => 'category',
			'value'       => $product_categories_dropdown,
			'save_always' => true,
			'description' => esc_html__( 'Product category list', 'homemarket' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'homemarket' ),
			'value'       => 12,
			'save_always' => true,
			'param_name'  => 'per_page',
			'description' => esc_html__( 'How much items per page to show', 'homemarket' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Columns', 'homemarket' ),
			'value'       => 4,
			'save_always' => true,
			'param_name'  => 'columns',
			'description' => __( 'How much columns grid', 'homemarket' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order by', 'homemarket' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => esc_html__( 'Select how to sort retrieved products.', 'homemarket' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Sort order', 'homemarket' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => esc_html__( 'Designates the ascending or descending order.', 'homemarket' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Carousel Navigation Style', 'homemarket' ),
			'param_name'  => 'carousel_nav',
			'value'       => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2'
			),
			'dependency'  => array(
				'element' => 'display_style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
            'type'        => 'checkbox',
            'heading'     => __( 'Border Box Layout', 'homemarket' ),
            'param_name'  => 'border_box',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
		array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Product Rating', 'homemarket' ),
            'param_name'  => 'hidden_rating',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Product Title', 'homemarket' ),
            'param_name'  => 'hidden_title',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Product Price', 'homemarket' ),
            'param_name'  => 'hidden_price',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Product Description', 'homemarket' ),
            'param_name'  => 'hidden_desc',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
            'dependency' => array(
                'element' => 'display_style',
                'value'   => 'list'
            )
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Cart Button', 'homemarket' ),
            'param_name'  => 'hidden_cart_btn',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
		$extra_class
	),
) );

/* Custom Sale Products */
vc_map( array(
	'name'        => esc_html__( 'Sale Products', 'homemarket' ),
	'base'        => 'sale_product_carousel',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'List all products on sale using Carousel', 'homemarket' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Title', 'homemarket' ),
			'param_name' => 'part_title',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Display Style', 'homemarket' ),
			'param_name' => 'display_style',
			'value'      => array(
				esc_html__( 'Carousel', 'homemarket' ) => 'carousel',
				esc_html__( 'Grid', 'homemarket' ) => 'grid',
				esc_html__( 'List', 'homemarket' ) => 'list',
			),
			'std'        => 'carousel',
			'description'=> ''
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'homemarket' ),
			'value'       => 12,
			'save_always' => true,
			'param_name'  => 'per_page',
			'description' => esc_html__( 'How much items per page to show', 'homemarket' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Columns', 'homemarket' ),
			'value'       => 4,
			'save_always' => true,
			'param_name'  => 'columns',
			'description' => __( 'How much columns grid', 'homemarket' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order by', 'homemarket' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => esc_html__( 'Select how to sort retrieved products.', 'homemarket' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Sort order', 'homemarket' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => esc_html__( 'Designates the ascending or descending order.', 'homemarket' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Carousel Navigation Style', 'homemarket' ),
			'param_name'  => 'carousel_nav',
			'value'       => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2'
			),
			'dependency'  => array(
				'element' => 'display_style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
            'type'        => 'checkbox',
            'heading'     => __( 'Border Box Layout', 'homemarket' ),
            'param_name'  => 'border_box',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
		array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Product Rating', 'homemarket' ),
            'param_name'  => 'hidden_rating',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Product Title', 'homemarket' ),
            'param_name'  => 'hidden_title',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Product Price', 'homemarket' ),
            'param_name'  => 'hidden_price',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Product Description', 'homemarket' ),
            'param_name'  => 'hidden_desc',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
            'dependency' => array(
                'element' => 'display_style',
                'value'   => 'list'
            )
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Hidden Cart Button', 'homemarket' ),
            'param_name'  => 'hidden_cart_btn',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Layout', 'homemarket' ),
        ),
		$extra_class
	),
) );

/* Category Link with Image */
vc_map( array(
	'name'       => esc_html__( 'Image Blogs', 'homemarket' ),
	'base'       => 'category_link_imgs',
	'icon'       => 'homemarket-js-composer',
	'as_parent'   => array( 'only' => 'category_link_img' ),
	'category'   => esc_html__( 'by SoapTheme', 'homemarket' ),
	'params'     => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Display Columns Setting', 'homemarket' ),
			'param_name' => 'columns',
			'value' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
		),
		$extra_class
	),
	'js_view' => 'VcColumnView',
	'default_content' => '[category_link_img][/category_link_img]'
) );

vc_map( array(
	'name'        => esc_html__( 'Image Blog', 'homemarket' ),
	'base'        => 'category_link_img',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Show Image with created category link', 'homemarket' ),
	'params'      => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Select Category or Taxonomy', 'homemarket' ), 
			'param_name'  => 'category_taxonomy',
			'value' => array(
                esc_html__( 'Category', 'homemarket' ) => 'category',
                esc_html__( 'Taxonomy', 'homemarket' ) => 'taxonomy',
                esc_html__( 'Custom', 'homemarket' ) => 'custom',
            ),
            'std' => 'category',
            'description' => ''
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Category Llist', 'homemarket' ),
			'param_name' => 'seleted_category',
			'value'      => $product_categories_dropdown,
			'dependency' => array(
				'element' => 'category_taxonomy',
				'value'   => 'category'
			)
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Taxonomy Llist', 'homemarket' ),
			'param_name' => 'seleted_taxonomy',
			'value'      => $brand_names,
			'dependency' => array(
				'element' => 'category_taxonomy',
				'value'   => 'taxonomy'
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Custom Link', 'homemarket' ),
			'param_name'  => 'custom_link',
			'description' => esc_html__( 'Enter the Custom Link (http://)', 'homemarket' ),
			'dependency' => array(
				'element' => 'category_taxonomy',
				'value'   => 'custom'
			)
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Image', 'homemarket' ),
			'param_name'  => 'featured_img',
			'description' => esc_html__( 'Featured Link Image', 'homemarket' )
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Image Size', 'homemarket' ),
			'param_name'  => 'image_size',
			'description' => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). If you want to use theme default size, please leave this field as blank.', 'homemarket' ),
			'std' => 'full',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Title', 'homemarket' ),
			'param_name' => 'image_title',
			'group'      => esc_html__( 'Text & Animation', 'homemarket' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'SubTitle', 'homemarket' ),
			'param_name' => 'image_subtitle',
			'group'      => esc_html__( 'Text & Animation', 'homemarket' ),
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Text Color', 'homemarket' ),
			'param_name' => 'image_text_color',
			'group'      => esc_html__( 'Text & Animation', 'homemarket' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Text Align', 'homemarket' ),
			'param_name' => 'image_text_align',
			'value'      => array(
				esc_html__( 'Left', 'homemarket' )     => 'left',
				esc_html__( 'Center', 'homemarket' ) => 'center',
				esc_html__( 'Right', 'homemarket' ) => 'right'
			),
			'group'      => esc_html__( 'Text & Animation', 'homemarket' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Hover Animation', 'homemarket' ),
			'param_name' => 'hover_animation',
			'value'      => array(
				esc_html__( 'None', 'homemarket' )     => 'none',
				esc_html__( 'Effect 1', 'homemarket' ) => 'effect-1',
				esc_html__( 'Effect 2', 'homemarket' ) => 'effect-2',
				esc_html__( 'Effect 3', 'homemarket' ) => 'effect-3',
				esc_html__( 'Effect 4', 'homemarket' ) => 'effect-4',
				esc_html__( 'Effect 5', 'homemarket' ) => 'effect-5'
			),
			'group'      => esc_html__( 'Text & Animation', 'homemarket' ),
		),
		$extra_class
	),
) );

/* Custom Info Box */
vc_map( array(
	'name'        => esc_html__( 'Info Box', 'homemarket' ),
	'base'        => 'theme_info_box',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Add icon box with custom font icon', 'homemarket' ),
	'params'      => array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Icon library', 'homemarket' ),
			'param_name' => 'info_box_icon_type',
			'value'      => array(
				esc_html__( 'Font Awesome', 'homemarket' )      => 'fontawesome',
				esc_html__( 'Custom Image Icon', 'homemarket' ) => 'image',
			),
		),
		array(
			'type'       => 'iconpicker',
			'heading'    => esc_html__( 'Select Icon', 'homemarket' ),
			'param_name' => 'theme_divider_icon',
			'dependency' => array( 
				'element' => 'info_box_icon_type',
				'value'   => 'fontawesome'
			),
		),
		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Select Icon', 'homemarket' ),
			'param_name' => 'theme_divider_image',
			'dependency' => array( 
				'element' => 'info_box_icon_type',
				'value'   => 'image'
			),	
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Size of Icon(px)', 'homemarket' ),
			'value'       => 14,
			'save_always' => true,
			"min" => 12,
			"max" => 72,
			'param_name'  => 'icon_size',
			'description' => __( 'How big would you like it?', 'homemarket' ),
			'dependency' => array( 
				'element' => 'info_box_icon_type',
				'value'   => 'fontawesome'
			),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Icon Font Color', 'homemarket' ),
			'param_name'  => 'icon_font_color' ,
			'value'       => '#ffffff',
			'dependency' => array( 
				'element' => 'info_box_icon_type',
				'value'   => 'fontawesome'
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Image Width(px)', 'homemarket' ),
			'value'       => 48,
			'save_always' => true,
			"min" => 12,
			"max" => 100,
			'param_name'  => 'img_icon_width',
			'description' => __( 'Provide Image Width', 'homemarket' ),
			'dependency' => array( 
				'element' => 'info_box_icon_type',
				'value'   => 'image'
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Icon Style', 'homemarket' ),
			'param_name' => 'info_box_icon_style',
			'value'      => array(
				esc_html__( 'None', 'homemarket' )      => 'none',
				esc_html__( 'Circle Background', 'homemarket' ) => 'circle',
				esc_html__( 'Square Background', 'homemarket' ) => 'square',
			),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Background Color', 'homemarket' ),
			'param_name'  => 'icon_font_background' ,
			'value'       => '#fa5555',
			'dependency'  => array( 
				'element' => 'info_box_icon_style',
				'value'   => array(
					'circle', 'square'
				),
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'homemarket' ),
			'param_name'  => 'info_box_title',
			'description' => esc_html__( 'Provide the title for this icon box', 'homemarket' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Title Font Weight', 'homemarket' ),
			'param_name' => 'title_font_weight',
			'value'      => array(
				esc_html__( 'Initial', 'homemarket' ) => 'initial',
				esc_html__( 'Normal', 'homemarket' ) => 'normal',
				esc_html__( 'Bold', 'homemarket' ) => 'bold',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title Font Size(px)', 'homemarket' ),
			'value'       => 14,
			'save_always' => true,
			'min' => 12,
			'max' => 50,
			'param_name'  => 'title_font_size',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title Bottom Space', 'homemarket' ),
			'value'       => 10,
			'save_always' => true,
			'min' => 0,
			'max' => 30,
			'param_name'  => 'title_bottom_space',
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => esc_html__( 'Description', 'homemarket' ),
			'param_name'  => 'info_box_description',
			'description' => esc_html__( 'Provide the description for this icon box', 'homemarket' ),	
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Text Color', 'homemarket' ),
			'param_name'  => 'text_font_color' ,
			'value'       => '#696969',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Text Vertical Align', 'homemarket' ),
			'param_name'  => 'text_vertical_align',
			'value'       => array(
				esc_html__( 'Normal', 'homemarket' ) => 'normal',
				esc_html__( 'Middle', 'homemarket' ) => 'middle'
			),
		),
		$extra_class
	),
) );

/* Google Map */
vc_map( array(
	'name'        => esc_html__( 'Google Map', 'homemarket' ),
	'base'        => 'theme_google_map',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Add Google Map on current page', 'homemarket' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Width (in %)', 'homemarket' ),
			'value'      => '100%',
			'param_name' => 'map_width',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Height (in px)', 'homemarket' ),
			'value'      => '500px',
			'param_name' => 'map_height',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Map Type', 'homemarket' ),
			'param_name' => 'map_type',
			'value'      => array(
				esc_html__( 'Roadmap', 'homemarket' ) => 'ROADMAP',
				esc_html__( 'Satellite', 'homemarket' ) => 'SATELLITE',
				esc_html__( 'Hybrid', 'homemarket' ) => 'HYBRID',
				esc_html__( 'Terrain', 'homemarket' ) => 'TERRAIN',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Map Center Position', 'homemarket' ),
			'description' => esc_html__( 'input Latitude & Longitude like this: 22.491, 89.758', 'homemarket' ),
			'param_name'  => 'map_center_posi'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Map Zoom', 'homemarket' ),
			'value'       => 12,
			'save_always' => true,
			'min'         => 1,
			'max'         => 20,
			'param_name'  => 'map_zoom',
			'description' => esc_html__( 'Max:20 Min:1', 'homemarket' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Map Type Control', 'homemarket' ),
			'param_name' => 'map_type_control',
			'value'      => array(
				esc_html__( 'Enable', 'homemarket' ) => 'true',
				esc_html__( 'Disable', 'homemarket' ) => 'false',
			),
			"group" => __('Advanced', 'homemarket'),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Map Navigation Control', 'homemarket' ),
			'param_name' => 'map_navigation_control',
			'value'      => array(
				esc_html__( 'Enable', 'homemarket' ) => 'true',
				esc_html__( 'Disable', 'homemarket' ) => 'false',
			),
			"group" => __('Advanced', 'homemarket'),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Map Scroll Wheel Control', 'homemarket' ),
			'param_name' => 'map_scroll_control',
			'value'      => array(
				esc_html__( 'Enable', 'homemarket' ) => 'true',
				esc_html__( 'Disable', 'homemarket' ) => 'false',
			),
			"group" => __('Advanced', 'homemarket'),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Map Street View Control', 'homemarket' ),
			'param_name' => 'map_street_view_control',
			'value'      => array(
				esc_html__( 'Enable', 'homemarket' ) => 'true',
				esc_html__( 'Disable', 'homemarket' ) => 'false',
			),
			"group" => __('Advanced', 'homemarket'),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Map Draggable Control', 'homemarket' ),
			'param_name' => 'map_draggale_control',
			'value'      => array(
				esc_html__( 'Enable', 'homemarket' ) => 'true',
				esc_html__( 'Disable', 'homemarket' ) => 'false',
			),
			"group" => __('Advanced', 'homemarket'),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Marker/Point icon', 'homemarket' ),
			'param_name' => 'map_marker_icon',
			'value'      => array(
				esc_html__( 'Use Google Default', 'homemarket' ) => 'default',
				esc_html__( 'Upload Custom Icon', 'homemarket' ) => 'custom_icon',
			),
			"group" => __('Marker', 'homemarket'),
		),
		array(
			'type'  => 'attach_image',
			'heading' => esc_html__( 'Upload Image Icon:', 'homemarket' ),
			'param_name' => 'map_custom_icon',
			'description' => esc_html__( 'Upload the custom image icon.', 'homemarket' ),
			'dependency' => array( 
				'element' => 'map_marker_icon',
				'value'   => 'custom_icon'
			),
			"group" => __('Marker', 'homemarket'),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Google Styled Map', 'homemarket' ),
			'param_name'  => 'map_styled',
			'value'      => array(
				esc_html__( 'Google Default Style', 'homemarket' ) => 'default',
				esc_html__( 'Ultra Light with Labels', 'homemarket' ) => 'ultra_light',
				esc_html__( 'Subtle Grayscale', 'homemarket' ) => 'subtle_gray',
				esc_html__( 'Shades of Grey', 'homemarket' ) => 'shades_grey',
				esc_html__( 'Blue Water', 'homemarket' ) => 'blue_water',
				esc_html__( 'Blue Dark Sea', 'homemarket' ) => 'blue_dark_sea',
				esc_html__( 'Midnight Commander', 'homemarket' ) => 'midnight_commander',
			),
			"group" => __('Styling', 'homemarket'),
		),
		$extra_class
	),
) );

/* Masonry View */
vc_map( array(
	'name'        => esc_html__( 'Masonry Images', 'homemarket' ),
	'base'        => 'theme_masonry_view',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Image Viewer by masonry', 'homemarket' ),
	'params'      => array(
		array(
			'type'    => 'attach_images',
			'heading' => esc_html__( 'Masonry Images', 'homemarket' ),
			'param_name' => 'masonry_image_lists',
			'description' => esc_html__( 'Upload the masonry images', 'homemarket' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'CSS Animation', 'homemarket' ),
			'param_name'  => 'masonry_image_effect',
			'value'      => array(
				esc_html__( 'Effect 1', 'homemarket' ) => 'effect-1',
				esc_html__( 'Effect 2', 'homemarket' ) => 'effect-2',
				esc_html__( 'Effect 3', 'homemarket' ) => 'effect-3',
				esc_html__( 'Effect 4', 'homemarket' ) => 'effect-4',
				esc_html__( 'Effect 5', 'homemarket' ) => 'effect-5',
				esc_html__( 'Effect 6', 'homemarket' ) => 'effect-6',
				esc_html__( 'Effect 7', 'homemarket' ) => 'effect-7',
				esc_html__( 'Effect 8', 'homemarket' ) => 'effect-8',
			),
		),
		$extra_class
	),
) );

/* Featured Categories */
vc_map( array(
	'name'        => esc_html__( 'Featured Categories', 'homemarket' ),
	'base'        => 'featured_categories',
	'icon'        => 'homemarket-js-composer',
	'as_parent'   => array( 'only' => 'featured_cateogry' ),
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Display featured category with image', 'homemarket' ),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'homemarket' ),
			'param_name'  => 'featured_part_title',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Setting', 'homemarket' ),
			'param_name'  => 'display_set',
			'value' => array(
				esc_html__( 'Grid', 'homemarket' ) => 'grid',
				esc_html__( 'Carousel', 'homemarket' ) => 'carousel',
			),
			'std'         => 'grid',
			'description' => ''
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Columns Setting', 'homemarket' ),
			'param_name'  => 'columns',
			'value' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
			'description' => ''
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Carousel Navigation Style', 'homemarket' ),
			'param_name'  => 'carousel_nav',
			'value'       => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2'
			),
			'dependency'  => array(
				'element' => 'display_set',
				'value'   => array(
					'carousel',
				),
			),
		),
		$extra_class
	),
	'js_view' => 'VcColumnView',
	'default_content' => '[featured_cateogry][/featured_cateogry]'
) );

vc_map( array(
	'name'        => esc_html__( 'Featured Category', 'homemarket' ),
	'base'        => 'featured_cateogry',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'as_child'    => array( 'only' => 'featured_categories' ),
	'params'      => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Product Category List', 'homemarket' ),
			'param_name'  => 'category_name',
			'value'       => $category_names,
			'description' => ''
		),
		array(
			'type'        => 'checkbox',
			'heading'     => __( 'Display Category Title', 'homemarket' ),
			'param_name'  => 'category_title',
			'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
		),
		array(
			'type'        => 'checkbox',
			'heading'     => __( 'Display Products Count', 'homemarket' ),
			'param_name'  => 'category_item',
			'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
		),
		$extra_class
	),
) );

/* Latest Posts */
vc_map( array(
	'name'        => esc_html__( 'Recent Posts', 'homemarket' ),
	'base'        => 'recent_post',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Display recent posts', 'homemarket' ),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'homemarket' ),
			'param_name'  => 'title',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Title Style', 'homemarket' ),
			'value'       => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2',
			),
			'param_name'  => 'title_style',
		),
		array(
            'type'        => 'dropdown',
            'heading'     => esc_html__( 'Display Setting', 'homemarket' ),
            'param_name'  => 'display_set',
            'value' => array(
                esc_html__( 'Grid', 'homemarket' ) => 'grid',
                esc_html__( 'Carousel', 'homemarket' ) => 'carousel',
            ),
            'std'         => 'grid',
            'description' => ''
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => esc_html__( 'Display Columns Setting', 'homemarket' ),
            'param_name'  => 'columns',
            'value' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
            'description' => ''
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Per page', 'homemarket' ),
            'value'       => 4,
            'save_always' => true,
            'param_name'  => 'per_page',
            'description' => esc_html__( 'How much items per page to show', 'homemarket' ),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Post Date', 'homemarket' ),
            'param_name' => 'post_date',
            'value'      => array(
                esc_html__( 'Enable', 'homemarket' ) => 'true',
                esc_html__( 'Disable', 'homemarket' ) => 'false',
            ),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Post Comment Counts', 'homemarket' ),
            'param_name' => 'post_comments',
            'value'      => array(
                esc_html__( 'Enable', 'homemarket' ) => 'true',
                esc_html__( 'Disable', 'homemarket' ) => 'false',
            ),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Post Readmore', 'homemarket' ),
            'param_name' => 'post_readmore',
            'value'      => array(
                esc_html__( 'Enable', 'homemarket' ) => 'true',
                esc_html__( 'Disable', 'homemarket' ) => 'false',
            ),
        ),
        $extra_class
	),
) );

/* Homemarket Products View */
vc_map( array(
	'name'        => esc_html__( 'Multi Products', 'homemarket' ),
	'base'        => 'multi_products',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Show multiple products by ID or SKU.', 'homemarket' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Title', 'homemarket' ),
			'param_name' => 'part_title',
		),
		array(
			'type'     => 'dropdown',
			'heading'  => esc_html__( 'Display Setting', 'homemarket' ),
			'param_name' => 'display_style',
			'value' => array(
				esc_html__( 'Grid', 'homemarket' ) => 'grid',
				esc_html__( 'List', 'homemarket' ) => 'list',
				esc_html__( 'Carousel', 'homemarket' ) => 'carousel',
				esc_html__( 'Carousel with List', 'homemarket' ) => 'carousel_list',
			),
			'std'         => 'grid',
			'description' => ''
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Columns Setting', 'homemarket' ),
			'param_name'  => 'columns',
			'value' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
			'description' => '',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Rows Setting', 'homemarket' ),
			'param_name'  => 'rows',
			'value'       => array(
				'1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'	
			),
			'description' => '',
			'dependency'  => array(
				'element' => 'display_style',
				'value'   => array(
					'carousel', 'carousel_list'
				),
			)
 		),
 		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order by', 'homemarket' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => esc_html__( 'Select how to sort retrieved products.', 'homemarket' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Sort order', 'homemarket' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => esc_html__( 'Designates the ascending or descending order.', 'homemarket' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Carousel Navigation Style', 'homemarket' ),
			'param_name'  => 'carousel_nav',
			'value'       => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2'
			),
			'dependency'  => array(
				'element' => 'display_style',
				'value'   => array(
					'carousel', 'carousel_list'
				),
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Product Image Width', 'homemarket' ),
			'param_name'  => 'image_width',
			'value'       => array(
				esc_html__( 'Normal Width', 'homemarket' ) => 'normal_width',
				esc_html__( 'Half Width', 'homemarket' ) => 'half_width',
			),
		),
		array(
            'type'        => 'checkbox',
            'heading'     => __( 'Border Box Layout', 'homemarket' ),
            'param_name'  => 'border_box',
            'value'       => array(__('Yes, please', 'homemarket') => 'yes'),
            'group'       => __( 'Advanced', 'homemarket' ),
        ),
		array(
            'type'        => 'dropdown',
            'heading'     => __( 'Hidden Product Rating', 'homemarket' ),
            'param_name'  => 'hidden_rating',
            'value'      => array(
            	esc_html__( 'Disable', 'homemarket' ) => 'false',
				esc_html__( 'Enable', 'homemarket' ) => 'true',
			),
            'group'       => __( 'Advanced', 'homemarket' ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Hidden Product Title', 'homemarket' ),
            'param_name'  => 'hidden_title',
            'value'      => array(
				esc_html__( 'Disable', 'homemarket' ) => 'false',
				esc_html__( 'Enable', 'homemarket' ) => 'true',
			),
            'group'       => __( 'Advanced', 'homemarket' ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Hidden Product Price', 'homemarket' ),
            'param_name'  => 'hidden_price',
            'value'      => array(
				esc_html__( 'Disable', 'homemarket' ) => 'false',
				esc_html__( 'Enable', 'homemarket' ) => 'true',
			),
            'group'       => __( 'Advanced', 'homemarket' ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Hidden Product Description', 'homemarket' ),
            'param_name'  => 'hidden_desc',
            'value'      => array(
				esc_html__( 'Disable', 'homemarket' ) => 'false',
				esc_html__( 'Enable', 'homemarket' ) => 'true',
			),
            'group'       => __( 'Advanced', 'homemarket' ),
            'dependency' => array(
                'element' => 'display_style',
                'value'   => array(
                	'list', 'carousel_list'
                ),
            )
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Hidden Cart Button', 'homemarket' ),
            'param_name'  => 'hidden_cart_btn',
            'value'      => array(
				esc_html__( 'Disable', 'homemarket' ) => 'false',
				esc_html__( 'Enable', 'homemarket' ) => 'true',
			),
            'group'       => __( 'Advanced', 'homemarket' ),
        ),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Products', 'homemarket' ),
			'param_name' => 'ids',
			'settings' => array(
				'multiple' => true,
				'sortable' => true,
				'unique_values' => true,
				// In UI show results except selected. NB! You should manually check values in backend
			),
			'save_always' => true,
			'description' => __( 'Enter List of Products', 'homemarket' ),
		),
		array(
			'type' => 'hidden',
			'param_name' => 'skus',
		),
		$extra_class,
	),
) );

/* Homemarket Best Selling Products */
vc_map( array(
	'name'        => esc_html__( 'Homemarket Best Selling Products', 'homemarket' ),
	'base'        => 'hm_best_selling_products',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'List best selling products on sale', 'homemarket' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Title', 'homemarket' ),
			'param_name' => 'part_title',
		),
		array(
			'type'     => 'dropdown',
			'heading'  => esc_html__( 'Display Setting', 'homemarket' ),
			'param_name' => 'display_style',
			'value' => array(
				esc_html__( 'Grid', 'homemarket' ) => 'grid',
				esc_html__( 'List', 'homemarket' ) => 'list',
				esc_html__( 'Carousel', 'homemarket' ) => 'carousel',
			),
			'std'         => 'grid',
			'description' => ''
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Category', 'homemarket' ),
			'param_name'  => 'category',
			'value'       => $product_categories_dropdown,
			'save_always' => true,
			'description' => esc_html__( 'Product category list', 'homemarket' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Per page', 'homemarket' ),
			'value' => 12,
			'param_name' => 'per_page',
			'save_always' => true,
			'description' => __( 'How much items per page to show', 'homemarket' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Columns Setting', 'homemarket' ),
			'param_name'  => 'columns',
			'value' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
			'description' => '',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Rows Setting', 'homemarket' ),
			'param_name'  => 'rows',
			'value'       => array(
				'1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'	
			),
			'description' => '',
			'dependency'  => array(
				'element' => 'display_style',
				'value'   => array(
					'carousel', 'carousel_list'
				),
			)
 		),
 		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Carousel Navigation Style', 'homemarket' ),
			'param_name'  => 'carousel_nav',
			'value'       => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2'
			),
			'dependency'  => array(
				'element' => 'display_style',
				'value'   => array(
					'carousel', 'carousel_list'
				),
			),
		),
		$extra_class,
	),
) );

/* Homemarket Recent Products */
vc_map( array(
	'name'        => esc_html__( 'Homemarket Recent Products', 'homemarket' ),
	'base'        => 'hm_recent_products',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Lists recent products', 'homemarket' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Title', 'homemarket' ),
			'param_name' => 'part_title',
		),
		array(
			'type'     => 'dropdown',
			'heading'  => esc_html__( 'Display Setting', 'homemarket' ),
			'param_name' => 'display_style',
			'value' => array(
				esc_html__( 'Grid', 'homemarket' ) => 'grid',
				esc_html__( 'List', 'homemarket' ) => 'list',
				esc_html__( 'Carousel', 'homemarket' ) => 'carousel',
			),
			'std'         => 'grid',
			'description' => ''
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Category', 'homemarket' ),
			'param_name'  => 'category',
			'value'       => $product_categories_dropdown,
			'save_always' => true,
			'description' => esc_html__( 'Product category list', 'homemarket' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Per page', 'homemarket' ),
			'value' => 12,
			'param_name' => 'per_page',
			'save_always' => true,
			'description' => __( 'How much items per page to show', 'homemarket' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Columns Setting', 'homemarket' ),
			'param_name'  => 'columns',
			'value' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
			'description' => '',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Rows Setting', 'homemarket' ),
			'param_name'  => 'rows',
			'value'       => array(
				'1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'	
			),
			'description' => '',
			'dependency'  => array(
				'element' => 'display_style',
				'value'   => array(
					'carousel', 'carousel_list'
				),
			)
 		),
 		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order by', 'homemarket' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => esc_html__( 'Select how to sort retrieved products.', 'homemarket' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Sort order', 'homemarket' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => esc_html__( 'Designates the ascending or descending order.', 'homemarket' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Carousel Navigation Style', 'homemarket' ),
			'param_name'  => 'carousel_nav',
			'value'       => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2'
			),
			'dependency'  => array(
				'element' => 'display_style',
				'value'   => array(
					'carousel', 'carousel_list'
				),
			),
		),
		$extra_class
	),
) );

/* Content Block */
vc_map( array(
	'name'        => esc_html__( 'Homemarket Content Blocks', 'homemarket' ),
	'base'        => 'hm_content_blocks',
	'icon'        => 'homemarket-js-composer',
	'as_parent'   => array( 'only' => 'hm_content_block' ),
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Custom Content Blocks', 'homemarket' ),
	'params'      => array(
		array(
			'type'    => 'textfield',
			'heading' => esc_html__( 'Title', 'homemarket' ),
			'param_name'  => 'blocks_title',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Title Style', 'homemarket' ),
			'param_name' => 'blocks_title_style',
			'value'      => array(
				esc_html__( 'Style 1', 'homemarket' ) => 'style-1',
				esc_html__( 'Style 2', 'homemarket' ) => 'style-2'
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Columns', 'homemarket' ),
			'value' => 4,
			'save_always' => true,
			'param_name' => 'columns',
			'description' => __( 'How much columns grid', 'homemarket' ),
		),
		$extra_class,
	),
	'js_view' => 'VcColumnView',
	'default_content' => '[hm_content_block][/hm_content_block]'
) );

vc_map( array(
	'name'        => esc_html__( 'Homemarket Content Block', 'homemarket' ),
	'base'        => 'hm_content_block',
	'icon'        => 'homemarket-js-composer',
	'category'    => esc_html__( 'by SoapTheme', 'homemarket' ),
	'description' => esc_html__( 'Custom Content Block', 'homemarket' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Title', 'homemarket' ),
			'param_name' => 'part_title' ,
		),
		array(
			'type'       => 'textarea_html',
			'heading'    => esc_html__( 'Description', 'homemarket' ),
			'param_name' => 'content_block_description',
		),
		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Background Image', 'homemarket' ),
			'param_name' => 'content_background_img',
			'description' => esc_html__( 'Upload the custom background image', 'homemarket' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Block Link', 'homemarket' ),
			'param_name'  => 'block_btn_link',
			'description' => esc_html__( 'Enter the Link (http://)', 'homemarket' ),
		),
		$extra_class
	),
) );


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Container extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Toggles extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Pricing_Table_Container extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Process extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Progress_Bars extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Tabs extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Team extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Testimonials extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Carousel extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Flexslider extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Product_Brands extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Featured_Categories extends WPBakeryShortCodesContainer {}

    class WPBakeryShortCode_Category_Link_Imgs extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Hm_Content_Blocks extends WPBakeryShortCodesContainer {}

}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Toggle extends WPBakeryShortCode {}

    class WPBakeryShortCode_Pricing_Table extends WPBakeryShortCode {}

    class WPBakeryShortCode_Progress_Bar extends WPBakeryShortCode {}

    class WPBakeryShortCode_Process_Item extends WPBakeryShortCode {}

    class WPBakeryShortCode_Tab extends WPBakeryShortCode {}

    class WPBakeryShortCode_Team_Member extends WPBakeryShortCode {}

    class WPBakeryShortCode_Slide extends WPBakeryShortCode {}
}
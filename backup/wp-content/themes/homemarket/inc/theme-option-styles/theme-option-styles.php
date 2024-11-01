<?php

	if ( !function_exists('homemarket_theme_option_styles') ) {
		function homemarket_theme_option_styles() {
			global $homemarket_theme_options;
			
			//convert hex to rgb
			function homemarket_hex2rgb($hex) {
				$hex = str_replace("#", "", $hex);
				
				if(strlen($hex) == 3) {
					$r = hexdec(substr($hex,0,1).substr($hex,0,1));
					$g = hexdec(substr($hex,1,1).substr($hex,1,1));
					$b = hexdec(substr($hex,2,1).substr($hex,2,1));
				} else {
					$r = hexdec(substr($hex,0,2));
					$g = hexdec(substr($hex,2,2));
					$b = hexdec(substr($hex,4,2));
				}
				$rgb = array($r, $g, $b);
				return implode(",", $rgb); // returns the rgb values separated by commas
				//return $rgb; // returns an array with the rgb values
			}
			ob_start();
?>

	<!--*************** HomeMarket Theme Options Styles ***********************-->
	<style>

		/**************** Fonts ****************/
		
		h1, h2, h3, h4, h5, h6, a,
		.site-header__search form.search-bar .collections-selector select,
		.site-header__search form.search-bar .st-default-search-input,
		.link-list li span,
		.nav-bar .site-nav > li > a,
		#rightbox-nav-bar.nav-bar .shop-by-collections .sidebar-collections .sdcollections-title,
		#rightbox-nav-bar.nav-bar .shop-by-collections .sidebar-collections .sdcollections-content .sdcollections-list .sdc-element > a .element-main .collection-area,
		.woocommerce a.button, .single_add_to_cart_button,
		.quickview-wrap .grid__item .woocommerce.woocommerce-product-rating .review-link a, 
		#content .grid__item .woocommerce.woocommerce-product-rating .review-link a,
		.shopping-cart-page .cart-box-form table.shop_table tbody tr td.product-name .info_item a.product-title,
		.shopping-cart-page .cart-box-form table.shop_table tbody tr td.product-price span,
		.woocommerce .cart-collaterals table.shop_table tr th, .woocommerce .cart-collaterals table.shop_table tr td,
		.woocommerce .cart-collaterals table.shop_table tr.shipping td .woocommerce-shipping-calculator .shipping-calculator-form button,
		.homemarket-mini-cart .widget_shopping_cart_content p.buttons a.button,
		.cart-empty, .return-to-shop,
		.blog .index-page.main-content .blog-sidebar aside .post-slide .post-item-small a,
		.woocommerce #login-form form p input.woocommerce-Button, .woocommerce #register-form form p input.woocommerce-Button,
		.woocommerce .lost_reset_password p.form-row input.woocommerce-Button,
		.woocommerce .woocommerce-MyAccount-navigation ul li a,
		.single-page.main-content #content .post-content article .post-author p,
		.single-page.main-content #content .post-content article .comment-respond .comment-form-comment label,
		.single-page.main-content #content .post-content article .comment-respond .comment-form .form-submit input,
		.single-page.main-content #content .post-content article .comment-respond .comment-form p,
		.wishlist-page #yith-wcwl-form table.wishlist_table td.product-price,
		.no-product-info,
		.content-blocks-area .content-blocks-inner .block-inner .content-block .link-action a {
			font-family: <?php echo '\'' . $homemarket_theme_options['main_font']['font-family'] . '\''; ?>
		}

		body,
		#top-header .currency-picker .currency-picker__wrapper select.currency-picker,
		.nav-bar .site-nav > li.menu-item-has-children > ul.sub-menu > li,
		.info-box-component #info-box-wrap .info-box-icon-header h3,
		.info-box-component #info-box-wrap .info-box-icon-header .info-box-icon-description {
			font-family: <?php echo '\'' . $homemarket_theme_options['alternative_font']['font-family'] . '\''; ?>
		}

		/**************** Header Top Bar *****************/

		<?php
			if ( (isset($homemarket_theme_options['top_bar_switch'])) && ($homemarket_theme_options['top_bar_switch'] == "1") ) {
				$header_top_bar_height = 35;
			} else {
				$header_top_bar_height = 0;
			}
		?>

		#top-header {
			height: <?php echo esc_html($header_top_bar_height) ?>px;
			<?php if ( (isset($homemarket_theme_options['top_bar_background_color'])) && (trim($homemarket_theme_options['top_bar_background_color']) != "" ) ) : ?>
				background: <?php echo esc_html($homemarket_theme_options['top_bar_background_color']) ?>;
			<?php endif; ?>
		}

		<?php if ( (isset($homemarket_theme_options['top_bar_text_color'])) && (trim($homemarket_theme_options['top_bar_text_color']) != "" ) ) : ?>
			#top-header .currency-picker .currency-picker__wrapper select.currency-picker, #top-header {
				color: <?php echo esc_html($homemarket_theme_options['top_bar_text_color']) ?>;
			}	
		<?php endif; ?>

		#top-header .social-icons a i {
			<?php if ( (isset($homemarket_theme_options['top_bar_social_icons_color'])) && (trim($homemarket_theme_options['top_bar_social_icons_color']) != "" ) ) : ?>
				color: <?php echo esc_html($homemarket_theme_options['top_bar_social_icons_color']) ?>;
			<?php endif; ?>
		}

		/**************************** Header ******************************/
		/******************************************************************/
		<?php
			$logo_height = 56;
			if ( (isset($homemarket_theme_options['site_logo']['url'])) && (trim($homemarket_theme_options['site_logo']['url']) != "" ) ) {
				$logo_height = $homemarket_theme_options['logo_height']; 
			} else {
				$logo_height = 56;
			}
		?>

		header.site-header .site-header__logo-link img {
			height: <?php echo esc_html($logo_height) ?>px;
		}

		<?php
			if ( (isset($homemarket_theme_options['logo_space_top'])) && (trim($homemarket_theme_options['logo_space_top']) != "" ) ) {
		?>	
			header.site-header {
				padding-top: <?php echo esc_html($homemarket_theme_options['logo_space_top']); ?>px;
			}
		<?php
			}
		?>

		<?php
			if ( (isset($homemarket_theme_options['logo_space_bottom'])) && (trim($homemarket_theme_options['logo_space_bottom']) != "" ) ) {
		?>	
			header.site-header {
				padding-bottom: <?php echo esc_html($homemarket_theme_options['logo_space_bottom']); ?>px;
			}
		<?php
			}
		?>

		header.site-header {
			<?php if ( (isset($homemarket_theme_options['main_header_background']['background-color'])) ): ?>
				background-color: <?php echo esc_html($homemarket_theme_options['main_header_background']['background-color']) ?>;
			<?php endif ?>

			<?php if ( (isset($homemarket_theme_options['main_header_background']['background-image'])) && ($homemarket_theme_options['main_header_background']['background-image']) != "" ) : ?>
				background-image:url(<?php echo esc_url($homemarket_theme_options['main_header_background']['background-image']); ?>);
			<?php endif; ?>
			
			<?php if ( (isset($homemarket_theme_options['main_header_background']['background-repeat'])) ) : ?>
				background-repeat:<?php echo esc_html($homemarket_theme_options['main_header_background']['background-repeat']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($homemarket_theme_options['main_header_background']['background-position'])) ) : ?>
				background-position:<?php echo esc_html($homemarket_theme_options['main_header_background']['background-position']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($homemarket_theme_options['main_header_background']['background-size'])) ) : ?>
				background-size:<?php echo esc_html($homemarket_theme_options['main_header_background']['background-size']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($homemarket_theme_options['main_header_background']['background-attachment'])) ) : ?>
				background-attachment:<?php echo esc_html($homemarket_theme_options['main_header_background']['background-attachment']); ?>;
			<?php endif; ?>
		}

		.site-header__search form.search-bar .st-default-search-input {
			<?php if ( (isset($homemarket_theme_options['main_header_collection_select'])) && ($homemarket_theme_options['main_header_collection_select'] != "1" ) ): ?>
				width: 100%;
			<?php endif; ?>
		}

		.site-header__search {
			<?php if ( (isset($homemarket_theme_options['main_header_search_bar'])) && ($homemarket_theme_options['main_header_search_bar'] != "1" ) ): ?>
				border: none;
			<?php elseif ( ($homemarket_theme_options['main_header_search_bar'] != "1" ) && ($homemarket_theme_options['main_header_collection_select'] != "1" ) ) : ?>
				border: none;
			<?php endif; ?>

			<?php if ( (isset($homemarket_theme_options['search_collection_box_background'])) && (trim($homemarket_theme_options['search_collection_box_background']) != "") ): ?>
				background: <?php echo esc_html($homemarket_theme_options['search_collection_box_background']); ?>;
			<?php endif; ?>

			<?php if ( (isset($homemarket_theme_options['search_collection_box_border_color'])) && (trim($homemarket_theme_options['search_collection_box_border_color']) != "") ): ?>
				border-color: <?php echo esc_html($homemarket_theme_options['search_collection_box_border_color']); ?>;
			<?php endif; ?>
		}

		.site-header__search form.search-bar .collections-selector {
			<?php if ( (isset($homemarket_theme_options['main_header_search_bar'])) && ($homemarket_theme_options['main_header_search_bar'] != "1" ) ): ?>
				display: block;
				margin: auto;
				width: 100%;
			<?php endif; ?>
		}

		.site-header__search form.search-bar .collections-selector select {
			<?php if ( (isset($homemarket_theme_options['main_header_search_bar'])) && ($homemarket_theme_options['main_header_search_bar'] != "1" ) ): ?>
				border: 1px solid <?php echo esc_html($homemarket_theme_options['search_collection_box_border_color']); ?>;
				width: 100%;
				text-align: center;
			<?php endif; ?>

			<?php if ( (isset($homemarket_theme_options['search_collection_box_border_color'])) && (trim($homemarket_theme_options['search_collection_box_border_color']) != "") ): ?>
				border-color: <?php echo esc_html($homemarket_theme_options['search_collection_box_border_color']); ?>;
			<?php endif; ?>
		}

		.link-list li i {
			<?php if ( (isset($homemarket_theme_options['header_icon_color'])) && (trim($homemarket_theme_options['header_icon_color'] != "" )) ): ?>
				color: <?php echo esc_html($homemarket_theme_options['header_icon_color']) ?>;
			<?php endif; ?>
		}

		.link-list li span {
			<?php if ( (isset($homemarket_theme_options['header_icon_text_color'])) && (trim($homemarket_theme_options['header_icon_text_color'] != "" )) ): ?>
				color: <?php echo esc_html($homemarket_theme_options['header_icon_text_color']) ?>;
			<?php endif; ?>
		}

		.link-list li {
			<?php if ( (isset($homemarket_theme_options['header_icon_text_color'])) && (trim($homemarket_theme_options['header_icon_text_color'] != "" )) ): ?>
				border-color: rgba(<?php echo homemarket_hex2rgb($homemarket_theme_options['header_icon_text_color']); ?>,0.15);
			<?php endif; ?>
		}

		/**************************** Menu Bar ******************************/
		/********************************************************************/

		<?php if ( (isset($homemarket_theme_options['main_menu_background']['background-color'])) && (trim($homemarket_theme_options['main_menu_background']['background-color'] != "" )) ): ?>
			.nav-bar {
				background: <?php echo esc_html($homemarket_theme_options['main_menu_background']['background-color']) ?>;

				<?php if ( (isset($homemarket_theme_options['main_menu_background']['background-image'])) && ($homemarket_theme_options['main_menu_background']['background-image']) != "" ) : ?>
					background-image:url(<?php echo esc_url($homemarket_theme_options['main_menu_background']['background-image']); ?>);
				<?php endif; ?>
				
				<?php if ( (isset($homemarket_theme_options['main_menu_background']['background-repeat'])) ) : ?>
					background-repeat:<?php echo esc_html($homemarket_theme_options['main_menu_background']['background-repeat']); ?>;
				<?php endif; ?>
				
				<?php if ( (isset($homemarket_theme_options['main_menu_background']['background-position'])) ) : ?>
					background-position:<?php echo esc_html($homemarket_theme_options['main_menu_background']['background-position']); ?>;
				<?php endif; ?>
				
				<?php if ( (isset($homemarket_theme_options['main_menu_background']['background-size'])) ) : ?>
					background-size:<?php echo esc_html($homemarket_theme_options['main_menu_background']['background-size']); ?>;
				<?php endif; ?>
				
				<?php if ( (isset($homemarket_theme_options['main_menu_background']['background-attachment'])) ) : ?>
					background-attachment:<?php echo esc_html($homemarket_theme_options['main_menu_background']['background-attachment']); ?>;
				<?php endif; ?>
			}
			#rightbox-nav-bar.nav-bar .shop-by-collections .sidebar-collections .sdcollections-title {
				background: <?php echo esc_html($homemarket_theme_options['main_menu_background']['background-color']) ?>;
			}
			#rightbox-nav-bar.nav-bar .site-nav {
				background: <?php echo esc_html($homemarket_theme_options['main_menu_background']['background-color']) ?>;	
			}
			#rightbox-nav-bar.nav-bar .shop-by-collections .sidebar-collections .sdcollections-content .sdcollections-list .sdc-element:hover > a .element-main .collection-area,
			#page-content-custom-menu .shop-by-collections .sidebar-collections .sdcollections-content .sdcollections-list .sdc-element:hover > a .element-main .collection-area {
				color: <?php echo esc_html($homemarket_theme_options['main_menu_background']['background-color']) ?>;
			}
		<?php endif ?>

		<?php if ( (isset($homemarket_theme_options['main_menu_hover_background']['background-color'])) && (trim($homemarket_theme_options['main_menu_hover_background']['background-color'] != "" )) ): ?>
			.nav-bar .site-nav > li > a::before,
			.nav-bar .site-nav > li.current-menu-item > a::before {
				background: <?php echo esc_html($homemarket_theme_options['main_menu_hover_background']['background-color']) ?>;

				<?php if ( (isset($homemarket_theme_options['main_menu_hover_background']['background-image'])) && ($homemarket_theme_options['main_menu_hover_background']['background-image']) != "" ) : ?>
					background-image:url(<?php echo esc_url($homemarket_theme_options['main_menu_hover_background']['background-image']); ?>);
				<?php endif; ?>
				
				<?php if ( (isset($homemarket_theme_options['main_menu_hover_background']['background-repeat'])) ) : ?>
					background-repeat:<?php echo esc_html($homemarket_theme_options['main_menu_hover_background']['background-repeat']); ?>;
				<?php endif; ?>
				
				<?php if ( (isset($homemarket_theme_options['main_menu_hover_background']['background-position'])) ) : ?>
					background-position:<?php echo esc_html($homemarket_theme_options['main_menu_hover_background']['background-position']); ?>;
				<?php endif; ?>
				
				<?php if ( (isset($homemarket_theme_options['main_menu_hover_background']['background-size'])) ) : ?>
					background-size:<?php echo esc_html($homemarket_theme_options['main_menu_hover_background']['background-size']); ?>;
				<?php endif; ?>
				
				<?php if ( (isset($homemarket_theme_options['main_menu_hover_background']['background-attachment'])) ) : ?>
					background-attachment:<?php echo esc_html($homemarket_theme_options['main_menu_hover_background']['background-attachment']); ?>;
				<?php endif; ?>
			}
		<?php endif ?>

		.nav-bar .site-nav > li > a,
		.nav-bar .site-nav > li.menu-item-has-children > a:after {
			<?php if ( (isset($homemarket_theme_options['main_menu_font_size'])) && (trim($homemarket_theme_options['main_menu_font_size'] != "" )) ): ?>
				font-size: <?php echo esc_html($homemarket_theme_options['main_menu_font_size']) ?>px;
			<?php endif; ?>

			<?php if ( (isset($homemarket_theme_options['main_menu_font_color'])) && (trim($homemarket_theme_options['main_menu_font_color'] != "" )) ): ?>
				color: <?php echo esc_html($homemarket_theme_options['main_menu_font_color']) ?>;
			<?php endif; ?>
		}

		<?php if ( (isset($homemarket_theme_options['main_menu_font_color_hover'])) && (trim($homemarket_theme_options['main_menu_font_color_hover'] != "" )) ): ?>
			.nav-bar .site-nav > li > a:hover,
			.nav-bar .site-nav > li.current-menu-item > a,
			.nav-bar .site-nav > li.menu-item-has-children > a:hover:after {
				color: <?php echo esc_html($homemarket_theme_options['main_menu_font_color_hover']) ?>;
			}
		<?php endif; ?>

		.nav-bar .site-nav > li > a,
		#rightbox-nav-bar.nav-bar .shop-by-collections .sidebar-collections .sdcollections-title {
			<?php if ( (isset($homemarket_theme_options['menubar_space_top'])) && (trim($homemarket_theme_options['menubar_space_top']) != "" ) ): ?>
				padding-top: <?php echo esc_html($homemarket_theme_options['menubar_space_top']); ?>px;
			<?php endif; ?>

			<?php if ( (isset($homemarket_theme_options['menubar_space_bottom'])) && (trim($homemarket_theme_options['menubar_space_bottom']) != "" ) ): ?>
				padding-bottom: <?php echo esc_html($homemarket_theme_options['menubar_space_bottom']); ?>px;
			<?php endif; ?>
		}

		/**************************** Sub Menu ******************************/
		/********************************************************************/

		.nav-bar .site-nav > li.menu-item-has-children > ul.sub-menu,
		#rightbox-nav-bar.nav-bar .shop-by-collections .sidebar-collections .sdcollections-content .sdcollections-list .sdc-element > a .element-main .collection-area {
			<?php if ( (isset($homemarket_theme_options['sub_menu_font_size'])) && (trim($homemarket_theme_options['sub_menu_font_size']) != "" ) ): ?>
				font-size: <?php echo esc_html($homemarket_theme_options['sub_menu_font_size']); ?>px;
			<?php endif ?>
		}

		.nav-bar .site-nav > li.menu-item-has-children > ul.sub-menu > li a,
		#rightbox-nav-bar.nav-bar .shop-by-collections .sidebar-collections .sdcollections-content .sdcollections-list .sdc-element > a .element-main .collection-area,
		#rightbox-nav-bar.nav-bar .shop-by-collections .sidebar-collections .sdcollections-content .sdc-element .icon-arrow-right {
			<?php if ( (isset($homemarket_theme_options['sub_menu_font_color'])) && (trim($homemarket_theme_options['sub_menu_font_color']) != "" ) ): ?>
				color: <?php echo esc_html($homemarket_theme_options['sub_menu_font_color']); ?>;
			<?php endif ?>
		}

		/**************************** Page Content ******************************/
		/************************************************************************/

		<?php if ( (isset($homemarket_theme_options['site_skin'])) && (trim($homemarket_theme_options['site_skin']) != "") ): ?>
			.carousel-products.woocommerce .home-products-carousel-enable .owl-nav div:hover,
			.woocommerce .products.product-display-custom .product h3:hover,
			.woocommerce .products.product-display-custom .product span.price ins,
			.woocommerce .products.product-display-custom .product .added_to_cart::before,
			.woocommerce .products.product-display-custom .product .add-btns-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a::before,
			.woocommerce .products.product-display-custom .product .add-btns-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a::before,
			.quickview-wrap .grid__item .price ins span.woocommerce-Price-amount, #content .grid__item .price ins span.woocommerce-Price-amount,
			.quickview-wrap .quantity.homemarket-quantity .qty-down:hover i, 
			.quickview-wrap .quantity.homemarket-quantity .qty-up:hover i, 
			#content .quantity.homemarket-quantity .qty-down:hover i, 
			#content .quantity.homemarket-quantity .qty-up:hover i,
			.product_meta > div a,
			.quickview-wrap .product-image-slider .owl-nav > div,
			.quickview-wrap .product-thumbs-slider .thumb-nav > div,
			.brands-area ul.carousel-brand .owl-nav div:hover,
			.categories-area ul.carousel-category .owl-nav div:hover,
			#collection .products-content .shop-loop-before .sort-view .gridlist-toggle > a:hover, 
			#collection .products-content .shop-loop-before .sort-view .gridlist-toggle > a.active,
			.sidebar-group aside.sidebar ul.product-categories li a:hover,
			.ajax-product-filter .prices-list-filter li label:hover,
			.woocommerce-atf-filters ul li.taxonomy-has-children span:hover,
			.woocommerce ul.product_list_widget li .product-info ins,
			.woocommerce ul.product_list_widget li .product-info h3:hover,
			#product-detail-content .yith-wcwl-add-to-wishlist > div a:hover,
			#product-detail-content .yith-wcwl-add-to-wishlist > div a[rel="nofollow"]::before,
			.product-review-part #product-detail-content .grid__item .price ins span.woocommerce-Price-amount,
			.product-review-part #product-detail-content .yith-wcwl-add-to-wishlist > div a[rel="nofollow"]::before,
			.product-review-part #product-detail-content form.variations_form table.variations tr td a.reset_variations,
			.product-review-part #product-detail-content .grid__item .price span.woocommerce-Price-amount,
			.quickview-wrap form.variations_form table.variations tr td a.reset_variations,
			.quickview-wrap .grid__item .price span.woocommerce-Price-amount,
			.product-review-part #product-detail-content .quantity.homemarket-quantity .qty-down:hover i, 
			.product-review-part #product-detail-content .quantity.homemarket-quantity .qty-up:hover i,
			.shopping-cart-page .cart-box-form table.shop_table tbody tr td.product-name .info_item a.product-title:hover,
			.woocommerce .cart-collaterals table.shop_table tr.order-total td span,
			.homemarket-mini-cart .widget_shopping_cart_content .product_list_widget li.mini_cart_item a:nth-child(2):hover,
			.homemarket-mini-cart .widget_shopping_cart_content .product_list_widget li.mini_cart_item .product_cart_info span.quantity span.woocommerce-Price-amount,
			.homemarket-mini-cart .widget_shopping_cart_content p.total span.woocommerce-Price-amount,
			.blog .index-page.main-content #content .blog-posts article .blog-date p span,
			.blog .index-page.main-content .blog-sidebar aside .post-slide .post-item-small a:hover,
			.woocommerce #login-form form p a:hover, .woocommerce #login-form form p label:hover, 
			.woocommerce #register-form form p a:hover, .woocommerce #register-form form p label:hover,
			a, .text-link, 
			.woocommerce .woocommerce-MyAccount-content .MyAccount-featured-box .box-content h3,
			.single-page.main-content #content .post-content article .post-date p span,
			.single-page.main-content #content .post-content article .post-share-links h4,
			.single-page.main-content #content .post-content article .post-author h3,
			.single-page.main-content #content .post-content article .post-comments h3,
			.single-page.main-content #content .post-content article .comment-respond h3,
			.wishlist-page #yith-wcwl-form table.wishlist_table td.product-name .info_item a:hover,
			.woocommerce .products.product-display-custom .product span.price,
			.recent-post-content.carousel-post .owl-nav div:hover,
			.wpb_content_element .wpb_tour_tabs_wrapper.style-3 .homemarket-tabs_nav.style-3 li a:hover,
			.mobile-sidebar .sidebar-toggle:hover,
			.single-page.main-content .post-sidebar aside .post-slide .post-item-small a:hover,
			#footer-main .share-links a:hover, #footer-main #menu-footer-menu li a:hover,
			#footer-main .tagcloud a:hover,
			#footer-main .contact-info .contact-details li i,
			#footer-main .post-slide .post-item-small .post-author span,
			.sidebar-group aside.sidebar ul.product-categories li.current-cat a, .sidebar-group aside.sidebar ul.product-categories li.current-cat span {	
				color: <?php echo esc_html($homemarket_theme_options['site_skin']); ?>;
			}
			.shopping-cart-page .cart-box-form table.shop_table tbody tr td.product-name .info_item a.remove:hover,
			.homemarket-mini-cart .widget_shopping_cart_content .product_list_widget li.mini_cart_item a.remove:hover {
				color: <?php echo esc_html($homemarket_theme_options['site_skin']); ?> !important;
			}
			.woocommerce .products.product-display-custom .product .add-btns-wrap .button:hover,
			.single_add_to_cart_button:hover,
			.woocommerce button.button.single_add_to_cart_button:hover,
			.woocommerce nav.woocommerce-pagination ul.page-numbers li a:hover, 
			.woocommerce nav.woocommerce-pagination ul.page-numbers li a:focus, 
			.woocommerce nav.woocommerce-pagination ul.page-numbers li span.current,
			.sidebar-group aside.sidebar h3.sidebar-title span.toggle:hover,
			#product-detail-content .single_add_to_cart_button, 
			#product-detail-content .woocommerce button.button.single_add_to_cart_button,
			.product-review-part #product-detail-content .single_add_to_cart_button, 
			.product-review-part #product-detail-content .woocommerce button.button.single_add_to_cart_button,
			.blog .index-page.main-content #content .blog-posts article .blog-meta a.readmore:hover,
			.wishlist-page #yith-wcwl-form table.wishlist_table td.product-add-to-cart .add-btns-wrap .add-btn a:hover,
			.post-pagination-field span, .post-pagination-field a:hover {
				background: <?php echo esc_html($homemarket_theme_options['site_skin']); ?>;
				border-color: <?php echo esc_html($homemarket_theme_options['site_skin']); ?>;
			}
			.woocommerce .products.product-display-custom .product .added_to_cart:hover::before,
			.woocommerce .products.product-display-custom .product .add-btns-wrap .yith-wcwl-add-to-wishlist a:hover,
			.woocommerce #reviews #review_form_wrapper #review_form .form-submit input#submit:hover,
			.woocommerce-message,
			.shopping-cart-page .cart-box-form table.shop_table tbody tr td.actions div.coupon input.button,
			.shopping-cart-page .cart-box-form table.shop_table tbody tr td.actions input.update_cart_submit:hover,
			.woocommerce .cart-collaterals .wc-proceed-to-checkout a,
			.woocommerce .cart-collaterals table.shop_table tr.shipping td .woocommerce-shipping-calculator .shipping-calculator-form button:hover,
			.homemarket-mini-cart .widget_shopping_cart_content p.buttons a.button.checkout,
			.homemarket-mini-cart .widget_shopping_cart_content p.buttons a.button:hover,
			.woocommerce .return-to-shop a.wc-backward, .btn-primary:hover,
			.woocommerce #login-form form p input.woocommerce-Button, .woocommerce #register-form form p input.woocommerce-Button,
			.woocommerce .lost_reset_password p.form-row input.woocommerce-Button,
			.woocommerce .lost_reset_password p.form-row a.back-login:hover,
			.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
			.single-page.main-content #content .post-content article .comment-respond .comment-form .form-submit input,
			.wishlist-page #yith-wcwl-form table.wishlist_table td.product-remove a:hover,
			.no-product-info,
			.carousel-products.woocommerce.border_box.style-2 > h4.title span::before,
			.brands-area.style-2 > h4.title span::before,
			.wpb_content_element .wpb_tour_tabs_wrapper.style-2 .homemarket-tabs_nav.style-2 li a::before,
			.categories-area.style-2 h3.title span::before,
			.wpb_content_element .wpb_tour_tabs_wrapper.style-3 > h2::before,
			.content-blocks-area h3.title.style-2 span::before,
			.content-blocks-area .content-blocks-inner .block-inner .content-block .link-action a,
			.recent-post-inner h3.title.style-2 span::before,
			.owl-carousel .owl-dots .owl-dot.active span {
				background: <?php echo esc_html($homemarket_theme_options['site_skin']); ?>;
			}
			.woocommerce .products.product-display-custom .product .quickview:hover {
				background: rgba(<?php echo homemarket_hex2rgb($homemarket_theme_options['site_skin']); ?>,0.5);
			}
			#fancybox-loading::before {
				border-right-color: <?php echo esc_html($homemarket_theme_options['site_skin']); ?>;
				border-top-color: <?php echo esc_html($homemarket_theme_options['site_skin']); ?>;
			}
			#yith-wcwl-popup-message,
			.yith-wcan-loading:before,
			.watf-loading .watf-spinner,
			.woocommerce .woocommerce-MyAccount-content .MyAccount-featured-box .box-content,
			.nav-bar .site-nav li.menu-item-has-children ul.sub-menu li:hover > a {
				border-color: <?php echo esc_html($homemarket_theme_options['site_skin']); ?>;
			}
		<?php endif; ?>


		/**************************** Footer ******************************/
		/******************************************************************/

		<?php if ( (isset($homemarket_theme_options['footer_top_background'])) && (trim($homemarket_theme_options['footer_top_background']) != "") ): ?>
			#footer-top {
				background: <?php echo esc_html($homemarket_theme_options['footer_top_background']); ?>;
			}
		<?php endif; ?>

		<?php if ( (isset($homemarket_theme_options['footer_top_font_color'])) && (trim($homemarket_theme_options['footer_top_font_color']) != "") ): ?>
			#footer-top aside.widget form > *:first-child {
				color: <?php echo esc_html($homemarket_theme_options['footer_top_font_color']); ?>;
			}
		<?php endif; ?>

		<?php if ( (isset($homemarket_theme_options['footer_main_background'])) && (trim($homemarket_theme_options['footer_main_background']) != "") ): ?>
			#footer-main, #footer-bottom {
				background: <?php echo esc_html($homemarket_theme_options['footer_main_background']); ?>;
			}
		<?php endif; ?>

		<?php if ( (isset($homemarket_theme_options['footer_main_font_color'])) && (trim($homemarket_theme_options['footer_main_font_color']) != "") ): ?>
			#footer-main .wrapper h3.widget-title,
			#footer-main .contact-info .contact-details li span, #footer-main .contact-info .contact-details li span a,
			#footer-main #menu-footer-menu li a,
			#footer-main .tagcloud a, #footer-main .post-slide .post-item-small a,
			#footer-main .post-slide .post-item-small .post-author, #footer-bottom .wrapper .grid__item p,
			#footer-main .post-slide .post-item-small p.post-date {
				color: <?php echo esc_html($homemarket_theme_options['footer_main_font_color']); ?>;
			}
		<?php endif; ?>

		<?php if ( (isset($homemarket_theme_options['footer_main_border_color'])) && (trim($homemarket_theme_options['footer_main_border_color']) != "") ): ?>
			#footer-main .tagcloud a, #footer-bottom {
				border-color: <?php echo esc_html($homemarket_theme_options['footer_main_border_color']); ?>;
			}
		<?php endif; ?>

		/**************************** Shop page ******************************/
		/*********************************************************************/

		#breadcrumb-wrapper {
			<?php if ( (isset($homemarket_theme_options['breadcrumbs_background']['background-color'])) ): ?>
				background-color: <?php echo esc_html($homemarket_theme_options['breadcrumbs_background']['background-color']) ?>;
			<?php endif ?>

			<?php if ( (isset($homemarket_theme_options['breadcrumbs_background']['background-image'])) && ($homemarket_theme_options['breadcrumbs_background']['background-image']) != "" ) : ?>
				background-image:url(<?php echo esc_url($homemarket_theme_options['breadcrumbs_background']['background-image']); ?>);
			<?php endif; ?>
			
			<?php if ( (isset($homemarket_theme_options['breadcrumbs_background']['background-repeat'])) ) : ?>
				background-repeat:<?php echo esc_html($homemarket_theme_options['breadcrumbs_background']['background-repeat']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($homemarket_theme_options['breadcrumbs_background']['background-position'])) ) : ?>
				background-position:<?php echo esc_html($homemarket_theme_options['breadcrumbs_background']['background-position']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($homemarket_theme_options['breadcrumbs_background']['background-size'])) ) : ?>
				background-size:<?php echo esc_html($homemarket_theme_options['breadcrumbs_background']['background-size']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($homemarket_theme_options['breadcrumbs_background']['background-attachment'])) ) : ?>
				background-attachment:<?php echo esc_html($homemarket_theme_options['breadcrumbs_background']['background-attachment']); ?>;
			<?php endif; ?>
		}

		#breadcrumb-wrapper.breadcrumb-initial {
			background-image: url(<?php echo ( get_template_directory_uri() . '/images/breadcrumb.jpg' ); ?>);
		}

		/**************************** Responsive ******************************/
		/**********************************************************************/

		<?php if ( (isset($homemarket_theme_options['search_collection_box_border_color'])) && (trim($homemarket_theme_options['search_collection_box_border_color']) != "") ): ?>
			@media( max-width: 767px ) {
				.mobile-bottom {
					background: <?php echo esc_html($homemarket_theme_options['search_collection_box_border_color']); ?>;
				}
			}
		<?php endif ?>

		/**************************** Custom CSS ******************************/
		/**********************************************************************/
		<?php if ( (isset($homemarket_theme_options['custom_css'])) && (trim($homemarket_theme_options['custom_css']) != "" ) ) : ?>
			<?php echo $homemarket_theme_options['custom_css'] ?>
		<?php endif; ?>

	</style>

<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) { if(!empty($line)) $new_lines[] = trim($line); }
		echo implode($new_lines);

		}
	}

?>
<?php add_action('wp_head', 'homemarket_theme_option_styles', 90); ?>
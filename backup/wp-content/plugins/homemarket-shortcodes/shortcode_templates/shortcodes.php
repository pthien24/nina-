<?php
/*==============================================
			 	ShortCodes 
==============================================*/

if ( ! class_exists('HomemarketShortcodes') ):

	class HomemarketShortcodes {
		public $shortcodes = array(
			/* content */
			"custom_menu",
			"flexslider",
			"flexslider_individual",
			"product_brands",
			"product_brand",
			"product_category_carousel",
			"sale_product_carousel",
			"category_link_imgs",
			"category_link_img",
			"theme_info_box",
			"theme_google_map",
			"theme_masonry_view",
			"featured_categories",
			"featured_cateogry",
			"recent_post",
			"multi_products",
			"hm_best_selling_products",
			"hm_recent_products",
			"hm_content_blocks",
			"hm_content_block"
		);

		function __construct() {
			add_action( 'init', array( $this, 'add_shortcodes' ) );
			add_filter( 'woocommerce_product_get_rating_html', array( $this, 'get_rating_html_custom' ), 10 , 2 );
		}

		// Add ShortCodes
		function add_shortcodes() {
			foreach ( $this->shortcodes as $shortcode ) {
				$function_name = 'shortcode_' . $shortcode;
				add_shortcode( $shortcode, array( $this, $function_name ) );
			}
		}

		/* content */
		// Shortcode Custom Menu
		function shortcode_custom_menu( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'menu_name'      => '',
				'menu_title'     => 'All Collections',
				'title_bg_color' => '#000000',
				'class'          => ''
			), $atts ) );

            $atts = apply_filters( 'homemarket_shortcode_custom_menu_atts', $atts );

            $title_attr = 'style="background: ' .esc_attr( $title_bg_color ). ';"';
			$walker_collection = new rc_scm_walker_collection;

			ob_start();
			?>

			<div id="page-content-custom-menu" class="<?php echo $class; ?>">
				<div class="shop-by-collections always-show">
					<div class="sidebar-collections">
						<div class="sdcollections-title sb-title" <?php echo $title_attr; ?> >
							<i class="fa fa-list"></i>
							<span><?php echo $menu_title ?></span>
						</div>
						<div class="sdcollections-content">
							<?php
								wp_nav_menu(array(
						            'menu'       => $menu_name,
						            'walker'     => $walker_collection,
						            'items_wrap' => '<ul class="%1$s sdcollections-list">%3$s</ul>',
						        ));
						    ?>			
						</div>
					</div>
				</div>
			</div>

            <?php

            $content = ob_get_clean();

            $content = apply_filters( 'homemarket_shortcode_custom_menu', $content );

            return $content;
		}

		// Shortcode Flex Slider
		function shortcode_flexslider( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'animation_type' => 'fade',
				'class'          => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_flexslider_atts', $atts );

			$html = '';
			$html .= '<div class="main_slideshow_wrapper '.$class.'">';

			$content = do_shortcode( $content );
			preg_match_all( '/\<img class="featured-img"(.*?)>/i', $content, $featured_imgs, PREG_OFFSET_CAPTURE );

			if ( $featured_imgs[0] ) { 
				$html .= '<div id="slider" class="flexslider">';
					$html .= '<ul class="slides">';
					foreach ( $featured_imgs[0] as $key => $featured_img ) {
						$html .= '<li>' . $featured_img[0] . '</li>';
					}
					$html .= '</ul>';
				$html .= '</div>';
			}

			preg_match_all( '/<div class="thumb-slide(.*?)">(.*?)<\/div>/i', $content, $thumbnails, PREG_OFFSET_CAPTURE );

			if ( $thumbnails[0] ) { 
				$html .= '<div id="carousel" class="flexslider">';
					$html .= '<ul class="slides">';
					foreach ( $thumbnails[0] as $key => $thumbnail ) {
						$html .= '<li>' . $thumbnail[0] . '</li>';
					}
					$html .= '</ul>';
				$html .= '</div>';
			}

			$html .= '</div>';

			$html = apply_filters( 'homemarket_shortcode_flexslider', $html );

			return $html;
		}

		function shortcode_flexslider_individual( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'flex_featured_img'    => '',
				'flex_thumbnail_img'   => '',
				'flex_thumbnail_title' => '',
				'flex_thumbnail_dec'   => '',
				'class' => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_flexslider_individual_atts', $atts );

			$featured_img_src = wp_get_attachment_image_src( $flex_featured_img, 'full' );
			$thumbnail_img_src = wp_get_attachment_image_src( $flex_thumbnail_img, 'thumbnail' );

			$html = '';
			$html .= '<img class="featured-img" src="' . $featured_img_src[0] . '" alt="Slider Featured" />';

			$html .= '<div class="thumb-slide '.$class.'">';
			$html .= '<img src="' . $thumbnail_img_src[0] . '" alt="Slider Thumbnail" />';
			$html .= '<span class="cr-title"><a href="#" onclick="">' . $flex_thumbnail_title . '</a></span>';
			$html .= '<span class="cr-desc">' . $flex_thumbnail_dec . '</span>';
			$html .= do_shortcode( $content );
			$html .= '</div>';

			$html = apply_filters( 'homemarket_shortcode_flexslider_individual', $html );

			return $html;
		}

		// Shortcode Product Brand
		function shortcode_product_brands( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'brands_part_title' => '',
				'display_set' => 'grid',
				'columns' => '1',
				'carousel_nav' => 'style-1',
				'border_box' => '',
				'class'   => ''

			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_product_brands_atts', $atts );

			$carousel_class = '';

			if ( $display_set == 'carousel' ) {
				$carousel_class = 'carousel-brand owl-carousel';
			} else {
				$carousel_class = 'brands-elements ele-col-'. esc_attr( $columns );
			}

			if ( $border_box == 'yes' ) {
				$border_class = 'border_box';
			} else {
				$border_class = '';
			}

			$html = '';

			$html .= '<div class="brands-area ' . $class . ' '. $border_class .' ' . $carousel_nav . '">';
			if ( $brands_part_title ) {
				$html .= '<h4 class="title"><span>'. stripslashes($brands_part_title) .'</span></h4>';
			}
			//$html .= '<ul class="brands-elements ele-col-'. esc_attr( $columns ) .'">';
			$html .= '<ul class="' .$carousel_class. '" data-brand-column="' .$columns. '">';
			$html .= do_shortcode( $content );
			$html .= '</ul>';
			$html .= '</div>';

			$html = apply_filters( 'homemarket_shortcode_product_brands', $html );

			return $html;
		}

		function shortcode_product_brand( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'brand_name' => '',
				'class'      => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_product_brand_atts', $atts );

			$current_brand_term = get_term_by( 'name', $brand_name, 'brand_taxonomy', ARRAY_A );
			$current_brand_term_id = $current_brand_term['term_id'];
			$brand_img_id = get_term_meta( $current_brand_term_id, 'category-image-id' );
			$current_brand_link = get_category_link( $current_brand_term_id );

			if ( $brand_img_id[0] != 0 ) {
				$brand_img_src = wp_get_attachment_image_src( $brand_img_id[0], 'full' );
			}
			
			$html = '';

			$html .= '<li class="' . $class . '">';
			$html .= '<a href="'.$current_brand_link.'"><img src="' . $brand_img_src[0] . '" alt="Brand Image" /></a>';
			$html .= do_shortcode( $content );
			$html .= '</li>';

			$html = apply_filters( 'homemarket_shortcode_product_brand', $html );

			return $html;
		}

		// Product list Carousel
		function shortcode_product_category_carousel( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'display_style' => 'carousel',
				'category'      => '',
				'per_page'      => '12',
				'rows'			=> 1,
				'columns'       => '4',
				'orderby'       => 'menu_order',
				'order'         => 'asc',
				'operator'      => 'IN',
				'carousel_nav' => 'style-1',
				'hidden_rating' => '',
				'hidden_title'  => '',
				'hidden_price'  => '',
				'hidden_desc'   => '',
				'hidden_cart_btn' => '',
				'part_title'    => '',
				'border_box'    => '',
				'class'         => ''
			), $atts );

			if ( ! $atts['category'] ) {
				return '';
			}
			
			$atts = apply_filters( 'homemarket_shortcode_product_category_carousel', $atts );

			// Default ordering args
			$ordering_args = WC()->query->get_catalog_ordering_args( $atts['orderby'], $atts['order'] );
			$meta_query    = WC()->query->get_meta_query();
			$query_args    = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'orderby'             => $ordering_args['orderby'],
				'order'               => $ordering_args['order'],
				'posts_per_page'      => $atts['per_page'],
				'meta_query'          => $meta_query
			);

			$query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );	
			
			if ( isset( $ordering_args['meta_key'] ) ) {
				$query_args['meta_key'] = $ordering_args['meta_key'];
			}		

			$return = self::homemarket_product_loop( $query_args, $atts, $atts['display_style'], 'product_cat' );

			// Remove ordering query arguments
			WC()->query->remove_ordering_args();

			return $return;
		}

		function shortcode_sale_product_carousel( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'display_style' => 'carousel',
				'category'      => '',
				'per_page'      => '12',
				'columns'       => '4',
				'rows'          => '1',
				'orderby'       => 'menu_order',
				'order'         => 'asc',
				'operator'      => 'IN',
				'carousel_nav' => 'style-1',
				'hidden_rating' => '',
				'hidden_title'  => '',
				'hidden_price'  => '',
				'hidden_desc'   => '',
				'hidden_cart_btn' => '',
				'part_title'    => '',
				'border_box'    => '',
				'class'         => ''
			), $atts );

			$query_args = array(
				'posts_per_page' => $atts['per_page'],
				'orderby'        => $atts['orderby'],
				'order'          => $atts['order'],
				'no_found_rows'  => 1,
				'post_status'    => 'publish',
				'post_type'      => 'product',
				'meta_query'     => WC()->query->get_meta_query(),
				'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
			);

			$query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );

			return self::homemarket_product_loop( $query_args, $atts, $atts['display_style'], 'sale_products' );
		}

		// Category Link
		function shortcode_category_link_imgs( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'columns' => '1',
				'class'   => ''
			), $atts ) );

			$html = '';

			$html .= '<div class="image-blogs category_img_links ele-col-'. $columns .' '. $class .'" data-img-column="' . $columns . '">';
			$html .= do_shortcode( $content );
			$html .= '</div>';

			return $html;
		}

		function shortcode_category_link_img( $atts, $content =  null ) {
			extract( shortcode_atts( array(
				'seleted_category' => '',
				'seleted_taxonomy' => '',
				'featured_img'     => '',
				'custom_link'      => '',
				'image_size'       => 'full',
				'image_title'      => '',
				'image_subtitle'   => '',
				'image_text_color' => '',
				'image_text_align' => 'left',
				'hover_animation'  => '',
				'class'            => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_category_link_img', $atts );

			$image_link = '';
			if ( $seleted_category ) {

				$category = get_term_by( 'name', $seleted_category, 'product_cat', ARRAY_A );
				$category_id = $category['term_id'];
				$category_link = get_category_link( $category_id );	
				$image_link = $category_link;

			} else if ( $seleted_taxonomy ) {

				$taxonomy = get_terms( 'name', $seleted_taxonomy, 'brand_taxonomy', ARRAY_A );
				$taxonomy_id = $taxonomy['term_id'];
				$taxonomy_link = get_category_link( $taxonomy_id );	
				$image_link = $taxonomy_link;

			} else {

				$image_link = $custom_link;

			}

			$link_img_src = wp_get_attachment_image_src( $featured_img, $image_size );
			
			$html = '';

			$html .= '<div class="category_img_link ' . esc_attr($hover_animation) . ' ' . $class . '">';
			$html .= '<a href="'.$image_link.'">';
			$html .= '<img src=" '.$link_img_src[0].' " alt="Linked Image" />';

			if ( $image_title || $image_subtitle ) {
				$html .= '<div class="image_text_content" style=" color: '. esc_attr($image_text_color) .'; text-align: '. esc_attr($image_text_align) .'; ">';
				if ( $image_title ) {
					$html .= '<h1>' . stripslashes($image_title) . '</h1>';
				}
				if ( $image_subtitle ) {
					$html .= '<p>' . stripslashes($image_subtitle) . '</p>';
				}
				$html .= '</div>';
			}

			$html .= '</a>';
			$html .= do_shortcode( $content );
			$html .= '</div>';

			return $html;
		}

		// Info box
		function shortcode_theme_info_box( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'info_box_icon_type'   => 'fontawesome',
				'theme_divider_icon'   => '',
				'theme_divider_image'  => '',
				'icon_size'            => '14',
				'icon_font_color'      => '#ffffff',
				'img_icon_width'       => '48',
				'info_box_icon_style'  => '',
				'icon_font_background' => '#fa5555',
				'info_box_title'       => '',
				'title_font_weight'    => 'initial',
				'title_font_size'      => '14',
				'title_bottom_space'   => '10',
				'info_box_description' => '',
				'text_font_color'      => '#696969', 
				'text_vertical_align'  => 'normal',
				'class'                => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_theme_info_box_atts', $atts );

			$icon_background = '';
			if ( $theme_divider_image ) {
				$divider_image_url = wp_get_attachment_image_src( $theme_divider_image, 'full' );
			}

			if ( $info_box_icon_style ) {
				$icon_background = $icon_font_background;
			} else {
				$icon_background = 'transparent';
			}

			if ( $text_vertical_align == 'middle' ) {
				$vertical_align_style = 'vertical-align: middle;';
			} else {
				$vertical_align_style = '';
			}

			$html = '';

			$html .= '<div class="info-box-component '.$class.'">';
			$html .= '<div id="info-box-wrap">';
			$html .= '<div class="info-box-icon-default" style="' . $vertical_align_style . '">';

			if ( $theme_divider_icon ) {
				$html .= '<div class="box-font-icon '.$info_box_icon_style.'" style="display: inline-block; color: '.esc_attr($icon_font_color).'; background: '.esc_attr($icon_background).'; font-size: '.esc_attr($icon_size).'px; ">';
				$html .= '<i class="'.$theme_divider_icon.'"></i>';
				$html .= '</div>';
			}

			if ( !empty($divider_image_url) ) {
				$html .= '<div class="box-image-icon '.$info_box_icon_style.'" style="display: inline-block; background: '.esc_attr($icon_background).'; font-size: '.esc_attr($img_icon_width).'px; ">';
				$html .= '<img class="img-icon" src="' . $divider_image_url[0] . '" alt="Info Icon" />';
				$html .= '</div>';
			}

			$html .= '</div>';

			$html .= '<div class="info-box-icon-header" style="color: '.esc_attr($text_font_color).'; ' . $vertical_align_style . '">';
			$html .= '<h3 style="font-size:'.esc_attr($title_font_size).'px; font-weight:'.esc_attr($title_font_weight).'; margin-bottom: ' . $title_bottom_space . 'px;">'.stripslashes($info_box_title).'</h3>';
			$html .= '<div class="info-box-icon-description">'.$info_box_description.'</div>';
			$html .= '</div>';
			$html .= do_shortcode( $content );
			$html .= '</div></div>';

			return $html;
		}

		// Google Map
		function shortcode_theme_google_map( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'map_width' => '100%',
				'map_height' => '500px',
				'map_type'   => 'ROADMAP',
				'map_center_posi' => '',
				'map_zoom' => '12',
				'map_type_control' => 'true',
				'map_navigation_control' => 'true',
				'map_scroll_control' => 'true',
				'map_street_view_control' => 'true',
				'map_custom_icon' => '',
				'map_draggale_control' => 'true',
				'map_styled' => 'default',
				'class' => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_theme_google_map_atts', $atts );

			global $google_default, $ultra_light, $subtle_gray, $shades_grey, $blue_water, $blue_dark_sea, $midnight_commander;

			if ( ! empty( $map_zoom ) && is_numeric( $map_zoom ) ) { $map_zoom = 'zoom: ' . esc_attr( $map_zoom ) . ','; } else { $map_zoom = ''; }
			if ( ( $map_type_control == 'yes' ) || ( $map_type_control == 'true' ) ) { $map_type_control = 'mapTypeControl: true,'; } else { $map_type_control = 'mapTypeControl: false,'; }
			if ( ( $map_navigation_control == 'yes' ) || ( $map_navigation_control == 'true' ) ) { $map_navigation_control = 'navigationControl: true,'; } else { $map_navigation_control = 'navigationControl: false,'; }
			if ( ( $map_scroll_control == 'yes' ) || ( $map_scroll_control == 'true' ) ) { $map_scroll_control = 'scrollwheel: true,'; } else { $map_scroll_control = 'scrollwheel: false,'; }
			if ( ( $map_street_view_control == 'yes' ) || ( $map_street_view_control == 'true' ) ) { $map_street_view_control = 'streetViewControl: true,'; } else { $map_street_view_control = 'streetViewControl: false,'; }
			if ( ( $map_draggale_control == 'yes' ) || ( $map_draggale_control == 'true' ) ) { $map_draggale_control = 'draggable: true,'; } else { $map_draggale_control = 'draggable: false,'; }

			$map_types = array( 'ROADMAP', 'SATELLITE', 'HYBRID', 'TERRAIN' );
			$map_type = strtoupper( $map_type );
			if ( empty( $map_type) || ! in_array( $map_type, $map_types ) ) $map_type = 'ROADMAP';
			$map_type = 'mapTypeId: google.maps.MapTypeId.' . $map_type . ',';

			static $map_id = 1;
			$class = empty( $class )?'':( ' class="' . esc_attr( $class ) . '"' );

			$custom_marker = '';
			if ( $map_custom_icon ) {
				$icon_src = wp_get_attachment_image_src( $map_custom_icon, 'homemarket-map-marker3' );
				$custom_marker = 'options: { icon: "' . esc_attr( $icon_src[0] ) . '" }';
			}

			$center_str = '';
			$marker_str = '';
			if ( ! empty( $map_center_posi ) ) {
				$center_str = 'center: [' . esc_attr( $map_center_posi ) . '],';
				$marker_str = 'marker: { 
					latLng: [' . esc_attr( $map_center_posi ) . '], 
					' . $custom_marker . '
				},';	
			} 

			$map_seleted_style = '';
		    if ( $map_styled == 'default' ) {
		        $map_seleted_style = $google_default;
		    } elseif ( $map_styled == 'ultra_light' ) {
		      	$map_seleted_style = $ultra_light;
		    } elseif ( $map_styled == 'subtle_gray' ) {
		      	$map_seleted_style = $subtle_gray;
		    } elseif ( $map_styled == 'shades_grey' ) {
		      	$map_seleted_style = $shades_grey;
		    } elseif ( $map_styled == 'blue_water' ) {
		      	$map_seleted_style = $blue_water;
		    } elseif ( $map_styled == 'blue_dark_sea' ) {
		      	$map_seleted_style = $blue_dark_sea;
		    } elseif ( $map_styled == 'midnight_commander' ) {
		    	$map_seleted_style = $midnight_commander;
		    }
		    
			$html = '';
			$html .= '<div id="map' . esc_attr( $map_id ) . '"' . $class . ' style="width:' . esc_attr( $map_width ) . ';height:' . esc_attr( $map_height ) . '"></div>';
			$html .=
			'<script type="text/javascript">
				jQuery(document).ready( function() {
					jQuery("#map' . $map_id . '").gmap3({
						map: {options: {' . $center_str . $map_zoom . $map_type . $map_type_control . $map_navigation_control . $map_scroll_control . $map_street_view_control . $map_draggale_control . '}},'
						. $marker_str. ' ' . $map_seleted_style . '
					});
					jQuery("#map1").gmap3("get").setMapTypeId("style1");
				});
			</script>';
			$map_id++;

			return $html;
		}

		//  Masonry Grid
		function shortcode_theme_masonry_view( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'masonry_image_lists' => '',
				'masonry_image_effect' => 'effect-1',
				'class' => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_theme_masonry_view_atts', $atts );

			$class = empty( $class )?'':( ' class="' . esc_attr( $class ) . '"' );

			$html = '';
			if ( $masonry_image_lists ) {

				$image_array_lists = explode( ',', $masonry_image_lists );

				$html .= '<div ' . $class . '>';
				$html .= '<ul class="masonry_image_grid grid ' . esc_attr( $masonry_image_effect ) . '" id="masonry_grid">';
				foreach ($image_array_lists as $image_array_list) {
					$masonry_image_url = wp_get_attachment_image_src( $image_array_list, 'full' );
					$html .= '<li class="grid-item"><div class="mask"><img src="' . esc_url($masonry_image_url[0]) . '" alt="Masonry Images" /></div></li>';
				}
				$html .= '</ul>';
				$html .= '<div>';
			}
			// $html .= '<script type="text/javascript">
			// new AnimOnScroll( document.getElementById( "masonry_grid" ), {
			// 	minDuration : 0.4,
			// 	maxDuration : 0.7,
			// 	viewportFactor : 0.2
			// } );
			// </script>';

			$html = apply_filters( 'homemarket_shortcode_theme_masonry_view', $html );

			return $html;
		}

		// Featured Category
		function shortcode_featured_categories( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'featured_part_title' => '',
				'display_set' => 'grid',
				'columns' => '1',
				'carousel_nav' => 'style-1',
				'class'   => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_featured_cateogries_atts', $atts );

			$carousel_class = '';

			if ( $display_set == 'carousel' ) {
				$carousel_class = 'carousel-category owl-carousel';
			} else {
				$carousel_class = 'categories-elements ele-col-'. esc_attr( $columns );
			}

			$html = '';

			$html .= '<div class="categories-area ' . $class . ' ' . $carousel_nav . '">';
			if ( $featured_part_title ) {
				$html .= '<h3 class="title"><span>' . stripslashes( $featured_part_title ) . '</span></h3>';
			}
			$html .= '<ul class="' .$carousel_class. ' ' . $carousel_nav . '" data-brand-column="' .$columns. '">';
			$html .= do_shortcode( $content );
			$html .= '</ul>';
			$html .= '</div>';

			$html = apply_filters( 'homemarket_shortcode_featured_categories', $html );

			return $html;
		}

		function shortcode_featured_cateogry( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'category_name' => '',
				'category_title' => '',
				'category_item' => '',
				'class' => '',
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_featured_cateogry_atts', $atts );

			$current_category_term = get_term_by( 'name', $category_name, 'product_cat', ARRAY_A );

			if ( false == $current_category_term ) { 
			    $current_category_term = get_term_by( 'slug', $category_name, 'product_cat', ARRAY_A );
			}

			$current_category_title = $current_category_term['name'];
			$current_category_item = $current_category_term['count'];
			$current_category_term_id = $current_category_term['term_id'];

			$category_img_id = get_term_meta( $current_category_term_id, $key = 'thumbnail_id' );
			$current_category_link = get_category_link( $current_category_term_id );

			if ( $category_img_id[0] != 0 ) {
				$category_img_src = wp_get_attachment_image_src( $category_img_id[0], 'full' );
			}

			$html = '';

			$html .= '<li class="coll-items ' . $class . '">';
			$html .= '<a href="'.$current_category_link.'"><img src="' . $category_img_src[0] . '" alt="Category Featured Image" /></a>';
			if ( $category_title || $category_item  ) {
				$html .= '<div class="detail">';
				if ( $category_title ) {
					$html .= '<h3 class="name">'. $current_category_title .'</h3>';
				}
				if ( $category_item ) {
					$html .= '<p class="count">'. $current_category_item .' '. __('items', 'homemarket') .'</p>';
				}
				$html .= '</div>';
			}
			$html .= do_shortcode( $content );
			$html .= '</li>';

			return $html;

		}

		// Recent Posts
		function shortcode_recent_post( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'title' => '',
				'title_style' => 'style-1',
				'display_set' => 'grid',
				'columns' => '1',
				'per_page' => '4',
				'post_date' => 'true',
				'post_comments' => 'true',
				'post_readmore' => 'true',
				'class' => ''
			), $atts ) );

			$atts = apply_filters( 'homemarket_shortcode_recent_post_atts', $atts );
			
			$args = array(
				'numberposts' => $per_page,
				'offset' => 0,
				'category' => 0,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'include' => '',
				'exclude' => '',
				'meta_key' => '',
				'meta_value' =>'',
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => true
			);

			$carousel_class = '';

			if ( $display_set == 'carousel' ) {
				$carousel_class = 'carousel-post owl-carousel';
			} else {
				$carousel_class = 'grid-post';
			}

			$html = '';

			$recent_posts = wp_get_recent_posts( $args );
			$html .= '<div class="recent-post-inner">';
			$html .= '<h3 class="title ' . $title_style . '"><span>' . stripcslashes( $title ) . '</span></h3>';
			$html .= '<div class="recent-post-content ' . $class . ' ' . $carousel_class . '" data-post-column="' .$columns. '">';
			foreach( $recent_posts as $recent ){
				$post_content = $recent['post_content'];
				$post_content = explode( ' ', $post_content, 26 );
				
				if ( count( $post_content ) >= 26 ) {
					array_pop( $post_content );
					$post_content = implode( " ",$post_content ).'... ';
				} else {
					$post_content = implode( " ", $post_content );
				}

				$html .= '<div class="recent-post-item"><div class="recent-post-item-inner">';
				$html .= '<div class="recent-post-top">';
				$html .= get_the_post_thumbnail( $recent['ID'], 'homemarket-blog' );
				if ( $post_date == 'true' ) {
					$html .= '<span class="post-date">' . get_the_time( 'j', $recent['ID'] );
					$html .= '<small>' . get_the_time( 'M', $recent['ID'] ) . '</small>';
					$html .= '</span>';
				}
				$html .= '</div>';
				$html .= '<div class="recent-post-bottom">';
				$html .= '<h4 class="title">' . $recent["post_title"] . '</h4>';
				$html .= '<p class="description">' . $post_content . '</p>';
				$html .= '<div class="group-area">';
				if ( $post_readmore == 'true' ) {
					$html .= '<div class="recent-post-action">';
					$html .= '<a href="' . get_permalink($recent["ID"]) . '"><i class="fa fa-caret-right"></i>' . __( 'Read More', 'homemarket' ) . '</a>';
					$html .= '</div>';
				}
				if ( $post_comments == 'true' ) {
					$html .= '<div class="recent-post-cmt">';
					$html .= '<i class="fa fa-comments-o"></i><span>' . $recent['comment_count'] . '</span>';
					$html .= '</div>';
				}
				$html .= '</div></div>';
				$html .= '</div></div>';
			}
			$html .= '</div></div>';
			wp_reset_query();

			return $html;
		}

		// Homemarket Multi products
		function shortcode_multi_products( $atts, $content = null ) {
			$atts = apply_filters( 'homemarket_shortcode_multi_products_atts', $atts );

			$atts = shortcode_atts( array(
				'part_title' => '',
				'display_style' => 'grid',
				'columns' => '1',
				'rows' => '1',
				'orderby' => 'title',
				'order'   => 'ASC',
				'carousel_nav' => 'style-1',
				'image_width' => 'normal_width',
				'border_box' => '',
				'hidden_rating' => '',
				'hidden_title' => '',
				'hidden_price' => '',
				'hidden_desc' => '',
				'hidden_cart_btn' => '',
				'ids' => '',
				'skus' => '',
				'class' => '',
			), $atts );

			$query_args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'orderby'             => $atts['orderby'],
				'order'               => $atts['order'],
				'posts_per_page'      => -1,
				'meta_query'          => WC()->query->get_meta_query()
			);

			if ( ! empty( $atts['skus'] ) ) {
				$query_args['meta_query'][] = array(
					'key'     => '_sku',
					'value'   => array_map( 'trim', explode( ',', $atts['skus'] ) ),
					'compare' => 'IN'
				);

				// Ignore catalog visibility
				$query_args['meta_query'] = array_merge( $query_args['meta_query'], WC()->query->stock_status_meta_query() );
			}

			if ( ! empty( $atts['ids'] ) ) {
				$query_args['post__in'] = array_map( 'trim', explode( ',', $atts['ids'] ) );

				// Ignore catalog visibility
				$query_args['meta_query'] = array_merge( $query_args['meta_query'], WC()->query->stock_status_meta_query() );
			}

			return self::homemarket_product_loop( $query_args, $atts, $atts['display_style'], 'products' );
		}

		// Homemarket Best selling products
		function shortcode_hm_best_selling_products( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'part_title' => '',
				'display_style' => 'grid',
				'category' => '',
				'per_page' => '12',
				'columns' => '1',
				'rows' => '1',
				'carousel_nav' => 'style-1',
				'operator' => 'IN',
				'class' => '',
			), $atts );

			$query_args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => $atts['per_page'],
				'meta_key'            => 'total_sales',
				'orderby'             => 'meta_value_num',
				'meta_query'          => WC()->query->get_meta_query()
			);

			$query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );

			return self::homemarket_product_loop( $query_args, $atts, $atts['display_style'], 'best_selling_products' );
		}

		// homemarket recent Products
		function shortcode_hm_recent_products( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'part_title' => '',
				'display_style' => 'grid',
				'category' => '',
				'per_page' => '12',
				'columns' => '1',
				'rows' => '1',
				'orderby'  => 'date',
				'order'    => 'desc',
				'carousel_nav' => 'style-1',
				'operator' => 'IN',
				'class' => '',
			), $atts );

			$query_args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => $atts['per_page'],
				'orderby'             => $atts['orderby'],
				'order'               => $atts['order'],
				'meta_query'          => WC()->query->get_meta_query()
			);

			$query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );

			return self::homemarket_product_loop( $query_args, $atts, $atts['display_style'], 'recent_products' );
		}

		// Homemarket Content Blocks
		function shortcode_hm_content_blocks( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'blocks_title' => '',
				'blocks_title_style' => 'style-1',
				'columns' => '4',
				'class' => '',
			), $atts ) );

			$html = '';

			if ( $columns > 6 ) {
				$columns = 6;
			}

			$html .= '<div class="content-blocks-area ' . $class . ' ele-col-' . $columns . '">';
			if ( $blocks_title ) {
				$html .= '<h3 class="title ' . $blocks_title_style . '"><span>' . stripcslashes($blocks_title) . '</span></h3>';
			}
			$html .= '<div class="content-blocks-inner">';
			$html .= do_shortcode( $content );
			$html .= '</div></div>';

			return $html;
		}

		function shortcode_hm_content_block( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'part_title' => '',
				'content_block_description' => '',
				'content_background_img' => '',
				'block_btn_link' => '',
				'class' => ''
			), $atts ) );

			if ( $content_background_img ) {
				$background_img_src = wp_get_attachment_image_src( $content_background_img, 'homemarket-blog' );

				$background_style = 'background-image: url(' . esc_url( $background_img_src[0] ) . ')';
			}


			$html = '';
			
			$html .= '<div class="block-inner"><div class="content-block ' . $class . '" style="' . $background_style . '">';
			$html .= '<h3 class="title">' . stripcslashes($part_title) . '</h3>';
			$html .= '<div class="block-inner-content">';
			$html .= $content_block_description;
			$html .= '</div>';
			$html .= '<div class="link-action">';
			$html .= '<a href="' . esc_url( $block_btn_link ) . '">'. __( 'VIEW MORE', 'homemarket' ) .'<i class="fa fa-caret-right"></i></a>';
			$html .= '</div></div></div>';

			return $html;
		}



		/*==========================================================================================================
													functions added
		===========================================================================================================*/

		private static function _maybe_add_category_args( $args, $category, $operator ) {
			if ( ! empty( $category ) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'terms'    => array_map( 'sanitize_title', explode( ',', $category ) ),
						'field'    => 'slug',
						'operator' => $operator
					)
				);
			}

			return $args;
		}

		private static function homemarket_product_loop( $query_args, $atts, $style, $loop_name ) {
			global $woocommerce_loop;

			$products                    = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, $loop_name ) );
			$columns                     = absint( $atts['columns'] );
			$woocommerce_loop['columns'] = $columns;
			$woocommerce_loop['name']    = $loop_name;

			if ( $style == 'carousel' ) {
				$woocommerce_loop['display_style'] = 'carousel';
			} elseif ( $style == 'grid' ) {
				$woocommerce_loop['display_style'] = 'grid';
			} elseif ( $style == 'list' ) {
				$woocommerce_loop['display_style'] = 'list';
			} elseif ( $style == 'carousel_list' ) {
				$woocommerce_loop['display_style'] = 'carousel_list';
			}

			if ( $atts['rows'] > 1 ) {
				$woocommerce_loop['row_enable'] = true;
			} else {
				$woocommerce_loop['row_enable'] = false;
			}

			$woocommerce_loop['navigation_style'] = $atts['carousel_nav'];

			if ( isset($atts['image_width']) ) {
				$product_img_width = $atts['image_width'];
			} else {
				$product_img_width = '';
			}

			$hidden_rating = ''; $hidden_title = ''; $hidden_price = ''; $hidden_desc = ''; $hidden_cart_btn = '';
			if ( isset($atts['hidden_rating']) ) {
				if ( 'true' == $atts['hidden_rating'] || 'yes' == $atts['hidden_rating'] ) {
					$hidden_rating = 'hidden_rating';
				}
			}
			if ( isset($atts['hidden_title']) ) {
				if ( 'true' == $atts['hidden_title'] || 'yes' == $atts['hidden_title'] ) {
					$hidden_title = 'hidden_title';
				}
			}
			if ( isset($atts['hidden_price']) ) {
				if ( 'true' == $atts['hidden_price'] || 'yes' == $atts['hidden_price'] ) {
					$hidden_price = 'hidden_price';
				}
			}
			if ( isset($atts['hidden_desc']) ) {
				if ( 'true' == $atts['hidden_desc'] || 'yes' == $atts['hidden_desc'] ) {
					$hidden_desc = 'hidden_desc';
				}
			}
			if ( isset($atts['hidden_cart_btn']) ) {
				if ( 'true' == $atts['hidden_cart_btn'] || 'yes' == $atts['hidden_cart_btn'] ) {
					$hidden_cart_btn = 'hidden_cart_btn';
				}
			}

			$hidden_style = '';
			$hidden_style = $hidden_rating . ' ' . $hidden_title . ' ' . $hidden_price . ' ' . $hidden_desc . ' ' . $hidden_cart_btn;

			$title_heading = '';
			if ( $atts['part_title'] )
				$title_heading = '<h4 class="title"><span>'. stripslashes($atts['part_title']) .'</span></h4>';

			$border_box = '';
			if ( isset($atts['border_box']) ) {
				if ( 'yes' == $atts['border_box'] ) {
					$border_box = 'border_box';
				}
			}

			ob_start();

			if ( $products->have_posts() ) {
				?>

				<?php do_action( "woocommerce_shortcode_before_{$loop_name}_loop" ); ?>

				<?php woocommerce_product_loop_start(); ?>

					<?php 
						$index = 0; 
						while ( $products->have_posts() ) : $products->the_post(); 
					?>
					
						<?php
							if ( $style == 'carousel' || $style == 'carousel_list' ) {
								if ( $index == 0 )
									echo '<div class="product-item-wrapper">';

								if ( $index % $atts['rows'] == 0 && $index != 0 ) {
									echo '</div><div class="product-item-wrapper">';
								}
							}
						?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php 
						$index++; 
						endwhile; // end of the loop. 

						if ( $style == 'carousel' || $style == 'carousel_list' ) {
							?></div><?php
						}
					?>
					
				<?php woocommerce_product_loop_end(); ?>

				<?php do_action( "woocommerce_shortcode_after_{$loop_name}_loop" ); ?>

				<?php
			} else {
				do_action( "woocommerce_shortcode_{$loop_name}_loop_no_results" );
			}

			woocommerce_reset_loop();
			wp_reset_postdata();

			return '<div class="' . $atts['class'] . '"><div class="carousel-products '. $border_box .' '. $product_img_width .' woocommerce columns-' . $columns . ' '. $hidden_style .' '. $atts['carousel_nav'] .'" data-column="'.$columns.'">'. $title_heading . ob_get_clean() . '</div></div>';
		}

		function get_rating_html_custom( $rating_html, $rating ) {
			if ( $rating == 0 ) {
				$rating_html  = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'homemarket' ), $rating ) . '">';

				$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'homemarket' ) . '</span>';

				$rating_html .= '</div>';
			}

			return $rating_html;
		}

	}

endif;
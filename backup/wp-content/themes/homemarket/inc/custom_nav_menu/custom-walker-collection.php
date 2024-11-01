<?php
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class rc_scm_walker_collection extends Walker_Nav_Menu
{
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{		   
	   
		global $wp_query, $wpdb;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) .' sdc-element vetical-menu1 site-nav--has-dropdown"';

		$output .= $indent . '<li id="homemarket-menu-item-'. esc_attr( $item->ID ) . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$prepend = '';
		$append = '';
		//$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';



		/************************* Get Custom Menu Value Start ************************/

		$collection_icon = ! empty( $item->collection_icon ) ? $item->collection_icon : '';
		$featured_img = ! empty( $item->featured_img ) ? $item->featured_img : '';

		if ( $collection_icon != "" ) {
			$collection_icon_url = 'src="' . esc_url( $collection_icon ) . '"';
			$collection_icon_class = "added-icon";
		} else {
			$collection_icon_url = 'src="#"';
			$collection_icon_class = "blank-icon";
		}

		if ( $featured_img != "" ) {
			$featured_img_url = $featured_img;
			$featured_img_class = "added-featured-img";
		} else {
			$featured_img_url = "#";
			$featured_img_class = "blank-featured-img";
		}

		if($depth != 0)
		{
		$description = $append = $prepend = "";
		}

		/************************* Get Custom Menu Value Start ************************/

		/*====================================================================
						Inset Output Content Start
		=====================================================================*/

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .' class="site-nav__link">';
		$item_output .= '<img src="'. esc_url( $featured_img_url ).'" class="'.$featured_img_class.'" alt="" /><div style="clear: both;"></div>';
		$item_output .= '<div class="element-main">';
		$item_output .= '<div class="collection-icon '.$collection_icon_class.'"><img '.$collection_icon_url.' alt="" /></div>';
		$item_output .= '<div class="collection-area have-icons '.$featured_img_class.'"><div class="collection-name">'.$args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append.'</div></div>';
		$item_output .= '</div>';
		$item_output .= '<span class="icon icon-arrow-right"></span>';
		$item_output .= $args->link_after;
		//$item_output .= $description.$args->link_after;
		//$item_output .= ' '.$item->background_url.'</a>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		/*====================================================================
						Inset Output Content End
		=====================================================================*/

		apply_filters( 'walker_nav_menu_start_lvl', $item_output, $depth, $args->background_url = $item->background_url );
	}
	 

	 function start_lvl(&$output, $depth = 0, $args = array()) {
		if ($args->background_url != "" && $args->background_option != "") {
			$bg_class = "with_bg_image";
			$bg_style = "background-image:url(". esc_url( $args->background_url ).");";
		} else {
			$bg_class = "";
			$bg_style = "";
		}

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"site-nav__dropdown vetical__dropdown vetical__dropdown1".$bg_class." level-".$depth."\" ".$bg_style.">\n";
	}
}
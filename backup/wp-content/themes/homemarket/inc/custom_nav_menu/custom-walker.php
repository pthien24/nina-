<?php
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class rc_scm_walker extends Walker_Nav_Menu
{
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{		   
	   
	   global $wp_query, $wpdb;
	   
	   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	   $class_names = $value = '';
	
	   $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
	   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	   $class_names = ' class="'. esc_attr( $class_names ) . '"';
	
	   $output .= $indent . '<li ' . $value . $class_names .'>';
	
	   $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	   $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	   $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	   $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
	   $prepend = '';
	   $append = '';
	   //$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';



	   /************************* Get Custom Menu Value Start ************************/

	   $custom_content = ! empty( $item->custom_content ) ? $item->custom_content : '';
	   $menu_marker = ! empty( $item->menu_marker ) ? $item->menu_marker : '';
	   
	   if ( $menu_marker == "title" ) {
	   		$menu_marker_class = "hidden_marker";
	   		$menu_marker_id = "";
	   } else {
	   		$menu_marker_class = "";
	   		$menu_marker_id = $menu_marker;
	   }

	   if ( $item->label_hidden != "" ) {
	   		$label_class = "navigation-label-hidden";
	   } else {
	   		$label_class = "";
	   }
	
	   if($depth != 0)
	   {
		   $description = $append = $prepend = "";
	   }

	   $collection_icon = ! empty( $item->collection_icon ) ? $item->collection_icon : '';

		if ( $collection_icon != "" ) {
			$collection_icon_url = 'src="' . esc_url ( $collection_icon ) . '"';
			$collection_icon_class = "added-icon";
		} else {
			$collection_icon_url = 'src="#"';
			$collection_icon_class = "blank-icon";
		}

	   /************************* Get Custom Menu Value Start ************************/

	   /************************* Get Marker Style Start ************************/

	   $sql = $wpdb->prepare( 'SELECT * FROM %1$s WHERE marker_id = %2$d', HM_MARKER_TABLE, $menu_marker_id );
       $marker_data = $wpdb->get_row( $sql, ARRAY_A );

       $marker_name = $marker_data['marker_name'];
       $marker_color = $marker_data['marker_background_color'];

	   /************************* Get Marker Style End **************************/
	   

	   /*====================================================================
							Inset Output Content Start
	   =====================================================================*/
	
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= '<img class="menu-icon '.$collection_icon_class.'" ' . $collection_icon_url . ' alt="' . __('Collection Icon', 'homemarket') . '" />';
		$item_output .= '<span class="menu-label ' .$label_class. '">'. $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append. '</span>';
		$item_output .= '<div class="menu-marker ' .$menu_marker_class. '"><div class="marker-content"><i class="fa fa-comment" aria-hidden="true" style="color:'.$marker_color.';"></i><span>'. esc_html( $marker_name ) .'</span></div></div>';
		$item_output .= $custom_content.$args->link_after;
		//$item_output .= $description.$args->link_after;
		//$item_output .= ' '.$item->background_url.'</a>';
		$item_output .= '</a>';
		$item_output .= $args->after;
	
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		/*====================================================================
							Inset Output Content End
	   =====================================================================*/
		
		apply_filters( 'walker_nav_menu_start_lvl', $item_output, $depth, $args->background_url = $item->background_url, $args->background_width = $item->background_width, $args->background_repeat = $item->background_repeat, $args->background_size = $item->background_size, $args->background_position = $item->background_position, $args->background_option = $item->background_option, $args->menu_view = $item->menu_view );
	 }
	 

	 function start_lvl(&$output, $depth = 0, $args = array()) {
		if ($args->background_url != "" && $args->background_option != "") {
			$bg_class = "with_bg_image";
			$bg_style = "background-image:url(". esc_url( $args->background_url ).");";
		} else {
			$bg_class = "";
			$bg_style = "";
		}

		if ($args->background_width != "" && $args->background_option != "") {
			$width_option = $args->background_width;
			$full_width_class = "full-width";
		} else {
			$width_option ="";
			$full_width_class = "";
		}

		if ($args->background_repeat != "" && $args->background_option != "") {
			$bg_repeat = "background-repeat:".$args->background_repeat.";";
		} else {
			$bg_repeat ="";
		}

		if ($args->background_size != "" && $args->background_option != "") {
			$bg_size = "background-size:".$args->background_size.";";
		} else {
			$bg_size ="";
		}

		if ($args->background_position != "" && $args->background_option != "") {
			$bg_position = "background-position:".$args->background_position.";";
		} else {
			$bg_position ="";
		}

		$menu_view = ! empty( $args->menu_view ) ? $args->menu_view : 'list_menu';

		$menu_view_class = "";
		if ( $menu_view == "list_menu" ) {
			$menu_view_class = " original_view ";
		}

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu ".$menu_view_class.$bg_class." level-".$depth." ".$full_width_class." \" style=\" ".$bg_style." ".$bg_repeat." ".$bg_size." ".$bg_position." \">\n";
	}
}
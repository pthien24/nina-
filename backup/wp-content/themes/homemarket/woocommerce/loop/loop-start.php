<?php
/**
 * Product Loop Start
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php
	global $woocommerce_loop;
	$class = "";
	
	if ( isset( $woocommerce_loop['display_style'] ) ) {
		if ( $woocommerce_loop['display_style'] == 'carousel' ) {
			$class = "home-products-carousel-enable owl-carousel";
		} elseif ( $woocommerce_loop['display_style'] == 'grid' ) {
			$class = "grid";
		} elseif ( $woocommerce_loop['display_style'] == 'list' ) {
			$class = "list";
		} elseif ( $woocommerce_loop['display_style'] == 'carousel_list' ) {
			$class = "home-products-carousel-enable owl-carousel list";
		}
	}

	if ( isset( $woocommerce_loop['row_enable'] ) ) {
		if ( $woocommerce_loop['row_enable'] == true ) {
			$class .= " row_enable";
		}
	}

	if ( isset( $woocommerce_loop['navigation_style'] ) ) {
		if ( $woocommerce_loop['navigation_style'] )
			$class .= " " . $woocommerce_loop['navigation_style'];
	}

	if ( isset( $woocommerce_loop['columns'] ) ) {
		if ( $woocommerce_loop['columns'] ) {
			$column_count = $woocommerce_loop['columns'];
		} else {
			$column_count = 4;
		}
	}
?>
<ul class="products product-display-custom <?php echo $class; ?>" data-column="<?php if( isset( $column_count ) ) echo $column_count; ?>">
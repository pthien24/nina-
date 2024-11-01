<?php
/**
 * Loop Add to Cart
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$wishlist = class_exists( 'YITH_WCWL' );

?>
<div class="add-btns-wrap">
	<div class="add-btn">

	<?php

		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'button' ),
				esc_html( $product->add_to_cart_text() )
			),
		$product );

    ?>

        <!-- <div class="email-link">
        	<a target="_blank" class="email-to-friend">
        		<i class="fa fa-envelope"></i>
        	</a>
        </div> -->
	</div>

	<?php 
		if ( $wishlist )
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	?>

</div>

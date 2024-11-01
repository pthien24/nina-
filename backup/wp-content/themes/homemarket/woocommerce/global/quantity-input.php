<?php
/**
 * Product quantity inputs
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="homemarket-quantity-wrapper">
	<div class="quantity homemarket-quantity">
		<span class="qty-down" title="Decrease" data-src="#qs-quantity">
			<i class="fa fa-minus"></i>
		</span>
		<input type="text" id="qs-quantity" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( $max_value ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'homemarket' ) ?>" class="input-text qty text" size="5" pattern="<?php echo esc_attr( $pattern ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" />
		<span class="qty-up" title="Increase" data-src="#qs-quantity">
			<i class="fa fa-plus"></i>
		</span>
	</div>
</div>
<div style="clear: both;"></div>

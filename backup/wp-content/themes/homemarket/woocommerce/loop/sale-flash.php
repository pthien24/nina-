<?php
/**
 * Product loop sale flash
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$product_id = $product->get_id();

$_product = wc_get_product( $product_id );

$regular_price = $_product->get_regular_price();
$sale_price = $_product->get_sale_price();
$price = $_product->get_price();

if ( !empty($sale_price) || !empty($regular_price) ) {
	$sale_percent = 100 - $sale_price / $regular_price * 100;
}

?>
<?php if ( $product->is_on_sale() ) : ?>

	<span class="onsale">
		<?php 
			if ( empty($sale_percent) ) {
				_e( 'Sale!', 'homemarket' );
			} else {
				echo (intval( $sale_percent ));?>%<?php 
			}
		?>
	</span>
	<?php // echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'homemarket' ) . '</span>', $post, $product ); ?>

<?php endif; ?>

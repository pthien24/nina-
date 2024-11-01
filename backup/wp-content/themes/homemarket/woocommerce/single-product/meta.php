<?php
/**
 * Single Product Meta
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$brand_count = sizeof( get_the_terms( $post->ID, 'brand_taxonomy' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'homemarket' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'homemarket' ); ?></span></span>

	<?php endif; ?>
	
	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in category">' . _n( 'Category:', 'Categories:', $cat_count, 'homemarket' ) . ' ', '</div>' ); ?>

	<?php 
		echo get_the_term_list( $post->id, 'brand_taxonomy', '<div class="posted_in brand">' . _n( 'Brand:', 'Brands:', $brand_count, 'homemarket' ) . ' ', ', ', '</div>' );
	?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'homemarket' ) . ' ', '</div>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>

<?php
/**
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li class="product">
	<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<div class="product-image">
			<?php echo $product->get_image(); ?>
		</div>
		<div class="product-info">
			<?php if ( ! empty( $show_rating ) ) : ?>
				<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
			<?php endif; ?>
			<h3 class="product-title"><?php echo $product->get_title(); ?></h3>
			<?php echo $product->get_price_html(); ?>
		</div>
	</a>
</li>

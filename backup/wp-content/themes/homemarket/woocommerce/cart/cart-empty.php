<?php
/**
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $homemarket_theme_options;

wc_print_notices();

?>

<div class="shopping-cart-page">
	<div id="breadcrumb-wrapper">
		<?php 
			if ( (isset($homemarket_theme_options['show_breadcrumbs'])) && ($homemarket_theme_options['show_breadcrumbs'] == "1" ) ) {
				do_action( 'woocommerce_breadcrumb_init' ); 
			}
		?>
		<?php 
			if ( (isset($homemarket_theme_options['show_page_title'])) && ($homemarket_theme_options['show_page_title'] == "1" ) ):
				if ( apply_filters( 'woocommerce_show_page_title', true ) ) : 
		?>
			<h1 class="page-title"><?php wp_title('', true, ''); ?></h1>
		<?php 
				endif;
			endif; 
		?>
	</div>

	<?php do_action( 'woocommerce_cart_is_empty' ); ?>

	<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
		<p class="return-to-shop">
			<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php _e( 'Return To Shop', 'homemarket' ) ?>
			</a>
		</p>
	<?php endif; ?>
</div>


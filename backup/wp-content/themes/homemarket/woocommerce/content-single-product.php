<?php
/**
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $homemarket_theme_options, $product;
$page_layout = '';

if ( isset($homemarket_theme_options['single_product_page_layout']) ) :

	if ( $homemarket_theme_options['single_product_page_layout'] == '1' ):
		$page_layout = 'full-page';
	elseif ( $homemarket_theme_options['single_product_page_layout'] == '2' ):
		$page_layout = 'right-page';
	elseif ( $homemarket_theme_options['single_product_page_layout'] == '3' ):
		$page_layout = 'left-page';
	endif;

endif;

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wrapper">
		<div class="product-review-part <?php echo $page_layout; ?>">
			<div id="product-detail-content">
				<div class="grid__item one-half summary-before">
					<?php
						/**
						 * woocommerce_before_single_product_summary hook.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>

				<div class="grid__item one-half summary entry-summary">

					<?php
						/**
						 * woocommerce_single_product_summary hook.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
						do_action( 'homemarket_single_product_share' );
					?>

				</div><!-- .summary -->
			</div>

			<?php
				/**
				 * homemarket_product_sidebar hook.
				 *
				 * @hooked homemarket_product_get_sidebar - 10
				 */
				if ( $homemarket_theme_options['single_product_page_layout'] == '2' || $homemarket_theme_options['single_product_page_layout'] == '3' ) {
					do_action( 'homemarket_product_sidebar' );
				} 
			?>
		</div>

		<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>

		<meta itemprop="url" content="<?php the_permalink(); ?>" />
	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

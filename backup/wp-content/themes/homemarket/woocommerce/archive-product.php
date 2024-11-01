<?php
/**
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 

global $homemarket_theme_options, $woocommerce_loop;

$woocommerce_loop['carousel'] = false;
$page_layout = '';

if ( isset($homemarket_theme_options['page_layout']) ) :

	if ( $homemarket_theme_options['page_layout'] == '1' ):
		$page_layout = 'full-page';
	elseif ( $homemarket_theme_options['page_layout'] == '2' ):
		$page_layout = 'left-page';
	elseif ( $homemarket_theme_options['page_layout'] == '3' ):
		$page_layout = 'right-page';
	endif;

endif;

?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
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
				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
			<?php 
					endif;
				endif; 
			?>

		</div>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<div id="collection" class="wrapper <?php echo $page_layout; ?>">
				<div class="products-content">
					<div class="shop-loop-before">
						<?php
							/**
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>
						<div class="sort-view">
							<?php
								/**
								 * woocommerce_before_shop_loop hook.
								 *
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>
					</div>

					<div class="archive-products">
						<?php woocommerce_product_loop_start(); ?>

							<?php woocommerce_product_subcategories(); ?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>	
					</div>

					<div class="shop-loop-after">
						<?php
							do_action( 'woocommerce_after_shop_loop' );
						?>
					</div>
				</div>

				<div class="sidebar-content">
					<?php
						/**
						 * woocommerce_sidebar hook.
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						if ( $homemarket_theme_options['page_layout'] == '2' || $homemarket_theme_options['page_layout'] == '3' ) {
							do_action( 'woocommerce_sidebar' );
						}
					?>
				</div>

				<div class="mobile-sidebar">
					<div class="sidebar-toggle">
						<i class="fa sidebar-mobile-icon"></i>
					</div>
				</div>
			</div>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>

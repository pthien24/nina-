<?php

global $homemarket_theme_options;
?>

<footer id="site-footer">
	<div class="footer-content">

		<div id="footer-top">
			<div class="wrapper">
				<?php 
					if ( is_active_sidebar( 'footer-top-widget' ) ) {
						dynamic_sidebar( 'footer-top-widget' ); 
					}
				?>
			</div>
		</div>

		<div id="footer-main">
			<div class="wrapper">
				<?php
				for ( $i = 1; $i <= 4; $i++ ) {
					?>
					<div class="grid__item one-quarter">
						<?php 
							if ( is_active_sidebar( 'footer-column-' . $i ) ) {		
								 dynamic_sidebar( 'footer-column-'. $i ); 
							}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div id="footer-bottom">
			<div class="wrapper">
				<div class="grid__item one-half">
					<?php if ( isset($homemarket_theme_options['copyright']) && ($homemarket_theme_options['copyright'] != "") ): ?>
						<p><?php echo esc_html($homemarket_theme_options['copyright']); ?></p>
					<?php endif; ?>
				</div>
				<div class="grid__item one-half">
					<?php if ( $homemarket_theme_options['payments_image'] && $homemarket_theme_options['payments_image']['url'] ) :?>
						<?php if ( $homemarket_theme_options['payments_link_url'] ) : ?>
							<a href="<?php echo esc_url( $homemarket_theme_options['payments_link_url'] ) ?>">
						<?php endif; ?>
							<img class="responsive-img" src="<?php echo esc_url(str_replace( array( 'http:', 'https:' ), '', $homemarket_theme_options['payments_image']['url'])) ?>" alt="<?php __('Payment Image', 'homemarket'); ?>">
						<?php if ( $homemarket_theme_options['payments_link_url'] ) : ?>
							</a>
						<?php endif; ?>							
					<?php endif; ?>
				</div>
				<?php 
				if ( is_active_sidebar( 'footer-bottom-widget' ) ) {
					dynamic_sidebar( 'footer-bottom-widget' ); 
				}
				?>
			</div>
		</div>

	</div>
</footer>
		</div> <!-- PageContainer end -->
	</div>	<!-- ht-content end -->
</div>	<!-- ht-container end -->

<!--************************ Mini Cart ***********************-->
<div class="homemarket-mini-cart">
	<div class="widget_shopping_cart_content">
		<?php 
		if ( class_exists( 'WooCommerce' ) ) { 
			woocommerce_mini_cart(); 
		}
		?>
	</div>
</div>

<!-- Custom Footer Javascript CODE -->

<?php if ( (isset($homemarket_theme_options['footer_js'])) && ($homemarket_theme_options['footer_js'] != "") ) : ?>
	<?php echo $homemarket_theme_options['footer_js']; ?>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
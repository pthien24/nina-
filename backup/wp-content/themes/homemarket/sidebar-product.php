<?php
/**
 * The product sidebar containing the main widget area
*/

if ( ! is_active_sidebar( 'woo-product-sidebar' ) ) {
	return;
}

?>

<div class="product-sidebar-group">
	<?php dynamic_sidebar( 'woo-product-sidebar');  ?>
</div>

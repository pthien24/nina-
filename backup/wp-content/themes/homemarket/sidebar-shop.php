<?php
/**
 * The sidebar containing the main widget area
 * @see 	    https://docs.woocommerce.com/document/template-structure/
*/

if ( ! is_active_sidebar( 'woo-category-sidebar' ) ) {
	return;
}

?>

<div class="sidebar-group">
	<?php dynamic_sidebar( 'woo-category-sidebar');  ?>
</div>

<?php
/**
 * Single Product title
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<h2 itemprop="name" class="product_title entry-title">
    <?php if (homemarket_is_ajax()) : ?>
    <a href="<?php the_permalink(); ?>">
    <?php endif; ?>
    <?php the_title(); ?>
    <?php if (homemarket_is_ajax()) : ?>
    </a>
    <?php endif; ?>
</h2>

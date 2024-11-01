<?php
/*
Template Name: Full Width with Breadcrumb Page template
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_id = "";
if ( is_page() ) {
	$page_id = get_the_ID();
} else if ( is_home() ) {
	$page_id = get_option('page_for_posts');
}

$page_title_option = "on";

if( get_post_meta( $page_id, 'page_title_meta_box_check', true ) ) {
	$page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
}

get_header();
?>

<main class="main-content full-page-content">
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
	<div class="full-page-wrapper">

		<?php if ( isset( $page_title_option ) && ( 'on' == $page_title_option ) ): ?>
			<h1 class="entry-title"><?php the_title(); ?></h1><!-- Page Title -->
		<?php endif; ?>

		<?php
		    // TO SHOW THE PAGE CONTENTS
		    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
		        <div class="entry-content-page">
		            <?php the_content(); ?> <!-- Page Content -->
		        </div><!-- .entry-content-page -->

		    <?php
		    endwhile; //resetting the page loop

		    wp_reset_postdata();
    		comments_template();
	    ?>

	</div>
</main>

<?php get_footer(); ?>
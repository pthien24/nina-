
<?php 

/*
 * The template for displaying all pages
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

<main class="main-content">
	<div class="wrapper">
		
		<?php if ( isset( $page_title_option ) && ( $page_title_option == 'on' ) ): ?>
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
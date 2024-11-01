<?php get_header(); 

$post_page_layout = '';

if ( isset($homemarket_theme_options['post_page_layout']) ) :

	if ( $homemarket_theme_options['post_page_layout'] == '1' ):
		$post_page_layout = 'full-page';
	elseif ( $homemarket_theme_options['post_page_layout'] == '2' ):
		$post_page_layout = 'left-page';
	elseif ( $homemarket_theme_options['post_page_layout'] == '3' ):
		$post_page_layout = 'right-page';
	endif;

endif;
?>

	<main class="single-page main-content">
		<?php if ( !isset($homemarket_theme_options['breadcrumbs_background']) ) { ?>
			<div id="breadcrumb-wrapper" class="breadcrumb-initial">
		<?php } else { ?>
			<div id="breadcrumb-wrapper">
		<?php } ?>
			<?php 
				if ( (isset($homemarket_theme_options['show_breadcrumbs'])) && ($homemarket_theme_options['show_breadcrumbs'] == "1" ) ) {
					do_action( 'woocommerce_breadcrumb_init' ); 
				}
			?>
			<?php 
				if ( (isset($homemarket_theme_options['show_page_title'])) && ($homemarket_theme_options['show_page_title'] == "1" ) ):
					if ( apply_filters( 'woocommerce_show_page_title', true ) ) : 
			?>
				<h1 class="page-title"><?php _e( 'Article page', 'homemarket' );//wp_title('', true, '');  ?></h1>
			<?php 
					endif;
				endif; 
			?>
		</div>
		<div class="wrapper <?php echo $post_page_layout; ?>">
			<div class="post-sidebar">
				<?php 
					if ( $homemarket_theme_options['post_page_layout'] == '1' ) { 
						?><h2><?php 
						_e( 'No Sidebar', 'homemarket' );
						?></h2><?php 
					} else {
						if ( is_active_sidebar( 'post-sidebar' ) ) {
							dynamic_sidebar( 'post-sidebar' ); 
						}
					}
				?>
			</div>

			<div id="content">
				<div class="post-content">
					<?php
						if ( have_posts() ) {
							the_post();

							get_template_part( 'content', 'post' );
						}
					?>
				</div>
			</div>

			<div class="mobile-sidebar">
				<div class="sidebar-toggle">
					<i class="fa sidebar-mobile-icon"></i>
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
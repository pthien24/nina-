<?php
	global $homemarket_theme_options, $woocommerce;
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="supports-fontface">

<head>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />

	<!-- Custom Header Javascript CODE -->

	<?php
		if ( (isset($homemarket_theme_options['header_js'])) && ($homemarket_theme_options['header_js'] != "") ):
			echo $homemarket_theme_options['header_js'];
		endif;
	?>

	<!-- Wordpress wp_head() -->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php if ( 'enable' == $homemarket_theme_options['page_pre_load'] ) { ?>
		<div id="introLoader" class="introLoading introLoader gifLoader"><div id="introLoaderSpinner" class="gifLoaderInner"></div></div>
	<?php } ?>
	
	<div id="ht-container" class="ht-container">
		<div class="ht-content">
			
			<div id="NavDrawer" class="drawer drawer--left">
				<div class="mobile-nav-header">
					<h3><?php _e( 'Browse', 'homemarket' ) ?></h3>
					<div class="mobile-nav-close"><span class="icon"></span></div>
				</div>
				<?php
					$walker = new rc_scm_walker;
					wp_nav_menu(array(
	                    'theme_location'  => 'main-navigation',
	                    'fallback_cb'     => false,
	                    'container'       => false,
	                    'items_wrap'      => '<ul class="%1$s site-nav">%3$s</ul>',
						'walker'          => $walker
	                ));
				?>
			</div>

			<div id="PageContainer" class="is-moved-by-drawer">
				<div class="headers-wrapper">
					
					<?php if ( (isset($homemarket_theme_options['top_bar_switch'])) && ($homemarket_theme_options['top_bar_switch']) == '1' ): ?>
						<?php include( get_parent_theme_file_path('inc/header/header-topbar.php') ); ?>
					<?php endif; ?>

					<?php if ( isset($homemarket_theme_options['header_main_layout']) ): ?>

						<?php if ( $homemarket_theme_options['header_main_layout'] == '1' ): ?>
							<?php include( get_parent_theme_file_path( 'inc/header/header-normal.php' ) ); ?>
						<?php elseif ( $homemarket_theme_options['header_main_layout'] == '2' ): ?>
							<?php include( get_parent_theme_file_path( 'inc/header/header-center.php' ) ); ?>
						<?php elseif ( $homemarket_theme_options['header_main_layout'] == '3' ): ?>
							<?php include( get_parent_theme_file_path( 'inc/header/header-rightbox.php' ) ); ?>
						<?php endif; ?>
						
					<?php else: ?>		

						<?php include( get_parent_theme_file_path( 'inc/header/header-normal.php' ) ); ?>

					<?php endif; ?>

				</div>

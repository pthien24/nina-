<header id="normal-header" class="site-header">

	<div class="wrapper">

		<div id="main-header" class="grid--full grid--table">

			<div class="grid__item small--one-whole medium--one-whole two-eighths">

			<?php
				if ( (isset($homemarket_theme_options['site_logo']['url'])) && (trim($homemarket_theme_options['site_logo']['url']) != "") ) {
					if(is_ssl()) {
						$logo_url = str_replace("http://", "https://", $homemarket_theme_options['site_logo']['url']);
					} else {
						$logo_url = $homemarket_theme_options['site_logo']['url'];
					}
			?>

				<div class="site-header__logo large--left" rel="home" itemscope="" itemtype="http://schema.org/Organization">
					<a href="<?php echo esc_url(home_url( '/' )); ?>" itemprop="url" class="site-header__logo-link">
						<img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" itemprop="logo">
					</a>
				</div>

			<?php } else { ?>
				<h3 class="site-header-title">
					<a href="<?php echo esc_url(home_url( '/' )); ?>" rel="home">
						<?php bloginfo('name'); ?>
					</a>
				</h3>
			<?php } ?>

			</div>

			<div class="grid__item small--one-whole medium--one-whole four-eighths mobile-bottom">
				<div class="large--hide medium-down--show navigation-icon">
					<div class="grid">
						<div class="grid__item one-half">
							<div class="site-nav--mobile">
								<div id="nav-mobile-icon">
								  <span></span>
								  <span></span>
								  <span></span>
								  <span></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="site-header__search">
					<?php
					// $wc_get_template = function_exists('wc_get_template') ? 'wc_get_template' : 'woocommerce_get_template';
        			// $wc_get_template( 'yith-woocommerce-ajax-search.php', array(), '', YITH_WCAS_DIR . 'templates/' );
					?>
					<form action="<?php echo esc_url( home_url('/') ); ?>/" method="get" class="input-group search-bar">
					
						<?php if ( (isset($homemarket_theme_options['main_header_collection_select'])) && ($homemarket_theme_options['main_header_collection_select'] == "1" ) ): ?>

							<div class="collections-selector">
							<?php
								$args = array(
			                        'show_option_all' => __( 'All Categories', 'homemarket' ),
			                        'hierarchical' => 1,
			                        'class' => 'cat',
			                        'echo' => 1,
			                        'value_field' => 'slug',
			                        'selected' => 1,
			                        'taxonomy' => 'product_cat',
			                        'name' => 'product_cat'
			                    );
			                    wp_dropdown_categories($args);
							?>
							</div>

						<?php endif; ?>

						<?php if ( (isset($homemarket_theme_options['main_header_search_bar'])) && ($homemarket_theme_options['main_header_search_bar'] == "1" ) ): ?>
							<input name="s" id="s" class="input-group-field st-default-search-input" type="text" value="<?php echo get_search_query() ?>" placeholder="<?php echo __('Search our store', 'homemarket'); ?>" autocomplete="off" />
							<input type="hidden" name="post_type" value="product">
							<span class="input-group-btn">
								<button type="submit" class="btn icon-fallback-text">
									<i class="fa fa-search"></i>
								</button>
							</span>

						<?php endif; ?>
					
					</form>
				</div>
				<div class="large--hide medium-down--show navigation-cart">
					<div class="text-right">
						<?php if (class_exists('YITH_WCWL')) : ?>
							<?php if ( (isset($homemarket_theme_options['main_header_shopping_cart'])) && ($homemarket_theme_options['main_header_shopping_cart'] == "1" ) ): ?>

								<div class="site-nav--mobile">
									<div class="header-cart">
										<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="site-header__cart-toggle js-drawer-open-right">
											<?php if ( (isset($homemarket_theme_options['main_header_shopping_cart_icon']['url'])) && ($homemarket_theme_options['main_header_shopping_cart_icon']['url'] != "" ) ): ?>
												<img src="<?php echo esc_url($homemarket_theme_options['main_header_shopping_cart_icon']['url']); ?>">
											<?php else: ?>
												<i class="fa fa-shopping-basket"></i>
											<?php endif; ?>

											<?php //homemarket_woocommerce_header_add_to_cart_fragment(); ?>
											<?php WC()->cart->get_cart_contents_count(); ?>
										</a>
									</div>
								</div>

							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="grid__item small--one-whole two-eighths medium-down--hide">
				<ul class="link-list">

					<?php if ( (isset($homemarket_theme_options['main_header_store_location'])) && ($homemarket_theme_options['main_header_store_location'] == "1" ) ): ?>
					
						<li class="track-order">
							<?php if ( (isset($homemarket_theme_options['main_header_store_location_url'])) && ($homemarket_theme_options['main_header_store_location_url'] ) ): ?>
							<a href="<?php echo esc_url($homemarket_theme_options['main_header_store_location_url']); ?>">
							<?php else: ?>
							<a href="#">
							<?php endif; ?>
								<?php if ( (isset($homemarket_theme_options['main_header_store_location_icon']['url'])) && ($homemarket_theme_options['main_header_store_location_icon']['url'] != "" ) ): ?>
									<img src="<?php echo esc_url($homemarket_theme_options['main_header_store_location_icon']['url']); ?>">
								<?php else: ?>
									<i class="fa fa-map-marker"></i>
									<span class="name"><?php _e('Store Location', 'homemarket'); ?></span>
								<?php endif; ?>
							</a>
						</li>

					<?php endif; ?>

					<?php if ( (isset($homemarket_theme_options['main_header_account'])) && ($homemarket_theme_options['main_header_account'] == "1" ) ): ?>
					
						<li class="header-account">

							 <?php if ( is_user_logged_in() ) { ?>
							 	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" id="login_link" title="<?php _e('My Account','homemarket'); ?>">
							 		<?php if ( (isset($homemarket_theme_options['main_header_account_icon']['url'])) && ($homemarket_theme_options['main_header_account_icon']['url'] != "" ) ): ?>
										<img src="<?php echo esc_url($homemarket_theme_options['main_header_account_icon']['url']); ?>">
									<?php else: ?>
										<i class="fa fa-user"></i>
										<span class="name"><?php _e('My Account','homemarket'); ?></span>
									<?php endif; ?>
								</a>
							 <?php } 

							 else { ?>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" id="login_link" title="<?php _e('Login / Register','homemarket'); ?>">
							 		<?php if ( (isset($homemarket_theme_options['main_header_account_icon']['url'])) && ($homemarket_theme_options['main_header_account_icon']['url'] != "" ) ): ?>
										<img src="<?php echo esc_url($homemarket_theme_options['main_header_account_icon']['url']); ?>">
									<?php else: ?>
										<i class="fa fa-user"></i>
										<span class="name"><?php _e('Login / Register','homemarket'); ?></span>
									<?php endif; ?>
								</a>
							<?php } ?>

						</li>

					<?php endif; ?> 

					<?php if (class_exists('YITH_WCWL')) : ?>
						<?php if ( (isset($homemarket_theme_options['main_header_shopping_cart'])) && ($homemarket_theme_options['main_header_shopping_cart'] == "1" ) ): ?>

							<li class="header-cart">
								<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="site-header__cart-toggle js-drawer-open-right">
									<?php if ( (isset($homemarket_theme_options['main_header_shopping_cart_icon']['url'])) && ($homemarket_theme_options['main_header_shopping_cart_icon']['url'] != "" ) ): ?>
										<img src="<?php echo esc_url($homemarket_theme_options['main_header_shopping_cart_icon']['url']); ?>">
									<?php else: ?>
										<i class="fa fa-shopping-basket"></i>
										<span class="name">Shopping Cart</span>
									<?php endif; ?>

									<span id="CartCount"><?php echo sprintf('%d', WC()->cart->cart_contents_count); ?></span>
								</a>
							</li>

						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</div>

		</div>       

	</div>

</header>

<!-- Navigation Bar -->
<nav class="nav-bar" role="navigation">
	<div class="wrapper">
		<div class="medium-down--hide">
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
	</div>
</nav>
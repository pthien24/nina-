<?php

	// Get Theme name
	if ( ! function_exists( 'homemarket_parent_theme_name' ) ):
		function homemarket_parent_theme_name() {

			$homemarket_theme = wp_get_theme();
			if ($homemarket_theme->parent()):
				$theme_name = $homemarket_theme->parent()->get('Name');
			else:
				$theme_name = $homemarket_theme->get('Name');
			endif;

			return $theme_name;

		}
	endif;

	// Get Theme Version
	if ( ! function_exists( 'homemarket_theme_version' ) ):
		function homemarket_theme_version() {
			$homemarket_theme = wp_get_theme(get_template());
			
			return $homemarket_theme->get('Version');
		}
	endif;
?>
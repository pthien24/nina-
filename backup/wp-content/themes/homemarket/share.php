<?php

/*
 * Single Product Share Links
 */

global $homemarket_theme_options;

?>

<div class="share-links">

	<?php
	if ( isset ($homemarket_theme_options['facebook_link']) ) $facebook = $homemarket_theme_options['facebook_link'];
    if ( isset ($homemarket_theme_options['pinterest_link']) ) $pinterest = $homemarket_theme_options['pinterest_link'];
    if ( isset ($homemarket_theme_options['linkedin_link']) ) $linkedin = $homemarket_theme_options['linkedin_link'];
    if ( isset ($homemarket_theme_options['twitter_link']) ) $twitter = $homemarket_theme_options['twitter_link'];
    if ( isset ($homemarket_theme_options['googleplus_link']) ) $googleplus = $homemarket_theme_options['googleplus_link'];
    if ( isset ($homemarket_theme_options['rss_link']) ) $rss = $homemarket_theme_options['rss_link'];
    if ( isset ($homemarket_theme_options['tumblr_link']) ) $tumblr = $homemarket_theme_options['tumblr_link'];
    if ( isset ($homemarket_theme_options['instagram_link']) ) $instagram = $homemarket_theme_options['instagram_link'];
    if ( isset ($homemarket_theme_options['youtube_link']) ) $youtube = $homemarket_theme_options['youtube_link'];
    if ( isset ($homemarket_theme_options['vimeo_link']) ) $vimeo = $homemarket_theme_options['vimeo_link'];
    if ( isset ($homemarket_theme_options['behance_link']) ) $behance = $homemarket_theme_options['behance_link'];
    if ( isset ($homemarket_theme_options['dribble_link']) ) $dribble = $homemarket_theme_options['dribble_link'];
    if ( isset ($homemarket_theme_options['flickr_link']) ) $flickr = $homemarket_theme_options['flickr_link'];
    if ( isset ($homemarket_theme_options['git_link']) ) $git = $homemarket_theme_options['git_link'];
    if ( isset ($homemarket_theme_options['skype_link']) ) $skype = $homemarket_theme_options['skype_link'];
    if ( isset ($homemarket_theme_options['weibo_link']) ) $weibo = $homemarket_theme_options['weibo_link'];
    if ( isset ($homemarket_theme_options['foursquare_link']) ) $foursquare = $homemarket_theme_options['foursquare_link'];
    if ( isset ($homemarket_theme_options['soundcloud_link']) ) $soundcloud = $homemarket_theme_options['soundcloud_link'];
    if ( isset ($homemarket_theme_options['vk_link']) ) $vk = $homemarket_theme_options['vk_link'];

    if ( $facebook ) echo('<a href="' . esc_attr($facebook) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a> ' );
    
    if ( $twitter ) echo('<a href="' . esc_attr($twitter) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a> ' );

    if ( $googleplus ) echo('<a href="' . esc_attr($googleplus) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a> ' );

    if ( $pinterest ) echo('<a href="' . esc_attr($pinterest) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-pinterest"></i></a> ' );

    if ( $linkedin ) echo('<a href="' . esc_attr($linkedin) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a> ' );

    if ( $rss ) echo('<a href="' . esc_attr($rss) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-rss"></i></a> ' );

    if ( $tumblr ) echo('<a href="' . esc_attr($tumblr) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-tumblr"></i></a> ' );

    if ( $instagram ) echo('<a href="' . esc_attr($instagram) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-instagram"></i></a> ' );

    if ( $youtube ) echo('<a href="' . esc_attr($youtube) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-youtube"></i></a> ' );

    if ( $vimeo ) echo('<a href="' . esc_attr($vimeo) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-vimeo"></i></a> ' );

    if ( $behance ) echo('<a href="' . esc_attr($behance) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-behance"></i></a> ' );

    if ( $dribble ) echo('<a href="' . esc_attr($dribble) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-dribbble"></i></a> ' );

    if ( $flickr ) echo('<a href="' . esc_attr($flickr) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-flickr"></i></a> ' );

    if ( $git ) echo('<a href="' . esc_attr($git) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-git"></i></a> ' );

    if ( $skype ) echo('<a href="' . esc_attr($skype) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-skype"></i></a> ' );

    if ( $weibo ) echo('<a href="' . esc_attr($weibo) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-weibo"></i></a> ' );

    if ( $foursquare ) echo('<a href="' . esc_attr($foursquare) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-foursquare"></i></a> ' );

    if ( $soundcloud ) echo('<a href="' . esc_attr($soundcloud) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-soundcloud"></i></a> ' );

    if ( $vk ) echo('<a href="' . esc_attr($vk) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-vk"></i></a> ' );
	?>

</div>


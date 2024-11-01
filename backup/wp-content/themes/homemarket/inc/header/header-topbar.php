<?php
	global $homemarket_theme_options;
?>

<div id="top-header" class="grid--full grid--table">

	<div class="wrapper">

		<div id="topother-header" class="grid--full grid--table">
			
			<div class="grid__item one-half top-header-left">
				
			<?php
				if ( isset($homemarket_theme_options['top_bar_text']) )
					esc_html_e( $homemarket_theme_options['top_bar_text'], 'homemarket' );
			?>

			</div>

			<div class="grid__item one-half top-header-right">

				<!-- <?php if ( (isset($homemarket_theme_options['top_bar_currency_unit']))  && ($homemarket_theme_options['top_bar_currency_unit'] == '1') ): ?>

				<div class="currency-picker">
					<label class="currency-picker__wrapper">
					<span class="currency-picker__label">Currency</span>
					<select class="currency-picker" name="currencies" style="display: inline; width: auto; vertical-align: inherit;">
						<option value="USD" selected="selected">USD</option>
						<option value="INR">INR</option>
						<option value="GBP">GBP</option>
						<option value="CAD">CAD</option>
						<option value="AUD">AUD</option>
						<option value="EUR">EUR</option>
						<option value="JPY">JPY</option>
					</select>
					</label>
				</div>

				<?php endif; ?>
 -->
				<?php if ( (isset($homemarket_theme_options['top_bar_social_icons']))  && ($homemarket_theme_options['top_bar_social_icons'] == '1') ): ?>
				<div class="fi-content inline-list social-icons">

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

                        if ( $twitter ) echo('<a href="' . esc_url($twitter) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-twitter-square"></i></a> ' );

                        if ( $facebook ) echo('<a href="' . esc_url($facebook) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-facebook-square"></i></a> ' );

                        if ( $googleplus ) echo('<a href="' . esc_url($googleplus) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-google-plus-square"></i></a> ' );

                        if ( $pinterest ) echo('<a href="' . esc_url($pinterest) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-pinterest-square"></i></a> ' );

                        if ( $linkedin ) echo('<a href="' . esc_url($linkedin) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-linkedin-square"></i></a> ' );

                        if ( $rss ) echo('<a href="' . esc_url($rss) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-rss-square"></i></a> ' );

                        if ( $tumblr ) echo('<a href="' . esc_url($tumblr) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-tumblr-square"></i></a> ' );

                        if ( $instagram ) echo('<a href="' . esc_url($instagram) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-instagram"></i></a> ' );

                        if ( $youtube ) echo('<a href="' . esc_url($youtube) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-youtube-square"></i></a> ' );

                        if ( $vimeo ) echo('<a href="' . esc_url($vimeo) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-vimeo-square"></i></a> ' );

                        if ( $behance ) echo('<a href="' . esc_url($behance) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-behance-square"></i></a> ' );

                        if ( $dribble ) echo('<a href="' . esc_url($dribble) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-dribbble-square"></i></a> ' );

                        if ( $flickr ) echo('<a href="' . esc_url($flickr) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-flickr-square"></i></a> ' );

                        if ( $git ) echo('<a href="' . esc_url($git) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-git-square"></i></a> ' );

                        if ( $skype ) echo('<a href="' . esc_url($skype) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-skype-square"></i></a> ' );

                        if ( $weibo ) echo('<a href="' . esc_url($weibo) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-weibo-square"></i></a> ' );

                        if ( $foursquare ) echo('<a href="' . esc_url($foursquare) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-foursquare"></i></a> ' );

                        if ( $soundcloud ) echo('<a href="' . esc_url( $soundcloud ) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-soundcloud-square"></i></a> ' );

                        if ( $vk ) echo('<a href="' . esc_url($vk) . '" target="_blank" class="icon-social" data-toggle="tooltip" data-placement="top"><i class="fa fa-vk-square"></i></a> ' );
                    ?>
				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>
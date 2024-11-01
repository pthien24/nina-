<?php
	global $homemarket_theme_options;
?>

<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-image">
		<?php the_post_thumbnail('homemarket-blog'); ?> 
	</div>
	<div class="blog-post-info">
		<h3 class="blog-title"><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
		<div class="blog-date">
			<p><?php _e( 'Posted by', 'homemarket' ) ?><a href="<?php esc_url(the_permalink()); ?>"><span><?php echo get_the_author_meta('display_name'); ?></span></a> <a href="<?php esc_url(the_permalink()); ?>"><?php $post_date = get_the_date(); echo $post_date; ?></a></p>
		</div>
		<div class="blog-content">
			<?php

				if ($homemarket_theme_options['blog_post_excerpt_length']) {
					$summary_limit = $homemarket_theme_options['blog_post_excerpt_length'];
				} else {
					$summary_limit = 36;
				}

				if (has_excerpt()) {
			        $content = get_the_excerpt();
			    } else {
			        $content = get_the_content();
			    }

				$content = explode( ' ', $content, $summary_limit );
				
				if ( count( $content ) >= $summary_limit ) {
					array_pop( $content );
					$content = implode( " ",$content ).'... ';
				} else {
					$content = implode( " ", $content );
				}
			?>
			<p><?php echo $content; ?></p>
		</div>
		<div class="blog-meta">
			<a class="readmore btn" href="<?php echo esc_url( apply_filters( 'the_permalink', get_permalink() ) ) ?>">
				<?php _e('Read More ...', 'homemarket'); ?>
			</a>
		</div>
	</div>
</article>
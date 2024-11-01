<?php
	global $homemarket_theme_options;
?>

<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-header">
		<?php if ( (isset($homemarket_theme_options['title_enable']))  && ($homemarket_theme_options['title_enable'] == '1') ): ?>
			<h3 class="post-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h3>
		<?php endif; ?>

		<div class="post-date">
			<p><?php _e( 'Posted by', 'homemarket' ) ?> <span><?php echo get_the_author_meta('display_name'); ?></span></span> <?php $post_date = get_the_date(); echo $post_date; ?></p>
		</div>
	</div>

	<div class="post-image">
		<?php esc_html( the_post_thumbnail('homemarket-post') ); ?> 
	</div>

	<div class="post-content">
		<?php
	        the_content();
	        wp_link_pages( array(
	            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'homemarket' ) . '</span>',
	            'after'       => '</div>',
	            'link_before' => '<span>',
	            'link_after'  => '</span>',
	            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'homemarket' ) . ' </span>%',
	            'separator'   => '<span class="screen-reader-text">, </span>',
	        ) );
        ?>
	</div>

	<?php if ( (isset($homemarket_theme_options['social_links_enable']))  && ($homemarket_theme_options['social_links_enable'] == '1') ): ?>
		<div class="post-block post-share-links">
			<h4><i class="fa fa-share"></i><?php _e( 'Share This Post', 'homemarket' ); ?></h4>
			<?php get_template_part('share'); ?>
		</div>
	<?php endif; ?>

	<?php if ( (isset($homemarket_theme_options['author_enable']))  && ($homemarket_theme_options['author_enable'] == '1') ): ?>
		<div class="post-block post-author clearfix">
			<h3><i class="fa fa-user"></i><?php _e('Author', 'homemarket'); ?></h3>
			<div class="img-thumbnail">
	            <?php echo get_avatar(get_the_author_meta('email'), '80'); ?>
	        </div>
	        <p><strong class="author-name"><?php the_author_posts_link(); ?></strong></p>
	        <p><?php the_author_meta("description"); ?></p>
		</div>
	<?php endif; ?>

	<?php
	if ( (isset($homemarket_theme_options['comments_enable']))  && ($homemarket_theme_options['comments_enable'] == '1') ) {
		wp_reset_postdata();
    	comments_template();
	}
    ?>
	<div class="blog-meta">
		
	</div>
</article>
<?php
global $homemarket_theme_options;

?>
<div class="post-item-small">
    <a href="<?php esc_url( the_permalink() ); ?>"><?php the_title() ?></a>
    <p class="post-date"><?php $post_date = get_the_date(); echo $post_date; ?></p>
    <div class="post-author"><?php echo __('by', 'homemarket'); ?> <span><?php echo get_the_author_meta('display_name'); ?></span></div>
</div>
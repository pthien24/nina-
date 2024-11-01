<?php

add_action( 'widgets_init', 'homemarket_recent_posts_load_widgets' );

function homemarket_recent_posts_load_widgets() {
	register_widget( 'Homemarket_Recent_Posts_Widget' );
}

class Homemarket_Recent_Posts_Widget extends WP_Widget {

	public function __construct() {

		$widget_ops = array('classname' => 'recent-posts', 'description' => __('Show recent posts.', 'homemarket'));

        $control_ops = array('id_base' => 'recent_posts-widget');

        parent::__construct('recent_posts-widget', __('Homemarket: Recent Posts', 'homemarket'), $widget_ops, $control_ops);

	}

	function widget( $args, $instance ) {
		extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $items = $instance['items'];
        $cat = $instance['cat'];
        $hide_post_date = $instance['hide_post_date'];
        $hide_post_author = $instance['hide_post_author'];

        $hide_post_date_class = '';
        $hide_post_author_class = '';


        if ($items == 0)
            $items = 3;

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $number-1
        );

        if ($cat)
            $args['cat'] = $cat;

        if ($hide_post_date) 
            $hide_post_date_class = 'hide-post-date';

        if ($hide_post_author) 
            $hide_post_author_class = 'hide-post-author';

        $posts = new WP_Query($args);

        if ($posts->have_posts()) :

            echo $before_widget;

            if ($title) {
                echo $before_title . $title . $after_title;
            }

            ?>
            <div class="row">
                <div <?php if ($number > $items) : ?> class="post-carousel homemarket-carousel owl-carousel show-nav-title" <?php endif; ?>>
                    <?php
                    $count = 0;
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        global $previousday;
                        unset($previousday);

                        if ($count % $items == 0) echo '<div class="post-slide ' .$hide_post_date_class. ' ' .$hide_post_author_class. '">';

                        get_template_part('content', 'post-item');

                        if ( ($count % $items == $items - 1) || ($number == $count + 1) )  echo '</div>';

                        $count++;
                    }
                    ?>
                </div>
            </div>
            <?php

            echo $after_widget;

        endif;
        wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['items'] = $new_instance['items'];
        $instance['cat'] = $new_instance['cat'];
        $instance['hide_post_date'] = $new_instance['hide_post_date'];
        $instance['hide_post_author'] = $new_instance['hide_post_author'];

        return $instance;
    }

    function form( $instance ) {

        $defaults = array('title' => __('RECENT POST', 'homemarket'), 'number' => 2, 'items' => 2, 'view' => 'small', 'cat' => '');
        $instance = wp_parse_args((array) $instance, $defaults); 

        $post_date_value = isset( $instance['hide_post_date'] ) ? 'true' : 'false';
        $post_author_value = isset( $instance['hide_post_author'] ) ? 'true' : 'false';
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <strong><?php _e('Title', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
                <strong><?php _e('Number of posts to show', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php if (isset($instance['number'])) echo esc_attr($instance['number']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('items')); ?>">
                <strong><?php _e('Number of items per slide', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('items')); ?>" name="<?php echo esc_attr($this->get_field_name('items')); ?>" value="<?php if (isset($instance['items'])) echo esc_attr($instance['items']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>">
                <strong><?php _e('Category IDs', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('cat')); ?>" name="<?php echo esc_attr($this->get_field_name('cat')); ?>" value="<?php if (isset($instance['cat'])) echo esc_attr($instance['cat']); ?>" />
            </label>
        </p>
        <p>
            <input id="post_date_enable <?php echo esc_attr($this->get_field_id('hide_post_date')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_post_date')); ?>" type="checkbox" value="true" <?php checked( $post_date_value, 'true' ); ?>>
            <label for="post_date_enable <?php echo esc_attr($this->get_field_id('hide_post_date')); ?>"><?php _e( 'Hide Post Date', 'homemarket' ); ?></label>
        </p>
        <p>
            <input id="post_author_enable <?php echo esc_attr($this->get_field_id('hide_post_author')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_post_author')); ?>" type="checkbox" value="true" <?php checked( $post_author_value, 'true' ); ?>>
            <label for="post_author_enable <?php echo esc_attr($this->get_field_id('hide_post_author')); ?>"><?php _e( 'Hide Post Author', 'homemarket' ); ?></label>
        </p>
    <?php
    }

}

?>
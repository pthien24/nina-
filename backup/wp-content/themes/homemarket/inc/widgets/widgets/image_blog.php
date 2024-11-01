<?php
add_action('widgets_init', 'homemarket_image_blog_load_widgets');

function homemarket_image_blog_load_widgets() {
	register_widget( 'Homemarket_Image_Blog_Widget' );
}

class Homemarket_Image_Blog_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'image-blog', 'description' => __( 'Display image blog in widget area.', 'homemarket' ) );

		$control_ops = array( 'id_base' => 'image-blog-widget' );

		parent::__construct( 'image-blog-widget', __( 'Homemarket: Image Blog', 'homemarket' ), $widget_ops, $control_ops );
	}

	public function widget( $args, $instance ) {
		extract($args);
		$image_url = $instance['url'];

		echo $before_widget;
		?>
		<div class="image-blog">
			 <img src="<?php if (isset($instance['url'])) echo esc_url($instance['url']);  ?>" />
		</div>
		<?php

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['url'] = $new_instance['url'];

		return $instance;
	}

	public function form( $instance ) {
		$defaults = array('url' => 'http://wp.homemarket.com/wp-content/uploads/2017/02/sb-banner.png');
		$instance = wp_parse_args((array) $instance, $defaults);
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('url')); ?>">
                <strong><?php echo __('Image URL', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" value="<?php if (isset($instance['url'])) echo esc_attr($instance['url']); ?>" />
            </label>
		</p>

		<?php
	}

}
?>
<?php
add_action('widgets_init', 'homemarket_product_extrainfo_load_widgets');

function homemarket_product_extrainfo_load_widgets() {
	register_widget( 'Homemarket_Product_Extrainfo_Widget' );
}

class Homemarket_Product_Extrainfo_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'product-extrainfo', 'description' => __( 'Add product extra info in sidebar', 'homemarket' ) );

		$control_ops = array( 'id_base' => 'product-extrainfo-widget' );

		parent::__construct( 'product-extrainfo-widget', __( 'Homemarket: Product ExtraInfo', 'homemarket' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$icon = $instance['icon'];
		$extrainfo_header = $instance['extrainfo_header'];
		$extrainfo_description = $instance['extrainfo_description'];

		//var_dump($icon); exit();

		echo $before_widget;

		if ( $title ) {
        	echo $before_title . $title . $after_title;
        }
        ?>
        <div class="product-extrainfo">
        	<div class="extrainfo-icon-left">
        		<?php if ( $icon ): ?>
        			<i class="fa <?php echo esc_attr($icon); ?>"></i>
        		<?php endif; ?>
        	</div>

        	<div class="extrainfo-detail">
        		<div class="extrainfo-header">
        			<?php if ( $extrainfo_header ): ?>
        				<h3><?php echo esc_html($extrainfo_header); ?></h3>
        			<?php endif; ?>
        		</div>
        		<div class="extrainfo-description">
        			<?php if ( $extrainfo_description ): ?>
        				<p><?php echo esc_html($extrainfo_description); ?></p>
        			<?php endif; ?>
        		</div>
        	</div>
        </div>

        <?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['icon'] = $new_instance['icon'];
		$instance['extrainfo_header'] = $new_instance['extrainfo_header'];
		$instance['extrainfo_description'] = $new_instance['extrainfo_description'];

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', 'icon' => 'fa-shield', 'extrainfo_header' => __('Guarantee', 'homemarket'), 'extrainfo_description' => __('Quality Checked', 'homemarket') );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
				<strong><?php echo __('Title', 'homemarket') ?>:</strong>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>">
				<strong><?php echo __('Icon', 'homemarket') ?>:</strong>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('icon')); ?>" name="<?php echo esc_attr($this->get_field_name('icon')); ?>" value="<?php if (isset($instance['icon'])) echo esc_attr($instance['icon']); ?>" />
				<label><?php echo __('Font Awesome icon code (EX:fa-circle)', 'homemarket') ?></label>
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('extrainfo_header')); ?>">
				<strong><?php echo __('ExtraInfo Header', 'homemarket') ?>:</strong>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('extrainfo_header')); ?>" name="<?php echo esc_attr($this->get_field_name('extrainfo_header')); ?>" value="<?php if (isset($instance['extrainfo_header'])) echo esc_attr($instance['extrainfo_header']); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('extrainfo_description')); ?>">
				<strong><?php echo __('ExtraInfo Description', 'homemarket') ?>:</strong>
				<textarea type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('extrainfo_description')); ?>" name="<?php echo esc_attr($this->get_field_name('extrainfo_description')); ?>" value="<?php if (isset($instance['extrainfo_description'])) echo esc_attr($instance['extrainfo_description']); ?>"><?php if (isset($instance['extrainfo_description'])) echo esc_html($instance['extrainfo_description']); ?></textarea>
			</label>
		</p>
		<?php
	}

}
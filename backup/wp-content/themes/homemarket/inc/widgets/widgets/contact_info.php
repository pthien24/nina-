<?php
add_action('widgets_init', 'homemarket_contact_info_load_widgets');

function homemarket_contact_info_load_widgets() {
	register_widget( 'Homemarket_Contact_Info_Widget' );
}

class Homemarket_Contact_Info_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'contact-info', 'description' => __( 'Add contact information.', 'homemarket' ) );

		$control_ops = array( 'id_base' => 'contact-info-widget' );

		parent::__construct( 'contact-info-widget', __( 'Homemarket: Contact Info', 'homemarket' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
        $contact_before = $instance['contact_before'];
        $address = $instance['address'];
        $phone = $instance['phone'];
        $email = $instance['email'];
        $contact_after = $instance['contact_after'];

        echo $before_widget;

        if ( $title ) {
        	echo $before_title . $title . $after_title;
        }
        ?>
        <div class="contact-info">
            <?php if ($contact_before) : ?><?php echo wpautop(do_shortcode($contact_before)) ?><?php endif; ?>
            <ul class="contact-details">
                <?php if ($address) : ?>
                	<li>
                		<i class="fa fa-map-marker"></i>
                		<span><?php echo esc_html( force_balance_tags($address) ); ?></span>
                	</li>
                <?php endif; ?>
                <?php if ($phone) : ?>
                	<li>
                		<i class="fa fa-phone"></i>
                		<span><?php echo esc_html( force_balance_tags($phone) ); ?></span>
                	</li>
                <?php endif; ?>
                <?php if ($email) : ?>
                	<li>
                		<i class="fa fa-envelope"></i>
                		<span><a href="mailto:<?php echo esc_attr($email) ?>"><?php echo esc_html( force_balance_tags($email) ); ?></a></span>
                	</li>
                <?php endif; ?>
            </ul>
            <?php if ($contact_after) : ?><?php echo wpautop(do_shortcode($contact_after)) ?><?php endif; ?>
        </div>
        <?php

        echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['contact_before'] = $new_instance['contact_before'];
        $instance['address'] = $new_instance['address'];
        $instance['phone'] = $new_instance['phone'];
        $instance['email'] = $new_instance['email'];
        $instance['contact_after'] = $new_instance['contact_after'];

        return $instance;
	}

	function form( $instance ) {
		$defaults = array('title' => __('Contact Us', 'homemarket'), 'contact_before' => '', 'address' => '474 Ontario St Toronto, ON M4X 1M7 Canada', 'phone' => '(+1234) 56789xxx', 'email' => 'tadathemes@gmail.com', 'contact_after' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <strong><?php echo __('Title', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('contact_before')); ?>">
                <strong><?php echo __('Before Description', 'homemarket') ?>:</strong>
                <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_before')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_before')); ?>"><?php if (isset($instance['contact_before'])) echo esc_attr($instance['contact_before']); ?></textarea>
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>">
                <strong><?php echo __('Address', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" value="<?php if (isset($instance['address'])) echo esc_attr($instance['address']); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>">
                <strong><?php echo __('Phone', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" value="<?php if (isset($instance['phone'])) echo esc_attr($instance['phone']); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>">
                <strong><?php echo __('Email', 'homemarket') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" value="<?php if (isset($instance['email'])) echo esc_attr($instance['email']); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('contact_after')); ?>">
                <strong><?php echo __('After Description', 'homemarket') ?>:</strong>
                <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_after')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_after')); ?>"><?php if (isset($instance['contact_after'])) echo esc_attr($instance['contact_after']); ?></textarea>
            </label>
        </p>

        <?php
	}

}

?>
<?php

add_action( 'widgets_init', 'homemarket_price_filter_load_widgets' );

function homemarket_price_filter_load_widgets() {
	register_widget( 'Homemarket_Price_filter_Widget' );
}

class Homemarket_Price_filter_Widget extends WP_Widget {
	protected $_id_base = 'ajax-price-filter';

    public function __construct() {
        $classname = 'list-price-filter ajax-product-filter';
        $widget_ops  = array( 'classname' => $classname, 'description' => __( 'Show a price filter widget with a list of preset price ranges that users can use to better narrow down the products', 'homemarket' ) );
        $control_ops = array( 'width' => 400, 'height' => 350 );
        parent::__construct( $this->_id_base, __( 'Homemarket: Ajax Price List Filter', 'homemarket' ), $widget_ops, $control_ops );
    }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $args['before_widget'];

        if ( ! empty( $title ) ){
            echo $args['before_title'] . $title . $args['after_title'];
        }

        include_once( get_parent_theme_file_path('inc/widgets/widgets/widget-views/list-price-filter.php') );

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        ?>

        <p>
            <label>
                <strong><?php _e( 'Title', 'homemarket' ) ?>:</strong><br />
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e( 'Price Range', 'homemarket' ) ?>:
            </label><br />
            <span class="range-filter" data-field_name="<?php echo esc_attr($this->get_field_name( 'prices' )); ?>">
                <?php $i = 0; ?>
                <?php if( is_array( $instance['prices'] ) ) : ?>
                    <?php foreach ( $instance['prices'] as $price ) : ?>
                        <input type="text" name="<?php echo esc_attr($this->get_field_name( 'prices' )); ?>[<?php echo esc_attr($i); ?>][min]" value="<?php echo esc_attr($price['min']); ?>" />
                        <input type="text" name="<?php echo esc_attr($this->get_field_name( 'prices' )); ?>[<?php echo esc_attr($i); ?>][max]" value="<?php echo esc_attr($price['max']); ?>" />
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </span>
        </p>

        <div class="hm-add-new-range-button">
            <input type="button" class="button button-primary" value="<?php _e( 'Add new range', 'homemarket' ) ?>">
        </div>
        
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        foreach ( $new_instance['prices'] as $key => $price ) {
            if ( !is_numeric($price['min']) || !is_numeric($price['max']) || ( $price['min'] > $price['max'] ) ) { 
                unset( $new_instance['prices'][$key] );
            }
        }
        $instance['prices'] = $new_instance['prices'];
        return $instance;
    }

}

?>
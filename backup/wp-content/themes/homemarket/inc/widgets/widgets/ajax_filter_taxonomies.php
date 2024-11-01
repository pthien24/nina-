<?php
add_action('widgets_init', 'homemarket_filter_taxonomies_load_widgets');

function homemarket_filter_taxonomies_load_widgets() {
	register_widget( 'Homemarket_Filter_Taxonomies_widget' );
}

class Homemarket_Filter_Taxonomies_widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'ajax_filter_taxonomies', 'description' => __( 'Generates a list of hierarchic taxonomies with ajax filtering.', 'homemarket' ) );

		$control_ops = array( 'id_base' => 'ajax_filter_taxonomies-widget' );

		parent::__construct( 'ajax_filter_taxonomies-widget', __( 'Homemarket: Ajax Taxonomy Filter', 'homemarket' ), $widget_ops, $control_ops );
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$hide_empty = ( isset( $instance['hide_empty'] ) ) ? true : false;
        $order_options = ( isset( $instance['order_options'] ) ) ? explode( '/', $instance['order_options'] ) : array( '', '' );

        $get_terms_args = array(
            'hide_empty' => $hide_empty,
            'orderby'    => ( isset( $order_options[0] ) ) ? $order_options[0] : 'name',
            'order'      => ( isset( $order_options[1] ) ) ? $order_options[1] : 'ASC',
            'number'     => ( isset( $instance['max_terms'] )) ? $instance['max_terms'] : '',
            'exclude'    => ( isset( $instance['exclude'] )) ? $instance['exclude'] : '',
            'include'    => ( isset( $instance['include'] )) ? $instance['include'] : '',                    
            'pad_counts' => true,
            'parent'     => 0
        );

        $terms_raw = get_terms( $instance['selected_taxonomies'], $get_terms_args );

        if ( empty( $terms_raw ) && isset( $instance['hide_widget_empty'] ) )
            return;

        $filters = $this->order_terms_by_taxonomy( $terms_raw );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		if ( ! empty( $title ) ){
			echo $args['before_title'] . $title . $args['after_title'];
		}

		include( get_parent_theme_file_path('inc/widgets/widgets/widget-views/taxonomies-filter-ui.php') );

   		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {

		$field_data = array(
            'title' => array(
                'id'    => $this->get_field_id('title'),
                'name'  => $this->get_field_name('title'),
                'value' => ( isset( $instance['title'] ) ) ? $instance['title'] : __( 'New Title', 'homemarket' )
            ),
            'taxonomies' => array(
            	'id'	 => $this->get_field_id( 'taxonomies' ),
                'name'   => $this->get_field_name( 'selected_taxonomies' ),
                'value'  => ( isset( $instance['selected_taxonomies'] ) ) ? $instance['selected_taxonomies'] : ''
            ),
            'max_terms' => array(
                'id'    => $this->get_field_id( 'max_terms' ),
                'name'  => $this->get_field_name( 'max_terms' ),
                'value' => ( isset( $instance['max_terms'] ) ) ? $instance['max_terms'] : ''
            ),
            'hide_widget_empty' => array(
                'id'    => $this->get_field_id( 'hide_widget_empty' ),
                'name'  => $this->get_field_name( 'hide_widget_empty' ),
                'value' => ( isset( $instance['hide_widget_empty'] ) ) ? 'true' : ''
            ),
            'hide_empty' => array(
                'id'    => $this->get_field_id( 'hide_empty' ),
                'name'  => $this->get_field_name( 'hide_empty' ),
                'value' => ( isset( $instance['hide_empty'] ) ) ? 'true' : ''
            ),
            'order_options' => array(
                'id'    => $this->get_field_id( 'order_options' ),
                'name'  => $this->get_field_name( 'order_options' ),
                'value' => ( isset( $instance['order_options'] ) ) ? $instance['order_options'] : 'name'
            ),
            'exclude' => array(
                'id'    => $this->get_field_id( 'exclude' ),
                'name'  => $this->get_field_name( 'exclude' ),
                'value' => ( isset( $instance['exclude'] ) ) ? $instance['exclude'] : ''
            ),
            'include' => array(
                'id'    => $this->get_field_id( 'include' ),
                'name'  => $this->get_field_name( 'include' ),
                'value' => ( isset( $instance['include'] ) ) ? $instance['include'] : ''
            )
        );

        $taxonomies = get_object_taxonomies( 'product', 'objects' );
		
		// Widget admin form
		?>

        <p>
            <label for="<?php echo esc_attr($field_data['title']['id']); ?>"><?php _e( 'Title:', 'homemarket' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($field_data['title']['id']); ?>" name="<?php echo esc_attr($field_data['title']['name']); ?>" type="text" value="<?php echo esc_attr( $field_data['title']['value'] ); ?>">
        </p>


        <p style='font-weight: bold;'><?php _e( 'Options:', 'homemarket' ); ?></p>

        <p>
            <input id="<?php echo esc_attr($field_data['hide_widget_empty']['id']); ?>" name="<?php echo esc_attr($field_data['hide_widget_empty']['name']); ?>" type="checkbox" value="true" <?php checked( $field_data['hide_widget_empty']['value'], 'true' ); ?>>
            <label for="<?php echo esc_attr($field_data['hide_widget_empty']['id']); ?>"><?php _e( 'Hide Widget if there are no terms to be displayed?', 'homemarket' ); ?></label>
        </p>

        <p>
            <input id="<?php echo esc_attr($field_data['hide_empty']['id']); ?>" name="<?php echo esc_attr($field_data['hide_empty']['name']); ?>" type="checkbox" value="true" <?php checked( $field_data['hide_empty']['value'], 'true' ); ?>>
            <label for="<?php echo esc_attr($field_data['hide_empty']['id']); ?>"><?php _e( 'Hide terms that have no related posts?', 'homemarket' ); ?></label>
        </p>

        <p>
            <label for="<?php echo esc_attr($field_data['order_options']['id']); ?>"><?php _e( 'Order Terms By:', 'homemarket' ); ?></label><br>
            <select id="<?php echo esc_attr($field_data['order_options']['id']); ?>" name="<?php echo esc_attr($field_data['order_options']['name']); ?>">
                <option value="id/ASC" <?php selected( $field_data['order_options']['value'], 'id/ASC' ); ?>><?php _e( 'ID Ascending', 'homemarket' ) ?></option>
                <option value="id/DESC" <?php selected( $field_data['order_options']['value'], 'id/DESC' ); ?>><?php _e( 'ID Descending', 'homemarket' ) ?></option>
                <option value="count/ASC" <?php selected( $field_data['order_options']['value'], 'count/ASC' ); ?>><?php _e( 'Count Ascending', 'homemarket' ) ?></option>
                <option value="count/DESC" <?php selected( $field_data['order_options']['value'], 'count/DESC' ); ?>><?php _e( 'Count Descending', 'homemarket' ) ?></option>
                <option value="name/ASC" <?php selected( $field_data['order_options']['value'], 'name/ASC' ); ?>><?php _e( 'Name Ascending', 'homemarket' ) ?></option>
                <option value="name/DESC" <?php selected( $field_data['order_options']['value'], 'name/DESC' ); ?>><?php _e( 'Name Descending', 'homemarket' ) ?></option>               
                <option value="slug/ASC" <?php selected( $field_data['order_options']['value'], 'slug/ASC' ); ?>><?php _e( 'Slug Ascending', 'homemarket' ) ?></option>
                <option value="slug/DESC" <?php selected( $field_data['order_options']['value'], 'slug/DESC' ); ?>><?php _e( 'Slug Descending', 'homemarket' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($field_data['max_terms']['id']); ?>"><?php _e('Maximum Number Of Terms To Return:', 'homemarket'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($field_data['max_terms']['id']); ?>" name="<?php echo esc_attr($field_data['max_terms']['name']); ?>" type="text" value="<?php echo esc_attr($field_data['max_terms']['value']); ?>" placeholder="Keep Empty To Display All">
        </p>

        <p>
            <label for="<?php echo esc_attr($field_data['exclude']['id']); ?>"><?php _e('Ids To Exclude From Being Displayed:', 'homemarket'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($field_data['exclude']['id']); ?>" name="<?php echo esc_attr($field_data['exclude']['name']); ?>" type="text" value="<?php echo esc_attr($field_data['exclude']['value']); ?>" placeholder="Separate ids with a comma ','">
        </p>

        <p>
            <label for="<?php echo esc_attr($field_data['include']['id']); ?>"><?php _e('Only Display Terms With The Following Ids:', 'homemarket'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($field_data['include']['id']); ?>" name="<?php echo esc_attr($field_data['include']['name']); ?>" type="text" value="<?php echo esc_attr($field_data['include']['value']); ?>" placeholder="Separate ids with a comma ','">
        </p>


        <p style='font-weight: bold;'><?php _e( 'Selected Taxonomy:', 'homemarket' ); ?></p>
	
		<p>
            <?php foreach($taxonomies as $taxonomy): ?>
                <p>
                    <input id="<?php echo ( esc_attr($taxonomy->name) . esc_attr($field_data['taxonomies']['id']) ); ?>" name="<?php echo esc_attr($field_data['taxonomies']['name']); ?>" type="radio" value="<?php echo esc_attr($taxonomy->name); ?>" <?php echo $this->is_taxonomy_checked( $field_data['taxonomies']['value'], $taxonomy->name ); ?>>
                    <label for="<?php echo ( esc_attr($taxonomy->name) . esc_attr($field_data['taxonomies']['id']) ); ?>"><?php echo esc_html($taxonomy->labels->name); ?></label>
                </p>
            <?php endforeach; ?>
		</p>

	<?php 
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['hide_widget_empty'] = $new_instance['hide_widget_empty'];
        $instance['hide_empty']        = $new_instance['hide_empty'];
        $instance['order_options']     = $new_instance['order_options'];
        $instance['max_terms']         = $new_instance['max_terms'];
        $instance['exclude']           = $new_instance['exclude'];
        $instance['include']           = $new_instance['include'];
        $instance['selected_taxonomies'] = $new_instance['selected_taxonomies'];

        return $instance;
	}

	public function is_taxonomy_checked( $custom_taxonomies_checked, $taxonomy_name ){
        if ( ! is_array( $custom_taxonomies_checked ) )
            return checked( $custom_taxonomies_checked, $taxonomy_name );

        if ( in_array( $taxonomy_name, $custom_taxonomies_checked ) )
            return 'checked="checked"';
    }

    public function order_terms_by_taxonomy( $terms ){

    	$taxonomies = array();

    	// build taxonomies array
    	foreach ( $terms as $term ) {
    		$taxonomies[ $term->taxonomy ][] = $term;
    	}

    	return $taxonomies;

    }

    public function get_current_url(){
        global $wp;
        $current_url = trailingslashit( esc_url(home_url( add_query_arg( array(),$wp->request ) )) );

        return $current_url;
    }

}

?>
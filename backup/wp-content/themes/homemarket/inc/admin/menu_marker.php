<!-- PHP Form Action -->

<?php

$item = 'homemarket_menu_marker';

if ( !defined('ABSPATH') ) exit;  // Exit if accessed directly

if ( !class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/****** functions to manage markers ******/
if ( !class_exists( 'Menu_Marker_table' ) ) :
    class Menu_Marker_table extends WP_List_Table {

        function __construct() {
            parent::__construct(array(
                'singular' => 'marker',  // singular name of the listed records
                'plural'   => 'markers', // plural name of the listed records
                'ajax'     => false      // does not table support ajax
            ));
        }

        function column_default( $item, $column_name ) {
            switch( $column_name ) {
                case 'marker_id':
                case 'marker_name':
                case 'marker_slug':
                case 'marker_background_color':
                    return $item[ $column_name ];
                default:
                    return print_r( $item, true ); //Show the whole array for troubleshooting purposes
            }
        }

        function column_cb( $item ) {
            return sprintf( '<input type="checkbox" name="%1$s[]" value="%2$s" />', $this->_args['singular'], $item['marker_id'] );
        }

        function column_marker_name( $item ) {
            $actions = array(
                'edit'    => '<a href="' . esc_url( sprintf( 'admin.php?page=%1$s&action=%2$s&marker_id=%3$s', 'menu_marker', 'edit', $item['marker_id'] ) ) . '">Edit</a>',
                'delete'    => '<a href="' . esc_url( sprintf( 'admin.php?page=%1$s&action=%2$s&marker_id=%3$s', 'menu_marker', 'delete', $item['marker_id'] ) ) . '">Delete</a>',
            );
            return sprintf( '%1$s %2$s', $item['marker_name'], $this->row_actions( $actions ) );
        }

        function get_columns() {
            $columns = array(
                'cb'                  => '<input type="checkbox" />',
                'marker_id'               => esc_html__( 'ID', 'homemarket' ),
                'marker_name'             => esc_html__( 'Marker Name', 'homemarket' ),
                'marker_slug'             => esc_html__( 'Marker Slug', 'homemarket' ),
                'marker_background_color' => esc_html__( 'Background Color', 'homemarket' ),
            );
            return $columns;
        }

        function get_sortable_columns() {
            $sortable_columns = array(
                'marker_id'               => array( 'marker_id', false ),
                'marker_name'             => array( 'marker_name', false ),
                'marker_slug'             => array( 'marker_slug', false ),
                'marker_background_color' => array( 'marker_background_color', false )
            );
            return $sortable_columns;
        }

        function get_bulk_actions() {
            $actions = array(
                'bulk_delete'    => 'Delete'
            );
            return $actions;
        }

        function process_bulk_action() {
            global $wpdb;
            //Detect when a bulk action is being triggered...

            if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {

                $nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
                $action = 'bulk-' . $this->_args['plural'];

                if ( ! wp_verify_nonce( $nonce, $action ) )
                    wp_die( 'Sorry, your nonce did not verify' );

            }
            if ( 'bulk_delete'===$this->current_action() ) {
                $selected_ids = $_GET[ $this->_args['singular'] ];
                $format = implode(', ', $selected_ids);

                $sql = sprintf('DELETE FROM %1$s WHERE marker_id IN (%2$s)', HM_MARKER_TABLE, "$format" );
                $wpdb->query( $sql );

                wp_redirect( admin_url( 'admin.php?page=menu_marker' ) );
            }
        }

        function prepare_items() {
            global $wpdb;
            $per_page = 10;
            $columns = $this->get_columns();
            $hidden = array();
            $sortable = $this->get_sortable_columns();
            
            $this->_column_headers = array( $columns, $hidden, $sortable );
            $this->process_bulk_action();
            
            $orderby = ( ! empty( $_REQUEST['orderby'] ) ) ? sanitize_sql_orderby( $_REQUEST['orderby'] ) : 'marker_id'; //If no sort, default to title
            $order = ( ! empty( $_REQUEST['order'] ) ) ? sanitize_text_field( $_REQUEST['order'] ) : 'desc'; //If no order, default to asc
            $current_page = $this->get_pagenum();
            $post_table_name  = $wpdb->prefix . 'posts';

            $where = "1=1";

            $sql = $wpdb->prepare( 'SELECT HM_marker.* FROM %1$s as HM_marker
                            WHERE ' . $where . ' ORDER BY %3$s %4$s
                            LIMIT %5$s, %6$s' , HM_MARKER_TABLE, '', $orderby, $order, $per_page * ( $current_page - 1 ), $per_page );

            $data = $wpdb->get_results( $sql, ARRAY_A );

            $sql = "SELECT COUNT(*) FROM " . HM_MARKER_TABLE . " where 1=1 ";
            $total_items = $wpdb->get_var( $sql );

            $this->items = $data;
            $this->set_pagination_args( array(
                'total_items' => $total_items,                  //WE have to calculate the total number of items
                'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
                'total_pages' => ceil( $total_items/$per_page )   //WE have to calculate the total number of pages
            ) );
        }
    }
endif;

if (isset($_POST) && !empty($_POST)) {

    /*================================================================
                            Insert New Table
    ================================================================*/
    if ( ! function_exists('menu_marker_add_action') ) {
        function menu_marker_add_action() {
            global $wpdb;

            $name             = $_POST['marker-name'];
            $slug             = $_POST['marker-slug'];
            $background_color = $_POST['marker-background-color'];

            $wpdb->insert(
                HM_MARKER_TABLE,
                array(
                    'marker_name'             => $name,
                    'marker_slug'             => $slug,
                    'marker_background_color' => $background_color
                ),
                array(
                    '%s',
                    '%s',
                    '%s'
                )
            );

            wp_redirect( admin_url( 'admin.php?page=menu_marker' ) );
            exit;
        }
    }

    /*================================================================
                            Update Edited Table
    ================================================================*/
    if ( ! function_exists('menu_marker_save_action') ) {
        function menu_marker_save_action() {
            global $wpdb;

            $edit_id               = $_POST['marker-id-edit'];
            $edit_name             = $_POST['marker-name-edit'];
            $edit_slug             = $_POST['marker-slug-edit'];
            $edit_background_color = $_POST['marker-background-color-edit'];

            $wpdb->update(
                HM_MARKER_TABLE,
                array(
                    'marker_name'             => $edit_name,
                    'marker_slug'             => $edit_slug,
                    'marker_background_color' => $edit_background_color,
                ),
                array( 'marker_id' =>  $edit_id ),
                array(
                    '%s', '%s', '%s'
                ),
                array(
                    '%d'
                )
            );

            wp_redirect( admin_url( 'admin.php?page=menu_marker') );
            exit;
        }
    }

}

/* =======================================================================
                    marker-style render action 
======================================================================== */
if ( ! function_exists( 'marker_style_render_action' ) ) { 
    function marker_style_render_action() { 
        if ( ! empty( $_POST['submit-add'] ) ) {
            menu_marker_add_action();
            return;
        }
        ?>

        <!-- Add Form Content -->
        <h1>Main Menu Markers</h1>

        <div id="col-container" class="wp-clearfix">

            <div id="col-left" class="add_markers_left_tag">
                <div class="col-wrap">
                    <p>Menu above special marker can be managed here. To display these markers on the front-end you can select selectbox option on Main Menu page.</p>
                    <div class="form-wrap">
                        <h2>Add New Menu Marker</h2>
                        <form id="addmarker" class="validate" method="POST">
                            
                            <div class="form-field form-required term-name-wrap">
                                <label for="marker-name"><?php _e('Name', 'homemarket') ?></label>
                                <input name="marker-name" id="marker-name" type="text" value="" size="40" aria-required="true" />
                                <p><?php _e('The name is how it appears on your site.', 'homemarket'); ?></p>
                            </div>
                            <div class="form-field form-required term-slug-wrap">
                                <label for="marker-slug"><?php _e('Slug', 'homemarket'); ?></label>
                                <input name="marker-slug" id="marker-slug" type="text" value="" size="40" />
                                <p>The &#8220;slug&#8221; is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
                            </div>
                            <div class="form-field form-required term-background-color-wrap">
                                <label for="marker-background-color"><?php _e('Marker Background Color', 'homemarket'); ?></label>
                                <input type="text" name="marker-background-color" id="marker-background-color" value="#fa5555" />
                                <p><?php _e('The marker background color can be changed. You can select background color here.', 'homemarket') ?></p>
                            </div>
                            <p class="submit">
                                <input type="submit" name="submit-add" id="submit" class="button button-primary" value="Add New Marker Style">
                            </p>

                        </form>
                    </div>
                </div>  
            </div>

            <?php

            $markerTable = new Menu_Marker_table();
            $markerTable->prepare_items();
            
            ?>

            <div id="col-right" class="added_markers_right_tag">
                <div class="col-wrap">
                    <form id="addedmarker" method="get">
                        <input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ) ?>" />
                        <?php $markerTable->display() ?>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }
}

/* =======================================================================
                    marker-style edit action 
======================================================================== */
if ( ! function_exists( 'marker_style_edit_action' ) ) { 
    function marker_style_edit_action() { 

        global $wpdb;

        if ( ! empty( $_POST['submit-edit'] ) ) {
            menu_marker_save_action();
            return;
        }

        $marker_data = array();

        if ( empty( $_REQUEST['marker_id'] ) ) {
            # code...
            echo "<h2>You attempted to eidt an item that doesn`t exist now. Perhaps it was deleted?</h2>";
            return;
        }

        $marker_id = sanitize_text_field( $_REQUEST['marker_id'] );
        $sql = $wpdb->prepare( 'SELECT HM_marker.* FROM %1$s as HM_marker WHERE HM_marker.marker_id = %2$d', HM_MARKER_TABLE, $marker_id );
        $marker_data = $wpdb->get_row( $sql, ARRAY_A );

        if ( empty( $marker_data ) ) {
            echo "<h2>You attempted to eidt an item that doesn`t exist now. Perhaps it was deleted?</h2>";
            return;
        }
        
        ?>
        <!-- Edit Form Content -->
        <div class="wrap">
            <div class="form-wrap">
                <h2>Edit Menu Marker</h2>
                <form id="addmarker" class="validate" method="POST">
                    
                    <div class="form-field form-required term-name-wrap">
                        <label for="marker-id-edit"></label>
                        <input name="marker-id-edit" id="marker-id-edit" type="hidden" value="<?php if ( !empty( $marker_data['marker_id'] ) ) echo esc_attr( $marker_data['marker_id'] ); ?>" size="40" aria-required="true" />
                    </div>
                    <div class="form-field form-required term-name-wrap">
                        <label for="marker-name-edit"><?php _e('Name', 'homemarket') ?></label>
                        <input name="marker-name-edit" id="marker-name-edit" type="text" value="<?php if ( !empty( $marker_data['marker_name'] ) ) echo esc_attr( $marker_data['marker_name'] ); ?>" size="40" aria-required="true" />
                        <p><?php _e('The name is how it appears on your site.', 'homemarket'); ?></p>
                    </div>
                    <br />
                    <div class="form-field form-required term-slug-wrap">
                        <label for="marker-slug-edit"><?php _e('Slug', 'homemarket'); ?></label>
                        <input name="marker-slug-edit" id="marker-slug-edit" type="text" value="<?php if ( !empty( $marker_data['marker_slug'] ) ) echo esc_attr( $marker_data['marker_slug'] ); ?>" size="40" />
                        <p>The &#8220;slug&#8221; is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
                    </div>
                    <br />
                    <div class="form-field form-required term-background-color-wrap">
                        <label for="marker-background-color-edit"><?php _e('Marker Background Color', 'homemarket'); ?></label>
                        <input type="text" name="marker-background-color-edit" id="marker-background-color-edit" value="<?php if ( !empty( $marker_data['marker_background_color'] ) ) echo esc_attr( $marker_data['marker_background_color'] ); ?>" />
                        <p><?php _e('The marker background color can be changed. You can select background color here.', 'homemarket') ?></p>
                    </div>
                    <br />
                    <p class="submit">
                        <input type="submit" name="submit-edit" id="submit" class="button button-primary" value="Save Marker Style">
                    </p>

                </form>
            </div>
        </div>

        <?php
    }
}

/* =======================================================================
                    marker-style delete action 
======================================================================== */
if( ! function_exists( 'marker_style_delete_action' ) ) {
    function marker_style_delete_action() {
        global $wpdb;
        $wpdb->delete( HM_MARKER_TABLE, array( 'marker_id' => $_REQUEST['marker_id'] ) );
        wp_redirect( admin_url( 'admin.php?page=menu_marker') );
        exit;
    }
}

/********************* marker-style admin main actions **********************/
/****************************************************************************/

if ( isset( $_REQUEST['action'] ) && 'edit' == $_REQUEST['action'] ) {
    marker_style_edit_action();
} elseif ( isset( $_REQUEST['action'] ) && 'delete' == $_REQUEST['action'] ) {
    marker_style_delete_action();
} else {
    marker_style_render_action();
}
<?php
/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {	
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	    global $_wp_nav_menu_max_depth, $wpdb;
	   
	    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
	
	    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	    ob_start();
	    $item_id = esc_attr( $item->ID );
	    $removed_args = array(
	        'action',
	        'customlink-tab',
	        'edit-menu-item',
	        'menu-item',
	        'page-tab',
	        '_wpnonce',
	    );
	
	    $original_title = '';
	    if ( 'taxonomy' == $item->type ) {
	        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
	        if ( is_wp_error( $original_title ) )
	            $original_title = false;
	    } elseif ( 'post_type' == $item->type ) {
	        $original_object = get_post( $item->object_id );
	        $original_title = $original_object->post_title;
	    }
	
	    $classes = array(
	        'menu-item menu-item-depth-' . $depth,
	        'menu-item-' . esc_attr( $item->object ),
	        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
	    );
	
	    $title = $item->title;
	
	    if ( ! empty( $item->_invalid ) ) {
	        $classes[] = 'menu-item-invalid';
	        /* translators: %s: title of menu item which is invalid */
	        $title = sprintf( __('%s (Invalid)', 'homemarket'), $item->title );
	    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
	        $classes[] = 'pending';
	        /* translators: %s: title of menu item in draft status */
	        $title = sprintf( __('%s (Pending)', 'homemarket'), $item->title );
	    }
	
	    $title = empty( $item->label ) ? $title : $item->label;

	    $sql = $wpdb->prepare( 'SELECT * FROM %1$s', HM_MARKER_TABLE );
        $hm_markers = $wpdb->get_results( $sql, ARRAY_A );
	
	    ?>
	    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
	        <dl class="menu-item-bar">
	            <dt class="menu-item-handle">
	                <span class="item-title"><?php echo esc_html( $title ); ?></span>
	                <span class="item-controls">
	                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
	                    <span class="item-order hide-if-js">
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-up-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'homemarket'); ?>">&#8593;</abbr></a>
	                        |
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-down-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'homemarket'); ?>">&#8595;</abbr></a>
	                    </span>
	                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'homemarket'); ?>" href="<?php
	                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
	                    ?>"><?php _e( 'Edit Menu Item', 'homemarket' ); ?></a>
	                </span>
	            </dt>
	        </dl>
	
	        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
	            <?php if( 'custom' == $item->type ) : ?>
	                <p class="field-url description description-wide">
	                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
	                        <?php _e('URL', 'homemarket'); ?><br />
	                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
	                    </label>
	                </p>
	            <?php endif; ?>
	            <p class="description description-thin">
	                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
	                    <?php _e('Navigation Label', 'homemarket'); ?><br />
	                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
	                </label>
	            </p>
	            <p class="description description-thin">
	                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
	                    <?php _e('Title Attribute', 'homemarket'); ?><br />
	                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
	                </label>
	            </p>
	            <p class="field-link-target description">
	                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
	                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
	                    <?php _e('Open link in a new window/tab', 'homemarket'); ?>
	                </label>
	            </p>
	            <p class="field-css-classes description description-thin">
	                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
	                    <?php _e('CSS Classes (optional)', 'homemarket'); ?><br />
	                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
	                </label>
	            </p>
	            <p class="field-xfn description description-thin">
	                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
	                    <?php _e('Link Relationship (XFN)', 'homemarket'); ?><br />
	                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
	                </label>
	            </p>
	            <p class="field-description description description-wide">
	                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
	                    <?php _e('Description', 'homemarket'); ?><br />
	                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
	                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'homemarket'); ?></span>
	                </label>
	            </p>        
	            <?php
	            /* New fields insertion starts here */
	            ?>
	            <p class="field-background-url description description-wide">
	            	<label for="edit-menu-menu_view-<?php echo $item_id; ?>">
	            		<?php _e('Menu View', 'homemarket'); ?>
	            		<select id="edit-menu-menu_view-<?php echo $item_id; ?>" class="widefat code edit-menu-menu-view" name="menu_view_mode[<?php echo $item_id; ?>]"> 
	            			<option value="list_menu" <?php if ($item->menu_view == "list_menu" ) echo "selected"; ?>><?php _e( 'Original Menu', 'homemarket' ) ?></option>
	            			<option value="mega_menu" <?php if ($item->menu_view == "mega_menu" ) echo "selected"; ?>><?php _e( 'Mega Menu', 'homemarket' ) ?></option>
		            	</select>
	            	</label>
	            </p>
	            <p class="field-label-option description description-wide">
            		<label for="label-option-<?php echo $item_id; ?>">
            			<input type="checkbox" id="label-option-<?php echo $item_id; ?>" value="_blank" name="menu_item_label_option[<?php echo $item_id; ?>]" <?php checked( $item->label_hidden, 'checked' ); ?> />
	                    <?php _e('Navigation Label Hidden', 'homemarket'); ?>
	                </label>	
	                <br />
	            </p>
	            <p class="field-background-url description description-wide">
	            	<span class="background-field-checkbox">
	            		<label for="option-check-<?php echo $item_id; ?>">
	            			<input type="checkbox" id="option-check-<?php echo $item_id; ?>" value="_blank" name="menu_item_background_option[<?php echo $item_id; ?>]" <?php checked( $item->background_option, 'checked' ); ?> />
		                    <?php _e('Background Options', 'homemarket'); ?>
		                </label>	
		                <br />
	            	</span>
	            	<span class="background-field-options">
	            		<label for="edit-menu-item-full_width-<?php echo $item_id; ?>">
	            			<input type="checkbox" id="edit-menu-item-full_width-<?php echo $item_id; ?>" value="_blank" name="menu_item_background_width[<?php echo $item_id; ?>]" <?php checked($item->background_width, 'checked' ); ?> />
		                    <?php _e('Submenu Full Width', 'homemarket'); ?>
		                </label>
	            		<label for="edit-menu-item-background_url-<?php echo $item_id; ?>">
		                    <?php _e('Background URL', 'homemarket'); ?><br />
		                    <input type="text" id="edit-menu-item-background_url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu_item_background_url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->background_url ); ?>" />
		                </label>
		                <label for="edit-menu-item-background_repeat-<?php echo $item_id; ?>">
		                    <?php _e('Background Repeat', 'homemarket'); ?><br />
		                    <select id="edit-menu-item-background_repeat-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu_item_background_repeat[<?php echo $item_id; ?>]"/>
		                    	<option value="inherit" <?php if ($item->background_repeat == "inherit" ) echo "selected"; ?> >Inherit</option>
		                    	<option value="no-repeat" <?php if ($item->background_repeat == "no-repeat" ) echo "selected"; ?> >No repeat</option>
		                    	<option value="repeat-all" <?php if ($item->background_repeat == "repeat-all" ) echo "selected"; ?> >Repeat All</option>
		                    	<option value="repeat-horizontal" <?php if ($item->background_repeat == "repeat-horizontal" ) echo "selected"; ?> >Repeat Horizontally</option>
		                    	<option value="repeat-vertical" <?php if ($item->background_repeat == "repeat-vertical" ) echo "selected"; ?> >Repeat Vertically</option>
		                    </select>
		                </label>
		                <label for="edit-menu-item-background_size-<?php echo $item_id; ?>">
		                    <?php _e('Background Size', 'homemarket'); ?><br />
		                    <select id="edit-menu-item-background_size-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu_item_background_size[<?php echo $item_id; ?>]"/>
		                    	<option value="inherit" <?php if ($item->background_size == "inherit" ) echo "selected"; ?> >Inherit</option>
		                    	<option value="cover" <?php if ($item->background_size == "cover" ) echo "selected"; ?> >Cover</option>
		                    	<option value="contain" <?php if ($item->background_size == "contain" ) echo "selected"; ?> >Contain</option>
		                    </select>
		                </label>
		                <label for="edit-menu-item-background_position-<?php echo $item_id; ?>">
		                    <?php _e('Background Position', 'homemarket'); ?><br />
		                    <select id="edit-menu-item-background_position-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu_item_background_position[<?php echo $item_id; ?>]"/>
		                    	<option value="left top" <?php if ($item->background_position == "left top" ) echo "selected"; ?> >Left Top</option>
		                    	<option value="left center" <?php if ($item->background_position == "left center" ) echo "selected"; ?> >Left Center</option>
		                    	<option value="left bottom" <?php if ($item->background_position == "left bottom" ) echo "selected"; ?> >Left Bottom</option>
		                    	<option value="center top" <?php if ($item->background_position == "center top" ) echo "selected"; ?> >Center Top</option>
		                    	<option value="center center" <?php if ($item->background_position == "center center" ) echo "selected"; ?> >Center Center</option>
		                    	<option value="center bottom" <?php if ($item->background_position == "center bottom" ) echo "selected"; ?> >Center Bottom</option>
		                    	<option value="right top" <?php if ($item->background_position == "right top" ) echo "selected"; ?> >Right Top</option>
		                    	<option value="right center" <?php if ($item->background_position == "right center" ) echo "selected"; ?> >Right Center</option>
		                    	<option value="right bottom" <?php if ($item->background_position == "right bottom" ) echo "selected"; ?> >Right Bottom</option>
		                    </select>
		                </label>
	            	</span>
	            </p>
	            <p class="field-menu-marker description description-wide">
	            	<label for="edit-menu-item_marker-<?php echo $item_id; ?>">
	            		<?php _e('Main Menu Marker', 'homemarket'); ?>
	            		<select id="edit-menu-item_marker-<?php echo $item_id; ?>" class="widefat code edit-menu-item-marker" name="menu_item_marker[<?php echo $item_id; ?>]"> 
	            			<option value="title" <?php if ($item->menu_marker == "title" ) echo "selected"; ?>><?php _e( '--SELECT MARKER--', 'homemarket' ) ?></option>
		            		<?php 
		            		foreach ( $hm_markers as $hm_marker ) { ?>
		            		<option value="<?php echo $hm_marker['marker_id']; ?>" <?php if ($item->menu_marker == $hm_marker['marker_id'] ) echo "selected"; ?> ><?php echo $hm_marker['marker_name'] ?></option>
		            		<?php 
		            		}
		            		?>
		            	</select>
	            	</label>
	            </p>
	            <p class="field-menu-featured-img description description-wide">
	            	<label for="edit-menu-featured-img-<?php echo $item_id; ?>">
	                    <?php _e('Menu Featured Image', 'homemarket'); ?><br />
	                    <input type="text" id="edit-menu-featured-img-<?php echo $item_id; ?>" class="widefat code edit-menu-featured-img" name="menu_item_featured_img[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->featured_img ); ?>" />
	                    <span class="description"><?php _e('Only Image URL (http://)', 'homemarket'); ?></span>
	                </label>
	            </p>
	            <p class="field-collection-menu-icon description description-wide">
	            	<label for="edit-collection-menu-icon-<?php echo $item_id; ?>">
	                    <?php _e('Menu Icon', 'homemarket'); ?><br />
	                    <input type="text" id="edit-collection-menu-icon-<?php echo $item_id; ?>" class="widefat code edit-menu-collection-icon" name="collection_menu_icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->collection_icon ); ?>" />
	                    <span class="description"><?php _e('Only Icon URL (http://)', 'homemarket'); ?></span>
	                </label>
	            </p>
	            <p class="field-custom-content description description-wide">
	                <label for="edit-menu-item-custom-content-<?php echo $item_id; ?>">
	                    <i class="fa fa-cogs"></i><?php _e('Custom Content', 'homemarket'); ?><br />
	                    <textarea id="edit-menu-item-custom-content-<?php echo $item_id; ?>" class="widefat edit-menu-item-custom" rows="10" cols="20" name="menu_item_custom_content[<?php echo $item_id; ?>]"><?php echo esc_html( $item->custom_content ); // textarea_escaped ?></textarea>
	                    <span class="description"><?php _e('Only contain html code.', 'homemarket'); ?></span>
	                </label>
	            </p> 
	            <?php
	            /* New fields insertion ends here */
	            ?>
	            <div class="menu-item-actions description-wide submitbox">
	                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
	                    <p class="link-to-original">
	                        <?php printf( __('Original: %s', 'homemarket'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
	                    </p>
	                <?php endif; ?>
	                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
	                echo wp_nonce_url(
	                    add_query_arg(
	                        array(
	                            'action' => 'delete-menu-item',
	                            'menu-item' => $item_id,
	                        ),
	                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                    ),
	                    'delete-menu_item_' . $item_id
	                ); ?>"><?php _e('Remove', 'homemarket'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
	                    ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'homemarket'); ?></a>
	            </div>
	
	            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
	            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
	            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
	            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
	            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
	            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
	            <div style="clear: both;"></div>
	        </div><!-- .menu-item-settings-->
	        <ul class="menu-item-transport"></ul>
	    <?php
	    
	    $output .= ob_get_clean();

	    }
}

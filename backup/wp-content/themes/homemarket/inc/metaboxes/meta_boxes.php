<?php

require_once( get_parent_theme_file_path( 'inc/metaboxes/product.php' ) );

// Get Meta Tabs
function homemarket_get_meta_tabs( $meta_fields ) {
    $meta_tabs = array();
    $general_tab = array('general', __('General', 'homemarket'));

    foreach ($meta_fields as $meta_field) {
        $meta_tab = isset($meta_field['tab']) ? $meta_field['tab'] : '';
        if (!$meta_tab && !in_array($general_tab, $meta_tabs)) {
            $meta_tabs[] = $general_tab;
        }
        if ($meta_tab && !in_array($meta_tab, $meta_tabs)) {
            $meta_tabs[] = $meta_tab;
        }
    }

    return $meta_tabs;
}

// Show Meta Boxes
function homemarket_show_meta_box( $meta_fields ) {

    if (!isset($meta_fields) || empty($meta_fields))
        return;

    $meta_tabs = homemarket_get_meta_tabs($meta_fields);

    echo '<div class="postoptions homemarket-meta-tab clearfix">';
    if (count($meta_tabs) <= 1) {
        foreach ($meta_fields as $meta_field) {
            homemarket_show_meta_field($meta_field);
        }
    } else {
        echo '<ul class="resp-tabs-list">';
        foreach ($meta_tabs as $meta_tab) {
            echo '<li>' . $meta_tab[1] . '</li>';
        }
        echo '</ul>';
        echo '<div class="resp-tabs-container">';
        foreach ($meta_tabs as $meta_tab) {
            echo '<div>';
            echo '<h3>' . $meta_tab[1] . '</h3>';
            foreach ($meta_fields as $meta_field) {
                if ((!isset($meta_field['tab']) && $meta_tab[0] == 'general') || (isset($meta_field['tab']) && $meta_field['tab'][0] == $meta_tab[0]))
                    homemarket_show_meta_field($meta_field);
            }
            echo '</div>';
        }
        echo '</div>';
    }
    echo'</div>';
}

// Show Meta Box
function homemarket_show_meta_field( $meta_field ) {
    if ( isset( $_GET['post'] ) ) {
        $post_id = (int)( $_GET['post'] );
        $post    = get_post( $post_id );
    }
    else {
        $post = $GLOBALS['post'];
    }

    $name = $title = $desc = $type = $tab = $default = $required = $options = '';
    extract(shortcode_atts(array(
        "name" => '',
        "title" => '',
        "desc" => '',
        "type" => '',
        "tab" => '',
        "default" => '',
        "required" => '',
        "options" => ''
    ), $meta_field));

    $meta_value = get_post_meta($post->ID, $name, true);

    if ($meta_value == "")
        $meta_value = $default;

    $required_atts = array();
    if ($required) {
        $required_atts['data-required'] = $required['name'];
        $required_atts['data-value'] = $required['value'];
    }

    $required = homemarket_stringify_attributes( $required_atts );

    if ($type == "text") : // text ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo stripslashes($meta_value) ?>" size="50%" />
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "select") : // select ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <select name="<?php echo $name ?>" id="<?php echo $name ?>">
                        <?php if (!is_array($options) || !in_array('', array_keys($options))) : ?>
                            <option value=""><?php echo __('Select', 'homemarket') ?></option>
                        <?php endif; ?>
                        <?php if (is_array($options)) :
                            foreach ($options as $key => $value) : ?>
                                <option value="<?php echo $key ?>"<?php echo ($meta_value == $key ? ' selected="selected"' : '') ?>>
                                    <?php echo $value ?>
                                </option>
                            <?php endforeach;
                        endif ?>
                    </select>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "upload") : // upload image ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                        <input value="<?php echo stripslashes($meta_value) ?>" type="text" name="<?php echo $name ?>"  id="<?php echo $name ?>" size="50%" />
                        <br/>
                        <input class="button_upload_image button" id="<?php echo $name ?>" type="button" value="<?php _e('Upload Image', 'homemarket') ?>" />&nbsp;
                        <input class="button_remove_image button" id="<?php echo $name ?>" type="button" value="<?php _e('Remove Image', 'homemarket') ?>" />
                    <?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif;

    if ($type == "attach") : // attach image ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <div class="attach_image" id="<?php echo $name ?>_thumb"><?php if ($meta_value) { echo wp_get_attachment_image((int)$meta_value, 'full'); } ?></div>
                    <input value="<?php echo stripslashes($meta_value) ?>" type="hidden" name="<?php echo $name ?>"  id="<?php echo $name ?>" size="50%" />
                    <br/>
                    <input class="button_attach_image button" id="<?php echo $name ?>" type="button" value="<?php _e('Attach Image', 'homemarket') ?>" />&nbsp;
                    <input class="button_remove_image button" id="<?php echo $name ?>" type="button" value="<?php _e('Remove Image', 'homemarket') ?>" />
                    <label><?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?></label>
                </div>
            </div>
        </div>
    <?php endif;

    if ($type == "editor") : // editor ?>
        <div class="metabox" <?php echo $required ?>>
            <h3 style="float:none;"><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <?php wp_editor( $meta_value, $name ) ?>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "textarea") : // textarea ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <textarea id="<?php echo $name ?>" name="<?php echo $name ?>"><?php echo $meta_value ?></textarea>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if (($type == 'radio') && (!empty($options))) : // radio buttons ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option radio">
                    <?php foreach ($options as $key => $value) : ?>
                        <input type="radio" id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>" value="<?php echo $key ?>"
                            <?php echo (isset($meta_value) && ($meta_value == $key) ? ' checked="checked"' : '') ?>/>
                        <label for="<?php echo $name ?>_<?php echo $key ?>"><?php echo $value ?></label>&nbsp;&nbsp;&nbsp;
                    <?php endforeach; ?>
                    <br>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "checkbox") : // checkbox
        if ( $meta_value == $name ) {
            $checked = "checked=\"checked\"";
        } else {
            $checked = "";
        } ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option checkbox">
                    <label><input type="checkbox" name="<?php echo $name ?>" value="<?php echo $name ?>" <?php echo $checked ?>/> <?php echo $desc ?></label>
                </div>
            </div>
        </div>
    <?php endif;

    if (($type == 'multi_checkbox') && (!empty($options))) : // radio buttons ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option radio">
                    <?php foreach ($options as $key => $value) : ?>
                    <input type="checkbox" id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>[]" value="<?php echo $key ?>" <?php echo (isset($meta_value) && in_array($key, explode(',', $meta_value))) ? ' checked="checked"' : ''?>/><label for="<?php echo $name ?>_<?php echo $key ?>"> <?php echo $value ?> </label>&nbsp;&nbsp;&nbsp;
                    <?php endforeach; ?>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "color") : // color ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option homemarket-meta-color">
                    <input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo stripslashes($meta_value) ?>" size="50%" class="homemarket-color-field" />
                    <label class="homemarket-transparency-check" for="<?php echo $name ?>-transparency"><input type="checkbox" value="1" id="<?php echo $name ?>-transparency" class="checkbox homemarket-color-transparency"<?php if ($meta_value == 'transparent') echo ' checked="checked"' ?>> <?php _e('Transparent', 'homemarket') ?></label>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;
}

// Save Post Data
function homemarket_save_meta_value( $post_id, $meta_fields ) {
    if (!isset($meta_fields) || empty($meta_fields))
        return;

    foreach ($meta_fields as $meta_field) {

        $name = $title = $desc = $type = $default = $options = '';
        extract(shortcode_atts(array(
            "name" => '',
            "title" => '',
            "desc" => '',
            "type" => '',
            "default" => '',
            "options" => ''
        ), $meta_field));

        if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $meta_value = get_post_meta($post_id, $name, true);

        if (!isset($_POST[$name])) {
            delete_post_meta($post_id, $name);
            continue;
        }

        $data = $_POST[$name];

        if (is_array($data))
            $data = implode(',', $data);

        if ($data) {
            update_post_meta($post_id, $name, $data);
        } elseif (!$data && $meta_value) {
            delete_post_meta($post_id, $name);
        }
    }
}


function homemarket_stringify_attributes( $attributes ) {
    $atts = array();
    foreach ( $attributes as $name => $value ) {
        $atts[] = $name . '="' . esc_attr( $value ) . '"';
    }

    return implode( ' ', $atts );
}
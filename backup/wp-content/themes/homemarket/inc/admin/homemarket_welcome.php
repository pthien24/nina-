<?php

$theme = wp_get_theme();
if ( $theme->parent_theme ) {
    $template_dir = basename( get_template_directory() );
    $theme = wp_get_theme( $template_dir );
}

$tgmpa             = TGM_Plugin_Activation::$instance;
$plugins           = TGM_Plugin_Activation::$instance->plugins;
$view_totals = array(
    'all'      => array(), // Meaning: all plugins which still have open actions.
    'install'  => array(),
    'update'   => array(),
    'activate' => array(),
);

foreach ( $plugins as $slug => $plugin ) {
    if ( $tgmpa->is_plugin_active( $slug ) && false === $tgmpa->does_plugin_have_update( $slug ) ) {
        // No need to display plugins if they are installed, up-to-date and active.
        continue;
    } else {
        $view_totals['all'][ $slug ] = $plugin;

        if ( ! $tgmpa->is_plugin_installed( $slug ) ) {
            $view_totals['install'][ $slug ] = $plugin;
        } else {
            if ( false !== $tgmpa->does_plugin_have_update( $slug ) ) {
                $view_totals['update'][ $slug ] = $plugin;
            }

            if ( $tgmpa->can_plugin_activate( $slug ) ) {
                $view_totals['activate'][ $slug ] = $plugin;
            }
        }
    }
}

$all_index = $install_index = $update_index = $activate_index = 0;

foreach ( $view_totals as $type => $count ) {
    $size = sizeof($count);
    if ( $size < 1 ) {
        continue;
    }
    switch ( $type ) {
        case 'all':
            $all_index = $size;
            break;
        case 'install':
            $install_index = $size;
            break;
        case 'update':
            $update_index = $size;
            break;
        case 'activate':
            $activate_index = $size;
            break;
        default:
            break;
    }
}

$installed_plugins = get_plugins();

function homemarket_demo_types() {
    return array(
        'default' => array( 'alt' => 'Main Demo', 'img' => HM_PLUGINS_URI.'/images/home1.jpg' ),
        'fullwidth-parallax' => array( 'alt' => 'FullWidth Parallax', 'img' => HM_PLUGINS_URI.'/images/home2.jpg' ),
        'left-sidebar' => array( 'alt' => 'Home With Left Sidebar', 'img' => HM_PLUGINS_URI.'/images/home3.jpg' ),
        'jewelry' => array( 'alt' => 'Jewelry Demo', 'img' => HM_PLUGINS_URI.'/images/home4.png' ),
        'supermarket' => array( 'alt' => 'Supermarket Demo', 'img' => HM_PLUGINS_URI.'/images/home8.jpg' ),
    );
}

$demos = homemarket_demo_types();


?>
<div class="wrap about-wrap homemarket-welcome">
    <h1><?php _e( 'Welcome to Homemarket', 'homemarket' ); ?></h1>
    <div class="about-text">
        <?php echo esc_html__( 'Homemarket is now installed and ready to use! Please install below recommened plugins. We hope you enjoy it!', 'homemarket' ); ?>
    </div>
    <div class="homemarket-plugins-section">
        <h2><?php _e( 'Recommended Plugins', 'homemarket' ) ?></h2>
        <?php if ($install_index > 1 || $update_index > 1 || $activate_index > 1) : ?>
        <p class="about-description">
            <?php
            if ($install_index > 1)
                printf( '<a href="%s" class="button-primary">%s</a>', admin_url( 'themes.php?page=install-required-plugins&plugin_status=install' ), __( "Click here to install plugins all together.", 'homemarket' ) );
            ?>
            <?php
            if ($activate_index > 1)
                printf( '<a href="%s" class="button-primary">%s</a>', admin_url( 'themes.php?page=install-required-plugins&plugin_status=activate' ), __( "Click here to activate plugins all together.", 'homemarket' ) );
            ?>
            <?php
            if ($update_index > 1)
                printf( '<a href="%s" class="button-primary">%s</a>', admin_url( 'themes.php?page=install-required-plugins&plugin_status=update' ), __( "Click here to update plugins all together.", 'homemarket' ) );
            ?><br><br>
        </p>
        <?php endif; ?>

        <div class="homemarket-install-plugins">
            <div class="feature-section theme-browser rendered">
                <?php foreach ( $plugins as $plugin ) : ?>
                    <?php
                    $class = '';
                    $plugin_status = '';
                    $file_path = $plugin['file_path'];
                    $plugin_action = $this->plugin_link( $plugin );

                    if ( is_plugin_active( $file_path ) ) {
                        $plugin_status = 'active';
                        $class = 'active';
                    }
                    ?>
                    <p class="after"></p>
                    <div class="theme <?php echo $class; ?>">   
                        <div class="theme-wrapper">
                            <div class="theme-screenshot">
                                <img src="<?php echo $plugin['image_url']; ?>" alt="" />
                                <div class="plugin-info">
                                    <?php if ( isset( $installed_plugins[ $plugin['file_path'] ] ) ) : ?>
                                        <?php printf( __( 'Version: %1s', 'homemarket' ), $installed_plugins[ $plugin['file_path'] ]['Version'] ); ?>
                                    <?php elseif ( 'bundled' == $plugin['source_type'] ) : ?>
                                        <?php printf( esc_attr__( 'Available Version: %s', 'homemarket' ), $plugin['version'] ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <h3 class="theme-name">
                                <?php if ( 'active' == $plugin_status ) : ?>
                                    <span><?php printf( __( 'Active: %s', 'homemarket' ), $plugin['name'] ); ?></span>
                                <?php else : ?>
                                    <?php echo $plugin['name']; ?>
                                <?php endif; ?>
                            </h3>
                            <div class="theme-actions">
                                <?php foreach ( $plugin_action as $action ) { echo $action; } ?>
                            </div>
                            <?php if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) : ?>
                                <div class="theme-update">
                                    <?php printf( __( 'Update Available: Version %s', 'homemarket' ), $plugin['version'] ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( isset( $plugin['required'] ) && $plugin['required'] ) : ?>
                                <div class="plugin-required">
                                    <?php esc_html_e( 'Required', 'homemarket' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="homemarket-demo-import-section">
    
        <?php
            $import_ready = true;
            $plugins_required = true;

            foreach ( $plugins as $plugin ) {
                if ( !$plugin['required'] ) continue;
                
                $plugin_path = $plugin['file_path'];
                if ( !is_plugin_active( $plugin_path ) ) {
                    $plugins_required = false;
                    break;
                }
            }

            $memory_limit = intval(substr( ini_get('memory_limit'), 0, -1 ));
            if ( $memory_limit < 256 ) $import_ready = false;
            $execution_time = intval(ini_get( 'max_execution_time' ));
            if ( $execution_time < 30 ) $import_ready = false;
            $upload_size = intval(substr(size_format( wp_max_upload_size() ), 0, -1));
            if ( $upload_size < 12 ) $import_ready = false;

            if ( ! (function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) ) {
                $import_ready = false;
                $fsockopen = true;
            }

            $posting['gzip']['name'] = 'GZip';
            if ( !is_callable( 'gzopen' ) ) {
                $import_ready = false;
            }

            // WP Remote Get Check
            $posting['wp_remote_get']['name'] = __( 'Remote Get', 'homemarket');
            $response = wp_safe_remote_get( 'http://www.woothemes.com/wc-api/product-key-api?request=ping&network=' . ( is_multisite() ? '1' : '0' ) );

            if ( !( !is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) )
            {
                $import_ready = false;
            }

            if (!ini_get('allow_url_fopen')) {
                $import_ready = false;
            }
        ?>

        <h2><?php _e( 'Demo Import', 'homemarket' ) ?></h2>
        <div class="import-header-section">
            <a href="#demo_tab" class="demo-tab-switch active" id="demo_toggle"><?php echo __( 'Importer', 'homemarket' ); ?></a>
            <a href="#status_tab" class="demo-tab-switch <?php if (!$import_ready || !$plugins_required) echo "error"; ?>" id="status_toggle">
                <?php if (!$import_ready || !$plugins_required): ?><span class="dashicons dashicons-warning"></span>&nbsp;&nbsp;<?php endif; ?><?php echo __( 'System Status', 'homemarket' ); ?>
            </a>
            <div class="clear"></div>
        </div>

        <div id="demo_tab" class="demo-tab theme-browser rendered">

            <div id="homemarket-install-options" style="display: none;">
                <h3><?php _e('Install Options', 'homemarket') ?></h3>
                <label for="homemarket-import-options"><input type="checkbox" id="homemarket-import-options" value="1" checked="checked"/> <?php _e('Import theme options', 'homemarket') ?></label>
                <input type="hidden" id="homemarket-install-demo-type" value="landing"/>
                <label for="homemarket-reset-menus"><input type="checkbox" id="homemarket-reset-menus" value="1" checked="checked"/> <?php _e('Reset menus', 'homemarket') ?></label>
                <label for="homemarket-reset-widgets"><input type="checkbox" id="homemarket-reset-widgets" value="1" checked="checked"/> <?php _e('Reset widgets', 'homemarket') ?></label>
                <label for="homemarket-import-dummy"><input type="checkbox" id="homemarket-import-dummy" value="1" checked="checked"/> <?php _e('Import dummy content', 'homemarket') ?></label>
                <label for="homemarket-import-widgets"><input type="checkbox" id="homemarket-import-widgets" value="1" checked="checked"/> <?php _e('Import widgets', 'homemarket') ?></label>
                <p><?php _e('Do you want to install demo? It can also take a minute to complete.', 'homemarket') ?></p>
                <button class="button button-primary" id="homemarket-import-yes"><?php _e('Yes', 'homemarket') ?></button>
                <button class="button" id="homemarket-import-no"><?php _e('No', 'homemarket') ?></button>
            </div>

            <div id="import-status"></div>

            <div class="import-success importer-notice" style="display: none;">
                <p>
                    <?php echo ('The demo content has been imported successfully. <a href="'.site_url().'" target="_blank"> View Site</a>'); ?> 
                </p>
            </div>

            <div class="import-error import-failed" style="display: none;">
                <p><span class="dashicons dashicons-warning"></span>&nbsp;&nbsp;<?php _e( 'The demo importing process failed. Please check the <a href="javascript:void(0)" class="system-status-toggle">System Status</a>. It should help you understand if some of the requirements aren’t met. ', 'homemarket' ); ?></p>
            </div>

            <?php if (!$import_ready): ?>
                <div class="import-error">
                    <p><span class="dashicons dashicons-warning"></span>&nbsp;&nbsp;<?php _e( 'Please check the <a href="javascript:void(0)" class="system-status-toggle">System Status</a> before importing the demo content to make sure the importing process won’t fail.', 'homemarket' ); ?></p>
                </div> 
            <?php endif; ?>

            <div class="import-demos-area">
                <div class="demo">
                    <?php foreach ( $demos as $demo => $demo_details ) : ?>
                        <div class="demo-screenshot">
                            <img src="<?php echo $demo_details['img']; ?>" alt="">
                            <div id="<?php echo $demo; ?>" class="demo-info">
                                <?php echo $demo_details['alt']; ?>
                            </div>
                            <div class="demo-actions">
                                <?php printf( '<a class="button button-primary homemarket-install-demo-button" data-demo-id="%s" href="#">%s</a>', strtolower( $demo ), __( 'Install', 'homemarket' ) ); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (!$plugins_required): ?>
                        <div class="demo-disabled">
                            <?php echo __("Install the <strong>Required Plugins</strong> above<br/> before importing the demo content.", "homemarket"); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="demo-import-loader preview-all"></div>
                    
                    <div class="demo-import-loader preview-default"><i class="dashicons dashicons-admin-generic"></i></div>
                </div>
            </div>
        </div>

        <!-- Staging Demo Checklist -->
        <div id="status_tab" class="demo-tab status-holder">
            <table class="demo-import-status" cellspacing="0">
                <thead>
                    <tr>
                        <td><?php _e( 'Required Plugins', 'homemarket' ) ?></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach( $plugins as $plugin ):
                            if ( !$plugin['required'] ) continue;
                            $plugin_path = $plugin['file_path'];
                            $active = is_plugin_active( $plugin_path );
                    ?>

                    <tr>
                        <td><?php echo $plugin['name']; ?></td>
                        <td>
                            <?php
                                if ( $active ):
                                    echo '<mark class="activated"><span class="dashicons dashicons-yes"></span></mark>';
                                else:
                                    echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ';
                                    _e('<span>Not installed/activated.</span>', 'homemarket');
                                    echo '</mark>';  
                                endif;
                            ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

            <table class="demo-import-status" cellspacing="0">
                <thead>
                    <tr>
                        <td><?php _e( 'Server Environment', 'homemarket' ); ?></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( function_exists( 'ini_get' ) ) : ?>
                        <tr>
                            <td data-export-label="Server Memory Limit">
                                <?php _e( 'Server Memory Limit', 'homemarket' ); ?>:
                            </td>
                            <td>
                                <?php
                                    $mark = $memory_limit >= 256 ? 'activated' : 'error';
                                ?>

                                <?php if ( $mark == 'activated' ) : ?>
                                    <mark class="<?php echo $mark; ?>">
                                            <span class="dashicons dashicons-yes"></span><?php echo ini_get('memory_limit'); ?>
                                    </mark>
                                <?php else: ?>
                                    <mark class="<?php echo $mark; ?>">
                                            <span class="dashicons dashicons-warning"></span>  <span><?php echo ini_get('memory_limit'); ?></span>. 
                                            <?php _e('The recommended value is 256M.', 'homemarket'); ?>
                                    </mark>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit', 'homemarket' ); ?>:</td>
                            <td>
                                <?php
                                    $mark = $execution_time >= 30 ? 'activated' : 'error'; 
                                ?>

                                <?php if ($mark == 'activated'): ?>
                                    <mark class="<?php echo $mark; ?>">
                                            <span class="dashicons dashicons-yes"></span><?php echo ini_get('max_execution_time'); ?>
                                    </mark>
                                <?php else: ?>
                                    <mark class="<?php echo $mark; ?>">
                                            <span class="dashicons dashicons-warning"></span>  <span><?php echo ini_get('max_execution_time'); ?></span>. 
                                            <?php _e('The recommended value is 30.', 'homemarket'); ?>
                                    </mark>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size', 'homemarket' ); ?>:</td>
                        <td>
                            <?php

                                $mark = $upload_size >= 12 ? 'activated' : 'error'; 
                            ?>

                            <?php if ($mark == 'activated'): ?>
                                <mark class="<?php echo $mark; ?>">
                                        <span class="dashicons dashicons-yes"></span><?php echo size_format( wp_max_upload_size() ); ?>
                                </mark>
                            <?php else: ?>
                                <mark class="<?php echo $mark; ?>">
                                        <span class="dashicons dashicons-warning"></span>  <span><?php echo size_format( wp_max_upload_size() ); ?></span>. 
                                        <?php _e('The recommended value is 12M.', 'homemarket'); ?>
                                </mark>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                        $posting = array();

                        // fsockopen/cURL
                        $posting['fsockopen_curl']['name'] = 'fsockopen/cURL';
                        $posting['fsockopen_curl']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Payment gateways can use cURL to communicate with remote servers to authorize payments, other plugins may also use it when communicating with remote services.', 'homemarket' ) . '">[?]</a>';

                        if (  (function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) ) {
                            $posting['fsockopen_curl']['success'] = true;
                        } else {
                            $posting['fsockopen_curl']['success'] = false;
                            $posting['fsockopen_curl']['note']    = 'Disabled.';
                        }

                        // GZIP
                        $posting['gzip']['name'] = 'GZip';
                        
                        if ( is_callable( 'gzopen' ) ) {
                            $posting['gzip']['success'] = true;
                        } else {
                            $posting['gzip']['success'] = false;
                            $posting['gzip']['note']    = 'Disabled.';
                        }

                        // WP Remote Get Check
                        $posting['wp_remote_get']['name'] = __( 'Remote Get', 'homemarket');
                        $response = wp_safe_remote_get( 'http://www.woothemes.com/wc-api/product-key-api?request=ping&network=' . ( is_multisite() ? '1' : '0' ) );

                        if (  !is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
                            $posting['wp_remote_get']['success'] = true;
                        } else {
                            $posting['wp_remote_get']['note']    = 'Disabled.';
                            
                            $posting['wp_remote_get']['success'] = false;
                        }

                        // allow url fopen
                        $posting['fopen']['name'] = __('Remote file open', 'homemarket');

                        if (ini_get('allow_url_fopen'))
                        {
                            $posting['fopen']['success'] = true;
                        }
                        else
                        {
                            $posting['fopen']['note']    = 'Disabled.';
                            $posting['fopen']['success'] = false;
                        }

                        $posting = apply_filters( 'woocommerce_debug_posting', $posting );

                        foreach ( $posting as $post ) {
                            $mark = ! empty( $post['success'] ) ? 'activated' : 'error';
                            ?>
                            <tr>
                                <td data-export-label="<?php echo esc_html( $post['name'] ); ?>"><?php echo esc_html( $post['name'] ); ?>:</td>
                                <td>
                                    <mark class="<?php echo $mark; ?>">
                                        <?php echo ! empty( $post['success'] ) ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-warning"></span>'; ?> 
                                        <span><?php echo ! empty( $post['note'] ) ? esc_html__( $post['note'], 'homemarket' ) : ''; ?></span>
                                    </mark>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
/**
* Plugin Name: SP Custom Post Widget
* Plugin URI: https://wordpress.org/plugins/sp-custom-post-widget/
* Description: This plugin helps you showcase your posts from the specified post type in a native wordpress widgets.
* Author: Sulav Parajuli
* Author URI:  https://www.facebook.com/sulav2059
* Version: 1.0.0
* License: GPLv2 or later
*/

//exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
//plugin path url
if ( ! defined( 'SPCPWLINK_PLUGIN_PATH' ) ) {
  define('SPCPWLINK_PLUGIN_PATH', plugins_url('/', __FILE__));
}
//plugin dir path
if ( ! defined( 'SPCPWPATH_PLUGIN_DIR' ) ) {
  define( 'SPCPWPATH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

require_once ('inc/sp-scripts-widget.php');
// Register Widget
function register_spspwidget(){
  register_widget('SPSPSP_Widget_Custom');
}
// Hook in function
add_action('widgets_init', 'register_spspwidget');
function spspsp_new_excerpt_length($length) {
    return 10;
}
add_filter('excerpt_length', 'spspsp_new_excerpt_length');
?>
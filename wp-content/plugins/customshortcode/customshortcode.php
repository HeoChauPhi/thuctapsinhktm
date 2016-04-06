<?php
/**
 * Plugin Name: Custom ShortCode
 * Plugin URI: http://heochaua.tk
 * Description: Custom ShortCode
 * Version: 1.0
 * Author: HeoChauA
 * Author URI: http://heochaua.tk
 * License: GPLv2
 */

$custom_path = dirname(__FILE__).'/';
include ($custom_path.'custom-function.php');
include ($custom_path.'shortcode-template/postshortcode.php');
include ($custom_path.'shortcode-template/postslide.php');
include ($custom_path.'shortcode-template/usershortcode.php');

// Add Jquery and Stylesheet
add_action('wp_enqueue_scripts', 'customs_plugin_scripts');
function customs_plugin_scripts() {
  wp_register_script('slick', plugin_dir_url( __FILE__ ) . 'scripts/libs/slick.min.js', array('jquery')); // Custom scripts
  wp_enqueue_script('slick'); // Enqueue it!

  wp_register_script('colorbox', plugin_dir_url( __FILE__ ) . 'scripts/libs/jquery.colorbox.js', array('jquery')); // Custom scripts
  wp_enqueue_script('colorbox'); // Enqueue it!

  wp_register_script('customscripts', plugin_dir_url( __FILE__ ) . 'scripts/customscripts.js', array('jquery')); // Custom scripts
  wp_enqueue_script('customscripts'); // Enqueue it!
}

add_action('wp_enqueue_scripts', 'customs_plugin_styles');
function customs_plugin_styles() {
  wp_register_style('slick-style', plugin_dir_url( __FILE__ ) .'stylesheet/libs/slick.min.css', array(), 'all');
  wp_enqueue_style('slick-style');
}

add_action( 'admin_head', 'customs_plugin_admin_scripts' );

function customs_plugin_admin_scripts() {
  echo '<script type="text/javascript" src="' . plugin_dir_url( __FILE__ ) . 'scripts/admin-script.js"></script>';
}

// Add Custom Shortcode
add_shortcode( 'count_per_day', 'create_count_per_day' );
function create_count_per_day() {
  /*extract(shortcode_atts (array(
    'cat_id'       => '',
    'per_page'    => ''
  ), $cats));

  http://www.tomsdimension.de/wp-plugins/count-per-day#readme-arbitrary */
  ob_start();
    echo '<ul>';
    echo '<li><span>Tổng số truy cập:</span>' . do_shortcode("[CPD_READS_TOTAL]") . '</li>';
    echo '<li><span>Truy cập hôm nay:</span>' . do_shortcode("[CPD_READS_TODAY]") . '</li>';
    echo '<li><span>Truy cập hôm qua:</span>' . do_shortcode("[CPD_READS_YESTERDAY]") . '</li>';
    echo '<li><span>Truy cập tuần trước:</span>' . do_shortcode("[CPD_READS_LAST_WEEK]") . '</li>';
    echo '<li><span>Số người đang online:</span>' . do_shortcode("[CPD_VISITORS_ONLINE]") . '</li>';
    $count_perday = ob_get_contents();
  ob_end_clean();
  return $count_perday;
  wp_reset_postdata();
}

// Add Post shortcode
add_shortcode( 'view_post_cat', 'create_view_post_cat' );

add_shortcode( 'view_cat', 'create_view_cat' );

add_shortcode( 'view_all_post', 'create_view_all_post' );

// Add Slide Shortcode
add_shortcode( 'gallery_slider', 'create_gallery_slider' );

// Quan tri thanh vien

add_shortcode( 'code_ctv', 'create_code_ctv' );

add_shortcode( 'list_product', 'create_list_product' );

add_shortcode( 'quantri_thanhvien', 'create_quantri_thanhvien' );

add_shortcode( 'permission_quantri', 'create_permission_quantri' );

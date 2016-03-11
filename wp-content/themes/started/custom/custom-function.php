<?php
/*
 *  Author: HeoChauA
 *  URL: heochaua.tk
 *  Custom functions, support, custom post types and more.
 */

// Varial option framework
function get_path_option_file() {
  $template_dir_customtheme = "/custom/option-framework/";

  return apply_filters( 'path_option_file', $template_dir_customtheme );
}
function get_path_option() {
  $template_dir_customtheme = get_template_directory_uri() ."/custom/option-framework/option-themes";

  return apply_filters( 'path_option', $template_dir_customtheme );
}
function get_path_img() {
  $template_dir_customtheme = get_template_directory_uri() . "/custom/framework-assets/images";

  return apply_filters( 'path_img', $template_dir_customtheme );
}

// Them css va javascript vao giua the head
add_action( 'admin_head', 'showhiddencustomfields' );

function showhiddencustomfields() {
  // Add stylesheet
  echo "<link rel='stylesheet' type='text/css' href='" . get_path_option() . "/styles/admin-style.css'>";
}

add_action('wp_enqueue_scripts', 'customs_themes_scripts');
function customs_themes_scripts() {

  wp_register_script('equalheights', get_template_directory_uri() . '/custom/framework-assets/js/jquery.equalheights.js', array('jquery')); // Custom scripts
  wp_enqueue_script('equalheights'); // Enqueue it!

  wp_register_script('bootstrap', get_template_directory_uri() . '/custom/framework-assets/js/bootstrap.min.js', array('jquery')); // Custom scripts
  wp_enqueue_script('bootstrap'); // Enqueue it!

  wp_register_script('colorbox', get_template_directory_uri() . '/custom/framework-assets/js/jquery.colorbox.js', array('jquery')); // Custom scripts
  wp_enqueue_script('colorbox'); // Enqueue it!

  wp_register_script('frameword', get_template_directory_uri() . '/custom/framework-assets/js/frameword.js', array('jquery')); // enre script with version number
  wp_enqueue_script('frameword'); // Enqueue it!
}

add_action('wp_enqueue_scripts', 'customs_themes_styles');
function customs_themes_styles() {
  wp_register_style('started-custom-style', get_template_directory_uri().'/custom/styles/css/customs.css', array(), 'all');
  wp_enqueue_style('started-custom-style');
}

function remove_unused_image_size( $sizes) {
  unset( $sizes['medium']);
  unset( $sizes['large']);
  unset( $sizes['small']);
  unset( $sizes['custom-size']);
  return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_unused_image_size');

// If Dynamic Sidebar Exists

if (function_exists('register_sidebar'))
{
  // Define Only Sidebar
  register_sidebar(array(
    'name' => __('Only Sidebar', 'enre'),
    'description' => __('Description for this Only Sidebar', 'enre'),
    'id' => 'only-sidebar',
    'before_widget' => '<div id="%1$s" class="%2$s block-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="block-title">',
    'after_title' => '</h2>'
  ));
}
if (function_exists('register_sidebar'))
{
  // Define Only Sidebar
  register_sidebar(array(
    'name' => __('Footer Panel', 'enre'),
    'description' => __('Description for this Footer Panel', 'enre'),
    'id' => 'footer-panel',
    'before_widget' => '<div id="%1$s" class="%2$s block-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="block-title">',
    'after_title' => '</h2>'
  ));
}
if (function_exists('register_sidebar'))
{
  // Define Only Sidebar
  register_sidebar(array(
    'name' => __('Header', 'enre'),
    'description' => __('Description for this Header', 'enre'),
    'id' => 'header',
    'before_widget' => '<div id="%1$s" class="%2$s block-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="block-title">',
    'after_title' => '</h2>'
  ));
}

// bold, italic, underline, strikethrough, justifyleft, justifycenter, justifyright, justifyfull, bullist, numlist, outdent, indent, cut, copy, paste, undo, redo, link, unlink, image, cleanup, help, code, hr, removeformat, formatselect, fontselect, fontsizeselect, styleselect, sub, sup, forecolor, backcolor, charmap, visualaid, anchor, newdocument, separator
function enable_more_buttons($buttons) {
  $buttons[] = 'bold';
  $buttons[] = 'italic';
  $buttons[] = 'underline';
  $buttons[] = 'strikethrough';
  $buttons[] = 'justifyleft';
  $buttons[] = 'justifycenter';
  $buttons[] = 'justifyright';
  $buttons[] = 'justifyfull';
  $buttons[] = 'bullist';
  $buttons[] = 'numlist';
  $buttons[] = 'outdent';
  $buttons[] = 'indent';
  $buttons[] = 'cut';
  $buttons[] = 'copy';
  $buttons[] = 'paste';
  $buttons[] = 'undo';
  $buttons[] = 'redo';
  $buttons[] = 'link';
  $buttons[] = 'unlink';
  $buttons[] = 'cleanup';
  $buttons[] = 'help';
  $buttons[] = 'code';
  $buttons[] = 'hr';
  $buttons[] = 'removeformat';
  $buttons[] = 'formatselect';
  $buttons[] = 'fontselect';
  $buttons[] = 'fontsizeselect';
  $buttons[] = 'styleselect';
  $buttons[] = 'sub';
  $buttons[] = 'sup';
  $buttons[] = 'forecolor';
  $buttons[] = 'backcolor';
  $buttons[] = 'charmap';
  $buttons[] = 'visualaid';
  $buttons[] = 'anchor';
  $buttons[] = 'newdocument';
  $buttons[] = 'separator';

  return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");

// Theme option
/*require_once('option-framework/functions-vafpress.php');

function theme_option( $name )
{
  return vp_option( "frameworrk_option." . $name );
}*/

/* This example syncs both UM / WP role during user approval */

add_action('um_after_user_is_approved', 'sync_um_and_wp_role', 99 );
function sync_um_and_wp_role( $user_id ) {

    // Get UM role
    $role = get_user_meta( $user_id, 'role', true );

  if ( $role == 'Member' ) {
    $wp_user_object = new WP_User( $user_id );
    $wp_user_object->set_role( 'subscriber');
  }

  if ( $role == 'CongTacVien' ) {
    $wp_user_object = new WP_User( $user_id );
    $wp_user_object->set_role( 'contributor');
  }
}

// Custom menu
function custom_nav()
{
  wp_nav_menu(
  array(
    'theme_location'  => 'custom-menu',
    'menu'            => '',
    'container'       => 'div',
    'container_class' => 'menu-{menu slug}-container',
    'container_id'    => '',
    'menu_class'      => 'menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul>%3$s</ul>',
    'depth'           => 0,
    'walker'          => ''
    )
  );
}

function register_custom_menu()
{
    register_nav_menus(array(
        'custom-menu' => __('Custom Menu', 'started')
    ));
}
add_action('init', 'register_custom_menu');

?>

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

add_shortcode( 'view_post_cat', 'create_view_post_cat' );
function create_view_post_cat($cats) {
  extract(shortcode_atts (array(
    'taxonomy'  		=> 'category',
    'orderby'       => 'name',
    'show_count'    => 0,
    'pad_counts'    => 0,
    'hierarchical'	=> 1,
    'title'        	=> '',
    'empty'        	=> 0,
    'cat_id'        => '',
  ), $cats));
  ob_start();
    echo '<div class="block-list-post-cat">';
    if($cat->category_parent == 0)
    {
      $args = array(
      'taxonomy'      => $taxonomy,
      'child_of'      => 0,
      'parent'        => $cat_id,
      'orderby'       => $orderby,
      'show_count'    => $show_count,
      'pad_counts'    => $pad_counts,
      'hierarchical'  => $hierarchical,
      'title_li'      => $title,
      'hide_empty'    => $empty

      );
      $sub_cats = get_categories( $args );
      if($sub_cats)
      {
        foreach($sub_cats as $sub_category)
        {
          echo "<div class='post-cat-item " . $sub_category->slug ."'>";
          if($sub_cats->$sub_category == 0)
          { ?>
            <h3 class='post-cat-title'>
              <a href="<?php echo get_category_link( $sub_category->term_id ); ?>" title="<?php echo $sub_category->cat_name; ?>">
                <?php echo $sub_category->cat_name; ?>
              </a>
            </h3>
            <?php

            $sticky = get_option( 'sticky_posts' );
            $args1 = array(
              'post_type'           => 'post',
              'posts_per_page'      => 1,
              'post__in'            => $sticky,
              'ignore_sticky_posts' => 1,
              'cat'                 => $sub_category->term_id
            );
            $loop1 = new WP_Query( $args1 );
            while ($loop1->have_posts()) : $loop1->the_post(); ?>
              <div class="post-cat-sticky">
                <div class="post-cat-img">
                 <?php echo get_the_post_thumbnail( ); ?>
                </div>
                <div class="post-cat-content">
                  <h4 class="post-cat-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <p class="post-cat-text"><?php echo wp_trim_words(get_the_content(), 30); ?></p>
                </div>
              </div>
            <?php endwhile;
            wp_reset_query();

            $args2 = array(
              'post_type'       => 'post',
              'cat'             => $sub_category->term_id,
              'posts_per_page'  => 6,
              'post__not_in'    => $sticky
            ); ?>
            <div class="post-cat-other"><ul>
            <?php
            $loop2 = new WP_Query( $args2 );
            while ($loop2->have_posts()) : $loop2->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile;
            wp_reset_query(); ?>
            </ul></div>
          <?php
          }
          echo "</div>";
        }
      }
    }
    echo '</div>';
    $list_post = ob_get_contents();
  ob_end_clean();
  return $list_post;
  wp_reset_postdata();
}

add_shortcode( 'view_cat', 'create_view_cat' );
function create_view_cat($cats) {
  extract(shortcode_atts (array(
    'cat_id'       => '',
    'child_of'     => 0,
    'hide_empty'   => 0,
    'hierarchical' => 1,
    'show_count'   => 0,
    'pad_counts'   => 0,
  ), $cats));

  $args = array (
    'parent'       => $cat_id,
    'child_of'     => 0,
    'hide_empty'   => 0,
    'hierarchical' => 1,
    'show_count'   => 0,
    'pad_counts'   => 0,
  );
  $categories =  get_categories($args);
  ob_start();
    echo '<div class="block-cat block-show-ct"><ul class="cat-list-home">';
      foreach ($categories as $category) : ?>
        <li class="cat-item">
            <a class="cat-parent" href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>">
                <?php echo $category->name; ?>
            </a>
            <ul class="sub-cat clearfix">
            <?php
              $args2 = array (
                'parent'       => $category->term_id,
                'child_of'     => 0,
                'hide_empty'   => 0,
                'hierarchical' => 1,
                'show_count'   => 0,
                'pad_counts'   => 0,
              );

              $subcategories =  get_categories($args2);
              foreach ($subcategories as $subcategory) : ?>
              <li>
                <div class="cat-detail">
                  <div class="cat-detail__image">
                    <a class="sub-cat-image" href="<?php echo get_category_link( $subcategory->term_id ); ?>" title="<?php echo $subcategory->name; ?>">
                      <img class="cat-image" src="<?php echo z_taxonomy_image_url($subcategory->term_id); ?>" />
                    </a>
                  </div>
                  <div class="cat-detail__title">
                    <a href="<?php echo get_category_link( $subcategory->term_id ); ?>" title="<?php echo $subcategory->name; ?>">
                      <?php echo $subcategory->name; ?>
                    </a>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
            </ul>
        </li>
      <?php
      endforeach;
    echo '</ul></div>';
    $list_cat = ob_get_contents();
  ob_end_clean();
  return $list_cat;
  wp_reset_postdata();
}

add_shortcode( 'view_all_post', 'create_view_all_post' );
function create_view_all_post($cats) {
  extract(shortcode_atts (array(
    'cat_id'       => '',
    'per_page'    => ''
  ), $cats));
  ob_start();
    echo '<ul>';
    global $post;
    $args = array (
      'posts_per_page' => $per_page,
      'offset'=> 0,
      'category' => $cat_id
    );
    $myposts = get_posts( $args );
    foreach ( $myposts as $post ) :
      setup_postdata( $post ); ?>
      <?php if($per_page == 1 ) { ?>
        <li>
          <div class="post-image">
            <?php echo get_the_post_thumbnail( ); ?>
          </div>
          <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <div class="post-content">
            <?php echo wp_trim_words(get_the_content(), 30); ?>
          </div>
        </li>
      <?php } else { ?>
      <li>
      <div class="post-image">
        <?php echo get_the_post_thumbnail( ); ?>
      </div>
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </li>
      <?php } ?>
    <?php endforeach;
    wp_reset_postdata();
    echo '</ul>';
    $view_all_post = ob_get_contents();
  ob_end_clean();
  return $view_all_post;
  wp_reset_postdata();
}

add_shortcode( 'gallery_slider', 'create_gallery_slider' );
function create_gallery_slider($attrs) {
  extract(shortcode_atts (array(
    'post_type' => 'video',
    'per_page' => 4,
  ), $attrs));

  ob_start();
    $args=array(
      'post_type' => $post_type,
      'post_status' => 'publish',
      'posts_per_page' => $per_page
    );

    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) { ?>
    <div class="video-event-list">
      <div class="main-slick">
      <?php 
      while ($my_query->have_posts()) : $my_query->the_post();

      $video_type = types_render_field("video", array());
      preg_match('/src="(.+?)"/', $video_type, $matches);

      $video_url = $matches[1];

      $image_url = parse_url($video_url);
      if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
        $vimeo_has_id = substr($image_url['path'], 1);
        $vimeo_get_id = explode('/', $vimeo_has_id);
        $vimeoid = array_pop($vimeo_get_id);
        $video_url = 'https://player.vimeo.com/video/'.$vimeoid;
      } else {
        $video_url = $matches[1];
      }

      $image_path = video_image($video_url);
      ?>

      <div class="video-event-item item" style="background-image: url('<?php echo $image_path; ?>')">
        <a class="video-colorbox" href="<?php echo $video_url; ?>"><img src="<?php echo $image_path; ?>"></a>
      </div>


      <?php
      endwhile;
      ?>
      </div>
      
      <div class="sub-slick">
      <?php 
      while ($my_query->have_posts()) : $my_query->the_post();

      $video_type = types_render_field("video", array());
      preg_match('/src="(.+?)"/', $video_type, $matches);

      $video_url = $matches[1];

      $image_url = parse_url($video_url);
      if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
        $vimeo_has_id = substr($image_url['path'], 1);
        $vimeo_get_id = explode('/', $vimeo_has_id);
        $vimeoid = array_pop($vimeo_get_id);
        $video_url = 'https://player.vimeo.com/video/'.$vimeoid;
      } else {
        $video_url = $matches[1];
      }

      $image_path = video_image($video_url);
      ?>

      <div class="video-event-subitem" style="background-image: url('<?php echo $image_path; ?>')">
        <img src="<?php echo $image_path; ?>">
      </div>


      <?php
      endwhile;
      ?>
      </div>
      </div>


      <?php 
    }

    $gallery_slider = ob_get_contents();
  ob_end_clean();
  return $gallery_slider;
  wp_reset_postdata();
}

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

// Quan tri thanh vien

add_shortcode( 'code_ctv', 'create_code_ctv' );
function create_code_ctv($showlink) {
  ob_start();
    echo '<div class="block-code-ctv">';
    $current_user = wp_get_current_user();
    $url = site_url( '/quan-tri-thanh-vien/');
    $role = get_user_meta( wp_get_current_user()->ID, 'role', true );
    if ($role != 'admin') {
      echo '<p><span>Mã cộng tác viên của bạn là: </span><strong> CTV-'. $current_user->ID . '</strong></p>';
      if ($showlink['show_link'] == "show"){
        echo '<p><a href="'. $url .'" target="_blank">Đến trang quản trị thành viên</a></p>';
      }
    }
    echo '</div>';
    $code_ctv = ob_get_contents();
  ob_end_clean();
  return $code_ctv;
  wp_reset_postdata();
}

add_shortcode( 'list_product', 'create_list_product' );
function create_list_product() {
  ob_start();
    $current_user = 'CTV-'.wp_get_current_user()->ID;
    $role = get_user_meta( wp_get_current_user()->ID, 'role', true );

    echo '<div class="block-product"><h2 class="block-title">Lựa chọn chương trình</h2><ul class="tabs">';
    foreach( get_users_by_meta_data( 'role', 'member' ) as $child_user ) {
      if ($child_user->code == $current_user || $role == 'admin') {
        $products = str_language($child_user->product);

        echo '<li><a href="#'.$products.'">'.$child_user->product.'</li>';
      }
    }
    echo '</ul><p><a href="register/" target="_blank">Thêm học viên</a></p></div>';
    $list_product = ob_get_contents();
  ob_end_clean();
  return $list_product;
  wp_reset_postdata();
}

add_shortcode( 'quantri_thanhvien', 'create_quantri_thanhvien' );
function create_quantri_thanhvien() {
  ob_start();

    $role = get_user_meta( wp_get_current_user()->ID, 'role', true );
    if ($role == 'admin') {
      $args1 = array(
        'role' => 'contributor',
      );
      $contributor = get_users($args1);
        foreach ($contributor as $user) {
          $child_role1 = get_users($args2);
          echo '<div class="ctv-thanhvien">'; ?>
            <h3><a href="<?php echo site_url( '/user/'.$user->user_login); ?>" target="_blank"><?php echo  $user->display_name; ?></a></h3>
            <?php foreach( get_users_by_meta_data( 'code', 'CTV-'.$user->ID ) as $childuser ) { ?>
              <table class="table quantrithanhvien">
                <thead>
                  <tr class="active">
                    <th class="hoten">Họ tên</th>
                    <th class="cmnd">Số CMND</th>
                    <th class="email">Email</th>
                    <th class="phone">Số điện thoại</th>
                    <th class="address">Quê quán</th>
                    <th class="tientrinh">Tiến trình</th>
                    <th class="thanhtoan">Thanh toán</th>
                  </tr>
                </thead>

                <tbody id="table-content">
                <tr>
                  <td class="name_student"><a href="<?php echo site_url( '/user/'.$childuser->user_login); ?>" target="_blank"><?php echo $childuser->display_name; ?></a></td>
                  <td><?php echo $childuser->cmnd_thanhvien; ?></td>
                  <td><?php echo $childuser->email_thanhvien; ?></td>
                  <td><?php echo $childuser->sodienthoai; ?></td>
                  <td><?php echo $childuser->noisinh; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                </tbody>

              </table>
            <?php } // end foreach
          echo '</div>';
        }
    }

    $current_user = wp_get_current_user(); ?>
    <?php foreach( get_users_by_meta_data( 'code', 'CTV-'.$current_user->ID ) as $child_user ) {
      $products = str_language($child_user->product);
      if (empty($child_user->tientrinh1)) {
        $tientrinh = 'Chưa hoàn thiện';
      } else {
        $tientrinh = $child_user->tientrinh1;
      }
      if (empty($child_user->thanhtoan)) {
        $thanhtoan = 'Chưa thanh toán';
      } else {
        $thanhtoan = $child_user->thanhtoan;
      }
    ?>
    <div id="<?php echo $products; ?>">
    <h3 colspan="7"><?php echo $child_user->product; ?></h3>
    <table class="table quantrithanhvien">
      <thead>
        <tr class="active">
          <th class="hoten">Họ tên</th>
          <th class="cmnd">Số CMND</th>
          <th class="email">Email</th>
          <th class="phone">Số điện thoại</th>
          <th class="address">Quê quán</th>
          <th class="tientrinh">Tiến trình</th>
          <th class="thanhtoan">Thanh toán</th>
        </tr>
      </thead>

      <tbody id="table-content">
      <tr>
        <td class="name_student"><a href="<?php echo site_url( '/user/'.$child_user->user_login); ?>" target="_blank"><?php echo $child_user->display_name; ?></a></td>
        <td><?php echo $child_user->cmnd_thanhvien; ?></td>
        <td><?php echo $child_user->email_thanhvien; ?></td>
        <td><?php echo $child_user->sodienthoai; ?></td>
        <td><?php echo $child_user->noisinh; ?></td>
        <td><?php echo $tientrinh; ?></td>
        <td><?php echo $thanhtoan; ?></td>
      </tr>
      </tbody>

    </table></div>
    <?php } ?>
    <?php
    $quantri_thanhvien = ob_get_contents();
  ob_end_clean();
  return $quantri_thanhvien;
  wp_reset_postdata();
}

add_shortcode( 'permission_quantri', 'create_permission_quantri' );
function create_permission_quantri() {
  ob_start();
    // get current ctv
    $current_ctv = 'CTV-'.wp_get_current_user()->ID;

    // get current user
    $uri = $_SERVER['REQUEST_URI'];
    $uri_replace = str_replace('/', ' ', $uri);
    $uri_trim = explode(" ",trim($uri_replace));
    $current_user = end($uri_trim);

      //print_r($uri_trim);
    //echo $uri_trim;
    $check_edit = '?profiletab=main&um_action=edit';
    if ($current_user == $check_edit) {
      $uri_change = array_pop ($uri_trim);
      //print_r($uri_trim);
      $current_user = end($uri_trim);
    }

    // get current code ctv of user
    $the_user = get_user_by('login', $current_user);
    $the_user_id = $the_user->ID;
    $key = 'code';
    $single = true;
    $code_ctv = get_user_meta( $the_user_id, $key, $single );
    $ctv = get_user_meta( $the_user_id, 'role', $single );

    $role = get_user_meta( wp_get_current_user()->ID, 'role', $single );

    //echo $current_user;


    if ($current_ctv == $code_ctv || $role == 'member' || $role == 'admin') {
      echo do_shortcode("[ultimatemember form_id=116]");
    } elseif ($ctv == 'congtacvien' && $role == 'congtacvien') {
      echo do_shortcode("[ultimatemember form_id=260]");
    } else {
      echo '<h5 style="color: red;">Bạn không có quyền xem thành viên này!</h5>';
    }
    $permission_quantri = ob_get_contents();
  ob_end_clean();
  return $permission_quantri;
  wp_reset_postdata();
}

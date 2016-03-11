<?php
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
?>
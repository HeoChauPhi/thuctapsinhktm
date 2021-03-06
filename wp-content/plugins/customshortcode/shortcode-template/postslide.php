<?php
function create_gallery_slider($attrs) {
  extract(shortcode_atts (array(
    'posttype' => '',
    'per_page' => ''
  ), $attrs));

  ob_start();
    $args=array(
      'post_type' => $posttype,
      'post_status' => 'publish',
      'posts_per_page' => $per_page
    );

    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      if ($posttype == 'video') { ?>
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

      else if ($posttype == 'gallerys') {?>
        <div class="gallery-list">
          <div class="slide-carousel">
            <?php

            while ($my_query->have_posts()) : $my_query->the_post();
              $image_type = types_render_field("gallery-thumbnail", array()); ?>
              <div class="gallery-post">
                <div class="gallery-image">
                  <?php echo $image_type; ?>
                </div>
                <div class="gallery-content">
                  <div class="gallery-link"><a href="<?php the_permalink(); ?>">learn more</a></div>
                  <div  class="gallery-title"><?php the_title(); ?></div>
                </div>
              </div>
              <?php
            endwhile;
            ?>
          </div>
        </div>

      <?php
      } else if($posttype == 'student') { ?>
        <div class="gallery-list">
          <div class="slide-carousel">
            <?php

            while ($my_query->have_posts()) : $my_query->the_post();
              $student_img = types_render_field("student-image", array()); ?>
              <div class="student-post">
                <div class="student-image">
                  <?php echo $student_img; ?>
                </div>
                <div class="student-content">
                  <div class="student-link"><a href="<?php the_permalink(); ?>">learn more</a></div>
                  <div  class="student-title"><?php the_title(); ?></div>
                </div>
              </div>
              <?php
            endwhile;
            ?>
          </div>
        </div>
      <?php
      }
    }

    $gallery_slider = ob_get_contents();
  ob_end_clean();
  return $gallery_slider;
  wp_reset_postdata();
}
?>

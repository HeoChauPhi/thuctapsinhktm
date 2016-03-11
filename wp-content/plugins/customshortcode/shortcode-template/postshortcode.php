<?php 
function create_view_post_cat($cats) {
  extract(shortcode_atts (array(
    'taxonomy'      => 'category',
    'orderby'       => 'name',
    'show_count'    => 0,
    'pad_counts'    => 0,
    'hierarchical'  => 1,
    'title'         => '',
    'empty'         => 0,
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
?>
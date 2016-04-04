<?php get_header(); ?>

  <main role="main">
  <!-- section -->
  <section>

  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <!-- post thumbnail -->
      <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <?php the_post_thumbnail(); // Fullsize image for the single post ?>
        </a>
      <?php endif; ?>
      <!-- /post thumbnail -->

      <!-- post title -->
      <h1>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      </h1>
      <!-- /post title -->

      <!-- post details -->
      <div class="submition">
      <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
      <span class="author"><?php _e( 'Published by', 'started' ); ?> <?php the_author_posts_link(); ?></span>
      <span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'started' ), __( '1 Comment', 'started' ), __( '% Comments', 'started' )); ?></span>
      </div>
      <!-- /post details -->
      <div class="post-content">
          <?php the_content(); // Dynamic Content ?>
      </div>
      <div class="post-category"><?php _e( 'Categorised in: ', 'started' ); the_category(', '); // Separated by commas ?></div>

      <?php edit_post_link(); // Always handy to have Edit Post Links available ?>

    </article>
    <!-- /article -->
    <?php comments_template(); ?>

  <?php endwhile; ?>

  <?php else: ?>

    <!-- article -->
    <article>

      <h1><?php _e( 'Sorry, nothing to display.', 'started' ); ?></h1>

    </article>
    <!-- /article -->

  <?php endif; ?>

  </section>
  <!-- /section -->
  </main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

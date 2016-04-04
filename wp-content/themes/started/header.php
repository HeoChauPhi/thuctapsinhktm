<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
    <meta name="google-site-verification" content="PLAZi1jmc_JlAG6tnXBm_Dk7p6Re15WNrWuDWCCRfsY" />
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

    <!-- <div class="body-slider">
      <?php // echo do_shortcode("[rev_slider bodyslide]"); ?>
    </div> -->

		<!-- wrapper -->
		<div class="wrapper">

      <div class="header-top">
        <div class="container">
          <div class="header-top-left">
            <div class="block-top-menu">
              <?php custom_nav(); ?>
            </div>
          </div>

          <div class="header-top-right">
            <div class="block-language">
              <h2 class="block-title">Ngôn ngữ: </h2>
              <?php
                echo pll_the_languages( array(
                  'show_flags' => 1,
                  'show_names' => 0,
                  'hide_if_empty' => 0,
                  'echo' => 0,
                ));
              ?>
            </div>

            <div class="block-search">
              <!-- <span class="toggle-search open">toggle search</span> -->
              <div class="search-wrapper">
                <?php get_template_part('searchform'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>

			<!-- header -->
			<header class="header clear" role="banner">
				<div class="container">
          <div class="branding">
            <!-- logo -->
            <div class="logo">
              <a href="<?php echo home_url(); ?>">
                <!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" class="logo-img">
              </a>
            </div>
            <!-- /logo -->

            <div class="site-info">
              <p class="site-name"><?php echo get_bloginfo('name'); ?></p>
              <p class="site-title"><?php echo get_bloginfo( 'description' ); ?></p>
            </div>  
          </div>

          <div class="block-header">
            <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('header')) ?>
          </div>
				</div>
			</header>
			<!-- /header -->

      <!-- nav -->
      <div class="menubar">
        <div class="container">
          <nav class="nav" role="navigation">
              <?php started_nav(); ?>
          </nav>
        </div>
      </div>
      <!-- /nav -->

      <?php if ( is_front_page() ) { ?>
       <div class="feature">
          <div class="container">
            <?php echo do_shortcode("[advps-slideshow optset='1']"); ?>
          </div>
        </div>
      <?php } ?>

      <div class="main-content">
        <div class="container">

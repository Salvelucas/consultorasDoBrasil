<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

      <div id="page" class="hfeed site">
          <?php do_action( 'before' ); ?>

          <nav class="navbar navbar-inverse navbar-top-area">
              <div class="container">
                  <div class="row">
                      <div class="col-md-6 col-sm-5">
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top-collapse">
                                  <span class="sr-only"><?php _e( 'Toggle navigation', 'dokan' ); ?></span>
                                  <i class="fa fa-bars"></i>
                              </button>
                          </div>
                          <?php
                              wp_nav_menu( array(
                                  'theme_location'    => 'top-left',
                                  'depth'             => 0,
                                  'container'         => 'div',
                                  'container_class'   => 'collapse navbar-collapse navbar-top-collapse',
                                  'menu_class'        => 'nav navbar-nav',
                                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                  'walker'            => new wp_bootstrap_navwalker())
                              );
                          ?>
                      </div>

                      <div class="col-md-6 col-sm-7">
                          <div class="collapse navbar-collapse navbar-top-collapse">
                              <?php dokan_header_user_menu(); ?>
                          </div>
                      </div>
                  </div> <!-- .row -->
              </div> <!-- .container -->
          </nav>

          <header id="masthead" class="site-header" role="banner">
              <div class="container">
                  <div class="row">
                      <div class="col-md-4 col-sm-5">
                          <hgroup>
                              <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?> <small> - <?php bloginfo( 'description' ); ?></small></a></h1>
                          </hgroup>
                      </div><!-- .col-md-6 -->

                      <div class="col-md-8 col-sm-7 clearfix">
                          <?php dynamic_sidebar( 'sidebar-header' ) ?>
                      </div>
                  </div><!-- .row -->
              </div><!-- .container -->

              <div class="menu-container">
                  <div class="container">
                      <div class="row">
                          <div class="col-md-12">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location'    => 'primary',
                                    'container'         => 'div',
                                    'container_class'   => 'collapse navbar-collapse navbar-main-collapse',
                                    'menu_class'        => 'nav navbar-nav',
                                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                    'walker'            => new wp_bootstrap_navwalker())
                                );
                            ?>

                          </div><!-- .span12 -->
                      </div><!-- .row -->
                  </div><!-- .container -->
              </div> <!-- .menu-container -->
          </header><!-- #masthead .site-header -->

          <div id="main" class="site-main">
              <div class="container content-wrap">
                  <div class="row">

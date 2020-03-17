<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Videofire
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header class="header">

  <?php revideo_header_top();?>

    <div class="header-middle">
      <div class="container">
        <div class="row">

          <div class="col-sm-3">
            <div class="navbar-brand hidden-xs">
              <?php revideo_header_mobile_logo();?>
            </div>
          </div>

          <?php revideo_top_header_banner();?>

        </div>
      </div>
    </div><!-- /.header-middle -->

    <div class="header-bottom">
      <div class="container">
        <div class="nav-bg">
          <div class="row">
            <div class="col-sm-8">
              <nav class="navbar navbar-default">
                <div class="navbar-header visible-xs">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                  </button>
                  <?php revideo_header_logo();?>
                </div>

                <div id="menu" class="main-menu collapse navbar-collapse pull-left">

                  <?php
                       wp_nav_menu(array(
                          'theme_location'    => 'main-menu',
                          'depth'             => 3,
                          'container'         => 'ul',
                          'container_class'   => 'nav navbar-nav',
                          'menu_class'        => 'nav navbar-nav',
                          'container_id'      => 'menu',
                          'menu_id'           => 'main-menu',
                          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                          'walker'            => new wp_bootstrap_navwalker()
                          )
                      );

                    ?>

                </div><!-- /.navbar-collapse -->
              </nav><!-- /.navbar -->
            </div>

            <?php get_search_form();?>
          </div>
        </div>
      </div><!-- /.container -->
    </div><!-- /.header-bottom -->
  </header><!-- /.header -->


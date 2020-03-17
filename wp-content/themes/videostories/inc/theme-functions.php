<?php

/* Theme Options */

// Header Mobile Logo
function videostories_header_mobile_logo(){
    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ){
        the_custom_logo();
    }else { ?>
        <a class="logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_html( bloginfo( 'name' )); ?> - <?php esc_html(bloginfo( 'description' )); ?>">
            <?php esc_html(bloginfo( 'name' )); ?>
        </a>
        <p class="site-description"><?php esc_html(bloginfo( 'description' )); ?></p>
    <?php }
}

// Header Logo
function videostories_header_logo(){
    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ){
        the_custom_logo();
    }else { ?>
        <a class="logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_html(bloginfo( 'name' )); ?> - <?php esc_html(bloginfo( 'description' )); ?>">
            <?php esc_html(bloginfo( 'name' )); ?>
        </a>
        <p class="site-description"><?php esc_html(bloginfo( 'description' )); ?></p>
    <?php }
}


// Copyright Text
function videostories_copyrights_text(){
    $copyright_text = get_theme_mod( 'copyright_text' );

    if(!empty($copyright_text)){
        echo esc_html( $copyright_text );
    } elseif (is_home()  || is_front_page() || is_page()) {
        echo '&copy; ' . esc_attr( date('Y') ) . esc_html__( ' | Developed with ','videostories') . '<i class="fa fa-heart"></i> ' . esc_html__('by','videostories') . ' <a href="' . esc_url( 'https://prowptheme.com' ) . '" rel="nofollow">' . esc_html__('ProWPTheme','videostories') . '</a>';
    } else {
        echo '&copy; ' . esc_attr( date('Y') ) . esc_html__( ' | Developed with ','videostories') . '<i class="fa fa-heart"></i> ' . esc_html__('by ','videostories') . esc_html__('ProWPTheme','videostories');
    }
}



// Header Top Social
function videostories_header_social(){

        $facebook   = get_theme_mod( 'facebook' );
        $twitter    = get_theme_mod( 'twitter' );
        $skype      = get_theme_mod( 'skype' );
        $instagram  = get_theme_mod( 'instagram' );
        $dribble    = get_theme_mod( 'dribble' );
        $vimeo      = get_theme_mod( 'vimeo' );


        if( $twitter || $skype || $instagram || $dribble || $vimeo || $facebook ) { ?>

            <div class="top-sitemap text-right">
                <?php if(!empty($facebook)){ ?><a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fa fa-facebook"></i></a> <?php } ?>
                <?php if(!empty($twitter)){ ?><a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fa fa-twitter"></i></a> <?php } ?>
                <?php if(!empty($skype)){ ?><a href="<?php echo esc_url( $skype ) ; ?>" target="_blank"><i class="fa fa-skype"></i></a> <?php } ?>
                <?php if(!empty($instagram)){ ?><a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="fa fa-instagram"></i></a> <?php } ?>
                <?php if(!empty($dribble)){ ?><a href="<?php echo esc_url( $dribble ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a> <?php } ?>
                <?php if(!empty($vimeo)){ ?><a href="<?php echo esc_url( $vimeo ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a> <?php } ?>

            </div>

        <?php }

}





function videostories_login_register_page(){
    global $current_user;
    wp_get_current_user();

    if( is_user_logged_in()){ ?>

            <span><?php echo esc_html__("Welcome Back!", "videostories");?>
                <a href="<?php echo esc_url( get_author_posts_url($current_user->ID) ); ?>">
                    <?php echo esc_html( $current_user->display_name ); ?>
                </a>
            </span>

    <?php }
}


// Read More Contents
function videostories_read_more(){ ?>
        <a href="<?php the_permalink();?>" class="btn"><?php echo esc_html__("Continue Reading", 'videostories');?></a><!-- /.btn -->
<?php }



// VideoStories Blog Header Background
function videostories_404_page(){ ?>

    <section id="error-banner" class="error-banner text-center" style="background:url('<?php echo esc_url( get_template_directory_uri() ) . "/images/404.jpg"; ?>')" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">

      <div class="parallax-style">
        <div class="section-padding">
          <div class="container">
            <div class="banner-text">
              <div class="section-top">
                <h3 class="error-title">
                  <?php echo esc_html__( 'Sorry!! 404 Error!', 'videostories');?>
                </h3><!-- /.error-title -->
              </div><!-- /.section-top -->

              <div class="section-border">
                <div class="border-style">
                  <span></span>
                </div><!-- /.border-style -->
              </div><!-- /.section-border -->

              <h1 class="error-main-title">
                <?php echo esc_html__('Page Not Found', 'videostories');?>
              </h1><!-- /.main-title -->
              <h2 class="error-sub-title">
                <?php esc_html__('There was Some Problem Finding the page You Requested', 'videostories');?>
              </h2><!-- /.sub-title -->
              <div class="btn-container">
                <a href="<?php echo esc_url( home_url( '/' ));?>" class="btn">
                    <?php echo esc_html__('Return Home', 'videostories');?>
                </a>
              </div><!-- /.btn-container -->
            </div><!-- /.banner-text -->
          </div><!-- /.container -->
        </div><!-- /.section-padding -->
      </div><!-- /.parallax-style -->
    </section><!-- /#error-banner -->

<?php
}



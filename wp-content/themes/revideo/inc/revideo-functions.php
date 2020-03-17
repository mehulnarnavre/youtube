<?php

// Top Header
function revideo_header_top(){ ?>

    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="top-sitemap text-left">

               <?php revideo_login_register_page();?>

            </div><!-- /.top-sitemap -->
          </div>

          <div class="col-sm-6">
              <?php revideo_header_social();?>
          </div>

        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.header-top -->

<?php }



function revideo_login_register_page(){
    global $current_user;
    wp_get_current_user();

    if( is_user_logged_in()){ ?>

            <span><?php echo esc_html__("Welcome Back!", "revideo");?>
                <a href="<?php echo esc_url( get_author_posts_url($current_user->ID) ); ?>">
                    <?php echo esc_html( $current_user->display_name ); ?>
                </a>
            </span>

    <?php }
}




// Header Top Social
function revideo_header_social(){

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

// Header Logo
function revideo_header_logo(){
    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ){
        the_custom_logo();
    }else { ?>
        <a class="logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_html(bloginfo( 'name' )); ?> - <?php esc_html(bloginfo( 'description' )); ?>">
            <?php esc_html(bloginfo( 'name' )); ?>
        </a>
        <p class="site-description"><?php esc_html(bloginfo( 'description' )); ?></p>
    <?php }
}


// Header Mobile Logo
function revideo_header_mobile_logo(){
    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ){
        the_custom_logo();
    }else { ?>
        <a class="logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_html( bloginfo( 'name' )); ?> - <?php esc_html(bloginfo( 'description' )); ?>">
            <?php esc_html(bloginfo( 'name' )); ?>
        </a>
        <p class="site-description"><?php esc_html(bloginfo( 'description' )); ?></p>
    <?php }
}



// Top Header Banner Ads
function revideo_top_header_banner(){
	if ( is_active_sidebar( 'header-banner' ) ) { ?>
		<div class="col-sm-9">
			<?php dynamic_sidebar('header-banner'); ?>
		</div>
	<?php } 
}




// Post Format Content Thumbs
function revideo_post_format_content_thumbs(){ ?>
     <?php if ( has_post_thumbnail() ) { ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail('revideo-blog'); ?>
            </div>
    <?php }
}



// Post meta
function revideo_entry_post_meta(){?>

    <div class="entry-meta">
        <span><i class="fa fa-clock-o"></i> <time datetime="PT5M"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) ; ?></time></span>
        <span><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <span class="count"><?php comments_number( '0', '1', '%' );?></span></a></span>
    </div><!-- /.entry-meta -->

<?php
}


// Blog Sidebar
function revideo_sidebar(){ ?>

    <div class="col-sm-4">
        <aside class="sidebar video-blog">
            <?php get_sidebar(); ?>
        </aside>
    </div>

<?php }
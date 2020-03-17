<?php

function videostories_widgets() {
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'videostories' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Add widget on Blog Sidebar', 'videostories' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar', 'videostories' ),
        'id'            => 'footer-sidebar',
        'description'   => esc_html__( 'Add Footer Sidebar widgets', 'videostories' ),
        'before_widget' => '<div class="col-md-3 col-sm-6"><div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Top Header Banner Ads', 'videostories' ),
        'id'            => 'header-banner',
        'description'   => esc_html__( 'Add Banner Ads widgets', 'videostories' ),
        'before_widget' => '<div id="%1$s" class="widget widget_banner_ad"><div class="widget-details">',
        'after_widget'  => '</div></div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );




}
add_action( 'widgets_init', 'videostories_widgets' );
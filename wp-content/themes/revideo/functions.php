<?php

add_action( 'wp_enqueue_scripts', 'revideo_enqueue_styles' );

function revideo_enqueue_styles() {
    wp_enqueue_style( 'revideo-style', get_stylesheet_directory_uri() . '/style.css', array('videostories-style'));
	wp_enqueue_style( 'revideo-header', get_stylesheet_directory_uri() . '/assets/css/header.css', array('videostories-header'));
	wp_enqueue_style( 'revideo-themes', get_stylesheet_directory_uri() . '/assets/css/themes.css', array('videostories-themes'));
	wp_enqueue_style( 'revideo-responsive', get_stylesheet_directory_uri() . '/assets/css/responsive.css', array('videostories-responsive'));
}


/*
* After Theme Setup
*/
add_action( 'after_setup_theme', 'revideo_setup' );
if ( ! function_exists( 'revideo_setup' ) ) {
	function revideo_setup(){
		add_image_size( 'revideo-slider-thumb', '180', '260', true );
		add_image_size( 'revideo-blog', '750', '425', true );
		add_image_size( 'revideo-featured-thumb', '720', '530', true );
		add_image_size( 'revideo-featured-square-thumb', '365', '265', true );
	}
}



require ( get_stylesheet_directory() . '/inc/revideo-functions.php' );
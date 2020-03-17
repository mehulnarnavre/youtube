<?php

add_action( 'wp_enqueue_scripts', 'videomag_enqueue_styles' );

function videomag_enqueue_styles() {
    wp_enqueue_style( 'videomag-style', get_stylesheet_directory_uri() . '/style.css', array('videostories-style'));
	wp_enqueue_style( 'videostories-header', get_stylesheet_directory_uri() . '/assets/css/header.css');
	wp_enqueue_style( 'videostories-themes', get_stylesheet_directory_uri() . '/assets/css/themes.css');
	wp_enqueue_style( 'videostories-responsive', get_stylesheet_directory_uri() . '/assets/css/responsive.css');

	//Owl Carousel
	wp_enqueue_style( 'owl-carousel', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.css');
	wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );
}


/*
* After Theme Setup
*/
add_action( 'after_setup_theme', 'videomag_setup' );
if ( ! function_exists( 'videomag_setup' ) ) {
	function videomag_setup(){
		add_image_size( 'videomag-slider-thumb', '180', '260', true );
		add_image_size( 'videomag-blog', '750', '425', true );
	}
}



require ( get_stylesheet_directory() . '/inc/videomag-functions.php' );
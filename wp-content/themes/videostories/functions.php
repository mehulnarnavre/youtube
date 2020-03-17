<?php
/**
 * VideoStories functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package VideoStories
 */



define( 'VIDEOSTORIES', wp_get_theme()->get( 'Name' ));
define( 'VIDEOSTORIES_VER', wp_get_theme()->get( 'Version' ));
define( 'VIDEOSTORIES_CSS', get_template_directory_uri().'/assets/css/');
define( 'VIDEOSTORIES_JS', get_template_directory_uri().'/assets/js/');
define( 'VIDEOSTORIES_PATH', get_template_directory_uri());
define( 'VIDEOSTORIES_THME_URI', get_template_directory());
define( 'AJAX_URL', esc_url_raw( admin_url('admin-ajax.php')));



if ( ! function_exists( 'videostories_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function videostories_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on VideoStories, use a find and replace
	 * to change 'videostories' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'videostories', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	//Custom Image Size
	add_image_size( 'videostories-blog', '750', '425', true );

	//Video Attachment Support
 	add_post_type_support( 'attachment:video', 'thumbnail' );
 	add_theme_support( 'post-thumbnails', array( 'video', 'attachment:audio', 'attachment:video' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main-menu' => esc_html__( 'Main Menu', 'videostories' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'audio', 'quote', 'link', 'status', 'chat', 'gallery' ) );

    add_editor_style( array('inc/editor-style.css'), videostories_google_fonts_url() );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 185,
		'height'      => 35,
		'flex-width'  => true,
	) );





	/*
	* Gutenberg Support
	*/
	add_theme_support( 'customize-selective-refresh-widgets' );
	// Add support for Block Styles
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Editor color palette
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Primary Color', 'videostories' ),
				'slug'  => 'primary',
				'color' => jeweltheme_blog_hsl_hex( 'default' === get_theme_mod( 'colorscheme' ) ? 199 : get_theme_mod( 'colorscheme_primary_hue', 199 ), 100, 33 ),
			),
		)
	);

	// Add support for responsive embedded content
	add_theme_support( 'responsive-embeds' );




}
endif;
add_action( 'after_setup_theme', 'videostories_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function videostories_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'videostories_content_width', 640 );
}
add_action( 'after_setup_theme', 'videostories_content_width', 0 );


// Google Fonts
function videostories_google_fonts_url() {
    $font_url = '';
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'videostories' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Arizonia|Poppins:400,500,600,700|Roboto: 400,500,700|Lato:400,700,900' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}


/**
 * Enqueue scripts and styles.
 */
function videostories_scripts() {

		//CSS
		wp_enqueue_style( 'themify-icons', VIDEOSTORIES_CSS . 'themify-icons.css');
		wp_enqueue_style( 'bootstrap', VIDEOSTORIES_CSS . 'bootstrap.min.css');
		wp_enqueue_style( 'font-awesome', VIDEOSTORIES_CSS . 'font-awesome.min.css');
		wp_enqueue_style( 'magnific-popup', VIDEOSTORIES_CSS . 'magnific-popup.css');
		wp_enqueue_style( 'owl-carousel', VIDEOSTORIES_CSS . 'owl.carousel.css');
		wp_enqueue_style( 'animate', VIDEOSTORIES_CSS . 'animate.min.css');

		wp_enqueue_style( 'videostories-style', get_stylesheet_uri() );
		wp_enqueue_style( 'videostories-header', VIDEOSTORIES_CSS . 'header.css');
		wp_enqueue_style( 'videostories-themes', VIDEOSTORIES_CSS . 'themes.css');
		wp_enqueue_style( 'videostories-responsive', VIDEOSTORIES_CSS . 'responsive.css');
		wp_enqueue_style( 'videostories-google-fonts', videostories_google_fonts_url());


		//JS
        wp_enqueue_script( 'videostories-plugins', VIDEOSTORIES_JS . 'plugins.js', array('jquery'), '', true );
        wp_enqueue_script( 'bootstrap', VIDEOSTORIES_JS . 'bootstrap.js', array('jquery'), '', true );
        wp_enqueue_script( 'magnific-popup', VIDEOSTORIES_JS . 'magnific.popup.js', array('jquery'), '', true );
        wp_enqueue_script( 'match-height', VIDEOSTORIES_JS . 'match.height.js', array('jquery'), '', true );
        wp_enqueue_script( 'owl-carousel', VIDEOSTORIES_JS . 'owl.carousel.js', array('jquery'), '', true );

		wp_enqueue_script( 'videostories-main', VIDEOSTORIES_JS . 'main.js', array('jquery'), '', true );
		wp_enqueue_script( 'imagesloaded', array('jquery'), true );

        wp_localize_script( 'videostories-main', 'videostories_params', array( 'videostories_ajax_url' => admin_url('admin-ajax.php')));

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

}
add_action( 'wp_enqueue_scripts', 'videostories_scripts' );


/*** ------------------------------ Start Functions --------------------------------- **/
require ( VIDEOSTORIES_THME_URI . '/inc/custom-header.php' ) ;
require ( VIDEOSTORIES_THME_URI . '/inc/extras.php' );
require ( VIDEOSTORIES_THME_URI . '/inc/customizer.php' );
require ( VIDEOSTORIES_THME_URI . '/inc/template-tags.php' );
require ( VIDEOSTORIES_THME_URI . '/inc/theme-functions.php' );
require ( VIDEOSTORIES_THME_URI . '/inc/widgets.php' );

if ( defined( 'JETPACK__VERSION' ) ) {
	require ( VIDEOSTORIES_THME_URI . '/inc/jetpack.php' );
}
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
	require ( VIDEOSTORIES_THME_URI . '/inc/wp_bootstrap_navwalker.php' );
}

require ( VIDEOSTORIES_THME_URI . '/inc/gutenberg.php' );
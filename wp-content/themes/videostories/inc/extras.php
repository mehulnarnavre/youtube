<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package VideoStories
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function videostories_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'videostories_body_classes' );





/* Display a notice that can be dismissed */

add_action('admin_notices', 'videostories_theme_admin_notice');

function videostories_theme_admin_notice() {
    global $current_user ;
        $user_id = $current_user->ID;
    if ( ! get_user_meta($user_id, 'videostories_ignore_notice') ) {
        echo '<div class="updated"><p>';         
        printf(__('<h4 style="font-size: 20px; color: #5FA52A; font-weight: normal; margin-bottom: 10px; margin-top: 5px;"><a href="https://themeforest.net/item/videostories-responsive-video-wordpress-theme-for-marketers/20828897?ref=jewel_theme" target="_blank">' . __('Get VideoStories PRO $29 Today! ', 'videostories') . '</a></h4>Check out Premium Features of <a href="https://themeforest.net/item/videostories-responsive-video-wordpress-theme-for-marketers/20828897?ref=jewel_theme" target="_blank">' . __('VideoStories PRO', 'videostories') . '</a> Theme. <br>

             <a style="float: right;" href="%1$s">X</a>'), '?videostories_ignore=0');
        echo "</p></div>";
    }
}
add_action('admin_init', 'videostories_theme_ignore');


function videostories_theme_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['videostories_ignore']) && '0' == $_GET['videostories_ignore'] ) {
             add_user_meta($user_id, 'videostories_ignore_notice', 'true', true);
    }
}


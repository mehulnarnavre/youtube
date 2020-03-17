<?php

/*
  Plugin Name: Like dislike counter
  Plugin URI: https://layerdeveloper.com/portfolio
  Description: Add like and dislike button after the post with like and dislike counter.
  Version: 1.0
  Author: Zeshan Abdullah
  Author URI: https://www.fiverr.com/aliali44
 */

// Exit if accessed directly 
  if (!defined('ABSPATH'))
    exit;

include_once 'admin/admin.php';
/**
* creating a table for saving button update details
* on activating the plugin
*/
function ldcPostLikeDislikeDetailTable()
{      
  global $wpdb; 
  $db_table_name = $wpdb->prefix . 'like_dislike_btn_details';  // table name
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $db_table_name (
    id int(11) NOT NULL auto_increment,
    btn_container varchar(1000),
    likeDislikeType varchar(20),
    show_one_home varchar(5),
    on_pages varchar(5),
    on_product_page varchar(5),
    onshowShare varchar(5),
    UNIQUE KEY id (id)
    ) $charset_collate;";


require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
add_option( 'test_db_version', $test_db_version );
   // Adding default values
$wpdb->insert( $db_table_name, array( 'btn_container' => '<div class="button-container-likes-dislike">
    <button class="btn-start-1" id="post-like-btn"><i class="fa fa-thumbs-up"></i><span>Like</span><b>224</b></button>
    <button class="btn-start-1" id="post-dislike-btn"><i class="fa fa-thumbs-down"></i><span>Dislike</span><b>28</b></button>
    <label class="switch-on-off" style="display: none;"><input type="checkbox" class="input-on-off"><span class="slider-on-off round"></span></label></div>', 'likeDislikeType' => 'cookie-check', 'show_one_home' => 'no', 'on_pages' =>'no', 'on_product_page' =>'yes', 'onshowShare' =>'yes' ) );

} 

register_activation_hook( __FILE__, 'ldcPostLikeDislikeDetailTable' );

//enqueues font awesome stylesheet
function ldcEnqueueFontAwesomeStylesheets() {
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}

add_action('wp_enqueue_scripts', 'ldcEnqueueFontAwesomeStylesheets');

//enqueues css and js files
add_action('wp_enqueue_scripts', 'ldcAjaxPostLikeDislikeEnqueueScripts');

function ldcAjaxPostLikeDislikeEnqueueScripts() {
        wp_enqueue_style('like', plugins_url('/assets/css/style.css', __FILE__));
    wp_enqueue_script('like', plugins_url('/assets/js/logic.js', __FILE__), array('jquery'), '1.0', true);

    wp_localize_script('like', 'counterURL', array(
        'ajax_url' => admin_url('admin-ajax.php')
        ));

    wp_localize_script('like', 'cookieURL', array(
        'cookie_ajax_url' => admin_url('admin-ajax.php')
        ));
}

//Ajax call receive
add_action('wp_ajax_nopriv_ldcPostLikeDislikeCounter', 'ldcPostLikeDislikeCounter');
add_action('wp_ajax_ldcPostLikeDislikeCounter', 'ldcPostLikeDislikeCounter');

function ldcPostLikeDislikeCounter() {
    if (isset($_POST['counter_type'], $_POST['post_id'])) {
        $counter_type = sanitize_key($_POST['counter_type']);
        $post_id = sanitize_key($_POST['post_id']);
    }
    
    
    if ($counter_type == "post-like-btn") {
        //First check dislike exist in user meta 
        ldcDislikeAlreadyExist($post_id);
        $user_result_like = ldcUserLikeIncrement($counter_type, $post_id);
        if ($user_result_like == "1") {
            //Like added successfuly in user meta
            $post_result_like = ldcPostLikeIncrement($post_id);
            if ($post_result_like == "1") {
                echo esc_html( "1" );
            }
        } else {
            //Likst does not posted
            echo esc_html( $user_result_like );
        }
    } else {
        ldcLikeAlreadyExist($post_id);
        $user_result_dislike = ldcUserDislikeIncrement($counter_type, $post_id);
        if ($user_result_dislike == "1") {
            //Like added successfuly in user meta
            $post_result_dislike = ldcPostDislikeIncrement($post_id);
            if ($post_result_dislike == "1") {
                echo esc_html( "1" );
            }
        } else {
            //Likst does not posted
            echo esc_html( $user_result_dislike );
        }
    }
    die();
}




// ============================ Like dislike button sourc ====================//
function ldcLikeDislikeSourceBtns(){
 global $wp_query;
 $postid = $wp_query->post->ID;
        //Post meta 
 $post_like_counter = get_post_meta($postid, 'post_likes_plusCounter', true);
 $post_dislike_counter = get_post_meta($postid, 'post_dislikes_plusCounter', true);
 if ($post_like_counter == "") {
    $post_like_counter = "0";
}
if ($post_dislike_counter == "") {
    $post_dislike_counter = "0";
}
global $wpdb;
$table_name = $wpdb->prefix . 'like_dislike_btn_details';
$button_db_details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '1' ");

$c = "<div class='post-like-dislike-plusCounter-container'>".$button_db_details->btn_container."</div><span class='hidden-id' id='like-dislike-post-id'>".get_the_ID()."</span><span class='hidden-id ldc-post-total-likes'>".$post_like_counter."</span><span class='hidden-id ldc-post-total-dislikes'>".$post_dislike_counter."</span><span class='hidden-id ldc-lk-dk-type'>".$button_db_details->likeDislikeType."</span><span class='hidden-id ldc-page-title'>".get_the_title()."</span><span class='hidden-id ldc-share-it'>".$button_db_details->onshowShare."</span>";
return $c;
}




// Like increment 
function ldcUserLikeIncrement($counter_type, $post_id) {
    $sendBack = "";
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $user_like_posts = get_user_meta($user_id, 'post_likes_plusCounter', true);
        if ($user_like_posts == "") {
            $post_id = $post_id . ",";
            add_user_meta($user_id, 'post_likes_plusCounter', $post_id);
            // Like added successuflly
            $sendBack = "1";
        } else {
            $comma_seperate_post_ids = explode(',', $user_like_posts);
            if (in_array($post_id, $comma_seperate_post_ids)) {
                //like aready exist of current user.
                $sendBack = "0";
            } else {
                //update user meta with new post id
                $user_like_posts = $user_like_posts . "" . $post_id . ",";
                update_user_meta($user_id, 'post_likes_plusCounter', $user_like_posts);
                // Like added successuflly
                $sendBack = "1";
            }
        }
    } else {
        //User not login
        $sendBack = "2";
    }
    return $sendBack;
}

// Dislike increment
function ldcUserDislikeIncrement($counter_type, $post_id) {
    $sendBack = "";
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $user_like_posts = get_user_meta($user_id, 'post_dislikes_plusCounter', true);
        if ($user_like_posts == "") {
            $post_id = $post_id . ",";
            add_user_meta($user_id, 'post_dislikes_plusCounter', $post_id);
            // Like added successuflly
            $sendBack = "1";
        } else {
            $comma_seperate_post_ids = explode(',', $user_like_posts);
            if (in_array($post_id, $comma_seperate_post_ids)) {
                //like aready exist of current user.
                $sendBack = "0";
            } else {
                //update user meta with new post id
                $user_like_posts = $user_like_posts . "" . $post_id . ",";
                update_user_meta($user_id, 'post_dislikes_plusCounter', $user_like_posts);
                // Like added successuflly
                $sendBack = "1";
            }
        }
    } else {
        //User not login
        $sendBack = "2";
    }
    return $sendBack;
}

//Post like increment
function ldcPostLikeIncrement($post_id) {
    $post_like_posts = get_post_meta($post_id, 'post_likes_plusCounter', true);
    if ($post_like_posts == "") {
        add_post_meta($post_id, 'post_likes_plusCounter', '1');
    } else {
        $post_like_posts = $post_like_posts + 1;
        update_post_meta($post_id, 'post_likes_plusCounter', $post_like_posts);
    }
    return "1";
}

//Post like increment
function ldcPostDislikeIncrement($post_id) {
    $post_like_posts = get_post_meta($post_id, 'post_dislikes_plusCounter', true);

    if ($post_like_posts == "") {
        add_post_meta($post_id, 'post_dislikes_plusCounter', '1');
    } else {
        $post_like_posts = $post_like_posts + 1;
        update_post_meta($post_id, 'post_dislikes_plusCounter', $post_like_posts);
    }
    return "1";
}

// Checking if dislike already exist
function ldcDislikeAlreadyExist($post_id) {
    $user_id = get_current_user_id();
    $user_like_posts = get_user_meta($user_id, 'post_dislikes_plusCounter', true);
    if ($user_like_posts == "") {
        return "Not exist";
    } else {
        $comma_seperate_post_ids = explode(',', $user_like_posts);
        if (in_array($post_id, $comma_seperate_post_ids)) {
            //dislike aready exist of the current user.
            $key = array_search($post_id, $comma_seperate_post_ids);
            if (false !== $key) {
                unset($comma_seperate_post_ids[$key]);
                $updated_counter = implode(',', $comma_seperate_post_ids);
                if($updated_counter==""){
                    $updated_counter = ",";
                }
                update_user_meta($user_id, 'post_dislikes_plusCounter', $updated_counter);
                ldcDislikeDecrease($post_id);
            }

        }
    }
}


function ldcDislikeDecrease($post_id){
    if (is_user_logged_in()) {
        $user_dislike_posts = get_post_meta( $post_id, 'post_dislikes_plusCounter', true );
        $user_dislike_posts = $user_dislike_posts - 1;
        update_post_meta( $post_id, 'post_dislikes_plusCounter', $user_dislike_posts );
        echo esc_html( "1" );
    }
}

// Checking if like already exist
function ldcLikeAlreadyExist($post_id) {
    $user_id = get_current_user_id();
    $user_like_posts = get_user_meta($user_id, 'post_likes_plusCounter', true);
    if ($user_like_posts == "") {
        return "Not exist";
    } else {
        $comma_seperate_post_ids = explode(',', $user_like_posts);
        if (in_array($post_id, $comma_seperate_post_ids)) {
            //dislike aready exist of the current user.
            $key = array_search($post_id, $comma_seperate_post_ids);
            if (false !== $key) {
                unset($comma_seperate_post_ids[$key]);
                $updated_counter = implode(',', $comma_seperate_post_ids);
                if($updated_counter==""){
                    $updated_counter = ",";
                }
                update_user_meta($user_id, 'post_likes_plusCounter', $updated_counter);
                ldcLikeDecrease($post_id);
            }

        }
    }
}


function ldcLikeDecrease($post_id){
    if (is_user_logged_in()) {
        $user_dislike_posts = get_post_meta( $post_id, 'post_likes_plusCounter', true );
        $user_dislike_posts = $user_dislike_posts - 1;
        update_post_meta( $post_id, 'post_likes_plusCounter', $user_dislike_posts );
        echo esc_html( "1" );
    }
}



//============ Ajax call for cookie update post counts====================//
add_action('wp_ajax_nopriv_ldcPostCookieUpdate', 'ldcPostCookieUpdate');
add_action('wp_ajax_ldcPostCookieUpdate', 'ldcPostCookieUpdate');

function ldcPostCookieUpdate(){
    if (isset($_POST['postId']) && isset($_POST['updateType'])) {
        $post_id = $_POST['postId'];
        $updateType = $_POST['updateType'];

        if ($updateType == "11") {
           //Icrement in post like
           $post_like_posts = get_post_meta($post_id, 'post_likes_plusCounter', true);
           $post_like_posts = $post_like_posts + 1;
           update_post_meta($post_id, 'post_likes_plusCounter', $post_like_posts);

    // Decrement in post dislike
           $post_like_posts = get_post_meta($post_id, 'post_dislikes_plusCounter', true);
           $post_like_posts = $post_like_posts - 1;
           update_post_meta($post_id, 'post_dislikes_plusCounter', $post_like_posts);
       }  
   elseif ($updateType == "1") { //increment in post like
    $post_like_posts = get_post_meta($post_id, 'post_likes_plusCounter', true);
    if ($post_like_posts == "") {
        add_post_meta($post_id, 'post_likes_plusCounter', '1');
    } else {
        $post_like_posts = $post_like_posts + 1;
        update_post_meta($post_id, 'post_likes_plusCounter', $post_like_posts);
    }
}
elseif ($updateType == "00") {
         //Icrement in post dislike
   $post_like_posts = get_post_meta($post_id, 'post_dislikes_plusCounter', true);
   $post_like_posts = $post_like_posts + 1;
   update_post_meta($post_id, 'post_dislikes_plusCounter', $post_like_posts);

    // Decrement in post like
   $post_like_posts = get_post_meta($post_id, 'post_likes_plusCounter', true);
   $post_like_posts = $post_like_posts - 1;
   update_post_meta($post_id, 'post_likes_plusCounter', $post_like_posts);
}

    elseif ($updateType == "0") { //increment in post dislike
        $post_like_posts = get_post_meta($post_id, 'post_dislikes_plusCounter', true);
        if ($post_like_posts == "") {
            add_post_meta($post_id, 'post_dislikes_plusCounter', '1');
        } else {
            $post_like_posts = $post_like_posts + 1;
            update_post_meta($post_id, 'post_dislikes_plusCounter', $post_like_posts);
        }

    }
}
echo "1";
die();
}

// ================== Buttons show with database conditions ====================
// Like and dislike buttons after Single Post
function ldcTextAfterContent($content) {
        //Calling buttons source
    if (is_single()) {
     if (!function_exists('is_product')) {
        {
         $c =  ldcLikeDislikeSourceBtns();
               $content .= $c;
               return $content;
        } 
    }
}
elseif (is_home()) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_dislike_btn_details';
    $button_db_details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '1' ");
    if ($button_db_details->show_one_home=="yes") {
        $c =  ldcLikeDislikeSourceBtns();
        $content .= $c;
        return $content;    
    }
}
elseif (is_page()) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_dislike_btn_details';
    $button_db_details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '1' ");
    if ($button_db_details->on_pages=="yes") {
        $c =  ldcLikeDislikeSourceBtns();
        $content .= $c;
        return $content;    
    }
}
return $content;


}

add_filter('the_content', 'ldcTextAfterContent');

// ========================= WooCommerce add button====================//
add_action( 'woocommerce_share', 'add_content_after_addtocart_button_func' );

function add_content_after_addtocart_button_func() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_dislike_btn_details';
    $button_db_details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '1' ");
    if ($button_db_details->on_product_page=="yes") {
            echo ldcLikeDislikeSourceBtns();
    }
//like/dislike buttons after product medta


}
<?php
//adding custom style file
function ldcPostLikeDislikeAdminStyle() {
    wp_enqueue_style('ldcPostLikeDislikeAdminStyle', plugins_url('icon-picker/simple-iconpicker.min.css', __FILE__));
    wp_enqueue_style('ldcPostLikeDislikeAdminStyle2', plugins_url('css/style.css', __FILE__));
    wp_enqueue_style('post_like_dislike_admin_font', plugins_url('/font-awesome/css/font-awesome.min.css', __FILE__));
       
wp_enqueue_script('custom_logic0', plugins_url('js/loader.js',__FILE__ ));
    wp_enqueue_script('custom_logic', plugins_url('js/logic.js',__FILE__ ));
    wp_enqueue_script('custom_logic2', plugins_url('icon-picker/simple-iconpicker.min.js',__FILE__ ));


    

}
add_action('admin_enqueue_scripts', 'ldcPostLikeDislikeAdminStyle');
add_action('login_enqueue_scripts', 'ldcPostLikeDislikeAdminStyle');

//color picker
add_action( 'admin_enqueue_scripts', 'ldcAdminAddColorPicker' );
function ldcAdminAddColorPicker( $hook ) {

    if( is_admin() ) { 

        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 

        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', plugins_url( 'js/custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}

function ldcRegisterLikeDislikePlusCounterNav() {
    add_menu_page('post like dislike plusCounter', 'Likes & dislikes', 'manage_options', 'like_dislike_setting', 'ldcPostLikeDislikeSettingPage', null, 90); 
}
add_action('admin_menu', 'ldcRegisterLikeDislikePlusCounterNav');

function ldcPostLikeDislikeSettingPage(){
    ?>
    <div class="cont-p-dashboard"><div class="post_like_dislike_header wrap">Dashboard<span>Contact me for further customization, start from $5. <a href="https://www.fiverr.com/aliali44">Contact</a></span></div>
    <div class="alert-show-limitation">Some of the buttons does not support a different background and custom text. If you want to customize any theme(buttons) as per your theme then please <a href="https://www.fiverr.com/aliali44">contact me</a></div>  
    <?php
   // Code displayed before the tabs (outside)
// Tabs
    $tab = ( ! empty( $_GET['tab'] ) ) ? esc_attr( $_GET['tab'] ) : 'first';
    ldcAdminPageTabs( $tab );

 // Like button style details
    global $wpdb;
    $table_name = $wpdb->prefix . 'like_dislike_btn_details';


    if ( $tab == 'first' ) {
    //like radio buttons checked option
        $like_db_details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '1' ");


    // add the code you want to be displayed in the first tab
        $admin_like_dislike_container =  "<div class='button-update-container'><div class='btn-update-btnmain'>
        ".$like_db_details->btn_container."
        <span class='tooltip-describe'><div class='tooltip'>This is the selected theme(buttons). These buttons will be shown for post like and dislike. If you want to customize these buttons then click on 'Customize like button' and 'Customize dislike button'.<span class='tooltiptext'>This is the selected theme(buttons). These buttons will be shown for post like and dislike. If you want to customize these buttons then click on 'Customize like button' and 'Customize dislike button'.</span></div>
        </span></div></div><div class='main-container-post-like-dislike'>
        <div class='post-like-dislike-plusCounter-container'>
        </div>

        <div class='cont-like-btn1' id='like-cont'>
        <span class='hide-btn-cont'>&#10005;</span>
        <div class='icon-update'>
        <span class='h5'>Update like icon:</span> &nbsp;&nbsp;
        <i class='fa fa-thumbs-up' id='icon-font-updateable'></i>
        <input type='text' class='font-awesome-picker' value='' placeholder='Click to select icon'>
        </div>
        <div class='text-update'>
        <span class='h5'>Update text:</span> &nbsp;&nbsp;
        <input type='text' name='updte-like-text' class='update-text-like' value='' />
        </div>
        <br>
        <div class='back-color-update'>
        <span class='h5'>Update background color:</span> &nbsp;&nbsp;
        <input type='text' class='wp-color-picker' name='color-picker' value=''/>
        </div>
        <button class='update-like-btn-send' id='like-update-ajax'>Update Like Button</button>
        </div>
        <div class='cont-like-btn1' id='dislike-cont'>
        <span class='hide-btn-cont'>&#10005;</span>
        <div class='icon-update'>
        <span class='h5'>Update like icon:</span> &nbsp;&nbsp;
        <i class='fa fa-thumbs-down' id='icon-font-updateable2'></i>
        <input type='text' class='font-awesome-picker-dislike' value='' placeholder='Click to select icon'>
        </div>

        <div class='text-update'>
        <span class='h5'>Update text:</span> &nbsp;&nbsp;
        <input type='text' name='updte-like-text' class='update-text-dislike' value='' />
        </div>
        <br>
        <div class='back-color-update'>
        <span class='h5'>Update background color:</span> &nbsp;&nbsp;
        <input type='text' class='wp-color-picker2' name='color-picker' value=''/>
        </div>
        <button class='update-like-btn-send' id='dislike-udpate-ajax'>Update Dislike button</button>
        </div>

        <div class='update-like-dislike-buttons wrap'>
        <span class='h4'>Customize button?</span>
        <button id='btn-update-like' class=''>
        Customize Like button
        </button>
        <button id='btn-update-dislike' class=''>
        Customize Dislike button
        </button>
        </div>
        </div>";
        echo $admin_like_dislike_container;
        include_once 'static/index.html';
        echo "</div>";
    }
    elseif($tab == 'second' ){
       $args = array(

          'posts_per_page' => 4,
          'order' => 'asc',
          'meta_query' => array(
              array(
                  'key' => 'post_likes_plusCounter',
                  )
              )
          );
       $loop = new WP_Query( $args );
       ?>     
       <div class="statistic-cont">
        <div class="stc-rows">
            <div class="stc-cols stc-col-1">
           <div id="piechart"></div>      

            </div>
            <div class="stc-cols stc-col-2">
                <div class="gradient-sts-list g-sts-l-1">
                    <i class="fa fa-thumbs-up"></i>
                    <span>Total Likes</span>
                    <b>0</b>
                </div>
            </div>
            <div class="stc-cols stc-col-3">
                <div class="gradient-sts-list g-sts-l-2">
                    <i class="fa fa-thumbs-down"></i>
                    <span>Total Dislikes</span>
                    <b>0</b>
                </div>
            </div>
        </div>
        <table class="widefat fixed" id="post-like-dislike-table" cellspacing="0">
            <tr>
                <th class="check-column">No.</th>
                <th class="check-column">Post title</th>
                <th class="check-column">Total Likes/Dislikes</th>
                <th class="check-column">View post</th>
            </tr>
            <?php
            $i = 1;
            while ( $loop->have_posts() ) : $loop->the_post();
            ?>
            <tr >
                <td>
                    <?php echo esc_html( $i ); 
                    $i++
                    ?>   
                </td>
                <td class="column-columnname" id="<?php echo get_the_ID();?>">
                    <p><?php the_title(); ?></p>
                </td>
                <td class="column-columnname l-d-ldc-Total">
                   <span class="p-likes-l"> <?php echo get_post_meta(get_the_ID(),'post_likes_plusCounter',true)?> </span>/ 
                   <span class="p-dislikes-l"> 
                    <?php 
                    if(get_post_meta(get_the_ID(),'post_dislikes_plusCounter',true) == ""){
                        echo "0";
                    }
                    else{
                        echo get_post_meta(get_the_ID(),'post_dislikes_plusCounter',true);
                    }
                    ?> 
                </span>

                </td>       
                <td>
                    <a href="<?php echo get_post_permalink(); ?>" target="_blank">View post</a>
                </td>
            </tr>   
            <?php
            endwhile;
            ?>            
        </table>
    </div>
    <?php
}
else{
    $setting_details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '1' ");
            //Setting login details
    $ldc_on_home = $setting_details->show_one_home;
    $ldc_on_page = $setting_details->on_pages;
    $ldc_on_product = $setting_details->on_product_page;
    $onshowShare = $setting_details->onshowShare;

    if ($ldc_on_home=="yes") {
        $ldc_on_home = "checked";
    }
    else{
        $ldc_on_home = "";
    }
    if ($ldc_on_page=="yes") {
        $ldc_on_page = "checked";
    }
    else{
        $ldc_on_page = "";
    }
    if ($ldc_on_product=="yes") {
        $ldc_on_product = "checked";
    }
    else{
        $ldc_on_product = "";
    }
    if ($onshowShare=="yes") {
        $onshowShare = "checked";
    }
    else{
        $onshowShare = "";
    }

            //Selected type of like and dislike (cookie/login)
    $btnLoginChecked = $btnCookieChcked = "";
    if ($setting_details->likeDislikeType =="login-check") {
        $btnLoginChecked = "checked";
    }
    else{
        $btnCookieChcked = "checked";
    }
    ?>
    <div class="setting-ldc">

        <table class="tbl-setting1">
            <tr>
                <td>
                    Like and dislike functionality using Cookies(no need to login).
                </td>
                <td>
                   <div> <label class="switch-on-off"><input type="checkbox" class="input-on-off cookie-check" <?php echo esc_html( $btnCookieChcked ) ?>><span class="slider-on-off round"></span></label></div>
               </td>
           </tr>
           <tr>
             <td>
                Like and dislike functionality using login.
            </td>
            <td>
               <div> <label class="switch-on-off"><input type="checkbox" class="input-on-off login-check" <?php echo esc_html( $btnLoginChecked ) ?>><span class="slider-on-off round"></span></label></div>
           </td>
       </tr>
       <tr>
        <td>
            Want to show <b>Like/Dislike</b> buttons on the <b>Home page</b>?
        </td>
        <td>
            <input type="checkbox" class="checkboxes-ldc on-home-page" <?php echo esc_html( $ldc_on_home ) ?>> 
        </td>
    </tr>
    <tr>
        <td>
            Want to show  <b>Like/Dislike</b> buttons on the <b>pages?</b>.
        </td>
        <td>
            <input type="checkbox" class="checkboxes-ldc on-simple-page" <?php echo esc_html( $ldc_on_page ) ?>> 
        </td>
    </tr>
    <tr>
        <td>
            Want to show on <b>Like/Dislike</b> buttons on the <b>product page</b> (for Woocommerce)?
        </td>
        <td>
            <input type="checkbox" class="checkboxes-ldc on-woo-page" <?php echo esc_html( $ldc_on_product ) ?>> 
        </td>
    </tr>
    <tr>
        <td>
            Want to show  <b>Share</b> functionality after pressing <b>like button</b>?
        </td>
        <td>
            <input type="checkbox" class="checkboxes-ldc ldc-show-share" <?php echo esc_html( $onshowShare ) ?>> 
        </td>
    </tr>
    <tr>
        <td class="update-setting-btn">
            <button>Update Setting</button>
        </td>
    </tr>

</table>
</div>
<?php
}





}
function ldcAdminPageTabs( $current = 'first' ) {
    $tabs = array(
        'first'   => __( 'Customize Button', 'plugin-textdomain' ), 
        'second'  => __( 'Statistics', 'plugin-textdomain' ),
        'third'  => __( 'Setting', 'plugin-textdomain' ),
        );
    $html = '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? 'nav-tab-active' : '';
        $html .= '<a class="nav-tab ' . esc_html($class) . '" href="?page=like_dislike_setting&tab=' . esc_html($tab) . '">' . esc_html($name) . '</a>';
    }
    $html .= '</h2>';
    echo $html ;
}
/**
* Ajax call for updating button properties 
*/
add_action('wp_ajax_bnt_update', 'ldcMyAjaxActionBtnUpdate');

function ldcMyAjaxActionBtnUpdate(){

 global $wpdb;
 $table_name = $wpdb->prefix . 'btn_details';
 if (isset($_POST['btnContainer'])) {
     $btnContainer =  $_POST['btnContainer'];
 $db_table_name = $wpdb->prefix . "like_dislike_btn_details";  // table name

 $update = "UPDATE $db_table_name SET btn_container = '$btnContainer' WHERE id = 1";
 $results = $wpdb->query( $update );
 echo esc_html( "Default buttons are updated!" );
}

exit();

}


/**
* Ajax call for updating setting
*/
add_action('wp_ajax_bnt_update_setting', 'ldcMyAjaxActionBtnUpdateSetting');

function ldcMyAjaxActionBtnUpdateSetting(){
    if (isset($_POST['likeDislikeType'], $_POST['onHomePageShow'], $_POST['onPagesShow'], $_POST['onProductPageShow'])) {
        $onHomePageShow = $_POST['onHomePageShow'];
        $onPagesShow = $_POST['onPagesShow'];
        $onProductPageShow = $_POST['onProductPageShow'];
        $onshowShare = $_POST['onshowShare'];
        global $wpdb;
        $table_name = $wpdb->prefix . "like_dislike_btn_details";
        $funcType =  $_POST['likeDislikeType'];
        $update = "UPDATE $table_name SET likeDislikeType = '$funcType', show_one_home = '$onHomePageShow', on_pages = '$onPagesShow', on_product_page = '$onProductPageShow', onshowShare = '$onshowShare' WHERE id = 1";
        $results = $wpdb->query( $update );
        echo esc_html( "Setting saved!" );
    }

    exit();

}
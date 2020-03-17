<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package VideoStories
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function videostories_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'videostories_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'videostories_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so videostories_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so videostories_categorized_blog should return false.
		return false;
	}
}



// Blog Sidebar
function videostories_sidebar(){ ?>

	<div class="col-sm-4">
		<aside class="sidebar video-blog">
			<?php get_sidebar(); ?>
		</aside>
	</div>

<?php }


// Author Profile Page Sidebar
function videostories_author_sidebar(){ ?>

	<div class="col-sm-4">
		<aside class="sidebar">
			<?php if ( is_active_sidebar( 'author-sidebar' ) ) {
				dynamic_sidebar('author-sidebar');
			} ?>
		</aside>
	</div>

<?php }

// Top Header Banner Ads
function videostories_top_header_banner(){ ?>

	<?php if ( is_active_sidebar( 'header-banner' ) ) { ?>
		<div class="col-sm-9">
			<?php dynamic_sidebar('header-banner'); ?>
		</div>
	<?php } ?>

<?php }


// Top Header
function videostories_header_top(){ ?>

    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="top-sitemap text-left">

               <?php videostories_login_register_page();?>

            </div><!-- /.top-sitemap -->
          </div>

          <div class="col-sm-6">
              <?php videostories_header_social();?>
          </div>

        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.header-top -->

<?php }



// Get Post Meta
function videostories_meta($meta){
    $meta = get_post_meta(get_the_ID(), $meta, true);
    return $meta;
}




// Post Format Content Thumbs
function videostories_post_format_content_thumbs(){ ?>
     <?php if ( has_post_thumbnail() ) { ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail('videostories-blog'); ?>
			</div>
    <?php }
}



// Single Post Thumbnails

function videostories_post_format_content_single_thumbs(){
    if ( has_post_thumbnail() ) { ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail('videostories-blog'); ?>
            </div>
    <?php }
}


function videostories_get_attachment_url( $url ){
	return	wp_get_attachment_url( $url );
}




// Post meta
function videostories_entry_post_meta(){?>

			<div class="entry-meta">
				<span><i class="fa fa-clock-o"></i> <time datetime="PT5M"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) ; ?></time></span>
				<span><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <span class="count"><?php comments_number( '0', '1', '%' );?></span></a></span>
			</div><!-- /.entry-meta -->

<?php
}

function videostories_blog_entry_meta(){ ?>
	<div class="entry-meta">
		<?php echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';?>
		<span><i class="fa fa-clock-o"></i> <time datetime="PT5M"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') )) ; ?></time></span>
		<span><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <span class="count"><?php comments_number( '0', '1', '%' );?></span></a></span>
		<span><?php the_tags();?></span>
	</div><!-- /.entry-meta -->
<?php }




function videostories_post_navigation(){
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	<div class="post-navigation">

		<h3 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'videostories' ); ?></h3>

		<div class="nav-links">

			<?php
			if ( is_attachment() ) {
				previous_post_link( '%link', '<span class="meta-nav">' . esc_html__('Published In', 'videostories') . '</span>%title' );
			}
			else { ?>

			<div class="pull-left">
				<?php previous_post_link( '%link', '<span class="meta-nav">' . esc_html__('Previous Post', 'videostories') . '</span><i class="fa fa-angle-double-left"></i><h2 class="entry-title">%title</h2>' );	?>
			</div>

			<div class="pull-right">
				<?php next_post_link( '%link', '<span class="meta-nav">' . esc_html__('Next Post', 'videostories') . '</span><span class="nav-icon"></span><h2 class="entry-title">%title</h2><i class="fa fa-angle-double-right"></i>' );?>
			</div>


			<?php } ?>

		</div><!-- .nav-links -->
	</div><!-- /.post-navigation -->

<?php }




if( !function_exists('videostories_get_post_authorID') ){
 	function videostories_get_post_authorID($post_id) {
 		if( !$post_id )
 			return false;
 		$post = get_post($post_id);
 		return $post->post_author;
 	}
 }



/*===================================================================================
 * VideoStories Comments
 * =================================================================================*/

if(!function_exists('videostories_comment')){

    function videostories_comment($comment, $args, $depth){

        //$GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

        <p><?php esc_html__('Pingback:','videostories');?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'videostories' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
        break;
        default :

        global $post;
        ?>

        <li <?php comment_class('comment parent media'); ?> id="li-comment-<?php comment_ID(); ?>">

            <div class="comment-item">
                <div class="author-avatar media-left">
                    <?php echo get_avatar( $comment, 90 ); ?>
                </div><!-- /.author-avatar -->
                <div class="comment-body media-body">
                    <div class="comment-metadata">
                        <span class="name"><a href="<?php comment_author_link(); ?>"><?php comment_author(); ?></a></span>
                        <span class="btn reply pull-right"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'videostories' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
                        <span class="time">
                        	<time datetime="<?php echo esc_attr(get_the_modified_date( 'c' ));?>"><?php echo esc_html(get_the_date('M j, Y')); ?> <?php echo esc_html__('at','videostories');?> <?php echo esc_html( get_comment_time() ); ?></time>
                        </span>
                    </div><!-- /.comment-metadata -->
                    <p class="description">
                        <?php echo esc_html( get_comment_text() ); ?>
                    </p>
                </div><!--/.comment-body-->
            </div><!-- /.comment-item -->



            <?php
            break;
            endswitch;
        }

}





/**
 * Convert HSL to HEX colors
 */
function jeweltheme_blog_hsl_hex( $h, $s, $l, $to_hex = true ) {

	$h /= 360;
	$s /= 100;
	$l /= 100;

	$r = $l;
	$g = $l;
	$b = $l;
	$v = ( $l <= 0.5 ) ? ( $l * ( 1.0 + $s ) ) : ( $l + $s - $l * $s );
	if ( $v > 0 ) {
		$m;
		$sv;
		$sextant;
		$fract;
		$vsf;
		$mid1;
		$mid2;

		$m = $l + $l - $v;
		$sv = ( $v - $m ) / $v;
		$h *= 6.0;
		$sextant = floor( $h );
		$fract = $h - $sextant;
		$vsf = $v * $sv * $fract;
		$mid1 = $m + $vsf;
		$mid2 = $v - $vsf;

		switch ( $sextant ) {
			case 0:
				$r = $v;
				$g = $mid1;
				$b = $m;
				break;
			case 1:
				$r = $mid2;
				$g = $v;
				$b = $m;
				break;
			case 2:
				$r = $m;
				$g = $v;
				$b = $mid1;
				break;
			case 3:
				$r = $m;
				$g = $mid2;
				$b = $v;
				break;
			case 4:
				$r = $mid1;
				$g = $m;
				$b = $v;
				break;
			case 5:
				$r = $v;
				$g = $m;
				$b = $mid2;
				break;
		}
	}
	$r = round( $r * 255, 0 );
	$g = round( $g * 255, 0 );
	$b = round( $b * 255, 0 );

	if ( $to_hex ) {

		$r = ( $r < 15 ) ? '0' . dechex( $r ) : dechex( $r );
		$g = ( $g < 15 ) ? '0' . dechex( $g ) : dechex( $g );
		$b = ( $b < 15 ) ? '0' . dechex( $b ) : dechex( $b );

		return "#$r$g$b";

	} else {

		return "rgb($r, $g, $b)";
	}
}
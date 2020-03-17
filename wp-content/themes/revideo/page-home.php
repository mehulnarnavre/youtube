<?php
/*
Template Name: Homepage
*/

get_header();
global $post;

	$do_not_duplicate = array();
	$sticky = get_option( 'sticky_posts' );
	$query_args = array(
	  	'post_type' 			=> 'post',
	  	'posts_per_page' 		=> 1,
		'post__in'       		=> $sticky,
		'post_status' 	 		=> 'publish',
		'ignore_sticky_posts' 	=> false,
	);
	$trending_query = new WP_Query( $query_args );	        	
	if ( $trending_query->have_posts() ) { while ( $trending_query->have_posts() ) { $trending_query->the_post();

		$do_not_duplicate[] = $post->ID;

	  	$terms = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "all"));  
	  	$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'revideo-slider-thumb' ) );

	  	$t = array();                    
	  	foreach($terms as $term)
	    	$t[0] = $term->slug;
	    	$term_name = implode(', ', $t); $t = array();
    ?>
		<section class="banner-section text-center background-bg" data-image-src="<?php echo esc_url_raw($url);?>">
		    <div class="overlay">
		      <div class="section-padding">
		        <div class="container">
		          <div class="banner-contents">
		            <div class="play-btn">
		            	<a href="<?php the_permalink();?>" class="iframe play-video">
		            		<i class="fa fa-play"></i>
		            	</a>
		            </div>
		            
		            <h3 class="title">
						<a href="<?php echo esc_url( get_term_link($term_name, 'category') );?>">
							<?php echo $term_name; ?>
						</a>
					</h3><!-- /.title -->

		            <h2 class="banner-title">
		            	<?php the_title();?>		
		            </h2><!-- /.banner-title -->
		            
		          </div><!-- /.banner-contents -->
		        </div><!-- /.container -->
		      </div><!-- /.section-padding -->
		    </div><!-- /.overlay -->
		</section><!-- /.banner-section -->

	<?php } } wp_reset_postdata(); ?>


  <div class="blog-posts">
    <div class="section-padding">
      <div class="container">
        <div class="row">

        	<div class="col-sm-8">

		  		<?php

				  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				  	$sticky = get_option( 'sticky_posts' );
				  	$revideo_blog_posts_args = array(
				  		'post_type' 	 => 'post',
				  		'post_status' 	 => 'publish',
				  		'post__in'       => $sticky,
				  		'posts_per_page' => 4,
				  		'ignore_sticky_posts' 	=> true,
				  		'post__not_in' 	 => $do_not_duplicate,
				  		'paged'          => $paged		  		
				  	);
				  	
				  	$revideo_blog_posts = new WP_Query( $revideo_blog_posts_args );

					if ( $revideo_blog_posts->have_posts() ) { while ( $revideo_blog_posts->have_posts() ) { 
						
						$revideo_blog_posts->the_post();

							get_template_part( 'template-parts/content');

						wp_reset_postdata();

					} } else {

						get_template_part( 'template-parts/content', 'none' );

					}

		            the_posts_pagination( array(
		                'type'      => 'list',
		                'prev_text'   => esc_html__('Prev', 'revideo'),
		                'next_text'   => esc_html__('Next', 'revideo'),
		                'screen_reader_text'=> '&nbsp;'
		            ));
	    		?>


			</div>

			<?php videostories_sidebar();?>

        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </div><!-- /.blog-posts -->


<?php
get_footer();

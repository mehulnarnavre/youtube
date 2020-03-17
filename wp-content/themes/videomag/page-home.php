<?php
/*
Template Name: Homepage
*/


get_header(); 
?>




 <section class="videomag-home">

	  <section class="top-videos">
	    <div class="section-padding">
	      <div class="container">
	        <div class="recent-movie-slider owl-carousel owl-theme">

	        	<?php
					global $post;
					$count = 5;
					$sticky = get_option( 'sticky_posts' );
					$query_args = array(
					  	'post_type' => 'post',
					  	'posts_per_page' => $count,
						'post__in'            => $sticky,
						'ignore_sticky_posts' => 1,
					);
					$block_query = new WP_Query( $query_args );	        	
		        	if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

				  	$terms = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "all"));  
				  	$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videomag-slider-thumb' ) );

				  	$t = array();                    
				  	foreach($terms as $term)
				    	$t[] = $term->slug;
				    ?>


		          <div class="item">
		            <article id="movie-<?php the_ID(); ?>" <?php post_class(); ?>>
		              <div class="entry-thumbnail">
		                
		                <a href="<?php the_permalink();?>">
		                  <?php if( has_post_thumbnail() ){ the_post_thumbnail('videomag-slider-thumb'); } ?>
		                </a>
		                
		                <span class="rating">
		                	<i class="fa fa-star"></i>
		            	</span>

		              </div><!-- /.entry-thumbnail -->
		              <div class="entry-content">
		                <h3 class="entry-title">
		                	<a href="<?php the_permalink();?>">
		                		<?php the_title();?>
		                	</a>
		                </h3><!-- /.entry-title -->
		              </div><!-- /.entry-content -->
		            </article><!-- /.post -->
		          </div>

		        <?php } } wp_reset_postdata(); wp_reset_query(); ?>      


	      </div><!-- /.container -->
	    </div><!-- /.section-padding -->
	  </section><!-- /.top-videos -->


    <div class="section-padding">
      	<div class="container">
        	<div class="row">

				<div class="col-sm-8">

					<?php 
						$count = 5;
						$query_args = array(
						  	'post_type' => 'post',
						  	'posts_per_page' => 5,
							'ignore_sticky_posts' => 1,
						);
						$posts_query = new WP_Query( $query_args );	        	
		        	

    					if ( $posts_query->have_posts() ) { while ( $posts_query->have_posts() ) { $posts_query->the_post();

    							get_template_part( 'template-parts/content');

				              	the_posts_pagination( array(
				                  'type'      => 'list',
				                  'prev_text'   => esc_html__('Prev', 'videomag'),
				                  'next_text'   => esc_html__('Next', 'videomag'),
				                  'screen_reader_text'=> '&nbsp;'
				              	));

    					} } else {
    						get_template_part( 'template-parts/content', 'none' );
    					}



					?>

				</div>

				<?php videomag_sidebar();?>

			</div>
		</div>
	</div>
</section>

<?php
get_footer();

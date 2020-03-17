<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VideoStories
 */

get_header();
?>

  <div class="blog-posts">
    <div class="section-padding">
      <div class="container">
        <div class="row">

        	<div class="col-sm-8">
    				<?php
    					if ( have_posts() ) { while ( have_posts() ) { the_post();
    							get_template_part( 'template-parts/content');
    					} } else {
    						get_template_part( 'template-parts/content', 'none' );
    					}


              the_posts_pagination( array(
                  'type'      => 'list',
                  'prev_text'   => esc_html__('Prev', 'videostories'),
                  'next_text'   => esc_html__('Next', 'videostories'),
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

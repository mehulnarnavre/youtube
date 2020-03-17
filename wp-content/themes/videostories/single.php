<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package VideoStories
 */
get_header(); ?>

	<section class="blog-posts single-post">
	    <div class="section-padding">
	      <div class="container">
	        <div class="row">
	        	<div class="col-sm-8">

      				<?php
	      					if ( have_posts() ) { while ( have_posts() ) { the_post();
	  							get_template_part( 'template-parts/content', 'single');

								// If comments are open or we have at least one comment, load up the comment template.
	  							if ( comments_open() || get_comments_number() ) {
	  								comments_template();
	  							}

	      					} } else {
	      						get_template_part( 'template-parts/content', 'none' );
	      					}
      				?>

				</div>

				<?php videostories_sidebar();?>

	        </div><!-- /.row -->
	      </div><!-- /.container -->
	    </div><!-- /.section-padding -->
	</section><!-- /.blog-posts -->

<?php
get_footer();

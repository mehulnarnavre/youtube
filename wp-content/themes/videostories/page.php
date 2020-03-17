<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VideoStories
 */

get_header(); ?>

 <section class="page-content">
    <div class="section-padding">
      	<div class="container">
        	<div class="row">
				<div class="col-sm-8">

					<?php while ( have_posts() ) { the_post();

							get_template_part( 'template-parts/content', 'page' );

							// Comments Open by default
							if ( comments_open() || get_comments_number() ) { comments_template(); }

						} // End of the loop.
					?>

				</div>

				<?php videostories_sidebar();?>

			</div>
		</div>
	</div>
</section>

<?php
get_footer();

<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VideoStories
 */

get_header(); ?>

  <section class="video-contents category-sorting column-3">
    <div class="section-padding">
      <div class="container">
        <div class="row">

        <?php if ( have_posts() ) { ?>

            <div class="col-sm-8">
              <?php
                the_archive_title( '<h2 class="section-title">', '</h2>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
              ?>
              <div class="row">
                <?php while ( have_posts() ) { the_post();
                    get_template_part( 'template-parts/content', 'category');
                  }
                ?>
              </div>
               <?php
                    the_posts_pagination( array(
                      'type'      => 'list',
                      'prev_text'   => esc_html__('Prev', 'videostories'),
                      'next_text'   => esc_html__('Next', 'videostories'),
                      'screen_reader_text'=> '&nbsp;'
                  ));
                ?>
            </div>

          <?php } ?>

          <?php videostories_sidebar();?>

        </div>
      </div>
    </div>
  </section>

<?php get_footer();
<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package VideoStories
 */

get_header(); ?>

<section class="blog-posts">
  <div class="section-padding">
    <div class="container">
      <div class="row">

        <div class="col-sm-8">

          <?php if ( have_posts() ) { ?>
          
            <header class="page-header">
              <?php /* translators: %s: search term */ ?>
              <h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'videostories' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
            </header><!-- .page-header -->

          <?php while ( have_posts() ) { the_post();
               get_template_part( 'template-parts/content');
             }
             the_posts_pagination( array(
              'type'      => 'list',
              'prev_text'   => esc_html__('Prev', 'videostories'),
              'next_text'   => esc_html__('Next', 'videostories'),
              'screen_reader_text'=> '&nbsp;'
            ));
           } else {
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

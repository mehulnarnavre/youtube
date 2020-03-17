<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VideoStories
 */

?>



  <footer class="site-footer">

    <?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>

      <div class="footer-top background-bg">
        <div class="overlay">
          <div class="section-padding">
            <div class="container">


              <div class="row">
                <div class="footer-widgets">

                  <?php dynamic_sidebar('footer-sidebar'); ?>

                </div>
              </div><!-- /.row -->
            </div><!-- /.container -->
          </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
      </div><!-- /.footer-top -->

    <?php } // end of footer sidebar ?>


    <div class="footer-bottom">
      <div class="padding">
        <div class="container">
          <div class="copyright text-center">
            <?php videostories_copyrights_text();?>
          </div><!-- /.copyright -->
        </div><!-- /.container -->
      </div><!-- /.padding -->
    </div><!-- /.footer-bottom -->
  </footer><!-- /.footer -->



<?php wp_footer(); ?>

</body>
</html>

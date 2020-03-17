<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VideoStories
 */
?>



	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php videostories_post_format_content_single_thumbs(); ?>

		<div class="entry-content">

			<h1 class="entry-title"><?php the_title();?></h1><!-- /.entry-title -->

			<?php videostories_entry_post_meta(); ?>

			<?php the_content();?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'videostories' ),
					'after'  => '</div>',
					) );
			?>


		</div><!-- /.entry-content -->



	</article><!-- /.post -->



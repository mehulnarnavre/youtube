<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ReVideo
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php revideo_post_format_content_thumbs();?>

	<div class="entry-content">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
			<?php revideo_entry_post_meta(); ?>
		<?php
		endif; ?>


		<p class="description">
			<?php echo esc_html( wp_trim_words( get_the_content(), 40, ' '  ) ); ?>
		</p><!-- /.description -->

		<a class="btn read-more" href="<?php the_permalink();?>">
			<?php echo esc_html__('Continue Reading...', 'revideo');?>		
		</a>


	</div><!-- /.entry-content -->
</article><!-- /.post -->

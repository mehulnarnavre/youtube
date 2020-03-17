<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VideoStories
 */
$categories_list = get_the_category_list( esc_html__( ', ', 'videostories' ) );
?>

<div class="col-md-4 col-sm-6">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php videostories_post_format_content_thumbs();?>

		<div class="entry-content">
			<?php if ( $categories_list && videostories_categorized_blog() ) {
						printf( '<span class="category tag">' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
					}
					?>

					<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3><!-- /.entry-title -->

					<?php videostories_entry_post_meta();?>

				</div><!-- /.emtry-content -->
			</article>
		</div>

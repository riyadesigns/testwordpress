<?php
/**
 * Author Template
 *
 * @package Zozothemes
 */
 
global $zozo_options;
get_header();
 
$container_class = $scroll_type = $scroll_type_class = '';
$post_type_layout = $excerpt_limit = '';

if( $zozo_options['zozo_archive_blog_type'] == 'grid' ) {	
	if( $zozo_options['zozo_archive_blog_grid_columns'] != '' ) {
		if( $zozo_options['zozo_archive_blog_grid_columns'] == 'two' ) {
			$container_class = 'grid-layout grid-col-2';
		} elseif ( $zozo_options['zozo_archive_blog_grid_columns'] == 'three' ) {
			$container_class = 'grid-layout grid-col-3';
		} elseif ( $zozo_options['zozo_archive_blog_grid_columns'] == 'four' ) {
			$container_class = 'grid-layout grid-col-4';
		}
	}
	$post_class = 'grid-posts';
	$image_size = 'blog-medium';
	$page_type_layout = 'grid';
	$excerpt_limit = $zozo_options['zozo_blog_excerpt_length_grid'];
	
} elseif( $zozo_options['zozo_archive_blog_type'] == 'large' ) {
	$container_class = 'large-layout';
	$post_class = 'large-posts';
	$image_size = 'blog-large';
	$post_type_layout = 'large';
	$excerpt_limit = $zozo_options['zozo_blog_excerpt_length_large'];
	
} elseif( $zozo_options['zozo_archive_blog_type'] == 'list' ) {
	$container_class = 'list-layout';
	$post_class = 'list-posts';	
	$image_size = 'blog-medium';
	$page_type_layout = 'list';
	$excerpt_limit = apply_filters( 'zozo_blog_list_excerpt_length', 30 );
}

if( $zozo_options['zozo_disable_blog_pagination'] ) {
	$scroll_type = "infinite";
	$scroll_type_class = " scroll-infinite";
} else {
	$scroll_type = "pagination";
	$scroll_type_class = " scroll-pagination";
} ?>

<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container <?php zozo_content_sidebar_classes(); ?>">
			<div class="zozo-row row">
				<div id="primary" class="content-area <?php zozo_primary_content_classes(); ?>">
					<div id="content" class="site-content">
						<?php echo zozo_author_info(); ?>
						<div id="archive-posts-container" class="zozo-posts-container <?php echo esc_attr( $container_class ); ?><?php echo esc_attr($scroll_type_class); ?> clearfix">
						<?php if ( have_posts() ):
							while ( have_posts() ): the_post();
								include( locate_template( 'partials/blog/blog-layout.php' ) );
							endwhile;				
							
							else : ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
						</div>
						
						<?php echo zozo_pagination( $pages = '', $scroll_type ); ?>
						
					</div><!-- #content -->
				</div><!-- #primary -->
			
				<?php get_sidebar(); ?>
			</div>
		</div><!-- #single-sidebar-container -->

		<?php get_sidebar( 'second' ); ?>

	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
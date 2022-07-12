<?php
/**
 * Archive Template
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
	$post_class = 'list-posts clearfix';	
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
						<?php // Featured Post Slider
						if( isset( $zozo_options['zozo_show_archive_featured_slider'] ) && $zozo_options['zozo_show_archive_featured_slider'] == 1 && $zozo_options['zozo_featured_slider_type'] == 'above_content' ) {
							get_template_part('partials/blog/featured', 'slider' );	
						} ?>
									
						<?php $category = '';
						$category = get_queried_object();
						if( isset( $category->term_id ) && $category->term_id != '' ) {
						   	$term_meta = get_option( "taxonomy_$category->term_id" );
						} ?>
						<div class="archive-header">
							<?php if( isset( $term_meta['zozo_thumbnail_image'] ) && $term_meta['zozo_thumbnail_image'] != '' ) { ?>
								<div class="category-image">
									<img class="img-responsive" src="<?php echo esc_url($term_meta['zozo_thumbnail_image']); ?>" alt="<?php echo esc_attr( $category->term_id ); ?>" />
								</div>
							<?php } ?>							
						</div>
						
						<?php if( isset( $category->term_id ) && is_tag( $category->term_id  ) ) {								
							$args['tax_query'] = array( array( 
													'taxonomy' => 'post_tag', 
													'field' => 'id', 
													'terms' => $category->term_id 
												));
						} elseif( isset( $category->term_id ) ) {
							$args['tax_query'] = array( array( 
													'taxonomy' => 'category', 
													'field' => 'id', 
													'terms' => $category->term_id 
												));
						}
						
						if( ! empty( $args ) ) {
							new WP_Query($args); 
						} ?>
						
						<div id="archive-posts-container" class="zozo-posts-container <?php echo esc_attr($container_class); ?><?php echo esc_attr($scroll_type_class); ?> clearfix">
							<?php if ( have_posts() ):
								while ( have_posts() ): the_post();
									include( locate_template( 'partials/blog/blog-layout.php' ) );
								endwhile;
								
								else :
									get_template_part( 'content', 'none' );
							endif; ?>
						</div>
						<?php echo zozo_pagination( $pages = '', $scroll_type );
						
						wp_reset_postdata(); ?>
					
					</div><!-- #content -->
				</div><!-- #primary -->
			
				<?php get_sidebar(); ?>
			</div>		
		</div><!-- #single-sidebar-container -->

		<?php get_sidebar( 'second' ); ?>
		
	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
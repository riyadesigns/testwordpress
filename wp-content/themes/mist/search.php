<?php
/**
 * Search Page Template
 *
 * @package Zozothemes
 */
 
global $zozo_options;
get_header(); 

$container_class = $scroll_type = $scroll_type_class = '';
$post_type_layout = $excerpt_limit = '';

if( $zozo_options['zozo_search_page_type'] == 'grid' ) {	
	if( $zozo_options['zozo_search_grid_columns'] != '' ) {
		if( $zozo_options['zozo_search_grid_columns'] == 'two' ) {
			$container_class = 'grid-layout grid-col-2';
		} elseif ( $zozo_options['zozo_search_grid_columns'] == 'three' ) {
			$container_class = 'grid-layout grid-col-3';
		} elseif ( $zozo_options['zozo_search_grid_columns'] == 'four' ) {
			$container_class = 'grid-layout grid-col-4';
		}
	}
	$post_class = 'grid-posts';
	$image_size = 'blog-medium';
	$page_type_layout = 'grid';
	$excerpt_limit = $zozo_options['zozo_blog_excerpt_length_grid'];
	
} elseif( $zozo_options['zozo_search_page_type'] == 'large' ) {
	$container_class = 'large-layout';
	$post_class = 'large-posts';
	$image_size = 'blog-large';
	$post_type_layout = 'large';
	$excerpt_limit = $zozo_options['zozo_blog_excerpt_length_large'];
	
} elseif( $zozo_options['zozo_search_page_type'] == 'list' ) {
	$container_class = 'list-layout';
	$post_class = 'list-posts clearfix';	
	$image_size = 'blog-medium';
	$page_type_layout = 'list';
	$excerpt_limit = apply_filters( 'zozo_blog_list_excerpt_length', 30 );
}

$scroll_type = "pagination";
$scroll_type_class = " scroll-pagination";
?>

<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container <?php zozo_content_sidebar_classes(); ?>">
			<div class="zozo-row row">	
				<div id="primary" class="content-area <?php zozo_primary_content_classes(); ?>">
					<div id="content" class="site-content">
						<?php if ( have_posts() && strlen( trim( get_search_query() ) ) != 0 ): ?>
							<div class="zozo-search-page search-page-form">
								<h4><?php esc_html_e( 'New Search', 'mist' ); ?></h4>
																	
								<p><?php esc_html_e('If you didn\'t find what you were looking for, try another search', 'mist'); ?></p>
								<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form search-page">
									<div class="input-group">
										<input type="text" value="" name="s" class="form-control" placeholder="<?php esc_html_e('Search...', 'mist'); ?>" />
										<span class="input-group-btn">
											<button class="btn btn-search" type="submit"><?php esc_html_e('Go', 'mist'); ?></button>
										</span>
									</div>
								</form>		
							</div>	
							
							<div id="archive-posts-container" class="zozo-posts-container zozo-search-results-wrapper <?php echo esc_attr($container_class); ?><?php echo esc_attr($scroll_type_class); ?> clearfix">
	
							<?php while ( have_posts() ): the_post();
								include( locate_template( 'partials/blog/blog-layout.php' ) );
							endwhile; ?>
							
							</div>							
							
						<?php else : ?>
							<div class="zozo-search-no-results">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post-inner-wrapper">
									<div class="posts-content-container">
										<div class="entry-header">			   
											<h1 class="entry-title"><?php esc_html_e('Nothing Found', 'mist'); ?></h1>			
											<p><?php esc_html_e('Sorry, but no posts matched your search terms. Please try again with different keywords.', 'mist'); ?></p>
										</div><!-- .entry-header -->
										<div class="entry-content">
											<h4><?php esc_html_e('Try New Search', 'mist'); ?></h4>
											<?php get_search_form(); ?>
										</div><!-- .entry-content -->
									</div><!-- .posts-content-container -->		
								</div><!-- .post-inner-wrapper -->
							</article><!-- #post -->
							</div>
						<?php endif; ?>
						
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
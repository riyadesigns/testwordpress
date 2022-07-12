<?php
/**
 * Taxonomy Portfolio Tags Template
 *
 * @package Zozothemes
 */
 
global $zozo_options;
get_header(); ?>

<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container <?php zozo_content_sidebar_classes(); ?>">
			<div class="zozo-row row">	
				<div id="primary" class="content-area <?php zozo_primary_content_classes(); ?>">
					<div id="content" class="site-content">
						<?php
						global $wp_query; 
						$term = $wp_query->get_queried_object();
						$term_id = $term->term_id;
						
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						
						if( isset( $zozo_options['zozo_portfolio_archive_count'] ) && $zozo_options['zozo_portfolio_archive_count'] != '' ) {
							$posts = $zozo_options['zozo_portfolio_archive_count'];
						} else {
							$posts = 10;
						}
						
						if( isset( $zozo_options['zozo_portfolio_archive_layout'] ) && $zozo_options['zozo_portfolio_archive_layout'] != '' ) {
							$style = $zozo_options['zozo_portfolio_archive_layout'];
						} else {
							$style = 'grid';
						}
						
						if( isset( $zozo_options['zozo_portfolio_archive_columns'] ) && $zozo_options['zozo_portfolio_archive_columns'] != '' ) {
							$grid_columns = $zozo_options['zozo_portfolio_archive_columns'];
						} else {
							$grid_columns = 4;
						}
						
						if( isset( $zozo_options['zozo_portfolio_archive_gutter'] ) && $zozo_options['zozo_portfolio_archive_gutter'] != '' ) {
							$grid_gutter = $zozo_options['zozo_portfolio_archive_gutter'];
						} else {
							$grid_gutter = 30;
						}
						
						$query = new WP_Query(array('post_type'  	=> 'zozo_portfolio',
												'posts_per_page'	=> $posts,
												'paged' 			=> $paged,
												'orderby' 		 	=> 'date',
												'order' 		 	=> 'DESC',
												'tax_query' 	 	=> array(
																	   array(
																		'taxonomy' 	=> 'portfolio_tags',
																		'field' 	=> 'id',
																		'terms' 	=> $term_id
																	) )));
						?>
						<?php if ( $query->have_posts() ):
							echo '<div class="zozo-portfolio-grid-wrapper clearfix">';
							
								if( isset( $style ) && $style == 'classic' ) {
									echo '<div id="zozo_portfolio_'.$term_id.'" class="zozo-portfolio classic-grid-style portfolio-cols-'.$grid_columns.'" data-columns="'.$grid_columns.'" data-gutter="'.$grid_gutter.'">'. "\n";
								} else {
									echo '<div id="zozo_portfolio_'.$term_id.'" class="zozo-portfolio default-grid-style portfolio-cols-'.$grid_columns.'" data-columns="'.$grid_columns.'" data-gutter="'.$grid_gutter.'">';
								}
			
								echo '<div class="portfolio-inner">';
								while ( $query->have_posts() ): $query->the_post();
								
									if( isset( $grid_columns ) && $grid_columns == '2' ) {
										$image_size = 'portfolio-large';
									} else {
										$image_size = 'portfolio-mid';
									}
									
									$portfolio_img = '';
									$portfolio_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size); ?>
									
									<div id="portfolio-<?php the_ID(); ?>" <?php post_class('portfolio-item'); ?>>
										<div class="portfolio-content">
											<?php $portfolio_large = ''; 
											$portfolio_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
											$author_rating 	 = get_post_meta( $post->ID, 'zozo_author_rating', true );
											$custom_text 	 = get_post_meta( $post->ID, 'zozo_portfolio_custom_text', true ); 
											
											if( isset( $style ) && $style == 'classic' ) {
												echo '<a href="'.esc_url( $portfolio_large[0] ).'" data-rel="prettyPhoto[gallery'.$term_id.']" class="classic-img-link" title="'.get_the_title().'"><img class="img-responsive" src="'.esc_url($portfolio_img[0]).'" width="'.esc_attr($portfolio_img[1]).'" height="'.esc_attr($portfolio_img[2]).'" alt="'.get_the_title().'" /></a>';
												
												echo '<div class="portfolio-inner-wrapper">';
													echo '<div class="portfolio-inner-content">';
														if( isset( $custom_text ) && $custom_text != '' ) {
															echo '<h5><a href="'. get_permalink() .'" title="'.get_the_title().'">'.get_the_title().'<p class="portfolio-custom-text pull-right">'. $custom_text .'</p></a></h5>';
														} else {
															echo '<h5><a href="'. get_permalink() .'" title="'.get_the_title().'">'.get_the_title().'</a></h5>';
														}
														
														if( isset( $author_rating ) && $author_rating != '' ) {
															echo '<div class="portfolio-rating">';	
																echo '<div class="rateit" data-rateit-value="'.$author_rating.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
															echo '</div>';
														}
														echo '<p>' . zozo_shortcode_stripped_excerpt( get_the_content(), 15 ) . '</p>';
														
														echo '<a href="'. get_permalink() .'" class="btn btn-more" title="'.get_the_title().'">'. __('Read more', 'mist') .'</a>';
														
													echo '</div>';
												echo '</div>';
											} else {
												echo '<img class="img-responsive" src="'.esc_url($portfolio_img[0]).'" width="'.esc_attr($portfolio_img[1]).'" height="'.esc_attr($portfolio_img[2]).'" alt="'.get_the_title().'" />';
												
												echo '<div class="portfolio-overlay">';
													echo '<div class="portfolio-mask">';
																			
													echo '<div class="portfolio-title">';
														echo '<h4>'.get_the_title().'</h4>';
														echo '<p>' . zozo_shortcode_stripped_excerpt( get_the_content(), 8 ) . '</p>';
													echo '</div>';
													echo '<a href="'.esc_url( $portfolio_large[0] ).'" data-rel="prettyPhoto[gallery'.$term_id.']" title="'.get_the_title().'"><i class="fa fa-search"></i></a>';
													echo '<a href="'. get_permalink() .'" title="'.get_the_title().'"><i class="fa fa-link"></i></a>';
													echo '</div>';
												echo '</div>';
											} ?>
											
										</div>
									</div><!-- #post -->
									
								<?php endwhile; ?>
								</div>
								<?php echo zozo_pagination( $query->max_num_pages, '' ); ?>
								
								</div>
							</div>
								
						<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
								
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
						
					</div><!-- #content -->
				</div><!-- #primary -->
				<?php get_sidebar(); ?>
				
			</div>
		</div><!-- #single-sidebar-container -->

		<?php get_sidebar( 'second' ); ?>
		
	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
<?php
/**
 * Taxonomy Testimonial Categories Template
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
							
							$query = new WP_Query(array('post_type'  => 'zozo_testimonial',
													'posts_per_page' => -1,
													'orderby' 		 => 'date',
													'order' 		 => 'DESC',
													'tax_query' 	 => array(
																	   array(
																		'taxonomy' => 'testimonial_categories',
																		'field' => 'id',
																		'terms' => $term_id
																	) )));
						?>
						<?php if ( $query->have_posts() ):
							echo '<div class="zozo-testimonial-grid-wrapper testimonial-archives testimonials-left">';
							echo '<div class="testimonial-grid-inner">';
			
								while ( $query->have_posts() ): $query->the_post();
								
								$author_designation = get_post_meta( $post->ID, 'zozo_author_designation', true );
								$author_company 	= get_post_meta( $post->ID, 'zozo_author_company_name', true );
								$author_company_url = get_post_meta( $post->ID, 'zozo_author_company_url', true );
								$author_rating 		= get_post_meta( $post->ID, 'zozo_author_rating', true ); ?>
								
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="testimonial-item text-left">
										
										<div class="testimonial-author-wrapper">
											<?php if( has_post_thumbnail() ) { ?>
												<div class="testimonial-img">
													<?php the_post_thumbnail( 'blog-thumb' ); ?>
												</div>
											<?php } ?>
											
											<?php if( isset( $author_rating ) && $author_rating != '' ) { ?>
												<div class="testimonial-rating">
													<div class="rateit" data-rateit-value="<?php echo esc_attr( $author_rating ); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
												</div>
											<?php } ?>
										</div>
										
										<div class="testimonial-info-wrapper">
											<div class="testimonial-content">
												<blockquote><p><?php echo zozo_shortcode_stripped_excerpt( get_the_content(), '35' ); ?><p></blockquote>
											</div>
									
											<div class="author-details">
												<p><span class="testimonial-author-name"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span></p>
												<p class="author-designation-info">
												<?php if( isset( $author_designation ) && $author_designation != '' ) {
													echo '<span class="testimonial-author-designation">'.$author_designation.'</span>';
												}
												if( isset( $author_company ) && $author_company != '' ) {
													if( isset( $author_company_url ) && $author_company_url != '' ) {
														echo '<span class="testimonial-author-company"><a href="'.esc_url( $author_company_url ).'" target="_blank">'.$author_company.'</a></span>';
													} else {
														echo '<span class="testimonial-author-company">'.$author_company.'</span>';
													}
												} ?>
												</p>
											</div>
										</div>
										
									</div>
								</div><!-- #post -->
									
								<?php endwhile;
								
							echo '</div>';
							echo '</div>';
								
						else : ?>
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
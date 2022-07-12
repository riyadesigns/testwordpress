<?php
/**
 * Single Testimonials Page
 *
 * @package Zozothemes
 */
 
global $zozo_options;
get_header();
?>

<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container <?php zozo_content_sidebar_classes(); ?>">
			<div class="zozo-row row">
				<div id="primary" class="content-area <?php zozo_primary_content_classes(); ?>">
					<div id="content" class="site-content">
						<?php if ( have_posts() ):
						while ( have_posts() ): the_post();
							
							$author_designation = get_post_meta( $post->ID, 'zozo_author_designation', true );
							$author_company 	= get_post_meta( $post->ID, 'zozo_author_company_name', true );
							$author_company_url = get_post_meta( $post->ID, 'zozo_author_company_url', true );
							$author_rating 		= get_post_meta( $post->ID, 'zozo_author_rating', true ); ?>

							<div id="testimonial-content-wrap" class="testimonial-single clearfix">										
								<div <?php post_class(); ?> id="testimonial-<?php the_ID(); ?>">
									
									<div class="testimonial-item tstyle-border">
										<div class="testimonial-content">
											<blockquote><?php the_content(); ?></blockquote>
											
											<?php if( isset( $author_rating ) && $author_rating != '' ) { ?>
												<div class="testimonial-rating">
													<div class="rateit" data-rateit-value="<?php echo esc_attr( $author_rating ); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
												</div>
											<?php } ?>
										</div>
										
										<div class="author-info-box clearfix">
											<?php if( has_post_thumbnail() ) { ?>
												<div class="testimonial-img">
													<?php the_post_thumbnail( 'blog-thumb' ); ?>
												</div>
											<?php } ?>
										
											<div class="author-details">
												<h5 class="testimonial-author-name"><?php the_title(); ?></h5>
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
									
									<?php zozo_postnavigation(); ?>
									
								</div>
							</div>
							
							<?php 					
							endwhile;
							
							else : ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
					</div><!-- #content -->
				</div><!-- #primary -->
		
				<?php get_sidebar(); ?>	
			</div>
		</div><!-- #single-sidebar-container -->

		<?php get_sidebar( 'second' ); ?>

	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
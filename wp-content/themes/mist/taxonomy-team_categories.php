<?php
/**
 * Taxonomy Team Categories Template
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
						$post_count = 1;
						
						$query = new WP_Query(array('post_type'  => 'zozo_team_member',
												'posts_per_page' => -1,
												'orderby' 		 => 'date',
												'order' 		 => 'DESC',
												'tax_query' 	 => array(
																   array(
																	'taxonomy' 	=> 'team_categories',
																	'field' 	=> 'id',
																	'terms' 	=> $term_id
																) )));
						?>
						<?php if ( $query->have_posts() ):
							echo '<div class="zozo-team-list-wrapper clearfix">';
								echo '<div class="team-list-inner">';
								while ( $query->have_posts() ): $query->the_post();
								
									$align_class = '';
									if( ($post_count % 2) > 0 ) {
										$align_class = " pull-left";
									} else {
										$align_class = " pull-right";
									}
									
									$team_img 			= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-medium');
									$member_name 		= get_post_meta( $post->ID, 'zozo_member_name', true );
									$member_designation = get_post_meta( $post->ID, 'zozo_member_designation', true );
									$member_desc 		= get_post_meta( $post->ID, 'zozo_member_description', true ); ?>
									
									<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<div class="row team-item text-left">
											<div class="col-md-6 col-xs-12<?php echo esc_attr( $align_class ); ?>">
											<?php if( isset( $team_img ) && $team_img != '' ) { ?>
												<div class="team-item-img">
													<img src="<?php echo esc_url($team_img[0]); ?>" width="<?php echo esc_attr($team_img[1]); ?>" height="<?php echo esc_attr($team_img[2]); ?>" alt="<?php the_title(); ?>" class="img-responsive" />
												</div>
											<?php } ?>
											</div>
											
											<div class="col-md-6 col-xs-12">
												<div class="team-content">
													<?php if( isset( $member_name ) && $member_name != '' ) {
														echo '<h4 class="team-member-name">'.$member_name.' / <span class="team-member-designation">'. $member_designation .'</span></h4>';
													}
													if( isset( $member_desc ) && $member_desc != '' ) {
														echo '<div class="team-member-desc">'.do_shortcode( $member_desc ).'</div>';
													} ?>
												</div>
											</div>
										</div>
									</div><!-- #post -->
									
								<?php $post_count++;
								endwhile; ?>
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
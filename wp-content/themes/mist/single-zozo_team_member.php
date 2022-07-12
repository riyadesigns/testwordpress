<?php
/**
 * Single Team Page
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
							
							$args = array(
									   'post_type' 		=> 'attachment',
									   'numberposts' 	=> -1,
									   'post_status' 	=> null,
									   'post_parent' 	=> $post->ID,
									   'post_mime_type' => 'image',
									   'orderby'        => 'title',
									   'order' 		 	=> 'ASC',
								  	);
								
							$attachments = get_posts( $args );
							
							$member_name 		= get_post_meta( $post->ID, 'zozo_member_name', true );
							$member_designation = get_post_meta( $post->ID, 'zozo_member_designation', true );
							$member_desc 		= get_post_meta( $post->ID, 'zozo_member_description', true );
							$email 				= get_post_meta( $post->ID, 'zozo_member_email', true );
							$facebook 			= get_post_meta( $post->ID, 'zozo_member_facebook', true );
							$twitter 			= get_post_meta( $post->ID, 'zozo_member_twitter', true );
							$linkedin 			= get_post_meta( $post->ID, 'zozo_member_linkedin', true );
							$pinterest 			= get_post_meta( $post->ID, 'zozo_member_pinterest', true );
							$dribbble 			= get_post_meta( $post->ID, 'zozo_member_dribbble', true );
							$skype 				= get_post_meta( $post->ID, 'zozo_member_skype', true );
							$yahoo 				= get_post_meta( $post->ID, 'zozo_member_yahoo', true );
							$youtube 			= get_post_meta( $post->ID, 'zozo_member_youtube', true );
							$link_target 		= get_post_meta( $post->ID, 'zozo_member_link_target', true );
							
							$data_attr = '';
		
							$data_attr .= ' data-items="1"';
							$data_attr .= ' data-slideby="1"';
							$data_attr .= ' data-items-tablet="1"';
							$data_attr .= ' data-items-mobile-landscape="1"';
							$data_attr .= ' data-items-mobile-portrait="1"';
							$data_attr .= ' data-autoplay="true"';
							$data_attr .= ' data-autoplay-timeout="5000"';
							$data_attr .= ' data-loop="false"';
							$data_attr .= ' data-pagination="true"';
							$data_attr .= ' data-navigation="false"'; ?>

							<div id="team-content-wrap" class="team-single clearfix">										
								<div <?php post_class(); ?> id="team-<?php the_ID(); ?>">
									
									<div class="row">
										<div class="col-md-5 col-xs-12">		
											<?php if ( $attachments ) {	
													echo '<div id="team-gallery" class="zozo-owl-carousel owl-carousel team-gallery-slider"'. $data_attr .'>';													
													foreach ( $attachments as $attachment ) {
														$posts_image   		= wp_get_attachment_image($attachment->ID, 'team');			
														$posts_image_link 	= wp_get_attachment_image_src($attachment->ID, 'full');
																																							
														echo '<div class="team-gallery-item"><a href="'.esc_url($posts_image_link[0]).'" data-rel="prettyPhoto[gallery'.esc_attr( $post->ID ).']" >' . $posts_image . '</a></div>';
													}
													echo '</div>';
												 } elseif( has_post_thumbnail() ) {
													echo '<div class="team-image">';
														the_post_thumbnail( 'team' );
													echo '</div>';
												 }
											 ?>
										</div>	
										<div class="col-md-7 col-xs-12">
											<div class="team-member-info">
												<?php if( isset( $member_name ) && $member_name != '' ) { ?>
													<h4 class="team-member-name"><?php echo esc_html( $member_name ); ?></h4>
												<?php }
												if( isset( $member_designation ) && $member_designation != '' ) { ?>
													<p class="team-member-designation"><?php echo esc_html( $member_designation ); ?></p>
												<?php } 
												if( ( isset( $facebook ) && $facebook != '' ) || ( isset( $twitter ) && $twitter != '' ) || ( isset( $linkedin ) && $linkedin != '' ) || ( isset( $pinterest ) && $pinterest != '' ) || ( isset( $dribbble ) && $dribbble != '' ) || ( isset( $skype ) && $skype != '' ) || ( isset( $yahoo ) && $yahoo != '' ) || ( isset( $youtube ) && $youtube != '' ) || ( isset( $email ) && $email != '' ) ) { 
													echo '<div class="zozo-team-social">';
														echo '<ul class="zozo-social-icons soc-icon-transparent zozo-team-social-list">';
															if( isset( $facebook ) && $facebook != '' ) {
																echo '<li class="facebook"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $facebook ).'"><i class="fa fa-facebook"></i></a></li>' . "\n";
															}
															if( isset( $twitter ) && $twitter != '' ) {
																echo '<li class="twitter"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $twitter ).'"><i class="fa fa-twitter"></i></a></li>' . "\n";
															}
															if( isset( $linkedin ) && $linkedin != '' ) {
																echo '<li class="linkedin"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $linkedin ).'"><i class="fa fa-linkedin"></i></a></li>' . "\n";
															}
															if( isset( $pinterest ) && $pinterest != '' ) {
																echo '<li class="pinterest"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $pinterest ).'"><i class="fa fa-pinterest"></i></a></li>' . "\n";
															}
															if( isset( $dribbble ) && $dribbble != '' ) {
																echo '<li class="dribbble"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $dribbble ).'"><i class="fa fa-dribbble"></i></a></li>' . "\n";
															}
															if( isset( $skype ) && $skype != '' ) {
																echo '<li class="skype"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $skype ).'"><i class="fa fa-skype"></i></a></li>' . "\n";
															}
															if( isset( $yahoo ) && $yahoo != '' ) {
																echo '<li class="yahoo"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $yahoo ).'"><i class="fa fa-yahoo"></i></a></li>' . "\n";
															}
															if( isset( $youtube ) && $youtube != '' ) {
																echo '<li class="youtube"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $youtube ).'"><i class="fa fa-youtube-play"></i></a></li>' . "\n";
															}
															if( isset( $email ) && $email != '' ) {
																echo '<li class="email"><a target="'.esc_attr( $link_target ).'" href="mailto:'.$email.'"><i class="fa fa-envelope"></i></a></li>' . "\n";
															}
														echo '</ul>';
													echo '</div>';
												}
												if( isset( $member_desc ) && $member_desc != '' ) { ?>
													<div class="team-member-desc"><?php echo do_shortcode( $member_desc ); ?></div>
												<?php } ?>
											</div>
										</div>									
									</div>
									
									<div class="entry-content team-content">
										<?php the_content(); ?>
									</div>
																		
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
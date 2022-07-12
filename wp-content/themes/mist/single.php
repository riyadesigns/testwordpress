<?php
/**
 * Single Post Template
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
							
							$gallery_images_type = '';
							
							$show_social_sharing 	= get_post_meta( $post->ID, 'zozo_show_social_sharing', true );
							$show_author_info 		= get_post_meta( $post->ID, 'zozo_show_author_info', true );
							$show_comments 			= get_post_meta( $post->ID, 'zozo_show_comments', true );
							$show_related_posts 	= get_post_meta( $post->ID, 'zozo_show_related_posts', true );
							$show_post_navigation 	= get_post_meta( $post->ID, 'zozo_show_post_navigation', true );
							$gallery_images_type 	= get_post_meta( $post->ID, 'zozo_gallery_images_type', true );
							
							$post_fields 	= array('socials' 		=> $show_social_sharing, 
													'author_info' 	=> $show_author_info, 
													'comments' 		=> $show_comments, 
													'related' 		=> $show_related_posts,
													'navigation' 	=> $show_post_navigation 
												);
							
							$theme_fields 	= array('socials' 		=> $zozo_options['zozo_blog_social_sharing'],
													'author_info' 	=> $zozo_options['zozo_blog_author_info'], 
													'comments' 		=> $zozo_options['zozo_blog_comments'], 
													'related' 		=> $zozo_options['zozo_show_related_posts'],
													'navigation' 	=> $zozo_options['zozo_blog_prev_next'] 
												);
							
							$post_values = array();
							if( isset( $post_fields ) && ! empty( $post_fields ) ) {
								foreach( $post_fields as $field => $value ) {
									if( isset( $value ) && $value == '' || $value == 'default' ) {
										$post_values[$field] = $theme_fields[$field];
									} else {
										$post_values[$field] = $value;
									}
								}
							}
							
							if( isset( $gallery_images_type ) && ( $gallery_images_type == '' || $gallery_images_type == 'default' ) ) {
								$options_gallery_type = $zozo_options['zozo_single_blog_carousel'];
								if( isset( $options_gallery_type ) && $options_gallery_type == 1 ) {
									$gallery_images_type = "carousel";
								} else {
									$gallery_images_type = "slider";
								}
							} ?>
								
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post-inner-wrapper">
								
									<?php include_once( locate_template( 'partials/blog/post-slider.php' ) ); ?>
									
									<div class="posts-content-container">
									<?php if( has_post_format('quote') ) { ?>			
										<!-- ========== Entry Content ========== -->			
										<div class="entry-content">
											<div class="entry-quotes quote-format">
												<blockquote>
													<?php echo the_content(); ?>
													<!-- ========== Title ========== -->
													<footer>
														<h1 class="entry-title">
															<?php the_title(); ?>
														</h1>
													</footer>
												</blockquote>
												<?php wp_link_pages( array(
														'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mist' ) . '</span>',
														'after'       => '</div>',
														'link_before' => '<span>',
														'link_after'  => '</span>',
													) );
												?>
											</div>
										</div><!-- .entry-content -->
									<?php } else { ?>
										
										<!-- ========== Entry Content ========== -->
										<div class="entry-content">
											<?php the_content(); ?>
											<?php wp_link_pages( array(
													'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mist' ) . '</span>',
													'after'       => '</div>',
													'link_before' => '<span>',
													'link_after'  => '</span>',
												) );
											?>
										</div><!-- .entry-content -->
										
										<!-- ========== Entry Meta ========== -->
										<div class="entry-meta-wrapper">
											<ul class="entry-meta">
												<!-- Entry Author -->
												<?php if( ! $zozo_options['zozo_blog_post_meta_author'] ): ?>
													<li class="author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></li>
												<?php endif; ?>
												<!-- Entry Date -->
												<?php if( ! $zozo_options['zozo_blog_post_meta_date'] ): ?>
													<li class="posted-date"><i class="fa fa-calendar"></i><?php the_time( $zozo_options['zozo_blog_date_format'] ); ?></li>
												<?php endif; ?>					
												<!-- Entry Category -->
												<?php if( ! $zozo_options['zozo_blog_post_meta_categories'] ): ?>
													<li class="category"><i class="fa fa-folder"></i><?php echo get_the_category_list(', '); ?></li>
												<?php endif; ?>
												<!-- Comments -->
												<?php if( ! $zozo_options['zozo_blog_post_meta_comments'] ): ?>
													<?php if ( comments_open() ) { ?>
														<li class="comments-link"><i class="fa fa-comments"></i><?php comments_popup_link( '<span class="leave-reply">' . esc_html__( '0 Comments', 'mist' ) . '</span>', esc_html__( '1 Comments', 'mist' ), esc_html__( '% Comments', 'mist' ) ); ?>
													</li>
													<?php }
												endif; ?>
											</ul>
										</div>
									<?php } ?>
														
									<!-- ========== Social Sharing & Tags ========== -->			
									<?php if( has_tag() || ( $post_values['socials'] == 'show' || $post_values['socials'] == 1 ) ) { ?>
									<div class="container tags-share-section">
										<div class="row">
											<?php if( has_tag() ) { ?>
												<div class="col-md-6">
													<?php the_tags('<div class="post-tags"><div class="tags-title"><i class="fa fa-tags"></i></div>', ', ', '</div>'); ?>
												</div>
												<div class="col-md-6">
													<?php if( $post_values['socials'] == 'show' || $post_values['socials'] == 1 ) {
														echo '<div class="share-options">';
														zozo_display_social_sharing_icons();
														echo '</div>';
													} ?>
												</div>
											<?php } else { ?>
												<div class="col-md-12">
													<?php if( $post_values['socials'] == 'show' || $post_values['socials'] == 1 ) {
														echo '<div class="share-options">';
														zozo_display_social_sharing_icons();
														echo '</div>';
													} ?>
												</div>
											<?php } ?>						
										</div>
									</div>				
									<?php } ?>
									</div><!-- .posts-content-container -->	
										
								</div><!-- .post-inner-wrapper -->
							</article><!-- #post -->								
									
							<?php if( $post_values['related'] == 'show' || $post_values['related'] == 1 ) { 
								get_template_part( 'partials/blog/related', 'posts' ); 
							}
													
							if( $post_values['navigation'] == 'show' || $post_values['navigation'] == 1 ) { 
								zozo_postnavigation();
							}
							
							if( $post_values['author_info'] == 'show' || $post_values['author_info'] == 1 ) { 
								zozo_author_info();
							}
							
							if( $post_values['comments'] == 'show' || $post_values['comments'] == 1 ) { 
								comments_template();
							}					
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
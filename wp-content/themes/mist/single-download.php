<?php
/**
 * Single Easy Digital Downlads
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
						while ( have_posts() ): the_post(); ?>

							<div <?php post_class(); ?> id="download-<?php the_ID(); ?>">
									
								<div class="row">
									<div class="col-md-6 col-xs-12">		
										<?php if( has_post_thumbnail() ) {
												$post_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
												echo '<div class="edd-download-image">';
												echo '<a href="'.esc_url($post_img[0]).'" data-rel="prettyPhoto">';
													the_post_thumbnail( 'theme-mid' );
												echo '</a>';
												echo '</div>';
											 }
										 ?>
									</div>	
									<div class="col-md-6 col-xs-12">
										<div class="edd-download-content-wrapper">
											<h4 class="edd_download_title"><?php the_title(); ?></h4>
											
											<?php if ( edd_has_variable_prices( get_the_ID() ) ) { ?>
												<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
													<div itemprop="price" class="edd_price">
														<?php echo edd_price_range( get_the_ID() ); ?>	
													</div>
												</div>
											<?php } else { ?>
												<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
													<div itemprop="price" class="edd_price">
														<?php edd_price( get_the_ID() ); ?>	
													</div>
												</div>
											<?php } ?>
											
											<div class="download-meta">
											<?php if(get_the_term_list($post->ID, 'download_category', '', ',', '')) { ?>												
												<span class="posted_in">
													<strong><?php esc_html_e('Category:', 'mist') ?></strong>
													<?php echo get_the_term_list($post->ID, 'download_category', '', ', ', ''); ?>
												</span>
											<?php } ?>
											
											<?php if(get_the_term_list($post->ID, 'download_tag', '', ',', '')) { ?>
												<span class="tagged_as">
													<strong><?php esc_html_e('Tag:', 'mist') ?></strong>
													<?php echo get_the_term_list($post->ID, 'download_tag', '', ', ', ''); ?>
												</span>
											<?php } ?>
											</div>
											
											<div class="edd_download_buy_button">
												<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
											</div>
											
											<div class="zozo-download-social-share-box zozo-social-share-box">
												<?php echo apply_filters( 'zozo_edd_socials_share_title', '<span>' . __( 'Share on:', 'mist' ) . '</span>' ); ?>
												<ul class="edd-social-share zozo-social-share-icons clearfix">
													<li class="facebook"><a href="<?php echo 'http://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;=' . get_permalink() . '&p&#91;title&#93;=' . wp_strip_all_tags( get_the_title(), true ) . ''; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
													
													<li class="twitter"><a href="<?php echo 'https://twitter.com/share?text=' . wp_strip_all_tags( get_the_title(), true ) . ' ' . get_permalink() . ''; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
													
													<li class="pinterest">
													<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
					
													<a href="<?php echo 'http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . urlencode( wp_strip_all_tags( get_the_title(), true ) ) . '&amp;media=' . urlencode( $full_image[0] ) . ''; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
													
													<li class="email"><a href="<?php echo 'mailto:?subject=' . wp_strip_all_tags( get_the_title(), true ) . '&amp;body=' . get_permalink() . ''; ?>" target="_blank"><i class="fa fa-envelope"></i></a></li>
												</ul>
											</div>
											
										</div>
									</div>									
								</div>
								
								<div class="entry-content edd-download-content">
									<?php the_content(); ?>
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
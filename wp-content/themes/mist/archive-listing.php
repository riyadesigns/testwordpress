<?php
/**
 * Archive Template for EPL
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
 
get_header(); ?>
<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container <?php zozo_content_sidebar_classes(); ?>">
			<div class="zozo-row row">	
				<div id="primary" class="content-area epl-archive-default <?php zozo_primary_content_classes(); ?>">
					<div id="content" class="site-content">
					
						<?php if ( have_posts() ) : ?>
							<div class="zozo-epl-listings-wrapper">
								<div class="entry-content loop-content">
									<?php do_action( 'epl_property_loop_start' ); ?>
									<div class="zozo-epl-listing-loop epl-clearfix">
										<?php while ( have_posts() ) : // The Loop
												the_post();
												do_action('epl_property_blog');
											endwhile; // end of one post
										?>
									</div>
									<?php do_action( 'epl_property_loop_end' ); ?>
								</div>
								
								<div class="loop-footer">
									<!-- Previous/Next page navigation -->
									<div class="loop-utility clearfix">
										<?php do_action('epl_pagination'); ?>
									</div>
								</div>
							</div>
						<?php else : ?>
							<div class="zozo-epl-listings-wrapper">
								<div class="entry-header clearfix">
									<h3 class="entry-title"><?php _e('Listing not Found', 'mist'); ?></h3>
								</div>
								
								<div class="entry-content clearfix">
									<p><?php _e('Listing not found, expand your search criteria and try again.', 'mist'); ?></p>
								</div>
							</div>
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
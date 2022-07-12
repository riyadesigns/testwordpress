<?php
/*
 * Single Template for EPL
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
 
get_header(); ?>
<div class="container">
	<div id="main-wrapper" class="zozo-row row">
		<div id="single-sidebar-container" class="single-sidebar-container main-col-full">
			<div class="zozo-row row">	
				<div id="primary" class="content-area epl-single-default content-col-full">
					<div id="content" class="site-content">
						<?php if ( have_posts() ) : ?>
							<div class="zozo-epl-single-listing-wrapper">
								<div class="entry-content loop-content">
									<?php while ( have_posts() ) :
											the_post();
											do_action('epl_property_single');
										endwhile;
									?>
								</div>
							</div>
						<?php else : ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
					</div><!-- #content -->
				</div><!-- #primary -->
			</div>		
		</div><!-- #single-sidebar-container -->
	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
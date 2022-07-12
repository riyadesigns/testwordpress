<?php
/**
 * Default Page Template
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
						<?php if ( have_posts() ):
							while ( have_posts() ): the_post();	?>								
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>								
									<?php if ( has_post_thumbnail() ) { ?>
									<div class="entry-thumbnail">
										<?php the_post_thumbnail(); ?>
									</div>
									<?php } ?>
									<div class="entry-content">
										<?php the_content(); ?>
										<?php wp_link_pages( array(
												'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mist' ) . '</span>',
												'after'       => '</div>',
												'link_before' => '<span>',
												'link_after'  => '</span>',
											) );
										?>
									</div>									
									<?php if ( comments_open() ) {
										comments_template(); 
									} ?>
								</div>
							<?php endwhile;
						endif; ?>
					</div><!-- #content -->
				</div><!-- #primary -->
				
				<?php get_sidebar(); ?>
				
			</div>
		</div><!-- #single-sidebar-container -->

		<?php get_sidebar( 'second' ); ?>
		
	</div><!-- #main-wrapper -->
</div><!-- .container -->
<?php get_footer(); ?>
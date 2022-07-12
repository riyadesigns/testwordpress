<?php
/**
 * Template Name: Parallax Template
 *
 * The home page parallax template displays all sections from menu
 *
 * @package Zozothemes 
 */
 
global $zozo_options;
get_header(); ?>

<div id="single-sidebar-container" class="single-sidebar-container">
	<div class="zozo-row">	
		<div id="primary" class="content-area">
			<div id="content" class="site-content">            
				<?php $main_query = '';
					/* Check for primary navigation */
					if ( has_nav_menu( 'primary-menu' ) ) {
					
						$page_query = zozo_parallax_front_query();						
						
						/* Do not run query if no parallax sections are assigned to the menu */
						if( !empty( $page_query ) ) {													
							$main_query = new WP_Query( $page_query );							
						}

					}
					
					$front_page_id = get_option('page_on_front');
				
					if( is_object($main_query) ) {
						if ( $main_query->have_posts() ):
							while ( $main_query->have_posts() ): $main_query->the_post();
								global $post;
								$backup = $post;
								
								$post_id = get_the_ID();
							
								$zozo_additional_sections_order = get_post_meta( $post_id, 'zozo_parallax_additional_sections_order', true );
							
								get_template_part('template-parallax');
															
								if( $zozo_additional_sections_order != '' ) {
									$additional_query = zozo_parallax_additional_query( $zozo_additional_sections_order );
									
									if( !empty( $additional_query ) ) {
										$custom_query = new WP_Query( $additional_query );
									}
									if ( $custom_query->have_posts() ):
										while ( $custom_query->have_posts() ): $custom_query->the_post();
											$additional_post_id = get_the_ID();
											if( $front_page_id != $additional_post_id ) {
												get_template_part('template-parallax');
											}	
										endwhile;
									endif;
									wp_reset_postdata();
								}
								
								$post = $backup; ?>
							<?php endwhile;
						endif;
					}
					wp_reset_postdata();
				?>
			</div><!-- #content -->
		</div><!-- #primary -->
		
	</div>
</div><!-- #single-sidebar-container -->

<?php get_footer(); ?>
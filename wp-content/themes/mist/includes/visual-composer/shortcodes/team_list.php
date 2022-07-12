<?php 
/**
 * Team List shortcode 
 */

if ( ! function_exists( 'zozo_vc_team_list_shortcode' ) ) {
	function zozo_vc_team_list_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'text_align' 				=> 'left',
					'posts'						=> '-1',
					'show_pagination'			=> 'yes',
					'team_image' 				=> 'image',
					'categories_id' 			=> 'all',
				), $atts 
			) 
		);

		$output = '';
		global $post;
		$post_count = 1;
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$data_attr = '';
		
		$data_attr .= ' data-items="1" ';
		$data_attr .= ' data-slideby="1" ';
		$data_attr .= ' data-items-tablet="1" ';
		$data_attr .= ' data-items-mobile-landscape="1" ';
		$data_attr .= ' data-items-mobile-portrait="1" ';
		$data_attr .= ' data-autoplay="true" ';
		$data_attr .= ' data-autoplay-timeout="5000" ';
		$data_attr .= ' data-loop="true" ';
		$data_attr .= ' data-margin="0" ';
		$data_attr .= ' data-pagination="true" ';
		$data_attr .= ' data-navigation="false" ';
				
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$query_args = array(
						'post_type' 		=> 'zozo_team_member',
						'posts_per_page'	=> $posts,
						'paged' 			=> $paged,
						'orderby' 		 	=> 'date',
						'order' 		 	=> 'DESC',
					  );
					  
		if( $categories_id != 'all' ) {
			$query_args['tax_query'] 	= array(
											array(
												'taxonomy' 	=> 'team_categories',
												'field' 	=> 'slug',
												'terms' 	=> $categories_id
											) );
		
		}
		
		$team_query = new WP_Query( $query_args );
		
		if( $team_query->have_posts() ) {
			$output = '<div class="zozo-team-list-wrapper clearfix'.$main_classes.'">';
			$output .= '<div class="team-list-inner">';
			
				while ($team_query->have_posts()) : $team_query->the_post();
					
					$align_class = '';
					if( ($post_count % 2) > 0 ) {
						$align_class = " pull-left";
					} else {
						$align_class = " pull-right";
					}
					
					$team_img 			= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-medium');
					$member_name 		= get_post_meta( $post->ID, 'zozo_member_name', true );
					$member_designation = get_post_meta( $post->ID, 'zozo_member_designation', true );
					$member_desc 		= get_post_meta( $post->ID, 'zozo_member_description', true );
					
					$output .= '<div class="row team-item text-'.$text_align.'">';
					
						$output .= '<div class="col-md-6 col-xs-12'.$align_class.'">';
						
							if( isset( $team_image ) && $team_image == 'image' ) {
								$output .= '<div class="team-item-img">';
									$output .= '<img src="'.esc_url($team_img[0]).'" width="'.esc_attr($team_img[1]).'" height="'.esc_attr($team_img[2]).'" alt="'.get_the_title().'" class="img-responsive" />';
								$output .= '</div>';
							} 
							elseif( isset( $team_image ) && $team_image == 'slider' ) {
								$output .= '<div id="team-gallery-slider" class="team-gallery-slider zozo-owl-carousel owl-carousel"'. $data_attr .'>';
									ob_start();
									get_gallery_post_images( 'blog-medium', $post->ID );
									$output .= ob_get_clean();
								$output .= '</div>';
							}
							
						$output .= '</div>';
						
						$output .= '<div class="col-md-6 col-xs-12">';
						
							$output .= '<div class="team-content">';
								if( isset( $member_name ) && $member_name != '' ) {
									$output .= '<h4 class="team-member-name"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'.$member_name.'</a> / <span class="team-member-designation">'. $member_designation .'</span></h4>';
								}
								if( isset( $member_desc ) && $member_desc != '' ) {
									$output .= '<div class="team-member-desc">'.do_shortcode( $member_desc ).'</div>';
								}
							$output .= '</div>';
							
						$output .= '</div>';
						
					$output .= '</div>';
					
					$post_count++;
					
				endwhile;
				
			$output .= '</div>';
			
			if( isset( $show_pagination ) && $show_pagination == 'yes' ) {
				$output .= zozo_pagination( $team_query->max_num_pages, '' );
			}
			
			$output .= '</div>';
		}
				
		wp_reset_postdata();
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_team_list_shortcode_map' ) ) {
	function zozo_vc_team_list_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> __( "Team List", "mist" ),
				"description"			=> __( "Show your team in List.", 'mist' ),
				"base"					=> "zozo_vc_team_list",
				"category"				=> __( "Theme Addons", "mist" ),
				"icon"					=> "zozo-vc-icon",
				"params"				=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Extra Class', "mist" ),
						'param_name'	=> 'classes',
						'value' 		=> '',
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "CSS Animation", "mist" ),
						"param_name"	=> "css_animation",
						"value"			=> array(
							__( "No", "mist" )					=> '',
							__( "Top to bottom", "mist" )			=> "top-to-bottom",
							__( "Bottom to top", "mist" )			=> "bottom-to-top",
							__( "Left to right", "mist" )			=> "left-to-right",
							__( "Right to left", "mist" )			=> "right-to-left",
							__( "Appear from center", "mist" )	=> "appear" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Alignment", "mist" ),
						"param_name"	=> "text_align",
						'admin_label' 	=> true,
						"value"			=> array(
							__( "Default", "mist" )	=> "",
							__( "Center", "mist" )	=> "center",
							__( "Left", "mist" )		=> "left",
							__( "Right", "mist" )		=> "right",
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Posts per Page", "mist" ),
						"admin_label" 	=> true,
						"param_name"	=> "posts",						
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Pagination ?", "mist" ),
						"param_name"	=> "show_pagination",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "yes",
							__( "No", "mist" )		=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Team Image", "mist" ),
						"param_name"	=> "team_image",	
						"value"			=> array(
							__( "Image", "mist" )		=> "image",
							__( "Slider", "mist" )	=> "slider" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_team_list_shortcode_map' );
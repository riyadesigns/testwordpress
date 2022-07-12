<?php 
/**
 * Team Slider shortcode 
 */

if ( ! function_exists( 'zozo_vc_team_slider_shortcode' ) ) {
	function zozo_vc_team_slider_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'text_align' 				=> 'center',
					'show_socials' 				=> 'yes',
					'member_desc_type' 			=> 'excerpt',
					'items'						=> '3',
					'items_scroll' 				=> '1',
					'auto_play' 				=> 'true',					
					'timeout_duration' 			=> '5000',
					'infinite_loop' 			=> '',
					'margin' 					=> '30',
					'items_tablet'				=> '2',
					'items_mobile_landscape'	=> '1',
					'items_mobile_portrait'		=> '1',
					'navigation' 				=> 'true',
					'pagination' 				=> 'true',
					'categories_id' 			=> 'all',
				), $atts 
			) 
		);

		$output = '';
		global $post;
		static $team_id = 1;
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		
		// Slider Configuration
		$data_attr = '';
	
		if( isset( $items ) && $items != '' ) {
			$data_attr .= ' data-items="' . $items . '" ';
		}
		
		if( isset( $items_scroll ) && $items_scroll != '' ) {
			$data_attr .= ' data-slideby="' . $items_scroll . '" ';
		}
		
		if( isset( $items_tablet ) && $items_tablet != '' ) {
			$data_attr .= ' data-items-tablet="' . $items_tablet . '" ';
		}
		
		if( isset( $items_mobile_landscape ) && $items_mobile_landscape != '' ) {
			$data_attr .= ' data-items-mobile-landscape="' . $items_mobile_landscape . '" ';
		}
		
		if( isset( $items_mobile_portrait ) && $items_mobile_portrait != '' ) {
			$data_attr .= ' data-items-mobile-portrait="' . $items_mobile_portrait . '" ';
		}
		
		if( isset( $auto_play ) && $auto_play != '' ) {
			$data_attr .= ' data-autoplay="' . $auto_play . '" ';
		}
		if( isset( $timeout_duration ) && $timeout_duration != '' ) {
			$data_attr .= ' data-autoplay-timeout="' . $timeout_duration . '" ';
		}
		
		if( isset( $items ) && $items == 1 ) {
			$data_attr .= ' data-loop="false" ';
		} else {
			if( isset( $infinite_loop ) && $infinite_loop != '' ) {
				$data_attr .= ' data-loop="' . $infinite_loop . '" ';
			}
		}
		
		if( isset( $margin ) && $margin != '' ) {
			$data_attr .= ' data-margin="' . $margin . '" ';
		}
		
		if( isset( $pagination ) && $pagination != '' ) {
			$data_attr .= ' data-pagination="' . $pagination . '" ';
		}
		if( isset( $navigation ) && $navigation != '' ) {
			$data_attr .= ' data-navigation="' . $navigation . '" ';
		}
		
		if( isset( $items ) && $items == "1" ) {
			$image_size = 'full';
		} else {
			$image_size = 'team';
		}
		
		$query_args = array(
						'post_type' 		=> 'zozo_team_member',
						'posts_per_page'	=> -1,						
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
			$output = '<div class="zozo-team-slider-wrapper'.$main_classes.'">';
			$output .= '<div id="zozo-team-slider'.$team_id.'" class="zozo-owl-carousel owl-carousel team-carousel-slider"'.$data_attr.'>';
			
				while ($team_query->have_posts()) : $team_query->the_post();
					$team_image 		= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size);
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
					
					$output .= '<div class="team-item text-'.$text_align.'">';
						
						if( isset( $team_image ) && $team_image != '' ) {
							$output .= '<div class="team-item-img">';
								$output .= '<img src="'.esc_url($team_image[0]).'" width="'.esc_attr($team_image[1]).'" height="'.esc_attr($team_image[2]).'" alt="'.get_the_title().'" class="img-responsive" />';
							$output .= '</div>';
						}
							
						$output .= '<div class="team-content">';
							if( isset( $member_name ) && $member_name != '' ) {
								$output .= '<h5 class="team-member-name"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'.$member_name.'</a></h5>';
							}
							if( isset( $member_designation ) && $member_designation != '' ) {
								$output .= '<span class="team-member-designation">'.$member_designation.'</span>';
							}
							if( isset( $member_desc ) && $member_desc != '' ) {
								if( isset( $member_desc_type ) && $member_desc_type == 'full_content' ) {
									$output .= '<div class="team-member-desc">'. $member_desc .'</div>';
								} elseif( isset( $member_desc_type ) && $member_desc_type == 'excerpt' ) {
									$output .= '<div class="team-member-desc">'. wp_trim_words( $member_desc, 15, '.') .'</div>';
								}
							}
							
							if( isset( $show_socials ) && $show_socials == 'yes' ) {
								if( ( isset( $facebook ) && $facebook != '' ) || ( isset( $twitter ) && $twitter != '' ) || ( isset( $linkedin ) && $linkedin != '' ) || ( isset( $pinterest ) && $pinterest != '' ) || ( isset( $dribbble ) && $dribbble != '' ) || ( isset( $skype ) && $skype != '' ) || ( isset( $yahoo ) && $yahoo != '' ) || ( isset( $youtube ) && $youtube != '' ) || ( isset( $email ) && $email != '' ) ) { 
								$output .= '<div class="zozo-team-social">';
									$output .= '<ul class="zozo-social-icons soc-icon-transparent zozo-team-social-list">';
										if( isset( $facebook ) && $facebook != '' ) {
											$output .= '<li class="facebook"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $facebook ).'"><i class="fa fa-facebook"></i></a></li>' . "\n";
										}
										if( isset( $twitter ) && $twitter != '' ) {
											$output .= '<li class="twitter"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $twitter ).'"><i class="fa fa-twitter"></i></a></li>' . "\n";
										}
										if( isset( $linkedin ) && $linkedin != '' ) {
											$output .= '<li class="linkedin"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $linkedin ).'"><i class="fa fa-linkedin"></i></a></li>' . "\n";
										}
										if( isset( $pinterest ) && $pinterest != '' ) {
											$output .= '<li class="pinterest"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $pinterest ).'"><i class="fa fa-pinterest"></i></a></li>' . "\n";
										}
										if( isset( $dribbble ) && $dribbble != '' ) {
											$output .= '<li class="dribbble"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $dribbble ).'"><i class="fa fa-dribbble"></i></a></li>' . "\n";
										}
										if( isset( $skype ) && $skype != '' ) {
											$output .= '<li class="skype"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $skype ).'"><i class="fa fa-skype"></i></a></li>' . "\n";
										}
										if( isset( $yahoo ) && $yahoo != '' ) {
											$output .= '<li class="yahoo"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $yahoo ).'"><i class="fa fa-yahoo"></i></a></li>' . "\n";
										}
										if( isset( $youtube ) && $youtube != '' ) {
											$output .= '<li class="youtube"><a target="'.esc_attr( $link_target ).'" href="'.esc_url( $youtube ).'"><i class="fa fa-youtube-play"></i></a></li>' . "\n";
										}
										if( isset( $email ) && $email != '' ) {
											$output .= '<li class="email"><a target="'.esc_attr( $link_target ).'" href="mailto:'.$email.'"><i class="fa fa-envelope"></i></a></li>' . "\n";
										}
									$output .= '</ul>';
								$output .= '</div>';
								}
							}
						$output .= '</div>';
						
					$output .= '</div>';
					
				endwhile;
				
			$output .= '</div>';
			
			$output .= '</div>';
		}
		
		$team_id++;	
		wp_reset_postdata();
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_team_slider_shortcode_map' ) ) {
	function zozo_vc_team_slider_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> __( "Team Slider", "mist" ),
				"description"			=> __( "Show your team in Slider.", 'mist' ),
				"base"					=> "zozo_vc_team_slider",
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
						"type"			=> 'dropdown',
						"admin_label" 	=> true,
						"heading"		=> __( "Show Social Links ?", "mist" ),
						"param_name"	=> "show_socials",
						"value"			=> array(
							__( 'Yes', 'mist' ) 	=> "yes",
							__( 'No', 'mist' ) 	=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Member Description Type", "mist" ),
						"param_name"	=> "member_desc_type",
						"value"			=> array(
							__( "Excerpt", "mist" )			=> "excerpt",
							__( "Full Content", "mist" )		=> "full_content" ),
					),
					// Slider
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Display", "mist" ),
						"param_name"	=> "items",
						'admin_label'	=> true,
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Scrollby", "mist" ),
						"param_name"	=> "items_scroll",
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Auto Play", 'mist' ),
						'param_name'	=> "auto_play",
						'admin_label'	=> true,
						'value'			=> array(
							__( 'True', 'mist' )	=> 'true',
							__( 'False', 'mist' )	=> 'false',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Timeout Duration (in milliseconds)', 'mist' ),
						'param_name'	=> "timeout_duration",
						'value'			=> "5000",
						'dependency'	=> array(
							'element'	=> "auto_play",
							'value'		=> 'true'
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Infinite Loop", 'mist' ),
						'param_name'	=> "infinite_loop",
						'value'			=> array(
							__( 'False', 'mist' )	=> 'false',
							__( 'True', 'mist' )	=> 'true',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Margin ( Items Spacing )", "mist" ),
						"param_name"	=> "margin",
						'admin_label'	=> true,
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display in Tablet", "mist" ),
						"param_name"	=> "items_tablet",
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Landscape", "mist" ),
						"param_name"	=> "items_mobile_landscape",
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Portrait", "mist" ),
						"param_name"	=> "items_mobile_portrait",
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Navigation", "mist" ),
						"param_name"	=> "navigation",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false" ),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Pagination", "mist" ),
						"param_name"	=> "pagination",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false" ),
						"group"			=> __( "Slider", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_team_slider_shortcode_map' );
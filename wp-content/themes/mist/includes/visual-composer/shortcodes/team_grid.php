<?php 
/**
 * Team Grid shortcode 
 */

if ( ! function_exists( 'zozo_vc_team_grid_shortcode' ) ) {
	function zozo_vc_team_grid_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'text_align' 				=> 'center',
					'posts'						=> '-1',
					'show_pagination'			=> 'yes',
					'member_desc_type' 			=> 'excerpt',
					'columns' 					=> '2',
					'show_socials' 				=> 'yes',
					'categories_id' 			=> 'all',
				), $atts 
			) 
		);

		$output = '';
		global $post;
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		$main_classes .= ' team-columns-'.$columns.'';
		
		$column_class = '';
		
		if( isset( $columns ) && $columns != '' ) {
			if( isset( $columns ) && $columns == '2' ) {
				$column_class = 'col-sm-6 col-xs-12';
			} else if( isset( $columns ) && $columns == '3' ) {
				$column_class = 'col-sm-4 col-xs-12';
			} else if( isset( $columns ) && $columns == '4' ) {
				$column_class = 'col-md-3 col-sm-6 col-xs-12';
			}
		} else {
			$column_class = 'col-sm-6 col-xs-12';
		}
		
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
			$output = '<div class="zozo-team-grid-wrapper'.$main_classes.'">';
			$output .= '<div class="row team-grid-inner">';
			
				$count = 1;
			
				while ($team_query->have_posts()) : $team_query->the_post();
					$team_image 		= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'team');
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
					
					if( ( isset( $columns ) && $columns == '2' && $count == '3' ) || ( isset( $columns ) && $columns == '3' && $count == '4' ) || ( isset( $columns ) && $columns == '4' && $count == '5' ) ) {
						$count = 1;
						$output .= '<div class="team-clearfix clearfix"></div>';
					}
					
					$output .= '<div class="team-item '.$column_class.' text-'.$text_align.'">';
						
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
					
					$count++;
					
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


if ( ! function_exists( 'zozo_vc_team_grid_shortcode_map' ) ) {
	function zozo_vc_team_grid_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> __( "Team Grid", "mist" ),
				"description"			=> __( "Show your team in Grid.", 'mist' ),
				"base"					=> "zozo_vc_team_grid",
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
						"heading"		=> __( "Member Description Type", "mist" ),
						"param_name"	=> "member_desc_type",
						"value"			=> array(
							__( "Excerpt", "mist" )			=> "excerpt",
							__( "Full Content", "mist" )		=> "full_content" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Team Columns", "mist" ),
						"param_name"	=> "columns",
						"admin_label" 	=> true,
						"value"			=> array(
							__( "Two Columns", "mist" )		=> "2",
							__( "Three Columns", "mist" )		=> "3",
							__( "Four Columns", "mist" )		=> "4" ),
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
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_team_grid_shortcode_map' );
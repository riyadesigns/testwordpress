<?php 
/**
 * Testimonials Grid shortcode 
 */

if ( ! function_exists( 'zozo_vc_testimonials_grid_shortcode' ) ) {
	function zozo_vc_testimonials_grid_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'text_align' 				=> 'center',
					'posts' 					=> '-1',
					'pagination' 				=> 'yes',
					'columns' 					=> '2',
					'categories_id' 			=> 'all',
				), $atts 
			) 
		);

		$output = '';
		global $post;
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		$main_classes .= ' tcolumns-'.$columns.'';
		$main_classes .= ' testimonials-'.$text_align.'';
		
		$column_class = '';
		
		if( isset( $columns ) && $columns != '' ) {
			if( isset( $columns ) && $columns == '2' ) {
				$column_class = 'col-md-6 col-sm-12';
			} else if( isset( $columns ) && $columns == '3' ) {
				$column_class = 'col-md-4 col-sm-12';
			} else if( isset( $columns ) && $columns == '4' ) {
				$column_class = 'col-md-3 col-sm-12';
			}
		} else {
			$column_class = 'col-md-6 col-sm-12';
		}
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$query_args = array(
						'post_type' 		=> 'zozo_testimonial',
						'posts_per_page' 	=> $posts,
						'paged' 			=> $paged,
						'orderby' 		 	=> 'date',
						'order' 		 	=> 'DESC',
					  );
					  
		if( $categories_id != 'all' ) {
			$query_args['tax_query'] 	= array(
											array(
												'taxonomy' 	=> 'testimonial_categories',
												'field' 	=> 'slug',
												'terms' 	=> $categories_id
											) );
		
		}
		
		$testimonial_query = new WP_Query( $query_args );
		
		if( $testimonial_query->have_posts() ) {
			$output = '<div class="zozo-testimonial-grid-wrapper'.$main_classes.'">';
			$output .= '<div class="testimonial-grid-inner">';
			
				while ($testimonial_query->have_posts()) : $testimonial_query->the_post();
					$testi_img 			= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-thumb');
					$author_designation = get_post_meta( $post->ID, 'zozo_author_designation', true );
					$author_company 	= get_post_meta( $post->ID, 'zozo_author_company_name', true );
					$author_company_url = get_post_meta( $post->ID, 'zozo_author_company_url', true );
					$author_rating 		= get_post_meta( $post->ID, 'zozo_author_rating', true );
					
					$output .= '<div class="testimonial-item '.$column_class.' text-'.$text_align.'">';
						if( isset( $text_align ) && $text_align == 'center' ) { 
							$output .= '<div class="testimonial-content">';						
								$output .= '<blockquote><p>'. zozo_shortcode_stripped_excerpt( get_the_content(), '35' ) .'</p></blockquote>';
								
								if( isset( $author_rating ) && $author_rating != '' ) {
									$output .= '<div class="testimonial-rating">';	
										$output .= '<div class="rateit" data-rateit-value="'.$author_rating.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
									$output .= '</div>';
								}
							$output .= '</div>';
							
							$output .= '<div class="author-info-box">';
								if( isset( $testi_img ) && $testi_img != '' ) {
									$output .= '<div class="testimonial-img">';
									$output .= '<img src="'.esc_url($testi_img[0]).'" width="'.esc_attr($testi_img[1]).'" height="'.esc_attr($testi_img[2]).'" alt="'.get_the_title().'" class="img-responsive" />';
									$output .= '</div>';
								}
						
								$output .= '<div class="author-details">';
									$output .= '<p><span class="testimonial-author-name"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></span></p>';
									$output .= '<p class="author-designation-info">';
										if( isset( $author_designation ) && $author_designation != '' ) {
											$output .= '<span class="testimonial-author-designation">'.$author_designation.'</span>';
										}
										if( isset( $author_company ) && $author_company != '' ) {
											if( isset( $author_company_url ) && $author_company_url != '' ) {
												$output .= '<span class="testimonial-author-company"><a href="'.esc_url( $author_company_url ).'" target="_blank">'.$author_company.'</a></span>';
											} else {
												$output .= '<span class="testimonial-author-company">'.$author_company.'</span>';
											}
										}
									$output .= '</p>';
								$output .= '</div>';
							$output .= '</div>';
						} else {
							$output .= '<div class="testimonial-author-wrapper">';
								if( isset( $testi_img ) && $testi_img != '' ) {
									$output .= '<div class="testimonial-img">';
									$output .= '<img src="'.esc_url($testi_img[0]).'" width="'.esc_attr($testi_img[1]).'" height="'.esc_attr($testi_img[2]).'" alt="'.get_the_title().'" class="img-responsive" />';
									$output .= '</div>';
								}
								
								if( isset( $author_rating ) && $author_rating != '' ) {
									$output .= '<div class="testimonial-rating">';	
										$output .= '<div class="rateit" data-rateit-value="'.$author_rating.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
									$output .= '</div>';
								}
							$output .= '</div>';
							
							$output .= '<div class="testimonial-info-wrapper">';
								$output .= '<div class="testimonial-content">';
									$output .= '<blockquote><p>'. zozo_shortcode_stripped_excerpt( get_the_content(), '35' ) .'</p></blockquote>';
								$output .= '</div>';
							
								$output .= '<div class="author-details">';
									$output .= '<p><span class="testimonial-author-name"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></span></p>';
									$output .= '<p class="author-designation-info">';
										if( isset( $author_designation ) && $author_designation != '' ) {
											$output .= '<span class="testimonial-author-designation">'.$author_designation.'</span>';
										}
										if( isset( $author_company ) && $author_company != '' ) {
											if( isset( $author_company_url ) && $author_company_url != '' ) {
												$output .= '<span class="testimonial-author-company"><a href="'.esc_url( $author_company_url ).'" target="_blank">'.$author_company.'</a></span>';
											} else {
												$output .= '<span class="testimonial-author-company">'.$author_company.'</span>';
											}
										}
									$output .= '</p>';
								$output .= '</div>';
							$output .= '</div>';
						}
							
					$output .= '</div>';
					
				endwhile;
				
			$output .= '</div>';
			
			if( isset( $pagination ) && $pagination == 'yes' ) {
				$output .= zozo_pagination( $testimonial_query->max_num_pages, '' );
			}
			
			$output .= '</div>';
		}
				
		wp_reset_postdata();
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_testimonials_grid_shortcode_map' ) ) {
	function zozo_vc_testimonials_grid_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> __( "Testimonials Grid", "mist" ),
				"description"			=> __( "Show your testimonials in Grid.", 'mist' ),
				"base"					=> "zozo_vc_testimonials_grid",
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
						"param_name"	=> "pagination",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "yes",
							__( "No", "mist" )		=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Testimonial Columns", "mist" ),
						"param_name"	=> "columns",
						"admin_label" 	=> true,
						"value"			=> array(
							__( "Two Columns", "mist" )		=> "2",
							__( "Three Columns", "mist" )		=> "3",
							__( "Four Columns", "mist" )		=> "4" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_testimonials_grid_shortcode_map' );
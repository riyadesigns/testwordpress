<?php 
/**
 * Blog shortcode
 */

if ( ! function_exists( 'zozo_vc_blog_shortcode' ) ) {
	function zozo_vc_blog_shortcode( $atts, $content = NULL ) { 
		
		$atts = vc_map_get_attributes( 'zozo_vc_blog', $atts );
		extract( $atts );

		$output = '';
		global $post, $zozo_options;
		
		// Include categories
		$include_categories = ( '' != $include_categories ) ? $include_categories : '';
		$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;
		if( $include_categories ) {
			$include_categories = explode( ',', $include_categories );
			if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {
				$include_categories = array(
					'taxonomy'	=> 'category',
					'field'		=> 'slug',
					'terms'		=> $include_categories,
					'operator'	=> 'IN',
				);
			} else {
				$include_categories = '';
			}
		}
				
		// Exclude categories
		if( $exclude_categories ) {
			$exclude_categories = explode( ',', $exclude_categories );
			if ( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {
				$exclude_categories = array(
						'taxonomy'	=> 'category',
						'field'		=> 'slug',
						'terms'		=> $exclude_categories,
						'operator'	=> 'NOT IN',
					);
			} else {
				$exclude_categories = '';
			}
		}
				
		if( ( is_front_page() || is_home() ) ) {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
		} else {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		
		$query_args = array(
						'posts_per_page'	=> $posts,
						'paged' 			=> $paged,
						'orderby' 		 	=> 'date',
						'order' 		 	=> 'DESC',
					  );
					  		
		$query_args['tax_query'] 	= array(
										'relation'	=> 'AND',
										$include_categories,
										$exclude_categories );
		
		$blog_query = new WP_Query( $query_args );
		
		$post_class = $container_class = $scroll_type = $scroll_type_class = '';
		$post_type_layout = $excerpt_limit = '';
		
		if( $layout == 'grid' ) {	
			if( $columns != '' ) {
				if( $columns == 'two' ) {
					$container_class = 'grid-layout grid-col-2';
				} elseif ( $columns == 'three' ) {
					$container_class = 'grid-layout grid-col-3';
				} elseif ( $columns == 'four' ) {
					$container_class = 'grid-layout grid-col-4';
				}
			}
			$post_class = 'grid-posts';
			$image_size = 'blog-medium';
			$page_type_layout = 'grid';
			$excerpt_limit = $zozo_options['zozo_blog_excerpt_length_grid'];
			
		} elseif( $layout == 'large' ) {
			$container_class = 'large-layout';
			$post_class = 'large-posts';
			$image_size = 'blog-large';
			$post_type_layout = 'large';
			$excerpt_limit = $zozo_options['zozo_blog_excerpt_length_large'];
			
		} elseif( $layout == 'list' ) {
			$container_class = 'list-layout';
			$post_class = 'list-posts clearfix';	
			$image_size = 'blog-medium';
			$page_type_layout = 'list';
			$excerpt_limit = apply_filters( 'zozo_blog_list_excerpt_length', 30 );
		}
		
		if( $pagination == "infinite" ) {
			$scroll_type = "infinite";
			$scroll_type_class = " scroll-infinite";
		} 
		elseif( $pagination == "pagination" ) {
			$scroll_type = "pagination";
			$scroll_type_class = " scroll-pagination";
		}
		
		$post_count = 1;
	
		$prev_post_timestamp = null;
		$prev_post_month = null;
		$first_timeline_loop = false;
		
		// Classes
		$main_classes = '';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		if( $blog_query->have_posts() ) {
		
			$output = '<div class="zozo-blog-posts-wrapper'.$main_classes.'">';
				$output .= '<div id="archive-posts-container" class="zozo-posts-container '. esc_attr($container_class . $scroll_type_class) .' clearfix">';
				
				while($blog_query->have_posts()) : $blog_query->the_post();
				
					$post_id = get_the_ID();
					$post_timestamp = strtotime($post->post_date);
					$post_month = date('n', $post_timestamp);
					$post_year = get_the_date('o');
					$current_date = get_the_date('o-n');
				
					$post_format = get_post_format();
					
					$post_format_class = '';
					if( $post_format == 'image' ) {
						$post_format_class = 'image-format';
					} elseif( $post_format == 'quote' ) {
						$post_format_class = 'quote-image';
					}
					
					if( has_post_format('link') ) {
						$external_url = '';
						$external_url = get_post_meta( $post_id, 'zozo_external_link_url', true );
						if( isset( $external_url ) && $external_url == '' ) {
							$external_url = get_permalink( $post_id );
						}
					} 
												
					$output .= '<article id="post-'.$post_id.'" ';
					ob_start();
						post_class($post_class);
					$output .= ob_get_clean() .'>';
					
					$output .= '<div class="post-inner-wrapper">';
					
						if ( $thumbnail == 'yes' ) {
							ob_start();
							include( locate_template( 'partials/blog/post-slider.php' ) );
							$output .= ob_get_clean();
						}
						
						$output .= '<div class="posts-content-container">';
						
							if( has_post_format('quote') ) {
								
								$output .= '<div class="entry-summary clearfix">
									<div class="entry-quotes quote-format">
										<blockquote>';
								$output .= '<p>';
								$output .= zozo_blog_trim_excerpt( $excerpt_limit );
								$output .= '</p>';
								$output .= '<footer>
												<h2 class="entry-title">';
										$output .= '<a href="'. get_permalink($post_id) .'" rel="bookmark" title="'.get_the_title().'">'.get_the_title().'</a>';
									$output .= '</h2>
											</footer>';
								$output .= '</blockquote>										
									</div>
								</div>';
							
							} else {							
								
								$output .= '<div class="entry-header">
									<h2 class="entry-title">';
									if( has_post_format('link') ) {
										$output .= '<a href="'. esc_url($external_url) .'" rel="bookmark" title="'.get_the_title().'" target="_blank">'.get_the_title().'</a>';
									} else {
										$output .= '<a href="'. get_permalink($post_id) .'" rel="bookmark" title="'.get_the_title().'">'.get_the_title().'</a>';
									}
								$output .= '</h2>
								</div>';
								
								$output .= '<div class="entry-summary clearfix">';
								$output .= '<p>'. zozo_blog_trim_excerpt( $excerpt_limit ) .'</p>';
								$output .= '</div>';
								
							
								if( $hide_author != 'yes' || $hide_date != 'yes' || $hide_categories != 'yes' || $hide_comments != 'yes' ) {
									$output .= '<div class="entry-meta-wrapper">';							
									$output .= '<ul class="entry-meta">';
										
										if( $hide_author != 'yes' ) {
											$output .= '<li class="author"><i class="fa fa-user"></i>';
											ob_start();
											the_author_posts_link();
											$output .= ob_get_clean() . '</li>';
										}
																												
										if( $hide_date != 'yes' ) {
											$output .= '<li class="posted-date"><i class="fa fa-calendar"></i>' .get_the_time( $zozo_options['zozo_blog_date_format'] ).'</li>';
										}
										
										if( $hide_categories != 'yes' ) {
											$output .= '<li class="category"><i class="fa fa-folder"></i>'.get_the_category_list(', ').'</li>';
										}
																				
										if( $hide_comments != 'yes' ) {							
											if ( comments_open() ) {
												$output .= '<li class="comments-link"><i class="fa fa-comments"></i>';
												ob_start();
												comments_popup_link( '<span class="leave-reply">' . esc_html__( '0 Comment', 'mist' ) . '</span>', esc_html__( '1 Comment', 'mist' ), esc_html__( '% Comments', 'mist' ) );
												$output .= ob_get_clean();
												
												$output .= '</li>';
											}
										}																			
										
									$output .= '</ul>';	
									$output .= '</div>';							
								}
							
								if( $hide_morelink != 'yes' ) {
									$output .= '<div class="entry-footer clearfix">';
										$output .= '<div class="read-more">';
											if( has_post_format('link') ) {
												$output .= '<a href="'. esc_url($external_url) .'" class="btn-more read-more-link" target="_blank">';
											} else {
												$output .= '<a href="'. get_permalink($post_id) .'" class="btn-more read-more-link">';
											}
											
											if( ! $zozo_options['zozo_blog_read_more_text'] ) {
												$output .= esc_html__('Read more', 'mist'); 
											} else { 
												$output .= $zozo_options['zozo_blog_read_more_text'];
											}
											$output .= '</a>';
										$output .= '</div>';
									$output .= '</div>';									
								}
							}
						$output .= '</div>';
						
					$output .= '</div>';
											
					$output .= '</article>';
					
					$prev_post_timestamp = $post_timestamp;
					$prev_post_month = $post_month;
					$post_count++;

				endwhile;
				
			$output .= '</div>';
			
			if( $pagination != "hide" ) {
				$output .= zozo_pagination( $blog_query->max_num_pages, $scroll_type );
			}
			
			$output .= '</div>';
			
		}
		
		wp_reset_postdata();
		
		return $output;
	}
}

if ( ! function_exists( 'zozo_vc_blog_shortcode_map' ) ) {
	function zozo_vc_blog_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Blog", "mist" ),
				"description"			=> __( "Show your blog posts in different styles.", 'mist' ),
				"base"					=> "zozo_vc_blog",
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
						"type"			=> "textfield",
						"heading"		=> __( "Posts per Page", "mist" ),
						"admin_label" 	=> true,
						"param_name"	=> "posts",						
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Include Categories', 'mist' ),
						'param_name'	=> 'include_categories',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to pull posts from or enter "all" to pull recent posts from all categories. Example: category-1, category-2.','mist'),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Exclude Categories', 'mist' ),
						'param_name'	=> 'exclude_categories',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to exclude. Example: category-1, category-2.','mist'),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Blog Layout", "mist" ),
						"param_name"	=> "layout",
						"admin_label" 	=> true,
						"group"			=> __( "Layout", "mist" ),
						"value"			=> array(
							__( "Large Layout", "mist" )		=> "large",
							__( "List Layout", "mist" )		=> "list",
							__( "Grid Layout", "mist" )		=> "grid" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Thumbnail", "mist" ),
						"param_name"	=> "thumbnail",
						"value"			=> array(
							__( "Yes", "mist" )	=> "yes",
							__( "No", "mist" )	=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Hide Author Name", "mist" ),
						"param_name"	=> "hide_author",
						"value"			=> array(
							__( "No", "mist" )	=> "no",
							__( "Yes", "mist" )	=> "yes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Hide Post Date", "mist" ),
						"param_name"	=> "hide_date",
						"value"			=> array(
							__( "No", "mist" )	=> "no",
							__( "Yes", "mist" )	=> "yes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Hide Post Categories", "mist" ),
						"param_name"	=> "hide_categories",
						"value"			=> array(
							__( "No", "mist" )	=> "no",
							__( "Yes", "mist" )	=> "yes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Hide Comments Count", "mist" ),
						"param_name"	=> "hide_comments",
						"value"			=> array(
							__( "No", "mist" )	=> "no",
							__( "Yes", "mist" )	=> "yes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Hide Read More Link", "mist" ),
						"param_name"	=> "hide_morelink",
						"value"			=> array(
							__( "No", "mist" )	=> "no",
							__( "Yes", "mist" )	=> "yes" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Pagination", "mist" ),
						"param_name"	=> "pagination",
						"group"			=> __( "Layout", "mist" ),
						"value"			=> array(
							__( "Hide", "mist" )				=> "hide",
							__( "Pagination", "mist" )		=> "pagination",
							__( "Infinite Scroll", "mist" )	=> "infinite" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Blog Grid Columns", "mist" ),
						"param_name"	=> "columns",
						"admin_label" 	=> true,
						"group"			=> __( "Layout", "mist" ),
						"value"			=> array(
							__( "2 Columns", "mist" )		=> "two",
							__( "3 Columns", "mist" )		=> "three",
							__( "4 Columns", "mist" )		=> "four" ),
						'dependency'	=> array(
							'element'	=> 'layout',
							'value'		=> 'grid',
						),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_blog_shortcode_map' );
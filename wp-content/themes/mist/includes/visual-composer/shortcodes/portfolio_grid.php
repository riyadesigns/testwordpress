<?php 
/**
 * Portfolio Grid shortcode
 */

if ( ! function_exists( 'zozo_vc_portfolio_grid_shortcode' ) ) {
	function zozo_vc_portfolio_grid_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'				=> '',
					'css_animation'			=> '',
					'posts'					=> '-1',
					'pagination'			=> 'yes',
					'include_categories' 	=> '',
					'exclude_categories' 	=> '',
					'filters' 				=> 'yes',
					'filter_align' 			=> '',
					'columns'				=> '2',
					'gutter' 				=> '30',
					'style' 				=> 'default',
					'orderby' 				=> 'title',
					'first_filter' 			=> 'all',
					'button_text' 			=> '',
				), $atts 
			) 
		);

		$output = '';
		static $portfolio_id = 1;
		global $post, $zozo_options;
		
		// Include categories
		$include_categories = ( '' != $include_categories ) ? $include_categories : '';
		$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;
		$include_filter_cats = '';
		if( $include_categories ) {
			$include_categories = explode( ',', $include_categories );
			$include_filter_cats = array();
			foreach( $include_categories as $key ) {
				$key = get_term_by( 'slug', $key, 'portfolio_categories' );
				$include_filter_cats[] = $key->term_id;
			}
		}
		
		if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {
			$include_categories = array(
				'taxonomy'	=> 'portfolio_categories',
				'field'		=> 'slug',
				'terms'		=> $include_categories,
				'operator'	=> 'IN',
			);
		} else {
			$include_categories = '';
		}
		
		// Exclude categories
		$exclude_filter_cats = '';
		if( $exclude_categories ) {
			$exclude_categories = explode( ',', $exclude_categories );
			if ( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {
				$exclude_filter_cats = array();
				foreach ( $exclude_categories as $key ) {
					$key = get_term_by( 'slug', $key, 'portfolio_categories' );
					$exclude_filter_cats[] = $key->term_id;
				}
				$exclude_categories = array(
						'taxonomy'	=> 'portfolio_categories',
						'field'		=> 'slug',
						'terms'		=> $exclude_categories,
						'operator'	=> 'NOT IN',
					);
			} else {
				$exclude_categories = '';
			}
		}
				
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$query_args = array(
						'post_type' 		=> 'zozo_portfolio',
						'posts_per_page'	=> $posts,
						'paged' 			=> $paged,
						'orderby' 		 	=> 'date',
						'order' 		 	=> 'DESC',
					  );
					  		
		$query_args['tax_query'] 	= array(
										'relation'	=> 'AND',
										$include_categories,
										$exclude_categories );
										
		if( isset( $style ) && $style == 'classic' ) {
			switch( $orderby ) {
				case 'rating':
					$query_args['meta_key'] = 'zozo_author_rating';
					$query_args['orderby']  = 'meta_value_num';
				break;
		
				case 'title':
					$query_args['orderby'] = 'title';
				break;
		
				case 'id':
					$query_args['orderby'] = 'ID';
				break;
		
				case 'random':
					$query_args['orderby'] = 'rand';
				break;
		
				default:
					$query_args['orderby'] = 'post_date';
				break;
			}
		}
		
		$portfolio_query = new WP_Query( $query_args );
		
		// Classes
		$main_classes = '';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		if( $portfolio_query->have_posts() ) {
			$output = '<div class="zozo-portfolio-grid-wrapper'.$main_classes.'">';
			
			if( isset( $style ) && $style == 'masonry' ) {
				$output .= '<div id="zozo_portfolio_'.$portfolio_id.'" class="zozo-portfolio masonry-style portfolio-cols-'.$columns.'" data-columns="'.$columns.'" data-gutter="'.$gutter.'">'. "\n";
			} else if( isset( $style ) && $style == 'classic' ) {
				$output .= '<div id="zozo_portfolio_'.$portfolio_id.'" class="zozo-portfolio classic-grid-style portfolio-cols-'.$columns.'" data-columns="'.$columns.'" data-gutter="'.$gutter.'">'. "\n";
			} else {
				$output .= '<div id="zozo_portfolio_'.$portfolio_id.'" class="zozo-portfolio default-grid-style portfolio-cols-'.$columns.'" data-columns="'.$columns.'" data-gutter="'.$gutter.'">';
			}
				
			// Display filter links
			if( isset( $filters ) && $filters == 'yes' ) {
			
				$terms = get_terms( 'portfolio_categories', array(
					'include'	=> $include_filter_cats,
					'exclude'	=> $exclude_filter_cats,
				) );
				
				if ( $terms && count( $terms ) > '1') {
					$filter_class = '';
					if( isset( $filter_align ) && $filter_align != '' ) {
						$filter_class = ' text-'. $filter_align .'';
					}
					$output .= '<ul class="portfolio-tabs list-inline'.$filter_class.'">'. "\n";
					
						// First Filter Check
						if( isset( $first_filter ) && $first_filter == "all" ) {
							$output .= '<li><a class="active" data-filter="*" href="#">'. esc_html__('Show All', 'mist').'</a></li>'. "\n";
						}
						foreach($terms as $term ) {
							$tag_class = '';
							if( isset( $first_filter ) && $first_filter != 'all' ) {
								if( $first_filter == $term->term_id ) {
									$tag_class = ' class="active"';
								}
							}
							$output .= '<li><a'.$tag_class.' data-filter=".'.$term->term_id.'" href="#">'.$term->name.'</a></li>'. "\n";
						}
						
					$output .= '</ul>'. "\n";
				}
			}
				
			$output .= '<div class="portfolio-inner">';
				
			while($portfolio_query->have_posts()) : $portfolio_query->the_post();
				
				if( isset( $style ) && $style == 'masonry' ) {
					$image_size = 'full';
				} else {
					if( isset( $columns ) && $columns == '2' ) {
						$image_size = 'portfolio-large';
					} else {
						$image_size = 'portfolio-mid';
					}
				}
				
				$portfolio_img = '';
				$portfolio_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size);
				
				$item_classes = '';
				$item_tags = get_the_terms($post->ID, 'portfolio_categories');
				if( $item_tags ) {
					foreach( $item_tags as $item_tag ) {
						$item_classes .= ' ' . $item_tag->term_id;
					}
				}
				
				$output .= '<div id="portfolio-'.get_the_ID().'" class="portfolio-item '.$item_classes.'">';
				$output .= '<div class="portfolio-content">';
					
					$portfolio_large = ''; 
					$portfolio_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
					$author_rating 	 = get_post_meta( $post->ID, 'zozo_author_rating', true );
					$custom_text 	 = get_post_meta( $post->ID, 'zozo_portfolio_custom_text', true );
						
					if( isset( $style ) && $style == 'classic' ) {
						$output .= '<a href="'.esc_url( $portfolio_large[0] ).'" data-rel="prettyPhoto[gallery'.$portfolio_id.']" class="classic-img-link" title="'.get_the_title().'"><img class="img-responsive" src="'.esc_url($portfolio_img[0]).'" width="'.esc_attr($portfolio_img[1]).'" height="'.esc_attr($portfolio_img[2]).'" alt="'.get_the_title().'" /></a>';
						
						$output .= '<div class="portfolio-inner-wrapper">';
							$output .= '<div class="portfolio-inner-content">';
								if( isset( $custom_text ) && $custom_text != '' ) {
									$output .= '<h5>'.get_the_title().'<p class="portfolio-custom-text pull-right">'. $custom_text .'</p></h5>';
								} else {
									$output .= '<h5>'.get_the_title().'</h5>';
								}
								
								if( isset( $author_rating ) && $author_rating != '' ) {
									$output .= '<div class="portfolio-rating">';	
										$output .= '<div class="rateit" data-rateit-value="'.$author_rating.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
									$output .= '</div>';
								}
								$output .= '<p>' . zozo_shortcode_stripped_excerpt( get_the_content(), 15 ) . '</p>';
								
								if( isset( $button_text ) && $button_text != '' ) {
									$output .= '<a href="'. get_permalink() .'" class="btn btn-more" title="'.get_the_title().'">'. $button_text .'</a>';
								}
								
							$output .= '</div>';
						$output .= '</div>';
					} else {
						$output .= '<img class="img-responsive" src="'.esc_url($portfolio_img[0]).'" width="'.esc_attr($portfolio_img[1]).'" height="'.esc_attr($portfolio_img[2]).'" alt="'.get_the_title().'" />';
						
						$output .= '<div class="portfolio-overlay">';
							$output .= '<div class="portfolio-mask">';
													
							$output .= '<div class="portfolio-title">';
								$output .= '<h4>'.get_the_title().'</h4>';
								$output .= '<p>' . zozo_shortcode_stripped_excerpt( get_the_content(), 8 ) . '</p>';
							$output .= '</div>';
							$output .= '<a href="'.esc_url( $portfolio_large[0] ).'" data-rel="prettyPhoto[gallery'.$portfolio_id.']" title="'.get_the_title().'"><i class="fa fa-search"></i></a>';
							$output .= '<a href="'. get_permalink() .'" title="'.get_the_title().'"><i class="fa fa-link"></i></a>';
							$output .= '</div>';
						$output .= '</div>';
					}
				$output .= '</div>';
				$output .= '</div>';

			endwhile;
				
			$output .= '</div>';
				
			if( isset( $pagination ) && $pagination == 'yes' ) {
				$output .= zozo_pagination( $portfolio_query->max_num_pages, '' );
			}
			
			$output .= '</div>';
			
			$output .= '</div>';
		}		
		
		$portfolio_id++;
		wp_reset_postdata();
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_portfolio_grid_shortcode_map' ) ) {
	function zozo_vc_portfolio_grid_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Portfolio Grid", "mist" ),
				"description"			=> __( "Show your works in grid with different style.", 'mist' ),
				"base"					=> "zozo_vc_portfolio_grid",
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
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Pagination ?", "mist" ),
						"param_name"	=> "pagination",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "yes",
							__( "No", "mist" )		=> "no" ),
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
						"heading"		=> __( "Portfolio Filters", "mist" ),
						"param_name"	=> "filters",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "yes",
							__( "No", "mist" )		=> "no" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Filters Alignment", "mist" ),
						"param_name"	=> "filter_align",
						"value"			=> array(
							__( "Default", "mist" )	=> "",
							__( "Center", "mist" )	=> "center",
							__( "Left", "mist" )		=> "left",
							__( "Right", "mist" )		=> "right",
						),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Portfolio First Filter", "mist" ),
						"param_name"	=> "first_filter",
						"description" 	=> __( 'Enter the slug of category (only one) to show elements from that category on page load. Enter "all" to show from all categories.', 'mist' ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Portfolio Columns", "mist" ),
						"param_name"	=> "columns",
						"admin_label" 	=> true,
						"value"			=> array(
							__( "Two Columns", "mist" )		=> "2",
							__( "Three Columns", "mist" )		=> "3",
							__( "Four Columns", "mist" )		=> "4" ),
					),					
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items Spacing", "mist" ),
						"param_name"	=> "gutter",
						"description" 	=> __( "Enter gap size between portfolio items. Only enter number Ex: 10", "mist" ),
					),					
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Portfolio Type", "mist" ),
						"param_name"	=> "style",
						"admin_label" 	=> true,
						"value"			=> array(
							__( "Default", "mist" )		=> "default",
							__( "Classic", "mist" )		=> "classic",
							__( "Masonry", "mist" )		=> "masonry" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Order By", "mist" ),
						"param_name"	=> "orderby",
						"value"			=> array(
							__( "Title", "mist" )		=> "title",
							__( "ID", "mist" )		=> "id",
							__( "Random", "mist" )	=> "random",
							__( "Post Date", "mist" )	=> "post_date",
							__( "Rating", "mist" )	=> "rating",
						),
						'dependency'	=> array(
							'element'	=> 'style',
							"value" 	=> array( "classic" ),
						),
					),			
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Button Text", "mist" ),
						"param_name"	=> "button_text",
						"description" 	=> __( "Enter button text.", "mist" ),
						'dependency'	=> array(
							'element'	=> 'style',
							"value" 	=> array( "classic" ),
						),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_portfolio_grid_shortcode_map' );
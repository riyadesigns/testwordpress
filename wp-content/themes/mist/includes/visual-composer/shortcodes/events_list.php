<?php 
/**
 * The Events Calendar List shortcode
 */

if ( ! function_exists( 'zozo_vc_events_list_shortcode' ) ) {
	function zozo_vc_events_list_shortcode( $atts, $content = NULL ) {
	
		/**
		 * Check if events calendar plugin method exists
		 */
		if ( ! function_exists( 'tribe_get_events' ) ) {
			return;
		}
		
		$atts = vc_map_get_attributes( 'zozo_vc_events_list', $atts );
		extract( $atts );

		$output = '';
		$extra_class = '';
		static $events_id = 1;
		
		global $post;
		
		if( isset( $events_listtype ) && $events_listtype == 'categories' ) {
			// Include categories
			$include_categories = ( '' != $include_categories ) ? $include_categories : '';
			$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;
			$include_filter_cats = '';
			if( $include_categories ) {
				$include_categories = explode( ',', $include_categories );
				$include_filter_cats = array();
				foreach( $include_categories as $key ) {
					$key = get_term_by( 'slug', $key, 'tribe_events_cat' );
					$include_filter_cats[] = $key->term_id;
				}
			}
			
			if ( ! empty( $include_categories ) && is_array( $include_categories ) ) {
				$include_categories = array(
					'taxonomy'	=> 'tribe_events_cat',
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
						$key = get_term_by( 'slug', $key, 'tribe_events_cat' );
						$exclude_filter_cats[] = $key->term_id;
					}
					$exclude_categories = array(
							'taxonomy'	=> 'tribe_events_cat',
							'field'		=> 'slug',
							'terms'		=> $exclude_categories,
							'operator'	=> 'NOT IN',
						);
				} else {
					$exclude_categories = '';
				}
			}
		} else if( isset( $events_listtype ) && $events_listtype == 'ids' ) {
			// Include Events
			$include_postids = ( '' != $include_events ) ? $include_events : '';
			$include_filter_ids = '';
			if( $include_postids ) {
				$include_postids = explode( ',', $include_events );
				$include_filter_ids = array();
				foreach( $include_postids as $key ) {
					$include_filter_ids[] = $key;
				}
			}
			
			// Exclude Events
			$exclude_postids = ( '' != $exclude_events ) ? $exclude_events : '';
			$exclude_filter_ids = '';
			if( $exclude_postids ) {
				$exclude_postids = explode( ',', $exclude_events );
				$exclude_filter_ids = array();
				foreach( $exclude_postids as $key ) {
					$exclude_filter_ids[] = $key;
				}
			}
		}
				
		// Past Event
		$meta_date_compare = '>=';
		$meta_date_date = date( 'Y-m-d' );

		if( isset( $past ) && $past == 'yes' ) {
			$meta_date_compare = '<';
		}
		
		// Key
		$key = '';
		if( $orderkey == 'startdate' ) {
			$key = '_EventStartDate';
		} else {
			$key = '_EventEndDate';
		}
		
		// Date
		$meta_date = '';
		$meta_date = array(
			array(
				'key' 		=> $key,
				'value' 	=> $meta_date_date,
				'compare' 	=> $meta_date_compare,
				'type' 		=> 'DATETIME'
			)
		);
		
		// Specific Month
		if( $month == 'current' ) {
			$month = date( 'Y-m' );
		}
		
		if( $month ) {
			$month_array = explode("-", $month);

			$month_yearstr = $month_array[0];
			$month_monthstr = $month_array[1];

			$month_startdate = date($month_yearstr . "-" . $month_monthstr . "-1");
			$month_enddate = date($month_yearstr . "-" . $month_monthstr . "-t");

			$meta_date = array(
				array(
					'key' 		=> $key,
					'value' 	=> array($month_startdate, $month_enddate),
					'compare' 	=> 'BETWEEN',
					'type' 		=> 'DATETIME'
				)
			);
		}
		
		if( isset( $message ) && $message == "" ) {
			$message = 'There are no upcoming events at this time.';
		}
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$query_args = array(
						'post_type' 		=> 'tribe_events',
						'posts_per_page'	=> $posts,
						'paged' 			=> $paged,
						'orderby' 		 	=> 'meta_value',
						'order' 		 	=> $orderby,
						'meta_key' 			=> $key,
						'meta_query' 		=> array( $meta_date )
					  );
		
		if( isset( $events_listtype ) && $events_listtype == 'categories' ) {			  		
			$query_args['tax_query'] 	= array(
											'relation'	=> 'AND',
											$include_categories,
											$exclude_categories );
		} 
		else if( isset( $events_listtype ) && $events_listtype == 'ids' ) {
			if( $include_filter_ids != '' ) {
				$query_args['include'] 	= $include_filter_ids;
			}
			
			if( $exclude_filter_ids != '' ) {
				$query_args['exclude'] 	= $exclude_filter_ids;
			}
		}
		
		$events_query = get_posts( $query_args );
		
		// Classes
		$main_classes = 'zozo-events-list-wrapper';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		$main_classes .= ' skin-'. $events_skin;
		$main_classes .= ' style-'. $events_style;
		
		$row_class = '';
		$column_class = '';
		if( isset( $events_style ) && $events_style == 'grid' ) {
			$row_class = ' row';
			if( isset( $columns ) && $columns != '' ) {
				if( isset( $columns ) && $columns == '1' ) {
					$column_class = ' col-md-12 col-xs-12';
				} else if( isset( $columns ) && $columns == '2' ) {
					$column_class = ' col-md-6 col-sm-6 col-xs-12';
				} else if( isset( $columns ) && $columns == '3' ) {
					$column_class = ' col-md-4 col-sm-6 col-xs-12';
				} else if( isset( $columns ) && $columns == '4' ) {
					$column_class = ' col-md-3 col-sm-6 col-xs-12';
				}
			} else {
				$column_class = ' col-md-12 col-xs-12';
			}
		}
		
		$contentorder = explode( ',', $contentorder );
		
		if( isset( $title_transform ) && $title_transform != '' ) {
			$extra_class = ' text-'.$title_transform.'';
		}
		
		// Stylings
		$main_styles = '';
		if( isset( $bg_color ) && $bg_color != '' ) {
			$main_stylings = ' background-color: '. $bg_color .'; ';
		}
		if( isset( $border_width ) && $border_width != '' ) {
			$main_stylings .= ' border: '. $border_width .' solid '. $border_color .';';
		}
		if( isset( $main_stylings ) && $main_stylings != '' ) {
			$main_styles = ' style="'. $main_stylings .'"';
		}
		
		$title_styles = '';
		if( isset( $title_color ) && $title_color != '' ) {
			$title_styles = 'color: '. $title_color .';';
		}
		if( isset( $title_size ) && $title_size != '' ) {
			$title_styles .= 'font-size:'. $title_size .';';
		}
		if( $title_styles ) {
			$title_styles = ' style="'. $title_styles  .'"';
		}
		
		$content_styles = '';
		if( isset( $content_color ) && $content_color != '' ) {
			$content_styles = ' style="color: '. $content_color .';"';
		}
				
		if( $events_query ) {
			$output .= '<div id="zozo_events_'.$events_id.'" class="'. esc_attr( $main_classes ) .'">';
				$output .= '<ul class="ecs-event-list'. $row_class .'">';
					
					$count = 1;
					
					foreach( $events_query as $post ) :
						setup_postdata( $post );
						
						if( ( isset( $columns ) && $columns == '2' && $count == '3' ) || ( isset( $columns ) && $columns == '3' && $count == '4' ) || ( isset( $columns ) && $columns == '4' && $count == '5' ) ) {
							$output .= '<li class="ecs-clearfix clearfix"></li>';
						}
											
						$output .= '<li class="ecs-event'. $column_class .'">';
							$output .= '<div class="ecs-event-inner clearfix"'.$main_styles.'>';
							
							// Put Values into $output
							foreach ( $contentorder as $content_order ) {
								switch ( trim( $content_order ) ) {
									case 'title' :
										$output .= '<'. $title_type .' class="event-title summary'.$extra_class.'"><a href="' . tribe_get_event_link() . '" rel="bookmark"'.$title_styles.'>' . apply_filters( 'ecs_event_list_title', get_the_title(), $atts ) . '</a></'. $title_type .'>';
										break;
			
									case 'thumbnail' :
										if( isset( $thumb_image ) && $thumb_image == "true" ) {
											$thumbWidth = is_numeric( $thumb_width ) ? $thumb_width : '';
											$thumbHeight = is_numeric( $thumb_height ) ? $thumb_height : '';
											
											if( ! empty($thumbWidth) && ! empty($thumbHeight) ) {
												$output .= get_the_post_thumbnail(get_the_ID(), array($thumbWidth, $thumbHeight) );
											} else {
												$size = ( !empty($thumbWidth) && !empty($thumbHeight) ) ? array( $thumbWidth, $thumbHeight ) : 'theme-mid';
			
												if ( $thumb = get_the_post_thumbnail( get_the_ID(), $size ) ) {
													$output .= '<a href="' . tribe_get_event_link() . '">';
													$output .= $thumb;
													$output .= '</a>';
												}
											}
										}
										break;
			
									case 'excerpt' :
										if( isset( $excerpt ) && $excerpt == "true" ) {
											$excerptLength = is_numeric( $excerpt_length ) ? $excerpt_length : 100;
											$output .= '<p class="ecs-excerpt"'. $content_styles .'>' . zozo_shortcode_stripped_excerpt( get_the_content(), $excerptLength ) . '</p>';
										}
										break;
			
									case 'date' :
										if( isset( $eventdetails ) && $eventdetails == "true" ) {
											$output .= '<span class="duration time"'. $content_styles .'>' . apply_filters( 'ecs_event_list_details', tribe_events_event_schedule_details(), $atts ) . '</span>';
										}
										break;
			
									case 'venue' :
										if( isset( $venue ) && $venue == "true" ) {
											$output .= '<span class="duration venue"'. $content_styles .'><em> at </em>' . apply_filters( 'ecs_event_list_venue', tribe_get_venue(), $atts ) . '</span>';
										}
										break;
								}
							}
							$output .= '</div>';
							
						$output .= '</li>';
						
						$count++;
						
						wp_reset_postdata();
					
					endforeach;
		
				$output .= '</ul>';
				
				if( isset( $viewall ) && $viewall == "yes" ) {
					$output .= '<span class="ecs-all-events"><a href="' . apply_filters( 'ecs_event_list_viewall_link', tribe_get_events_link(), $atts ) .'" class="btn btn-default" rel="bookmark">' . translate( 'View All Events', 'mist' ) . '</a></span>';
				}
			$output .= '</div>';
		} else { //No Events were Found
			$output .= translate( $message, 'mist' );
		}
		
		$events_id++;
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_events_list_shortcode_map' ) ) {
	function zozo_vc_events_list_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Events List", "mist" ),
				"description"			=> __( "List your events from The Events Calendar Plugin.", 'mist' ),
				"base"					=> "zozo_vc_events_list",
				"category"				=> __( "Theme Addons", "mist" ),
				"icon"					=> "zozo-vc-icon",
				"params"				=> array(					
					array(
						'type'			=> 'textfield',
						'admin_label' 	=> true,
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
						"heading"		=> __( "Style", "mist" ),
						"param_name"	=> "events_style",						
						"value"			=> array(
							__( "List", "mist" )		=> "list",
							__( "Grid", "mist" )		=> "grid" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Columns", "mist" ),
						"param_name"	=> "columns",
						"value"			=> array(
							__( "One Column", "mist" )		=> "1",
							__( "Two Columns", "mist" )		=> "2",
							__( "Three Columns", "mist" )		=> "3",
							__( "Four Columns", "mist" )		=> "4" ),
						'dependency' 	=> array(
							'element' 	=> 'events_style',
							'value' 	=> array( 'grid' ),
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Skin", "mist" ),
						"param_name"	=> "events_skin",						
						"value"			=> array(
							__( "Default", "mist" )		=> "default",
							__( "Transparent", "mist" )	=> "transparent" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Posts per Page", "mist" ),
						"admin_label" 	=> true,
						"param_name"	=> "posts",						
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "List Events", "mist" ),
						"param_name"	=> "events_listtype",
						"admin_label" 	=> true,
						"value"			=> array(
							__( "Categories", "mist" )		=> "categories",
							__( "List of IDs", "mist" )		=> "ids" ),
					),
					array(
						'type' 			=> 'autocomplete',
						'heading' 		=> __( 'Include Events', 'mist' ),
						'param_name' 	=> 'include_events',
						"admin_label" 	=> true,
						'description' 	=> __( 'Add events by title.', 'mist' ),
						'settings' 		=> array(
							'multiple' 	=> true,
							'sortable' 	=> true,
						),
						'dependency' 	=> array(
							'element' 	=> 'events_listtype',
							'value' 	=> array( 'ids' ),
						),
					),
					array(
						'type' 			=> 'autocomplete',
						'heading' 		=> __( 'Exclude Events', 'mist' ),
						'param_name' 	=> 'exclude_events',
						"admin_label" 	=> true,
						'description' 	=> __( 'Remove events by title.', 'mist' ),
						'settings' 		=> array(
							'multiple' 	=> true,
							'sortable' 	=> true,
						),
						'dependency' 	=> array(
							'element' 	=> 'events_listtype',
							'value' 	=> array( 'ids' ),
						),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Include Categories', 'mist' ),
						'param_name'	=> 'include_categories',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to pull posts from or enter "all" to pull recent posts from all categories. Example: category-1, category-2.','mist'),
						'dependency' 	=> array(
							'element' 	=> 'events_listtype',
							'value' 	=> array( 'categories' ),
						),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Exclude Categories', 'mist' ),
						'param_name'	=> 'exclude_categories',
						'admin_label'	=> true,
						'description'	=> __('Enter the slugs of a categories (comma seperated) to exclude. Example: category-1, category-2.','mist'),
						'dependency' 	=> array(
							'element' 	=> 'events_listtype',
							'value' 	=> array( 'categories' ),
						),
					),				
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Order By", "mist" ),
						"param_name"	=> "orderby",
						"value"			=> array(
							__( "ASC", "mist" )		=> "ASC",
							__( "DESC", "mist" )		=> "DESC",							
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Order by Key", "mist" ),
						"param_name"	=> "orderkey",
						"value"			=> array(
							__( "Start Date", "mist" )	=> "startdate",
							__( "End Date", "mist" )		=> "enddate" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Event Title Type", "mist" ),
						"param_name"	=> "title_type",
						"value"			=> array(
							__( "h2", "mist" )	=> "h2",
							__( "h3", "mist" )	=> "h3",
							__( "h4", "mist" )	=> "h4",
							__( "h5", "mist" )	=> "h5",
							__( "h6", "mist" )	=> "h6",
						),
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> __( "Event Title Text Transform", 'mist' ),
						"param_name"	=> "title_transform",
						"value"			=> array(
							__( "Default", 'mist' )		=> '',
							__( "None", 'mist' )			=> 'none',
							__( "Capitalize", 'mist' )	=> 'capitalize',
							__( "Uppercase", 'mist' )		=> 'uppercase',
							__( "Lowercase", 'mist' )		=> 'lowercase',
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Event Title Font Size", "mist" ),
						"param_name"	=> "title_size",
						"description" 	=> __( "Enter Title Font Size in px. Ex: 18px", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Event Details ?", "mist" ),
						"param_name"	=> "eventdetails",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "true",
							__( "No", "mist" )		=> "false" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Event Venue ?", "mist" ),
						"param_name"	=> "venue",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "true",
							__( "No", "mist" )		=> "false" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Excerpt ?", "mist" ),
						"param_name"	=> "excerpt",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "true",
							__( "No", "mist" )		=> "false" ),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Excerpt Length", "mist" ),
						"param_name"	=> "excerpt_length",	
						"value"			=> "",
						'dependency'	=> array(
							'element'	=> 'excerpt',
							'value'		=> array( 'true' ),
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Thumbnail Image ?", "mist" ),
						"param_name"	=> "thumb_image",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "true",
							__( "No", "mist" )		=> "false" ),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Thumbnail Width", "mist" ),
						"param_name"	=> "thumb_width",	
						"value"			=> "",
						'dependency'	=> array(
							'element'	=> 'thumb_image',
							'value'		=> array( 'true' ),
						),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Thumbnail Height", "mist" ),
						"param_name"	=> "thumb_height",	
						"value"			=> "",
						'dependency'	=> array(
							'element'	=> 'thumb_image',
							'value'		=> array( 'true' ),
						),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Message", "mist" ),
						"param_name"	=> "message",	
						"value"			=> "",
						'description'	=> __('Message to show when there are no events.','mist'),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "View All Events", "mist" ),
						"param_name"	=> "viewall",	
						"value"			=> array(
							__( "Yes", "mist" )		=> "yes",
							__( "No", "mist" )		=> "no" ),
						'description'	=> __('Choose to show "View all events" or not.','mist'),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Content Order", "mist" ),
						"param_name"	=> "contentorder",	
						"value"			=> "title, thumbnail, excerpt, date, venue",
						'description'	=> __('Manage the order of content with commas.','mist'),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Events from Specific Month", "mist" ),
						"param_name"	=> "month",	
						"value"			=> "",
						'description'	=> __('Type "current" for displaying current month only. Ex: 2015-06 or current','mist'),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Outdated Events", "mist" ),
						"param_name"	=> "past",
						"value"			=> array(
							__( "No", "mist" )		=> "no",
							__( "Yes", "mist" )		=> "yes" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Background Color", "mist" ),
						"param_name"	=> "bg_color",
						"group"			=> __( "Design", "mist" ),
					),
					array(
						"type"			=> 'textfield',
						"heading"		=> __( "Border Width", "mist" ),
						"param_name"	=> "border_width",	
						"value"			=> "",
						'description'	=> __('Enter border width. Ex: 1px or 2px','mist'),
						"group"			=> __( "Design", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Border Color", "mist" ),
						"param_name"	=> "border_color",
						"group"			=> __( "Design", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Event Title Color", "mist" ),
						"param_name"	=> "title_color",
						"group"			=> __( "Design", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Content Color", "mist" ),
						"param_name"	=> "content_color",
						"group"			=> __( "Design", "mist" ),
					),
				)
			) 
		);
		
		//Filters For autocomplete param:
		//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
		add_filter( 'vc_autocomplete_zozo_vc_events_list_include_events_callback', 'zozo_vc_events_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_zozo_vc_events_list_include_events_render', 'zozo_vc_events_include_field_render', 10, 1 ); // Render exact post. Must return an array (label,value)
		add_filter( 'vc_autocomplete_zozo_vc_events_list_exclude_events_callback', 'zozo_vc_events_exclude_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_zozo_vc_events_list_exclude_events_render', 'zozo_vc_events_exclude_field_render', 10, 1 ); // Render exact post. Must return an array (label,value)
		
		/**
		 * @param $search_string
		 *
		 * @return array
		 */
		function zozo_vc_events_include_field_search( $search_string ) {
			$query = $search_string;
			$data = array();
			$args = array( 's' => $query, 'post_type' => 'tribe_events' );
			$args['vc_search_by_title_only'] = true;
			$args['numberposts'] = - 1;
			if ( strlen( $args['s'] ) == 0 ) {
				unset( $args['s'] );
			}
			add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
			$posts = get_posts( $args );
			if ( is_array( $posts ) && ! empty( $posts ) ) {
				foreach ( $posts as $post ) {
					$data[] = array(
						'value' => $post->ID,
						'label' => $post->post_title,
						'group' => $post->post_type,
					);
				}
			}
		
			return $data;
		}
		
		/**
		 * @param $value
		 *
		 * @return array|bool
		 */
		function zozo_vc_events_include_field_render( $value ) {
			$post = get_post( $value['value'] );
		
			return is_null( $post ) ? false : array(
				'label' => $post->post_title,
				'value' => $post->ID,
				'group' => $post->post_type
			);
		}
		
		/**
		 * @param $data_arr
		 *
		 * @return array
		 */
		function zozo_vc_events_exclude_field_search( $data_arr ) {
			if( is_array( $data_arr ) ) {
				$query = isset( $data_arr['query'] ) ? $data_arr['query'] : null;
				$term = isset( $data_arr['term'] ) ? $data_arr['term'] : "";
			} else {
				$query = $data_arr;
			}
			$data = array();
			
			$args = ! empty( $query ) ? array( 's' => $query, 'post_type' => 'tribe_events' ) : array( 's' => $term, 'post_type' => 'tribe_events' );
			
			$args['vc_search_by_title_only'] = true;
			$args['numberposts'] = - 1;
			if ( strlen( $args['s'] ) == 0 ) {
				unset( $args['s'] );
			}
			add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
			$posts = get_posts( $args );
			if ( is_array( $posts ) && ! empty( $posts ) ) {
				foreach ( $posts as $post ) {
					$data[] = array(
						'value' => $post->ID,
						'label' => $post->post_title,
						'group' => $post->post_type,
					);
				}
			}
		
			return $data;
		}
		
		/**
		 * @param $value
		 *
		 * @return array|bool
		 */
		function zozo_vc_events_exclude_field_render( $value ) {
			$post = get_post( $value['value'] );
		
			return is_null( $post ) ? false : array(
				'label' => $post->post_title,
				'value' => $post->ID,
				'group' => $post->post_type
			);
		}
		
	}
}
add_action( 'vc_before_init', 'zozo_vc_events_list_shortcode_map' );
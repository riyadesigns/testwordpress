<?php 
/**
 * Clients Slider shortcode
 */

if ( ! function_exists( 'zozo_vc_clients_slider_shortcode' ) ) {
	function zozo_vc_clients_slider_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'images' 					=> '',
					'custom_links' 				=> '',
					'link_target' 				=> '',
					'show_slider' 				=> 'yes',
					'columns' 					=> '2',
					'items'						=> '5',
					'items_scroll' 				=> '1',
					'auto_play' 				=> 'true',					
					'timeout_duration' 			=> '5000',
					'infinite_loop' 			=> 'false',
					'margin' 					=> '0',
					'items_tablet'				=> '3',
					'items_mobile_landscape'	=> '2',
					'items_mobile_portrait'		=> '1',
					'navigation' 				=> 'true',
					'pagination' 				=> 'true',
				), $atts 
			) 
		);

		$output = '';
		static $clients_id = 1;
				
		// Slider Configuration
		$data_attr = '';
		
		if( isset( $show_slider ) && $show_slider == "yes" ) {
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
		}
		
		// Classes
		$main_classes = '';
		$column_class = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		if( isset( $show_slider ) && $show_slider == "no" ) {
			$main_classes .= ' client-columns-'.$columns.'';
		
			if( isset( $columns ) && $columns != '' ) {
				if( isset( $columns ) && $columns == '2' ) {
					$column_class = ' col-md-6 col-sm-6 col-xs-12';
				} else if( isset( $columns ) && $columns == '3' ) {
					$column_class = ' col-md-4 col-sm-4 col-xs-12';
				} else if( isset( $columns ) && $columns == '4' ) {
					$column_class = ' col-md-3 col-sm-4 col-xs-12';
				} else if( isset( $columns ) && $columns == '6' ) {
					$column_class = ' col-md-2 col-sm-4 col-xs-12';
				}
			} else {
				$column_class = ' col-md-6 col-sm-6 col-xs-12';
			}
		}
		
		// Clients link
		$client_links = explode( ",", $custom_links );
		$images = explode( ',', $images );
		$i = -1;
		$client_images = '';
		
		foreach ( $images as $attach_id ) {
			$i++;
			
			$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => 'full' ) );
			$thumbnail = $post_thumbnail['thumbnail'];
			
			$link_start = $link_end = '';
		
			if( isset( $client_links[$i] ) && $client_links[$i] != '' ) {
				$link_start = '<a href="' . $client_links[$i] . '"' . ( ! empty( $link_target ) ? ' target="' . $link_target . '"' : '' ) . '>';
				$link_end = '</a>';
			}
			$client_images .= '<div class="client-item'. $column_class .'">' . $link_start . $thumbnail . $link_end . '</div>';
		}
		
		$extra_margin_class = "";
		if( $i > $columns ) {
			$extra_margin_class = " client-grid-spacer";
		}
		
		// Main Wrapper
		$output = '<div class="zozo-client-slider-wrapper'.$main_classes.'">';
		if( isset( $show_slider ) && $show_slider == "yes" ) {
			$output .= '<div id="zozo-client-slider-' . $clients_id. '" class="zozo-owl-carousel zozo-client-slider owl-carousel"' . $data_attr . '>';
		} else {		
			$output .= '<div id="zozo-client-grid-' . $clients_id. '" class="zozo-client-grid'.$extra_margin_class.'">';
		}
			$output .= $client_images;
		$output .= '</div>';
		$output .= '</div>'; // .zozo-client-slider-wrapper
		
		$clients_id++;
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_clients_slider_shortcode_map' ) ) {
	function zozo_vc_clients_slider_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Clients Slider", "mist" ),
				"description"			=> __( "Clients/Brands Images Carousel Slider.", 'mist' ),
				"base"					=> "zozo_vc_clients_slider",
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
						"type" 			=> 'attach_images',
						"heading" 		=> __( "Client/Brand Images", "mist" ),
						"param_name"	=> "images",
						"admin_label" 	=> true,
						"value" 		=> '',
						"description" 	=> __( "Select images from media library.", "mist" )
					),					
					array(
						"type"			=> 'exploded_textarea',
						"heading"		=> __( "Custom Links", "mist" ),
						"param_name"	=> "custom_links",
						"value" 		=> 'http://customlink.com,http://customlink.com',
						"description" 	=> __( "Enter links for each image here. Divide links with linebreaks (Enter).", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Link Target", "mist" ),
						"param_name"	=> "link_target",
						"value"			=> array(
							__( 'Same window', 'mist' ) 	=> "_self",
							__( 'New window', 'mist' ) 	=> "_blank" ),
					),
					// Slider
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Show as Slider", 'mist' ),
						'param_name'	=> "show_slider",
						'value'			=> array(
							__( 'Yes', 'mist' )	=> 'yes',
							__( 'No', 'mist' )	=> 'no',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Columns", "mist" ),
						"param_name"	=> "columns",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'no',
						),				
						"value"			=> array(
							__( "Two Columns", "mist" )		=> "2",
							__( "Three Columns", "mist" )		=> "3",
							__( "Four Columns", "mist" )		=> "4",
							__( "Six Columns", "mist" )		=> "6", ),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Display", "mist" ),
						"param_name"	=> "items",
						"admin_label" 	=> true,
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Scrollby", "mist" ),
						"param_name"	=> "items_scroll",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Auto Play", 'mist' ),
						'param_name'	=> "auto_play",
						"admin_label" 	=> true,
						'value'			=> array(
							__( 'True', 'mist' )	=> 'true',
							__( 'False', 'mist' )	=> 'false',
						),
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
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
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Margin ( Items Spacing )", "mist" ),
						"param_name"	=> "margin",
						'admin_label'	=> true,
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display in Tablet", "mist" ),
						"param_name"	=> "items_tablet",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Landscape", "mist" ),
						"param_name"	=> "items_mobile_landscape",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Portrait", "mist" ),
						"param_name"	=> "items_mobile_portrait",
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Navigation", "mist" ),
						"param_name"	=> "navigation",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false" ),
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Pagination", "mist" ),
						"param_name"	=> "pagination",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false" ),
						'dependency' 	=> array(
							'element' 	=> 'show_slider',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Slider", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_clients_slider_shortcode_map' );
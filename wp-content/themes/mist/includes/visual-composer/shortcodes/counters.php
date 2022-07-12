<?php 
/**
 * Counters shortcode
 */

if ( ! function_exists( 'zozo_vc_counters_shortcode' ) ) {
	function zozo_vc_counters_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'				=> '',
					'css_animation'			=> '',
					'counter_value'			=> '',
					'counter_title' 		=> '',
					'counter_color'			=> '',
					'title_color' 			=> '',
					'type' 					=> '',
					'icon_flaticons' 		=> '',
					'icon_fontawesome' 		=> 'fa fa-minus-circle',
					'icon_lineicons' 		=> '',
					'icon_icomoonpack1' 	=> '',
					'icon_icomoonpack2' 	=> '',
					'icon_icomoonpack3' 	=> '',
					'icon_position' 		=> 'top',
					'icon_color'			=> '',
				), $atts 
			) 
		);

		$output = '';
		$extra_class = '';
		static $counter_id = 1;

		// Icon style		
		$icon_style = '';
		if( $icon_color ) {
			$icon_style .= 'color:'. $icon_color .';';
		}
		if( $icon_style ) {
			$icon_style = ' style="'. $icon_style  .'"';
		}
		
		if( $type == 'fontawesome' && function_exists( 'vc_icon_element_fonts_enqueue' ) ) vc_icon_element_fonts_enqueue( 'fontawesome' );	
		
		// Counter style
		if( isset( $counter_value ) && $counter_value != '' ) {
			$counter_style = '';
			if ( $counter_color ) {
				$counter_style .= 'color:'. $counter_color.';';
			}
			if ( $counter_style ) {
				$counter_style = ' style="'. $counter_style .'"';
			}
		}
		
		// Title style
		if( isset( $counter_title ) && $counter_title != '' ) {
			$title_style = '';
			if ( $title_color ) {
				$title_style .= 'color:'. $title_color.';';
			}
			if ( $title_style ) {
				$title_style = ' style="'. $title_style .'"';
			}
		}
		
		// Classes
		$main_classes = 'zozo-counter-wrapper';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$output .= '<div id="zozo-counter-'.$counter_id.'" class="'. esc_attr( $main_classes ) .'">';
			$output .= '<div class="counter-item zozo-counter">';
				
				// Icon
				if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
					if( isset( $icon_position ) && $icon_position == 'top' ) {
						$output .= '<div class="counter-icon">';
							$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .'"'.$icon_style.'></i>';
						$output .= '</div>';
					}
				}
				
				// Content						
				if( isset( $counter_value ) && $counter_value != '' ) {
					$output .= '<div class="counter-info">';
						$output .= '<div class="zozo-count-number text-center" data-count="'.$counter_value.'">';
							$output .= '<h3 class="counter zozo-counter-count"'.$counter_style.'>0</h3>';		
						$output .= '</div>';
						$output .= '<div class="counter-title text-center">';
							if( isset( $counter_title ) && $counter_title != '' ) {
								$output .= '<h5'.$title_style.'>' . esc_html( $counter_title ) .'</h5>';
							}
						$output .= '</div>';
					$output .= '</div>';
				}
				
				// Icon
				if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
					if( isset( $icon_position ) && $icon_position == 'bottom' ) {
						$output .= '<div class="counter-icon">';
							$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .'"'.$icon_style.'></i>';
						$output .= '</div>';
					}
				}			
				
			$output .= '</div>';
		$output .= '</div>';
		
		$counter_id++;
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_counters_shortcode_map' ) ) {
	function zozo_vc_counters_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Counters", "mist" ),
				"description"			=> __( "Animated number counters.", 'mist' ),
				"base"					=> "zozo_vc_counters",
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
						"type"			=> "textfield",
						"heading"		=> __( "Counter Value", "mist" ),
						'admin_label' 	=> true,
						"param_name"	=> "counter_value",						
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Counter Title", "mist" ),
						"param_name"	=> "counter_title",						
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Counter Text Color", "mist" ),
						"param_name"	=> "counter_color",						
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Title Text Color", "mist" ),
						"param_name"	=> "title_color",						
					),
					// Icon
					array(
						"type" 			=> "dropdown",
						"heading" 		=> __( "Choose from Icon library", "mist" ),
						"value" 		=> array(
							__( "None", "mist" ) 				=> "",
							__( "Font Awesome", "mist" ) 		=> "fontawesome",
							__( "Lineicons", "mist" ) 		=> "lineicons",
							__( "Flaticons", "mist" ) 		=> "flaticons",
							__( "Icomoon Pack 1", "mist" ) 	=> "icomoonpack1",
							__( "Icomoon Pack 2", "mist" ) 	=> "icomoonpack2",
							__( "Icomoon Pack 3", "mist" ) 	=> "icomoonpack3",
						),
						"admin_label" 	=> true,
						"param_name" 	=> "type",
						"description" 	=> __( "Select icon library.", "mist" ),
						"group"			=> __( "Icon", "mist" ),
					),					
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Counter Icon", "mist" ),
						"param_name" 	=> "icon_fontawesome",
						"settings" 		=> array(
							"emptyIcon" 	=> false,
							"type" 			=> "fontawesome",
							"iconsPerPage" 	=> 200,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "fontawesome",
						),
						"description" 	=> __( "Select icon from library.", "mist" ),
						"group"			=> __( "Icon", "mist" ),
					),				
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Counter Icon", "mist" ),
						"param_name" 	=> "icon_lineicons",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'simplelineicons',
							"iconsPerPage" 	=> 200,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "lineicons",
						),
						"description" 	=> __( "Select icon from library.", "mist" ),
						"group"			=> __( "Icon", "mist" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Counter Icon", "mist" ),
						"param_name" 	=> "icon_flaticons",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'flaticons',
							"iconsPerPage" 	=> 200,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "flaticons",
						),
						"description" 	=> __( "Select icon from library.", "mist" ),
						"group"			=> __( "Icon", "mist" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Counter Icon", "mist" ),
						"param_name" 	=> "icon_icomoonpack1",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'icomoonpack1',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "icomoonpack1",
						),
						"description" 	=> __( "Select icon from library.", "mist" ),
						"group"			=> __( "Icon", "mist" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Counter Icon", "mist" ),
						"param_name" 	=> "icon_icomoonpack2",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'icomoonpack2',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "icomoonpack2",
						),
						"description" 	=> __( "Select icon from library.", "mist" ),
						"group"			=> __( "Icon", "mist" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Counter Icon", "mist" ),
						"param_name" 	=> "icon_icomoonpack3",
						"value" 		=> "",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'icomoonpack3',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "icomoonpack3",
						),
						"description" 	=> __( "Select icon from library.", "mist" ),
						"group"			=> __( "Icon", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Position", "mist" ),
						"param_name"	=> "icon_position",
						"value"			=> array(
							__( "Top", "mist" )		=> "top",
							__( "Bottom", "mist" )	=> "bottom" ),
					), 
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Color", "mist" ),
						"param_name"	=> "icon_color",
						"group"			=> __( "Icon", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_counters_shortcode_map' );
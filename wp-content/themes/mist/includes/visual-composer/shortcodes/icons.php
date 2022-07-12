<?php 
/**
 * Icons shortcode
 */

if ( ! function_exists( 'zozo_vc_icons_shortcode' ) ) {
	function zozo_vc_icons_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'				=> '',
					'css_animation'			=> '',
					'icon_align'			=> 'left',
					'icon_type'				=> 'none',
					'icon_style' 			=> 'light',
					'icon_size'				=> 'small',
					'type' 					=> '',
					'icon_flaticons' 		=> '',
					'icon_fontawesome' 		=> 'fa fa-minus-circle',
					'icon_lineicons' 		=> '',
					'icon_icomoonpack1' 	=> '',
					'icon_icomoonpack2' 	=> '',
					'icon_icomoonpack3' 	=> '',
					'icon_color'			=> '',
					'icon_bg_color' 		=> '',
					'icon_border_color'		=> '',
					'icon_border_width'		=> '',
				), $atts 
			) 
		);

		$output = '';
		$extra_class = '';

		// Icon style		
		$icon_stylings = '';
		if( $icon_color ) {
			$icon_stylings .= 'color:'. $icon_color .';';
		}
		
		if( $icon_border_color ) {
			if( $icon_border_width == '' ) {
				$icon_border_width = 1;
			}
			$icon_stylings .= ' border:'.$icon_border_width.'px solid '.$icon_border_color.';';
		}
		
		if( $icon_type != 'none' ) {
			if( $icon_bg_color != '' ) {
				$icon_stylings .= ' background-color: '.$icon_bg_color.';';
			}
			$extra_class .= sprintf( ' icon-shape icon-%s', $icon_type );
		} else {
			$extra_class .= ' icon-plain';
		}
		
		if( $icon_size ) {
			$extra_class .= sprintf( ' icon-%s', $icon_size );
		}
		
		if( $icon_style ) {		
			$extra_class .= sprintf( ' icon-%s', $icon_style );
		}
				
		if( $icon_stylings ) {
			$icon_stylings = 'style="'. $icon_stylings  .'"';
		}	

		if( $type == 'fontawesome' && function_exists( 'vc_icon_element_fonts_enqueue' ) ) vc_icon_element_fonts_enqueue( 'fontawesome' );	
		
		// Classes
		$main_classes = 'zozo-vc-icons';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		if( isset( $icon_align ) && $icon_align != '' ) {
			$main_classes .= ' text-' . $icon_align;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$output .= '<div class="'. esc_attr( $main_classes ) .'">';					
			// Icon
			if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
				$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) . $extra_class . ' zozo-icon"'.$icon_stylings.'></i>';
			}
		$output .= '</div>';
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_icons_shortcode_map' ) ) {
	function zozo_vc_icons_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Icons", "mist" ),
				"description"			=> __( "List Icons with different style.", 'mist' ),
				"base"					=> "zozo_vc_icons",
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
						"heading"		=> __( "Alignment", "mist" ),
						"param_name"	=> "icon_align",
						"value"			=> array(
							__( "Default", "mist" )	=> "",
							__( "Center", "mist" )	=> "center",
							__( "Left", "mist" )		=> "left",
							__( "Right", "mist" )		=> "right",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Type", "mist" ),
						"param_name"	=> "icon_type",
						"value"			=> array(
							__( "None", "mist" )		=> "none",
							__( "Circle", "mist" )	=> "circle",
							__( "Rounded", "mist" )	=> "rounded",
							__( "Square", "mist" )	=> "square",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Style", "mist" ),
						"param_name"	=> "icon_style",
						"value"			=> array(
							__( "Light", "mist" )			=> "light",
							__( "Dark", "mist" )			=> "dark",
							__( "Bordered", "mist" )		=> "bordered",
							__( "Transparent", "mist" )	=> "transparent",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Size", "mist" ),
						"param_name"	=> "icon_size",
						"value"			=> array(
							__( "Small", "mist" )			=> "small",
							__( "Medium", "mist" )		=> "medium",
							__( "Large", "mist" )			=> "large",
							__( "Extra Large", "mist" )	=> "exlarge",
						),
						"group"			=> __( "Icon", "mist" ),
					),
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
						"heading" 		=> __( "Icon", "mist" ),
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
						"heading" 		=> __( "Icon", "mist" ),
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
						"heading" 		=> __( "Icon", "mist" ),
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
						"heading" 		=> __( "Icon", "mist" ),
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
						"heading" 		=> __( "Icon", "mist" ),
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
						"heading" 		=> __( "Icon", "mist" ),
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
					// Stylings
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Color", "mist" ),
						"param_name"	=> "icon_color",
						"group"			=> __( "Stylings", "mist" ),
					),		
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Background Color", "mist" ),
						"param_name"	=> "icon_bg_color",
						"group"			=> __( "Stylings", "mist" ),			
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Border Color", "mist" ),
						"param_name"	=> "icon_border_color",
						"group"			=> __( "Stylings", "mist" ),			
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Border Width", "mist" ),
						"param_name"	=> "icon_border_width",
						"description" 	=> __( "Enter border width for icon. Ex: 2 or 3.", "mist" ),
						"group"			=> __( "Stylings", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_icons_shortcode_map' );
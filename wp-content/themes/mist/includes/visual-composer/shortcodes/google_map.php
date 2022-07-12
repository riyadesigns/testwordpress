<?php
/**
 * Google Map shortcode
 */

if ( ! function_exists( 'zozo_vc_google_map_shortcode' ) ) {
	function zozo_vc_google_map_shortcode( $atts, $content = NULL ) {		
		
		$atts = vc_map_get_attributes( 'zozo_vc_google_map', $atts );
		extract( $atts );

		$output = '';
		global $zozo_options;
		
		// Classes
		$main_classes = '';
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$addresses = explode('|', $address);
		
		if( $map_overlay == "true" && $hue_color == '' ) {
			if( isset( $zozo_options['zozo_custom_scheme_color'] ) && $zozo_options['zozo_custom_scheme_color'] != '' ) {
				$hue_color = $zozo_options['zozo_custom_scheme_color'];
			} else {
				$hue_color = "#ffc400";
			}
		}
		
		if( isset( $saturation ) && $saturation == '' ) {
			$saturation = "80";
		}
		
		if( isset( $lightness ) && $lightness == '' ) {
			$lightness = "-10";
		}
		
		$data_attr = '';
		$data_attr = ' data-type="'. $map_type .'"';
		$data_attr .= ' data-zoom="'. $zoom .'"';
		$data_attr .= ' data-scrollwheel="'. $scroll_wheel .'"';
		$data_attr .= ' data-zoomcontrol="'. $zoom_control .'"';
		if( $map_overlay == "true" ) {
			$data_attr .= ' data-hue="'. $hue_color .'"';
		}
		if( isset( $marker_image ) && $marker_image == '' ) {
			$new_marker_image = ZOZOTHEME_URL . '/images/map-marker.png';
		} else if( isset( $marker_image ) && $marker_image != '' ) {
			$marker_image_id = preg_replace( '/[^\d]/', '', $marker_image );
			$new_marker_image_src = wp_get_attachment_image_src( $marker_image_id, 'full' );
			if ( ! empty( $new_marker_image_src[0] ) ) {
				$new_marker_image = $new_marker_image_src[0];
			}
		}
		$data_attr .= ' data-marker="'. $new_marker_image .'"';
		$data_attr .= ' data-saturation="'. $saturation .'"';
		$data_attr .= ' data-lightness="'. $lightness .'"';
		$data_attr .= ' data-address="'. $addresses[0] .'"';
		$data_attr .= ' data-addresses="'. $address .'"';
		$data_attr .= ' data-title="'. $title .'"';
		$data_attr .= ' data-content="' . str_replace( '"', "'", $info_content ) .'"';
		
		if( isset( $map_width ) && $map_width != '' ) {
			$map_styles = ' style="width: '.$map_width.'; ';
			if( isset( $map_height ) && $map_height != '' ) {
				$map_styles .= 'height: '.$map_height.';"';
			} else {
				$map_styles .= '"';
			}
		}
		
		wp_enqueue_script( 'zozo-gmaps-js' );
		
		$output .= '<div class="gmap-wrapper">';
			$output .= '<div class="gmap_canvas"'. $data_attr .''.$map_styles.'>';
			$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_google_map_shortcode_map' ) ) {
	function zozo_vc_google_map_shortcode_map() {
	
		vc_map( 
			array(
				"name"					=> __( "Google Map", "mist" ),
				"description"			=> __( "Google Map with different options and styles.", 'mist' ),
				"base"					=> "zozo_vc_google_map",
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
						'admin_label' 	=> true,
						"heading"		=> __( "Map Type", "mist" ),
						"param_name"	=> "map_type",
						"value"			=> array(
							__( "Roadmap", "mist" )		=> "roadmap",
							__( "Satellite", "mist" )		=> "satellite",
							__( "Hybrid", "mist" )		=> "hybrid",
							__( "Terrain", "mist" )		=> "terrain" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Map Width", "mist" ),
						"param_name"	=> "map_width",
						"value"			=> "100%",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Map Height", "mist" ),
						"param_name"	=> "map_height",
						"value"			=> "376px",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Zoom Level", "mist" ),
						"param_name"	=> "zoom",
						'admin_label' 	=> true,
						"value"			=> "12",
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Map Scrollwheel", "mist" ),
						"param_name"	=> "scroll_wheel",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Map Zoom Control", "mist" ),
						"param_name"	=> "zoom_control",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Map Overlay", "mist" ),
						"param_name"	=> "map_overlay",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false",
						),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Map Overlay Color", "mist" ),
						"param_name"	=> "hue_color",
						"value"			=> "",				
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Saturation", "mist" ),
						"param_name"	=> "saturation",
						"description" 	=> __( "Saturation level 0 to 100", "mist" ),
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Lightness", "mist" ),
						"param_name"	=> "lightness",
						"description" 	=> __( "Lightness level 0 to 100", "mist" ),
						"value"			=> "",
					),
					array(
						"type"			=> "attach_image",
						"heading"		=> __( "Marker Image", "mist" ),
						"param_name"	=> "marker_image",
						"value"			=> "",
					),
					array(
						"type"			=> "textarea",
						"heading"		=> __( "Latitude/ Longtitude", "mist" ),
						"param_name"	=> "address",
						'admin_label' 	=> true,
						"description" 	=> __( "Add latitude/longtitude to show marker on map. To show multiple marker locations on map, to separate latitude/longtitude by using | symbol. <br />Ex: -33.867139, 151.207114|-4.325, 15.322222", "mist" ),
						"value"			=> "-33.867139, 151.207114",
					),
					// Content
					array(
						"type"			=> "exploded_textarea",
						"heading"		=> __( "Title", "mist" ),
						"param_name"	=> "title",
						"value" 		=> 'Title for First Marker,Title for Second Marker',
						"description" 	=> __( "Enter title for each marker position here. Divide titles with linebreaks (Enter).", "mist" ),
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> 'textarea',
						"heading"		=> __( "Content", "mist" ),
						"param_name"	=> "info_content",
						"value" 		=> 'Content for First Marker|Content for Second Marker',
						"description" 	=> __( "Enter content for each marker position here. Divide content with | and divide new line with ,", "mist" ),
						"group"			=> __( "Content", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_google_map_shortcode_map' );
<?php 
/**
 * Section Title shortcode
 */

if ( ! function_exists( 'zozo_vc_section_title_shortcode' ) ) {
	function zozo_vc_section_title_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'				=> '',
					'css_animation'			=> '',
					'text_align'			=> 'center',
					'title'					=> 'Sample Heading',
					'title_type'			=> 'h4',
					'title_transform' 		=> '',
					'title_size'			=> '',
					'title_color'			=> '',
					'title_margin'			=> '',
					'content_style' 		=> 'default',
					'content_size'			=> '',
					'content_color'			=> '',
					'content_margin' 		=> '',					
				), $atts 
			) 
		);

		$output = '';
		$extra_class = '';

		// Heading style
		if ( isset( $title ) && $title != '' ) {
			$title_style = '';
			if( $title_color ) {
				$title_style .= 'color:'. $title_color .';';
			}
			if( $title_size ) {
				$title_style .= 'font-size:'. $title_size .';';
			}
			if( $title_margin ) {
				$title_style .= 'margin:'. $title_margin .';';
			}
			if( $title_style ) {
				$title_style = ' style="'. $title_style  .'"';
			}
		}
		
		// Content						
		if( isset( $content ) && $content != '' ) {
			$content_styles = '';
			if ( $content_size ) {
				$content_styles .= 'font-size:'. $content_size.';';
			}
			if ( $content_color ) {
				$content_styles .= 'color:'. $content_color.';';
			}
			if( $content_margin ) {
				$content_styles .= 'margin:'. $content_margin .';';
			}
			if ( $content_styles ) {
				$content_styles = ' style="'. $content_styles .'"';
			}
		}
		
		if( isset( $text_align ) && $text_align != '' ) {
			$text_align = ' text-'.$text_align.'';
		}
		
		if( isset( $title_transform ) && $title_transform != '' ) {
			$extra_class = ' text-'.$title_transform.'';
		}
		
		// Content
		$content = wpb_js_remove_wpautop( $content, true );
		
		// Classes
		$main_classes = 'zozo-parallax-header';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$output .= '<div class="'. esc_attr( $main_classes ) .'">';
			$output .= '<div class="parallax-header">';
			if( isset( $title ) && $title != '' ) {
				$output .= '<'. $title_type .' class="parallax-title'.$text_align.''.$extra_class.'"'.$title_style.'>'. $title .'</'. $title_type .'>';
			}
			if( isset( $content ) && $content != '' ) {
				if( isset( $content_style ) && $content_style == 'blockquote' ) {
					$output .= '<div class="parallax-desc blockquote-style'.$text_align.'"'.$content_styles.'>';
						$output .= '<blockquote><em>';
						$output .= $content;
						$output .= '</em></blockquote>';
					$output .= '</div>';
				} else {
					$output .= '<div class="parallax-desc default-style'.$text_align.'"'.$content_styles.'>';
						$output .= $content;
					$output .= '</div>';
				}
			}
			$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_section_title_shortcode_map' ) ) {
	function zozo_vc_section_title_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Section Title", "mist" ),
				"description"			=> __( "Section Title with more options.", 'mist' ),
				"base"					=> "zozo_vc_section_title",
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
						"param_name"	=> "text_align",
						"value"			=> array(
							__( "Default", "mist" )	=> "",
							__( "Center", "mist" )	=> "center",
							__( "Left", "mist" )		=> "left",
							__( "Right", "mist" )		=> "right",
						),
					),
					// Headings
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Heading", "mist" ),
						"param_name"	=> "title",
						'admin_label' 	=> true,
						"value"			=> "Sample Heading",
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Heading Type", "mist" ),
						"param_name"	=> "title_type",
						"std" 			=> "h4",
						"value"			=> array(
							__( "h2", "mist" )	=> "h2",
							__( "h3", "mist" )	=> "h3",
							__( "h4", "mist" )	=> "h4",
							__( "h5", "mist" )	=> "h5",
							__( "div", "mist" )	=> "div",
						),
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> __( "Heading Text Transform", 'mist' ),
						"param_name"	=> "title_transform",
						"value"			=> array(
							__( "Default", 'mist' )		=> '',
							__( "None", 'mist' )			=> 'none',
							__( "Capitalize", 'mist' )	=> 'capitalize',
							__( "Uppercase", 'mist' )		=> 'uppercase',
							__( "Lowercase", 'mist' )		=> 'lowercase',
						),
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Heading Font Size", "mist" ),
						"param_name"	=> "title_size",
						"description" 	=> __( "Enter Heading Font Size in px. Ex: 25px", "mist" ),
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Heading Color", "mist" ),
						"param_name"	=> "title_color",
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Heading Margin", "mist" ),
						"param_name"	=> "title_margin",
						"description" 	=> __( "Enter Heading Margin in px. Ex: 5px 5px 5px 5px", "mist" ),
						"group"			=> __( "Heading", "mist" ),
					),
					// Content
					array(
						"type"			=> "textarea_html",
						"holder"		=> "div",
						"heading"		=> __( "Content", "mist" ),
						"param_name"	=> "content",
						"value"			=> '',
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> __( "Content Style", 'mist' ),
						"param_name"	=> "content_style",
						"value"			=> array(
							__( "Default", 'mist' )		=> 'default',
							__( "Blockquote", 'mist' )	=> 'blockquote',
						),
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Content Font Size", "mist" ),
						"param_name"	=> "content_size",
						"description" 	=> __( "Enter Content Font Size in px. Ex: 25px", "mist" ),
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Content Color", "mist" ),
						"param_name"	=> "content_color",
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Content Margin", "mist" ),
						"param_name"	=> "content_margin",
						"description" 	=> __( "Enter Content Margin in px. Ex: 5px 5px 5px 5px", "mist" ),
						"group"			=> __( "Content", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_section_title_shortcode_map' );
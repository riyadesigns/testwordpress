<?php
/**
 * Mailchimp Form shortcode
 */

if ( ! function_exists( 'zozo_vc_mailchimp_form_shortcode' ) ) {
	function zozo_vc_mailchimp_form_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( 'zozo_vc_mailchimp_form', $atts );
		extract( $atts );

		$output = '';
		$button_class = '';
		$button_html = '';
		$form_extra_class = '';
		static $zozo_mailchimp_id = 1;
		
		// Button
		$button_html = $button_text;
		if ( 'yes' == $button_block && $button_align == 'bottom' ) {
			$button_class .= ' btn-block';
		}
		
		if ( $button_align ) {
			$button_class .= ' btn-'. $button_align;
		}
		
		if( $type == 'fontawesome' && function_exists( 'vc_icon_element_fonts_enqueue' ) ) vc_icon_element_fonts_enqueue( 'fontawesome' );	
		
		if ( 'yes' === $add_icon ) {
			$button_class .= ' zozo-btn-icon-' . $icon_align;
			if( isset( ${"icon_" . $type} ) ) {
				$iconClass = ${"icon_" . $type};
			} else {
				$iconClass = 'fa fa-adjust';
			}
				
			$icon_html = '<i class="zozo-btn-icon ' . esc_attr( $iconClass ) . '"></i>';
		
			if ( $icon_align == 'left' ) {
				$button_html = $icon_html . ' ' . $button_html;
			} else {
				$button_html .= ' ' . $icon_html;
			}
		}
		
		if ( $button_align ) {
			$form_extra_class = ' form-btn-'. $button_align;
		}
		
		$button_styles = $button_hover_styles = '';
		if( isset( $bg_color ) && $bg_color != '' ) {
			$button_styles = 'background-color: '.$bg_color.'; ';
		}
		
		if( isset( $bg_text_color ) && $bg_text_color != '' ) {
			$button_styles .= 'color: '.$bg_text_color.';';
		}
		
		if( isset( $bg_hover_color ) && $bg_hover_color != '' ) {
			$button_hover_styles = 'background-color: '.$bg_hover_color.'; ';
		}
		
		if( isset( $bg_hover_text_color ) && $bg_hover_text_color != '' ) {
			$button_hover_styles .= 'color: '.$bg_hover_text_color.';';
		}
		
		// Classes
		$main_classes = '';
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		if( isset( $form_style ) && $form_style != '' ) {
			$main_classes .= ' form-style-' . $form_style;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		wp_enqueue_script( 'zozo-bootstrap-validator-js' );
		
		if( isset( $mailing_list ) && $mailing_list != '' ) {
		
			if( ( isset( $button_styles ) && $button_styles != '' ) || ( isset( $button_hover_styles ) && $button_hover_styles != '' ) ) {
				$output = '<style type="text/css" scoped>';
				if( isset( $button_styles ) && $button_styles != '' ) {
					$output .= '#mc-subscribe'.$zozo_mailchimp_id.' .btn.mc-subscribe {' . $button_styles . ' }';
				}
				if( isset( $button_hover_styles ) && $button_hover_styles != '' ) {
					$output .= '#mc-subscribe'.$zozo_mailchimp_id.' .btn.mc-subscribe:hover, #mc-subscribe'.$zozo_mailchimp_id.' .btn.mc-subscribe:active, #mc-subscribe'.$zozo_mailchimp_id.' .btn.mc-subscribe:focus {' . $button_hover_styles . ' }';
				}
				$output .= '</style>';
			}
	
			$output .= '<div id="mc-subscribe'.$zozo_mailchimp_id.'" class="zozo-mc-form subscribe-form mailchimp-form-wrapper'. esc_attr( $main_classes ) .'">';
				$output .= '<form action="'.zozo_get_current_url().'" id="zozo-mailchimp-form'.$zozo_mailchimp_id.'" name="zozo-mailchimp-form'.$zozo_mailchimp_id.'" class="zozo-mailchimp-form'.$form_extra_class.'">';
					
					if( $button_align == 'bottom' ) {
						$output .= '<div class="form-group mailchimp-email">';
							$output .= '<input type="email" placeholder="'.$placeholder_text.'" class="zozo-subscribe input-email form-control" name="subscribe_email">';
						$output .= '</div>';
						$output .= '<button type="submit" id="zozo_mc_form_submit" name="zozo_mc_submit" class="btn mc-subscribe zozo-submit'. esc_attr( $button_class ) .'">'.$button_html.'</button>';
					} 
					elseif( $button_align == 'inline' || $button_align == 'right' ) {
						$output .= '<div class="form-group mailchimp-email zozo-form-group-addon">';
						$output .= '<div class="input-group">';
							$output .= '<input type="email" placeholder="'.$placeholder_text.'" class="zozo-subscribe input-email form-control" name="subscribe_email">';
							$output .= '<div class="input-group-addon"><button type="submit" id="zozo_mc_form_submit" name="zozo_mc_submit" class="btn mc-subscribe zozo-submit'. esc_attr( $button_class ) .'">'.$button_html.'</button></div>';
						$output .= '</div>';
						$output .= '</div>';
					}
					
					$output .= '<input type="hidden" id="zozo_mc_form_list" name="zozo_mc_form_list" value="'. $mailing_list .'">';
																
				$output .= '</form>';
				
				$output .= '<p class="mailchimp-msg zozo-form-success"></p>';
			$output .= '</div>';
		
		}
		
		$zozo_mailchimp_id++;
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_mailchimp_form_shortcode_map' ) ) {
	function zozo_vc_mailchimp_form_shortcode_map() {
	
		vc_map( 
			array(
				"name"					=> __( "Mailchimp Form", "mist" ),
				"description"			=> __( "Mailchimp form with different styles.", 'mist' ),
				"base"					=> "zozo_vc_mailchimp_form",
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
						"heading"		=> __( "Form Style", "mist" ),
						"param_name"	=> "form_style",
						'admin_label' 	=> true,
						"value"			=> array(
							__( "Default", "mist" )			=> "default",
							__( "Transparent", "mist" )		=> "transparent" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Mailing List", "mist" ),
						"param_name"	=> "mailing_list",
						"value"			=> get_mailing_lists_format()
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Placeholder Text", "mist" ),
						"param_name"	=> "placeholder_text",
						'admin_label' 	=> true,
						"value"			=> __( 'Subscribe Now!', 'mist' ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Button Text", "mist" ),
						"param_name"	=> "button_text",
						'admin_label' 	=> true,
						"value"			=> __( 'Subscribe', 'mist' ),
						"group"			=> __( "Button", "mist" ),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> __( 'Button Alignment', 'mist' ),
						'param_name' 	=> 'button_align',
						'description' 	=> __( 'Select button alignment.', 'mist' ),
						'value' 		=> array(
							__( 'Inline', 'mist' ) 	=> 'inline',
							__( 'Right', 'mist' ) 	=> 'right',
							__( 'Bottom', 'mist' ) 	=> 'bottom'
						),
						"group"			=> __( "Button", "mist" ),
					),
					array(
						'type' 			=> 'checkbox',
						'heading' 		=> __( 'Set full width button?', 'mist' ),
						'param_name' 	=> 'button_block',
						"value"			=> array(
							__( "Yes", "mist" )	=> "yes"
						),
						"group"			=> __( "Button", "mist" ),
					),
					array(
						'type' 			=> 'checkbox',
						'heading' 		=> __( 'Add icon?', 'mist' ),
						'param_name' 	=> 'add_icon',
						"value"			=> array(
							__( "Yes", "mist" )	=> "yes"
						),
						"group"			=> __( "Button", "mist" ),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> __( 'Icon Alignment', 'mist' ),
						'description' 	=> __( 'Select icon alignment.', 'mist' ),
						'param_name' 	=> 'icon_align',
						'value' 		=> array(
							__( 'Left', 'mist' ) 	=> 'left',
							__( 'Right', 'mist' ) => 'right',
						),
						'dependency' 	=> array(
							'element' 	=> 'add_icon',
							'value' 	=> 'yes',
						),
						"group"			=> __( "Button", "mist" ),
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> __( "Choose from Icon library", "mist" ),
						"value" 		=> array(
							__( "Font Awesome", "mist" ) 	=> "fontawesome",
							__( "Lineicons", "mist" ) 	=> "lineicons",
							__( "Flaticons", "mist" ) 	=> "flaticons",
							__( "Icomoon Pack 1", "mist" ) 	=> "icomoonpack1",
							__( "Icomoon Pack 2", "mist" ) 	=> "icomoonpack2",
							__( "Icomoon Pack 3", "mist" ) 	=> "icomoonpack3",
						),
						"param_name" 	=> "type",
						'dependency' 	=> array(
							'element' 	=> 'add_icon',
							'value' 	=> 'yes',
						),
						"description" 	=> __( "Select icon library.", "mist" ),
						"group"			=> __( "Button", "mist" ),
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
						"group"			=> __( "Button", "mist" ),
					),				
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Icon", "mist" ),
						"param_name" 	=> "icon_lineicons",
						"value" 		=> "fa fa-minus-circle",
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
						"group"			=> __( "Button", "mist" ),
					),
					array(
						"type" 			=> 'iconpicker',
						"heading" 		=> __( "Icon", "mist" ),
						"param_name" 	=> "icon_flaticons",
						"value" 		=> "fa fa-minus-circle",
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
						"group"			=> __( "Button", "mist" ),
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
						"group"			=> __( "Button", "mist" ),
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
						"group"			=> __( "Button", "mist" ),
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
						"group"			=> __( "Button", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Button Background Color", "mist" ),
						"param_name"	=> "bg_color",
						"group"			=> __( "Button", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Button Text Color", "mist" ),
						"param_name"	=> "bg_text_color",
						"group"			=> __( "Button", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Button Hover Background Color", "mist" ),
						"param_name"	=> "bg_hover_color",
						"group"			=> __( "Button", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Button Hover Text Color", "mist" ),
						"param_name"	=> "bg_hover_text_color",
						"group"			=> __( "Button", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_mailchimp_form_shortcode_map' );
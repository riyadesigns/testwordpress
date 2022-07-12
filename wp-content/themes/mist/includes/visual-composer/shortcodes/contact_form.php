<?php
/**
 * Contact Form shortcode
 */

if ( ! function_exists( 'zozo_vc_contact_form_shortcode' ) ) {
	function zozo_vc_contact_form_shortcode( $atts, $content = NULL ) {
	
		$atts = vc_map_get_attributes( 'zozo_vc_contact_form', $atts );
		extract( $atts );

		$output = '';
		$button_class = '';
		$button_html = '';
		static $zozo_contactform_id = 1;
		
		// Button
		$button_html = $button_text;
		if ( 'yes' == $button_block ) {
			$button_class .= ' btn-block';
		}
		
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
		
		$custom_msgs = '';
		if( isset( $name_not_empty_msg ) && $name_not_empty_msg != '' ) {
			$custom_msgs .= ' data-name_not_empty="'. $name_not_empty_msg .'"';
		} else {
			$custom_msgs .= ' data-name_not_empty="'. __( "Name Field Required", "mist" ) .'"';
		}
		
		if( isset( $email_not_empty_msg ) && $email_not_empty_msg != '' ) {
			$custom_msgs .= ' data-email_not_empty="'. $email_not_empty_msg .'"';
		} else {
			$custom_msgs .= ' data-email_not_empty="'. __( "The email address is required", "mist" ) .'"';
		}
		
		if( isset( $email_valid_msg ) && $email_valid_msg != '' ) {
			$custom_msgs .= ' data-email_valid="'. $email_valid_msg .'"';
		} else {
			$custom_msgs .= ' data-email_valid="'. __( "The input is not a valid email address", "mist" ) .'"';
		}
		
		if( isset( $phone_valid_msg ) && $phone_valid_msg != '' ) {
			$custom_msgs .= ' data-phone_valid="'. $phone_valid_msg .'"';
		} else {
			$custom_msgs .= ' data-phone_valid="'. __( "The value can contain only digits", "mist" ) .'"';
		}
		
		if( isset( $message_not_empty_msg ) && $message_not_empty_msg != '' ) {
			$custom_msgs .= ' data-msg_not_empty="'. $message_not_empty_msg .'"';
		} else {
			$custom_msgs .= ' data-msg_not_empty="'. __( "Message is required", "mist" ) .'"';
		}
		
		// Classes
		$main_classes = '';
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		if( isset( $form_style ) && $form_style != '' ) {
			$main_classes .= ' form-style-' . $form_style;
		}
		if( isset( $form_layout ) && $form_layout != '' ) {
			$main_classes .= ' form-layout-' . $form_layout;
		}
		$main_classes .= zozo_vc_animation( $css_animation );
		
		wp_enqueue_script( 'zozo-bootstrap-validator-js' );
		
		$output .= '<div class="contact-form-wrapper'. esc_attr( $main_classes ) .'">';
			$output .= '<p class="bg-success zozo-form-success"></p>'; 
			$output .= '<p class="bg-danger zozo-form-error"></p>';
				
				$output .= '<div class="zozo-contact-form-container">';
					$output .= '<form name="contactform" class="zozo-contact-form" id="contactform'.$zozo_contactform_id.'" method="post" action="#"'. $custom_msgs .'>';
					
					if( isset( $form_layout ) && $form_layout == 'two-column' ) {
						$output .= '<div class="row">';
							$output .= '<div class="col-md-6 form-col-left col-xs-12">';
					}
					
					// Name Field
					if( isset( $show_name ) && $show_name == 'yes' ) {						
						$output .= '<div class="zozo-input-text form-group">';
							$output .= '<label class="sr-only" for="contact_name">'.$name_label.'</label>';
							$output .= '<input type="text" name="contact_name" id="contact_name" class="input-name form-control" placeholder="'.esc_attr($name_label).'">';		
						$output .= '</div>';
					}
					
					// Email Field
					$output .= '<div class="zozo-input-email form-group">';
						$output .= '<label class="sr-only" for="contact_email">'.$email_label.'</label>';							
						$output .= '<input type="email" name="contact_email" id="contact_email" class="input-email form-control" placeholder="'.esc_attr($email_label).'">';
					$output .= '</div>';
					
					// Phone Field
					if( isset( $show_phone ) && $show_phone == 'yes' ) {
						$output .= '<div class="zozo-input-phone form-group">';
							$output .= '<label class="sr-only" for="contact_phone">'.$phone_label.'</label>';
							$output .= '<input type="text" id="contact_phone" name="contact_phone" class="input-phone form-control" placeholder="'.esc_attr($phone_label).'">';
						$output .= '</div>';
					}
					
					if( isset( $form_layout ) && $form_layout == 'two-column' ) {
						$output .= '</div>';
						$output .= '<div class="col-md-6 col-xs-12">';
					}
					
					// Message Field
					if( isset( $show_message ) && $show_message == 'yes' ) {
						$output .= '<div class="zozo-textarea-message form-group">';								
							$output .= '<label class="sr-only" for="contact_message">'.$message_label.'</label>';
							$output .= '<textarea name="contact_message" id="contact_message" class="textarea-message form-control" rows="3" cols="25" placeholder="'.esc_attr($message_label).'"></textarea>';
						$output .= '</div>';
					}
					
					// Button
					$output .= '<div class="zozo-input-submit form-group text-'.$button_align.'">';
						$output .= '<button type="submit" class="btn zozo-submit'. esc_attr( $button_class ) .'">'.$button_html.'</button>';
					$output .= '</div>';
					
					if( isset( $form_layout ) && $form_layout == 'two-column' ) {
							$output .= '</div>';
						$output .= '</div>';
					}
					
					$output .= '</form>';
				$output .= '</div>';
				
		$output .= '</div>';
		
		$zozo_contactform_id++;
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_contact_form_shortcode_map' ) ) {
	function zozo_vc_contact_form_shortcode_map() {
	
		vc_map( 
			array(
				"name"					=> __( "Contact Form", "mist" ),
				"description"			=> __( "Contact form with different styles.", 'mist' ),
				"base"					=> "zozo_vc_contact_form",
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
						"heading"		=> __( "Form Layout", "mist" ),
						"param_name"	=> "form_layout",
						"value"			=> array(
							__( "Default", "mist" )			=> "default",
							__( "Two Column Style", "mist" )	=> "two-column"	),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Form Style", "mist" ),
						"param_name"	=> "form_style",
						"value"			=> array(
							__( "Default", "mist" )			=> "default",
							__( "Transparent", "mist" )		=> "transparent",
							__( "Flat", "mist" )				=> "flat" ),
					),
					// Fields
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Name Field", "mist" ),
						"param_name"	=> "show_name",
						"value"			=> array(
							__( "Yes", "mist" )	=> "yes",
							__( "No", "mist" )	=> "no",
						),
						"group"			=> __( "Fields", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Name Field Label", "mist" ),
						"param_name"	=> "name_label",
						"value"			=> "Full Name",
						"group"			=> __( "Fields", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Email Field Label", "mist" ),
						"param_name"	=> "email_label",
						"value"			=> "Email",
						"group"			=> __( "Fields", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Phone Field", "mist" ),
						"param_name"	=> "show_phone",
						"value"			=> array(
							__( "Yes", "mist" )	=> "yes",
							__( "No", "mist" )	=> "no",
						),
						"group"			=> __( "Fields", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Phone Field Label", "mist" ),
						"param_name"	=> "phone_label",
						"value"			=> "Phone",
						"group"			=> __( "Fields", "mist" ),
					),					
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Message Field", "mist" ),
						"param_name"	=> "show_message",
						"value"			=> array(
							__( "Yes", "mist" )	=> "yes",
							__( "No", "mist" )	=> "no",
						),
						"group"			=> __( "Fields", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Message Field Label", "mist" ),
						"param_name"	=> "message_label",
						"value"			=> "Message",
						"group"			=> __( "Fields", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Button Text", "mist" ),
						"param_name"	=> "button_text",
						'admin_label' 	=> true,
						"value"			=> __( 'Send Now', 'mist' ),
						"group"			=> __( "Button", "mist" ),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> __( 'Button Alignment', 'mist' ),
						'param_name' 	=> 'button_align',
						'description' 	=> __( 'Select button alignment.', 'mist' ),
						'value' 		=> array(
							__( 'Left', 'mist' ) 		=> 'left',
							__( 'Right', 'mist' ) 	=> 'right',
							__( 'Center', 'mist' ) 	=> 'center'
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
							__( "Icomoon", "mist" ) 		=> "icomoonicons",
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
						"value" 		=> "fa fa-minus-circle",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"iconsPerPage" 	=> 4000,
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
							"iconsPerPage" 	=> 4000,
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
							"iconsPerPage" 	=> 4000,
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
						"param_name" 	=> "icon_icomoonicons",
						"value" 		=> "fa fa-minus-circle",
						"settings" 		=> array(
							"emptyIcon" 	=> true,
							"type" 			=> 'icomoonicons',
							"iconsPerPage" 	=> 4000,
						),
						"dependency" 	=> array(
							"element" 	=> "type",
							"value" 	=> "icomoonicons",
						),
						"description" 	=> __( "Select icon from library.", "mist" ),
						"group"			=> __( "Button", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Name Field Required", "mist" ),
						"param_name"	=> "name_not_empty_msg",
						"value"			=> __( "The name is required and cannot be empty", "mist" ),
						"group"			=> __( "Error Messages", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Email Field Required", "mist" ),
						"param_name"	=> "email_not_empty_msg",
						"value"			=> __( "The email address is required", "mist" ),
						"group"			=> __( "Error Messages", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Email Field Valid", "mist" ),
						"param_name"	=> "email_valid_msg",
						"value"			=> __( "The input is not a valid email address", "mist" ),
						"group"			=> __( "Error Messages", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Phone Field Valid", "mist" ),
						"param_name"	=> "phone_valid_msg",
						"value"			=> __( "The value can contain only digits", "mist" ),
						"group"			=> __( "Error Messages", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Message Field Required", "mist" ),
						"param_name"	=> "message_not_empty_msg",
						"value"			=> __( "Message is required", "mist" ),
						"group"			=> __( "Error Messages", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_contact_form_shortcode_map' );
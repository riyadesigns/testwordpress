<?php 
/**
 * Contact Info shortcode
 */

if ( ! function_exists( 'zozo_vc_contact_info_shortcode' ) ) {
	function zozo_vc_contact_info_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( 'zozo_vc_contact_info', $atts );
		extract( $atts );

		$output = '';
		$extra_class = '';
		static $zozo_contact_info_id = 1;
		
		// Stylings
		$widget_title_styles = $widget_desc_styles = $address_label_styles = '';
		
		$widget_title_styles 	= !empty( $title_color ) ? ' style="color: '. $title_color .';"' : '';
		$widget_desc_styles 	= !empty( $desc_color ) ? ' style="color: '. $desc_color .';"' : '';
		$address_label_styles 	= !empty( $address_label_color ) ? ' style="color: '. $address_label_color .';"' : '';
		$phone_label_styles 	= !empty( $phone_label_color ) ? ' style="color: '. $phone_label_color .';"' : '';
		$phone_styles 			= !empty( $phone_color ) ? ' style="color: '. $phone_color .';"' : '';
		$email_label_styles 	= !empty( $email_label_color ) ? ' style="color: '. $email_label_color .';"' : '';
		$email_styles 			= !empty( $email_color ) ? ' style="color: '. $email_color .';"' : '';
		$social_label_styles 	= !empty( $social_label_color ) ? ' style="color: '. $social_label_color .';"' : '';
		$icon_styles 			= !empty( $icon_color ) ? 'color: '. $icon_color .';' : '';
		if( isset( $social_icons_type ) && $social_icons_type != 'transparent' ) {
			if( isset( $social_icons_style ) && $social_icons_style == 'background' ) {
				$icon_styles 		   .= !empty( $icon_bg_color ) ? 'background-color: '. $icon_bg_color .';' : '';
			}
			if( isset( $social_icons_style ) && $social_icons_style == 'bordered' ) {
				$icon_styles 		   .= !empty( $icon_border_color ) ? 'border-color: '. $icon_border_color .';' : '';
			}
		}
		$icon_hv_styles			= !empty( $icon_hover_color ) ? 'color: '. $icon_hover_color .';' : '';
		if( isset( $social_icons_type ) && $social_icons_type != 'transparent' ) {
			if( isset( $social_icons_style ) && $social_icons_style == 'background' ) {
				$icon_hv_styles		   .= !empty( $icon_bg_hover_color ) ? 'background-color: '. $icon_bg_hover_color .';' : '';
			}
			if( isset( $social_icons_style ) && $social_icons_style == 'bordered' ) {
				$icon_hv_styles		   .= !empty( $icon_border_hover_color ) ? 'border-color: '. $icon_border_hover_color .';' : '';
			}
		}		
		
		// Classes
		$main_classes = '';
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		
		if( isset( $style ) && $style != '' ) {
			$main_classes .= ' contact-info-'.$style;
		}
		
		if( isset( $separator ) && $separator == 'yes' ) {
			$main_classes .= ' show-separator';
		} else {
			$main_classes .= ' no-separator';
		}
		
		$main_classes .= zozo_vc_animation( $css_animation );
		
		if( ( isset( $icon_styles ) && $icon_styles != '' ) || ( isset( $icon_hv_styles ) && $icon_hv_styles != '' ) || ( isset( $sep_color ) && $sep_color != '' ) || ( isset( $address_color ) && $address_color != '' ) ) {
			$output = '<style type="text/css">';
			if( isset( $sep_color ) && $sep_color != '' ) {
				$output .= '#contact-info-'.$zozo_contact_info_id.'.show-separator .contact-widget-desc { border-color: ' . $sep_color . '; }';
			}
			if( isset( $address_color ) && $address_color != '' ) {
				$output .= '#contact-info-'.$zozo_contact_info_id.' .contact-address p { color: ' . $address_color . '; }';
			}
			if( isset( $icon_styles ) && $icon_styles != '' ) {
				$output .= '#contact-info-'.$zozo_contact_info_id.' .zozo-social-icons li a {' . $icon_styles . ' }';
			}
			if( isset( $icon_hv_styles ) && $icon_hv_styles != '' ) {
				$output .= '#contact-info-'.$zozo_contact_info_id.' .zozo-social-icons li a:hover {' . $icon_hv_styles . ' }';
			}
			$output .= '</style>';
		}
		
		$output .= '<div id="contact-info-'.$zozo_contact_info_id.'" class="contact-info-container'. esc_attr( $main_classes ) .'">';
			$output .= '<div class="contact-info-inner text-'. $alignment .'">';
				$output .= '<div class="contact-top-header">';
					if( isset( $widget_title ) && $widget_title != '' ) {
						$output .= '<h4 class="contact-widget-title"'.$widget_title_styles.'>' . $widget_title . '</h4>';
					}
					if( isset( $widget_desc ) && $widget_desc != '' ) {
						$output .= '<div class="contact-widget-desc"'.$widget_desc_styles.'>' . $widget_desc . '</div>';
					}
				$output .= '</div>';
				
				if( isset( $content ) && $content != '' ) {
					$output .= '<div class="contact-address-box">';
						if( isset( $address_label ) && $address_label != '' ) {
							$output .= '<div class="contact-address-label">';
							$output .= '<h6'.$address_label_styles.'>'. $address_label .'</h6>';
							$output .= '</div>';
						}
						$output .= '<div class="contact-address">';
							$output .= wpb_js_remove_wpautop( $content, true );
						$output .= '</div>';
					$output .= '</div>';
				}
				
				if( isset( $phone_number ) && $phone_number != '' ) {
					$output .= '<div class="contact-phone-box">';
						if( isset( $phone_label ) && $phone_label != '' ) {
							$output .= '<div class="contact-phone-label">';
							$output .= '<h6'.$phone_label_styles.'>'. $phone_label .'</h6>';
							$output .= '</div>';
						}
						$output .= '<div class="contact-phone">';
							if( isset( $phone_number ) && $phone_number != '' ) {
								$output .= '<h5'.$phone_styles.'>'. $phone_number .'</h5>';
							}
							if( isset( $phone_number2 ) && $phone_number2 != '' ) {
								$output .= '<h5'.$phone_styles.'>'. $phone_number2 .'</h5>';
							}
							if( isset( $phone_number3 ) && $phone_number3 != '' ) {
								$output .= '<h5'.$phone_styles.'>'. $phone_number3 .'</h5>';
							}
						$output .= '</div>';
					$output .= '</div>';
				}
				
				if( isset( $email_address ) && $email_address != '' ) {
					$output .= '<div class="contact-email-box">';
						if( isset( $email_label ) && $email_label != '' ) {
							$output .= '<div class="contact-email-label">';
							$output .= '<h6'.$email_label_styles.'>'. $email_label .'</h6>';
							$output .= '</div>';
						}
						$output .= '<div class="contact-email">';
							if( isset( $email_address ) && $email_address != '' ) {
								$output .= '<h5><a href="mailto:'.$email_address.'"'.$email_styles.'>'. $email_address .'</a></h5>';
							}
							if( isset( $email_address2 ) && $email_address2 != '' ) {
								$output .= '<h5><a href="mailto:'.$email_address2.'"'.$email_styles.'>'. $email_address2 .'</a></h5>';
							}
							if( isset( $email_address3 ) && $email_address3 != '' ) {
								$output .= '<h5><a href="mailto:'.$email_address3.'"'.$email_styles.'>'. $email_address3 .'</a></h5>';
							}
						$output .= '</div>';
					$output .= '</div>';
				}
			
				$social_medias = array( 
								'facebook' 		=> $facebook, 
								'twitter' 		=> $twitter, 
								'pinterest' 	=> $pinterest, 
								'linkedin' 		=> $linkedin, 
								'youtube' 		=> $youtube, 
								'rss' 			=> $rss, 
								'tumblr' 		=> $tumblr, 
								'reddit' 		=> $reddit, 
								'dribbble' 		=> $dribbble, 
								'flickr' 		=> $flickr, 
								'instagram' 	=> $instagram, 
								'vimeo' 		=> $vimeo, 
								'skype' 		=> $skype, 
								'blogger' 		=> $blogger, 
								'yahoo' 		=> $yahoo );
								
				$social_links = array();
								
				foreach( $social_medias as $icon => $link ) {
					if( $link && $link != '' ) {
						$social_link = vc_build_link( $link );
						$social_links[$icon]['icon'] = $icon;
						$social_links[$icon]['url'] = isset( $social_link['url'] ) ? $social_link['url'] : '';
						$social_links[$icon]['title'] = isset( $social_link['title'] ) ? $social_link['title'] : '';
						$social_links[$icon]['target'] = !empty( $social_link['target'] ) ? $social_link['target'] : '_blank';
					}
				}
				
				$li_html = '';
				if( isset( $social_links ) && is_array( $social_links ) ) {
					foreach( $social_links as $social ) {
						$icon_class = $social['icon'];
						
						if( $social['icon'] == 'vimeo' ) {
							$icon = 'flaticon flaticon-social140';
						} elseif( $social['icon'] == 'blogger' ) {
							$icon = 'flaticon flaticon-blogger8';
						} else {
							$icon = 'fa fa-' . $social['icon'];
						}
						
						if( $social['url'] != '' ) {
							$li_html .= '<li class="'.esc_attr( $icon_class ).'"><a target="'.esc_attr( $social['target'] ).'" href="'. $social['url'] .'" title="'.esc_attr( $social['title'] ).'"><i class="'.esc_attr( $icon ).'"></i></a></li>';
						}
					}
				}
				
				if( isset( $li_html ) && $li_html != '' ) {
					if( isset( $social_label ) && $social_label != '' ) {
						$output .= '<div class="contact-social-label">';
						$output .= '<h6'.$social_label_styles.'>'. $social_label .'</h6>';
						$output .= '</div>';
					}
						
					$output .= '<ul class="zozo-social-icons soc-icon-'.$social_icons_type.' social-style-'.$social_icons_style.'">';
					$output .= $li_html;
					$output .= '</ul>';
				}
								
			$output .= '</div>';
		$output .= '</div>';
		
		$zozo_contact_info_id++;
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_contact_info_shortcode_map' ) ) {
	function zozo_vc_contact_info_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Contact Info", "mist" ),
				"description"			=> __( "Contact info with more options.", 'mist' ),
				"base"					=> "zozo_vc_contact_info",
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
						"param_name"	=> "alignment",
						"value"			=> array(
							__( "Default", "mist" )	=> "default",
							__( "Center", "mist" )	=> "center",
							__( "Left", "mist" )		=> "left",
							__( "Right", "mist" )		=> "right",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Style", "mist" ),
						"param_name"	=> "style",
						"value"			=> array(
							__( "Default", "mist" )	=> "default",
							__( "Style 2", "mist" )	=> "style2",
						),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Widget Title", "mist" ),
						"param_name"	=> "widget_title",
						"value"			=> "",
					),
					array(
						"type"			=> "textarea",
						"heading"		=> __( "Description", "mist" ),
						"param_name"	=> "widget_desc",
						"value"			=> '',
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Separator", "mist" ),
						"param_name"	=> "separator",
						"value"			=> array(
							__( "No", "mist" )		=> "no",
							__( "Yes", "mist" )		=> "yes",
						),
						"description" 	=> __( "Choose this option to show border separator between widget description and contact info.", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Address Label", "mist" ),
						"param_name"	=> "address_label",
						"value"			=> "",
					),
					array(
						"type"			=> "textarea_html",
						"holder"		=> "div",
						"heading"		=> __( "Address", "mist" ),
						"param_name"	=> "content",
						"value"			=> __( 'I am text block. Please change this dummy text in your page editor for this box.', "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Phone Label", "mist" ),
						"param_name"	=> "phone_label",
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Phone Number", "mist" ),
						"param_name"	=> "phone_number",
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Phone Number 2", "mist" ),
						"param_name"	=> "phone_number2",
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Phone Number 3", "mist" ),
						"param_name"	=> "phone_number3",
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Email Label", "mist" ),
						"param_name"	=> "email_label",
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Email Address", "mist" ),
						"param_name"	=> "email_address",
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Email Address 2", "mist" ),
						"param_name"	=> "email_address2",
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Email Address 3", "mist" ),
						"param_name"	=> "email_address3",
						"value"			=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Social Label", "mist" ),
						"param_name"	=> "social_label",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						'admin_label' 	=> true,
						"heading"		=> __( "Type", "mist" ),
						"param_name"	=> "social_icons_type",
						"value"			=> array(
							__( "Circle", "mist" )		=> "circle",
							__( "Square", "mist" )		=> "square",
							__( "Rounded", "mist" )		=> "rounded",
							__( "Transparent", "mist" )	=> "transparent",
						),
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Style", "mist" ),
						"param_name"	=> "social_icons_style",
						"value"			=> array(
							__( "None", "mist" )			=> "none",
							__( "Bordered", "mist" )		=> "bordered",
							__( "Background", "mist" )	=> "background",
						),
						'dependency'	=> array(
							'element'	=> 'social_icons_type',
							'value'		=> array( 'circle', 'square', 'rounded' ),
						),
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Facebook Link", 'mist' ),
						"param_name"	=> "facebook",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Twitter Link", 'mist' ),
						"param_name"	=> "twitter",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Pinterest Link", 'mist' ),
						"param_name"	=> "pinterest",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Linkedin Link", 'mist' ),
						"param_name"	=> "linkedin",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Youtube Link", 'mist' ),
						"param_name"	=> "youtube",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "RSS Link", 'mist' ),
						"param_name"	=> "rss",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Tumblr Link", 'mist' ),
						"param_name"	=> "tumblr",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Reddit Link", 'mist' ),
						"param_name"	=> "reddit",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Dribbble Link", 'mist' ),
						"param_name"	=> "dribbble",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Flickr Link", 'mist' ),
						"param_name"	=> "flickr",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Instagram Link", 'mist' ),
						"param_name"	=> "instagram",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Vimeo Link", 'mist' ),
						"param_name"	=> "vimeo",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Skype Link", 'mist' ),
						"param_name"	=> "skype",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Blogger Link", 'mist' ),
						"param_name"	=> "blogger",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Yahoo Link", 'mist' ),
						"param_name"	=> "yahoo",
						"value"			=> "",
						"group"			=> __( "Social Icons", "mist" ),
					),
					// Stylings
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Widget Title Color", "mist" ),
						"param_name"	=> "title_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Widget Description Color", "mist" ),
						"param_name"	=> "desc_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Separator Color", "mist" ),
						"param_name"	=> "sep_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Address Label Color", "mist" ),
						"param_name"	=> "address_label_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Address Text Color", "mist" ),
						"param_name"	=> "address_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Phone Label Color", "mist" ),
						"param_name"	=> "phone_label_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Phone Text Color", "mist" ),
						"param_name"	=> "phone_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Email Label Color", "mist" ),
						"param_name"	=> "email_label_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Email Text Color", "mist" ),
						"param_name"	=> "email_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Social Label Color", "mist" ),
						"param_name"	=> "social_label_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Icon Color", "mist" ),
						"param_name"	=> "icon_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Background Color", "mist" ),
						"param_name"	=> "icon_bg_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'social_icons_style',
							'value'		=> array( 'background' ),
						),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Border Color", "mist" ),
						"param_name"	=> "icon_border_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'social_icons_style',
							'value'		=> array( 'bordered' ),
						),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Icon Hover Color", "mist" ),
						"param_name"	=> "icon_hover_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Icon Background Hover Color", "mist" ),
						"param_name"	=> "icon_bg_hover_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'social_icons_style',
							'value'		=> array( 'background' ),
						),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Icon Border Hover Color", "mist" ),
						"param_name"	=> "icon_border_hover_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'social_icons_style',
							'value'		=> array( 'bordered' ),
						),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_contact_info_shortcode_map' );
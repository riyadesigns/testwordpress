<?php 
/**
 * Features shortcode
 */

if ( ! function_exists( 'zozo_vc_feature_box_shortcode' ) ) {
	function zozo_vc_feature_box_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts(
				array(
					'id'					=> '',
					'classes'				=> '',
					'css_animation'			=> '',
					'text_align'			=> 'center',
					'title_style' 			=> 'title-below',
					'box_style' 			=> 'default-box',
					'info_box_style' 		=> 'box-with-bg',
					'box_link' 				=> '',
					'feature_image' 		=> '', 
					'image_url' 			=> '',
					'image_shape' 			=> 'none',
					'image_filters' 		=> '',
					'image_hover_style' 	=> '',
					'type' 					=> '',
					'icon_flaticons' 		=> '',
					'icon_fontawesome' 		=> '',
					'icon_lineicons' 		=> '',
					'icon_icomoonpack1' 	=> '',
					'icon_icomoonpack2' 	=> '',
					'icon_icomoonpack3' 	=> '',
					'icon_size' 			=> 'normal',
					'icon_shape' 			=> 'icon-none',
					'icon_skin_color' 		=> 'icon-skin-default',
					'icon_style' 			=> 'icon-bg',
					'icon_pattern' 			=> 'pattern-1',
					'pattern_image' 		=> '',
					'icon_hover_style' 		=> 'no-hover',
					'title'					=> __('Sample Heading', 'mist'),
					'title_type'			=> 'h2',
					'title_extra_class' 	=> '',
					'title_size'			=> '',
					'title_color'			=> '',
					'title_url'				=> '',
					'title_align' 			=> '',
					'content_size'			=> '',
					'content_color'			=> '',
					'content_align' 		=> '',
					'separator' 			=> 'yes',
					'show_button' 			=> 'no',
					'button_text' 			=> __( 'Read More', 'mist' ),
					'button_url' 			=> '',
					'button_style' 			=> 'normal_style',
					'bg_color'				=> '',
					'bg_hover_color' 		=> '',
					'box_br_color' 			=> '',
					'box_hv_br_color' 		=> '',
					'icon_bg_color'			=> '',
					'icon_color'			=> '',
					'icon_border_color' 	=> '',
					'icon_hv_color'			=> '',
					'icon_hv_bg_color' 		=> '',
					'icon_hv_br_color' 		=> '',
					'css' 					=> '',
				), $atts 
			) 
		);

		$output = '';
		$extra_class = '';
		static $feature_box_id = 1;

		// ID
		$div_id = '';
		$custom_id = '';
		if ( isset( $id ) && $id != '' ) {
			$div_id = ' id="'. $id .'"';
			$custom_id = '#' . $id;
		} else {
			$div_id = ' id="feature-box-'. $feature_box_id .'"';
			$custom_id = '#feature-box-' . $feature_box_id;
		}

		// Style
		$custom_stylings = '';
		// Background Color
		if( isset( $bg_color ) && $bg_color != '' ) {
			if( isset( $info_box_style ) && $info_box_style == 'box-with-bg' ) {	
				$custom_stylings .= $custom_id . '.feature-box-style.style-box-with-bg .grid-item { background-color:'. $bg_color .'; }' . "\n";
			} elseif( isset( $info_box_style ) && $info_box_style == 'outline-box' ) {
				$custom_stylings .= $custom_id . '.feature-box-style.style-outline-box .grid-item { background-color:'. $bg_color .'; }' . "\n";
			} elseif( isset( $box_style ) && $box_style == 'overlay-box' ) {
				$custom_stylings .= $custom_id . '.feature-box-style.style-overlay-box .grid-overlay-bottom { background-color:'. $bg_color .'; }' . "\n";
			}
		}
		
		// Hover Background Color
		if( isset( $bg_hover_color ) && $bg_hover_color != '' ) {
			if( isset( $info_box_style ) && $info_box_style == 'box-with-bg' ) {	
				$custom_stylings .= $custom_id . '.feature-box-style.style-box-with-bg .grid-item { background-color:'. $bg_hover_color .'; }' . "\n";
			} elseif( isset( $info_box_style ) && $info_box_style == 'outline-box' ) {
				$custom_stylings .= $custom_id . '.feature-box-style.style-outline-box .grid-item:hover { background-color:'. $bg_hover_color .'; }' . "\n";
			} elseif( isset( $box_style ) && $box_style == 'overlay-box' ) {
				$custom_stylings .= $custom_id . '.feature-box-style.style-overlay-box .grid-item:hover .grid-overlay-bottom { background-color:'. $bg_hover_color .'; }' . "\n";
			}
		}
		
		// Background Pattern Image
		if( ( isset( $icon_style ) && $icon_style == 'icon-pattern' ) && ( isset( $icon_pattern ) && $icon_pattern == 'custom-pattern' ) ) {
			if ( isset( $pattern_image ) && $pattern_image != '' ) {
				$pattern = wpb_getImageBySize( array( 'attach_id' => $pattern_image, 'thumb_size' => 'full' ) );
				$custom_stylings .= $custom_id . '.feature-box-style .grid-item .zozo-icon.icon-pattern.custom-pattern { background-image:url('. $pattern['p_img_large'][0] .'); }' . "\n";
			} 
		}
		
		if( $type == 'fontawesome' && function_exists( 'vc_icon_element_fonts_enqueue' ) ) vc_icon_element_fonts_enqueue( 'fontawesome' );	
		
		// Outlined Box Border Styles
		if( isset( $box_br_color ) && $box_br_color != '' ) {
			$custom_stylings .= $custom_id . '.feature-box-style.style-outline-box .grid-item { border-color:'. $box_br_color .'; }' . "\n";
		}
		
		if( isset( $box_hv_br_color ) && $box_hv_br_color != '' ) {
			$custom_stylings .= $custom_id . '.feature-box-style.style-outline-box .grid-item:hover { border-color:'. $box_hv_br_color .'; }' . "\n";
		}
		
		if( ( isset( $icon_bg_color ) && $icon_bg_color != '' ) || ( isset( $icon_color ) && $icon_color != '' ) || ( isset( $icon_border_color ) && $icon_border_color != '' ) ) {
			
			$custom_stylings .= $custom_id . " .grid-item .grid-box-inner .grid-icon { ";
			
			if ( isset( $icon_bg_color ) && $icon_bg_color != '' ) {
				$custom_stylings .= 'background-color:'. $icon_bg_color .'; ';
			}
			if ( isset( $icon_border_color ) && $icon_border_color != '' ) {
				$custom_stylings .= 'border-color:'. $icon_border_color .'; ';
			}
			if ( isset( $icon_color ) && $icon_color != '' ) {
				$custom_stylings .= 'color:'. $icon_color .'; ';
			}
			
			$custom_stylings .= "}" . "\n";
			
		}
		
		// Hover Styles	
		if( ( isset( $icon_hv_color ) && $icon_hv_color != '' ) || ( isset( $icon_hv_br_color ) && $icon_hv_br_color != '' ) || ( isset( $icon_hv_bg_color ) && $icon_hv_bg_color != '' ) || ( isset( $icon_hv_br_color ) && $icon_hv_br_color != '' ) ) {			
			// Hover Only Background
			if ( isset( $icon_hover_style ) && $icon_hover_style == 'icon-hv-bg' ) {
				$custom_stylings .= $custom_id . " .grid-item:hover .grid-box-inner .icon-hv-bg .grid-icon { ";
				if ( isset( $icon_hv_bg_color ) && $icon_hv_bg_color != '' ) {
					$custom_stylings .= 'background-color:'. $icon_hv_bg_color .'; ';
				}
				
				$custom_stylings .= "}" . "\n";
			} 
			// Hover Only Border
			elseif ( isset( $icon_hover_style ) && $icon_hover_style == 'icon-hv-br' ) {
				$custom_stylings .= $custom_id . " .grid-item:hover .grid-box-inner .icon-hv-br .grid-icon { ";
				if ( isset( $icon_hv_br_color ) && $icon_hv_br_color != '' ) {
					$custom_stylings .= 'border-color:'. $icon_hv_br_color .'; ';
				}
							
				$custom_stylings .= "}" . "\n";
			} 
			// Hover Background & Border
			elseif ( isset( $icon_hover_style ) && $icon_hover_style == 'icon-hv-bg-br' ) {
				$custom_stylings .= $custom_id . " .grid-item:hover .grid-box-inner .icon-hv-bg-br .grid-icon { ";
				if ( isset( $icon_hv_bg_color ) && $icon_hv_bg_color != '' ) {
					$custom_stylings .= 'background-color:'. $icon_hv_bg_color .'; ';
				}
				if ( isset( $icon_hv_br_color ) && $icon_hv_br_color != '' ) {
					$custom_stylings .= 'border-color:'. $icon_hv_br_color .'; ';
				}				
				$custom_stylings .= "}" . "\n";
			} 
			// Hover Background & Icon Color
			elseif ( isset( $icon_hover_style ) && $icon_hover_style == 'icon-hv-bg-icon' ) {
				$custom_stylings .= $custom_id . " .grid-item:hover .grid-box-inner .icon-hv-bg-icon .grid-icon { ";
				if ( isset( $icon_hv_bg_color ) && $icon_hv_bg_color != '' ) {
					$custom_stylings .= 'background-color:'. $icon_hv_bg_color .'; ';
				}
				if ( isset( $icon_hv_color ) && $icon_hv_color != '' ) {
					$custom_stylings .= 'color:'. $icon_hv_color .'; ';
				}	
				$custom_stylings .= "}" . "\n";
			}
			// Hover Border & Icon Color
			elseif ( isset( $icon_hover_style ) && $icon_hover_style == 'icon-hv-br-icon' ) {
				$custom_stylings .= $custom_id . " .grid-item:hover .grid-box-inner .icon-hv-br-icon .grid-icon { ";
				if ( isset( $icon_hv_br_color ) && $icon_hv_br_color != '' ) {
					$custom_stylings .= 'border-color:'. $icon_hv_br_color .'; ';
				}
				if ( isset( $icon_hv_color ) && $icon_hv_color != '' ) {
					$custom_stylings .= 'color:'. $icon_hv_color .'; ';
				}
				$custom_stylings .= "}" . "\n";
			}
			// Hover Icon Color
			elseif ( isset( $icon_hover_style ) && $icon_hover_style == 'icon-hv-color' ) {
				$custom_stylings .= $custom_id . " .grid-item:hover .grid-box-inner .icon-hv-color .grid-icon { ";
				if ( isset( $icon_hv_color ) && $icon_hv_color != '' ) {
					$custom_stylings .= 'color:'. $icon_hv_color .'; ';
				}			
				$custom_stylings .= "}" . "\n";
			}	
			// Hover All
			elseif ( isset( $icon_hover_style ) && $icon_hover_style == 'icon-hv-all' ) {
				$custom_stylings .= $custom_id . " .grid-item:hover .grid-box-inner .icon-hv-all .grid-icon { ";
				if ( isset( $icon_hv_bg_color ) && $icon_hv_bg_color != '' ) {
					$custom_stylings .= 'background-color:'. $icon_hv_bg_color .'; ';
				}
				if ( isset( $icon_hv_br_color ) && $icon_hv_br_color != '' ) {
					$custom_stylings .= 'border-color:'. $icon_hv_br_color .'; ';
				}	
				if ( isset( $icon_hv_color ) && $icon_hv_color != '' ) {
					$custom_stylings .= 'color:'. $icon_hv_color .'; ';
				}			
				$custom_stylings .= "}" . "\n";
			}
		
		}
		
		if ( isset( $custom_stylings ) && $custom_stylings != '' ) {
			$output .= '<style type="text/css" scoped>';
			$output .= $custom_stylings;
			$output .= '</style>';
		}
		
		// Classes
		$main_classes = 'zozo-feature-box feature-box-style';
		$image_classes = '';
		
		if( isset( $classes ) && $classes != '' ) {
			$main_classes .= ' ' . $classes;
		}
		
		if( isset( $image_filters ) && $image_filters != '' ) {
			$main_classes .= ' zozo-img-filter-' . $image_filters;
			$image_classes = ' image-filter-' . $image_filters;
		}
		
		if( isset( $image_hover_style ) && $image_hover_style != '' ) {
			$main_classes .= ' zozo-img-hover zozo-img-hover-' . $image_hover_style;
		}
		
		if( isset( $box_style ) && $box_style != 'info-box' ) {
			$main_classes .= ' style-' . $box_style;
		} else {
			$main_classes .= ' style-info-box style-' . $info_box_style;
		}
		
		if( isset( $separator ) && $separator != '' ) {
			$main_classes .= ' style-sep-' . $separator;
		}
		
		if( isset( $image_shape ) && $image_shape != '' ) {
			$image_classes .= ' img-' . $image_shape;
		}
		
		if( isset( $feature_image ) && $feature_image != '' ) {
			$img_org_size = wp_get_attachment_image_src( $feature_image, 'full' );
			if( isset( $img_org_size[1] ) && $img_org_size[1] <= 250 ) {
				$image_classes .= ' img-size-small';
			}
		}
		
		$css_classes = array( vc_shortcode_custom_css_class( $css ) );
		
		$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), 'zozo_vc_feature_box', $atts ) );
		
		$main_classes .= ' ' . esc_attr( trim( $css_class ) );
		
		$main_classes .= zozo_vc_animation( $css_animation );
		
		// Image URL
		$img_link = $img_title = $img_target = '';
		if( $image_url && $image_url != '' ) {
			$link = vc_build_link( $image_url );
			$img_link = isset( $link['url'] ) ? $link['url'] : '';
			$img_title = isset( $link['title'] ) ? $link['title'] : '';
			$img_target = !empty( $link['target'] ) ? $link['target'] : '_self';
		}
		
		// Heading style
		if ( isset( $title ) && $title != '' ) {
			$heading_style = '';
			if( $title_color ) {
				$heading_style .= 'color:'. $title_color .';';
			}
			if( $title_size ) {
				$heading_style .= 'font-size:'. $title_size .';';
			}
			if( $heading_style ) {
				$heading_style = 'style="'. $heading_style  .'"';
			}
			
			$title_class = '';
			if( $title_align != '' ) {
				$title_class = ' text-'. $title_align .'';
			}
			$title_class .= ' ' . $title_extra_class;
			
			// Heading URL
			$title_link = $link_title = $link_target = '';
			if( $title_url && $title_url != '' ) {
				$link = vc_build_link( $title_url );
				$title_link = isset( $link['url'] ) ? $link['url'] : '';
				$link_title = isset( $link['title'] ) ? $link['title'] : '';
				$link_target = !empty( $link['target'] ) ? $link['target'] : '_self';
			}
		}
		
		// Content						
		if( isset( $content ) && $content != '' ) {
			$content_style = '';
			if ( $content_size ) {
				$content_style .= 'font-size:'. $content_size.';';
			}
			if ( $content_color ) {
				$content_style .= 'color:'. $content_color.';';
			}
			if ( $content_style ) {
				$content_style = 'style="'. $content_style .'"';
			}
			
			$content_class = '';
			if( $content_align != '' ) {
				$content_class = ' text-'. $content_align .'';
			}
		}
		
		// Button URL
		$button_link = $button_title = $button_target = '';
		if( $button_url && $button_url != '' ) {
			$link = vc_build_link( $button_url );
			$button_link = isset( $link['url'] ) ? $link['url'] : '';
			$button_title = isset( $link['title'] ) ? $link['title'] : '';
			$button_target = !empty( $link['target'] ) ? $link['target'] : '_self';
		}
		
		// Icon Shape Class
		$icon_extra_class = '';
		$grid_extra_class = '';
		if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
			if( isset( $icon_shape ) && $icon_shape != 'icon-none' ) {
				$icon_extra_class = ' icon-shape';
				$grid_extra_class = ' grid-icon-shape';
			}
		}
		
		// Icon Class
		$icon_wrapper_class = '';
		if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
			$icon_wrapper_class = ' grid-box-'.$icon_size.' grid-box-'.$icon_shape.'';
		} else {
			$icon_wrapper_class = ' grid-box-image';
		}
				
		$output .= '<div class="'. esc_attr( $main_classes ) .'"'. $div_id .'>';
			$output .= '<div class="grid-item">';
			
			if( isset( $box_style ) && ( $box_style != 'title-top-icon' && $box_style != 'overlay-box' ) ) {
			
				$output .= '<div class="grid-box-inner grid-text-'.$text_align.''.$icon_wrapper_class.''.$grid_extra_class.' grid-shape-'.$image_shape.'">';
				
					// Grid Box Style Center
					if( isset( $text_align ) && $text_align == "center" ) {
						
						// Heading ( Title Above )
						if( isset( $title_style ) && $title_style == "title-above" ) {
							if ( isset( $title ) && $title != '' ) {
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
								}
								$output .= '<'. $title_type .' class="grid-title-top grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '</a>';
								}
							}
						}
				
						// Image
						if( isset( $feature_image ) && $feature_image != '' ) {
							if( $image_shape == 'circle' ) {
								$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $feature_image, 'thumb_size' => 'team', 'class' => 'img-' . $image_shape ) );
							} else {
								$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $feature_image, 'thumb_size' => 'theme-mid', 'class' => 'img-' . $image_shape ) );
							}							
							$thumbnail = $post_thumbnail['thumbnail'];
							
							$output .= '<div class="grid-image-wrapper zozo-image-wrapper'.$image_classes.'">';
								if( isset( $img_link ) && $img_link != '' ) {
									$output .= '<a href="'. esc_url( $img_link ) .'" title="'. esc_attr( $img_title ) .'" target="'. esc_attr( $img_target ) .'">';
								}
								$output .= $thumbnail;
								if( isset( $img_link ) && $img_link != '' ) {
									$output .= '</a>';
								}
							$output .= '</div>';
						} 
						else {
							// Icon
							if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
								$output .= '<div class="grid-icon-wrapper '.$icon_hover_style.' shape-'.$icon_shape.'">';
									$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .' grid-icon zozo-icon'.$icon_extra_class.' '.$icon_shape.' '.$icon_skin_color.' '.$icon_style.' '.$icon_pattern.' icon-'.$icon_size.'"></i>';
								$output .= '</div>';
							}
							
						}
						
						// Heading ( Title Below )
						if( isset( $title_style ) && $title_style == "title-below" ) {
							if ( isset( $title ) && $title != '' ) {
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
								}							
								$output .= '<'. $title_type .' class="grid-title-below grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';				
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '</a>';
								}						
							}
						}
					
						// Content
						if( isset( $content ) && $content != '' ) {
							$output .= '<div class="grid-desc'.$content_class.'" '. $content_style .'>';
								$output .= wpb_js_remove_wpautop( $content, true );
							$output .= '</div>';
						}
						
						// Heading ( Title Bottom )
						if( isset( $title_style ) && $title_style == "title-bottom" ) {
							if ( isset( $title ) && $title != '' ) {
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
								}							
								$output .= '<'. $title_type .' class="grid-title-bottom grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';				
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '</a>';
								}						
							}
						}
						
						// Button
						if( isset( $show_button ) && $show_button == 'yes' ) {
							$output .= '<div class="grid-button'.$content_class.'">';
								if( isset( $button_style ) && $button_style == 'normal_style' ) {
									$output .= '<a href="'.esc_url( $button_link ).'" title="'. esc_attr( $button_title ).'" target="'. esc_attr( $button_target ).'">'.$button_text.'</a>';
								} elseif( isset( $button_style ) && $button_style == 'button_style' ) {
									$output .= '<a href="'.esc_url( $button_link ).'" class="btn btn-fbox-more" title="'. esc_attr( $button_title ).'" target="'. esc_attr( $button_target ).'">'.$button_text.'</a>';
								}
							$output .= '</div>';
						}
					}
					// Grid Box Style Left or Right
					elseif( isset( $text_align ) && ( $text_align == "left" || $text_align == "right" ) ) {
						
						// Image
						if( isset( $feature_image ) && $feature_image != '' ) {
							$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $feature_image, 'thumb_size' => 'theme-mid', 'class' => 'img-' . $image_shape ) );
							$thumbnail = $post_thumbnail['thumbnail'];
							
							$output .= '<div class="grid-image-wrapper zozo-image-wrapper'.$image_classes.'">';
								if( isset( $img_link ) && $img_link != '' ) {
									$output .= '<a href="'. esc_url( $img_link ) .'" title="'. esc_attr( $img_title ) .'" target="'. esc_attr( $img_target ) .'">';
								}
								$output .= $thumbnail;
								if( isset( $img_link ) && $img_link != '' ) {
									$output .= '</a>';
								}
							$output .= '</div>';
						} 
						else {
							// Icon
							if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
								$output .= '<div class="grid-icon-wrapper '.$icon_hover_style.' shape-'.$icon_shape.'">';
									$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .' grid-icon zozo-icon'.$icon_extra_class.' '.$icon_shape.' '.$icon_skin_color.' '.$icon_style.' '.$icon_pattern.' icon-'.$icon_size.'"></i>';
								$output .= '</div>';
							}
						}
							
						$output .= '<div class="grid-content-wrapper">';
							// Heading
							if ( isset( $title ) && $title != '' ) {
								if( isset( $title_link ) && $title_link ) {
									$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
								}							
								$output .= '<'. $title_type .' class="grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';				
								if( isset( $title_link ) && $title_link ) {
									$output .= '</a>';
								}						
							}
						
							// Content						
							if( isset( $content ) && $content != '' ) {
								$output .= '<div class="grid-desc'.$content_class.'" '. $content_style .'>';
									$output .= wpb_js_remove_wpautop( $content, true );								
								$output .= '</div>';
							}
							
							// Button
							if( isset( $show_button ) && $show_button == 'yes' ) {
								$output .= '<div class="grid-button'.$content_class.'">';
									if( isset( $button_style ) && $button_style == 'normal_style' ) {
										$output .= '<a href="'.esc_url( $button_link ).'" title="'. esc_attr( $button_title ).'" target="'. esc_attr( $button_target ).'">'.$button_text.'</a>';
									} elseif( isset( $button_style ) && $button_style == 'button_style' ) {
										$output .= '<a href="'.esc_url( $button_link ).'" class="btn btn-fbox-more" title="'. esc_attr( $button_title ).'" target="'. esc_attr( $button_target ).'">'.$button_text.'</a>';
									}
								$output .= '</div>';
							}
						$output .= '</div>';
						
					}
				
				$output .= '</div>'; // .grid-box-inner
			}
			elseif( isset( $box_style ) && $box_style == "overlay-box" ) {
				$count = '';
				
				// Box URL
				$box_url = $box_title = $box_target = '';
				if( $box_link && $box_link != '' ) {
					$link = vc_build_link( $box_link );
					$box_url = isset( $link['url'] ) ? $link['url'] : '';
					$box_title = isset( $link['title'] ) ? $link['title'] : '';
					$box_target = !empty( $link['target'] ) ? $link['target'] : '_self';
				}
				$output .= '<div class="grid-box-inner grid-text-'.$text_align.''.$icon_wrapper_class.' grid-shape-'.$image_shape.'">';
					
					if( isset( $box_url ) && $box_url != '' ) {
						$output .= '<a href="'. esc_url( $box_url ) .'" class="overlay-box-link" title="'. esc_attr( $box_title ) .'" target="'. esc_attr( $box_target ).'"></a>';
					}
					
					for( $count = 1; $count <= 2; $count++ ) {
						if( $count == 1 ) {
							$output .= '<div class="grid-overlay-top">';
						} else {
							$output .= '<div class="grid-overlay-bottom">';
						}
						
						$output .= '<div class="grid-overlay-info">';
						// Heading ( Title Above )
						if( isset( $title_style ) && $title_style == "title-above" ) {
							if ( isset( $title ) && $title != '' ) {
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
								}
								$output .= '<'. $title_type .' class="grid-title-top grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '</a>';
								}
							}
						}
						
						// Image
						if( isset( $feature_image ) && $feature_image != '' ) {
							if( $image_shape == 'circle' ) {
								$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $feature_image, 'thumb_size' => 'team', 'class' => 'img-' . $image_shape ) );
							} else {
								$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $feature_image, 'thumb_size' => 'theme-mid', 'class' => 'img-' . $image_shape ) );
							}
							
							$thumbnail = $post_thumbnail['thumbnail'];
							
							$output .= '<div class="grid-image-wrapper zozo-image-wrapper'.$image_classes.'">';
								if( isset( $img_link ) && $img_link != '' ) {
									$output .= '<a href="'. esc_url( $img_link ) .'" title="'. esc_attr( $img_title ) .'" target="'. esc_attr( $img_target ) .'">';
								}
								$output .= $thumbnail;
								if( isset( $img_link ) && $img_link != '' ) {
									$output .= '</a>';
								}
							$output .= '</div>';
						} 
						else {
							// Icon
							if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
								$output .= '<div class="grid-icon-wrapper '.$icon_hover_style.' shape-'.$icon_shape.'">';
									$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .' grid-icon zozo-icon'.$icon_extra_class.' '.$icon_shape.' '.$icon_skin_color.' '.$icon_style.' '.$icon_pattern.' icon-'.$icon_size.'"></i>';
								$output .= '</div>';
							}
						}
						
						// Heading ( Title Below )
						if( isset( $title_style ) && $title_style == "title-below" ) {
							if ( isset( $title ) && $title != '' ) {
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
								}							
								$output .= '<'. $title_type .' class="grid-title-below grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';				
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '</a>';
								}						
							}
						}
												
						if( $count == 2 ) {
							// Content
							if( isset( $content ) && $content != '' ) {
								$output .= '<div class="grid-desc'.$content_class.'" '. $content_style .'>';
									$output .= wpb_js_remove_wpautop( $content, true );
								$output .= '</div>';
							}
						}
						
						// Heading ( Title Bottom )
						if( isset( $title_style ) && $title_style == "title-bottom" ) {
							if ( isset( $title ) && $title != '' ) {
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
								}							
								$output .= '<'. $title_type .' class="grid-title-bottom grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';				
								if( isset( $title_link ) && $title_link != '' ) {
									$output .= '</a>';
								}						
							}
						}
						$output .= '</div>';
						
						if( $count <= 2 ) {
							// Button
							if( isset( $show_button ) && $show_button == 'yes' ) {
								$output .= '<div class="grid-button'.$content_class.'">';
									if( isset( $button_style ) && $button_style == 'normal_style' ) {
										$output .= '<a href="'.esc_url( $button_link ).'" title="'. esc_attr( $button_title ).'" target="'. esc_attr( $button_target ).'">'.$button_text.'</a>';
									} elseif( isset( $button_style ) && $button_style == 'button_style' ) {
										$output .= '<a href="'.esc_url( $button_link ).'" class="btn btn-fbox-more" title="'. esc_attr( $button_title ).'" target="'. esc_attr( $button_target ).'">'.$button_text.'</a>';
									}
								$output .= '</div>';
							}
						}
						
						$output .= '</div>';
					}
				$output .= '</div>'; // .grid-box-inner
			}
			else {
				$icon_box_class = '';
				$icon_box_class = " grid-icon-box-".$text_align."";
					
				$output .= '<div class="grid-icon-box">';
				$output .= '<div class="grid-box-inner grid-icon-box-wrapper'.$icon_wrapper_class.''.$grid_extra_class.' '.$icon_box_class.'">';
					
					if ( ( isset( $title ) && $title != '' ) || ( isset( $feature_image ) && $feature_image != '' ) ) {
						$output .= '<div class="grid-icon-box-title">';
					}
					
					if( $text_align == "right" ) {
						// Heading
						if ( isset( $title ) && $title != '' ) {
							if( isset( $title_link ) && $title_link ) {
								$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
							}
							$output .= '<'. $title_type .' class="grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';
							if( isset( $title_link ) && $title_link ) {
								$output .= '</a>';
							}
						}
					}
					
					// Image
					if( isset( $feature_image ) && $feature_image != '' ) {
						$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $feature_image, 'thumb_size' => 'thumbnail', 'class' => 'img-' . $image_shape ) );
						$thumbnail = $post_thumbnail['thumbnail'];
						
						$output .= '<div class="grid-image-wrapper zozo-image-wrapper'.$image_classes.'">';
							if( isset( $img_link ) && $img_link != '' ) {
								$output .= '<a href="'. esc_url( $img_link ) .'" title="'. esc_attr( $img_title ) .'" target="'. esc_attr( $img_target ) .'">';
							}
							$output .= $thumbnail;
							if( isset( $img_link ) && $img_link != '' ) {
								$output .= '</a>';
							}
						$output .= '</div>';
					} 
					else {
						// Icon
						if( isset( ${'icon_'. $type} ) && ${'icon_'. $type} != '' ) {
							$output .= '<div class="grid-icon-wrapper '.$icon_hover_style.' shape-'.$icon_shape.'">';
								$output .= '<i class="'. esc_attr( ${'icon_'. $type} ) .' grid-icon zozo-icon'.$icon_extra_class.' '.$icon_shape.' '.$icon_skin_color.' '.$icon_style.' '.$icon_pattern.' icon-'.$icon_size.'"></i>';
							$output .= '</div>';
						}
					}
					
					if( $text_align == "left" || $text_align == "center" ) {
						// Heading
						if ( isset( $title ) && $title != '' ) {
							if( isset( $title_link ) && $title_link ) {
								$output .= '<a href="'. esc_url( $title_link ) .'" title="'. esc_attr( $link_title ) .'" target="'. esc_attr( $link_target ) .'">';
							}
							$output .= '<'. $title_type .' class="grid-title'.$title_class.'" '.$heading_style.'>'. $title .'</'. $title_type .'>';
							if( isset( $title_link ) && $title_link ) {
								$output .= '</a>';
							}
						}
					}
					
					if ( ( isset( $title ) && $title != '' ) || ( isset( $feature_image ) && $feature_image != '' ) ) {
						$output .= '</div>';
					}
					
					$output .= '<div class="clearfix"></div>';
					
					$output .= '<div class="grid-icon-box-content">';
						// Content						
						if( isset( $content ) && $content != '' ) {
							$output .= '<div class="grid-desc'.$content_class.'" '. $content_style .'>';
								$output .= wpb_js_remove_wpautop( $content, true );
							$output .= '</div>';
						}
					
						// Button
						if( isset( $show_button ) && $show_button == 'yes' ) {
							$output .= '<div class="grid-button'.$content_class.'">';
								if( isset( $button_style ) && $button_style == 'normal_style' ) {
									$output .= '<a href="'.esc_url( $button_link ).'" title="'. esc_attr( $button_title ).'" target="'. esc_attr( $button_target ).'">'.$button_text.'</a>';
								} elseif( isset( $button_style ) && $button_style == 'button_style' ) {
									$output .= '<a href="'.esc_url( $button_link ).'" class="btn btn-fbox-more" title="'. esc_attr( $button_title ).'" target="'. esc_attr( $button_target ).'">'.$button_text.'</a>';
								}
							$output .= '</div>';
						}
					$output .= '</div>';
				
				$output .= '</div>';
				$output .= '</div>'; // .grid-icon-box
			}
			$output .= '</div>'; // .grid-item
			
		$output .= '</div>';
		
		$feature_box_id++;
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_feature_box_shortcode_map' ) ) {
	function zozo_vc_feature_box_shortcode_map() {
		
		vc_map( 
			array(
				"name"					=> __( "Feature Box", "mist" ),
				"description"			=> __( "A feature box with list or grid style.", 'mist' ),
				"base"					=> "zozo_vc_feature_box",
				"category"				=> __( "Theme Addons", "mist" ),
				"icon"					=> "zozo-vc-icon",
				"params"				=> array(
					array(
						'type'			=> 'textfield',
						'admin_label' 	=> true,
						'heading'		=> __( 'ID', "mist" ),
						'param_name'	=> 'id',
						'value' 		=> '',
					),
					array(
						'type'			=> 'textfield',
						'admin_label' 	=> true,
						'heading'		=> __( 'Extra Classes', "mist" ),
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
						"param_name"	=> "box_style",
						'admin_label' 	=> true,
						"value"			=> array(
							__( "Default Box", "mist" )			=> "default-box",
							__( "Info Box", "mist" )				=> "info-box",							
							__( "Icon & Title on Top", "mist" )	=> "title-top-icon",
							__( "Overlay Style", "mist" )			=> "overlay-box",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Info Box Style", "mist" ),
						"param_name"	=> "info_box_style",
						"value"			=> array(
							__( "Box with Background", "mist" )		=> "box-with-bg",
							__( "Box without Background", "mist" )	=> "box-without-bg",
							__( "Box with Bordered", "mist" )			=> "outline-box",
						),
						'dependency'	=> array(
							'element'	=> 'box_style',
							"value" 	=> array( "info-box" ),
						),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Box Link", 'mist' ),
						"param_name"	=> "box_link",
						"value"			=> "",
						'dependency'	=> array(
							'element'	=> 'box_style',
							"value" 	=> array( "overlay-box" ),
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Alignment", "mist" ),
						"param_name"	=> "text_align",
						'admin_label' 	=> true,
						"value"			=> array(
							__( "Default", "mist" )	=> "",
							__( "Center", "mist" )	=> "center",
							__( "Left", "mist" )		=> "left",
							__( "Right", "mist" )		=> "right",
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Title Position", "mist" ),
						"param_name"	=> "title_style",
						"value"			=> array(
							__( "Default", "mist" )						=> "",
							__( "Title below Icon or Image", "mist" )		=> "title-below",
							__( "Title above Icon or Image", "mist" )		=> "title-above",
							__( "Title Bottom", "mist" )					=> "title-bottom",
						),
						'dependency'	=> array(
							'element'	=> 'text_align',
							"value" 	=> array( "", "center" ),
						),
					),					
					// Image 
					array(
						"type"			=> "attach_image",
						"heading"		=> __( "Image", "mist" ),
						"param_name"	=> "feature_image",
						"value"			=> "",
						'group'			=> __( 'Image', 'mist' ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Image Link", 'mist' ),
						"param_name"	=> "image_url",
						"value"			=> "",
						'group'			=> __( 'Image', 'mist' ),
						'dependency'	=> array(
							'element'	=> 'feature_image',
							'not_empty'	=> true,
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Image Shapes", "mist" ),
						"param_name"	=> "image_shape",
						"value"			=> array(
							__( "None", "mist" )		=> "",
							__( "Rounded", "mist" )	=> "rounded",
							__( "Circle", "mist" )	=> "circle",
						),
						'group'			=> __( 'Image', 'mist' ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Image Filters", 'mist' ),
						"param_name"	=> "image_filters",
						"value"			=> zozo_vc_image_filters(),
						'group'			=> __( 'Image', 'mist' ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Image Hover Effects", 'mist' ),
						"param_name"	=> "image_hover_style",
						"value"			=> zozo_vc_image_hovers(),
						'group'			=> __( 'Image', 'mist' ),
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
						"heading" 		=> __( "Feature Icon", "mist" ),
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
						"heading" 		=> __( "Feature Icon", "mist" ),
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
						"heading" 		=> __( "Feature Icon", "mist" ),
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
						"heading" 		=> __( "Feature Icon", "mist" ),
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
						"heading" 		=> __( "Feature Icon", "mist" ),
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
						"heading" 		=> __( "Feature Icon", "mist" ),
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
						"heading"		=> __( "Icon Size", "mist" ),
						"param_name"	=> "icon_size",
						"value"			=> array(
							__( "Normal", "mist" )		=> "normal",
							__( "Small", "mist" )			=> "small",
							__( "Medium", "mist" )		=> "medium",
							__( "Large", "mist" )			=> "large",
							__( "Extra Large", "mist" )	=> "exlarge",
						),
						"group"			=> __( "Icon", "mist" ),
					),			
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Shape", "mist" ),
						"param_name"	=> "icon_shape",
						'admin_label' 	=> true,
						"value"			=> array(
							__( "None", "mist" )		=> "icon-none",
							__( "Circle", "mist" )	=> "icon-circle",
							__( "Rounded", "mist" )	=> "icon-rounded",
							__( "Square", "mist" )	=> "icon-square",
						),
						"group"			=> __( "Icon", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Color", "mist" ),
						"param_name"	=> "icon_skin_color",
						"value"			=> array(
							__( "Default", "mist" )	=> "icon-skin-default",
							__( "Light", "mist" )		=> "icon-skin-light",
							__( "Dark", "mist" )		=> "icon-skin-dark",
						),
						'dependency'	=> array(
							'element'	=> 'icon_shape',
							'value'		=> array( 'icon-none' ),
						),
						"group"			=> __( "Icon", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Background Style", "mist" ),
						"param_name"	=> "icon_style",
						'admin_label' 	=> true,
						"value"			=> array(
							__( "Default Background", "mist" )		=> "icon-bg",
							__( "Light Background", "mist" )			=> "icon-light",
							__( "Dark Background", "mist" )			=> "icon-dark",
							__( "Transparent", "mist" )				=> "icon-transparent",
							__( "Pattern Background", "mist" )		=> "icon-pattern",
							__( "Bordered", "mist" )					=> "icon-bordered",
							__( "Bordered w/ Background", "mist" ) 	=> "icon-border-bg",
						),
						"group"			=> __( "Icon", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Pattern Background", "mist" ),
						"param_name"	=> "icon_pattern",
						"value"			=> array(
							__( "Pattern 1", "mist" )			=> "pattern-1",
							__( "Pattern 2", "mist" )			=> "pattern-2",
							__( "Pattern 3", "mist" )			=> "pattern-3",
							__( "Pattern 4", "mist" )			=> "pattern-4",
							__( "Pattern 5", "mist" )			=> "pattern-5",
							__( "Custom Pattern", "mist" )	=> "custom-pattern",
						),
						"group"			=> __( "Icon", "mist" ),
						'dependency'	=> array(
							'element'	=> 'icon_style',
							'value'		=> array( 'icon-pattern' ),
						),
					),
					array(
						"type"			=> "attach_image",
						"heading"		=> __( "Pattern Image", "mist" ),
						"param_name"	=> "pattern_image",
						"value"			=> "",
						"group"			=> __( "Icon", "mist" ),
						'dependency'	=> array(
							'element'	=> 'icon_pattern',
							'value'		=> array( 'custom-pattern' ),
						),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Icon Hover Style", "mist" ),
						"param_name"	=> "icon_hover_style",
						"value"			=> array(
							__( "No Hover", "mist" )							=> "no-hover",
							__( "Color", "mist" )								=> "icon-hv-color",
							__( "Background Color", "mist" )					=> "icon-hv-bg",
							__( "Border Color", "mist" )						=> "icon-hv-br",
							__( "Both Background & Border Color", "mist" )	=> "icon-hv-bg-br",
							__( "Both Border & Icon Color", "mist" )			=> "icon-hv-br-icon",
							__( "Both Background & Icon Color", "mist" )		=> "icon-hv-bg-icon",
							__( "All Colors", "mist" ) 						=> "icon-hv-all",
						),
						"group"			=> __( "Icon", "mist" ),
					),
					// Headings
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Heading", "mist" ),
						"param_name"	=> "title",
						"value"			=> "Sample Heading",
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Heading Type", "mist" ),
						"param_name"	=> "title_type",
						"value"			=> array(
							__( "h2", "mist" )	=> "h2",
							__( "h3", "mist" )	=> "h3",
							__( "h4", "mist" )	=> "h4",
							__( "h5", "mist" )	=> "h5",
							__( "h6", "mist" )	=> "h6",
						),
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Heading URL", "mist" ),
						"param_name"	=> "title_url",
						"value"			=> "",
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Heading Font Size", "mist" ),
						"param_name"	=> "title_size",
						"description" 	=> __( "Enter Heading Font Size. Ex: 20px", "mist" ),
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Heading Alignment", "mist" ),
						"param_name"	=> "title_align",
						"value"			=> array(
							__( "Default", "mist" )	=> "",
							__( "Center", "mist" )	=> "center",
							__( "Left", "mist" )		=> "left",
							__( "Right", "mist" )		=> "right",
						),
						"group"			=> __( "Heading", "mist" ),
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> __( 'Extra Heading Classes', "mist" ),
						'param_name'	=> 'title_extra_class',
						'value' 		=> '',
						"group"			=> __( "Heading", "mist" ),
					),
					// Content
					array(
						"type"			=> "textarea_html",
						"holder"		=> "div",
						"heading"		=> __( "Content", "mist" ),
						"param_name"	=> "content",
						"value"			=> __( 'I am text block. Please change this dummy text in your page editor for this feature box.', "mist" ),
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Content Font Size", "mist" ),
						"param_name"	=> "content_size",
						"description" 	=> __( "Enter Content Font Size. Ex: 15px", "mist" ),
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Content Alignment", "mist" ),
						"param_name"	=> "content_align",
						"value"			=> array(
							__( "Default", "mist" )	=> "",
							__( "Center", "mist" )	=> "center",
							__( "Left", "mist" )		=> "left",
							__( "Right", "mist" )		=> "right",
						),
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Separator", "mist" ),
						"param_name"	=> "separator",
						"value"			=> array(
							__( "Yes", "mist" )		=> "yes",
							__( "No", "mist" )		=> "no",
						),
						"description" 	=> __( "Choose this option to show border separator between content and button.", "mist" ),
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Show Button", "mist" ),
						"param_name"	=> "show_button",
						"value"			=> array(
							__( "No", "mist" )	=> "no",
							__( "Yes", "mist" )	=> "yes",							
						),
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Button Text", "mist" ),
						"param_name"	=> "button_text",
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> "vc_link",
						"heading"		=> __( "Button URL", "mist" ),
						"param_name"	=> "button_url",
						"value"			=> "",
						"group"			=> __( "Content", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Button Style", "mist" ),
						"param_name"	=> "button_style",
						"value"			=> array(
							__( "Normal", "mist" )	=> "normal_style",
							__( "Button", "mist" )	=> "button_style",							
						),
						"group"			=> __( "Content", "mist" ),
					),
					// Stylings
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Heading Color", "mist" ),
						"param_name"	=> "title_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> __( "Content Color", "mist" ),
						"param_name"	=> "content_color",
						"group"			=> __( "Stylings", "mist" ),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Box Background Color", "mist" ),
						"param_name"	=> "bg_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'box_style',
							'value'		=> array( 'info-box' ),
						),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Box Hover Background Color", "mist" ),
						"param_name"	=> "bg_hover_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'box_style',
							'value'		=> array( 'info-box' ),
						),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Box Border Color", "mist" ),
						"param_name"	=> "box_br_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'info_box_style',
							'value'		=> 'outline-box',
						),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Box Hover Border Color", "mist" ),
						"param_name"	=> "box_hv_br_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'info_box_style',
							'value'		=> 'outline-box',
						),
					),
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
						'dependency'	=> array(
							'element'	=> 'icon_style',
							'value'		=> array( 'icon-bg', 'icon-border-bg', 'icon-pattern' ),
						),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Border Color", "mist" ),
						"param_name"	=> "icon_border_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'icon_style',
							'value'		=> array( 'icon-border-bg', 'icon-bordered' ),
						),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Hover Color", "mist" ),
						"param_name"	=> "icon_hv_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'icon_hover_style',
							'value'		=> array( 'icon-hv-color', 'icon-hv-br-icon', 'icon-hv-bg-icon', 'icon-hv-all' ),
						),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Hover Background Color", "mist" ),
						"param_name"	=> "icon_hv_bg_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'icon_hover_style',
							'value'		=> array( 'icon-hv-bg', 'icon-hv-bg-br', 'icon-hv-bg-icon', 'icon-hv-all' ),
						),
					),
					array(
						"type"			=> 'colorpicker',
						"heading"		=> __( "Icon Hover Border Color", "mist" ),
						"param_name"	=> "icon_hv_br_color",
						"group"			=> __( "Stylings", "mist" ),
						'dependency'	=> array(
							'element'	=> 'icon_hover_style',
							'value'		=> array( 'icon-hv-br', 'icon-hv-bg-br', 'icon-hv-br-icon', 'icon-hv-all' ),
						),
					),
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> __( 'CSS box', 'mist' ),
						'param_name' 	=> 'css',
						'group' 		=> __( 'Design Options', 'mist' )
					),					
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_feature_box_shortcode_map' );
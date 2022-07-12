<?php 
/**
 * Woocommerce Latest Product Slider shortcode
 */

if ( ! function_exists( 'zozo_vc_woo_product_slider_shortcode' ) ) {
	function zozo_vc_woo_product_slider_shortcode( $atts, $content = NULL ) {
		
		extract( 
			shortcode_atts( 
				array(
					'classes'					=> '',
					'css_animation'				=> '',
					'products' 					=> '-1',
					'categories_id' 			=> 'all',
					'items'						=> '6',
					'items_scroll' 				=> '1',
					'auto_play' 				=> 'true',					
					'timeout_duration' 			=> '5000',
					'infinite_loop' 			=> 'false',
					'margin' 					=> '30',
					'items_tablet'				=> '4',
					'items_mobile_landscape'	=> '2',
					'items_mobile_portrait'		=> '1',
					'navigation' 				=> 'true',
					'pagination' 				=> 'true',
				), $atts 
			) 
		);

		$output = '';
		global $post;
		static $product_slider_id = 1;
				
		// Slider Configuration
		$data_attr = '';
	
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
		
		// Classes
		$main_classes = '';
		$main_classes .= zozo_vc_animation( $css_animation );
		
		$query_args = array(
				'post_type' 		=> 'product',
				'post_status' 		=> 'publish',
				'posts_per_page'	=> $products,
				'orderby' 			=> 'date',
				'order' 			=> 'DESC',
			);
			
		if( $categories_id != 'all' ) {
			$query_args['tax_query'] 	= array(
											array(
												'taxonomy' 	=> 'product_cat',
												'field' 	=> 'slug',
												'terms' 	=> $categories_id
											) );
		
		}
	
		$latest_product_query = new WP_Query( $query_args );
		
		if( $latest_product_query->have_posts() ) {
			$output = '<div class="zozo-woo-latest-slider-wrapper clearfix'.$main_classes.'">';
			$output .= '<div id="zozo-woo-latest-slider-' . $product_slider_id. '" class="zozo-owl-carousel zozo-woo-latest-slider owl-carousel"' . $data_attr . '>';
			
				while($latest_product_query->have_posts()) : $latest_product_query->the_post();
					global $product;
					$woo_product_img 	= wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'theme-mid' );
					$cat_count 			= sizeof( get_the_terms( get_the_ID(), 'product_cat' ) );
					
					$output .= '<div class="woo-latest-slider-item">';
						
						$output .= '<div class="woo-latest-product-box">';
							$output .= '<a href="'.get_permalink().'" title="'.get_the_title().'"><img src="'.esc_url( $woo_product_img[0] ).'" alt="'.get_the_title().'" /></a>';
							$output .= '<div class="product-buttons-overlay">';
							$output .= '<div class="product-buttons-wrapper"><div class="product-buttons">';
								$output .= '<a href="' . get_permalink() . '" class="woo-show-details">' . esc_html__( 'Show Details', 'mist' ) . '</a>';
							$output .= '</div></div>';
							$output .= '</div>';
						$output .= '</div>';
						
						$output .= '<div class="woo-latest-product-content">';
							$output .= '<h6 class="latest-product-title">'.get_the_title().'</h6>';
							if ( $price_html = $product->get_price_html() ) :
								$output .= '<span class="price">'. $price_html .'</span>';
							endif;							
						$output .= '</div>';
						
					$output .= '</div>';
					
				endwhile;
				
			$output .= '</div>';
			$output .= '</div>';
		}
		
		$product_slider_id++;
		wp_reset_postdata();
		
		return $output;
	}
}


if ( ! function_exists( 'zozo_vc_woo_product_slider_shortcode_map' ) ) {
	function zozo_vc_woo_product_slider_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> __( "Woo Latest Product Slider", "mist" ),
				"description"			=> __( "Show latest products in Slider.", 'mist' ),
				"base"					=> "zozo_vc_woo_product_slider",
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
						"type"			=> "textfield",
						"heading"		=> __( "Number Of Products", "mist" ),
						"param_name"	=> "products",
						'admin_label' 	=> true,
						'value' 		=> '',
					),
					// Slider
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Display", "mist" ),
						"param_name"	=> "items",
						'admin_label'	=> true,
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items to Scrollby", "mist" ),
						"param_name"	=> "items_scroll",
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> __( "Auto Play", 'mist' ),
						'param_name'	=> "auto_play",
						'admin_label'	=> true,				
						'value'			=> array(
							__( 'True', 'mist' )	=> 'true',
							__( 'False', 'mist' )	=> 'false',
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
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Margin ( Items Spacing )", "mist" ),
						"param_name"	=> "margin",
						'admin_label'	=> true,
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display in Tablet", "mist" ),
						"param_name"	=> "items_tablet",
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Landscape", "mist" ),
						"param_name"	=> "items_mobile_landscape",
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> __( "Items To Display In Mobile Portrait", "mist" ),
						"param_name"	=> "items_mobile_portrait",
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Navigation", "mist" ),
						"param_name"	=> "navigation",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false" ),
						"group"			=> __( "Slider", "mist" ),
					),
					array(
						"type"			=> 'dropdown',
						"heading"		=> __( "Pagination", "mist" ),
						"param_name"	=> "pagination",
						"value"			=> array(
							__( "Yes", "mist" )	=> "true",
							__( "No", "mist" )	=> "false" ),
						"group"			=> __( "Slider", "mist" ),
					),
				)
			) 
		);
	}
}
add_action( 'vc_before_init', 'zozo_vc_woo_product_slider_shortcode_map' );
<?php 
/**
 * Add new params to Visual Composer
 *
 * @package		Mist
 * @subpackage	Visual Composer
 * @author		Zozothemes
 */

/* =========================================
*  Rows
*  ========================================= */

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Style', 'mist' ),
	'param_name'	=> 'bg_style',
	'value'			=> array(
		__( 'Default', 'mist' )								=> '',
		__( 'Primary Background Color', 'mist' )				=> 'bg-normal',
		__( 'Light Background Color', 'mist' )				=> 'light-wrapper',
		__( 'Grey Background Color', 'mist' )					=> 'grey-wrapper',
		__( 'Dark Background Color', 'mist' )					=> 'dark-wrapper',
		__( 'Dark Grey Background Color', 'mist' )			=> 'dark-grey-wrapper',
		__( 'Image Left, Content on Right', 'mist' )			=> 'image-left',
		__( 'Image Right, Content on Left', 'mist' )			=> 'image-right',
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Skin', 'mist' ),
	'param_name'	=> 'bg_side_skin',
	'value'			=> array(
		__( 'Default', 'mist' )								=> '',
		__( 'Primary Background Color', 'mist' )				=> 'bg-normal',
		__( 'Light Background Color', 'mist' )				=> 'light-wrapper',
		__( 'Grey Background Color', 'mist' )					=> 'grey-wrapper',
		__( 'Dark Background Color', 'mist' )					=> 'dark-wrapper',
		__( 'Dark Grey Background Color', 'mist' )			=> 'dark-grey-wrapper',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'attach_image',
	'heading'		=> __( 'Left or Right Image', 'mist' ),
	'param_name'	=> 'bg_side_image',
	'value'			=> '',
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Size', 'mist' ),
	'param_name'	=> 'bg_side_size',
	'value'			=> array(
		__( 'Default', 'mist' )	=> 'default',
		__( 'Cover', 'mist' )		=> 'cover',
		__( 'Contain', 'mist' )	=> 'contain',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Repeat', 'mist' ),
	'param_name'	=> 'bg_side_repeat',
	'value'			=> array(
		__( 'No Repeat', 'mist' )	=> 'no-repeat',
		__( 'Repeat', 'mist' )	=> 'repeat',
		__( 'Repeat-x', 'mist' )	=> 'repeat-x',
		__( 'Repeat-y', 'mist' )	=> 'repeat-y',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Make Container Fluid ?', 'mist' ),
	'param_name'	=> 'container_fluid',
	'value'			=> array(
		__( 'No', 'mist' )	=> 'no',
		__( 'Yes', 'mist' )	=> 'yes',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( 'image-left', 'image-right' )
	),
	'description'	=> __( 'Use this option to make column in fluid container.', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Column Match Height', 'mist' ),
	'param_name'	=> 'match_height',
	'value'			=> array(
		__( 'No', 'mist' )	=> 'no',
		__( 'Yes', 'mist' )	=> 'yes',
	),
	'dependency'	=> array(
		'element'	=> 'bg_style',
		'value'		=> array( '', 'bg-normal', 'light-wrapper', 'grey-wrapper', 'dark-wrapper' )
	),
	'description'	=> __( 'Use this option to make all column in equal heights..', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Center Row Content', 'mist' ),
	'param_name'	=> 'center_row',
	'value'			=> array(
		__( 'No', 'mist' )	=> 'no',
		__( 'Yes', 'mist' )	=> 'yes',
	),
	'description'	=> __( 'Use this option to add container and center the inner content. Useful when using full-width pages.', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'checkbox',
	'heading'		=> __( 'Enable Background Image Overlay?', 'mist' ),
	'param_name'	=> 'bg_overlay',
	'description'	=> __( 'Check this box to enable the overlay for background image.', 'mist' ),
	'value'			=> array(
		__( 'Yes, please', 'mist' )	=> 'yes'
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Overlay Style', 'mist' ),
	'param_name'	=> 'bg_overlay_style',
	'value'			=> array(
		__( 'Default', 'mist' )				=> 'overlay-dark',
		__( 'Dark Overlay', 'mist' )			=> 'overlay-dark',
		__( 'Light Overlay', 'mist' )			=> 'overlay-light',
		__( 'Theme Overlay', 'mist' )			=> 'overlay-primary',	
	),
	'dependency'	=> array(
		'element'	=> 'bg_overlay',
		'value'		=> 'yes'
	),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'checkbox',
	'heading'		=> __( 'Enable Video Background?', 'mist' ),
	'param_name'	=> 'enable_video_bg',
	'description'	=> __( 'Check this box to enable the options for video background.', 'mist' ),
	'value'			=> array(
		__( 'Yes, please', 'mist' )	=> 'yes'
	),
	'group'			=> __( 'Video', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'textfield',
	'heading'		=> __( 'Video ID', 'mist' ),
	'param_name'	=> 'video_id',
	'description'	=> __( 'Enter Youtube Video ID to play background video. Ex: Y-OLlJUXwKU', 'mist' ),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'attach_image',
	'heading'		=> __( 'Video Fallback Image', 'mist' ),
	'param_name'	=> 'video_fallback',
	'value'			=> '',
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Video Autoplay', 'mist' ),
	'param_name'	=> 'video_autoplay',
	'value'			=> array(
		__( 'Yes', 'mist' )	=> 'true',
		__( 'No', 'mist' )	=> 'false',
	),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Video Mute', 'mist' ),
	'param_name'	=> 'video_mute',
	'value'			=> array(
		__( 'No', 'mist' )	=> 'false',
		__( 'Yes', 'mist' )	=> 'true',
	),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Video Controls', 'mist' ),
	'param_name'	=> 'video_controls',
	'value'			=> array(
		__( 'No', 'mist' )	=> 'false',
		__( 'Yes', 'mist' )	=> 'true',
	),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'textfield',
	'heading'		=> __( 'Video Height', 'mist' ),
	'param_name'	=> 'video_height',
	'description'	=> __( 'Enter Video Height. Ex: 400', 'mist' ),
	'dependency'	=> array(
		'element'	=> 'enable_video_bg',
		'value'		=> 'yes'
	),
	'group'			=> __( 'Video', 'mist' ),
) );

vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Typography Style', 'mist' ),
	'param_name'	=> 'typo_style',
	'value'			=> array(
		__( 'Dark Text', 'mist' )		=> 'dark',
		__( 'Default', 'mist' )		=> 'default',
		__( 'White Text', 'mist' )	=> 'light',
	),
) );

vc_add_param( 'vc_row', vc_map_add_css_animation( $label = false ) );

vc_add_param( 'vc_row', array(
	'type'			=> 'textfield',
	'heading'		=> __( 'Minimum Height', 'mist' ),
	'param_name'	=> 'min_height',
	'description'	=> __( 'You can enter a minimum height for this row.', 'mist' ),
) );

vc_remove_param( 'vc_row', 'equal_height' );

/* =========================================
*  Row Inner
*  ========================================= */

vc_add_param( 'vc_row_inner', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Column Match Height', 'mist' ),
	'param_name'	=> 'match_height',
	'value'			=> array(
		__( 'No', 'mist' )	=> 'no',
		__( 'Yes', 'mist' )	=> 'yes',
	),
	'description'	=> __( 'Use this option to make all column in equal heights..', 'mist' ),
) );

vc_remove_param( 'vc_row_inner', 'equal_height' );

/* =========================================
*  Columns
*  ========================================= */

vc_add_param( 'vc_column', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Style', 'mist' ),
	'param_name'	=> 'bg_style',
	'value'			=> array(
		__( 'Default', 'mist' )								=> '',
		__( 'Primary Background Color', 'mist' )				=> 'bg-normal',
		__( 'Light Background Color', 'mist' )				=> 'light-wrapper',
		__( 'Grey Background Color', 'mist' )					=> 'grey-wrapper',
		__( 'Dark Background Color', 'mist' )					=> 'dark-wrapper',
		__( 'Dark Grey Background Color', 'mist' )			=> 'dark-grey-wrapper',
	),
) );

vc_add_param( 'vc_column', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Typography Style', 'mist' ),
	'param_name'	=> 'typo_style',
	'value'			=> array(
		__( 'Default', 'mist' )		=> 'default',
		__( 'Dark Text', 'mist' )		=> 'dark',
		__( 'White Text', 'mist' )	=> 'light',
	),
) );

vc_add_param( 'vc_column', vc_map_add_css_animation( $label = false) );

/* =========================================
*  Column inner
*  ========================================= */

vc_add_param( 'vc_column_inner', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Background Style', 'mist' ),
	'param_name'	=> 'bg_style',
	'value'			=> array(
		__( 'Default', 'mist' )								=> '',
		__( 'Primary Background Color', 'mist' )				=> 'bg-normal',
		__( 'Light Background Color', 'mist' )				=> 'light-wrapper',
		__( 'Grey Background Color', 'mist' )					=> 'grey-wrapper',
		__( 'Dark Background Color', 'mist' )					=> 'dark-wrapper',
		__( 'Dark Grey Background Color', 'mist' )			=> 'dark-grey-wrapper',
	),
) );

vc_add_param( 'vc_column_inner', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Typography Style', 'mist' ),
	'param_name'	=> 'typo_style',
	'value'			=> array(
		__( 'Default', 'mist' )		=> 'default',
		__( 'Dark Text', 'mist' )		=> 'dark',
		__( 'White Text', 'mist' )	=> 'light',
	),
) );

vc_add_param( 'vc_column_inner', vc_map_add_css_animation( $label = false) );

/* =========================================
*  Accordion
*  ========================================= */

vc_add_param( 'vc_tta_accordion', array(
	'type'			=> 'dropdown',
	'heading'		=> __( 'Style', 'mist' ),
	'description' 	=> __( 'Select accordion display style.', 'mist' ),
	'param_name'	=> 'style',
	'value'			=> array(
		__( 'Default', 'mist' ) 	=> 'default',
		__( 'Classic', 'mist' ) 	=> 'classic',
		__( 'Modern', 'mist' ) 	=> 'modern',
		__( 'Flat', 'mist' ) 		=> 'flat',
		__( 'Outline', 'mist' ) 	=> 'outline',
	),
) );

/* =========================================
*  Section
*  ========================================= */

vc_remove_param( 'vc_tta_section', 'el_class' );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> "dropdown",
	"heading" 		=> __( "Icon library", "mist" ),
	"value" 		=> array(
		__( "Font Awesome", "mist" ) 		=> "fontawesome",
		__( 'Open Iconic', 'mist' ) 		=> 'openiconic',
		__( 'Typicons', 'mist' ) 		=> 'typicons',
		__( 'Entypo', 'mist' ) 			=> 'entypo',
		__( "Lineicons", "mist" ) 		=> "lineicons",
		__( "Flaticons", "mist" ) 		=> "flaticons",
		__( "Icomoon Pack 1", "mist" ) 	=> "icomoonpack1",
		__( "Icomoon Pack 2", "mist" ) 	=> "icomoonpack2",
		__( "Icomoon Pack 3", "mist" ) 	=> "icomoonpack3",
	),
	"admin_label" 	=> true,
	"param_name" 	=> "i_type",
	"dependency" 	=> array(
						"element" 	=> "add_icon",
						"value" 	=> "true",
					),
	"description" 	=> __( "Select icon library.", "mist" ),
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "mist" ),
	"param_name" 	=> "i_icon_lineicons",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'simplelineicons',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "lineicons",
	),
	"description" 	=> __( "Select icon from library.", "mist" ),
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "mist" ),
	"param_name" 	=> "i_icon_flaticons",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'flaticons',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "flaticons",
	),
	"description" 	=> __( "Select icon from library.", "mist" ),
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "mist" ),
	"param_name" 	=> "i_icon_icomoonpack1",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'icomoonpack1',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "icomoonpack1",
	),
	"description" 	=> __( "Select icon from library.", "mist" ),
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "mist" ),
	"param_name" 	=> "i_icon_icomoonpack2",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'icomoonpack2',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "icomoonpack2",
	),
	"description" 	=> __( "Select icon from library.", "mist" ),	
) );

vc_add_param( 'vc_tta_section', array(
	"type" 			=> 'iconpicker',
	"heading" 		=> __( "Icon", "mist" ),
	"param_name" 	=> "i_icon_icomoonpack3",
	"value" 		=> "",
	"settings" 		=> array(
		"emptyIcon" 	=> true,
		"type" 			=> 'icomoonpack3',
		"iconsPerPage" 	=> 4000,
	),
	"dependency" 	=> array(
		"element" 	=> "i_type",
		"value" 	=> "icomoonpack3",
	),
	"description" 	=> __( "Select icon from library.", "mist" ),
) );

vc_add_param( 'vc_tta_section', array(
	'type' 			=> 'textfield',
	'heading' 		=> __( 'Extra class name', 'mist' ),
	'param_name' 	=> 'el_class',
	'description' 	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'mist' )
) );

/* =========================================
*  Button
*  ========================================= */

vc_add_param( 'vc_btn', array(
	"type" 			=> "dropdown",
	'heading' 		=> __( 'Style', 'mist' ),
	'description' 	=> __( 'Select button display style.', 'mist' ),
	'value' 		=> array(
		__( 'Default', 'mist' ) 			=> 'default',
		__( 'Transparent', 'mist' ) 		=> 'transparent',
		__( 'Modern', 'mist' ) 			=> 'modern',
		__( 'Classic', 'mist' ) 			=> 'classic',
		__( 'Flat', 'mist' ) 				=> 'flat',
		__( 'Outline', 'mist' ) 			=> 'outline',
		__( '3d', 'mist' ) 				=> '3d',
		__( 'Custom', 'mist' ) 			=> 'custom',
		__( 'Outline custom', 'mist' ) 	=> 'outline-custom',
	),
	"param_name" 	=> "style",
) );

vc_add_param( 'vc_btn', array(
	'type' 					=> 'dropdown',
	'heading' 				=> __( 'Color', 'mist' ),
	'param_name' 			=> 'color',
	'description' 			=> __( 'Select button color.', 'mist' ),
	// compatible with btn2, need to be converted from btn1
	'param_holder_class' 	=> 'vc_colored-dropdown vc_btn3-colored-dropdown',
	'value' 				=> array(
				// Theme Colors
				__( 'Theme Color', 'mist' ) 		=> 'primary-bg',
			   // Btn1 Colors
			   __( 'Classic Grey', 'mist' ) 		=> 'default',
			   __( 'Classic Blue', 'mist' ) 		=> 'primary',
			   __( 'Classic Turquoise', 'mist' ) => 'info',
			   __( 'Classic Green', 'mist' ) 	=> 'success',
			   __( 'Classic Orange', 'mist' )	=> 'warning',
			   __( 'Classic Red', 'mist' ) 		=> 'danger',
			   __( 'Classic Black', 'mist' ) 	=> "inverse"
			   // + Btn2 Colors (default color set)
		   ) + vc_get_shared( 'colors-dashed' ),
	'std' 					=> 'primary-bg',
	// must have default color grey
	'dependency' => array(
		'element' => 'style',
		'value_not_equal_to' => array( 'custom', 'outline-custom' )
	),
) );

/* =========================================
*  Call To Action
*  ========================================= */

vc_add_param( 'vc_cta', array(
	'type' 			=> 'dropdown',
	'heading' 		=> __( 'Style', 'mist' ),
	'param_name' 	=> 'style',
	'value' 		=> array(
		__( 'Default', 'mist' ) 	=> 'default',
		__( 'Classic', 'mist' ) 	=> 'classic',
		__( 'Flat', 'mist' ) 		=> 'flat',
		__( 'Outline', 'mist' ) 	=> 'outline',
		__( '3d', 'mist' ) 		=> '3d',
		__( 'Custom', 'mist' ) 	=> 'custom',
	),
	'std' 			=> 'default',
	'description' 	=> __( 'Select call to action display style.', 'mist' ),
) );

vc_add_param( 'vc_cta', array(
	"type" 			=> "dropdown",
	'heading' 		=> __( 'Style', 'mist' ),
	'description' 	=> __( 'Select button display style.', 'mist' ),
	'value' 		=> array(
		__( 'Default', 'mist' ) 			=> 'default',
		__( 'Transparent', 'mist' ) 		=> 'transparent',
		__( 'Modern', 'mist' ) 			=> 'modern',
		__( 'Classic', 'mist' ) 			=> 'classic',
		__( 'Flat', 'mist' ) 				=> 'flat',
		__( 'Outline', 'mist' ) 			=> 'outline',
		__( '3d', 'mist' ) 				=> '3d',
		__( 'Custom', 'mist' ) 			=> 'custom',
		__( 'Outline custom', 'mist' ) 	=> 'outline-custom',
	),
	'dependency' 			=> array(
		'element' 		=> 'add_button',
		'not_empty' 	=> true,
	),
	"integrated_shortcode" 			=> "vc_btn",
	"integrated_shortcode_field" 	=> "btn_",
	"param_name" 					=> "btn_style",
	"group"							=> __( 'Button', 'mist' ),
) );

vc_add_param( 'vc_cta', array(
	'type' 					=> 'dropdown',
	'heading' 				=> __( 'Color', 'mist' ),
	'param_name' 			=> 'btn_color',
	'description' 			=> __( 'Select button color.', 'mist' ),
	// compatible with btn2, need to be converted from btn1
	'param_holder_class' 	=> 'vc_colored-dropdown vc_btn3-colored-dropdown',
	'value' 				=> array(
				// Theme Colors
				__( 'Theme Color', 'mist' ) 		=> 'primary-bg',
			   // Btn1 Colors
			   __( 'Classic Grey', 'mist' ) 		=> 'default',
			   __( 'Classic Blue', 'mist' ) 		=> 'primary',
			   __( 'Classic Turquoise', 'mist' ) => 'info',
			   __( 'Classic Green', 'mist' ) 	=> 'success',
			   __( 'Classic Orange', 'mist' )	=> 'warning',
			   __( 'Classic Red', 'mist' ) 		=> 'danger',
			   __( 'Classic Black', 'mist' ) 	=> "inverse"
			   // + Btn2 Colors (default color set)
		   ) + vc_get_shared( 'colors-dashed' ),
	'std' 							=> 'primary-bg',
	"group"							=> __( 'Button', 'mist' ),
	"integrated_shortcode" 			=> "vc_btn",
	"integrated_shortcode_field" 	=> "btn_",
	// must have default color grey
	'dependency' 			=> array(
		'element' 				=> 'btn_style',
		'value_not_equal_to' 	=> array( 'custom', 'outline-custom' )
	),
) );

vc_add_param( 'vc_cta', array(
	"type" 			=> "dropdown",
	'heading' 		=> __( 'Icon color', 'mist' ),
	'description' 	=> __( 'Select icon color.', 'mist' ),
	'value' 		=> array_merge( vc_get_shared( 'colors' ), array( __( 'Theme Color', 'mist' ) => 'primary-bg' ), array( __( 'Custom color', 'mist' ) => 'custom' ) ),
	'dependency' 			=> array(
		'element' 		=> 'add_icon',
		'not_empty' 	=> true,
	),
	"integrated_shortcode" 			=> "vc_icon",
	"integrated_shortcode_field" 	=> "i_",
	"param_name" 					=> "i_color",
	'param_holder_class' 			=> 'vc_colored-dropdown',
	"group"							=> __( 'Icon', 'mist' ),
) );

vc_add_param( 'vc_cta', array(
	"type" 			=> "dropdown",
	'heading' 		=> __( 'Background color', 'mist' ),
	'description' 	=> __( 'Select background color for icon.', 'mist' ),
	'value' 		=> array_merge( vc_get_shared( 'colors' ), array( __( 'Theme Color', 'mist' ) => 'primary-bg' ), array( __( 'Custom color', 'mist' ) => 'custom' ) ),
	'dependency' 		=> array(
		'element' 		=> 'i_background_style',
		'not_empty' 	=> true,
	),
	"integrated_shortcode" 			=> "vc_icon",
	"integrated_shortcode_field" 	=> "i_",
	"param_name" 					=> "i_background_color",
	'param_holder_class' 			=> 'vc_colored-dropdown',
	"group"							=> __( 'Icon', 'mist' ),
) );

/* =========================================
*  Progress Bar
*  ========================================= */

vc_add_param( 'vc_progress_bar', array(
	'type' 			=> 'dropdown',
	'heading' 		=> __( 'Color', 'mist' ),
	'param_name' 	=> 'bgcolor',
	'value' 		=> array(
		__( 'Default', 'mist' ) 		=> 'bar_default',
		__( 'Default White', 'mist' ) => 'bar_default_white',
		__( 'Grey', 'mist' ) 			=> 'bar_grey',
		__( 'Blue', 'mist' ) 			=> 'bar_blue',
		__( 'Turquoise', 'mist' ) 	=> 'bar_turquoise',
		__( 'Green', 'mist' ) 		=> 'bar_green',
		__( 'Orange', 'mist' ) 		=> 'bar_orange',
		__( 'Red', 'mist' ) 			=> 'bar_red',
		__( 'Black', 'mist' ) 		=> 'bar_black',
		__( 'Custom Color', 'mist' ) 	=> 'custom'
	),
	'admin_label' 	=> true,
	'description' 	=> __( 'Select bar background color.', 'mist' ),
) );

vc_add_param( 'vc_progress_bar', array(
	'type' 			=> 'dropdown',
	'heading' 		=> __( 'Style', 'mist' ),
	'param_name' 	=> 'bar_style',
	'value' 		=> array(
		__( 'Default', 'mist' ) 		=> 'default',
		__( 'Tooltip', 'mist' ) 		=> 'tooltip',
	),
	'description' 	=> __( 'Select bar style.', 'mist' ),
) );

vc_add_param( 'vc_progress_bar', array(
	'type' 			=> 'textfield',
	'heading' 		=> __( 'Bar Height', 'mist' ),
	'param_name' 	=> 'bar_height',
	'description' 	=> __( 'Enter bar height. Ex: 20px', 'mist' )
) );

/* =========================================
*  Testimonial Categories
*  ========================================= */
if( ZOZO_TESTIMONIAL_ACTIVE ) {

	$testimonial_args = array(
		'orderby'                  => 'name',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'taxonomy'                 => 'testimonial_categories'
	);
	
	$testimonial_lists = get_categories( $testimonial_args );
	$testimonials_cats = array( 'Show all categories' => 'all' );
	
	foreach( $testimonial_lists as $cat ){
		$testimonials_cats[$cat->name] = $cat->slug;
	}
	
	vc_add_param( 'zozo_vc_testimonials_slider', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Testimonial Categories', 'mist' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $testimonials_cats		
	) );
	
	vc_add_param( 'zozo_vc_testimonials_grid', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Testimonial Categories', 'mist' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $testimonials_cats		
	) );
	
}

/* =========================================
*  Team Categories
*  ========================================= */
if( ZOZO_TEAM_ACTIVE ) {

	$team_args = array(
		'orderby'                  => 'name',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'taxonomy'                 => 'team_categories'
	);
	
	$team_lists = get_categories( $team_args );
	$team_cats = array( 'Show all categories' => 'all' );
	
	foreach( $team_lists as $cat ){
		$team_cats[$cat->name] = $cat->slug;
	}
	
	vc_add_param( 'zozo_vc_team_grid', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Team Categories', 'mist' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $team_cats		
	) );
	
	vc_add_param( 'zozo_vc_team_slider', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Team Categories', 'mist' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $team_cats		
	) );
	
	vc_add_param( 'zozo_vc_team_list', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Team Categories', 'mist' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $team_cats		
	) );
	
}

/* =========================================
*  Woocommerce Product Categories
*  ========================================= */
if( ZOZO_WOOCOMMERCE_ACTIVE ) {

	$woo_args = array(
		'orderby'                  => 'name',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'taxonomy'                 => 'product_cat'
	);
	
	$woo_lists = get_categories( $woo_args );
	$woo_cats = array( 'Show all categories' => 'all' );
	
	foreach( $woo_lists as $cat ){
		$woo_cats[$cat->name] = $cat->slug;
	}
	
	vc_add_param( 'zozo_vc_woo_product_slider', array(
		'type'			=> 'dropdown',
		'admin_label' 	=> true,
		'heading'		=> __( 'Choose Product Categories', 'mist' ),
		'param_name'	=> 'categories_id',
		'value' 		=> $woo_cats		
	) );
	
}
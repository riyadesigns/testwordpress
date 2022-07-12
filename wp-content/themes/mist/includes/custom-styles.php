<?php 
/* ======================================
 * Add theme custom styles 
 * ====================================== */

global $zozo_options, $post; 

$object_id = get_queried_object_id();
	
if( ( get_option('show_on_front') && get_option('page_for_posts') && is_home() ) || ( get_option('page_for_posts') && is_archive() && ! is_post_type_archive() ) 
&& ! ( is_tax('product_cat') || is_tax('product_tag' ) ) || ( get_option('page_for_posts') && is_search() ) ) {
	$post_id = get_option('page_for_posts');
} else {
	if( isset( $object_id ) ) {
		$post_id = $object_id;
	}
	
	if( ZOZO_WOOCOMMERCE_ACTIVE ) {
		if( is_shop() ) {
			$post_id = get_option('woocommerce_shop_page_id');
		}
		
		if ( ! is_singular() && ! is_shop() ) {
			$post_id = false;
		}
	} else {
		if( ! is_singular() ) {
			$post_id = false;
		}
	}
}
// Custom CSS
if( isset( $zozo_options['zozo_custom_css'] ) && $zozo_options['zozo_custom_css'] != '' ) {
	echo ''. $zozo_options['zozo_custom_css'];
}

// Body Background Stylings 
$body_bg_image = $body_bg_image_repeat = $body_bg_color = $body_bg_attachment = $body_bg_position = $body_bg_opacity = $body_bg_cover = '';
$body_bg_image 			= get_post_meta( $post_id, 'zozo_body_bg_image', true );
$body_bg_image_repeat 	= get_post_meta( $post_id, 'zozo_body_bg_repeat', true );
$body_bg_color 			= get_post_meta( $post_id, 'zozo_body_bg_color', true );
$body_bg_attachment 	= get_post_meta( $post_id, 'zozo_body_bg_attachment', true );
$body_bg_position 		= get_post_meta( $post_id, 'zozo_body_bg_position', true );
$body_bg_opacity 		= get_post_meta( $post_id, 'zozo_body_bg_opacity', true );
$body_bg_cover 			= get_post_meta( $post_id, 'zozo_body_bg_full', true );
if( $body_bg_cover ) {
	$body_bg_cover = "cover";
}

$theme_body_img = $theme_body_color = $theme_body_position = $theme_body_size = $theme_body_repeat = $theme_body_attachment = '';
if( isset( $zozo_options['zozo_body_bg_image'] ) ) {
	if( isset( $zozo_options['zozo_body_bg_image']['background-image'] ) && $zozo_options['zozo_body_bg_image']['background-image'] != '' ) {
		$theme_body_img = $zozo_options['zozo_body_bg_image']['background-image'];
	}	
	if( isset( $zozo_options['zozo_body_bg_image']['background-position'] ) && $zozo_options['zozo_body_bg_image']['background-position'] != '' ) {
		$theme_body_position = $zozo_options['zozo_body_bg_image']['background-position'];
	}
	if( isset( $zozo_options['zozo_body_bg_image']['background-size'] ) && $zozo_options['zozo_body_bg_image']['background-size'] != '' ) {
		$theme_body_size = $zozo_options['zozo_body_bg_image']['background-size'];
	}
	if( isset( $zozo_options['zozo_body_bg_image']['background-repeat'] ) && $zozo_options['zozo_body_bg_image']['background-repeat'] != '' ) {
		$theme_body_repeat = $zozo_options['zozo_body_bg_image']['background-repeat'];
	}
	if( isset( $zozo_options['zozo_body_bg_image']['background-attachment'] ) && $zozo_options['zozo_body_bg_image']['background-attachment'] != '' ) {
		$theme_body_attachment = $zozo_options['zozo_body_bg_image']['background-attachment'];
	}
}
if( isset( $zozo_options['zozo_body_bg_image']['background-color'] ) && $zozo_options['zozo_body_bg_image']['background-color'] != '' ) {
	$theme_body_color = $zozo_options['zozo_body_bg_image']['background-color'];
}

$body_bg_image 			= ! empty( $body_bg_image ) ? $body_bg_image : $theme_body_img;
$body_bg_color 			= ! empty( $body_bg_color ) ? $body_bg_color : $theme_body_color;
$body_bg_image_repeat 	= ! empty( $body_bg_image_repeat ) ? $body_bg_image_repeat : $theme_body_repeat;
$body_bg_attachment 	= ! empty( $body_bg_attachment ) ? $body_bg_attachment : $theme_body_attachment;
$body_bg_position 		= ! empty( $body_bg_position ) ? $body_bg_position : $theme_body_position;
$body_bg_cover 			= ! empty( $body_bg_cover ) ? $body_bg_cover : $theme_body_size;

if( isset( $body_bg_opacity ) && $body_bg_opacity != 0 ) {
	$body_rgb_color = '';
	$body_rgb_color = zozo_hex2rgb( $body_bg_color );
}

$body_styles = '';

if( isset( $body_bg_image ) && $body_bg_image != '' ) {
	$body_styles .= 'background-image: url('. $body_bg_image .');';
	if( isset( $body_bg_image_repeat ) && $body_bg_image_repeat != '' ) {
		$body_styles .= 'background-repeat: '. $body_bg_image_repeat .';';
	}
	if( isset( $body_bg_attachment ) && $body_bg_attachment != '' ) {
		$body_styles .= 'background-attachment: '. $body_bg_attachment .';';
	}
	if( isset( $body_bg_position ) && $body_bg_position != '' ) {
		$body_styles .= 'background-position: '. $body_bg_position .';';
	}
	if( isset( $body_bg_cover ) && $body_bg_cover != '' ) {
		$body_styles .= 'background-size: '. $body_bg_cover .';';
		$body_styles .= '-moz-background-size: '. $body_bg_cover .';';
		$body_styles .= '-webkit-background-size: '. $body_bg_cover .';';
		$body_styles .= '-o-background-size: '. $body_bg_cover .';';
		$body_styles .= '-ms-background-size: '. $body_bg_cover .';';
	}
}
if( isset( $body_bg_color ) && $body_bg_color != '' ) {
	if( isset( $body_bg_opacity ) && $body_bg_opacity != 0 ) {
		$body_styles .= 'background-color: rgba(' . $body_rgb_color[0] . ',' . $body_rgb_color[1] . ',' . $body_rgb_color[2] . ', ' . $body_bg_opacity . ');';
	} else {
		$body_styles .= 'background-color: '. $body_bg_color .';';
	}
}

if( $body_styles ) {
	echo 'body { '. $body_styles . ' }' . "\n";
}

// Header Stylings
$header_styles = '';

$header_bg_image = $header_bg_image_repeat = $header_bg_color = $header_bg_attachment = $header_bg_position = $header_bg_opacity = $header_bg_cover = '';
$header_bg_image 		= get_post_meta( $post_id, 'zozo_header_bg_image', true );
$header_bg_image_repeat = get_post_meta( $post_id, 'zozo_header_bg_repeat', true );
$header_bg_color 		= get_post_meta( $post_id, 'zozo_header_bg_color', true );
$header_bg_attachment 	= get_post_meta( $post_id, 'zozo_header_bg_attachment', true );
$header_bg_position 	= get_post_meta( $post_id, 'zozo_header_bg_postion', true );
$header_bg_opacity 		= get_post_meta( $post_id, 'zozo_header_bg_opacity', true );
$header_bg_cover 		= get_post_meta( $post_id, 'zozo_body_bg_full', true );
if( $header_bg_cover ) {
	$header_bg_cover = "cover";
}

$theme_header_bg_image = $theme_header_bg_image_repeat = $theme_header_bg_color = $theme_header_bg_attachment = $theme_header_bg_position = $theme_header_bg_cover = '';
if( isset( $zozo_options['zozo_header_bg_image'] ) ) {
	if( isset( $zozo_options['zozo_header_bg_image']['background-image'] ) && $zozo_options['zozo_header_bg_image']['background-image'] != '' ) {
		$theme_header_bg_image = $zozo_options['zozo_header_bg_image']['background-image'];
	}
	if( isset( $zozo_options['zozo_header_bg_image']['background-repeat'] ) && $zozo_options['zozo_header_bg_image']['background-repeat'] != '' ) {
		$theme_header_bg_image_repeat = $zozo_options['zozo_header_bg_image']['background-repeat'];
	}
	if( isset( $zozo_options['zozo_header_bg_image']['background-attachment'] ) && $zozo_options['zozo_header_bg_image']['background-attachment'] != '' ) {
		$theme_header_bg_attachment = $zozo_options['zozo_header_bg_image']['background-attachment'];
	}
	if( isset( $zozo_options['zozo_header_bg_image']['background-position'] ) && $zozo_options['zozo_header_bg_image']['background-position'] != '' ) {
		$theme_header_bg_position = $zozo_options['zozo_header_bg_image']['background-position'];
	}
	if( isset( $zozo_options['zozo_header_bg_image']['background-size'] ) && $zozo_options['zozo_header_bg_image']['background-size'] != '' ) {
		$theme_header_bg_cover = $zozo_options['zozo_header_bg_image']['background-size'];
	}
}
if( isset( $zozo_options['zozo_header_bg_image']['background-color'] ) && $zozo_options['zozo_header_bg_image']['background-color'] != '' ) {
	$theme_header_bg_color = $zozo_options['zozo_header_bg_image']['background-color'];
}
$header_bg_image = ! empty( $header_bg_image ) ? $header_bg_image : $theme_header_bg_image;
$header_bg_color = ! empty( $header_bg_color ) ? $header_bg_color : $theme_header_bg_color;
$header_bg_image_repeat = ! empty( $header_bg_image_repeat ) ? $header_bg_image_repeat : $theme_header_bg_image_repeat;
$header_bg_attachment = ! empty( $header_bg_attachment ) ? $header_bg_attachment : $theme_header_bg_attachment;
$header_bg_position = ! empty( $header_bg_position ) ? $header_bg_position : $theme_header_bg_position;
$header_bg_cover = ! empty( $header_bg_cover ) ? $header_bg_cover : $theme_header_bg_cover;

if( isset( $header_bg_opacity ) && $header_bg_opacity != 0 ) {
	$header_rgb_color = '';
	$header_rgb_color = zozo_hex2rgb( $header_bg_color );
}

if( isset( $header_bg_image ) && $header_bg_image != '' ) {
	$header_styles .= 'background-image: url('. $header_bg_image .');';
	if( isset( $header_bg_image_repeat ) && $header_bg_image_repeat != '' ) {
		$header_styles .= 'background-repeat: '. $header_bg_image_repeat .';';
	}
	if( isset( $header_bg_attachment ) && $header_bg_attachment != '' ) {
		$header_styles .= 'background-attachment: '. $header_bg_attachment .';';
	}
	if( isset( $header_bg_position ) && $header_bg_position != '' ) {
		$header_styles .= 'background-position: '. $header_bg_position .';';
	}
	if( isset( $header_bg_cover ) && $header_bg_cover != '' ) {
		$header_styles .= 'background-size: '. $header_bg_cover .';';
		$header_styles .= '-moz-background-size: '. $header_bg_cover .';';
		$header_styles .= '-webkit-background-size: '. $header_bg_cover .';';
		$header_styles .= '-o-background-size: '. $header_bg_cover .';';
		$header_styles .= '-ms-background-size: '. $header_bg_cover .';';
	}
}
if( isset( $header_bg_color ) && $header_bg_color != '' ) {
	if( isset( $header_bg_opacity ) && $header_bg_opacity != 0 ) {
		$header_styles .= 'background-color: rgba(' . $header_rgb_color[0] . ',' . $header_rgb_color[1] . ',' . $header_rgb_color[2] . ', ' . $header_bg_opacity . ');';
	} else {
		$header_styles .= 'background-color: '. $header_bg_color .';';
	}
}
if( $header_styles ) {
	echo '#zozo_wrapper #header { '. $header_styles . ' }' . "\n";
}

// Page Background Stylings
$page_bg_styles = '';

$page_bg_image = $page_bg_image_repeat = $page_bg_color = $page_bg_attachment = $page_bg_position = $page_bg_opacity = $page_bg_cover = '';
$page_bg_image 			= get_post_meta( $post_id, 'zozo_page_bg_image', true );
$page_bg_image_repeat 	= get_post_meta( $post_id, 'zozo_page_bg_repeat', true );
$page_bg_color 			= get_post_meta( $post_id, 'zozo_page_bg_color', true );
$page_bg_attachment 	= get_post_meta( $post_id, 'zozo_page_bg_attachment', true );
$page_bg_position 		= get_post_meta( $post_id, 'zozo_page_bg_position', true );
$page_bg_opacity 		= get_post_meta( $post_id, 'zozo_page_bg_opacity', true );
$page_bg_cover 			= get_post_meta( $post_id, 'zozo_page_bg_full', true );
if( $page_bg_cover ) {
	$page_bg_cover = "cover";
}

$theme_page_bg_image = $theme_page_bg_image_repeat = $theme_page_bg_color = $theme_page_bg_attachment = $theme_page_bg_position = $theme_page_bg_cover = '';
if( isset( $zozo_options['zozo_page_bg_image'] ) ) {
	if( isset( $zozo_options['zozo_page_bg_image']['background-image'] ) && $zozo_options['zozo_page_bg_image']['background-image'] != '' ) {
		$theme_page_bg_image = $zozo_options['zozo_page_bg_image']['background-image'];
	}
	if( isset( $zozo_options['zozo_page_bg_image']['background-repeat'] ) && $zozo_options['zozo_page_bg_image']['background-repeat'] != '' ) {
		$theme_page_bg_image_repeat = $zozo_options['zozo_page_bg_image']['background-repeat'];
	}
	if( isset( $zozo_options['zozo_page_bg_image']['background-attachment'] ) && $zozo_options['zozo_page_bg_image']['background-attachment'] != '' ) {
		$theme_page_bg_attachment = $zozo_options['zozo_page_bg_image']['background-attachment'];
	}
	if( isset( $zozo_options['zozo_page_bg_image']['background-position'] ) && $zozo_options['zozo_page_bg_image']['background-position'] != '' ) {
		$theme_page_bg_position = $zozo_options['zozo_page_bg_image']['background-position'];
	}
	if( isset( $zozo_options['zozo_page_bg_image']['background-size'] ) && $zozo_options['zozo_page_bg_image']['background-size'] != '' ) {
		$theme_page_bg_cover = $zozo_options['zozo_page_bg_image']['background-size'];
	}
}
if( isset( $zozo_options['zozo_page_bg_image']['background-color'] ) && $zozo_options['zozo_page_bg_image']['background-color'] != '' ) {
	$theme_page_bg_color = $zozo_options['zozo_page_bg_image']['background-color'];
}
$page_bg_image = ! empty( $page_bg_image ) ? $page_bg_image : $theme_page_bg_image;
$page_bg_color = ! empty( $page_bg_color ) ? $page_bg_color : $theme_page_bg_color;
$page_bg_image_repeat = ! empty( $page_bg_image_repeat ) ? $page_bg_image_repeat : $theme_page_bg_image_repeat;
$page_bg_attachment = ! empty( $page_bg_attachment ) ? $page_bg_attachment : $theme_page_bg_attachment;
$page_bg_position = ! empty( $page_bg_position ) ? $page_bg_position : $theme_page_bg_position;
$page_bg_cover = ! empty( $page_bg_cover ) ? $page_bg_cover : $theme_page_bg_cover;

if( isset( $page_bg_opacity ) && $page_bg_opacity != 0 ) {
	$page_rgb_color = '';
	$page_rgb_color = zozo_hex2rgb( $page_bg_color );
}

if( isset( $page_bg_image ) && $page_bg_image != '' ) {
	$page_bg_styles .= 'background-image: url('. $page_bg_image .');';
	if( isset( $page_bg_image_repeat ) && $page_bg_image_repeat != '' ) {
		$page_bg_styles .= 'background-repeat: '. $page_bg_image_repeat .';';
	}
	if( isset( $page_bg_attachment ) && $page_bg_attachment != '' ) {
		$page_bg_styles .= 'background-attachment: '. $page_bg_attachment .';';
	}
	if( isset( $page_bg_position ) && $page_bg_position != '' ) {
		$page_bg_styles .= 'background-position: '. $page_bg_position .';';
	}
	if( isset( $page_bg_cover ) && $page_bg_cover != '' ) {
		$page_bg_styles .= 'background-size: '. $page_bg_cover .';';
		$page_bg_styles .= '-moz-background-size: '. $page_bg_cover .';';
		$page_bg_styles .= '-webkit-background-size: '. $page_bg_cover .';';
		$page_bg_styles .= '-o-background-size: '. $page_bg_cover .';';
		$page_bg_styles .= '-ms-background-size: '. $page_bg_cover .';';
	}
}

if( isset( $page_bg_color ) && $page_bg_color != '' ) {
	if( isset( $page_bg_opacity ) && $page_bg_opacity != 0 ) {
		$page_bg_styles .= 'background-color: rgba(' . $page_rgb_color[0] . ',' . $page_rgb_color[1] . ',' . $page_rgb_color[2] . ', ' . $page_bg_opacity . ');';
	} else {
		$page_bg_styles .= 'background-color: '. $page_bg_color .';';
	}
}

if( $page_bg_styles ) {
	echo '#main { '. $page_bg_styles .' }' . "\n";
}

// Page Title Bar Styles
$page_title_border = $page_title_bg = $page_title_bg_color = $page_title_bar_bg_position = $page_title_bar_bg_repeat = $page_title_bg_full = $page_title_bg_parallax = $page_title_height = $page_title_mobile_height = '';
$page_title_styles = $page_title_outer_styles = '';

$page_title_border 				= get_post_meta( $post_id, 'zozo_page_title_bar_border_color', true );
$page_title_bg 					= get_post_meta( $post_id, 'zozo_page_title_bar_bg', true );
$page_title_bg_color 			= get_post_meta( $post_id, 'zozo_page_title_bar_bg_color', true );
$page_title_bar_bg_position 	= get_post_meta( $post_id, 'zozo_page_title_bar_bg_position', true );
$page_title_bg_full 			= get_post_meta( $post_id, 'zozo_page_title_bar_bg_full', true );
$page_title_bar_bg_repeat 		= get_post_meta( $post_id, 'zozo_page_title_bar_bg_repeat', true );
$page_title_bg_parallax 		= get_post_meta( $post_id, 'zozo_page_title_bar_bg_parallax', true );
$page_title_height 				= get_post_meta( $post_id, 'zozo_page_title_height', true );
$page_title_mobile_height 		= get_post_meta( $post_id, 'zozo_page_title_mobile_height', true );
$page_title_color 				= get_post_meta( $post_id, 'zozo_page_title_bar_title_color', true );
$page_slogan_color 				= get_post_meta( $post_id, 'zozo_page_title_bar_slogan_color', true );
$page_breadcrumbs_color 		= get_post_meta( $post_id, 'zozo_page_breadcrumbs_color', true );

$parallax_styles = '';

if( isset( $page_title_bg ) && $page_title_bg != '' ) {

	if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'no' ) {
		$page_title_styles .= 'background-image: url('. $page_title_bg .');';
	}
	
	if( isset( $page_title_bar_bg_repeat ) && $page_title_bar_bg_repeat != '' ) {
		if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'yes' ) {
			$parallax_styles .= 'background-repeat: '. $page_title_bar_bg_repeat .';';
		} else {
			$page_title_styles .= 'background-repeat: '. $page_title_bar_bg_repeat .';';
		}
	}
	
	if( isset( $page_title_bar_bg_position ) && $page_title_bar_bg_position != '' ) {
		if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'yes' ) {
			$parallax_styles .= 'background-position: '. $page_title_bar_bg_position .';';
		} else {
			$page_title_styles .= 'background-position: '. $page_title_bar_bg_position .';';
		}
	}
	
	if( isset( $page_title_bg_full ) && $page_title_bg_full ) {
		if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'yes' ) {
			$parallax_styles .= 'background-size: cover;';
			$parallax_styles .= '-moz-background-size: cover;';
			$parallax_styles .= '-webkit-background-size: cover;';
			$parallax_styles .= '-o-background-size: cover;';
			$parallax_styles .= '-ms-background-size: cover;';
		} else {
			$page_title_styles .= 'background-size: cover;';
			$page_title_styles .= '-moz-background-size: cover;';
			$page_title_styles .= '-webkit-background-size: cover;';
			$page_title_styles .= '-o-background-size: cover;';
			$page_title_styles .= '-ms-background-size: cover;';
		}
	}
}
if( isset( $page_title_bg_color ) && $page_title_bg_color != '' ) {
	$page_title_styles .= 'background-color: '. $page_title_bg_color .';';
}
if( isset( $page_title_border ) && $page_title_border != '' ) {
	$page_title_styles .= 'border-color: '. $page_title_border .';';
}
if( isset( $page_title_height ) && $page_title_height != '' ) {
	$page_title_outer_styles .= 'height: '. $page_title_height .';';
}

if( isset( $page_title_styles ) && $page_title_styles != '' ) {
	echo '.page-title-section { '. $page_title_styles . ' }' . "\n";
}

if( isset( $page_title_bg_parallax ) && $page_title_bg_parallax == 'yes' ) {
	if( isset( $parallax_styles ) && $parallax_styles != '' ) {
		echo '.page-title-section.zozo-parallax .zozo_parallax-inner { '. $parallax_styles . ' }' . "\n";
	}
}

if( isset( $page_title_outer_styles ) && $page_title_outer_styles != '' ) {
	echo '.page-title-section .page-title-wrapper-outer { '. $page_title_outer_styles . ' }' . "\n";
}

if( isset( $page_title_color ) && $page_title_color != '' ) {
	echo '.page-title-section .page-title-captions h1 { color: '. $page_title_color . '; }' . "\n";
}

if( isset( $page_slogan_color ) && $page_slogan_color != '' ) {
	echo '.page-title-section .page-title-captions .page-entry-slogan { color: '. $page_slogan_color . '; }' . "\n";
}

if( isset( $page_breadcrumbs_color ) && $page_breadcrumbs_color != '' ) {
	echo '.page-title-section .zozo-breadcrumbs > span { color: '. $page_breadcrumbs_color . '; }' . "\n";
}

if( isset( $page_title_mobile_height ) && $page_title_mobile_height != '' ) {
	$page_title_mobile_styles .= 'height: '. $page_title_mobile_height .';';
}

if( isset( $page_title_mobile_styles ) && $page_title_mobile_styles != '' ) {
	echo '@media only screen and (max-width: 767px) { .page-title-section .page-title-wrapper-outer { '. $page_title_mobile_styles . ' } }' . "\n";
}

// Side Header Width
$header_type 			= get_post_meta( $post_id, 'zozo_header_type', true );
$header_toggle_position = get_post_meta( $post_id, 'zozo_header_toggle_position', true );
if( isset( $header_type ) && $header_type == '' || $header_type == 'default' ) {
	$header_type = $zozo_options['zozo_header_type'];
}
if( isset( $header_toggle_position ) && $header_toggle_position == '' || $header_toggle_position == 'default' ) {
	$header_toggle_position = $zozo_options['zozo_header_toggle_position'];
}

if( isset( $zozo_options['zozo_header_side_width'] ) && $zozo_options['zozo_header_side_width'] != '' && $header_type == 'header-10' ) {
	echo '.header-sidenav-section { width: '. $zozo_options['zozo_header_side_width'] . '; }' . "\n";
	
	if( isset( $header_toggle_position ) && $header_toggle_position == 'left' ) {
		echo '#zozo_wrapper { margin-left: '. $zozo_options['zozo_header_side_width'] . '; width: auto; }' . "\n";
	}
	
	if( isset( $header_toggle_position ) && $header_toggle_position == 'right' ) {
		echo '#zozo_wrapper { margin-right: '. $zozo_options['zozo_header_side_width'] . '; width: auto; }' . "\n";
	}
}

// Page Content Padding
$page_top_padding = $page_bottom_padding = '';

$page_top_padding 				= get_post_meta( $post_id, 'zozo_page_top_padding', true );
$page_bottom_padding 			= get_post_meta( $post_id, 'zozo_page_bottom_padding', true );

if( ( isset( $page_top_padding ) && $page_top_padding != '' ) || ( isset( $page_bottom_padding ) && $page_bottom_padding != '' ) ) {
	echo '#main-wrapper #content { ';
	
	if( isset( $page_top_padding ) && $page_top_padding != '' ) {
		echo 'padding-top: '. $page_top_padding . ';';
	}
	if( isset( $page_bottom_padding ) && $page_bottom_padding != '' ) {
		echo ' padding-bottom: '. $page_bottom_padding . ';';
	}
	
	echo ' }' . "\n";
}
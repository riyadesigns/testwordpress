<?php
/**
 * Visual Composer Functions
 *
 * @package     Mist
 * @subpackage  Includes/Visual Composer
 * @author      Zozothemes
 */

// Retun if the Visual Composer plugin isn't active
if ( ! ZOZO_VC_ACTIVE ) {
    return;
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( function_exists('vc_set_as_theme') ){
	function zozo_vcSetAsTheme() {
		vc_set_as_theme( true );
	}
	add_action( 'vc_before_init', 'zozo_vcSetAsTheme' );
}

// Admin Init
add_action( 'init', 'zozo_vc_extend_params_init', 10 );

function zozo_vc_extend_params_init() {

	// Add Params
	if ( function_exists( 'vc_add_param' ) ) {
		require_once( ZOZOINCLUDES . 'visual-composer/vc-params.php' );
	}
	
}

add_action( 'vc_after_init', 'zozo_add_new_color_options' );

function zozo_add_new_color_options() {
  //Get current values stored in the param
  $param = WPBMap::getParam( 'vc_masonry_grid', 'button_color' );
  //Append new value to the 'value' array
  //$param['value'][__( 'Theme Color', 'mist' )] = 'primary-bg';
  //Finally "mutate" param with new values
  vc_update_shortcode_param( 'vc_masonry_grid', $param );
}

// Get VC CSS Animation
function zozo_vc_animation( $css_animation ) {
	$output = '';
	if ( $css_animation != '' ) {
		wp_enqueue_script( 'vc_waypoints' );   //waypoints
		$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
	}

	return $output;
}

// Include all custom shortcodes for VC
require_once( ZOZOINCLUDES . 'visual-composer/vc-init.php' );

// Default Layouts
require_once( ZOZOINCLUDES . 'visual-composer/vc-layouts.php' );

/**
 * Simple Line Icons
 *
 * @param $icons - taken from filter 
 * 
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
if( ! function_exists('zozo_vc_custom_simplelineicons') ) {
	function zozo_vc_custom_simplelineicons( $icons ) {
	
		$pattern = '/\.(icon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$simpleline_icons_path = ZOZO_ADMIN_ASSETS . 'css/simple-line-icons.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($simpleline_icons_path) );
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$all_line_icons = array();
		$all_new_line_icons = array();
		
		foreach($matches as $match){
			$all_line_icons['simple-icon ' . $match[1]] = $match[1];
		}
		
		foreach($all_line_icons as $key => $value ){
			$all_new_line_icons[] = array( $key => $value );
		}
	
		return array_merge( $icons, $all_new_line_icons );
		
	}
}

add_filter( 'vc_iconpicker-type-simplelineicons', 'zozo_vc_custom_simplelineicons', 10, 1 );

/**
 * Flaticons
 *
 * @param $icons - taken from filter 
 * 
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
if( ! function_exists('zozo_vc_custom_flaticons') ) {
	function zozo_vc_custom_flaticons( $icons ) {
	
		$pattern = '/\.(flaticon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$flaticons_path = ZOZO_ADMIN_ASSETS . 'css/flaticon.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($flaticons_path) );
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$all_flat_icons = array();
		$all_new_flat_icons = array();
		
		foreach($matches as $match){
			$all_flat_icons['flaticon ' . $match[1]] = $match[1];
		}
		
		foreach($all_flat_icons as $key => $value ){
			$all_new_flat_icons[] = array( $key => $value );
		}
	
		return array_merge( $icons, $all_new_flat_icons );
	}
}

add_filter( 'vc_iconpicker-type-flaticons', 'zozo_vc_custom_flaticons', 10, 1 );

/**
 * Icomoon Pack1 Icons
 *
 * @param $icons - taken from filter 
 * 
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
if( ! function_exists('zozo_vc_custom_icomoonpack1icons') ) {
	function zozo_vc_custom_icomoonpack1icons( $icons ) {
	
		$pattern = '/\.(icomoon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$icomoon_path = ZOZO_ADMIN_ASSETS . 'css/icomoon-1.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($icomoon_path) );
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$icomoon_icons = array();
		$all_icomoon_icons = array();
		
		foreach($matches as $match){
			$icomoon_icons['icomoon1 ' . $match[1]] = $match[1];
		}
		
		foreach($icomoon_icons as $key => $value ){
			$all_icomoon_icons[] = array( $key => $value );
		}
			
		return array_merge( $icons, $all_icomoon_icons );
	}
}

add_filter( 'vc_iconpicker-type-icomoonpack1', 'zozo_vc_custom_icomoonpack1icons', 10, 1 );

/**
 * Icomoon Pack2 Icons
 *
 * @param $icons - taken from filter 
 * 
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
if( ! function_exists('zozo_vc_custom_icomoonpack2icons') ) {
	function zozo_vc_custom_icomoonpack2icons( $icons ) {
	
		$pattern = '/\.(icomoon2-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$icomoon_path = ZOZO_ADMIN_ASSETS . 'css/icomoon-2.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($icomoon_path) );
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$icomoon_icons = array();
		$all_icomoon_icons = array();
		
		foreach($matches as $match){
			$icomoon_icons['icomoon2 ' . $match[1]] = $match[1];
		}
		
		foreach($icomoon_icons as $key => $value ){
			$all_icomoon_icons[] = array( $key => $value );
		}
			
		return array_merge( $icons, $all_icomoon_icons );
	}
}

add_filter( 'vc_iconpicker-type-icomoonpack2', 'zozo_vc_custom_icomoonpack2icons', 10, 1 );

/**
 * Icomoon Pack3 Icons
 *
 * @param $icons - taken from filter 
 * 
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
if( ! function_exists('zozo_vc_custom_icomoonpack3icons') ) {
	function zozo_vc_custom_icomoonpack3icons( $icons ) {
	
		$pattern = '/\.(icomoon3-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$icomoon_path = ZOZO_ADMIN_ASSETS . 'css/icomoon-3.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($icomoon_path) );
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$icomoon_icons = array();
		$all_icomoon_icons = array();
		
		foreach($matches as $match){
			$icomoon_icons['icomoon3 ' . $match[1]] = $match[1];
		}
		
		foreach($icomoon_icons as $key => $value ){
			$all_icomoon_icons[] = array( $key => $value );
		}
			
		return array_merge( $icons, $all_icomoon_icons );
	}
}

add_filter( 'vc_iconpicker-type-icomoonpack3', 'zozo_vc_custom_icomoonpack3icons', 10, 1 );

/**
 * Image hover Styles
 */
if ( ! function_exists( 'zozo_vc_image_hovers' ) ) {
	function zozo_vc_image_hovers() {
		$hovers = array (
			__( 'None', 'mist' )				=> '',
			__( 'Fade Out', 'mist' )			=> 'fade-out',
			__( 'Fade In', 'mist' )			=> 'fade-in',
			__( 'Grow', 'mist' )				=> 'grow',
			__( 'Grow & Rotate', 'mist' )		=> 'grow-rotate',
			__( 'Sepia', 'mist' )				=> 'sepia',
			__( 'Normal - Blurr', 'mist' )	=> 'blurr',
			__( 'Blurr - Normal', 'mist' )	=> 'blurr-invert',
			
		);
		return apply_filters( 'zozo_vc_image_hovers', $hovers );
	}
}

/**
 * Image filter Styles
 */
if ( ! function_exists( 'zozo_vc_image_filters' ) ) {
	function zozo_vc_image_filters() {
		$filters = array (
			__( 'None', 'mist' )		=> '',
			__( 'Grayscale', 'mist' )	=> 'grayscale',
		);
		return apply_filters( 'zozo_vc_image_filters', $filters );
	}
}
<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $el_id = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_inner',
	'vc_column_container',
	$width,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

// Custom Typography
if( isset( $typo_style ) && $typo_style != '' ) {
	$css_classes[] = ' typo-' . $typo_style;
}

// Custom Background Style
if( isset( $bg_style ) && $bg_style != '' ) {
	$css_classes[] = ' bg-style ' . $bg_style;
}
if( isset( $bg_style ) && ( $bg_style == 'dark-wrapper' || $bg_style == 'dark-grey-wrapper' ) ) {
	$css_classes[] = ' bg-skin-dark';
}

// Animation
if( isset( $css_animation ) && $css_animation != '' ) {
	$css_classes[] = $this->getCSSAnimation( $css_animation );
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
echo '<div ' . implode( ' ', $wrapper_attributes ) . '>';
echo '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
echo '<div class="wpb_wrapper">';
echo wpb_js_remove_wpautop( $content );
echo '</div>';
echo '</div>';
echo '</div>';
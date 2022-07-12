<?php

global $zozo_options;

// Body Stylings 

echo '.editor-block-list__layout .editor-block-list__block,
.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block p,
.block-editor__container .editor-styles-wrapper .mce-content-body {';
	echo zozo_get_font_css_out( 'zozo_body_font' );
echo '
}';

echo '.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block h1 {';
	echo zozo_get_font_css_out( 'zozo_h1_font_styles' );
echo '
}';
echo '.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block h2 {';
	echo zozo_get_font_css_out( 'zozo_h2_font_styles' );
echo '
}';
echo '.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block h3 {';
	echo zozo_get_font_css_out( 'zozo_h3_font_styles' );
echo '
}';
echo '.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block h4 {';
	echo zozo_get_font_css_out( 'zozo_h4_font_styles' );
echo '
}';
echo '.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block h5 {';
	echo zozo_get_font_css_out( 'zozo_h5_font_styles' );
echo '
}';
echo '.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block h6 {';
	echo zozo_get_font_css_out( 'zozo_h6_font_styles' );
echo '
}';

$custom_color = $zozo_options['zozo_custom_scheme_color'];
$container_width = $zozo_options['zozo_fullwidth_site_width'];

echo '.editor-styles-wrapper .wp-block, .editor-styles-wrapper .editor-block-list__block.wp-block[data-align=wide], .wp-block[data-align="wide"] {
	width: '. esc_attr( $container_width ) .'; max-width: 100%;
}';

echo '.editor-styles-wrapper .wp-block:not([data-align="full"]) {
	width: '. esc_attr( $container_width ) .'; max-width: 100%;
}';

$editor_css = '
/*
 * Set colors for:
 * - links
 * - blockquote
 * - pullquote (solid color)
 * - buttons
 */
.editor-block-list__layout .editor-block-list__block a,
.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:hover .wp-block-button__link:not(.has-text-color),
.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:focus .wp-block-button__link:not(.has-text-color),
.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:active .wp-block-button__link:not(.has-text-color),
.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink {
	color: ' . $custom_color . '; /* base: #0073a8; */
}

.wp-block-quote[style*="text-align:right"], .wp-block-quote[style*="text-align: right"] {
	border-right: 3px solid ' . $custom_color . '; /* base: #0073a8; */
}
.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color) {
	background-color: ' . $custom_color . '; /* base: #0073a8; */
}

.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__button,
.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link,
.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:active,
.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:focus,
.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover {
	background-color: ' . $custom_color . '; /* base: #0073a8; */
}

/* Hover colors */
.editor-block-list__layout .editor-block-list__block a:hover,
.editor-block-list__layout .editor-block-list__block a:active,
.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink:hover {
	color: ' . $custom_color . '; /* base: #005177; */
}

/* Do not overwrite solid color pullquote or cover links */
.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color a,
.editor-block-list__layout .editor-block-list__block .wp-block-cover a {
	color: inherit;
}
.wp-block-pullquote blockquote,
.editor-styles-wrapper .editor-block-list__layout blockquote.wp-block-quote.is-style-large p {
	border-left: solid ' . $custom_color . ' 3px;
}
.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block .wp-block-quote p,
.editor-styles-wrapper .editor-block-list__layout .editor-block-list__block blockquote p {
	font-family: georgia;
	font-style: italic;
	font-size: 20px;
	color: #7f7f7f;
}';

if ( function_exists( 'register_block_type' ) && is_admin() ) {
	echo ''. $editor_css;
}

function zozo_get_font_css_out($font_field){
	global $zozo_options;
	$body_font_styles = '';
	if ( $zozo_options[$font_field] ) {
		$body_font_styles .= 'font-family: '.$zozo_options[$font_field]['font-family'].';';
		$body_font_styles .= 'font-size: '.$zozo_options[$font_field]['font-size'].';';
		if( isset( $zozo_options[$font_field]['font-style'] ) && $zozo_options[$font_field]['font-style'] != '' ) {
			$body_font_styles .= 'font-style: '.$zozo_options[$font_field]['font-style'].';';
		}
		if( isset( $zozo_options[$font_field]['font-weight'] ) && $zozo_options[$font_field]['font-weight'] != '' ) {
			$body_font_styles .= 'font-weight: '.$zozo_options[$font_field]['font-weight'].';';
		}
		$body_font_styles .= 'color: '.$zozo_options[$font_field]['color'].';';
		$body_font_styles .= 'line-height: '.$zozo_options[$font_field]['line-height'].';';
	}
	return $body_font_styles;
}
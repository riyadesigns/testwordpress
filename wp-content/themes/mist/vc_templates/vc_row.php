<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $min_height
 * @var $bg_style
 * @var $bg_side_skin
 * @var $bg_side_size
 * @var $match_height
 * @var $center_row
 * @var $bg_overlay
 * @var $bg_overlay_style
 * @var $typo_style
 * @var $enable_video_bg
 * @var $video_id
 * @var $video_autoplay
 * @var $video_mute
 * @var $video_fallback
 * @var $video_controls
 * @var $video_height
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $atts['rtl_reverse'] ) ) {
	$css_classes[] = 'vc_rtl-columns-reverse';
}

$wrapper_attributes = array();
$side_image_attributes = array();
$side_css_classes = array();

// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}
/*if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}*/

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	
	if( 'image-left' == $bg_style || 'image-right' == $bg_style ) {
		$side_image_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
		$side_css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;		
	} else {
		$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
		$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	}
	
	if ( false !== strpos( $parallax, 'fade' ) ) {
		if( 'image-left' == $bg_style || 'image-right' == $bg_style ) {
			$side_image_attributes[] = 'data-vc-parallax-o-fade="on"';
			$side_css_classes[] = 'js-vc_parallax-o-fade';
		} else {
			$css_classes[] = 'js-vc_parallax-o-fade';
			$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
		}
		
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		if( 'image-left' == $bg_style || 'image-right' == $bg_style ) {
			$side_css_classes[] = 'js-vc_parallax-o-fixed';
		} else {
			$css_classes[] = 'js-vc_parallax-o-fixed';
		}
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
	$side_image_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}

// Section Class
if( $this->settings( 'base' ) === 'vc_row_inner' ) {
	$css_classes[] = ' vc-zozo-section-inner';
} else {
	$css_classes[] = ' vc-zozo-section';
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

$side_wrapper_skin = '';
if( isset( $bg_side_skin ) && $bg_side_skin != '' ) {
	$side_wrapper_skin = ' ' . $bg_side_skin;
}
if( isset( $bg_side_skin ) && ( $bg_side_skin == 'dark-wrapper' || $bg_side_skin == 'dark-grey-wrapper' ) ) {
	$side_wrapper_skin .= ' bg-skin-dark';
}
// Custom Background Overlay Style
if( isset( $bg_overlay ) && $bg_overlay == 'yes' ) {
	if( isset( $bg_overlay_style ) && $bg_overlay_style != '' ) {
		$css_classes[] = ' bg-' . $bg_overlay_style;
	}
}
// Match Height
$extra_height_class = '';
if( isset( $match_height ) && $match_height == 'yes' ) {
	$extra_height_class = " vc-match-height-row";
}

// Minimum Height
$inner_row_style = '';
if( isset( $min_height ) && $min_height != '' ) {	
	$inner_row_style .= ' style="min-height:'. $min_height .'px;"';
}

if( isset( $video_id ) && $video_id != '' ) {
	$css_classes[] = " zozo-vc-video-bg-wrapper";
}

$video_fallback_src = '';
if ( isset( $video_fallback ) ) {
	$video_fallback_id = preg_replace( '/[^\d]/', '', $video_fallback );
	$video_fallback_src = wp_get_attachment_image_src( $video_fallback_id, 'full' );
	if ( ! empty( $video_fallback_src[0] ) ) {
		$video_fallback_src = $video_fallback_src[0];
	}
}

$video_styles = '';
$video_height_styles = '';
if( isset( $video_height ) && $video_height != '' ) {
	$video_height_styles = " style='height:". (int) $video_height."px;'";
}
if( ( isset( $video_height ) && $video_height != '' ) || $video_fallback_src != '' ) {
	$video_styles .= ' style="';
	if( isset( $video_height ) && $video_height != '' ) {
		$video_styles .= 'height:'. (int) $video_height.'px;';
	}
	if ( $video_fallback_src ) {
		$video_styles .= ' background-image: url( ' . $video_fallback_src . ');';
	}
	$video_styles .= ' "';
}
$video_count = '';
$video_count = rand(1, 100);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if( 'image-left' == $bg_style || 'image-right' == $bg_style ) {
	$image_class = '';
	
	if( 'image-right' == $bg_style ) {
		$image_class = " pull-right";
	} else {
		$image_class = " pull-left";
	}
	
	echo '<section ' . implode( ' ', $wrapper_attributes ) . '>';
		echo '<div class="zozo-vc-main-row-inner vc-match-height-row'. esc_attr( $side_wrapper_skin ) .'"'. $inner_row_style .'>';
			// Image or Video Wrapper
			echo '<div class="vc-zozo-background-wrapper vc-side-image-wrapper col-sm-6 col-xs-12'. esc_attr( $image_class ) .'">';
				if( isset( $video_id ) && $video_id != '' ) {
					
					wp_enqueue_script( 'jquery-YTPlayer' );
					
					echo '<div class="vc-zozo-video-wrapper vc-match-height-content">';
						
						echo '<div id="video-bg-'. esc_attr( $video_count ) .'" class="video-bg"'.$video_styles.'>';
						ob_start();	?>
						
							<div id="player-<?php echo esc_attr( $video_count );?>" class="zozo-yt-player bg-video-container" 
							data-property="{<?php echo "videoURL:'https://www.youtube.com/watch?v=".$video_id."',autoPlay:".$video_autoplay.",mute:".$video_mute.""; ?>,showControls:false,containment:'self',loop:false,startAt:0,opacity:1,ratio:'16/9',quality:'hd720'}"<?php echo esc_attr( $video_height_styles ); ?>>
							</div>
							<?php if( isset( $video_controls ) && $video_controls == "true" ) { ?>
								<div id="video-controls-<?php echo esc_attr( $video_count ); ?>" class="zozo-video-controls">
									<?php if( isset( $video_autoplay ) && $video_autoplay == "true" ) { ?>
										<a class="fa fa-pause" id="video-play" href="#"></a>
									<?php } else { ?>
										<a class="fa fa-play" id="video-play" href="#"></a>
									<?php } ?>
								</div>
							<?php } ?>
						
						<?php echo ob_get_clean();
						
						echo '</div>';
					echo '</div>';
				} else {
				
					$bg_side_image_id = preg_replace( '/[^\d]/', '', $bg_side_image );
					$bg_side_image_src = wp_get_attachment_image_src( $bg_side_image, 'full' );
					if ( ! empty( $bg_side_image_src[0] ) ) {
						$bg_side_image_src = $bg_side_image_src[0];
					}
					
					$custom_style = $custom_styles = '';
					if( isset( $bg_side_image_src ) && $bg_side_image_src != '' ) {
						$custom_styles = 'background-image: url('.$bg_side_image_src.');';
						
						if( isset( $bg_side_size ) && $bg_side_size != 'default' ) {
							$custom_styles .= ' background-size: '.$bg_side_size.';';
						}
						
						if( isset( $bg_side_repeat ) && $bg_side_repeat != '' ) {
							$custom_styles .= ' background-repeat: '.$bg_side_repeat.';';
						}
						
						if( isset( $custom_styles ) && $custom_styles != '' ) {
							$custom_style = ' style="'.$custom_styles.'"';
						}
					}
					echo '<div class="vc-zozo-image-wrapper vc-match-height-content '.implode( ' ', array_filter( $side_css_classes ) ).'"'. implode(' ', $side_image_attributes ) .''.$custom_style.'>';
					echo '</div>';
				}
			echo '</div>';
			
			if( isset( $container_fluid ) && $container_fluid == 'yes' ) {
				echo '<div class="container-fluid">';
			} else {
				echo '<div class="container">';
			}
				echo '<div class="row">';
					echo '<div class="vc-side-content-wrapper vc-match-height-content col-sm-6 col-xs-12">';
						echo wpb_js_remove_wpautop( $content );	
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
		echo '</div>';		
	echo '</section>';

} else { ?>

	<?php echo '<section ' . implode( ' ', $wrapper_attributes ) . '>';
	
		if( isset( $video_id ) && $video_id != '' ) {
						
			wp_enqueue_script( 'jquery-YTPlayer' );
			
			echo '<div class="vc-zozo-video-wrapper">';
				
				if( isset( $video_controls ) && $video_controls == "true" ) {
					echo '<div id="video-player-wrapper'. esc_attr( $video_count ) .'" class="video-player-wrapper">';
						echo '<div id="video-player-'. esc_attr( $video_count ) .'" class="video-player"'.$video_styles.'>';
				} else {
					echo '<div id="video-bg-wrapper'. esc_attr( $video_count ) .'" class="video-bg-wrapper">';
						echo '<div id="video-bg-'. esc_attr( $video_count ) .'" class="video-bg"'.$video_styles.'>';
				}
				
				ob_start();	?>
				
					<div id="player-<?php echo esc_attr( $video_count ); ?>" class="zozo-yt-player bg-video-container" 
					data-property="{<?php echo "videoURL:'https://www.youtube.com/watch?v=".$video_id."',autoPlay:".$video_autoplay.",mute:".$video_mute.""; ?>,showControls:false,containment:'self',loop:false,startAt:0,opacity:1,ratio:'16/9',quality:'hd720'}"<?php echo esc_attr( $video_height_styles ); ?>>
					</div>
					<?php if( isset( $video_controls ) && $video_controls == "true" ) { ?>
						<div id="video-controls-<?php echo esc_attr( $video_count ); ?>" class="zozo-video-controls">
							<?php if( isset( $video_autoplay ) && $video_autoplay == "true" ) { ?>
								<a class="fa fa-pause" id="video-play" href="#"></a>
							<?php } else { ?>
								<a class="fa fa-play" id="video-play" href="#"></a>
							<?php } ?>
						</div>
					<?php } ?>
				
				<?php echo ob_get_clean();
				
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
		}
	
		echo '<div class="zozo-vc-main-row-inner vc-normal-section'.$extra_height_class.'"'. $inner_row_style .'>';
			if ( 'yes' == $center_row ) {
				echo '<div class="container"><div class="row">';
			}
			
			echo wpb_js_remove_wpautop( $content );	
			
			if ( 'yes' == $center_row ) {
				echo '</div></div>';
			}
		echo '</div>';
		
	echo '</section>'; ?>
	
<?php } ?>

<?php if ( ! empty( $full_width ) ) {
	echo '<div class="vc_row-full-width vc_clearfix"></div>';
} ?>
<?php global $post;

$post_id = get_the_ID();
$post_name = $post->post_name;

$overlay_class = $parallax_class = '';

// Get Parallax Options
$zozo_section_header_status = get_post_meta( $post_id, 'zozo_section_header_status', true );
$zozo_section_title = get_post_meta( $post_id, 'zozo_section_title', true );
$zozo_section_slogan = get_post_meta( $post_id, 'zozo_section_slogan', true);
$zozo_parallax_status = get_post_meta( $post_id, 'zozo_parallax_status', true);
$zozo_parallax_bg_image = get_post_meta( $post_id, 'zozo_parallax_bg_image', true);
$zozo_parallax_bg_overlay = get_post_meta( $post_id, 'zozo_parallax_bg_overlay', true);
$zozo_overlay_pattern_status = get_post_meta( $post_id, 'zozo_overlay_pattern_status', true);
$zozo_section_overlay_color = get_post_meta( $post_id, 'zozo_section_overlay_color', true);
$zozo_overlay_pattern_style = get_post_meta( $post_id, 'zozo_overlay_pattern_style', true);
if( $zozo_parallax_bg_overlay == 'yes' && $zozo_overlay_pattern_status == 'yes' ) {
	$overlay_class = ' ' . $zozo_overlay_pattern_style . ' parallax-overlay';
}							
if( $overlay_class != '' && $zozo_overlay_pattern_style != '' ) {
	$overlay_class .= ' parallax-overlay-pattern';
}
if( $overlay_class != '' && $zozo_section_overlay_color != '' ) {
	$overlay_class .= ' parallax-overlay-color';
}

if( $zozo_parallax_status == 'yes') {
	$parallax_class = ' parallax-background parallax-section';
} else {
	$parallax_class = ' normal-background';
}
if( isset( $zozo_parallax_bg_image ) && $zozo_parallax_bg_image != '' ) {
	$parallax_class .= ' parallax-bg-image';
} else {
	$parallax_class .= ' no-bg-image';
}
?>

<div id="section-<?php echo esc_attr($post_name); ?>" class="page-id-<?php echo esc_attr($post_id); ?> page-<?php echo esc_attr($post_name); ?> fullwidth-section<?php echo esc_attr($parallax_class); ?><?php echo esc_attr($overlay_class); ?>">
	<div id="page-<?php echo esc_attr($post_name); ?>" class="parallax-page-inner">
		<div class="parallax-bg-overlay"></div>
		
		<div class="parallax-section-container">
			<?php if( $zozo_section_header_status == 'show' && ( $zozo_section_title != '' || $zozo_section_slogan != '' ) ) { ?>
				<div class="container zozo-parallax-header">
					<div class="parallax-header">
						<h2 class="parallax-title"><?php echo do_shortcode( $zozo_section_title ); ?></h2>
						<?php if( !empty($zozo_section_slogan) ) { ?>
							<p class="parallax-desc"><?php echo do_shortcode( $zozo_section_slogan ); ?></p>
						<?php } ?>
					</div>
				</div>
			<?php } ?>	
		
			<div class="container">
				<div class="entry-content parallax-content">				
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		
	</div>
</div>
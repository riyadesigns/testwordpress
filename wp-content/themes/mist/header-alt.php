<?php
/**
 * The Alternate Header for our theme.
 *
 * Displays sliders and others from the header section
 *
 * @package Zozothemes
 */

global $zozo_options;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	
	<!-- Latest IE rendering engine & Chrome Frame Meta Tags -->
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo ZOZOTHEME_URL; ?>/js/plugins/html5.js"></script>
	<script src="<?php echo ZOZOTHEME_URL; ?>/js/plugins/respond.min.js"></script>
	<![endif]--> 
	
	<!--[if lte IE 7]><script src="<?php echo ZOZOTHEME_URL; ?>/js/plugins/icons-lte-ie7.js"></script><![endif]-->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if( isset( $zozo_options['zozo_disable_page_loader'] ) && $zozo_options['zozo_disable_page_loader'] != 1 ) { ?>	
	<div class="pageloader">
		<div class="zozo-loader">
			<div class="zozo-loader-inner ball-clip-rotate">
				<div></div>
			</div>
		</div>
	</div>
<?php } ?>

<div id="zozo_wrapper" class="wrapper-class">
	<?php 
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
	
	$slider_position = '';
	$slider_position 	= get_post_meta( $post_id, 'zozo_slider_position', true );
	if( isset( $slider_position ) && $slider_position == '' || $slider_position == 'default' ) {
		$slider_position = $zozo_options['zozo_slider_position'];
	}
	
	if( ! $slider_position ) {
		$slider_position = "below";
	}
	if( $slider_position == "above" || $slider_position == "below" ) {
		get_template_part('partials/sliders' );
	} ?>
	
	<div id="section-top" class="zozo-top-anchor"></div>
	
	<div id="main" class="main-section">
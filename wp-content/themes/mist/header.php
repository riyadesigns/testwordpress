<?php
/**
 * The Header for our theme.
 *
 * Displays all of the header section
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
<?php if( isset($zozo_options['zozo_enable_secondary_menu']) && $zozo_options['zozo_enable_secondary_menu'] == 1 ) { ?>
	<div class="secondary_menu <?php echo esc_attr( $zozo_options['zozo_secondary_menu_position'] ); ?>">		
		<a href="#" target="_self" class="secondary_menu_close"><i class="fa fa-times"></i></a>
		<?php dynamic_sidebar( 'secondary-menu' ); ?>
	</div>
<?php } ?>

<div id="zozo_wrapper" class="wrapper-class">
	<?php if( isset( $zozo_options['zozo_footer_style'] ) && $zozo_options['zozo_footer_style'] == 'hidden' ) { ?>
		<div class="wrapper-inner">	
	<?php } ?>
	
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
	
	// Sliding Bar
	$sliding_bar = '';
	$sliding_bar = get_post_meta( $post_id, 'zozo_show_header_sliding_bar', true );
	if( isset( $sliding_bar ) && $sliding_bar == '' || $sliding_bar == 'default' ) {
		$sliding_bar = $zozo_options['zozo_enable_sliding_bar'];
		if( $sliding_bar == 1 ) {
			$sliding_bar = 'yes';
		} else {
			$sliding_bar = 'no';
		}
	}
	
	if ( isset($sliding_bar) && $sliding_bar == 'yes' ) {
		get_template_part('partials/slidingbar' );
	}
	
	$slider_position = '';
	$slider_position = get_post_meta( $post_id, 'zozo_slider_position', true );
	if( isset( $slider_position ) && $slider_position == '' || $slider_position == 'default' ) {
		$slider_position = $zozo_options['zozo_slider_position'];
	}
	
	if( ! $slider_position ) {
		$slider_position = "below";
	}
	
	// Header Above Slider
	if( $slider_position == "above" ) {
		get_template_part('partials/sliders' );
	} ?>
	
	<?php $show_header = '';
	$show_header 	= get_post_meta( $post_id, 'zozo_show_header', true );
	if( ! $show_header ) {
		$show_header  = "yes";
	} 
	
	// Header Layout
	$header_layout = '';
	$header_layout 	= get_post_meta( $post_id, 'zozo_header_layout', true );
	if( isset( $header_layout ) && $header_layout == '' || $header_layout == 'default' ) {
		$header_layout = $zozo_options['zozo_header_layout'];
	}
		
	if( ! $header_layout ) {
		$header_layout  = "fullwidth";
	}
	
	// Header Transparency
	$header_transparency 	= '';
	$header_transparency 	= get_post_meta( $post_id, 'zozo_header_transparency', true );
	if( isset( $header_transparency ) && $header_transparency == '' || $header_transparency == 'default' ) {
		$header_transparency = $zozo_options['zozo_header_transparency'];
	}
	
	if( ! $header_transparency ) {
		$header_transparency  = "no-transparent";
	}
	
	// Header Skin
	$header_skin 	= '';
	$header_skin 	= get_post_meta( $post_id, 'zozo_header_skin', true );
	if( isset( $header_skin ) && $header_skin == '' || $header_skin == 'default' ) {
		$header_skin = $zozo_options['zozo_header_skin'];
	}
	
	// Header Type
	$header_type = '';
	$header_toggle_position = '';
	
	$header_type 	= get_post_meta( $post_id, 'zozo_header_type', true );
	$header_toggle_position = get_post_meta( $post_id, 'zozo_header_toggle_position', true );
	
	if( isset( $header_type ) && $header_type == '' || $header_type == 'default' ) {
		$header_type = $zozo_options['zozo_header_type'];
	}
	
	if( isset( $header_toggle_position ) && $header_toggle_position == '' || $header_toggle_position == 'default' ) {
		$header_toggle_position = $zozo_options['zozo_header_toggle_position'];
	}
	
	$header_extra_class = '';
	if( $header_type == 'header-4' || $header_type == 'header-5' || $header_type == 'header-6' || $header_type == 'header-11' ) { 
		$header_extra_class = ' header-fullwidth-menu';
	}
	
	if( $header_type == 'header-9' ) { 
		$header_extra_class .= ' header-toggle-position-'. $header_toggle_position .'';
	} ?>
	
	<?php if( isset( $show_header ) && $show_header == 'yes' ) { ?>
		<div id="header" class="header-section type-<?php echo esc_attr( $header_type ); ?><?php echo esc_attr( $header_extra_class ); ?> header-skin-<?php echo esc_attr( $header_skin ); ?> header-<?php echo esc_attr( $header_transparency ); ?>">
			<?php if( isset( $header_layout ) && $header_layout == 'boxed' ) { ?>
				<div class="container boxed-header">
					<div class="row">
			<?php } ?>
			
			<?php get_template_part('partials/header/'. $header_type ); ?>
			
			<?php if( isset( $header_layout ) && $header_layout == 'boxed' ) { ?>
					</div>
				</div>
			<?php } ?>
		</div><!-- #header -->
	<?php } ?>
	
	<div id="section-top" class="zozo-top-anchor"></div>
	
	<?php if( $slider_position == "below" ) {
		get_template_part('partials/sliders' );
	} ?>
	
	<?php // Featured Post Slider for Home
	if( is_home() ) { 
		if( isset( $zozo_options['zozo_show_blog_featured_slider'] ) && $zozo_options['zozo_show_blog_featured_slider'] == 1 && $zozo_options['zozo_featured_slider_type'] == 'below_header' ) {
			get_template_part('partials/blog/featured', 'slider' );	
	 	} 
	} 
	// Featured Post Slider for Archives
	elseif( ( ( is_archive() || is_tag() || is_category() ) && ! is_post_type_archive() ) && ! ( is_tax('product_cat') || is_tax('product_tag' ) ) ) { 
		if( isset( $zozo_options['zozo_show_archive_featured_slider'] ) && $zozo_options['zozo_show_archive_featured_slider'] == 1 && $zozo_options['zozo_featured_slider_type'] == 'below_header' ) {
			get_template_part('partials/blog/featured', 'slider' );	
	 	}
	} ?>
	
	<div id="main" class="main-section">
	
		<!-- ============ Page Header ============ -->
		<?php get_template_part('partials/page', 'header' ); ?>
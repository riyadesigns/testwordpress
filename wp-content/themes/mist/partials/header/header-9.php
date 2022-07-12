<?php global $post, $zozo_options; 
$object_id = get_queried_object_id();

if( ( get_option('show_on_front') && get_option('page_for_posts') && is_home() ) || 
( get_option('page_for_posts') && is_archive() && ! is_post_type_archive() ) && 
!( is_tax('product_cat') || is_tax('product_tag') ) || 
( get_option('page_for_posts') && is_search() ) ) {

	$post_id = get_option('page_for_posts');		
} else {
	if( isset($object_id) ) {
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
$header_top_bar = '';
$header_top_bar 	= get_post_meta( $post_id, 'zozo_show_header_top_bar', true );
if( isset( $header_top_bar ) && $header_top_bar == '' || $header_top_bar == 'default' ) {
	$header_top_bar = $zozo_options['zozo_enable_header_top_bar'];
	if( $header_top_bar == 1 ) {
		$header_top_bar = 'yes';
	} else {
		$header_top_bar = 'no';
	}
} 
$header_mini_cart = '';
$header_mini_cart 	= get_post_meta( $post_id, 'zozo_show_header_mini_cart', true );
if( isset( $header_mini_cart ) && $header_mini_cart == '' || $header_mini_cart == 'default' ) {
	$header_mini_cart = $zozo_options['zozo_show_cart_header'];
	if( $header_mini_cart == 1 ) {
		$header_mini_cart = 'yes';
	} else {
		$header_mini_cart = 'no';
	}
}
$header_toggle_position = '';
$header_toggle_position = get_post_meta( $post_id, 'zozo_header_toggle_position', true );
if( isset( $header_toggle_position ) && $header_toggle_position == '' || $header_toggle_position == 'default' ) {
	$header_toggle_position = $zozo_options['zozo_header_toggle_position'];
}
?>

<div id="header-main" class="header-main-section navbar">
	<div class="container">				
		<?php $zozo_site_title = get_bloginfo( 'name' );
		$zozo_site_url = home_url( '/' );
		$zozo_site_description = get_bloginfo( 'description' );
		 
		$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; 
		
		if( $zozo_options['zozo_sticky_logo'] && $zozo_options['zozo_sticky_logo']['url'] ) {
			$logo_class = " zozo-has-sticky-logo";
		} else {
			$logo_class = " zozo-no-sticky-logo"; 
		} 
		
		if( $zozo_options['zozo_mobile_logo'] && $zozo_options['zozo_mobile_logo']['url'] ) {
			$logo_class .= " zozo-has-mobile-logo";
		} else {
			$logo_class .= " zozo-no-mobile-logo"; 
		} ?>
	 	
		<!-- ============ Logo ============ -->
		<div class="navbar-header nav-respons zozo-logo<?php echo esc_attr( $logo_class ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
				<?php if( $zozo_options['zozo_logo'] && $zozo_options['zozo_logo']['url'] ) {
					echo '<img class="img-responsive zozo-standard-logo" src="' . esc_url( $zozo_options['zozo_logo']['url'] ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" width="'. esc_attr( $zozo_options['zozo_logo']['width'] ) .'" height="'. esc_attr( $zozo_options['zozo_logo']['height'] ) .'" />';
				} else {
					bloginfo( 'name' );
				} ?>
				<?php if( $zozo_options['zozo_sticky_logo'] && $zozo_options['zozo_sticky_logo']['url'] ) {
					echo '<img class="img-responsive zozo-sticky-logo" src="' . esc_url( $zozo_options['zozo_sticky_logo']['url'] ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" width="'. esc_attr( $zozo_options['zozo_sticky_logo']['width'] ) .'" height="'. esc_attr( $zozo_options['zozo_sticky_logo']['height'] ) .'" />';
				} ?>
				<?php if( $zozo_options['zozo_mobile_logo'] && $zozo_options['zozo_mobile_logo']['url'] ) {
					echo '<img class="img-responsive zozo-mobile-logo" src="' . esc_url( $zozo_options['zozo_mobile_logo']['url'] ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" width="'. esc_attr( $zozo_options['zozo_mobile_logo']['width'] ) .'" height="'. esc_attr( $zozo_options['zozo_mobile_logo']['height'] ) .'" />';
				} ?>
			</a>
		</div>
		
		<div class="zozo-mainnavbar-collapse zozo-header-main-bar">
			<!-- ==================== Header Left ==================== -->
			<ul class="nav navbar-nav navbar-right zozo-main-bar">
				<li class="header-side-wrapper">
					<a id="nav-side-menu" href="#">
						<i class="icomoon icomoon-menu5"></i>
					</a>
				</li>
			</ul>
		</div>
	</div><!-- .container -->
</div><!-- .header-main-section -->

<div id="header-toggle" class="header-toggle-section header-position-<?php echo esc_attr( $header_toggle_position ); ?>">
	<div class="header-toggle-inner">
		<a id="nav-close-menu" href="#" class="close-menu flaticon-cross37"></a>
		<?php if ( isset($header_top_bar) && $header_top_bar == 'yes' ) { ?>
		<div id="header-side-top-bar" class="header-side-top-section clearfix">
			<?php if( ZOZO_WOOCOMMERCE_ACTIVE ) {
				if ( isset($header_mini_cart) && $header_mini_cart == 'yes' ) { ?>
					<div class="header-side-top-cart header-top-cart">
						<?php echo zozo_header_content_area( 'cart-icon' ); ?>
					</div>
				<?php }
			} ?>
			<div class="header-side-topmenu dropdown">
				<button class="header-side-btn btn dropdown-toggle" type="button" id="zozo-side-topmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<?php _e( 'Menu', 'mist' ); ?>
					<span class="caret"></span>
				</button>
				<div class="header-side-top-submenu dropdown-menu" aria-labelledby="zozo-side-topmenu">
					<?php zozo_header_content_area( 'top-navigation' ); ?>
				</div>
			</div>
		</div>
		<?php } ?>
					
		<div id="header-side-main" class="header-side-main-section clearfix">
			<div class="zozo-header-side-main-bar">
				<?php zozo_header_content_area( 'side-navigation' ); ?>
			</div>
		</div><!-- .header-side-main-section -->
	
		<div class="zozo-header-side-bottom clearfix">
			<?php if( isset($zozo_options['zozo_enable_search_in_header']) && $zozo_options['zozo_enable_search_in_header'] == 1 ) { ?>				
			<div id="header-main-search" class="header-main-side-search">
				<?php echo get_search_form(); ?>
			</div>				
			<?php } ?>
			
			<?php zozo_header_content_area( 'contact-info' ); ?>
				
			<?php if ( isset( $zozo_options['zozo_show_socials_header']) && $zozo_options['zozo_show_socials_header'] == 1 ) { ?>
				<div class="side-social-nav"><?php zozo_header_content_area( 'social-links' ); ?></div>
			<?php } ?>
		</div>
	</div>
</div>
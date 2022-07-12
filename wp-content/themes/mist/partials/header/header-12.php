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
} ?>
	
<?php if ( isset($header_top_bar) && $header_top_bar == 'yes' ) { ?>
<div id="header-top-bar" class="header-top-section navbar">				
	<div class="container">
		<!-- ==================== Toggle Icon ==================== -->
		<div class="navbar-header nav-respons">
			<button type="button" aria-expanded="false" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".zozo-topnavbar-collapse">
				<span class="sr-only"><?php esc_html_e('Toggle navigation', 'mist'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="navbar-collapse zozo-topnavbar-collapse collapse">
			<!-- ==================== Header Top Bar Left ==================== -->
			<ul class="nav navbar-nav zozo-top-left">
				<li>
				<?php if( isset( $zozo_options['zozo_welcome_msg']) && $zozo_options['zozo_welcome_msg'] != '' ) { ?>
					<p class="welcome-msg"><?php echo do_shortcode( $zozo_options['zozo_welcome_msg'] ); ?></p>
				<?php } ?>
				</li>
			</ul>
		
			<!-- ==================== Header Top Bar Right ==================== -->
			<ul class="nav navbar-nav navbar-right zozo-top-right">
				<li><?php zozo_header_content_area( 'top-navigation' ); ?></li>
			</ul>
		</div>
	</div><!-- .container -->
</div>
<?php } ?>
		
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
			<!-- ==================== Toggle Icon ==================== -->
			<button type="button" aria-expanded="false" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".zozo-mainnavbar-collapse">
				<span class="sr-only"><?php esc_html_e('Toggle navigation', 'mist'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
				
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
		
		<div class="navbar-collapse zozo-mainnavbar-collapse collapse zozo-header-main-bar zozo-header-toggle-bar">
			<!-- ==================== Header Right ==================== -->
			<ul class="nav navbar-nav navbar-right zozo-main-bar">
				<li><?php zozo_header_content_area( 'main-navigation' ); ?></li>
				
				<?php if( isset( $zozo_options['zozo_header_phone'] ) && $zozo_options['zozo_header_phone'] != '' ) { ?>
				<li class="extra-nav contact-phone">
					<i class="icomoon icomoon-mobile phone-trigger"></i>					
				</li>
				<?php } ?>
				
				<?php if( isset( $zozo_options['zozo_header_email'] ) && $zozo_options['zozo_header_email'] != '' ) { ?>
				<li class="extra-nav contact-email">
					<i class="fa fa-envelope email-trigger"></i>					
				</li>
				<?php } ?>
				
				<?php if( isset($zozo_options['zozo_enable_search_in_header']) && $zozo_options['zozo_enable_search_in_header'] == 1 ) { ?>
				<li class="extra-nav search-toggle">
					<i class="fa fa-search search-trigger"></i>
				</li>
				<?php } ?>
				
				<?php if ( isset( $zozo_options['zozo_show_socials_header']) && $zozo_options['zozo_show_socials_header'] == 1 ) { ?>
				<li class="extra-nav social-toggle">
					<i class="fa fa-share-alt social-trigger"></i>
				</li>
				<?php } ?>
				
				<?php if( ZOZO_WOOCOMMERCE_ACTIVE ) {
					if ( isset($header_mini_cart) && $header_mini_cart == 'yes' ) { ?>
						<li class="extra-nav header-top-cart"><?php echo zozo_header_content_area( 'cart-icon' ); ?></li>
					<?php }
				} ?>
				
				<?php if( isset($zozo_options['zozo_enable_secondary_menu']) && $zozo_options['zozo_enable_secondary_menu'] == 1 ) { ?>
				<li class="extra-nav">
					<div id="secondary-menu" class="header-main-bar-sidemenu side-menu">
						<a class="secondary_menu_button" href="javascript:void(0)">
							<i class="fa fa-bars"></i>
						</a>
					</div>
				</li>
				<?php } ?>
			</ul>
			
			<?php if( isset( $zozo_options['zozo_header_phone'] ) && $zozo_options['zozo_header_phone'] != '' ) { ?>
			<div id="header-contact-phone" class="header-toggle-content header-contact-phone">
				<i class="fa fa-times btn-toggle-close"></i>				
				<?php echo '<h3 class="header-phone">' . esc_html( $zozo_options['zozo_header_phone']) .'</h3>'; ?>	
			</div>
			<?php } ?>
			
			<?php if( isset( $zozo_options['zozo_header_email'] ) && $zozo_options['zozo_header_email'] != '' ) { ?>
			<div id="header-contact-email" class="header-toggle-content header-contact-email">
				<i class="fa fa-times btn-toggle-close"></i>				
				<?php echo '<h3 class="header-email"><a href="mailto:'.esc_attr( $zozo_options['zozo_header_email'] ).'">'.esc_html( $zozo_options['zozo_header_email'] ).'</a></h3>'; ?>
			</div>
			<?php } ?>
			
			<?php if( isset($zozo_options['zozo_enable_search_in_header']) && $zozo_options['zozo_enable_search_in_header'] == 1 ) { ?>
			<div id="header-toggle-search" class="header-toggle-content header-toggle-search">
				<i class="fa fa-times btn-toggle-close"></i>
				<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
					<div class="toggle-search-form">
						<input type="text" value="" name="s" id="s" class="form-control" placeholder="<?php esc_html_e('Enter your text & hit Enter', 'mist'); ?>" />
					</div>
				</form>				
			</div>
			<?php } ?>
			
			<?php if ( isset( $zozo_options['zozo_show_socials_header']) && $zozo_options['zozo_show_socials_header'] == 1 ) { ?>
			<div id="header-toggle-social" class="header-toggle-content header-toggle-social">
				<i class="fa fa-times btn-toggle-close"></i>
				<?php zozo_header_content_area( 'social-links' ); ?>
			</div>
			<?php } ?>
		</div>
	</div><!-- .container -->
</div><!-- .header-main-section -->
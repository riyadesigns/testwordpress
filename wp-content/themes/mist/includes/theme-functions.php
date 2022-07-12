<?php
/**
* Theme Functions
*/

/* ================================================
 * Add Navigation theme support and Register Menus
 * ================================================ */
 
if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 
		'primary-menu'	=> esc_html__( 'Primary Menu', 'mist' ),
		'primary-right'	=> esc_html__( 'Primary Right Menu', 'mist' ),
		'top-menu'		=> esc_html__( 'Top Menu', 'mist' ),
		'footer-menu'	=> esc_html__( 'Footer Menu', 'mist' )
	) );
}

/* =========================================================
 * Header Content Area
 * ========================================================= */
 
if ( ! function_exists( 'zozo_header_content_area' ) ) { 

	function zozo_header_content_area( $section ) {
	
		global $zozo_options, $woocommerce;
		
		if( $section == 'social-links' ) {
			echo '<div id="header-sidebar-social" class="sidebar-social">';
			echo zozo_display_social_icons();
			echo '</div>';
		}
		
		if( $section == 'top-navigation') {			
			echo '<div class="hidden-xs">';
			echo wp_nav_menu( array( 'container_class' => 'zozo-nav top-menu-navigation', 'container_id' => 'top-nav', 'menu_id' => 'top-menu', 'menu_class' => 'nav navbar-nav navbar-right zozo-top-nav', 'theme_location' => 'top-menu', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker() ) );
			echo '</div>';			
			// ==================== Mobile Menu ==================== //
			echo '<div id="mobile-top-menu-wrapper" class="visible-xs mobile-menu">';
			echo wp_nav_menu( array( 'container_class' => 'zozo-nav top-menu-navigation', 'container_id' => 'top-mobile-nav', 'menu_id' => 'top-mobile-menu', 'menu_class' => 'nav navbar-nav zozo-top-nav', 'theme_location' => 'top-menu', 'fallback_cb' => 'wp_bootstrap_mobile_navwalker::fallback', 'walker' => new wp_bootstrap_mobile_navwalker() ) );
			echo '</div>';
		}
		
		if( $section == 'side-navigation' ) {
			
			echo wp_nav_menu( array( 'container_class' => 'main-nav main-menu-container', 'container_id' => 'main-nav-container', 'menu_id' => 'main-menu', 'menu_class' => 'nav navbar-nav navbar-main zozo-main-nav', 'theme_location' => 'primary-menu', 'fallback_cb' => 'wp_bootstrap_mobile_navwalker::fallback', 'walker' => new wp_bootstrap_mobile_navwalker() ) );
			
		}
		
		if( $section == 'main-navigation') {			
			echo '<div class="hidden-xs">';
			
			if( $zozo_options['zozo_menu_type'] != 'standard' && $zozo_options['zozo_menu_type'] == 'megamenu' ) {
				echo wp_nav_menu( array( 'container_class' => 'main-nav main-menu-container main-megamenu', 'container_id' => 'main-nav-container', 'menu_id' => 'main-menu', 'menu_class' => 'nav navbar-nav navbar-main zozo-main-nav', 'theme_location' => 'primary-menu', 'fallback_cb' => 'ZozoMegaMenuFrontendWalker::fallback', 'walker' => new ZozoMegaMenuFrontendWalker() ) );
			} else {
				echo wp_nav_menu( array( 'container_class' => 'main-nav main-menu-container', 'container_id' => 'main-nav-container', 'menu_id' => 'main-menu', 'menu_class' => 'nav navbar-nav navbar-main zozo-main-nav', 'theme_location' => 'primary-menu', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker() ) );
			}

			echo '</div>';
			// ==================== Mobile Menu ==================== //
			echo '<div id="main-mobile-menu-wrapper" class="visible-xs mobile-menu">';
			echo wp_nav_menu( array( 'container_class' => 'main-nav main-mobile-nav main-menu-navigation', 'container_id' => 'main-mobile-nav', 'menu_id' => 'main-mobile-menu', 'menu_class' => 'nav navbar-nav navbar-main zozo-main-nav', 'theme_location' => 'primary-menu', 'fallback_cb' => 'wp_bootstrap_mobile_navwalker::fallback', 'walker' => new wp_bootstrap_mobile_navwalker() ) );
			echo '</div>';
		}
		
		if( $section == 'main-right-navigation') {			
			echo '<div class="hidden-xs">';
			
			if( $zozo_options['zozo_menu_type'] != 'standard' && $zozo_options['zozo_menu_type'] == 'megamenu' ) {
				echo wp_nav_menu( array( 'container_class' => 'main-right-nav main-menu-container main-megamenu', 'container_id' => 'main-right-nav-container', 'menu_id' => 'main-right-menu', 'menu_class' => 'nav navbar-nav navbar-main zozo-main-nav', 'theme_location' => 'primary-right', 'fallback_cb' => 'ZozoMegaMenuFrontendWalker::fallback', 'walker' => new ZozoMegaMenuFrontendWalker() ) );
			} else {
				echo wp_nav_menu( array( 'container_class' => 'main-right-nav main-menu-container', 'container_id' => 'main-right-nav-container', 'menu_id' => 'main-right-menu', 'menu_class' => 'nav navbar-nav navbar-main zozo-main-nav', 'theme_location' => 'primary-right', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker() ) );
			}

			echo '</div>';
			// ==================== Mobile Menu ==================== //
			echo '<div id="main-right-mobile-menu-wrapper" class="visible-xs mobile-menu">';
			echo wp_nav_menu( array( 'container_class' => 'main-right-nav main-right-mobile-nav main-menu-navigation', 'container_id' => 'main-right-mobile-nav', 'menu_id' => 'main-right-mobile-menu', 'menu_class' => 'nav navbar-nav navbar-main zozo-main-nav', 'theme_location' => 'primary-right', 'fallback_cb' => 'wp_bootstrap_mobile_navwalker::fallback', 'walker' => new wp_bootstrap_mobile_navwalker() ) );
			echo '</div>';
		}
						
		if( $section == 'search-box') {
			echo '<div id="header-search-form" class="header-search-form">';			
			echo get_search_form();
			echo '</div>';
		}
		
		if( $section == 'contact-info' ) {
			echo '<div id="header-contact-info" class="top-contact-info">';
				echo '<ul class="header-contact-details">';
				if( isset( $zozo_options['zozo_header_phone'] ) && $zozo_options['zozo_header_phone'] != '' ) {
					echo '<li class="header-phone">' . esc_html( $zozo_options['zozo_header_phone']) .'</li>';
				}
				if( isset( $zozo_options['zozo_header_email'] ) && $zozo_options['zozo_header_email'] != '' ) {
					echo '<li class="header-email">';
						echo '<a href="mailto:'.esc_attr( $zozo_options['zozo_header_email'] ).'">'.esc_html( $zozo_options['zozo_header_email'] ).'</a>';
					echo '</li>';
				}
				echo '</ul>';
			echo '</div>';
		}
		
		if( $section == 'cart-icon') { ?>
		
			<div class="woo-cart">
				<?php if( ! $woocommerce->cart->cart_contents_count ) { ?>
				<a class="cart-empty cart-icon" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><i class="icomoon icomoon3-shopping_cart"></i></a>
				<?php } else { ?>
				<a class="cart-icon" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><i class="icomoon icomoon3-shopping_cart"></i><span class="cart-count"><?php echo wp_kses_post( $woocommerce->cart->cart_contents_count ); ?></span></a>
				
				<div class="woo-cart-contents">
					<?php foreach( $woocommerce->cart->cart_contents as $cart_item_key => $cart_item ) { ?>
						<div class="woo-cart-item">
							<a href="<?php echo get_permalink($cart_item['product_id']); ?>" title="<?php echo esc_html( $cart_item['data']->post->post_title ); ?>">
								<?php $thumbnail_id = ($cart_item['variation_id']) ? $cart_item['variation_id'] : $cart_item['product_id']; ?>
								<?php echo get_the_post_thumbnail($thumbnail_id, 'thumbnail'); ?>
								<div class="cart-item-content">
									<h5 class="cart-product-title"><?php echo wp_kses_post( $cart_item['data']->post->post_title ); ?></h5>
									<p class="cart-product-quantity"><?php echo wp_kses_post( $cart_item['quantity'] ); ?> x <?php echo wp_kses_post( $woocommerce->cart->get_product_subtotal($cart_item['data'], 1) ); ?></p>
								</div>
							</a>
							<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove-cart-item" title="%s" data-cart_id="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'mist'), $cart_item_key ), $cart_item_key ); ?>
                            <div class="ajax-loading"></div>							
						</div>
					<?php } ?>
					
					<div class="woo-cart-total">
						<h5 class="cart-total"><?php esc_html_e('Total: ', 'mist'); ?> <?php echo wp_kses_post( $woocommerce->cart->get_cart_total() ); ?></h5>						
					</div>
					
					<div class="woo-cart-links clearfix">
						<div class="cart-link"><a class="btn btn-cart" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>" title="<?php esc_html_e('Cart', 'mist'); ?>"><?php esc_html_e('View Cart', 'mist'); ?></a></div>
						<div class="checkout-link"><a class="btn btn-checkout" href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>" title="<?php esc_html_e('Checkout', 'mist'); ?>"><?php esc_html_e('Checkout', 'mist'); ?></a></div>
					</div>
				</div>
				<?php } ?>
			</div>
			
		<?php }
		
	}
	
}

/*===================================================================================
 * Add Author Links
 * =================================================================================*/
function zozo_add_to_author_profile( $contactmethods ) {
	
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'zozo_add_to_author_profile', 10, 1);

/* =========================================================
 * Main Layout Custom Classes
 * ========================================================= */
 
/**
 * Single Sidebar Container Classes works on all column layouts
 */ 
if ( ! function_exists( 'zozo_content_sidebar_classes' ) ) { 

	function zozo_content_sidebar_classes() {	
	
		global $zozo_options, $post;
		$layout = $home_id = '';
		
		if( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );			
		}
		
		if( is_archive() ) {
			$layout = $zozo_options['zozo_blog_archive_layout'];
		}
		
		if( is_home() ) {
			$home_id = get_option( 'page_for_posts' );
			$layout = get_post_meta( $home_id, 'zozo_layout', true );
			if( !$layout ) {
				$layout = $zozo_options['zozo_blog_layout'];
			}
		}
		
		if ( is_singular( 'post' ) ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );
			if( !$layout ) {
				$layout = $zozo_options['zozo_single_post_layout'];
			}			
		}
		
		if( !$layout ) {			
			if( $zozo_options['zozo_layout'] != '' ) {		
				$layout = $zozo_options['zozo_layout'];
			}
			else {
				$layout = 'two-col-right';
			}
		}
			
		if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' ) {
			echo 'main-col-small';
		}
		else {
			echo 'main-col-full';
		}		
	}	
} 

/**
 * Primary Content Classes works on all column layouts
 */
if ( ! function_exists( 'zozo_primary_content_classes' ) ) { 

	function zozo_primary_content_classes() {	
	
		global $zozo_options, $post;
		$layout = $home_id = '';
		
		if( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );			
		}
		
		if( is_archive() ) {
			$layout = $zozo_options['zozo_blog_archive_layout'];
		}
		
		if( is_home() ) {
			$home_id = get_option( 'page_for_posts' );
			$layout = get_post_meta( $home_id, 'zozo_layout', true );
			if( !$layout ) {
				$layout = $zozo_options['zozo_blog_layout'];
			}
		}
		
		if ( is_singular( 'post' ) ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );
			if( !$layout ) {
				$layout = $zozo_options['zozo_single_post_layout'];
			}			
		}
		
		if( !$layout ) {			
			if( $zozo_options['zozo_layout'] != '' ) {		
				$layout = $zozo_options['zozo_layout'];
			}
			else {
				$layout = 'two-col-right';
			}
		}
						
		if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' || $layout == 'two-col-left' || $layout == 'two-col-right' ) {
			echo 'content-col-small';
		}		
		elseif( $layout == 'one-col' ) {
			echo 'content-col-full';
		}
		
	}	
} 

/**
 * Primary Sidebar Classes works on two-column and three-column layouts
 */
if ( ! function_exists( 'zozo_primary_sidebar_classes' ) ) { 

	function zozo_primary_sidebar_classes() {	
	
		global $zozo_options, $post;
		$layout = $home_id = '';
		
		if( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );			
		}
		
		if( is_archive() ) {
			$layout = $zozo_options['zozo_blog_archive_layout'];
		}
		
		if( is_home() ) {
			$home_id = get_option( 'page_for_posts' );
			$layout = get_post_meta( $home_id, 'zozo_layout', true );
			if( !$layout ) {
				$layout = $zozo_options['zozo_blog_layout'];
			}
		}
		
		if ( is_singular( 'post' ) ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );
			if( !$layout ) {
				$layout = $zozo_options['zozo_single_post_layout'];
			}			
		}
		
		if( !$layout ) {			
			if( $zozo_options['zozo_layout'] != '' ) {		
				$layout = $zozo_options['zozo_layout'];
			}
			else {
				$layout = 'two-col-right';
			}
		}
				
		if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' || $layout == 'two-col-left' || $layout == 'two-col-right' ) {
			echo 'pm-sidebar';
		}		
	}	
} 

/**
 * Secondary Sidebar Classes works only on three-column layout
 */
if ( ! function_exists( 'zozo_secondary_sidebar_classes' ) ) { 

	function zozo_secondary_sidebar_classes() {	
	
		global $zozo_options, $post;
		$layout = $home_id = '';
		
		if( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );			
		}
		
		if( is_archive() ) {
			$layout = $zozo_options['zozo_blog_archive_layout'];
		}
		
		if( is_home() ) {
			$home_id = get_option( 'page_for_posts' );
			$layout = get_post_meta( $home_id, 'zozo_layout', true );
			if( !$layout ) {
				$layout = $zozo_options['zozo_blog_layout'];
			}
		}
		
		if ( is_singular( 'post' ) ) {
			$layout = get_post_meta( $post->ID, 'zozo_layout', true );
			if( !$layout ) {
				$layout = $zozo_options['zozo_single_post_layout'];
			}			
		}
		
		if( !$layout ) {			
			if( $zozo_options['zozo_layout'] != '' ) {		
				$layout = $zozo_options['zozo_layout'];
			}
			else {
				$layout = 'two-col-right';
			}
		}
		
		if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' ) {
			echo 'sec-sidebar';
		}				
	}	
}

/**
 * Footer Widget Columns and Classes based on footer type
 */
if ( ! function_exists( 'footer_widget_column_classes' ) ) { 

	function footer_widget_column_classes( $column = 'no', $class = 'yes' ) {	
	
		global $zozo_options;
		
		$footer_type = $zozo_options['zozo_footer_type'];
		
		$columns = '';
		$classes = array();
		
		switch( $footer_type ) {
			case 'footer-1':
				$columns = 4;
				$classes[1] = 'col-md-3 col-sm-6 col-xs-12';
				$classes[2] = 'col-md-3 col-sm-6 col-xs-12';
				$classes[3] = 'col-md-3 col-sm-6 col-xs-12';
				$classes[4] = 'col-md-3 col-sm-6 col-xs-12';
				break;
			case 'footer-2':
				$columns = 3;
				$classes[1] = 'col-sm-4 col-xs-12';
				$classes[2] = 'col-sm-4 col-xs-12';
				$classes[3] = 'col-sm-4 col-xs-12';
				break;
			case 'footer-3':
				$columns = 3;
				$classes[1] = 'col-sm-3 col-xs-12';
				$classes[2] = 'col-sm-6 col-xs-12';
				$classes[3] = 'col-sm-3 col-xs-12';
				break;
			case 'footer-4':
				$columns = 2;
				$classes[1] = 'col-sm-6 col-xs-12';
				$classes[2] = 'col-sm-6 col-xs-12';
				break;
			case 'footer-5':
				$columns = 2;
				$classes[1] = 'col-sm-9 col-xs-12';
				$classes[2] = 'col-sm-3 col-xs-12';
				break;
			case 'footer-6':
				$columns = 2;
				$classes[1] = 'col-sm-3 col-xs-12';
				$classes[2] = 'col-sm-9 col-xs-12';
				break;
			case 'footer-7':
				$columns = 1;
				$classes[1] = 'col-xs-12';
				break;
		}
		
		if( $column == 'yes' && $class == 'no' ) {
			return $columns;
		} elseif( $column == 'no' && $class == 'yes' ) {
			return $classes;
		} else {
			return array( $columns, $classes );
		}
				
	}
}


/* =========================================================
 * Display Social Icons
 * ========================================================= */
 
if ( ! function_exists( 'zozo_display_social_icons' ) ) { 

	function zozo_display_social_icons( $type = '' ) {	
	
		global $zozo_options;
		
		$output = '';
		$social_links = array();
		
		if( $type == '' ) {
			$type = $zozo_options['zozo_social_icon_type'];
		}
		
		if( isset( $zozo_options['zozo_facebook_link'] ) && $zozo_options['zozo_facebook_link'] ) {
			$social_links['facebook'] = $zozo_options['zozo_facebook_link'];
		}
		
		if( isset( $zozo_options['zozo_twitter_link'] ) && $zozo_options['zozo_twitter_link'] ) {
			$social_links['twitter'] = $zozo_options['zozo_twitter_link'];
		}
		
		if( isset( $zozo_options['zozo_linkedin_link'] ) && $zozo_options['zozo_linkedin_link'] ) {
			$social_links['linkedin'] = $zozo_options['zozo_linkedin_link'];
		}
		
		if( isset( $zozo_options['zozo_pinterest_link'] ) && $zozo_options['zozo_pinterest_link'] ) {
			$social_links['pinterest'] = $zozo_options['zozo_pinterest_link'];
		}
		
		if( isset( $zozo_options['zozo_youtube_link'] ) && $zozo_options['zozo_youtube_link'] ) {
			$social_links['youtube'] = $zozo_options['zozo_youtube_link'];
		}
		
		if( isset( $zozo_options['zozo_rss_link'] ) && $zozo_options['zozo_rss_link'] ) {
			$social_links['rss'] = $zozo_options['zozo_rss_link'];
		}
		
		if( isset( $zozo_options['zozo_tumblr_link'] ) && $zozo_options['zozo_tumblr_link'] ) {
			$social_links['tumblr'] = $zozo_options['zozo_tumblr_link'];
		}
		
		if( isset( $zozo_options['zozo_reddit_link'] ) && $zozo_options['zozo_reddit_link'] ) {
			$social_links['reddit'] = $zozo_options['zozo_reddit_link'];
		}
		
		if( isset( $zozo_options['zozo_dribbble_link'] ) && $zozo_options['zozo_dribbble_link'] ) {
			$social_links['dribbble'] = $zozo_options['zozo_dribbble_link'];
		}
		
		if( isset( $zozo_options['zozo_digg_link'] ) && $zozo_options['zozo_digg_link'] ) {
			$social_links['digg'] = $zozo_options['zozo_digg_link'];
		}
		
		if( isset( $zozo_options['zozo_flickr_link'] ) && $zozo_options['zozo_flickr_link'] ) {
			$social_links['flickr'] = $zozo_options['zozo_flickr_link'];
		}
		
		if( isset( $zozo_options['zozo_instagram_link'] ) && $zozo_options['zozo_instagram_link'] ) {
			$social_links['instagram'] = $zozo_options['zozo_instagram_link'];
		}
		
		if( isset( $zozo_options['zozo_vimeo_link'] ) && $zozo_options['zozo_vimeo_link'] ) {
			$social_links['vimeo'] = $zozo_options['zozo_vimeo_link'];
		}
		
		if( isset( $zozo_options['zozo_skype_link'] ) && $zozo_options['zozo_skype_link'] ) {
			$social_links['skype'] = $zozo_options['zozo_skype_link'];
		}
		
		if( isset( $zozo_options['zozo_blogger_link'] ) && $zozo_options['zozo_blogger_link'] ) {
			$social_links['blogger'] = $zozo_options['zozo_blogger_link'];
		}
		
		if( isset( $zozo_options['zozo_yahoo_link'] ) && $zozo_options['zozo_yahoo_link'] ) {
			$social_links['yahoo'] = $zozo_options['zozo_yahoo_link'];
		}
		
		$icon_class = '';
		$li_html = '';
		
		$target = isset( $zozo_options['zozo_social_icon_window'] ) ? $zozo_options['zozo_social_icon_window'] : '_blank';
		
		if( isset( $social_links ) && is_array( $social_links ) ) {
			foreach( $social_links as $icon => $link ) {
				$icon_class = $icon;
				
				if( $icon == 'vimeo' ) {
					$icon = 'flaticon flaticon-social140';
				} elseif( $icon == 'blogger' ) {
					$icon = 'flaticon flaticon-blogger8';
				} else {
					$icon = 'fa fa-' . $icon;
				}
				
				$li_html .= '<li class="'.esc_attr( $icon_class ).'"><a target="'. esc_attr( $target ) .'" href="'. $link .'"><i class="'.esc_attr( $icon ).'"></i></a></li>';
			}
		}
		
		if( isset( $li_html ) && $li_html != '' ) {
			$output = '<ul class="zozo-social-icons soc-icon-'.$type.'">';
			$output .= $li_html;
			$output .= '</ul>';
		}
				
		return $output;
	}	
} 

/* =========================================================
 * Get Post Gallery Images in Slider
 * ========================================================= */

function get_gallery_post_images($size, $id) {

	if( !$size ) 
		$size = 'full';
	
	if($images = get_posts(array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
		'orderby'        => 'title',
		'order' 		 => 'ASC',
	))) {
		foreach($images as $image) {
		
			$posts_image   = wp_get_attachment_image($image->ID,$size);
			
			$posts_image_link = wp_get_attachment_image_src($image->ID, 'full');
			
			echo '<div class="blog-gallery-item"><a href="'.esc_url($posts_image_link[0]).'" data-rel="prettyPhoto[gallery'.esc_attr( $id ).']">' . $posts_image . '</a></div>';

		}
	}
}

/* =========================================================
 * Display Social Sharing Icons in Blog Posts
 * ========================================================= */
 
if ( ! function_exists( 'zozo_display_social_sharing_icons' ) ) { 

	function zozo_display_social_sharing_icons() {	
	
		global $zozo_options, $post;
		
		$output = '';
				
		if( $zozo_options['zozo_sharing_facebook'] ) {
			$output .= '<li class="facebook"><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u='.urlencode(get_permalink()).'" title="facebook"><i class="fa fa-facebook"></i></a></li>';
		}		
		
		if( $zozo_options['zozo_sharing_twitter'] ) {
			$output .= '<li class="twitter"><a target="_blank" href="https://twitter.com/home?status='.urlencode($post->post_title). '%20-%20' . urlencode(get_permalink()).'" title="twitter"><i class="fa fa-twitter"></i></a></li>';
		}
		
		if( $zozo_options['zozo_sharing_linkedin'] ) {
			$output .= '<li class="linkedin"><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'"><i class="fa fa-linkedin"></i></a></li>';
		}
		
		if( $zozo_options['zozo_sharing_pinterest'] ) {
			$share_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
			$output .= '<li class="pinterest"><a target="_blank" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&amp;description='.urlencode($post->post_title).'&amp;media='.urlencode($share_image[0]).'"><i class="fa fa-pinterest"></i></a></li>';
		}
		
		if( $zozo_options['zozo_sharing_tumblr'] ) {
			if( has_post_format('quote') ) {
				$output .= '<li class="tumblr"><a target="_blank" href="http://www.tumblr.com/share/quote?quote='.urlencode(get_the_content()).'&amp;source='.urlencode($post->post_title).'"><i class="fa fa-tumblr"></i></a></li>';
			}
			else {
				$output .= '<li class="tumblr"><a target="_blank" href="http://www.tumblr.com/share/link?url='.urlencode(get_permalink()).'&amp;name='.urlencode($post->post_title).'&amp;description='.urlencode(get_the_excerpt()).'"><i class="fa fa-tumblr"></i></a></li>';
			}
		}
		
		if( $zozo_options['zozo_sharing_reddit'] ) {
			$output .= '<li class="reddit"><a target="_blank" href="http://reddit.com/submit?url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'"><i class="fa fa-reddit"></i></a></li>';
		}
		
		if( $zozo_options['zozo_sharing_digg'] ) {
			$output .= '<li class="digg"><a target="_blank" href="http://digg.com/submit?url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'"><i class="fa fa-digg"></i></a></li>';
		}
		
		if( $zozo_options['zozo_sharing_email'] ) {
			$output .= '<li class="email"><a target="_blank" href="mailto:?subject='.urlencode(get_the_title()).'&amp;body='.urlencode(get_permalink()).'"><i class="fa fa-envelope"></i></a></li>';
		}
		
		if( isset ( $output ) && $output != '' ) {
			echo '<div class="zozo-social-share-box"><ul class="zozo-social-share-icons share-box">';
			echo wp_kses_post( $output );
			echo '</ul></div>';
		}
	}	
}

/* =========================================================
 * Display Pagination on Archive/Category and Index Pages
 * ========================================================= */
 
if ( ! function_exists( 'zozo_pagination' ) ) { 

	function zozo_pagination( $pages = '', $scroll = '', $paged = '' ) {
		
		global $zozo_options, $wp_query, $wp_rewrite;
		
		$output = '';
				
		$extra_class = '';
		if( $scroll == "infinite" ) {
			$extra_class = ' infinite-scroll';
		} else {
			$extra_class = ' scroll-pagination';
		}
		
		$pages = ($pages) ? $pages : $wp_query->max_num_pages;

		// Don't print empty markup if there's only one page.
		if ( $pages < 2 ) {
			return;
		}

		//$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		if( $paged == '' ) {
			$paged 		= get_query_var( 'paged' ) ? get_query_var( 'paged' ) : (isset($wp_query->query['paged']) ? $wp_query->query['paged'] : 1);
		}
		
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );
	
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
	
		$pagenum_link = esc_url ( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
	
		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';
		
		// Arrows with RTL support
		$enable_rtl_mode = $zozo_options['zozo_enable_rtl_mode'];
		$isRTL = 0;
		if( is_rtl() || ( isset( $enable_rtl_mode ) && $enable_rtl_mode == 1 ) || isset( $_GET['RTL'] ) ) {
			$isRTL = 1;
		}
		
		$prev_arrow = $isRTL ? 'fa fa-angle-right' : 'fa fa-angle-left';
		$next_arrow = $isRTL ? 'fa fa-angle-left' : 'fa fa-angle-right';
		
		// Set up paginated links.
		$links = paginate_links( array(
			'base'     				=> $pagenum_link,
			'format'   				=> $format,
			'total'    				=> $pages,
			'current'  				=> $paged,
			'show_all' 				=> false,
			'mid_size' 				=> 1,
			'type' 					=> 'array',
			'add_args'           	=> false,
			'prev_text' 			=> '<i class="'. $prev_arrow .'"></i>',
			'next_text' 			=> '<i class="'. $next_arrow .'"></i>',
		) );

		if ( !empty($links) ) {
			$output .= '<ul class="pagination' . esc_attr( $extra_class ) . '">';
			foreach( $links as $link ) {
				$output .= '<li>'.$link.'</li>';
			}
			$output .= '</ul>';
		}
				
		return $output; 
	}
}

/* =========================================================
 * Display Post Navigation on Single Posts
 * ========================================================= */

if( ! function_exists( 'zozo_postnavigation' ) ) {
	function zozo_postnavigation() { 
		if ( is_single() ) { 
		?>
	        <div class="post-navigation">
				<ul class="pager">
					<li class="previous"><?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i> %title' ) ?></li>
					<li class="next"><?php next_post_link( '%link', '%title <i class="fa fa-angle-right"></i>' ) ?></li>
				</ul>	            
	        </div>	
		<?php 
		}
	}                	
}

/* =========================================================
 * Display Comments in different Layout
 * ========================================================= */
 
if( ! function_exists( "zozo_custom_comments" ) ) {

	function zozo_custom_comments( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">	    		      	
	      	<div id="li-comment-<?php comment_ID() ?>" class="comment-container">
				
				<div class="comment-avatar">
					<?php echo get_avatar($comment, $args['avatar_size']); ?>
				</div>

				<div class="comment-status-text" id="comment-<?php comment_ID(); ?>">
					<?php comment_text() ?>
					<?php if ($comment->comment_approved == '0') { ?>
						<p class='comment-unapproved'><?php esc_html_e('Your comment is awaiting moderation.', 'mist'); ?></p>
					<?php } ?>
					<div class="comments-box">
						<div class="comment-list meta">
							<span class="author-name"><i class="fa fa-user"></i> <?php echo get_comment_author_link() ?></span>
							<span class="date"><i class="fa fa-calendar"></i><?php printf(__('%1$s', 'mist'), get_comment_date( 'd.m.Y' ) ) ?></span>								
						</div>
					</div><!-- .comments-box -->
					<div class="reply">
						<span class="edit"><i class="fa fa-edit"></i><?php edit_comment_link( esc_html__('Edit', 'mist'), '', ''); ?></span>	
						<span class="reply-link"><i class="fa fa-comments"></i><?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('Reply', 'mist'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
					</div>
				</div><!-- .comment-status-text -->

			</div><!-- .comment-container -->
			
	<?php 
	}	
}

/* =========================================================
 * Display Author Info on Single Post pages
 * ========================================================= */
 
if( ! function_exists( "zozo_author_info" ) ) {

	function zozo_author_info() { 
		if( is_author() ) {
		
			$author_id = get_the_author_meta('ID');
			$author_name = get_the_author_meta('display_name', $author_id);			
			$author_description  = get_the_author_meta('description', $author_id); ?>
			
			<div class="author-info-page">
				<div class="author-avatar">
					<?php echo get_avatar(get_the_author_meta('email', $author_id), '80'); ?>
				</div>
				<div class="author-title">
					<h4><?php esc_html_e('About', 'mist'); ?> <span class="author-name"><?php echo esc_html($author_name); ?></span></h4>
				</div>
			  	<div class="author-description">
					<p>
					<?php if( !$author_description ) {
						echo sprintf( esc_html__( 'This author %s has created %s entries.', 'mist' ), $author_name, count_user_posts( $author_id ) );
					} else {
						echo esc_html($author_description);
					} ?>
					</p>
				</div>
				<div class="author-links">						
					<div class="author-media-links zozo-social-share-box">
						<ul class="author-social zozo-social-share-icons clearfix">
							<?php $facebook_profile = get_the_author_meta( 'facebook_profile' );
								if( isset($facebook_profile) && $facebook_profile != '' ) {
									echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '" target="_blank" ><i class="fa fa-facebook"></i></a></li>';
								}
												
								$twitter_profile = get_the_author_meta( 'twitter_profile' );
								if( isset($twitter_profile) && $twitter_profile != '' ) {
									echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '" target="_blank" ><i class="fa fa-twitter"></i></a></li>';
								}
																					
								$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
								if( isset($linkedin_profile) && $linkedin_profile != '' ) {
									echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '" target="_blank" ><i class="fa fa-linkedin"></i></a></li>';
								}
								
								$mail = get_the_author_meta('email');
								if( isset($mail) && $mail != '' ) {
									echo '<li class="email"><a href="mailto:' . esc_url($mail). '" rel="author" target="_blank"><i class="fa fa-envelope"></i></a></li>';
								}
							?>
						</ul>
					</div>
				</div>					
			</div>
		<?php }	else { ?>
			<div class="author-info clearfix">				
				<div class="author-info-container">
					<div class="author-avatar">
						<?php echo get_avatar(get_the_author_meta('email'), '80'); ?>
					</div>
					<div class="author-title">						
						<h4 class="author-name"><?php the_author_posts_link(); ?></h4>
					</div>
					<div class="author-description">
						<p><?php the_author_meta("description"); ?></p>
					</div>
				</div>
			</div>
		<?php }
	}	
}

/* =========================================================
 * Register Additional Image field For Post Categories
 * ========================================================= */

if ( ! function_exists( 'zozo_category_taxonomy_add_meta_fields' ) ) {
	function zozo_category_taxonomy_add_meta_fields() {	?>	
		<div class="form-field">
			<label for="zozo_cat_thumbnail_image"><?php esc_html_e( 'Category Image', 'mist' ); ?></label>
			<div class="zozo_cat_img_field">				
				<input type="text" class="media_field" id="zozo_cat_thumbnail_image" name="zozo_cat_thumbnail_image" value="" />
				<button type="button" class="zozo_img_upload_button btn"><?php esc_html_e( 'Upload/Add image', 'mist' ); ?></button>
				<button type="button" class="zozo_img_remove_button btn"><?php esc_html_e( 'Remove image', 'mist' ); ?></button>
			</div>					
			<p class="description"><?php esc_html_e( 'Select an image to list categories with images', 'mist' ); ?></p>
			<?php wp_enqueue_media(); ?>
			<script type="text/javascript">

				// Only show remove button when needed
				if ( ! jQuery('#zozo_cat_thumbnail_image').val() ) {
					 jQuery('.zozo_img_remove_button').hide();
				}

				// Uploading files
				var file_frame;

				jQuery(document).on( 'click', '.zozo_img_upload_button', function( event ){

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}
					
					// Create the media frame.
					file_frame = wp.media.frames.file_frame = wp.media({
						title: '<?php esc_html_e( 'Select image', 'mist' ); ?>',
						button: {
							text: '<?php esc_html_e( 'Upload image', 'mist' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						attachment = file_frame.state().get('selection').first().toJSON();
						
						jQuery('#zozo_cat_thumbnail_image').val( attachment.url );
						jQuery('.zozo_img_remove_button').show();
					});
					
					// Finally, open the modal.
					if( file_frame ) {
						file_frame.open();
					}
					
				});

				jQuery(document).on( 'click', '.zozo_img_remove_button', function( event ){					
					jQuery(this).parent('.zozo_cat_img_field').find('#zozo_cat_thumbnail_image').attr('value', '');
					jQuery(this).parent('.zozo_cat_img_field').find('.zozo_img_remove_button').hide();
					return false;
				});
			</script>
		</div>		
	<?php
	}
}
add_action( 'category_add_form_fields', 'zozo_category_taxonomy_add_meta_fields', 10, 2 );

if ( ! function_exists( 'zozo_category_taxonomy_edit_meta_fields' ) ) {
	function zozo_category_taxonomy_edit_meta_fields($term) {
	 
		// put the term ID into a variable
		$term_id = $term->term_id;
	 
		// retrieve the existing value(s) for this meta field. This returns an array
		$term_meta = get_option( "taxonomy_$term_id" ); ?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="zozo_cat_thumbnail_image"><?php esc_html_e( 'Category Image', 'mist' ); ?></label></th>
			<td>
				<div class="zozo_cat_img_field">				
					<input type="text" class="media_field" id="zozo_cat_thumbnail_image" name="zozo_cat_thumbnail_image" value="<?php echo esc_url($term_meta['zozo_thumbnail_image']); ?>" />
					<button type="button" class="zozo_img_upload_button btn"><?php esc_html_e( 'Upload/Add image', 'mist' ); ?></button>
					<button type="button" class="zozo_img_remove_button btn"><?php esc_html_e( 'Remove image', 'mist' ); ?></button>
				</div>					
				<p class="description"><?php _e( 'Select an image to list categories with images', 'mist' ); ?></p>
				<?php wp_enqueue_media(); ?>
				<script type="text/javascript">

					// Only show remove button when needed
					if ( ! jQuery('#zozo_cat_thumbnail_image').val() ) {
						 jQuery('.zozo_img_remove_button').hide();
					}
	
					// Uploading files
					var file_frame;
	
					jQuery(document).on( 'click', '.zozo_img_upload_button', function( event ){
	
						event.preventDefault();
	
						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}
						
						// Create the media frame.
						file_frame = wp.media.frames.file_frame = wp.media({
							title: '<?php esc_html_e( 'Select image', 'mist' ); ?>',
							button: {
								text: '<?php esc_html_e( 'Upload image', 'mist' ); ?>',
							},						
							multiple: false
						});
	
						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							attachment = file_frame.state().get('selection').first().toJSON();
							
							jQuery('#zozo_cat_thumbnail_image').val( attachment.url );
							jQuery('.zozo_img_remove_button').show();
						});
						
						// Finally, open the modal.
						if( file_frame ) {
							file_frame.open();
						}
						
					});
					
					jQuery(document).on( 'click', '.zozo_img_remove_button', function( event ){					
						jQuery(this).parent('.zozo_cat_img_field').find('#zozo_cat_thumbnail_image').attr('value', '');
						jQuery(this).parent('.zozo_cat_img_field').find('.zozo_img_remove_button').hide();
						return false;
					});
				</script>
			</td>
		</tr>	
	<?php
	}
}
add_action( 'category_edit_form_fields', 'zozo_category_taxonomy_edit_meta_fields', 10, 2 );

if ( ! function_exists( 'zozo_save_category_taxonomy_custom_meta' ) ) {
	function zozo_save_category_taxonomy_custom_meta( $term_id ) {
	
		if( isset( $_POST['zozo_cat_thumbnail_image'] ) ) {
			$zozo_term_id = $term_id;
			$term_meta = '';
			$term_meta = get_option( "taxonomy_$zozo_term_id" );
			if( isset( $term_meta ) && $term_meta == '' ) {
				$term_meta = array();
			}
			$term_meta['zozo_thumbnail_image'] = $_POST['zozo_cat_thumbnail_image'];
			
			// Save the option array.
			update_option( "taxonomy_$zozo_term_id", $term_meta );
		}
		
	}
}
add_action( 'edited_category', 'zozo_save_category_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_category', 'zozo_save_category_taxonomy_custom_meta', 10, 2 );

/* =========================================================
 * Get FontAwesome Icons Array
 * ========================================================= */
if ( ! function_exists( 'zozo_get_fontawesome_icon_array' ) ) {
	function zozo_get_fontawesome_icon_array() {
	
		$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$fontawesome_path = ZOZOTHEME_URL . '/css/font-awesome.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($fontawesome_path) );
	
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$icons = array();
		
		foreach($matches as $match){
			$icons[$match[1]] = $match[2];
		}
		
		return $icons;
		
	}
}

/* =========================================================
 * Get Glyphicons Array
 * ========================================================= */
if ( ! function_exists( 'zozo_get_glyphicons_array' ) ) {
	function zozo_get_glyphicons_array() {
	
		$pattern = '/\.(glyphicon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$glyphicon_path = ZOZOTHEME_URL . '/css/bootstrap.css';
		$subject = wp_remote_retrieve_body( wp_remote_get($glyphicon_path) );
		
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		
		$icons = array();
		
		foreach($matches as $match){
			$icons[$match[1]] = $match[2];
		}
		
		return $icons;
		
	}
}

/* =========================================================
 * Get Taxonomies List array for any post type
 * ========================================================= */
if ( ! function_exists( 'zozo_get_taxonomy_terms_array' ) ) {
	function zozo_get_taxonomy_terms_array($taxonomy, $post_type, $msg) {
	
		$list_groups = get_categories('taxonomy='.$taxonomy.'&post_type='.$post_type.'');
		$groups_list[0] = $msg;
		if( !empty($list_groups) ) {
			foreach ($list_groups as $groups) {
				$group_name = $groups->name;
				$termid = $groups->term_id;		
				$groups_list[$termid] = $group_name;
			}
		}
	
		if( isset($groups_list) ) {
			return $groups_list;
		}
		
	}
}

/* =========================================================
 * Update Post Views Count to find Popular Posts
 * ========================================================= */
if ( ! function_exists( 'zozo_set_post_views_count' ) ) {
	function zozo_set_post_views_count() {
		global $post;
	
		if('post' == get_post_type() && is_single()) {
			$post_id = $post->ID;
	
			if(!empty($post_id)) {
				$count_key = 'zozo_post_views_count';
				$count = get_post_meta($post_id, $count_key, true);

				if($count == '') {
					$count = 0;
					delete_post_meta($post_id, $count_key);
					add_post_meta($post_id, $count_key, '0');
				} else {
					$count++;
					update_post_meta($post_id, $count_key, $count);
				}
			}
		}
	}
}
add_action('wp_head', 'zozo_set_post_views_count');

/* ==================================================================
 * Add Current Category Class to Categories List on Single Post
 * ================================================================== */
if ( ! function_exists( 'zozo_current_cat_on_single_posts' ) ) {

	function zozo_current_cat_on_single_posts($output) {
		global $post;
		
		if(is_single()) {
			$categories = wp_get_post_categories($post->ID);			
			if($categories) { 
				foreach($categories as $value) {
					if(preg_match('#item-' . $value . '">#', $output)) {
						$output = str_replace('item-' . $value . '">', 'item-' . $value . ' current-cat">', $output);
					}
				}
			}
		}
		return $output;
	}
	
}
add_filter('wp_list_categories', 'zozo_current_cat_on_single_posts');


/* =========================================================
 * Get current ID
 * ========================================================= */ 

function zozo_get_the_id() {

	// If singular get_the_ID
	if ( is_singular() ) {
		return get_the_ID();
	}
	elseif ( is_post_type_archive( 'product' ) && class_exists( 'Woocommerce' ) && function_exists( 'wc_get_page_id' ) ) {
		$shop_id = wc_get_page_id( 'shop' );
		if ( isset( $shop_id ) ) {
			return wc_get_page_id( 'shop' );
		}
	}
	// Posts page
	elseif( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
		return $page_for_posts;
	}
	else {
		return NULL;
	}
	
}

/* =========================================================
 * Get RGB values from Hexadecimal
 * ========================================================= */ 
 
function zozo_hex2rgb($hex) {

   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   
   $rgb = array($r, $g, $b);
   
   return $rgb;
}

/* =========================================================
 * Lightens/darkens a given colour (hex format)
 * $percent ( 0.4 = lighten by 40%, -0.4 = darken by 40% )
 * ========================================================= */
 
function zozo_color_luminance( $hex, $percent ) {
	
	// validate hex string
	$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';

	if( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
	}

	// convert to decimal and change luminosity
	for( $i = 0; $i < 3; $i++ ) {
		$dec = hexdec( substr( $hex, $i*2, 2 ) );
		$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
		$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
	}		

	return $new_hex;
}

/* ==================================================================
 * Parallax Menu Links Creation
 * ================================================================== */
if ( ! function_exists( 'zozo_get_parallax_link' ) ) {

	function zozo_get_parallax_link( $item ) {
		global $wp_query;
			
		$post_data = $link = $item_object_id = '';
	   
		// Front and Blog page
		$blog_page_id 	= get_option('page_for_posts');
		$front_page_id 	= get_option('page_on_front');
		
		// Get URL
		if( !is_page_template( 'template-parallax-page' ) ) {
			$blog_url = esc_url( home_url() ) . '/';
		} else {
			$blog_url = '';
		}
		
		$front_url   = is_front_page() ? esc_url( $blog_url ) . '#section-top' : esc_url( home_url() ) . '/' ;
		
		if ( !empty( $item->object_id ) ) {
			$post_data = get_post($item->object_id);
			$item_object_id = $item->object_id;
		}
		
		$slug = ( isset($post_data->post_name) ) ? $post_data->post_name : '';
		
		// Regular link for blog - all other menu items are anchors
		if( $blog_page_id == $item_object_id || $item->zozo_megamenu_menutype == 'page' ) {
			
			$link = ! empty( $item->url ) ? esc_attr( $item->url ) : '';
			
		} 
		// Regular link for the front page or an anchors
		elseif( $front_page_id == $item_object_id ) {
			
			// Front page
			if( is_front_page() ) {				
				$link = ! empty( $item->url ) ? esc_url( $blog_url ) . '#section-top' : '';
			} else {
				// Regular link
				$link = ! empty( $item->url ) ? esc_attr( $item->url ) : '';				
				
			}
			
		} else {
			if( $item->zozo_megamenu_menutype == 'section' ) {
				$link = ! empty( $slug ) ? esc_url( $blog_url ) . '#section-' . esc_attr( $slug ) : '';
			} else {
				$link = ! empty( $item->url ) ? esc_attr( $item->url ) : '';
			}
		}
		
		return $link;
		
	}
	
}

/* ==================================================================
 * Parallax Custom Query
 * ================================================================== */
if ( ! function_exists( 'zozo_parallax_front_query' ) ) {

	function zozo_parallax_front_query() {
	
		$pages_query = array();
		
		$zozo_menu_items = '';
			
		// Check for primary navigation
		if( has_nav_menu( 'primary-menu' ) ) {
			
			// Primary navigation ID
			$zozo_menu_theme_locations = get_nav_menu_locations();
			$zozo_menu_objects = get_term( $zozo_menu_theme_locations['primary-menu'] , 'nav_menu' );
			$zozo_menu_id = $zozo_menu_objects->term_id;
		
			$menu_args = array(
				'orderby' => 'menu_order'
			);
			
			$zozo_menu_items = wp_get_nav_menu_items( $zozo_menu_id , $menu_args );			
				
			// Create array of query for query_posts()
			foreach( (array) $zozo_menu_items as $key => $zozo_menu_item ) {
				
				$blog_page_id = get_option('page_for_posts');
				$front_page_id = get_option('page_on_front');
	
				if( $zozo_menu_item->zozo_megamenu_menutype == 'section' && $blog_page_id != $zozo_menu_item->object_id ) {						
					$pages_query[] = $zozo_menu_item->object_id;					
				}
				
			}
				
			// Return query
			if( !empty( $pages_query ) ) {
					
				// Query Args
				$zozo_query = array(						
						'post_type' 		=> 'page',
						'post__in' 			=> $pages_query,
						'posts_per_page' 	=> count($pages_query),
						'orderby'			=> 'post__in'				
				);
				
				return $zozo_query;

			} else {			
				return array();				
			}				
		}
	
	}
}

/* ==================================================================
 * Parallax Additional Sections Query
 * ================================================================== */
if ( ! function_exists( 'zozo_parallax_additional_query' ) ) {

	function zozo_parallax_additional_query( $ids ) {
	
		$additional_query = array();
		
		$query_ids = explode(',', $ids);
				
		// Create array of query for WP_Query()
		foreach( (array) $query_ids as $id => $value ) {
			
			$blog_page_id = get_option('page_for_posts');
			$front_page_id = get_option('page_on_front');
	
			if( $blog_page_id != $value && $front_page_id != $value ) {
				$additional_query[] = $value;
			}
			
		}
				
		// Return query
		if( !empty( $additional_query ) ) {
				
			// Query Args
			$zozo_additional_query = array(						
					'post_type' 		=> 'page',
					'post__in' 			=> $additional_query,
					'posts_per_page' 	=> count($additional_query),
					'orderby'			=> 'post__in'				
			);
			
			return $zozo_additional_query;

		} else {			
			return array();				
		}
	
	}
}

/* =============================================================
 *	Mailchimp Functions
 * ============================================================= */

// Calls the MailChimp API	
function call_api( $method, array $data = array() ) {	
	
	global $zozo_options;

	if( isset( $zozo_options['zozo_mailchimp_api'] ) && $zozo_options['zozo_mailchimp_api'] != '' ) {
		$data['apikey'] = $zozo_options['zozo_mailchimp_api'];
	}
	
	// If api key is empty do not make request
	if( empty( $data['apikey'] ) ) { 
		return false; 
	}
	
	$get_key = explode( '-', $data['apikey'] );
	
	// Store Api URL
	if( strpos( $data['apikey'], '-' ) !== false ) {
		$api_url = 'https://' . $get_key[1] . '.api.mailchimp.com/2.0/';
	}
	
	$url = $api_url . $method . '.json';

	$response = wp_remote_post( $url, array(
		'body' => $data,
		'timeout' => 15,
		'headers' => array('Accept-Encoding' => ''),
		'sslverify' => false
		)
	);	
	
	$body = wp_remote_retrieve_body( $response );
	return json_decode( $body );
}

// Gets the lists for the current API Key
function get_mailing_lists() {
	
	$args = array(
		'limit' => 20
	);	
	
	// Pings the MailChimp API
	$connection_result = call_api( 'helper/ping' );

	if( $connection_result !== false ) {
		if( isset( $connection_result->msg ) && $connection_result->msg === "Everything's Chimpy!" ) {
		} elseif( isset( $connection_result->error ) ) {
			//echo "MailChimp Error: " . $connection_result->error;
		}
	} 
	
	// Get Lists from MailChimp for Current API
	$result = call_api( 'lists/list', $args );

	if( is_object( $result ) && isset( $result->data ) ) {
		return $result->data;
	}

	return false;
}

// Gets formated mailing lists in an array
function get_mailing_lists_format() {

	global $zozo_options;
	
	$new_key = $old_mc_api_key = '';

	if( isset( $zozo_options['zozo_mailchimp_api'] ) && $zozo_options['zozo_mailchimp_api'] != '' ) {
		$new_key = $zozo_options['zozo_mailchimp_api'];
	}
	
	$old_mc_api_key  = get_transient( 'zozo_mailchimp_api_key_feed' );
	
	if( $old_mc_api_key != $new_key ) {
		// store api key in transients
		delete_transient( 'zozo_mailchimp_api_key_feed' );
		set_transient( 'zozo_mailchimp_api_key_feed', $new_key, ( 24 * 3600 ) );
		delete_transient( 'zozo_mailchimp_lists' );
	}
	
	$cached_mc_lists = get_transient( 'zozo_mailchimp_lists' );
	
	if( false === $cached_mc_lists || empty( $cached_mc_lists ) ) {
		$get_lists = get_mailing_lists();
		
		if( is_array( $get_lists ) ) {

			$lists = array();
			foreach( $get_lists as $list ) {	
				$lists["{$list->id}"] = (object) array(
					'id' => $list->id,
					'name' => $list->name								
				);
			}
			// store lists in transients
			set_transient( 'zozo_mailchimp_lists', $lists, ( 24 * 3600 ) ); // 1 day
		}
	} else {
		$lists = get_transient( 'zozo_mailchimp_lists' );		
	}
	
	$mailist = array();
	if( !empty( $lists ) ) {
		foreach( $lists as $list ) {
			$name = $list->name;
			$id = $list->id;		
			$mailist[$name] = $id;
		}
	}
	
	if( isset($mailist) ) {
		return $mailist;
	}

	return false;
}

// Get Wordpress Current Page URL
function zozo_get_current_url() {
	global $wp;
	$url = home_url( $wp->request );
	
	$qry_str = '';
	if( function_exists('mist_get_server_details') ) $qry_str = mist_get_server_details('REQUEST_URI');

	if( substr( $qry_str, -1 ) === '/' ) {
		$url = trailingslashit( $url );
	}

	return esc_url( $url );
}

// Sends subscription request to the MailChimp API
function mc_subscribeformat( $email, $merge_vars, $mc_list_id ) {		
			
	$subscribe_result = mc_subscribe( $mc_list_id, $email, $merge_vars, 'html', true );
	
	return $subscribe_result;
	
}

function mc_subscribe( $list_id, $email, array $merge_vars = array(), $email_type = 'html', $double_optin = true, $update_existing = false, $replace_interests = true, $send_welcome = false )	{
	
	$data = array(
		'id' => $list_id,
		'email' => array( 'email' => $email ),
		'merge_vars' => $merge_vars,
		'email_type' => $email_type,
		'double_optin' => $double_optin,
		'update_existing' => $update_existing,
		'replace_interests' => $replace_interests,
		'send_welcome' => $send_welcome
	);

	$result = call_api( 'lists/subscribe', $data );

	if( is_object( $result ) ) {

		if( ! isset( $result->error ) ) {
			return esc_html__('Success. You will receive confirmation email to subscribe into our mailing lists.', 'mist');
		} else {

			// Check subscription Error
			if( (int) $result->code === 214 ) {
				return esc_html__('Sorry. You already subscribed into our mailing lists', 'mist');
			} 
		
			// Get Error Message
			$error_message = $result->error;
			return esc_html__('Error. Please try again.', 'mist');
		}

	}

	return esc_html__('Error. Please try again.', 'mist');
}

/* =========================================================
 * Mailchimp Form Submit on AJAX
 * ========================================================= */

add_action('wp_ajax_zozo_mailchimp_subscribe', 'zozo_mailchimp_subscribe_user');
add_action('wp_ajax_nopriv_zozo_mailchimp_subscribe', 'zozo_mailchimp_subscribe_user');

if( ! function_exists( "zozo_mailchimp_subscribe_user" ) ) {

	function zozo_mailchimp_subscribe_user() {
	
		global $zozo_options;
	   		
		$mailing_list = '';
		$merge_vars = array();
		
		// Get Mailing List ID value from submitted form		
		$mailing_list = trim($_POST['zozo_mc_form_list']);
				
		// Get Email id from submitted form
		$email = trim($_POST['subscribe_email']);
		
		$list_result = mc_subscribeformat( $email, $merge_vars, $mailing_list );
		
		$msg_array = array( 'data' => $list_result );
		echo json_encode($msg_array);
		
		die();
	}
	
}

/* =============================================================
 *	Related Portfolio Slider
 * ============================================================= */ 

if( ! function_exists( 'zozo_related_portfolio_slider' ) ) {
	function zozo_related_portfolio_slider() {
	
		global $post, $zozo_options;
		
		$items = $items_scroll = $itemstablet = $itemsmobileland = $itemsmobile = $pagination = $navigation = $margin = $autoplay = $duration = $loop = '';
		
		if( isset( $zozo_options['zozo_portfolio_citems'] ) && $zozo_options['zozo_portfolio_citems'] != '' ) {
			$items = $zozo_options['zozo_portfolio_citems'];
		} else {
			$items = 3;
		}
		
		if( isset( $zozo_options['zozo_portfolio_citems_scroll'] ) && $zozo_options['zozo_portfolio_citems_scroll'] != '' ) {
			$items_scroll = $zozo_options['zozo_portfolio_citems_scroll'];
		} else {
			$items_scroll = 1;
		}
		
		if( isset( $zozo_options['zozo_portfolio_ctablet'] ) && $zozo_options['zozo_portfolio_ctablet'] != '' ) {
			$itemstablet = $zozo_options['zozo_portfolio_ctablet'];
		} else {
			$itemstablet = 2;
		}
		
		if( isset( $zozo_options['zozo_portfolio_cmobile_land'] ) && $zozo_options['zozo_portfolio_cmobile_land'] != '' ) {
			$itemsmobileland = $zozo_options['zozo_portfolio_cmobile_land'];
		} else {
			$itemsmobileland = 2;
		}
		
		if( isset( $zozo_options['zozo_portfolio_cmobile'] ) && $zozo_options['zozo_portfolio_cmobile'] != '' ) {
			$itemsmobile = $zozo_options['zozo_portfolio_cmobile'];
		} else {
			$itemsmobile = 1;
		}
		
		if( isset( $zozo_options['zozo_portfolio_cpagination'] ) && $zozo_options['zozo_portfolio_cpagination'] == 1 ) {
			$pagination = "true";
		} else {
			$pagination = "false";
		}
		
		if( isset( $zozo_options['zozo_portfolio_cnavigation'] ) && $zozo_options['zozo_portfolio_cnavigation'] == 1 ) {
			$navigation = "true";
		} else {
			$navigation = "false";
		}
		
		if( isset( $zozo_options['zozo_portfolio_cmargin'] ) && $zozo_options['zozo_portfolio_cmargin'] != '' ) {
			$margin = $zozo_options['zozo_portfolio_cmargin'];
		} else {
			$margin = 20;
		}
		
		if( isset( $zozo_options['zozo_portfolio_cautoplay'] ) && $zozo_options['zozo_portfolio_cautoplay'] == 1 ) {
			$autoplay = "true";
		} else {
			$autoplay = "false";
		}
		
		if( isset( $zozo_options['zozo_portfolio_ctimeout'] ) && $zozo_options['zozo_portfolio_ctimeout'] != '' ) {
			$duration = $zozo_options['zozo_portfolio_ctimeout'];
		} else {
			$duration = 5000;
		}
		
		if( isset( $zozo_options['zozo_portfolio_cloop'] ) && $zozo_options['zozo_portfolio_cloop'] == 1 ) {
			$loop = "true";
		} else {
			$loop = "false";
		}
		
		$data_attr = $image_size = '';
	
		if( isset( $items ) && $items == "1" ) {
			$image_size = 'full';
		} else {
			$image_size = 'portfolio-mid';
		}
		
		if( isset( $items ) && $items != '' ) {
			$data_attr .= ' data-items="' . $items . '" ';
		}
		
		if( isset( $items_scroll ) && $items_scroll != '' ) {
			$data_attr .= ' data-slideby="' . $items_scroll . '" ';
		}
		
		if( isset( $itemstablet ) && $itemstablet != '' ) {
			$data_attr .= ' data-items-tablet="' . $itemstablet . '" ';
		}
		
		if( isset( $itemsmobileland ) && $itemsmobileland != '' ) {
			$data_attr .= ' data-items-mobile-landscape="' . $itemsmobileland . '" ';
		}
		
		if( isset( $itemsmobile ) && $itemsmobile != '' ) {
			$data_attr .= ' data-items-mobile-portrait="' . $itemsmobile . '" ';
		}
		
		if( isset( $autoplay ) && $autoplay != '' ) {
			$data_attr .= ' data-autoplay="' . $autoplay . '" ';
		}
		if( isset( $duration ) && $duration != '' ) {
			$data_attr .= ' data-autoplay-timeout="' . $duration . '" ';
		}
		
		if( isset( $loop ) && $loop != '' ) {
			$data_attr .= ' data-loop="' . $loop . '" ';
		}
		
		if( isset( $margin ) && $margin != '' ) {
			$data_attr .= ' data-margin="' . $margin . '" ';
		}
		
		if( isset( $pagination ) && $pagination != '' ) {
			$data_attr .= ' data-pagination="' . $pagination . '" ';
		}
		if( isset( $navigation ) && $navigation != '' ) {
			$data_attr .= ' data-navigation="' . $navigation . '" ';
		}
		
		$item_cats = get_the_terms( $post->ID, 'portfolio_tags' );
		
		$item_array = array();
		if( $item_cats ) {
			foreach( $item_cats as $item_cat ) {
				$item_array[] = $item_cat->term_id;
			}
		}
		
		if( $item_cats ) {
		
			$args = array(
				'post__not_in'   	=> array($post->ID),
				'posts_per_page' 	=> -1,
				'post_type'  		=> 'zozo_portfolio',
				'orderby' 			=> 'date',
				'order' 		 	=> 'DESC',
				'tax_query' => array(
							array(
								'field' 	=> 'id',
								'taxonomy' 	=> 'portfolio_tags',
								'terms' 	=> $item_array,
							)
				)
		    );
						
			$portfolio_slider_query = new WP_Query($args);
			
			if( $portfolio_slider_query->have_posts() ) { ?>
				<div class="related-portfolio-slider-section">	
					<!-- ============ Section Header ============ -->
					<div class="zozo-parallax-header">
						<div class="parallax-header">
						<?php if( isset( $zozo_options['zozo_portfolio_related_title'] ) && $zozo_options['zozo_portfolio_related_title'] != '' ) { ?>
							<h4 class="parallax-title"><?php echo esc_html( $zozo_options['zozo_portfolio_related_title'] ); ?></h4>
						<?php } else { ?>
							<h4 class="parallax-title"><?php esc_html_e( 'Related Projects', 'mist'); ?></h4>
						<?php } ?>
						</div>
					</div>

					<?php echo '<div id="zozo-related-portfolio-slider" class="zozo-owl-carousel owl-carousel related-portfolio-carousel-slider"'.$data_attr.'>';
				
					while ($portfolio_slider_query->have_posts()) : $portfolio_slider_query->the_post();
						$portfolio_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $image_size); ?>
					
						<div id="portfolio-<?php the_ID(); ?>" class="portfolio-item portfolio-slider-item">
							<div class="portfolio-content">
								<img class="img-responsive" src="<?php echo esc_url($portfolio_img[0]); ?>" width="<?php echo esc_attr($portfolio_img[1]); ?>" height="<?php echo esc_attr($portfolio_img[2]); ?>" alt="<?php the_title(); ?>" />
								<div class="portfolio-overlay">
									<div class="portfolio-mask">
							
									<?php $portfolio_large = ''; 
									$portfolio_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
							
										<div class="portfolio-title">
											<h4><?php the_title(); ?></h4>
											<p><?php echo zozo_shortcode_stripped_excerpt( get_the_content(), 8 ); ?></p>
										</div>
										<a href="<?php echo esc_url( $portfolio_large[0] ); ?>" data-rel="prettyPhoto[relatedgallery]" title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>	
					</div>
				</div>
			<?php }	
		}	
	
		wp_reset_postdata();
		
	}
}

/* =============================================================
 *	Woocommerce Build Query String
 * ============================================================= */
if( ! function_exists('zozo_woo_build_query_string') ) {
	function zozo_woo_build_query_string($params = array(), $overwrite_key = '', $overwrite_value = '') {
		$params[$overwrite_key] = $overwrite_value;
		
		$paged = (array_key_exists('product_count', $params)) ? 'paged=1&' : '';
		
		return "?" . $paged . http_build_query($params);
	}
}

/* =============================================================
 *	HTML Allowed Tags for wp_kses
 * ============================================================= */
if( ! function_exists('zozo_expanded_allowed_tags') ) {
	function zozo_expanded_allowed_tags() {
		$allowed_tags = wp_kses_allowed_html( 'post' );
		
		// iframe
		$allowed_tags['iframe'] = array(
			'src' 					=> array(),
			'id' 					=> array(),
			'height' 				=> array(),
			'width' 				=> array(),
			'frameborder' 			=> array(),
			'allowFullScreen' 		=> array(),
			'webkitAllowFullScreen' => array(),
			'mozallowfullscreen' 	=> array(),
		);
		
		// style
		$allowed_tags['style'] = array(
			'type' => array(),
		);
		
		// link
		$allowed_tags['link'] = array(
			'type'  => array(),
			'href'  => array(),
			'rel'   => array(),
			'sizes' => array(),
		);
		
		// meta
		$allowed_tags['meta'] = array(
			'name'  	=> array(),
			'content'   => array(),			
		);
		
		// select
		$allowed_tags['select'] = array(
			'name'  	=> array(),
			'multiple'  => array(),
			'required'  => array(),
			'class' 	=> array(),	
			'size' 		=> array(),
		);
		
		// option
		$allowed_tags['option'] = array(
			'id'  		=> array(),
			'value'  	=> array(),
			'label'  	=> array(),
			'selected'  => array(),			
		);
		
		// input
		$allowed_tags['input'] = array(
			'type'  	=> array(),
			'id'  		=> array(),
			'class' 	=> array(),	
			'value' 	=> array(),
			'name'  	=> array(),
			'checked'   => array(),
			'readonly'  => array(),
		);
		 
		return $allowed_tags;
	}
}

/* =============================================================
 *	Remove Extra P Tags
 * ============================================================= */

if( ! function_exists( 'zozo_shortcodes_formatter' ) ) {
	function zozo_shortcodes_formatter( $content ) {
		$block = join( "|", array("zozo_vc_section_title", "zozo_vc_contact_form", "zozo_vc_contact_info", "zozo_vc_content_carousel", "zozo_vc_feature_box", "zozo_vc_list_item", "zozo_vc_pricing_table", "zozo_vc_service_box", "ultimate_heading") );
	
		// opening tag
		$shortcode = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
	
		// closing tag
		$shortcode = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$shortcode);
	
		return $shortcode;
	}
}

add_filter('the_content', 'zozo_shortcodes_formatter');
add_filter('widget_text', 'zozo_shortcodes_formatter');

/* =============================================================
 *	Render Breadcrumbs
 * ============================================================= */
 
if( ! function_exists( 'zozo_breadcrumbs' ) ) {
	function zozo_breadcrumbs() {
		$breadcrumbs = new Zozo_Breadcrumbs();
		$breadcrumbs->zozo_display_breadcrumbs();
	}
}

/* =============================================================
 *	Search Filters
 * ============================================================= */

if( ! is_admin() ) {
	function Zozo_SearchFilter($query) {
		global $zozo_options;
			
		if( is_search() && $query->is_search ) {
			if( isset( $_GET ) && count( $_GET ) > 1 ) {
				return $query;
			}
	
			if($zozo_options['zozo_search_results_content'] == 'only_posts') {
				$query->set('post_type', 'post');
			}
	
			if($zozo_options['zozo_search_results_content'] == 'only_pages') {
				$query->set('post_type', 'page');
			}
		}
		return $query;
	}

	add_filter('pre_get_posts','Zozo_SearchFilter');
}

/* =============================================================
 *	Shortcode Check for Scripts
 * ============================================================= */
 
if ( ! function_exists( 'zozo_save_post_content_check' ) ) {
	function zozo_save_post_content_check( $post_id ) {

		 // Make sure meta is added to the post, not a revision
		if ( $the_post = wp_is_post_revision( $post_id ) ) {
			$post_id = $the_post;
		}

		$post = get_post($post_id);

		if( $post ) {

			$content = $post->post_content;

			if( function_exists( 'has_shortcode' ) ) {

				// Products
				if ( has_shortcode( $content, 'related_products' ) || has_shortcode( $content, 'best_selling_products' ) || has_shortcode( $content, 'top_rated_products' ) || has_shortcode( $content, 'sale_products' ) || has_shortcode( $content, 'recent_products' ) || has_shortcode( $content, 'product_attribute' ) || has_shortcode( $content, 'product_category' ) || has_shortcode( $content, 'featured_products' ) || has_shortcode( $content, 'products' ) || has_shortcode( $content, 'product' ) || has_shortcode( $content, 'woocomposer_carousel' ) || has_shortcode( $content, 'woocomposer_grid' ) || has_shortcode( $content, 'woocomposer_product' ) ) {
					update_post_meta( $post_id, 'zozo_page_has_products', 1 );
				} else {
					delete_post_meta( $post_id, 'zozo_page_has_products' );
				}
				
			}
		}

	}
	add_action( 'save_post', 'zozo_save_post_content_check' );
}

/* =============================================================
 *	Disable default breadcrumbs from bbPress
 * ============================================================= */
add_filter( 'bbp_no_breadcrumb', '__return_true' );

/* =============================================================
 *	Events Calendar Archive
 * ============================================================= */
function is_events_archive() {
	if( class_exists( 'TribeEvents' ) ) {
		if( tribe_is_month() || tribe_is_day() || tribe_is_past() || tribe_is_upcoming() || class_exists( 'TribeEventsPro' ) && ( tribe_is_week() || tribe_is_photo() || tribe_is_map() ) ) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

/* ==================================================================
 *	Easy Digital Downloads Remove Purchase Link filter from $content
 * ================================================================== */
function zozo_edd_remove_purchase_link() {
	global $post;
	
	if( $post && $post->post_type == 'download' && is_singular( 'download' ) && is_main_query() && !post_password_required() ) {
		$rf = 'remove'.'_filter';
		$rf( 'the_content', 'edd_after_download_content' );
	}
	
}
add_action( 'wp_head', 'zozo_edd_remove_purchase_link' );

if( ! function_exists( 'zozo_edd_purchase_link_args' ) ) {
	function zozo_edd_purchase_link_args( $args ) {
	
		global $post;
		
		$post_id = is_object( $post ) ? $post->ID : 0;
		$button_behavior = edd_get_download_button_behavior( $post_id );
		
		$button_text = $button_behavior == 'direct' ? edd_get_option( 'buy_now_text', __( 'Buy Now', 'mist' ) ) : edd_get_option( 'add_to_cart_text', __( 'Purchase', 'mist' ) );
	
		$download = new EDD_Download( $args['download_id'] );
		
		if( empty( $download->ID ) ) {
			return false;
		}
	
		if( 'publish' !== $download->post_status && ! current_user_can( 'edit_product', $download->ID ) ) {
			return false; // Product not published or user doesn't have permission to view drafts
		}
		
		$variable_pricing = $download->has_variable_prices();
		$show_price       = $args['price'] && $args['price'] !== 'no';

		if ( $variable_pricing && false !== $args['price_id'] ) {
	
			$price_id            = $args['price_id'];
			$prices              = $download->prices;
			$found_price         = isset( $prices[$price_id] ) ? $prices[$price_id]['amount'] : false;
	
			if ( $show_price ) {
				$price = $found_price;
			}
	
		} elseif ( ! $variable_pricing ) {
		
			if ( $show_price ) {
				$price = $download->price;
			}
	
		}
	
		$button_text = ! empty( $button_text ) ? $button_text : '';

		if ( isset( $price ) && false !== $price ) {
	
			if ( 0 == $price ) {
				$args['text'] = $button_text;
			} else {
				$args['text'] = $button_text;
			}
	
		}
		
		return $args;
	
	}
}
add_filter( 'edd_purchase_link_args', 'zozo_edd_purchase_link_args' );

// Save Theme Options
if( class_exists( 'Redux' ) ){
	add_action('redux/options/zozo_options/saved', 'zozo_save_theme_options', 10, 2);
	add_action('redux/options/zozo_options/import', 'zozo_save_theme_options', 10, 2);
	add_action('redux/options/zozo_options/reset', 'zozo_save_theme_options');
	add_action('redux/options/zozo_options/section/reset', 'zozo_save_theme_options');
}
function zozo_save_theme_options() {
	global $wp_filesystem;
	
	$upload_dir = wp_upload_dir();
	$cus_dir_name = $upload_dir['basedir'] . '/mist';

	if ( ! file_exists( $cus_dir_name ) ) {
		wp_mkdir_p( $cus_dir_name );
	}
	
	if( empty( $wp_filesystem ) ) {
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}
	
	// Custom Styles File
	ob_start();
	include ZOZOINCLUDES . 'custom-skins.php';
	$custom_css = ob_get_clean();

	$filename =  $cus_dir_name . '/theme_'.get_current_blog_id().'.css';

	if( $wp_filesystem ) {
	
		$wp_filesystem->put_contents(
			$filename,
			$custom_css,
			FS_CHMOD_FILE // predefined mode settings for WP files
		);
		
	}

}
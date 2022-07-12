<?php
/**
* Woocommerce Config
*
* @package  Zozothemes
*/

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    die;
}

if( ! class_exists( 'ZozoWooConfig' ) ) {
	
    class ZozoWooConfig {

    	function __construct() {
		
			add_filter( 'woocommerce_enqueue_styles', array( $this, 'zozo_woo_dequeue_styles' ) );

    		add_filter( 'woocommerce_show_page_title', array( $this, 'zozo_woo_shop_title' ), 10 );

    		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			
    		add_action( 'woocommerce_before_main_content', array( $this, 'zozo_woo_before_container' ), 10 );
    		add_action( 'woocommerce_after_main_content', array( $this, 'zozo_woo_after_container' ), 10 );
			
			// Remove Woocommerce Default Sidebar
			remove_action( 'woocommerce_sidebar' , 'woocommerce_get_sidebar', 10 );

    		// Products Loop
    		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'zozo_woo_before_shop_loop_item' ), 9 );
    		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'zozo_woo_after_shop_loop_item' ), 11 );
			
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			
			// Single Product
    		//add_action( 'woocommerce_before_single_product_summary', array( $this, 'zozo_woocommerce_before_single_product_summary_open' ), 5 );
    		//add_action( 'woocommerce_before_single_product_summary', array( $this, 'zozo_woocommerce_before_single_product_summary_close' ), 30 );
			
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'woocommerce_share', array( $this, 'zozo_woocommerce_share' ), 10 );
		
			// Remove totals from cart collaterals
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
			
			// Remove unneccesary Woocommerce Scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'zozo_remove_woo_scripts' ), 99 );

    	}
		
		function zozo_woo_dequeue_styles( $enqueue_styles ) {
			unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
			
			$enqueue_styles['woocommerce-smallscreen'] = array(
				'src'     => str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() ) . '/css/woocommerce-smallscreen.css',
				'deps'    => 'woocommerce-layout',
				'version' => WC_VERSION,
				'media'   => 'all'
			);
			
			return $enqueue_styles;
		}
		
		function zozo_woo_before_container() {
			global $zozo_options, $post;
			
			$shop_page_id = $layout = $content_class = $primary_class = $show_title = $zozo_page_slogan = $zozo_page_icon = '';
			
			if( is_shop() ) {
				$shop_page_id = get_option('woocommerce_shop_page_id');
				if( isset( $shop_page_id ) ) {
					$layout = get_post_meta( $shop_page_id, 'zozo_layout', true );
				}
				if( isset( $layout ) && $layout == '' ) {
					$layout = 'one-col';
				}				
			} 
			
			if( is_product_category() || is_product_tag() ) {
				$layout = $zozo_options['zozo_woo_archive_layout'];
				if( isset( $layout ) && $layout == '' ) {
					$layout = 'one-col';
				}
			}
			
			if( is_product() ) {
				$layout = $zozo_options['zozo_woo_single_layout'];
				if( isset( $layout ) && $layout == '' ) {
					$layout = 'two-col-right';
				}
			}
			
			if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' ) {
				$content_class = 'main-col-small';
			}
			else {
				$content_class = 'main-col-full';
			}	
			
			if( $layout == 'three-col-left' || $layout == 'three-col-middle' || $layout == 'three-col-right' || $layout == 'two-col-left' || $layout == 'two-col-right' ) {
				$primary_class = 'content-col-small';
			}		
			elseif( $layout == 'one-col' ) {
				$primary_class = 'content-col-full';
			}

			echo '<div class="container zozo-woocommerce-wrapper">
					<div id="main-wrapper" class="zozo-row row">
						<div id="single-sidebar-container" class="single-sidebar-container '.$content_class.'">        
							<div class="zozo-row row">	
								<div id="primary" class="content-area '.$primary_class.'">
									<div id="content" class="site-content">';
		}
		
		function zozo_woo_after_container() {
			global $zozo_options, $post;
			
			echo '</div></div>';
			
			$shop_page_id = $layout = $layouts = $pm_sidebar_widget = $sec_sidebar_widget = '';
			
			if( is_shop() ) {
				$shop_page_id = get_option('woocommerce_shop_page_id');
				if( isset( $shop_page_id ) ) {
					$layout = get_post_meta( $shop_page_id, 'zozo_layout', true );
					$pm_sidebar_widget = get_post_meta( $shop_page_id, 'zozo_primary_sidebar', true );
					$sec_sidebar_widget = get_post_meta( $shop_page_id, 'zozo_secondary_sidebar', true );
				}
				if( isset( $layout ) && $layout == '' ) {
					$layout = 'one-col';
				}
			} 
			
			if( is_product_category() || is_product_tag() ) {
				$layout = $zozo_options['zozo_woo_archive_layout'];
				if( isset( $layout ) && $layout == '' ) {
					$layout = 'one-col';
				}
			}
			
			if( is_product() ) {
				$layout = $zozo_options['zozo_woo_single_layout'];
				if( isset( $layout ) && $layout == '' ) {
					$layout = 'two-col-right';
				}
			}
			
			if( $pm_sidebar_widget == '' || $pm_sidebar_widget == '0' ) {
				$pm_sidebar_widget = 'shop-sidebar';
			}
			
			if( $layout != 'one-col' ) {
				if ( is_active_sidebar( $pm_sidebar_widget ) ) {				
					echo '<div id="sidebar" class="primary-sidebar sidebar pm-sidebar">';
						dynamic_sidebar( $pm_sidebar_widget );
					echo '</div>';
				}
			}
			
			echo '</div></div>';
			
			if( $sec_sidebar_widget == '' || $sec_sidebar_widget == '0' ) {
				$sec_sidebar_widget = 'secondary';
			}
				
			$layouts = array( 'three-col-middle', 'three-col-right', 'three-col-left' );
	
			if ( in_array( $layout, $layouts ) ) {				
				if ( is_active_sidebar( $sec_sidebar_widget ) ) {
					echo '<div id="secondary-sidebar" class="secondary-sidebar sidebar sec-sidebar">';
						dynamic_sidebar( $sec_sidebar_widget );
					echo '</div>';
				}		
			}
			
			echo '</div></div>';
		}
		
		function zozo_woo_shop_title() {
			return false;
		}
		
		function zozo_woo_before_shop_loop_item() {
			echo '<div class="product-buttons-wrapper"><div class="product-buttons">';
		}

		function zozo_woo_after_shop_loop_item() {
			echo '<a href="' . get_permalink() . '" class="woo-show-details" title="' . esc_html__( 'Show Details', 'mist' ) . '">' . esc_html__( 'Show Details', 'mist' ) . '</a></div></div>';
		}
		
		function zozo_woocommerce_before_single_product_summary_open() {
			echo '<div class="single-product-image-wrapper">';
		}
			
		function zozo_woocommerce_before_single_product_summary_close() {
			echo '</div>';
		}
		
		function zozo_woocommerce_share() {

			global $zozo_options;
			
			if( isset( $zozo_options['zozo_woo_social_sharing'] ) && $zozo_options['zozo_woo_social_sharing'] == 1 ) {
				echo '<div class="zozo-woo-social-share-box zozo-social-share-box">';
				echo apply_filters( 'zozo_woo_socials_share_title', '<span>' . __( 'Share on:', 'mist' ) . '</span>' );
				echo '<ul class="woo-social-share zozo-social-share-icons clearfix">';
					
					echo '<li class="facebook"><a href="http://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;='.urlencode(get_permalink()).'&p&#91;images&#93;&#91;0&#93;=' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) . '&p&#91;title&#93;=' . rawurlencode( get_the_title() ) .'" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>';
					
					echo '<li class="twitter"><a href="https://twitter.com/share?text=' . wp_strip_all_tags( get_the_title(), true ) . ' ' . get_permalink() . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
					
					echo '<li class="pinterest">';
					$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					echo '<a href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . urlencode( wp_strip_all_tags( get_the_title(), true ) ) . '&amp;media=' . urlencode( $full_image[0] ) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
					echo '</li>';
					
					echo '<li class="email"><a href="mailto:?subject=' . wp_strip_all_tags( get_the_title(), true ) . '&amp;body=' . get_permalink() . '" target="_blank"><i class="fa fa-envelope"></i></a></li>';
				
				echo '</ul>';
				echo '</div>';
			}
		}
		
		function zozo_remove_woo_scripts() {

			global $post;

			// Page Content Meta
			$page_has_products = false;
			if( $post ) {
				$page_has_products = get_post_meta( $post->ID, 'zozo_page_has_products', true );
			}

			// Check page for WoooCommerce content
			$body_class = get_body_class();
			
			//remove generator meta tag
			remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

			if( ! in_array( 'woocommerce', $body_class ) && ! in_array( 'woocommerce-cart', $body_class ) && ! in_array( 'woocommerce-checkout', $body_class ) && ! $page_has_products ) {

				// WooCommerce Scripts
				wp_dequeue_script( 'jquery-blockui' );
				wp_dequeue_script( 'jquery-cookie' );
				wp_dequeue_script( 'woocommerce' );
				wp_dequeue_script( 'wc-add-to-cart' );
				wp_dequeue_script( 'wc-cart-fragments' );
				wp_dequeue_script( 'wc-add-to-cart-variation' );
				
			}

			if( in_array( 'woocommerce-cart', $body_class ) ) {
				// WooCommerce Scripts
				wp_dequeue_script( 'wc-add-to-cart-variation' );
			}

			if( in_array( 'woocommerce-checkout', $body_class ) ) {

				// WooCommerce Scripts
				wp_dequeue_script( 'wc-add-to-cart' );
				wp_dequeue_script( 'wc-cart-fragments' );
				wp_dequeue_script( 'wc-add-to-cart-variation' );
			}

			// WooCommerce Scripts / Styles
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );

		}
		
	}
}
new ZozoWooConfig();

global $zozo_options;

// Remove Breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Remove result count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Change number of products per row to 3
add_filter('loop_shop_columns', 'zozo_woo_loop_columns');

function zozo_woo_loop_columns() {
	global $zozo_options;
	
	if( isset( $zozo_options['zozo_loop_shop_columns'] ) && $zozo_options['zozo_loop_shop_columns'] != '' ) {
		$product_columns = $zozo_options['zozo_loop_shop_columns'];
	} else {
		$product_columns = 3;
	}
	
	return $product_columns;
}

// Related Products Count
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action('woocommerce_after_single_product_summary', 'zozo_woocommerce_output_related_products', 15);

function zozo_woocommerce_output_related_products() {
	global $zozo_options;
	
	if( isset( $zozo_options['zozo_related_products_count'] ) && $zozo_options['zozo_related_products_count'] != '' ) {
		$related_count = $zozo_options['zozo_related_products_count'];
	} else {
		$related_count = 3;
	}
	
	$args = array(
		'posts_per_page' => $related_count,
		'columns' => $related_count,
		'orderby' => 'rand'
	);

	woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}

// Shop Ordering
if( isset( $zozo_options['zozo_woo_shop_ordering'] ) && $zozo_options['zozo_woo_shop_ordering'] == 1 ) {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	add_action('woocommerce_before_shop_loop', 'zozo_woocommerce_catalog_ordering', 30);
	add_action('woocommerce_get_catalog_ordering_args', 'zozo_woocommerce_overwrite_catalog_ordering', 20);
}

function zozo_woocommerce_catalog_ordering() {

	global $wp_query, $zozo_options;
	
	$product_order = array();
	$product_sort = array();
	
	$product_order['default'] 	 = esc_html__('Default Sorting', 'mist');
	$product_order['title'] 	 = esc_html__('Name', 'mist');
	$product_order['price'] 	 = esc_html__('Price', 'mist');
	$product_order['date'] 		 = esc_html__('Date', 'mist');
	$product_order['popularity'] = esc_html__('Popularity', 'mist');

	$product_sort['asc'] 		 = esc_html__('Products ascending',  'mist');
	$product_sort['desc'] 		 = esc_html__('Products descending',  'mist');
	
	// Set the products per page options
	if( $zozo_options['zozo_loop_products_per_page'] ) {
		$per_page = $zozo_options['zozo_loop_products_per_page'];
	} else {
		$per_page = 12;
	}
	
	$qry_str = '';
	if( function_exists('mist_get_server_details') ) $qry_str = mist_get_server_details('QUERY_STRING');
	
	parse_str( $qry_str, $params);

	$product_order_key = !empty($params['product_order']) ? $params['product_order'] : 'default';
	$product_sort_key  = !empty($params['product_sort'])  ? $params['product_sort'] : 'asc';
	$product_count_key = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	$product_sort_key = strtolower($product_sort_key);
	
	$output = '';
	
	$output .= '<div class="woo-catalog-ordering clearfix">';
		
		// Products Orderby
		$output .= '<div class="zozo-woo-orderby-container">';
		$output .= '<ul class="orderby-dropdown woo-ordering woo-dropdown">';
			$output .= '<li>';
				$output .= '<span class="current-li"><span class="current-li-content">'.esc_html__('Sort by: ', 'mist').' <strong>'.$product_order[$product_order_key].'</strong></span></span>';
				$output .= '<ul class="order-sub-dropdown">';
					// Default
					$output .= '<li class="'.(($product_order_key == 'default') ? 'current': '').'"><a href="'.zozo_woo_build_query_string($params, 'product_order', 'default').'"><strong>'.$product_order['default'].'</strong></a></li>';
					// Title
					$output .= '<li class="'.(($product_order_key == 'title') ? 'current': '').'"><a href="'.zozo_woo_build_query_string($params, 'product_order', 'title').'"><strong>'.$product_order['title'].'</strong></a></li>';
					// Price
					$output .= '<li class="'.(($product_order_key == 'price') ? 'current': '').'"><a href="'.zozo_woo_build_query_string($params, 'product_order', 'price').'"><strong>'.$product_order['price'].'</strong></a></li>';
					// Date
					$output .= '<li class="'.(($product_order_key == 'date') ? 'current': '').'"><a href="'.zozo_woo_build_query_string($params, 'product_order', 'date').'"><strong>'.$product_order['date'].'</strong></a></li>';
					// Popularity
					$output .= '<li class="'.(($product_order_key == 'popularity') ? 'current': '').'"><a href="'.zozo_woo_build_query_string($params, 'product_order', 'popularity').'"><strong>'.$product_order['popularity'].'</strong></a></li>';
				$output .= '</ul>';
			$output .= '</li>';
		$output .= '</ul>';
		$output .= '</div>';
		
		// Products Sorting
		$output .= '<div class="zozo-woo-sorting-container">';
		$output .= '<ul class="sorting-dropdown woo-sort-ordering">';
			if($product_sort_key == 'desc') {			
				$output .= '<li class="sort-desc"><a title="'.$product_sort['asc'].'" href="'.zozo_woo_build_query_string($params, 'product_sort', 'asc').'"><i class="fa fa-arrow-down"></i></a></li>';
			}
			
			if($product_sort_key == 'asc') {			
				$output .= '<li class="sort-asc"><a title="'.$product_sort['desc'].'" href="'.zozo_woo_build_query_string($params, 'product_sort', 'desc').'"><i class="fa fa-arrow-up"></i></a></li>';
			}
		$output .= '</ul>';
		$output .= '</div>';
		
		// Products Count
		$output .= '<div class="zozo-woo-count-container">';
		$output .= '<ul class="count-dropdown woo-product-count woo-dropdown">';
		
			$output .= '<li>';
				$output .= '<span class="current-li"><span class="current-li-content">'.esc_html__('Show: ', 'mist').' <strong>'.$product_count_key.' '.esc_html__(' items/page', 'mist').'</strong></span></span>';
				$output .= '<ul class="order-sub-dropdown">';
					$output .= '<li class="'.(($product_count_key == $per_page) ? 'current': '').'"><a href="'.zozo_woo_build_query_string($params, 'product_count', $per_page).'"><strong>'.$per_page.' '.esc_html__(' items/page', 'mist').'</strong></a></li>';
					
					$output .= '<li class="'.(($product_count_key == $per_page * 2) ? 'current': '').'"><a href="'.zozo_woo_build_query_string($params, 'product_count', $per_page * 2).'"><strong>'.( $per_page * 2 ).' '.esc_html__(' items/page', 'mist').'</strong></a></li>';
					
					$output .= '<li class="'.(($product_count_key == $per_page * 3) ? 'current': '').'"><a href="'.zozo_woo_build_query_string($params, 'product_count', $per_page * 3).'"><strong>'.( $per_page * 3 ).' '.esc_html__(' items/page', 'mist').'</strong></a></li>';
					
				$output .= '</ul>';
			$output .= '</li>';
		$output .= '</ul>';
		$output .= '</div>';
			
	$output .= '</div>';
	
	echo wp_kses_post( $output );
}

// Function to overwrite default query parameters
if( !function_exists('zozo_woocommerce_overwrite_catalog_ordering') ) {	

	function zozo_woocommerce_overwrite_catalog_ordering($args) {
			
		global $woocommerce;

		// Check parameters and session vars. if they are set overwrite the defaults
		$check = array('product_order', 'product_count', 'product_sort');		

		foreach($check as $key) {
			if(isset($_GET[$key]) ) $_SESSION['zozo_woocommerce'][$key] = esc_attr($_GET[$key]);			
		}

		// is user wants to use new product order remove the old sorting parameter
		if(isset($_GET['product_order']) && !isset($_GET['product_sort']) && isset($_SESSION['zozo_woocommerce']['product_sort'])) {
			unset($_SESSION['zozo_woocommerce']['product_sort']);
		}
		
		$qry_str = '';
		if( function_exists('mist_get_server_details') ) $qry_str = mist_get_server_details('QUERY_STRING');
		
		parse_str( $qry_str, $params);
		
		$product_order = !empty($params['product_order']) ? $params['product_order'] : 'default';
		$product_sort = !empty($params['product_sort'])  ? $params['product_sort'] : 'asc';

		// Product order
		if(!empty($product_order)) {
			switch( $product_order ) {
				case 'date': 
					$orderby = 'date'; 
					$order = 'desc'; 
					$meta_key = '';  
					break;
				case 'price': 
					$orderby = 'meta_value_num'; 
					$order = 'asc'; 
					$meta_key = '_price'; 
					break;
				case 'popularity': 
					$orderby = 'meta_value_num'; 
					$order = 'desc'; 
					$meta_key = 'total_sales'; 
					break;
				case 'title': 
					$orderby = 'title'; 
					$order = 'asc'; 
					$meta_key = ''; 
					break;
				case 'default':
				default: 
					$orderby = 'menu_order title'; 
					$order = 'asc'; 
					$meta_key = ''; 
					break;
			}
		}

		// Product sorting
		if(!empty($product_sort))
		{
			switch( $product_sort ) {
				case 'desc': 
					$order = 'desc'; 
					break;
				case 'asc': 
					$order = 'asc'; 
					break;
				default: 
					$order = 'asc'; 
					break;
			}
		}


		if(isset($orderby)) $args['orderby'] = $orderby;
		if(isset($order)) 	$args['order'] = $order;
		
		if (!empty($meta_key)) {
			$args['meta_key'] = $meta_key;
		}
				
		return $args;
	}
}

// Change number of products per page
add_filter('loop_shop_per_page', 'zozo_woo_loop_shop_per_page');

function zozo_woo_loop_shop_per_page() {
	global $zozo_options;
	
	$qry_str = '';
	if( function_exists('mist_get_server_details') ) $qry_str = mist_get_server_details('QUERY_STRING');
	
	parse_str( $qry_str, $params);

	if( isset( $zozo_options['zozo_loop_products_per_page'] ) && $zozo_options['zozo_loop_products_per_page'] != '' ) {
		$products_per_page = $zozo_options['zozo_loop_products_per_page'];
	} else {
		$products_per_page = 12;
	}
	
	$product_count = !empty($params['product_count']) ? $params['product_count'] : $products_per_page;

	return $product_count;
}

// Move Rating After Price
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );

// Ajax Add to Cart Update
add_filter( 'woocommerce_add_to_cart_fragments', 'zozo_woocommerce_add_to_cart_fragment' );
function zozo_woocommerce_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	?>
	<div class="woo-cart">
		<?php if( ! $woocommerce->cart->cart_contents_count ) { ?>
		<a class="cart-empty cart-icon" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><i class="icomoon icomoon3-shopping_cart"></i></a>
		<?php } else { ?>
		<a class="cart-icon" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><i class="icomoon icomoon3-shopping_cart"></i><span class="cart-count"><?php echo wp_kses_post( $woocommerce->cart->cart_contents_count ); ?></span></a>
		
		<div class="woo-cart-contents">			
			<?php foreach( $woocommerce->cart->cart_contents as $cart_item_key => $cart_item ) { ?>
				<div class="woo-cart-item clearfix">
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
			
			<div class="woo-cart-total clearfix">
				<h5 class="cart-total"><?php esc_html_e('Total: ', 'mist'); ?> <?php echo wp_kses_post( $woocommerce->cart->get_cart_total() ); ?></h5>
			</div>
					
			<div class="woo-cart-links clearfix">
				<div class="cart-link"><a class="btn btn-cart" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>" title="<?php esc_html_e('Cart', 'mist'); ?>"><?php esc_html_e('View Cart', 'mist'); ?></a></div>
				<div class="checkout-link"><a class="btn btn-checkout" href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>" title="<?php esc_html_e('Checkout', 'mist'); ?>"><?php esc_html_e('Checkout', 'mist'); ?></a></div>
			</div>
		</div>
		<?php } ?>
	</div>
	
	<?php $fragments['.header-top-cart .woo-cart'] = ob_get_clean();
	
	return $fragments;

}

// Ajax Remove Item
add_action( 'wp_ajax_zozo_product_remove', 'zozo_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_zozo_product_remove', 'zozo_ajax_product_remove' );
function zozo_ajax_product_remove() {

    $cart = WC()->instance()->cart;
    $cart_id = $_POST['cart_id'];
    $cart_item_id = $cart->find_product_in_cart($cart_id);

    if ($cart_item_id) {
        $cart->set_quantity($cart_item_id, 0);
    }

    $cart_ajax = new WC_AJAX();
    $cart_ajax->get_refreshed_fragments();

    exit();
}

// Create Custom Fields for Products

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'zozo_woo_add_custom_general_fields' );
// Save Fields
add_action( 'woocommerce_process_product_meta', 'zozo_woo_save_custom_general_fields' );

function zozo_woo_add_custom_general_fields() {
 
	global $woocommerce, $post, $wpdb;
	
	echo '<div class="options_group">';		

	woocommerce_wp_text_input( array( 'id' => 'woo_delivery_time', 'label' => esc_html__( 'Delivery Time', 'mist' ), 'description' => esc_html__( 'Enter delivery time for this product', 'mist' ), 'desc_tip' => true, 'wrapper_class' => '' ) );

	woocommerce_wp_text_input( array( 'id' => 'woo_warranty', 'label' => esc_html__( 'Warranty', 'mist' ), 'description' => esc_html__( 'Enter warranty period for this product', 'mist' ), 'desc_tip' => true, 'wrapper_class' => '' ) );
	
	woocommerce_wp_text_input( array( 'id' => 'woo_registered_info', 'label' => esc_html__( 'Registered', 'mist' ), 'description' => esc_html__( 'Enter registration details for this product', 'mist' ), 'desc_tip' => true, 'wrapper_class' => '' ) );
	
	echo '</div>';	
}

// Save Woocommerce custom fields
function zozo_woo_save_custom_general_fields( $post_id ) {
	global $woocommerce, $post;

	if ( isset( $_POST['woo_delivery_time'] ) ) {
		update_post_meta( $post_id, 'woo_delivery_time', sanitize_text_field( $_POST['woo_delivery_time'] ) );
	}
	
	if ( isset( $_POST['woo_warranty'] ) ) {
		update_post_meta( $post_id, 'woo_warranty', sanitize_text_field( $_POST['woo_warranty'] ) );
	}
	
	if ( isset( $_POST['woo_registered_info'] ) ) {
		update_post_meta( $post_id, 'woo_registered_info', sanitize_text_field( $_POST['woo_registered_info'] ) );
	}

}

// Show Custom Fields before Cart Buttons
add_action( 'woocommerce_single_product_summary', 'zozo_woo_show_product_fields', 25 );

function zozo_woo_show_product_fields() {
	global $woocommerce, $post, $zozo_options;
	
	if( is_product() ) {
		$layout = $zozo_options['zozo_woo_single_layout'];		
	}
	
	$column_class = '';
	$column_class = "col-md-4";
	if( isset( $layout ) && $layout != '' ) {
		if( $layout == 'two-col-right' || $layout == 'two-col-left' ) {
			$column_class = "col-md-4";
		} elseif( $layout == 'three-col-right' || $layout == 'three-col-left' || $layout == 'three-col-middle' ) {
			$column_class = "col-xs-12";
		} elseif( $layout == 'one-col' ) {
			$column_class = "col-md-4";
		}
	}
	
	$delivery_time = get_post_meta( $post->ID, 'woo_delivery_time', true );
	$warranty = get_post_meta( $post->ID, 'woo_warranty', true );
	$registered = get_post_meta( $post->ID, 'woo_registered_info', true );
	
	if( ( isset( $delivery_time ) && $delivery_time != '' ) || ( isset( $warranty ) && $warranty != '' ) || ( isset( $registered ) && $registered != '' ) ) {
	
		echo '<div class="product-meta-info-wrapper">';		
			echo '<div class="row">';
				if( isset( $delivery_time ) && $delivery_time != '' ) {
					echo '<div class="'.esc_attr( $column_class ).'">';
						echo '<div class="product-meta-item clearfix">';
						echo '<i class="icomoon2 icomoon2-alarmclock2"></i>';
						echo '<div class="product-meta-content">';
							echo '<p class="product-meta-title">' . esc_html__('Delivery time', 'mist') . '</p>';
							echo '<h5 class="product-meta-value">' . esc_html( $delivery_time ) . '</h5>';
						echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				
				if( isset( $warranty ) && $warranty != '' ) {
					echo '<div class="'.esc_attr( $column_class ).'">';
						echo '<div class="product-meta-item clearfix">';
						echo '<i class="icomoon2 icomoon2-medal2"></i>';
						echo '<div class="product-meta-content">';
							echo '<p class="product-meta-title">' . esc_html__('Warranty', 'mist') . '</p>';
							echo '<h5 class="product-meta-value">' . esc_html( $warranty ) . '</h5>';
						echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				
				if( isset( $registered ) && $registered != '' ) {
					echo '<div class="'.esc_attr( $column_class ).'">';
						echo '<div class="product-meta-item clearfix">';
						echo '<i class="icomoon2 icomoon2-library"></i>';
						echo '<div class="product-meta-content">';
							echo '<p class="product-meta-title">' . esc_html__('Officially', 'mist') . '</p>';
							echo '<h5 class="product-meta-value">' . esc_html( $registered ) . '</h5>';
						echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';			
		echo '</div>';
		
	}
}
// Move Rating After Content
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 21 );

/* Cart */
function zozo_woocommerce_before_cart_table( $args ) {
	global $woocommerce;

	echo '<div class="woocommerce-cart-content-box woo-cart-table-top clearfix">';

	if ( $woocommerce->cart->cart_contents_count == 1 ) {
		echo '<h5>' . sprintf( __( 'Your Selection In Cart : %d Item', 'mist' ), $woocommerce->cart->cart_contents_count ) . '</h5>';
	} else {
		echo '<h5>' . sprintf( __( 'Your Selection In Cart : %d Items', 'mist' ), $woocommerce->cart->cart_contents_count ) . '</h5>';
	}
	
}

function zozo_woocommerce_after_cart_table( $args ) {
	echo '</div>';
}

add_action( 'woocommerce_before_cart_table', 'zozo_woocommerce_before_cart_table', 20 );
add_action( 'woocommerce_after_cart_table', 'zozo_woocommerce_after_cart_table', 20 );

function woocommerce_cross_sell_display( $posts_per_page = 4, $columns = 4, $orderby = 'rand' ) {
	wc_get_template( 'cart/cross-sells.php', array(
		'posts_per_page' => $posts_per_page,
		'orderby'        => $orderby,
		'columns'        => $columns
	) );
}

// Enable Catalog Mode
if( isset( $zozo_options['zozo_woo_enable_catalog_mode'] ) && $zozo_options['zozo_woo_enable_catalog_mode'] == 1 ) {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	add_filter( 'woocommerce_loop_add_to_cart_link', '__return_empty_string', 10 );
	
	add_filter( 'woocommerce_free_sale_price_html', '__return_empty_string', 10 );
	add_filter( 'woocommerce_free_price_html', '__return_empty_string', 10 );
	
	add_action( 'wp', 'zozo_woo_pages_redirect', 10 );
}

function zozo_woo_pages_redirect() {

	$cart     = get_option( 'woocommerce_cart_page_id' );
	$checkout = get_option( 'woocommerce_checkout_page_id' );

	wp_reset_postdata();
	
	if( ( isset( $cart ) && $cart != '' ) || ( isset( $checkout ) && $checkout != '' ) ) {	
		if( is_page( $cart ) || is_page( $checkout ) ) {
			wp_redirect( home_url() );
			exit;
		}
	}
	
}
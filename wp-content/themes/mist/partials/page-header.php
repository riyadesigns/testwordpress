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

$hide_title_bar 	= get_post_meta( $post_id, 'zozo_hide_page_title_bar', true );
$hide_title 		= get_post_meta( $post_id, 'zozo_hide_page_title', true );
$breadcrumbs 		= get_post_meta( $post_id, 'zozo_display_breadcrumbs', true );
$show_page_slogan 	= get_post_meta( $post_id, 'zozo_show_page_slogan', true );
$page_slogan 		= get_post_meta( $post_id, 'zozo_page_slogan', true );
$page_title_align 	= get_post_meta( $post_id, 'zozo_page_title_align', true );
$page_title_type 	= get_post_meta( $post_id, 'zozo_page_title_type', true );
$page_title_skin 	= get_post_meta( $post_id, 'zozo_page_title_skin', true );
$page_video_bg 		= get_post_meta( $post_id, 'zozo_page_title_video_bg', true );
$page_video_id 		= get_post_meta( $post_id, 'zozo_page_title_video_id', true );
$page_title_bg 		= get_post_meta( $post_id, 'zozo_page_title_bar_bg', true );
$page_bg_parallax   = get_post_meta( $post_id, 'zozo_page_title_bar_bg_parallax', true );
$page_title_bar_bg_position = get_post_meta( $post_id, 'zozo_page_title_bar_bg_position', true );

$page_title_align 	= !empty( $page_title_align ) ? $page_title_align : 'default';
$page_title_type 	= !empty( $page_title_type ) ? $page_title_type : 'default';
$page_title_skin 	= !empty( $page_title_skin ) ? $page_title_skin : 'default';

if( isset( $breadcrumbs ) && $breadcrumbs == '' || $breadcrumbs == 'default' ) {
	$breadcrumbs = $zozo_options['zozo_enable_breadcrumbs'];
	if( $breadcrumbs ) {
		$breadcrumbs = 'show';
	} else {
		$breadcrumbs = 'hide';
	}
}

$title = '';
$title = get_the_title( $post_id );

if( is_home() ) {
	$title = $zozo_options['zozo_blog_title'];
	$page_slogan = $zozo_options['zozo_blog_slogan'];
}

if( is_search() ) {
	$title = __( 'Search results for:', 'mist' ) . ' ' . get_search_query();
}

if( is_404() ) {
	$title = __('Error 404 Page', 'mist');
}

if( ( class_exists( 'TribeEvents' ) && tribe_is_event() && ! is_single() && ! is_home() ) ||
	( class_exists( 'TribeEvents' ) && is_events_archive() ) ||
	( class_exists( 'TribeEvents' ) && is_events_archive() && is_404() ) ) { 
	$title = tribe_get_events_title();	
}

if( is_archive() && ! ( class_exists('bbPress') && is_bbpress() ) && ! is_search() ) {
	if ( is_day() ) {
		$title = __( 'Daily Archives:', 'mist' ) . '<span> ' . get_the_date() . '</span>';
	} else if ( is_month() ) {
		$title = __( 'Monthly Archives:', 'mist' ) . '<span> ' . get_the_date( _x( 'F Y', 'monthly archives date format', 'mist' ) ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives:', 'mist' ) . '<span> ' . get_the_date( _x( 'Y', 'yearly archives date format', 'mist' ) ) . '</span>';
	} elseif ( is_author() ) {
		$current_auth = get_user_by( 'id', get_query_var( 'author' ) );
		$title = $current_auth->nickname;
	} elseif( is_post_type_archive() ) {				
		$title = post_type_archive_title( '', false );
		
		$sermon_settings = get_option('wpfc_options');
		if( is_array( $sermon_settings ) ) {
			$title = $sermon_settings['archive_title'];
		}				
	} else {
		$title = single_cat_title( '', false );
	}
}

if( ZOZO_EPL_ACTIVE ) {
	if ( ( is_tax( 'tax_feature' ) || is_tax( 'location' ) || is_tax( 'tax_business_listing' ) ) && function_exists( 'epl_is_search' ) && false == epl_is_search() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = sprintf( __( 'Property in %s', 'mist' ), $term->name );
	}
}

if( ZOZO_WOOCOMMERCE_ACTIVE && is_woocommerce() && ( is_product() || is_shop() ) && ! is_search() ) {
	if( ! is_product() ) {
		$title = woocommerce_page_title( false );
	}
}

if( ! is_archive() && ! is_search() && ! ( is_home() && ! is_front_page() ) ) {
	if ( $hide_title_bar != 'yes' ) {
		if( $hide_title == 'yes' ) {
			$title = '';
		}
	}
}	else {
	if ( $hide_title_bar != 'yes' ) {
		if( $hide_title == 'yes' ) {
			$title = '';
		}				
	}
}
		
$output_title_bar = '';
if( ! is_archive() && ! is_search() && ! ( is_home() && ! is_front_page() ) ) {
	if ( $hide_title_bar != 'yes' ) {
		if( is_home() && is_front_page() && ! $zozo_options['zozo_blog_page_title_bar'] ) {
			$output_title_bar = 'no';
		} else {
			$output_title_bar = 'yes';
		}
	}
} else {
	if( is_home() && ! $zozo_options['zozo_blog_page_title_bar'] ) {
		$output_title_bar = 'no';
	} else {	
		if( $hide_title_bar != 'yes' ) {
			$output_title_bar = 'yes';
		}
	}
}

$extra_class = '';
if( isset( $page_video_bg ) && $page_video_bg == 1 ) {
	if( isset( $page_video_id ) && $page_video_id != '' ) {
		$extra_class .= ' page-title-video-bg page-video-'. $post_id .'';
	}
}

$extra_class 		.= ' page-titletype-'. $page_title_type .'';
$extra_class 		.= ' page-titleskin-'. $page_title_skin .'';
$extra_class 		.= ' page-titlealign-'. $page_title_align .'';
if( isset( $page_title_bg ) && $page_title_bg != '' ) {
	$extra_class 	.= ' page-title-image-bg';
}

$wrapper_attributes = array();
if( isset( $page_bg_parallax ) && $page_bg_parallax == 'yes' ) {
	wp_enqueue_script( 'zozo-skrollr-js' );
	$wrapper_attributes[] = 'data-zozo-parallax="2"';
	$extra_class .= ' zozo-parallax';
}

if( ! empty( $page_title_bg ) ) {
	$wrapper_attributes[] = 'data-zozo-parallax-image="' . esc_attr( $page_title_bg ) . '"';
} 

if( ! empty( $page_title_bar_bg_position ) ) {
	$wrapper_attributes[] = 'data-zozo-parallax-position="' . esc_attr( $page_title_bar_bg_position ) . '"';
} 

$wrapper_attributes[] = 'class="page-title-section ' . esc_attr( trim( $extra_class ) ) . '"'; ?>

<!-- ============ Page Header ============ -->
<?php if( isset( $output_title_bar ) && $output_title_bar == 'yes' ) { ?>
<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<div class="page-title-wrapper-outer">

	<!-- ===== Video Background -->
	<?php if( isset( $page_video_bg ) && $page_video_bg == 1 ) { ?>
		<?php if( isset( $page_video_id ) && $page_video_id != '' ) { ?>			
			<?php wp_enqueue_script( 'zozo-video-slider-js' ); ?>				
			<div id="video-bg-<?php echo esc_attr( $post_id ); ?>" class="video-bg">
				<div id="player-<?php echo esc_attr( $post_id );?>" class="zozo-yt-player bg-video-container" 
				data-property="{<?php echo "videoURL:'https://www.youtube.com/watch?v=".$page_video_id."',autoPlay:true"; ?>,showControls:false,mute:true,containment:'<?php echo '.page-video-'. $post_id .'';?>',loop:false,startAt:0,opacity:1,ratio:'16/9',quality:'hd720'}"></div>
			</div>
		<?php } ?>
	<?php } ?>
	
	<div class="page-title-wrapper clearfix">
		<div class="container page-title-container">
			<div class="page-title-captions">
				<?php if( isset( $title ) && $title != '' ) { ?>
					<?php echo sprintf( '<h1 class="entry-title">%s</h1>', $title ); ?>
				<?php } ?>
				<?php if( isset( $show_page_slogan ) && $show_page_slogan == 'yes' && $page_slogan != '' ) { ?>
					<h5 class="page-entry-slogan">
						<?php echo do_shortcode( $page_slogan ); ?>
					</h5>
				<?php } ?>
					
				<?php if( isset( $breadcrumbs ) && $breadcrumbs == 'show' ) {
				if( isset( $page_title_align ) && $page_title_align == 'center' ) { ?>
					<div class="page-title-breadcrumbs">
						<?php zozo_breadcrumbs(); ?>
					</div>
				<?php }
				} ?>
			</div>
		
			<?php if( isset( $breadcrumbs ) && $breadcrumbs == 'show' ) {
			if( isset( $page_title_align ) && $page_title_align != 'center' ) { ?>
				<div class="page-title-breadcrumbs">
					<?php zozo_breadcrumbs(); ?>
				</div>
			<?php }
			} ?>
		</div>
	</div>
	
	</div>
</div>
<?php } ?>
<!-- ============ Page Header Ends ============ -->
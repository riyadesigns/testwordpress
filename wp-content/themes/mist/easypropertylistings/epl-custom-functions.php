<?php
function zozo_epl_get_property_icons() {
	global $property;
	$land = $bed = $bath = $rooms = $parking = $construction = $category = '';
	
	$property_land_area_unit = $property->get_property_meta('property_land_area_unit');
	if( isset( $property_land_area_unit ) && $property_land_area_unit == 'squareMeter' ) {
		$property_land_area_unit = __('sqm' , 'mist');
	}
	if( intval( $property->get_property_meta('property_land_area') ) != 0 ) {
		$land = '<div class="property-icon-item"><div class="property-icon-inner icon land">';
		$land .= '<h6><span class="property-icon-item-label">'.__('Area', 'mist').'</span>';
		$land .= '<span class="property-icon-value">'. $property->get_property_meta('property_land_area') . ' '.$property_land_area_unit.'</span></h6>';
		$land .= '</div></div>';
	}
	
	if( $property->get_property_meta('property_bedrooms') != '' ) {
		$bed = '<div class="property-icon-item"><div class="property-icon-inner icon beds">';
		$bed .= '<h6><span class="property-icon-item-label">'.__('Bedrooms', 'mist').'</span>';
		$bed .= '<span class="property-icon-value">'. $property->get_property_meta('property_bedrooms') . '</span></h6>';
		$bed .= '</div></div>';
	}
	
	if( $property->get_property_meta('property_bathrooms') != '' ) {
		$bath = '<div class="property-icon-item"><div class="property-icon-inner icon bath">';
		$bath .= '<h6><span class="property-icon-item-label">'.__('Bathrooms', 'mist').'</span>';
		$bath .= '<span class="property-icon-value">'. $property->get_property_meta('property_bathrooms') . '</span></h6>';
		$bath .= '</div></div>';
	}
	
	if( $property->get_property_meta('property_rooms') != '' ) {
		$rooms = '<div class="property-icon-item"><div class="property-icon-inner icon rooms">';
		$rooms .= '<h6><span class="property-icon-item-label">'.__('Rooms', 'mist').'</span>';
		$rooms .= '<span class="property-icon-value">'. $property->get_property_meta('property_rooms') . '</span></h6>';
		$rooms .= '</div></div>';
	}
	
	if( $property->get_property_meta('property_garage') != '' && $property->get_property_meta('property_carport') != '' ) {
		$property_parking = '';
		
		$property_garage 	= intval($property->get_property_meta('property_garage'));
		$property_carport 	= intval($property->get_property_meta('property_carport'));
		$property_parking 	= $property_carport + $property_garage;
		if( $property_parking != 0 ) {
			$parking = '<div class="property-icon-item"><div class="property-icon-inner icon parking">';
			$parking .= '<h6><span class="property-icon-item-label">'.__('Parking Spaces', 'mist').'</span>';
			$parking .= '<span class="property-icon-value">'. $property_parking . '</span></h6>';
			$parking .= '</div></div>';
		}
	}
	
	$property_new_construction = $property->get_property_meta('property_new_construction');
	if( isset($property_new_construction) && ($property_new_construction == 1 || $property_new_construction == 'yes') ) {
		$construction = '<div class="property-icon-item"><div class="property-icon-inner icon new_construction">';
		$construction .= '<h6><span class="property-icon-item-label">'.__('Construction', 'mist').'</span>';
		$construction .= '<span class="property-icon-value">'. __('New', 'mist') . '</span></h6>';
		$construction .= '</div></div>';
	}
	
	$property_category = $property->get_property_category();
	if( isset( $property_category ) && $property_category != '' ) {
		$category = '<div class="property-icon-item"><div class="property-icon-inner icon type_category">';
		$category .= '<h6><span class="property-icon-item-label">'.__('Type', 'mist').'</span>';
		$category .= '<span class="property-icon-value">'. $property_category . '</span></h6>';
		$category .= '</div></div>';
	}
		
	return $land . $bed . $bath . $rooms . $parking . $construction . $category;
}

function zozo_epl_property_icons() {
	echo zozo_epl_get_property_icons();
}
add_action('zozo_epl_property_icons','zozo_epl_property_icons');

function zozo_epl_loop_get_property_icons( $show_all = 'yes', $only_bb = 'no' ) {
	global $property;
	$land = $bed = $bath = $rooms = $parking = $construction = $category = '';
	
	$property_land_area_unit = $property->get_property_meta('property_land_area_unit');
	if( isset( $property_land_area_unit ) && $property_land_area_unit == 'squareMeter' ) {
		$property_land_area_unit = __('sqm' , 'mist');
	}
	if( intval( $property->get_property_meta('property_land_area') ) != 0 ) {
		$land = '<div class="property-icon-item"><div class="property-icon-inner">';
		$land .= '<h6><span class="property-icon"><svg viewBox="0 0 48 48" height="20" width="20" version="1.1" x="0" y="0" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><path d="M46 16v-12c0-1.104-.896-2.001-2-2.001h-12c0-1.103-.896-1.999-2.002-1.999h-11.997c-1.105 0-2.001.896-2.001 1.999h-12c-1.104 0-2 .897-2 2.001v12c-1.104 0-2 .896-2 2v11.999c0 1.104.896 2 2 2v12.001c0 1.104.896 2 2 2h12c0 1.104.896 2 2.001 2h11.997c1.106 0 2.002-.896 2.002-2h12c1.104 0 2-.896 2-2v-12.001c1.104 0 2-.896 2-2v-11.999c0-1.104-.896-2-2-2zm-4.002 23.998c0 1.105-.895 2.002-2 2.002h-31.998c-1.105 0-2-.896-2-2.002v-31.999c0-1.104.895-1.999 2-1.999h31.998c1.105 0 2 .895 2 1.999v31.999zm-5.623-28.908c-.123-.051-.256-.078-.387-.078h-11.39c-.563 0-1.019.453-1.019 1.016 0 .562.456 1.017 1.019 1.017h8.935l-20.5 20.473v-8.926c0-.562-.455-1.017-1.018-1.017-.564 0-1.02.455-1.02 1.017v11.381c0 .562.455 1.016 1.02 1.016h11.39c.562 0 1.017-.454 1.017-1.016 0-.563-.455-1.019-1.017-1.019h-8.933l20.499-20.471v8.924c0 .563.452 1.018 1.018 1.018.561 0 1.016-.455 1.016-1.018v-11.379c0-.132-.025-.264-.076-.387-.107-.249-.304-.448-.554-.551z"/></svg></span>';
		$land .= '<span class="property-icon-value">'. $property->get_property_meta('property_land_area') . ' '.$property_land_area_unit.'</span></h6>';
		$land .= '</div></div>';
	}
	
	if( $property->get_property_meta('property_bedrooms') != '' ) {
		$bed = '<div class="property-icon-item"><div class="property-icon-inner">';
		$bed .= '<h6><span class="property-icon"><svg version="1.1" id="layer-icon-bed" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" width="20" height="20" viewBox="0 0 240 240" enable-background="new 0 0 240 240"><path d="M80,119.834c0,13.241-10.729,23.979-23.963,23.979c-13.232,0-23.962-10.737-23.962-23.979  c0-13.239,10.729-23.975,23.962-23.975C69.271,95.859,80,106.595,80,119.834z M80,143.812c42.6,0,85.201,0,127.801,0  C162.759,100.185,125.654,102.203,80,143.812L80,143.812z M224.025,112.094v47.953H15.975V80H0v127.875h15.975v-16.109h208.05V208  H240v-95.906H224.025z"/></svg></span>';
		$bed .= '<span class="property-icon-value">'. $property->get_property_meta('property_bedrooms') . ' '.__('Bedrooms', 'mist').'</span></h6>';
		$bed .= '</div></div>';
	}
	
	if( $property->get_property_meta('property_bathrooms') != '' ) {
		$bath = '<div class="property-icon-item"><div class="property-icon-inner">';
		$bath .= '<h6><span class="property-icon"><svg xml:space="preserve" enable-background="new 0 0 24 24" viewBox="0 0 24 24" height="20" width="20" y="0px" x="0px" id="Layer_1" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><path d="M23.001 12h-1.513C21.805 11.6 22 11.1 22 10.5C22 9.1 20.9 8 19.5 8S17 9.1 17 10.5 c0 0.6 0.2 1.1 0.5 1.5H2.999c0-0.001 0-0.002 0-0.002V2.983V2.98c0.084-0.169-0.083-0.979 1-0.981h0.006 C4.008 2 4.3 2 4.5 2.104L4.292 2.292c-0.39 0.392-0.39 1 0 1.415c0.391 0.4 1 0.4 1.4 0l2-1.999 c0.39-0.391 0.39-1.025 0-1.415c-0.391-0.391-1.023-0.391-1.415 0L5.866 0.72C5.775 0.6 5.7 0.5 5.5 0.4 C4.776 0 4.1 0 4 0H3.984v0.001C1.195 0 1 2.7 1 2.98v0.019v0.032v8.967c0 0 0 0 0 0.002H0.999 C0.447 12 0 12.4 0 12.999S0.447 14 1 14H1v2.001c0.001 2.6 1.7 4.8 4 5.649V23c0 0.6 0.4 1 1 1s1-0.447 1-1v-1h10v1 c0 0.6 0.4 1 1 1s1-0.447 1-1v-1.102c2.745-0.533 3.996-3.222 4-5.897V14h0.001C23.554 14 24 13.6 24 13 S23.554 12 23 12z M21.001 16.001c-0.091 2.539-0.927 3.97-3.001 3.997H7c-2.208-0.004-3.996-1.79-4-3.997V14h15.173 c-0.379 0.484-0.813 0.934-1.174 1.003c-0.54 0.104-0.999 0.446-0.999 1c0 0.6 0.4 1 1 1 c2.159-0.188 3.188-2.006 3.639-2.999h0.363V16.001z" class="path"/>
<rect height="1.4" width="1" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 15.6319 3.2336)" y="4.1" x="6.6" class="rect"/>
<rect height="1" width="1.4" transform="matrix(0.7066 0.7076 -0.7076 0.7066 4.9969 -6.342)" y="2.4" x="9.4" class="rect"/>
<rect height="1" width="1.4" transform="matrix(0.7071 0.7071 -0.7071 0.7071 7.8179 -5.167)" y="6.4" x="9.4" class="rect"/>
<rect height="1" width="1.4" transform="matrix(0.7069 0.7073 -0.7073 0.7069 7.2858 -7.8754)" y="4.4" x="12.4" class="rect"/>
<rect height="1" width="1.4" transform="matrix(-0.7064 -0.7078 0.7078 -0.7064 18.5823 23.4137)" y="7.4" x="13.4" class="rect"/>
</svg></span>';
		$bath .= '<span class="property-icon-value">'. $property->get_property_meta('property_bathrooms') . ' '.__('Bathrooms', 'mist').'</span></h6>';
		$bath .= '</div></div>';
	}
	
	if( $property->get_property_meta('property_garage') != '' ) {
		$property_garage = '';
		$property_garage 	= intval($property->get_property_meta('property_garage'));
		if( $property_garage != 0 ) {
			$parking = '<div class="property-icon-item"><div class="property-icon-inner">';
			$parking .= '<h6><span class="property-icon"><svg xml:space="preserve" enable-background="new 0 0 24 24" viewBox="0 0 24 24" height="20" width="20" y="0px" x="0px" id="Layer_garage" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
<path d="M23.958 0.885c-0.175-0.64-0.835-1.016-1.475-0.842l-11 3.001c-0.64 0.173-1.016 0.833-0.842 1.5 c0.175 0.6 0.8 1 1.5 0.842L16 4.299V6.2h-0.001H13c-2.867 0-4.892 1.792-5.664 2.891L5.93 11.2H5.024 c-0.588-0.029-2.517-0.02-3.851 1.221C0.405 13.1 0 14.1 0 15.201V18.2v2H2h2.02C4.126 22.3 5.9 24 8 24 c2.136 0 3.873-1.688 3.979-3.801H16V24h2V3.754l5.116-1.396C23.756 2.2 24.1 1.5 24 0.885z M8 22 c-1.104 0-2-0.896-2-2.001s0.896-2 2-2S10 18.9 10 20S9.105 22 8 22.001z M11.553 18.2C10.891 16.9 9.6 16 8 16 c-1.556 0-2.892 0.901-3.553 2.201H2v-2.999c0-0.599 0.218-1.019 0.537-1.315C3.398 13.1 5 13.2 5 13.2h2L9 10.2 c0 0 1.407-1.999 4-1.999h2.999H16v10H11.553z"/>
</svg></span>';
			if( $property_garage == 1 ) { 
				$parking .= '<span class="property-icon-value">'. $property_garage . ' '.__('Garage', 'mist').'</span></h6>';
			} else {
				$parking .= '<span class="property-icon-value">'. $property_garage . ' '.__('Garages', 'mist').'</span></h6>';
			}
			$parking .= '</div></div>';
		}
	}
	
	if( $show_all == 'yes' ) {
		return $land . $bed . $bath . $parking;
	} elseif( $only_bb == 'yes' && $show_all == 'no' ) {
		return $bed . $bath;
	}
}

function zozo_epl_loop_property_icons() {
	echo zozo_epl_loop_get_property_icons();
}
add_action('zozo_epl_loop_property_icons', 'zozo_epl_loop_property_icons');
remove_action('epl_property_icons', 'epl_property_icons');
add_action('epl_property_icons', 'zozo_epl_loop_property_icons', 10);

function zozo_epl_get_property_bb_icons() {
	echo zozo_epl_loop_get_property_icons( $show_all = 'no', $only_bb = 'yes' );
}
add_action('zozo_epl_get_property_bb_icons', 'zozo_epl_get_property_bb_icons');

function zozo_epl_property_tab_section() {
	global $property;
	$post_type = $property->post_type;
	$the_property_feature_list = '';
	
	if ( 'commercial' == $post_type || 'commercial_land' == $post_type || 'business' == $post_type ) {
		$the_property_feature_list .= $property->get_property_commercial_category('li');
	}
	
	$additional_features 	= array (
		'property_remote_garage',
		'property_secure_parking',
		'property_study',
		'property_dishwasher',
		'property_built_in_robes',
		'property_gym',
		'property_workshop',
		'property_rumpus_room',
		'property_floor_boards',
		'property_broadband',
		'property_pay_tv',
		'property_vacuum_system',
		'property_intercom',
		'property_spa',
		'property_tennis_court',
		'property_balcony',
		'property_deck',
		'property_courtyard',
		'property_outdoor_entertaining',
		'property_shed',
		'property_open_fire_place',
		'property_ducted_cooling',
		'property_split_system_heating',
		'property_hydronic_heating',
		'property_split_system_aircon',
		'property_gas_heating',
		'property_reverse_cycle_aircon',
		'property_evaporative_cooling'

	);
	$additional_features = apply_filters('epl_property_additional_features_list',$additional_features);
	
	if ( 'property' == $property->post_type || 'rental' == $property->post_type || 'rural' == $property->post_type){
		foreach($additional_features as $additional_feature){
			$the_property_feature_list .= $property->get_additional_features_html($additional_feature);
		}
	}
	
	if( $property->post_type != 'land' || $property->post_type != 'business') {
		if( $the_property_feature_list != '' ) { ?>
			<h5 class="tab-title"><?php _e('Additional Features', 'mist'); ?></h5>
			<div class="epl-tab-content tab-content">
				<ul class="listing-info epl-tab-<?php echo esc_attr( $property->get_epl_settings('display_feature_columns') ); ?>-columns">
					<?php echo ''. $the_property_feature_list; ?>							
				</ul>
			</div>
	<?php }
	} ?>

	<div class="epl-tab-content epl-tab-content-additional tab-content">
		<?php
			//Land Category
			if( 'land' == $property->post_type || 'commercial_land' == $property->post_type ) {
				echo '<div class="epl-land-category">' . $property->get_property_land_category() . '</div>';
			}
			
			//Commercial Options
			if ( $property->post_type == 'commercial' ) {
				if ( $property->get_property_meta('property_com_plus_outgoings') == 1) {
					echo '<div class="epl-commercial-outgoings price-type">'.__('Plus Outgoings', 'mist').'</div>';
				}
			}
		?>
	</div>
<?php }
add_action('zozo_epl_property_tab_section', 'zozo_epl_property_tab_section');

function zozo_epl_property_video_callback( $width = 600 ) {

	global $property;
	$property_video_url	= $property->get_property_meta('property_video_url');
	
	if( isset( $property_video_url ) && $property_video_url != '' ) {
		echo '<div class="epl-tab-section epl-tab-section-video">';
		echo '<h5 class="tab-title">'. apply_filters('epl_property_tab_title_video',__('Property Video', 'mist')) .'</h5>';
		echo '<div class="tab-content">';
		
		if ( has_post_thumbnail() ) { ?>
			<div class="epl-video-featured-image">
				<a href="<?php echo esc_url( $property_video_url ); ?>" class="epl-video-play" data-rel="prettyPhoto">
					<div class="epl-play-btn"></div>
					<?php the_post_thumbnail( 'blog-large' ); ?>
				</a>
			</div>
		<?php } else { 
			$video_width = $width != '' ? $width : 600;
			echo epl_get_video_html($property_video_url, $video_width);
		}
		
		echo '</div>';
		echo '</div>';
	}
	
}
remove_action('epl_property_content_after', 'epl_property_video_callback');
add_action('zozo_epl_property_video', 'zozo_epl_property_video_callback', 10, 2);

function zozo_epl_property_map_wrapper_before() {
	echo '<div class="epl-tab-section epl-tab-section-map">';
	echo '<h5 class="tab-title">'. apply_filters('epl_property_tab_title_map', __('Property Map', 'mist')) .'</h5>';
	echo '<div class="tab-content">';
}
add_action('epl_property_map', 'zozo_epl_property_map_wrapper_before', 1);

function zozo_epl_property_map_wrapper_after() {
	echo '</div>';
	echo '</div>';
}
add_action('epl_property_map', 'zozo_epl_property_map_wrapper_after', 99);

remove_action('epl_buttons_single_property', 'epl_buttons_wrapper_before', 1);
remove_action('epl_buttons_single_property', 'epl_buttons_wrapper_after', 99);

/**
 * This shortcode allows for you to specify the property type(s) using 
 * [listing post_type="property,rental" status="current,sold,leased" template="default"] option. You can also 
 * limit the number of entries that display. using  [listing limit="5"]
 */
function zozo_epl_shortcode_listing( $atts ) {
	$property_types = epl_get_active_post_types();
	if(!empty($property_types)) {
		 $property_types = array_keys($property_types);
	}
	
	extract( shortcode_atts( array(
		'post_type' 	=>	$property_types, //Post Type
		'status'		=>	array('current' , 'sold' , 'leased' ),
		'limit'			=>	'10', // Number of maximum posts to show
		'template'		=>	false, // Template can be set to "slim" for home open style template
		'location'		=>	'', // Location slug. Should be a name like sorrento
		'tools_top'		=>	'off', // Tools before the loop like Sorter and Grid on or off
		'tools_bottom'	=>	'off', // Tools after the loop like pagination on or off
		'sortby'		=>	'', // Options: price, date : Default date
		'sort_order'	=>	'DESC',
		'navigation'	=>	'on', // Previous/Next page navigation on or off
		'query_object'	=>	'' // only for internal use . if provided use it instead of custom query 
	), $atts ) );
	
	if(is_string($post_type) && $post_type == 'rental') {
		$meta_key_price = 'property_rent';
	} else {
		$meta_key_price = 'property_price';
	}
	
	$sort_options = array(
		'price'			=>	$meta_key_price,
		'date'			=>	'post_date'
	);
	if( !is_array($post_type) ) {
		$post_type 			= array_map('trim',explode(',',$post_type) );
	}
	ob_start();
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array(
		'post_type' 		=>	$post_type,
		'posts_per_page'	=>	$limit,
		'paged' 		=>	$paged
	);
	
	if(!empty($location) ) {
		if( !is_array( $location ) ) {
			$location = explode(",", $location);
			$location = array_map('trim', $location);
			
			$args['tax_query'][] = array(
				'taxonomy'	=> 'location',
				'field'		=> 'slug',
				'terms' 	=> $location
			);
		}
	}
	
	if(!empty($status)) {
		if(!is_array($status)) {
			$status = explode(",", $status);
			$status = array_map('trim', $status);
			
			$args['meta_query'][] = array(
				'key'		=> 'property_status',
				'value'		=> $status,
				'compare'	=> 'IN'
			);
			
			add_filter('epl_sorting_options','epl_sorting_options_callback');
		}
	}

	if( $sortby != '' ) {
	
		if($sortby == 'price') {
			$args['orderby']	=	'meta_value_num';
			$args['meta_key']	=	$meta_key_price;
		} else {
			$args['orderby']	=	'post_date';
			$args['order']		=	'DESC';

		}
		$args['order']			=	$sort_order;
	}
	
	if( isset( $_GET['sortby'] ) ) {
		$orderby = sanitize_text_field( trim($_GET['sortby']) );
		if($orderby == 'high') {
			$args['orderby']	=	'meta_value_num';
			$args['meta_key']	=	$meta_key_price;
			$args['order']		=	'DESC';
		} elseif($orderby == 'low') {
			$args['orderby']	=	'meta_value_num';
			$args['meta_key']	=	$meta_key_price;
			$args['order']		=	'ASC';
		} elseif($orderby == 'new') {
			$args['orderby']	=	'post_date';
			$args['order']		=	'DESC';
		} elseif($orderby == 'old') {
			$args['orderby']	=	'post_date';
			$args['order']		=	'ASC';
		} elseif($orderby == 'status_desc') {
			$args['orderby']	=	'meta_value';
			$args['meta_key']	=	'property_status';
			$args['order']		=	'DESC';
		} elseif($orderby == 'status_asc') {
			$args['orderby']	=	'meta_value';
			$args['meta_key']	=	'property_status';
			$args['order']		=	'ASC';
		}
		
	}

	$query_open = new WP_Query( $args );
	
	if( is_object($query_object) ) {
		$query_open = $query_object;
	}
	
	if ( $query_open->have_posts() ) { ?>
		<div class="zozo-epl-listings-wrapper epl-shortcode">
			<div class="entry-content loop-content epl-shortcode-listing <?php echo epl_template_class( $template ); ?>">
				<?php
					if ( $tools_top == 'on' ) {
						do_action( 'epl_property_loop_start' );
					}
				?>
				<div class="zozo-epl-listing-loop epl-clearfix">
				<?php	
					while ( $query_open->have_posts() ) {
						$query_open->the_post();
						$template = str_replace('_','-',$template);
						epl_property_blog($template);
					}
				?>
				</div>
				<?php
					if ( $tools_bottom == 'on' ) {
						do_action( 'epl_property_loop_end' );
					}
				?>
			</div>
			<?php if ( $navigation == 'on' ) { ?>
				<div class="loop-footer">
					<?php do_action('epl_pagination', array('query'	=>	$query_open)); ?>
				</div>
			<?php } ?>
			
		</div>
		<?php 
	} else { ?>
		<div class="zozo-epl-listings-wrapper">
			<div class="entry-header clearfix">
				<h3 class="entry-title"><?php _e('Listing not Found', 'mist'); ?></h3>
			</div>
		</div>
	<?php }
	wp_reset_postdata();
	return ob_get_clean();
}
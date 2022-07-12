<?php
/*
 * Single Property Template: Expanded
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
global $epl_settings, $property; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-listing-single epl-property-single view-expanded' ); ?>>

	<div class="entry-content epl-content epl-clearfix">
	
		<div class="epl-property-wrapper epl-clearfix">
			<div class="col-md-8 col-xs-12 property-gallery-wrapper">
				<?php $attachments = ''; $attachments_count = '';
	
				$attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				$attachments_count = sizeof( $attachments );
				if( !empty($epl_settings) && isset($epl_settings['display_single_gallery'])) {
					$d_gallery		= $epl_settings['display_single_gallery'];
				}
				
				if( ( $attachments && $attachments_count > 1 ) && $d_gallery == 1 ) { ?>
					<div class="epl-gallery property-gallery">
						<div class="epl-gallery-entry zozo-owl-carousel epl-gallery-carousel epl-clearfix" data-items="1" data-slideby="1" data-items-tablet="1" data-items-mobile-landscape="1" data-items-mobile-portrait="1" data-autoplay="true" data-autoplay-timeout="5000" data-loop="false" data-pagination="true" data-navigation="false">
							<?php get_gallery_post_images( 'portfolio-large', get_the_ID() ); ?>
						</div>
					</div>
					<?php
				} else { 
					do_action( 'epl_property_featured_image', 'portfolio-large' );
				} ?>
			</div>
			<div class="col-md-4 col-xs-12 property-details-wrapper">
				<!-- Heading -->
				<h4 class="single-property-title"><?php do_action('epl_property_heading'); ?></h4>
				<!-- Price -->
				<?php do_action('epl_property_price_before'); ?>
				<div class="property-meta pricing">
					<?php do_action('epl_property_price'); ?>
				</div>
				<?php do_action('epl_property_price_after'); ?>
				
				<div class="property-feature-icons epl-clearfix">
					<?php do_action('zozo_epl_property_icons'); ?>				
				</div>
				
				<?php do_action('epl_property_land_category'); ?>
				<?php do_action('epl_property_commercial_category'); ?>
				
				<div class="zozo-epl-button-wrapper epl-clearfix">
					<div class="share-icon">
						<h6 class="share-btn zozo-epl-button"><i class="fa fa-share-alt"></i><?php _e('Share', 'mist'); ?></h6>
						<div class="epl-share-icons-wrapper">
							<?php zozo_display_social_sharing_icons(); ?>
						</div>
					</div>
					<div class="printer-icon">
						<h6><a href="javascript:window.print()" class="zozo-epl-button"><i class="fa fa-print"></i><?php _e('Print', 'mist'); ?></a></h6>
					</div>
				</div>
			</div>
		</div>
		
		<?php if ( is_active_sidebar( 'epl-sidebar' ) ) { ?>
			<div class="property-content-wrapper">
				<div class="row">
					<div class="col-md-8 col-xs-12 property-content-inner">
		<?php } ?>
		<div class="tab-wrapper">
			<div class="epl-tab-section epl-section-property-details">
				<h5 class="tab-title"><?php echo apply_filters('property_tab_title',__('Property Details', 'mist')); ?></h5>
				<div class="tab-content">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<ul class="property-details">
								<?php if ( $property->get_property_meta('property_unique_id') != '' ) { ?>
								<li class="property-details-item">
									<p class="tab-property-id">
										<span class="property-label"><?php _e('Property ID:', 'mist'); ?></span>
										<span class="item-uniqueid"><?php echo ''. $property->get_property_meta('property_unique_id'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if ( $property->get_property_meta('property_year_built') != '' ) { ?>
								<li class="property-details-item">
									<p class="tab-property-builtin">
										<span class="property-label"><?php _e('Built In:', 'mist'); ?></span>
										<span class="item-builtin"><?php echo ''. $property->get_property_meta('property_year_built'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if ( $property->get_property_meta('property_status') != '' ) { ?>
								<li class="property-details-item">
									<p class="tab-property-status">
										<span class="property-label"><?php _e('Status:', 'mist'); ?></span>
										<span class="item-status"><?php echo ''. $property->get_property_meta('property_status'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if ( $property->get_property_meta('property_address_display') == 'yes' ) { ?>
								<li class="property-details-item">
									<p class="tab-address">
										<span class="property-label"><?php _e('Address:', 'mist'); ?></span>
										<span class="item-street"><?php echo ''. $property->get_formatted_property_address(); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if( $property->get_property_meta('property_com_display_suburb') != 'no' || $property->get_property_meta('property_address_display') == 'yes' ) { ?>
								<li class="property-details-item">
									<p class="tab-suburb">
										<span class="property-label"><?php _e('Suburb:', 'mist'); ?></span>
										<span class="item-suburb"><?php echo ''. $property->get_property_meta('property_address_suburb'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if( $property->get_epl_settings('epl_enable_city_field') == 'yes' ) { ?>
								<li class="property-details-item">
									<p class="tab-suburb">
										<span class="property-label"><?php _e('City:', 'mist'); ?></span>
										<span class="item-city"><?php echo ''. $property->get_property_meta('property_address_city'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if ( $property->get_property_meta('property_address_state') != '' ) { ?>
								<li class="property-details-item">
									<p class="tab-state">
										<span class="property-label"><?php _e('State:', 'mist'); ?></span>
										<span class="item-state"><?php echo ''. $property->get_property_meta('property_address_state'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if ( $property->get_property_meta('property_address_postal_code') != '' ) { ?>
								<li class="property-details-item">
									<p class="tab-pcode">
										<span class="property-label"><?php _e('Zipcode:', 'mist'); ?></span>
										<span class="item-pcode"><?php echo ''. $property->get_property_meta('property_address_postal_code'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if( $property->get_epl_settings('epl_enable_country_field') == 'yes' ) { ?>
								<li class="property-details-item">
									<p class="tab-country">
										<span class="property-label"><?php _e('Country:', 'mist'); ?></span>
										<span class="item-country"><?php echo ''. $property->get_property_meta('property_address_country'); ?></span>
									</p>
								</li>
								<?php } ?>
							</ul>
						</div>
						<div class="col-md-6 col-xs-12">
							<ul class="property-details">
								<?php if( 'rental' == $property->post_type && $property->get_property_meta('property_date_available') != '' && $property->get_property_meta('property_status') != 'leased' ) { ?>
								<li class="property-details-item">
									<p class="tab-property-dateavailable">
										<span class="property-label"><?php _e('Available from:', 'mist'); ?></span>
										<span class="item-dateavailable"><?php echo ''. $property->get_property_available(); ?></span>
									</p>
								</li>
								<?php } ?>
								
								<?php if( intval( $property->get_property_meta('property_land_area') ) != 0 ) { 
								$property_land_area_unit = '';
								$property_land_area_unit = $property->get_property_meta('property_land_area_unit');
								if( isset( $property_land_area_unit ) && $property_land_area_unit == 'squareMeter' ) {
									$property_land_area_unit = __('sqm' , 'mist');
								} ?>
								<li class="property-details-item">
									<p class="tab-property-landarea">
										<span class="property-label"><?php _e('Land Area:', 'mist'); ?></span>
										<span class="item-landarea"><?php echo ''. $property->get_property_meta('property_land_area') . ' ' . $property_land_area_unit; ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if( intval( $property->get_property_meta('property_building_area') ) != 0 ) { 
								$building_unit = '';
								$building_unit = $property->get_property_meta('property_building_area_unit');
								if( isset( $building_unit ) && $building_unit == 'squareMeter' ) {
									$building_unit = 'm²';
								} ?>
								<li class="property-details-item">
									<p class="tab-property-floorarea">
										<span class="property-label"><?php _e('Floor Area:', 'mist'); ?></span>
										<span class="item-floorarea"><?php echo ''. $property->get_property_meta('property_building_area') . ' ' . $building_unit; ?></span>
									</p>
								</li>
								<?php } ?>
								<?php $property_air_conditioning = $property->get_property_meta('property_air_conditioning');
								if( isset($property_air_conditioning) && ($property_air_conditioning == 1 || $property_air_conditioning == 'yes') ) { ?>
								<li class="property-details-item">
									<p class="tab-property-aircool">
										<span class="property-label"><?php _e('Air Conditioning:', 'mist'); ?></span>
										<span class="item-aircool"><?php _e('Yes', 'mist'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php $property_pool = $property->get_property_meta('property_pool');
								if( isset($property_pool) && ($property_pool == 1 || $property_pool == 'yes') ) { ?>
								<li class="property-details-item">
									<p class="tab-property-pool">
										<span class="property-label"><?php _e('Pool:', 'mist'); ?></span>
										<span class="item-pool"><?php _e('Yes', 'mist'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php $property_security_system = $property->get_property_meta('property_security_system');
								if( isset($property_security_system) && ($property_security_system == 1 || $property_security_system == 'yes') ) { ?>
								<li class="property-details-item">
									<p class="tab-property-alarm">
										<span class="property-label"><?php _e('Alarm System:', 'mist'); ?></span>
										<span class="item-alarm"><?php _e('Yes', 'mist'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if( $property->get_property_meta('property_carport') != '' ) { ?>
								<li class="property-details-item">
									<p class="tab-carport">
										<span class="property-label"><?php _e('Carport:', 'mist'); ?></span>
										<span class="item-carport"><?php echo ''. $property->get_property_meta('property_carport'); ?></span>
									</p>
								</li>
								<?php } ?>
								<?php if( $property->get_property_meta('property_garage') != '' ) { ?>
								<li class="property-details-item">
									<p class="tab-garage">
										<span class="property-label"><?php _e('Garage:', 'mist'); ?></span>
										<span class="item-garage"><?php echo ''. $property->get_property_meta('property_garage'); ?></span>
									</p>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php $property_inspection_times = '';
						$property_inspection_times = $property->get_property_inspection_times();
						if( trim( $property_inspection_times ) != '' ) { ?>
						<div class="row">
							<div class="col-xs-12 property-inspection-wrapper">
								<div class="property-details-inspection">
									<h6><?php echo ''. $property->get_epl_settings('label_home_open'); ?></h6>
									<div class="property-inspection-content epl-clearfix">
										<?php echo ''. $property_inspection_times; ?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			
			<div class="epl-tab-section epl-section-description">
				<h5 class="tab-title"><?php echo apply_filters('epl_property_tab_title_description',__('Description', 'mist')); ?></h5>
				<div class="tab-content">
					<?php
						do_action('epl_property_content_before');
						
						do_action('epl_property_the_content');
						
						do_action('epl_property_content_after');
					?>
				</div>
			</div>
			
			<?php $property_features_list = '';
			$property_features_list = $property->get_features_from_taxonomy();
			if( $property_features_list != '' ) { ?>
				<div class="epl-tab-section epl-tab-section-features-list">
					<h5 class="tab-title"><?php echo apply_filters('epl_property_tab_title_features',__('Features', 'mist')); ?></h5>
					<div class="tab-content">
						<ul class="property-features-list">
							<?php echo ''. $property_features_list; ?>
						</ul>
					</div>
				</div>
			<?php } ?>

			<?php do_action('epl_property_tab_section_before'); ?>
			<div class="epl-tab-section epl-tab-section-features">
				<?php do_action('zozo_epl_property_tab_section'); ?>
			</div>
			<?php do_action('epl_property_tab_section_after'); ?>
			
			<?php do_action( 'zozo_epl_property_video' ); ?>
			
			<?php do_action( 'epl_property_map' ); ?>
			
			<?php ob_start();
			do_action( 'epl_buttons_single_property' ); 
			$single_buttons = ob_get_clean(); 
			
			if( isset( $single_buttons ) && $single_buttons != '' ) { ?>
				<div class="epl-tab-section epl-tab-button-wrapper">
					<h5 class="tab-title"><?php echo apply_filters('epl_property_tab_title_buttons',__('Property Attachments', 'mist')); ?></h5>
					<div class="tab-content">
						<h6><?php do_action( 'epl_buttons_single_property' ); ?></h6>
					</div>
				</div>
			<?php } ?>
			
			<?php do_action( 'epl_single_extensions' ); ?>

			<?php do_action( 'epl_single_before_author_box' ); ?>
			<?php do_action( 'epl_single_author' ); ?>
			<?php do_action( 'epl_single_after_author_box' ); ?>
		</div>
		<!-- categories, tags and comments -->
		<div class="entry-footer epl-clearfix">
			<div class="entry-meta">
				<?php wp_link_pages( array( 'before' => '<div class="entry-utility entry-pages">' . __( 'Pages:', 'mist' ) . '', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>		
			</div>
		</div>
		
		<?php comments_template(); ?>
	
		<?php if ( is_active_sidebar( 'epl-sidebar' ) ) { ?>
				</div>
				<div class="col-md-4 col-xs-12 property-sidebar-inner">
					<div id="epl-sidebar" class="epl-sidebar sidebar">
						<?php dynamic_sidebar( 'epl-sidebar' ); ?>	
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<!-- end property -->
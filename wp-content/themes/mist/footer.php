<?php
/**
 * The template for displaying the footer.
 *
 * @package Zozothemes
 */
 
 global $zozo_options;
?>
	</div><!-- #main -->
	
	<?php // Featured Post Slider for Home
	if( is_home() ) { 
		if( isset( $zozo_options['zozo_show_blog_featured_slider'] ) && $zozo_options['zozo_show_blog_featured_slider'] == 1 && $zozo_options['zozo_featured_slider_type'] == 'above_footer' ) {
			get_template_part('partials/blog/featured', 'slider' );	
	 	} 
	} 
	// Featured Post Slider for Archives
	elseif( ( ( is_archive() || is_tag() || is_category() ) && ! is_post_type_archive() ) && ! ( is_tax('product_cat') || is_tax('product_tag' ) ) ) { 
		if( isset( $zozo_options['zozo_show_archive_featured_slider'] ) && $zozo_options['zozo_show_archive_featured_slider'] == 1 && $zozo_options['zozo_featured_slider_type'] == 'above_footer' ) {
			get_template_part('partials/blog/featured', 'slider' );	
	 	}
	} ?>
	
	<?php if( isset( $zozo_options['zozo_footer_style'] ) && $zozo_options['zozo_footer_style'] == 'hidden' ) { ?>
		</div><!-- .wrapper-inner -->
	<?php } ?>
	
	<div id="footer" class="footer-section footer-style-<?php echo esc_attr( $zozo_options['zozo_footer_style'] ); ?> footer-skin-<?php echo esc_attr( $zozo_options['zozo_footer_skin'] ); ?>">	
		<?php $object_id = get_queried_object_id();
	
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
		
		$show_footer_widgets = '';
		$show_footer_widgets = get_post_meta( $post_id, 'zozo_show_footer_widgets', true );
		if( isset( $show_footer_widgets ) && $show_footer_widgets == '' || $show_footer_widgets == 'default' ) {
			$show_footer_widgets = $zozo_options['zozo_footer_widgets_enable'];
			if( $show_footer_widgets == 1 ) {
				$show_footer_widgets = 'yes';
			} else {
				$show_footer_widgets = 'no';
			}
		}
		
		$show_footer_menu = '';
		$show_footer_menu = get_post_meta( $post_id, 'zozo_show_footer_menu', true );
		if( isset( $show_footer_menu ) && $show_footer_menu == '' || $show_footer_menu == 'default' ) {
			$show_footer_menu = $zozo_options['zozo_enable_footer_menu'];
			if( $show_footer_menu == 1 ) {
				$show_footer_menu = 'yes';
			} else {
				$show_footer_menu = 'no';
			}
		}
				
		if( isset( $show_footer_widgets ) && $show_footer_widgets == 'yes' ) { ?>
		<div id="footer-widgets-container" class="footer-widgets-section">
			<div class="container">
				<div class="zozo-row row">
					<?php						
						$columns = footer_widget_column_classes( 'yes', 'no' );
						$classes = footer_widget_column_classes( 'no', 'yes' );
						
						for( $i = 1; $i <= intval( $columns ); $i++ ) { 
							if( is_active_sidebar( 'footer-widget-' . $i ) ) { ?>
							<div id="footer-widgets-<?php echo esc_attr( $i ); ?>" class="footer-widgets <?php echo esc_attr( $classes[$i] ); ?>">
								<?php dynamic_sidebar( 'footer-widget-' . esc_attr( $i ) ); ?>
							</div>
							<?php }	
						} ?>
				</div><!-- .row -->
			</div>
		</div><!-- #footer-widgets-container -->
		<?php } ?>
		
		<div id="footer-copyright-container" class="footer-copyright-section">
			<div class="container">
				<div class="zozo-row row">
					<?php if( $zozo_options['zozo_enable_back_to_top'] ) {
							$copyright_class = "col-sm-7";
						}
						else {
							$copyright_class = "col-sm-12";
						}
					?>
					
					<div id="copyright-text" class="<?php echo esc_attr( $copyright_class ); ?>">
						<?php if( $zozo_options['zozo_copyright_text'] ) {						
						echo '<p>'.do_shortcode( $zozo_options['zozo_copyright_text'] ).'</p>';							
						} else { ?>						
						<p>&copy; <?php esc_html_e('Copyright', 'mist'); ?> <?php echo date('Y'); ?>. <?php echo esc_html( bloginfo( 'name' ) ); ?>. <?php esc_html_e('All rights reserved.', 'mist'); ?></p>
						<?php } ?>
						
						<?php if( isset( $show_footer_menu ) && $show_footer_menu == 'yes' ) { ?>
						<div class="footer-menu-wrapper">
							<!-- ==================== Footer Menu ==================== -->
							<div class="hidden-xs">
								<?php echo wp_nav_menu( array( 'container_class' => 'zozo-nav footer-menu-navigation', 'container_id' => 'footer-nav', 'menu_id' => 'footer-menu', 'menu_class' => 'nav navbar-nav zozo-footer-nav', 'theme_location' => 'footer-menu', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker() ) ); ?>
							</div>
							<!-- ==================== Mobile Menu ==================== -->
							<div id="footer-mobile-menu-wrapper" class="visible-xs mobile-menu">
								<?php echo wp_nav_menu( array( 'container_class' => 'zozo-nav footer-menu-navigation', 'container_id' => 'footer-mobile-nav', 'menu_id' => 'footer-mobile-menu', 'menu_class' => 'nav navbar-nav zozo-footer-nav', 'theme_location' => 'footer-menu', 'fallback_cb' => 'wp_bootstrap_mobile_navwalker::fallback', 'walker' => new wp_bootstrap_mobile_navwalker() ) ); ?>
							</div>
						</div>
						<?php } ?>
						
					</div><!-- #copyright-text -->									
					<?php if( $zozo_options['zozo_enable_back_to_top'] ) { ?>
					<div id="zozo-back-to-top" class="footer-backtotop col-sm-5 text-right">					
						<a href="#zozo_wrapper"><i class="glyphicon glyphicon-arrow-up"></i></a>
					</div><!-- #zozo-back-to-top -->
					<?php } ?>
					
				</div>
			</div>
		</div><!-- #footer-copyright-container -->		
	</div><!-- #footer -->
</div>
<?php wp_footer(); ?>

</body>
</html>
<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Zozothemes
 */
 
global $zozo_options;
$sidebar_widget = $layout = $home_id = '';

	if( is_singular() ) {
		$layout = get_post_meta( $post->ID, 'zozo_layout', true );
		$sidebar_widget = get_post_meta( $post->ID, 'zozo_primary_sidebar', true );
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
		$sidebar_widget = get_post_meta( $home_id, 'zozo_primary_sidebar', true );
	}
	
	if ( is_singular( 'post' ) ) {
		$layout = get_post_meta( $post->ID, 'zozo_layout', true );
		if( !$layout ) {
			$layout = $zozo_options['zozo_single_post_layout'];
		}
		$sidebar_widget = get_post_meta( $post->ID, 'zozo_primary_sidebar', true );
	}
	
	if( !$layout ) {			
		if( $zozo_options['zozo_layout'] != '' ) {		
			$layout = $zozo_options['zozo_layout'];
		}
		else {
			$layout = 'two-col-right';
		}
	}
	
	if( $sidebar_widget == '' || $sidebar_widget == '0' ) {
		$sidebar_widget = 'primary';
	}
		
	if( $layout != 'one-col' ) {
		
		if ( is_active_sidebar( $sidebar_widget ) ) {	
?>
<div id="sidebar" class="primary-sidebar sidebar <?php zozo_primary_sidebar_classes(); ?>">
	<?php dynamic_sidebar( $sidebar_widget ); ?>	
</div><!-- #sidebar -->

<?php } // End Active Sidebar IF Statement

	} // End Layout IF Statement
?>
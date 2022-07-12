<?php
/**
 * The Sidebar containing the secondary widget areas.
 *
 * @package Zozothemes
 */

global $zozo_options;
$sidebar_widget = $choosed_layout = $layouts = $home_id = '';

	if( is_singular() ) {
		$choosed_layout = get_post_meta( $post->ID, 'zozo_layout', true );		
		$sidebar_widget = get_post_meta( $post->ID, 'zozo_secondary_sidebar', true );	
	}
	
	if( is_archive() ) {
		$choosed_layout = $zozo_options['zozo_blog_archive_layout'];
	}
	
	if( is_home() ) {
		$home_id = get_option( 'page_for_posts' );			
		$choosed_layout = get_post_meta( $home_id, 'zozo_layout', true );
		if( !$choosed_layout ) {
			$choosed_layout = $zozo_options['zozo_blog_layout'];
		}
		$sidebar_widget = get_post_meta( $home_id, 'zozo_secondary_sidebar', true );
	}
	
	if ( is_singular( 'post' ) ) {
		$choosed_layout = get_post_meta( $post->ID, 'zozo_layout', true );
		if( !$choosed_layout ) {
			$choosed_layout = $zozo_options['zozo_single_post_layout'];
		}
		
		$sidebar_widget = get_post_meta( $post->ID, 'zozo_secondary_sidebar', true );
	}
	
	if( !$choosed_layout ) {			
		if( $zozo_options['zozo_layout'] != '' ) {		
			$choosed_layout = $zozo_options['zozo_layout'];
		}
		else {
			$choosed_layout = 'two-col-right';
		}
	}	
	
	if( $sidebar_widget == '' || $sidebar_widget == '0' ) {
		$sidebar_widget = 'secondary';
	}
	
	$layouts = array( 'three-col-middle', 'three-col-right', 'three-col-left' );
	
	if ( in_array( $choosed_layout, $layouts ) ) {
		
		if ( is_active_sidebar( $sidebar_widget ) ) {	
?>
<div id="secondary-sidebar" class="secondary-sidebar sidebar <?php zozo_secondary_sidebar_classes(); ?>">
	<?php dynamic_sidebar( $sidebar_widget ); ?>	
</div><!-- #secondary-sidebar -->
<?php } // End Active Sidebar IF Statement

} // End Layouts IF Statement
?>
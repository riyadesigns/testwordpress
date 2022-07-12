<?php global $post, $zozo_options;
$post_id = '';
$object_id = get_queried_object_id();

if( is_search() ) {
	$post_id = '';
}
if( ! is_search() ) {
	$post_id = '';
	if ( ! is_home() && ! is_front_page() && ! is_archive() && isset( $object_id ) ) {
		$post_id = $object_id;
	}
	if ( ! is_home() && is_front_page() && isset( $object_id ) ) {
		$post_id = $object_id;
	}
	if ( is_home() && ! is_front_page() ) {
		$post_id = get_option( 'page_for_posts' );
	}
	if ( class_exists( 'Woocommerce' ) ) {
		if ( is_shop() ) {
			$post_id = get_option( 'woocommerce_shop_page_id' );
		}
	}
}
$rev_slider 	= get_post_meta( $post_id, 'zozo_revolutionslider', true );

if( class_exists( 'RevSlider' ) && isset( $rev_slider ) && $rev_slider != '' ) {
	echo '<div class="zozo-revslider-section">';
	echo do_shortcode($rev_slider);
	echo '</div>';
}
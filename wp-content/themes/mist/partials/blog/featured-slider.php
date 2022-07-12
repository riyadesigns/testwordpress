<?php global $zozo_options;
	
$output = $data_attr = $extra_class = '';	

if( isset( $zozo_options['zozo_featured_slider_citems'] ) && $zozo_options['zozo_featured_slider_citems'] != '' ) {
	$data_attr .= ' data-items=' . $zozo_options['zozo_featured_slider_citems'] . ' ';
}

if( isset( $zozo_options['zozo_featured_slider_citems_scroll'] ) && $zozo_options['zozo_featured_slider_citems_scroll'] != '' ) {
	$data_attr .= ' data-slideby=' . $zozo_options['zozo_featured_slider_citems_scroll'] . ' ';
}

if( isset( $zozo_options['zozo_featured_slider_ctablet'] ) && $zozo_options['zozo_featured_slider_ctablet'] != '' ) {
	$data_attr .= ' data-items-tablet=' . $zozo_options['zozo_featured_slider_ctablet'] . ' ';
}

if( isset( $zozo_options['zozo_featured_slider_cmlandscape'] ) && $zozo_options['zozo_featured_slider_cmlandscape'] != '' ) {
	$data_attr .= ' data-items-mobile-landscape=' . $zozo_options['zozo_featured_slider_cmlandscape'] . ' ';
}

if( isset( $zozo_options['zozo_featured_slider_cmportrait'] ) && $zozo_options['zozo_featured_slider_cmportrait'] != '' ) {
	$data_attr .= ' data-items-mobile-portrait=' . $zozo_options['zozo_featured_slider_cmportrait'] . ' ';
}

if( isset( $zozo_options['zozo_featured_slider_cautoplay'] ) && $zozo_options['zozo_featured_slider_cautoplay'] == 1 ) {
	$data_attr .= ' data-autoplay=true ';
} else {
	$data_attr .= ' data-autoplay=false ';
}

if( isset( $zozo_options['zozo_featured_slider_ctimeout'] ) && $zozo_options['zozo_featured_slider_ctimeout'] != '' ) {
	$data_attr .= ' data-autoplay-timeout=' . $zozo_options['zozo_featured_slider_ctimeout'] . ' ';
}

if( isset( $zozo_options['zozo_featured_slider_cloop'] ) && $zozo_options['zozo_featured_slider_cloop'] == 1 ) {
	$data_attr .= ' data-loop=true ';
} else {
	$data_attr .= ' data-loop=false ';
}

if( isset( $zozo_options['zozo_featured_slider_cmargin'] ) && $zozo_options['zozo_featured_slider_cmargin'] != '' ) {
	$data_attr .= ' data-margin=' . $zozo_options['zozo_featured_slider_cmargin'] . ' ';
}

if( isset( $zozo_options['zozo_featured_slider_cdots'] ) && $zozo_options['zozo_featured_slider_cdots'] == 1 ) {
	$data_attr .= ' data-pagination=true ';
	$extra_class = ' slider-dots-active';
} else {
	$data_attr .= ' data-pagination=false ';
}

if( isset( $zozo_options['zozo_featured_slider_cnav'] ) && $zozo_options['zozo_featured_slider_cnav'] == 1 ) {
	$data_attr .= ' data-navigation=true ';
} else {
	$data_attr .= ' data-navigation=false ';
}
	
$posts_count = is_numeric($zozo_options['zozo_featured_posts_limit']) ? $zozo_options['zozo_featured_posts_limit'] : 6;	
	
$slider_args = array(
			'posts_per_page' 		=> $posts_count,
			'orderby' 		 		=> 'date',
			'order' 		 		=> 'DESC',
		);
		
$slider_args['tax_query'] = array( array( 
									'taxonomy' 	=> 'post_tag', 
									'field' 	=> 'slug', 
									'terms' 	=> 'featured' 
								));

$featured_slider = new WP_Query($slider_args);
	
if ( $featured_slider->have_posts() ) {
	
	echo '<div id="featured-carousel" class="zozo-owl-carousel owl-carousel featured-carousel-'. $zozo_options['zozo_featured_slider_citems'] .' featured-carousel-slider'.$extra_class.'"'. $data_attr .'>'; ?>
		
	<?php while( $featured_slider->have_posts() ) : $featured_slider->the_post();
		$slider_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-medium');
		
		if( has_post_format('link') ) {
			$external_url = '';
			$external_url = get_post_meta( $post->ID, 'zozo_external_link_url', true );
			if( isset( $external_url ) && $external_url == '' ) {
				$external_url = get_permalink( $post->ID );
			}
		}  ?>
		
		<div class="featured-item">
			<img src="<?php echo esc_url( $slider_image[0] ); ?>" alt="<?php the_title(); ?>">
			<div class="featured-caption">
				<div class="featured-caption-inner">
					<div class="featured-category">
						<?php $categories = get_the_category();
						if( $categories ){
							foreach($categories as $category) {
								echo '<span class="post-category"><a href="'. get_category_link( $category->term_id ).'">' . $category->cat_name . '</a></span>';
							}
						} ?>
					</div>
					<h5 class="featured-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
					<div class="featured-description">
						<p><?php echo zozo_shortcode_stripped_excerpt( get_the_content(), 10 ); ?></p>
					</div>
					<div class="read-more">
						<?php if( has_post_format('link') ) { ?>
							<a href="<?php echo esc_url($external_url); ?>" class="btn-more read-more-link" target="_blank">
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>" class="btn-more read-more-link">
						<?php } ?>
							<?php if( ! $zozo_options['zozo_blog_read_more_text'] ) { 
								esc_html_e('Read more', 'mist'); 
							} else { 
								echo esc_attr($zozo_options['zozo_blog_read_more_text']); 
							} ?>						
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile;	?>
	
	</div>
<?php }

wp_reset_postdata(); ?>
<?php
/**
 * Related Posts
 */

global $zozo_options, $post; 

$tags = wp_get_post_tags($post->ID);
if($tags) {
	$tag_ids = array();
	foreach($tags as $tag) {
		$tag_ids[] = $tag->term_id;
	}
	
	$args = array(
		'tag__in'    	=> $tag_ids,
		'post__not_in'   => array($post->ID),
		'posts_per_page' => -1,    
	);
	
	// Slider Configuration
	$data_attr = '';
	
	if( isset( $zozo_options['zozo_related_blog_items'] ) && $zozo_options['zozo_related_blog_items'] != '' ) {
		$data_attr .= ' data-items=' . $zozo_options['zozo_related_blog_items'] . ' ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_items_scroll'] ) && $zozo_options['zozo_related_blog_items_scroll'] != '' ) {
		$data_attr .= ' data-slideby=' . $zozo_options['zozo_related_blog_items_scroll'] . ' ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_tablet'] ) && $zozo_options['zozo_related_blog_tablet'] != '' ) {
		$data_attr .= ' data-items-tablet=' . $zozo_options['zozo_related_blog_tablet'] . ' ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_landscape'] ) && $zozo_options['zozo_related_blog_landscape'] != '' ) {
		$data_attr .= ' data-items-mobile-landscape=' . $zozo_options['zozo_related_blog_landscape'] . ' ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_portrait'] ) && $zozo_options['zozo_related_blog_portrait'] != '' ) {
		$data_attr .= ' data-items-mobile-portrait=' . $zozo_options['zozo_related_blog_portrait'] . ' ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_autoplay'] ) && $zozo_options['zozo_related_blog_autoplay'] == 1 ) {
		$data_attr .= ' data-autoplay=true ';
	} else {
		$data_attr .= ' data-autoplay=false ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_timeout'] ) && $zozo_options['zozo_related_blog_timeout'] != '' ) {
		$data_attr .= ' data-autoplay-timeout=' . $zozo_options['zozo_related_blog_timeout'] . ' ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_loop'] ) && $zozo_options['zozo_related_blog_loop'] == 1 ) {
		$data_attr .= ' data-loop=true ';
	} else {
		$data_attr .= ' data-loop=false ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_margin'] ) && $zozo_options['zozo_related_blog_margin'] != '' ) {
		$data_attr .= ' data-margin=' . $zozo_options['zozo_related_blog_margin'] . ' ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_dots'] ) && $zozo_options['zozo_related_blog_dots'] == 1 ) {
		$data_attr .= ' data-pagination=true ';
	} else {
		$data_attr .= ' data-pagination=false ';
	}
	
	if( isset( $zozo_options['zozo_related_blog_nav'] ) && $zozo_options['zozo_related_blog_nav'] == 1 ) {
		$data_attr .= ' data-navigation=true ';
	} else {
		$data_attr .= ' data-navigation=false ';
	}
	
	$related_query = new WP_Query($args);
	if( $related_query->have_posts() ) { ?>
		<div class="related-posts-wrapper">
			<h3 class="related-title"><?php esc_html_e('Related Posts', 'mist'); ?></h3>
			<div id="single-related-posts" class="zozo-owl-carousel related-posts-slider owl-carousel"<?php echo esc_attr( $data_attr ); ?>>
				<?php while ($related_query->have_posts()) {
					$related_query->the_post();
					
					if( has_post_format('link') ) {
						$external_url = '';
						$external_url = get_post_meta( $post->ID, 'zozo_external_link_url', true );
						if( isset( $external_url ) && $external_url == '' ) {
							$external_url = get_permalink( $post->ID );
						}
					}
								
					if ( has_post_thumbnail() ) { ?>
						<div class="related-post-item">
							<div class="entry-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="post-img">
									<?php the_post_thumbnail( 'blog-medium' ); ?>
								</a>
							</div>
							<div class="related-content-wrapper">
								<h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-link"><?php the_title(); ?></a></h5>
								<div class="related-post-summary">
									<p><?php echo zozo_shortcode_stripped_excerpt( get_the_content(), '20' ); ?></p>
								</div>
								<div class="related-post-more">
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
					<?php } else { ?>
						<div class="related-post-item">
							<div class="entry-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="post-img">
									<img src="<?php echo ZOZOTHEME_URL; ?>/images/empty.jpg" class="img-responsive" alt="<?php the_title_attribute(); ?>" />											
								</a>
							</div>
							<div class="related-content-wrapper">
								<h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-link"><?php the_title(); ?></a></h5>													
								<div class="related-post-summary">
									<p><?php echo zozo_shortcode_stripped_excerpt( get_the_content(), '20' ); ?></p>
								</div>
								<div class="related-post-more">
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
					<?php }
				} ?>
			</div>				
		</div>
	<?php } 
	wp_reset_postdata();
}
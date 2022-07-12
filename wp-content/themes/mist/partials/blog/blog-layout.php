<?php
/**
 * Fullwidth Post Template
 *
 * It is used to display the content for Large Layout
 *
 * @package Zozothemes
 */

global $zozo_options, $post;

if( has_post_format('link') ) {
	$external_url = '';
	$external_url = get_post_meta( $post->ID, 'zozo_external_link_url', true );
	if( isset( $external_url ) && $external_url == '' ) {
		$external_url = get_permalink( $post->ID );
	}
} 

if( ! isset( $post_class ) || isset( $post_class ) && $post_class == '' ) {
	$post_class = '';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<div class="post-inner-wrapper">
		
		<?php include( locate_template( 'partials/blog/post-slider.php' ) ); ?>
		
		<div class="posts-content-container">
		<?php if( has_post_format('quote') ) { ?>			
			<!-- ========== Entry Content ========== -->			
			<div class="entry-summary clearfix">
				<div class="entry-quotes quote-format">
					<blockquote>
						<p><?php echo zozo_blog_trim_excerpt( $excerpt_limit ); ?></p>
						<!-- ========== Title ========== -->
						<footer>
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h2>
						</footer>
					</blockquote>
					<?php wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mist' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) );
					?>
				</div>
			</div><!-- .entry-summary -->
		<?php } else { ?>
			<!-- ========== Title ========== -->
			<div class="entry-header">
				<h2 class="entry-title">
					<?php if( has_post_format('link') ) { ?>
						<a href="<?php echo esc_url($external_url); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
					<?php } else { ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					<?php } ?>
				</h2>
			</div><!-- .entry-header -->
			
			<!-- ========== Entry Content ========== -->
			<div class="entry-summary clearfix">
				<p><?php echo zozo_blog_trim_excerpt( $excerpt_limit ); ?></p>
				<?php wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mist' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-summary -->
			
			<!-- ========== Entry Meta ========== -->
			<div class="entry-meta-wrapper">
				<ul class="entry-meta">
					<!-- Sticky Post -->
					<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
						<li class="sticky-post"><i class="fa fa-thumb-tack"></i> <span class="meta-name"><?php esc_html_e('Featured', 'mist'); ?></span></li>						
					<?php } ?>
					<!-- Entry Author -->
					<?php if( ! $zozo_options['zozo_blog_post_meta_author'] ): ?>
						<li class="author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></li>
					<?php endif; ?>
					<!-- Entry Date -->
					<?php if( ! $zozo_options['zozo_blog_post_meta_date'] ): ?>
						<li class="posted-date"><i class="fa fa-calendar"></i><?php the_time( $zozo_options['zozo_blog_date_format'] ); ?></li>
					<?php endif; ?>					
					<!-- Entry Category -->
					<?php if( ! $zozo_options['zozo_blog_post_meta_categories'] ): ?>
						<li class="category"><i class="fa fa-folder"></i><?php echo get_the_category_list(', '); ?></li>
					<?php endif; ?>
					<!-- Comments -->
					<?php if( ! $zozo_options['zozo_blog_post_meta_comments'] ): ?>
						<?php if ( comments_open() ) { ?>
							<li class="comments-link"><i class="fa fa-comments"></i><?php comments_popup_link( '<span class="leave-reply">' . esc_html__( '0 Comment', 'mist' ) . '</span>', esc_html__( '1 Comment', 'mist' ), esc_html__( '% Comments', 'mist' ) ); ?>
						</li>
						<?php }
					endif; ?>
				</ul>
			</div>
							
			<!-- ========== Read More Link ========== -->				
			<?php if( ! $zozo_options['zozo_blog_read_more'] ) { ?>
				<div class="entry-footer clearfix">
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
			<?php } ?>
		<?php } ?>
		</div><!-- .posts-content-container -->	
		
	</div><!-- .post-inner-wrapper -->
</article><!-- #post -->
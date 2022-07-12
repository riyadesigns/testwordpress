<?php
/**
 * Loop Property Template: Default
 *
 * @package easy-property-listings
 * @subpackage Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $property, $post;
$meta = get_post_custom();
$property_featured = '';
if(isset($meta['property_featured'])) {
	if(isset($meta['property_featured'][0])) {
		$property_featured = $meta['property_featured'][0];
	}
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('epl-listing-post epl-property-blog epl-clearfix'); ?>>
	<?php do_action('epl_property_before_content'); ?>
		<?php if ( has_post_thumbnail() ) :
			$image_class = 'teaser-left-thumb'; ?>
			<div class="property-box property-box-left property-featured-image-wrapper">
				<div class="epl-archive-entry-image">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<div class="epl-blog-image">
							<?php if( epl_get_price_sticker() || ( isset( $property_featured ) && $property_featured == 'yes' ) ) { ?>
							<div class="epl-stickers-wrapper">
								<?php if( epl_get_price_sticker() ) { ?>
								<div class="epl-offer-sticker">
								<h6><?php echo epl_get_price_sticker(); ?></h6>
								</div>
								<?php } ?>
								<?php if( isset( $property_featured ) && $property_featured == 'yes' ) { ?>
								<div class="epl-featured-sticker">
									<h6><span class="status-sticker featured"><?php esc_html_e('Featured', 'mist'); ?></span></h6>
								</div>
								<?php } ?>
							</div>
							<?php } ?>
							<?php the_post_thumbnail( 'portfolio-mid' , array( 'class' => $image_class ) ); ?>
							<!-- Price -->
							<div class="price">
								<h5><?php do_action('epl_property_price'); ?></h5>
							</div>
						</div>
					</a>
				</div>
			</div>
		<?php else: ?>
			<!-- Price -->
			<div class="price">
				<h5><?php do_action('epl_property_price'); ?></h5>
			</div>
		<?php endif; ?>

		<div class="property-box property-box-right property-content">
			<!-- Category -->
			<p class="property-category"><?php echo '<span class="epl-property-category">' . $property->get_property_category() . '</span>'; ?></p>
			<!-- Heading -->
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php do_action('epl_property_heading'); ?></a></h3>
			<!-- Address -->
			<div class="property-address">
				<p><?php do_action('epl_property_address'); ?></p>
			</div>
			<div class="entry-content epl-list-view-content">
				<p><?php echo zozo_shortcode_stripped_excerpt( get_the_content(), 40 ); ?></p>
			</div>
			<!-- Property Featured Icons -->
			<div class="property-feature-icons">
				<?php do_action('zozo_epl_loop_property_icons'); ?>
			</div>
		</div>
	<?php do_action('epl_property_after_content'); ?>
</div>
<?php
/**
 * Loop Property Template: Table
 *
 * @package easy-property-listings
 * @subpackage Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $property;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('epl-listing-post epl-property-blog epl-property-table epl-table epl-clearfix'); ?>>
	<?php do_action('epl_property_before_content'); ?>				
		<div class="epl-table-column-image property-featured-image-wrapper">
			<a href="<?php the_permalink(); ?>">
				<div class="epl-blog-image">
					<?php the_post_thumbnail( 'epl-image-medium-crop', array( 'class' => 'teaser-left-thumb' ) ); ?>
				</div>
			</a>
		</div>

		<div class="epl-table-column-content property-box property-box-right property-content">
			<!-- Address -->
			<div class="epl-table-box epl-table-column epl-table-column-left">
				<!-- Heading -->
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php do_action('epl_property_heading'); ?></a></h3>
				<!-- Address -->
				<div class="property-address">
					<p><?php do_action('epl_property_address'); ?></p>
				</div>
			</div>
			<!-- Property Featured Icons -->
			<div class="epl-table-box epl-table-column epl-table-column-middle"> 
				<div class="property-feature-icons">
					<?php do_action('zozo_epl_loop_property_icons'); ?>			
				</div>
			</div>
			<!-- Price -->
			<div class="epl-table-box epl-table-column epl-table-column-right">
				<?php do_action('epl_property_price'); ?>
			</div>
		</div>	
	<?php do_action('epl_property_after_content'); ?>
</div>

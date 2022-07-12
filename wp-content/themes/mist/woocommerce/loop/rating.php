<?php
/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;

$rating = $product->get_average_rating();

$rating_html  = '<div class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'mist' ), $rating ) . '">';

$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__( 'out of 5', 'mist' ) . '</span>';

$rating_html .= '</div>';

if ( $rating_html ) : ?>
<div class="zozo-woo-rating">
	<?php echo wp_kses( $rating_html, zozo_expanded_allowed_tags() ); ?>
</div>
<?php endif; ?>

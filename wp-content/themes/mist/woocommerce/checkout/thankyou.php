<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-order">

	<?php if ( $order ) : ?>
		<div class="zozo-woocommerce-thank-you">
			<?php if ( $order->has_status( 'failed' ) ) : ?>
			
				<h6 class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'mist' ); ?></h6>

				<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
					<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'mist' ) ?></a>
					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'mist' ); ?></a>
					<?php endif; ?>
				</p>

			<?php else : ?>
			
				<h4 class="thank-you-title"><?php echo apply_filters( 'woocommerce_thankyou_order_received_title', esc_html__( 'Order Received', 'mist' ), $order ); ?></h4>

				<h6 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received thank-you-text"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'mist' ), $order ); ?></h6>

				<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details order_info">

					<li class="woocommerce-order-overview__order order">
						<?php _e( 'Order number:', 'mist' ); ?>						
						<strong><?php echo wp_kses_post( $order->get_order_number() ); ?></strong>
					</li>

					<li class="woocommerce-order-overview__date date">
						<?php _e( 'Date:', 'mist' ); ?>
						<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
					</li>

					<li class="woocommerce-order-overview__total total">
						<?php _e( 'Total:', 'mist' ); ?>						
						<strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
					</li>

					<?php if ( $order->get_payment_method_title() ) : ?>

					<li class="woocommerce-order-overview__payment-method method">
						<?php _e( 'Payment method:', 'mist' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>						
					</li>

					<?php endif; ?>

				</ul>

			<?php endif; ?>

			<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		</div>
	
		<div class="zozo-woocommerce-order-details">
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
		</div>	

	<?php else : ?>

		<h5 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'mist' ), null ); ?></h5>
			
	<?php endif; ?>

</div>

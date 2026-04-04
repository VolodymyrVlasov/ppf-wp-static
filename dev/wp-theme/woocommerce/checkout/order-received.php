<?php
/**
 * "Order received" message.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.3.0
 *
 * @var WC_Order|false $order
 */

defined('ABSPATH') || exit;
?>

<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
<p class="text_32"> PPF ORDER RECEIVED</p>
<?php
/**
 * Filter the message shown after a checkout is complete.
 *
 * @since 2.2.0
 *
 * @param string         $message The message.
 * @param WC_Order|false $order   The order created during checkout, or false if order data is not available.
 */
$message = apply_filters(
	'woocommerce_thankyou_order_received_text',
	esc_html(__('Thank you. Your order has been received.', 'woocommerce')),
	$order
);

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $message;

?>
</p>


<p class="text_32"> PPF ORDER RECEIPT</p>

<ul class="order_details">
	<li class="order">
		<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
		<strong><?php echo esc_html( $order->get_order_number() ); ?></strong>
	</li>
	<li class="date">
		<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
		<strong><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></strong>
	</li>
	<li class="total">
		<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
		<strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
	</li>
	<?php if ( $order->get_payment_method_title() ) : ?>
	<li class="method">
		<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
		<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
	</li>
	<?php endif; ?>
</ul>

<?php do_action( 'woocommerce_receipt_' . $order->get_payment_method(), $order->get_id() ); ?>

<div class="clear"></div>
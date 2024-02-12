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

$order_id = isset($_GET['key']) ? wc_get_order_id_by_order_key($_GET['key']) : 0;

if (!$order_id) {
	// ID заказа не найден в URL или не является числом
	echo 'ID заказа не найден или некорректен.';
}


if ($order_id) {
	// ID заказа успешно получен, можно использовать его для нужных операций

	$order = wc_get_order($order_id);

	if (!$order) {
		echo 'Заказ с таким ID не найден.';
	} else {
		echo 'ID заказа: ' . $order_id;
		$order_total = $order->get_total();
		echo 'Общая стоимость заказа: ' . wc_price($order_total);
		// $order_data = $order->get_data();

		// foreach ($order_data as $key => $value) {
		// 	echo '<p><strong>' . $key . ':</strong> ' . $value . '</p>';
		// }
	}
} else {

	echo 'ID заказа не найден или некорректен.';
}
?>


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

<div class="col">
	<?php wc_get_template('checkout/ppf-order-receipt.php', array('order' => $order)); ?>
</div>
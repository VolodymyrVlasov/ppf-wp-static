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

<?php $order_id = isset($_GET['key']) ? wc_get_order_id_by_order_key($_GET['key']) : 0;
if ($order_id) {
	$order = wc_get_order($order_id);
	?>

	<?
	echo '$order->get_shipping_method' . $order->get_shipping_method();
	echo '$order->get_shipping_to_display()' . $order->get_shipping_to_display();
	?>
	<a href="<?php echo $order->get_cancel_order_url() ?>" class="button__secondary">Скасувати замовлення</a>
	<section class="section">
		<div class="container col_center big_gap">
			<div class="col_center gap">
				<img src="{{stylesheet_url}}/static/icons/icon-order-proceed.svg" alt="Замовлення отримано" width="65px" height="65px">
				<h1 class="text_32__bold">Дякуємо, <?php echo $order->get_billing_first_name();?>!</h1>
				<p class="text_16 text_center width_75">Замовлення сформоване успішно,<br> найближчим часом ми його отримаємо, перевіремо всі деталі і <bp>надамо зворотній зв'язок.<br>
				</p>
			</div>
			<span class="text_12__gray">Всі деталі замовлення надіслано на
				<?php echo $order->get_billing_email() ?>
			</span>

			<div class="col_center width_100 big_gap">
				<?php wc_get_template('checkout/ppf-order-receipt.php', array('order' => $order)); ?>
			</div>
			<p>Якщо у Вас є питання, напишіть нам:</p>
		</div>
		<?php $checkout_nonce = wp_create_nonce("woocommerce-process_checkout"); ?>
		<input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="<?php echo esc_attr($checkout_nonce) ?>" />
	</section>
<?php } else {
	echo 'ID заказа не найден или некорректен.';
}
?>
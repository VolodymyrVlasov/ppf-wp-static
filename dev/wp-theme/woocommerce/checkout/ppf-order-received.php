<?php
/**
 * "Order received" message.
 */

defined('ABSPATH') || exit;
?>

<?php $order_id = isset($_GET['key']) ? wc_get_order_id_by_order_key($_GET['key']) : 0;
if ($order_id) {
	$order = wc_get_order($order_id);
	?>

	<section class="section">
		<div class="container col_center big_gap">
			<div class="col_center gap">
				<img src="{{stylesheet_url}}/static/icons/icon-order-proceed.svg" alt="Замовлення отримано" width="65px" height="65px">
				<h1 class="text_32__bold">
					<?php echo "Дякуємо, " . $order->get_billing_first_name() . "!"; ?>
				</h1>
				<p class="text_16 text_center width_75">Замовлення сформоване,<br> найближчим часом ми його отримаємо, перевіремо всі деталі і <bp>надамо зворотній зв'язок.<br>
				</p>
			</div>
			<span class="text_16 text_center">Подробиці замовлення надіслали на
				<?php echo $order->get_billing_email() ?>
			</span>
			<?php wc_get_template('checkout/ppf-order-receipt.php', array('order' => $order)); ?>
		</div>
	</section>

	<?php wc_get_template('template-parts/ppf-contact-section.php', array('contact_section_title' => "Якщо у Вас є питання, напишіть нам")); ?>
	<div class="checkout_thankyou_wrapper">
		<?php do_action('woocommerce_thankyou', $order->get_id()); ?>
	</div>
<?php } else {
	echo 'ID заказа не найден или некорректен.';
}
?>
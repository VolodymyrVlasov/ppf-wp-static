<?php
/**
 * Checkout Order Receipt Template
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<div class="row big_gap width_100">
	<div class="col_center small_gap cards_4">
		<span class="text_12__gray text_center">Замовлення</span>
		<span class="text_16__bold text_center">
			<?php echo '#' . esc_html($order->get_order_number()); ?>
		</span>
	</div>
	<div class="col_center small_gap cards_4">
		<span class="text_12__gray text_center">Сума замовлення</span>
		<span class="text_16__bold text_center">
			<?php echo wp_kses_post($order->get_formatted_order_total()); ?>
		</span>
	</div>
	<div class="col_center small_gap cards_4">
		<span class="text_12__gray text_center">Метод оплати</span>
		<span class="text_16__bold text_center">
			<?php echo wp_kses_post($order->get_payment_method_title()); ?>
		</span>
	</div>
	<div class="col_center small_gap cards_4">
		<span class="text_12__gray text_center">Доставка</span>
		<span class="text_16__bold text_center">
			<?php echo $order->get_shipping_method() ?>
		</span>
	</div>
</div>
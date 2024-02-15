<?php
/**
 * Checkout Order Receipt Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-receipt.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.2.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<div class="row width_100">
	<div class="col_center small_gap flex_1">
		<span class="text_12__gray text_center">Замовлення</span>
		<span class="text_16__bold text_center">
			<?php echo '#' . esc_html($order->get_order_number()); ?>
		</span>
	</div>
	<div class="col_center small_gap flex_1">
		<span class="text_12__gray text_center">Сума замовлення</span>
		<span class="text_16__bold text_center">
			<?php echo wp_kses_post($order->get_formatted_order_total()); ?>
		</span>
	</div>
	<div class="col_center small_gap flex_1">
		<span class="text_12__gray text_center">Метод оплати</span>
		<span class="text_16__bold text_center">
			<?php echo wp_kses_post($order->get_payment_method_title()); ?>
		</span>
	</div>
	<div class="col_center small_gap flex_1">
		<span class="text_12__gray text_center">Доставка</span>
		<span class="text_16__bold text_center">Самовивіз</span>
	</div>
</div>
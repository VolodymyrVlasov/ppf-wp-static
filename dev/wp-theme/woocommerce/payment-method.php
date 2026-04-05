<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>



<li class="checkout_input_radio_wrapper wc_payment_method payment_method_<?php echo esc_attr($gateway->id); ?>">
    <div class="checkout_input_radio">
        <input type="radio" name="payment_method" id="payment_method_<?php echo esc_attr($gateway->id); ?>"
            value="<?php echo esc_attr($gateway->id); ?>">
        <label for="payment_method_<?php echo esc_attr($gateway->id); ?>">
            <?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */?>
            <?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */?>
        </label>
    </div>
    <div class="checkout_input_radio_legend">
        <span class="text_12__gray">
            <?php $gateway->payment_fields(); ?>
        </span>
    </div>
</li>
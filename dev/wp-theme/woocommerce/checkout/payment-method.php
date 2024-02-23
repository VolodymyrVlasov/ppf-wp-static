<?php
/**
 * Output a single payment method
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<li class="checkout_input_radio_wrapper wc_payment_method payment_method_<?php echo esc_attr($gateway->id); ?>">
    <div class="checkout_input_radio">
        <input type="radio" name="payment_method" id="payment_method_<?php echo esc_attr($gateway->id); ?>"
            value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?>>
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
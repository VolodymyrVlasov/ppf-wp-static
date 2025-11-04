<?php
/**
 * Cart summary card template part.
 *
 * @package PaperFox\WooCommerce
 */

defined('ABSPATH') || exit;

$show_coupon = isset($args['show_coupon']) ? (bool) $args['show_coupon'] : false;
?>

<article class="cart_summary_card flex_2">
    <span class="text_32"><?php esc_html_e('Разом', 'paperfox'); ?></span>

    <div class="cart_summary_card_totals row_sp_btw small_gap">
        <div class="cart_summary_count col small_gap">
            <span class="text_12"><?php esc_html_e('Товарів:', 'paperfox'); ?></span>
            <span class="text_24">
                <?php
                printf(
                    /* translators: %d: cart items count */
                    esc_html__('%d шт.', 'paperfox'),
                    WC()->cart->get_cart_contents_count()
                );
                ?>
            </span>
        </div>

        <div class="cart_summary_card_price col small_gap">
            <span class="text_12"><?php esc_html_e('До сплати', 'paperfox'); ?></span>
            <span class="text_24 cart_summary_total_amount"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>
    </div>

    <?php if ($show_coupon && wc_coupons_enabled()) : ?>
        <div class="woocommerce-cart-form__coupon cart_summary_coupon col small_gap">
            <div class="checkout_input_text">
                <label for="coupon_code"><?php esc_html_e('Купон на знижку', 'paperfox'); ?></label>
                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Введіть код купона', 'paperfox'); ?>" />
            </div>
            <button type="submit" class="button__normal width_100" name="apply_coupon" value="<?php esc_attr_e('Застосувати купон', 'paperfox'); ?>">
                <?php esc_html_e('Застосувати', 'paperfox'); ?>
            </button>
            <?php do_action('woocommerce_cart_coupon'); ?>
        </div>
    <?php endif; ?>

    <div class="col small_gap">
        <?php do_action('woocommerce_cart_actions'); ?>

        <a class="button__primary width_100" href="<?php echo esc_url(wc_get_checkout_url()); ?>" title="<?php echo esc_attr__('Натисніть, щоб перейти до оформлення замовлення', 'paperfox'); ?>">
            <?php esc_html_e('ПЕРЕЙТИ ДО ОФОРМЛЕННЯ', 'paperfox'); ?>
        </a>
    </div>

    <span class="text_12">
        <?php esc_html_e('Підтверджуючи оформлення, ви переконуєтеся у відповідності дизайну або виробу, з можливими відхиленнями через технічні обмеження.', 'paperfox'); ?>
    </span>

    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
    <input type="hidden" name="cart" value="1" />
</article>

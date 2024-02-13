<?php
/**
 * Output ppf checkout form
 */

if (!defined('ABSPATH')) {
    exit;
}
?>


<article class="col big_gap">
    <h1 class="text_32__bold">Оформлення замовлення</h1>

    <?php do_action('woocommerce_before_checkout_form', $checkout); ?>

    <form name="checkout" method="post" class="checkout col big_gap width_100" action="https://shop.paperfox.in.ua/checkout/" enctype="multipart/form-data" novalidate="novalidate">

        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

        <div class="row big_gap">
            <div class="col big_gap flex_4" id="customer_details">
                <div class="col gap width_100">
                    <div class="woocommerce-billing-fields col gap width_100">
                        <div class="col gap width_100">
                            <!-- Замовник - контакти -->
                            <?php wc_get_template('checkout/ppf-checkout-billing-recepient.php'); ?>
                        </div>
                        <div class="col gap width_100">
                            <!-- Методи доставки -->
                            <?php wc_get_template('checkout/ppf-checkout-delivery.php'); ?>
                        </div>
                        <div class="col gap width_100">
                            <!-- Методи оплати -->
                            <h3 class="text_24">Оплата</h3>
                            <ul class="woocommerce-checkout-payment col big_gap width_100" id="payment"></ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php do_action('woocommerce_checkout_after_customer_details'); ?>

            <div id="order_review" class="cart_summary_card flex_2">
                <?php wc_get_template('checkout/ppf-checkout-cart-list.php'); ?>

                <button type="submit" class="button__primary width_100" name="woocommerce_checkout_place_order" id="place_order" value="Підтвердити замовлення" data-value="Підтвердити замовлення">Підтвердити замовлення</button>
                <div class="row">
                    <input type="checkbox" checked class="checkout_checkbox" required
                        id="user-policy-confirmation">
                    <label for="user-policy-confirmation" class="checkout_checkbox_label">Перейшовши до
                        оформнення Ви підтверджуєте що перевірили зміст та склад створенного дизайну або
                        обраного готового виробу. Готовий виріб або створений дизайн матиме вигляд що було
                        створено у редакторі або показано на фото з можливими відхилення згідно до технічних
                        можливостей</label>
                </div>
                <?php do_action('woocommerce_checkout_after_order_review'); ?>
            </div>

            <!-- Коментар -->
            <?php wc_get_template('checkout/ppf-checkout-comment.php'); ?>

            <?php $checkout_nonce = wp_create_nonce("woocommerce-process_checkout"); ?>
            <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="<?php echo esc_attr($checkout_nonce) ?>" />
        </div>

        <!-- <input type="hidden" name="npregionref" location="billing" value=""><input type="hidden" name="npregionname" location="billing" value="undefined"> -->
    </form>

    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>

</article>
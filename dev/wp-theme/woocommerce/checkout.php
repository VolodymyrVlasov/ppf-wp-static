<?php
/**
 * Template Name: Checkout Page
 */

?>

<?php defined('ABSPATH') || exit; ?>



<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="{{stylesheet_url}}/static/icons/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{stylesheet_url}}/style.css">
    <title>Оформлення замовлення | PaperFox</title>
    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>
        <section class="section">
            <div class="container  col big_gap">
                <article id="post-9" class=" col big_gap">
                    <h1 class="text_32__bold">Оформлення замовлення</h1>
                    <div class="entry-content">

                        <form name="checkout" method="post" class="checkout row big_gap" action="https://shop.paperfox.in.ua/checkout/" enctype="multipart/form-data" novalidate="novalidate">

                            <div class="col big_gap flex_4" id="customer_details">
                                <div class="col gap width_100">
                                    <div class="woocommerce-billing-fields col gap width_100">
                                        <h3 class="text_24">Ваші контактні дані</h3>
                                        <div class="col gap width_100">
                                            <!-- Замовник - контакти -->
                                            @@include('../../partials/checkout/checkout-billing-recepient.html')
                                            <div class="col gap width_100">
                                                <h2 class="text_24">Доставка</h2>
                                                <div class="woocommerce-shipping-fields">
                                                </div>
                                                <ul id="shipping_method" class="woocommerce-shipping-methods col gap width_100">
                                                    <!-- Самовивіз -->
                                                    <li class="checkout_input_radio_wrapper">
                                                        <div class="checkout_input_radio">
                                                            <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_pickup2" value="local_pickup:2" class="shipping_method">
                                                            <label for="shipping_method_0_local_pickup2">Самовивіз з офісу</label>
                                                        </div>
                                                        <span class="checkout_input_radio_legend">м. Київ, вул. Ярославська 14/20.
                                                            Окремий вхід з фасаду, цокольний поверх.<br>Видача замовлень: {{weekdays}}</span>
                                                    </li>
                                                    <!-- Нова Пошта -->
                                                    <li class="checkout_input_radio_wrapper">
                                                        <div class="checkout_input_radio">
                                                            <input type="radio" id="shipping_method_np_wrapper" checked>
                                                            <label for="shipping_method_0_nova_poshta_shipping_method">Нова Пошта</label>
                                                        </div>
                                                        <div class="checkout_input_radio_legend gap" id="shipping_method_0_nova_poshta_shipping_method_legend">
                                                            <div id="ship-to-different-address" class="checkout_input_checkbox margin-top">
                                                                <input id="ship-to-different-address-checkbox" type="checkbox" name="ship_to_different_address" value="1">
                                                                <label for="ship-to-different-address-checkbox">Інший отримувач?</label>
                                                            </div>

                                                            <!-- Інший отримувач - контакти -->
                                                            @@include('../../partials/checkout/checkout-shipping-recepient.html')

                                                            <!-- Нова Пошта - види доставки -->
                                                            @@include('../../partials/checkout/checkout-shipping-types.html')

                                                            <!-- Платіжна адреса (billing address) - Нова Пошта  -->
                                                            @@include('../../partials/checkout/checkout-billing-address.html')

                                                            <!-- Інший отримувач - Нова Пошта -->
                                                            @@include('../../partials/checkout/checkout-shipping-address.html')
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col gap width_100">
                                    <div class="woocommerce-additional-fields">
                                        <div class="woocommerce-additional-fields__field-wrapper">
                                            <p class="form-row notes" id="order_comments_field" data-priority=""><label for="order_comments" class="">Нотатки до замовлень&nbsp;<span class="optional">(необов'язково)</span></label><span class="woocommerce-input-wrapper"><textarea
                                                        name="order_comments" class="input-text " id="order_comments" placeholder="Нотатки до вашого замовлення, наприклад спеціальні нотатки для доставки." rows="2" cols="5"></textarea></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div id="payment" class="woocommerce-checkout-payment col gap width_100">
                                    <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_bacs">
                                            <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" data-order_button_text="">

                                            <label for="payment_method_bacs">
                                                Банківський переказ </label>
                                            <div class="payment_box payment_method_bacs" style="display:none;">
                                                <p>Проведіть платіж безпосередньо на наш банківський рахунок. Будь ласка, вкажіть номер Вашого замовлення в описі переказу. Ваше замовлення не буде виконано, доки кошти не будуть зараховані на наш рахунок.</p>
                                            </div>
                                        </li>
                                        <li class="wc_payment_method payment_method_mono_gateway">
                                            <input id="payment_method_mono_gateway" type="radio" class="input-radio" name="payment_method" value="mono_gateway" data-order_button_text="">

                                            <label for="payment_method_mono_gateway">
                                                Оплата онлайн з monopay <style>
                                                    .payment_method_mono_gateway>label {
                                                        display: flex;
                                                        align-items: center;
                                                    }
                                                </style>
                                                <div class="mono_pay_logo" style="display: flex;align-items: center;justify-content: center;flex: 1;"><img src="./Оформлення замовлення – PaperFox_files/footer_monopay_light_bg.svg" style="width: 85px;" alt="Mono"></div>
                                            </label>
                                        </li>
                                        <li class="wc_payment_method payment_method_morkva-liqpay">
                                            <input id="payment_method_morkva-liqpay" type="radio" class="input-radio" name="payment_method" value="morkva-liqpay" checked="checked" data-order_button_text="">

                                            <label for="payment_method_morkva-liqpay">
                                                LiqPay </label>
                                            <div class="payment_box payment_method_morkva-liqpay">
                                                <p>Оплата картою на сайті платіжної системи або у додатку Приват24</p>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div id="order_review" class="cart_summary_card flex_2">
                                <h3 id="order_review_heading">Ваше замовлення</h3>
                                <button type="submit" class="button__primary width_100" name="woocommerce_checkout_place_order" id="place_order" value="Підтвердити замовлення" data-value="Підтвердити замовлення">Підтвердити замовлення</button>

                                <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="e6c0c63e44"><input type="hidden" name="_wp_http_referer" value="/?wc-ajax=update_order_review">

                                <div class="row">
                                    <input type="checkbox" checked class="checkout_checkbox" required
                                        id="user-policy-confirmation">
                                    <label for="user-policy-confirmation" class="checkout_checkbox_label">Перейшовши до
                                        оформнення Ви підтверджуєте що перевірили зміст та склад створенного дизайну або
                                        обраного готового виробу. Готовий виріб або створений дизайн матиме вигляд що було
                                        створено у редакторі або показано на фото з можливими відхилення згідно до технічних
                                        можливостей</label>
                                </div>
                            </div>



                            <input type="hidden" name="npregionref" location="billing" value=""><input type="hidden" name="npregionname" location="billing" value="undefined">
                        </form>

                    </div><!-- .entry-content -->

                </article><!-- #post-## -->





            </div>
        </section>
    </main>

    <?php
    get_footer();
    wp_footer();
    ?>
</body>


<!-- @@include('../../pages/checkout/index.html') -->
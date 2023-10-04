
/**
 * Template Name: Checkout Page
 */


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
            <div class="container col big_gap">
                <article id="post-9" class="col big_gap">
                    <h1 class="text_32__bold">Оформлення замовлення</h1>


                    <form name="checkout" method="post" class="checkout row big_gap" action="https://shop.paperfox.in.ua/checkout/" enctype="multipart/form-data" novalidate="novalidate">

                        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                        <div class="col big_gap flex_4" id="customer_details">
                            <div class="col gap width_100">
                                <div class="woocommerce-billing-fields col gap width_100">
                                    <div class="col gap width_100">
                                        <!-- Замовник - контакти -->
                                        @@include('../../partials/checkout/checkout-billing-recepient.html')
                                    </div>
                                    <div class="col gap width_100">
                                        <!-- Методи доставки -->
                                        @@include('../../partials/checkout/checkout-delivery.html')
                                    </div>
                                    <div class="col gap width_100">
                                        <!-- Методи оплати -->
                                        <h3 class="text_24">Оплата</h3>
                                        <ul class="col gap width_100 woocommerce-checkout-payment" id="payment"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php do_action('woocommerce_checkout_after_customer_details'); ?>


                        <div id="order_review" class="cart_summary_card flex_2">
                            <h3 id="order_review_heading">Ваше замовлення</h3>
                            <div class="form-row place-order">
                                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                                <h3 id="order_review_heading">
                                    <?php esc_html_e('Your order', 'woocommerce'); ?>
                                </h3>

                                <?php do_action('woocommerce_checkout_before_order_review'); ?>

                                <div id="order_review" class="woocommerce-checkout-review-order">
                                    <?php do_action('woocommerce_checkout_order_review'); ?>
                                </div>

                                <?php do_action('woocommerce_checkout_after_order_review'); ?>

                                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
                                <!-- <?php wc_get_template('checkout/terms.php'); ?> -->

                                <?php do_action('woocommerce_review_order_before_submit'); ?>

                                <?php echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="button alt' . esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); // @codingStandardsIgnoreLine ?>

                                <?php do_action('woocommerce_review_order_after_submit'); ?>

                                <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
                            </div>

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
                            <?php do_action('woocommerce_checkout_after_order_review'); ?>
                        </div>

                        <!-- Коментар -->
                        @@include('../../partials/checkout/checkout-comment.html')

                        <!-- <input type="hidden" name="npregionref" location="billing" value=""><input type="hidden" name="npregionname" location="billing" value="undefined"> -->
                    </form>
                </article>





            </div>
        </section>
    </main>

    <?php
    get_footer();
    wp_footer();
    ?>
</body>


<!-- @@include('../../pages/checkout/index.html') -->
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



                            



<?php
/**
 * Template Name: Checkout Page
 */

defined('ABSPATH') || exit; ?>

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
                <?php
                do_action('woocommerce_before_checkout_form', $checkout);

                //If checkout registration is disabled and not logged in, the user cannot checkout.
                // if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
                //     echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
                //     return;
                // }
                ?>

                <?php
                $checkout = WC()->checkout;
                $cart = WC()->cart->get_cart();
                ?>
                <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

                    <?php if ($checkout->get_checkout_fields()): ?>

                        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                        <div class="col2-set" id="customer_details">
                            <div class="col-1">
                                <?php do_action('woocommerce_checkout_billing'); ?>
                            </div>

                            <div class="col-2">
                                <?php do_action('woocommerce_checkout_shipping'); ?>
                            </div>
                        </div>

                        <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                    <?php endif; ?>

                    <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                    <h3 id="order_review_heading">
                        <?php esc_html_e('Your order', 'woocommerce'); ?>
                    </h3>



                    <?php do_action('woocommerce_checkout_before_order_review'); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action('woocommerce_checkout_order_review'); ?>
                    </div>

                    <?php do_action('woocommerce_checkout_after_order_review'); ?>

                    <?php do_action('woocommerce_pay_order_before_submit'); ?>



                    <?php do_action('woocommerce_pay_order_after_submit'); ?>


                    <div class="row width_100">
                        <button type="submit" class="button__primary" id="place_order"> PLACE ORDER </button>
                    </div>

                    <?php $checkout_nonce = wp_create_nonce('woocommerce-process-checkout-nonce'); ?>
                    <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="<?php echo esc_attr($checkout_nonce) ?>" /><input type="radio" name="_wp_http_referer" value="/checkout/" />
                    <label for="woocommerce-process-checkout-nonce"><?php echo esc_attr($checkout_nonce) ?></label>

                </form>

                <?php do_action('woocommerce_after_checkout_form', $checkout); ?>


            </div>
        </section>
    </main>

    <?php
    get_footer();
    wp_footer();
    ?>
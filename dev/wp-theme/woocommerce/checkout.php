<?php
/**
 * Template Name: PPF-Checkout
 */

defined('ABSPATH') || exit;
$checkout = WC()->checkout;
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="{{stylesheet_url}}/static/icons/favicon.webp" type="image/x-icon">
    <title>Оформлення замовлення | PaperFox</title>
    <link rel="shortcut icon" href="{{domain}}static/icons/favicon.png" type="image/x-icon">
    <?php wc_get_template('template-parts/ppf-google-tag-head.php'); ?>
    <?php wp_head(); ?>
</head>

<body>
    <?php wc_get_template('template-parts/ppf-google-tag-body.php'); ?>
    <?php get_header(); ?>
    <main>
        <?php do_action('woocommerce_before_checkout_form', $checkout); ?>
        <?php if (is_wc_endpoint_url('order-received')) {

            $order_id = isset ($_GET['key']) ? wc_get_order_id_by_order_key($_GET['key']) : 0;
            $order = wc_get_order($order_id);

            echo 'order #' . $order_id . ' status: ' . $order->get_status() . '<br>';

            if ($order && in_array($order->get_status(), array('pending'))) {
                echo 'Order pending';
            } elseif ($order && in_array($order->get_status(), array('failed'))) {
                echo 'Order failed';
            } elseif ($order && in_array($order->get_status(), array('processing'))) {
                echo 'Order processing';
                wc_get_template('checkout/ppf-order-received.php', array('order' => $order));
            } elseif ($order && in_array($order->get_status(), array('on-hold'))) {
                echo 'Order on-hold';
            } elseif ($order && in_array($order->get_status(), array('cancelled'))) {
                echo 'Order cancelled';
            }
        } else {
            wc_get_template('checkout/ppf-checkout-form.php', array('order' => $order));
        }
        ?>
    </main>
    <?php
    get_footer();
    wp_footer();
    ?>
</body>

</html>
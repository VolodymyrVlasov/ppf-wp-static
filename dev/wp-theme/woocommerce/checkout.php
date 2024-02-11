<?php defined('ABSPATH') || exit;
/**
 * Template Name: PPF-Checkout
 */
?>

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

                <?php if (is_wc_endpoint_url('order-received')) {
                    // Путь к вашему пользовательскому шаблону для страницы "order-received"
                    wc_get_template('checkout/ppf-order-received.php', array('order' => $order));
                } else {
                    wc_get_template('checkout/ppf-checkout-form.php', array('order' => $order));
                }
                ?>
            </div>
        </section>
    </main>
    <?php
    get_footer();
    wp_footer();
    ?>
</body>

<?php
/**
 * Template Name: PPF-Checkout
 */

defined('ABSPATH') || exit;
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
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MNG4WVJJ');</script>
    <!-- End Google Tag Manager -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GTM-MNG4WVJJ"></script>
    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MNG4WVJJ"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
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
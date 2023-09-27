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
            <div class="container">


            </div>
        </section>
    </main>

    <?php
    get_footer();
    wp_footer();
    ?>
</body>


<!-- @@include('../../pages/checkout/index.html') -->
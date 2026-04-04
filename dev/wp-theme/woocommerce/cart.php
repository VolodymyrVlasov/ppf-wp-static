<?php
/**
 * Template Name: PPF-Cart
 */

defined('ABSPATH') || exit;

// do_action('woocommerce_before_cart'); 
?>

<!DOCTYPE html>

<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{domain}}/static/icons/favicon.png" type="image/x-icon">

    <title>Кошик | PaperFox</title>
    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>
        <section class="section" id="cart-section">
            <div class="container">
                <form class="row big_gap" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                    <?php if (WC()->cart->is_empty()): ?>
                        <div class="empty_cart">
                            <img src="<?php echo get_template_directory_uri(); ?>/static/icons/icon-empty-cart.webp"
                                alt="Empty Cart Icon" width="200" height="200" class="empty-cart-image">
                            <p class="text_16">Ви ще не додали жодного товару</p>
                        </div>
                    <?php else: ?>
                        <article class="cart_items_card flex_4">
                            <div class="col big_gap width_100">
                                <h2 class="text_24">Ваш кошик</h2>
                                <ul class="cart_items_card_list">
                                    <?php do_action('woocommerce_before_cart_contents'); ?>
                                    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
                                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)):
                                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                            ?>

                                            <?php include get_template_directory() . '/template-parts/ppf-cart-item-card.php'; ?>

                                        <?php endif; endforeach; ?>
                                </ul>
                            </div>
                        </article>
                        <article class="cart_summary_card flex_2">
                            <span class="text_32">Разом</span>
                            <div class="row_sp_btw">
                                <span class="text_12">
                                    Товарів: <?php echo WC()->cart->get_cart_contents_count(); ?> шт.
                                </span>
                                <span class="text_12">
                                    <?php echo WC()->cart->get_cart_subtotal(); ?>
                                </span>
                            </div>
                            <div class="cart_summary_card_price">
                                <span class="text_12">До сплати</span>
                                <span class="text_24">
                                    <?php echo WC()->cart->get_cart_total(); ?>
                                </span>
                            </div>
                            <div class="col small_gap">
                                <button type="submit" class="button__normal width_100" name="update_cart"
                                    value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('ОНОВИТИ КОШИК', 'woocommerce'); ?></button>
                                <?php wp_nonce_field('woocommerce-cart', '_wpnonce'); ?>

                                <?php do_action('woocommerce_after_cart_contents'); ?>
                                <a class="button__primary width_100" href="<?php echo esc_url(wc_get_checkout_url()); ?>"
                                    title="Натисніть щоб перейти до оформлення замовлення">ПЕРЕЙТИ ДО ОФОРМЛЕННЯ</a>
                            </div>
                            <span class="text_12">Підтверджуючи оформлення, ви переконуєтеся у відповідності дизайну або
                                виробу, з можливими відхиленнями через технічні обмеження.</span>
                        </article>
                    <?php endif; ?>
                    <?php do_action('woocommerce_cart_contents'); ?>
                </form>
            </div>
        </section>

    </main>
    <?php do_action('woocommerce_after_cart'); ?>





    <?php get_footer(); ?>
    <?php wp_footer(); ?>
</body>

</html>
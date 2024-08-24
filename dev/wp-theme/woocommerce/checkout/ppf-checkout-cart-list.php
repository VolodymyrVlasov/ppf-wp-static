<?php
/**
 * Output checkout purchase items list
 */
defined('ABSPATH') || exit;
?>

<article class="col gap width_100" data-value="" data-transaction-id="" data-currency="">
    <h3 class="header_4" id="order_review_heading">Ваше замовлення</h3>
    <ul class="col width_100 border_bottom_gray_between_col_items">
        <?php $index = 1; ?>
        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)): ?>

                <li class="row small_gap width_100 padding_top_bottom">
                    <div class="plain_text_small flex_4 text_left">
                        <?php echo $index . ". " . $_product->get_name(); ?>
                    </div>
                    <div class="plain_text_small flex_1 text_center">
                        <?php echo esc_attr($cart_item['quantity']) . " шт."; ?>
                    </div>
                    <div class="plain_text_small flex_2 text_right">
                        <?php echo $_product->get_price() . " грн."; ?>
                    </div>
                </li>
                <?php $index++ ?>
            <?php endif; endforeach; ?>
    </ul>
</article>
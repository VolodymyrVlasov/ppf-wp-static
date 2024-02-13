<?php
/**
 * Output checkout purchase items list
 */
defined('ABSPATH') || exit;
?>

<article class="col gap width_100" data-value="" data-transaction-id="" data-currency="">
    <h3 class="text_24__bold" id="order_review_heading">Ваше замовлення</h3>
    <ul class="col small_gap width_100" data-items="">
        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)): ?>

                <li class="row small_gap width_100 border_bottom_gray padding_top_bottom" data-item-id="">
                    <div class="text_16 flex_4 text_left" data-item-name="">
                        <?php echo $_product->get_name(); ?>
                    </div>
                    <div class="text_16 flex_1 text_center" data-quantity="">
                        <?php echo esc_attr($cart_item['quantity']) . " шт."; ?>
                    </div>
                    <div class="text_16 flex_2 text_right" data-price="">
                        <?php echo $_product->get_price() . " грн."; ?>
                    </div>
                </li>
            <?php endif; endforeach; ?>
    </ul>
    <script>
        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
            event: "purchase",
            ecommerce: {
                transaction_id: "Вова",
                value: "12.0",
                currency: "UAH",
                items: [{
                    item_name: "Календар",
                    item_id: "0000001",
                    price: "12.0",
                    quantity: 1
                }]
            }
        });</script>

</article>
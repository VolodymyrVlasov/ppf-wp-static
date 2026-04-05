<?php
global $post;

$product = wc_get_product($post->ID);
$product_id = $product->get_id();
$product_permalink = get_permalink($product_id);
$cart_item_key = $product_id;
$cart_item = WC()->cart->get_cart_item($cart_item_key);
?>

<li class="cart_item">
    <img src="<?php echo get_the_post_thumbnail_url($product_id); ?>" alt="<?php echo $product->get_name(); ?>"
        width="200" height="100" class="cart_item_image bg_img">
    <div class="col small_gap flex_1">
        <span class="text_16__bold">
            <?php echo $product->get_name(); ?>
        </span>
        <span class="cart_item_category">
            <?php echo wc_get_product_category_list($product_id); ?>
        </span>
        <a href="<?php echo esc_url($product_permalink); ?>" class="link">Редагувати дизайн</a>
    </div>
    <div class="col_end">
        <span class="cart_item_price">
            <?php echo WC()->cart->get_product_subtotal($product, $cart_item['quantity']); ?>
        </span>
        <div class="row small_gap">
            <div class="custom_input">
                <button type="button" class="custom_number_btn minus"
                    onclick="this.nextElementSibling.stepDown();">-</button>
                <input type="number" class="custom_input_input__number" step="1" min="1" max="1000"
                    name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]"
                    value="<?php echo esc_attr($cart_item['quantity']); ?>"
                    title="<?php esc_attr_e('Qty', 'woocommerce'); ?>" size="4" inputmode="numeric"
                    data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                <button type="button" class="custom_number_btn plus"
                    onclick="this.previousElementSibling.stepUp();">+</button>
            </div>
            <?php
            echo apply_filters(
                'woocommerce_cart_item_remove_link',
                sprintf(
                    '<a href="%s" class="cart_item_del" aria-label="%s"></a>',
                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                    esc_html__('Remove this item', 'woocommerce')
                ),
                $cart_item_key
            );
            ?>
        </div>
    </div>
</li>
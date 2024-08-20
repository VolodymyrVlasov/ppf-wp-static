<li class="cart_item">
    <?php
    $fpd_data = $cart_item['fpd_data'];
    $fpd_preview_image = $fpd_data['fpd_product_thumbnail']; // Замініть 'fpd_data' на відповідний ключ метаданих
    
    if (!empty($fpd_preview_image)) {
        $product_image_url = $fpd_preview_image;
    } else {
        $product_image_url = esc_url(get_the_post_thumbnail_url($_product->get_id()));
    }

    $alt_text = $_product->get_name();
    ?>

    <img src="<?php echo $product_image_url; ?>"
        alt="<?php echo esc_attr($alt_text); ?>" width="200" height="100"
        class="cart_item_image bg_img">

    <div class="col small_gap flex_3">
        <span class="plain_text text_bold text_truncated_1_line">
            <?php echo $_product->get_name(); ?>
        </span>
        <span class="cart_item_category">
            <?php echo wc_get_product_category_list($product_id); ?>
        </span>
        <a href="<?php echo esc_url($product_permalink); ?>"
            class="plain_text_smaller link">Редагувати
            дизайн</a>
    </div>
    <div class="col_end flex_2">
        <span class="cart_item_price">
            <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
        </span>
        <div class="row big_gap">
            <div class="quantity">
                <?php
                $product_quantity = woocommerce_quantity_input(
                    array(
                        'input_name' => "cart[{$cart_item_key}][qty]",
                        'input_value' => $cart_item['quantity'],
                        'max_value' => $max_quantity,
                        'min_value' => $min_quantity,
                        'product_name' => $_product->get_name(),
                    ),
                    $_product,
                    false
                );

                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                ?>
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
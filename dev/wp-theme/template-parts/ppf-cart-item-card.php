<li class="cart_item">
    <?php
    $product_image_url = function_exists('ppf_get_fpd_preview')
        ? ppf_get_fpd_preview($cart_item, $_product->get_id())
        : esc_url(get_the_post_thumbnail_url($_product->get_id()));

    $alt_text = $_product->get_name();
    $edit_url = function_exists('ppf_get_fpd_edit_url')
        ? ppf_get_fpd_edit_url($cart_item_key, $cart_item)
        : get_permalink($_product->get_id());
    ?>
    <div class="cart_item_description flex_2">
        <img src="<?php echo get_the_post_thumbnail_url($product_id); ?>"
            alt="<?php echo esc_attr($alt_text); ?>" width="100" height="100"
            class="cart_item_image bg_img">
        <div class="col small_gap ">
            <div class="popover_wrapper">
                <div class="popover_content">
                    <div class="col_center">
                        <span
                            class="plain_text text_bold cart_item_name_truncated"><?php echo $_product->get_name(); ?></span>
                    </div>
                </div>
                <div class="popover_description">
                    <div class="plain_text_small col small_gap">
                        <span><?php echo $_product->get_name(); ?></span>
                    </div>
                </div>
            </div>

            <span class="cart_item_category">
                <?php echo wc_get_product_category_list($product_id); ?>
            </span>
            <a href="<?php echo esc_url($product_permalink); ?>"
                class="plain_text_smaller link">Редагувати
                дизайн</a>
        </div>
    </div>

    <div class="col_end flex_1">
        <span class="cart_item_price">
            <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
        </span>
        <div class="row_center big_gap">
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
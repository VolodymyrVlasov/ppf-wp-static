<div class="single_product_summary_card">
    <div class="row_sp_btw">
        <div class="col small_gap">
            <span class="plain_text_smaller text_color_gray">Кількість</span>
            <div class="col_center">
                <?php woocommerce_quantity_input(
                    array(
                        'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                        'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                        'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                        // WPCS: CSRF ok, input var ok.
                    )
                ); ?>
            </div>

        </div>
        <div class="col small_gap">
            <span class="plain_text_smaller text_color_gray">Вартість за одиницю</span>
            <p class="price">
                <?php echo $product->get_price_html(); ?>
            </p>
        </div>
    </div>
    <button type="submit" name="add-to-cart"
        value="<?php echo esc_attr($product->get_id()); ?>"
        class="button__primary width_100">ДОДАТИ У
        КОШИК</button>
</div>
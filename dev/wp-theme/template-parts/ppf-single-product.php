<?php global $product; ?>

<!-- ====== START: Single Product Section ====== -->

<section class="section">
    <div class="container col big_gap">
        <?php do_action('woocommerce_before_single_product'); ?>

        <!-- === START: Single Product Card === -->
        <div class="single_product_card">
            <!-- -- START: Product Image -- -->
            <div class="flex_1">
                <picture class="single_product_card_image_cnt bg_img width_100">
                    <img
                        src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'full') ?>"
                        class="bg_img width_100"
                        alt="<?php echo $product->get_name() ?>" />
                </picture>
            </div>
            <!-- -- END: Product Image -- -->

            <!-- -- START: Product Info (title, props, price, related) -- -->
            <div class="col gap flex_1">
                <div class="col big_gap">
                    <h1 class="header_2"><?php echo $product->get_name() ?></h1>
                    <?php wc_get_template('template-parts/ppf-single-product-props.php', ['order' => $order]); ?>

                    <div class="col small_gap">
                        <div class="price_label">
                            <span>Вартість</span>
                            <p class="price_after"><?php echo $product->get_price() ?></p>
                        </div>

                        <?php
                        global $product;
                        $product_id = $product ? $product->get_id() : get_the_ID();
                        ?>
                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                            data-quantity="1"
                            data-product_id="<?php echo esc_attr($product_id); ?>"
                            data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                            class="button__primary">
                            <span><?php echo esc_html($product->add_to_cart_text()); ?></span>
                        </a>
                    </div>

                    <!-- --- START: Related Products --- -->
                    <div class="col small_gap">
                        <?php
                        global $product;
                        $upsell_ids = $product ? $product->get_upsell_ids() : [];

                        if (!empty($upsell_ids)): ?>
                            <div class="col small_gap">
                                <p class="header_4">Разом купують</p>
                                <div class="row small_gap">
                                    <?php
                                    foreach ($upsell_ids as $id) {
                                        $prod = wc_get_product($id);
                                        get_template_part('template-parts/ppf-upsell-product-card', 'upsell', ['product' => $prod]);
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif;
                        ?>
                    </div>
                    <!-- --- END: Related Products --- -->

                </div>
            </div>
            <!-- -- END: Product Info -- -->
        </div>
        <!-- === START: Product Description Block === -->
        <div class="col small_gap">
            <h4 class="header_4">Опис товару</h4>
            <p><?php echo $product->get_description() ?></p>
        </div>
        <!-- === END: Product Description Block === -->
        <!-- === END: Single Product Card === -->
    </div>
</section>
<!-- ====== END: Single Product Section ====== -->
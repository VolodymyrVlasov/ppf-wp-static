<!-- ====== START: FPD Section ====== -->
<?php global $product; ?>
<section class="section">
    <div class="container col big_gap">
        <div class="col width_100">
            <?php do_action('woocommerce_before_single_product'); ?>
            <h1 class="header_2"><?php echo $product->get_name() ?></h1>
        </div>
        <!-- === START: Single Product Card === -->
        <div class="single_product_card_fpd_cnt big_gap">
            <!-- -- START: Product Image (FPD) -- -->

            <div class="single_product_card_fpd_cnt__fpd ">
                <?php echo do_shortcode('[fpd]'); ?>
            </div>
            <!-- -- END: Product Image (FPD) -- -->

            <!-- -- START: Product Content Row -- -->
            <div class="single_product_card_fpd">
                <!-- --- START: Related Products + Description --- -->
                <div class="col big_gap flex_2">
                    <!-- --- START: Related Products --- -->
                    <div class="col small_gap">
                        <?php
                        global $product;
                        $upsell_ids = $product ? $product->get_upsell_ids() : [];

                        if (!empty($upsell_ids)):

                            // показуємо максимум 3 товари
                            $display_ids = array_slice($upsell_ids, 0, 3);

                            // беремо перший товар і його першу категорію
                            $first_id = reset($display_ids);
                            $first_cats = $first_id ? get_the_terms($first_id, 'product_cat') : [];
                            $cat_link = '';
                            $cat_count = 0;

                            if (!empty($first_cats) && !is_wp_error($first_cats)) {
                                $term = is_array($first_cats) ? $first_cats[0] : $first_cats;
                                $termlink = get_term_link($term);
                                if (!is_wp_error($termlink)) {
                                    $cat_link = $termlink;
                                }

                                // рахуємо товари у цій категорії
                                $cat_count = (int) $term->count;
                            }
                            ?>
                            <div class="col small_gap">
                                <p class="header_4">Разом купують</p>
                                <div class="row small_gap">
                                    <?php
                                    foreach ($display_ids as $id) {
                                        $prod = wc_get_product($id);
                                        if ($prod) {
                                            get_template_part('template-parts/ppf-upsell-product-card', 'upsell', ['product' => $prod]);
                                        }
                                    }

                                    // Кнопка "+" тільки якщо товарів у категорії > 3
                                    if (!empty($cat_link) && $cat_count > 3): ?>
                                        <div class="ppf-upsell-plus-card">
                                            <a class="ppf-upsell-plus-btn" href="<?php echo esc_url($cat_link); ?>"
                                                aria-label="<?php echo esc_attr__('Більше з цієї категорії', 'your-textdomain'); ?>">+</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- --- END: Related Products --- -->

                    <!-- ---- START: Product Description ---- -->
                    <div class="col small_gap">
                        <h4 class="header_4">Опис товару</h4>
                        <p><?php echo apply_filters('the_content', $product->get_description()); ?></p>
                    </div>
                    <!-- ---- END: Product Description ---- -->
                </div>
                <!-- --- END: Related Products + Description --- -->

                <!-- --- START: Cart Summary Card --- -->
                <div class="col gap flex_1">
                    <div class="single_product_summary_card">


                        <?php wc_get_template('template-parts/ppf-single-product-props.php', ['order' => $order]); ?>

                        <div class="price_label">
                            <span>Вартість</span>
                            <p class="price_after"><?php echo $product->get_price() ?></p>
                        </div>


                        <?php $product_id = $product ? $product->get_id() : get_the_ID();
                        ?>
                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                            data-quantity="1"
                            data-product_id="<?php echo esc_attr($product_id); ?>"
                            data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                            class="button__primary">
                            <span><?php echo esc_html($product->add_to_cart_text()); ?></span>
                        </a>
                    </div>
                </div>
                <!-- --- END: Cart Summary Card --- -->
            </div>
            <!-- -- END: Product Content Row -- -->
        </div>
        <!-- === END: Single Product Card === -->
    </div>
</section>
<!-- ====== END: FPD Section ====== -->
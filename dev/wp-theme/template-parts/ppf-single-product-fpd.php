<!-- ====== START: FPD Section ====== -->
<section class="section">
    <div class="container col big_gap">
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
                        <h1 class="header_4">Чашка-батарейка</h1>

                        <div class="row small_gap">
                            <div class="prop_label">
                                <span>Обʼєм</span>
                                <p>310 мл</p>
                            </div>

                            <div class="prop_label">
                                <span>Вага</span>
                                <p>0.5 кг</p>
                            </div>

                            <div class="prop_label">
                                <span>Розміри</span>
                                <p>10х10х10 см</p>
                            </div>
                        </div>

                        <div class="price_label">
                            <span>Вартість</span>
                            <p class="price_after">300</p>
                        </div>

                        <button type="submit" name="add-to-cart" class="button__primary width_100">ДОДАТИ У
                            КОШИК</button>
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
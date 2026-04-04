<?php global $product; ?>

<!-- ====== START: Single Product Section ====== -->

<section class="section">
    <div class="container col big_gap">


        <div class="col small_gap">
            <?php do_action('woocommerce_before_single_product'); ?>
            <?php
            if (function_exists('WC')) {
                $bc = new WC_Breadcrumb();

                // Згенерувати крихти (WooCommerce логіка побудови)
                $crumbs = apply_filters('woocommerce_get_breadcrumb', $bc->generate(), $bc);

                if (!empty($crumbs)): ?>
                    <nav class="breadcrumbs row small_gap" aria-label="breadcrumbs">
                        <?php foreach ($crumbs as $i => $crumb):
                            $is_last = ($i === count($crumbs) - 1);
                            $label = isset($crumb[0]) ? $crumb[0] : '';
                            $url = isset($crumb[1]) ? $crumb[1] : '';
                            ?>
                            <?php if (!$is_last && !empty($url)): ?>
                                <a class="text_link" href="<?php echo esc_url($url); ?>">
                                    <?php echo esc_html($label); ?>
                                </a>
                            <?php else: ?>
                                <span class="current"><?php echo esc_html($label); ?></span>
                            <?php endif; ?>

                            <?php if (!$is_last): ?>
                                <span class="delimiter"> › </span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </nav>
                <?php endif;
            }
            ?>

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


                    </div>
                </div>
                <!-- -- END: Product Info -- -->
            </div>
            <!-- === START: Product Description Block === -->
            <div class="col small_gap">
                <h4 class="header_4">Опис товару</h4>
                <p><?php echo apply_filters('the_content', $product->get_description()); ?></p>
            </div>
            <!-- === END: Product Description Block === -->
            <!-- === END: Single Product Card === -->
        </div>
    </div>
</section>
<!-- ====== END: Single Product Section ====== -->
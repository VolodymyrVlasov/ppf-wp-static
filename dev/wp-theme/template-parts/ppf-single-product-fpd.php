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
                    <!-- ---- START: Related Products ---- -->
                    <?php
                    global $product;
                    $upsell_ids = $product ? $product->get_upsell_ids() : [];
                    if (!empty($upsell_ids)):
                        $q = new WP_Query([
                            'post_type' => 'product',
                            'post__in' => $upsell_ids,
                            'orderby' => 'post__in',
                            'posts_per_page' => -1,
                        ]);
                        if ($q->have_posts()): ?>
                            <div class="col small_gap">
                                <p class="header_4">Разом купують</p>
                                <div class="row small_gap">
                                    <?php while ($q->have_posts()):
                                        $q->the_post();
                                        $prod = wc_get_product(get_the_ID());
                                        get_template_part('ppf-upsell-product-card.php', 'upsell', ['product' => $prod]);
                                    endwhile; ?>
                                </div>
                            </div>
                            <?php
                        endif;
                        wp_reset_postdata();
                    endif;
                    ?>

                    <!-- ---- END: Related Products ---- -->

                    <!-- ---- START: Product Description ---- -->
                    <div class="col small_gap">
                        <h4 class="header_4">Опис товару</h4>
                        <p>
                            Short product description<br />
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem vel impedit consequuntur
                            ratione quidem nam magnam id amet
                            harum dolore, nihil dolorum esse doloribus aut praesentium in reprehenderit beatae quasi,
                            eligendi ea nostrum deserunt
                            cupiditate porro. Aperiam consequuntur facilis maiores ad libero quasi reiciendis officia
                            debitis, veniam minima, sunt
                            perspiciatis explicabo optio. Quo nulla quidem nam sit quasi hic aspernatur!
                        </p>
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
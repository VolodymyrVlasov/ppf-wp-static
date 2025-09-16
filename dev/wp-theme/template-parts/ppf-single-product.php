<!-- ====== START: Single Product Section ====== -->
<section class="section">
    <div class="container col big_gap">
        <!-- === START: Single Product Card === -->
        <div class="single_product_card">
            <!-- -- START: Product Image -- -->
            <div class="flex_1">
                <picture class="single_product_card_image_cnt bg_img width_100">
                    <img
                        src="http://localhost/paperfox/wp-content/themes/paperfox/static/global/cup-battery.webp"
                        class="bg_img width_100"
                        alt="Чашка-батарейка, вигляд зверху" />
                </picture>
            </div>
            <!-- -- END: Product Image -- -->

            <!-- -- START: Product Info (title, props, price, related) -- -->
            <div class="col gap flex_1">
                <div class="col big_gap">
                    <!-- --- START: Title & Props --- -->
                    <h1 class="header_2">Чашка-батарейка</h1>

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
                    <!-- --- END: Title & Props --- -->

                    <!-- --- START: Price & CTA --- -->
                    <div class="col small_gap">
                        <div class="price_label">
                            <span>Вартість</span>
                            <p class="price_after">300</p>
                        </div>

                        <button type="submit" name="add-to-cart" class="button__primary">ДОДАТИ У КОШИК</button>
                    </div>
                    <!-- --- END: Price & CTA --- -->

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
        <!-- === END: Single Product Card === -->

        <!-- === START: Product Description Block === -->
        <div class="col big_gap">
            <div class="col small_gap">
                <h4 class="header_4">Опис товару</h4>
                <p>
                    Short product description<br />
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem vel impedit consequuntur ratione
                    quidem nam magnam id amet harum
                    dolore, nihil dolorum esse doloribus aut praesentium in reprehenderit beatae quasi, eligendi ea
                    nostrum deserunt cupiditate
                    porro. Aperiam consequuntur facilis maiores ad libero quasi reiciendis officia debitis, veniam
                    minima, sunt perspiciatis
                    explicabo optio. Quo nulla quidem nam sit quasi hic aspernatur!
                </p>
            </div>
        </div>
        <!-- === END: Product Description Block === -->
    </div>
</section>
<!-- ====== END: Single Product Section ====== -->
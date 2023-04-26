<?php
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>

<!DOCTYPE html>
<html lang="uk">
<?php
the_post();
global $product;

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $product->get_name(); ?>
    </title>
    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>

        <section class="section">
            <div class="container col big_gap">
                <div id="product-<?php the_ID(); ?>">
                    <div class="row big_gap">
                        <div class="col">
                            <?php if (!do_shortcode('[fpd]')) {
                                ?>
                                <picture class="col Width_100">
                                    <?php $image_url = wp_get_attachment_url($product->get_image_id()); ?>
                                    <img src="<?php echo $image_url ?>" class="product_card__image bg_img width_100"
                                        width="380" height="180" alt="<?php echo $relate_product_name; ?>">
                                </picture>
                                <?php
                            } else {
                                echo do_shortcode('[fpd]');
                            } ?>
                        </div>

                        <div class="col gap">
                            <p class="text_24">
                                <?php echo $product->get_name(); ?>
                            </p>
                            <span class="text_12">
                                <?php echo $product->get_categories()->name; ?>
                            </span>

                            <span class="text_16">
                                <?php echo $product->get_short_description(); ?>
                                <?php echo $product->get_description(); ?>
                            </span>
                            <div class="row_sp_btw width_100">
                                <p class="text_16">Вага товару:</p>
                                <div>
                                    <?php echo $product->get_weight(); ?>
                                </div>
                            </div>
                            <div class="row_sp_btw width_100">
                                <p class="text_16">Розміри товару:</p>
                                <div>
                                    <?php echo $dimensions = $product->get_dimensions(); ?>
                                </div>
                            </div>
                            <p class="price">
                                <?php echo $product->get_price_html(); ?>
                            </p>
                            <form class="row_sp_btw width_100"
                                action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                                method="post" enctype='multipart/form-data'>
                                <?php
                                woocommerce_quantity_input(
                                    array(
                                        'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                                        'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                                        'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                                        // WPCS: CSRF ok, input var ok.
                                    )
                                );
                                ?>
                                <button type="submit" name="add-to-cart"
                                    value="<?php echo esc_attr($product->get_id()); ?>" class="button__primary">ДОДАТИ У
                                    КОШИК</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col width_100">
                    <p class="text_24">Асоційовані товари:</p>
                    <div class="row big_gap width_100">
                        <?php
                        $upsells = $product->get_upsell_ids();
                        if (!empty($upsells)) {
                            foreach ($upsells as $upsell_id) {
                                $upsell = wc_get_product($upsell_id);
                                $upsell_product_name = $upsell->get_name();
                                $upsell_image_url = wp_get_attachment_url($upsell->get_image_id());
                                ?>
                                <div class="product_card cards_3">
                                    <picture>
                                        <img src="<?php echo $upsell_image_url ?>" class="product_card__image bg_img width_100"
                                            width="380" height="180" alt="<?php echo $upsell_product_name; ?>">
                                    </picture>
                                    <h3 class="text_24 width_100">
                                        <?php echo $upsell_product_name; ?>
                                    </h3>
                                    <p class="text_14 width_100">
                                        <?php echo $upsell->get_short_description(); ?>
                                    </p>
                                    <div class="row_sp_btw">
                                        <span class="price">
                                            <?php echo $upsell->get_price_html(); ?>
                                        </span>
                                        <a title="Натисніть щоб перейти до сторінки замовлення <?php echo $upsell_product_name; ?>"
                                            href="<?php echo get_permalink($upsell_id); ?>" class="sub_link">
                                            <span>ЗАМОВИТИ</span>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>

                <div class="col width_100">
                    <p class="text_24">Рекомендовані товари:</p>
                    <div class="row big_gap width_100">
                        <?php
                        $related = $product->get_related();
                        if (!empty($related)) {
                            foreach ($related as $related_id) {
                                $related_product = wc_get_product($related_id);
                                $relate_product_name = $related_product->get_name();

                                $image_url = wp_get_attachment_url($related_product->get_image_id());

                                ?>
                                <div class="product_card cards_3">
                                    <picture>
                                        <img src="<?php echo $image_url ?>" class="product_card__image bg_img width_100"
                                            width="380" height="180" alt="<?php echo $relate_product_name; ?>">
                                    </picture>
                                    <h3 class="text_24 width_100">
                                        <?php echo $relate_product_name; ?>
                                    </h3>
                                    <p class="text_14 width_100">
                                        <?php echo $related_product->get_short_description(); ?>
                                    </p>
                                    <div class="row_sp_btw">
                                        <span class="price">
                                            <?php echo $related_product->get_price_html(); ?>
                                        </span>
                                        <a title="Натисніть щоб перейти до сторінки замовлення <?php echo $relate_product_name; ?>"
                                            href="<?php echo get_permalink($related_id); ?>" class="sub_link">
                                            <span>ЗАМОВИТИ</span>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>


            </div>
        </section>
    </main>
    <?php
    get_footer();
    wp_footer();
    ?>
</body>

</html>
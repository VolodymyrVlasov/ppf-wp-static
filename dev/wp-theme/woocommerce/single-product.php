<?php do_action('woocommerce_before_single_product'); ?>

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
    <link rel="shortcut icon" href="{{domain}}/wp-content/themes/paperfox/static/icons/favicon.png" type="image/x-icon">
    <title><?php echo $product->get_name(); ?></title>

    <meta name="description"
        content="<?php echo esc_attr(wp_strip_all_tags($product->get_short_description())); ?>">
    <meta name="keywords"
        content="<?php echo esc_attr(implode(', ', wp_get_post_terms($product->get_id(), 'product_tag', array('fields' => 'names')))); ?>">

    <meta property="og:title" content="<?php echo esc_attr($product->get_name()); ?>">
    <meta property="og:type" content="<?php echo esc_attr('product'); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:image" content="<?php echo esc_url(wp_get_attachment_url($product->get_image_id())); ?>">
    <meta property="og:description"
        content="<?php echo esc_attr(wp_strip_all_tags($product->get_short_description())); ?>">
    <meta property="og:site_name" content="PaperFox">
    <meta property="og:locale" content="uk_UA">

    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>

        <section class="section">
            <div class="container">
                <div class="single_product_card_row">
                    <div class="single_product_card_image_cnt bg_theme">FPD</div>
                    <div class="single_product_card_description_cnt bg_theme">
                        <div class="row gap width_100">
                            <h1 class="header_4 flex_1 bg_theme">Name</h1>
                            <div class="row_end gap flex_1 bg_theme">
                                <span>Amount</span>
                                <span>Add to cart</span>
                            </div>
                        </div>
                        <p>Description</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container col big_gap">
                <div class="col small_gap">
                    <div class="row">
                        <? if (function_exists('woocommerce_breadcrumb')) {
                            woocommerce_breadcrumb();
                        } ?>
                    </div>
                    <div id="product-<?php the_ID(); ?>">
                        <div class="col">
                            <?php if (!do_shortcode('[fpd]')) {
                                ?>
                                <picture class="col width_100">
                                    <?php $image_url = wp_get_attachment_url($product->get_image_id()); ?>
                                    <img src="<?php echo $image_url ?>" class="product_card__image bg_img width_100"
                                        width="380" height="180" alt="<?php echo $relate_product_name; ?>">
                                </picture>
                                <?php
                            } else {
                                echo do_shortcode('[fpd]');
                            } ?>
                        </div>
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
        </section>
        <section class="section">
            <div class="container col big_gap">
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

            </div>
        </section>
        <section class="section">
            <div class="container col big_gap">
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
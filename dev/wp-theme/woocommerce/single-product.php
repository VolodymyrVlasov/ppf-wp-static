<!DOCTYPE html>
<html lang="uk">
<?php
the_post();
global $product;
?>

<head>
    <link rel="shortcut icon" href="{{domain}}/static/icons/favicon.png" type="image/x-icon">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="container col gap">

                <h1 class="header_4"><?php echo $product->get_name(); ?></h1>

                <div class="row">
                    <? if (function_exists('woocommerce_breadcrumb')) {
                        woocommerce_breadcrumb();
                    } ?>
                </div>


                <?php $isFPD = do_shortcode('[fpd]') ?>
                <div class="<?php echo ($isFPD == true) ? 'single_product_card_col' : 'single_product_card_row'; ?>">
                    <div
                        class="<?php echo ($isFPD == true) ? 'single_product_card_fpd_cnt bg_img' : 'single_product_card_image_cnt'; ?> bg_theme">
                        <img class="bg_img"
                            src="{{stylesheet_url}}/static/global/ppf-image-not-found.png"
                            alt="<?php echo $relate_product_name; ?>"
                            width="500" height="450" loading="lazy" decoding="async" />
                    </div>
                    <div class="single_product_card_description_cnt ">
                        <?php do_action('woocommerce_before_single_product'); ?>


                        <div class="row gap">
                            <div class="col small_gap flex_1">
                                <ul class="row big_gap">
                                    <li class="plain_text text_bold">Опис</li>
                                    <li class="plain_text text_bold">Характеристики</li>
                                </ul>
                                <div class="col">
                                    <p class="plain_text_small">
                                        <?php echo wp_kses_post(nl2br($post->post_content)); ?>
                                    </p>
                                </div>
                            </div>
                            <form class="single_product_summary_card"
                                action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                                method="post" enctype='multipart/form-data'>
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

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 
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
        </section> -->
    </main>
    <?php
    get_footer();
    wp_footer();
    ?>
</body>

</html>
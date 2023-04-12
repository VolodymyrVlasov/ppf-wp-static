<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сторінка товара</title>
</head>

<body>
    <?php get_header(); ?>
    <section class="section">
        <div class="container col big_gap">
            <?php
            // Get product
            global $product;
            ?>
            <div class="product">
                <h1 class="product-title">
                    <?php echo $product->get_name(); ?>
                </h1>
                <div class="product-image">
                    <?php echo $product->get_image(); ?>
                </div>
                <div class="product-price">
                    <?php echo $product->get_price_html(); ?>
                </div>
                <div class="product-description">
                    <?php echo $product->get_description(); ?>
                </div>
                <?php if ($product->is_in_stock()): ?>
                    <form class="cart"
                        action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                        method="post" enctype="multipart/form-data">
                        <?php do_action('woocommerce_before_add_to_cart_button'); ?>
                        <div class="quantity">
                            <?php
                            if (!$product->is_sold_individually()) {
                                woocommerce_quantity_input(
                                    array(
                                        'min_value' => apply_filters('woocommerce_quantity_input_min', 1, $product),
                                        'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                                        'input_value' => isset($_POST['quantity']) ? wc_stock_amount($_POST['quantity']) : 1,
                                    )
                                );
                            }
                            ?>
                        </div>
                        <button type="submit" class="single_add_to_cart_button button alt">
                            <?php echo esc_html($product->single_add_to_cart_text()); ?>
                        </button>
                        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php get_footer(); ?>
</body>

</html>
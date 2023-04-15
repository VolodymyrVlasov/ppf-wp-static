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
            <div class="container">
                <div class="col big_gap">
                    <h1 class="text_60">Correct product page template</h1>
                    <div class="width_100">
                        <?php echo do_shortcode('[fpd]'); ?>
                    </div>
                    <ul class="col gap width_100">
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product ID -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_id(); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product name -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_name(); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product title -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_title(); ?>
                            </span>
                        </li>

                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product slug -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_slug(); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product price -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_price(); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product description -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_description(); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product short description -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_short_description(); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product image ID -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_image_id(); ?>
                            </span>
                        </li>

                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product image URL ($size) -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo wp_get_attachment_url($product->get_image_id()); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product categories -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_categories(); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product tags -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_tags(); ?>
                            </span>
                        </li>
                        <li class="row width_100 space_btw">
                            <span class="text_16 row flex_1">product attributes -> </span>
                            <span class="text_16 row flex_2">
                                <?php echo $product->get_attributes(); ?>
                            </span>
                        </li>
                    </ul>
                    <form class="cart" action="<?php echo esc_url(get_permalink()); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php
                        global $product;
                        $min_value = apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product);
                        $max_value = apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product);
                        $input_value = isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity();
                        ?>
                        <input type="number" name="quantity" value="<?php echo esc_attr($input_value); ?>"
                            min="<?php echo esc_attr($min_value); ?>" max="<?php echo esc_attr($max_value); ?>"
                            step="1" />

                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
                            class="single_add_to_cart_button button alt"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
                    </form>
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
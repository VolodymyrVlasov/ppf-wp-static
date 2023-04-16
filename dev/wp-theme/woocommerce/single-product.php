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
        <section class="section" id="head-section">
            <div class="container">
                <span class="template">SINGLE-PRODUCT.PHP</span>
            </div>
        </section>
        <section class="section">
            <div class="container">

                <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
                 
                    <div class="summary entry-summary">
                        <?php do_action('woocommerce_single_product_summary'); ?>
                        <?php echo do_shortcode('[fpd]'); ?>
                    </div>

                    <?php do_action('woocommerce_after_single_product_summary'); ?>
                </div>

                <?php do_action('woocommerce_after_single_product'); ?>
Í
            </div>
        </section>
    </main>
    <?php
    get_footer();
    wp_footer();
    ?>
</body>

</html>
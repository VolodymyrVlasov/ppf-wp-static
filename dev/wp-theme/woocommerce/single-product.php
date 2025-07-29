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
    <?php $isFPD = do_shortcode('[fpd]') ?>
</head>

<body>
    <?php get_header(); ?>
    <main>

        <section class="section" id="single-product">
            <form class="container col gap"
                action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                method="post" enctype='multipart/form-data'>
                <?php do_action('woocommerce_before_single_product'); ?>

                <h1 class="header_4"><?php echo $product->get_name(); ?></h1>
                <div class="row">
                    <? if (function_exists('woocommerce_breadcrumb')) {
                        woocommerce_breadcrumb();
                    } ?>
                </div>
                <div class="<?php echo ($isFPD == true) ? 'single_product_card_col' : 'single_product_card_row'; ?>">
                    <div
                        class="<?php echo ($isFPD == true) ? 'single_product_card_fpd_cnt bg_img' : 'single_product_card_image_cnt'; ?>">
                        <?php if ($isFPD) {
                            echo do_shortcode('[fpd]');
                        } else { ?>
                            <img class="bg_img"
                                src="{{stylesheet_url}}/static/global/ppf-image-not-found.png"
                                alt="<?php echo $relate_product_name; ?>"
                                width="500" height="450" loading="lazy" decoding="async" />
                        <?php } ?>
                    </div>
                    <div class="single_product_card_description_cnt ">
                        <div class="row gap">
                            <div class="col small_gap flex_1">
                                <?php include get_template_directory() . '/template-parts/ppf-single-product-fpd-description.php'; ?>
                            </div>
                            <?php include get_template_directory() . '/template-parts/ppf-single-product-form.php'; ?>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <?php
    get_footer();
    wp_footer();
    ?>
</body>

</html>
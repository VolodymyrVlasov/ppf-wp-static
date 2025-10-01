<?php
defined('ABSPATH') || exit;
the_post();
global $product;
$product_id = $product ? $product->get_id() : get_the_ID();
ppf_add_head_tag('<meta name="ppf-test" content="ok">');

ppf_add_head_tag(
    '<link rel="shortcut icon" href="' . esc_url(get_stylesheet_directory_uri() . '/static/icons/favicon.png') . '" type="image/x-icon">'
);
?>

<?php get_header(); ?>
<main>
   
    <?php
    if (ppf_product_has_fpd($product_id)) {
        wc_get_template('template-parts/ppf-single-product-fpd.php', ['order' => $order]);
    } else {
        wc_get_template('template-parts/ppf-single-product.php', ['order' => $order]);
    } ?>

    
</main>
<?php get_footer(); ?>
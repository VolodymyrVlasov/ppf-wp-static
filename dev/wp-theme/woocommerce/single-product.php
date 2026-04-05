<?php
defined('ABSPATH') || exit;

get_header();

while (have_posts()) :
    the_post();

    $product_id = get_the_ID();

    if (ppf_product_has_fpd($product_id)) {
        get_template_part('template-parts/woocommerce/ppf-single-product', 'fpd');
    } else {
        get_template_part('template-parts/woocommerce/ppf-single-product', 'standard');
    }
endwhile;

get_footer();

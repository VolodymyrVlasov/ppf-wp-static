<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('', $product); ?>>
    <div class="product-wrapper">
        <article class="product_card cards_3">
            <?php $image_url = wp_get_attachment_image_src( $product->get_image_id(), 'full' )[0]; ?>
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title(); ?>" class="bg_img width_100" width="200" height="200" loading="lazy" decoding="async" />
            <h3 class="text_16__bold width_100"><?php the_title(); ?></h3>
            <p class="text_14 width_100"><?php echo wp_kses_post( $product->get_short_description() ); ?></p>
            <a title="Перейти на сторінку товара <?php the_title(); ?>" href="<?php the_permalink(); ?>" class="sub_link">
                <span>ЗАМОВИТИ</span>
            </a>
        </article>
    </div>
</li>

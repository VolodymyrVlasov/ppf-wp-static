<?php
defined('ABSPATH') || exit;

global $product;

if (!$product || !$product->is_purchasable()) {
    return;
}

echo wc_get_stock_html($product);

if (!$product->is_in_stock()) {
    return;
}

do_action('woocommerce_before_add_to_cart_form');
?>

<form class="cart" method="post" enctype="multipart/form-data">
    <?php do_action('woocommerce_before_add_to_cart_button'); ?>

    <input type="hidden" name="quantity" value="1" />

    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
        class="single_add_to_cart_button button__primary">
        <?php echo esc_html($product->single_add_to_cart_text()); ?>
    </button>

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>

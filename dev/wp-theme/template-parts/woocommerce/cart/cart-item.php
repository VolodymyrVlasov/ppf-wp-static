<?php
/**
 * Cart item card template part.
 *
 * @package PaperFox\WooCommerce
 */

defined('ABSPATH') || exit;

if (empty($args['cart_item']) || empty($args['product']) || ! isset($args['cart_item_key'])) {
    return;
}

$cart_item     = $args['cart_item'];
$product       = $args['product'];
$cart_item_key = (string) $args['cart_item_key'];

/** @var \WC_Product $product */
$product_id        = $product->get_id();
$product_name      = apply_filters('woocommerce_cart_item_name', $product->get_name(), $cart_item, $cart_item_key);
$product_permalink = apply_filters(
    'woocommerce_cart_item_permalink',
    $product->is_visible() ? $product->get_permalink($cart_item) : '',
    $cart_item,
    $cart_item_key
);

$thumbnail_id = $product->get_image_id();

if ($thumbnail_id) {
    $image_html = wp_get_attachment_image(
        $thumbnail_id,
        array(100, 100),
        false,
        array(
            'class'   => 'cart_item_image bg_img',
            'loading' => 'lazy',
        )
    );
} else {
    $image_html = sprintf(
        '<img src="%1$s" alt="%2$s" width="100" height="100" class="cart_item_image bg_img" loading="lazy" />',
        esc_url(wc_placeholder_img_src('woocommerce_thumbnail')),
        esc_attr(wp_strip_all_tags($product_name))
    );
}

$thumbnail      = apply_filters('woocommerce_cart_item_thumbnail', $image_html, $cart_item, $cart_item_key);
$item_subtotal  = apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($product, $cart_item['quantity']), $cart_item, $cart_item_key);
$categories     = wc_get_product_category_list($product_id, ', ');
$product_meta   = wc_get_formatted_cart_item_data($cart_item);
$backorder_info = '';
$can_edit_design = false;

if ($product->backorders_require_notification() && $product->is_on_backorder($cart_item['quantity'])) {
    $backorder_info = esc_html__('Доступно для передзамовлення', 'paperfox');
}

if ($product_permalink && function_exists('ppf_product_has_fpd')) {
    $can_edit_design = (bool) ppf_product_has_fpd($product_id);
}

if ($product->is_sold_individually()) {
    $product_quantity  = '<div class="quantity">';
    $product_quantity .= '<div class="row small_gap">';
    $product_quantity .= '<div class="custom_number_wrapper">';
    $product_quantity .= '<span class="custom_input_input__number input-text qty text" data-quantity-display="true">1</span>';
    $product_quantity .= sprintf('<input type="hidden" name="cart[%s][qty]" value="1" />', esc_attr($cart_item_key));
    $product_quantity .= '</div></div></div>';
} else {
    $min_value = apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product);
    $max_value = apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product);
    $step      = apply_filters('woocommerce_quantity_input_step', 1, $product);
    $pattern   = apply_filters('woocommerce_quantity_input_pattern', '', $product);
    $inputmode = apply_filters('woocommerce_quantity_input_inputmode', '', $product);
    $input_id  = 'quantity_' . sanitize_html_class($cart_item_key);

    $product_quantity  = '<div class="quantity" data-cart-quantity>';
    $product_quantity .= '<div class="row small_gap">';
    $product_quantity .= '<div class="custom_number_wrapper">';
    $product_quantity .= sprintf(
        '<button type="button" class="custom_number_btn minus" data-quantity-button="minus" aria-label="%s"></button>',
        esc_attr__('зменшити кількість на 1', 'paperfox')
    );
    $product_quantity .= sprintf(
        '<input type="number" id="%1$s" class="custom_input_input__number input-text qty text" name="cart[%2$s][qty]" value="%3$s"%4$s%5$s step="%6$s"%7$s%8$s placeholder="" inputmode="numeric" autocomplete="off" title="%9$s" />',
        esc_attr($input_id),
        esc_attr($cart_item_key),
        esc_attr($cart_item['quantity']),
        '' !== $max_value && $max_value > 0 ? ' max="' . esc_attr($max_value) . '"' : '',
        '' !== $min_value ? ' min="' . esc_attr($min_value) . '"' : '',
        esc_attr($step),
        $pattern ? ' pattern="' . esc_attr($pattern) . '"' : '',
        $inputmode ? ' inputmode="' . esc_attr($inputmode) . '"' : '',
        esc_attr__('Кількість', 'paperfox')
    );
    $product_quantity .= sprintf(
        '<button type="button" class="custom_number_btn plus" data-quantity-button="plus" aria-label="%s"></button>',
        esc_attr__('збільшити кількість на 1', 'paperfox')
    );
    $product_quantity .= '</div>';
    $product_quantity .= '</div>';
    $product_quantity .= '</div>';
}

$product_quantity = apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
?>

<li class="cart_item" data-cart-item="<?php echo esc_attr($cart_item_key); ?>">
    <div class="cart_item_description flex_2">
        <div class="cart_item_image_wrapper">
            <?php if ($product_permalink) : ?>
                <a href="<?php echo esc_url($product_permalink); ?>" class="cart_item_image_link">
                    <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </a>
            <?php else : ?>
                <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php endif; ?>
        </div>

        <div class="col small_gap">
            <div class="popover_wrapper">
                <div class="popover_content">
                    <div class="col_center">
                        <?php if ($product_permalink) : ?>
                            <a class="plain_text text_bold cart_item_name_truncated" href="<?php echo esc_url($product_permalink); ?>">
                                <?php echo wp_kses_post($product_name); ?>
                            </a>
                        <?php else : ?>
                            <span class="plain_text text_bold cart_item_name_truncated"><?php echo wp_kses_post($product_name); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="popover_description">
                    <div class="plain_text_small col small_gap">
                        <span><?php echo wp_kses_post($product_name); ?></span>
                        <?php if ($product_meta) : ?>
                            <?php echo wp_kses_post($product_meta); ?>
                        <?php endif; ?>
                        <?php if ($backorder_info) : ?>
                            <span class="cart_item_backorder"><?php echo esc_html($backorder_info); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($categories) : ?>
                <span class="cart_item_category"><?php echo wp_kses_post($categories); ?></span>
            <?php endif; ?>

            <?php if ($can_edit_design) : ?>
                <a href="<?php echo esc_url($product_permalink); ?>" class="plain_text_smaller link">
                    <?php esc_html_e('Редагувати дизайн', 'paperfox'); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="col_end flex_1">
        <span class="cart_item_price">
            <?php echo wp_kses_post($item_subtotal); ?>
        </span>
        <div class="row_center big_gap">
            <div class="cart_item_quantity">
                <?php echo $product_quantity; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>

            <?php
            echo apply_filters(
                'woocommerce_cart_item_remove_link',
                sprintf(
                    '<a href="%1$s" class="cart_item_del" aria-label="%2$s" data-product_id="%3$s" data-product_sku="%4$s"></a>',
                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                    esc_attr__('Видалити товар', 'paperfox'),
                    esc_attr($product_id),
                    esc_attr($product->get_sku())
                ),
                $cart_item_key
            );
            ?>
        </div>
    </div>
</li>

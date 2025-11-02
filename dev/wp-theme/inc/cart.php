<?php
/**
 * Cart-related helpers and AJAX handlers.
 *
 * @package PaperFox\WooCommerce
 */

defined('ABSPATH') || exit;

/**
 * Returns cart content HTML used both on the page and in AJAX refreshes.
 */
function paperfox_get_cart_content_html(): string
{
    ob_start();

    ?>
    <div class="paperfox-cart-content" data-cart-content>
        <form class="row big_gap woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post" enctype="multipart/form-data">
            <article class="cart_items_card flex_4">
                <div class="col big_gap width_100">
                    <h2 class="text_24"><?php esc_html_e('Ваш кошик', 'paperfox'); ?></h2>

                    <?php do_action('woocommerce_before_cart_table'); ?>

                    <ul class="cart_items_card_list">
                        <?php do_action('woocommerce_before_cart_contents'); ?>

                        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                            /** @var \WC_Product $product */
                            $product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                            if (! $product || ! $product->exists() || $cart_item['quantity'] <= 0 || ! apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                continue;
                            }

                            get_template_part(
                                'template-parts/woocommerce/cart/cart-item',
                                null,
                                [
                                    'cart_item_key' => $cart_item_key,
                                    'cart_item'     => $cart_item,
                                    'product'       => $product,
                                ]
                            );
                        endforeach; ?>

                        <?php do_action('woocommerce_cart_contents'); ?>
                        <?php do_action('woocommerce_after_cart_contents'); ?>
                    </ul>

                    <?php do_action('woocommerce_after_cart_table'); ?>
                </div>
            </article>

            <article class="cart_summary_card flex_2">
                <span class="text_32"><?php esc_html_e('Разом', 'paperfox'); ?></span>

                <div class="row_sp_btw">
                    <span class="text_12">
                        <?php
                        printf(
                            /* translators: %d: cart items count */
                            esc_html__('Товарів: %d шт.', 'paperfox'),
                            WC()->cart->get_cart_contents_count()
                        );
                        ?>
                    </span>
                    <span class="text_12">
                        <?php wc_cart_totals_subtotal_html(); ?>
                    </span>
                </div>

                <div class="cart_summary_card_price">
                    <span class="text_12"><?php esc_html_e('До сплати', 'paperfox'); ?></span>
                    <span class="text_24"><?php wc_cart_totals_order_total_html(); ?></span>
                </div>

                <?php if (wc_coupons_enabled()) : ?>
                    <div class="woocommerce-cart-form__coupon cart_summary_coupon col small_gap">
                        <div class="checkout_input_text">
                            <label for="coupon_code"><?php esc_html_e('Купон на знижку', 'paperfox'); ?></label>
                            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Введіть код купона', 'paperfox'); ?>" />
                        </div>
                        <button type="submit" class="button__normal width_100" name="apply_coupon" value="<?php esc_attr_e('Застосувати купон', 'paperfox'); ?>">
                            <?php esc_html_e('Застосувати', 'paperfox'); ?>
                        </button>
                        <?php do_action('woocommerce_cart_coupon'); ?>
                    </div>
                <?php endif; ?>

                <div class="col small_gap">
                    <?php do_action('woocommerce_cart_actions'); ?>

                    <a class="button__primary width_100" href="<?php echo esc_url(wc_get_checkout_url()); ?>" title="<?php echo esc_attr__('Натисніть, щоб перейти до оформлення замовлення', 'paperfox'); ?>">
                        <?php esc_html_e('ПЕРЕЙТИ ДО ОФОРМЛЕННЯ', 'paperfox'); ?>
                    </a>
                </div>

                <span class="text_12">
                    <?php esc_html_e('Підтверджуючи оформлення, ви переконуєтеся у відповідності дизайну або виробу, з можливими відхиленнями через технічні обмеження.', 'paperfox'); ?>
                </span>

                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                <input type="hidden" name="cart" value="1" />
            </article>
        </form>

        <?php do_action('woocommerce_before_cart_collaterals'); ?>

        <div class="cart-collaterals cart_collaterals_custom">
            <?php woocommerce_cross_sell_display(); ?>
        </div>

        <?php do_action('woocommerce_after_cart'); ?>
    </div>
    <?php

    return (string) ob_get_clean();
}

/**
 * Enqueue cart-specific scripts.
 */
function paperfox_enqueue_cart_scripts(): void
{
    if (! is_cart()) {
        return;
    }

    wp_enqueue_script(
        'paperfox-cart-auto-update',
        get_stylesheet_directory_uri() . '/js/paperfox-cart-auto-update.js',
        array('jquery'),
        null,
        true
    );

    wp_localize_script(
        'paperfox-cart-auto-update',
        'PAPERFOX_CART',
        array(
            'ajax_url'   => admin_url('admin-ajax.php'),
            'nonce'      => wp_create_nonce('paperfox_update_cart'),
            'error_text' => esc_html__('Не вдалося оновити кошик. Спробуйте ще раз.', 'paperfox'),
            'loading_label' => esc_html__('Оновлення...', 'paperfox'),
        )
    );
}
add_action('wp_enqueue_scripts', 'paperfox_enqueue_cart_scripts');

/**
 * AJAX handler for updating cart item quantity.
 */
function paperfox_ajax_update_cart_item(): void
{
    check_ajax_referer('paperfox_update_cart', 'nonce');

    if (! isset($_POST['cart_item_key'], $_POST['quantity'])) {
        wp_send_json_error(array('message' => esc_html__('Невірні дані для оновлення кошика.', 'paperfox')));
    }

    $cart_item_key = sanitize_text_field(wp_unslash($_POST['cart_item_key']));
    $quantity      = wc_stock_amount(wp_unslash($_POST['quantity']));

    $cart = WC()->cart;

    if (! $cart || ! $cart->get_cart_item($cart_item_key)) {
        wp_send_json_error(array('message' => esc_html__('Товар не знайдено у кошику.', 'paperfox')));
    }

    $updated = $cart->set_quantity($cart_item_key, $quantity, true);

    if (false === $updated) {
        wp_send_json_error(array('message' => esc_html__('Не вдалося оновити кількість товару.', 'paperfox')));
    }

    $cart->calculate_totals();
    $notices_html = wc_get_template_html('notices/notices.php');

    wp_send_json_success(
        array(
            'html'      => paperfox_get_cart_content_html(),
            'cart_hash' => $cart->get_cart_hash(),
            'notices'   => $notices_html,
        )
    );
}
add_action('wp_ajax_paperfox_update_cart_item', 'paperfox_ajax_update_cart_item');
add_action('wp_ajax_nopriv_paperfox_update_cart_item', 'paperfox_ajax_update_cart_item');

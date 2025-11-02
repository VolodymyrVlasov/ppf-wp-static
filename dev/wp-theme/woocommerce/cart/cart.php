<?php
/**
 * Cart page template override.
 *
 * @package PaperFox\WooCommerce
 */

defined('ABSPATH') || exit;

?>

<section class="section paperfox-cart-section">
    <div class="container">
        <?php do_action('woocommerce_before_cart'); ?>

        <?php if (WC()->cart->is_empty() && ! WC()->cart->has_errors()) : ?>
            <?php wc_get_template('cart/cart-empty.php'); ?>
        <?php else : ?>
            <?php echo paperfox_get_cart_content_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php endif; ?>
    </div>
</section>

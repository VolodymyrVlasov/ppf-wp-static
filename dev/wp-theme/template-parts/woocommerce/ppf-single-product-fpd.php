<?php
defined('ABSPATH') || exit;

global $product;

do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}

$before_summary_html = '';
ob_start();
do_action('woocommerce_before_single_product_summary');
$before_summary_html = trim(ob_get_clean());

if ($before_summary_html === '' && $product) {
    ob_start();
    woocommerce_show_product_images();
    $before_summary_html = ob_get_clean();
}

$upsell_html = $product instanceof WC_Product ? ppf_render_product_upsell_section($product) : '';
$description_html = $product instanceof WC_Product ? ppf_render_product_description_block($product) : '';
?>

<section class="section">
    <div class="container col big_gap">
        <?php if ($before_summary_html !== '') : ?>
            <div class="single_product_card_fpd_cnt">
                <div class="ppf-fpd-wrapper">
                    <?php echo $before_summary_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="single_product_card_fpd">
            <div class="col big_gap flex_2">
                <?php if ($upsell_html !== '') : ?>
                    <?php echo $upsell_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php endif; ?>

                <?php if ($description_html !== '') : ?>
                    <?php echo $description_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php endif; ?>
            </div>

            <div class="col gap flex_1">
                <div class="single_product_summary_card">
                    <h1 class="header_4"><?php the_title(); ?></h1>

                    <div class="price_label">
                        <span><?php esc_html_e('Вартість', 'paperfox'); ?></span>
                        <p class="price_after"><?php echo wp_kses_post($product->get_price_html()); ?></p>
                    </div>

                    <div class="ppf-add-to-cart">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php do_action('woocommerce_after_single_product_summary'); ?>
<?php do_action('woocommerce_after_single_product'); ?>

<?php
defined('ABSPATH') || exit;

function paperfox_enqueue_styles(): void
{
    wp_enqueue_style('paperfox-style', get_stylesheet_directory_uri() . '/style.css', array(), null);
}
add_action('wp_enqueue_scripts', 'paperfox_enqueue_styles');

function paperfox_theme_support(): void
{
    add_theme_support('title-tag');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'paperfox_theme_support');

function paperfox_single_product_tweaks(): void
{
    if (!is_product()) {
        return;
    }

    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}
add_action('wp', 'paperfox_single_product_tweaks');

function paperfox_inline_styles(): void
{
    if (!wp_style_is('paperfox-style', 'enqueued')) {
        return;
    }

    $css = [];
    $css[] = '.price_label .price, .price_label .price_after {border: 0; background: none; padding: 0; margin: 0; display: block;}';
    $css[] = '.price_label .price_after del {margin-right: 0.75rem;}';
    $css[] = '.single_product_card_image_cnt .woocommerce-product-gallery,';
    $css[] = '.single_product_card_image_cnt .woocommerce-product-gallery__wrapper,';
    $css[] = '.single_product_card_image_cnt .woocommerce-product-gallery__wrapper img {width: 100%; height: 100%;}';
    $css[] = '.single_product_card_image_cnt .woocommerce-product-gallery__wrapper img {object-fit: contain;}';
    $css[] = '.single_product_summary_card .single_add_to_cart_button {width: 100%;}';
    $css[] = '.single_product_summary_card .single_add_to_cart_button.button__primary {background: var(--color-red-500); color: #fff;}';

    wp_add_inline_style('paperfox-style', implode("\n", $css));
}
add_action('wp_enqueue_scripts', 'paperfox_inline_styles', 20);

add_filter( 'woocommerce_currency_symbol', '__return_empty_string' );
?>

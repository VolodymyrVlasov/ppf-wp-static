<?php

function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

add_filter('template_include', 'ppf_order_received_template', 99);

function ppf_order_received_template($template)
{
    // Проверяем, что мы находимся на странице "order-received"
    if (is_wc_endpoint_url('order-received')) {
        // Путь к вашему пользовательскому шаблону для страницы "order-received"
        $custom_template = get_stylesheet_directory() . 'ppf-order-received.php';

        // Проверяем, существует ли пользовательский шаблон
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    // Если мы не находимся на странице "order-received" или не найден пользовательский шаблон, возвращаем текущий шаблон
    return $template;
}

function custom_woocommerce_breadcrumbs($defaults)
{
    $defaults['delimiter'] = ' > '; // Вказуємо свій роздільник
    $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb text_color_gray plain_text_small">';
    $defaults['wrap_after'] = '</nav>';
    return $defaults;
}

add_filter('woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumbs');

?>
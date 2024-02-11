<?php
function my_theme_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', false);
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function ppf_theme_scripts()
{
    wp_enqueue_script('ppf-script-checkout', get_template_directory_uri() . '/js/checkout.js', array(), null, true);
}

// Запуск функции при загрузке скриптов
add_action('wp_enqueue_scripts', 'ppf_theme_scripts');



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



// add_filter('category_link', function($a){
// 	return str_replace( '/product-category', '', $a );
// }, 99 );
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



function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
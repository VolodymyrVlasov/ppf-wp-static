<?php
function my_theme_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', false);
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function ppf_theme_scripts()
{
    if (is_checkout()) {
        wp_enqueue_script('ppf-script-checkout', get_template_directory_uri() . '/js/checkout.js', array(), null, true);
    }
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

function custom_woocommerce_breadcrumbs($defaults)
{
    $defaults['delimiter'] = ' > '; // Вказуємо свій роздільник
    $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb text_color_gray plain_text_small">';
    $defaults['wrap_after'] = '</nav>';
    return $defaults;
}

add_filter('woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumbs');

// add_filter('category_link', function($a){
// 	return str_replace( '/product-category', '', $a );
// }, 99 );


function ppf_product_has_fpd( $product_id = null ): bool {
  $product_id = $product_id ?: get_the_ID();

  // Плагін активний?
  if ( ! class_exists('Fancy_Product_Designer') && ! defined('FPD_PLUGIN_DIR') ) {
    return false;
  }

  // Шорткод у контенті або в короткому описі
  $content = (string) get_post_field('post_content', $product_id);
  $excerpt = (string) get_post_field('post_excerpt', $product_id);
  if ( ($content && has_shortcode($content, 'fpd')) || ($excerpt && has_shortcode($excerpt, 'fpd')) ) {
    return true;
  }

  // Найпоширеніші meta-ключі FPD (варіанти з/без підкреслення)
  $candidates = [
    '_fpd_enabled', 'fpd_enabled',                 // 'yes' / 'no'
    '_fpd_product', 'fpd_product',                 // ID одного FPD-продукту
    '_fpd_products', 'fpd_products',               // масив або JSON для кількох
    '_fpd_display', 'fpd_display',                 // спосіб відображення
    '_fpd_product_settings', 'fpd_product_settings'
  ];

  foreach ( $candidates as $key ) {
    $val = get_post_meta( $product_id, $key, true );

    if ( is_array($val) && !empty($val) ) return true;

    if ( is_string($val) ) {
      $v = strtolower(trim($val));
      if ( $v !== '' && $v !== '0' && $v !== 'no' && $v !== 'false' && $v !== '[]' && $v !== '{}' ) {
        // якщо JSON – розпарсимо
        $decoded = json_decode($val, true);
        if ( json_last_error() === JSON_ERROR_NONE ) {
          if ( !empty($decoded) ) return true;
        } else {
          return true; // просто непорожній рядок
        }
      }
    }

    if ( is_numeric($val) && intval($val) > 0 ) return true;
  }

  return false;
}



<?php

function ppf_product_has_fpd($product_id = null): bool
{
    $product_id = $product_id ?: get_the_ID();

    // Плагін активний?
    if (!class_exists('Fancy_Product_Designer') && !defined('FPD_PLUGIN_DIR')) {
        return false;
    }

    // Шорткод у контенті або в короткому описі
    $content = (string) get_post_field('post_content', $product_id);
    $excerpt = (string) get_post_field('post_excerpt', $product_id);
    if (($content && has_shortcode($content, 'fpd')) || ($excerpt && has_shortcode($excerpt, 'fpd'))) {
        return true;
    }

    // Найпоширеніші meta-ключі FPD (варіанти з/без підкреслення)
    $candidates = [
        '_fpd_enabled',
        'fpd_enabled',                 // 'yes' / 'no'
        '_fpd_product',
        'fpd_product',                 // ID одного FPD-продукту
        '_fpd_products',
        'fpd_products',               // масив або JSON для кількох
        '_fpd_display',
        'fpd_display',                 // спосіб відображення
        '_fpd_product_settings',
        'fpd_product_settings'
    ];

    foreach ($candidates as $key) {
        $val = get_post_meta($product_id, $key, true);

        if (is_array($val) && !empty($val))
            return true;

        if (is_string($val)) {
            $v = strtolower(trim($val));
            if ($v !== '' && $v !== '0' && $v !== 'no' && $v !== 'false' && $v !== '[]' && $v !== '{}') {
                // якщо JSON – розпарсимо
                $decoded = json_decode($val, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    if (!empty($decoded))
                        return true;
                } else {
                    return true; // просто непорожній рядок
                }
            }
        }

        if (is_numeric($val) && intval($val) > 0)
            return true;
    }

    return false;
}

if (!function_exists('ppf_get_fpd_preview')) {
    /**
     * Повертає URL (або data:image) прев’ю з FPD для елемента кошика.
     * Працює з різними структурами даних FPD: прямі ключі в $cart_item,
     * вкладений масив 'fpd_data', JSON-рядок, attachment ID, data URL.
     */
    function ppf_get_fpd_preview($cart_item, $product_id = 0)
    {

        // 1) Зібрати потенційні кандидати з прямими ключами
        $candidates = array();
        foreach (array('fpd_product_thumbnail', 'fpd_thumbnail', 'fpd_preview', 'fpd_product_image', 'fancy_product_thumbnail') as $k) {
            if (!empty($cart_item[$k]))
                $candidates[] = $cart_item[$k];
        }

        // 2) Розібрати вкладені дані (масив або JSON) в 'fpd_data'
        if (!empty($cart_item['fpd_data'])) {
            $data = $cart_item['fpd_data'];

            // якщо це JSON — декодуємо
            if (is_string($data)) {
                $decoded = json_decode($data, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $data = $decoded;
                }
            }

            if (is_array($data)) {
                foreach (array('fpd_product_thumbnail', 'product_thumbnail', 'thumbnail', 'preview', 'image') as $k) {
                    if (!empty($data[$k]))
                        $candidates[] = $data[$k];
                }
                // інколи ескіз лежить у views[0].thumbnail або подібно
                if (!empty($data['views']) && is_array($data['views'])) {
                    foreach ($data['views'] as $view) {
                        if (!empty($view['thumbnail']))
                            $candidates[] = $view['thumbnail'];
                    }
                }
            }
        }

        // 3) Повернути перший валідний кандидат (id вкладення / URL / data:image)
        foreach ($candidates as $v) {
            if (is_numeric($v)) {
                $url = wp_get_attachment_url(intval($v));
                if ($url)
                    return $url;
            }
            if (is_string($v) && $v !== '') {
                return $v; // може бути як звичайний URL, так і data:image/png;base64,…
            }
        }

        // 4) Фолбек на стандартну мініатюру товару або плейсхолдер
        if ($product_id) {
            $fallback = get_the_post_thumbnail_url($product_id, 'woocommerce_thumbnail');
            if ($fallback)
                return $fallback;
        }
        return wc_placeholder_img_src('woocommerce_thumbnail');
    }
}


// === PPF × FPD: cart integration helpers ===

// 1) При додаванні в кошик зберігаємо FPD-дані + прев’ю + унікальний ключ (щоб рядки не зливалися)
add_filter('woocommerce_add_cart_item_data', function ($cart_item_data, $product_id, $variation_id, $quantity) {
    $fpd_payload = array();
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'fpd_') === 0) {
            $fpd_payload[$k] = is_string($v) ? wp_unslash($v) : $v;
        }
    }

    $preview = $fpd_payload['fpd_product_thumbnail'] ?? ($cart_item_data['fpd_product_thumbnail'] ?? '');
    if (!$preview && !empty($_POST['fpd_product_thumbnail'])) {
        $preview = esc_url_raw(wp_unslash($_POST['fpd_product_thumbnail']));
    }

    if (!empty($fpd_payload) || !empty($preview)) {
        if (!empty($fpd_payload)) {
            $cart_item_data['fpd_data'] = $fpd_payload;
        }
        if (!empty($preview)) {
            $cart_item_data['fpd_product_thumbnail'] = $preview;
        }
        // важливо: це примусово робить кожен FPD-макет окремим рядком у кошику
        $cart_item_data['ppf_unique_key'] = wp_generate_uuid4();
    }
    return $cart_item_data;
}, 10, 4);

// 2) Classic Cart: підміна прев’ю
add_filter('woocommerce_cart_item_thumbnail', function ($html, $cart_item, $cart_item_key) {
    if (!function_exists('ppf_get_fpd_preview'))
        return $html;
    $url = ppf_get_fpd_preview($cart_item, $cart_item['product_id'] ?? 0);
    if ($url) {
        $alt = isset($cart_item['data']) && is_object($cart_item['data']) ? $cart_item['data']->get_name() : 'Customized preview';
        return sprintf('<img src="%s" alt="%s" class="cart_item_image bg_img" />', esc_url($url), esc_attr($alt));
    }
    return $html;
}, 10, 3);

// 3) Blocks Cart: підміна прев’ю через Store API
add_filter('woocommerce_store_api_cart_item_images', function ($images, $cart_item, $cart_item_key) {
    if (!function_exists('ppf_get_fpd_preview'))
        return $images;
    $url = ppf_get_fpd_preview($cart_item, $cart_item['product_id'] ?? 0);
    if ($url) {
        return array(
            (object) array(
                'id' => 0,
                'src' => $url,
                'thumbnail' => $url,
                'srcset' => '',
                'sizes' => '',
                'name' => 'Customized preview',
                'alt' => 'Customized preview',
            )
        );
    }
    return $images;
}, 10, 3);

// 4) URL для редагування макету з кошика
if (!function_exists('ppf_get_fpd_edit_url')) {
    function ppf_get_fpd_edit_url($cart_item_key, $cart_item)
    {
        $product_id = $cart_item['product_id'] ?? 0;
        if (!$product_id)
            return '';
        $args = array(
            'ppf_edit' => 1,
            'cart_item_key' => $cart_item_key,
        );
        // якщо маєш у cart_item якісь fpd_product / fpd_set — додаємо до URL
        if (!empty($cart_item['fpd_data']['fpd_product'])) {
            $args['fpd_product'] = $cart_item['fpd_data']['fpd_product'];
        }
        if (!empty($cart_item['fpd_data']['fpd_set'])) {
            $args['fpd_set'] = $cart_item['fpd_data']['fpd_set'];
        }
        return add_query_arg($args, get_permalink($product_id));
    }
}

?>
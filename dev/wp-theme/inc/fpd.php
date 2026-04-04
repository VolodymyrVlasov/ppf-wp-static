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

?>
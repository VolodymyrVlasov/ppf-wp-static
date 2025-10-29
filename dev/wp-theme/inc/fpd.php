<?php
defined('ABSPATH') || exit;

if (!function_exists('ppf_product_has_fpd')) {
    function ppf_product_has_fpd($product_id = null)
    {
        if (!class_exists('Fancy_Product_Designer')) {
            return false;
        }

        $product_id = $product_id ?: get_the_ID();
        if (!$product_id) {
            return false;
        }

        $content = (string) get_post_field('post_content', $product_id);
        if ($content && has_shortcode($content, 'fpd')) {
            return true;
        }

        $excerpt = (string) get_post_field('post_excerpt', $product_id);
        if ($excerpt && has_shortcode($excerpt, 'fpd')) {
            return true;
        }

        $candidates = array(
            '_fpd_enabled',
            'fpd_enabled',
            '_fpd_product',
            'fpd_product',
            '_fpd_products',
            'fpd_products',
            '_fpd_display',
            'fpd_display',
        );

        foreach ($candidates as $key) {
            $val = get_post_meta($product_id, $key, true);
            if (empty($val)) {
                continue;
            }

            if (is_numeric($val) && intval($val) > 0) {
                return true;
            }

            if (is_array($val) && !empty($val)) {
                return true;
            }

            if (is_string($val)) {
                $trimmed = strtolower(trim($val));
                if ($trimmed !== '' && $trimmed !== '0' && $trimmed !== 'no' && $trimmed !== 'false') {
                    return true;
                }
            }
        }

        return false;
    }
}

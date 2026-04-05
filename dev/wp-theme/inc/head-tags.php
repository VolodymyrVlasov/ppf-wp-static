<?php
if (!defined('ABSPATH'))
    exit;

/* =========================
 * Універсальний head-буфер
 * ========================= */
$GLOBALS['ppf_head_tags'] = [];
function ppf_add_head_tag(string $html): void
{
    if (!isset($GLOBALS['ppf_head_tags']))
        $GLOBALS['ppf_head_tags'] = [];
    $GLOBALS['ppf_head_tags'][] = $html;
}
add_action('wp_head', function () {
    if (empty($GLOBALS['ppf_head_tags']))
        return;
    foreach ($GLOBALS['ppf_head_tags'] as $tag)
        echo $tag . "\n";
}, 99);


/* =========================
 * Фолбеки для метаданих
 * ========================= */

/** Отримати fallback description, якщо у товару порожній опис */
function ppf_fallback_description(): string
{
    $site = wp_strip_all_tags(get_bloginfo('name'));
    $tagl = wp_strip_all_tags(get_bloginfo('description')); // tagline
    $base = $site . ($tagl ? ' — ' . $tagl : 'PaperFox — друк на замовлення');
    // Можеш задати свій кастомний:
    // $base = 'PaperFox — друк на замовлення';
    return $base;
}

/**
 * Якщо тема НЕ підтримує title-tag, виводимо <title> вручну
 * (інакше цим керує ядро/SEO-плагін/фільтр document_title_parts)
 */
add_action('wp_head', function () {
    if (current_theme_supports('title-tag'))
        return;

    $title = wp_get_document_title(); // ядро зліпить з фільтра нижче
    if ($title) {
        echo '<title>' . esc_html($title) . '</title>' . "\n";
    }
}, 1); // дуже рано, до інших meta


/* ===============================================
 * Фільтр заголовка <title> (для продуктів за замовчанням)
 * =============================================== */
add_filter('document_title_parts', function ($parts) {
    if (function_exists('is_product') && is_product()) {
        $site = get_bloginfo('name');
        $prod = get_the_title();
        $parts['title'] = $prod ? $prod : $site;
    }
    return $parts;
}, 20);


/* =======================================================
 * Авто-OG/Twitter/description + JSON-LD Product для товарів
 * ======================================================= */

function ppf_get_product_images(WC_Product $product): array
{
    $out = [];
    if ($id = $product->get_image_id()) {
        if ($u = wp_get_attachment_image_url($id, 'large'))
            $out[] = esc_url_raw($u);
    }
    foreach ((array) $product->get_gallery_image_ids() as $gid) {
        if ($u = wp_get_attachment_image_url($gid, 'large'))
            $out[] = esc_url_raw($u);
    }
    if (empty($out)) {
        if ($u = wc_placeholder_img_src('large'))
            $out[] = esc_url_raw($u);
    }
    return array_values(array_unique($out));
}
function ppf_schema_availability(WC_Product $product): string
{
    switch ($product->get_stock_status()) {
        case 'instock':
            return 'https://schema.org/InStock';
        case 'onbackorder':
            return 'https://schema.org/PreOrder';
        case 'outofstock':
            return 'https://schema.org/OutOfStock';
        default:
            return 'https://schema.org/InStock';
    }
}
function ppf_get_product_brand(WC_Product $product): string
{
    $brand = $product->get_attribute('pa_brand');
    if ($brand)
        return wp_strip_all_tags($brand);
    $meta = get_post_meta($product->get_id(), '_brand', true);
    return $meta ? wp_strip_all_tags($meta) : '';
}
function ppf_trim_description(string $html, int $words = 40): string
{
    return wp_trim_words(wp_strip_all_tags($html), $words, '…');
}

/** Головний генератор метаданих під продукт */
function ppf_add_product_meta_tags(): void
{
    $product_id = get_queried_object_id();
    $product = $product_id ? wc_get_product($product_id) : null;
    if (!$product instanceof WC_Product)
        return;

    $title = wp_strip_all_tags($product->get_name());
    $desc = $product->get_short_description() ?: $product->get_description();
    $desc = ppf_trim_description((string) $desc, 40);
    if ($desc === '')
        $desc = ppf_fallback_description(); // <-- ФОЛБЕК!

    $url = get_permalink($product->get_id());
    $images = ppf_get_product_images($product);
    $curr = get_woocommerce_currency();
    $price = $product->get_price();
    $sku = $product->get_sku();
    $brand = ppf_get_product_brand($product);
    $avail = ppf_schema_availability($product);

    /* --- Open Graph --- */
    ppf_add_head_tag('<meta property="og:type" content="product">');
    ppf_add_head_tag('<meta property="og:title" content="' . esc_attr($title) . '">');
    ppf_add_head_tag('<meta property="og:description" content="' . esc_attr($desc) . '">');
    ppf_add_head_tag('<meta property="og:url" content="' . esc_url($url) . '">');
    if (!empty($images)) {
        ppf_add_head_tag('<meta property="og:image" content="' . esc_url($images[0]) . '">');
        for ($i = 1; $i < min(count($images), 3); $i++) {
            ppf_add_head_tag('<meta property="og:image" content="' . esc_url($images[$i]) . '">');
        }
    }
    if ($price !== '') {
        ppf_add_head_tag('<meta property="product:price:amount" content="' . esc_attr($price) . '">');
        ppf_add_head_tag('<meta property="product:price:currency" content="' . esc_attr($curr) . '">');
    }

    /* --- Twitter --- */
    ppf_add_head_tag('<meta name="twitter:card" content="summary_large_image">');
    ppf_add_head_tag('<meta name="twitter:title" content="' . esc_attr($title) . '">');
    ppf_add_head_tag('<meta name="twitter:description" content="' . esc_attr($desc) . '">');
    if (!empty($images)) {
        ppf_add_head_tag('<meta name="twitter:image" content="' . esc_url($images[0]) . '">');
    }

    /* --- Meta description --- */
    ppf_add_head_tag('<meta name="description" content="' . esc_attr($desc) . '">');

    /* --- JSON-LD Product --- */
    $item = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        '@id' => esc_url_raw($url) . '#product',
        'name' => $title,
        'url' => esc_url_raw($url),
        'image' => $images,
        'sku' => $sku ?: null,
        'brand' => $brand ? ['@type' => 'Brand', 'name' => $brand] : null,
        'description' => $desc,
    ];
    $rating_count = (int) $product->get_rating_count();
    $average = (float) $product->get_average_rating();
    if ($rating_count > 0 && $average > 0) {
        $item['aggregateRating'] = [
            '@type' => 'AggregateRating',
            'ratingCount' => $rating_count,
            'ratingValue' => $average,
            'bestRating' => 5,
            'worstRating' => 1,
        ];
    }
    if ($price !== '') {
        $offer = [
            '@type' => 'Offer',
            'price' => (string) $price,
            'priceCurrency' => $curr,
            'availability' => $avail,
            'url' => esc_url_raw($url),
        ];
        $reg = $product->get_regular_price();
        $sale = $product->get_sale_price();
        if ($sale !== '') {
            $offer['priceSpecification'] = [
                '@type' => 'UnitPriceSpecification',
                'price' => (string) $sale,
                'priceCurrency' => $curr,
            ];
        }
        $item['offers'] = $offer;
    }
    // прибрати порожні
    $item = array_filter($item, fn($v) => $v !== null && $v !== '' && $v !== []);
    $json = wp_json_encode($item, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json) {
        ppf_add_head_tag('<script type="application/ld+json">' . $json . '</script>');
    }
}

add_action('wp_head', 'ppf_add_product_meta_tags', 12);


<?php
defined('ABSPATH') || exit;
the_post();
global $product;
$product_id = $product ? $product->get_id() : get_the_ID();
ppf_add_head_tag('<meta name="ppf-test" content="ok">');

ppf_add_head_tag(
    '<link rel="shortcut icon" href="' . esc_url(get_stylesheet_directory_uri() . '/static/icons/favicon.png') . '" type="image/x-icon">'
);
?>

<?php get_header(); ?>
<main>
    <?php
    if (ppf_product_has_fpd($product_id)) {
        wc_get_template('template-parts/ppf-single-product-fpd.php', ['order' => $order]);
    } else {
        wc_get_template('template-parts/ppf-single-product.php', ['order' => $order]);
    } ?>

    <section class="section">
        <div class="container col gap">

            <?php
            // Основні властивості
            echo "ID: " . $product->get_id() . "\n";
            echo "Назва: " . $product->get_name() . "\n";
            echo "SKU: " . $product->get_sku() . "\n";
            echo "Тип: " . $product->get_type() . "\n";
            echo "Статус: " . $product->get_status() . "\n";
            echo "Посилання: " . $product->get_permalink() . "\n";

            // Ціна
            echo "Ціна (звичайна): " . $product->get_regular_price() . "\n";
            echo "Ціна (акційна): " . $product->get_sale_price() . "\n";
            echo "Ціна (поточна): " . $product->get_price() . "\n";
            echo "HTML ціни: " . $product->get_price_html() . "\n";

            // Склад
            echo "Є у наявності? " . ($product->is_in_stock() ? 'так' : 'ні') . "\n";
            echo "Статус складу: " . $product->get_stock_status() . "\n";
            echo "Кількість на складі: " . $product->get_stock_quantity() . "\n";

            // Вага та розміри
            echo "Вага: " . wc_format_weight($product->get_weight()) . "\n";
            echo "Розміри: " . wc_format_dimensions($product->get_dimensions(false)) . "\n";

            // Зображення
            echo "Головне зображення: " . wp_get_attachment_image_url($product->get_image_id(), 'full') . "\n";
            echo "Галерея:\n";
            print_r($product->get_gallery_image_ids());

            // Атрибути
            echo "Атрибути:\n";
            print_r($product->get_attributes());

            // Категорії і теги
            echo "Категорії: " . wc_get_product_category_list($product->get_id()) . "\n";
            echo "Теги: " . wc_get_product_tag_list($product->get_id()) . "\n";

            // Відгуки
            echo "Кількість відгуків: " . $product->get_review_count() . "\n";
            echo "Середній рейтинг: " . $product->get_average_rating() . "\n";

            // Опис
            echo "Короткий опис:\n" . $product->get_short_description() . "\n";
            echo "Повний опис:\n" . $product->get_description() . "\n";

            echo '</pre>';
            ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
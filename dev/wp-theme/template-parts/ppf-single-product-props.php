<?php
global $product;
$attributes = $product->get_attributes();
if (!empty($attributes) || $product->get_weight() || $product->has_dimensions()) ?>
<div class="row small_gap">
    <?php
    // Вага (якщо задана)
    if ($product->get_weight()): ?>
        <div class="prop_label">
            <span><?php esc_html_e('Вага', 'woocommerce'); ?></span>
            <p><?php echo esc_html(wc_format_weight($product->get_weight())); ?></p>
        </div>
    <?php endif; ?>

    <?php
    // Розміри (якщо задані)
    if ($product->has_dimensions()): ?>
        <div class="prop_label">
            <span><?php esc_html_e('Розміри', 'woocommerce'); ?></span>
            <p><?php echo wc_format_dimensions($product->get_dimensions(false)); ?></p>
        </div>
    <?php endif; ?>

    <?php
    if (!empty($attributes))
        foreach ($attributes as $attribute): ?>
            <?php
            // Назва атрибуту
            $name = wc_attribute_label($attribute->get_name());

            // Значення (повертається рядком)
            if ($attribute->is_taxonomy()) {
                // Якщо це таксономія (наприклад pa_color, pa_size)
                $terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), ['fields' => 'names']);
                $value = implode(', ', $terms);
            } else {
                // Якщо це кастомний атрибут
                $value = implode(', ', $attribute->get_options());
            }
            ?>
            <div class="prop_label">
                <span><?php echo esc_html($name); ?></span>
                <p><?php echo esc_html($value); ?></p>
            </div>
        <?php endforeach; ?>
</div>
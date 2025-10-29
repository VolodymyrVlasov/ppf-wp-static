<?php
defined('ABSPATH') || exit;

if (!function_exists('ppf_get_product_attribute_rows')) {
    function ppf_get_product_attribute_rows(WC_Product $product): array
    {
        $rows = array();

        if ($product->get_weight()) {
            $rows[] = array(
                'label' => esc_html__('Вага', 'paperfox'),
                'value' => esc_html(wc_format_weight($product->get_weight())),
            );
        }

        if ($product->has_dimensions()) {
            $rows[] = array(
                'label' => esc_html__('Розміри', 'paperfox'),
                'value' => esc_html(wc_format_dimensions($product->get_dimensions(false))),
            );
        }

        foreach ($product->get_attributes() as $attribute) {
            if (!$attribute->get_visible()) {
                continue;
            }

            $name = wc_attribute_label($attribute->get_name());

            if ($attribute->is_taxonomy()) {
                $terms = wc_get_product_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'));
                $value = implode(', ', $terms);
            } else {
                $value = implode(', ', $attribute->get_options());
            }

            if ($value === '') {
                continue;
            }

            $rows[] = array(
                'label' => $name,
                'value' => $value,
            );
        }

        return $rows;
    }
}

if (!function_exists('ppf_render_product_attributes_block')) {
    function ppf_render_product_attributes_block(WC_Product $product): string
    {
        $rows = ppf_get_product_attribute_rows($product);
        if (empty($rows)) {
            return '';
        }

        ob_start();
        ?>
        <div class="row small_gap ppf-attributes-row">
            <?php foreach ($rows as $row) : ?>
                <div class="prop_label">
                    <span><?php echo esc_html($row['label']); ?></span>
                    <p><?php echo esc_html($row['value']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('ppf_render_product_description_block')) {
    function ppf_render_product_description_block(WC_Product $product): string
    {
        $content = get_the_content();
        $content = $content ? apply_filters('the_content', $content) : '';
        $attributes = ppf_render_product_attributes_block($product);

        if ($content === '' && $attributes === '') {
            return '';
        }

        ob_start();
        ?>
        <div class="col small_gap">
            <h4 class="header_4"><?php esc_html_e('Опис товару', 'paperfox'); ?></h4>

            <?php if ($content !== '') : ?>
                <div class="ppf-product-description">
                    <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>

            <?php if ($attributes !== '') : ?>
                <?php echo $attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('ppf_render_product_upsell_section')) {
    function ppf_render_product_upsell_section(WC_Product $product): string
    {
        $upsell_ids = array_filter($product->get_upsell_ids());
        if (empty($upsell_ids)) {
            return '';
        }

        $display_ids = array_slice($upsell_ids, 0, 3);
        $category_link = '';
        $total_count = count($upsell_ids);

        if (!empty($display_ids)) {
            $first = wc_get_product($display_ids[0]);
            if ($first) {
                $terms = get_the_terms($first->get_id(), 'product_cat');
                if (!empty($terms) && !is_wp_error($terms)) {
                    $term_link = get_term_link(array_shift($terms));
                    if (!is_wp_error($term_link)) {
                        $category_link = $term_link;
                    }
                }
            }
        }

        ob_start();
        ?>
        <div class="col small_gap">
            <p class="header_4"><?php esc_html_e('Разом купують', 'paperfox'); ?></p>
            <div class="row small_gap ppf-upsell-row">
                <?php foreach ($display_ids as $id) :
                    $upsell_product = wc_get_product($id);
                    if (!$upsell_product) {
                        continue;
                    }

                    $permalink = get_permalink($upsell_product->get_id());
                    $image = $upsell_product->get_image('woocommerce_thumbnail', array(), false);
                    if (!$image) {
                        $placeholder = wc_placeholder_img_src('woocommerce_thumbnail');
                        $image = sprintf('<img src="%s" alt="%s" />', esc_url($placeholder), esc_attr($upsell_product->get_name()));
                    }
                    ?>
                    <a href="<?php echo esc_url($permalink); ?>" class="related_product_card">
                        <picture class="related_product_img bg_img">
                            <?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </picture>
                        <p class="related_product_title"><?php echo esc_html($upsell_product->get_name()); ?></p>
                    </a>
                <?php endforeach; ?>

                <?php if ($total_count > 3 && $category_link) : ?>
                    <div class="ppf-upsell-plus-card">
                        <a class="ppf-upsell-plus-btn" href="<?php echo esc_url($category_link); ?>"
                            aria-label="<?php esc_attr_e('Більше товарів з цієї категорії', 'paperfox'); ?>">+</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

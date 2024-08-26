<article class="product_card">
    <div class="product_card_image_container">
        <img src="<?php echo esc_url($image_url); ?>"
            alt="<?php echo esc_attr($product_category->name); ?>" class="bg_img product_card_image"
            width="200" height="200" loading="lazy" decoding="async" />
    </div>
    <div class="product_card_description">
        <h3 class="plain_text text_bold"><?php echo esc_html($product_category->name); ?></h3>
        <p class="plain_text_small text_truncated">
            <?php echo wp_strip_all_tags($product_category->description); ?>
        </p>
        <a title="Перейти на сторінку категории <?php echo esc_attr($product_category->name); ?>"
            href="<?php echo esc_url($category_link); ?>" class="sub_link">
            <span>ДОКЛАДНІШЕ</span>
        </a>
    </div>
</article>
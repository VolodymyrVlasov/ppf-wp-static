<article class="product_card">
    <div class="product_card_image_container">
        <?php $image_url = wp_get_attachment_image_src($product->get_image_id(), 'full')[0]; ?>
        <img src="<?php echo esc_url($image_url); ?>"
            alt="<?php the_title(); ?>" class="product_card_image bg_img" width="360" height="200"
            loading="lazy" decoding="async">
    </div>
    <div class="product_card_description">
        <h3 class="plain_text text_bold">
            <?php
            $title = get_the_title();
            $title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');
            $position = strpos($title, ' – ');
            if ($position !== false) {
                $title_with_break = substr_replace($title, '<br>', $position, strlen(' – '));
                echo $title_with_break;
            } else {
                echo $title;
            }
            ?>
        </h3>
        <p class="plain_text_small text_truncated"><?php echo wp_strip_all_tags($product->get_description()); ?></p>
        <a title="Перейти на сторінку товара <?php the_title(); ?>" href="<?php the_permalink(); ?>"
            class="sub_link">
            <span>ЗАМОВИТИ</span>
        </a>
    </div>
</article>
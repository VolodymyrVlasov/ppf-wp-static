<?php
/**
 * Template Name: Front Page with Products
 */
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{domain}}/static/icons/favicon.png" type="image/x-icon">

    <title>front-page.php | PaperFox</title>
    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>
        <section class="section" id="head-section">
            <div class="container">
                <span class="template">FRONT-PAGE.PHP</span>
            </div>
        </section>


        <section class="section" id="head-section">
            <div class="container">
                <?php
                
                $args = array(
                    'post_type' => 'services',
                    'post_status' => 'publish',
                    'posts_per_page' => 8, 
                    'orderby' => 'title', 
                    'order' => 'ASC', 
                    // Кількість постів, які треба вивести
                );
                $posts = get_posts($args);

                // Виведення списку постів
                foreach ($posts as $post) {
                    setup_postdata($post);
                    echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
                    echo '<div>' . get_the_excerpt() . '</div>';
                }

                ?>

            </div>
        </section>

        <section class="section">
            <div class="container col big_gap">
                <h2>CATEGORIES</h2>

                <ul class="row big_gap width_100">
                    <?php
                    $args = array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                    );

                    $product_categories = get_terms($args);

                    if (!empty($product_categories)):
                        foreach ($product_categories as $product_category):
                            if ($product_category->name !== 'Без категорії' && !empty($product_category->description)) {
                                $thumbnail_id = get_term_meta($product_category->term_id, 'thumbnail_id', true);
                                $image_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
                                $category_link = get_term_link($product_category->term_id);
                                ?>
                                <li class="cards_3">
                                    <article class="product_card">
                                        <img src="<?php echo esc_url($image_url); ?>"
                                            alt="<?php echo esc_attr($product_category->name); ?>" class="bg_img width_100"
                                            width="200" height="200" loading="lazy" decoding="async" />
                                        <h3 class="text_16__bold width_100">
                                            <?php echo esc_html($product_category->name); ?>
                                        </h3>
                                        <p class="text_14 width_100">
                                            <?php echo wp_strip_all_tags($product_category->description); ?>
                                        </p>
                                        <a title="Перейти на сторінку категории <?php echo esc_attr($product_category->name); ?>"
                                            href="<?php echo esc_url($category_link); ?>" class="sub_link">
                                            <span>ПЕРЕЙТИ</span>
                                        </a>
                                    </article>
                                </li>
                                <?php
                            }
                        endforeach;
                    else:
                        echo '<p>Категории товаров не найдены</p>';
                    endif;

                    ?>
                </ul>
            </div>
        </section>


        <section class="section">
            <div class="container col big_gap">
                <h2>PRODUCTS</h2>
                <ul class="row big_gap width_100">
                    <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => -1
                    );

                    $products = new WP_Query($args);

                    if ($products->have_posts()):
                        while ($products->have_posts()):
                            $products->the_post();
                            global $product;

                            if (empty($product) || !$product->is_visible()) {
                                continue;
                            }
                            ?>
                            <li class="cards_3">
                                <article class="product_card">
                                    <?php $image_url = wp_get_attachment_image_src($product->get_image_id(), 'full')[0]; ?>
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>"
                                        class="product_card_image bg_img width_100" width="380" height="180" loading="lazy"
                                        decoding="async" style="object-fit: cover;" />
                                    <h3 class="text_16__bold width_100">
                                        <?php echo get_the_title(); ?>
                                    </h3>
                                    <p class="text_14 width_100">
                                        <?php echo wp_strip_all_tags($product->get_short_description()); ?>
                                    </p>
                                    <a title="Перейти на сторінку товара <?php the_title(); ?>" href="<?php the_permalink(); ?>"
                                        class="sub_link">
                                        <span>ЗАМОВИТИ</span>
                                    </a>
                                </article>
                            </li>
                            <?php
                        endwhile;
                    else:
                        echo '<p>Товары не найдены</p>';
                    endif;

                    wp_reset_postdata();
                    ?>
                </ul>

            </div>
        </section>

        <?php get_template_part('map', 'widget'); ?>
    </main>
    <?php get_footer(); ?>
    <?php wp_footer(); ?>
</body>

</html>
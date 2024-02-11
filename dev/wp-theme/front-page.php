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
    <section class="section">
            <video autoplay muted loop id="background-video">
                <source src="{{domain}}/static/video/paperfox_office_review_demo.mp4"
                    type="video/mp4">
            </video>
            <div class="main_page_h1">
                <div class="container col_center big_gap">
                    <h1 class="text_60 h1_paperfox">Твій надійний партнер<br>у сфері поліграфії - <svg width="360"
                            height="75">
                            <g id="paperfox" class="logo_svg_text">
                                <text x="0" y="75" id="letter1">P</text><text x="40" y="75" id="letter2">A</text><text
                                    x="90" y="75" id="letter3">P</text><text x="135" y="75" id="letter4">E</text><text
                                    x="177" y="75" id="letter5">R</text><text x="225" y="75" id="letter6">F</text><text
                                    x="265" y="75" id="letter7">O</text><text x="315" y="75" id="letter8">X</text>
                            </g>
                        </svg></h1>
                    <div class="row width_100 gap">
                        <div class="col small_gap flex_1 clock_icon_before">
                            <span class="text_24__bold">Друк в строк</span>
                            <span class="text_16">Стандартний термін<br>виготовлення замовлення</span>
                        </div>
                        <div class="col small_gap flex_1 magic_icon_before">
                            <span class="text_24__bold">Результат</span>
                            <span class="text_16">Зробимо все можливе<br>для вашого замовлення</span>
                        </div>
                        <div class="col small_gap flex_1 rocket_icon_before">
                            <span class="text_24__bold">Доставка</span>
                            <span class="text_16">Відправимо по Києву та Україні<br>Нова Пошта та Uklon Доставка</span>
                        </div>
                    </div>
                    <div class="row_center big_gap width_100 main_nav_announcement_cnt">
                        <a href="#paperfox_services" class="main_nav_arrow" title="Наші послуги"
                            aria-label="навігація до послуг компанії"></a>
                        <div class="main_announcement">
                            <div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore aperiam id, atque
                                    quod provident optio quia ipsum, deleniti consectetur sint corrupti perspiciatis
                                    neque labore temporibus nihil! Nihil vitae vero, iusto nisi illum optio ullam!
                                    Mollitia consequuntur fugiat nulla sunt doloribus nemo? Autem quae non dicta
                                    laborum! Reprehenderit eos laboriosam nemo commodi. In ut minus quasi magni esse
                                    voluptatum, eius explicabo! Hic ipsa deleniti, possimus magni perspiciatis tenetur
                                    cum voluptatum dolorum blanditiis soluta ut optio porro tempora enim tempore esse
                                    voluptate eum, nesciunt sit a iure eius quos quia at. Delectus eaque, officiis
                                    reprehenderit modi iste dicta voluptas ex sapiente commodi aliquid maxime dolorem,
                                    optio consequatur vitae velit! Laborum amet itaque doloribus soluta debitis eos
                                    vitae et maxime enim magnam accusamus quia ab impedit ut consequatur culpa assumenda
                                    autem recusandae ipsa repellat saepe, quidem accusantium? Incidunt accusantium modi
                                    esse maiores quos iure minus tenetur odit sint, cumque officia quod itaque numquam
                                    quia error! Harum assumenda consequatur culpa adipisci quis error aperiam temporibus
                                    explicabo distinctio ipsam est, repudiandae modi quae nobis sequi tenetur ratione
                                    quia rem. Vel numquam quisquam reprehenderit ex exercitationem incidunt ut
                                    reiciendis ratione perferendis unde facilis ipsum a, possimus animi praesentium
                                    ullam distinctio voluptas sed dolorem officiis blanditiis cupiditate.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
                <h2>Наші послуги</h2>

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
                                            <span>ДОКЛАДНІШЕ</span>
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
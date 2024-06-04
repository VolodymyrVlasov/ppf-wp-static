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
        <?php wc_get_template('template-parts/ppf-front-page-video-section.php'); ?>

        <section class="section" id="paperfox_services">
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

        <section class="section" id="seo-section">
            <div class="container col gap">
                <h2 class="text_32">Цифровий та широкоформатний друк у київській поліграфії PaperFox на Подолі</h2>
                <div class="col small_gap">
                    <p>Термінний, якісний і доступний друк усіх видів у Києві – це поліграфія PaperFox, уся команда якої
                        працює для того, щоб ваші замовлення були виконані вчасно, на високому рівні та за прийнятною
                        ціною. Наша технічна база дозволяє здійснювати повнокольоровий цифровий і широкоформатний друк
                        від А6 до А0 формату фотографічної якості, а також інші види друку та поліграфічні послуги в
                        найкоротші терміни, тиражами будь-яких розмірів.</p>

                    <div class="col">
                        <p class="text_16__bold">У поліграфії PaperFox вам завжди запропонують замовити тільки якісні та
                            оперативні продукти всі 5 робочих днів на тиждень:</p>
                        <ul class="list">
                            <li>друк наклейок та наліпок із порізкою круглої форми або будь-якої довільної що актульано
                                для стікерпаків А6, А5, А4 та А3 формату на крейдованому самоклеючому папері, прозорому,
                                матовому та глянцевому вінілі;</li>
                            <li>друк на полотні фотографій, створення колажів із подальшою галерейною натяжкою на
                                підрамник у 100% бавовняному 360 г/м або синтетичному нетканому полотні 260 г/мі і
                                покриттям акриловим захисним лаком;</li>
                            <li>широкоформатний друк плакатів на матовому фотопапері високої якості, креслень на
                                ватмані, фотографій. Формат друку А2, B2, А1, B1 та А0;</li>
                            <li>цифровий друк листівок, візиток, бланків, плакатів, документів, будь-якої рекламної та
                                сувенірної поліграфії з постдрукарською обробкою;</li>
                            <li>офсетний та терміновий цифровий друк єврофлерів 21х10 см та листівок від А6 до А3
                                форматів;</li>
                            <li>друк на футболках методом DTF, флекс плівками та прямий цифровий друк;</li>
                            <li>друк на чашках фотографій і будь-яких зображень, картинок, вітальних або пам’ятних
                                написів, берндування сублімаційним методом на чашках об’ємом 200 мл, 310 мл або 425 мл;
                            </li>
                            <li>офсетний та цифровий друк буклетів, каталогів, брошур;</li>
                            <li>широкоформатний та цифровий друк календарів форматів: А5, А4, А3, А2, А1, А0 формату;
                            </li>
                        </ul>
                    </div>
                    <p>
                        Цифровий друк невеликих тиражів і широкоформатний друк постерів здійсниться просто в день
                        замовлення, і ми візьмемося за виготовлення навіть єдиного екземпляра – це наше правило
                        непорушне із дня заснування у 2015 році. Зручне розташування в центрі Києва на Подолі дасть вам
                        змогу не витрачати багато часу на проїзд, до того ж ми можемо доставити готове замовлення
                        кур’єром Нової Пошти за вказаною адресою по всій Україні або таксі по Києву. Ми цінуємо ваш час,
                        кошти та гарний настрій, тому працюємо з натхненням і сумлінно!</p>
                    <p>Ми прагнемо встановити новий стандарт для друку, з чудовими новими продуктами онлайн, які
                        приносять дизайн і високі стандарти Інтернету. Хоча багато інших поліграфій вирішили
                        використовувати нові технології, щоб просто знизити витрати на друк (і нерідко якість), ми
                        прагнемо зробити друк не тільки рентабельним і зручнішим, але й кращим, ніж будь-коли раніше.
                    </p>
                </div>
            </div>
        </section>
    </main>
    <?php get_footer(); ?>
    <?php wp_footer(); ?>
</body>

</html>
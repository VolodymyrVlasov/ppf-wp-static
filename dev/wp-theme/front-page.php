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
    <title>Цифровий та Широкоформатний друк. Поліграфія в Києві | PaperFox</title>
    <meta name="description"
        content="Поліграфія в Києві - PAPERFOX. Друк А0, А1, А2 та цифровий друк А3 та А4 формата. Якісний друк на полотні, футболках, фото на чашках. Самовивіз в Києві на Подолі та доставка Новою Поштою по Україні">
    <meta name="keywords"
        content="Печать а0 киев, друк А0 київ, печать а1 киев,  друк А1 київ, печать а2 киев,  друк А2 київ, печать а4 киев, друк А4 київ, печать а3 киев, друк А3 київ, печать на чашках киев, друк на чашках київ,  печать на холсте, друк на холсті (полотні), фото на холсте, фото на холсті (полотні), фотохолст, цветная печать, кольоровий друк, фото на чашках киев, печать наклеек, друк наклейок (наліпок), печать стикеров, друк стікерів,  круглые наклейки, круглі наліпки, фигурные наклейки, фігрні наліпки">

    <meta property="og:title" content="PaperFox - Цифровий та Широкоформатний Друк в Києві">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://paperfox.com.ua">
    <meta property="og:image" content="https://paperfox.com.ua/wp-content/uploads/images/og-paperfox-main.jpg">
    <meta property="og:image" content="https://paperfox.com.ua/wp-content/uploads/images/og-paperfox-main.jpg">
    <meta property="og:description"
        content="Послуги цифрового друку Paperfox допоможуть вам замовити найкращі індивідуальні продукти:  маркетингові матеріали, листівки, наліпки, рекламну продукцію, холсти, чашки, футболки">
    <meta property="og:site_name" content="PaperFox">
    <meta property="og:locale" content="uk_UA">

    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>
        <?php wc_get_template('template-parts/ppf-front-page-video-section.php'); ?>

        <section class="section" id="paperfox_services">
            <div class="container col_center big_gap width_100">
                <p class="text_32__bold">Наші послуги</p>
                <div class="row big_gap products_cards">
                    <a class="product_card cards_3" href="{{domain}}/print-sticker/stickerpack/"
                        title="Натисніть щоб перейти до сторінки Друк стікерпаків">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-stickerpack-print.png" alt="Друк стікерпаків"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк стікерпаків</h3>
                        <p class="text_14 width_100">Стікерпаки - швидко, зручно та індивідуально.
                            Ідеальний спосіб створити унікальні наліпки для особистого використання, стартапу або малого
                            бізнесу.
                        </p>
                        <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/print-sticker/"
                        title="Натисніть щоб перейти до сторінки Друк наклейок">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-sticker-print.png" alt="Друк наклейок"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк наклейок</h3>
                        <p class="text_14 width_100">Друк наклейок та стікерів різних форматів, будь яких конфігурацій.
                            Яскравий дизайн, оригінальна подача, висока якість і швидкий друк та порізка наклейок в
                            центрі Києва
                        </p>
                        <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/digital-print"
                        title="Натисніть щоб перейти до сторінки Цифровий друк">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-digital-print.png" alt="Цифровий друк"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Цифровий друк</h3>
                        <p class="text_14 width_100">Формат: А5, А4 и А3. Кольоровий цифровий друк на сучасних лазерних
                            аппаратах
                            у
                            стислий термін будь якими тиражами. Цифровий друк візиток, плакатів, листівок, дипломів тощо
                        </p>
                        <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/large-print/"
                        title="Натисніть щоб перейти до сторінки Широкоформатний друк">
                        <img src="{{stylesheet_url}}/static/main-page/main-large-format-print.png" alt="Широкоформатний друк"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Широкоформатний друк</h3>
                        <p class="text_14 width_100">Формат: А0, А1 и А2. Кольоровий і чорно-білий широкоформатний друк
                            плакатів, афіш, постерів, фотографій, креслень, схем, технічної та ділової документації.
                        </p>
                        <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/mug-print/"
                        title="Натисніть щоб перейти до сторінки Друк на чашках">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-mug-print.png" alt="Друк на чашках"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк на чашках</h3>
                        <p class="text_14 width_100">Оригінальний друк на чашках фотографій, логотипів, малюнків,
                            надписів, привітань. Друк на чашках різних розмірів, чашках – хамелеонах, кавових чашках.
                        </p>
                        <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/print-poster/"
                        title="Натисніть щоб перейти до сторінки Друк плакатів">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-poster-print.png" alt="Друк візиток"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк плакатів</h3>
                        <p class="text_14 width_100">Якісний оперативний друк візиток від Економ до Еліт класу на різних
                            видах картону; ламінація, скруглення кутів, висікання отворів – все для унікальних візиток.
                        </p>
                        <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/print-vizitki/"
                        title="Натисніть щоб перейти до сторінки Друк візиток">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-biz-cards-print.png" alt="Друк візиток"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк візиток</h3>
                        <p class="text_14 width_100">Якісний оперативний друк візиток від Економ до Еліт класу на різних
                            видах картону; ламінація, скруглення кутів, висікання отворів – все для унікальних візиток.
                        </p>
                         <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/print-flyer/"
                        title="Натисніть щоб перейти до сторінки Друк флаєрів">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-flyer-print.png" alt="Друк флаєрів"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк флаєрів</h3>
                        <p class="text_14 width_100">Повнокольоровий друк флаєрів і листівок різноманітних форматів від
                            100 шт. Доступний терміновий друк флаєрів за 15 хвилин. Офсетний друк листівок великих
                            тиражів.
                        </p>
                         <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/booklet-print/"
                        title="Натисніть щоб перейти до сторінки Друк буклетів">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-brochure-print.png" alt="Друк буклетів"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк буклетів</h3>
                        <p class="text_14 width_100">Двостороння цифровий та офсетний друк буклетів, каталогів, брошур
                            на крейдованому матовому і глянцевому папері; ламінація, біговка, фальцювання, брошурування.
                        </p>
                         <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/print-canvas/"
                        title="Натисніть щоб перейти до сторінки Друк на холсті">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-canvas-print.png" alt="Друк на холсті"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк на холсті</h3>
                        <p class="text_14 width_100">Якісний друк на полотні фотографій та артів з високою роздільною
                            здатністю та галерейная натяжка на дерев’яний підрамник. Перед друком опрацьовуємо
                            фотографії
                        </p>
                         <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/print-t-shirt/"
                        title="Натисніть щоб перейти до сторінки Друк на Футболках">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-t-shirt-print.png" alt="Друк на Футболках"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк на Футболках</h3>
                        <p class="text_14 width_100">Цифровий друк на футболках зображень, фотографій, логотипів,
                            надписів, номерів: стійкий друк на футболках полімерними плівками (флекс), термо друк.
                        </p>
                         <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
                    <a class="product_card cards_3" href="{{domain}}/print-calendar/"
                        title="Натисніть щоб перейти до сторінки Друк календарів">
                        <img src="{{stylesheet_url}}/static/main-page/main-page-calendar-print.png" alt="Друк календарів"
                            class="product_card_image bg_img" width="200" height="200" loading="lazy" decoding="async" />
                        <h3 class="header_4 width_100 ">Друк календарів</h3>
                        <p class="text_14 width_100">Друк календарів будь-яких видів, розмірів та типів: перекидні
                            настінні та будиночки, планінги, квартальні календарі. 
                            <br>Тираж від 1 штуки
                        </p>
                         <button class="sub_link" aria-label="Друк на чашках">
                            <span>ДОКЛАДНІШЕ</span>
                        </button>
                    </a>
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
<?php
/**
 * Template Name: Checkout Page
 */

?>

<?php defined('ABSPATH') || exit; ?>



<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="{{stylesheet_url}}/static/icons/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{stylesheet_url}}/style.css">
    <title>Оформлення замовлення | PaperFox</title>
    <?php wp_head(); ?>
</head>

<?php
$checkout = WC()->checkout(); // Определение переменной $checkout
$cart = WC()->cart;
do_action('woocommerce_before_checkout_form', $checkout);
?>
<?php get_header(); ?>
<main>
    <section class="section" id="cart-section">
        <div class="container col big_gap">
            <h1 class="text_32__bold">Оформлення замовлення</h1>
            <form class="row big_gap" name="checkout" method="post" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data" novalidate="novalidate">

                <?php if ($checkout->get_checkout_fields()): ?>
                    <article class="col big_gap flex_4" id="customer_details">
                        <?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>
                        <p class="text_24">Ваші контактні дані</p>
                        <div class="col gap width_100 ">
                            <div class="row big_gap width_100">
                                <div class="checkout_input_text" id="billing_first_name_field">
                                    <label for="billing_first_name">Імʼя</label>
                                    <input type="text" name="billing_first_name" id="billing_first_name" required="true"
                                        placeholder="Тарас" autocomplete="given-name">
                                </div>
                                <div class="checkout_input_text" id="billing_last_name_field">
                                    <label for="billing_last_name">Прізвище</label>
                                    <input type="text" name="billing_last_name" id="billing_last_name" required="true"
                                        placeholder="Шевченко" autocomplete="family-name">
                                </div>
                            </div>
                            <div class="row big_gap width_100">
                                <div class="checkout_input_text" id="billing_phone_field">
                                    <label for="billing_phone">Мобільний телефон</label>
                                    <input type="tel" name="billing_phone" id="billing_phone" required="true"
                                        placeholder=" +38 077 777 7777" autocomplete="tel">
                                </div>
                                <div class="checkout_input_text" id="billing_email_field">
                                    <label for="billing_email">Електронна пошта</label>
                                    <input type="email" name="billing_email" id="billing_email" required="true"
                                        placeholder="superman@shevchenko.ua" autocomplete="email username">
                                </div>
                            </div>
                        </div>

                        <span class="text_24">Доставка</span>
                        <div id="shipping_country_field" data-priority="40" style="margin-top: -40px;">
                            <input type="hidden" name="shipping_country" id="shipping_country" value="UA" autocomplete="country" readonly="readonly" style="display: none">
                            <input type="hidden" name="billing_country" id="billing_country" value="UA" autocomplete="country" readonly="readonly" style="display: none">
                        </div>
                        <ul class="col gap width_100" id="shipping_method">
                            <li class="col small_gap width_100">
                                <div class="select col flex_1 width_100" id="billing_nova_poshta_region_field">
                                    <label for="billing_nova_poshta_region">Регіон</label>
                                    <select id="billing_nova_poshta_region" name="billing_nova_poshta_region">
                                        <option selected>Оберіть область</option>
                                        <option value="71508128-9b87-11de-822f-000c2965ae0e">АРК</option>
                                        <option value="71508129-9b87-11de-822f-000c2965ae0e">Вінницька</option>
                                        <option value="7150812a-9b87-11de-822f-000c2965ae0e">Волинська</option>
                                        <option value="7150812b-9b87-11de-822f-000c2965ae0e">Дніпропетровська</option>
                                        <option value="7150812c-9b87-11de-822f-000c2965ae0e">Донецька</option>
                                        <option value="7150812d-9b87-11de-822f-000c2965ae0e">Житомирська</option>
                                        <option value="7150812e-9b87-11de-822f-000c2965ae0e">Закарпатська</option>
                                        <option value="7150812f-9b87-11de-822f-000c2965ae0e">Запорізька</option>
                                        <option value="71508130-9b87-11de-822f-000c2965ae0e">Івано-Франківська</option>
                                        <option value="71508131-9b87-11de-822f-000c2965ae0e">Київська</option>
                                        <option value="71508132-9b87-11de-822f-000c2965ae0e">Кіровоградська</option>
                                        <option value="71508133-9b87-11de-822f-000c2965ae0e">Луганська</option>
                                        <option value="71508134-9b87-11de-822f-000c2965ae0e">Львівська</option>
                                        <option value="71508135-9b87-11de-822f-000c2965ae0e">Миколаївська</option>
                                        <option value="71508136-9b87-11de-822f-000c2965ae0e">Одеська</option>
                                        <option value="71508137-9b87-11de-822f-000c2965ae0e">Полтавська</option>
                                        <option value="71508138-9b87-11de-822f-000c2965ae0e">Рівненська</option>
                                        <option value="71508139-9b87-11de-822f-000c2965ae0e">Сумська</option>
                                        <option value="7150813a-9b87-11de-822f-000c2965ae0e">Тернопільська</option>
                                        <option value="7150813b-9b87-11de-822f-000c2965ae0e">Харківська</option>
                                        <option value="7150813c-9b87-11de-822f-000c2965ae0e">Херсонська</option>
                                        <option value="7150813d-9b87-11de-822f-000c2965ae0e">Хмельницька</option>
                                        <option value="7150813e-9b87-11de-822f-000c2965ae0e">Черкаська</option>
                                        <option value="7150813f-9b87-11de-822f-000c2965ae0e">Чернівецька</option>
                                        <option value="71508140-9b87-11de-822f-000c2965ae0e">Чернігівська</option>
                                    </select>
                                </div>
                            </li>
                            <li class="col small_gap width_100">
                                <div class="select col flex_1 width_100" id="billing_nova_poshta_city_field">
                                    <label for="billing_nova_poshta_city">Ваше місто</label>
                                    <select id="billing_nova_poshta_city" name="billing_nova_poshta_city"></select>
                                </div>
                            </li>

                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method" id="nova_poshta_shipping_method" class="nova_poshta_shipping_method" value="nova_poshta_shipping_method" checked>
                                    <label for="nova_poshta_shipping_method">Самовивіз з Нової Пошти</label>
                                </div>

                                <div class="checkout_input_radio_legend">
                                    <div class="select col flex_1 width_100" id="billing_nova_poshta_warehouse_field">
                                        <label for="billing_nova_poshta_warehouse">Відділення Нової Пошти</label>
                                        <select id="billing_nova_poshta_warehouse" name="billing_nova_poshta_warehouse"></select>
                                    </div>
                                </div>
                            </li>
                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method" id="checkout-delivery-np-postbox" value="nova_poshta_shipping_method">
                                    <label for="checkout-delivery-np-postbox">Поштомат Нової Пошти</label>
                                </div>
                                <div class="checkout_input_radio_legend">
                                    <div class="checkout_input_text width_100">
                                        <label for="checkout-delivery-postoffice">Номер поштомата</label>
                                        <input type="text" name="checkout-delivery-postoffice"
                                            id="checkout-delivery-postoffice" value="nova_poshta_shipping_method_poshtomat"
                                            placeholder="№6753, Таунхауз, вул. Центральна, 49а">
                                    </div>
                                </div>

                            </li>
                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method[0]" id="checkout-delivery-np-address" value="npttn_address_shipping_method">
                                    <label for="checkout-delivery-np-address">Адресна доставка Нової Пошти</label>
                                </div>
                                <div class="checkout_input_radio_legend">
                                    <div class="row gap">
                                        <div class="checkout_input_text flex_3">
                                            <label for="checkout-delivery-postoffice">Вулиця</label>
                                            <input type="text" name="checkout-delivery-postoffice"
                                                id="checkout-delivery-postoffice" placeholder="вул. Центральна">
                                        </div>
                                        <div class="checkout_input_text flex_1">
                                            <label for="checkout-delivery-postoffice">Будинок</label>
                                            <input type="text" name="checkout-delivery-postoffice"
                                                id="checkout-delivery-postoffice" placeholder="49а">
                                        </div>
                                        <div class="checkout_input_text flex_1">
                                            <label for="checkout-delivery-postoffice">Квартира чи офіс</label>
                                            <input type="text" name="checkout-delivery-postoffice"
                                                id="checkout-delivery-postoffice" placeholder="1">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method[0]" id="shipping_method_0_local_pickup8">
                                    <label for="shipping_method_0_local_pickup8">Самовивіз з нашого офісу</label>
                                </div>
                                <span class="checkout_input_radio_legend">м. Київ, вул. Ярославська 14/20. Окремий вхід
                                    з
                                    фасаду, цокольний поверх.<br>Видача замовлень: понеділок - пʼятниця, 11:00 -
                                    19:00</span>
                            </li>


                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method[0]" id="checkout-delivery-uklon">
                                    <label for="checkout-delivery-uklon">Uklon доставка</label>
                                </div>
                                <div class="checkout_input_radio_legend">
                                    <div class="row gap">
                                        <div class="checkout_input_text flex_4">
                                            <label for="checkout-delivery-postoffice">Вулиця</label>
                                            <input type="text" name="checkout-delivery-postoffice"
                                                id="checkout-delivery-postoffice" placeholder="вул. Центральна">
                                        </div>
                                        <div class="checkout_input_text flex_1">
                                            <label for="checkout-delivery-postoffice">Будинок</label>
                                            <input type="text" name="checkout-delivery-postoffice"
                                                id="checkout-delivery-postoffice" placeholder="49а">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_recepient">
                                    <input type="checkbox" class="checkout_checkbox" id="checkout-recepient">
                                    <label for="checkout-recepient" class="checkout_checkbox_label">Інший
                                        отримувач</label>
                                </div>
                                <div class="checkout_input_radio_legend">
                                    <div class="row small_gap width_100">
                                        <div class="checkout_input_text">
                                            <label for="checkout-name">Імʼя</label>
                                            <input type="text" name="name" id="checkout-name" required="true"
                                                placeholder="Ліна">
                                        </div>
                                        <div class="checkout_input_text">
                                            <label for="checkout-lastname">Прізвище</label>
                                            <input type="text" name="lastname" id="checkout-lastname" required="true"
                                                placeholder="Костенко">
                                        </div>
                                        <div class="checkout_input_text">
                                            <label for="checkout-tel">Мобільний телефон</label>
                                            <input type="tel" name="phone" id="checkout-tel" required="true"
                                                placeholder=" +38 099 999 9999">
                                        </div>
                                    </div>

                            </li>
                        </ul>
                        <?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>
                    </article>
                    <article class="cart_summary_card flex_2">
                        <span class="text_32">Разом</span>
                        <div class="row_sp_btw">
                            <span class="text_12">
                                <?php echo WC()->cart->get_cart_contents_count(); ?> товарів на суму
                            </span>
                            <span class="text_12">
                                <?php echo WC()->cart->get_cart_subtotal(); ?>
                            </span>
                        </div>
                        <div class="cart_summary_card_price">
                            <span class="text_12">До сплати</span>
                            <span class="text_24">
                                <?php echo WC()->cart->get_cart_total(); ?>
                            </span>
                        </div>
                        <div class="col small_gap">
                            <button type="submit" class="button__primary width_100" name="woocommerce_checkout_place_order" id="place_order" value="Оформити замовлення">ОФОРМИТИ ЗАМОВЛЕННЯ</button>
                        </div>
                        <div class="row">
                            <input type="checkbox" checked class="checkout_checkbox" required
                                id="user-policy-confirmation">
                            <label for="user-policy-confirmation" class="checkout_checkbox_label">Перейшовши до
                                оформнення Ви підтверджуєте що перевірили зміст та склад створенного дизайну або
                                обраного готового виробу. Готовий виріб або створений дизайн матиме вигляд що було
                                створено у редакторі або показано на фото з можливими відхилення згідно до технічних
                                можливостей</label>
                        </div>
                    </article>
                <?php endif; ?>
            </form>
        </div>
    </section>



    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
    <?php
    get_footer();
    wp_footer();
    ?>


    <!-- @@include('../../pages/checkout/index.html') -->
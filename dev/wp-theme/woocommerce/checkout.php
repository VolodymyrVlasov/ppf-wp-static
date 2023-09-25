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
                    <article class="col big_gap flex_4 woocommerce-billing-fields" id="customer_details">
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
                                        placeholder="superman@shevchenko.ua" autocomplete="email">
                                </div>
                            </div>
                        </div>

                        <span class="text_24">Доставка</span>

                        <div id="shipping_country_field" data-priority="40" style="margin-top: -40px;">
                            <input type="hidden" name="shipping_country" id="shipping_country" value="UA" autocomplete="country" readonly="readonly" style="display: none">
                            <input type="hidden" name="billing_country" id="billing_country" value="UA" autocomplete="country" readonly="readonly" style="display: none">
                        </div>
                        <ul class="col gap width_100 woocommerce-shipping-methods woocommerce-billing-fields__field-wrapper" id="shipping_method">
                            <li class="col small_gap width_100">
                                <div class="select col flex_1 width_100" id="billing_nova_poshta_region_field">
                                    <label for="billing_nova_poshta_region">Регіон</label>
                                    <select id="billing_nova_poshta_region" name="billing_nova_poshta_region" autocomplete="on location region">
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
                                    <select id="billing_nova_poshta_city" name="billing_nova_poshta_city" autocomplete="home city">
                                        <option selected>Оберіть місто</option>
                                    </select>
                                </div>
                            </li>




                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method" id="shipping_method_nova_poshta_shipping_method" value="nova_poshta_shipping_method" class="shipping_method" checked>
                                    <label for="shipping_method_nova_poshta_shipping_method">Самовивіз з Нової Пошти</label>
                                </div>


                                <div class="checkout_input_radio_legend" id="np_warehouse">
                                    <div class="select col flex_1 width_100" id="billing_nova_poshta_warehouse_field">
                                        <label for="billing_nova_poshta_warehouse">Відділення Нової Пошти</label>
                                        <select id="billing_nova_poshta_warehouse" name="billing_nova_poshta_warehouse">
                                            <option selected>Оберіть відділення</option>
                                        </select>

                                        <!-- <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                                            <span class="selection">
                                                <span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                                    aria-labelledby="select2-billing_nova_poshta_warehouse-container" role="combobox"
                                                    style="border: none; background-color:transparent; padding-left: 16px; width: 100% !important; margin-top: -32px;">
                                                    <span class="select2-selection__rendered" id="select2-billing_nova_poshta_warehouse-container" role="textbox" aria-readonly="true" style="color: black;">
                                                    </span>
                                                </span>
                                            </span>
                                            <span class="dropdown-wrapper" aria-hidden="true"></span>
                                        </span> -->
                                    </div>
                                </div>
                            </li>
                            


                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method" id="shipping_method_nova_poshta_shipping_method_poshtomat" class="shipping_method" value="nova_poshta_shipping_method_poshtomat">
                                    <label for="shipping_method_nova_poshta_shipping_method_poshtomat">Поштомат Нової Пошти</label>

                                </div>


                                <div class="checkout_input_radio_legend" id="np_poshtomat">
                                    <div class="select col width_100" id="billing_nova_poshta_warehouse_field">
                                        <label for="billing_nova_poshta_warehouse">Поштомат</label>
                                        <select id="billing_nova_poshta_warehouse" name="billing_nova_poshta_warehouse" autocomplete="on">
                                            <option selected>Оберіть поштомат</option>
                                        </select>
                                        <!-- <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                                            <span class="selection">
                                                <span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                                    aria-labelledby="select2-billing_nova_poshta_warehouse-container" role="combobox"
                                                    style="border: none; background-color:transparent; padding-left: 16px; width: 100% !important; margin-top: -32px;">
                                                    <span class="select2-selection__rendered" id="select2-billing_nova_poshta_warehouse-container" role="textbox" aria-readonly="true" style="color: black;">
                                                    </span>
                                                </span>
                                            </span>
                                            <span class="dropdown-wrapper" aria-hidden="true"></span>
                                        </span> -->
                                    </div>
                                </div>

                            </li>






                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method" id="npttn_address_shipping_method" value="npttn_address_shipping_method" class="shipping_method">
                                    <label for="npttn_address_shipping_method">Адресна доставка Нової Пошти</label>
                                </div>
                                <div class="checkout_input_radio_legend">
                                    <div class="row gap" id="billing_mrkvnp_street_field">
                                        <div class="select col  flex_3">
                                            <label for="billing_mrkvnp_street">Вулиця</label>
                                            <!-- <input type="text" name="billing_mrkvnp_street"
                                                id="billing_mrkvnp_street" placeholder="Введіть перші три літери.." autocomplete="shipping"> -->

                                            <select id="billing_mrkvnp_street" name="billing_mrkvnp_street" autocomplete="on">

                                            </select>

                                        </div>
                                        <div class="checkout_input_text flex_1">
                                            <label for="billing_mrkvnp_house">Будинок</label>
                                            <input type="text" name="billing_mrkvnp_house"
                                                id="billing_mrkvnp_house" placeholder="">
                                        </div>
                                        <div class="checkout_input_text flex_1">
                                            <label for="billing_mrkvnp_flat_field">Квартира чи офіс</label>
                                            <input type="text" name="billing_mrkvnp_flat_field"
                                                id="billing_mrkvnp_flat_field" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method" id="local_pickup" class="shipping_method">
                                    <label for="local_pickup">Самовивіз з нашого офісу</label>
                                </div>
                                <span class="checkout_input_radio_legend">м. Київ, вул. Ярославська 14/20. Окремий вхід
                                    з
                                    фасаду, цокольний поверх.<br>Видача замовлень: {{weekdays}}</span>
                            </li>

                            <li class="checkout_input_radio_wrapper">
                                <div class="checkout_input_radio">
                                    <input type="radio" name="shipping_method" id="checkout-delivery-uklon" class="shipping_method">
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



                        <?php
                        // Проверяем, есть ли методы доставки
                        if (WC()->shipping()->get_shipping_methods()) {
                            // Выводим заголовок
                            echo '<h2>Выберите метод доставки:</h2>';

                            // Получаем выбранный метод доставки, если он уже установлен
                            $chosen_method = WC()->session->get('chosen_shipping_methods')[0];

                            // Создаем список методов доставки в форме радиокнопок
                            foreach (WC()->shipping()->get_shipping_methods() as $shipping_method) {
                                $method_id = $shipping_method->id;
                                $method_title = $shipping_method->title;
                                echo "<label for='shipping_method_$method_id'>";
                                echo "<input type='radio' id='shipping_method_$method_id' name='shipping_method[0]' value='$method_id' " . checked($chosen_method, $method_id, false) . " />";
                                echo " $method_title";
                                echo "</label><br>";
                                
                            }
                        } else {
                            echo 'Методы доставки не настроены.';
                        }
                        ?>

                        <?php
                        $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
                        foreach ($available_gateways as $gateway) { ?>
                            <li class="wc_payment_method payment_method_<?php echo esc_attr($gateway->id); ?>">
                                <input id="payment_method_<?php echo esc_attr($gateway->id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?>
                                    data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" />

                                <label for="payment_method_<?php echo esc_attr($gateway->id); ?>">
                                    <?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */?>         <?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */?>
                                </label>
                                <?php if ($gateway->has_fields() || $gateway->get_description()): ?>
                                    <div class="payment_box payment_method_<?php echo esc_attr($gateway->id); ?>" <?php if (!$gateway->chosen): /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */?>style="display:none;" <?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */?>>
                                        <?php $gateway->payment_fields(); ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php } ?>

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
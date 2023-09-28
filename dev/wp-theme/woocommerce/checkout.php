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

<body>
    <?php get_header(); ?>
    <main>
        <section class="section">
            <div class="container  col big_gap">
                <article id="post-9" class=" col big_gap">
                    <h1 class="text_32__bold">Оформлення замовлення</h1>
                    <div class="entry-content">

                        <form name="checkout" method="post" class="checkout row big_gap" action="https://shop.paperfox.in.ua/checkout/" enctype="multipart/form-data" novalidate="novalidate">

                            <div class="col big_gap flex_4" id="customer_details">
                                <div class="col gap width_100">
                                    <div class="woocommerce-billing-fields col gap width_100">
                                        <h3 class="text_24">Ваші контактні дані</h3>

                                        <div class="col gap width_100">

                                            <div class="row big_gap width_100">
                                                <div class="checkout_input_text" id="billing_first_name_field" data-priority="10">
                                                    <label for="billing_first_name">* Імʼя</label>
                                                    <input type="text" name="billing_first_name" id="billing_first_name" value="" autocomplete="given-name" required="true"
                                                        placeholder="Тарас">
                                                </div>


                                                <div class="checkout_input_text" id="billing_last_name_field" data-priority="20">
                                                    <label for="billing_last_name">Прізвище</label>
                                                    <input type="text" name="billing_last_name" id="billing_last_name" value="" autocomplete="family-name" required="true"
                                                        placeholder="Шевченко">
                                                </div>
                                            </div>

                                            <div class="row big_gap width_100">
                                                <div class="checkout_input_text" id="billing_phone_field" data-priority="100">
                                                    <label for="billing_phone">Мобільний телефон</label>
                                                    <input type="tel" id="billing_phone" required="true" placeholder=" +38 077 777 7777" name="billing_phone" autocomplete="tel">
                                                </div>
                                                <div class="checkout_input_text" id="billing_email_field" data-priority="110">
                                                    <label for="billing_email">Електронна пошта</label>
                                                    <input type="email" name="billing_email" id="billing_email" autocomplete="email" required="true"
                                                        placeholder="superman@shevchenko.ua">
                                                </div>
                                            </div>


                                            <div class="col gap width_100">

                                                <h2 class="text_24">Доставка</h2>
                                                <ul id="shipping_method" class="woocommerce-shipping-methods col gap width_100">

                                                    <li class="checkout_input_radio_wrapper">
                                                        <div class="checkout_input_radio">
                                                            <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_pickup2" value="local_pickup:2" class="shipping_method" checked>
                                                            <label for="shipping_method_0_local_pickup2">Самовивіз з нашого офісу</label>
                                                        </div>
                                                        <span class="checkout_input_radio_legend">м. Київ, вул. Ярославська 14/20. Окремий вхід з фасаду, цокольний поверх.<br>Видача замовлень:{{weekdays}}</span>
                                                    </li>

                                                    <li class="checkout_input_radio_wrapper">
                                                        <div class="checkout_input_radio">
                                                            <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_nova_poshta_shipping_method" value="nova_poshta_shipping_method" class="shipping_method">
                                                            <label for="shipping_method_0_nova_poshta_shipping_method">Самовивіз з Нової Пошти</label>
                                                        </div>
                                                        <div class="checkout_input_radio_legend" id="shipping_method_0_nova_poshta_shipping_method_legend">
                                                            <!-- Регіон -->
                                                            <div class="row big_gap width_100">
                                                                <!-- <p class="form-row " id="billing_nova_poshta_region_field" data-priority="120">
                                                                    <label for="billing_nova_poshta_region" class="flex_1">Область</label>
                                                                    <span class="woocommerce-input-wrapper">
                                                                        <select name="billing_nova_poshta_region" id="billing_nova_poshta_region" class="select select2-hidden-accessible" data-allow_clear="true" data-placeholder="Оберіть область" tabindex="-1" aria-hidden="true">
                                                                            <option value="" selected="selected">Оберіть область</option>
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
                                                                    </span>
                                                                </p> -->
                                                                <!-- Регіон -->

                                                                <!-- Місто -->
                                                                <!-- <p class="form-row validate-required" id="billing_nova_poshta_city_field" data-priority="122" class="flex_1">
                                                                    <label for="billing_nova_poshta_city" class="">Місто&nbsp;<abbr class="" title="обов&#39;язкове">*</abbr></label>
                                                                    <span class="woocommerce-input-wrapper">
                                                                        <select name="billing_nova_poshta_city" id="billing_nova_poshta_city" class="select select2-hidden-accessible" data-allow_clear="true" data-placeholder="Оберіть місто" tabindex="-1" aria-hidden="true">
                                                                            <option value="" selected="selected">Оберіть область</option>
                                                                        </select>
                                                                    </span>
                                                                </p> -->
                                                                <!-- Місто -->
                                                            </div>

                                                            <div class="row width_100">
                                                                <!-- Відділення / Поштомат -->
                                                                <!-- <p class="form-row validate-required" id="billing_nova_poshta_warehouse_field" data-priority="124" class="flex_1">
                                                                    <label for="billing_nova_poshta_warehouse" class="">Поштомат<span>&nbsp;*</span></label>
                                                                    <span class="woocommerce-input-wrapper">
                                                                        <select name="billing_nova_poshta_warehouse" id="billing_nova_poshta_warehouse" class="select select2-hidden-accessible" data-allow_clear="true" data-placeholder="Нічого не вибрано" tabindex="-1" aria-hidden="true">
                                                                            <option value="" selected="selected">Оберіть область</option>
                                                                        </select>

                                                                    </span>
                                                                </p> -->
                                                                <!-- Відділення / Поштомат -->
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="checkout_input_radio_wrapper">
                                                        <div class="checkout_input_radio">
                                                            <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_nova_poshta_shipping_method_poshtomat" value="nova_poshta_shipping_method_poshtomat" class="shipping_method">
                                                            <label for="shipping_method_0_nova_poshta_shipping_method_poshtomat">Поштомат Нової Пошти</label>
                                                        </div>
                                                        <div class="checkout_input_radio_legend" id="shipping_method_0_nova_poshta_shipping_method_poshtomat_legend">

                                                        </div>
                                                    </li>

                                                    <li class="checkout_input_radio_wrapper">
                                                        <div class="checkout_input_radio">
                                                            <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_npttn_address_shipping_method" value="npttn_address_shipping_method" class="shipping_method">
                                                            <label for="shipping_method_0_npttn_address_shipping_method">Адресна доставка Нової Пошти</label>
                                                        </div>
                                                        <div class="checkout_input_radio_legend" id="shipping_method_0_npttn_address_shipping_method_legend">
                                                            
                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                            <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40" style="display: none;">
                                                <label for=" billing_country" class="">Країна / Регіон&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label>
                                                <span class="woocommerce-input-wrapper"><strong>Україна</strong><input type="hidden" name="billing_country" id="billing_country" value="UA" autocomplete="country" class="country_to_state" readonly="readonly">
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col gap width_100">
                                    <div class="woocommerce-shipping-fields">

                                        <h3 id="ship-to-different-address">
                                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                                <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" type="checkbox" name="ship_to_different_address" value="1"> <span>Доставити на іншу адресу?</span>
                                            </label>
                                        </h3>

                                        <div class="shipping_address" style="display: none;">


                                            <div class="woocommerce-shipping-fields__field-wrapper">
                                                <p class="form-row form-row-first validate-required" id="shipping_first_name_field" data-priority="10"><label for="shipping_first_name" class="">Ім'я&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                        class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_first_name" id="shipping_first_name" placeholder="" value="" autocomplete="given-name"></span></p>
                                                <p class="form-row form-row-last validate-required" id="shipping_last_name_field" data-priority="20"><label for="shipping_last_name" class="">Прізвище&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                        class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_last_name" id="shipping_last_name" placeholder="" value="" autocomplete="family-name"></span></p>
                                                <p class="form-row form-row-wide validate-required" id="shipping_phone_field" data-priority="25"><label for="shipping_phone" class="">Телефон&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                        class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_phone" id="shipping_phone" placeholder="" value=""></span></p>

                                                <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="shipping_country_field" data-priority="40"><label for="shipping_country" class="">Країна / Регіон&nbsp;<abbr class="required"
                                                            title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><strong>Україна</strong><input type="hidden" name="shipping_country" id="shipping_country" value="UA" autocomplete="country"
                                                            class="country_to_state" readonly="readonly"></span></p>
                                                <p class="form-row address-field validate-required form-row-wide" id="shipping_address_1_field" data-priority="50"><label for="shipping_address_1" class="">Назва вулиці&nbsp;<abbr class="required"
                                                            title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_address_1" id="shipping_address_1" placeholder="Номер будинку та назва вулиці" value=""
                                                            autocomplete="address-line1" data-placeholder="Номер будинку та назва вулиці"></span></p>
                                                <p class="form-row address-field form-row-wide" id="shipping_address_2_field" data-priority="60"><label for="shipping_address_2" class="screen-reader-text">Будинок, офіс, блок, тощо.&nbsp;<span
                                                            class="optional">(необов'язково)</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_address_2" id="shipping_address_2"
                                                            placeholder="Квартира, офіс, блок, тощо (опціонально)" value="" autocomplete="address-line2" data-placeholder="Квартира, офіс, блок, тощо (опціонально)"></span></p>
                                                <p class="form-row address-field validate-required form-row-wide" id="shipping_city_field" data-priority="70" data-o_class="form-row form-row-wide address-field validate-required"><label for="shipping_city" class="">Місто / Село&nbsp;<abbr
                                                            class="required" title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_city" id="shipping_city" placeholder="" value=""
                                                            autocomplete="address-level2"></span></p>
                                                <p class="form-row address-field validate-required validate-state form-row-wide" id="shipping_state_field" data-priority="80" data-o_class="form-row form-row-wide address-field validate-required validate-state"><label for="shipping_state"
                                                        class="">Область / Округ&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><select name="shipping_state" id="shipping_state" class="state_select select2-hidden-accessible"
                                                            autocomplete="address-level1" data-placeholder="Виберіть опцію…" data-input-classes="" data-label="Область / Округ" tabindex="-1" aria-hidden="true">
                                                            <option value="">Виберіть опцію…</option>
                                                            <option value="UA05">Вінницька область</option>
                                                            <option value="UA07">Волинська область</option>
                                                            <option value="UA09">Луганська область</option>
                                                            <option value="UA12">Дніпропетровська область</option>
                                                            <option value="UA14">Донецька область</option>
                                                            <option value="UA18">Житомирська область</option>
                                                            <option value="UA21">Закарпатська область</option>
                                                            <option value="UA23">Запорізька область</option>
                                                            <option value="UA26">Івано-Франківська область</option>
                                                            <option value="UA30">місто Київ</option>
                                                            <option value="UA32">Київська область</option>
                                                            <option value="UA35">Кіровоградська область</option>
                                                            <option value="UA40">місто Севастополь</option>
                                                            <option value="UA43">Автономна Республіка Крим</option>
                                                            <option value="UA46">Львівська область</option>
                                                            <option value="UA48">Миколаївська область</option>
                                                            <option value="UA51">Одеська область</option>
                                                            <option value="UA53">Полтавська область</option>
                                                            <option value="UA56">Рівненська область</option>
                                                            <option value="UA59">Сумська область</option>
                                                            <option value="UA61">Тернопільська область</option>
                                                            <option value="UA63">Харківська область</option>
                                                            <option value="UA65">Херсонська область</option>
                                                            <option value="UA68">Хмельницька область</option>
                                                            <option value="UA71">Черкаська область</option>
                                                            <option value="UA74">Чернігівська область</option>
                                                            <option value="UA77">Чернівецька область</option>
                                                        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false"
                                                                    tabindex="0" aria-label="Область / Округ" role="combobox"><span class="select2-selection__rendered" id="select2-shipping_state-container" role="textbox" aria-readonly="true" title="місто Київ">місто Київ</span><span
                                                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></span></p>
                                                <p class="form-row address-field validate-required validate-postcode form-row-wide" id="shipping_postcode_field" data-priority="90" data-o_class="form-row form-row-wide address-field validate-required validate-postcode"><label
                                                        for="shipping_postcode" class="">Поштовий індекс&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_postcode"
                                                            id="shipping_postcode" placeholder="" value="" autocomplete="postal-code"></span></p>
                                                <p class="form-row " id="shipping_nova_poshta_region_field" data-priority="120"><label for="shipping_nova_poshta_region" class="">Область&nbsp;<span class="optional">(необов'язково)</span></label><span
                                                        class="woocommerce-input-wrapper"><select name="shipping_nova_poshta_region" id="shipping_nova_poshta_region" class="select " data-allow_clear="true" data-placeholder="Оберіть область">
                                                            <option value="" selected="selected">Оберіть область</option>
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
                                                        </select></span></p>
                                                <p class="form-row validate-required" id="shipping_nova_poshta_city_field" data-priority="122"><label for="shipping_nova_poshta_city" class="">Місто&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                        class="woocommerce-input-wrapper"><select name="shipping_nova_poshta_city" id="shipping_nova_poshta_city" class="select " data-allow_clear="true" data-placeholder="Оберіть місто">
                                                            <option value="" selected="selected">Оберіть область</option>
                                                        </select></span></p>
                                                <p class="form-row validate-required" id="shipping_nova_poshta_warehouse_field" data-priority="124"><label for="shipping_nova_poshta_warehouse" class="">Відділення&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                        class="woocommerce-input-wrapper"><select name="shipping_nova_poshta_warehouse" id="shipping_nova_poshta_warehouse" class="select " data-allow_clear="true" data-placeholder="Нічого не вибрано">
                                                            <option value="" selected="selected">Оберіть область</option>
                                                        </select></span></p>
                                                <p class="form-row form-row-wide my-custom-class" id="shipping_mrkvnp_street_field" data-priority="130"><label for="shipping_mrkvnp_street" class="">Вулиця&nbsp;<span class="optional">(необов'язково)</span></label><span
                                                        class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_mrkvnp_street" id="shipping_mrkvnp_street" placeholder="Введіть перші три літери.." value=""></span></p>
                                                <p class="form-row form-row-first" id="shipping_mrkvnp_house_field" data-priority="132"><label for="shipping_mrkvnp_house" class="">Номер будинку&nbsp;<span class="optional">(необов'язково)</span></label><span
                                                        class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_mrkvnp_house" id="shipping_mrkvnp_house" placeholder="" value=""></span></p>
                                                <p class="form-row form-row-last" id="shipping_mrkvnp_flat_field" data-priority="134"><label for="shipping_mrkvnp_flat" class="">Кв.&nbsp;<span class="optional">(необов'язково)</span></label><span class="woocommerce-input-wrapper"><input
                                                            type="text" class="input-text " name="shipping_mrkvnp_flat" id="shipping_mrkvnp_flat" placeholder="" value=""></span></p>
                                                <p class="form-row form-row-wide my-custom-class" id="shipping_mrkvnp_patronymics_field" data-priority="136"><label for="shipping_mrkvnp_patronymics" class="">По батькові&nbsp;<span class="optional">(необов'язково)</span></label><span
                                                        class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_mrkvnp_patronymics" id="shipping_mrkvnp_patronymics" placeholder="" value=""></span></p>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="woocommerce-additional-fields">



                                        <div class="woocommerce-additional-fields__field-wrapper">
                                            <p class="form-row notes" id="order_comments_field" data-priority=""><label for="order_comments" class="">Нотатки до замовлень&nbsp;<span class="optional">(необов'язково)</span></label><span class="woocommerce-input-wrapper"><textarea
                                                        name="order_comments" class="input-text " id="order_comments" placeholder="Нотатки до вашого замовлення, наприклад спеціальні нотатки для доставки." rows="2" cols="5"></textarea></span></p>
                                        </div>


                                    </div>
                                </div>



                                <div id="payment" class="woocommerce-checkout-payment col gap width_100">
                                    <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_bacs">
                                            <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" data-order_button_text="">

                                            <label for="payment_method_bacs">
                                                Банківський переказ </label>
                                            <div class="payment_box payment_method_bacs" style="display:none;">
                                                <p>Проведіть платіж безпосередньо на наш банківський рахунок. Будь ласка, вкажіть номер Вашого замовлення в описі переказу. Ваше замовлення не буде виконано, доки кошти не будуть зараховані на наш рахунок.</p>
                                            </div>
                                        </li>
                                        <li class="wc_payment_method payment_method_mono_gateway">
                                            <input id="payment_method_mono_gateway" type="radio" class="input-radio" name="payment_method" value="mono_gateway" data-order_button_text="">

                                            <label for="payment_method_mono_gateway">
                                                Оплата онлайн з monopay <style>
                                                    .payment_method_mono_gateway>label {
                                                        display: flex;
                                                        align-items: center;
                                                    }
                                                </style>
                                                <div class="mono_pay_logo" style="display: flex;align-items: center;justify-content: center;flex: 1;"><img src="./Оформлення замовлення – PaperFox_files/footer_monopay_light_bg.svg" style="width: 85px;" alt="Mono"></div>
                                            </label>
                                        </li>
                                        <li class="wc_payment_method payment_method_morkva-liqpay">
                                            <input id="payment_method_morkva-liqpay" type="radio" class="input-radio" name="payment_method" value="morkva-liqpay" checked="checked" data-order_button_text="">

                                            <label for="payment_method_morkva-liqpay">
                                                LiqPay </label>
                                            <div class="payment_box payment_method_morkva-liqpay">
                                                <p>Оплата картою на сайті платіжної системи або у додатку Приват24</p>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                            <div id="order_review" class="cart_summary_card flex_2">
                                <h3 id="order_review_heading">Ваше замовлення</h3>
                                <button type="submit" class="button__primary width_100" name="woocommerce_checkout_place_order" id="place_order" value="Підтвердити замовлення" data-value="Підтвердити замовлення">Підтвердити замовлення</button>

                                <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="e6c0c63e44"><input type="hidden" name="_wp_http_referer" value="/?wc-ajax=update_order_review">

                                <div class="row">
                                    <input type="checkbox" checked class="checkout_checkbox" required
                                        id="user-policy-confirmation">
                                    <label for="user-policy-confirmation" class="checkout_checkbox_label">Перейшовши до
                                        оформнення Ви підтверджуєте що перевірили зміст та склад створенного дизайну або
                                        обраного готового виробу. Готовий виріб або створений дизайн матиме вигляд що було
                                        створено у редакторі або показано на фото з можливими відхилення згідно до технічних
                                        можливостей</label>
                                </div>
                            </div>



                            <input type="hidden" name="npregionref" location="billing" value=""><input type="hidden" name="npregionname" location="billing" value="undefined">
                        </form>

                    </div><!-- .entry-content -->

                </article><!-- #post-## -->





            </div>
        </section>
    </main>

    <?php
    get_footer();
    wp_footer();
    ?>
</body>


<!-- @@include('../../pages/checkout/index.html') -->
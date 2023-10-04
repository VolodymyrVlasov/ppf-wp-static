<?php
/**
 * Template Name: Checkout Page
 */

?>

<?php defined('ABSPATH') || exit; ?>

<div id="page" class="hfeed site">

    <header id="masthead" class="site-header" role="banner" style="">

        <div class="col-full"> <a class="skip-link screen-reader-text" href="https://shop.paperfox.in.ua/checkout/#site-navigation">Перейти до навігації</a>
            <a class="skip-link screen-reader-text" href="https://shop.paperfox.in.ua/checkout/#content">Перейти до контенту</a>
            <div class="site-branding">
                <div class="beta site-title"><a href="https://shop.paperfox.in.ua/" rel="home">PaperFox</a></div>
            </div>
            <div class="site-search">
                <div class="widget woocommerce widget_product_search">
                    <form role="search" method="get" class="woocommerce-product-search" action="https://shop.paperfox.in.ua/">
                        <label class="screen-reader-text" for="woocommerce-product-search-field-0">Шукати:</label>
                        <input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="Пошук товарів…" value="" name="s">
                        <button type="submit" value="Шукати" class="">Шукати</button>
                        <input type="hidden" name="post_type" value="product">
                    </form>
                </div>
            </div>
        </div>
        <div class="storefront-primary-navigation">
            <div class="col-full">
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Головне меню">
                    <button id="site-navigation-menu-toggle" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span>Меню</span></button>
                    <div class="menu">
                        <ul aria-expanded="false" class="nav-menu">
                            <li><a href="https://shop.paperfox.in.ua/">Головна</a></li>
                            <li class="page_item page-item-2"><a href="https://shop.paperfox.in.ua/sample-page/">Зразок сторінки</a></li>
                            <li class="page_item page-item-8"><a href="https://shop.paperfox.in.ua/cart/">Кошик</a></li>
                            <li class="page_item page-item-7"><a href="https://shop.paperfox.in.ua/shop/">Магазин</a></li>
                            <li class="page_item page-item-10"><a href="https://shop.paperfox.in.ua/my-account/">Мій обліковий запис</a></li>
                            <li class="page_item page-item-9 current_page_item"><a href="https://shop.paperfox.in.ua/checkout/" aria-current="page">Оформлення замовлення</a></li>
                        </ul>
                    </div>
                    <div class="menu">
                        <ul>
                            <li><a href="https://shop.paperfox.in.ua/">Головна</a></li>
                            <li class="page_item page-item-2"><a href="https://shop.paperfox.in.ua/sample-page/">Зразок сторінки</a></li>
                            <li class="page_item page-item-8"><a href="https://shop.paperfox.in.ua/cart/">Кошик</a></li>
                            <li class="page_item page-item-7"><a href="https://shop.paperfox.in.ua/shop/">Магазин</a></li>
                            <li class="page_item page-item-10"><a href="https://shop.paperfox.in.ua/my-account/">Мій обліковий запис</a></li>
                            <li class="page_item page-item-9 current_page_item"><a href="https://shop.paperfox.in.ua/checkout/" aria-current="page">Оформлення замовлення</a></li>
                        </ul>
                    </div>
                </nav><!-- #site-navigation -->
                <ul id="site-header-cart" class="site-header-cart menu">
                    <li class="">
                        <a class="cart-contents" href="https://shop.paperfox.in.ua/cart/" title="Переглянути кошик">
                            <span class="woocommerce-Price-amount amount">200<span class="woocommerce-Price-currencySymbol">₴</span></span> <span class="count">1 товар</span>
                        </a>

                    </li>
                    <li>
                    </li>
                </ul>
            </div>
        </div>
    </header><!-- #masthead -->

    <div class="storefront-breadcrumb">
        <div class="col-full">
            <nav class="woocommerce-breadcrumb" aria-label="breadcrumbs"><a href="https://shop.paperfox.in.ua/">Головна</a><span class="breadcrumb-separator"> / </span>Оформлення замовлення</nav>
        </div>
    </div>
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">


            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">


                    <article id="post-9" class="post-9 page type-page status-publish hentry">
                        <header class="entry-header">
                            <h1 class="entry-title">Оформлення замовлення</h1>
                        </header><!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>
                                <div class="woocommerce-notices-wrapper"></div>
                                <form name="checkout" method="post" class="checkout woocommerce-checkout" action="https://shop.paperfox.in.ua/checkout/" enctype="multipart/form-data" novalidate="novalidate">



                                    <div class="col2-set" id="customer_details">
                                        <div class="col-1">
                                            <div class="woocommerce-billing-fields">

                                                <h3>Платіжні дані</h3>



                                                <div class="woocommerce-billing-fields__field-wrapper">
                                                    <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><label for="billing_first_name" class="">Ім'я&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                            class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name"></span></p>
                                                    <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20"><label for="billing_last_name" class="">Прізвище&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                            class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name"></span></p>
                                                    <p class="form-row form-row-wide" id="billing_company_field" data-priority="30"><label for="billing_company" class="">Назва компанії&nbsp;<span class="optional">(необов'язково)</span></label><span class="woocommerce-input-wrapper"><input
                                                                type="text" class="input-text " name="billing_company" id="billing_company" placeholder="" value="" autocomplete="organization"></span></p>
                                                    <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40"><label for="billing_country" class="">Країна / Регіон&nbsp;<abbr class="required"
                                                                title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><strong>Україна</strong><input type="hidden" name="billing_country" id="billing_country" value="UA" autocomplete="country" class="country_to_state"
                                                                readonly="readonly"></span></p>
                                                    <p class="form-row address-field validate-required form-row-wide" id="billing_address_1_field" data-priority="50" style="display: none;"><label for="billing_address_1" class="">Назва вулиці&nbsp;<abbr class="required"
                                                                title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="Номер будинку та назва вулиці" value=""
                                                                autocomplete="address-line1" data-placeholder="Номер будинку та назва вулиці" disabled="disabled"></span></p>
                                                    <p class="form-row address-field form-row-wide" id="billing_address_2_field" data-priority="60" style="display: none;"><label for="billing_address_2" class="screen-reader-text">Будинок, офіс, блок, тощо.&nbsp;<span
                                                                class="optional">(необов'язково)</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_address_2" id="billing_address_2" placeholder="Квартира, офіс, блок, тощо (опціонально)"
                                                                value="" autocomplete="address-line2" data-placeholder="Квартира, офіс, блок, тощо (опціонально)" disabled="disabled"></span></p>
                                                    <p class="form-row address-field validate-required form-row-wide" id="billing_city_field" data-priority="70" data-o_class="form-row form-row-wide address-field validate-required" style="display: none;"><label for="billing_city" class="">Місто /
                                                            Село&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_city" id="billing_city" placeholder="" value=""
                                                                autocomplete="address-level2" disabled="disabled"></span></p>
                                                    <p class="form-row address-field validate-state validate-required form-row-wide" id="billing_state_field" data-priority="80" data-o_class="form-row form-row-wide address-field validate-state" style="display: none;"><label for="billing_state"
                                                            class="">Область / Округ&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><select name="billing_state" id="billing_state" class="state_select select2-hidden-accessible"
                                                                autocomplete="address-level1" data-placeholder="Виберіть опцію…" data-input-classes="" data-label="Область / Округ" tabindex="-1" aria-hidden="true" disabled="disabled">
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
                                                            </select><span class="select2 select2-container select2-container--default select2-container--disabled" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single"
                                                                        aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-label="Область / Округ" role="combobox"><span class="select2-selection__rendered" id="select2-billing_state-container" role="textbox" aria-readonly="true"
                                                                            title="місто Київ">місто Київ</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></span></p>
                                                    <p class="form-row address-field validate-postcode validate-required form-row-wide" id="billing_postcode_field" data-priority="90" data-o_class="form-row form-row-wide address-field validate-postcode" style="display: none;"><label
                                                            for="billing_postcode" class="">Поштовий індекс&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_postcode"
                                                                id="billing_postcode" placeholder="" value="" autocomplete="postal-code" disabled="disabled"></span></p>
                                                    <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100"><label for="billing_phone" class="">Телефон&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                            class="woocommerce-input-wrapper"><input type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder="" value="" autocomplete="tel"></span></p>
                                                    <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110"><label for="billing_email" class="">E-mail адреса&nbsp;<abbr class="required" title="обов&#39;язкове">*</abbr></label><span
                                                            class="woocommerce-input-wrapper"><input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="volodymyr.vlasov@gmail.com" autocomplete="email"></span></p>
                                                    <p class="form-row " id="billing_nova_poshta_region_field" data-priority="120"><label for="billing_nova_poshta_region" class="">Область&nbsp;<span class="optional"><span class="asterisk-color">*</span></span></label><span
                                                            class="woocommerce-input-wrapper"><select name="billing_nova_poshta_region" id="billing_nova_poshta_region" class="select select2-hidden-accessible" data-allow_clear="true" data-placeholder="Оберіть область" tabindex="-1"
                                                                aria-hidden="true">
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
                                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 563.281px;"><span class="selection"><span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false"
                                                                        tabindex="0" aria-labelledby="select2-billing_nova_poshta_region-container" role="combobox"><span class="select2-selection__rendered" id="select2-billing_nova_poshta_region-container" role="textbox"
                                                                            aria-readonly="true"><span class="select2-selection__placeholder">Оберіть область</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span
                                                                    class="dropdown-wrapper" aria-hidden="true"></span></span></span></p>
                                                    <p class="form-row validate-required" id="billing_nova_poshta_city_field" data-priority="122"><label for="billing_nova_poshta_city" class="">Місто&nbsp;<abbr class="" title="обов&#39;язкове">*</abbr></label><span
                                                            class="woocommerce-input-wrapper"><select name="billing_nova_poshta_city" id="billing_nova_poshta_city" class="select select2-hidden-accessible" data-allow_clear="true" data-placeholder="Оберіть місто" tabindex="-1" aria-hidden="true">
                                                                <option value="" selected="selected">Оберіть область</option>
                                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 563.281px;"><span class="selection"><span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false"
                                                                        tabindex="0" aria-labelledby="select2-billing_nova_poshta_city-container" role="combobox"><span class="select2-selection__rendered" id="select2-billing_nova_poshta_city-container" role="textbox" aria-readonly="true"><span
                                                                                class="select2-selection__placeholder">Оберіть місто</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper"
                                                                    aria-hidden="true"></span></span></span></p>
                                                    <p class="form-row validate-required" id="billing_nova_poshta_warehouse_field" data-priority="124"><label for="billing_nova_poshta_warehouse" class="">Поштомат<span>&nbsp;*</span></label><span class="woocommerce-input-wrapper"><select
                                                                name="billing_nova_poshta_warehouse" id="billing_nova_poshta_warehouse" class="select select2-hidden-accessible" data-allow_clear="true" data-placeholder="Нічого не вибрано" tabindex="-1" aria-hidden="true">
                                                                <option value="" selected="selected">Оберіть область</option>
                                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 563.281px;"><span class="selection"><span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false"
                                                                        tabindex="0" aria-labelledby="select2-billing_nova_poshta_warehouse-container" role="combobox"><span class="select2-selection__rendered" id="select2-billing_nova_poshta_warehouse-container" role="textbox"
                                                                            aria-readonly="true"><span class="select2-selection__placeholder">Оберіть поштомат</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span
                                                                    class="dropdown-wrapper" aria-hidden="true"></span></span></span></p>
                                                    <p class="form-row form-row-wide my-custom-class" id="billing_mrkvnp_street_field" data-priority="130" style="display: none;"><label for="billing_mrkvnp_street" class="">Вулиця&nbsp;<span class="optional"><span
                                                                    class="asterisk-color">*</span></span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_mrkvnp_street" id="billing_mrkvnp_street" placeholder="Введіть перші три літери.."
                                                                value="" disabled="disabled"></span></p>
                                                    <p class="form-row form-row-first" id="billing_mrkvnp_house_field" data-priority="132" style="display: none;"><label for="billing_mrkvnp_house" class="">Номер будинку&nbsp;<span class="optional"><span
                                                                    class="asterisk-color">*</span></span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_mrkvnp_house" id="billing_mrkvnp_house" placeholder="" value=""
                                                                disabled="disabled"></span></p>
                                                    <p class="form-row form-row-last" id="billing_mrkvnp_flat_field" data-priority="134" style="display: none;"><label for="billing_mrkvnp_flat" class="">Кв.&nbsp;<span class="optional">(необов'язково)</span></label><span
                                                            class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_mrkvnp_flat" id="billing_mrkvnp_flat" placeholder="" value="" disabled="disabled"></span></p>
                                                    <p class="form-row form-row-wide my-custom-class" id="billing_mrkvnp_patronymics_field" data-priority="136" style="display: none;"><label for="billing_mrkvnp_patronymics" class="">По батькові&nbsp;<span class="optional"><span
                                                                    class="asterisk-color">*</span></span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_mrkvnp_patronymics" id="billing_mrkvnp_patronymics" placeholder="" value=""
                                                                disabled="disabled"></span></p>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-2">
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
                                                        <p class="form-row form-row-wide" id="shipping_company_field" data-priority="30"><label for="shipping_company" class="">Назва компанії&nbsp;<span class="optional">(необов'язково)</span></label><span class="woocommerce-input-wrapper"><input
                                                                    type="text" class="input-text " name="shipping_company" id="shipping_company" placeholder="" value="" autocomplete="organization"></span></p>
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
                                    </div>




                                    <h3 id="order_review_heading">Ваше замовлення</h3>


                                    <div id="order_review" class="woocommerce-checkout-review-order">
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Товар</th>
                                                    <th class="product-total">Проміжний підсумок</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        Чашка "Мама може все"&nbsp; <strong class="product-quantity">×&nbsp;1</strong> </td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount"><bdi>200<span class="woocommerce-Price-currencySymbol">₴</span></bdi></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>

                                                <tr class="cart-subtotal">
                                                    <th>Проміжний підсумок</th>
                                                    <td><span class="woocommerce-Price-amount amount"><bdi>200<span class="woocommerce-Price-currencySymbol">₴</span></bdi></span></td>
                                                </tr>




                                                <tr class="woocommerce-shipping-totals shipping">
                                                    <th>Доставка</th>
                                                    <td data-title="Доставка">
                                                        <ul id="shipping_method" class="woocommerce-shipping-methods">
                                                            <li>
                                                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_pickup2" value="local_pickup:2" class="shipping_method"><label for="shipping_method_0_local_pickup2">Самовивіз</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_nova_poshta_shipping_method" value="nova_poshta_shipping_method" class="shipping_method"><label
                                                                    for="shipping_method_0_nova_poshta_shipping_method">Нова Пошта</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_nova_poshta_shipping_method_poshtomat" value="nova_poshta_shipping_method_poshtomat" class="shipping_method" checked="checked"><label
                                                                    for="shipping_method_0_nova_poshta_shipping_method_poshtomat">Нова Пошта Поштомат</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_npttn_address_shipping_method" value="npttn_address_shipping_method" class="shipping_method"><label
                                                                    for="shipping_method_0_npttn_address_shipping_method">Адресна доставка Нова пошта</label>
                                                            </li>
                                                        </ul>


                                                    </td>
                                                </tr>






                                                <tr class="order-total">
                                                    <th>Загалом</th>
                                                    <td><strong><span class="woocommerce-Price-amount amount"><bdi>200<span class="woocommerce-Price-currencySymbol">₴</span></bdi></span></strong> </td>
                                                </tr>


                                            </tfoot>
                                        </table>

                                        <div id="payment" class="woocommerce-checkout-payment">
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
                                            <div class="form-row place-order">
                                                <noscript>
                                                    Оскільки ваш браузер не підтримує JavaScript (або він вимкнений), будь ласка, натисніть кнопку <em>Оновлення підсумку</em> перед розміщенням замовлення. Інакше ви можете отримати рахунок на більшу суму, ніж очікуєте, якщо не зробите цього.
                                                    <br /><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Оновити підсумки">Оновити підсумки</button>
                                                </noscript>

                                                <div class="woocommerce-terms-and-conditions-wrapper">
                                                    <div class="woocommerce-privacy-policy-text">
                                                        <p>Ваші персональні дані будуть використовуватися для обробки вашого замовлення, підтримки вашого досвіду на цьому сайті та для інших цілей, описаних у нашій <a href="https://shop.paperfox.in.ua/?page_id=3"
                                                                class="woocommerce-privacy-policy-link" target="_blank">політика конфіденційності</a>.</p>
                                                    </div>
                                                </div>


                                                <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Підтвердити замовлення" data-value="Підтвердити замовлення">Підтвердити замовлення</button>

                                                <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="e6c0c63e44"><input type="hidden" name="_wp_http_referer" value="/?wc-ajax=update_order_review">
                                            </div>
                                        </div>

                                    </div>


                                    <input type="hidden" name="npregionref" location="billing" value=""><input type="hidden" name="npregionname" location="billing" value="undefined">
                                </form>

                            </div>
                        </div><!-- .entry-content -->
                        <div class="edit-link"><a class="post-edit-link" href="https://shop.paperfox.in.ua/wp-admin/post.php?post=9&amp;action=edit">Редагувати <span class="screen-reader-text">Оформлення замовлення</span></a></div>
                    </article><!-- #post-## -->

                </main><!-- #main -->
            </div><!-- #primary -->


        </div><!-- .col-full -->
    </div><!-- #content -->
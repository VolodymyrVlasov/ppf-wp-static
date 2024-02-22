<h2 class="text_24">Доставка</h2>
<div class="woocommerce-shipping-fields">
</div>
<ul id="shipping_method" class="woocommerce-shipping-methods col gap width_100">
    <!-- Самовивіз -->
    <li class="checkout_input_radio_wrapper">
        <div class="checkout_input_radio">
            <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_pickup1" value="local_pickup:2" class="shipping_method">
            <label for="shipping_method_0_local_pickup1">Самовивіз з офісу</label>
        </div>
        <span class="checkout_input_radio_legend" id="billing_city_field">
            <input type="text" class="aperance_none" name="billing_city" id="billing_city" value="Київ" />
            <label for="billing_city">
                Київ, вул. Ярославська 14/20.
                Окремий вхід з фасаду, цокольний поверх.<br>Видача замовлень: {{weekdays}}"</label>
        </span>
    </li>
    <!-- Нова Пошта -->
    <div class="checkout_input_radio_wrapper">
        <div class="checkout_input_radio">
            <input type="radio" id="shipping_method_np_wrapper" checked>
            <label for="shipping_method_np_wrapper">Нова Пошта</label>
        </div>
        <div class="checkout_input_radio_legend gap" id="shipping_method_0_nova_poshta_shipping_method_legend">

            <div id="ship-to-different-address" class="checkout_input_checkbox margin-top">
                <input id="ship-to-different-address-checkbox" type="checkbox" name="ship_to_different_address" value="1">
                <label for="ship-to-different-address-checkbox">Інший отримувач?</label>
            </div>
            <!-- Інший отримувач - контакти -->
            @@include('../../../partials/checkout/checkout-shipping-recepient.php')

            <!-- Нова Пошта - види доставки -->
            <div class="checkout_np_shipping_types">
                <li class="checkout_input_checkbox">
                    <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_nova_poshta_shipping_method" value="nova_poshta_shipping_method" class="shipping_method" checked>
                    <label for="shipping_method_0_nova_poshta_shipping_method">Відділення</label>
                </li>
                <li class="checkout_input_checkbox">
                    <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_nova_poshta_shipping_method_poshtomat" value="nova_poshta_shipping_method_poshtomat" class="shipping_method">
                    <label for="shipping_method_0_nova_poshta_shipping_method_poshtomat">Поштомат</label>
                </li>
                <li class="checkout_input_checkbox">
                    <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_npttn_address_shipping_method" value="npttn_address_shipping_method" class="shipping_method">
                    <label for="shipping_method_0_npttn_address_shipping_method">Адресна</label>
            </div>

            <!-- Платіжна адреса (billing address) - Нова Пошта  -->
            @@include('../../../partials/checkout/checkout-billing-address.php')

            <!-- Інший отримувач - Нова Пошта -->
            @@include('../../../partials/checkout/checkout-shipping-address.php')
        </div>
    </div>


</ul>
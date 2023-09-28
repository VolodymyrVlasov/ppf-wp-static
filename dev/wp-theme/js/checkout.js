console.log("checkout.js")

const shippingMethodsGroup = document.getElementById("shipping_method");
const shippingMethodList = document.getElementsByName("shipping_method[0]");

const NP_WH_PM = `
<!-- Регіон -->
                                                            <div class="row big_gap width_100">
                                                                <p class="form-row " id="billing_nova_poshta_region_field" data-priority="120">
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
                                                                </p>
                                                                <!-- Регіон -->

                                                                <!-- Місто -->
                                                                <p class="form-row validate-required" id="billing_nova_poshta_city_field" data-priority="122" class="flex_1">
                                                                    <label for="billing_nova_poshta_city" class="">Місто&nbsp;<abbr class="" title="обов&#39;язкове">*</abbr></label>
                                                                    <span class="woocommerce-input-wrapper">
                                                                        <select name="billing_nova_poshta_city" id="billing_nova_poshta_city" class="select select2-hidden-accessible" data-allow_clear="true" data-placeholder="Оберіть місто" tabindex="-1" aria-hidden="true">
                                                                            <option value="" selected="selected">Оберіть область</option>
                                                                        </select>
                                                                    </span>
                                                                </p>
                                                                <!-- Місто -->
                                                            </div>

                                                            <div class="row width_100">
                                                                <!-- Відділення / Поштомат -->
                                                                <p class="form-row validate-required" id="billing_nova_poshta_warehouse_field" data-priority="124" class="flex_1">
                                                                    <label for="billing_nova_poshta_warehouse" class="">Поштомат<span>&nbsp;*</span></label>
                                                                    <span class="woocommerce-input-wrapper">
                                                                        <select name="billing_nova_poshta_warehouse" id="billing_nova_poshta_warehouse" class="select select2-hidden-accessible" data-allow_clear="true" data-placeholder="Нічого не вибрано" tabindex="-1" aria-hidden="true">
                                                                            <option value="" selected="selected">Оберіть область</option>
                                                                        </select>

                                                                    </span>
                                                                </p>
                                                                <!-- Відділення / Поштомат -->
                                                            </div>
                                                            `;


const NP_ADDRSS = `
<div class="row gap">
    <!-- Адресна доставка -->
    <p class="form-row form-row-wide my-custom-class" id="billing_mrkvnp_street_field" data-priority="130" style="display: none;">
        <label for="billing_mrkvnp_street" class="">Вулиця&nbsp;<span class="optional"><span class="asterisk-color">*</span></span>
        </label>
        <span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_mrkvnp_street" id="billing_mrkvnp_street" placeholder="Введіть перші три літери.." value="" disabled="disabled"></span>
    </p>

    <p class="form-row form-row-first" id="billing_mrkvnp_house_field" data-priority="132" style="display: none;">
        <label for="billing_mrkvnp_house" class="">Номер будинку&nbsp;<span class="optional">
                <span class="asterisk-color">*</span>
            </span>
        </label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text " name="billing_mrkvnp_house" id="billing_mrkvnp_house" placeholder="" value="" disabled="disabled">
        </span>
    </p>

    <p class="form-row form-row-last" id="billing_mrkvnp_flat_field" data-priority="134" style="display: none;">
        <label for="billing_mrkvnp_flat" class="">Кв.&nbsp;<span class="optional">(необов'язково)</span>
        </label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text " name="billing_mrkvnp_flat" id="billing_mrkvnp_flat" placeholder="" value="" disabled="disabled">
        </span>
    </p>

    <p class="form-row form-row-wide my-custom-class" id="billing_mrkvnp_patronymics_field" data-priority="136" style="display: none;">
        <label for="billing_mrkvnp_patronymics" class="">По батькові&nbsp;<span class="optional">
                <span class="asterisk-color">*</span>
            </span>
        </label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text " name="billing_mrkvnp_patronymics" id="billing_mrkvnp_patronymics" placeholder="" value="" disabled="disabled">
        </span>
    </p>
    <!-- Адресна доставка -->
</div>`;

shippingMethodsGroup.addEventListener("change", () => {
    shippingMethodList.forEach(method => {
        if (method.checked) {
            if (method.id != "shipping_method_0_local_pickup2") {
                const npWarehouseLegend = document.getElementById("shipping_method_0_nova_poshta_shipping_method_legend");
                const npPoshtomatLegend = document.getElementById("shipping_method_0_nova_poshta_shipping_method_poshtomat_legend");
                const npAddressLegend = document.getElementById("shipping_method_0_npttn_address_shipping_method_legend");

                switch (method.id) {
                    // НП відділення
                    case "shipping_method_0_nova_poshta_shipping_method":
                        console.log("case 1", method.id);
                        npWarehouseLegend.innerHTML = NP_WH_PM;
                        npPoshtomatLegend.innerHTML = "";
                        npAddressLegend.innerHTML = "";
                        break;
                    // НП поштомат
                    case "shipping_method_0_nova_poshta_shipping_method_poshtomat":
                        console.log("case 2", method.id);

                        npWarehouseLegend.innerHTML = "";
                        npPoshtomatLegend.innerHTML = NP_WH_PM;
                        npAddressLegend.innerHTML = "";
                        break;
                    // НП адресна
                    case "shipping_method_0_npttn_address_shipping_method":
                        console.log("case 3", method.id);

                        npWarehouseLegend.innerHTML = "";
                        npPoshtomatLegend.innerHTML = "";
                        npAddressLegend.innerHTML = NP_WH_PM + NP_ADDRSS;
                        break;
                }
            }


        }
    })
})





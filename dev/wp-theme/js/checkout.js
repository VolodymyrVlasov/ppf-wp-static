console.log("checkout.js")

const regionSelect = document.getElementById("billing_nova_poshta_region");
const citySelect = document.getElementById("billing_nova_poshta_city_field");
const shippingMethod = document.querySelectorAll(".shipping_method");
const shippingMethodsGroup = document.getElementById("shipping_method");

regionSelect.addEventListener("change", () => {
    setTimeout(() => {
        document.getElementsByClassName("select2-selection__arrow")[0].style.display = "none";

        citySelect.style.paddingBottom = "12px";
        const ref = document.getElementsByClassName("select2-selection select2-selection--single")[0];
        ref.style.border = "none";
        ref.style.backgroundColor = "transparent";
        ref.style.paddingLeft = "16px";
        ref.style.width = "100% !important";
        const selected = document.getElementsByClassName("select2-selection__rendered")[0];
        selected.style.color = "black";
    }, 0)
})




const onChangeShippingMethod = (event) => {
    const selectedShippingType = event.target.id;
    const npWarehouseCnt = document.getElementById("np_warehouse");
    const npPoshtomadCnt = document.getElementById("np_poshtomat");
    const npAddressCnt = document.getElementById("billing_mrkvnp_street_field");

    switch (selectedShippingType) {
        case "nova_poshta_shipping_method": {
            console.log("Обрано відділення НП");
            npPoshtomadCnt.innerHTML = "";
            npWarehouseCnt.innerHTML = `
            <div class="select col flex_1 width_100 woocommerce-input-wrapper" id="billing_nova_poshta_warehouse_field">
                <label for="billing_nova_poshta_warehouse">Відділення Нової Пошти</label>
                <select id="billing_nova_poshta_warehouse" name="billing_nova_poshta_warehouse" autocomplete="on">
                    <option selected>Оберіть відділення</option>
                </select>

                <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                    <span class="selection">
                        <span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0"
                            aria-labelledby="select2-billing_nova_poshta_warehouse-container" role="combobox" 
                            style="border: none; background-color:transparent; padding-left: 16px; width: 100% !important; margin-top: -32px;">
                            <span class="select2-selection__rendered" id="select2-billing_nova_poshta_warehouse-container" role="textbox" aria-readonly="true"
                                style="color: black;">
                              
                            </span>
                        </span>
                    </span>
                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                </span>
            </div>`;
            break;
        }
        case "nova_poshta_shipping_method_poshtomat": {
            console.log("Обрано поштомат НП");
            npWarehouseCnt.innerHTML = "";
            npPoshtomadCnt.innerHTML = `
            <div class="select col width_100" id="billing_nova_poshta_warehouse_field">
                <label for="billing_nova_poshta_warehouse">Поштомат</label>
                <select id="billing_nova_poshta_warehouse" name="billing_nova_poshta_warehouse" autocomplete="on">
                    <option selected>Оберіть поштомат</option>
                </select>
                <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                    <span class="selection">
                        <span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0"
                            aria-labelledby="select2-billing_nova_poshta_warehouse-container" role="combobox"
                            style="border: none; background-color:transparent; padding-left: 16px; width: 100% !important; margin-top: -32px;">
                            <span class="select2-selection__rendered" id="select2-billing_nova_poshta_warehouse-container" role="textbox" aria-readonly="true"  style="color: black;">
                               
                            </span>
                    </span>
                    </span>
                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                </span>
            </div>`;
            break;
        }
        case "npttn_address_shipping_method": {
            console.log("Обрано адресну доставку НП");
            break;
        }
        default:
    }
}

shippingMethodsGroup.addEventListener("change", (event) => onChangeShippingMethod(event));







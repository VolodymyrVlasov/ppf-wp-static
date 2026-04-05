console.log("checkout.js")

const localPickup = document.getElementById("shipping_method_0_local_pickup1");
const npWrapper = document.getElementById("shipping_method_np_wrapper");
const np = document.getElementById("shipping_method_0_nova_poshta_shipping_method");
const anotherRecepient = document.getElementById("ship-to-different-address");
const billigFields = document.getElementById("woocommerce-billing-fields");


const shippingMethodList = document.getElementsByName("shipping_method[0]");
console.clear();
console.log("checkout-ppf.js")

const checkoutForm = document.getElementsByName("checkout")[0];

console.log("checkoutForm", checkoutForm)

checkoutForm?.addEventListener("submit", e => {

    const formData = new FormData(checkoutForm);

    // Выводим объект FormData в консоль
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }
})


// billing_first_name: volodymyr
// checkout.js:28 billing_last_name: vlasov
// checkout.js:28 billing_company: 
// checkout.js:28 billing_country: UA
// checkout.js:28 billing_address_1: Reee
// checkout.js:28 billing_address_2: 
// checkout.js:28 billing_city: qddww
// checkout.js:28 billing_state: UA30
// checkout.js:28 billing_postcode: 01211
// checkout.js:28 billing_phone: 0635825280
// checkout.js:28 billing_email: volodymyr.vlasov@gmail.com
// checkout.js:28 shipping_first_name: volodymyr
// checkout.js:28 shipping_last_name: vlasov
// checkout.js:28 shipping_phone: 0635825280
// checkout.js:28 shipping_company: 
// checkout.js:28 shipping_country: UA
// checkout.js:28 shipping_address_1: Reee
// checkout.js:28 shipping_address_2: 
// checkout.js:28 shipping_city: qddww
// checkout.js:28 shipping_state: UA30
// checkout.js:28 shipping_postcode: 01211
// checkout.js:28 shipping_nova_poshta_region: 
// checkout.js:28 shipping_nova_poshta_city: 
// checkout.js:28 shipping_nova_poshta_warehouse: 
// checkout.js:28 shipping_mrkvnp_street: 
// checkout.js:28 shipping_mrkvnp_house: 
// checkout.js:28 shipping_mrkvnp_flat: 
// checkout.js:28 shipping_mrkvnp_patronymics: 
// checkout.js:28 order_comments: 
// checkout.js:28 shipping_method[0]: local_pickup:2
// checkout.js:28 payment_method: bacs
// checkout.js:28 npregionref: 
// checkout.js:28 npregion



localPickup?.addEventListener("change", e => {
    if (e.target.checked) {
        npWrapper.checked = false;
        // anotherRecepient.style = "display: none;";
    }
})


npWrapper?.addEventListener("change", e => {
    if (e.target.checked) {
        setTimeout(() => {
            np.checked = true;
            console.log(np.checked)
        }, 5)
    }
})

np?.addEventListener("change", e => {
    if (e.target.checked) {
        npWrapper.checked = true;
        // anotherRecepient.style = "";
    }
})

anotherRecepient?.addEventListener("change", e => {
    console.log("shippingMethodList canged");
    if (e.target.checked) {
        console.log("shippingMethodList -> " + e.target.checked);
        billigFields.style = "background: green !important;";
        billigFields.style = "display: none !important;";
    } else {
        billigFields.style = "";
        console.log("else - shippingMethodList -> " + e.target.checked);
    }
}) 

// window.addEventListener
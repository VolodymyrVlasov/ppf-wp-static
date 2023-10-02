console.log("checkout.js")

const localPickup = document.getElementById("shipping_method_0_local_pickup2");
const npWrapper = document.getElementById("shipping_method_np_wrapper");
const np = document.getElementById("shipping_method_0_nova_poshta_shipping_method");
const anotherRecepient = document.getElementById("ship-to-different-address");
const billigFields = document.getElementById("woocommerce-billing-fields");


const shippingMethodList = document.getElementsByName("shipping_method[0]");



localPickup.addEventListener("change", e => {
    if (e.target.checked) {
        npWrapper.checked = false;
        // anotherRecepient.style = "display: none;";
    }
})


npWrapper.addEventListener("change", e => {
    if (e.target.checked) {
        setTimeout(() => {
            np.checked = true;
            console.log(np.checked)
        }, 0)
    }
})

np.addEventListener("change", e => {
    if (e.target.checked) {
        npWrapper.checked = true;
        // anotherRecepient.style = "";
    }
})

anotherRecepient.addEventListener("change", e => {
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
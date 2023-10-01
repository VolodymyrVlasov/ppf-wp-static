console.log("checkout.js")

const localPickup = document.getElementById("shipping_method_0_local_pickup2");
const npWrapper = document.getElementById("shipping_method_np_wrapper");
const np = document.getElementById("shipping_method_0_nova_poshta_shipping_method");
const anotherRecepient = document.getElementById("ship-to-different-address");


const shippingMethodList = document.getElementsByName("shipping_method[0]");



localPickup.addEventListener("change", e => {
    if (e.target.checked) {
        npWrapper.checked = false;
        anotherRecepient.style = "display: none;";
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
        anotherRecepient.style = "";
    }
})

// shippingMethodsGroup.addEventListener("change", () => {
//     shippingMethodList.forEach(method => {
//         if (method.checked) {
//             if (method.id != "shipping_method_0_local_pickup2") {
//                 const npWarehouseLegend = document.getElementById("shipping_method_0_nova_poshta_shipping_method_legend");
//                 const npPoshtomatLegend = document.getElementById("shipping_method_0_nova_poshta_shipping_method_poshtomat_legend");
//                 const npAddressLegend = document.getElementById("shipping_method_0_npttn_address_shipping_method_legend");

//                 switch (method.id) {
//                     // НП відділення
//                     case "shipping_method_0_nova_poshta_shipping_method":
//                         console.log("case 1", method.id);
//                         // npWarehouseLegend.innerHTML = NP_WH_PM;
//                         // npPoshtomatLegend.innerHTML = "";
//                         // npAddressLegend.innerHTML = "";
//                         break;
//                     // НП поштомат
//                     case "shipping_method_0_nova_poshta_shipping_method_poshtomat":
//                         console.log("case 2", method.id);

//                         // npWarehouseLegend.innerHTML = "";
//                         // npPoshtomatLegend.innerHTML = NP_WH_PM;
//                         // npAddressLegend.innerHTML = "";
//                         break;
//                     // НП адресна
//                     case "shipping_method_0_npttn_address_shipping_method":
//                         console.log("case 3", method.id);

//                         // npWarehouseLegend.innerHTML = "";
//                         // npPoshtomatLegend.innerHTML = "";
//                         // npAddressLegend.innerHTML = NP_WH_PM + NP_ADDRSS;
//                         break;
//                 }
//             }


//         }
//     })
// })





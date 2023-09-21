console.log("checkout.js")

const regionSelect = document.getElementById("billing_nova_poshta_region");
const citySelect = document.getElementById("billing_nova_poshta_city_field");

regionSelect.addEventListener("change", () => {
    setTimeout(() => {
        document.getElementsByClassName("select2-selection__arrow")[0].style.display = "none";

        citySelect.style.paddingBottom = "12px";
        const ref = document.getElementsByClassName("select2-selection select2-selection--single")[0];
        ref.style.border = "none";
        ref.style.backgroundColor = "transparent";
        ref.style.paddingLeft = "16px";
        // ref.style.color = "black";
        ref.style.width = "100% !important";

        const selected = document.getElementsByClassName("select2-selection__rendered")[0];
        selected.style.color = "black";


        

        // console.log(citySelect);
        // console.log(citySelect.children[2].children[0].children[0]);
        // citySelect.children[2].children[0].children[0].style.border = "none !important";
        // citySelect.children[2].children[0].children[0].style.backgroundColor = "red !important";
        // citySelect.children[2].children[0].children[0].style.fontSize = "36px !important";


    }, 0)

})



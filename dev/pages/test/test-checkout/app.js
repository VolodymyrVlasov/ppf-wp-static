
const inputCity = document.getElementById("checkout-city");
const dataList = document.getElementById("checkout-city-list");

const scheduleFetch = (query) => {
    fetch(`https://shop.paperfox.in.ua/?np=city&CityName=${query}`)
        .then(data => data.json())
        .then(data => {
            const resultList = data.data[0].Addresses;
            dataList.innerHTML = resultList.map(item => {
                return `<option class="link_14__gray" value="${item.Present}">${item.DeliveryCity}</option>`
            }).join("");
        })
        .catch(err => alert(err));
}

inputCity.addEventListener('input', (event) => {
    let query = event.target.value;
    if (query.length > 3) {
        console.log(query);
        scheduleFetch(query)
    }
})

inputCity.addEventListener("change", (e) => {
    console.dir(e.target);
    // console.table({ Present: e.target.value, Ref: e.target.dataset.DeliveryCity });
})
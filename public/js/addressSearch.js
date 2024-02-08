const searchBtn = document.getElementById("search-button");
const searchRes = document.getElementById("search-results");
const query = document.getElementById("address-search");
const match = document.getElementById("match");

searchBtn.addEventListener("click", (event) => {
    const resultList = document.getElementById("result-list");
    event.preventDefault();

    if (query.value) {
        const data = {
            query: query.value,
        };

        if (resultList) {
            resultList.remove();
        }

        const ul = document.createElement("ul");
        ul.id = "result-list";
        ul.className = "list-group mt-3";
        searchRes.appendChild(ul);

        axios.post("/search-address", data).then((res) => {
            res.data.forEach((element) => {
                const li = document.createElement("li");
                li.className = "search-result list-group-item";
                li.innerHTML = element.address.freeformAddress;
                ul.append(li);

                li.addEventListener("click", () => {
                    query.value = li.innerHTML;
                    match.value = li.innerHTML;
                    ul.remove();
                });
            });
        });
    }
});

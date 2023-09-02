document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.getElementById("search-input");
    searchInput.addEventListener("keyup", function () {
        searchTable(this.value);
    });

    function searchTable(value) {
        let table = document.getElementById("table");
        let rows = table
            .getElementsByTagName("tbody")[0]
            .getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            let rowData = rows[i].textContent.toLowerCase();
            if (rowData.includes(value.toLowerCase())) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
});

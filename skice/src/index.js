function toggleSearch() {
    console.log("search toggled");

    const searchInput = document.querySelector("#search-input");

    if (searchInput.display === "none") {
        searchInput.display = "block";
    } else {
        searchInput.style.display = "none";
    }
}

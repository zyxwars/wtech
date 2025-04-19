const toast = document.querySelector(".toast");

if (toast) {
    setTimeout(() => {
        toast.classList.add("opacity-0");
        setTimeout(() => {
            toast.style.display = "none";
        }, 500);
    }, 2000);
}

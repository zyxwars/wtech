const carouselEls = document.querySelectorAll(".rs-carousel-scroll");

function updateButtonVisibility(carouselEl, rightButtonEl, leftbuttonEl) {
    if (
        carouselEl.scrollLeft + 1 >
        carouselEl.scrollWidth - carouselEl.clientWidth
    ) {
        rightButtonEl.style.visibility = "hidden";
    } else {
        rightButtonEl.style.visibility = "visible";
    }

    if (carouselEl.scrollLeft === 0) {
        leftbuttonEl.style.visibility = "hidden";
    } else {
        leftbuttonEl.style.visibility = "visible";
    }
}

for (const carouselEl of carouselEls) {
    const right = carouselEl.querySelector(".rs-carousel-right");
    const left = carouselEl.querySelector(".rs-carousel-left");

    updateButtonVisibility(carouselEl, right, left);

    carouselEl.addEventListener("scrollend", () => {
        updateButtonVisibility(carouselEl, right, left);
    });

    right.addEventListener("click", () => {
        carouselEl.scroll({
            left: carouselEl.scrollLeft + carouselEl.clientWidth,
            behavior: "smooth",
        });
    });

    left.addEventListener("click", () => {
        carouselEl.scroll({
            left: carouselEl.scrollLeft - carouselEl.clientWidth,
            behavior: "smooth",
        });
    });
}

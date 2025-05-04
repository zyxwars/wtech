const galleryFrameEl = document.querySelector(".rs-gallery-frame");

if (galleryFrameEl) {
    const galleryEls = document.querySelectorAll(".rs-gallery");

    galleryFrameEl.style.display = "none";

    galleryFrameEl.addEventListener("click", () => {
        galleryFrameEl.style.display = "none";
        document.body.style.overflow = "auto";
    });

    for (const galleryEl of galleryEls) {
        galleryEl.addEventListener("click", () => {
            galleryFrameEl.querySelector("img").src = galleryEl.src;
            galleryFrameEl.style.display = "flex";
            document.body.style.overflow = "hidden";
        });
    }
}

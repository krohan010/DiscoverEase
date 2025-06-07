let slides = document.querySelectorAll(".slide");
let slideIndex = 1;

for (let i = 0; i < slides.length; i++) {
    slides[i].addEventListener("click", function () {
        zoomImage(i);
    });
}

function zoomImage(n) {
    // Remove the class from all images first
    slides.forEach(slide => slide.classList.remove("slider"));
    
    // Add the class to the clicked image
    slides[n].classList.add("slider");
    slides.forEach(slide => slide.style.filter= "blur(10px)");
    slides[n].style.filter="none";
}
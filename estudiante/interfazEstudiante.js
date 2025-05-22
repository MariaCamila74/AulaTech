let currentSlide = 0;

function showSlide(index) {
    const slides = document.querySelectorAll('.carrusel-item');
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }
    const offset = -currentSlide * 100;
    document.querySelector('.carrusel-inner').style.transform = `translateX(${offset}%)`;
}

function siguienteSlide() {
    showSlide(currentSlide + 1);
}

function anteriorSlide() {
    showSlide(currentSlide - 1);
}

document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentSlide);
});

setInterval(() => {
    siguienteSlide();
}, 2000);

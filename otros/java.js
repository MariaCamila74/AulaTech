let currentIndex = 0;
const cards = document.querySelectorAll('.card');
const totalCards = cards.length;

function updateCarousel() {
    const carousel = document.querySelector('.carousel');
    const translateXValue = -currentIndex * 100;
    carousel.style.transform = `translateX(${translateXValue}%)`;
}

function moveLeft() {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = totalCards - 1;
    }
    updateCarousel();
}

function moveRight() {
    if (currentIndex < totalCards - 1) {
        currentIndex++;
    } else {
        currentIndex = 0;
    }
    updateCarousel();
}

window.onload = function() {
    document.getElementById('alerta-container').style.display = 'block';
    document.body.classList.add('blur-active');
};

function cerrarAlerta() {
    const alerta = document.getElementById('alerta-container');
    alerta.style.display = 'none';
    document.body.classList.remove('blur-active');
}
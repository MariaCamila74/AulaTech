document.addEventListener('DOMContentLoaded', function () {
    const elementos = document.querySelectorAll('.imagen-texto img, .imagen-texto p');

    function checkElements() {
        const triggerBottom = window.innerHeight / 5 * 4;

        elementos.forEach(elemento => {
            const boxTop = elemento.getBoundingClientRect().top;

            if (boxTop < triggerBottom) {
                elemento.classList.add('show');
            } else {
                elemento.classList.remove('show');
            }
        });
    }

    window.addEventListener('scroll', checkElements);

    checkElements();
});


document.addEventListener('DOMContentLoaded', function () {
    const elementos = document.querySelectorAll('.imagen-texto img, .imagen-texto p, .cuerpo p');

    function checkElements() {
        const triggerBottom = window.innerHeight / 5 * 4;

        elementos.forEach(elemento => {
            const boxTop = elemento.getBoundingClientRect().top;

            if (boxTop < triggerBottom) {
                elemento.classList.add('show');
            } else {
                elemento.classList.remove('show');
            }
        });
    }

    window.addEventListener('scroll', checkElements);

    checkElements();
});

document.addEventListener('DOMContentLoaded', function () {
    const socialMedia = document.querySelector('.social-media');
    const section = document.querySelector('.section');

    function checkScroll() {
        const sectionBottom = section.getBoundingClientRect().bottom;
        const triggerBottom = window.innerHeight;

        if (sectionBottom < triggerBottom) {
            socialMedia.classList.add('show');
        } else {
            socialMedia.classList.remove('show');
        }
    }

    window.addEventListener('scroll', checkScroll);

    checkScroll();
});

document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
});

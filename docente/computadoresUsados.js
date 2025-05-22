document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('myModal');
    const closeButton = document.querySelector('.close');
    const cancelButton = document.getElementById('cancelButton');
    const openModalButton = document.getElementById('openModal');

    function openModal() {
        if (modal) {
            modal.style.display = 'block';
        }
    }

    function closeModal() {
        if (modal) {
            modal.style.display = 'none';
        }
    }

   
    if (openModalButton) {
        openModalButton.addEventListener('click', openModal);
    } else {
        console.error('No se encontró el botón para abrir el modal');
    }

    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    } else {
        console.error('No se encontró el botón de cierre del modal');
    }

    if (cancelButton) {
        cancelButton.addEventListener('click', closeModal);
    } else {
        console.error('No se encontró el botón de cancelar');
    }

    if (modal) {
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    } else {
        console.error('No se encontró el modal');
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const menuH = document.getElementById("menuH");
    const navbar = document.getElementById("navbar");

    if (menuH) { 
        menuH.addEventListener("click", () => {
            navbar.classList.toggle("hidden"); 
            navbar.classList.toggle("show");

            if (navbar.classList.contains("show")) {
                menuH.src = "../imagenes/equizs.png";
            } else {
                menuH.src = "../imagenes/menu.png";
            }
        });
    }
});

var Imagen = document.getElementById("ImagenContrasena");
console.log(Imagen);
Imagen.addEventListener("click", () => {
    Imagen.setAttribute("src", Imagen.getAttribute("src").includes("Cerrado") == true ? '../imagenes/Icono-Ojo-Abierto.png' : '../imagenes/Icono-Ojo-Cerrado.png');
    var password = document.getElementById("Id_Estudiante");
    password.setAttribute("type", Imagen.getAttribute("src").includes("Cerrado") == true ? "password":"text");
});

var Imagen2 = document.getElementById("ImagenContrasena2");
console.log(Imagen2);
if (Imagen2) {
    Imagen2.addEventListener("click", () => {
        Imagen2.setAttribute("src", Imagen2.getAttribute("src").includes("Cerrado") == true ? '../imagenes/Icono-Ojo-Abierto.png' : '../imagenes/Icono-Ojo-Cerrado.png');
        var password = document.getElementById("Id_Estudiante2");
        password.setAttribute("type", Imagen2.getAttribute("src").includes("Cerrado") == true ? "password":"text");
    });
}

var Imagen3 = document.getElementById("ImagenContrasena3");
console.log(Imagen3);
if (Imagen3) {
    Imagen3.addEventListener("click", () => {
        Imagen3.setAttribute("src", Imagen3.getAttribute("src").includes("Cerrado") == true ? '../imagenes/Icono-Ojo-Abierto.png' : '../imagenes/Icono-Ojo-Cerrado.png');
        var password = document.getElementById("Id_Estudiante3");
        password.setAttribute("type", Imagen3.getAttribute("src").includes("Cerrado") == true ? "password":"text");
    });
}

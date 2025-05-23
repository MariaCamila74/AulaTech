<?php

session_start();

if(!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
}else if(isset($_SESSION['Rol'])){
    if($_SESSION['Rol']==='Admin'){
        header('Location: ../administrador/admin.php');
        exit();
    }else if($_SESSION['Rol']==='Estudiante'){
        header('Location: ../estudiante/interfazEstudiante.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docente</title>
    <link rel="stylesheet" href="../estudiante/interfazEstudiante.css">
    <script src="../inicio/inicio.js"></script>
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="logo-nombre">
            <img src="../imagenes/Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="InterfazDocente.php">Inicio</a></li>
                <li><a href="">Reservar Sala</a></li>
                <li><a href="computadoresUsados1.php">Historial de Computadores</a></li>
                <li><a href="estudiantes-por-equipo.php">Historial de grupos</a></li>
                <li><a href="actividadesPendientes.php">Actividades</a></li>
                <!-- <li><a href="restablecerContrasenaD.php">Restablecer Contraseña</a></li> -->
                <li><select name="" id="">
                    <option value=""><a href="../otros/logout.php" id="logout">Cerrar Sesión</a></option>
                    <option value=""><a href="restablecerContrasenaD.php">Restablecer Contraseña</a></option>
                </select></li>
                <!-- <li><a href="../otros/logout.php" id="logout">Cerrar sesión</a></li> -->
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <main>
        <div class="container">
            <div class="pin" id="image-container">
                <img src="../imagenes/Pin-Docente.jpg" alt="" id="slideshow">
            </div>
            <div class="estudiante">
                <h2>¡Bienvenido <p>docente!</p>
                    Disfruta de tu <p>apartado</p>
                </h2>
            </div>
            <div class="frase">
                <p>Este proyecto busca tu bienestar, esperamos que <br> estés aprendiendo de la mejor manera</p>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer-info">
                <div class="footer-section">
                    <h4>Nombres de creadores</h4>
                    <p>Mesa Toro Juan Camilo</p>
                    <p>Monsalve Lopera Josué</p>
                    <p>Muñoz Arteaga Miller Santiago</p>
                    <p>Ortiz Maria Camila</p>
                </div>
                <div class="footer-section">
                    <h4>Redes Sociales</h4>
                    <p>Facebook: <a href="https://www.facebook.com/share/K4UHXvcXzuzLEsnT/?mibextid=LQQJ4d" target="_blank">IE San Antonio de Prado</a></p>
                    <p>Instagram: <a href="https://www.instagram.com/i.e.sadep?igsh=MWYzaGJtemxzZXN5aQ==" target="_blank">IE San Antonio de Prado</a></p>
                    <p>Correo: <a href="https://wwww.gmail.com" target="_blank">mediatecnicasadep@gmail.com</a></p>
                </div>
            </div>
            <div class="footer-logo">
                <img src="../imagenes/Logo1.png" alt="Logo" class="footer-logo-img">
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuH = document.getElementById("menuH");
            const navbar = document.getElementById("navbar");

            if (menuH) { 
                menuH.addEventListener("click", () => {
                    navbar.classList.toggle("hidden"); 
                    navbar.classList.toggle("show");

                    if (navbar.classList.contains("show")) {
                        menuH.src = "../imagenes/Icono-Cancelar.png";
                    } else {
                        menuH.src = "../imagenes/menu.png";
                    }
                });
            }
        });

        // const images = ['../imagenes/Pin-Docente.jpg', '../imagenes/Pin-Docente2.jpg'];
        // let currentImageIndex = 0;

        // // Función para cambiar la imagen
        // function changeImage() {
        //     currentImageIndex = (currentImageIndex + 1) % images.length;
        //     document.getElementById('slideshow').src = images[currentImageIndex];
        // }

        // // Cambiar la imagen cada 3 segundos (3000 milisegundos)
        // setInterval(changeImage, 3000);
    </script>
</body>

</html>


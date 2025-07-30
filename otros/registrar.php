<?php

session_start();

if(!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
}else if(isset($_SESSION['Rol'])){
    if($_SESSION['Rol']==='Estudiante'){
        header('Location: ../estudiante/interfazEstudiante.php');
        exit();
    }else if($_SESSION['Rol']==='Docente'){
        header('Location: ../docente/interfazDocente.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" href="../inicio/servicios.css">
    <script src="inicio.js"></script>
    <script src="carrusel.js"></script>
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="logo-nombre">
            <img src="../imagenes/Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="../index.html">Inicio</a></li>
                <li><a href="servicios.html">Servicios</a></li>
                <li><a href="contactanos.php">Contáctanos</a></li>
                <li><a href="iniciosesion.php">Iniciar Sesion</a></li>
                <li><a href="registrarse.html">Registrarse</a></li>
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <main>
        <h2>Servicios</h2>
        <div class="service-container">
            <div class="service-card">
                <div class="icon"><img src="../imagenes/Mantenimiento.png" alt="Mantenimiento Icono"></div>
                <h3>Mantenimiento de Sala de Informática</h3>
                <p>Los alfabetizadores harán un mantenimiento regular (Cada 6 meses) donde se revise la funcionalidad y
                    estados de los equipos de computación, con el fin de descartar los que no están en buen estado e
                    implementar pautas del cuidado de los computadores.</p>
            </div>
            <div class="service-card">
                <div class="icon-1"><img src="../imagenes/Vacantes.png" alt="Alfabetización Icono"></div>
                <h3>Vacantes de Alfabetización para Mantenimiento</h3>
                <p>AulaTech ofrece una espacio para estudiantes de especialidad donde podrán cumplir con sus
                    responsabilidades y adquirir nuevos conocimientos del cuidado de los equipos infromáticos por medio
                    del mantenimiento de los equipos.</p>
            </div>
            <div class="service-card">
                <div class="icon"><img src="../imagenes/Computadores.png" alt="Préstamo Icono"></div>
                <h3>Disponibilidad de la sala de informática</h3>
                <p>Está página, contará con un apartado de docentes, el cual incluirá una tabla de disponibilidad y
                    horarios de la sala de informática, con el fin de abrir espacios a profesores externos al área y
                    puedan hacer actividades allí.</p>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer-info">
                <div class="footer-section">
                    <h4>Nombres de creadores</h4>
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
    </script>
</body>

</html>
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
                <li><a href="admin.php">Inicio</a></li>
                <!-- <li><a href="Administrador.php">Agregar Administrador</a></li>
                <li><a href="Estudiante.php">Estudiantes</a></li>
                <li><a href="Docente.php">Docentes</a></li> -->
                <li><a href="registrar.php">Registrar</a></li>
                <li><a href="../otros/logout.php" id="logout">Cerrar sesión</a></li>
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <main>
        <h2>¿A quién deseas registrar?</h2>
        <div class="service-container">
            <div class="service-card">
                <div class="icon"><img src="../imagenes/Mantenimiento.png" alt="Mantenimiento Icono"></div>
                <h3>Administrador</h3>
                <p>Los administradores tendrán el control total de los apartados; podrán rechazar o aceptar alguna
                    reservación de las salas de informática, registrar a las diferentes personas para los diferentes
                    apartados, entre otras funciones. </p>
            </div>
            <div class="service-card">
                <div class="icon-1"><img src="../imagenes/Vacantes.png" alt="Alfabetización Icono"></div>
                <h3>Docente</h3>
                <p>Los docentes podrán interactuar más con los estudiantes, subiendo guías o trabajos,
                    al mismo tiempo los estudiantes podrán responder con sus trabajos a estás asignaciones, además podrán
                    tener un control de los equipos de la sala, entre otros. </p>
            </div>
            <div class="service-card">
                <div class="icon"><img src="../imagenes/Computadores.png" alt="Préstamo Icono"></div>
                <h3>Estudiante</h3>
                <p>Los estudiantes podrán interactuar más con los docentes, teniendo está plataforma como un aliado para
                    entregrar más eficazmenete sus trabajos, además los estudiantes de décimo y undécimo podrán acceder a 
                    beneficios como la alfabetización </p>
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
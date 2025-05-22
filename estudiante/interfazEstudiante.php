<?php

session_start();

if(!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
}else if(isset($_SESSION['Rol'])){
    if($_SESSION['Rol']==='Admin'){
        header('Location: ../administrador/admin.php');
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
    <title>Estudiante</title>
    <link rel="stylesheet" href="interfazEstudiante.css">
    <script src="interfazEstudiante.js"></script>
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="logo-nombre">
            <img src="../imagenes/Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="interfazEstudiante.php">Inicio</a></li>
                <li><a href="computadoresUsados.php">Historial de Computadores</a></li>
                <li><a href="actividadesPendientes1.php">Actividades</a></li>
                <li><a href="restablecerContrasena.php">Restablecer Contraseña</a></li>
                <li><a href="../otros/logout.php" id="logout">Cerrar sesión</a></li>
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <main>
        <div class="container">
            <div class="pin">
                <img src="../imagenes/Pin.jpg" alt="">
            </div>
            <div class="estudiante">
                <h2>¡Bienvenido <p>estudiante!</p>
                    Disfruta de tu <p>apartado</p>
                </h2>
            </div>
            <div class="frase">
                <p>El proyectos busca tu bienestar, esperamos que <br> estes aprendiendo de la mejor manera</p>
            </div>
        </div>
        <!-- <div class="titulo">
            <h2>Mira algunas fotos de tu <p>institución</p>
            </h2>
        </div> -->
        <!-- <div class="carrusel-fondo">
            <div class="carrusel">
                <div class="carrusel-inner">
                    <div class="carrusel-item">
                        <img src="imagenes/central.jpg" alt="Foto Sede">
                    </div>
                    <div class="carrusel-item">
                        <img src="imagenes/mall.jpg" alt="Foto Sede">
                    </div>
                    <div class="carrusel-item">
                        <img src="imagenes/sede.jpg" alt="Foto Sede">
                    </div>
                    <div class="carrusel-item">
                        <img src="imagenes/estudiantes.jpg" alt="Foto Sede">
                    </div>
                </div>
                <button class="anterior" onclick="anteriorSlide()">&#10094;</button>
                <button class="siguiente" onclick="siguienteSlide()">&#10095;</button>
            </div>
        </div> -->
        <!-- <div class="saberMas">
            <h4>¿Te gustaría saber los computadores que has utilizado durante tus horas de clase? <h4>
            <p>En este espacio podrás ver los computadores que has utilizado durante las horas de clase en
                tecnologia, logrando manifestar el buen registro que se lleva de estos, que los disfrutes</p>
            <button><a href="computadoresUsados.html">Click aquí</a></button>
        </div> -->
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
    </script>
</body>

</html>